<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabaprogramot
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegot         Arreglo de datos.
$flagnuevoot    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : lfolaya
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha 			| Motivo									| Autor 	|
19-ene-2006			 Implementaci�n de nueva funcionalidad		 mstroh
*/


include_once('grabatareot2.php');
include_once('grabaot2.php');
include_once('grabausuariotareot2.php');
include_once('grabatransaction2.php');
include_once ( '../bin/grabatareotherramie2.php');
include_once ( '../bin/grabaitemtareot2.php');

// ---- GRABADO DE ORDEN DE TRABAJO ------------
$iRegot[ordtracodigo]  = $ordtracodigo;
$iRegot[ordtrafecgen]  = $prografecgen;
$iRegot[ordtrahorgen]  = $prograhorgen;
$iRegot[tipmancodigo]  = $tipmancodigo;
$iRegot[equipocodigo]  = $equipocodigo;
$iRegot[tipmedcodigo]  = $tipmedcodigo;
$iRegot[sistemcodigo]  = $sistemcodigo;
$iRegot[plantacodigo]  = $plantacodigo;
$iRegot[partecodigo]   = $partecodigo;
$iRegot[componcodigo]  = $componcodigo;
$iRegot[solsercodigo]  = $solsercodigo;
$iRegot[ordtradescri]  = $ordtradescri;
$iRegot[ordtrafecini]  = $dateotini[0];
$iRegot[ordtrahorini]  = $dateotini[1];
$iRegot[ordtrafecfin]  = $dateotfin[0];
$iRegot[ordtrahorfin]  = $dateotfin[1];
$iRegot[ordtranota]    = $progranota1;
$iRegot[otcantid]      = $otcantid;
$iRegot[ordtratipo]    = 0;
$iRegot[ordtraorigen]  = $ordtraorigen;
$iRegot[ordtraacti]    = 1;
$iRegot[usuacodi]	   = $_COOKIE["usuacodi"];
$iRegot[servicicodigo] = $servicicodigo;
$iRegot[ordtrahistor]  = $ordtrahistor;
$iRegot[ordtranumpro]  = $ordtranumpro;
$iRegot[ordtraprogen]  = $ordtraprogen;

grabaot($iRegot,$flagnuevoot,$codigoot,$lider);
// ------------------------------------------------

// ---- GRABADO DE HISTORIA DE OT ----
//$iReghistoriaot[histotcodigo] = $histotcodigo;
//$iReghistoriaot[ordtracodigo] = $codigoot;
//$iReghistoriaot[histothorini] = $prograhorgen;
//$iReghistoriaot[histotfecini] = $prografecgen;
//$iReghistoriaot[histothorfin] = $histothorfin;
//$iReghistoriaot[histotsecuen] = 0;
//$iReghistoriaot[histotfin]    = $histotfin;
//$iReghistoriaot[usuacodi]     = $usuacodi;
//$iReghistoriaot[histotdescri] = $ordtradescri;
//$iReghistoriaot[otestacodigo] = $otestacodigo;

//grabahistoriaot($iReghistoriaot, $flagnuevohistoriaot);
// -----------------------------------
if(!$flagnuevoot)
{
	// --- GRABADO EN TAREOT ---
	$iRegtareot[tareotcodigo] = $tareotcodigo;
	$iRegtareot[ordtracodigo] = $codigoot;
	$iRegtareot[tareacodigo]  = $tareacodigo1;
	$iRegtareot[tiptracodigo] = $tiptracodigo1;
	$iRegtareot[operaccodigo] = $operaccodigo;
	$iRegtareot[tareottiedur] = $tareottiedur;
	$nuconn2 = fncconn();
	$progra =  loadrecordprogramacionserial($codigoprog,$nuconn2);
	$iRegtareot[tareotnota]   = $progra[progranota];//$tareotnota;
	$iRegtareot[progracodigo] = $codigoprog;

	$iRegtareot[tareothorini] = $dateotini[1];
	$iRegtareot[tareotfecini] = $dateotini[0];
	$iRegtareot[tareothorfin] = $tareothorfin;
	$iRegtareot[tareotfecfin] = $tareotfecfin;
	$iRegtareot[tareotsecuen] = 0;
	$iRegtareot[tareotfin] = $tareotfin;
	$iRegtareot[usuacodi] = $usuacodi;
	$iRegtareot[otestacodigo] = $otestacodigo;
	$iRegtareot[prioricodigo] = $prioricodigo;
	$iRegtareot[tipcumcodigo] = $tipcumcodigo;
	//$iRegtareot[parotcodigo] = $tarparotcodigo;


	grabatareot($iRegtareot,$flagnuevotareot,$flagnuevoot,$campnomb,$codigotareot,$flagotinicial);
	// -------------------------
	
	if(!$flagnuevotareot)
	{	
		if($lider){
			// --- GRABADO EN USUARIOTAREOT ---
			include ( 'grabausuariotareot.php');
			// ---------------------------------
		}
       
		if($arreglo_herr)
		{
			
			$nuconn = fncconn();
			transaction($arreglo_herr,$arrtransac,$arrtransacherr,$nuconn,$sbregquery,$sbregcod);
			$result = grabatransaction($sbregquery,$nuconn);
			fncclose($nuconn);

			for($k = 0; $k < count($sbregcod); $k++)
			{
				$iRegtareotherramie[tarherrcodigo] = $tarherrcodigo;
				$iRegtareotherramie[tareotcodigo] = $codigotareot;
				$iRegtareotherramie[transhercodigo] = $sbregcod[$k];
				grabatareotherramie($iRegtareotherramie,$flagnuevotareotherramie,$campnomb);
			}

			unset($sbregquery);
			unset($sbregcod);
		}

		if($arreglo_ite)
		{
			$nuconn = fncconn();
			transaction($arreglo_ite,$arrtransacitem,$arrtransactran,$nuconn,$sbregquery,$sbregcod);
			$result = grabatransaction($sbregquery,$nuconn);
			fncclose($nuconn);

			for($l = 0; $l < count($sbregcod); $l++)
			{
				$iRegitemtareot[itemtarecodigo] = $itemtarecodigo;
				$iRegitemtareot[tareotcodigo] = $codigotareot;
				$iRegitemtareot[transitecodigo] = $sbregcod[$l];
				$iRegitemtareot[numitem] = $l==count($sbregcod)-1?99:$l+1;
				grabaitemtareot($iRegitemtareot,$flagnuevoitemtareot,$campnomb);
			}
			unset($sbregquery);
			unset($sbregcod);
		}
	}
}
?> 
