<?php 
/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : grabaprioridad 
Decripcion      : Valida la data a grabar y la lleva al paquete. 
Parametros      : Descripicion 
    $iRegprioridad         Arreglo de datos. 
    $flagnuevoprioridad    Bandera de validación 
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
include ( '../src/FunPerPriNiv/pktblprioridad.php'); 
include ( '../src/FunGen/buscacaracter.php'); 
include ( '../src/FunGen/fncmsgerror.php'); 
 
function grabaprioridad($iRegprioridad,&$flagnuevoprioridad) 
{ 
	$nuconn = fncconn(); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
	define("id",5); 
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("errorTipArc",6);
	define("errorTamArc",7);
	define("errorSub",8);
	define("subirEx",9);
	define("errorArcExs",10);
	define("errorArcNoExs",11);
	define("bajarEx",12);
	define("errorRutNull",13);
	define("editaEx",14);
	$nuidtemp = fncnumact(	id,$nuconn); 
	do 
	{ 
		$nuresult = loadrecordprioridad($nuidtemp,$nuconn); 
		if($nuresult == e_empty) 
		{ 
			$iRegprioridad[prioricodigo] = $nuidtemp; 
		} 
		$nuidtemp ++; 
	}while ($nuresult != e_empty); 
	$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
	if ($iRegprioridad) 
	{ 
		while($elementos = each($iRegprioridad)) 
	{ 
			$validar = buscacaracter($elementos[1]); 
			if($validar == 1) 
			{ 
				fncmsgerror(errorCar); 
				$flagnuevoprioridad = 1; 
				$flagerror = 1; 
				break; 
			} 
			$validresult = consulmetaprioridad($elementos[0],$elementos[1],$nuconn); 
			if ($validresult == 1) 
			{ 
				$flagnuevoprioridad = 1; 
				$flagerror = 1; 
				unset ($validresult); 
				break; 
			} 
		} 
		if($flagerror != 1) 
		{ 
			$result = insrecordprioridad($iRegprioridad,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flagnuevoprioridad=1; 
			} 
			fncclose($nuconn); 
			if($result > 0) 
			{ 
				fncmsgerror(grabaEx); 
			} 
		} 
	} 
} 
$iRegprioridad[prioricodigo] = $prioricodigo; 
$iRegprioridad[priorinombre] = $priorinombre; 
$iRegprioridad[prioridescri] = $prioridescri; 
grabaprioridad($iRegprioridad,$flagnuevoprioridad); 
?> 
