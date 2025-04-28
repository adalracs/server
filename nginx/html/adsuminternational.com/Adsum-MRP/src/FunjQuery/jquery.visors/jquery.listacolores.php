<div style="width:380px; height: 70px;  overflow:auto; border-left:0; border-right:0; border-bottom:0; float: left;" class="ui-widget-content">
	<div style="width:360px; height: auto;  z-index: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	if($list_colors):
		$arrTmp = explode(',',$list_colors);
	
		for($a = 0; $a < count($arrTmp); $a++):
			($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
?>			
			<tr <?php echo $complement ?>">
				<td width="50" style=" border-bottom: 1px solid #fff;"><input type="checkbox" id="chklistacolores" name="chklistacolores" <?php echo $checked ?> onclick="setSelectionRow(this.value, document.getElementById('list_colors').value, ',', 'list_colors');" value="<?php echo $arrTmp[$a] ?>"></td>
				<td width="310" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $arrTmp[$a] ?></td>
			</tr>
<?php
		endfor;
	endif;
	
	if($a < 9):
		for($b = $a; $b < 9; $b++):
			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="50" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="310" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
		endfor;
	endif;	
?>
		</table>
	</div>
</div>