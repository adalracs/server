<?php
include('../src/FunPerPriNiv/pktblherramieproveedo.php');

function borraherramie($herramcodigo)
{
	$nuconn = fncconn();
	$iRegherramieproveedo["herramcodigo"] = $herramcodigo;
	$idres_herramieproveedo = dinamicscanherramieproveedo($iRegherramieproveedo, $nuconn);
	
	if(!is_numeric($idres_herramieproveedo))
	{
		$num_herramieproveedo = fncnumreg($idres_herramieproveedo);

		for($i=0; $i<$num_herramieproveedo; $i++)
		{
			$arr_herramieproveedo = fncfetch($idres_herramieproveedo, $i);

			if($arr_herramieproveedo["herramcodigo"] = $iRegherramieproveedo["herramcodigo"])
			{
				$result_herramieproveedo = delrecordherramieproveedo($arr_herramieproveedo["herprocodigo"], $nuconn);
			}
		}
	}
	$result = delrecordherramie($herramcodigo,$nuconn);
	
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
borraherramie ($herramcodigo);
?>