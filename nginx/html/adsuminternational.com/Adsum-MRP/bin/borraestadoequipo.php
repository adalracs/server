<?php 
function borraestadoequipo(  
$estequcodigo) 
{ 
$nuconn = fncconn(); 
$result = delrecordestadoequipo( 
$estequcodigo,$nuconn); 
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
borraestadoequipo ( 
$estequcodigo); 
?> 
