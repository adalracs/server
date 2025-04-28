<?php 
	ini_set("display_errors",1);

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

	$arrLaminado = array(0 => "1ER LAMINADO", 1 => "2DO LAMINADO", 2 => "3ER LAMINADO", 3 => "4TO LAMINADO" );
	
?>
<div style="width:100%; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="3%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel</td>
				<td width="7%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Item</td>
				<td width="30%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Material</td>
				<td width="10%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Disponible.</td>
				<td width="10%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Consumo pdt.</td>
				<td width="10%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Saldo&nbsp;<b>FINAL</b></td>
				<td width="18%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Proceso&nbsp;</td>
				<td width="10%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Consumo&nbsp;<b>(kgs)<b></td>
				<td width="2%" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:100%; height: 250px; overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:100%; height: auto;  z-index: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	$idcon = fncconn();

	if($arrmatplan) $objsarrmatplan = explode(":|:",$arrmatplan); else unset($objsarrmatplan);

	for($a = 0;$a< count($objsarrmatplan);$a++){

		($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
		$rowarrmatplan = explode(":-:",$objsarrmatplan[$a]);

		$rwItemdesa = loadrecorditemdesa($rowarrmatplan[0],$idcon);
		$rwProcedimiento = loadrecordprocedimiento($rowarrmatplan[1],$idcon);
		$obj_consumo = "consumo_".$objsarrmatplan[$a];

		$rwPlaneaItemDesa = loadrecordplaneaitemdesasum($rwItemdesa["itedescodigo"], $idcon);
		$rwOppItemDesa = loadrecordoppitemdesasumopp($rwItemdesa["itedescodigo"], $idcon);
?>
			<tr <?php echo $complement; ?> >
				<td width="3%" style="border-bottom: 1px solid #fff;"><?php if(!$flagdetallar):?><input type="checkbox" name="chkarrmatplan" id="chkarrmatplan" value="<?php echo $objsarrmatplan[$a] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrmatplantmp').value, ':|:', 'matplantmp');" /><?php else:?>&nbsp;&nbsp;&nbsp;<b>X</b><?php endif;?></td>
				<td width="7%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItemdesa["itedescodigo"]?></td>
				<td width="30%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItemdesa["itedesnombre"]?> </td>
				<td width="10%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwItemdesa['itedesinvent'], 2, ",", "."); ?> </td>
				<td width="10%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwPlaneaItemDesa["plaitecantid"], 2, ",", "."); ?></td>
				<td width="10%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format(($rwEstatusMat["itedesinvent"] + $rwOppItemDesa["oppitecantid"]) - $rwPlaneaItemDesa["plaitecantid"], 2, ",", "."); ?></td>
				<td width="18%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php if($rwProcedimiento && ($rowarrmatplan[2] > 0 || $rowarrmatplan[2] == "0") ) echo strtoupper($rwProcedimiento["procednombre"])."/".$arrLaminado[$rowarrmatplan[2]]; elseif($rwProcedimiento) echo strtoupper($rwProcedimiento["procednombre"]); else echo "---"; ?></td>
				<td width="10%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php if(!$flagdetallar){?><input type="text" name="<?php echo $obj_consumo; ?>" id="<?php echo $obj_consumo; ?>" value="<?php echo $$obj_consumo; ?>" size="7" /><?php }else{?><input type="hidden" name="<?php echo $obj_consumo ?>" id="<?php echo $obj_consumo ?>" value="<?php echo $$obj_consumo ?>" /><?php echo $$obj_consumo ?><?php } ?></td>
			</tr>
<?php 
	}
	
	if($a < 20){

		for($b = $a; $b < 20; $b++){

			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="3%" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="7%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="30%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="10%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="10%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="10%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="18%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="10%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
		}
	}
?>
		</table>
	</div>
</div>