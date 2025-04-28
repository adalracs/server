<?php 
	include_once '../src/FunGen/fncnumprox.php'; 
	include_once '../src/FunGen/fncnumact.php'; 
	include_once '../src/FunGen/cargainput.php'; 
	include_once ( '../src/FunGen/fncmsgerror.php');
	include_once ('../src/FunGen/fncdatediff.php');
	//-----

	include_once '../src/FunPerPriNiv/pktblnumerado.php'; 
	include_once '../src/FunPerPriNiv/pktblcierreot.php'; 
	include_once '../src/FunPerPriNiv/pktblot.php';
	include_once ('../src/FunPerPriNiv/pktblotestado.php');
	include_once '../src/FunPerPriNiv/pktblreportot.php';
	include_once '../src/FunPerPriNiv/pktbltareot.php';
	$declare = 1;
	include_once 'grabausuariotareot2.php';
	include_once ('../src/FunPerPriNiv/pktblusuariotareot.php');
	
	
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
	
	
	
	if($flagnuevoparaprod)
	{
		fncmsgerror ( 43 );
		$flagnuevoreportot = 1;
	}
	else
	{
		if($pasadmerini)
			$reporthora = date('H:i', strtotime($horini.':'.$minini.' pm'));
		else
			$reporthora = date('H:i', strtotime($horini.':'.$minini.' am'));
		
		$reporttiedur = datediff('h', $ordtrafecini.' '.$ordtrahorini, $reportfecha.' '.$reporthora, false);
	
		if($reporttiedur < 0)
		{
			echo "<script language='JavaScript'>";
			echo "alert('Error: La fecha de Reporte no puede ser menor a la fecha de inicio de la Orden de Trabajo');";
			echo "</script>";
			$flagnuevoreportot = 1;
		}
		else
		{
			//$iRegreportot[reportcodigo] = $reportcodigo;
			$iRegreportot[ordtracodigo] = $ordtracodigo;
			$iRegreportot[tipmancodigo] = $tipmancodigo;
			$iRegreportot[prioricodigo] = $prioricodigo;
			$iRegreportot[tiptracodigo] = $tiptracodigo;
			$iRegreportot[tareacodigo] = $tareacodigo;
			$iRegreportot[reportfecha] = $reportfecha;
			$iRegreportot[reporttiedur] = $reporttiedur;
			$iRegreportot[reportdescri] = $reportdescri;
			$iRegreportot[reporthora] = $reporthora;
			
			grabareportot($iRegreportot,$flagnuevoreportot,$campnomb,$reportcodigo);
			
			
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
	$otestacodigo = cargaotestadotipo(5, $idcon);
	$tareotnota = $descri.' - [Orden Cerrada]';
	
	grabaintareot($ordtracodigo, $flagreportot, $tareotnota, $usuacodi, $otestacodigo);
	
	if($result < 0)
		echo 'err';
	else
		echo 'sucess';
		
		
		
if($flagnuevoparaprod)
{
	fncmsgerror ( 43 );
	$flagnuevoreportot = 1;
}
else
{
	if($pasadmerini){
		if($horini != 12)
			$reporthora = ($horini + 12).":".$minini;
	}
	elseif($horini == 12)
			$reporthora = "00:".$minini;
	else
		$reporthora = $horini.":".$minini;
	
	$reporttiedur = datediff('h', $ordtrafecini.' '.$ordtrahorini, $reportfecha.' '.$reporthora, false);


	if($reporttiedur < 0)
	{
		echo "<script language='JavaScript'>";
		echo "alert('Error: La fecha de Reporte no puede ser menor a la fecha de inicio de la Orden de Trabajo');";
		echo "</script>";
		$flagnuevoreportot = 1;
	}
	else
	{
		//$iRegreportot[reportcodigo] = $reportcodigo;
		$iRegreportot[ordtracodigo] = $ordtracodigo;
		$iRegreportot[tipmancodigo] = $tipmancodigo;
		$iRegreportot[prioricodigo] = $prioricodigo;
		$iRegreportot[tiptracodigo] = $tiptracodigo;
		$iRegreportot[tareacodigo] = $tareacodigo;
		$iRegreportot[reportfecha] = $reportfecha;
		$iRegreportot[reporttiedur] = $reporttiedur;
		$iRegreportot[reportdescri] = $reportdescri;
		$iRegreportot[reporthora] = $reporthora;
		
		grabareportot($iRegreportot,$flagnuevoreportot,$campnomb,$reportcodigo);
	}
	//si el registro de reportot fue grabado con exito
	
	
	if(!$flagnuevoreportot)
	{
		//Cambio de estado a reportada en tareot
		include_once ('../src/FunPerPriNiv/pktblotestado.php');
		$flagreportot = true;
		$idcon = fncconn();
		$sbregot['ordtracodigo'] = $ordtracodigo; 
		$otestacodigo = cargaotestadotipo(4, $idcon);
		$tareotnota = $reportdescri.' - [Orden Reportada]';
		
		include ('grabatareot.php');
		include ('grabadocureporte.php');
		
//		unset($ordtracodigo);
		
//		if($ordtraparada)
//		{
//			$parprodescri = 'Parada generada por orden de trabajo No. '.$ordtracodigo;
//			$parprofecgen = date('Y-m-d');
//			$parprohorgen = date('H:i');
//			$ordtracodigo = $ordtracodigo;
//			
//			if($pasadpromerini){
//				if($horproini != 12)
//					$parprohorini = ($horproini + 12).":".$minproini;
//			}
//			elseif($horproini == 12)
//					$parprohorini = "00:".$minproini;
//			else
//				$parprohorini = $horproini.":".$minproini;
//			include('grabaparaprod.php');
//		}
		
		unset($ordtracodigo, $reloadot);
		
		//graba las transacciones de las herramientas
		$arreglo_herr = explode(",",$loadherram);
		$num = count($arreglo_herr);
		unset($idcon);
		for($i=0;$i<$num;$i++)
		{
			$idcon = fncconn();
			$arreglo_herr1 = explode("-",$arreglo_herr[$i]);
			$herramcodigo = trim($arreglo_herr1[0]);
			if($herramcodigo)
			{
				unset($sbregherramie);
				$sbregherramie = loadrecordherramie($herramcodigo,$idcon);
				if($sbregherramie>0)
				{
					$transhercanti = trim($arreglo_herr1[1]);
					$tipmovcodigo = 1;
					$transherfecha = date("Y-m-d");
					$herramvalor = $sbregherramie["herramvalor"];
					$usuacodi = $GLOBALS['usuacodi'];
					$herramdispon = $sbregherramie["herramdispon"];
	
					$transhertotal = $transhercanti * $herramvalor;
					$iRegtransacherramie[transhercodigo] = $transhercodigo;
					$iRegtransacherramie[tipmovcodigo] = $tipmovcodigo;
					$iRegtransacherramie[herramcodigo] = $herramcodigo;
					$iRegtransacherramie[transherfecha] = $transherfecha;
					$iRegtransacherramie[transhercanti] = $transhercanti;
					$iRegtransacherramie[transhertotal] = $transhertotal;
					$iRegtransacherramie[usuacodi] = $usuacodi;
	
					$iRegvalidaherramie[tipmovcodigo] = $tipmovcodigo;
					$iRegvalidaherramie[transhercanti] = $transhercanti;
					$iRegvalidaherramie[herramcodigo] 	= $herramcodigo;
					$iRegvalidaherramie[herramdispon] = $herramdispon;
					grabatransacreportherramie($iRegtransacherramie,$iRegvalidaherramie,
					$flagnuevotransacherramie,$campnomb,$arrtransher,$transhercodigo);
					if($reportcodigo && $transhercodigo)
					{
						$iRegreporotherramie[reportcodigo] = $reportcodigo;
						$iRegreporotherramie[transhercodigo] = $transhercodigo;
						grabareporotherramie($iRegreporotherramie,$flagnuevoreporotherramie,$campnomb);
					}
				}
			}
			fncclose($idcon);
		}
		
		//graba las transacciones de los items	
		$arreglo_item = explode(",",$loaditem1);
		$num = count($arreglo_item);
		unset($idcon);
		for($i=0;$i<$num;$i++)
		{
			$idcon = fncconn();
			$arreglo_item1 = explode("-",$arreglo_item[$i]);
			$itemcodigo = trim($arreglo_item1[0]);
			$cantidad = trim($arreglo_item1[1]);
			if($itemcodigo!="")
			{
				unset($sbregitem);
				$sbregitem = loadrecorditem($itemcodigo,$idcon);
				if($sbregitem>0)
				{
					$transitecanti = $cantidad;
					$tipmovcodigo = 1;
					$transitefecha = date("Y-m-d");
					$usuacodi = $GLOBALS['usuacodi'];
	
					//
					$transitetotal = $transitecanti * $sbregitem['itemvalor'];
					$iRegtransacitem[transitecodigo] = $transitecodigo;
					$iRegtransacitem[tipmovcodigo] = $tipmovcodigo;
					$iRegtransacitem[itemcodigo] = $itemcodigo;
					$iRegtransacitem[transitefecha] = $transitefecha;
					$iRegtransacitem[transitecantid] = $transitecanti;
					$iRegtransacitem[transitetotal] = $transitetotal;
					$iRegtransacitem[usuacodi] = $usuacodi;
	
					$iRegvalidaitem[itemcodigo] = $itemcodigo;
					$iRegvalidaitem[itemcanmin] = $sbregitem['itemcanmin'];
					$iRegvalidaitem[itemcanmax] = $sbregitem['itemcanmax'];
					$iRegvalidaitem[itemdispon] = $sbregitem['itemdispon'];
					grabatransacreportitem($iRegtransacitem,$iRegvalidaitem,$flagnuevotransacitem,$campnomb,
					$transitecodigo);
					if(!$flagnuevotransacitem)
					{
						$iRegreporotitem[reportcodigo] = $reportcodigo;
						$iRegreporotitem[transitecodigo] = $transitecodigo;
						grabareportotitem($iRegreporotitem,$flagnuevoreporotitem,$campnomb);
					}
				}
			}
			fncclose($idcon);
		}
		
		if($flagnuevotransacherramie || $flagnuevotransacitem)
		{
			$nuconn = fncconn();
			$nuResult = delrecordreportot($reportcodigo,$nuconn);
			$sbregnumerado = loadrecordnumerado(idreportot,$nuconn);
			$numeprox = $sbregnumerado[numeprox]-1;
			$sbregnumerado[numeprox] = $numeprox;
			$nuResultupdate = uprecordnumerado($sbregnumerado,$nuconn);
			$i = $num;
			fncclose($nuconn);
		}
	}
}
?>