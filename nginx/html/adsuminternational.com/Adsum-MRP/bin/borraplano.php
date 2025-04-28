<?php 
include( '../src/FunGen/fncborrarplano.php');
function borraplano($planocodigo,$inombarc) 
{
	$nuconn = fncconn();
	$result = delrecordplano($planocodigo,$nuconn);
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
		fncborrarplano($inombarc);		
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'alert("Borrado exitoso")';
		echo '//-->'."\n";
		echo '</script>';
	}
	fncclose($nuconn);
}
//datos del archivo
$inombarc = $planoruta;
borraplano($planocodigo,$inombarc); 
?> 
