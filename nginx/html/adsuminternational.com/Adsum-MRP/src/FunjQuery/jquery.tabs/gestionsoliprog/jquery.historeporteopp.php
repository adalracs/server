<table width="100%" border="0" cellspacing="0" cellpadding="0"
	align="center" class="ui-widget-content">
	<tr class="ui-state-default">
		<td class="cont-title">&nbsp;Historial Reportes</td>
	</tr>
</table>
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
					<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span> <b>No se encontraron Reportes.</b></p>
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
		<td class="ui-state-default" width="10%">Bobina #</td>
<?php if($tiposoliprog != 5 && $tiposoliprog != 6 && $tiposoliprog != 7 && $tiposoliprog != 12){?>
		<td class="ui-state-default" width="10%"><b>(kgs)</b></td>
		<td class="ui-state-default" width="10%"><b>(mts)</b></td>
<?php }else{?>
		<td class="ui-state-default" width="20%"><b>(und)</b></td>
<?php }?>
		<td class="ui-state-default" width="20%">Observacion&nbsp;</td>
		<td class="ui-state-default" width="20%">Fecha / Hora</td>
		<td class="ui-state-default" width="30%">Usuario</td>
	</tr>
	<?php 	

	$SZreoppncantkg = 0;
	$SZreoppncantmt = 0;
	$SZreoppncantun = 0;
	for( $a = 0; $a < $nrreporteopp; $a++)
	{
		$rwreporteopp = fncfetch($rsreporteopp,$a);
		$rsReporteoppreportepn = dinamicscanreporteoppreportepn(array('repoppcodigo' => $rwreporteopp['repoppcodigo']),$idcon);
		$nrReporteoppreportepn = fncnumreg($rsReporteoppreportepn);
		($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)" onclick="openReporteOpp('.$rwreporteopp['repoppcodigo'].')"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)" onclick="openReporteOpp('.$rwreporteopp['repoppcodigo'].')" ';
		for( $c = 0; $c < $nrReporteoppreportepn; $c++)
		{
			$rwReporteoppreportepn = fncfetch($rsReporteoppreportepn,$c);
			$SZreoppncantkg = $SZreoppncantkg + $rwReporteoppreportepn['reoppncantkg'];
			$SZreoppncantmt = $SZreoppncantmt + $rwReporteoppreportepn['reoppncantmt'];
			$SZreoppncantun = $SZreoppncantun + $rwReporteoppreportepn['reoppncantun'];
	?>
	<tr <?php echo $complement; ?>>
		<td width="10%">&nbsp;<?php echo ($a + 1); ?></td>
<?php if($tiposoliprog != 5 && $tiposoliprog != 6 && $tiposoliprog != 7 && $tiposoliprog != 12){?>
		<td width="10%">&nbsp;<?php echo number_format($rwReporteoppreportepn['reoppncantkg'], 2, ',', '.'); ?>&nbsp;</td>
		<td width="10%">&nbsp;<?php echo number_format($rwReporteoppreportepn['reoppncantmt'], 2, ',', '.'); ?>&nbsp;</td>
<?php }else{?>
		<td width="20%">&nbsp;<?php echo $rwReporteoppreportepn['reoppncantun']; ?>&nbsp;</td>
<?php }?>
		<td width="20%">&nbsp;<?php echo $rwReporteoppreportepn['reoppndescri']; ?>&nbsp;</td>
		<td width="20%">&nbsp;<?php echo $rwreporteopp['repoppfecha'].' - '.$rwreporteopp['repopphora']?>&nbsp;</td>
		<td width="30%">&nbsp;<?php echo cargausuanombre($rwreporteopp['usuacodi'],$idcon); ?>&nbsp;</td>
	</tr>
	<?php
		}
	}
	
	$SZreopdecantkg = 0;
	$SZreopdecantmt = 0;
	$rsReporteoppdesperdiciopn = dinamicscanreporteoppdesperdiciopn(array('repoppcodigo' => $rwreporteopp['repoppcodigo']),$idcon);
	$nrReporteoppdesperdiciopn = fncnumreg($rsReporteoppdesperdiciopn);
	for( $c = 0; $c < $nrReporteoppdesperdiciopn; $c++)
	{
		$rwReporteoppdesperdiciopn = fncfetch($rsReporteoppdesperdiciopn,$c);
		$rwDesperdicionpn = loadrecorddesperdiciopn($rwReporteoppdesperdiciopn['despercodigo'],$idcon);
		$SZreopdecantkg = $SZreopdecantkg + $rwReporteoppdesperdiciopn['reopdecantkg'];
		$SZreopdecantmt = $SZreopdecantmt + $rwReporteoppdesperdiciopn['reopdecantmt'];
	}
	?>
	<tr>
		<td class="ui-state-default" colspan="6">&nbsp;Total Pn :&nbsp;<?php echo number_format($SZreoppncantkg, 2, ',', '.'); ?>&nbsp;(kgs)&nbsp;&nbsp;&nbsp;<?php echo number_format($SZreoppncantmt, 2, ',', '.'); ?>&nbsp;(mts)&nbsp;&nbsp;&nbsp;<?php echo number_format($SZreoppncantun, 2, ',', '.'); ?>&nbsp;(und)</td>
	</tr>
	<tr>
		<td class="ui-state-default" colspan="6">&nbsp;Total Desperdicio :&nbsp;<?php echo number_format($SZreopdecantkg, 2, ',', '.'); ?>&nbsp;(kgs)&nbsp;&nbsp;&nbsp;<?php echo number_format($SZreopdecantmt, 2, ',', '.'); ?>&nbsp;(mts)</td>
	</tr>
	<?php }?>
</table>