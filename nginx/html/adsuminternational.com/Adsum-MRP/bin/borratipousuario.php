<?php
function borratipousuario($tipusucodigo)
{
	define("DEF_COD", 1);

	$nuconn = fncconn();
	$result = delrecordtipousuario($tipusucodigo,$nuconn);

	if ($tipusucodigo == DEF_COD)
	{
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'alert("Este registro no se puede eliminar del sistema")';
		echo '//-->'."\n";
		echo '</script>';
	}
	else {
		if($result < 0 )
		{
			ob_end_clean();
			echo '<script language="javascript">';
			echo '<!--//'."\n";
			echo 'alert("El registro no se puede eliminar porque se encuentra en uso")';
			echo '//-->'."\n";
			echo '</script>';
		}

		if($result > 0)
		{
			echo '<script language="javascript">';
			echo '<!--//'."\n";
			echo 'alert("Borrado exitoso")';
			echo '//-->'."\n";
			echo '</script>';
		}
	}
	fncclose($nuconn);
}
borratipousuario (
$tipusucodigo);
?>