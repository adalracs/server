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

   	$sql="SELECT DISTINCT itemdesa.itedescodigo,itemdesa.itedesnombre,gestionoppreporte.gesoppcantkg,itemdesa.itedescosto,oppitemdesa.oppitecantid,reporteoppdesperdiciopn.reopdecantkg as reopdecantkg
   					from vistaoppcosto
					left join reporteopp on reporteopp.ordoppcodigo=vistaoppcosto.ordoppcodigo
					left join reporteoppmaterial on reporteoppmaterial.repoppcodigo=reporteopp.repoppcodigo
					left join gestionoppreporte on gestionoppreporte.geoprecodigo=reporteoppmaterial.geoprecodigo
					left join gestionoppitemdesa on gestionoppitemdesa.itedescodigo=gestionoppreporte.itedescodigo
					left join itemdesa on itemdesa.itedescodigo=gestionoppitemdesa.itedescodigo
					left  join oppitemdesa ON oppitemdesa.ordoppcodigo = vistaoppcosto.ordoppcodigo AND oppitemdesa.itedescodigo = itemdesa.itedescodigo
					left  join reporteoppdesperdiciopn ON reporteoppdesperdiciopn.repoppcodigo = reporteopp.repoppcodigo
					where vistaoppcosto.ordprofecgen BETWEEN '".$consulfecini."' AND '".$consulfecfin."' 
					AND  itemdesa.itedescodigo IS NOT NULL AND vistaoppcosto.tipsolcodigo = '".$ordcomcodcli."' 
					order by itemdesa.itedescodigo";
	/*$sql="SELECT  DISTINCT itemdesa.itedescodigo,itemdesa.itedesnombre,gestionoppreporte.gesoppcantkg,itemdesa.itedescosto,oppitemdesa.oppitecantid,sum(reporteoppdesperdiciopn.reopdecantkg) as reopdecantkg
			from op 
			LEFT JOIN opp ON opp.ordoppcodigo =  op.ordoppcodigo
			LEFT JOIN soliprog ON soliprog.solprocodigo =  op.solprocodigo
			left join reporteopp ON reporteopp.ordoppcodigo=opp.ordoppcodigo
			left join reporteoppmaterial ON reporteoppmaterial.repoppcodigo=reporteopp.repoppcodigo
			left join gestionoppreporte ON gestionoppreporte.geoprecodigo=reporteoppmaterial.geoprecodigo
			left join gestionoppitemdesa ON gestionoppitemdesa.itedescodigo=gestionoppreporte.itedescodigo
			inner join itemdesa ON itemdesa.itedescodigo=gestionoppitemdesa.itedescodigo
			left  join oppitemdesa ON oppitemdesa.ordoppcodigo = opp.ordoppcodigo AND oppitemdesa.itedescodigo = itemdesa.itedescodigo
			left  join reporteoppdesperdiciopn ON reporteoppdesperdiciopn.repoppcodigo = reporteopp.repoppcodigo
			left join reporteopptiempopn on  reporteopptiempopn.repoppcodigo=reporteopp.repoppcodigo
			left join tiempopn on tiempopn.tiempocodigo = reporteopptiempopn.tiempocodigo
			WHERE  op.ordprofecgen BETWEEN '".$consulfecini."' AND '".$consulfecfin." AND  itemdesa.itedescodigo IS NOT NULL AND soliprog.tipsolcodigo = '".$ordcomcodcli."'  
			group by itemdesa.itedescodigo,itemdesa.itedesnombre,gestionoppreporte.gesoppcantkg,itemdesa.itedescosto,oppitemdesa.oppitecantid
			order by itemdesa.itedescodigo";*/

	$rsMaterial=fncsqlrun($sql,$idcon);				
	$nrMaterial=fncnumreg($rsMaterial);
	}
	$cantidad=0;
	$Kilogramos=0;
	$cosot=0;
