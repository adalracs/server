<?php 
	if(!$noAjax)
	{
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerPriNiv/pktblunimedida.php';
		include '../../FunPerPriNiv/pktbltiposoliprog.php';
		include '../../FunGen/cargainput.php';
	}
	setlocale(LC_MONETARY, 'en_US');
?>
<div style="width:100%; height: 35px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="4%"  height="35" class="ui-state-default" style="font-size: 9px; border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel</td>
				<td width="10%" height="35" class="ui-state-default" style="font-size: 9px; border-top:0; border-bottom:0; border-left:0;">&nbsp;Proceso</td>
				<td width="10%" height="35" class="ui-state-default" style="font-size: 9px; border-top:0; border-bottom:0; border-left:0;">&nbsp;Horas totales</td>
				<td width="10%" height="35" class="ui-state-default" style="font-size: 9px; border-top:0; border-bottom:0; border-left:0;">&nbsp;Mano de obra directa</td>
				<td width="10%" height="35" class="ui-state-default" style="font-size: 9px; border-top:0; border-bottom:0; border-left:0;">&nbsp;Mano de obra indirecta</td>
				<td width="10%" height="35" class="ui-state-default" style="font-size: 9px; border-top:0; border-bottom:0; border-left:0;">&nbsp;Energia</td>
				<td width="10%" height="35" class="ui-state-default" style="font-size: 9px; border-top:0; border-bottom:0; border-left:0;">&nbsp;Mantenimiento</td>
				<td width="10%" height="35" class="ui-state-default" style="font-size: 9px; border-top:0; border-bottom:0; border-left:0;">&nbsp;Depreciacion</td>
				<td width="10%" height="35" class="ui-state-default" style="font-size: 9px; border-top:0; border-bottom:0; border-left:0;">&nbsp;Otros</td>
				<td width="2%"  height="35" class="ui-state-default" style="font-size: 9px; border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:100%; height: 150px;  overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:100%; height: auto;  z-index: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	if($arrmodcif)
	{
		$array_tmp = explode(',',$arrmodcif);
		$idcon = fncconn();
		
		for($a = 0; $a < count($array_tmp); $a++)
		{
			$complement = ($a % 2) ? ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
			$arrSubTemp = explode("|", $array_tmp[$a]);
			$total = $arrSubTemp[2] * $arrSubTemp[3];
			$proceso = loadrecordtiposoliprog($arrSubTemp[0],$idcon);
?>			
			<tr <?php echo $complement ?>>
				<td width="4%"  class="maestabl-row-list" style=" border-bottom: 1px solid #fff;"><input type="checkbox" id="chkmodcif" name="chkmodcif" onclick="setSelectionRow(this.value, document.getElementById('arrmodcif').value, ',', 'modcif');" value="<?php echo $array_tmp[$a] ?>"></td>
				<td width="10%" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $proceso['tipsoldescri']; ?></td>
				<td width="10%" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($arrSubTemp[1], 2, ',', '.'); ?></td>
				<td width="10%" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($arrSubTemp[2], 2, ',', '.'); ?></td>
				<td width="10%" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($arrSubTemp[3], 2, ',', '.'); ?></td>
				<td width="10%" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($arrSubTemp[4], 2, ',', '.'); ?></td>
				<td width="10%" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($arrSubTemp[5], 2, ',', '.'); ?></td>
				<td width="10%" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($arrSubTemp[6], 2, ',', '.'); ?></td>
				<td width="10%" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($arrSubTemp[7], 2, ',', '.'); ?></td>
			</tr>
<?php
		}
	}
	
	if($a < 13):
		for($b = $a; $b < 13; $b++):
			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="4%"  style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="10%"  style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="10%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="10%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="10%"  style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="10%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="10%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="10%"  style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="10%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
		endfor;
	endif;	
?>
		</table>
	</div>
</div>
<input type="hidden" name="arrmodcif" id="arrmodcif" value="<?php echo $arrmodcif; ?>">