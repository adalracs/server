<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabareportelampn
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegreportelampn         Arreglo de datos.
$flagnuevoreportelampn    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/

ini_set('display_errors',1);

include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../def/tipocampo.php');
include ( '../src/FunPerPriNiv/pktblreportelampn.php');
include ( '../src/FunPerPriNiv/pktblcpeqpndetope.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombexs.php');

function grabareportelampn(&$iRegreportelampn,&$flagnuevoreportelampn,&$campnomb,$flagerror)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",248);
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
		$nuresult = loadrecordreportelampn($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegreportelampn[relapncodigo] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);

	//	No utilice esta parte si va a utilizar la llave primaria como serial

	if($iRegreportelampn)
	{
		$iRegtabla["tablnomb"] = "reportelampn";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "reportelampn")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegreportelampn_b = $iRegreportelampn;

		while($elementos = each($iRegreportelampn))
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
								$flagnuevoreportelampn = 1;
								$flagerror = 1;
							}
						}
					}
			}
			
			$validar = buscacaracter($elementos[1]);
			

			if($validar == 1)
			{
				$flagnuevoreportelampn = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;

			}
		
			
			$validresult = consulmetareportelampn($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevoreportelampn = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}

		}

		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}

		if($flagerror != 1)
		{
			$result = insrecordreportelampn($iRegreportelampn,$nuconn);
			
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevoreportelampn=1;
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

$iRegreportelampn[patestcodigo] = $patestcodigo;
$iRegreportelampn[equipocodigo] = $equipocodigo;
$iRegreportelampn[usuacodi] = $usuacodi;
$iRegreportelampn[relapnfecha] = date('Y-m-d');
$rwhora = getdate(time());
$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
$iRegreportelampn[relapnhora] = $hora;
$iRegreportelampn[relapndescri] = $relapndescri;
//validacion de campos personalizados
include 'validacamperequipopn.php';
grabareportelampn($iRegreportelampn,$flagnuevoreportelampn,$campnomb,$flagerror);

if(!$flagnuevoreportelampn)
{
	include 'grabacamperequipopn.php';
	echo '<script language="javascript">';
	echo '<!--//'."\n";
	echo 'location ="maestablreportelampn.php?codigo='.$codigo.';"';
	echo '//-->'."\n";
	echo '</script>';
}
?> 
