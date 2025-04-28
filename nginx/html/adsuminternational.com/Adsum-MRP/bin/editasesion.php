<?php 
function editasesion($iRegsesion)  
{ 
	$nuconn = fncconn(); 
	$result = uprecordsesion($iRegsesion,$nuconn); 
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
	$iRegsesion[sesicose] = $sesicose; 
	$iRegsesion[sesicodi] = $sesicodi; 
	$iRegsesion[usuacodi] = $usuacodi; 
	$iRegsesion[sesifein] = $sesifein; 
	$iRegsesion[sesifefi] = $sesifefi; 
	$iRegsesion[sesifeua] = $sesifeua; 
	$iRegsesion[sesiacti] = $sesiacti; 
	$iRegsesion[sesiip] = $sesiip; 
editasesion($iRegsesion); 
?> 
