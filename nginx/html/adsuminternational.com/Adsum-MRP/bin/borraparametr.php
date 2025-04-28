<?php
function borraparametr($moducodi,$paracodi)
{
	$nuconn = fncconn();
    $result = delrecordparametr($moducodi,$paracodi,$nuconn);
	if($result < 0 )
	{
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'alert("Error al borrar el registro")';
		echo '//-->'."\n";
		echo '</script>';
        return $result;
	}

	fncclose($nuconn);
    return $result;

}
borraparametr ($moducodi,$paracodi);
?> 
