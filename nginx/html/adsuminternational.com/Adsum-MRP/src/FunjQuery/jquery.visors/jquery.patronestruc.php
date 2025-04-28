<?php 

	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerPriNiv/pktblpadreitem.php';
	endif;


?>


<div style="width:600px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="50" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel</td>
				<td width="50" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp; No.</td>
				<td width="485" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Material</td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:600px; height: 100px; overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:583px; height: auto;  z-index: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	if($arrpatronestruc):
		$arrObjpatronestruc = explode(':|:',$arrpatronestruc);
		$idcon = fncconn();
		for($a = 0; $a < count($arrObjpatronestruc); $a++):
			$rowObjpatronestruc = explode(':-:',$arrObjpatronestruc[$a]);
			$rwItem = loadrecordpadreitem($rowObjpatronestruc[1],$idcon);
			($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
?>			
			<tr <?php echo $complement ?>">
				<td width="50" style=" border-bottom: 1px solid #fff;"><?php if(!$flagdetallar):?><input type="checkbox" id="chkpatronestruc" name="chkpatronestruc" <?php echo $checked ?> onclick="setSelectionRow(this.value, document.getElementById('arrpatronestructmp').value, ':|:', 'patronestructmp');" value="<?php echo $arrObjpatronestruc[$a] ?>"><?php else:?>&nbsp;&nbsp;&nbsp;<b>X</b><?php endif;?></td>
				<td width="50" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rowObjpatronestruc[0] ?>&nbsp;</td>
				<td width="483" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItem['paditenombre'] ?>&nbsp;<?php if($a == 0) echo '<b>MATERIAL IMPRESO</b>'; ?>&nbsp;</td>
			</tr>
<?php
		endfor;
	endif;
	
	
	if($a < 10):
		for($b = $a; $b < 10; $b++):
			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="50" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="50" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="483" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
			endfor;
		endif;	
?>
		</table>
	</div>
</div>