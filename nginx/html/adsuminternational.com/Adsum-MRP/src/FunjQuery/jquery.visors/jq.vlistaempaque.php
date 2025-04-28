<?php

	if(!$noAjax)
	{
		include '../../FunGen/cargainput.php';
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerSecNiv/fncsqlrun.php';
		include '../../FunPerPriNiv/pktblreporteoppreportepn.php';
	}
	
?>
<div style="width:800px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="30" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel</td>
				<td width="70" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Item</td>
				<td width="325" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Material</td>
				<td width="60" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;<b># Bo/Ca</b></td>
				<td width="80" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;<b>(kgs)</b></td>
				<td width="80" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;<b>(mts)</b></td>
				<td width="80" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;<b>(und)</b></td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:800px; height: 125px; overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:100%; height: auto;  z-index: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	$idcon = fncconn();
	
	if($arrlistaempaque) $arrObjslistaempaque = explode(',',$arrlistaempaque);
	for($a = 0;$a< count($arrObjslistaempaque);$a++){
		$rwReporteoporeportepn = loadrecordreporteoppreportepn($arrObjslistaempaque[$a],$idcon);
		$total_kilos = $total_kilos + $rwReporteoporeportepn['reoppncantkg'];
		$total_metros = $total_metros + $rwReporteoporeportepn['reoppncantmt'];
		$total_unidades = $total_unidades + $rwReporteoporeportepn['reoppncantun'];
		($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';			
?>
			<tr <?php echo $complement ?>">
				<td width="30" style=" border-bottom: 1px solid #fff;"><?php if(!$flagdetallar):?><input type="checkbox" name="chkarrlistaempaque" id="chkarrlistaempaque" value="<?php echo $arrObjslistaempaque[$a] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrlistaempaquetmp').value, ',', 'arrlistaempaquetmp');" /><?php else:?>&nbsp;&nbsp;&nbsp;<b>X</b><?php endif;?></td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $produccoduno.'::PR'; ?></td>
				<td width="325" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $producnombre; ?> </td>
				<td width="60" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwReporteoporeportepn['reoppnbobina'],2,',','.'); ?></td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwReporteoporeportepn['reoppncantkg'],2,',','.'); ?></td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwReporteoporeportepn['reoppncantmt'],2,',','.'); ?></td>
				<td width="78" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwReporteoporeportepn['reoppncantun'],2,',','.'); ?></td>
			</tr>
<?php 	
	}
	
	if($a < 20){
		for($b = $a; $b < 30; $b++){
			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="30" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="325" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="60" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="78" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
			}
		}
?>
		</table>
	</div>
</div>
<div>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
		<tr>
			<td width="15%" class="ui-state-default">&nbsp;Total Kilos&nbsp;</td>
			<td width="15%" class="NoiseDataTD">&nbsp;<span id="total_kilos"><?php echo number_format($total_kilos,2,',','.'); ?></span></td>
			<td width="15%" class="ui-state-default">&nbsp;Total Metros&nbsp;</td>
			<td width="20%" class="NoiseDataTD">&nbsp;<span id="total_metros"><?php echo number_format($total_metros,2,',','.'); ?></span></td>
			<td width="15%" class="ui-state-default">&nbsp;Total Unidades&nbsp;</td>
			<td width="20%" class="NoiseDataTD">&nbsp;<span id="total_unidades"><?php echo number_format($total_unidades,2,',','.'); ?></span></td>
		</tr>
	</table>
</div>