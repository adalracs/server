<?php
function editacategoria($iRegcategoria)
{
	$nuconn = fncconn();
	$result = uprecordcategoria($iRegcategoria,$nuconn);
		if($result < 0 )
		{
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'alert("Error al editar el registro")';
		echo '//-->'."\n";
		echo '</script>';
		}
		fncclose($nuconn);
		if($result > 0)
		{
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'alert("Modificación exitosa")';
		echo '//-->'."\n";
		echo '</script>';
		}
}
$iRegcategoria[categocodigo] = $categocodigo;
$iRegcategoria[categonombre] = $categonombre;
$iRegcategoria[categodescri] = $categodescri;
editacategoria($iRegcategoria);
?>