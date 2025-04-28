<?php

include('../src/FunPerPriNiv/delrecgrupcomp.php');

function borrahijo($grupcodi)
{
	$nuconn = fncconn();

    $result = delrecgrupcomp($grupcodi,$nuconn);

    //echo $result;
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
?>
