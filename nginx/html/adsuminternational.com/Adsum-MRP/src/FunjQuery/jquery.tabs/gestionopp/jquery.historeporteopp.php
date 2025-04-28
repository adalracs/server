<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr class="ui-state-default">
		<td class="cont-title">&nbsp;<a onClick="return verocultar('filgestionoppreporte',3);" href="javascript:animatedcollapse.toggle('filgestionoppreporte');"><img id="row3" align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0">Historial Reportes</a></td>
	</tr>
</table>
<div id="filgestionoppreporte" style="padding: 2px 2px 2px 2px; display:none;" >
	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
		<?php 
			$rsGestionopp = dinamicscangestionopp(array( 'ordoppcodigo' => $ordoppcodigo, 'gesopptipo' => 2 ),$idcon);
			$nrGestionopp = fncnumreg($rsGestionopp);

			if(!$nrGestionopp){
		?>
		<tr>
			<td>
				<div class="ui-widget">
					 <div style="margin-top: 1px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all"> 
				  		<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
				  		<b>No se encontraron reportes.</b></p>
				 	</div>
				</div>
			</td>
		</tr>
		<?php 
			}

			$bobinano = 0;

			$SZreoppncantkg = 0;
			$SZreoppncantmt = 0;

			for( $a = 0; $a < $nrGestionopp; $a++){

				$rwGestionopp = fncfetch($rsGestionopp,$a);
				$rsGestionoppreporte = dinamicscangestionoppreporte(array('gesoppcodigo' => $rwGestionopp['gesoppcodigo']),$idcon);
				$nrGestionoppreporte = fncnumreg($rsGestionoppreporte);
		?>				
		<tr>
			<td class="ui-state-default" width="3%">#</td>
			<td class="ui-state-default" width="27%">Usuario</td>
			<td class="ui-state-default" width="18%">Fecha / Hora</td>
			<td class="ui-state-default" width="52%">Motivo / Aclaraci&oacute;n</td>
		</tr>
		<tr>
			<td class="NoiseDataTD row-soliserv">&nbsp;<?php echo ($a + 1) ?></td>
			<td class="NoiseDataTD row-soliserv">&nbsp;<?php echo cargausuanombre($rwGestionopp['usuacodi'],$idcon); ?></td>
			<td class="NoiseDataTD row-soliserv">&nbsp;<?php echo $rwGestionopp['gesoppfecha'].' - '.$rwGestionopp['gesopphora']?></td>
			<td class="NoiseDataTD row-soliserv">&nbsp;<?php echo $rwGestionopp['gesoppdescri']; ?></td>
		</tr>	
		<?php 
			for( $b = 0; $b < $nrGestionoppreporte; $b++){
				$rwGestionoppreporte = fncfetch($rsGestionoppreporte,$b);

				$SZreoppncantkg += $rwGestionoppreporte["gesoppcantkg"];
				$SZreoppncantmt += $rwGestionoppreporte["gesoppcantmt"];
				$bobinano++;
		?>
		<tr>
			<td class="NoiseDataTD row-soliserv">&nbsp;</td>
			<td colspan="3">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
					<tr>
						<td class="NoiseDataTD row-soliserv" width="5%">&nbsp;</td>
						<td class="NoiseDataTD row-soliserv" width="65%">&nbsp;<b>Entrega :</b>&nbsp;<?php echo carganombitemdesa1($rwGestionoppreporte['itedescodigo'],$idcon)?></td>
						<td class="NoiseDataTD row-soliserv" width="15%">&nbsp;<?php echo number_format($rwGestionoppreporte['gesoppcantkg'],2, ",", ".");?>&nbsp;<b>(kgs)</b></td>
						<td class="NoiseDataTD row-soliserv" width="15%">&nbsp;<?php echo number_format($rwGestionoppreporte['gesoppcantmt'],2, ",", ".");?>&nbsp;<b>(mts)</b></td>
					</tr>
				</table>
			</td>
		</tr>
		<?php 
				}
			}
		?>
		<tr>
			<td class="ui-state-default" colspan="5">&nbsp;Total Entregado:&nbsp;<?php echo number_format($SZreoppncantkg, 2, ',', '.'); ?>&nbsp;(kgs)&nbsp;&nbsp;&nbsp;<?php echo number_format($SZreoppncantmt, 2, ',', '.'); ?>&nbsp;(mts)&nbsp;&nbsp;&nbsp;<?php echo number_format($bobinano, 2, ',', '.'); ?>&nbsp;(und)</td>
		</tr>
	</table>
</div>