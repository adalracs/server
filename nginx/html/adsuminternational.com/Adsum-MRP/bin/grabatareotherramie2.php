<?php 
/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : grabatareotherramie 
Decripcion      : Valida la data a grabar y la lleva al paquete. 
Parametros      : Descripicion 
    $iRegtareotherramie         Arreglo de datos. 
    $flagnuevotareotherramie    Bandera de validaci�n 
Retorno         : 
		true	= 1 
		false	= 0 
Autor           : ariascos 
Escrito con     : WAG Adsum versi�n 3.1.1 
Fecha           : 18082004 
Historial de modificaciones 
| Fecha | Motivo				| Autor 	| 
*/  
include ( '../src/FunPerPriNiv/pktbltareotherramie.php'); 
 
function grabatareotherramie($iRegtareotherramie,&$flagnuevotareotherramie,&$campnomb) 
{ 
	$nuconn = fncconn(); 

	define("id_3",72); 
	define("errorReg",1); 
	define("errorCar",2); 
	define("grabaEx",3); 
	define("compinst",4); 
	define("venccomp",5); 
	define("compactu",6); 
	define("fecvalid",7); 
	define("errormail",8); 
	define("editaEx",9); 
	
	$nuidtemp = fncnumact(id_3,$nuconn); 
	do 
	{ 
		$nuresult = loadrecordtareotherramie($nuidtemp,$nuconn); 
		if($nuresult == e_empty) 
		{ 
			$iRegtareotherramie[tarherrcodigo] = $nuidtemp; 
		} 
		$nuidtemp ++; 
	}while ($nuresult != e_empty); 

	if ($iRegtareotherramie) 
	{ 
		
		$result = insrecordtareotherramie($iRegtareotherramie,$nuconn); 
		if($result < 0 ) 
		{ 
			ob_end_clean(); 
			fncmsgerror(errorReg); 
			$flagnuevotareotherramie=1; 
		} 
		if($result > 0) 
		{ 
			$nuresult1 = fncnumprox(id_3,$nuidtemp,$nuconn);
		} 
		fncclose($nuconn); 
	} 
} 

?> 
