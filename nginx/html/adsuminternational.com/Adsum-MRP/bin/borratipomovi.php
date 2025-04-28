<?php 
function borratipomovi($tipmovcodigo) 
{
	define("Ingdef",1);
	define("Egrdef",2);
	
	if($tipmovcodigo == Ingdef || $tipmovcodigo == Egrdef)
	{
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'alert("Este registro no se puede eliminar del sistema")';
		echo '//-->'."\n";
		echo '</script>';	
	}else 
	{
		$nuconn = fncconn();
		$result = delrecordtipomovi($tipmovcodigo,$nuconn);
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
		fncclose($nuconn);
	}
}
borratipomovi($tipmovcodigo); 
?> 
