<?php 
	ini_set('display_errors',1);
	date_default_timezone_set('America/Bogota');
	$ajax = 1;
	$noinclude = 1;
	include_once '../../FunPerSecNiv/fncconn.php';
	include_once '../../FunPerSecNiv/fncclose.php';
	include_once '../../FunPerSecNiv/fncnumreg.php';
	include_once '../../FunPerSecNiv/fncfetch.php';
	include_once '../../FunGen/fncnumprox.php'; 
	include_once '../../FunGen/fncnumact.php'; 
	include_once '../../FunGen/cargainput.php'; 
	//-----

	include_once '../../FunPerPriNiv/pktblnumerado.php'; 
	include_once '../../FunPerPriNiv/pktblcierreot.php'; 
	include_once '../../FunPerPriNiv/pktblot.php';
	include_once ('../../FunPerPriNiv/pktblotestado.php');
	include_once '../../FunPerPriNiv/pktblreportot.php';
	include_once '../../FunPerPriNiv/pktbltareot.php';
	$declare = 1;
	include_once '../../../bin/grabausuariotareot2.php';
	include_once ('../../FunPerPriNiv/pktblusuariotareot.php');
	
	
	function grabaintareot($ordtracodigo, $flagreportot, $tareotnota, $usuacodi, $otestacodigo)
	{
		$idcon = fncconn();
			
		$iRegtareot = loadrecordallmaxtareot ( $ordtracodigo, $idcon );
	
		if($flagreportot):
			$iRecordusertareot ['tareotcodigo'] = $iRegtareot['tareotcodigo'];
			$nuResult = dinamicscanusuariotareot ( $iRecordusertareot, $idcon );
				
			if ($nuResult > 0):
				$nuCantRow = pg_numrows ( $nuResult );
					
				if ($nuCantRow > 0):
					for($i = 0; $i < $nuCantRow; $i ++):
						$sbRow = pg_fetch_row ( $nuResult, $i );
					
						if ($sbRow [3] == 't'):
							$lider = $sbRow[1];
						else:
							if(!$arreglo_tecnic)
								$arreglo_tecnic = $sbRow[1];
							else
								$arreglo_tecnic .= ','.$sbRow[1];
						endif;
					endfor;
				endif;
			endif;
		endif;
		
		$iRegtareot['tareotcodigo'] = $tareotcodigo; 
		$iRegtareot['ordtracodigo'] = $ordtracodigo; 
		$iRegtareot['tareotnota']   = $tareotnota; 
		$iRegtareot['tareothorini'] = date('H:i'); 
		$iRegtareot['tareotfecini'] = date('Y-m-d');
		$iRegtareot['tareothorfin'] = $tareothorfin; 
		$iRegtareot['tareotfecfin'] = $tareotfecfin; 
		$iRegtareot['tareotfin'] = $tareotfin; 
		$iRegtareot['usuacodi'] = $usuacodi;
		$iRegtareot['otestacodigo'] = $otestacodigo;
		$iRegtareot['tareotsecuen'] = $iRegtareot['tareotsecuen'] + 1;
		$iRegtareot['tareotfecgen'] = date('Y-m-d'); 
		$iRegtareot['tareothorgen'] = date('H:i'); 
		
	   	$nuidtemp = fncnumact(38,$idcon); 
		do 
		{ 
			$nuresult = loadrecordtareot($nuidtemp,$idcon); 
			
			if($nuresult == e_empty) 
			{ 
				$iRegtareot[tareotcodigo] = $nuidtemp; 
				$codigotareot = $iRegtareot[tareotcodigo];
			} 
			$nuidtemp ++; 
		}while ($nuresult != e_empty); 

	
		$result = insrecordtareot($iRegtareot,$idcon);
		$nuresult1 = fncnumprox(38, $nuidtemp,$idcon); 
	   		
		
		$iRegusuariotareot[usutarcodigo] = $usutarcodigo;
		$iRegusuariotareot[usuacodi] = $lider;
		$iRegusuariotareot[tareotcodigo] = $codigotareot;
		$iRegusuariotareot[usutarlider] = 't';
	
		grabausuariotareot($iRegusuariotareot,$flagnuevousuariotareot,$campnomb);
		
		if($arreglo_tecnic)
		{
			$valposic = explode(",",$arreglo_tecnic);
			
			$numposic = count($valposic);
			for($i = 0; $i < $numposic; $i++)
			{
				unset($iRegusuariotareot);
				
				if($valposic[$i] != $lider)
				{
					$iRegusuariotareot[usutarcodigo] = $emptarcodigo;
					$iRegusuariotareot[usuacodi] = $valposic[$i];
					$iRegusuariotareot[tareotcodigo] = $codigotareot;
					$iRegusuariotareot[usutarlider] = 'f';
					
					grabausuariotareot($iRegusuariotareot,$flagnuevousuariotareot,$campnomb);
				}
			}
		}
	}
	
	$idcon = fncconn();
	
	$irecOrden["ordtracodigo"] = $ordtracodigo;
	$irecOrdenop["ordtracodigo"] = '=';
	$sbregReportot = dinamicscanopreportot($irecOrden,$irecOrdenop, $idcon);
	$numreg = fncnumreg($sbregReportot);
	
	$reporte = fncfetch($sbregReportot, 0);
	$reportcodigo = $reporte[reportcodigo];

	
	$nuidtemp = fncnumact(58,$idcon);  // Tabla numerado [numecodi = 58 / cierreot]

	do 
	{ 
		$nuresult = loadrecordcierreot($nuidtemp,$idcon); 
		if($nuresult == e_empty) 
			$iRegcierreot[cierotcodigo] = $nuidtemp; 
		$nuidtemp ++; 
	}while ($nuresult != e_empty); 

	
	$iRegcierreot[usuacodi] = $usuacodi; 
	$iRegcierreot[tipcumcodigo] = $cumpli; 
	$iRegcierreot[reportcodigo] = $reportcodigo; 
	$iRegcierreot[cierotfecfin] = date('Y-m-d');//$cierotfecfin; 
	$iRegcierreot[cierothorfin] = date('H:i');//$cierothorfin; 
	$iRegcierreot[cierotdescri] = $descri;
	$iRegcierreot[ordtracodigo] = $ordtracodigo;
	$iRegcierreot[cierotfecgen] = date('Y-m-d');
	$iRegcierreot[cierothorgen] = date('H:i');
	
	$result = insrecordcierreot($iRegcierreot,$idcon);
	
	$flagreportot = true;
//	$otestacodigo = cargaotestadotipo(5, $idcon);
	$otestacodigo = 18; // Estado fijo para cerrado
	$tareotnota = $descri.' - [Orden Cerrada]';
	
	grabaintareot($ordtracodigo, $flagreportot, $tareotnota, $usuacodi, $otestacodigo);
	
	if($result < 0)
		echo 'err';
	else
		echo 'sucess';