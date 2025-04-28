<?php 
function borrahorasextra($arrhecode) 
{ 
	$nuconn = fncconn();
	$arr_codes = explode(',', $arrhecode);
	$del = 0;
	$exi = 0;
	
	for($a = 0; $a < count($arr_codes); $a++):
		$result = delrecordhorasextra($arr_codes[$a], $nuconn);
		
		if($result > 0)
			$exi ++;
		else
			$del ++;
	endfor;
	
	echo '<script language="javascript">';
	echo '<!--//'."\n";
	if(!$del && $exi)
		echo 'alert("Borrado exitoso")';
	elseif($del && !$exi)
		echo 'alert("Los registros no se pudieron eliminar")';
	elseif($del && $exi)
		echo 'alert("Se borraron algunos de los registros seleccionado con exito")';
	echo '//-->'."\n"; 
	echo '</script>';
	
	fncclose($nuconn); 
} 
borrahorasextra ($arrhecode);