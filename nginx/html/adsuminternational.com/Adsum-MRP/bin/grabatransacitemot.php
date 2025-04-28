<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabatransacitem
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegtransacitem         Arreglo de datos.
$flagnuevotransacitem    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/

include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../def/tipocampo.php');
if(!$flagreportotitem) {
	include ( '../src/FunPerPriNiv/pktbltransacitem.php');
}
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');

// Bajamos las variable de sesi�n
$arrtransacitem    = $_SESSION["arrtransacitem"];
$arrtransaccoditem = $_SESSION["arrtransaccoditem"];
$arrtransactran    = $_SESSION["arrtransactran"];

if($flagsoliotitem == 1)
{
	// Este es el primer registro de las variables
	$nuconn = fncconn();
	/*$initransac  = begintransaction($nuconn);
	$arrtransacitem = $_SESSION["arrtransacitem"];
	$arrtransacitem[0][0] = null;
	$arrtransacitem[0][1] = $initransac;
	$arrtransaccoditem[0][0] = null;
	$arrtransaccoditem[0][1] = null;
	$_SESSION["arrtransacitem"] = $arrtransacitem;
	$_SESSION["arrtransaccoditem"] = $arrtransaccoditem;*/
}

function grabatransacitem($iRegtransacitem,$iRegvalidaitem,&$flagnuevotransacitem,&$campnomb,&$flagsoliotitem)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",50);
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("compactu",6);
	define("fecvalid",7);
	define("errormail",8);
	define("editaEx",9);
	define("validcan",11);
	
	$nuidtemp = fncnumact(id,$nuconn);
	do
	{
		$nuresult = loadrecordtransacitem($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegtransacitem[transitecodigo] = $nuidtemp;
		}
		$nuidtemp++;
	}while ($nuresult != e_empty);

	if ($iRegtransacitem)
	{
		while($elementos = each($iRegtransacitem))
		{
			$validar = buscacaracter($elementos[1]);
			if($validar == 1)
			{
				fncmsgerror(errorCar);
				$flagnuevotransacitem = 1;
				$flagerror = 1;
				$campnomb = $elementos[0];
				break;
			}
			$validresult = consulmetatransacitem($elementos[0],$elementos[1],$nuconn);
			if ($validresult == 1)
			{
				$flagnuevotransacitem = 1;
				$flagerror = 1;
				$campnomb = $elementos[0];
				unset ($validresult);
				break;
			}
			if($elementos[0] == "transitecantid" && $elementos[1] < 0)
			{
				fncmsgerror(validcan);
				$flagnuevotransacitem = 1;
				$flagerror = 1;
				$campnomb = $elementos[0];
				break;
			}

		}

		if($flagerror != 1)
		{
			if($iRegtransacitem[itemcodigo] && $iRegtransacitem[transitecantid])
			{
				$validdispon = validadisponibilidad($iRegvalidaitem,$iRegtransacitem[transitecantid],$iRegtransacitem[tipmovcodigo],$nuconn);
				
				if(is_string($validdispon))
				{
					$resultSql = insrecordtransacitemtran($iRegtransacitem,$nuconn);

					if(is_int($resultSql))
					{
						ob_end_clean();
						fncmsgerror(errorReg);
						$flagnuevotransacitem=1;
					}
					else
					{
						$arrtransacitem    = $_SESSION["arrtransacitem"];
						$arrtransaccoditem = $_SESSION["arrtransaccoditem"];
						$arrtransactran    = $_SESSION["arrtransactran"];


						if($flagsoliotitem == 1)
						{
							$arrtransacitem[0][0] = $iRegtransacitem["itemcodigo"];
							$arrtransacitem[0][1] = $iRegtransacitem["transitecodigo"];
							$arrtransacitem[0][2] = $validdispon;
							$arrtransacitem[1][0] = $iRegtransacitem["itemcodigo"];
							$arrtransacitem[1][1] = $iRegtransacitem["transitecodigo"];
							$arrtransacitem[1][2] = $resultSql;
							$arrtransaccoditem[0][0] = $iRegtransacitem["itemcodigo"];
							$arrtransaccoditem[0][1] = $iRegtransacitem["transitecantid"];
							$arrtransactran[0][0] = $iRegtransacitem["itemcodigo"];
							$arrtransactran[0][1] = $iRegtransacitem["transitecodigo"];
							$flagsoliotitem = 2;
							$_SESSION["flagsoliotitem"] = $flagsoliotitem;
						}
						else
						{
							// Ciclo de validaci�n de llave primaria de la tabla item
							for ($i = 0;$i < count($arrtransacitem); $i++)
							{
								// Valido si herramcodigo existe para sobreescibir el registro
								if($arrtransacitem[$i][0] == $iRegtransacitem["itemcodigo"])
								{
									$arrtransacitem[$i][1] = $iRegtransacitem["transitecodigo"];
									$arrtransacitem[$i][2] = $validdispon;
									$arrtransacitem[$i+1][1] = $iRegtransacitem["transitecodigo"];
									$arrtransacitem[$i+1][2] = $resultSql;
									$i = $i + 1;
									$transacedit = 1;
								}
							}
							if(!$transacedit)
							{
								//si no existe el registro, inserto uno nuevo
								$y = count($arrtransacitem);
								$arrtransacitem[$y][0] = $iRegtransacitem["itemcodigo"];
								$arrtransacitem[$y][1] = $iRegtransacitem["transitecodigo"];
								$arrtransacitem[$y][2] = $validdispon;
								$arrtransacitem[$y+1][0] = $iRegtransacitem["itemcodigo"];
								$arrtransacitem[$y+1][1] = $iRegtransacitem["transitecodigo"];
								$arrtransacitem[$y+1][2] = $resultSql;
							}
							// Ciclo de validaci�n de llave primaria de la tabla item y campo cantidad
							for ($i = 0;$i < count($arrtransaccoditem); $i++)
							{
								// Valido si herramcodigo existe para sobreescibir el registro
								if($arrtransaccoditem[$i][0] == $iRegtransacitem["itemcodigo"])
								{
									$arrtransaccoditem[$i][1] = $iRegtransacitem["transitecantid"];
									$transacod = 1;
								}
							}
							if(!$transacod)
							{
								//si no existe el registro, inserto uno nuevo
								$x = count($arrtransaccoditem);
								$arrtransaccoditem[$x][0] = $iRegtransacitem["itemcodigo"];
								$arrtransaccoditem[$x][1] = $iRegtransacitem["transitecantid"];
							}
							// Ciclo de validaci�n de llave primaria de la tabla item y transacitem
							for ($i = 0;$i < count($arrtransactran); $i++)
							{
								// Valido si herramcodigo existe para sobreescibir el registro
								if($arrtransactran[$i][0] == $iRegtransacitem["herramcodigo"])
								{
									$arrtransactran[$i][0] = $iRegtransacitem["itemcodigo"];
									$arrtransactran[$i][1] = $iRegtransacitem["transitecodigo"];
									$transacodite = 1;
								}
							}
							if(!$transacodite)
							{
								//si no existe el registro, inserto uno nuevo
								$z = count($arrtransactran);
								$arrtransactran[$z][0] = $iRegtransacitem["itemcodigo"];
								$arrtransactran[$z][1] = $iRegtransacitem["transitecodigo"];
							}
						}
						//Subo los arreglos a las variables de sesi�n
						$_SESSION["arrtransacitem"]    = $arrtransacitem;
						$_SESSION["arrtransaccoditem"] = $arrtransaccoditem;
						$_SESSION["arrtransacite"]     = $arrtransacite;
						$_SESSION["arrtransactran"]    = $arrtransactran;

						$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
						if(!$iRegvalidaitem["flagrepite"])
						{
							fncmsgerror(grabaEx);	
						}
					}
				}else
				{
					$flagnuevotransacitem=1;
				}
			}
			else
			{
				fncmsgerror(errorReg);
				$flagnuevotransacitem=1;
			}
			fncclose($nuconn);
		}
	}

}
// $flagreportotitem: indica la devolución de items/herramientas desde Gestion de OT/Reporte de OT
if(!$flagreportotitem)
{
	$transitetotal = $transitecantid * $itemvalor;
	$iRegtransacitem[transitecodigo] = $transitecodigo;
	$iRegtransacitem[tipmovcodigo] = $tipmovcodigo;
	$iRegtransacitem[itemcodigo] = $itemcodigo;
	$iRegtransacitem[transitefecha] = $transitefecha;
	$iRegtransacitem[transitecantid] = $transitecantid;
	$iRegtransacitem[transitetotal] = $transitetotal;
	$iRegtransacitem[usuacodi] = $usuacodi;

	$iRegvalidaitem[itemcodigo] = $itemcodigo;
	$iRegvalidaitem[itemcanmin] = $itemcanmin;
	$iRegvalidaitem[itemcanmax] = $itemcanmax;
	$iRegvalidaitem[itemdispon] = $itemdispon;

	grabatransacitem($iRegtransacitem,$iRegvalidaitem,$flagnuevotransacitem,$campnomb,$flagsoliotitem);
}
else
{
	$idcon = fncconn();
	$arr_inicial = explode("||", $arreglo_aux);
	$num_inicial = count($arr_inicial);

	for ($i=0; $i<$num_inicial; $i++)
	{
		$arr_def = explode(",", $arr_inicial[$i]);

		if(trim($arr_def[1]) == "")
		{
			echo '<script language="Javascript">'."\n";
			echo '<!--//'."\n";
			echo 'alert("Debe especificar una cantidad valida");'."\n";
			echo '//-->'."\n";
			echo '</script>'."\n";

			break;
		}
		else {
			$dat_aux = loadrecorditem($arr_def[0], $idcon);

			$transitetotal = $arr_def[1] * $dat_aux["itemvalor"];
			$iRegtransacitem["transitecodigo"] = $transitecodigo;
			$iRegtransacitem["tipmovcodigo"]   = 1;
			$iRegtransacitem["itemcodigo"]	   = $arr_def[0];
			$iRegtransacitem["transitefecha"]  = $transitefecha;
			$iRegtransacitem["transitecantid"] = $arr_def[1];
			$iRegtransacitem["transitetotal"]  = $transitetotal;
			$iRegtransacitem["usuacodi"] 	   = $usuacodi;

			$iRegvalidaitem["itemcodigo"] = $arr_def[0];
			$iRegvalidaitem["itemcanmin"] = $dat_aux["itemcanmin"];
			$iRegvalidaitem["itemcanmax"] = $dat_aux["itemcanmax"];
			$iRegvalidaitem["itemdispon"] = $dat_aux["itemdispon"];
			// Bandera adicional de validacion
			$iRegvalidaitem["flagrepite"] = true;

			grabatransacitem($iRegtransacitem,$iRegvalidaitem,$flagnuevotransacitem,$campnomb,$flagsoliotitem);
			
			if(!$flagnuevotransacitem)
			{
				echo '<script language="javascript">'."\n";
				echo '<!--//'."\n";
				echo 'alert("Grabado exitiso");'."\n";
				echo 'self.close();'."\n";
				echo '//-->'."\n";
				echo '</script>'."\n";
			}
		}
	}
	fncclose($idcon);
}

