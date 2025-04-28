<?php
function borragrupotemp($grupcodi)
{
	$nuconn = fncconn();
	$result = delrecordgrupo($grupcodi,$nuconn);
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
borragrupotemp ($idgrupotemp);
?>
