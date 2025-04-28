<?php 
function editagrupcomp($iReggrupcomp)  
{ 
	$nuconn = fncconn(); 
	$result = uprecordgrupcomp($iReggrupcomp,$nuconn); 
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
	$iReggrupcomp[grupcodi] = $grupcodi; 
	$iReggrupcomp[mecocodi] = $mecocodi; 
editagrupcomp($iReggrupcomp); 
?> 
