<?php
function validausuariopersonal($usuacodigo)
{
	$idcon = fncconn();
	$sbregusuagrup = loadrecordusuagr($usuacodigo,$idcon);

	if($sbregusuagrup[usuacodi])
	{
		$sbreggrupo = loadrecordgrupo($sbregusuagrup[grupcodi],$idcon);
		if($sbreggrupo[grupedit] == 0)
		{
			echo '<script language="javascript">'; 
			echo 'alert("No se puede acceder al usuario seleccionado desde este componente")';
			echo '<!--//'."\n"; 
			echo 'location ="maestablusuacolab.php?codigo='.$codigo.';"'; 
			echo '//-->'."\n"; 
			echo '</script>'; 
		}
	}
}
validausuariopersonal($sbreg[usuacodi]);

?>