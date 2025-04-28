<?php 

	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerPriNiv/pktblitemdesa.php';
	endif;


?>


<div style="width:800px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="35" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel</td>
				<td width="35" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Capa</td>
				<td width="50" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Item</td>
				<td width="340" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Material</td>
				<td width="60" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Slip</td>
				<td width="70" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Antiblock</td>
				<td width="50" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;<b>%</b></td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:800px; height: 200px; overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:783px; height: auto;  z-index: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	if($arrformulacion):
		$array_tmp = explode(':|:',$arrformulacion);
		$idcon = fncconn();
		for($a = 0; $a < count($array_tmp); $a++):
			$rwArray_tmp = explode(':-:', $array_tmp[$a]);
			($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
			
			$rwItem = loadrecorditemdesa($rwArray_tmp[0],$idcon);
			
?>			
			<tr <?php echo $complement ?>">
				<td width="35" style=" border-bottom: 1px solid #fff;">&nbsp;&nbsp;<?php if(!$fladetallar):?><input type="checkbox" id="chkformulacion" name="chkformulacion" <?php echo $checked ?> onclick="setSelectionRow(this.value, document.getElementById('arrformulacion').value, ':|:', 'formulacion');" value="<?php echo $array_tmp[$a] ?>"><?php else:?>&nbsp;<b>X</b><?php endif?></td>
				<td width="35" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo ($rwArray_tmp[1]) ?> </td>
				<td width="50" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItem['itedescodigo'] ?></td>
				<td width="340" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItem['itedesnombre'] ?></td>
				<td width="60" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo (int)$rwArray_tmp[3] * ($rwArray_tmp[2] / 100) ?></td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo (int)$rwArray_tmp[4] * ($rwArray_tmp[2] / 100) ?></td>
				<td width="50" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwArray_tmp[2] ?>&nbsp;<b>%</b></td>
			</tr>
<?php
		endfor;
	endif;
	
	if($a < 30):
		for($b = $a; $b < 18; $b++):
			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="35" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="35" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="50" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="340" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="60" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="50" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
			endfor;
		endif;	
?>
		</table>
	</div>
</div>
<input type="hidden" name="arrformulacion" id="arrformulacion" size="60"value="<?php echo $arrformulacion ?>" />