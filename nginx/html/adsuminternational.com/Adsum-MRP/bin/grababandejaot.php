<?php
ob_start();
	include_once ('../src/FunPerPriNiv/pktblot.php');
	include_once ('../src/FunPerPriNiv/pktbltareot.php');
	include_once ('../src/FunPerPriNiv/pktblvistabandejaot.php');
	include_once ('../src/FunGen/fncsumdate.php');

	$cont = 0;
	
	if($typesource == 'user'):
		$arr = explode(',', $lsttecnicoot);
		$arreglo_tecnic = $lsttecnicoot;
		
		for($a = 0; $a < count($arr); $a++):
			if($usualider == $arr[$a]):
				$lider = $usualider;
				break;
			endif;
		endfor;
	elseif($typesource == 'cuadrilla'):
		include_once '../src/FunPerPriNiv/pktblcuadrillausuario.php';
		include_once '../src/FunPerPriNiv/pktblusuanovedad.php';
		include_once '../src/FunPerPriNiv/pktblestadonoveda.php';
	
		$cuadricodigo = $lsttecnicoot;
		
		$idcon = fncconn();
		$rs_cuadrillausuario = loadrecordcuadrillausuariousuario($lsttecnicoot, $idcon);
		
		for($a = 0; $a < count($rs_cuadrillausuario); $a++):
			$inactivo = false;
		
			$recUsuaNovedad = array('usuacodi' => $rs_cuadrillausuario[$a]['usuacodi'], 'usunovfecini' => $ordtrafecini, 'usunovfecfin' => $ordtrafecfin);
			$recopUsuaNovedad = array('usuacodi' => '=', 'usunovfecini' => '>=', 'usunovfecfin' => '<=');
			
			$rs_novedad = dinamicscanopusuanovedad($recUsuaNovedad, $recopUsuaNovedad, $idcon);
			$nr_novedad = fncnumreg($rs_novedad);
	
			if($nr_novedad > 0):
				$rw_novedad = fncfetch($rs_novedad, 0);
				$rs_estadonoveda = loadrecordestadonoveda($rw_novedad['estnovcodigo'], $idcon);
				
				if($rs_estadonoveda['estnovactusu'])
					$inactivo = true;
			endif;
			
			if($inactivo == false):
				if($arreglo_tecnic)
					$arreglo_tecnic .= ','.$rs_cuadrillausuario[$a]['usuacodi'];
				else
					$arreglo_tecnic = $rs_cuadrillausuario[$a]['usuacodi'];
			endif;
				
			if($rs_cuadrillausuario[$a]['cuausulider'] == 't'):
				if($inactivo == false)
					$lider = $rs_cuadrillausuario[$a]['usuacodi'];
			endif;
			
			if(!$lider && $inactivo == false)
				$lider = $rs_cuadrillausuario[$a]['usuacodi'];
		endfor;
	endif;
	
		
	if($pasadmerini)
		$ordtrahorini = date("H:i", strtotime($ordtrafecini.' '.$horini.':'.$minini.' pm'));
	else
		$ordtrahorini = date("H:i", strtotime($ordtrafecini.' '.$horini.':'.$minini.' am'));
			
	$idcon = fncconn();
	$ordtranumgru = fncnumact(98, $idcon); //ID consecutivo de Grupo programacion OT == 98
	do 
	{ 
		$ordtranumgru ++;
		$nuresult = dinamicscanopot(array('ordtranumpro' => $ordtranumgru), array('ordtranumpro' => '='), $idcon);
	}while ($nuresult != e_empty); 
	
	$arr_ordtracodigo = explode(",", $arr_bandeja);
	$nr_ot = count($arr_ordtracodigo);
				
	for($a = 0; $a < count($arr_ordtracodigo); $a++):
		$ordtracodigo = $arr_ordtracodigo[$a];
		$flagprogramacionot = NULL;
		$campnomb = NULL;
		$codigotareot = NULL;
					
		if($ordtracodigo):
			
			$idcon = fncconn();
			$rs_vistabandeja = loadrecordvistabandejaot($ordtracodigo, $idcon);
			$rs_tareot = buscartareotordtracodigo($ordtracodigo, $idcon);
			$codigotareot = $rs_tareot['tareotcodigo']; 
			
			$horas_tiedur = $rs_vistabandeja['tareottiedur'];
			$datefin = fncsumdate($ordtrafecini, $ordtrahorini, $horas_tiedur);
			$dateotfin = explode("/", $datefin);
	
			$arr_bandejaot['ordtracodigo'] = $ordtracodigo;
			$arr_bandejaot['ordtrafecini'] = $ordtrafecini;
			$arr_bandejaot['ordtrahorini'] = $ordtrahorini;
			$arr_bandejaot['ordtrafecfin'] = $dateotfin[0];
			$arr_bandejaot['ordtrahorfin'] = $dateotfin[1];
			$arr_bandejaot['tareotfecini'] = $ordtrafecini;
			$arr_bandejaot['tareothorini'] = $ordtrahorini;
			$arr_bandejaot['tareotfecfin'] = $dateotfin[0];
			$arr_bandejaot['tareothorfin'] = $dateotfin[1];
			$arr_bandejaot['ordtranumpro'] = $ordtranumgru;
			$arr_bandejaot['otestacodigo'] = $otestacodigo;
			$arr_bandejaot['usuacodi'] = $usuacodi;
			$arr_bandejaot['ordtraprogen'] = 'f';
	
			$idcon = fncconn();
			$resourceot = uprecordbandejaot($arr_bandejaot, $idcon);
			$resourcetareot = uprecordbandejaottareot($arr_bandejaot, $idcon);
			include ( 'grabausuariotareot.php');
		endif;
	endfor;

	echo '<script language="javascript">';
	echo "alert('Grabado exitoso'); ";
	echo "window.open('detallanuevaotprogramacionprint.php?ordtranumpro=$ordtranumgru','ordenes','status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=520');";
	echo "</script>";
	
	$idcon = fncconn();
	$ordtranumgru = fncnumprox (98, $ordtranumgru, $idcon); // Aqui se llama diferente $resultnumgrup
	unset($lsttecnicoot, $typesource);
	
	