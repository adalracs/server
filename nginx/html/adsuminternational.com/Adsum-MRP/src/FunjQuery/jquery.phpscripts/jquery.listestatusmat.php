<?php 

	if(!$noAjax){

		include ("../../FunPerPriNiv/pktblvistaestatusmat.php");
		include ("../../FunPerPriNiv/pktblplaneaitemdesa.php");
		include ("../../FunPerPriNiv/pktblfamestatusmat.php");
		include ("../../FunPerPriNiv/pktbloppitemdesa.php");
		include ("../../FunPerPriNiv/pktblitemdesa.php");		
		include ("../../FunPerSecNiv/fncnumreg.php");
		include ("../../FunPerSecNiv/fncsqlrun.php");
		include ("../../FunPerSecNiv/fncclose.php");
		include ("../../FunPerSecNiv/fncfetch.php");
		include ("../../FunPerSecNiv/fncconn.php");
		include ("../../FunGen/cargainput.php");
	}

	if($itedesancho || $itedescalib || $arrfamestatusmat || $itedesformul){

		$record["itedesancho"] = $itedesancho;
		$recordop["itedesancho"] = "=";

		$record["itedescalib"] = $itedescalib;
		$recordop["itedescalib"] = "=";

		$record["itedesformul"] = $itedesformul;
		$recordop["itedesformul"] = "=";

		$record["famestcodigo"] = $arrfamestatusmat;
		$recordop["famestcodigo"] = "in";

		$idcon = fncconn();

		$rsEstatusMat = dinamicscanopvistaestatusmat($record, $recordop, $idcon);
	}

	$nrEstatusMat = fncnumreg($rsEstatusMat);
?>
<div style="width:100%; height: auto" class="ui-state-default">
	<div style="width:99%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="5%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Item</td>
				<td width="24%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Descripci&oacute;n</td>			
				<td width="8%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Formula</td>	
				<td width="10%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Ancho&nbsp;<b>(mm)</b></td>
				<td width="10%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Calibre&nbsp;<b>(&micro;m)</b></td>
				<td width="8%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Disponible</td>
				<td width="8%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Consumo</td>
				<td width="8%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Saldo Final</td>
				<td width="8%" class="ui-state-default" style="border:0;">&nbsp;Transito</td>
				<td width="1%" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:100%; height: 480px; overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:99%; height: auto;  z-index: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	for($a = 0;$a< $nrEstatusMat;$a++){
		$rwEstatusMat = fncfetch($rsEstatusMat, $a);
		$rwPlaneaItemDesa = loadrecordplaneaitemdesasum($rwEstatusMat["itedescodigo"], $idcon);
		$rwOppItemDesa = loadrecordoppitemdesasumopp($rwEstatusMat["itedescodigo"], $idcon);

		$color = ( ( ($rwEstatusMat["itedesinvent"] + $rwOppItemDesa["oppitecantid"]) - $rwPlaneaItemDesa["plaitecantid"] ) > 0 )? "blue" : "red" ;
		($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
?>
			<tr <?php echo $complement ?>>
				<td width="5%" style=" border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwEstatusMat["itedescodigo"]; ?></td>
				<td width="24%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwEstatusMat["itedesnombre"]; ?></td>				
				<td width="8%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo ($rwEstatusMat['itedesformul'])? $rwEstatusMat['itedesformul'] : "---" ;?></td>
				<td width="10%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwEstatusMat['itedesancho'], 2, ",", "."); ?></td>
				<td width="10%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwEstatusMat['itedescalib'], 2, ",", "."); ?></td>
				<td width="8%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwEstatusMat['itedesinvent'], 2, ",", ".");?></td>
				<td width="8%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwPlaneaItemDesa["plaitecantid"], 2, ",", ".");?></td>
				<td width="8%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<font color="<?php echo $color; ?>"><b><?php echo number_format( ($rwEstatusMat["itedesinvent"] + $rwOppItemDesa["oppitecantid"]) - $rwPlaneaItemDesa["plaitecantid"], 2, ",", ".")?></b></font></td>
				<td width="8%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwEstatusMat["itedescantoc"] - $rwEstatusMat["itedescantec"],2, ",", "."); ?></td>
			</tr>
<?php
	}
	
	if($a < 40){

		for($b = $a; $b < 40; $b++){

			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="5%" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="24%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="8%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="10%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="10%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="8%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="8%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="8%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="8%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
		}
	}
?>
		</table>
	</div>
</div>