<?php
	include_once('../src/FunPerSecNiv/fncconn.php');
	include_once('../src/FunPerSecNiv/fncclose.php');
	include_once('../src/FunPerPriNiv/pktblprogramacion.php');
	include_once('../src/FunPerPriNiv/pktbltareot.php');

	$idconn = fncconn();
	$arrFieldRutina = explode("||",$arrRutina);

	($arrFieldRutina[6] == 2) ? $progratiedur1 = $arrFieldRutina[5] / 60 : $progratiedur1 = $arrFieldRutina[5];
	
	// --- Armamos el Registro (Programacion)---
	$iRegprogramacion[progracodigo] = $arrFieldRutina[0]; //$progracodigo;
	$iRegprogramacion[tipcomcodigo] = $arrFieldRutina[1]; //$tipcomcodigo;
	$iRegprogramacion[prioricodigo] = $arrFieldRutina[2]; //$prioricodigo;
	$iRegprogramacion[progratiedur] = $arrFieldRutina[5]; //$progratiedur;
	$iRegprogramacion[prograacti] = $arrFieldRutina[7]; //$prograacti
	$iRegprogramacion[progranota] = $arrFieldRutina[8]; //$progranota
	// --- Actualizamos Programacion ---
	$result = uprecordprogramacionedita($iRegprogramacion, $idconn);
	
	// --- Armamos el Registro (Tareot)---	
	$iRegotvalid[tareacodigo]  = $arrFieldRutina[3]; //$tareacodigo; 
	$iRegotvalid[otestacodigo]  = $arrFieldRutina[4]; //otestacodigo 
	$iRegotvalid[prioricodigo]  = $arrFieldRutina[2];
	$iRegotvalid[tareottiedur]  = $arrFieldRutina[5];
	$iRegotvalid[progracodigo] = $arrFieldRutina[0];
	// --- Actualizamos Tareot Programacion ---
	$result = uprecordtareotprogramacion($iRegotvalid, $idconn);
	
	fncclose($idconn);