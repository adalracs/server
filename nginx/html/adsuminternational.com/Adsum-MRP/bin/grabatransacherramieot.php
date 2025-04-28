<?php 
/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : grabatransacherramie 
Decripcion      : Valida la data a grabar y la lleva al paquete. 
Parametros      : Descripicion 
    $iRegtransacherramie         Arreglo de datos. 
    $flagnuevotransacherramie    Bandera de validación 
Retorno         : 
		true	= 1 
		false	= 0 
Autor           : ariascos 
Escrito con     : WAG Adsum versión 3.1.1 
Fecha           : 18082004 
Historial de modificaciones 
| Fecha | Motivo				| Autor 	| 
*/ 
  
include ( '../src/FunGen/fncnumprox.php'); 
include ( '../src/FunGen/fncnumact.php'); 
include ( '../def/tipocampo.php'); 
include ( '../src/FunPerPriNiv/pktbltransacherramie.php'); 
include ( '../src/FunGen/buscacaracter.php'); 
include ( '../src/FunGen/fncmsgerror.php'); 

// Bajamos las variable de sesión
$arrtransac = $_SESSION["arrtransac"];
$arrtransaccod = $_SESSION["arrtransaccod"];
$arrtransacherr = $_SESSION["arrtransacherr"];

if($flagsoliot == 1)	
{
	// Este es el primer registro de las variables
	$nuconn = fncconn();
/*	$initransac = begintransaction($nuconn);
	$arrtransac = $_SESSION["arrtransac"];
	$arrtransac[0][0] = null;
	$arrtransac[0][1] = null;
	$arrtransac[0][2] = $initransac;
	$arrtransaccod[0][0] = null;
	$arrtransaccod[0][1] = null;
	$_SESSION["arrtransac"] = $arrtransac;
	$_SESSION["arrtransaccod"] = $arrtransaccod;*/
}
 
