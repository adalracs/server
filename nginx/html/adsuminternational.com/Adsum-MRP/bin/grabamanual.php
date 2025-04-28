<?php
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabamanual
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegmanual         Arreglo de datos.
$flagnuevomanual    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/

include ('../src/FunGen/fncnumprox.php');
include ('../src/FunGen/fncnumact.php');
include ('../def/tipocampo.php');
include ('../src/FunPerPriNiv/pktblmanual.php');
include ('../src/FunPerPriNiv/pktbltabla.php');
include ('../src/FunPerPriNiv/pktblcampo.php');
include ('../src/FunGen/buscacaracter.php');
include ('../src/FunGen/fncsubirmanual.php');
include ('../src/FunGen/fncnombexs.php');

function grabamanual($iRegmanual, &$flagnuevomanual, &$campnomb, $iRegmanual, $itipoarc, $tamaarc, $irutaarc, $itemparc) {
	$nuconn = fncconn ();
	$inombarc = $_FILES ['file'] ['name'];
	$itipoarc = $_FILES ['file'] ['type'];
	$tamaarc = $_FILES ['file'] ['size'];
	$irutaarc = "../doc/manuales/";
	$itemparc = $_FILES ['file'] ['tmp_name'];
	$manualruta = $irutaarc . $inombarc;
	$iRegmanual [manualcodigo] = $manualcodigo;
	$iRegmanual [manualnombre] = $_POST[manualnombre];
	$iRegmanual [manualruta] = $manualruta;
	$iRegmanual [manualdescri] = $_POST[manualdescri];
	
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define ( "id", 32 );
	define ( "errorReg", 1 );
	define ( "errorCar", 2 );
	define ( "grabaEx", 3 );
	define ( "compinst", 4 );
	define ( "venccomp", 5 );
	define ( "compactu", 6 );
	define ( "fecvalid", 7 );
	define ( "errormail", 8 );
	define ( "editaEx", 9 );
	define ( "errorNombExs", 18 );
	define ( "errorIng", 35 );
	
	$nuidtemp = fncnumact ( id, $nuconn );
	do {
		$nuresult = loadrecordmanual ( $nuidtemp, $nuconn );
		if ($nuresult == e_empty) {
			$iRegmanual [manualcodigo] = $nuidtemp;
		}
		$nuidtemp ++;
	} while ( $nuresult != e_empty );
	$nuresult1 = fncnumprox ( id, $nuidtemp, $nuconn );
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	if ($iRegmanual) {
		$iRegtabla ["tablnomb"] = "manual";
		$resulttabla = dinamicscantabla ( $iRegtabla, $nuconn );
		$num = fncnumreg ( $resulttabla );
		for($i = 0; $i < $num; $i ++) {
			$sbregtabla = fncfetch ( $resulttabla, $i );
			if ($sbregtabla [tablnomb] == "manual") {
				$tablcodi = $sbregtabla ['tablcodi'];
				break;
			}
		}
		
		$iRegCampo ["tablcodi"] = $tablcodi;
		$resultcampo = dinamicscancampo ( $iRegCampo, $nuconn );
		$num = fncnumreg ( $resultcampo );
		
		//		while($elementos = each($iRegmanual))
		//		{
		//			$iRegCampo["campnomb"] = $elementos[0];
		//			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
		//			$num = fncnumreg($resultcampo);
		//			if($num>0)
		//			{
		//				$sbregcampo = fncfetch($resultcampo,0);
		//				if($elementos[0] != "manualcodigo")
		//				{
		//					if($sbregcampo["campnomb"] == $elementos[0])
		//					{
		//						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
		//						if($respuesta == 0)
		//						{
		//							if($elementos[1] == "")
		//							{
		//								$campnomb[$elementos[0]] = 1;
		//								$flagnuevomanual = 1;
		//								$flagerror = 1;
		//							}
		//						}
		//					}
		//				}
		//			}
		//			$validar = buscacaracter($elementos[1]);
		//
		//			if($validar == 1)
		//			{
		//			$flagnuevomanual = 1;
		//				$flagerror = 1;
		//				$campnomb[$elementos[0]] = 1;
		//			}
		//			$validresult = consulmetamanual($elementos[0],$elementos[1],$nuconn);
		//
		//			if($validresult == 1)
		//			{
		//				$flagnuevomanual = 1;
		//				$flagerror = 1;
		//				$campnomb[$elementos[0]] = 1;
		//				unset ($validresult);
		//			}
		//			if($elementos[0]=='manualnombre')
		//			{
		//				$validnombre =  fncnombexs('manual',$iRegmanual,$elementos[0],$elementos[1],$nuconn);
		//				if ($validnombre == 1)
		//				{
		//					fncmsgerror(errorNombExs);
		//					$flagnuevomanual = 1;
		//					$flagerror = 1;
		//					$campnomb[$elementos[0]] = 1;
		//					unset ($validnombre);
		//				}
		//			}
		//			if($elementos[0] == "manualruta" && $inombarc == null)
		//			{
		//				
		//				$flagnuevomanual = 1; 
		//				$flagerror = 1; 
		//				$campnomb[$elementos[0]] = 1;
		//				 				
		//			}
		//		}
		

		if ($flagerror == 1) {
			fncmsgerror ( errorIng );
		}
		
		if (! $campnomb) {
			fncsubirmanual ( $inombarc, $itipoarc, $tamaarc, $irutaarc, $itemparc, $flagerror, $flagnuevomanual, $flageditarmanual );
		}
		if ($flagerror != 1) {
			$result = insrecordmanual ( $iRegmanual, $nuconn );
			if ($result < 0) {
				ob_end_clean ();
				fncmsgerror ( errorReg );
				$campnomb = $elementos [0];
				$flagnuevomanual = 1;
			}
			if ($result > 0) {
				$nuresult1 = fncnumprox ( id, $nuidtemp, $nuconn ); //	No utilice esta parte si va a utilizar la llave primaria como serial //
				fncmsgerror ( grabaEx );
			}
			fncclose ( $nuconn );
		}
	}
}

grabamanual ( $iRegmanual, $flagnuevomanual, $campnomb, $inombarc, $itipoarc, $tamaarc, $irutaarc, $itemparc );
?> 
