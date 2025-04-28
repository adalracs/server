<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr class="ui-state-default">
		<td class="cont-title"><?php if($campnomb["arrgestionoppreporte"] == 1){ $arrgestionoppreporte = null;echo "*";}?>&nbsp;Bobinas Pendientes Por Aprobar</td>
	</tr>
</table>
<div style="padding: 2px 2px 2px 2px;" >
	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
<?php 
		$rsGestionopp = dinamicscanopgestionopp(array( "ordoppcodigo" => $ordoppcodigo, "gesopptipo" => "2" ),array( "ordoppcodigo" => "=", "gesopptipo" => "=" ),$idcon);
		$nrGestionopp = fncnumreg($rsGestionopp);

		if(!$nrGestionopp){
?>
		<tr>
			<td>
				<div class="ui-widget">
					 <div style="margin-top: 1px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all"> 
				  		<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
				  		<b>No se encontraron gestiones de entrega de materiales.</b></p>
				 	</div>
				</div>
			</td>
		</tr>
<?php 
		}else{

			$vgestionentrega = 0;

			//gestion de materiales de inventario
			for( $a = 0; $a < $nrGestionopp; $a++){

				$rwGestionopp = fncfetch($rsGestionopp,$a);
				$rsGestionoppreporte = dinamicscanopgestionoppreporte(array("gesoppcodigo" => $rwGestionopp["gesoppcodigo"], "geopreestado" => "0"),array("gesoppcodigo" => "=", "geopreestado" => "="),$idcon);
				$nrGestionoppreporte = fncnumreg($rsGestionoppreporte);

				if($nrGestionoppreporte > 0){
					$vgestionentrega = 1;
?>
		<tr>
			<td class="NoiseDataTD row-soliserv">&nbsp;</td>
			<td colspan="4">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
					<tr>
						<td class="ui-state-default row-soliserv" width="60%">&nbsp;Item - Descripcion</td>
						<td class="ui-state-default row-soliserv" width="15%">&nbsp;Kilogramos</td>
						<td class="ui-state-default row-soliserv" width="15%">&nbsp;Metros</td>
						<td class="ui-state-default row-soliserv" width="5%" align="center">&nbsp;<span class="ui-icon ui-icon-check" style="float: left;"></span></td>
						<td class="ui-state-default row-soliserv" width="5%" align="center">&nbsp;<span class="ui-icon ui-icon-close" style="float: left;"></span></td>
					</tr>
<?php
					for( $b = 0; $b < $nrGestionoppreporte; $b++){
						$rwGestionoppreporte = fncfetch($rsGestionoppreporte,$b);

						$objRadioButton = "chkgestionoppreporte_".$b;
?>
					<tr>
						<td class="NoiseDataTD row-soliserv" width="60%">&nbsp;<b>Entrega :</b>&nbsp;<?php echo carganombitemdesa1($rwGestionoppreporte["itedescodigo"],$idcon); ?></td>
						<td class="NoiseDataTD row-soliserv" width="15%">&nbsp;<?php echo number_format($rwGestionoppreporte["gesoppcantkg"], 2, ",", ".");?><!--&nbsp;<b>(kgs)</b>--></td>
						<td class="NoiseDataTD row-soliserv" width="15%">&nbsp;<?php echo number_format($rwGestionoppreporte["gesoppcantmt"], 2, ",", ".");?><!--&nbsp;<b>(mts)</b>--></td>
						<td class="NoiseDataTD row-soliserv" width="5%" align="center">
							<input type="radio" name="<?php echo $objRadioButton; ?>" id="<?php echo $objRadioButton; ?>" value="<?php echo $rwGestionoppreporte['geoprecodigo'].':-:f:-:1'; ?>" <?php echo $checked ?> onclick="vRadioButton(this.value,'<?php echo $rwGestionoppreporte['geoprecodigo'].':-:f:-:-1'; ?>',0);">
						</td>
						<td class="NoiseDataTD row-soliserv" width="5%" align="center">
							<input type="radio" name="<?php echo $objRadioButton; ?>" id="<?php echo $objRadioButton; ?>" value="<?php echo $rwGestionoppreporte['geoprecodigo'].':-:f:-:-1'; ?>" <?php echo $checked ?> onclick="vRadioButton(this.value, '<?php echo $rwGestionoppreporte['geoprecodigo'].':-:f:-:1'; ?>',1);">
						</td>
					</tr>
<?php 
					}
?>
				</table>
			</td>
		</tr>
<?php
				}
			}

			//gestion de saldo
			for( $a = 0; $a < $nrGestionopp; $a++){

				$rwGestionopp = fncfetch($rsGestionopp,$a);
				$rsGestionoppreportesaldo = dinamicscanopgestionoppreportesaldo(array("gesoppcodigo" => $rwGestionopp["gesoppcodigo"], "geopreestado" => "0"),array("gesoppcodigo" => "=", "geopreestado" => "="),$idcon);
				$nrGestionoppreportesaldo = fncnumreg($rsGestionoppreportesaldo);

				if($nrGestionoppreportesaldo > 0){

					if($vgestionentrega < 1){
?>
		<tr>
			<td class="NoiseDataTD row-soliserv">&nbsp;</td>
			<td colspan="4">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
					<tr>
						<td class="ui-state-default row-soliserv" width="60%">&nbsp;Item - Descripcion</td>
						<td class="ui-state-default row-soliserv" width="15%">&nbsp;Kilogramos</td>
						<td class="ui-state-default row-soliserv" width="15%">&nbsp;Metros</td>
						<td class="ui-state-default row-soliserv" width="5%" align="center">&nbsp;<span class="ui-icon ui-icon-check" style="float: left;"></span></td>
						<td class="ui-state-default row-soliserv" width="5%" align="center">&nbsp;<span class="ui-icon ui-icon-close" style="float: left;"></span></td>
					</tr>

<?php
					}

					$vgestionentrega = 1;

					for( $b = 0; $b < $nrGestionoppreportesaldo; $b++){
						$rwGestionoppreportesaldo = fncfetch($rsGestionoppreportesaldo,$b);
						$rwSaldo = loadrecordsaldo($rwGestionoppreportesaldo["saldocodigo"], $idcon);

						$objRadioButton = "chkgestionoppreporte_".$b;
?>
					
					<tr>
						<td class="NoiseDataTD row-soliserv" width="60%">&nbsp;<b>Entrega :</b>&nbsp;<?php echo carganombitemdesa1($rwSaldo["itedescodigo"],$idcon); ?>&nbsp;<b>{Saldo}</b></td>
						<td class="NoiseDataTD row-soliserv" width="15%">&nbsp;<?php echo number_format($rwSaldo["saldocantkgs"], 2, ",", ".");?>&nbsp;<b>(kgs)</b></td>
						<td class="NoiseDataTD row-soliserv" width="15%">&nbsp;<?php echo number_format($rwSaldo["saldocantmts"], 2, ",", ".");?>&nbsp;<b>(mts)</b></td>
						<td class="NoiseDataTD row-soliserv" width="5%" align="center">
							<input type="radio" name="<?php echo $objRadioButton; ?>" id="<?php echo $objRadioButton; ?>" value="<?php echo $rwGestionoppreporte['geoprecodigo'].':-:t:-:1'; ?>" <?php echo $checked ?> onclick="vRadioButton(this.value,'<?php echo $rwGestionoppreporte['geoprecodigo'].':-:t:-:-1'; ?>',0);">
						</td>
						<td class="NoiseDataTD row-soliserv" width="5%" align="center">
							<input type="radio" name="<?php echo $objRadioButton; ?>" id="<?php echo $objRadioButton; ?>" value="<?php echo $rwGestionoppreporte['geoprecodigo'].':-:t:-:-1'; ?>" <?php echo $checked ?> onclick="vRadioButton(this.value, '<?php echo $rwGestionoppreporte['geoprecodigo'].':-:t:-:1'; ?>',1);">
						</td>
					</tr>
<?php

					}
?>
				</table>
			</td>
		</tr>
<?php					
				}
			}

			if($vgestionentrega == 0){
?>
		<tr>
			<td>
				<div class="ui-widget">
					 <div style="margin-top: 1px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all"> 
				  		<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
				  		<b>No se encontraron Reportes de materiales pendientes por aprobar.</b></p>
				 	</div>
				</div>
			</td>
		</tr>
<?php
			}


		}
?>
	</table>
</div>