function grabatransacherramietran($iRegtransacherramie,$iRegvalidaherramie,&$flagnuevotransacherramie,&$campnomb,&$flagsoliot)
{ 
	$nuconn = fncconn(); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
	define("id",51);
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
	
	$nuidtemp = fncnumact(id,$nuconn);
	do
	{ 
		$nuresult = loadrecordtransacherramie($nuidtemp,$nuconn); 
		if($nuresult == e_empty) 
		{ 
			$iRegtransacherramie[transhercodigo] = $nuidtemp; 
		} 
		$nuidtemp ++; 
	}while ($nuresult != e_empty); 
	//$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
		
	if ($iRegtransacherramie) 
	{ 
		while($elementos = each($iRegtransacherramie)) 
		{ 
			$validar = buscacaracter($elementos[1]); 
			if($validar == 1) 
			{ 
				fncmsgerror(errorCar); 
				$flagnuevotransacherramie = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			if($elementos[0] == "transhercanti" && $elementos[1] < 0)
			{
				fncmsgerror(validcan); 
				$flagnuevotransacitem = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1; 
			}
			if (($elementos[0] == "herramcodigo") && ($elementos[1] == ""))
			{
				$flagnuevotransacherramie = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			if (($elementos[0] == "transhercanti") && ($elementos[1] == ""))
			{
				$flagnuevotransacherramie = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			} 
		} 
		if ($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}
		if($flagerror != 1) 
		{
			if($iRegtransacherramie[herramcodigo] && $iRegtransacherramie[transhercanti] && $iRegtransacherramie[tipmovcodigo])
			{ 
				$validdispon = validadisponibilidad($iRegvalidaherramie,$iRegtransacherramie[transhercanti],$iRegtransacherramie[tipmovcodigo],$nuconn);
				
				
				if(is_string($validdispon))
				{
					$resultSql = insrecordtransacherramietran($iRegtransacherramie,$nuconn); 
 					
					if(is_int($resultSql)) 
					{ 
						ob_end_clean();
						fncmsgerror(errorReg);
						$flagnuevotransacherramie=1; 
					} 
					else 
					{
						$arrtransac = $_SESSION["arrtransac"];
						$arrtransaccod = $_SESSION["arrtransaccod"];
						$arrtransacherr = $_SESSION["arrtransacherr"];
																		
						if($flagsoliot == 1)
						{
							// Este es el segundo registro de las variables
							$arrtransac[0][0] = $iRegtransacherramie["herramcodigo"];
							$arrtransac[0][1] = $iRegtransacherramie["transhercodigo"];
							$arrtransac[0][2] = $validdispon;
							$arrtransac[1][0] = $iRegtransacherramie["herramcodigo"];
							$arrtransac[1][1] = $iRegtransacherramie["transhercodigo"];
							$arrtransac[1][2] = $resultSql;
							$arrtransaccod[0][0] = $iRegtransacherramie["herramcodigo"];
							$arrtransaccod[0][1] = $iRegtransacherramie["transhercanti"];
							$arrtransacherr[0][0] = $iRegtransacherramie["herramcodigo"];
							$arrtransacherr[0][1] = $iRegtransacherramie["transhercodigo"];
							$flagsoliot = 2;
							$_SESSION["flagsoliot"] = $flagsoliot;
						}else 
						{
							// Ciclo de validación de llave primaria de la tabla herramie
							for ($i = 0;$i < count($arrtransac); $i++)
    						{
    							// Valido si herramcodigo existe para sobreescibir el registro
	    						if($arrtransac[$i][0] == $iRegtransacherramie["herramcodigo"])
	    						{
	    							$arrtransac[$i][1] = $iRegtransacherramie["transhercodigo"];
	    							$arrtransac[$i][2] = $validdispon;
	    							$arrtransac[$i+1][1] = $iRegtransacherramie["transhercodigo"];
	    							$arrtransac[$i+1][2] = $resultSql;
	    							$i = $i + 1;
	    							$transacedit = 1;
	    						} 
	    					}
	    					if(!$transacedit)
	    					{
	    						//si no existe el registro, inserto uno nuevo
	    						$y = count($arrtransac);
		    					$arrtransac[$y][0] = $iRegtransacherramie["herramcodigo"];
		    					$arrtransac[$y][1] = $iRegtransacherramie["transhercodigo"];
								$arrtransac[$y][2] = $validdispon;
								$arrtransac[$y+1][0] = $iRegtransacherramie["herramcodigo"];
								$arrtransac[$y+1][1] = $iRegtransacherramie["transhercodigo"];
								$arrtransac[$y+1][2] = $resultSql;
							}
							// Ciclo de validación de llave primaria de la tabla herramie y campo cantidad
							for ($i = 0;$i < count($arrtransaccod); $i++)
    						{
    							// Valido si herramcodigo existe para sobreescibir el registro
    							if($arrtransaccod[$i][0] == $iRegtransacherramie["herramcodigo"])
	    						{
	    							$arrtransaccod[$i][1] = $iRegtransacherramie["transhercanti"];
	    							$transacod = 1;
	    						} 
	    					}
							if(!$transacod)
							{
								//si no existe el registro, inserto uno nuevo
								$x = count($arrtransaccod);
								$arrtransaccod[$x][0] = $iRegtransacherramie["herramcodigo"];
								$arrtransaccod[$x][1] = $iRegtransacherramie["transhercanti"];
							}
							// Ciclo de validación de llave primaria de la tabla herramie y transacherramie
							for ($i = 0;$i < count($arrtransacherr); $i++)
    						{
    							// Valido si herramcodigo existe para sobreescibir el registro
    							if($arrtransacherr[$i][0] == $iRegtransacherramie["herramcodigo"])
	    						{
	    							$arrtransacherr[$i][0] = $iRegtransacherramie["herramcodigo"];
	    							$arrtransacherr[$i][1] = $iRegtransacherramie["transhercodigo"];
	    							$transacodherr = 1;
	    						} 
	    					}
							if(!$transacodherr)
							{
								//si no existe el registro, inserto uno nuevo
								$z = count($arrtransacherr);
								$arrtransacherr[$z][0] = $iRegtransacherramie["herramcodigo"];
								$arrtransacherr[$z][1] = $iRegtransacherramie["transhercodigo"];
							}
						}
	    				//Subo los arreglos a las variables de sesión
						$_SESSION["arrtransac"] = $arrtransac;
						$_SESSION["arrtransaccod"] = $arrtransaccod;
						$_SESSION["arrtransacherr"] = $arrtransacherr;
												
						$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
						fncmsgerror(grabaEx); 
					} 
				}else 
				{
					$flagnuevotransacherramie = 1;
				}
			}
			else
			{
				fncmsgerror(errorIng);
				$flagnuevotransacherramie = 1;
			}
			fncclose($nuconn); 
		} 
	} 
} 
$transhertotal = $transhercanti * $herramvalor;
$iRegtransacherramie[transhercodigo] = $transhercodigo; 
$iRegtransacherramie[tipmovcodigo] = 2; 
$iRegtransacherramie[herramcodigo] = $herramcodigo; 
$iRegtransacherramie[transherfecha] = $transherfecha; 
$iRegtransacherramie[transhercanti] = $transhercanti; 
$iRegtransacherramie[transhertotal] = $transhertotal; 
$iRegtransacherramie[usuacodi] = $usuacodi; 

$iRegvalidaherramie[tipmovcodigo] = 2; 
$iRegvalidaherramie[transhercanti] = $transhercanti; 
$iRegvalidaherramie[herramcodigo] = $herramcodigo;
$iRegvalidaherramie[herramdispon] = $herramdispon;
grabatransacherramietran($iRegtransacherramie,$iRegvalidaherramie,$flagnuevotransacherramie,$campnomb,$flagsoliot); 

/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : validadisponibilidad
Decripcion      : Valida y actualiza la tabla item
Parametros      : Descripicion 
    $arrherramie         Arreglo de datos. 
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
function validadisponibilidad($arrherramie,$transaccan,$tipomovi,$idcon)
{
	$sbregtipomovi = loadrecordtipomovi($tipomovi,$idcon);
	
	if($sbregtipomovi[tipmovtipo] > 0)
	{
		$sumherramie = $arrherramie[herramdispon] + $transaccan;
		if($sumherramie >= 0)
		{
			$resultSql = updateherramiedispontran($arrherramie[herramcodigo],$sumherramie,$idcon);
			
			return $resultSql;
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
		
		$resherramie = $arrherramie[herramdispon] - $transaccan;
		if($resherramie >= 0)
		{
			$resultSql = updateherramiedispontran($arrherramie[herramcodigo],$resherramie,$idcon);
			return $resultSql;
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
