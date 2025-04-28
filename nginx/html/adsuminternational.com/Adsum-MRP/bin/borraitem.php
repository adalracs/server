<?php
include('../src/FunPerPriNiv/pktblitemproveedo.php');
include('../src/FunPerPriNiv/pktblitemequipo.php');

function borraitem($itemcodigo)
{
	$nuconn = fncconn();

	$iRegitemproveedo["itemcodigo"] = $itemcodigo;
	$idres_itemproveedo = dinamicscanitemproveedo($iRegitemproveedo, $nuconn);

	if($idres_itemproveedo)
	{
		$num_itemproveedo = fncnumreg($idres_itemproveedo);

		for($i=0; $i<$num_itemproveedo; $i++)
		{
			$arr_itemproveedo = fncfetch($idres_itemproveedo, $i);

			if($arr_itemproveedo["itemcodigo"] = $iRegitemproveedo["itemcodigo"])
			{
				$result_itemproveedo = delrecorditemproveedo($arr_itemproveedo["iteprocodigo"], $nuconn);
			}
		}
	}
	
	
	// --
	$iRegitemequipo['itemcodigo'] = $itemcodigo;
	$idres_itemequipo = dinamicscanitemequipo($iRegitemequipo, $nuconn);

	if ($idres_itemequipo) {
		$num_itemequipo = fncnumreg($idres_itemequipo);

		for ($i=0; $i<$num_itemequipo; $i++)
		{
			$arr_itemequipo = fncfetch($idres_itemequipo, $i);

			if ($arr_itemequipo['itemcodigo'] == $iRegitemequipo['itemcodigo']) {
				$result_itemequipo = delrecorditemequipo($arr_itemequipo['iteequcodigo'], $nuconn);
			}
		}
	}
	//--
	$result = delrecorditem($itemcodigo,$nuconn);

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
borraitem ($itemcodigo);
?>