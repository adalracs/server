<?php 
function editausuagrup($iRegusuagrup)  
{ 
	$nuconn = fncconn(); 
	$result = uprecordusuagrup($iRegusuagrup,$nuconn); 
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
	$iRegusuagrup[grupcodi] = $grupcodi; 
	$iRegusuagrup[usuacodi] = $usuacodi; 
editausuagrup($iRegusuagrup); 
?> 
