<?php 
function editatipomeco($iRegtipomeco)  
{ 
	$nuconn = fncconn(); 
	$result = uprecordtipomeco($iRegtipomeco,$nuconn); 
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
	$iRegtipomeco[timecodi] = $timecodi; 
	$iRegtipomeco[ticonomb] = $ticonomb; 
	$iRegtipomeco[ticodesc] = $ticodesc; 
editatipomeco($iRegtipomeco); 
?> 
