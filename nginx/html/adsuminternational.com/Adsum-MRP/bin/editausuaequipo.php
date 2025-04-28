<?php
include_once ( '../src/FunGen/fncnumprox.php'); 
include_once ( '../src/FunGen/fncnumact.php'); 


function editausuaequipo($iRegusuaequipo, &$flageditarusuaequipo, &$campnomb, $flag, &$codigo){

	$nuconn = fncconn();
	
	define("idusuaequipo",53);
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("compactu",6);
	define("fecvalid",7);
	define("errormail",8);
	define("editaEx",9);

	if($flag){
		$nuidtemp = fncnumact(idusuaequipo,$nuconn);
		do{
			$nuresult = loadrecordusuaequipo($nuidtemp,$nuconn);
			if($nuresult == e_empty){
				$iRegusuaequipo[usuequcodigo] = $nuidtemp;
			}
			$nuidtemp ++;
		}while ($nuresult != e_empty);

		if ($iRegusuaequipo[usuacodi] != null){
			$result = insrecordusuaequipo($iRegusuaequipo,$nuconn);
			$nuresult1 = fncnumprox(idusuaequipo,$nuidtemp,$nuconn);

			fncmsgerror(editaEx);
			echo '<script language="javascript">';
			echo '<!--//'."\n";
			echo 'location ="maestablequipo.php?codigo='.$codigo.';"';
			echo '//-->'."\n";
			echo '</script>';
			
			fncclose($nuconn);
		}
	}else{
		if ($iRegusuaequipo){
			$result = uprecordusuaequipo($iRegusuaequipo,$nuconn);
			if($result < 0 ){
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditarusuaequipo=1;
			}
			if($result > 0){
				fncmsgerror(editaEx);
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestablequipo.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
			}
			fncclose($nuconn);
		}
	}
}
// En caso de que no se asigne un cuentadante
if(empty($usuacodigo)){
	define("editaEx", 9);
	
	fncmsgerror(editaEx);	
	echo '<script language="javascript">';
	echo '<!--//'."\n";
	echo 'location ="maestablequipo.php?codigo='.$codigo.';"';
	echo '//-->'."\n";
	echo '</script>';
}
//
else {
	$idcon = fncconn();
	$sbregusuaequ = loadrecordusuaequipo1($equipocodigo,$idcon);
	
	if(!is_array($sbregusuaequ))
		$flagnoedit = 1;
	
	fncclose($idcon);

	$iRegusuaequipo[usuequcodigo] = $sbregusuaequ[usuequcodigo];
	$iRegusuaequipo[usuacodi] 	  = $usuacodigo;
	$iRegusuaequipo[equipocodigo] = $equipocodigo;
	$usuacodigo = null;
	editausuaequipo($iRegusuaequipo, $flageditarusuaequipo, $campnomb, $flagnoedit, $codigo);
}
?>