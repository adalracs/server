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
	include_once '../src/FunPerPriNiv/pktblotestado.php'; 
	include_once '../src/FunPerPriNiv/pktblot.php';
	include_once '../src/FunPerPriNiv/pktblreportottermo.php';
	include_once 'grabadocureporte.php';
	include_once '../src/FunPerPriNiv/pktbltareot.php';
	$declare = 1;
	include_once '../src/FunPerPriNiv/pktblusuariotareot.php';
	include_once 'grabausuariotareot2.php';
	include_once '../src/FunGen/fncformat.php';
	
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
				}
				fncclose($nuconn);
			}
		}
	}

	/** Ordenes de trabajo programadas :: Excepcion para Termografias ;::*/
	$idcon = fncconn();
	$sbSqlListOT = "SELECT * FROM ot LEFT JOIN tareot ON tareot.ordtracodigo = ot.ordtracodigo AND tareot.tareotsecuen = '0' WHERE ot.ordtranumpro = '{$ordtranumpro}'";
	$rsOts = fncsqlrun($sbSqlListOT, $idcon);
	$nrOts = fncnumreg($rsOts);
	/** Ordenes de trabajo programadas :: Excepcion para Termografias ;::*/
	
	for($a = 0; $a < $nrOts; $a++):
		$rwOts = fncfetch($rsOts, $a);
		$reporttiedur = datediff('h', $rwOts['ordtrafecini'].' '.$rwOts['ordtrahorini'], date("Y-m-d H:i"), false);
		$ordtracodigo = $rwOts['ordtracodigo'];
		
		/**MedTermografia**/
		$TAot = 'TAot'.$rwOts['ordtracodigo'];
		$FAot = 'FAot'.$rwOts['ordtracodigo'];
		$FBot = 'FBot'.$rwOts['ordtracodigo'];
		$FCot = 'FCot'.$rwOts['ordtracodigo'];
		$D1v = 'D1v'.$rwOts['ordtracodigo'];
		$D2v = 'D2v'.$rwOts['ordtracodigo'];
		$uploadocumen = 'uploadocumen'.$rwOts['ordtracodigo'];
		
		if($$D1v > 0 || $$D2v > 0):
			$reportdescri = <<<ADSUMDES
Novedad TERMOGRAFIA:
TA: {$$TAot}
FA: {$$FAot}
FB: {$$FBot}
FC: {$$FCot}

DELTA 1: {$$D1v}
DELTA 2: {$$D2v}

ADSUMDES;
			$flagtermografia = 1;
		else:
			$reportdescri = 'SIN NOVEDAD';
		endif;
		/**MedTermografia**/
		
		if($reporttiedur < 0)
			$reporttiedur = 1;
		
		$Fecha = date("Y-m-d/H:i", strtotime($rwOts['ordtrafecini'].' '.$rwOts['ordtrahorini'].' + '.$reporttiedur.' hours'));
		$reporthorfec = explode('/', $Fecha);
			
		//$iRegreportot[reportcodigo] = $reportcodigo;
		$iRegreportot[ordtracodigo] = $ordtracodigo;
		$iRegreportot[tipmancodigo] = $rwOts['tipmancodigo'];
		$iRegreportot[prioricodigo] = $rwOts['prioricodigo'];
		$iRegreportot[tiptracodigo] = $rwOts['tiptracodigo'];
		$iRegreportot[tareacodigo] = $rwOts['tareacodigo'];
		$iRegreportot[reportfecha] = $reporthorfec[0];
		$iRegreportot[reporttiedur] = $reporttiedur;
		$iRegreportot[reportdescri] = $reportdescri;
		$iRegreportot[reporthora] = $reporthorfec[1];
		
		grabareportot($iRegreportot,$flagnuevoreportot,$campnomb,$reportcodigo);
	
		if(!$flagnuevoreportot)
		{
			$idcon = fncconn();
			$flagreportot = true;
			$otestacodigo = cargaotestadotipo(4, $idcon);
			$tareotnota = $reportdescri.' - [Orden Reportada]';
			grabaintareot($ordtracodigo, $flagreportot, $tareotnota, $usuacodi, $otestacodigo);
			
			
			if($$uploadocumen)
			{
				$arrDocument = explode("::",$$uploadocumen);
				
				for($a = 0; $a < count($arrDocument); $a++)
				{
					$iRegdocureporte[reportcodigo] = $reportcodigo;
					$iRegdocureporte[docrepnombre] = $arrDocument[$a];
					grabadocureporte($iRegdocureporte, $flagnuevodocureporte, $usuacodi);
				}
				deleteRecursive('../doc/upload/temp'.$usuacodi.'/');
			}
			
			
			if($flagtermografia)
			{
				$iRegreportottermo[reportcodigo] = $reportcodigo;
				$iRegreportottermo[reptertemamb] = unfmtCurrency($$TAot);
				$iRegreportottermo[repterfasea] = unfmtCurrency($$FAot);
				$iRegreportottermo[repterfaseb] = unfmtCurrency($$FBot);
				$iRegreportottermo[repterfasec] = unfmtCurrency($$FCot);
				
				$result = insrecordreportottermo($iRegreportottermo, $idcon);
			}
			else
			{
				$idcon = fncconn();
				$nuidtemp = fncnumact(58,$idcon);  // Tabla numerado [numecodi = 58 / cierreot]
				do 
				{ 
					$nuresult = loadrecordcierreot($nuidtemp,$idcon); 
					if($nuresult == e_empty) 
						$iRegcierreot[cierotcodigo] = $nuidtemp; 
					$nuidtemp ++; 
				}while ($nuresult != e_empty); 
				
				$tipcumcodigo = 4;	//Tipo cumplimineto Code 4 => Ejecutado - Sin novedad
				
				$iRegcierreot[usuacodi] = $usuacodi; 
				$iRegcierreot[tipcumcodigo] = $tipcumcodigo; 
				$iRegcierreot[reportcodigo] = $reportcodigo; 
				$iRegcierreot[cierotfecfin] = $reporthorfec[0]; 
				$iRegcierreot[cierothorfin] = $reporthorfec[1]; 
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
				unset($ordtracodigo, $reloadot);
			}
		}
	endfor;
	
	echo '<script language="Javascript">'."\n";
	echo '<!--//'."\n";
	echo 'alert("Grabado Exitoso");'."\n";
	echo 'location ="maestablotp.php?codigo='.$codigo.';"';
	echo '//-->'."\n";
	echo '</script>';