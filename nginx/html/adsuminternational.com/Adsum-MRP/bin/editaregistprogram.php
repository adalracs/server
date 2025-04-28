<?php 
include ( '../src/FunPerPriNiv/pktblregistprogram.php'); 
include ( '../def/tipocampo.php'); 
include ( '../src/FunGen/buscacaracter.php'); 
include ( '../src/FunGen/fncmsgerror.php'); 
function 
 
 
 
 
 
registprogram($iRegregistprogram,&$flageditarregistprogram,&$campnomb,&$codigo) 
{ 
	$nuconn = fncconn(); 
	define("errorReg",1); 
	define("errorCar",2); 
	define("grabaEx",3); 
	define("compinst",4); 
	define("venccomp",5); 
	define("compactu",6); 
	define("fecvalid",7); 
	define("errormail",8); 
	define("editaEx",9); 
	if ($iRegregistprogram) 
	{ 
		while($elementos = each($iRegregistprogram)) 
		{ 
			$validar = buscacaracter($elementos[1]); 
			if($validar == 1) 
			{ 
				fncmsgerror(errorCar); 
				$flageditarregistprogram = 1; 
				$flagerror = 1; 
				$campnomb = $elementos[0]; 
				break; 
			} 
			$validresult = consulmetaregistprogram($elementos[0],$elementos[1],$nuconn); 
			if ($validresult == 1) 
			{ 
				$flageditarregistprogram = 1; 
				$flagerror = 1; 
				$campnomb = $elementos[0]; 
				unset ($validresult); 
				break; 
			} 
		} 
		if($flagerror != 1) 
		{ 
			$result = uprecordregistprogram($iRegregistprogram,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flageditarregistprogram=1; 
			} 
			if($result > 0) 
			{ 
				fncmsgerror(editaEx); 
				echo '<script language="javascript">'; 
				echo '<!--//'."\n"; 
				echo 'location ="maestablregistprogram.php?codigo='.$codigo.';"'; 
				echo '//-->'."\n"; 
				echo '</script>'; 
			} 
			fncclose($nuconn); 
		} 
	} 
} 
$iRegregistprogram[regprocodigo] = $regprocodigo; 
$iRegregistprogram[progracodigo] = $progracodigo; 
$iRegregistprogram[regprovalor] = $regprovalor; 
$iRegregistprogram[regprofecha] = $regprofecha; 
$iRegregistprogram[regprohora] = $regprohora; 
$iRegregistprogram[regpronota] = $regpronota; 
 
 
 
taregistprogram($iRegregistprogram,$flageditarregistprogram,$campnomb,$codigo); 
?> 
