<?php 
function editacampo($iRegcampo)  
{ 
	$nuconn = fncconn(); 
	$result = uprecordcampo($iRegcampo,$nuconn); 
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
	$iRegcampo[tablcodi] = $tablcodi; 
	$iRegcampo[campcodi] = $campcodi; 
	$iRegcampo[campnomb] = $campnomb; 
	$iRegcampo[campdesc] = $campdesc; 
editacampo($iRegcampo); 
?> 
