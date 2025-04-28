<?php 
function editamenucomp($iRegmenucomp)  
{ 
	$nuconn = fncconn(); 
	$result = uprecordmenucomp($iRegmenucomp,$nuconn); 
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
	$iRegmenucomp[mecocodi] = $mecocodi; 
	$iRegmenucomp[mecocopa] = $mecocopa; 
	$iRegmenucomp[mecoorde] = $mecoorde; 
	$iRegmenucomp[timecodi] = $timecodi; 
	$iRegmenucomp[meconomb] = $meconomb; 
	$iRegmenucomp[mecoscri] = $mecoscri; 
	$iRegmenucomp[mecoacra] = $mecoacra; 
editamenucomp($iRegmenucomp); 
?> 
