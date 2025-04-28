<?php 
function editavalidaci($iRegvalidaci)  
{ 
	$nuconn = fncconn(); 
	$result = uprecordvalidaci($iRegvalidaci,$nuconn); 
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
	$iRegvalidaci[valicodi] = $valicodi; 
	$iRegvalidaci[valinomb] = $valinomb; 
	$iRegvalidaci[validesc] = $validesc; 
editavalidaci($iRegvalidaci); 
?> 
