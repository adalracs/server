<?php 
/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : grabausuanovedad
Decripcion      : Valida la data a grabar y la lleva al paquete. 
Parametros      : Descripicion 
    $iRegusuanovedad         Arreglo de datos. 
    $flagnuevousuanovedad    Bandera de validaci�n 
Retorno         : 
		true	= 1 
		false	= 0 
Autor           : cbedoya
Escrito con     : WAG Adsum versi�n 3.1.1 
Fecha           : 30-November-2007
Historial de modificaciones 
| Fecha | Motivo				| Autor 	| 
*/ 

if(!$noAjax):
	include '../src/FunPerSecNiv/fncconn.php';
	include '../src/FunPerSecNiv/fncclose.php';
	include '../src/FunPerSecNiv/fncnumreg.php';
	include '../src/FunPerSecNiv/fncfetch.php';
endif;

include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../def/tipocampo.php');
include ( '../src/FunPerPriNiv/pktblusuanovedad.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include ( '../src/FunGen/fncnombexs.php');
 
function grabausuanovedad($iRegusuanovedad,&$flagnuevousuanovedad,&$campnomb)
{ 
	$nuconn = fncconn(); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
	define("id",105); 
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("errorNombExs",18);
	define("errorIng",35);
	
	$nuidtemp = fncnumact(	id,$nuconn); 
	do{ 
		$nuresult = loadrecordusuanovedad($nuidtemp,$nuconn); 
		if($nuresult == e_empty)
			$iRegusuanovedad[usunovcodigo] = $nuidtemp;
		$nuidtemp ++; 
	}while ($nuresult != e_empty); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	
	
	$result = insrecordusuanovedad($iRegusuanovedad,$nuconn); 
			
	if($result < 0 )
		"#error::";
	if($result > 0)
		"#save::";
	
	fncclose($nuconn); 
}

$iRegusuanovedad[usunovcodigo] = $usunovcodigo; 
$iRegusuanovedad[estnovcodigo] = $estnovcodigo; 
$iRegusuanovedad[usuacodi] = $usuacodigo; 
$iRegusuanovedad[usunovfecini] = $usunovfecini; 
$iRegusuanovedad[usunovfecfin] = $usunovfecfin; 
$iRegusuanovedad[usunovhorini] = $usunovhorini; 
$iRegusuanovedad[usunovhorfin] = $usunovhorfin; 
$iRegusuanovedad[usunovdescri] = $usunovdescri; 

grabausuanovedad($iRegusuanovedad,$flagnuevousuanovedad,$campnomb);