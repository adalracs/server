<?php
function borratipocomp($ticocodi)
{
	$nuconn = fncconn();
	   $result = delrecordtipocomp(
                  $ticocodi,$nuconn);
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
borratipocomp ($ticocodi); 
?> 
