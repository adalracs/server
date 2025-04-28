<?php 
function editaestadoequipo($iRegestadoequipo)  
{ 
$nuconn = fncconn(); 
$result = uprecordestadoequipo($iRegestadoequipo,$nuconn); 
if($result < 0 ) 
{ 
echo '<script language="javascript">'; 
echo '<!--//'."\n"; 
echo 'alert("Error al editar el registro")'; 
echo '//-->'."\n"; 
echo '</script>'; 
} 
fncclose($nuconn); 
} 
$iRegestadoequipo[estequcodigo] = $estequcodigo; 
$iRegestadoequipo[estequnombre] = $estequnombre; 
$iRegestadoequipo[estequdescri] = $estequdescri; 
editaestadoequipo($iRegestadoequipo); 
?> 
