<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabareportot
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegreportot         Arreglo de datos.
$flagnuevoreportot    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha 	| Motivo												| Autor 	|
*/
	include ( '../src/FunGen/fncnumprox.php');
	include ( '../src/FunGen/fncnumact.php');
	include ( '../def/tipocampo.php');
	include ( '../src/FunPerPriNiv/pktblreportot.php');
	include ( '../src/FunPerPriNiv/pktbltipomovi.php');
	include ( '../src/FunPerPriNiv/pktblreporotherramie.php');
	include ( '../src/FunPerPriNiv/pktblreportotitem.php');
	include ( '../src/FunPerPriNiv/pktblcampo.php');
	include ( '../src/FunPerPriNiv/pktbltabla.php');
	include ( '../src/FunGen/buscacaracter.php');
	include ( '../src/FunGen/fncmsgerror.php');
	include ('../src/FunGen/fncdatediff.php');
	include ( 'grabatransacreportherramie.php');
	include ( 'grabareporotherramie.php');
	include ( 'grabatransacreportitem.php');
	include ( 'grabareportotitem.php');

	include_once '../src/FunGen/cargainput.php'; 
	include_once '../src/FunPerPriNiv/pktblcierreot.php'; 
	include_once '../src/FunPerPriNiv/pktblot.php';
	include_once '../src/FunPerPriNiv/pktbltareot.php';
	$declare = 1;
	include_once '../src/FunPerPriNiv/pktblusuariotareot.php';
	include_once 'grabausuariotareot2.php';
	
	/**
	 * 
	 * @param $ordtracodigo
	 * @param $flagreportot
	 * @param $tareotnota
	 * @param $usuacodi
	 * @param $otestacodigo
	 * @return unknown_type
	 */
	function grabaintareot($ordtracodigo, $flagreportot, $tareotnota, $usuacodi, $otestacodigo)
	{
		$idcon = fncconn();
			
		$iRegtareot = loadrecordallmaxtareot ( $ordtracodigo, $idcon );
	
		if($flagreportot):
			$iRecordusertareot ['tareotcodigo'] = $iRegtareot['tareotcodigo'];
			$nuResult = dinamicscanusuariotareot ( $iRecordusertareot, $idcon );
				
			if ($nuResult > 0):
				$nuCantRow = fncnumreg( $nuResult );
					
				if ($nuCantRow > 0):
					for($i = 0; $i < $nuCantRow; $i ++):
						$sbRow = fncfetch ( $nuResult, $i );
						$cuadricodigo = $sbRow['cuadricodigo'];
						
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
		
		if($result > 0)
		{
			$nuresult1 = fncnumprox(38, $nuidtemp,$idcon); 
		   		
			
			$iRegusuariotareot[usutarcodigo] = $usutarcodigo;
			$iRegusuariotareot[usuacodi] = $lider;
			$iRegusuariotareot[tareotcodigo] = $codigotareot;
			$iRegusuariotareot[cuadricodigo] = $cuadricodigo;
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
						$iRegusuariotareot[cuadricodigo] = $cuadricodigo;
						$iRegusuariotareot[usutarlider] = 'f';
						
						grabausuariotareot($iRegusuariotareot,$flagnuevousuariotareot,$campnomb);
					}
				}
			}
		}
	}


	/**
	 * 
	 * @param $iRegreportot
	 * @param $flagnuevoreportot
	 * @param $campnomb
	 * @param $reportcodigo
	 * @return unknown_type
	 */
	function grabareportot(&$iRegreportot,&$flagnuevoreportot,&$campnomb,&$reportcodigo)
	{
		$nuconn = fncconn();
		//	No utilice esta parte si va a utilizar la llave primaria como serial
		define("idreportot",60);
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
		
		$nuidtemp = fncnumact(idreportot,$nuconn);
		do
		{
			$nuresult = loadrecordreportot($nuidtemp,$nuconn);
			if($nuresult == e_empty)
			{
				$iRegreportot[reportcodigo] = $nuidtemp;
			}
			$nuidtemp ++;
		}while ($nuresult != e_empty);
	
		if($iRegreportot)
		{
			$iRegtabla["tablnomb"] = "reportot";
			$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
			$num = fncnumreg($resulttabla);
			for($i=0;$i<$num;$i++)
			{
				$sbregtabla = fncfetch($resulttabla,$i);
				if($sbregtabla[tablnomb] == "reportot")
				{
					$tablcodi=$sbregtabla['tablcodi'];
					break;
				}
			}
	
			$iRegCampo["tablcodi"] = $tablcodi;
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			
			while($elementos = each($iRegreportot))
			{
				$iRegCampo["campnomb"] = $elementos[0];
				$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
				$num = fncnumreg($resultcampo);
				if($num>0)
				{
					$sbregcampo = fncfetch($resultcampo,0);
					if($elementos[0] != "reportcodigo")
					{
						if($sbregcampo["campnomb"] == $elementos[0])
						{
							$respuesta = strcmp($sbregcampo["campnotnull"],"t");
							if($respuesta == 0)
							{
								if($elementos[1] == "")
								{
									$campnomb[$elementos[0]] = 1;
									$flagnuevoreportot = 1;
									$flagerror = 1;
								}
							}
						}
					}
				}
				$validar = buscacaracter($elementos[1]);
	
				if($validar == 1)
				{
					$flagnuevoreportot = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
				$validresult = consulmetareportot($elementos[0],$elementos[1],$nuconn);
	
				if($validresult == 1)
				{
					$flagnuevoreportot = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
					unset ($validresult);
				}
				
				if (($elementos[0] == "ordtracodigo") && ($elementos[1] == ""))
				{
					$flagnuevoreportot = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			}
	
			if($flagerror == 1)
			{
				fncmsgerror(errorIng);
			}
				
			if($flagerror != 1)
			{
				$result = insrecordreportot($iRegreportot,$nuconn);
				if($result < 0 )
				{
					ob_end_clean();
					fncmsgerror(errorReg);
					$flagnuevoreportot=1;
				}
				if($result > 0)
				{
	
					$reportcodigo = $iRegreportot[reportcodigo];
					$nuresult1 = fncnumprox(idreportot,$nuidtemp,$nuconn);
					//No utilice esta parte si va a utilizar la llave primaria como serial
					fncmsgerror(grabaEx);
				}
				fncclose($nuconn);
			}
		}
	}


	if($ordtraparada1)
	{
		include '../src/FunPerPriNiv/pktblparaprod.php';
		$idcon = fncconn();
		$rs_paraprod = loadrecordparaprodot($ordtracodigo, $idcon);
		
		if($rs_paraprod > 0)
		{
			if($pasadpromerfin)
				$fechorafin = date('Y-m-d H:i', strtotime($parprofecfin.' '.$horprofin.':'.$minprofin.' pm'));
			else
				$fechorafin = date('Y-m-d H:i', strtotime($parprofecfin.' '.$horprofin.':'.$minprofin.' am'));
				
			$duracparaprod = datediff('n', $rs_paraprod['parprofecini'].' '.$rs_paraprod['parprohorini'], $fechorafin, false);
			
			if($duracparaprod > 0)
			{
				$datefinpara = explode(' ', $fechorafin);
				
				$iRegparaprod [parprofecfin] = $datefinpara[0];
				$iRegparaprod [parprohorfin] = $datefinpara[1];
				$iRegparaprod [parprocodigo] = $rs_paraprod['parprocodigo'];
				
				$idcon = fncconn();
				$result = uprecordparaproddateend($iRegparaprod, $idcon);
			}
			else
				$flagnuevoparaprod = 1;
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
	
		if(!$flagnuevoreportot)
		{
			$idcon = fncconn();
			$flagreportot = true;
			$otestacodigo = cargaotestadotipo(4, $idcon);
			$tareotnota = $reportdescri.' - [Orden Reportada]';
	
			grabaintareot($ordtracodigo, $flagreportot, $tareotnota, $usuacodi, $otestacodigo);
			
			
			$idcon = fncconn();
			$nuidtemp = fncnumact(58,$idcon);  // Tabla numerado [numecodi = 58 / cierreot]
			do 
			{ 
				$nuresult = loadrecordcierreot($nuidtemp,$idcon); 
				if($nuresult == e_empty) 
					$iRegcierreot[cierotcodigo] = $nuidtemp; 
				$nuidtemp ++; 
			}while ($nuresult != e_empty); 
			
			$iRegcierreot[usuacodi] = $usuacodi; 
			$iRegcierreot[tipcumcodigo] = $tipcumcodigo; 
			$iRegcierreot[reportcodigo] = $reportcodigo; 
			$iRegcierreot[cierotfecfin] = date('Y-m-d'); 
			$iRegcierreot[cierothorfin] = date('H:i'); 
			$iRegcierreot[cierotdescri] = $reportdescri;
			$iRegcierreot[ordtracodigo] = $ordtracodigo;
			$iRegcierreot[cierotfecgen] = date('Y-m-d');
			$iRegcierreot[cierothorgen] = date('H:i');
			
			$result = insrecordcierreot($iRegcierreot,$idcon);
			
			$nuresult1 = fncnumprox(58,$nuidtemp,$idcon);
			$flagreportot = true;
			$otestacodigo = cargaotestadotipo(5, $idcon);
			$tareotnota = $reportdescri.' - [Orden Cerrada]';
			
			grabaintareot($ordtracodigo, $flagreportot, $tareotnota, $usuacodi, $otestacodigo);
			
			//		 Correos
			include '../src/FunPHPMailer/mail.send.php';
			include_once '../src/FunPerPriNiv/pktblot.php';
			include_once '../src/FunPerPriNiv/pktblsoliserv.php';
			include_once '../src/FunPerPriNiv/pktblusuario.php';
			
			$idcon = fncconn();
			$mails = array();
			
			$rsOt = loadrecordot($ordtracodigo, $idcon);
			if($rsOt['solsercodigo'])
			{ 
				$rsSoliserv = loadrecordsoliserv($rsOt['solsercodigo'], $idcon);
				$rsUsuario = loadrecordusuario($rsSoliserv['usuacodi'], $idcon);
				if($rsUsuario['usuaemail']) $mails[] = $rsUsuario['usuaemail'];
			}
			
			$rsUsuario = loadrecordusuario($rsOt['usuacodi'], $idcon);
			if($rsUsuario['usuaemail']) $mails[] = $rsUsuario['usuaemail'];
		
			$data = array('cierotcodigo' => $iRegcierreot[cierotcodigo], 'usuacodi' => $usuacodi, 'cierotdescri' => $reportdescri,
				'reportcodigo' => $reportcodigo, 'reportdescri' => $reportdescri );
			
			send_mail('reportot', $data, $mails, $arrParametros);
			send_mail('cierreot', $data, $mails, $arrParametros);
			//Correos
		
			unset($ordtracodigo, $reloadot);
		}
	}