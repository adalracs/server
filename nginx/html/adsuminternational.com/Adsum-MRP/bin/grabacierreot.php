<?php 
/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : grabacierreot 
Decripcion      : Valida la data a grabar y la lleva al paquete. 
Parametros      : Descripicion 
    $iRegcierreot         Arreglo de datos. 
    $flagnuevocierreot    Bandera de validaci�n 
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
include ( '../src/FunPerPriNiv/pktblcierreot.php'); 
include ( '../src/FunPerPriNiv/pktblcampo.php'); 
include ( '../src/FunPerPriNiv/pktbltabla.php'); 
include ( '../src/FunGen/buscacaracter.php'); 
include ( '../src/FunGen/fncmsgerror.php'); 
 
function grabacierreot($iRegcierreot,&$flagnuevocierreot,&$campnomb, &$cierotcodigo) 
{ 
	$nuconn = fncconn(); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
	define("id",58); 
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
	 
	$nuidtemp = fncnumact(	id,$nuconn); 

	do 
	{ 
		$nuresult = loadrecordcierreot($nuidtemp,$nuconn); 
		if($nuresult == e_empty) 
		{ 
			$iRegcierreot[cierotcodigo] = $nuidtemp; 
			$cierotcodigo = $nuidtemp;
		} 
		$nuidtemp ++; 
	}while ($nuresult != e_empty); 


	$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 

	if($iRegcierreot)
	{


		$iRegtabla["tablnomb"] = "cierreot";
		
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);

		
		
		$num = fncnumreg($resulttabla);

		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "cierreot")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		
		while($elementos = each($iRegcierreot))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);

			
			$num = fncnumreg($resultcampo);
			
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "cierotcodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flagnuevocierreot = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevocierreot = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			$validresult = consulmetacierreot($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevocierreot = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
			if($elementos[0] == "reportcodigo" && $elementos[1] == null)
			{
				$flagnuevocierreot = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			
			if($elementos[0] == "tipcumcodigo" && $elementos[1] == null)
			{
				$flagnuevocierreot = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			
			if($elementos[0] == "cierotdescri" && $elementos[1] == null)
			{
				$flagnuevocierreot = 1;
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
			$result = insrecordcierreot($iRegcierreot,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flagnuevocierreot=1; 
			} 
			if($result > 0) 
			{ 
				fncmsgerror(grabaEx); 
			} 
			fncclose($nuconn); 
		} 
	} 
} 

$iRegcierreot[cierotcodigo] = $cierotcodigo; 
$iRegcierreot[usuacodi] = $usuacodi; 
$iRegcierreot[tipcumcodigo] = $tipcumcodigo; 
$iRegcierreot[reportcodigo] = $reportcodigo; 
$iRegcierreot[cierotfecfin] = $cierotfecfin; 
$iRegcierreot[cierothorfin] = $cierothorfin; 
$iRegcierreot[cierotdescri] = $cierotdescri;


grabacierreot($iRegcierreot,$flagnuevocierreot,$campnomb, $cierotcodigo);

//si el registro de reportot fue grabado con exito
if(!$flagnuevocierreot)
{
	//Cambio de estado a reportada en tareot
	include_once ('../src/FunPerPriNiv/pktblotestado.php');
	include_once ('../src/FunPerPriNiv/pktblreportot.php');
	include_once ('../src/FunGen/cargainput.php');
	
	$flagreportot = true;
	$idcon = fncconn();
	$rs_report = loadrecordreportot($reportcodigo, $idcon);
	$sbregot['ordtracodigo'] = $rs_report['ordtracodigo'];
	$ordtracodigo = $rs_report['ordtracodigo'];
	$otestacodigo = cargaotestadotipo(4, $idcon);
	$tareotnota = $cierotdescri.' - [Orden Cerrada]';
	
	include ('grabatareot.php');
	
		//		 Correos
	include '../src/FunPHPMailer/mail.send.php';
	include_once '../src/FunPerPriNiv/pktblot.php';
	include_once '../src/FunPerPriNiv/pktblsoliserv.php';
	include_once '../src/FunPerPriNiv/pktblusuario.php';
			
	$idcon = fncconn();
	$mails = array();
	
	$rsOt = loadrecordot($ordtracodigo, $idcon);
	if($rsOt['solsercodigo'])
	{ 
		$rsSoliserv = loadrecordsoliserv($rsOt['solsercodigo'], $idcon);
		$rsUsuario = loadrecordusuario($rsSoliserv['usuacodi'], $idcon);
		if($rsUsuario['usuaemail']) $mails[] = $rsUsuario['usuaemail'];
	}
	
	$rsUsuario = loadrecordusuario($rsOt['usuacodi'], $idcon);
	if($rsUsuario['usuaemail']) $mails[] = $rsUsuario['usuaemail'];

	$data = array('cierotcodigo' => $cierotcodigo, 'usuacodi' => $usuacodi, 'cierotdescri' => $cierotdescri);
	
	send_mail('reportot', $data, $mails);
	//Correos
}
?>