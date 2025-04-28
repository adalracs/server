<?php 
/* 
<!-- Propiedad intelectual de Adsum SAS (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andrés A. Riascos D. 
Fecha: 20120110 
GenVers: 4.8 --> 
Funcion         : grabasaloncapaci 
Decripcion      : Valida la data a grabar y la lleva al paquete. 
Parametros      : Descripicion 
    $iRegsaloncapaci         Arreglo de datos. 
    $flagnuevosaloncapaci    Bandera de validación 
Retorno         : 
		true	= 1 
		false	= 0 
Autor           : ariascos 
Escrito con     : WAG 
Historial de modificaciones 
| Fecha | Motivo				| Autor 	| 
*/ 
  
include ( '../src/FunGen/fncnumprox.php'); 
include ( '../src/FunGen/fncnumact.php'); 
include ( '../def/tipocampo.php'); 
include ( '../src/FunPerPriNiv/pktblsaloncapaci.php'); 
include ( '../src/FunGen/buscacaracter.php'); 
include ( '../src/FunGen/fncmsgerror.php'); 
 
function grabasaloncapaci($iRegsaloncapaci,&$flagnuevosaloncapaci,&$campnomb) 
{ 
	$nuconn = fncconn(); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
	define("id",103); 
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
		$nuresult = loadrecordsaloncapaci($nuidtemp,$nuconn); 
		if($nuresult == e_empty) 
		{ 
			$iRegsaloncapaci[salcapcodigo] = $nuidtemp; 
		} 
		$nuidtemp ++; 
	}while ($nuresult != e_empty); 
	$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
	if ($iRegsaloncapaci) 
	{ 
		while($elementos = each($iRegsaloncapaci)) 
	{ 
			$validar = buscacaracter($elementos[1]); 
			if($validar == 1) 
			{ 
				fncmsgerror(errorCar); 
				$flagnuevosaloncapaci = 1; 
				$flagerror = 1; 
				$campnomb = $elementos[0]; 
				break; 
			} 
			$validresult = consulmetasaloncapaci($elementos[0],$elementos[1],$nuconn); 
			if ($validresult == 1) 
			{ 
				$flagnuevosaloncapaci = 1; 
				$flagerror = 1; 
				$campnomb = $elementos[0]; 
				unset ($validresult); 
				break; 
			} 
		} 
		if($flagerror != 1) 
		{ 
			$result = insrecordsaloncapaci($iRegsaloncapaci,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flagnuevosaloncapaci=1; 
			} 
			if($result > 0) 
			{ 
				fncmsgerror(grabaEx); 
			} 
			fncclose($nuconn); 
		} 
	} 
} 
$iRegsaloncapaci[salcapcodigo] = $salcapcodigo; 
$iRegsaloncapaci[salcapnombre] = $salcapnombre; 
$iRegsaloncapaci[ubicapcodigo] = $ubicapcodigo; 
$iRegsaloncapaci[salcapdescri] = $salcapdescri; 
grabasaloncapaci($iRegsaloncapaci,$flagnuevosaloncapaci,$campnomb); 
?> 
