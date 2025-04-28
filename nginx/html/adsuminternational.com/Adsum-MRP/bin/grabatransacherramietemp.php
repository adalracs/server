<?php 
/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : grabatransacherramietemp 
Decripcion      : Valida la data a grabar y la lleva al paquete. 
Parametros      : Descripicion 
    $iRegtransacherramietemp         Arreglo de datos. 
    $flagnuevotransacherramietemp    Bandera de validación 
Retorno         : 
		true	= 1 
		false	= 0 
Autor           : ariascos 
Escrito con     : WAG Adsum versión 3.1.1 
Fecha           : 18082004 
Historial de modificaciones 
| Fecha | Motivo				| Autor 	| 
*/ 
  
include ( '../src/FunGen/fncnumprox.php'); 
include ( '../src/FunGen/fncnumact.php'); 
include ( '../def/tipocampo.php'); 
include ( '../src/FunPerPriNiv/pktbltransacherramietemp.php'); 
include ( '../src/FunGen/buscacaracter.php'); 
include ( '../src/FunGen/fncmsgerror.php'); 
 
function 
 
 
 
 
 
 
 
 
 
 
 
 
 
erramietemp($iRegtransacherramietemp,&$flagnuevotransacherramietemp,&$campnomb) 
{ 
	$nuconn = fncconn(); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
	define("id",1); 
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
		$nuresult = loadrecordtransacherramietemp($nuidtemp,$nuconn); 
		if($nuresult == e_empty) 
		{ 
			$iRegtransacherramietemp[trahetemcodigo] = $nuidtemp; 
		} 
		$nuidtemp ++; 
	}while ($nuresult != e_empty); 
	$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
	if ($iRegtransacherramietemp) 
	{ 
		while($elementos = each($iRegtransacherramietemp)) 
	{ 
			$validar = buscacaracter($elementos[1]); 
			if($validar == 1) 
			{ 
				fncmsgerror(errorCar); 
				$flagnuevotransacherramietemp = 1; 
				$flagerror = 1; 
				$campnomb = $elementos[0]; 
				break; 
			} 
			$validresult = 
consulmetatransacherramietemp($elementos[0],$elementos[1],$nuconn); 
			if ($validresult == 1) 
			{ 
				$flagnuevotransacherramietemp = 1; 
				$flagerror = 1; 
				$campnomb = $elementos[0]; 
				unset ($validresult); 
				break; 
			} 
		} 
		if($flagerror != 1) 
		{ 
			$result = insrecordtransacherramietemp($iRegtransacherramietemp,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flagnuevotransacherramietemp=1; 
			} 
			if($result > 0) 
			{ 
				fncmsgerror(grabaEx); 
			} 
			fncclose($nuconn); 
		} 
	} 
} 
$iRegtransacherramietemp[trahetemcodigo] = $trahetemcodigo; 
$iRegtransacherramietemp[tipmovcodigo] = $tipmovcodigo; 
$iRegtransacherramietemp[herramcodigo] = $herramcodigo; 
$iRegtransacherramietemp[trahetemfecha] = $trahetemfecha; 
$iRegtransacherramietemp[trahetemcanti] = $trahetemcanti; 
$iRegtransacherramietemp[trahetemtotal] = $trahetemtotal; 
$iRegtransacherramietemp[usuacodi] = $usuacodi; 
 
 
 
 
 
 
 
 
 
 
 
 
herramietemp($iRegtransacherramietemp,$flagnuevotransacherramietemp,$campnomb); 
?> 
