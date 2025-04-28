<?php 
ini_set("display_erros", 1);
	include_once ( "../../../FunPerPriNiv/pktbloppitemdesa.php");
	include_once ( "../../../FunPerPriNiv/pktblitemdesa.php");
	include_once ( "../../../FunPerPriNiv/pktblpadreitem.php");
	include_once ( "../../../FunPerPriNiv/pktblsaldo.php");
	include_once ( "../../../FunPerSecNiv/fncnumreg.php");
	include_once ( "../../../FunPerSecNiv/fncclose.php");
	include_once ( "../../../FunPerSecNiv/fncfetch.php");
	include_once ( "../../../FunPerSecNiv/fncconn.php");
	include_once ('../../../FunPerSecNiv/fncsqlrun.php');

	$idcon = fncconn();	
	if($ordcomcodcli){

  $sql="SELECT DISTINCT desperdiciopn.despernombre,itemdesa.itedesnombre,itemdesa.itedescosto,sum(reporteoppdesperdiciopn.reopdecantkg) as reopdecantkg
				from vistaoppcosto
				inner join reporteopp on reporteopp.ordoppcodigo=vistaoppcosto.ordoppcodigo
				inner join reporteoppmaterial on reporteoppmaterial.repoppcodigo=reporteopp.repoppcodigo
				left join gestionoppreporte on gestionoppreporte.geoprecodigo=reporteoppmaterial.geoprecodigo
				left join gestionoppitemdesa on gestionoppitemdesa.itedescodigo=gestionoppreporte.itedescodigo
				left join itemdesa on itemdesa.itedescodigo=gestionoppitemdesa.itedescodigo
				inner join reporteoppdesperdiciopn on  reporteoppdesperdiciopn.repoppcodigo=reporteopp.repoppcodigo
				inner join desperdiciopn on desperdiciopn.despercodigo = reporteoppdesperdiciopn.despercodigo
				where vistaoppcosto.ordprofecgen BETWEEN '".$consulfecini."' AND '".$consulfecfin."' 
				AND vistaoppcosto.tipsolcodigo = '".$ordcomcodcli."' 
				group by desperdiciopn.despernombre,itemdesa.itedesnombre,itemdesa.itedescosto
				order by desperdiciopn.despernombre";

	$rsDesperdicio=fncsqlrun($sql,$idcon);				
	$nrDesperdicio=fncnumreg($rsDesperdicio);
	}
	$cantidad=0;
	$Kilogramos=0;
?>	
<div style="width:100%; height: 30px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="25%" class="NoiseDataTD" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Desperdicios</td>
				<td width="25%" class="NoiseDataTD" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Cantidad</td>
				<td width="20%" class="NoiseDataTD" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;MP</td>
				<td width="10%" class="NoiseDataTD" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Precio unitario</td>
				<td width="20%" class="NoiseDataTD" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Costo total</td>
				<td width="2%" class="NoiseDataTD" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>

<div style="width:100%; height: 130px; overflow:auto; " class="ui-widget-content">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
	<?php 
		if($nrDesperdicio > 0){//listado de saldos a asignar
			for($a = 0; $a < $nrDesperdicio; $a++){
				$rwDesperdicio = fncfetch($rsDesperdicio, $a);
				($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
					
	?>			
				<tr <?php echo $complement ?> >
					<td width="25%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwDesperdicio["despernombre"]; ?></td>
					<td width="25%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwDesperdicio["reopdecantkg"], 2, ",", "."); ?></td>
					<td width="20%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwDesperdicio['itedesnombre']; ?></td>
					<td width="10%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;" >&nbsp;<?php echo '$'.number_format($rwDesperdicio['itedescosto'], 2, ',', '.'); ?></td>
					<td width="20%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;" >&nbsp;<?php echo '$'.number_format($rwDesperdicio['itedescosto']*$rwDesperdicio['reopdecantkg'], 2, ',', '.'); ?></td>
				</tr>
<?php
				$cantidad+=$rwDesperdicio["reopdecantkg"];
				$costototal += ($rwDesperdicio['itedescosto']*$rwDesperdicio['reopdecantkg']);
			}
		}
	?>
<?php
	if( ($a + $b) < 10 ){

		for( $c = ($a + $b); $c < 10; $c++){

			($c % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="25%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="25%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="20%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="10%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="20%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
			}
		}
?>
		</table>
	</div>
</div>
<!--<div style="width:450px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="350" class="NoiseFooterTD" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Total desperdicion</td>
				<td width="80" class="NoiseDataTD">&nbsp;<?php //echo number_format($cantidad, 2, ",", "."); ?></td>
				<td width="350" class="NoiseFooterTD" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Total costo</td>
				<td width="80" class="NoiseDataTD">&nbsp;<?php //echo number_format($costototal, 2, ",", "."); ?></td>
			</tr>
		</table>
	</div>
</div>-->
<input type="hidden" name="costodesperdicio" id="costodesperdicio" value="<?php echo  $costototal; ?>"> 