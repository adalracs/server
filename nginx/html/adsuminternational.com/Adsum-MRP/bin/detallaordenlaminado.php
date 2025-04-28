<?php
ini_set('display_errors',1);
	if(!$noAjax)
	{
		include ( '../src/FunPerPriNiv/pktblreporteoppreportepn.php');
		include ( '../src/FunPerPriNiv/pktblprogramalaminado.php');
		include ( '../src/FunPerPriNiv/pktblprogramaflexo.php');
		include ( '../src/FunPerPriNiv/pktbloplaminado.php');
		include ( '../src/FunPerPriNiv/pktblplanta.php');
		include ( '../src/FunPerPriNiv/pktblop.php');
		include ( '../src/FunPerPriNiv/pktbloppitemdesa.php');
		include ( '../src/FunPerPriNiv/pktblitemdesa.php');
		include ( '../src/FunPerSecNiv/fncconn.php');
		include ( '../src/FunPerSecNiv/fncclose.php');
		include ( '../src/FunPerSecNiv/fncfetch.php');
		include ( '../src/FunPerSecNiv/fncsqlrun.php');
		include ( '../src/FunPerSecNiv/fncnumreg.php');
		include ( '../src/FunGen/cargainput.php');
	}

	$idcon = fncconn();
	
	//conexion
	$idcon = fncconn();
	//validacion de filtros para la bandeja de extrusion
	if($plantacodigo || $ordprodesem || $ordprotiposo)
	{
		$record['plantacodigo'] = $plantacodigo;
		$recordop['plantacodigo'] = '=';
		$record['ordprodesem'] = $ordprodesem;
		$recordop['ordprodesem'] = '=';
		$record['ordprotiposo'] = $ordprotiposo;
		$recordop['ordprotiposo'] = '=';		
		$rsLaminado = dinamicscanopprogramalaminado1($record, $recordop, $idcon, $rtr = 1);
	}
	else
	{
		$rsLaminado = fullscanprogramalaminado1($idcon);
	}
	//se valida y consulta el numero de registros de la consulta
	if($rsLaminado)
		$nrLaminado = fncnumreg($rsLaminado);
	//varibles para cantidad por equipos
	$totalopp_und = 0;
	$totalopp_mts = 0;
	$totalopp_kgs = 0;
?>
<script type="text/javascript">
	Event_animatedcollapse('<?php echo $nrLaminado ?>', 'filtrOpp');
</script>
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">
	<tr>
		<td class="ui-state-default" width="5%"  align="center"><span class="ui-icon ui-icon-arrowthickstop-1-s"></span></td>
		<td class="ui-state-default" width="5%"  align="center">Sel.</td> 
		<td class="ui-state-default" width="5%"  align="center"># OPP</td>
		<td class="ui-state-default" width="7%"  align="center"># PV</td>
		<td class="ui-state-default" width="20%"  align="center">Referencia</td>
		<td class="ui-state-default" width="10%"  align="center">Anc1&nbsp;<b>mm</b></td>
		<td class="ui-state-default" width="10%"  align="center">Anc2&nbsp;<b>mm</b></td>
		<td class="ui-state-default" width="10%"  align="center">F. Entrega</td>
		<td class="ui-state-default" width="10%"  align="center">Kilogramos&nbsp;</td>
		<td class="ui-state-default" width="10%"  align="center">Metros&nbsp;</td>
		<td class="ui-state-default" width="5%"  align="center"><span class="ui-icon ui-icon-person"></span></td>
	</tr>
