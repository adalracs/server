<?php 
/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : grabaplano 
Decripcion      : Valida la data a grabar y la lleva al paquete. 
Parametros      : Descripicion 
    $iRegplano         Arreglo de datos. 
    $flagnuevoplano    Bandera de validaci�n 
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
include ( '../src/FunPerPriNiv/pktblplano.php'); 
include ( '../src/FunGen/buscacaracter.php'); 
//include ( '../src/FunGen/fncmsgerror.php'); 
include( '../src/FunGen/fncsubirplano.php'); 
function grabaplano($iRegplano,&$flagnuevoplano,&$campnomb,$inombarc,$itipoarc,$tamaarc,$irutaarc,$itemparc) 
{ 
	$nuconn = fncconn(); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
	define("id",30); 
	define("errorReg",1); 
	define("errorCar",2); 
	define("grabaEx",3); 
	define("compinst",4); 
	define("venccomp",5); 
	define("compactu",6); 
	define("fecvalid",7); 
	define("errormail",8); 
	define("editaEx",9); 
	$nuidtemp = fncnumact(	id,$nuconn); 
	do 
	{ 
		$nuresult = loadrecordplano($nuidtemp,$nuconn); 
		if($nuresult == e_empty) 
		{ 
			$iRegplano[planocodigo] = $nuidtemp; 
		} 
		$nuidtemp ++; 
	}while ($nuresult != e_empty); 
	//$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
	if ($iRegplano) 
	{ 
		while($elementos = each($iRegplano)) 
		{ 
			$validar = buscacaracter($elementos[1]); 
			if($validar == 1) 
			{ 
				fncmsgerror(errorCar); 
				$flagnuevoplano = 1; 
				$flagerror = 1; 
				$campnomb = $elementos[0];
				break; 
			} 
		$validresult = consulmetaplano($elementos[0],$elementos[1],$nuconn); 
		if ($validresult == 1) 
		{ 
			$flagnuevoplano = 1; 
			$flagerror = 1; 
			$campnomb = $elementos[0];
			unset ($validresult); 
			break; 
		} 
	} 
	if (!$campnomb) 
		fncsubirplano($inombarc,$itipoarc,$tamaarc,$irutaarc,$itemparc,$flagerror,$flagnuevoplano);
	if($flagerror != 1) 
	{ 
			$result = insrecordplano($iRegplano,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$campnomb = $elementos[0];
				$flagnuevoplano=1; 
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
//datos del archivo
$inombarc = $HTTP_POST_FILES['file']['name'];
$itipoarc = $HTTP_POST_FILES['file']['type'];
$tamaarc = $HTTP_POST_FILES['file']['size'];
$irutaarc = "../img/planos/";
$itemparc = $HTTP_POST_FILES['file']['tmp_name'];
$planoruta = $irutaarc.$inombarc;

$iRegplano[planocodigo] = $planocodigo; 
$iRegplano[planonombre] = $planonombre; 
$iRegplano[planoruta] = $planoruta; 
$iRegplano[planodescri] = $planodescri; 

grabaplano($iRegplano,$flagnuevoplano,$campnomb,$inombarc,$itipoarc,$tamaarc,$irutaarc,$itemparc); 
?> 
