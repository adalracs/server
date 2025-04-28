<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabagestionmontaje
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iReggestionmontaje         Arreglo de datos.
$flagnuevogestionmontaje    Bandera de validaci�n
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
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombexs.php');

function grabagestionmontaje(&$iReggestionmontaje,&$flagnuevogestionmontaje,&$campnomb,$flagerror)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",246);
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
		$nuresult = loadrecordgestionmontaje($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iReggestionmontaje[gesmoncodigo] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);

	//	No utilice esta parte si va a utilizar la llave primaria como serial

	if($iReggestionmontaje)
	{
		$iRegtabla["tablnomb"] = "gestionmontaje";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "gestionmontaje")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iReggestionmontaje_b = $iReggestionmontaje;

		while($elementos = each($iReggestionmontaje))
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
							$flagnuevogestionmontaje = 1;
							$flagerror = 1;
						}
					}
				}
			}
			
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevogestionmontaje = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;

			}
		
			
			$validresult = consulmetagestionmontaje($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevogestionmontaje = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			
			if($elementos[0]=='gesmoncodigo' && $elementos[1] && $validresult == 0)
			{
				$valcodi = loadrecordgestionmontaje($iReggestionmontaje[gesmoncodigo], $nuconn);
		
				if($valcodi > -3)
				{
					$flagnuevogestionmontaje = 1;
					$flagerror = 1;
					$campnomb[gesmoncodigo] = 1;
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
			$result = insrecordgestionmontaje($iReggestionmontaje,$nuconn);
			
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevogestionmontaje=1;
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

$iReggestionmontaje[ordoppcodigo] = $ordoppcodigo;
$iReggestionmontaje[gesmonfecha] = date('Y-m-d');
$rwhora = getdate(time());
$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
$iReggestionmontaje[gesmonhora] = $hora;
$iReggestionmontaje[usuacodi] = $usuacodi;
$iReggestionmontaje[gesmondescri] = $gesmondescri;//gestion

if($arrdispensing) $arrObjdispensing = explode(':|:',$arrdispensing);
for( $a = 0; $a < count($arrObjdispensing); $a++)
{
	$rowObjdispensing = explode(':-:',$arrObjdispensing[$a]);
	$objCintaimp = 'cintaimp_'.$rowObjdispensing[1];
	if(!$$objCintaimp)
	{
	 	$flagnuevogestionmontaje = 1;	
	 	$flagerror = 1;
	 	$campnomb[$objCintaimp] = 1;
	}
}

grabagestionmontaje($iReggestionmontaje,$flagnuevogestionmontaje,$campnomb,$flagerror);

if(!$flagnuevogestionmontaje)
{
	$idcon = fncconn();
	
	if($arrdispensing) $arrObjdispensing = explode(':|:',$arrdispensing);
	for( $a = 0; $a < count($arrObjdispensing); $a++)
	{
		$rowObjdispensing = explode(':-:',$arrObjdispensing[$a]);
		$objCintaimp = 'cintaimp_'.$rowObjdispensing[1];
		$objNovedades = 'novedades_'.$rowObjdispensing[1];
		$iReggestionmontajeformula[gesmoncodigo] = $iReggestionmontaje[gesmoncodigo];
		$iReggestionmontajeformula[formulcodigo] = $rowObjdispensing[1];
		$iReggestionmontajeformula[gemofoicinta] = $$objCintaimp;
		$iReggestionmontajeformula[gemofodescri] = $$objNovedades;
		insrecordgestionmontajeformula($iReggestionmontajeformula,$idcon);
	}	
 	fncclose($idcon);
 	echo '<script language="javascript">';
	echo '<!--//'."\n";
	echo 'location ="maestablgestionmontaje.php?codigo='.$codigo.';"';
	echo '//-->'."\n";
	echo '</script>';
}

?> 