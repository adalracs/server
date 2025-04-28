<?php 
function borranumerado(  
					$numecodi) 
{ 
	$nuconn = fncconn(); 
	   $result = delrecordnumerado( 
                  $numecodi,$nuconn); 
	if($result < 0 ) 
	{ 
		echo '<script language="javascript">'; 
		echo '<!--//'."\n"; 
		echo 'alert("Error al borrar el registro")'; 
		echo '//-->'."\n"; 
		echo '</script>'; 
	} 
	fncclose($nuconn); 
} 
borranumerado ( 
                 $numecodi); 
?> 
