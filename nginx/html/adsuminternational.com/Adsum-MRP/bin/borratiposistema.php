<?php 
function borratiposistema( $tipsiscodigo) 
{ 
	$nuconn = fncconn(); 
	
	//Consultar si hay regitros en sistemacamperequipo
	$iRegtipsiscam['tipsiscodigo'] = $tipsiscodigo;
	$sistResult = dinamicscansistema($iRegtipsiscam,$nuconn);
	$numsist = fncnumreg($sistResult);
	
	if(!$numsist)
	{
		//Consultar si hay regitros en tiposistemacamperequipo
		$tipsisResult = dinamicscantiposistemacamperequipo($iRegtipsiscam, $nuconn);
		$numtipsis = fncnumreg($tipsisResult);
		
		if($numtipsis)
		{
			for ($j = 0; $j < $numtipsis; $j++)
			{
				$arrtipsiscam = fncfetch($tipsisResult,$j);
				if($arrtipsiscam["capeeqcodigo"])
				{
					//Consultar si hay registros en sistemacamperequipo
					$iRegsiscam['capeeqcodigo'] = $arrtipsiscam["capeeqcodigo"];
					$siscamResult = dinamicscansistemacamperequipo($iRegsiscam, $nuconn);
					$numsiscam = fncnumreg($siscamResult);
					if($numsiscam)
					{
						$auxtipsis = $arrtipsiscam["tipsiscodigo"];
						break;
					}
				}
			}
			if(!$auxtipeq)
				delrecordtiposistemacamperequipoAll($tipsiscodigo,$nuconn);
		}
		
	}
	$result = delrecordtiposistema($tipsiscodigo,$nuconn);
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
borratiposistema( $tipsiscodigo); 
?> 
