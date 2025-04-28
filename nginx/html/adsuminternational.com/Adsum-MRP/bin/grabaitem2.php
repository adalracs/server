<?php
function grabaitem2($iRegitem)
{
	$nuconn = fncconn();
    $result = insrecorditem($iRegitem,$nuconn);
	if($result < 0 )
	{ 
		echo '<script language="javascript">'; 
		echo '<!--//'."\n"; 
		echo 'alert("Error al ingresar el registro")'; 
		echo '//-->'."\n"; 
		echo '</script>'; 
	} 		
fncclose($nuconn); 
} 
?> 
