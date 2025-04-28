<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabagestionartepr
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iReggestionartepr         Arreglo de datos.
$flagnuevogestionartepr    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/
ini_set('diaplay_errors',1);
include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../def/tipocampo.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombexs.php');

function grabagestionartepr(&$iReggestionartepr,&$flagnuevogestionartepr,&$campnomb,$flagerror)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",245);
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("compactu",6);
	define("fecvalid",7);
	define("errormail",8);
	define("editaEx",9);
	define("errorIng",35);
	
	$nuidtemp = fncnumact(id,$nuconn);
	do
	{
		$nuresult = loadrecordgestionartepr($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iReggestionartepr[gesartcodigo] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);

	//	No utilice esta parte si va a utilizar la llave primaria como serial

	if($iReggestionartepr)
	{
		$iRegtabla["tablnomb"] = "gestionartepr";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "gestionartepr")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iReggestionartepr_b = $iReggestionartepr;

		while($elementos = each($iReggestionartepr))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($sbregcampo["campnomb"] == $elementos[0])
				{
					$respuesta = strcmp($sbregcampo["campnotnull"],"t");
					if($respuesta == 0)
					{
						if($elementos[1] == "")
						{
							$campnomb[$elementos[0]] = 1;
							$flagnuevogestionartepr = 1;
							$flagerror = 1;
						}
					}
				}
			}
			
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevogestionartepr = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;

			}
		
			
			$validresult = consulmetagestionartepr($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevogestionartepr = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			
			if($elementos[0]=='gesartcodigo' && $elementos[1] && $validresult == 0)
			{
				$valcodi = loadrecordgestionartepr($iReggestionartepr[gesartcodigo], $nuconn);
		
				if($valcodi > -3)
				{
					$flagnuevogestionartepr = 1;
					$flagerror = 1;
					$campnomb[gesartcodigo] = 1;
					$campnomb[err] = 'Codigo existente o invalido';
					unset ($valcodi);
				}
			}
			unset ($validresult);
			
		}
		

		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}

		if($flagerror != 1)
		{
			$result = insrecordgestionartepr($iReggestionartepr,$nuconn);
			
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevogestionartepr=1;
			}
			if($result > 0)
			{
				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //    		
    			fncmsgerror(grabaEx);
			}
			fncclose($nuconn);
		}
	}
}

$iReggestionartepr[ordoppcodigo] = $ordoppcodigo;
$iReggestionartepr[gesartfecha] = date('Y-m-d');
$rwhora = getdate(time());
$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
$iReggestionartepr[gesarthora] = $hora;
$iReggestionartepr[usuacodi] = $usuacodi;
$iReggestionartepr[gesartfpista] = $gesartfpista;
$iReggestionartepr[gesartdescri] = $gesartdescri;//gestion

if($arrdispensing) $arrObjdispensing = explode(':|:',$arrdispensing);
for( $a = 0; $a < count($arrObjdispensing); $a++)
{
	$rowObjdispensing = explode(':-:',$arrObjdispensing[$a]);
	$objCintasug = 'cintasug_'.$rowObjdispensing[1];
	if(!$$objCintasug)
	{
	 	$flagnuevoreporteopp = 1;	
	 	$flagerror = 1;
	 	$campnomb[$objCintasug] = 1;
	}
}

grabagestionartepr($iReggestionartepr,$flagnuevogestionartepr,$campnomb,$flagerror);

if(!$flagnuevogestionartepr)
{
	$idcon = fncconn();
	
	if($arrdispensing) $arrObjdispensing = explode(':|:',$arrdispensing);
	for( $a = 0; $a < count($arrObjdispensing); $a++)
	{
		$rowObjdispensing = explode(':-:',$arrObjdispensing[$a]);
		$objCintasug = 'cintasug_'.$rowObjdispensing[1];
		$iReggestionarteprformula[gesartcodigo] = $iReggestionartepr[gesartcodigo];
		$iReggestionarteprformula[formulcodigo] = $rowObjdispensing[1];
		$iReggestionarteprformula[gearfoscinta] = $$objCintasug;
		insrecordgestionarteprformula($iReggestionarteprformula,$idcon);
	}	
 	fncclose($idcon);
 	echo '<script language="javascript">';
	echo '<!--//'."\n";
	echo 'location ="maestablgestionartepr.php?codigo='.$codigo.';"';
	echo '//-->'."\n";
	echo '</script>';
}

?> 