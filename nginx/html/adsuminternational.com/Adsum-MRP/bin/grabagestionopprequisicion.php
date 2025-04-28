<?php
/*
 -Todos los derechos reservados-
 Propiedad intelectual de Adsum (c).
 Funcion         : grabarequisicion
 Decripcion      : Valida la data a grabar y la lleva al paquete.
 Parametros      : Descripicion
 $iRegrequisicion         Arreglo de datos.
 $flagnuevorequisicion    Bandera de validaci�n
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

include ( '../src/FunPerPriNiv/pktblrequisicionitemdesa.php');
include ( '../src/FunPerPriNiv/pktblrequisicionopp.php');
include ( '../src/FunPerPriNiv/pktblrequisicion.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunPerPriNiv/pktblop.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../src/FunGen/fncnombexs.php');
include ( '../def/tipocampo.php');

function grabarequisicion(&$iRegrequisicion,&$flagnuevorequisicion,&$campnomb,$arrrequisicionopp)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",263);
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
		$nuresult = loadrecordrequisicion($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegrequisicion["requiscodigo"] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	//	No utilice esta parte si va a utilizar la llave primaria como serial

	if($iRegrequisicion)
	{
		$iRegtabla["tablnomb"] = "requisicion";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla["tablnomb"] == "requisicion")
			{
				$tablcodi=$sbregtabla["tablcodi"];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegrequisicion_b = $iRegrequisicion;

		while($elementos = each($iRegrequisicion))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				//				if($elementos[0] != "requisicioncodigo")
				//				{
				if($sbregcampo["campnomb"] == $elementos[0])
				{
					$respuesta = strcmp($sbregcampo["campnotnull"],"t");
					if($respuesta == 0)
					{
						if($elementos[1] == "")
						{
							$campnomb[$elementos[0]] = 1;
							$flagnuevorequisicion = 1;
							$flagerror = 1;
						}
					}
				}
				//				}
			}
				
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevorequisicion = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;

			}

				
			$validresult = consulmetarequisicion($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevorequisicion = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
				
			unset ($validresult);
		}

		if(!$arrrequisicionopp)
		{
			$flagnuevorequisicion = 1;
			$flagerror = 1;
			$campnomb['arrrequisicionopp'] = 1;
		}

		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}

		if($flagerror != 1)
		{
			$result = insrecordrequisicion($iRegrequisicion,$nuconn);
				
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevorequisicion=1;
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

$iRegrequisicion["requisfecha"] = date('Y-m-d');
$iRegrequisicion["usuacodi"] = $usuacodi;
$iRegrequisicion["requisnumero"] = $requisnumero;
$iRegrequisicion["requisdescri"] = $requisdescri;
$iRegrequisicion["estreqcodigo"] = 1;//estado abierta


if($arrItemdesaRQ) $arrObjItemdesaRQ = explode(":|:",$arrItemdesaRQ); else unset($arrObjItemdesaRQ);

for( $a = 0; $a <count($arrObjItemdesaRQ); $a++){
	$rowItemdesaRQ = explode(":-:",$arrObjItemdesaRQ[$a]);

	if(validafloat4($rowItemdesaRQ[0]) > 0 || (!$rowItemdesaRQ[0]) )
	{

		$flagnuevorequisicion = 1;	
	 	$flagerror = 1;
	 	$campnomb["reqitecantrq_"] = 1;
	}

	if(validafloat4($rowItemdesaRQ[1]) > 0 || (!$rowItemdesaRQ[1]) )
	{

		$flagnuevorequisicion = 1;	
	 	$flagerror = 1;
	 	$campnomb["reqitecantrq_"] = 1;
	}

}

if($arrItemdesaResinasRQ) $arrObjItemdesaResinasRQ = explode(":|:",$arrItemdesaResinasRQ); else unset($arrObjItemdesaResinasRQ);

for( $a = 0; $a <count($arrObjItemdesaResinasRQ); $a++){
	$rowItemdesaResinasRQ = explode(":-:",$arrObjItemdesaResinasRQ[$a]);

	if(validafloat4($rowItemdesaResinasRQ[0]) > 0 || (!$rowItemdesaResinasRQ[0]) )
	{

		$flagnuevorequisicion = 1;	
	 	$flagerror = 1;
	 	$campnomb["reqitecantrq_"] = 1;
	}

	if(validafloat4($rowItemdesaResinasRQ[1]) > 0 || (!$rowItemdesaResinasRQ[1]) )
	{

		$flagnuevorequisicion = 1;	
	 	$flagerror = 1;
	 	$campnomb["reqitecantrq_"] = 1;
	}

}


grabarequisicion($iRegrequisicion,$flagnuevorequisicion,$campnomb,$arrrequisicionopp);

if(!$flagnuevorequisicion){

	$idcon = fncconn();
	define("id_gessoppcodigo",234);
	define("id_reqitecodigo",291);

	if($arrrequisicionopp) $arrObjrequisicion = explode(',',$arrrequisicionopp); else unset($arrObjrequisicion);

	for( $a = 0; $a < count($arrObjrequisicion); $a++){

		//se registra los ordenes implicadas en la requisicion
		$iRegrequisicionopp["requiscodigo"] = $iRegrequisicion["requiscodigo"];
		$iRegrequisicionopp["ordoppcodigo"] = $arrObjrequisicion[$a];

		insrecordrequisicionopp($iRegrequisicionopp,$idcon);

		//se registra la gestion a las ordenes 
		$nuidtemp = fncnumact(id_gessoppcodigo,$idcon);
		do{	
			$nuresult = loadrecordgestionopp($nuidtemp,$idcon);
			if($nuresult == e_empty){
				$iReggestionopp["gesoppcodigo"] = $nuidtemp;
			}
			$nuidtemp ++;
		}while ($nuresult != e_empty);
		
		$iReggestionopp["ordoppcodigo"] = $arrObjrequisicion[$a];
		$iReggestionopp["opestacodigo"] = 4;//estado en requisicion
		$iReggestionopp["gesoppfecha"] = date('Y-m-d');
		$rwhora = getdate(time());
		$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
		$iReggestionopp["gesopphora"] = $hora;
		$iReggestionopp["usuacodi"] = $usuacodi;
		$iReggestionopp["gesoppdescri"] = $requisdescri;
		$iReggestionopp["gesopptipo"] = 3;//gestion de requisicion

		if( insrecordgestionopp($iReggestionopp,$idcon)  > 0){
			$iRegop_opp["opestacodigo"] = 4;//estado en requisicion
    		$iRegop_opp["ordoppcodigo"] = $arrObjrequisicion[$a];
    		uprecordop_estado($iRegop_opp,$idcon);
    		fncnumprox(id_gessoppcodigo,$nuidtemp,$idcon); 
		}    	
		unset($nuidtemp,$nuresult);

	}	


	if($arrItemdesaRQ) $arrObjItemdesaRQ = explode(':|:',$arrItemdesaRQ); else unset($arrObjItemdesaRQ);

	for( $a = 0; $a < count($arrObjItemdesaRQ); $a++){

		$rowItemdesaRQ = explode(":-:",$arrObjItemdesaRQ[$a]);

		//se regista el listado de materiales requeridos
		$nuidtemp = fncnumact(id_reqitecodigo,$idcon);
		do{	
			$nuresult = loadrecordrequisicionitemdesa($nuidtemp,$idcon);
			if($nuresult == e_empty){
				$iRegrequisicionitemdesa["reqitecodigo"] = $nuidtemp;
			}
			$nuidtemp ++;
		}while ($nuresult != e_empty);

		$iRegrequisicionitemdesa["requiscodigo"] = $iRegrequisicion["requiscodigo"];
		$iRegrequisicionitemdesa["itedescodigo"] = $rowItemdesaRQ[0];//itedescodigo
		$iRegrequisicionitemdesa["reqitefecini"] = date('Y-m-d');
		$rwhora = getdate(time());
		$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
		$iRegrequisicionitemdesa["reqitehorini"] = $hora;
		$iRegrequisicionitemdesa["reqitecantrq"] = $rowItemdesaRQ[1];//reqitecantrq

		if( insrecordrequisicionitemdesa($iRegrequisicionitemdesa,$idcon)  > 0){
    		fncnumprox(id_reqitecodigo,$nuidtemp,$idcon); 
		}    	
		unset($nuidtemp,$nuresult);

	}

	if($arrItemdesaResinasRQ) $arrObjItemdesaResinasRQ = explode(":|:",$arrItemdesaResinasRQ); else unset($arrObjItemdesaResinasRQ);

	for( $a = 0; $a <count($arrObjItemdesaResinasRQ); $a++){
		$rowItemdesaResinasRQ = explode(":-:",$arrObjItemdesaResinasRQ[$a]);

		//se regista el listado de materiales requeridos
		$nuidtemp = fncnumact(id_reqitecodigo,$idcon);
		do{	
			$nuresult = loadrecordrequisicionitemdesa($nuidtemp,$idcon);
			if($nuresult == e_empty){
				$iRegrequisicionitemdesa["reqitecodigo"] = $nuidtemp;
			}
			$nuidtemp ++;
		}while ($nuresult != e_empty);

		$iRegrequisicionitemdesa["requiscodigo"] = $iRegrequisicion["requiscodigo"];
		$iRegrequisicionitemdesa["itedescodigo"] = $rowItemdesaResinasRQ[0];//itedescodigo
		$iRegrequisicionitemdesa["reqitefecini"] = date('Y-m-d');
		$rwhora = getdate(time());
		$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
		$iRegrequisicionitemdesa["reqitehorini"] = $hora;
		$iRegrequisicionitemdesa["reqitecantrq"] = $rowItemdesaResinasRQ[1];//reqitecantrq

		if( insrecordrequisicionitemdesa($iRegrequisicionitemdesa,$idcon)  > 0){
    		fncnumprox(id_reqitecodigo,$nuidtemp,$idcon); 
		}    	
		unset($nuidtemp,$nuresult);


	}

 	fncclose($idcon);

 	echo '<script language="javascript">';
	echo '<!--//'."\n";
	echo 'location ="maestablgestionopprequisicion.php?codigo='.$codigo.';"';
	echo '//-->'."\n";
	echo '</script>';
	//header( "location:maestablgestionopprequisicion.php?codigo=" .$codigo) ;
}
?>
