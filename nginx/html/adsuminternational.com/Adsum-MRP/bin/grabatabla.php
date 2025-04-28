<?php 
include('../src/FunGen/numerador.php'); 
function grabatabla($iRegtabla)  
{ 
	$nuconn = fncconn(); 
	$iRegtabla[tablcodi]=numerador('tabla',$nuconn); 
	$result = insrecordtabla($iRegtabla,$nuconn); 
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
$iRegtabla[tablcodi] = $tablcodi; 
$iRegtabla[tablnomb] = $tablnomb; 
$iRegtabla[tabldesc] = $tabldesc; 
grabatabla($iRegtabla); 
?> 
