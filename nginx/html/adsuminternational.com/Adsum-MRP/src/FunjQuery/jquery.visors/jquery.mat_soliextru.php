<?php 

	if(!$noAjax){

		include ("../../FunPerPriNiv/pktblplaneaitemdesa.php");
		include ("../../FunPerPriNiv/pktblprocedimiento.php");
		include ("../../FunPerPriNiv/pktbloppitemdesa.php");
		include ("../../FunPerPriNiv/pktblitemdesa.php");
		include ("../../FunPerSecNiv/fncconn.php");
		include ("../../FunPerSecNiv/fncclose.php");
		include ("../../FunPerSecNiv/fncnumreg.php");
		include ("../../FunPerSecNiv/fncfetch.php");
		include ("../../FunPerSecNiv/fncsqlrun.php");
		include ("../../FunGen/cargainput.php");
	}
	
?>
<div style="width:740px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="30" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel</td>
				<td width="70" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Item</td>
				<td width="292" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Material</td>
				<td width="70" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Saldo Fin</td>
				<td width="70" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Consumo</td>
				<td width="170" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Proceso</td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:740px; height: 70px; overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:100%; height: auto;  z-index: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	$idcon = fncconn();

	if($arrmatsoliextru) $arrObject = explode(":|:",$arrmatsoliextru); else unset($arrObject);

	for($a = 0;$a< count($arrObject);$a++){

		$rowArrObject = explode(':-:',$arrObject[$a]);
		$rwItemdesa = loadrecorditemdesa($rowArrObject[0],$idcon);
		$rwProcedimiento = loadrecordprocedimiento($rowArrObject[1],$idcon);
		$obj_consumo = 'gessolcantid_'.$arrObject[$a];

		($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';

		$rwPlaneaItemDesa = loadrecordplaneaitemdesasum($rwItemdesa["itedescodigo"], $idcon);
		$rwOppItemDesa = loadrecordoppitemdesasumopp($rwItemdesa["itedescodigo"], $idcon);
?>
			<tr <?php echo $complement ?> >
				<td width="30" style=" border-bottom: 1px solid #fff;"><?php if(!$flagdetallar):?><input type="checkbox" name="chkarrmatsoliextru" id="chkarrmatsoliextru" value="<?php echo $arrObject[$a] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrmatsoliextrutmp').value, ':|:', 'arrmatsoliextrutmp');setSelectionRow(this.value, document.getElementById('arrtarsoliextrutmp').value, ':|:', 'arrtarsoliextrutmp');" /><?php else:?>&nbsp;&nbsp;&nbsp;<b>X</b><?php endif;?></td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItemdesa['itedescodigo']?></td>
				<td width="292" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItemdesa['itedesnombre']?> </td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwItemdesa["itedesinvent"] - $rwPlaneaItemDesa["plaitecantid"], 2, ",", "."); ?> </td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;
					<?php if(!$flagdetallar){?>
						<input type="text" name="<?php echo $obj_consumo ?>" id="<?php echo $obj_consumo ?>" value="<?php echo $$obj_consumo ?>" size="5" class="<?php if($campnomb[$obj_consumo] == 1) echo 'ui-state-error ui-corner-all'; ?>" />
					<?php }else{?>
						<input type="hidden" name="<?php echo $obj_consumo ?>" id="<?php echo $obj_consumo ?>" value="<?php echo $$obj_consumo ?>" /><?php echo $$obj_consumo ?>
						<?php } ?>
				</td>
				<td width="168" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo ($rwProcedimiento)?  strtoupper($rwProcedimiento['procednombre']) : '---' ;?></td>
			</tr>
<?php 
	}
	
	if($a < 5){

		for($b = $a; $b < 5; $b++){

			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="30" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="292" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="168" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
		}
	}
?>
		</table>
	</div>
</div>