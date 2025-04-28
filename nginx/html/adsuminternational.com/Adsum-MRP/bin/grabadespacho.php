<?php
	include ("../src/FunGen/fncsumdate.php");
	include ( '../src/FunGen/fncnumprox.php');
	include ( '../src/FunGen/fncnumact.php');
	include ( '../src/FunPerPriNiv/pktblcuadrillausuario.php');
	//include ( '../src/FunPerPriNiv/pktblusuariotareot.php');
	
	if(!$nota || !$clientfecsol || !$tipo_despacho){
		echo '<SCRIPT LANGUAGE="JavaScript">alert("Error:\n Algunos campos se encuentra vacios.\n Por favor llene los campos marcados por *");</script>';
		$flagnuevotareot=1;
	}else{

		$foo1 = explode(":",$horini.":".$minini);
		
		
		if($pasadmerini){
			if($foo1[0] != 12)
				$ordtrahorini = ($foo1[0] + 12).":".$foo1[1];
		}elseif($foo1[0] == 12){
			$ordtrahorini = "00:".$foo1[1];
		}else{
			$ordtrahorini = $foo1[0].":".$foo1[1];
		}
		
		$dateini = strtotime($ordtrafecgen." ".$ordtrahorgen);
		$dateact = strtotime($clientfecsol. " ".$ordtrahorini);
		$df = $dateact - $dateini ;
		$datedif = round($df/60/60);
		
		if($datedif < 0){
			echo '<SCRIPT LANGUAGE="JavaScript">alert("Error:\n La fecha de despacho debe ser mayor a la fecha de carga");</script>';
			$flagnuevotareot=1;
		}else{
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
			$iRegtareot[tareotfecini] = $clientfecsol; 
			$iRegtareot[tareotsecuen] = $tareotsecuen + 1; 
			$iRegtareot[tareotfin] = $tareotfin; 
			$iRegtareot[usuacodi] = $codud; 
			$iRegtareot[otestacodigo] = 4; 
			$iRegtareot[prioricodigo] = $sbreg[prioricodigo]; 
			$iRegtareot[tipcumcodigo] = $tipcumcodigo;
			$iRegtareot[tareotfecgen] = date("Y-m-d");
			$iRegtareot[tareothorgen] = date("H:i");
			
			$result = insrecordtareot($iRegtareot,$idcoon);
			$nuresult1 = fncnumprox(38,$codigotareot,$idcoon);
	
			$nuResult = pg_exec($idcoon,"INSERT INTO tipodestareot VALUES(".$tipo_despacho.",".$codigotareot.");"); 
			
		
		
			
			echo '<script language="javascript">';
			echo '<!--//'."\n";
			echo 'alert(\'Grabado exitoso\');'."\n";
			echo 'location = "maestablagendadespacho.php?codigo='.$codigo.'";';
			echo '//-->'."\n";
			echo '</script>';
		}
	}


?>
