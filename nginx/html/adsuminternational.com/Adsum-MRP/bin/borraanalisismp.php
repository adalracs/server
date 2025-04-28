<?php 
include ( '../src/FunPerPriNiv/pktblmpvaranalisis.php');
function borraanalisismp($analiscodigo) 
{ 
$nuconn = fncconn(); 
$result2= delrecordmpvaranalisispp($analiscodigo,$nuconn);
$result = delrecordanalisismp($analiscodigo,$nuconn); 
if($result < 0 && $result2 < 0 ) 
{ 
	ob_end_clean(); 
	echo '<script language="javascript">'; 
	echo '<!--//'."\n"; 
	echo 'alert("El registro no se puede eliminar porque se encuentra en uso")'; 
	echo '//-->'."\n"; 
	echo '</script>'; 
} 
	if($result > 0 && $result2 > 0) 
	{ 
		echo '<script language="javascript">'; 
		echo '<!--//'."\n"; 
		echo 'alert("Borrado exitoso")'; 
		echo '//-->'."\n"; 
		echo '</script>'; 
	} 
fncclose($nuconn); 
} 
borraanalisismp($analiscodigo); 
?> 
