<?php 
include ( '../src/FunPerPriNiv/pktblreporotherramie.php'); 
include ( '../def/tipocampo.php'); 
include ( '../src/FunGen/buscacaracter.php'); 
include ( '../src/FunGen/fncmsgerror.php'); 
function 
 
 
 
 
 
 
 
 
 
 
 
therramie($iRegreporotherramie,&$flageditarreporotherramie,&$campnomb,&$codigo) 
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
	if ($iRegreporotherramie) 
	{ 
		while($elementos = each($iRegreporotherramie)) 
		{ 
			$validar = buscacaracter($elementos[1]); 
			if($validar == 1) 
			{ 
				fncmsgerror(errorCar); 
				$flageditarreporotherramie = 1; 
				$flagerror = 1; 
				$campnomb = $elementos[0]; 
				break; 
			} 
			$validresult = 
consulmetareporotherramie($elementos[0],$elementos[1],$nuconn); 
			if ($validresult == 1) 
			{ 
				$flageditarreporotherramie = 1; 
				$flagerror = 1; 
				$campnomb = $elementos[0]; 
				unset ($validresult); 
				break; 
			} 
		} 
		if($flagerror != 1) 
		{ 
			$result = uprecordreporotherramie($iRegreporotherramie,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flageditarreporotherramie=1; 
			} 
			if($result > 0) 
			{ 
				fncmsgerror(editaEx); 
				echo '<script language="javascript">'; 
				echo '<!--//'."\n"; 
				echo 'location ="maestablreporotherramie.php?codigo='.$codigo.';"'; 
				echo '//-->'."\n"; 
				echo '</script>'; 
			} 
			fncclose($nuconn); 
		} 
	} 
} 
$iRegreporotherramie[rephercodigo] = $rephercodigo; 
$iRegreporotherramie[reportcodigo] = $reportcodigo; 
$iRegreporotherramie[transhercodigo] = $transhercodigo; 
 
 
 
 
 
 
 
 
 
rotherramie($iRegreporotherramie,$flageditarreporotherramie,$campnomb,$codigo); 
?> 
