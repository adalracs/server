<?php 

	if(!$noAjax){

		include ("../../FunPerPriNiv/pktblplaneaitemdesa.php");
		include ("../../FunPerPriNiv/pktbloppitemdesa.php");
		include ("../../FunPerPriNiv/pktblitemdesa.php");
		include ("../../FunPerPriNiv/pktblsaldo.php");
		include ("../../FunPerSecNiv/fncnumreg.php");
		include ("../../FunPerSecNiv/fncsqlrun.php");
		include ("../../FunGen/floadoppitemdesa.php");
		include ("../../FunPerSecNiv/fncfetch.php");
		include ("../../FunPerSecNiv/fncclose.php");
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
				<td width="180" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Consumo<small>(kgs)</small></td>
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

	if($arrplaneacionopp) $objsarrplaneacionopp = explode(",", $arrplaneacionopp); else unset($objsarrplaneacionopp);
	
	for($a = 0; $a < count($objsarrplaneacionopp); $a++){

		$rwItemdesa = loadrecorditemdesa($objsarrplaneacionopp[$a], $idcon);

		($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
		$obj_consumo = "consumo_".$objsarrplaneacionopp[$a];

		$rwPlaneaItemDesa = loadrecordplaneaitemdesasum($rwItemdesa["itedescodigo"], $idcon);
		$rwOppItemDesa = loadrecordoppitemdesasumopp($rwItemdesa["itedescodigo"], $idcon);
?>
		<tr <?php echo $complement ?> >
			<td width="40" style=" border-bottom: 1px solid #fff;">

				<?php if(!$flagdetallar):?>

					<input type="checkbox" name="chkarrplaneacionopp" id="chkarrplaneacionopp" value="<?php echo $objsarrplaneacionopp[$a]; ?>" onclick="setSelectionRow(this.value, document.getElementById('arrplaneacionopptmp').value, ',', 'arrplaneacionopptmp');" />
				<?php else:?>

					&nbsp;&nbsp;&nbsp;<b>X</b>
				<?php endif;?>
			</td>
			<td width="60" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItemdesa["itedescodigo"]?></td>
			<td width="360" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItemdesa["itedesnombre"]?></td>
			<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwItemdesa['itedesinvent'], 2, ",", "."); ?></td>
			<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwPlaneaItemDesa["plaitecantid"], 2, ",", "."); ?></td>
			<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwItemdesa["itedesinvent"] - $rwPlaneaItemDesa["plaitecantid"], 2, ",", "."); ?></td>
			<td width="180" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;
				<?php if(!$flagdetallar):?>
					<input type="text" name="<?php echo $obj_consumo; ?>" id="<?php echo $obj_consumo; ?>" value="<?php echo $$obj_consumo; ?>" size="7" class="<?php if($campnomb[$obj_consumo] == 1) echo 'ui-state-error ui-corner-all'; ?>" />
				<?php else: ?>
					&nbsp;&nbsp;<?php echo ($$obj_consumo)? $$obj_consumo : "---" ;?>
				<?php endif;?>
			</td>
		</tr>
<?php 
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
				<td width="180" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
		}
	}
?>
		</table>
	</div>
</div>