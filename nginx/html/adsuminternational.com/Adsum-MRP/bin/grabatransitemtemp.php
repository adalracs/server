<?php 
/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : grabatransitemtemp 
Decripcion      : Valida la data a grabar y la lleva al paquete. 
Parametros      : Descripicion 
    $iRegtransitemtemp         Arreglo de datos. 
    $flagnuevotransitemtemp    Bandera de validación 
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
include ( '../src/FunPerPriNiv/pktbltransitemtemp.php'); 
include ( '../src/FunGen/buscacaracter.php'); 
include ( '../src/FunGen/fncmsgerror.php'); 
 
function 
grabatransitemtemp($iRegtransitemtemp,&$flagnuevotransitemtemp,&$campnomb) 
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
		$nuresult = loadrecordtransitemtemp($nuidtemp,$nuconn); 
		if($nuresult == e_empty) 
		{ 
			$iRegtransitemtemp[traitempcodigo] = $nuidtemp; 
		} 
		$nuidtemp ++; 
	}while ($nuresult != e_empty); 
	$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
	if ($iRegtransitemtemp) 
	{ 
		while($elementos = each($iRegtransitemtemp)) 
	{ 
			$validar = buscacaracter($elementos[1]); 
			if($validar == 1) 
			{ 
				fncmsgerror(errorCar); 
				$flagnuevotransitemtemp = 1; 
				$flagerror = 1; 
				$campnomb = $elementos[0]; 
				break; 
			} 
			$validresult = consulmetatransitemtemp($elementos[0],$elementos[1],$nuconn); 
			if ($validresult == 1) 
			{ 
				$flagnuevotransitemtemp = 1; 
				$flagerror = 1; 
				$campnomb = $elementos[0]; 
				unset ($validresult); 
				break; 
			} 
		} 
		if($flagerror != 1) 
		{ 
			$result = insrecordtransitemtemp($iRegtransitemtemp,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flagnuevotransitemtemp=1; 
			} 
			if($result > 0) 
			{ 
				fncmsgerror(grabaEx); 
			} 
			fncclose($nuconn); 
		} 
	} 
} 
$iRegtransitemtemp[traitempcodigo] = $traitempcodigo; 
$iRegtransitemtemp[tipmovcodigo] = $tipmovcodigo; 
$iRegtransitemtemp[itemcodigo] = $itemcodigo; 
$iRegtransitemtemp[traitempfecha] = $traitempfecha; 
$iRegtransitemtemp[traitempcantid] = $traitempcantid; 
$iRegtransitemtemp[traitemptotal] = $traitemptotal; 
$iRegtransitemtemp[usuacodi] = $usuacodi; 
grabatransitemtemp($iRegtransitemtemp,$flagnuevotransitemtemp,$campnomb); 
?> 
