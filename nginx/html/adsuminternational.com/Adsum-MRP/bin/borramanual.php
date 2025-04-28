<?php 
include( '../src/FunGen/fncborrarmanual.php');
function borramanual($manualcodigo,$inombarc) 
{
	$nuconn = fncconn();
	$result = delrecordmanual($manualcodigo,$nuconn);
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
		fncborrarmanual($inombarc);
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'alert("Borrado exitoso")';
		echo '//-->'."\n";
		echo '</script>';
	}
	fncclose($nuconn);
}
//datos del archivo
$inombarc = $manualruta;
borramanual($manualcodigo,$inombarc); 
?> 
