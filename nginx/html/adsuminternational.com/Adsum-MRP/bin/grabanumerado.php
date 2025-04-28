<?php 
include('../src/FunGen/numerador.php'); 
function grabanumerado($iRegnumerado)  
{ 
	$nuconn = fncconn(); 
	$iRegnumerado[numecodi]=numerador('numerado',$nuconn); 
	$result = insrecordnumerado($iRegnumerado,$nuconn); 
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
$iRegnumerado[numecodi] = $numecodi; 
$iRegnumerado[numedesc] = $numedesc; 
$iRegnumerado[numeprox] = $numeprox; 
grabanumerado($iRegnumerado); 
?> 
