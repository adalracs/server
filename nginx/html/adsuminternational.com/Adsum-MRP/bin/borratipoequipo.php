<?php 
function borratipoequipo( $tipequcodigo) 
{ 
	$nuconn = fncconn(); 
	
	//Consultar si hay regitros en equipocamperequipo
	$iRegtipeqcam['tipequcodigo'] = $tipequcodigo;
	$equiResult = dinamicscanequipo($iRegtipeqcam,$nuconn);
	$numequi = fncnumreg($equiResult);
	
	if(!$numequi)
	{
		//Consultar si hay regitros en tipoequipocamperequipo
		$tipeqResult = dinamicscantipoequipocamperequipo($iRegtipeqcam, $nuconn);
		$numtipeq = fncnumreg($tipeqResult);
		
		if($numtipeq)
		{
			for ($j = 0; $j < $numtipeq; $j++)
			{
				$arrtipeqcam = fncfetch($tipeqResult,$j);
				if($arrtipeqcam["capeeqcodigo"])
				{
					//Consultar si hay registros en equipocamperequipo
					$iRegequcam['capeeqcodigo'] = $arrtipeqcam["capeeqcodigo"];
					$eqcamResult = dinamicscanequipocamperequipo($iRegequcam, $nuconn);
					$numeqcam = fncnumreg($eqcamResult);
					if($numeqcam)
					{
						$auxtipeq = $arrtipeqcam["tipequcodigo"];
						break;
					}
				}
			}
			if(!$auxtipeq)
				delrecordtipoequipocamperequipoAll($tipequcodigo,$nuconn);
		}
		
	}
	$result = delrecordtipoequipo( $tipequcodigo,$nuconn);
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
borratipoequipo( $tipequcodigo); 
?> 
