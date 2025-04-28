<?php 
function editagrupo($iReggrupo)  
{ 
	$nuconn = fncconn(); 
	$result = uprecordgrupo($iReggrupo,$nuconn); 
	fncclose($nuconn); 
} 
	$iReggrupo[grupcodi] = $grupcodi; 
	$iReggrupo[grupnomb] = $grupnomb; 
	$iReggrupo[grupedit] = $grupedit; 
editagrupo($iReggrupo); 
?> 
