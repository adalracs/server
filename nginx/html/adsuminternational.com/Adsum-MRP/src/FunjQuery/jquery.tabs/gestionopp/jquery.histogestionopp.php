<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr class="ui-state-default">
		<td class="cont-title">&nbsp;<a onClick="return verocultar('filgestionopp',2);" href="javascript:animatedcollapse.toggle('filgestionopp');"><img id="row2" align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0">Historial Gestiones</a></td>
	</tr>
</table>
<div id="filgestionopp" style="padding: 2px 2px 2px 2px; display:none;" >
	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
		<?php 
			$rsGestionopp = dinamicscanopgestionopp(array( "ordoppcodigo" => $ordoppcodigo, "gesopptipo" => "1,5" ), array("ordoppcodigo" => "=", "gesopptipo" => "in"), $idcon);
			$nrGestionopp = fncnumreg($rsGestionopp);

			if(!$nrGestionopp)
			{
		?>
		<tr>
			<td>
				<div class="ui-widget">
					 <div style="margin-top: 1px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all"> 
				  		<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
				  		<b>No se encontraron gestiones.</b></p>
				 	</div>
				</div>
			</td>
		</tr>
		<?php 
			}
								
			for( $a = 0; $a < $nrGestionopp; $a++)
			{	
				$rwGestionopp = fncfetch($rsGestionopp,$a);
				$rsGestionoppitemdesa = dinamicscangestionoppitemdesa(array('gesoppcodigo' => $rwGestionopp['gesoppcodigo']),$idcon);
				$nrGestionoppitemdesa = fncnumreg($rsGestionoppitemdesa);
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
			for( $b = 0; $b < $nrGestionoppitemdesa; $b++){
				$rwGestionoppitemdesa = fncfetch($rsGestionoppitemdesa,$b);
		?>
		<tr>
			<td class="NoiseDataTD row-soliserv">&nbsp;</td>
			<td colspan="3">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
					<tr>
						<td class="NoiseDataTD row-soliserv" width="5%">&nbsp;</td>
						<td class="NoiseDataTD row-soliserv" width="65%">&nbsp;<b>Asignacion {inventario} :</b>&nbsp;<?php echo carganombitemdesa1($rwGestionoppitemdesa['itedescodigo'],$idcon)?></td>
						<td class="NoiseDataTD row-soliserv" width="15%">&nbsp;<?php echo number_format($rwGestionoppitemdesa['gesoppcantkg'],2, ",", ".");?>&nbsp;<b>(kgs)</b></td>
						<td class="NoiseDataTD row-soliserv" width="15%">&nbsp;<?php echo number_format($rwGestionoppitemdesa['gesoppcantmt'],2, ",", ".");?>&nbsp;<b>(mts)</b></td>
					</tr>
				</table>
			</td>
		</tr>
		<?php 
		}
										
		$rsGestionoppsaldo = dinamicscangestionoppsaldo(array('gesoppcodigo' => $rwGestionopp['gesoppcodigo']),$idcon);
		$nrGestionoppsaldo = fncnumreg($rsGestionoppsaldo);
					
		for( $c = 0; $c < $nrGestionoppsaldo; $c++){
			$rwGestionoppsaldo = fncfetch($rsGestionoppsaldo,$c);
			$rwSaldo = loadrecordsaldo($rwGestionoppsaldo['saldocodigo'],$idcon);
		?>
		<tr>
			<td class="NoiseDataTD row-soliserv">&nbsp;</td>
			<td colspan="3">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
					<tr>
						<td class="NoiseDataTD row-soliserv" width="5%">&nbsp;</td>
						<td class="NoiseDataTD row-soliserv" width="65%">&nbsp;<b>Asignacion {saldo} :</b>&nbsp;<?php echo carganombitemdesa1($rwSaldo['itedescodigo'],$idcon)?></td>
						<td class="NoiseDataTD row-soliserv" width="15%">&nbsp;<?php echo number_format($rwSaldo['saldocantkgs'],2, ",", ".");?>&nbsp;<b>(kgs)</b></td>
						<td class="NoiseDataTD row-soliserv" width="15%">&nbsp;<?php echo number_format($rwSaldo['saldocantmts'],2, ",", ".");?>&nbsp;<b>(mts)</b></td>
					</tr>
				</table>
			</td>
		</tr>
		<?php 
			}
		}
		?>
	</table>
</div>