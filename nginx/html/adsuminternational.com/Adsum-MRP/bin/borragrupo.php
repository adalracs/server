<?php

include('../src/FunPerPriNiv/pktblborragrupo.php');

function borragrupo($grupcodi)
{
	$nuconn = fncconn();

    $result1 = delrecusuagrupre($grupcodi,$nuconn);
    fncnumreg($result1);
    if(fncnumreg($result1) > 0)
    {
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'alert("No se puede borrar grupo, usuarios asignados")';
		echo '//-->'."\n";
		echo '</script>';
        return;
    }
    $result2 = delrecgrupcompre($grupcodi,$nuconn);
    $result3 = delrecordgrupo($grupcodi,$nuconn);
	if($result1 < 0 || $result2 < 0 || $result3 < 0)
	{
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'alert("Error al borrar el registro")';
		echo '//-->'."\n";
		echo '</script>';
	}
	fncclose($nuconn);
}
borragrupo ($grupcodi);
?>
