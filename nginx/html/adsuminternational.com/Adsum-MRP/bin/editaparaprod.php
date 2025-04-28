<?php
/*
-Todos los derechos reservados- Propiedad intelectual de Adsum (c).
Funcion	:	editaparaprod
Decripcion	:	Valida la data a editar y la lleva al paquete.
Parametros	:	
	$iRegparaprod		Arreglo de datos.
	$flageditarparaprod	Bandera de validacion
Retorno	:
	true	=	1
	false	=	0
Autor		:	ariascos
Escrito con	:	Manualmente
Fecha		:	20091021
Historial de modificaciones
|	Fecha			|	Motivo							|	Autor					|
*/

include ('../src/FunGen/fncnumprox.php');
include ('../src/FunGen/fncnumact.php');
include ('../def/tipocampo.php');
include ('../src/FunPerPriNiv/pktblparaprod.php');
include ('../src/FunPerPriNiv/pktblcampo.php');
include ('../src/FunPerPriNiv/pktbltabla.php');
include ('../src/FunGen/buscacaracter.php');
include ('../src/FunGen/fncmsgerror.php');
include ('../src/FunGen/fnctimecmp.php');

function editaparaprod(&$iRegparaprod, &$flageditarparaprod, &$campnomb, &$codigoparaprod) {
	
	$nuconn = fncconn ();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define ( "id", 99 );
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
								$flageditarparaprod = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter ( $elementos [1] );
			
			if ($validar == 1) {
				$flageditarparaprod = 1;
				$flagerror = 1;
				$campnomb [$elementos [0]] = 1;
			}

			if ($elementos [0] == "equipocodigo" && $elementos [1] == null) {
				$flageditarparaprod = 1;
				$flagerror = 1;
				$campnomb [$elementos [0]] = 1;
			}
			
			if ($elementos [0] == "parprohorini" && $elementos [1] == null) {
				$flageditarparaprod = 1;
				$flagerror = 1;
				$campnomb [$elementos [0]] = 1;
			}
			
			if ($elementos [0] == "parprohorfin" && $elementos [1] == null) {
				$flageditarparaprod = 1;
				$flagerror = 1;
				$campnomb [$elementos [0]] = 1;
			}
			
			if ($elementos [0] == "tipfalcodigo" && $elementos [1] == null) {
				$flageditarparaprod = 1;
				$flagerror = 1;
				$campnomb [$elementos [0]] = 1;
			}
			
			if ($elementos [0] == "parprodescri" && $elementos [1] == null) {
				$flageditarparaprod = 1;
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
			$flageditarparaprod = 1;
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
			$flageditarparaprod = 1;
		}
		
		if ($flagerror != 1) {
			$result = uprecordparaprod ( $iRegparaprod, $nuconn ); //Guarda la Orden de trabajo Primero en la tabla paraprod

			if ($result < 0) {
				fncmsgerror ( errorReg );
				$flageditarparaprod = 1;
			}
			if ($result > 0) {
				$nuresult1 = fncnumprox ( id, $nuidtemp, $nuconn ); //	No utilice esta parte si va a utilizar la llave primaria como serial //
				$flageditarparaprod = null;
				fncmsgerror ( grabaEx );
			}
			fncclose ( $nuconn );
		} else {
			fncmsgerror ( errorIng );
			$flageditarparaprod = 1;
		}
	}
}

//Convierte la hora en formato de 24 horas
$foo1 = explode ( ":", $parprohorini );
$foo2 = explode ( ":", $parprohorfin );

if ($parprohorini) {
	if ($foo1 [0] != 12)
		$parprohorini = ($foo1 [0] + 12) . ":" . $parprominini;

} elseif ($foo1 [0] == 12)
	$parprohorini = "00:" . $foo1 [1];

if ($parprohorfin) {
	if ($foo2 [0] != 12)
		$parprohorfin = ($foo2 [0] + 12) . ":" . $parprominfin;

} elseif ($foo2 [0] == 12)
	$parprohorfin = "00:" . $foo2 [1];

$valor = 0;

//fin validar

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
$iRegparaprod [parprofecfin] = $parprofecfin;
$iRegparaprod [parprohorfin] = $parprohorfin;
$iRegparaprod [tiptracodigo] = $tiptracodigo;
$iRegparaprod [usuacodi] = $usuacodigo;

editaparaprod ( $iRegparaprod, $iRegvaltareparaprod, $flageditarparaprod, $campnomb, $codigoparaprod);

if(!$flageditarparaprod){
	echo "<script language='JavaScript'>";
	echo 'location="maestablparaprod.php?codigo='.$codigo.'"';
	echo "</script>";
}
?>