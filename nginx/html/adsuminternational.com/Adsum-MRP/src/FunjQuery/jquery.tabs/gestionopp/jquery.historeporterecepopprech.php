<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr class="ui-state-default">
		<td class="cont-title">&nbsp;<a onClick="return verocultar('filgestionoppreporterech',3);" href="javascript:animatedcollapse.toggle('filgestionoppreporterech');"><img id="row3" align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0">Historial Bobinas Rechazadas</a></td>
	</tr>
</table>
<div id="filgestionoppreporterech" style="padding: 2px 2px 2px 2px; display:none;" >
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
				  		<b>No se encontraron gestiones  de entrega de materiales.</b></p>
				 	</div>
				</div>
			</td>
		</tr>
		<?php 
		}else{

			$vgestionentrega = 0;

			$SZreoppncantkg = 0;
			$SZreoppncantmt = 0;
			$bobinano = 0;
			
			//gestion de materiales de inventario
			for( $a = 0; $a < $nrGestionopp; $a++){

				$rwGestionopp = fncfetch($rsGestionopp,$a);
				$rsGestionoppreporte = dinamicscanopgestionoppreporte(array("gesoppcodigo" => $rwGestionopp["gesoppcodigo"], "geopreestado" => "0"),array("gesoppcodigo" => "=", "geopreestado" => "<"),$idcon);
				$nrGestionoppreporte = fncnumreg($rsGestionoppreporte);

				if($nrGestionoppreporte > 0){
					$vgestionentrega = 1;

					for( $b = 0; $b < $nrGestionoppreporte; $b++){
						$rwGestionoppreporte = fncfetch($rsGestionoppreporte,$b);

						$SZreoppncantkg += $rwGestionoppreporte["gesoppcantkg"];
						$SZreoppncantmt += $rwGestionoppreporte["gesoppcantmt"];
						$bobinano++;
?>
		<tr>
			<td class="NoiseDataTD row-soliserv">&nbsp;</td>
			<td colspan="4">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
					<tr>
						<td class="NoiseDataTD row-soliserv" width="5%">&nbsp;</td>
						<td class="NoiseDataTD row-soliserv" width="65%">&nbsp;<b>Rechazada :</b>&nbsp;<?php echo carganombitemdesa1($rwGestionoppreporte["itedescodigo"],$idcon)?></td>
						<td class="NoiseDataTD row-soliserv" width="15%">&nbsp;<?php echo number_format($rwGestionoppreporte["gesoppcantkg"], 2, ",", ".");?>&nbsp;<b>(kgs)</b></td>
						<td class="NoiseDataTD row-soliserv" width="15%">&nbsp;<?php echo number_format($rwGestionoppreporte["gesoppcantmt"], 2, ",", ".");?>&nbsp;<b>(mts)</b></td>
						<td class="NoiseDataTD row-soliserv" align="center">
						
						</td>
					</tr>
				</table>
			</td>
		</tr>
<?php 
					}
				}
			}


			//gestion de saldo
			for( $a = 0; $a < $nrGestionopp; $a++){

				$rwGestionopp = fncfetch($rsGestionopp,$a);
				$rsGestionoppreportesaldo = dinamicscanopgestionoppreportesaldo(array("gesoppcodigo" => $rwGestionopp["gesoppcodigo"], "geopreestado" => "0"),array("gesoppcodigo" => "=", "geopreestado" => "<"),$idcon);
				$nrGestionoppreportesaldo = fncnumreg($rsGestionoppreportesaldo);

				if($nrGestionoppreportesaldo > 0){
					$vgestionentrega = 1;

					for( $b = 0; $b < $nrGestionoppreportesaldo; $b++){
						$rwGestionoppreportesaldo = fncfetch($rsGestionoppreportesaldo,$b);
						$rwSaldo = loadrecordsaldo($rwGestionoppreportesaldo["saldocodigo"], $idcon);

						$SZreoppncantkg += $rwSaldo["saldocantkgs"];
						$SZreoppncantmt += $rwSaldo["saldocantmts"];
						$bobinano++;
?>
		<tr>
			<td class="NoiseDataTD row-soliserv">&nbsp;</td>
			<td colspan="4">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
					<tr>
						<td class="NoiseDataTD row-soliserv" width="5%">&nbsp;</td>
						<td class="NoiseDataTD row-soliserv" width="65%">&nbsp;<b>Rechazada :</b>&nbsp;<?php echo carganombitemdesa1($rwSaldo["itedescodigo"],$idcon)?>&nbsp;<b>{Saldo}</b></td>
						<td class="NoiseDataTD row-soliserv" width="15%">&nbsp;<?php echo number_format($rwSaldo["saldocantkgs"], 2, ",", ".");?>&nbsp;<b>(kgs)</b></td>
						<td class="NoiseDataTD row-soliserv" width="15%">&nbsp;<?php echo number_format($rwSaldo["saldocantmts"], 2, ",", ".");?>&nbsp;<b>(mts)</b></td>
						<td class="NoiseDataTD row-soliserv" align="center"></td>
					</tr>
				</table>
			</td>
		</tr>
<?php 
					}
				}
			}
?>
		<tr>
			<td class="ui-state-default" colspan="5">&nbsp;Total Rechazado:&nbsp;<?php echo number_format($SZreoppncantkg, 2, ',', '.'); ?>&nbsp;(kgs)&nbsp;&nbsp;&nbsp;<?php echo number_format($SZreoppncantmt, 2, ',', '.'); ?>&nbsp;(mts)&nbsp;&nbsp;&nbsp;<?php echo number_format($bobinano, 2, ',', '.'); ?>&nbsp;(und)</td>
		</tr>
<?php


			if($vgestionentrega == 0){
?>
		<tr>
			<td>
				<div class="ui-widget">
					 <div style="margin-top: 1px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all"> 
				  		<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
				  		<b>No se encontraron reportes de rechazo de materiales.</b></p>
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