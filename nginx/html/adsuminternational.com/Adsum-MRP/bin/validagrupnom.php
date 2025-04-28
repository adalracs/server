<?php
include ( '../src/FunPerPriNiv/pktblgrupo.php');
include( '../src/FunGen/fncnombeditexs.php');
include( '../src/FunGen/fncnombexs.php');
$idcon = fncconn();
$iReggrupo[grupcodi] = $grupcodi;
$iReggrupo[grupnomb] = $grupnomb;
$iReggrupo[grupedit] = $grupedit;
if(!$accioneditargrupo)
{
	$validnombre =  fncnombexs('grupo',$iReggrupo,'grupnomb',$grupnomb,$idcon);
	if ($validnombre == 1)
	{
		echo '<script language = "javaScript">';
		echo '<!--//'."\n";
		echo 'alert("El nombre ya existe, digite un nombre diferente")';
		echo '//-->'."\n";
		echo 'location = "ingrnuevgrupo.php?codigo=1";';
		echo '</script>';
	}
}
else
{
	$validnombre =  fncnombeditexs('grupo',$iReggrupo,'grupnomb',$grupnomb,'grupcodi',$iReggrupo[grupcodi],$idcon);
	if ($validnombre == 1)
	{
		echo '<script language = "javaScript">';
		echo '<!--//'."\n";
		echo 'alert("El nombre ya existe, digite un nombre diferente")';
		echo '//-->'."\n";
		echo 'location = "ingrnuevgrupo.php?codigo=1";';
		echo '</script>';
	}
}
fncclose($idcon);
?>