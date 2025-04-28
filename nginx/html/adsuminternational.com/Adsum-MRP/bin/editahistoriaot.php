<?php 
include ( '../src/FunPerPriNiv/pktblhistoriaot.php'); 
include ( '../def/tipocampo.php'); 
include ( '../src/FunGen/buscacaracter.php'); 
include ( '../src/FunGen/fncmsgerror.php'); 
function 
editahistoriaot($iReghistoriaot,&$flageditarhistoriaot,&$campnomb,&$codigo) 
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
	if ($iReghistoriaot) 
	{ 
		while($elementos = each($iReghistoriaot)) 
		{ 
			$validar = buscacaracter($elementos[1]); 
			if($validar == 1) 
			{ 
				fncmsgerror(errorCar); 
				$flageditarhistoriaot = 1; 
				$flagerror = 1; 
				$campnomb = $elementos[0]; 
				break; 
			} 
			$validresult = consulmetahistoriaot($elementos[0],$elementos[1],$nuconn); 
			if ($validresult == 1) 
			{ 
				$flageditarhistoriaot = 1; 
				$flagerror = 1; 
				$campnomb = $elementos[0]; 
				unset ($validresult); 
				break; 
			} 
		} 
		if($flagerror != 1) 
		{ 
			$result = uprecordhistoriaot($iReghistoriaot,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flageditarhistoriaot=1; 
			} 
			if($result > 0) 
			{ 
				fncmsgerror(editaEx); 
				echo '<script language="javascript">'; 
				echo '<!--//'."\n"; 
				echo 'location ="maestablhistoriaot.php?codigo='.$codigo.';"'; 
				echo '//-->'."\n"; 
				echo '</script>'; 
			} 
			fncclose($nuconn); 
		} 
	} 
} 
$iReghistoriaot[histotcodigo] = $histotcodigo; 
$iReghistoriaot[ordtracodigo] = $ordtracodigo; 
$iReghistoriaot[histothorini] = $histothorini; 
$iReghistoriaot[histotfecini] = $histotfecini; 
$iReghistoriaot[histothorfin] = $histothorfin; 
$iReghistoriaot[histotfecfin] = $histotfecfin; 
$iReghistoriaot[histotsecuen] = $histotsecuen; 
$iReghistoriaot[histotfin] = $histotfin; 
editahistoriaot($iReghistoriaot,$flageditarhistoriaot,$campnomb,$codigo); 
?> 
