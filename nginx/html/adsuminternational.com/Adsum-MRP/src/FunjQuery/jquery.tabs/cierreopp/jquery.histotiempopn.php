<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<?php
	$rsreporteopp = dinamicscanreporteopp(array( 'ordoppcodigo' => $ordoppcodigo, 'repopptipo' => 1 ),$idcon);
	$nrreporteopp = fncnumreg($rsreporteopp);
	if(!$nrreporteopp)
	{
		?>
	<tr>
		<td>
			<div class="ui-widget">
				<div style="margin-top: 1px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all">
					<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span> <b>No se encontraron gestiones.</b></p>
				</div>
			</div>
		</td>
	</tr>
	<?php
	}
	else
	{
	?>
	<tr>
		<td class="ui-state-default" width="5%">&nbsp;</td>
		<td colspan="4" class="ui-state-default" width="95%">Tiempos</td>
	</tr>
	<?php 
	}

	for( $a = 0; $a < $nrreporteopp; $a++)
	{
		$rwreporteopp = fncfetch($rsreporteopp,$a);

		$rsReporteopptiempopn = dinamicscanreporteopptiempopn(array('repoppcodigo' => $rwreporteopp['repoppcodigo']),$idcon);
		$nrReporteopptiempopn = fncnumreg($rsReporteopptiempopn);

		for( $c = 0; $c < $nrReporteopptiempopn; $c++)
		{
			$rwReporteopptiempopn = fncfetch($rsReporteopptiempopn,$c);
			$rwTiempopn = loadrecordtiempopn($rwReporteopptiempopn['tiempocodigo'],$idcon);
	?>
	<tr>
		<td class="NoiseDataTD row-soliserv">&nbsp;</td>
		<td colspan="3">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td class="NoiseDataTD row-soliserv" width="5%">&nbsp;</td>
				<td class="NoiseDataTD row-soliserv" width="65%">&nbsp;<?php echo ($rwTiempopn['tiemponombre'])? strtoupper($rwTiempopn['tiemponombre']) : '---' ;?></td>
				<td class="NoiseDataTD row-soliserv" width="15%">&nbsp;<?php echo $rwReporteopptiempopn['reoptihorini'];?>&nbsp;</td>
				<td class="NoiseDataTD row-soliserv" width="15%">&nbsp;<?php echo $rwReporteopptiempopn['reoptihorfin'];?>&nbsp;</td>
			</tr>
		</table>
		</td>
	</tr>
	<?php
		}
	}
	?>
</table>