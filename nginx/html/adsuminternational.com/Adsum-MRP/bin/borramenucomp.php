<?php 
function borramenucomp(  
					$mecocodi) 
{ 
	$nuconn = fncconn(); 
	   $result = delrecordmenucomp( 
                  $mecocodi,$nuconn); 
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
borramenucomp ( 
                 $mecocodi); 
?> 
