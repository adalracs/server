<?php 
include('../src/FunGen/numerador.php'); 
function grabatipomeco($iRegtipomeco)  
{ 
	$nuconn = fncconn(); 
	$iRegtipomeco[timecodi]=numerador('tipomeco',$nuconn); 
	$result = insrecordtipomeco($iRegtipomeco,$nuconn); 
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
$iRegtipomeco[timecodi] = $timecodi; 
$iRegtipomeco[ticonomb] = $ticonomb; 
$iRegtipomeco[ticodesc] = $ticodesc; 
grabatipomeco($iRegtipomeco); 
?> 
