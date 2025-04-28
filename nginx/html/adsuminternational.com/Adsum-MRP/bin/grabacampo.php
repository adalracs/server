<?php 
include('../src/FunGen/numerador.php'); 
function grabacampo($iRegcampo)  
{ 
	$nuconn = fncconn(); 
	$iRegcampo[campcodi]=numerador('campo',$nuconn); 
	$result = insrecordcampo($iRegcampo,$nuconn); 
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
$iRegcampo[tablcodi] = $tablcodi; 
$iRegcampo[campcodi] = $campcodi; 
$iRegcampo[campnomb] = $campnomb; 
$iRegcampo[campdesc] = $campdesc; 
grabacampo($iRegcampo); 
?> 
