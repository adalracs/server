<?php 
/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : grabaequipotemp 
Decripcion      : Valida la data a grabar y la lleva al paquete. 
Parametros      : Descripicion 
    $iRegequipotemp         Arreglo de datos. 
    $flagnuevoequipotemp    Bandera de validación 
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
include ( '../src/FunPerPriNiv/pktblequipotemp.php'); 
include ( '../src/FunGen/buscacaracter.php'); 
include ( '../src/FunGen/fncmsgerror.php'); 
 
function grabaequipotemp($iRegequipotemp,&$flagnuevoequipotemp,&$campnomb) 
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
		$nuresult = loadrecordequipotemp($nuidtemp,$nuconn); 
		if($nuresult == e_empty) 
		{ 
			$iRegequipotemp[equtemcodigo] = $nuidtemp; 
		} 
		$nuidtemp ++; 
	}while ($nuresult != e_empty); 
	$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
	if ($iRegequipotemp) 
	{ 
		while($elementos = each($iRegequipotemp)) 
	{ 
			$validar = buscacaracter($elementos[1]); 
			if($validar == 1) 
			{ 
				fncmsgerror(errorCar); 
				$flagnuevoequipotemp = 1; 
				$flagerror = 1; 
				$campnomb = $elementos[0]; 
				break; 
			} 
			$validresult = consulmetaequipotemp($elementos[0],$elementos[1],$nuconn); 
			if ($validresult == 1) 
			{ 
				$flagnuevoequipotemp = 1; 
				$flagerror = 1; 
				$campnomb = $elementos[0]; 
				unset ($validresult); 
				break; 
			} 
		} 
		if($flagerror != 1) 
		{ 
			$result = insrecordequipotemp($iRegequipotemp,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flagnuevoequipotemp=1; 
			} 
			if($result > 0) 
			{ 
				fncmsgerror(grabaEx); 
			} 
			fncclose($nuconn); 
		} 
	} 
} 
$iRegequipotemp[equtemcodigo] = $equtemcodigo; 
$iRegequipotemp[estadocodigo] = $estadocodigo; 
$iRegequipotemp[sistemcodigo] = $sistemcodigo; 
$iRegequipotemp[cencoscodigo] = $cencoscodigo; 
$iRegequipotemp[equtemnombre] = $equtemnombre; 
$iRegequipotemp[equtemdescri] = $equtemdescri; 
$iRegequipotemp[equtemfabric] = $equtemfabric; 
$iRegequipotemp[equtemmarca] = $equtemmarca; 
$iRegequipotemp[equtemmodelo] = $equtemmodelo; 
$iRegequipotemp[equtemserie] = $equtemserie; 
$iRegequipotemp[equtemlargo] = $equtemlargo; 
$iRegequipotemp[equtemancho] = $equtemancho; 
$iRegequipotemp[equtemalto] = $equtemalto; 
$iRegequipotemp[equtempeso] = $equtempeso; 
$iRegequipotemp[equtemvolta] = $equtemvolta; 
$iRegequipotemp[equtemcorrie] = $equtemcorrie; 
$iRegequipotemp[equtempoten] = $equtempoten; 
$iRegequipotemp[equtemfeccom] = $equtemfeccom; 
$iRegequipotemp[equtemcinv] = $equtemcinv; 
$iRegequipotemp[equtemvengar] = $equtemvengar; 
$iRegequipotemp[equtemviduti] = $equtemviduti; 
$iRegequipotemp[equtemfecins] = $equtemfecins; 
$iRegequipotemp[equtemubicac] = $equtemubicac; 
$iRegequipotemp[equtemvalhor] = $equtemvalhor; 
$iRegequipotemp[equtemnohs] = $equtemnohs; 
$iRegequipotemp[equtemacti] = $equtemacti; 
grabaequipotemp($iRegequipotemp,$flagnuevoequipotemp,$campnomb); 
?> 
