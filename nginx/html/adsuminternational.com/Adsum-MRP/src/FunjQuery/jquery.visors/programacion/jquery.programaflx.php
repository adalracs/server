<?php

	$idcon = fncconn();
	$rsFlexografia = dinamicscanopprogramaflexo1(array('equipocodigo' => $equipo),array('equipocodigo' => '='),$idcon, $rtr = 1);
	$nrFlexografia = fncnumreg($rsFlexografia);
	//objetos para el total por maquina
	$total_equipound = $equipo.'_und';
	$total_equipomts = $equipo.'_mts';
	$total_equipokgs = $equipo.'_kgs';
	$total_equipotmp = $equipo.'_tmp';
	
	$rwhora = getdate(time());
	$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
	echo "<script type='text/javascript'>Event_animatedcollapse('".$nrFlexografia."', 'filtrOpp_".$equipo."');</script>";
?>
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">
	<tr>
		<td class="ui-state-default" width="5%"  align="center"><span class="ui-icon ui-icon-arrowthickstop-1-s"></span></td>
		<td class="ui-state-default" width="5%"  align="center">O.E</td>
		<td class="ui-state-default" width="5%"  align="center">Tiempo Pr.</td> 
		<td class="ui-state-default" width="5%"  align="center"># OPP</td>
		<td class="ui-state-default" width="10%"  align="center">PV</td>
		<td class="ui-state-default" width="15%"  align="center">Referencia</td>
		<td class="ui-state-default" width="10%"  align="center">Material</td>
		<td class="ui-state-default" width="5%"  align="center">Anc.&nbsp;mm</td>
		<td class="ui-state-default" width="10%"  align="center">Kilogramos</td>
		<td class="ui-state-default" width="5%"  align="center">Metros</td>
		<td class="ui-state-default" width="5%"  align="center">Impresion</td>
		<td class="ui-state-default" width="5%"  align="center">F. Entega</td>
		<td class="ui-state-default" width="5%"  align="center">Rodillo</td>
		<td class="ui-state-default" width="5%"  align="center">Clr</td>
		<td class="ui-state-default" width="5%"  align="center"><span class="ui-icon ui-icon-person"></span></td>
	</tr>
