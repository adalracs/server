<?php 
include('../src/FunGen/numerador.php'); 
function grabagrupcomp($iReggrupcomp)  
{ 
	$nuconn = fncconn(); 
	$result = insrecordgrupcomp($iReggrupcomp,$nuconn); 
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
$iReggrupcomp[grupcodi] = $grupcodi; 
$iReggrupcomp[mecocodi] = $mecocodi; 
grabagrupcomp($iReggrupcomp); 
?> 
