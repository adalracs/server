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


	 	$sql="SELECT vistaoppcosto.ordoppcodigo,vistaoppcosto.producnombre,vistaoppcosto.equipocodigo,vistaoppcosto.ordprofecgen,vistaoppcosto.equiponombre,reporteopp.repoppfecha
								from vistaoppcosto
								inner join reporteopp on reporteopp.ordoppcodigo=vistaoppcosto.ordoppcodigo
								inner join reporteopptiempopn on  reporteopptiempopn.repoppcodigo=reporteopp.repoppcodigo
								inner join tiempopn on tiempopn.tiempocodigo = reporteopptiempopn.tiempocodigo
								where vistaoppcosto.ordprofecgen BETWEEN '".$consulfecini."' AND '".$consulfecfin."' 
								AND vistaoppcosto.tipsolcodigo = '".$ordcomcodcli."'";
								
					

		$rsManoobra=fncsqlrun($sql,$idcon);				
		$nrManoobra=fncnumreg($rsManoobra);
	}

?>	
<div style="width:100%; height: 110px; overflow:auto; " class="ui-widget-content">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
			<?php 
			if($nrManoobra > 0){//listado de saldos a asignar
				for($a = 0; $a < $nrManoobra; $a++){
				$rwManoobra = fncfetch($rsManoobra, $a);

				  $fec = explode('-',$rwreporte['repoppfecha']); 
				  $tarifa = loadrecordtarifafecha($ordcomcodcli,$fec[1],$fec[0],$idcon);
				  if($tarifa<0){
				  	
				  		$tarifa = loadrecordtarifaultimo($ordcomcodcli,$idcon);
				  }
					$tarifamod += $tarifa["tarifamod"];
					$tarifamoi += $tarifa["tarifamoi"];
					$tarifacdep += $tarifa["tarifacdep"];
					$tarifasdep += $tarifa["tarifasdep"];
					$tarifaene += $tarifa["tarifaene"];
					$tarifaman += $tarifa["tarifaman"];
					$tarifaotros += $tarifa["tarifaotros"];

				}
			}
			?>
			<tr>
				<td  width="100" class="NoiseFooterTD" style="border-top:0; border-bottom:0; border-left:0;">Mano de obra Indirecta</td>
				<td width="100" class="NoiseFooterTD" style="border-top:0; border-bottom:0; border-left:0;">Energia</td>
				<td width="100" class="NoiseFooterTD" style="border-top:0; border-bottom:0; border-left:0;">Mantenimiento</td>
				<td width="100" class="NoiseFooterTD" style="border-top:0; border-bottom:0; border-left:0;">Otros Gastos</td>
				<td width="100" class="NoiseFooterTD" style="border-top:0; border-bottom:0; border-left:0;">Depreciacion</td>
				<td width="100" class="NoiseFooterTD" style="border-top:0; border-bottom:0; border-left:0;">Total costo Fabrica</td>
			</tr>
			<tr>
				<td  width="80" class="NoiseDataTD"><?php echo '$'.number_format($tarifamoi, 2, ",", ".");  ?></td>
				<td width="80" class="NoiseDataTD"><?php echo '$'.number_format($tarifaene, 2, ",", ".");  ?></td>
				<td width="80" class="NoiseDataTD"><?php echo '$'.number_format($tarifaman, 2, ",", ".");  ?></td>
				<td width="80" class="NoiseDataTD"><?php echo '$'.number_format($tarifaotros, 2, ",", ".");  ?></td>
				<td width="80" class="NoiseDataTD"><?php echo '$'.number_format($tarifacdep, 2, ",", ".");  ?></td>
				<td width="80" class="NoiseDataTD"><?php echo '$'.number_format($tarifamoi+$tarifaene+$tarifaman+$tarifaotros+$tarifacdep, 2, ",", ".");  ?></td>
			</tr>
		</table>
	</div>
</div>
<input type="hidden" name="totalcostofab" id="totalcostofab" value="<?php echo $tarifamoi+$tarifaene+$tarifaman+$tarifaotros+$tarifacdep; ?>">