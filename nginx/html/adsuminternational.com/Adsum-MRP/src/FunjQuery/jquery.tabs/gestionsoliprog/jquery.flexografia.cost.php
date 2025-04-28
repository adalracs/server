<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" >
	<tr class="ui-widget-header">
		<td colspan="9" width="50%" class="cont-title">&nbsp;FLEXOGRAFIA&nbsp;</td>
	</tr>
</table>
<?php 
ini_set("display_errors", 1);
$idcon = fncconn();
if($solprocodigo){
	$rsOP = dinamicscanopop2(array('solprocodigo' => $solprocodigo,'tipsolcodigo' => 3),array('solprocodigo' => '=','tipsolcodigo' => '='),$idcon);
	$nrOP = fncnumreg($rsOP);
}
if(!$nrOP)
{
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr>
		<td>
			<div class="ui-widget">
				<div style="margin-top: 1px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all">
					<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span> <b>No se encontraron opp.</b></p>
				</div>
			</div>
		</td>
	</tr>
</table>
<?php
}
	for($a = 0;$a < $nrOP;$a++)
	{
		$rwOP = fncfetch($rsOP,$a);
		if( $rwOP['ordoppcodigo']){
			$rsOpproduccion = dinamicscanopop(array('ordoppcodigo' => $rwOP['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
			$nrOpproduccion = fncnumreg($rsOpproduccion);
			$arrop=array();
			//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
			$ANCHOIMPRESION = '';
			$KILOSIMPRESION = '';
			$METROSIMPRESION = '';
			$APROBADOIMPRESION = '';
			//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
			$MATERIALIMPRESION = '';
			$TIPOIMPRESION = '';
			$FECHAENTREGA = '';
			$RODILLOIMPRESION = '';
			//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
			$ANCHOIMPRESION = ($rwOP['ordoppanchot'])? $rwOP['ordoppanchot'] : '---' ;
			$KILOSIMPRESION = ($rwOP['ordoppcantkg'])? $rwOP['ordoppcantkg'] : '---' ;
			$METROSIMPRESION = ($rwOP['ordoppcantmt'])? $rwOP['ordoppcantmt'] : '---' ;
			for($b = 0;$b < $nrOpproduccion;$b++)
			{
				$rwOpproduccion = fncfetch($rsOpproduccion, $b);
				if($rwOpproduccion['ordprocodigo']){
					$rwOpflexografia = loadrecordopflexo($rwOpproduccion['ordprocodigo'],$idcon);
					$arrop=$rwOpflexografia['paditecodigo'];
					//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
					$MATERIALIMPRESION = ($rwOpflexografia['paditenombre'])? $rwOpflexografia['paditenombre'] : '---' ;
					$TIPOIMPRESION = ($rwOpflexografia['ordprotipimp'])? strtoupper($rwOpflexografia['ordprotipimp']) : '---' ;
					$RODILLOIMPRESION = ($rwOpflexografia['ordprorodill'])? $rwOpflexografia['ordprorodill'] : '---' ;
					//VARIABLES ACUMULABLES A USAR EN OP {ORDENES DE PRODUCCION}
					if($rwOpflexografia['pedvenfecent']) $FECHAENTREGA = ($FECHAENTREGA)? $FECHAENTREGA.'<br>&nbsp;'.strtoupper($rwOpflexografia['pedvenfecent']) : strtoupper($rwOpflexografia['pedvenfecent']) ;
				}
			}
		}
		($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)" ' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)" ';
	?>
	<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
		<tr> 
			<td class="ui-state-default" width="10%"  align="center"># OPP</td>
			<td class="ui-state-default" width="30%"  align="center">Material</td>
			<td class="ui-state-default" width="10%"  align="center">Ancho</td>
			<td class="ui-state-default" width="10%"  align="center"><b>Kgs Pr.</b></td>
			<td class="ui-state-default" width="10%"  align="center"><b>Mts Pr.</b></td>  
			<td class="ui-state-default" width="10%"  align="center">Impresion</td>
			<td class="ui-state-default" width="10%"  align="center">F. Entega</td>
			<td class="ui-state-default" width="10%"  align="center">Rodillo</td>
		</tr>
		<tr <?php echo $complement ?>>
			<td class="cont-line" rowspan="6">&nbsp;<?php echo str_pad($rwOP['ordoppcodigo'], 4, "0", STR_PAD_LEFT); ?></td>
			<td class="cont-line">&nbsp;<?php echo $MATERIALIMPRESION; ?></td>
			<td class="cont-line">&nbsp;<?php echo $ANCHOIMPRESION; ?></td>
			<td class="cont-line">&nbsp;<?php echo number_format($KILOSIMPRESION, 2, ',', '.'); ?></td>
			<td class="cont-line">&nbsp;<?php echo number_format($METROSIMPRESION, 2, ',', '.'); ?></td>
			<td class="cont-line">&nbsp;<?php echo $TIPOIMPRESION; ?></td>
			<td class="cont-line">&nbsp;<?php echo $FECHAENTREGA; ?></td>
			<td class="cont-line">&nbsp;<?php echo $RODILLOIMPRESION; ?></td>
		</tr>
		<tr <?php echo $complement ?>>
			<td class="cont-line" colspan="7">
				<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">
					<tr class="ui-state-default" >
						<td width="10%"  align="center">&nbsp;Materias Primas consumidas</td>
						<td width="10%"  align="center">&nbsp;Descripci&oacute;n</td>
						<td width="10%"  align="center">&nbsp;Cantidad real</td>
						<td width="10%"  align="center">&nbsp;Costo total</td>
					</tr>
			<?php 	
				$rsGestionopp = dinamicscanopgestionopp(array('ordoppcodigo' => $rwOP['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
				$nrGestionopp = fncnumreg($rsGestionopp);
				for ($w=0; $w <$nrGestionopp; $w++) { 
					$rwGestionopp = fncfetch($rsGestionopp,$w);
					$rsGestionoppitem = dinamicscanopgestionoppitemdesa(array('gesoppcodigo' => $rwGestionopp['gesoppcodigo']),array('gesoppcodigo' => '='),$idcon);
					$nrGestionoppitem = fncnumreg($rsGestionoppitem);
					for ($s=0; $s < $nrGestionoppitem; $s++) { 
						$rwGestionoppitem = fncfetch($rsGestionoppitem,$s);
						$rwItem = loadrecorditemdesa($rwGestionoppitem['itedescodigo'],$idcon);
						$costosMateriaprima+=$rwItem['itedescosto']*$rwGestionoppitem['gesoppcantkg'];

						/*$rcont++;
						$objPHPExcel->getActiveSheet($sheet)->setCellValue('A'.$rcont,$solprocodigo)->getStyle('A'.$rcont)->applyFromArray($styleArray);
						$objPHPExcel->getActiveSheet($sheet)->setCellValue('B'.$rcont,$producnombre)->getStyle('B'.$rcont)->applyFromArray($styleArray);
						$objPHPExcel->getActiveSheet($sheet)->setCellValue('C'.$rcont,$ordcomrazsoc)->getStyle('C'.$rcont)->applyFromArray($styleArray);
						$objPHPExcel->getActiveSheet($sheet)->setCellValue('D'.$rcont,"Proceso")->getStyle('D'.$rcont)->applyFromArray($styleArray);
						$objPHPExcel->getActiveSheet($sheet)->setCellValue('E'.$rcont,str_pad($rwOP['ordoppcodigo'], 4, "0", STR_PAD_LEFT))->getStyle('E'.$rcont)->applyFromArray($styleArray);
						$objPHPExcel->getActiveSheet($sheet)->setCellValue('F'.$rcont,$rwItem['itedescodigo'])->getStyle('F'.$rcont)->applyFromArray($styleArray);
						$objPHPExcel->getActiveSheet($sheet)->setCellValue('G'.$rcont,$rwItem['itedesnombre'])->getStyle('G'.$rcont)->applyFromArray($styleArray);
						$objPHPExcel->getActiveSheet($sheet)->setCellValue('H'.$rcont,$rwGestionoppitem['gesoppcantkg'])->getStyle('H'.$rcont)->applyFromArray($styleArray);
						$objPHPExcel->getActiveSheet($sheet)->setCellValue('I'.$rcont,$rwItem['itedescosto'])->getStyle('I'.$rcont)->applyFromArray($styleArray);
						$objPHPExcel->getActiveSheet($sheet)->setCellValue('J'.$rcont,$rwItem['itedescosto']*$rwGestionoppitem['gesoppcantkg'])->getStyle('J'.$rcont)->applyFromArray($styleArray);*/
			?>
					<tr class="NoiseFooterTD">
						<td class="cont-line">&nbsp;<?php echo $rwItem['itedescodigo']; ?></td>
						<td class="cont-line">&nbsp;<?php echo $rwItem['itedesnombre']; ?></td>
						<td class="cont-line">&nbsp;<?php echo number_format($rwGestionoppitem['gesoppcantkg'], 2, ',', '.'); ?></td>
						<td class="cont-line">&nbsp;<?php echo '$'.number_format($rwItem['itedescosto']*$rwGestionoppitem['gesoppcantkg'], 2, ',', '.'); ?></td>
					</tr>
					<?php }?>
				<?php }?>
				</table>
			</td>
		</tr>
		<tr <?php echo $complement ?>>
			<td class="cont-line" colspan="7">
				<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">
					<tr class="ui-state-default" >
						<td width="10%"  align="center">&nbsp;Tiempo</td>
						<td width="10%"  align="center">&nbsp;Costos</td>
					</tr>
			<?php 	
						 	
				$sql=" SELECT DISTINCT vistaoppcosto.ordoppcodigo,vistaoppcosto.producnombre,vistaoppcosto.equipocodigo,vistaoppcosto.ordprofecgen,vistaoppcosto.equiponombre,(sum(reporteopptiempopn.reoptihorfin)-sum(reporteopptiempopn.reoptihorini)) as diferencia,reporteopp.repoppfecha
						from vistaoppcosto
						inner join reporteopp on reporteopp.ordoppcodigo=vistaoppcosto.ordoppcodigo
						inner join reporteopptiempopn on  reporteopptiempopn.repoppcodigo=reporteopp.repoppcodigo
						inner join tiempopn on tiempopn.tiempocodigo = reporteopptiempopn.tiempocodigo
						where vistaoppcosto.ordoppcodigo = '".$rwOP['ordoppcodigo']."'
						group by vistaoppcosto.ordoppcodigo,vistaoppcosto.producnombre,vistaoppcosto.equipocodigo,vistaoppcosto.ordprofecgen,vistaoppcosto.equiponombre,reporteopp.repoppfecha
						order by vistaoppcosto.ordoppcodigo";							
				$rsManoobra=fncsqlrun($sql,$idcon);				
				$nrManoobra=fncnumreg($rsManoobra);
				if($nrManoobra > 0){//listado de saldos a asignar
					for($a = 0; $a < $nrManoobra; $a++){
						$rwManoobra = fncfetch($rsManoobra, $a);
						$rwManoobra["diferencia"];
						if($rwManoobra["diferencia"]<0)$rwManoobra["diferencia"]=date("H:i:s", strtotime("00:00:00") + $rwManoobra["diferencia"] *-1);
						$horMin = explode(':', $rwManoobra['diferencia']);
						$tiempo=$horMin[0]+($horMin[1]/60);
						$totaltiempo+=$tiempo;

						$rwEquipo = loadrecordequipo($rwManoobra['equipocodigo'],$idcon);
						$fec = explode('-',$rwManoobra['repoppfecha']);
						$tarifa = loadrecordtarifafecha($rwEquipo['cencoscodigo'],$fec[1],$fec[0],$idcon);
						  if($tarifa<0){
						  	
						  		$tarifa = loadrecordtarifaultimo($rwEquipo['cencoscodigo'],$idcon);
						  }
						$totalmanoobra=($tiempo*$tarifa['tarifamod']);
						$cosotmanodeobra+=$totalmanoobra;
			?>
					<tr class="NoiseFooterTD">
						<td class="cont-line">&nbsp;<?php echo $rwManoobra["diferencia"]; ?></td>
						<td class="cont-line">&nbsp;<?php echo number_format($totalmanoobra, 2, ',', '.'); ?></td>
					</tr>
					<?php }?>
				<?php }?>
				</table>
			</td>
		</tr>
		<tr <?php echo $complement ?>>
			<td class="cont-line" colspan="7">
				<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">
					<tr class="ui-state-default" >
						<td width="10%"  align="center">&nbsp;Desperdicios</td>
						<td width="10%"  align="center">&nbsp;Cantidad</td>
						<td width="10%"  align="center">&nbsp;MP</td>
						<td width="10%"  align="center">&nbsp;Precio unitario</td>
						<td width="10%"  align="center">&nbsp;Costo total</td>
					</tr>
			<?php 	
					 $sql="SELECT DISTINCT desperdiciopn.despernombre,itemdesa.itedesnombre,itemdesa.itedescosto,sum(reporteoppdesperdiciopn.reopdecantkg) as reopdecantkg
						from vistaoppcosto
						inner join reporteopp on reporteopp.ordoppcodigo=vistaoppcosto.ordoppcodigo
						inner join reporteoppmaterial on reporteoppmaterial.repoppcodigo=reporteopp.repoppcodigo
						left join gestionoppreporte on gestionoppreporte.geoprecodigo=reporteoppmaterial.geoprecodigo
						left join gestionoppitemdesa on gestionoppitemdesa.itedescodigo=gestionoppreporte.itedescodigo
						left join itemdesa on itemdesa.itedescodigo=gestionoppitemdesa.itedescodigo
						inner join reporteoppdesperdiciopn on  reporteoppdesperdiciopn.repoppcodigo=reporteopp.repoppcodigo
						inner join desperdiciopn on desperdiciopn.despercodigo = reporteoppdesperdiciopn.despercodigo
						where vistaoppcosto.ordoppcodigo = '".$rwOP['ordoppcodigo']."'
						group by desperdiciopn.despernombre,itemdesa.itedesnombre,itemdesa.itedescosto
						order by desperdiciopn.despernombre";

				$rsDesperdicio=fncsqlrun($sql,$idcon);				
				$nrDesperdicio=fncnumreg($rsDesperdicio);	
				for($a = 0; $a < $nrDesperdicio; $a++){
					$rwDesperdicio = fncfetch($rsDesperdicio, $a); 	
					$costosMateriaprima+=($rwDesperdicio['itedescosto']*$rwDesperdicio['reopdecantkg']);
			?>
					<tr class="NoiseFooterTD">
						<td class="cont-line">&nbsp;<?php echo $rwDesperdicio["despernombre"]; ?></td>
						<td class="cont-line">&nbsp;<?php echo number_format($rwDesperdicio["reopdecantkg"], 2, ",", "."); ?></td>
						<td class="cont-line">&nbsp;<?php echo $rwDesperdicio['itedesnombre']; ?></td>
						<td class="cont-line">&nbsp;<?php echo '$'.number_format($rwDesperdicio['itedescosto'], 2, ',', '.'); ?></td>
						<td class="cont-line">&nbsp;<?php echo '$'.number_format($rwDesperdicio['itedescosto']*$rwDesperdicio['reopdecantkg'], 2, ',', '.'); ?></td>
					</tr>
					<?php }?>
				</table>
			</td>
		</tr>
		<tr <?php echo $complement ?>>
			<td class="cont-line" colspan="7">
				<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">
					<tr class="ui-state-default" >
						<td  width="100" align="center">Mano de obra Indirecta</td>
						<td width="100" align="center">Energia</td>
						<td width="100" align="center">Mantenimiento</td>
						<td width="100" align="center">Otros Gastos</td>
						<td width="100" align="center">Depreciacion</td>
						<td width="100" align="center">Total costo Fabrica</td>
					</tr>
			<?php 	
	           $sql=" SELECT DISTINCT vistaoppcosto.ordoppcodigo,vistaoppcosto.producnombre,vistaoppcosto.equipocodigo,vistaoppcosto.ordprofecgen,vistaoppcosto.equiponombre,(sum(reporteopptiempopn.reoptihorfin)-sum(reporteopptiempopn.reoptihorini)) as diferencia,reporteopp.repoppfecha
						from vistaoppcosto
						inner join reporteopp on reporteopp.ordoppcodigo=vistaoppcosto.ordoppcodigo
						inner join reporteopptiempopn on  reporteopptiempopn.repoppcodigo=reporteopp.repoppcodigo
						inner join tiempopn on tiempopn.tiempocodigo = reporteopptiempopn.tiempocodigo
						where vistaoppcosto.ordoppcodigo = '".$rwOP['ordoppcodigo']."' AND vistaoppcosto.solprocodigo ='".$solprocodigo."'
						group by vistaoppcosto.ordoppcodigo,vistaoppcosto.producnombre,vistaoppcosto.equipocodigo,vistaoppcosto.ordprofecgen,vistaoppcosto.equiponombre,reporteopp.repoppfecha
						order by vistaoppcosto.ordoppcodigo";

				$rsCIF=fncsqlrun($sql,$idcon);				
				$nrCIF=fncnumreg($rsCIF);	
				for($a = 0; $a < $nrCIF; $a++){
					$rwCIF = fncfetch($rsCIF, $a);
					$rwEquipo = loadrecordequipo($rwCIF['equipocodigo'],$idcon);
					$fec = explode('-',$rwManoobra['repoppfecha']);
					$tarifa = loadrecordtarifafecha($rwEquipo['cencoscodigo'],$fec[1],$fec[0],$idcon);
				    if($tarifa<0){
				  		$tarifa = loadrecordtarifaultimo($rwEquipo['cencoscodigo'],$idcon);
				    }
				    $tarifamod += $tarifa["tarifamod"];
					$tarifamoi += $tarifa["tarifamoi"];
					$tarifacdep += $tarifa["tarifacdep"];
					$tarifasdep += $tarifa["tarifasdep"];
					$tarifaene += $tarifa["tarifaene"];
					$tarifaman += $tarifa["tarifaman"];
					$tarifaotros += $tarifa["tarifaotros"];
			?>
					<tr class="NoiseFooterTD">
						<td  width="80"  class="cont-line"><?php echo '$'.number_format($tarifamoi, 2, ",", ".");  ?></td>
						<td width="80"  class="cont-line"><?php echo '$'.number_format($tarifaene, 2, ",", ".");  ?></td>
						<td width="80"  class="cont-line"><?php echo '$'.number_format($tarifaman, 2, ",", ".");  ?></td>
						<td width="80"  class="cont-line"><?php echo '$'.number_format($tarifaotros, 2, ",", ".");  ?></td>
						<td width="80"  class="cont-line"><?php echo '$'.number_format($tarifacdep, 2, ",", ".");  ?></td>
						<td width="80"  class="cont-line"><?php echo '$'.number_format($tarifamoi+$tarifaene+$tarifaman+$tarifaotros+$tarifacdep, 2, ",", ".");  ?></td>
					</tr>
					<?php }?>
				</table>
			</td>
		</tr>
	</table>
	<?php 
	}
?>