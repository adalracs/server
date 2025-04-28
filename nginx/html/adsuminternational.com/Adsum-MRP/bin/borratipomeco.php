<?php 
function borratipomeco(  
					$timecodi) 
{ 
	$nuconn = fncconn(); 
	   $result = delrecordtipomeco( 
                  $timecodi,$nuconn); 
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
borratipomeco ( 
                 $timecodi); 
?> 
