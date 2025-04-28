<?php

include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include ( '../src/FunGen/fnchourcmp.php');
include ( '../src/FunGen/fnctimecmp.php');
include ( '../src/FunPerPriNiv/pktblot.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
//include ( '../src/FunPerPriNiv/pktbltransaction.php');

function editaot($iRegot, $iRegvaltareot, &$flageditarot,&$campnomb,&$codigo, $codigoot, &$tareottiedur,$lider, $validafalla){
	
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("compactu",6);
	define("fecvalid",7);
	define("errormail",8);
	define("editaEx",9);
	define("errorIng",35);
	define("errorOtini",36);

	$nuconn = fncconn();
	
	if ($iRegot){
		$sbregotarot["ordtracodigo"] = $iRegot["ordtracodigo"];
		$sbregot = dinamicscantareot($sbregotarot,$nuconn);
		$nuCantRow = fncnumreg($sbregot);
		
		if($nuCantRow < 2){
			$iRegtabla["tablnomb"] = "ot";
			$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
			$num = fncnumreg($resulttabla);
	
			for($i=0;$i<$num;$i++){
				$sbregtabla = fncfetch($resulttabla,$i);

				if($sbregtabla[tablnomb] == "ot"){
					$tablcodi = $sbregtabla['tablcodi'];
					break;
				}
			}
			$iRegCampo["tablcodi"] = $tablcodi;
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
	
			while($elementos = each($iRegot)){
				$iRegCampo["campnomb"] = $elementos[0];
				$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
				$num = fncnumreg($resultcampo);
	
				if($num>0){
					$sbregcampo = fncfetch($resultcampo,0);
					
					if($elementos[0] != "ordtracodigo"){
						if($sbregcampo["campnomb"] == $elementos[0]){
							$respuesta = strcmp($sbregcampo["campnotnull"],"t");
							
							if($respuesta == 0){
								if($elementos[1] == ""){
									$campnomb[$elementos[0]] = 1;
									$flageditarot = 1;
									$flagerror = 1;
								}
							}
						}
					}
				}
				$validar = buscacaracter($elementos[1]);
	
				if($validar == 1){
					$flageditarot = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
				$validresult = consulmetaot($elementos[0],$elementos[1],$nuconn);
	
				if ($validresult == 1){
					$flageditarot = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
					unset ($validresult);
				}
				if($validafalla)
				{
					if($elementos[0] == "ordtradescri" && $elementos[1] == null){
						$flageditarot = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
					}
				}
// Comente aqui si quiere editar OT viejas	
	/*			if ($elementos[0] == "ordtrafecini"){
					if ($elementos[1] == ""){
						$campnomb[$elementos[0]] = 1;
						$flageditarot = 1;
						$flagerror = 1;
					}else{
						$actual = date("Y-m-d");
						$valid = datecmp($elementos[1], $actual);
	
						if ($valid == 0){
							$h_actual = date("H:i:s");
							$h_ini = $iRegot["ordtrahorini"];
	
							$valid_h = fnchourcmp($h_ini, $h_actual);
	
							if ($valid_h <= 0){
								fncmsgerror(errorOtini);
								$flageditarot = 1;
								$flagerrotini = 1;
								$flagerror = 1;
							}
						}elseif ($valid < 0){
							fncmsgerror(errorOtini);
							$flageditarot = 1;
							$flagerrotini = 1;
							$flagerror = 1;
						}
					}
				}*/
// Hasta aquí
			}
			
			if($iRegot["ordtrafecfin"]){
				$tareottiedur = fnctimecmp($iRegot["ordtrafecini"],$iRegot["ordtrafecfin"],$iRegot["ordtrahorini"],$iRegot["ordtrahorfin"]);
		
				if($tareottiedur < 0){
					$flageditarot = 1;
					$flagerror = 1;
					$campnomb[ordtrafecini] = 1;
					$campnomb[ordtrafecfin] = 1;
					fncmsgerror(fecvalid);
				}
			}else{
				$flageditarot = 1;
				$flagerror = 1;
				$campnomb[ordtrafecfin] = 1;
			}
			
			while ($elementareot = each($iRegvaltareot)){
				if($elementareot[0] == "tareotnota" && $elementareot[1] == null){
					$flageditarot = 1;
					$flagerror = 1;
					$campnomb[$elementareot[0]] = 1;
				}
			}
			
			if(!$lider){
				$campnomb["lider"] = 1;
				echo "<script language='JavaScript'>";
				echo "alert('Error: Debe asignar un encargado a la orden');";
				echo "</script>";
				//fncmsgerror(errorIng);
				$flagerror = 1;
				$flageditarot = 1;
			}
			
			if($flagerror != 1){
				$result = uprecordot($iRegot,$nuconn);
				if($result < 0 ){
					ob_end_clean();
					fncmsgerror(errorReg);
					$flageditarot=1;
				}else{
					fncmsgerror(editaEx);
				}
			}else{
				fncmsgerror(errorIng);
			}
		}else{
			echo '<script language="Javascript">'."\n";
			echo '<!--//'."\n";
			echo 'alert("El registro no se puede editar desde este componente,\n ya que la orden de trabajo ha sido ejecutada");'."\n";
			echo 'location ="maestablot.php?codigo='.$codigo.';"';
			echo '//-->'."\n";
			echo '</script>';
			$flageditarot=1;
		}
	}
	fncclose($nuconn);
}

if($pasadmerini)
	$ordtrahorini = date('H:i', strtotime($horini.':'.$minini.' pm'));
else
	$ordtrahorini = date('H:i', strtotime($horini.':'.$minini.' am'));
	
if($pasadmerfin)
	$ordtrahorfin = date('H:i', strtotime($horfin.':'.$minfin.' pm'));
else
	$ordtrahorfin = date('H:i', strtotime($horfin.':'.$minfin.' am'));

// Datos de la OT
$usutarcodigo = $codusuariotareot;
$iRegot[ordtracodigo] = $ordtracodigo;
$iRegot[ordtrafecgen] = $ordtrafecgen;
$iRegot[ordtrahorgen] = $ordtrahorgen;
$iRegot[tipmancodigo] = $tipmancodigo;
$iRegot[prioricodigo] = $prioricodigo;
$iRegot[equipocodigo] = $equipocodigo;
$iRegot[tipmedcodigo] = $tipmedcodigo;
$iRegot[sistemcodigo] = $sistemcodigo;
$iRegot[plantacodigo] = $plantacodigo;
$iRegot[partecodigo]  = $partecodigo;
$iRegot[componcodigo] = $componcodigo;
$iRegot[solsercodigo] = $solsercodigo;
$iRegot[ordtradescri] = $ordtradescri;
$iRegot[ordtrafecini] = $ordtrafecini;
$iRegot[ordtrahorini] = $ordtrahorini;
$iRegot[ordtrafecfin] = $ordtrafecfin;
$iRegot[ordtrahorfin] = $ordtrahorfin;
$iRegot[ordtranota]   = $ordtranota;
$iRegot[otcantid] 	  = $otcantid;
$iRegot[ordtratipo]   = $ordtratipo;
$iRegot[ordtraorigen] = $ordtraorigen;
$iRegot[ordtraacti]   = 1;
$iRegot[usuacodi] 	  = $usuacodi;
$iRegot[servicicodigo]= $servicicodigo;
$iRegot[ordtrahistor] = $ordtrahistor;
$iRegot[tipfalcodigo] = $tipfalcodigo;
$iRegot[ordtranumpro] = $ordtranumpro;
$iRegot[ordtraprogen] = $ordtraprogen;

if(!$ordtranumpro || $tipmancodigo == '12')
	$validafalla = 1;

//-- Datos de tareot
$iRegvaltareot[tareacodigo]  = $tareacodigo;
$iRegvaltareot[tiptracodigo] = $tiptracodigo;
$iRegvaltareot[tareotnota]   = $tareotnota;
$iRegvaltareot[prioricodigo] = $prioricodigo;
$iRegvaltareot[otestacodigo] = $otestacodigo;

//-- Datos auxiliares ??????? No se entiende su necesidad
$tareotcodigo = $tareaotcodigo;
$codigoot 	  = $ordtracodigo;
$notatareot	  = $tareotnota;
$tarcodigo	  = $tareacodigo;
$tiptcodigo	  = $tiptracodigo;
$codigotareot = $tareaotcodigo;

//--

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

editaot($iRegot, $iRegvaltareot, $flageditarot ,&$campnomb ,&$codigo, $codigoot, $tareottiedur,$lider,$validafalla);

if (!$flageditarot){
//	include( '../src/FunPerPriNiv/pktblusuariotareot.php'); 
	$idcon = fncconn();
	$declare = 1;
//	include ( 'grabausuariotareot.php');
	//include('editausuariotareot.php');
	include('editatareot.php');
	
	echo '<script language="javascript">';
	echo '<!--//'."\n";
	echo 'location ="maestablot.php?codigo='.$codigo.';"';
	echo '//-->'."\n";
	echo '</script>';
}
?>