<?php 
	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerPriNiv/pktblproducto.php';	
	endif;

?>
<div style="width:750px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="30" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel</td>
				<td width="70" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Item</td>
				<td width="435" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Producto</td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:750px; height: 100px; overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:100%; height: auto;  z-index: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
		
<?php 
	if($arrproduccoduno):
		$array_tmp = explode(',',$arrproduccoduno);
		$idcon = fncconn();
		for($a = 0; $a < count($array_tmp); $a++):
			($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
			$rwItem = loadrecordproducto1($array_tmp[$a],$idcon);
?>			
			<tr <?php echo $complement ?>">
				<td width="30" style=" border-bottom: 1px solid #fff;"><?php if(!$flagdetallar):?><input type="checkbox" id="chkproduccoduno" name="chkproduccoduno" <?php echo $checked ?> onclick="setSelectionRow(this.value, document.getElementById('arrproduccodunotmp').value, ',', 'produccodunotmp');" value="<?php echo $array_tmp[$a] ?>"><?php else:?>&nbsp;&nbsp;&nbsp;<b>X</b><?php endif;?></td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItem['produccoduno'] ?></td>
				<td width="435" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItem['producnombre']?></td>
			</tr>
<?php
		endfor;
	endif;
	
	
	if($a < 10):
		for($b = $a; $b < 6; $b++):
			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="30" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="435" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
			endfor;
		endif;	
?>
		</table>
	</div>
</div>
<input type="hidden" name="arrproduccoduno" id="arrproduccoduno" size="60"value="<?php echo $arrproduccoduno ?>" />
<input type="hidden" name="arrproduccodunotmp" id="arrproduccodunotmp" size="60"value="<?php echo $arrproduccodunotmp ?>" />
