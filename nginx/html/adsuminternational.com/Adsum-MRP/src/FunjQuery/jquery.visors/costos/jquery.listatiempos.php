<?php 
ini_set("display_erros", 1);
	include_once ( "../../../FunPerPriNiv/pktbloppitemdesa.php");
	include_once ( "../../../FunPerPriNiv/pktblitemdesa.php");
	include_once ( "../../../FunPerPriNiv/pktblpadreitem.php");
	include_once ( "../../../FunPerPriNiv/pktbltarifa.php");
	include_once ( "../../../FunPerPriNiv/pktblsaldo.php");
	include_once ( "../../../FunPerSecNiv/fncnumreg.php");
	include_once ( "../../../FunPerSecNiv/fncclose.php");
	include_once ( "../../../FunPerSecNiv/fncfetch.php");
	include_once ( "../../../FunPerSecNiv/fncconn.php");
	include_once ('../../../FunPerSecNiv/fncsqlrun.php');

	$idcon = fncconn();	
	if($ordcomcodcli){

  $sql="SELECT DISTINCT tiempopn.tiemponombre,(sum(reporteopptiempopn.reoptihorfin)-sum(reporteopptiempopn.reoptihorini)) as diferencia
				from vistaoppcosto
				inner join reporteopp on reporteopp.ordoppcodigo=vistaoppcosto.ordoppcodigo
				inner join reporteopptiempopn on  reporteopptiempopn.repoppcodigo=reporteopp.repoppcodigo
				inner join tiempopn on tiempopn.tiempocodigo = reporteopptiempopn.tiempocodigo
				where vistaoppcosto.ordprofecgen BETWEEN '".$consulfecini."' AND '".$consulfecfin."' 
				AND vistaoppcosto.tipsolcodigo = '".$ordcomcodcli."'
				group by tiempopn.tiemponombre
				order by tiempopn.tiemponombre";
				

	$rsTiempos=fncsqlrun($sql,$idcon);				
	$nrTiempos=fncnumreg($rsTiempos);
	}
	$totalhoras=0;

	function resta($inicio, $fin){
		return date("H:i:s", strtotime("00:00:00") + (strtotime($fin) - strtotime($inicio)));
	}
?>	
<div style="width:100%; height: 30px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="50%" class="NoiseDataTD" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Tiempos</td>
				<td width="25%" class="NoiseDataTD" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Horas</td>
				<td width="2%" class="NoiseDataTD" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>

<div style="width:100%; height: 150px; overflow:auto; " class="ui-widget-content">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
	<?php 
		if($nrTiempos > 0){//listado de saldos a asignar
			for($a = 0; $a < $nrTiempos; $a++){
				$rwTiempos = fncfetch($rsTiempos, $a);

				/*$diferencia = resta($rwTiempos["horini"],$rwTiempos["horfin"]); 
				$tiem = explode(":", $diferencia);
				$hor=$tiem[0]*1;
				$min=$tiem[1]/60;
				$tiempo=$hor+$min;
				$tiempo=round($tiempo,2);*/
				if($rwTiempos["diferencia"]<0)$rwTiempos["diferencia"]=date("H:i:s", strtotime("00:00:00") + $rwTiempos["diferencia"] *-1);
				$totaltiempo+=$rwTiempos["diferencia"];
				($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
					
	?>			
				<tr <?php echo $complement ?> >
					<td width="50%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwTiempos["tiemponombre"]; ?></td>
					<td width="25%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwTiempos["diferencia"]; ?></td>
				</tr>
<?php
			}
		}
	?>
<?php
	if( ($a + $b) < 20 ){

		for( $c = ($a + $b); $c < 20; $c++){

			($c % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="50%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="25%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="25%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
			}
		}
?>
		</table>
	</div>
</div>
<div style="width:450px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="350" class="NoiseFooterTD" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Total Tiempo</td>
				<td width="80" class="NoiseDataTD">&nbsp;<?php echo number_format($totaltiempo, 2, ",", "."); ?></td>
			</tr>
		</table>
	</div>
</div>
