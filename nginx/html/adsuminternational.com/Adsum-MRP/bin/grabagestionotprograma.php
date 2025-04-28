<?php

/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabaotprograma
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$arr_regot         Arreglo de datos.
Retorno         :
true	= 1
false	= 0
Autor           : cbedoya
Fecha           : 12-oct-2007
Historial de modificaciones
| Fecha     | Motivo				| Autor 	|
*/
	include_once( '../src/FunGen/fncnumprox.php');
	include_once( '../src/FunGen/fncnumact.php');
	include_once ( '../def/tipocampo.php');
	include_once ( '../src/FunPerPriNiv/pktblreportot.php');
	include_once ( '../src/FunPerPriNiv/pktbltipomovi.php');
	include_once ( '../src/FunPerPriNiv/pktblreporotherramie.php');
	include_once ( '../src/FunPerPriNiv/pktblreportotitem.php');
	include_once ( '../src/FunPerPriNiv/pktblcampo.php');
	include_once ( '../src/FunPerPriNiv/pktbltabla.php');
	include_once ( '../src/FunGen/buscacaracter.php');
	include_once ( '../src/FunGen/fncmsgerror.php');
	include_once ( 'grabatransacreportherramie.php');
	include_once ( 'grabareporotherramie.php');
	include_once ( 'grabatransacreportitem.php');
	include_once ( 'grabareportotitem.php');
	include_once ( 'grabagestionotprograma2.php');


	include_once('../src/FunPerPriNiv/pktblot.php');
	$idconn =fncconn();
	$sblista = loadrecorddatosreport($arr_regot,$idconn);

	//$iRegreportot[reportcodigo] = $reportcodigo;
	$iRegreportot[ordtracodigo] = $sblista[ordtracodigo];
	$iRegreportot[tipmancodigo] = $sblista[tipmancodigo];
	$iRegreportot[prioricodigo] = $sblista[prioricodigo];
	$iRegreportot[tiptracodigo] = $sblista[tiptracodigo];
	$iRegreportot[tareacodigo] = $sblista[tareacodigo];
	$iRegreportot[reportfecha] = date("Y-m-d");
	$iRegreportot[reporttiedur] = $reporttiedur;
	$iRegreportot[reportdescri] = "ACTIVIDAD TERMINADA";
	
	grabareportot($iRegreportot,$flagnuevoreportot,$campnomb,$reportcodigo);

	//si el registro de reportot fue grabado con exito
	if(!$flagnuevoreportot){
		//graba las transacciones de las herramientas
		$arreglo_herr = explode(",",$loadherram);
		$num = count($arreglo_herr);
		unset($idcon);
		for($i=0;$i<$num;$i++){
			$idcon = fncconn();
			$arreglo_herr1 = explode("-",$arreglo_herr[$i]);
			$herramcodigo = trim($arreglo_herr1[0]);
			if($herramcodigo){
				unset($sbregherramie);
				$sbregherramie = loadrecordherramie($herramcodigo,$idcon);
				if($sbregherramie>0){
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
					if($reportcodigo && $transhercodigo){
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
		for($i=0;$i<$num;$i++){
			$idcon = fncconn();
			$arreglo_item1 = explode("-",$arreglo_item[$i]);
			$itemcodigo = trim($arreglo_item1[0]);
			$cantidad = trim($arreglo_item1[1]);
			if($itemcodigo!=""){
				unset($sbregitem);
				$sbregitem = loadrecorditem($itemcodigo,$idcon);
				if($sbregitem>0){
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
					if(!$flagnuevotransacitem){
						$iRegreporotitem[reportcodigo] = $reportcodigo;
						$iRegreporotitem[transitecodigo] = $transitecodigo;
						grabareportotitem($iRegreporotitem,$flagnuevoreporotitem,$campnomb);
					}
				}
			}
			fncclose($idcon);
		}
		
		if($flagnuevotransacherramie || $flagnuevotransacitem){
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
	

	if($cantot==1){
		
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'alert(\'Grabado exitoso\');'."\n";
		echo '//-->'."\n";
		echo '</script>';
		 
	}

?>