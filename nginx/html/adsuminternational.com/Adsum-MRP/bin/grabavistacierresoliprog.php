<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabacierresoliprog
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegcierresoliprog         Arreglo de datos.
$flagnuevocierresoliprog    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/

include_once ( '../src/FunGen/fncnumprox.php');
include_once ( '../src/FunGen/fncnumact.php');
include_once ( '../src/FunPerPriNiv/pktblsoliprog.php');
include_once ( '../src/FunPerPriNiv/pktblcierresoliprog.php');
include_once ( '../def/tipocampo.php');
include_once ( '../src/FunPerPriNiv/pktblcampo.php');
include_once ( '../src/FunPerPriNiv/pktbltabla.php');
include_once ( '../src/FunGen/buscacaracter.php');
include_once ( '../src/FunGen/fncmsgerror.php');
include_once( '../src/FunGen/fncnombexs.php');

function grabacierresoliprog(&$iRegcierresoliprog,&$flagnuevocierresoliprog,&$campnomb,$opestacodigo,$flagerror)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",264);
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
		$nuresult = loadrecordcierresoliprog($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegcierresoliprog["ciesolcodigo"] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);

	//	No utilice esta parte si va a utilizar la llave primaria como serial

	if($iRegcierresoliprog)
	{
		$iRegtabla["tablnomb"] = "cierresoliprog";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla["tablnomb"] == "cierresoliprog")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegcierresoliprog_b = $iRegcierresoliprog;

		while($elementos = each($iRegcierresoliprog))
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
							$flagnuevocierresoliprog = 1;
							$flagerror = 1;
						}
					}
				}
			}
			
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevocierresoliprog = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;

			}
		
			
			$validresult = consulmetacierresoliprog($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevocierresoliprog = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			
			unset ($validresult);
		}
        
		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}

		if($flagerror != 1)
		{
			$result = insrecordcierresoliprog($iRegcierresoliprog,$nuconn);
			
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevocierresoliprog=1;
			}
			if($result > 0)
			{
				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
    			$iRegsoliprog["solprocodigo"] = $iRegcierresoliprog["solprocodigo"];
    			$iRegsoliprog["estsolcodigo"] = 4;//finalizada
    			uprecordsoliprogestadosoliprog1($iRegsoliprog,$nuconn);
    			$iRegOp['opestacodigo'] = $opestacodigo;
    			$iRegOp['solprocodigo'] = $iRegcierresoliprog["solprocodigo"];
    			uprecordop_estado1($iRegOp,$nuconn);
    			fncmsgerror(grabaEx);
    			echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestablvistacierresoliprog.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
			}
			fncclose($nuconn);
		}
	}
}

$iRegcierresoliprog["ciesolcodigo"] = $ciesolcodigo;
$iRegcierresoliprog["solprocodigo"] = $solprocodigo;
$iRegcierresoliprog["tipcumcodigo"] = $tipcumcodigo;
$iRegcierresoliprog["ciesolfecha"] = date('Y-m-d');
$rwhora = getdate(time());
$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
$iRegcierresoliprog["ciesolhora"] = $hora;
$iRegcierresoliprog["usuacodi"] = $usuacodi;
$iRegcierresoliprog["ciesoldescri"] = $ciesoldescri;
$iRegcierresoliprog["ciesoltipo"] = 1;//gestion

if($opestacodigo <= 0)
{
	$campnomb['opestacodigo'] = 1;
	$flagnuevocierresoliprog=1;
	$flagerror =1;
}

grabacierresoliprog($iRegcierresoliprog,$flagnuevocierresoliprog,$campnomb,$opestacodigo,$flagerror);

?>