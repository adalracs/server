<?php 
function borratipocomponen( $tipcomcodigo) 
{ 
	$nuconn = fncconn(); 
	
	//Consultar si hay regitros en componencamperequipo
	$iRegtipcomcam['tipcomcodigo'] = $tipcomcodigo;
	$compResult = dinamicscancomponen($iRegtipcomcam,$nuconn);
	$numcomp = fncnumreg($compResult);
	
	if(!$numcomp)
	{
		//Consultar si hay regitros en tipocomponencamperequipo
		$tipcomResult = dinamicscantipocomponencamperequipo($iRegtipcomcam, $nuconn);
		$numtipcom = fncnumreg($tipcomResult);
		
		if($numtipcom)
		{
			for ($j = 0; $j < $numtipcom; $j++)
			{
				$arrtipcomcam = fncfetch($tipcomResult,$j);
				if($arrtipcomcam["capeeqcodigo"])
				{
					//Consultar si hay registros en componencamperequipo
					$iRegcompcam['capeeqcodigo'] = $arrtipcomcam["capeeqcodigo"];
					$comcamResult = dinamicscancomponencamperequipo($iRegcompcam, $nuconn);
					$numcomcam = fncnumreg($comcamResult);
					if($numcomcam)
					{
						$auxtipcom = $arrtipcomcam["tipcomcodigo"];
						break;
					}
				}
			}
			if(!$auxtipeq)
				delrecordtipocomponencamperequipoAll($tipcomcodigo,$nuconn);
		}
		
	}
	$result = delrecordtipocomponen($tipcomcodigo,$nuconn);
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
borratipocomponen( $tipcomcodigo); 
?> 