<?php 
		for($b = 0; $b < $nrFlexografia; $b++):
			$rwFlexografia = fncfetch($rsFlexografia, $b);
			//sumatoria de unidades , metros, kilogramos
			$$total_equipound = $$total_equipound + 1; 
			$$total_equipokgs = $$total_equipokgs + $rwFlexografia['ordoppcantkg'];
			$$total_equipomts = $$total_equipomts + $rwFlexografia['ordoppcantmt'];
			
			//escaneo de velocidades para sumatoria de minutos de duracion de la orden
			$rsOppVelocidadpn = dinamicscanopoppvelocidadpn(array('ordoppcodigo' => $rwFlexografia['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
			$nrOppVelocidadpn = fncnumreg($rsOppVelocidadpn);
			for($i = 0; $i < $nrOppVelocidadpn; $i++)
			{
				$rwOppVelocidadpn = fncfetch($rsOppVelocidadpn, $i);
				$rwVelocidadpn = loadrecordvelocidadpn($rwOppVelocidadpn['velocicodigo'],$idcon);
				$$total_equipotmp = $$total_equipotmp + $rwVelocidadpn['velocivalora'];
			}
			//escaneo de ajuste para sumatoria de minutos de duracion de la orden
			$rsOppAjustepn = dinamicscanopoppajustepn(array('ordoppcodigo' => $rwFlexografia['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
			$nrOppAjustepn = fncnumreg($rsOppAjustepn);
			for($i = 0; $i < $nrOppAjustepn; $i++)
			{
				$rwOppAjustepn = fncfetch($rsOppAjustepn, $i);
				$rwAjustepn = loadrecordajustepn($rwOppAjustepn['ajustecodigo'],$idcon);
				$$total_equipotmp = $$total_equipotmp + $rwAjustepn['ajustevalora'];
			}
			//converision de mintuos a horas
			$varDate = date("Y-m-d H:i");
			//rutina para traer las op's que contienen la opp madre
			$rsOpproduccion = dinamicscanopop(array('ordoppcodigo' => $rwFlexografia['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
			$nrOpproduccion = fncnumreg($rsOpproduccion);
			//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
			$ANCHOIMPRESION = '';
			$KILOSIMPRESION = '';
			$METROSIMPRESION = '';
			$APROBADOIMPRESION = '';
			//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
			$ITEMPRODUCCION = '';
			$REFPRODUCCION = '';
			$MATERIALIMPRESION = '';
			$TIPOIMPRESION = '';
			$FECHAENTREGA = '';
			$RODILLOIMPRESION = '';
			$COLORESIMPRESION = '';
			$PEDIDOPRODUCCION = '';
			$CLIENTEPRODUCCION = '';
			$DESTINOPRODUCCION = '';
			$TIPOPEDIDOVENTA = '';
			//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
			$ANCHOIMPRESION = ($rwFlexografia['ordoppanchot'])? $rwFlexografia['ordoppanchot'] : '---' ;
			$KILOSIMPRESION = ($rwFlexografia['ordoppcantkg'])? $rwFlexografia['ordoppcantkg'] : '---' ;
			$METROSIMPRESION = ($rwFlexografia['ordoppcantmt'])? $rwFlexografia['ordoppcantmt'] : '---' ;
			$SPANIMPRESION = ($rwFlexografia['ordoppcomfir'] > 0)? 'ui-icon ui-icon-circle-check' : 'ui-icon ui-icon-circle-close' ;
			//se recorren las ordenes de produccion {op} asociadas en la opp
			for($c = 0;$c < $nrOpproduccion;$c++)
			{
				$rwOpproduccion = fncfetch($rsOpproduccion, $c);
				$rwOpflexografia = loadrecordopflexo($rwOpproduccion['ordprocodigo'],$idcon);
				$rwOpsoliprog = loadrecordsoliprog($rwOpproduccion['solprocodigo'],$idcon);
				$rwOpflexografia1 = loadrecordcantformula1($rwOpsoliprog['produccodigo'],$idcon);
				//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
				$MATERIALIMPRESION = ($rwOpflexografia['paditenombre'])? $rwOpflexografia['paditenombre'] : '---' ;
				$TIPOIMPRESION = ($rwOpflexografia['ordprotipimp'])? strtoupper($rwOpflexografia['ordprotipimp']) : '---' ;
				$RODILLOIMPRESION = ($rwOpflexografia['ordprorodill'])? $rwOpflexografia['ordprorodill'] : '---' ;
				$COLORESIMPRESION = ($rwOpflexografia1['colorcantun'])? $rwOpflexografia1['colorcantun'] : '---' ;
				//VARIABLES ACUMULABLES A USAR EN OP {ORDENES DE PRODUCCION}				
				if($rwOpflexografia['produccoduno']) $ITEMPRODUCCION = ($ITEMPRODUCCION)? $ITEMPRODUCCION.'<br>&nbsp;'.$rwOpflexografia['produccoduno'] : $rwOpflexografia['produccoduno'] ;
				if($rwOpflexografia['producnombre']) $REFPRODUCCION = ($REFPRODUCCION)? $REFPRODUCCION.'<br>&nbsp;'.$rwOpflexografia['producnombre'] : $rwOpflexografia['producnombre'] ;
				if($rwOpflexografia['pedvenfecent']) $FECHAENTREGA = ($FECHAENTREGA)? $FECHAENTREGA.'<br>&nbsp;'.strtoupper($rwOpflexografia['pedvenfecent']) : strtoupper($rwOpflexografia['pedvenfecent']) ;
				if($rwOpflexografia['pedvennumero']) $PEDIDOPRODUCCION = ($PEDIDOPRODUCCION)? $PEDIDOPRODUCCION.'<br>&nbsp;'.$rwOpflexografia['pedvennumero'] : $rwOpflexografia['pedvennumero'] ;
				if($rwOpflexografia['ordcomrazsoc']) $CLIENTEPRODUCCION = ($CLIENTEPRODUCCION)? $CLIENTEPRODUCCION.'<br>&nbsp;'.$rwOpflexografia['ordcomrazsoc'] : $rwOpflexografia['ordcomrazsoc'] ;
				if($rwOpflexografia['procednombre']) $DESTINOPRODUCCION = ($DESTINOPRODUCCION)? $DESTINOPRODUCCION.'<br>&nbsp;'.strtoupper($rwOpflexografia['procednombre']) : strtoupper($rwOpflexografia['procednombre']);
				if($rwOpflexografia['tipevenombre']) $TIPOPEDIDOVENTA = ($TIPOPEDIDOVENTA)? $TIPOPEDIDOVENTA.'<br>&nbsp;'.$rwOpflexografia['tipevenombre'] : $rwOpflexografia['tipevenombre'];
			}

			($b % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';

			$rsreporteopp = dinamicscanopreporteopp(array( "ordoppcodigo" => $rwFlexografia['ordoppcodigo'], "repopptipo" => 1 ), array("ordoppcodigo" => "=", "repopptipo" => "=") ,$idcon);
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
	<tr <?php echo $complement ?> >
		<td width="5%" align="center"><a href="javascript:animatedcollapse.toggle('filtrOpp_<?php echo $equipo; ?>_<?php echo $b; ?>');"><img id="row" align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0"></a></td>
		<td width="5%" class="cont-line">&nbsp;&nbsp;<?php echo ($b + 1); ?>&nbsp;<a onclick="openUpdateOpp('<?php echo $rwFlexografia['ordoppcodigo']; ?>', '<?php echo $equipo; ?>')"><span class="ui-icon ui-icon-document" style="float: left; margin-right: .3em;"></span></a></td>
		<td width="5%" class="cont-line">&nbsp;<font color="green"><b><?php echo date("Y-m-d H:i", strtotime(" {$varDate} + {$$total_equipotmp} minutes")); ?></b></font></td>
		<td width="5%" class="cont-line">&nbsp;
			<a href="#" title="Kgs Pn [<?php echo number_format($SZreoppncantkg, 2, ",", "."); ?>] - Kgs Pdt [<?php echo number_format($KILOSIMPRESION - $SZreoppncantkg, 2, ",", "."); ?>]" style="text-decoration:none;">
				<font color="blue"><b><?php echo str_pad($rwOpflexografia['solprocodigo'], 4, "0", STR_PAD_LEFT); ?></b></font>
			</a>
		</td>
		<td width="10%" class="cont-line">&nbsp;<font color="brown"><b><?php echo $PEDIDOPRODUCCION; ?></b></font></td>
		<td width="15%" class="cont-line">&nbsp;<font color="blue"><small><?php echo $REFPRODUCCION; ?></small></font></td>
		<td width="5%" class="cont-line">&nbsp;<font color="brown"><small><?php echo $MATERIALIMPRESION; ?></small></font></td>
		<td width="10%" class="cont-line">&nbsp;<?php echo $ANCHOIMPRESION; ?></td>
		<td width="5%" class="cont-line">&nbsp;<font color="green"><b><?php echo number_format($KILOSIMPRESION, 0, ',', '.'); ?></b></font></td>
		<td width="5%" class="cont-line">&nbsp;<font color="green"><b><?php echo number_format($METROSIMPRESION, 0, ',', '.'); ?></b></font></td>
		<td width="5%" class="cont-line">&nbsp;<?php echo $TIPOIMPRESION; ?></td>
		<td width="5%" class="cont-line">&nbsp;<?php echo $FECHAENTREGA; ?></td>
		<td width="5%" class="cont-line">&nbsp;<?php echo $RODILLOIMPRESION; ?></td>
		<td width="5%" class="cont-line">&nbsp;<?php echo $COLORESIMPRESION; ?></td>
		<td width="5%" class="cont-line">&nbsp;<span class="<?php echo $SPANIMPRESION; ?>" style="float: left;"></span></td>
	</tr>
	<tr <?php echo $complement ?> >
		<td colspan="15">
			<div id="filtrOpp_<?php echo $equipo ?>_<?php echo $b ?>" style="display: none;" >
				<table border="0" cellspacing="1" cellpadding="1" style="border-top:none; border-right:none;" align="left" class="ui-widget-content" width="100%">
					<tr>
						<td width="120" class="ui-state-default"><small>Item</small></td>
						<td width="560" class="ui-state-default"><small>Cliente&nbsp;</small></td>
						<td width="120" class="ui-state-default"><small>Trabajo</small></td>
						<td width="240" class="ui-state-default"><small>Destino</small></td>
					</tr>
					<tr class="<?php echo  $class ?>">
						<td class="NoiseFooterTD" valign="top">&nbsp;<small><?php echo $ITEMPRODUCCION; ?></small></td>
						<td class="NoiseFooterTD" valign="top">&nbsp;<small><?php echo $CLIENTEPRODUCCION; ?></small></td>
						<td class="NoiseFooterTD" valign="top">&nbsp;<small><?php echo $TIPOPEDIDOVENTA; ?></small></td>
						<td class="NoiseFooterTD" valign="top">&nbsp;<small><?php echo $DESTINOPRODUCCION; ?></small></td>
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