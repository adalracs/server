<?php 
function editatabla($iRegtabla)  
{ 
	$nuconn = fncconn(); 
	$result = uprecordtabla($iRegtabla,$nuconn); 
	if($result < 0 ) 
	{ 
		echo '<script language="javascript">'; 
		echo '<!--//'."\n"; 
		echo 'alert("Error al editar el registro")'; 
		echo '//-->'."\n"; 
		echo '</script>'; 
	} 
	fncclose($nuconn); 
} 
	$iRegtabla[tablcodi] = $tablcodi; 
	$iRegtabla[tablnomb] = $tablnomb; 
	$iRegtabla[tabldesc] = $tabldesc; 
editatabla($iRegtabla); 
?> 
