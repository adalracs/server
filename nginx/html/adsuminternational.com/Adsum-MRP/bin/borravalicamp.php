<?php 
function borravalicamp(  
					$tablcodi, 
					$campcodi, 
					$valicodi) 
{ 
	$nuconn = fncconn(); 
	   $result = delrecordvalicamp( 
                  $tablcodi, 
                  $campcodi, 
                  $valicodi,$nuconn); 
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
borravalicamp ( 
                 $tablcodi, 
                 $campcodi, 
                 $valicodi); 
?> 
