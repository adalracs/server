<?php 
	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
	endif;
	
	if($usuacodigo):
		$idcon = fncconn();
			
		$strSQL = "	SELECT DISTINCT horasextra.horextcodigo
					FROM horasextra 
						LEFT JOIN horaextraot ON horaextraot.horextcodigo = horasextra.horextcodigo 
						LEFT JOIN usunovhorext ON usunovhorext.hoexotcodigo = horaextraot.hoexotcodigo 
					WHERE horasextra.usuacodi = '{$usuacodigo}' AND usunovhorext.hoexotcodigo is null";
	
		$rs_horaextrot = pg_exec($idcon, $strSQL); 
		$nr_horaextrot = fncnumreg($rs_horaextrot);
	endif;
?>
<table width="100%" border="0" cellspacing="1" cellpadding="1"  align="center">	
	<?php 
		if($arrhecode)
		{
			$array_tmp = explode(',',$arrhecode);
			$array_key = array_flip($array_tmp);
		}
	
		for($a = 0; $a < $nr_horaextrot; $a++): 
			$rw_horaextrot = fncfetch($rs_horaextrot, $a);
			
			$strSQL = "	SELECT horasextra.*, horaextraot.hoexotcodigo, horaextraot.ordtracodigo 
					FROM horasextra 
						LEFT JOIN horaextraot ON horaextraot.horextcodigo = horasextra.horextcodigo 
						LEFT JOIN usunovhorext ON usunovhorext.hoexotcodigo = horaextraot.hoexotcodigo 
					WHERE horasextra.usuacodi = '{$usuacodigo}' AND horasextra.horextcodigo = '{$rw_horaextrot['horextcodigo']}' AND usunovhorext.hoexotcodigo is null";
	
			$rs_dethoraextrot = pg_exec($idcon, $strSQL); 
			$nr_dethoraextrot = fncnumreg($rs_dethoraextrot);
			
			if($a % 2)
				$classrow = 'class="NoiseDataTD"';
			else
				$classrow = 'class="NoiseFooterTD"';

			
			for($b = 0; $b < $nr_dethoraextrot; $b++): 
				$checked = '';
				$rw_dethoraextrot = fncfetch($rs_dethoraextrot, $b);
				
				if(is_array($array_key))
				{
					if(array_key_exists($rw_dethoraextrot['hoexotcodigo'], $array_key))
						$checked = 'checked ';
				}
				
				if($c % 2)
					$complement = 'class="NoiseDataTD"';
				else
					$complement = 'class="NoiseFooterTD"';
	?>
	<tr <?php echo $complement ?>>
		<?php if($b < 1): ?><td width="5" rowspan="<?php echo $nr_dethoraextrot ?>" <?php echo $classrow ?> >&nbsp;</td><?php endif ?>
		<td width="30"><input type="checkbox" id="chkhecode" name="chkhecode" <?php echo $checked ?> onclick="setSelectionRow(this.value, document.getElementById('arrhecode').value, ',', 'hecode');" value="<?php echo $rw_dethoraextrot['hoexotcodigo'] ?>"></td>
		<td width="80">&nbsp;<?php echo $rw_dethoraextrot['horextfecha']  ?></td>
		<td width="80">&nbsp;<?php echo date("h:i a", strtotime($rw_dethoraextrot['horextfecha'].' '.$rw_dethoraextrot['horexthorini'])) ?></td>
		<td width="80">&nbsp;<?php echo date("h:i a", strtotime($rw_dethoraextrot['horextfecha'].' '.$rw_dethoraextrot['horexthorfin'])) ?></td>
		<td width="70">&nbsp;<?php if($rw_dethoraextrot['ordtracodigo']) echo $rw_dethoraextrot['ordtracodigo']; else echo '------' ?></td>
		<td width="245">&nbsp;<?php echo  utf8_encode(substr($rw_dethoraextrot['horextdescri'],0,40)); if(strlen($rw_dethoraextrot['horextdescri']) > 40) echo '...'; ?></td>
	</tr>
	<?php 
				$c++;
			endfor;
		endfor; 
	
		if($a < 9):
			for($b = $a; $b < 9; $b++):
			
				if($b % 2)
					$class = "NoiseDataTD";
				else
					$class = "NoiseFooterTD";
	?>
	<tr class="<?php echo $class ?>">
		<td width="6">&nbsp;</td>
		<td width="30">&nbsp;</td>
		<td width="80">&nbsp;</td>
		<td width="80">&nbsp;</td>
		<td width="80">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="245">&nbsp;</td>
	</tr>
	<?php
			endfor;
		endif;
	?>
</table>
<input type="hidden" name="arrhecode" id="arrhecode" value="<?php echo $arrhecode ?>">