<?php 
		for($b = 0; $b < $nrLaminado; $b++):
			$rwLaminado = fncfetch($rsLaminado, $b);
			//sumatoria de unidades , metros, kilogramos
			$totalopp_und = $totalopp_und + 1; 
			$totalopp_kgs = $totalopp_kgs + $rwLaminado['ordoppcantkg'];
			$totalopp_mts = $totalopp_mts + $rwLaminado['ordoppcantmt'];
			//rutina para material asignado a la orden
			$MATLAMINADO = '';
			$rsOppItemDesa = dinamicscanopoppitemdesa(array('ordoppcodigo' => $rwLaminado['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
			$nrOppItemDesa = fncnumreg($rsOppItemDesa);
			for($c = 0; $c < $nrOppItemDesa; $c++)
			{
				$rWOppItemDesa = fncfetch($rsOppItemDesa, $c);
				if($rWOppItemDesa['itedescodigo']) $MATLAMINADO = ($MATLAMINADO)? $MATLAMINADO.'<br>&nbsp;'.strtoupper($rWOppItemDesa['itedescodigo']).' - '.carganombitemdesa($rWOppItemDesa['itedescodigo'],$idcon) : strtoupper($rWOppItemDesa['itedescodigo']).' - '.carganombitemdesa($rWOppItemDesa['itedescodigo'],$idcon) ;
			}
			//rutina para proceso de impresion
			$MATIMPRESO = '';
			$CANTIMPRESO = 0;
			$METROSIMPRESO = 0;
			$rwOp = loadrecordop1($rwLaminado['ordoppcodigo'],$idcon);
			$rsProgramaFlexo = dinamicscanopop1(array( 'solprocodigo' => $rwOp['solprocodigo'], 'tipsolcodigo' => 3 ), array( 'solprocodigo' => '=', 'tipsolcodigo' => '=' ), $idcon);
			$nrProgramaFlexo = fncnumreg($rsProgramaFlexo);

			if($nrProgramaFlexo < 0 || !$nrProgramaFlexo)
				$MATIMPRESO = strtoupper('sin impresion');


			for($c = 0; $c < $nrProgramaFlexo; $c++)
			{
				$rwProgramaFlexo = fncfetch($rsProgramaFlexo, $c);

				if($rwProgramaFlexo["ordoppcodigo"] > 0){
				
					$rsReporteoppReportepn = dinamicscanopreporteoppreportepn1( array( 'ordoppcodigo' => $rwProgramaFlexo['ordoppcodigo'] ), array( 'ordoppcodigo' => '='), $idcon);
					$nrReporteoppReportepn = fncnumreg($rsReporteoppReportepn);
					for($d = 0; $d < $nrReporteoppReportepn; $d++)
					{
						$rwReporteoppReportepn = fncfetch($rsReporteoppReportepn, $d);
						$CANTIMPRESO += $rwReporteoppReportepn['reoppncantkg'];
						$METROSIMPRESO += $rwReporteoppReportepn['reoppncantmt'];
					}
				}
			}

			if($CANTIMPRESO > 0 && $METROSIMPRESO > 0)
				$MATIMPRESO = strtoupper('Kgs: '.number_format($CANTIMPRESO,2 , ',', '.').' Mts: '.number_format($METROSIMPRESO, 2, ',', '.'));
			else
				$MATIMPRESO = strtoupper('no impreso');
			
			//rutina para traer las op's que contienen la opp madre
			$rsOpproduccion = dinamicscanopop(array('ordoppcodigo' => $rwLaminado['ordoppcodigo']),(array('ordoppcodigo' => '=')),$idcon);
			$nrOpproduccion = fncnumreg($rsOpproduccion);
			//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
			$ANCHOLAMINADO = '';
			$ANCHOLAMINADO2 = '';
			$KILOSLAMINADO = '';
			$METROSLAMINADO = '';
			$APROBADOLAMINADO = '';
			$SPANLAMINADO = '';
			//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
			$TIPOADHESIVO = '';
			$DESEMPENOADHESIVO = '';
			$LAMINADOADHESIVO = '';
			$FECHAENTREGA = '';
			$PEDIDOPRODUCCION = '';
			$CLIENTEPRODUCCION = '';
			$REFPRODUCCION = '';
			$ITEMPRODUCCION = '';
			$TIPOPEDIDOVENTA = '';
			//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
			$ANCHOLAMINADO = ($rwLaminado['ordoppanchot'])? $rwLaminado['ordoppanchot'] : '---' ;
			$KILOSLAMINADO = ($rwLaminado['ordoppcantkg'])? $rwLaminado['ordoppcantkg'] : '---' ;
			$METROSLAMINADO = ($rwLaminado['ordoppcantmt'])? $rwLaminado['ordoppcantmt'] : '---' ;
			$SPANLAMINADO = ($rwLaminado['equipocodigo'])? 'ui-icon ui-icon-check' : 'ui-icon ui-icon-help' ;
			for($c = 0;$c < $nrOpproduccion;$c++)
			{				
				$rwOpproduccion = fncfetch($rsOpproduccion, $c);
				$rwOplaminado = loadrecordoplaminado($rwOpproduccion['ordprocodigo'],$idcon);
				//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
				$TIPOADHESIVO = ($rwOplaminado['ordprotiposo'])? strtoupper($rwOplaminado['ordprotiposo']) : '---' ;
				$DESEMPENOADHESIVO = ($rwOplaminado['ordprodesemp'])? strtoupper($rwOplaminado['ordprodesemp']) : '---' ;
				$LAMINADOADHESIVO = ($rwOplaminado['ordprolamina'])? strtoupper($rwOplaminado['ordprolamina']) : '---' ;
				$ANCHOLAMINADO2 = ($rwOplaminado['ordproancalt'])? strtoupper($rwOplaminado['ordproancalt']) : '---' ;
//				$ANCHOLAMINADO = ($rwOplaminado['ordproanclam'])? $rwOplaminado['ordproanclam'] : '---' ;				
				//VARIABLES ACUMULABLES A USAR EN OP {ORDENES DE PRODUCCION}
				if($rwOplaminado['pedvenfecent']) $FECHAENTREGA = ($FECHAENTREGA)? $FECHAENTREGA.'<br>&nbsp;'.strtoupper($rwOplaminado['pedvenfecent']) : strtoupper($rwOplaminado['pedvenfecent']) ;
				if($rwOplaminado['pedvennumero']) $PEDIDOPRODUCCION = ($PEDIDOPRODUCCION)? $PEDIDOPRODUCCION.'<br>&nbsp;'.$rwOplaminado['pedvennumero'] : $rwOplaminado['pedvennumero'] ;
				if($rwOplaminado['ordcomrazsoc']) $CLIENTEPRODUCCION = ($CLIENTEPRODUCCION)? $CLIENTEPRODUCCION.'<br>&nbsp;'.$rwOplaminado['ordcomrazsoc'] : $rwOplaminado['ordcomrazsoc'] ;
				if($rwOplaminado['producnombre']) $REFPRODUCCION = ($REFPRODUCCION)? $REFPRODUCCION.'<br>&nbsp;'.$rwOplaminado['producnombre'] : $rwOplaminado['producnombre'] ;
				if($rwOplaminado['produccoduno']) $ITEMPRODUCCION = ($ITEMPRODUCCION)? $ITEMPRODUCCION.'<br>&nbsp;'.$rwOplaminado['produccoduno'] : $rwOplaminado['produccoduno'] ;
				if($rwOplaminado['tipevenombre']) $TIPOPEDIDOVENTA = ($TIPOPEDIDOVENTA)? $TIPOPEDIDOVENTA.'<br>&nbsp;'.$rwOplaminado['tipevenombre'] : $rwOplaminado['tipevenombre'];
			}
			($b % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
?>			
	<tr <?php echo $complement; ?> >
		<td width="5%" align="center"><a href="javascript:animatedcollapse.toggle('filtrOpp_<?php echo $b ?>');"><img id="row" align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0"></a></td>
		<td width="5%" class="cont-line"><input type="radio" id="chkopp" name="chkopp" <?php echo $checked ?> onclick="setArropp(this.value);" value="<?php echo $rwLaminado['ordoppcodigo'] ?>"></td>
		<td width="5%" class="cont-line">&nbsp;<font color="blue"><b><?php echo str_pad($rwOplaminado['solprocodigo'], 4, "0", STR_PAD_LEFT); ?></b></font></td>
		<td width="7%" class="cont-line">&nbsp;<font color="brown"><b><?php echo $PEDIDOPRODUCCION; ?></b></font></td>
		<td width="25%" class="cont-line">&nbsp;<font color="blue"><small><?php echo $REFPRODUCCION; ?></small></font></td>
		<td width="10%" class="cont-line">&nbsp;<?php echo $ANCHOLAMINADO; ?></td>
		<td width="10%" class="cont-line">&nbsp;<?php echo $ANCHOLAMINADO2; ?></td>
		<td width="10%" class="cont-line">&nbsp;<?php echo $FECHAENTREGA; ?></td>
		<td width="10%" class="cont-line">&nbsp;<font color="green"><b><?php echo number_format($KILOSLAMINADO, 2, ',', '.'); ?></b></font></td>
		<td width="10%" class="cont-line">&nbsp;<font color="green"><b><?php echo number_format($METROSLAMINADO, 2, ',', '.'); ?></b></font></td>
		<td width="5%" class="cont-line">&nbsp;<span class="<?php echo $SPANLAMINADO; ?>" style="float: left;"></span></td>
	</tr>
	<tr <?php echo $complement; ?> >
		<td colspan="11">
			<div id="filtrOpp_<?php echo $b ?>" style="display: none;" >
				<table border="0" cellspacing="1" cellpadding="1" style="border-top:none; border-right:none;" align="left" class="ui-widget-content" width="100%">
					<tr>
						<td width="100" class="ui-state-default"><small>Tipo PV</small></td>
						<td width="100" class="ui-state-default"><small>Item&nbsp;</small></td>
						<td width="440" class="ui-state-default"><small>Cliente&nbsp;</small></td>
						<td width="100" class="ui-state-default"><small>Adhesivo&nbsp;</small></td>
						<td width="100" class="ui-state-default"><small>Desempe&ntilde;o&nbsp;</small></td>
						<td width="180" class="ui-state-default"><small>Laminado&nbsp;</small></td>
					</tr>
					<tr>
						<td class="NoiseFooterTD" valign="top">&nbsp;<small><?php echo $TIPOPEDIDOVENTA; ?></small></td>
						<td class="NoiseFooterTD" valign="top">&nbsp;<small><?php echo $ITEMPRODUCCION; ?></small></td>
						<td class="NoiseFooterTD" valign="top">&nbsp;<small><?php echo $CLIENTEPRODUCCION; ?></small></td>
						<td class="NoiseFooterTD" valign="top">&nbsp;<small><?php echo $TIPOADHESIVO; ?></small></td>
						<td class="NoiseFooterTD" valign="top">&nbsp;<small><?php echo $DESEMPENOADHESIVO; ?></small></td>
						<td class="NoiseFooterTD" valign="top">&nbsp;<small><?php echo $LAMINADOADHESIVO; ?></small></td>
					</tr>
					<tr>
						<td width="100" class="ui-state-default"><small>Material</small></td>
						<td colspan="2" class="NoiseFooterTD" valign="top">&nbsp;<small><?php echo $MATLAMINADO; ?></small></td>
						<td colspan="1" class="ui-state-default"><small>Estado</small></td>
						<td colspan="2" class="NoiseFooterTD" valign="top"><small>&nbsp;<?php echo $MATIMPRESO; ?></small></td>
					</tr>
				</table>
			</div>
		</td>		
	</tr>	
<?php
		endfor;	
	
	if($b < 13):
		for($c = $b; $c < 35; $c++):
			($c % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="5%" align="center" class="cont-line">&nbsp;</td>
				<td width="5%" align="center" class="cont-line">&nbsp;</td>
				<td width="5%" align="center" class="cont-line">&nbsp;</td>
				<td width="7%" align="center" class="cont-line">&nbsp;</td>
				<td width="25%" align="center" class="cont-line">&nbsp;</td>
				<td width="10%" align="center" class="cont-line">&nbsp;</td>
				<td width="10%" align="center" class="cont-line">&nbsp;</td>
				<td width="10%" align="center" class="cont-line">&nbsp;</td>
				<td width="10%" align="center" class="cont-line">&nbsp;</td>
				<td width="10%" align="center" class="cont-line">&nbsp;</td>
				<td width="5%" align="center" class="cont-line">&nbsp;</td>
			</tr>
<?php
			endfor;
		endif;	
?>
</table>
<input type="hidden" name="totalopp_und" id="totalopp_und" value="<?php echo $totalopp_und ?>" />
<input type="hidden" name="totalopp_kgs" id="totalopp_kgs" value="<?php echo $totalopp_kgs ?>" />
<input type="hidden" name="totalopp_mts" id="totalopp_mts" value="<?php echo $totalopp_mts ?>" />