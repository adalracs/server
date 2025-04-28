<?php 
include ( '../src/FunPerPriNiv/pktblmedicion.php'); 
include ( '../def/tipocampo.php'); 
include ( '../src/FunGen/buscacaracter.php'); 
include ( '../src/FunGen/fncmsgerror.php'); 
function editamedicion($iRegmedicion,&$flageditarmedicion,&$campnomb,&$codigo) 
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
	if ($iRegmedicion) 
	{ 
		while($elementos = each($iRegmedicion)) 
		{ 
			$validar = buscacaracter($elementos[1]); 
			if($validar == 1) 
			{ 
				fncmsgerror(errorCar); 
				$flageditarmedicion = 1; 
				$flagerror = 1; 
				$campnomb = $elementos[0]; 
				break; 
			} 
			$validresult = consulmetamedicion($elementos[0],$elementos[1],$nuconn); 
			if ($validresult == 1) 
			{ 
				$flageditarmedicion = 1; 
				$flagerror = 1; 
				$campnomb = $elementos[0]; 
				unset ($validresult); 
				break; 
			} 
		} 
		if($flagerror != 1) 
		{ 
			$result = uprecordmedicion($iRegmedicion,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flageditarmedicion=1; 
			} 
			if($result > 0) 
			{ 
				fncmsgerror(editaEx); 
				echo '<script language="javascript">'; 
				echo '<!--//'."\n"; 
				echo 'location ="maestablmedicion.php?codigo='.$codigo.';"'; 
				echo '//-->'."\n"; 
				echo '</script>'; 
			} 
			fncclose($nuconn); 
		} 
	} 
} 
$iRegmedicion[medicicodigo] = $medicicodigo; 
$iRegmedicion[medequcodigo] = $medequcodigo; 
$iRegmedicion[medicicantid] = $medicicantid; 
$iRegmedicion[medicifecreg] = $medicifecreg; 
$iRegmedicion[usuacodi] = $usuacodi; 
editamedicion($iRegmedicion,$flageditarmedicion,$campnomb,$codigo); 
?> 
