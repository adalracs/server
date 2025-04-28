<?php 

	if(!$noAjax)
	{
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerSecNiv/fncsqlrun.php';
		include '../../FunPerPriNiv/pktblitemdesa.php';
		include '../../FunGen/cargainput.php';
	}
	
?>
<div style="width:800px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="30" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel</td>
				<td width="30" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;# B.</td>
				<td width="80" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Item</td>
				<td width="325" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Material</td>
				<td width="60" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Lote</td>
				<td width="110" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Kilogramos&nbsp;<b>(kgs)</b></td>
				<td width="100" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Metros&nbsp;<b>(mts)</b></td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:800px; height: 95px; overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:100%; height: auto;  z-index: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	$idcon = fncconn();
	if($arrbobina) $arrObject = explode(':|:',$arrbobina);
	for($a = 0;$a< count($arrObject);$a++){
		$rowObject = explode(':-:',$arrObject[$a]);
		$rwItemdesa = loadrecorditemdesa($rowObject[1],$idcon);
		$obj_consumomt = 'consumomt_'.$rowObject[0].'_'.$rwItemdesa['itedescodigo'];
		$obj_consumokg = 'consumokg_'.$rowObject[0].'_'.$rwItemdesa['itedescodigo'];
		$obj_lote = 'lote_'.$rowObject[0].'_'.$rwItemdesa['itedescodigo'];
		($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
?>
			<tr <?php echo $complement ?>">
				<td width="30" style=" border-bottom: 1px solid #fff;"><?php if(!$flagdetallar):?><input type="checkbox" name="chkarrbobina" id="chkarrbobina" value="<?php echo $arrObject[$a] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrbobinatmp').value, ':|:', 'arrbobinatmp');" /><?php else:?>&nbsp;&nbsp;&nbsp;<b>X</b><?php endif;?></td>
				<td width="30" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo ($a + 1); ?></td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItemdesa['itedescodigo']?> </td>
				<td width="325" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItemdesa['itedesnombre']?> </td>
				<td width="60" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php if(!$flagdetallar){?><input type="text" name="<?php echo $obj_lote ?>" id="<?php echo $obj_lote ?>" value="<?php echo $$obj_lote ?>" size="4" /><?php }else{?><input type="hidden" name="<?php echo $obj_lote ?>" id="<?php echo $obj_lote ?>" value="<?php echo $$obj_lote ?>" /><?php echo $$obj_lote ?><?php } ?></td>
				<td width="110" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php if(!$flagdetallar){?><input type="text" name="<?php echo $obj_consumokg ?>" id="<?php echo $obj_consumokg ?>" value="<?php echo $$obj_consumokg ?>" size="9" /><?php }else{?><input type="hidden" name="<?php echo $obj_consumokg ?>" id="<?php echo $obj_consumo ?>" value="<?php echo $$obj_consumokg ?>" /><?php echo $$obj_consumokg ?><?php } ?></td>
				<td width="98" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php if(!$flagdetallar){?><input type="text" name="<?php echo $obj_consumomt ?>" id="<?php echo $obj_consumomt ?>" value="<?php echo $$obj_consumomt ?>" size="9" /><?php }else{?><input type="hidden" name="<?php echo $obj_consumomt ?>" id="<?php echo $obj_consumomt ?>" value="<?php echo $$obj_consumomt ?>" /><?php echo $$obj_consumomt ?><?php } ?></td>
			</tr>
<?php 
	}
	
	if($a < 5){
		for($b = $a; $b < 9; $b++){
			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="30" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="30" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="85" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="325" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="60" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="110" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="98" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
			}
		}
?>
		</table>
	</div>
</div>