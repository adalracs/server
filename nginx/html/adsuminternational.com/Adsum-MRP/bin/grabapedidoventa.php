<?php 
/* 
<!-- Propiedad intelectual de Adsum SAS (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andrés A. Riascos D. 
Fecha: 20120110 
GenVers: 4.8 --> 
Funcion         : grabapedidoventa 
Decripcion      : Valida la data a grabar y la lleva al paquete. 
Parametros      : Descripicion 
    $iRegpedidoventa         Arreglo de datos. 
    $flagnuevopedidoventa    Bandera de validación 
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
include ( '../src/FunPerPriNiv/pktblpedidoventa.php'); 
include ( '../src/FunGen/buscacaracter.php'); 
include ( '../src/FunGen/fncmsgerror.php'); 
 
function grabapedidoventa($iRegpedidoventa,&$flagnuevopedidoventa,&$campnomb) 
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
		$nuresult = loadrecordpedidoventa($nuidtemp,$nuconn); 
		if($nuresult == e_empty) 
		{ 
			$iRegpedidoventa[pedvencodigo] = $nuidtemp; 
		} 
		$nuidtemp ++; 
	}while ($nuresult != e_empty); 
	$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
	if ($iRegpedidoventa) 
	{ 
		while($elementos = each($iRegpedidoventa)) 
	{ 
			$validar = buscacaracter($elementos[1]); 
			if($validar == 1) 
			{ 
				fncmsgerror(errorCar); 
				$flagnuevopedidoventa = 1; 
				$flagerror = 1; 
				$campnomb = $elementos[0]; 
				break; 
			} 
			$validresult = consulmetapedidoventa($elementos[0],$elementos[1],$nuconn); 
			if ($validresult == 1) 
			{ 
				$flagnuevopedidoventa = 1; 
				$flagerror = 1; 
				$campnomb = $elementos[0]; 
				unset ($validresult); 
				break; 
			} 
		} 
		if($flagerror != 1) 
		{ 
			$result = insrecordpedidoventa($iRegpedidoventa,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flagnuevopedidoventa=1; 
			} 
			if($result > 0) 
			{ 
				fncmsgerror(grabaEx); 
			} 
			fncclose($nuconn); 
		} 
	} 
} 
$iRegpedidoventa[pedvencodigo] = $pedvencodigo; 
$iRegpedidoventa[tipevecodigo] = $tipevecodigo; 
$iRegpedidoventa[ordcomcodigo] = $ordcomcodigo; 
$iRegpedidoventa[usuacodi] = $usuacodi; 
$iRegpedidoventa[pedvennumero] = $pedvennumero; 
$iRegpedidoventa[pedvenfecent] = $pedvenfecent; 
$iRegpedidoventa[pedvenfecrec] = $pedvenfecrec; 
$iRegpedidoventa[pedvendiapac] = $pedvendiapac; 
$iRegpedidoventa[pedvenobserv] = $pedvenobserv; 
$iRegpedidoventa[pedvenconsec] = $pedvenconsec; 
$iRegpedidoventa[pedvenmotmue] = $pedvenmotmue; 
$iRegpedidoventa[pedvennompro] = $pedvennompro; 
grabapedidoventa($iRegpedidoventa,$flagnuevopedidoventa,$campnomb); 
?> 
