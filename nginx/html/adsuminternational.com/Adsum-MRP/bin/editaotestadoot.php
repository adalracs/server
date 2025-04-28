<?php 
include ( '../src/FunPerPriNiv/pktblotestadoot.php'); 
include ( '../def/tipocampo.php'); 
include ( '../src/FunGen/buscacaracter.php'); 
include ( '../src/FunGen/fncmsgerror.php'); 
function 
editaotestadoot($iRegotestadoot,&$flageditarotestadoot,&$campnomb,&$codigo) 
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
	if ($iRegotestadoot) 
	{ 
		while($elementos = each($iRegotestadoot)) 
		{ 
			$validar = buscacaracter($elementos[1]); 
			if($validar == 1) 
			{ 
				fncmsgerror(errorCar); 
				$flageditarotestadoot = 1; 
				$flagerror = 1; 
				$campnomb = $elementos[0]; 
				break; 
			} 
			$validresult = consulmetaotestadoot($elementos[0],$elementos[1],$nuconn); 
			if ($validresult == 1) 
			{ 
				$flageditarotestadoot = 1; 
				$flagerror = 1; 
				$campnomb = $elementos[0]; 
				unset ($validresult); 
				break; 
			} 
		} 
		if($flagerror != 1) 
		{ 
			$result = uprecordotestadoot($iRegotestadoot,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flageditarotestadoot=1; 
			} 
			if($result > 0) 
			{ 
				fncmsgerror(editaEx); 
				echo '<script language="javascript">'; 
				echo '<!--//'."\n"; 
				echo 'location ="maestablotestadoot.php?codigo='.$codigo.';"'; 
				echo '//-->'."\n"; 
				echo '</script>'; 
			} 
			fncclose($nuconn); 
		} 
	} 
} 
$iRegotestadoot[otestcodigo] = $otestcodigo; 
$iRegotestadoot[ordtracodigo] = $ordtracodigo; 
$iRegotestadoot[otestacodigo] = $otestacodigo; 
$iRegotestadoot[otestorigen] = $otestorigen; 
$iRegotestadoot[otestfecini] = $otestfecini; 
$iRegotestadoot[otesthorini] = $otesthorini; 
$iRegotestadoot[otestfecfin] = $otestfecfin; 
$iRegotestadoot[otesthorfin] = $otesthorfin; 
editaotestadoot($iRegotestadoot,$flageditarotestadoot,$campnomb,$codigo); 
?> 
