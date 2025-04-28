<?php
/*
-Todos los derechos reservados- Propiedad intelectual de Adsum (c).
Funcion	:	grabaparaprod
Decripcion	:	Valida la data a grabar y la lleva al paquete.
Parametros	:	
	$iRegparaprod		Arreglo de datos.
	$flagnuevoparaprod	Bandera de validacion
Retorno	:
	true	=	1
	false	=	0
Autor		:	ariascos
Escrito con	:	Manualmente
Fecha		:	20091021
Historial de modificaciones
|	Fecha			|	Motivo							|	Autor					|
 	20091021 			Implementacion						ariascos
*/

if(!$ordtracodigo)
{
	include ('../src/FunGen/fncnumprox.php');
	include ('../src/FunGen/fncnumact.php');
	include ('../def/tipocampo.php');
	include ('../src/FunPerPriNiv/pktblcampo.php');
	include ('../src/FunPerPriNiv/pktbltabla.php');
	include ('../src/FunGen/buscacaracter.php');
	include ('../src/FunGen/fncmsgerror.php');
	include ('../src/FunGen/fnctimecmp.php');
}
include ('../src/FunPerPriNiv/pktblparaprod.php');


function grabaparaprod(&$iRegparaprod, &$flagnuevoparaprod, &$campnomb, &$codigoparaprod) {
	
	$nuconn = fncconn ();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define ( "idT", 99 );
	define ( "errorReg", 1 );
	define ( "errorCar", 2 );
	define ( "grabaEx", 3 );
	define ( "compinst", 4 );
	define ( "venccomp", 5 );
	define ( "compactu", 6 );
	define ( "fecvalid", 7 );
	define ( "errormail", 8 );
	define ( "editaEx", 9 );
	define ( "errorIng", 35 );
	define ( "errorTimeValparaprod", 38 );
	
	$nuidtemp = fncnumact ( idT, $nuconn );
	
	do {
		$nuresult = loadrecordparaprod ( $nuidtemp, $nuconn );
		
		if ($nuresult == e_empty) {
			$iRegparaprod [parprocodigo] = $nuidtemp;
			$codigoparaprod = $iRegparaprod [parprocodigo];
		}
		$nuidtemp ++;
	} while ( $nuresult != e_empty );
	//$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn);
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	if ($iRegparaprod) {
		$iRegtabla ["tablnomb"] = "paraprod";
		$resulttabla = dinamicscantabla ( $iRegtabla, $nuconn );
		$num = fncnumreg ( $resulttabla );
		for($i = 0; $i < $num; $i ++) {
			$sbregtabla = fncfetch ( $resulttabla, $i );
			
			if ($sbregtabla [tablnomb] == "paraprod") {
				$tablcodi = $sbregtabla ['tablcodi'];
				break;
			}
		}
		
		$iRegCampo ["tablcodi"] = $tablcodi;
		$resultcampo = dinamicscancampo ( $iRegCampo, $nuconn );
		$num = fncnumreg ( $resultcampo );
		
		while ( $elementos = each ( $iRegparaprod ) ) {
			$iRegCampo ["campnomb"] = $elementos [0];
			$resultcampo = dinamicscancampo ( $iRegCampo, $nuconn );
			$num = fncnumreg ( $resultcampo );
			
			if ($num > 0) {
				$sbregcampo = fncfetch ( $resultcampo, 0 );
				
				if ($elementos [0] != "parprocodigo") {
					if ($sbregcampo ["campnomb"] == $elementos [0]) {
						$respuesta = strcmp ( $sbregcampo ["campnotnull"], "t" );
						
						if ($respuesta == 0) {
							if ($elementos [1] == "") {
								$campnomb [$elementos [0]] = 1;
								$flagnuevoparaprod = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter ( $elementos [1] );
			
			if ($validar == 1) {
				$flagnuevoparaprod = 1;
				$flagerror = 1;
				$campnomb [$elementos [0]] = 1;
			}

			if ($elementos [0] == "equipocodigo" && $elementos [1] == null) {
				$flagnuevoparaprod = 1;
				$flagerror = 1;
				$campnomb [$elementos [0]] = 1;
			}
			
			if ($elementos [0] == "parprohorini" && $elementos [1] == null) {
				$flagnuevoparaprod = 1;
				$flagerror = 1;
				$campnomb [$elementos [0]] = 1;
			}
			
			if ($elementos [0] == "parprohorfin" && $elementos [1] == null) {
				$flagnuevoparaprod = 1;
				$flagerror = 1;
				$campnomb [$elementos [0]] = 1;
			}
			
			if ($elementos [0] == "tipfalcodigo" && $elementos [1] == null) {
				$flagnuevoparaprod = 1;
				$flagerror = 1;
				$campnomb [$elementos [0]] = 1;
			}
			
			if ($elementos [0] == "parprodescri" && $elementos [1] == null) {
				$flagnuevoparaprod = 1;
				$flagerror = 1;
				$campnomb [$elementos [0]] = 1;
			}
			
		}
		
		// Si quiere ingresar paraprod viejas comoente este codigo
		/*
		$varfecaux = $iRegparaprod[parprofecini].",".$iRegparaprod[parprohorini];
		$varfecgen = $iRegparaprod[parprofecgen].",".$iRegparaprod[parprohorgen];

		if($varfecaux < $varfecgen)
		{
			fncmsgerror(errorTimeValparaprod);
			$flagnuevoparaprod = 1;
			$flagerror = 1;
			$campnomb[parprofecini] = 1;
		}

		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}*/
		// Hasta aqui		
		

		if ($campnomb ["caufallcodigo"] == 1) {
			echo '<script language="javascript">';
			echo '<!--//' . "\n";
			echo 'alert("Debe seleccionar una Causa de Falla")';
			echo '//-->' . "\n";
			echo '</script>';
			$flagnuevoparaprod = 1;
		}
		
		if ($flagerror != 1) {
			$result = insrecordparaprod ( $iRegparaprod, $nuconn ); //Guarda la Orden de trabajo Primero en la tabla paraprod

			if ($result < 0) {
				fncmsgerror ( errorReg );
				$flagnuevoparaprod = 1;
			}
			if ($result > 0) {
				$nuresult1 = fncnumprox ( idT, $nuidtemp, $nuconn ); //	No utilice esta parte si va a utilizar la llave primaria como serial //
				$flagnuevoparaprod = null;
				fncmsgerror ( grabaEx );
			}
			fncclose ( $nuconn );
		} else {
			fncmsgerror ( errorIng );
			$flagnuevoparaprod = 1;
		}
	}
}

if(!$parprohorini && !$parprohorfin)
{
	//Convierte la hora en formato de 24 horas
	$parprohorini = $horini.':'.$minini;
	$parprohorfin = $horfin.':'.$minfin;
	
	if ($pasadmerini) {
		if ($horini != 12)
			$parprohorini = ($horini + 12) . ":" . $minini;
	} 
	elseif ($horini == 12)
		$parprohorini = "00:" . $minini;
		
	if ($pasadmerfin) {
		if ($horfin != 12)
			$parprohorfin = ($horfin + 12) . ":" . $minfin;
	
	} elseif ($horfin == 12)
		$parprohorfin = "00:" . $minfin;
}

$valor = 0;

//fin validar
if(!$parprocodigo)
{

	$iRegparaprod [parprocodigo] = $parprocodigo;
	$iRegparaprod [plantacodigo] = $plantacodigo;
	$iRegparaprod [sistemcodigo] = $sistemcodigo;
	$iRegparaprod [equipocodigo] = $equipocodigo;
	$iRegparaprod [componcodigo] = $componcodigo;
	$iRegparaprod [partecodigo] = $partecodigo;
	$iRegparaprod [tipfalcodigo] = $tipfalcodigo;
	$iRegparaprod [caufallcodigo] = $caufallcodigo;
	$iRegparaprod [parprodescri] = $parprodescri;
	$iRegparaprod [parprofecgen] = $parprofecgen;
	$iRegparaprod [parprohorgen] = $parprohorgen;
	$iRegparaprod [parprofecini] = $parprofecini;
	$iRegparaprod [parprohorini] = $parprohorini;
	$iRegparaprod [ordtracodigo] = $ordtracodigo;
	if($parprofecfin)
	{
		$iRegparaprod [parprofecfin] = $parprofecfin;
		$iRegparaprod [parprohorfin] = $parprohorfin;
	}
	$iRegparaprod [tiptracodigo] = $tiptracodigo;
	$iRegparaprod [usuacodi] = $usuacodi;
	
	grabaparaprod( $iRegparaprod, $iRegvaltareparaprod, $flagnuevoparaprod, $campnomb, $codigoparaprod);
}
else
{
	if($parprofecfin >= $parprofecini)
	{
		if($parprohorfin > $parprohorini)
		{
			$iRegparaprod [parprofecfin] = $parprofecfin;
			$iRegparaprod [parprohorfin] = $parprohorfin;
			$iRegparaprod [parprocodigo] = $parprocodigo;
			
			$idcon = fncconn();
			$result = uprecordparaproddateend($iRegparaprod, $idcon);

			if ($result < 0) {
				fncmsgerror ( 1 );
				$flagnuevoparaprod = 1;
			}
			if ($result > 0) {
				$flagnuevoparaprod = null;
				fncmsgerror ( 3 );
				unset( $parprocodigo, $plantacodigo, $sistemcodigo, $equipocodigo, $componcodigo, $caufallcodigo, $tiptracodigo, $tipfalcodigo, $parprofecinis, $parprohorinis);
			}
		}
		else
			$flagnuevoparaprod = 1;
	}
	else
		$flagnuevoparaprod = 1;
	
	if($flagnuevoparaprod)
		fncmsgerror ( 43 );
		
}
if(!$flagnuevoparaprod && !$ordtracodigo){
	echo "<script language='JavaScript'>";
	echo 'location="maestablparaprod.php?codigo='.$codigo.'"';
	echo "</script>";
}
?>