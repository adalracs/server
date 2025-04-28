<?php 
function borragrupcomp(  
					$grupcodi, 
					$mecocodi) 
{ 
	$nuconn = fncconn(); 
	   $result = delrecordgrupcomp( 
                  $grupcodi, 
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
borragrupcomp ( 
                 $grupcodi, 
                 $mecocodi); 
?> 
