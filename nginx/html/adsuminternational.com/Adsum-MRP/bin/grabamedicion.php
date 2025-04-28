<?php 
	//include_once('grabamedicion2.php');
	include ( '../src/FunGen/fncmsgerror.php');
	include ( '../src/FunGen/fncnumprox.php');
	include ( '../src/FunGen/fncnumact.php');	
	include ( '../src/FunPerPriNiv/pktblmedicion.php');
	define("id",85);
	define("grabaEx",3);
	
	$idcon = fncconn();
	
	$nuidtemp = fncnumact(id,$idcon);	
	do
	{
		$nuresult = loadrecordmedicion($nuidtemp,$idcon);
		if($nuresult == e_empty)
			$iRegMedicion[medicicodigo] = $nuidtemp - 1;
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	
	if(!$arrmedicion)
	{
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'alert(\'Debe Ingresar Mediciones\');'."\n";
		echo '//-->'."\n";
		echo '</script>';
		$flagnuevomedicion =1;
		$campnomb = 1;
	}
	else
	{
		$arrObject = explode(':|:', $arrmedicion);
		for($i = 0; $i < count($arrObject); $i++):
			$arr = explode(':-:', $arrObject[$i]);
			$iRegMedicion[medicicodigo] = $iRegMedicion[medicicodigo] + 1;
			$iRegMedicion[medequcodigo] = $arr[0];
			$iRegMedicion[medicicantid] = $arr[1];
			$iRegMedicion[medicifecreg] = date('Y-m-d');
			$iRegMedicion[usuacodi] = $usuacodi;
			$iRegMedicion[medicifecmed] = date('Y-m-d');
			$resultado = insrecordmedicion($iRegMedicion,$idcon);
		endfor;	
		
		if($resultado > 0)
		{
			$nuresult1 = fncnumprox(id,$nuidtemp,$idcon); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
			fncmsgerror(grabaEx);
			echo '<script language="javascript">';
			echo '<!--//'."\n";
			echo 'location ="maestablmedicion.php?codigo='.$codigo.';"';
			echo '//-->'."\n";
			echo '</script>';
		}
			
	}
	
	fncclose($idcon);
		
	
	/*

$nuevi = explode(",",$newdata);

$iRegmedicion[medicicodigo] = $medicicodigo; 
$iRegmedicion[medequcodigo] = $nuevi[0];// $medequcodigo; 
$iRegmedicion[medicicantid] = $nuevi[1];//$medicicantid; 
$iRegmedicion[medicifecreg] = $medicifecreg; 
$iRegmedicion[usuacodi] = $empleacod; 
$iRegmedicion[medicifecmed] = date('Y-m-d'); 

if(trim($empleacod) ==""  ){
	echo '<script language="javascript">';
	echo '<!--//'."\n";
	echo 'alert(\'Debe seleccionar el encargado\');'."\n";
	//echo 'location ="maestablprogramacion.php?codigo='.$codigo.';"';
	echo '//-->'."\n";
	echo '</script>';
	$flagnuevomedicion =1;
}else{
	grabamedicion($iRegmedicion,$flagnuevomedicion,$campnomb); 
}



if($tamano==1){
	
	echo '<script language="javascript">';
	echo '<!--//'."\n";
	echo 'alert(\'Grabado exitoso\');'."\n";
	//echo 'location ="maestablprogramacion.php?codigo='.$codigo.';"';

	echo '//-->'."\n";
	echo '</script>';
	unset($arr_detalle);
}
*/

?> 
