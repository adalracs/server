<?php 

	if(!$noAjax){

		include ("../../FunPerPriNiv/pktblplaneaitemdesa.php");
		include ("../../FunPerPriNiv/pktbloppitemdesa.php");
		include ("../../FunPerPriNiv/pktblitemdesa.php");	
		include ("../../FunGen/floadoppitemdesa.php");
		include ("../../FunPerPriNiv/pktblsaldo.php");
		include ("../../FunPerSecNiv/fncsqlrun.php");
		include ("../../FunPerSecNiv/fncnumreg.php");
		include ("../../FunPerSecNiv/fncclose.php");
		include ("../../FunPerSecNiv/fncfetch.php");
		include ("../../FunPerSecNiv/fncconn.php");
		include ("../../FunGen/cargainput.php");
	}	
	
?>
<div style="width:900px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="40" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel</td>
				<td width="60" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Item</td>
				<td width="360" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Material</td>
				<td width="80" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Disponible</td>
				<td width="80" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Pendiente</td>
				<td width="80" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Final</td>
				<td width="80" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;<small>identificador</small></td>
				<td width="100" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Consumo<small>(kgs)</small></td>
				<td width="20" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:900px; height: 95px; overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:880px; height: auto;  z-index: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	$idcon = fncconn();
	if($arritem) $arrObject = explode(":|:",$arritem);
	
	for($a = 0;$a< count($arrObject);$a++){

		$rowObject = explode(":-:",$arrObject[$a]);
		$obj_consumo = "consumo_".$arrObject[$a];
		$obj_itedescodigoid = "itedescodigoid_".$arrObject[$a];

		if($rowObject[1] == "t"){
			($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
			$rwSaldo = loadrecordsaldo($rowObject[2],$idcon);
			$rwItemdesa = loadrecorditemdesa($rwSaldo["itedescodigo"],$idcon);
			$idcheck = $rwItemdesa["itedescodigo"].":-:t:-:".$rwSaldo["saldocodigo"];
?>
			<tr <?php echo $complement ?> >
				<td width="40" style=" border-bottom: 1px solid #fff;"><?php if(!$flagdetallar):?><input type="checkbox" name="chkarritem" id="chkarritem" value="<?php echo $arrObject[$a]; ?>" onclick="setSelectionRow(this.value, document.getElementById('arritemtmp').value, ':|:', 'arritemtmp');" /><?php else:?>&nbsp;&nbsp;&nbsp;<b>X</b><?php endif;?></td>
				<td width="60" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItemdesa["itedescodigo"]?></td>
				<td width="360" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItemdesa["itedesnombre"]?>&nbsp;{Saldo}&nbsp;<?php echo "[".$rwSaldo['saldoubicaci']." - ".$rwSaldo['saldoposicio']."]"; ?></td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;---</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;---</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;---</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;
				<?php if(!$flagdetallar){?>
					<select name="<?php echo $obj_itedescodigoid; ?>" id="<?php echo $obj_itedescodigoid; ?>" class="<?php if($campnomb[$obj_itedescodigoid] == 1) echo 'ui-state-error ui-corner-all'; ?>" >
						<option value="">--Sel.--</option>
						<?php floadoppitemdesa($$obj_itedescodigoid,$ordoppcodigo,$idcon); ?>
					</select>
				<?php }else{ ?>

					<input type="hidden" name="<?php echo $obj_itedescodigoid; ?>" id="<?php $obj_itedescodigoid; ?>" value="<?php  echo $$obj_itedescodigoid; ?>">&nbsp;<?php echo ($$obj_itedescodigoid)? $$obj_itedescodigoid : "---" ; ?>


				<?php } ?>
				</td>
				<td width="100" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo ($rwSaldo["saldocantkgs"])? number_format($rwSaldo["saldocantkgs"], 2, ",", ".") : "---" ; ?></td>
			</tr>
<?php 
		}else{

			($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
			$rwItemdesa = loadrecorditemdesa($rowObject[0],$idcon);
			$idcheck = $rwItemdesa["itedescodigo"].":-:f";

			$rwPlaneaItemDesa = loadrecordplaneaitemdesasum($rwItemdesa["itedescodigo"], $idcon);
			$rwOppItemDesa = loadrecordoppitemdesasumopp($rwItemdesa["itedescodigo"], $idcon);
?>
			<tr <?php echo $complement ?> >
				<td width="40" style=" border-bottom: 1px solid #fff;"><?php if(!$flagdetallar):?><input type="checkbox" name="chkarritem" id="chkarritem" value="<?php echo $arrObject[$a]; ?>" onclick="setSelectionRow(this.value, document.getElementById('arritemtmp').value, ',', 'arritemtmp');" /><?php else:?>&nbsp;&nbsp;&nbsp;<b>X</b><?php endif;?></td>
				<td width="60" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItemdesa["itedescodigo"]?></td>
				<td width="360" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItemdesa["itedesnombre"]?>&nbsp;{Inventario}</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwItemdesa["itedesinvent"], 2, ",", "."); ?> </td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwPlaneaItemDesa["plaitecantid"], 2, ",", "."); ?></td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwItemdesa["itedesinvent"] - $rwPlaneaItemDesa["plaitecantid"], 2, ",", "."); ?></td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;---</td>
				<td width="100" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php if(!$flagdetallar){?><input type="text" name="<?php echo $obj_consumo ?>" id="<?php echo $obj_consumo ?>" value="<?php echo $$obj_consumo ?>" class="<?php if($campnomb[$obj_consumo] == 1) echo 'ui-state-error ui-corner-all'; ?>" size="4" /><?php }else{?><input type="hidden" name="<?php echo $obj_consumo ?>" id="<?php echo $obj_consumo ?>" value="<?php echo $$obj_consumo ?>" class="<?php if($campnomb[$obj_consumo] == 1) echo 'ui-state-error ui-corner-all'; ?>" /><?php echo number_format($$obj_consumo, 2, ",", "."); ?><?php } ?></td>
			</tr>
<?php
		}

	}
	
	if($a < 5){
		for($b = $a; $b < 9; $b++){
			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="40" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="60" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="360" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="100" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
			}
		}
?>
		</table>
	</div>
</div>