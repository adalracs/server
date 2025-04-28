<?php 
function borraestadoalarma($estalacodigo) 
{ 
	define("_DEF_BEG",1);
	define("_DEF_END",4);
	
	if(($estalacodigo >= _DEF_BEG) || ($estalacodigo <= _DEF_END))
	{
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'alert("Este registro no se puede eliminar del sistema")';
		echo '//-->'."\n";
		echo '</script>';	
	}else 
	{
		$nuconn = fncconn();
		$result = delrecordestadoalarma($estalacodigo,$nuconn);
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
borraestadoalarma ($estalacodigo); 
?> 
