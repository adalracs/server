<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabaanalisispr
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegproveedo         Arreglo de datos.
$flagnuevoanalisispr    Bandera de validaci�n
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
function grabaanalisispr($iReganalisispr,&$flagnuevoanalisispr,&$campnomb,$flagerror)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",281);
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("compactu",6);
	define("fecvalid",7);
	define("errormail",8);
	define("editaEx",9);
	define("errorNombExs",18);
	define("errorIng",35);
	
	$nuidtemp = fncnumact(id,$nuconn);
	do
	{
		$nuresult = loadrecordanalisispr($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iReganalisispr[analiscodigo] = $nuidtemp;
			$analiscodi=$nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	//$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn);
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	
		
	if($iReganalisispr)
	{
		$iRegtabla["tablnomb"] = "analisispr";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "analisispr")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;

		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		
		while($elementos = each($iReganalisispr))
		{

			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);

			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != 'analiscodigo')
				{

					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{

								$campnomb[$elementos[0]] = 1;
								$flagnuevoanalisispr = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{

				$flagnuevoanalisispr = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			$validresult = consulmetaanalisispr($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
			
				$flagnuevoanalisispr = 1;
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

			$result = insrecordanalisispr($iReganalisispr,$nuconn);
			if($result < 0 )
			{
				fncmsgerror(errorReg);
				$flagnuevoanalisispr=1;
			}

			if($result > 0)
			{
				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
				fncmsgerror(grabaEx);
			}
			fncclose($nuconn);
			return $analiscodi;
		}
			
	}
}

$idcon = fncconn();
$iReganalisispr[analiscodigo] = $analiscodigo;
$iReganalisispr[procedcodigo] = $procedcodigo;
$iReganalisispr[ordoppcodigo] = $ordoppcodigo1;
$iReganalisispr[usuacodi] = $usuacodi;
$iReganalisispr[analisfecha] = date("Y-m-d");
$iReganalisispr[estanacodigo] = $estanacodigo;
$iReganalisispr[analisdescri] = $analisdescri;


if($procedcodigo)
{		
	$rwProcedimiento = loadrecordprocedimiento($procedcodigo,$idcon);
	$ircrecord['tipsolcodigo'] = $rwProcedimiento['tipsolcodigo'];
	$ircrecordop['tipsolcodigo'] = '=';
	$rsVarAnalisis = dinamicscanopvaranalisis($ircrecord,$ircrecordop,$idcon);	
}

if($rsVarAnalisis){
	$nrVarAnalisis = fncnumreg($rsVarAnalisis);
}

if($nrVarAnalisis){		
	for($a = 0; $a < $nrVarAnalisis; $a++){
		$rwVarAnalisis = fncfetch($rsVarAnalisis, $a);
		$varValor = 'txtvalor'.$rwVarAnalisis['varanacodigo'];
		
		
		if( validaint4($$varValor) > 0 || !$$varValor)
		{

			$campnomb[$varValor] = 1;
			$flagnuevoanalisispr = 1;
			$flagerror = 1;
		}
	}
	
}
	
$analiscodigo2=grabaanalisispr($iReganalisispr,$flagnuevoanalisispr,$campnomb,$flagerror);

$nuconn = fncconn();
if($analiscodigo2 && $rsVarAnalisis)
{
	
	if($nrVarAnalisis && $analiscodigo2 ){
		delrecordprvaranalisispp($analiscodigo2,$nuconn);
	}

	for($a = 0; $a < $nrVarAnalisis;$a++)
	{
		$rwVarAnalisis = fncfetch($rsVarAnalisis, $a);
			$nuidtemp = fncnumact(283,$nuconn);
			do
			{
				$nuresult = loadrecordprvaranalisis($nuidtemp,$nuconn);
				if($nuresult == e_empty)
				{
					$iRegprvaranalisis[prvaracodigo] = $nuidtemp;
				}
				$nuidtemp ++;
			}while ($nuresult != e_empty);
					$varValor = 'txtvalor'.$rwVarAnalisis['varanacodigo'];
					$iRegprvaranalisis[analiscodigo] = $analiscodigo2;
					$iRegprvaranalisis[varanacodigo] = $rwVarAnalisis['varanacodigo'];
					$iRegprvaranalisis[usuacodi] = $usuacodi;
					$iRegprvaranalisis[prvaravalor] = $$varValor;
					$iRegprvaranalisis[prvarafecha] = date("Y-m-d");
					$iRegprvaranalisis[prvaradescri] = $prvaranota;
					$result=insrecordprvaranalisis($iRegprvaranalisis,$nuconn);
		
	}

}
fncclose($nuconn);
		

?> 
