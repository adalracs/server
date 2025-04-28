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
| Fecha 		| Motivo								| Autor 	|
16-ene-2006		Implementaci�n del borrado de OT		mstroh
*/
if(!isset($arr_transacitem))
{
	include ( '../src/FunPerPriNiv/pktblcampo.php');
	include ( '../src/FunPerPriNiv/pktbltabla.php');
	include ( '../src/FunPerPriNiv/pktbltransacitem.php');
}
include ( '../src/FunGen/fncnumprox.php'); 
include ( '../src/FunGen/fncnumact.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');

function grabatransacitem($iRegtransacitem,$iRegvalidaitem,&$flagnuevotransacitem,&$campnomb)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id_i",50);
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
	define("errorIng",35);

	$nuidtemp = fncnumact(id_i,$nuconn);
	do
	{
		$nuresult = loadrecordtransacitem($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegtransacitem[transitecodigo] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);

	if ($iRegvalidaitem['otflag'])
	{
		$result = insrecordtransacitem($iRegtransacitem,$nuconn);
		if($result < 0 )
		{
			$flagnuevotransacitem = 1;
		}
		if($result > 0)
		{
			$nuresult1 = fncnumprox(id_i,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
		}
		return ;
	}
	else
	{
		if($iRegtransacitem)
		{
			$iRegtabla["tablnomb"] = "transacitem";
			$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
			$num = fncnumreg($resulttabla);
			for($i=0;$i<$num;$i++)
			{
				$sbregtabla = fncfetch($resulttabla,$i);
				if($sbregtabla[tablnomb] == "transacitem")
				{
					$tablcodi = $sbregtabla['tablcodi'];
					break;
				}
			}

			$iRegCampo["tablcodi"]=$tablcodi;
			$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);

			while($elementos = each($iRegtransacitem))
			{
				$iRegCampo["campnomb"] = $elementos[0];
				$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
				$num = fncnumreg($resultcampo);
				if($num>0)
				{
					$sbregcampo = fncfetch($resultcampo,0);
					if($elementos[0] != "transitecodigo")
					{
						if($sbregcampo["campnomb"] == $elementos[0])
						{
							$respuesta = strcmp($sbregcampo["campnotnull"],"t");
							if($respuesta == 0)
							{
								if($elementos[1] == "")
								{
									$campnomb[$elementos[0]] = 1;
									$flagnuevotransacitem = 1;
									$flagerror = 1;
								}
							}
						}
					}
				}
				$validar = buscacaracter($elementos[1]);

				if($validar == 1)
				{
					$flagnuevotransacitem = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
				$validresult = consulmetatransacitem($elementos[0],$elementos[1],$nuconn);

				if($validresult == 1)
				{
					$flagnuevotransacitem = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
					unset ($validresult);
				}
				if($elementos[0] == "itemcodigo" && $elementos[1] == "")
				{
					$flagnuevotransacitem = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
				if($elementos[0] == "transitecantid" && (($elementos[1] < 0) || ($elementos[1] == "")))
				{
					fncmsgerror(validcan);
					$flagnuevotransacitem = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}

				if($elementos[0] == "bodegacodigo" && $elementos[1] == "")
				{
					$flagnuevotransacitem = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}

				if($elementos[0] == "itestacodigo" && $elementos[1] == "")
				{
					$flagnuevotransacitem = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			}

			if($flagerror == 1)
			{
				fncmsgerror(errorIng);
			}

			if($flagerror != 1)
			{
				if($iRegtransacitem[itemcodigo] && $iRegtransacitem[transitecantid])
				{
					$validdispon = validadisponibilidad($iRegvalidaitem,$iRegtransacitem[transitecantid],$iRegtransacitem[tipmovcodigo],$nuconn);
					if($validdispon > 0)
					{
						$result = insrecordtransacitem($iRegtransacitem,$nuconn);
						if($result < 0 )
						{
							fncmsgerror(errorReg);
							$flagnuevotransacitem=1;
						}
						if($result > 0)
						{
							$sumitem = $iRegvalidaitem[itemdispon] + $iRegtransacitem[transitecantid];
							updateitemdispon($iRegvalidaitem[itemcodigo],$sumitem,$nuconn);
							
							$nuresult1 = fncnumprox(id_i,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
							fncmsgerror(grabaEx);
						}
					}
					else
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
}

if(!isset($arr_transacitem))
{
	if($bodegatipo == 2):
		$idcon = fncconn();
		$rs_bodega = dinamicscanopbodega(array('usuacodi' => $usuacodigo, 'bodegatipo' => 2), array('usuacodi' => '=', 'bodegatipo' => '='), $idcon);
		
		
		if($rs_bodega > 0):
			$rw_bodega = fncfetch($rs_bodega, 0);
			$iRegtransacitem[bodegacodigo] = $rw_bodega['bodegacodigo'];
		else:
			$transcbodega = true;
			include 'grababodegatecnico.php';
			$iRegtransacitem[bodegacodigo] = $bodegacode;
		endif;
	else:
		$iRegtransacitem[bodegacodigo]   = $bodegacodigo;
	endif;
		
	$transitetotal = $transitecantid * $itemvalor;

	$iRegtransacitem[transitecodigo] = $transitecodigo;
	$iRegtransacitem[tipmovcodigo]   = $tipmovcodigo;
	$iRegtransacitem[itemcodigo]     = $itemcodigo;
	$iRegtransacitem[transitefecha]  = $transitefecha;
	$iRegtransacitem[transitecantid] = $transitecantid;
	$iRegtransacitem[transitetotal]  = $transitetotal;
	$iRegtransacitem[usuacodi]       = $usuacodi;
	$iRegtransacitem[pedidocodigo]   = $pedidocodigo;
	$iRegtransacitem[itestacodigo]   = $itestacodigo;
	
	$idcon = fncconn();
	$rs_item = loadrecorditem($itemcodigo, $idcon);
	
	$iRegvalidaitem[itemcodigo] = $rs_item[itemcodigo];
	$iRegvalidaitem[itemcanmin] = $rs_item[itemcanmin];
	$iRegvalidaitem[itemcanmax] = $rs_item[itemcanmax];
	$iRegvalidaitem[itemdispon] = $rs_item[itemdispon];

	grabatransacitem($iRegtransacitem,$iRegvalidaitem,$flagnuevotransacitem,$campnomb);
}
else
{
	global $usuacodi;
	$num = count($arr_transacitem);
	
	for($i=0; $i<$num; $i++)
	{
		$iRegtransacitem[transitecodigo] = $transitecodigo;
		$iRegtransacitem[tipmovcodigo]   = 1;
		$iRegtransacitem[itemcodigo]  	 = $arr_transacitem[$i]["itemcodigo"];
		$iRegtransacitem[transitefecha]  = date("Y-m-d");
		$iRegtransacitem[transitecantid] = $arr_transacitem[$i]["transitecantid"];
		$iRegtransacitem[transitetotal]  = $arr_transacitem[$i]["transitetotal"];
		$iRegtransacitem[bodegacodigo]   = $arr_transacitem[$i]["bodegacodigo"];
		$iRegtransacitem[usuacodi]       = $usuacodi;

		$iRegvalidaitem['otflag'] = 1;

		grabatransacitem($iRegtransacitem,$iRegvalidaitem,$flagnuevotransacitem,$campnomb);
	}
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
			if($sumitem > $arritem[itemcanmax])
			{
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'alert("Se excedi\u00f3 la capacidad m\u00e1xima")';
				echo '//-->'."\n";
				echo '</script>';
				return 1;
			}
			elseif ($sumitem < $arritem[itemcanmin])
			{
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'alert("Se excedi\u00f3 la capacidad m\u00ednima de este item")';
				echo '//-->'."\n";
				echo '</script>';
				return 1;
			}
			else
			{
				return 1;
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
			updateitemdispon($arritem[itemcodigo],$resitem,$idcon);

			if($resitem > $arritem[itemcanmax])
			{
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'alert("Se excedi\u00f3 la capacidad m\u00e1xima")';
				echo '//-->'."\n";
				echo '</script>';
				return 1;
			}
			elseif ($resitem < $arritem[itemcanmin])
			{
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'alert("Se excedi\u00f3 la capacidad m\u00ednima de este item")';
				echo '//-->'."\n";
				echo '</script>';
				return 1;
			}
			else
			{
				return 1;
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
