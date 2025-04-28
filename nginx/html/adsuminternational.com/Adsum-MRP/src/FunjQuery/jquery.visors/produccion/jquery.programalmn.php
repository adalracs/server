<?php

	$idcon = fncconn();

	$rsLaminado = dinamicscanopprogramalaminado1(array('equipocodigo' => $equipo, 'ordoppcomfir' => 1),array('equipocodigo' => '=', 'ordoppcomfir' => '='),$idcon, $rtr = 1);
	$nrLaminado = fncnumreg($rsLaminado);

	$total_equipound = $equipo.'_und';
	$total_equipomts = $equipo.'_mts';
	$total_equipokgs = $equipo.'_kgs';
	$total_equipotmp = $equipo.'_tmp';
	
	$rwhora = getdate(time());
	$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
	echo "<script type='text/javascript'>Event_animatedcollapse('".$nrLaminado."', 'filtrOpp_".$equipo."');</script>";
?>
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">
	<tr>
		<td class="ui-state-default" width="5%"  align="center"><span class="ui-icon ui-icon-arrowthickstop-1-s"></span></td>
		<td class="ui-state-default" width="5%"  align="center"><span class="ui-icon ui-icon-person"></span></td>
		<td class="ui-state-default" width="5%"  align="center">O.E</td> 
		<td class="ui-state-default" width="5%"  align="center"># OPP</td>
		<td class="ui-state-default" width="7%"  align="center"># PV</td>
		<td class="ui-state-default" width="20%"  align="center">Referencia</td>
		<td class="ui-state-default" width="10%"  align="center">Anc1&nbsp;<b>mm</b></td>
		<td class="ui-state-default" width="10%"  align="center">Anc2&nbsp;<b>mm</b></td>
		<td class="ui-state-default" width="10%"  align="center">F. Entrega</td>
		<td class="ui-state-default" width="10%"  align="center">Kilogramos&nbsp;</td>
		<td class="ui-state-default" width="10%"  align="center">Metros&nbsp;</td>
	</tr>
