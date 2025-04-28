<?php 
/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : grabaempleadotareot 
Decripcion      : Valida la data a grabar y la lleva al paquete. 
Parametros      : Descripicion 
    $iRegempleadotareot         Arreglo de datos. 
    $flagnuevoempleadotareot    Bandera de validaci�n 
Retorno         : 
		true	= 1 
		false	= 0 
Autor           : ariascos 
Escrito con     : WAG Adsum versi�n 3.1.1 
Fecha           : 18082004 
Historial de modificaciones 
| Fecha | Motivo				| Autor 	| 
19012005 Implementacion			jcortes
*/ 
  
if (!$declare) {
	include ( '../src/FunPerPriNiv/pktblusuariotareot.php'); 
}
function grabausuariotareot($iRegusuariotareot,&$flagnuevousuariotareot,&$campnomb){ 
	$nuconn = fncconn(); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
	define("id_2",52); 
	define("errorReg",1); 
	define("errorCar",2); 
	define("grabaEx",3); 
	define("compinst",4); 
	define("venccomp",5); 
	define("compactu",6); 
	define("fecvalid",7); 
	define("errormail",8); 
	define("editaEx",9); 
	$nuidtemp = fncnumact(id_2,$nuconn); 
	do 
	{ 
		$nuresult = loadrecordusuariotareots($nuidtemp,$nuconn); 
		if($nuresult == e_empty) 
		{ 
			$iRegusuariotareot[usutarcodigo] = $nuidtemp;
			 
		} 
		$nuidtemp ++; 
	}while ($nuresult != e_empty); 
	
	
	
	
	if ($iRegusuariotareot) 
	{ 
			$result = insrecordusuariotareot($iRegusuariotareot,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flagnuevousuariotareot = 1; 
			} 
			if($result > 0) 
			{ 
				$nuresult1 = fncnumprox(id_2,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
			} 
			fncclose($nuconn); 
	} 
} 
?> 
