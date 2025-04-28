<?php 
include( '../src/FunGen/fncborrararchivo.php');
include( '../src/FunGen/fncmsgerror.php');
function borradisponibilidad($disponcodigo,$inombarc)
{
	$nuconn = fncconn();
	$result = delrecorddisponibilidad($disponcodigo,$nuconn);
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
		fncborrararchivo($inombarc,$retval);
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'alert("Borrado exitoso")';
		echo '//-->'."\n";
		echo '</script>';
	}
	fncclose($nuconn);
}
$inombarc = $disponimagen;
borradisponibilidad ($disponcodigo,$inombarc);
?> 