<?php 
		for($b = 0; $b < $nrLaminado; $b++):
			$rwLaminado = fncfetch($rsLaminado, $b);
			//sumatoria de unidades , metros, kilogramos
			$$total_equipound = $$total_equipound + 1; 
			$$total_equipokgs = $$total_equipokgs + $rwLaminado['ordoppcantkg'];
			$$total_equipomts = $$total_equipomts + $rwLaminado['ordoppcantmt'];
			
			//escaneo de velocidades para sumatoria de minutos de duracion de la orden
			$rsOppVelocidadpn = dinamicscanopoppvelocidadpn(array('ordoppcodigo' => $rwLaminado['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
			$nrOppVelocidadpn = fncnumreg($rsOppVelocidadpn);
			for($i = 0; $i < $nrOppVelocidadpn; $i++)
			{
				$rwOppVelocidadpn = fncfetch($rsOppVelocidadpn, $i);
				$rwVelocidadpn = loadrecordvelocidadpn($rwOppVelocidadpn['velocicodigo'],$idcon);
				$$total_equipotmp = $$total_equipotmp + $rwVelocidadpn['velocivalora'];
			}
			//escaneo de ajuste para sumatoria de minutos de duracion de la orden
			$rsOppAjustepn = dinamicscanopoppajustepn(array('ordoppcodigo' => $rwLaminado['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
			$nrOppAjustepn = fncnumreg($rsOppAjustepn);
			for($i = 0; $i < $nrOppAjustepn; $i++)
			{
				$rwOppAjustepn = fncfetch($rsOppAjustepn, $i);
				$rwAjustepn = loadrecordajustepn($rwOppAjustepn['ajustecodigo'],$idcon);
				$$total_equipotmp = $$total_equipotmp + $rwAjustepn['ajustevalora'];
			}
			//converision de mintuos a horas
			$varDate = date("Y-m-d H:i");
			//rutina para material asignado a la orden
			$rsOppItemDesa = dinamicscanopoppitemdesa(array('ordoppcodigo' => $rwLaminado['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
			$nrOppItemDesa = fncnumreg($rsOppItemDesa);
			$MATLAMINADO = '';
			for($c = 0; $c < $nrOppItemDesa; $c++)
			{
				$rWOppItemDesa = fncfetch($rsOppItemDesa, $c);
				if($rWOppItemDesa['itedescodigo']) $MATLAMINADO = ($MATLAMINADO)? $MATLAMINADO.'-&nbsp;'.strtoupper($rWOppItemDesa['itedescodigo']).' - '.carganombitemdesa($rWOppItemDesa['itedescodigo'],$idcon) : strtoupper($rWOppItemDesa['itedescodigo']).' - '.carganombitemdesa($rWOppItemDesa['itedescodigo'],$idcon) ;
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
				
				$rsReporteoppReportepn = dinamicscanopreporteoppreportepn1( array( 'ordoppcodigo' => $rwProgramaFlexo['ordoppcodigo'] ), array( 'ordoppcodigo' => '='), $idcon);
				$nrReporteoppReportepn = fncnumreg($rsReporteoppReportepn);
				for($d = 0; $d < $nrReporteoppReportepn; $d++)
				{
					$rwReporteoppReportepn = fncfetch($rsReporteoppReportepn, $d);
					$CANTIMPRESO += $rwReporteoppReportepn['reoppncantkg'];
					$METROSIMPRESO += $rwReporteoppReportepn['reoppncantmt'];
				}
			}

			if($CANTIMPRESO > 0 && $METROSIMPRESO > 0)
				$MATIMPRESO = strtoupper('Kgs: '.number_format($CANTIMPRESO,2 , ',', '.').' Mts: '.number_format($METROSIMPRESO, 2, ',', '.'));
			else
				$MATIMPRESO = strtoupper('no impreso');
			//rutina para traer las op's que contienen la opp madre
			$rsOpproduccion = dinamicscanopop(array('ordoppcodigo' => $rwLaminado['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
			$nrOpproduccion = fncnumreg($rsOpproduccion);
			//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
			$ANCHOLAMINADO = '';
			$ANCHOLAMINADO2 = '';
			$KILOSLAMINADO = '';
			$METROSLAMINADO = '';
			$APROBADOLAMINADO = '';
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
			$APROBADOLAMINADO = ($rwLaminado['ordoppcomfir'] > 0)? '<font color="#000080"><b>Si</b></font>' : '<font color="#FF0000"><b>No</b></font>' ;
			$SPANLAMINADO = ($rwLaminado['ordoppcomfir'] > 0)? 'ui-icon ui-icon-circle-check' : 'ui-icon ui-icon-circle-close' ;
			for($c = 0;$c < $nrOpproduccion;$c++)
			{				
				$rwOpproduccion = fncfetch($rsOpproduccion, $c);
				$rwOplaminado = loadrecordoplaminado($rwOpproduccion['ordprocodigo'],$idcon);
				//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
				$TIPOADHESIVO = ($rwOplaminado['ordprotiposo'])? strtoupper($rwOplaminado['ordprotiposo']) : '---' ;
				$DESEMPENOADHESIVO = ($rwOplaminado['ordprodesemp'])? strtoupper($rwOplaminado['ordprodesemp']) : '---' ;
				$LAMINADOADHESIVO = ($rwOplaminado['ordprolamina'])? strtoupper($rwOplaminado['ordprolamina']) : '---' ;
				$ANCHOLAMINADO2 = ($rwOplaminado['ordproancalt'])? strtoupper($rwOplaminado['ordproancalt']) : '---' ;				
				//VARIABLES ACUMULABLES A USAR EN OP {ORDENES DE PRODUCCION}
				if($rwOplaminado['pedvenfecent']) $FECHAENTREGA = ($FECHAENTREGA)? $FECHAENTREGA.'<br>&nbsp;'.strtoupper($rwOplaminado['pedvenfecent']) : strtoupper($rwOplaminado['pedvenfecent']) ;
				if($rwOplaminado['pedvennumero']) $PEDIDOPRODUCCION = ($PEDIDOPRODUCCION)? $PEDIDOPRODUCCION.'<br>&nbsp;'.$rwOplaminado['pedvennumero'] : $rwOplaminado['pedvennumero'] ;
				if($rwOplaminado['ordcomrazsoc']) $CLIENTEPRODUCCION = ($CLIENTEPRODUCCION)? $CLIENTEPRODUCCION.'<br>&nbsp;'.$rwOplaminado['ordcomrazsoc'] : $rwOplaminado['ordcomrazsoc'] ;
				if($rwOplaminado['producnombre']) $REFPRODUCCION = ($REFPRODUCCION)? $REFPRODUCCION.'<br>&nbsp;'.$rwOplaminado['producnombre'] : $rwOplaminado['producnombre'] ;
				if($rwOplaminado['produccoduno']) $ITEMPRODUCCION = ($ITEMPRODUCCION)? $ITEMPRODUCCION.'<br>&nbsp;'.$rwOplaminado['produccoduno'] : $rwOplaminado['produccoduno'] ;
				if($rwOplaminado['tipevenombre']) $TIPOPEDIDOVENTA = ($TIPOPEDIDOVENTA)? $TIPOPEDIDOVENTA.'<br>&nbsp;'.$rwOplaminado['tipevenombre'] : $rwOplaminado['tipevenombre'];
			}

			($b % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';

			$rsreporteopp = dinamicscanopreporteopp(array( "ordoppcodigo" => $rwLaminado['ordoppcodigo'], "repopptipo" => 1 ), array("ordoppcodigo" => "=", "repopptipo" => "=") ,$idcon);
			$nrreporteopp = fncnumreg($rsreporteopp);

			$SZreoppncantkg = 0;
			$SZreoppncantmt = 0;

			for( $c = 0; $c < $nrreporteopp; $c++){

				$rwreporteopp = fncfetch($rsreporteopp,$c);
				$rsReporteoppreportepn = dinamicscanopreporteoppreportepn(array("repoppcodigo" => $rwreporteopp['repoppcodigo']), array("repoppcodigo" => "="), $idcon);
				$nrReporteoppreportepn = fncnumreg($rsReporteoppreportepn);

				for( $d = 0; $d < $nrReporteoppreportepn; $d++){

					$rwReporteoppreportepn = fncfetch($rsReporteoppreportepn,$d);
					$SZreoppncantkg = $SZreoppncantkg + $rwReporteoppreportepn["reoppncantkg"];
					$SZreoppncantmt = $SZreoppncantmt + $rwReporteoppreportepn["reoppncantmt"];
				}

			}
?>			
	<tr <?php echo $complement; ?> >
		<td width="5%" align="center"><a href="javascript:animatedcollapse.toggle('filtrOpp_<?php echo $equipo ?>_<?php echo $b ?>');"><img id="row" align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0"></a></td>
		<td width="5%" class="cont-line">&nbsp;<input type="radio" name="radiobutton1" id="radiobutton1" value="<?php echo $rwLaminado['ordoppcodigo']; ?>" onclick="setOrdoppcodigo(this.value);" /></td>
		<td width="5%" class="cont-line">&nbsp;&nbsp;<?php echo ($b + 1) ?></td>
		<td width="5%" class="cont-line">&nbsp;
			<a href="#" title="Kgs Pn [<?php echo number_format($SZreoppncantkg, 2, ",", "."); ?>] - Kgs Pdt [<?php echo number_format($KILOSLAMINADO - $SZreoppncantkg, 2, ",", "."); ?>]" style="text-decoration:none;">
				<font color="blue"><b><?php echo str_pad($rwOplaminado['solprocodigo'], 4, "0", STR_PAD_LEFT) ?></b></font>
			</a>
		</td>
		<td width="7%" class="cont-line">&nbsp;<font color="brown"><b><?php echo $PEDIDOPRODUCCION; ?></b></font></td>
		<td width="25%" class="cont-line">&nbsp;<font color="blue"><small><?php echo $REFPRODUCCION; ?></small></font></td>
		<td width="10%" class="cont-line">&nbsp;<?php echo $ANCHOLAMINADO; ?></td>
		<td width="10%" class="cont-line">&nbsp;<?php echo $ANCHOLAMINADO2; ?></td>
		<td width="10%" class="cont-line">&nbsp;<?php echo $FECHAENTREGA; ?></td>
		<td width="10%" class="cont-line">&nbsp;<font color="green"><b><?php echo number_format($KILOSLAMINADO, 2, ',', '.'); ?></b></font></td>
		<td width="10%" class="cont-line">&nbsp;<font color="green"><b><?php echo number_format($METROSLAMINADO, 2, ',', '.'); ?></b></font></td>
	</tr>
	<tr <?php echo $complement; ?> >
		<td colspan="11">
			<div id="filtrOpp_<?php echo $equipo ?>_<?php echo $b ?>" style="display: none;" >
				<table border="0" cellspacing="1" cellpadding="1" style="border-top:none; border-right:none;" align="left" class="ui-widget-content" width="100%">
					<tr>
						<td width="100" class="ui-state-default"><small>Tipo PV</small></td>
						<td width="100" class="ui-state-default"><small>Item&nbsp;</small></td>
						<td width="340" class="ui-state-default"><small>Cliente&nbsp;</small></td>
						<td width="100" class="ui-state-default"><small>Tiempo&nbsp;Pr.</small></td>
						<td width="100" class="ui-state-default"><small>Adhesivo&nbsp;</small></td>
						<td width="100" class="ui-state-default"><small>Desempe&ntilde;o&nbsp;</small></td>
						<td width="180" class="ui-state-default"><small>Laminado&nbsp;</small></td>
					</tr>
					<tr>
						<td class="NoiseFooterTD" valign="top">&nbsp;<small><?php echo $TIPOPEDIDOVENTA; ?></small></td>
						<td class="NoiseFooterTD" valign="top">&nbsp;<small><?php echo $ITEMPRODUCCION; ?></small></td>
						<td class="NoiseFooterTD" valign="top">&nbsp;<small><?php echo $CLIENTEPRODUCCION; ?></small></td>
						<td class="NoiseFooterTD" valign="top">&nbsp;<font color="green"><b><small>&nbsp;<?php echo date("Y-m-d H:i", strtotime(" {$varDate} + {$$total_equipotmp} minutes")) ?></small></b></font></td>
						<td class="NoiseFooterTD" valign="top">&nbsp;<small><?php echo $TIPOADHESIVO; ?></small></td>
						<td class="NoiseFooterTD" valign="top">&nbsp;<small><?php echo $DESEMPENOADHESIVO; ?></small></td>
						<td class="NoiseFooterTD" valign="top">&nbsp;<small><?php echo $LAMINADOADHESIVO; ?></small></td>
					</tr>
					<tr>
						<td width="100" class="ui-state-default"><small>Material</small></td>
						<td colspan="2" class="NoiseFooterTD" valign="top">&nbsp;<small><?php echo $MATLAMINADO; ?></small></td>
						<td colspan="1" class="ui-state-default"><small>Estado</small></td>
						<td colspan="3" class="NoiseFooterTD" valign="top"><small>&nbsp;<?php echo $MATIMPRESO; ?></small></td>
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
				<td class="cont-line">&nbsp;</td>
				<td class="cont-line">&nbsp;</td>
				<td class="cont-line">&nbsp;</td>
				<td class="cont-line">&nbsp;</td>
				<td class="cont-line">&nbsp;</td>
				<td class="cont-line">&nbsp;</td>
				<td class="cont-line">&nbsp;</td>
				<td class="cont-line">&nbsp;</td>
				<td class="cont-line">&nbsp;</td>
				<td class="cont-line">&nbsp;</td>
				<td class="cont-line">&nbsp;</td>
			</tr>
<?php
			endfor;
		endif;	
?>
</table>
<input type="hidden" name="<?php echo $total_equipound ?>" id="<?php echo $total_equipound ?>" value="<?php echo $$total_equipound ?>" />
<input type="hidden" name="<?php echo $total_equipokgs ?>" id="<?php echo $total_equipokgs ?>" value="<?php echo $$total_equipokgs ?>" />
<input type="hidden" name="<?php echo $total_equipomts ?>" id="<?php echo $total_equipomts ?>" value="<?php echo $$total_equipomts ?>" />