<?php 
function editanumerado($iRegnumerado)  
{ 
	$nuconn = fncconn(); 
	$result = uprecordnumerado($iRegnumerado,$nuconn); 
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
	$iRegnumerado[numecodi] = $numecodi; 
	$iRegnumerado[numedesc] = $numedesc; 
	$iRegnumerado[numeprox] = $numeprox; 
editanumerado($iRegnumerado); 
?> 
