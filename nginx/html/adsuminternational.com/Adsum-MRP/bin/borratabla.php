<?php 
function borratabla(  
					$tablcodi) 
{ 
	$nuconn = fncconn(); 
	   $result = delrecordtabla( 
                  $tablcodi,$nuconn); 
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
borratabla ( 
                 $tablcodi); 
?> 
