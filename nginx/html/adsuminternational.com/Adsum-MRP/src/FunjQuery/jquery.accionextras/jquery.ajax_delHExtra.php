<?php 
	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerPriNiv/pktblhorasextra.php';
	endif;
	
	if($usuacodigo):
		$idcon = fncconn();
		$rs_horasextra = dinamicscanhorasextra(array('usuacodi' => $usuacodigo), $idcon);
		$nr_horasextra = fncnumreg($rs_horasextra);
	endif;
?>
<table width="100%" border="0" cellspacing="1" cellpadding="1"  align="center">	
	<?php 
		for($a = 0; $a < $nr_horasextra; $a++): 
			$rw_horasextra = fncfetch($rs_horasextra, $a);
			
			if($a % 2)
				$complement = 'class="NoiseDataTD"';
			else
				$complement = 'class="NoiseFooterTD"';
	?>
	<tr <?php echo $complement ?>>
		<td width="30"><input type="checkbox" id="chkhecode" name="chkhecode" onclick="setSelectionRow(this.value, document.getElementById('arrhecode').value, ',', 'hecode');" value="<?php echo $rw_horasextra['horextcodigo'] ?>"></td>
		<td width="80">&nbsp;<?php echo $rw_horasextra['horextfecha']  ?></td>
		<td width="80">&nbsp;<?php echo date("h:i a", strtotime($rw_horasextra['horextfecha'].' '.$rw_horasextra['horexthorini'])) ?></td>
		<td width="80">&nbsp;<?php echo date("h:i a", strtotime($rw_horasextra['horextfecha'].' '.$rw_horasextra['horexthorfin'])) ?></td>
		<td width="255">&nbsp;<?php echo  utf8_encode(substr($rw_horasextra['horextdescri'],0,40)); if(strlen($rw_horasextra['horextdescri']) > 40) echo '...'; ?></td>
	</tr>
	<?php 
		endfor; 
	
		if($a < 9):
			for($b = $a; $b < 9; $b++):
			
				if($b % 2)
					$class = "NoiseDataTD";
				else
					$class = "NoiseFooterTD";
	?>
	<tr class="<?php echo $class ?>">
		<td width="30">&nbsp;</td>
		<td width="80">&nbsp;</td>
		<td width="80">&nbsp;</td>
		<td width="80">&nbsp;</td>
		<td width="255">&nbsp;</td>
	</tr>
	<?php
			endfor;
		endif;
	?>
</table>

