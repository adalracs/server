<?php 
/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : grabareportotitem 
Decripcion      : Valida la data a grabar y la lleva al paquete. 
Parametros      : Descripicion 
    $iRegreportotitem         Arreglo de datos. 
    $flagnuevoreportotitem    Bandera de validación 
Retorno         : 
		true	= 1 
		false	= 0 
Autor           : ariascos 
Escrito con     : WAG Adsum versión 3.1.1 
Fecha           : 18082004 
Historial de modificaciones 
| Fecha  | Motivo															| Autor 	| 
 16082005  Adaptación para utilizarla desde la función grabareportot.php	 jcortes
*/ 
  
/*include ( '../src/FunGen/fncnumprox.php'); 
include ( '../src/FunGen/fncnumact.php'); 
include ( '../def/tipocampo.php'); 
include ( '../src/FunPerPriNiv/pktblreportotitem.php'); 
include ( '../src/FunGen/buscacaracter.php'); 
include ( '../src/FunGen/fncmsgerror.php');*/
 
function grabareportotitem($iRegreportotitem,&$flagnuevoreportotitem,&$campnomb)
{ 
	$nuconn = fncconn(); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
	define("idreportotitem",62); 
	define("errorReg",1); 
	define("errorCar",2); 
	define("grabaEx",3); 
	define("compinst",4); 
	define("venccomp",5); 
	define("compactu",6); 
	define("fecvalid",7); 
	define("errormail",8); 
	define("editaEx",9); 
	$nuidtemp = fncnumact(	idreportotitem,$nuconn); 
	do 
	{ 
		$nuresult = loadrecordreportotitem($nuidtemp,$nuconn); 
		if($nuresult == e_empty) 
		{ 
			$iRegreportotitem[repitemcodigo] = $nuidtemp; 
		} 
		$nuidtemp ++; 
	}while ($nuresult != e_empty); 
	if ($iRegreportotitem) 
	{ 
		while($elementos = each($iRegreportotitem)) 
	{ 
			$validar = buscacaracter($elementos[1]); 
			if($validar == 1) 
			{ 
				fncmsgerror(errorCar); 
				$flagnuevoreportotitem = 1; 
				$flagerror = 1; 
				$campnomb = $elementos[0]; 
				break; 
			} 
			$validresult = consulmetareportotitem($elementos[0],$elementos[1],$nuconn); 
			if ($validresult == 1) 
			{ 
				$flagnuevoreportotitem = 1; 
				$flagerror = 1; 
				$campnomb = $elementos[0]; 
				unset ($validresult); 
				break; 
			} 
		} 
		if($flagerror != 1) 
		{ 
			$result = insrecordreportotitem($iRegreportotitem,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flagnuevoreportotitem=1; 
			} 
			if($result > 0) 
			{ 
				$nuresult1 = fncnumprox(idreportotitem,$nuidtemp,$nuconn); 
				//	No utilice esta parte si va a utilizar la llave primaria como serial 
				//fncmsgerror(grabaEx); 
			} 
			fncclose($nuconn); 
		}
	} 
} 
/*$iRegreportotitem[repitemcodigo] = $repitemcodigo; 
$iRegreportotitem[reportcodigo] = $reportcodigo; 
$iRegreportotitem[transitecodigo] = $transitecodigo; 
grabareportotitem($iRegreportotitem,$flagnuevoreportotitem,$campnomb); */
?> 
