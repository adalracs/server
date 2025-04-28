<?php 
function borrasesion(  
					$sesicose, 
					$sesicodi) 
{ 
	$nuconn = fncconn(); 
	   $result = delrecordsesion( 
                  $sesicose, 
                  $sesicodi,$nuconn); 
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
borrasesion ( 
                 $sesicose, 
                 $sesicodi); 
?> 
