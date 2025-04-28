<?php 
include('../src/FunGen/numerador.php'); 
function grabausuagrup($iRegusuagrup)  
{ 
	$nuconn = fncconn(); 
	$result = insrecordusuagrup($iRegusuagrup,$nuconn); 
	if($result < 0 ) 
	{ 
		echo '<script language="javascript">'; 
		echo '<!--//'."\n"; 
		echo 'alert("Error al ingresar el registro")'; 
		echo '//-->'."\n"; 
		echo '</script>'; 
	} 
	fncclose($nuconn); 
} 
$iRegusuagrup[grupcodi] = $grupcodi; 
$iRegusuagrup[usuacodi] = $usuacodi; 
grabausuagrup($iRegusuagrup); 
?> 
