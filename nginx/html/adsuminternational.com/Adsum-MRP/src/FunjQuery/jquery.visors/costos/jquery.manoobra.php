<?php 
ini_set("display_errors", 1);
	include_once ( "../../../FunPerPriNiv/pktblreporteopp.php");
	include_once ( "../../../FunPerPriNiv/pktblusuario.php");
	include_once ( "../../../FunPerPriNiv/pktbltarifa.php");
	include_once ( "../../../FunPerPriNiv/pktblequipo.php");
	include_once ( "../../../FunPerSecNiv/fncnumreg.php");
	include_once ( "../../../FunPerSecNiv/fncclose.php");
	include_once ( "../../../FunPerSecNiv/fncfetch.php");
	include_once ( "../../../FunPerSecNiv/fncconn.php");
	include_once ('../../../FunPerSecNiv/fncsqlrun.php');

	$idcon = fncconn();	
	if($ordcomcodcli){

 	
	$sql=" SELECT DISTINCT vistaoppcosto.ordoppcodigo,vistaoppcosto.producnombre,vistaoppcosto.equipocodigo,vistaoppcosto.ordprofecgen,vistaoppcosto.equiponombre,(sum(reporteopptiempopn.reoptihorfin)-sum(reporteopptiempopn.reoptihorini)) as diferencia
				from vistaoppcosto
				inner join reporteopp on reporteopp.ordoppcodigo=vistaoppcosto.ordoppcodigo
				inner join reporteopptiempopn on  reporteopptiempopn.repoppcodigo=reporteopp.repoppcodigo
				inner join tiempopn on tiempopn.tiempocodigo = reporteopptiempopn.tiempocodigo
				where vistaoppcosto.ordprofecgen BETWEEN '".$consulfecini."' AND '".$consulfecfin."' 
				AND vistaoppcosto.tipsolcodigo = '".$ordcomcodcli."'
				group by vistaoppcosto.ordoppcodigo,vistaoppcosto.producnombre,vistaoppcosto.equipocodigo,vistaoppcosto.ordprofecgen,vistaoppcosto.equiponombre
				order by vistaoppcosto.ordoppcodigo";
							
				

	$rsManoobra=fncsqlrun($sql,$idcon);				
	$nrManoobra=fncnumreg($rsManoobra);
	}
	$totalhoras=0;

	function resta($inicio, $fin){
		return date("H:i:s", strtotime("00:00:00") + (strtotime($fin) - strtotime($inicio)));
	}
?>	
<div style="width:1000px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="40%" class="NoiseDataTD" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;Opp</td>
				<td width="30%" class="NoiseDataTD" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;Equipo</td>
				<td width="28%" class="NoiseDataTD" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;Horas</td>
				<td width="2%" class="NoiseDataTD" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>

<div style="width:100%; height: 270px; overflow:auto; " class="ui-widget-content">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
	<?php 
		if($nrManoobra > 0){//listado de saldos a asignar
			for($a = 0; $a < $nrManoobra; $a++){
				$rwManoobra = fncfetch($rsManoobra, $a);
				//($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
				/*$diferencia = resta($rwManoobra["horini"],$rwManoobra["horfin"]); 
				//echo $diferencia;
				$tiem = explode(":", $diferencia);
				$hor=$tiem[0]*1;
				$min=$tiem[1]/60;
				$tiempo=$hor+$min;
				$tiempo=round($tiempo,2);
				$totaltiempo+=$tiempo;*/
				if($rwManoobra["diferencia"]<0)$rwManoobra["diferencia"]=date("H:i:s", strtotime("00:00:00") + $rwManoobra["diferencia"] *-1);
				$tiempo=$rwManoobra['diferencia'];
				$totaltiempo+=$tiempo;
				$rsreporte = dinamicscanopreporteopp(array("ordoppcodigo"=>$rwManoobra["ordoppcodigo"]),array("ordoppcodigo"=>"="),$idcon);
				$nrreporte = fncnumreg($rsreporte);
				
	?>			
				<tr class="NoiseFooterTD" <?php echo $complement ?> >
					<td width="40%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwManoobra["ordoppcodigo"]; ?></td>
					<td width="30%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwManoobra["equiponombre"]; ?></td>
					<td width="30%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwManoobra['diferencia']; ?></td>
				</tr>
				<tr>
					<td colspan="3">
						<table width="50%" border="0" cellspacing="0" cellpadding="0"  align="left">
							<?php 
							$totalmanoobra=0;
							 for($i=0 ; $i < $nrreporte ; $i++){
							  $rwreporte = fncfetch($rsreporte,$i);
							  //$rwUsuario = loadrecordusuario($rwreporte['usuacodi'],$idcon);

							  $fec = explode('-',$rwreporte['repoppfecha']);

							  	 $equipo = loadrecordequipo($rwManoobra['equipocodigo'],$idcon);
							  	 
							  	  $tarifa = loadrecordtarifafecha($ordcomcodcli,$fec[1],$fec[0],$idcon);
								  if($tarifa<0){
								  	
								  		$tarifa = loadrecordtarifaultimo($ordcomcodcli,$idcon);
								  }
								  $totalmanoobra=($tiempo*$tarifa['tarifamod']);
								  $cosotmanodeobra+=$totalmanoobra;
							  }
							 ?>
							<tr>
								<td width="20%" class="NoiseDataTD" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Cantidad operarios</td>
								<td width="20%" class="NoiseDataTD" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;<?php  echo $nrreporte; ?></td>
								<td width="20%" class="NoiseDataTD" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;</td>
								<td width="20%" class="NoiseDataTD" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;</td>
							</tr>
							<tr>
								<td width="20%" class="NoiseDataTD" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Costo</td>
								<td width="20%" class="NoiseDataTD" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;<?php  echo number_format($totalmanoobra,2, ",", "."); ?></td>
								<td width="20%" class="NoiseDataTD" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Fecha Reporte</td>
								<td width="20%" class="NoiseDataTD" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;<?php  echo $rwreporte['repoppfecha']; ?></td>
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
</div>

<!--<div style="width:800px; height: 110px; overflow:auto; " class="ui-widget-content">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
		<?php
			if( ($a + $b) < 20 ){

				for( $c = ($a + $b); $c < 20; $c++){

					($c % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
		?>
					<tr class="<?php echo $class ?>">
						<td width="40%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
						<td width="30%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
						<td width="30%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
					</tr>
		<?php
					}
				}
		?>
		</table>
	</div>
</div>-->
<!--<div style="width:1000px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="350" class="NoiseFooterTD" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Tiempo total</td>
				<td width="80" class="NoiseDataTD">&nbsp;<?php //echo number_format($totaltiempo, 2, ",", "."); ?></td>
			</tr>
			<tr>
				<td width="350" class="NoiseFooterTD" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Costo mano de obra</td>
				<td width="80" class="NoiseDataTD">&nbsp;<?php //echo number_format($cosotmanodeobra, 2, ",", "."); ?></td>
			</tr>
		</table>
	</div>
</div>-->
<input type="hidden" name="consolcostmo" id="consolcostmo" value="<?php echo $cosotmanodeobra; ?>">