?>	
<div style="width:100%; height: 40px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="500" colspan="9" class="NoiseFooterTD" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Detalle de consumo</td>
			</tr>
			<tr>
				<td width="80" class="NoiseDataTD"  style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;MP consumidas</td>
				<td width="100" class="NoiseDataTD" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;Descripci&oacute;n</td>
				<td width="80" class="NoiseDataTD"  style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;Cantidad real</td>
				<td width="80" class="NoiseDataTD"  style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;Desperdicion</td>
				<td width="80" class="NoiseDataTD"  style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;Precio unitario</td>
				<td width="80" class="NoiseDataTD"  style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;Costo total</td>
				<td width="80" class="NoiseDataTD"  style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;Cantidad planeada</td>
				<td width="80" class="NoiseDataTD"  style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;Desviaci&oacute;n </td>
				<td width="10" class="NoiseDataTD" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>

<div style="width:100%; height: 250px; overflow:auto; " class="ui-widget-content">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
	<?php 
		if($nrMaterial > 0){//listado de saldos a asignar
			for($a = 0; $a < $nrMaterial; $a++){
				$rwMaterial = fncfetch($rsMaterial, $a);
				($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
					
	?>			
				<tr <?php echo $complement ?> >
					<td width="80" class="cont-line"  style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;" >&nbsp;<?php echo $rwMaterial['itedescodigo']; ?></td>
					<td width="100" class="cont-line"  style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;" >&nbsp;<?php echo $rwMaterial['itedesnombre']; ?></td>
					<td width="80"  class="cont-line"  style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;" >&nbsp;<?php echo $rwMaterial['gesoppcantkg']; ?></td>
					<td width="80"  class="cont-line"  style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;" >&nbsp;<?php echo number_format($rwMaterial['reopdecantkg'], 2, ',', '.'); ?></td>
					<td width="80"  class="cont-line"  style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;" >&nbsp;<?php echo '$'.number_format($rwMaterial['itedescosto'], 2, ',', '.'); ?></td>
					<td width="80"  class="cont-line"  style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;" >&nbsp;<?php echo '$'.number_format($rwMaterial['itedescosto']*$rwMaterial['gesoppcantkg'], 2, ',', '.'); ?></td>
					<td width="80"  class="cont-line"  style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;" >&nbsp;<?php echo number_format($rwMaterial['oppitecantid'], 2, ',', '.'); ?></td>
					<td width="80"  class="cont-line"  style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;" >&nbsp;<?php echo number_format(($rwMaterial['oppitecantid']- $rwMaterial['gesoppcantkg']), 2, ',', '.'); ?></td>
				</tr>
<?php
				$cantidad+=$rwMaterial["gesoppcantmt"];
				$Kilogramos+=$rwMaterial["gesoppcantkg"];
				$cosot+=($rwMaterial['itedescosto']*$rwMaterial['gesoppcantkg']);
			}
		}
	?>
<?php
	if( ($a + $b) < 20 ){

		for( $c = ($a + $b); $c < 20; $c++){

			($c % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="80"  style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="100" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80"  style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80"  style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80"  style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80"  style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80"  style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80"  style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
			}
		}
?>
		</table>
	</div>
</div>
<!--<div style="width:600px; height: 40px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="350" class="NoiseFooterTD" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Metros</td>
				<td width="80" class="NoiseDataTD">&nbsp;<?php echo number_format($cantidad, 2, ",", "."); ?></td>
			</tr>
			<tr>
				<td width="350" class="NoiseFooterTD" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Kilogramos</td>
				<td width="80" class="NoiseDataTD">&nbsp;<?php echo number_format($Kilogramos, 2, ",", "."); ?></td>
			<tr>
				<td width="350" class="NoiseFooterTD" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Costo(Kg)</td>
				<td width="80" class="NoiseDataTD">&nbsp;<?php echo number_format($cosot, 2, ",", "."); ?></td>
			</tr>
		</table>
	</div>
</div>-->
<input type="hidden" name="consolcostmp" id="consolcostmp" value="<?php echo $cosot; ?>">