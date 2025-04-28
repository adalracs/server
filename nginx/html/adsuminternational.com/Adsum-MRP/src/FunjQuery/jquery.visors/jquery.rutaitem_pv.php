<div style="width:380px; height: 150px;  overflow:auto; border-left:0; border-right:0; border-bottom:0; float: left;" class="ui-widget-content">
	<div style="width:360px; height: auto;  z-index: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	if($rutaitem_pv):
		$arrTmp = explode(',',$rutaitem_pv);
	
		for($a = 0; $a < count($arrTmp); $a++):
			($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
?>			
			<tr <?php echo $complement ?>">
				<td width="360" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo strtoupper($arrTmp[$a]) ?></td>
			</tr>
<?php
		endfor;
	else:
		unset($a);
	endif;
	
	if($a < 12):
		for($b = $a; $b < 12; $b++):
			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="360" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
		endfor;
	endif;	
?>
		</table>
	</div>
</div>