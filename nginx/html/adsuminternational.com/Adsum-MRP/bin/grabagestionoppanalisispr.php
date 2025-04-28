<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabaanalisispr
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegproveedo         Arreglo de datos.
$flagnuevogestionoppanalisispr    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/

include ( '../src/FunPerPriNiv/pktblprvaranalisis.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include( '../src/FunGen/fncnombexs.php');
include ( '../def/tipocampo.php');

function grabaanalisispr(&$iReganalisispr,&$flagnuevogestionoppanalisispr,&$campnomb,$flagerror)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",284);
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
								$flagnuevogestionoppanalisispr = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{

				$flagnuevogestionoppanalisispr = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			$validresult = consulmetaanalisispr($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				
				$flagnuevogestionoppanalisispr = 1;
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
				$flagnuevogestionoppanalisispr=1;
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


$iReganalisispr["analiscodigo"] = $analiscodigo;
$iReganalisispr["procedcodigo"] = $procedcodigo;
$iReganalisispr["ordoppcodigo"] = $ordoppcodigo;
$iReganalisispr["usuacodi"] = $usuacodi;
$iReganalisispr["analisfecha"] = date("Y-m-d");
$iReganalisispr["estanacodigo"] = $estanacodigo;
$iReganalisispr["analisdescri"] = $analisdescri;
$iReganalisispr["analisestado"] = 1;//analisis abierto

$idcon = fncconn();

$rsVarAnalisis = dinamicscanopvaranalisis(array("tipsolcodigo" => $tipsolcodigo),array("tipsolcodigo" => "="),$idcon);
$nrVarAnalisis = fncnumreg($rsVarAnalisis);

if($nrVarAnalisis > 0){	

	for($a = 0; $a < $nrVarAnalisis; $a++){

		$rwVarAnalisis = fncfetch($rsVarAnalisis, $a);
		$varValor = 'txtvalor'.$rwVarAnalisis['varanacodigo'];
		
		if( validafloat4($$varValor) > 0 || !$$varValor)
		{
			$campnomb[$varValor] = 1;
			$flagnuevogestionoppanalisispr = 1;
			$flagerror = 1;
		}

		if($rwVarAnalisis["varanatipespe"] == 1){

			//ingresar codigo para validar con porcentaje

		}else if($rwVarAnalisis["varanatipespe"] == 2){//mayor igual

			if( $$varValor < $rwVarAnalisis["varanadetesp"] ){

				$campnombre[$varValor] = 1;
			}
			
		}else if($rwVarAnalisis["varanatipespe"] == 3){//menor igual

			if( $$varValor > $rwVarAnalisis["varanadetesp"] ){

				$campnombre[$varValor] = 1;
			}

		}else if($rwVarAnalisis["varanatipespe"] == 4){//binaria 1/0

			if( $$varValor != 1){
				$campnombre[$varValor] = 1;
			}

			if( $$varValor != 0 || $$varValor != 1){

				$campnomb[$varValor] = 1;
				$flagnuevoanalisismp = 1;
				$flagerror = 1;
			}

		}
		

	}

}else{

	$flagnuevogestionoppanalisispr = 1;
	$flagerror = 1;

}

fncclose($idcon);

grabaanalisispr($iReganalisispr,$flagnuevogestionoppanalisispr,$campnomb,$flagerror);

if(!$flagnuevogestionoppanalisispr)
{
	$idcon = fncconn();

	if($nrVarAnalisis){
		delrecordprvaranalisispp($iReganalisispr["analiscodigo"],$idcon);
	}

	for($a = 0; $a < $nrVarAnalisis;$a++){

		$rwVarAnalisis = fncfetch($rsVarAnalisis, $a);
		$varValor = 'txtvalor'.$rwVarAnalisis['varanacodigo'];

		$nuidtemp = fncnumact(285,$idcon);
		do
		{
			$nuresult = loadrecordprvaranalisis($nuidtemp,$idcon);
			if($nuresult == e_empty){
				$iRegprvaranalisis["prvaracodigo"] = $nuidtemp;
			}
			$nuidtemp ++;
		}while ($nuresult != e_empty);

		$iRegprvaranalisis["analiscodigo"] = $iReganalisispr["analiscodigo"];
		$iRegprvaranalisis["varanacodigo"] = $rwVarAnalisis["varanacodigo"];
		$iRegprvaranalisis["usuacodi"] = $usuacodi;
		$iRegprvaranalisis["prvaravalor"] =  $$varValor;
		$iRegprvaranalisis["prvarafecha"] = date("Y-m-d");

		if( insrecordprvaranalisis($iRegprvaranalisis,$idcon) > 0  ){
			fncnumprox(285,$nuidtemp,$idcon);
		}

	}

	fncclose($idcon);
	echo '<script language="javascript">';
	echo '<!--//'."\n";
	echo 'location ="maestablgestionoppanalisispr.php?codigo='.$codigo.';"';
	echo '//-->'."\n";
	echo '</script>';

}

		
?> 
