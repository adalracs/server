<?php
	include ("../src/FunGen/fncsumdate.php");
	include ( '../src/FunGen/fncnumprox.php');
	include ( '../src/FunGen/fncnumact.php');
	include ( '../src/FunPerPriNiv/pktblcuadrillausuario.php');
	//include ( '../src/FunPerPriNiv/pktblusuariotareot.php');
	
	if(!$nota || !$rango || !$fecha_agen){
		echo '<SCRIPT LANGUAGE="JavaScript">alert("Algunos campos se encuentra vacios. Por favor llene los campos marcados por *");</script>';
		$flagnuevotareot=1;
	}else{

		if($rango != 19)
			$tareottiedur = 2;
		else
			$tareottiedur = 12;
						
		$datefin = fncsumdate($fecha_agen, $rango.":00", $tareottiedur);
		$dateotfin = explode("/",$datefin);
		$ordtrahorini = $rango.":00";
	
		$idcoon = fncconn();
		$tareotsecuen = loadrecordtareotsecuen($ordtracodigo,$idcoon); 
		
			$nuidtemp = fncnumact(38,$idcoon); 
			do{ 
				$nuresult = loadrecordtareot($nuidtemp,$idcoon); 
				if($nuresult == e_empty) 
				{ 
					$iRegtareot[tareotcodigo] = $nuidtemp; 
					$codigotareot = $iRegtareot[tareotcodigo];
				} 
				$nuidtemp ++; 
			}while ($nuresult != e_empty); 
	
		
		$iRegtareot[ordtracodigo] = $ordtracodigo; 
		$iRegtareot[tareacodigo]  =  $sbreg[tareacodigo] ; 
		$iRegtareot[tiptracodigo] = $tiptracodigo; 
		$iRegtareot[operaccodigo] = $operaccodigo; 
		$iRegtareot[tareottiedur] = $tareottiedur; 
		$iRegtareot[tareotnota]   = $nota; 
		$iRegtareot[progracodigo] = $codigoprog; 
		$iRegtareot[tareothorini] = $ordtrahorini; 
		$iRegtareot[tareotfecini] = $fecha_agen; 
		$iRegtareot[tareothorfin] = $dateotfin[1]; 
		$iRegtareot[tareotfecfin] =$dateotfin[0]; 
		$iRegtareot[tareotsecuen] = $tareotsecuen+1; 
		$iRegtareot[tareotfin] = $tareotfin; 
		$iRegtareot[usuacodi] = $codud; 
		$iRegtareot[otestacodigo] = 3; 
		$iRegtareot[prioricodigo] = $sbreg[prioricodigo]; 
		$iRegtareot[tipcumcodigo] = $tipcumcodigo;
		$iRegtareot[tareotfecgen] = date("Y-m-d");
		$iRegtareot[tareothorgen] = date("H:i");
		if($ccuadrilla)
			$iRegtareot[tareotusuasi] = 't';
		else
			$iRegtareot[tareotusuasi] = 'f';
		
		
		$iRegtareotusuasi[tareotusuasi] = "f";
		$iRegtareotusuasi[ordtracodigo] = $ordtracodigo;
		uprecordtareotusuasi( $iRegtareotusuasi,$idcoon);
		
		$result = insrecordtareot($iRegtareot,$idcoon);
		$nuresult1 = fncnumprox(38,$codigotareot,$idcoon);

		//grabatareot($iRegtareot,$flagnuevotareot,$flagnuevoot,$campnomb,$codigotareot,$flagotinicial); 	
	}

	if(!$flagnuevotareot){
		if($ccuadrilla){
			$idcon = fncconn();
			$sbusucuadrilla = loadrecordcuadrillausuariousuario($ccuadrilla,$idcon);
			
			for($i = 0; $i < (count($sbusucuadrilla)); $i++){
				if($sbusucuadrilla[$i][cuausulider] == 't'){
					$empleacod = $sbusucuadrilla[$i][usuacodi];
				}else{
					if(!$arreglo_auxdef)
						$arreglo_auxdef = $sbusucuadrilla[$i][usuacodi];
					else 
						$arreglo_auxdef = $arreglo_auxdef.",".$sbusucuadrilla[$i][usuacodi];
				}
			}
			include('grabausuariotareot.php');
		}
		
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'alert(\'Grabado exitoso\');'."\n";
		echo 'location = "maestablagendadespacho.php?codigo='.$codigo.'";';
		echo '//-->'."\n";
		echo '</script>';
	}


?>