/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : validadisponibilidad
Decripcion      : Valida y actualiza la tabla item
Parametros      : Descripicion
$arritem         Arreglo de datos.
$transaccan    	 cantidad
$tipomovi		 Codigo de tipomovi

Retorno         :
true	= 1
false	= 0
Autor           : lfolaya
Fecha           : 26012005
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/
function validadisponibilidad($arritem,$transaccan,$tipomovi,$idcon)
{
	$sbregtipomovi = loadrecordtipomovi($tipomovi,$idcon);

	if($sbregtipomovi[tipmovtipo] > 0)
	{
		$sumitem = $arritem[itemdispon] + $transaccan;
		if($sumitem >= 0)
		{
			$resultSql = updateitemdispontran($arritem[itemcodigo],$sumitem,$idcon);

			if($sumitem > $arritem[itemcanmax])
			{
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'alert("Execedio la capacidad m�xima")';
				echo '//-->'."\n";
				echo '</script>';
				return $resultSql;
			}
			elseif ($sumitem < $arritem[itemcanmin])
			{
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'alert("Execedio la capacidad minima")';
				echo '//-->'."\n";
				echo '</script>';
				return $resultSql;
			}
			else
			{
				return $resultSql;
			}
		}else
		{
			echo '<script language="javascript">';
			echo '<!--//'."\n";
			echo 'alert("Cantidad no permitida")';
			echo '//-->'."\n";
			echo '</script>';
			return -1;
		}
	}
	elseif ($sbregtipomovi[tipmovtipo] < 1)
	{

		$resitem = $arritem[itemdispon] - $transaccan;
		if($resitem >= 0)
		{
			$resultSql = updateitemdispontran($arritem[itemcodigo],$resitem,$idcon);

			if($resitem > $arritem[itemcanmax])
			{
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'alert("Execedio la capacidad m�xima")';
				echo '//-->'."\n";
				echo '</script>';
				return $resultSql;
			}
			elseif ($resitem < $arritem[itemcanmin])
			{
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'alert("Execedio la capacidad minima")';
				echo '//-->'."\n";
				echo '</script>';
				return $resultSql;
			}
			else
			{
				return $resultSql;
			}
		}else
		{
			echo '<script language="javascript">';
			echo '<!--//'."\n";
			echo 'alert("Cantidad no permitida")';
			echo '//-->'."\n";
			echo '</script>';
			return -1;
		}
	}
}
?> 
