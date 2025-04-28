<?php
	ini_set('display_errors',1);
	include_once '../../FunPerSecNiv/fncnumreg.php';
	include_once '../../FunPerSecNiv/fncfetch.php';
	include_once '../../FunPerSecNiv/fncconn.php';
	include_once '../../FunPerSecNiv/fncclose.php';
	include_once '../../FunGen/cargainput.php';
	
	include_once('../../FunPerPriNiv/pktblreporteoppflagproduccion.php');
	include_once('../../FunPerPriNiv/pktblreporteoppdesperdiciopn.php');
	include_once('../../FunPerPriNiv/pktblreporteoppreportepn.php');
	include_once('../../FunPerPriNiv/pktblreporteopptiempopn.php');
	include_once('../../FunPerPriNiv/pktblreporteoppmaterial.php');
	include_once('../../FunPerPriNiv/pktblgestionoppreporte.php');
	include_once('../../FunPerPriNiv/pktblflagproduccion.php');
	include_once('../../FunPerPriNiv/pktbldesperdiciopn.php');
	include_once('../../FunPerPriNiv/pktbltiempopn.php');
	include_once('../../FunPerPriNiv/pktblreporteopp.php');
	include_once('../../FunPerPriNiv/pktblitemdesa.php');
	include_once('../../FunPerPriNiv/pktblproducto.php');
	include_once('../../FunPerPriNiv/pktblusuario.php');
	include_once('../../FunPerPriNiv/pktblsoliprog.php');
	include_once('../../FunPerPriNiv/pktblopp.php');
	include_once('../../FunPerPriNiv/pktblop.php');
	$idcon = fncconn();
	$rwreporteopp = loadrecordreporteopp($repoppcodigo,$idcon);
	$rwOP = loadrecordop1($rwreporteopp['ordoppcodigo'],$idcon);
	$rwSoliprog = loadrecordsoliprog($rwOP['solprocodigo'],$idcon);
	$rwProducto = loadrecordproducto($rwSoliprog['produccodigo'],$idcon);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr>
		<td class="ui-state-default" width="3%">#</td>
		<td class="ui-state-default" width="27%">Usuario</td>
		<td class="ui-state-default" width="18%">Fecha / Hora</td>
		<td class="ui-state-default" width="52%">Motivo / Aclaraci&oacute;n</td>
	</tr>
	<tr>
		<td class="NoiseDataTD row-soliserv">&nbsp;<?php echo ($a + 1) ?></td>
		<td class="NoiseDataTD row-soliserv">&nbsp;<?php echo cargausuanombre($rwreporteopp['usuacodi'],$idcon); ?></td>
		<td class="NoiseDataTD row-soliserv">&nbsp;<?php echo $rwreporteopp['repoppfecha'].' - '.$rwreporteopp['repopphora']?></td>
		<td class="NoiseDataTD row-soliserv">&nbsp;<?php echo $rwreporteopp['repoppdescri']; ?></td>
	</tr>
	<tr>
		<td class="ui-state-default" width="3%">&nbsp;</td>
		<td colspan="4" class="ui-state-default" width="3%">Material implicado</td>
	</tr>
	<?php 

		$rsReporteoppmaterial = dinamicscanreporteoppmaterial(array('repoppcodigo' => $rwreporteopp['repoppcodigo']),$idcon);
		$nrReporteoppmaterial = fncnumreg($rsReporteoppmaterial);

		for( $c = 0; $c < $nrReporteoppmaterial; $c++)
		{
			$rwReporteoppmaterial = fncfetch($rsReporteoppmaterial,$c);
			$rwGestionoppreporte = loadrecordgestionoppreporte($rwReporteoppmaterial['geoprecodigo'],$idcon);
	?>
	<tr>
		<td class="NoiseDataTD row-soliserv">&nbsp;</td>
		<td colspan="3">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"
			align="center">
			<tr>
				<td class="NoiseDataTD row-soliserv" width="5%">&nbsp;MT::</td>
				<td class="NoiseDataTD row-soliserv" width="55%">&nbsp;<b>Item</b>&nbsp;<?php echo carganombitemdesa1($rwGestionoppreporte['itedescodigo'],$idcon)?></td>
				<td class="NoiseDataTD row-soliserv" width="40%">&nbsp;
					<?php echo ($rwGestionoppreporte['gesoppcantkg'] > 1)? $rwGestionoppreporte['gesoppcantkg'] : '---' ;?>&nbsp;<b>(kgs)</b>&nbsp;
					<?php echo ($rwGestionoppreporte['gesoppcantmt'] > 1)? $rwGestionoppreporte['gesoppcantmt'] : '---' ;?>&nbsp;<b>(mts)</b>&nbsp;
					<?php echo ($rwGestionoppreporte['gesoppcantun'] > 1)? $rwGestionoppreporte['gesoppcantun'] : '---' ;?>&nbsp;<b>(und)</b>&nbsp;
				</td>
			</tr>
		</table>
		</td>
	</tr>
	<?php
		}
		
		$rsReporteoppreportepn = dinamicscanreporteoppreportepn(array('repoppcodigo' => $rwreporteopp['repoppcodigo']),$idcon);
		$nrReporteoppreportepn = fncnumreg($rsReporteoppreportepn);

		for( $c = 0; $c < $nrReporteoppreportepn; $c++)
		{
			$rwReporteoppreportepn = fncfetch($rsReporteoppreportepn,$c);
			$rwReporteoppreportepn = loadrecordreporteoppreportepn($rwReporteoppreportepn['reoppncodigo'],$idcon);
	?>
	<tr>
		<td class="NoiseDataTD row-soliserv">&nbsp;</td>
		<td colspan="3">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"
			align="center">
			<tr>
				<td class="NoiseDataTD row-soliserv" width="5%">&nbsp;PR::</td>
				<td class="NoiseDataTD row-soliserv" width="55%">&nbsp;<?php echo $rwProducto['produccoduno'].$rwProducto['producnombre'] ?></td>
				<td class="NoiseDataTD row-soliserv" width="40%">&nbsp;
					<?php echo ($rwReporteoppreportepn['reoppncantkg'] > 1)? $rwReporteoppreportepn['reoppncantkg'] : '---' ;?>&nbsp;<b>(kgs)</b>&nbsp;
					<?php echo ($rwReporteoppreportepn['reoppncantmt'] > 1)? $rwReporteoppreportepn['reoppncantmt'] : '---' ;?>&nbsp;<b>(mts)</b>&nbsp;
					<?php echo ($rwReporteoppreportepn['reoppncantun'] > 1)? $rwReporteoppreportepn['reoppncantun'] : '---' ;?>&nbsp;<b>(und)</b>&nbsp;
				</td>
			</tr>
		</table>
		</td>
	</tr>
	<?php 
		}
		$rsReporteoppdesperdiciopn = dinamicscanreporteoppdesperdiciopn(array('repoppcodigo' => $rwreporteopp['repoppcodigo']),$idcon);
		$nrReporteoppdesperdiciopn = fncnumreg($rsReporteoppdesperdiciopn);
		if($nrReporteoppdesperdiciopn > 0)
		{
		?>
	<tr>
		<td class="ui-state-default" width="3%">&nbsp;</td>
		<td colspan="4" class="ui-state-default" width="3%">Desperdicio</td>
	</tr>
	<?php 
		}
		
		for( $c = 0; $c < $nrReporteoppdesperdiciopn; $c++)
		{
			$rwReporteoppdesperdiciopn = fncfetch($rsReporteoppdesperdiciopn,$c);
			$rwDesperdicionpn = loadrecorddesperdiciopn($rwReporteoppdesperdiciopn['despercodigo'],$idcon);
	?>
	<tr>
		<td class="NoiseDataTD row-soliserv">&nbsp;</td>
		<td colspan="3">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"
			align="center">
			<tr>
				<td class="NoiseDataTD row-soliserv" width="5%">&nbsp;</td>
				<td class="NoiseDataTD row-soliserv" width="65%">&nbsp;<?php echo ($rwDesperdicionpn['despernombre'])? strtoupper($rwDesperdicionpn['despernombre']) : '---' ;?></td>
				<td class="NoiseDataTD row-soliserv" width="15%">&nbsp;<?php echo $rwReporteoppdesperdiciopn['reopdecantkg'];?>&nbsp;<b>(kgs)</b></td>
				<td class="NoiseDataTD row-soliserv" width="15%">&nbsp;<?php echo $rwReporteoppdesperdiciopn['reopdecantmt'];?>&nbsp;<b>(mts)</b></td>
			</tr>
		</table>
		</td>
	</tr>
	<?php
		}
		
		$rsReporteopptiempopn = dinamicscanreporteopptiempopn(array('repoppcodigo' => $rwreporteopp['repoppcodigo']),$idcon);
		$nrReporteopptiempopn = fncnumreg($rsReporteopptiempopn);
		if($nrReporteopptiempopn > 0)
		{
	?>
	<tr>
		<td class="ui-state-default" width="3%">&nbsp;</td>
		<td colspan="4" class="ui-state-default" width="3%">Tiempos</td>
	</tr>
	<?php 
		}
		
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

		$rsReporteoppflagproduccion = dinamicscanreporteoppflagproduccion(array('repoppcodigo' => $rwreporteopp['repoppcodigo']),$idcon);
		$nrReporteoppflagproduccion = fncnumreg($rsReporteoppflagproduccion);
		if($nrReporteoppflagproduccion > 0)
		{
	?>
	<tr>
		<td class="ui-state-default" width="3%">&nbsp;</td>
		<td colspan="4" class="ui-state-default" width="3%">Banderas</td>
	</tr>
	<?php 
		}
		
		for( $c = 0; $c < $nrReporteoppflagproduccion; $c++)
		{
			$rwReporteoppflagproduccion = fncfetch($rsReporteoppflagproduccion,$c);
			$rwFlagproduccion = loadrecordflagproduccion($rwReporteoppflagproduccion['flaprocodigo'],$idcon);
	?>
	<tr>
		<td class="NoiseDataTD row-soliserv">&nbsp;</td>
		<td colspan="3">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"
			align="center">
			<tr>
				<td class="NoiseDataTD row-soliserv" width="5%">&nbsp;</td>
				<td class="NoiseDataTD row-soliserv" colspan="3">&nbsp;<?php echo ($rwFlagproduccion['flapronombre'])? strtoupper($rwFlagproduccion['flapronombre']) : '---' ;?></td>
			</tr>
		</table>
		</td>
	</tr>
	<?php
		}

		$rsReporteoppreportepn = dinamicscanreporteoppreportepn(array('repoppcodigo' => $rwreporteopp['repoppcodigo']),$idcon);
		$nrReporteoppreportepn = fncnumreg($rsReporteoppreportepn);
		
		if($nrReporteoppreportepn > 0)
		{
	?>
	<tr>
		<td class="ui-state-default" width="3%">&nbsp;</td>
		<td colspan="4" class="ui-state-default" width="3%">Reporte pn</td>
	</tr>
	<?php 
		}
		
		for( $c = 0; $c < $nrReporteoppreportepn; $c++)
		{
			$rwReporteoppreportepn = fncfetch($rsReporteoppreportepn,$c);
	?>
	<tr>
		<td class="NoiseDataTD row-soliserv">&nbsp;</td>
		<td colspan="3">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
				<tr>
					<td class="NoiseDataTD row-soliserv" width="5%">&nbsp;</td>
					<td class="NoiseDataTD row-soliserv" width="65%">&nbsp;Kilogramos reportados :&nbsp;</td>
					<td class="NoiseDataTD row-soliserv" colspan="2">&nbsp;<?php echo ($rwReporteoppreportepn['reoppncantkg'] > 1)? $rwReporteoppreportepn['reoppncantkg'] : '---' ; ?>&nbsp;<b>(kgs)</b></td>
				</tr>
				<tr>
					<td class="NoiseDataTD row-soliserv" width="5%">&nbsp;</td>
					<td class="NoiseDataTD row-soliserv" width="65%">&nbsp;Metros reportados :&nbsp;</td>
					<td class="NoiseDataTD row-soliserv" colspan="2">&nbsp;<?php echo ($rwReporteoppreportepn['reoppncantmt'] > 1)? $rwReporteoppreportepn['reoppncantmt'] : '---' ; ?>&nbsp;<b>(mts)</b></td>
				</tr>
				<tr>
					<td class="NoiseDataTD row-soliserv" width="5%">&nbsp;</td>
					<td class="NoiseDataTD row-soliserv" width="65%">&nbsp;Unidades reportados :&nbsp;</td>
					<td class="NoiseDataTD row-soliserv" colspan="2">&nbsp;<?php echo ($rwReporteoppreportepn['reoppncantun'] > 1)? $rwReporteoppreportepn['reoppncantun'] : '---' ; ?>&nbsp;<b>(und)</b></td>
				</tr>
				<tr>
					<td class="NoiseDataTD row-soliserv" width="5%">&nbsp;</td>
					<td class="NoiseDataTD row-soliserv" colspan="3">&nbsp;Nota :&nbsp;<?php echo $rwReporteoppreportepn['reoppndescri']; ?></td>
				</tr>
			</table>
		</td>
	</tr>
	<?php
		}	
	?>
</table>