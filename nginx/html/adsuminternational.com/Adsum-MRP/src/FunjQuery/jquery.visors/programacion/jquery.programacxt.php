<?php
	$idcon = fncconn();
	$rsCorteExtrusion = dinamicscanopprogramacorteextrusion1(array('equipocodigo' => $equipo),array('equipocodigo' => '='),$idcon,$rtr = 1);
	$nrCorteExtrusion = fncnumreg($rsCorteExtrusion);
	//varibles para cantidad por equipos
	$total_equipound = $equipo.'_und';
	$total_equipomts = $equipo.'_mts';
	$total_equipokgs = $equipo.'_kgs';
	$total_equipotmp = $equipo.'_tmp';
	
	$rwhora = getdate(time());
	$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
	echo "<script type='text/javascript'>Event_animatedcollapse('".$nrCorteExtrusion."', 'filtrOpp_".$equipo."');</script>";
?>
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">
	<tr>
		<td class="ui-state-default" width="5%"  align="center"><span class="ui-icon ui-icon-arrowthickstop-1-s"></span></td>
		<td class="ui-state-default" width="5%"  align="center">O.E</td> 
		<td class="ui-state-default" width="5%"  align="center"># OPP</td>
		<td class="ui-state-default" width="10%"  align="center">Item&nbsp;<small><b>Pr.</b></small></td> 
		<td class="ui-state-default" width="5%"  align="center">Mezcla</td>
		<td class="ui-state-default" width="10%"  align="center">Anc.&nbsp;Ext.<b>(mm)</b></td>
		<td class="ui-state-default" width="10%"  align="center">Anc.&nbsp;Crt.<b>(mm)</b></td>
		<td class="ui-state-default" width="10%"  align="center">Calibre&nbsp;<b>(&micro;m)</b></td>
		<td class="ui-state-default" width="5%"  align="center">Pistas&nbsp;</td>
		<td class="ui-state-default" width="10%"  align="center">Kilogramos&nbsp;</td>
		<td class="ui-state-default" width="10%"  align="center">Kilogramos&nbsp;<small>(pdt)</small></td>
		<td class="ui-state-default" width="10%"  align="center">Tiempo Pr.</td> 
		<td class="ui-state-default" width="5%"  align="center"><span class="ui-icon ui-icon-person"></span></td>
	</tr>
<?php 
		for($b = 0; $b < $nrCorteExtrusion; $b++)
		{
			$rwCorteExtrusion = fncfetch($rsCorteExtrusion, $b);
			//sumatoria de unidades , metros, kilogramos
			$$total_equipound = $$total_equipound + 1; 
			$$total_equipokgs = $$total_equipokgs + $rwCorteExtrusion['ordoppcantkg'];
			$$total_equipomts = $$total_equipomts + $rwCorteExtrusion['ordoppcantmt'];
			//escaneo de velocidades para sumatoria de minutos de duracion de la orden
			$rsOppVelocidadpn = dinamicscanopoppvelocidadpn(array('ordoppcodigo' => $rwCorteExtrusion['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
			$nrOppVelocidadpn = fncnumreg($rsOppVelocidadpn);
			for($i = 0; $i < $nrOppVelocidadpn; $i++)
			{
				$rwOppVelocidadpn = fncfetch($rsOppVelocidadpn, $i);
				$rwVelocidadpn = loadrecordvelocidadpn($rwOppVelocidadpn['velocicodigo'],$idcon);
				$$total_equipotmp = $$total_equipotmp + $rwVelocidadpn['velocivalora'];
			}
			//escaneo de ajuste para sumatoria de minutos de duracion de la orden
			$rsOppAjustepn = dinamicscanopoppajustepn(array('ordoppcodigo' => $rwCorteExtrusion['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
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
			$rsOpproduccion = dinamicscanopop(array('ordoppcodigo' => $rwCorteExtrusion['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
			$nrOpproduccion = fncnumreg($rsOpproduccion);
			//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
			$ANCHOCORTEEXTRUSION = '';
			$CALIBRECORTEEXTRUSION = '';
			$KILOSCORTEEXTRUSION = '';
			$METROSCORTEEXTRUSION = '';
			$APROBADOCORTEEXTRUSION = '';
			//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
			$FORMULACORTEEXTRUSION = '';
			$CORTEEXTRUSION = '';
			$PISTASEXTRUSION = '';
			$ITEMPRODUCCION = '';
			$CLIENTEPRODUCCION = '';
			$REFPRODUCCION = '';
			$PEDIDOPRODUCCION = '';
			$DESTINOPRODUCCION = '';
			//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
			$ANCHOCORTEEXTRUSION = ($rwCorteExtrusion['ordoppanchot'])? $rwCorteExtrusion['ordoppanchot'] : '---' ;
			$KILOSCORTEEXTRUSION = ($rwCorteExtrusion['ordoppcantkg'])? $rwCorteExtrusion['ordoppcantkg'] : '---' ;
			$METROSCORTEEXTRUSION = ($rwCorteExtrusion['ordoppcantmt'])? $rwCorteExtrusion['ordoppcantmt'] : '---' ;
			$APROBADOCORTEEXTRUSION = ($rwCorteExtrusion['ordoppcomfir'] > 0)? '<font color="#000080"><b>Si</b></font>' : '<font color="#FF0000"><b>No</b></font>' ;
			$SPANEXTRUSION = ($rwCorteExtrusion['ordoppcomfir'] > 0)? 'ui-icon ui-icon-circle-check' : 'ui-icon ui-icon-circle-close' ;
			//se recorren las ordenes de produccion {op} asociadas en la opp
			for($c = 0;$c < $nrOpproduccion;$c++)
			{
				$rwOpproduccion = fncfetch($rsOpproduccion, $c);
				$rwOpcorteextrusion = loadrecordopcorteextrusion($rwOpproduccion['ordprocodigo'],$idcon);
				//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
				$FORMULACORTEEXTRUSION = ($rwOpcorteextrusion['formulnumero'])? $rwOpcorteextrusion['formulnumero'] : '---' ;
				$CALIBRECORTEEXTRUSION = ($rwOpcorteextrusion['ordprocalibr'])? $rwOpcorteextrusion['ordprocalibr'] : '---' ;
				//VARIABLES ACUMULABLES A USAR EN OP {ORDENES DE PRODUCCION}
				if($rwOpcorteextrusion['itedescodigo']) $ITEMPRODUCCION = ($ITEMPRODUCCION)? $ITEMPRODUCCION.' | '.$rwOpcorteextrusion['itedescodigo'] : $rwOpcorteextrusion['itedescodigo'] ;
				if($rwOpcorteextrusion['pedvennumero']) $PEDIDOPRODUCCION = ($PEDIDOPRODUCCION)? $PEDIDOPRODUCCION.'<br>&nbsp;'.$rwOpcorteextrusion['pedvennumero'] : $rwOpcorteextrusion['pedvennumero'] ;
				if($rwOpcorteextrusion['ordcomrazsoc']) $CLIENTEPRODUCCION = ($CLIENTEPRODUCCION)? $CLIENTEPRODUCCION.'<br>&nbsp;'.$rwOpcorteextrusion['ordcomrazsoc'] : $rwOpcorteextrusion['ordcomrazsoc'] ;
				if($rwOpcorteextrusion['producnombre']) $REFPRODUCCION = ($REFPRODUCCION)? $REFPRODUCCION.'<br>&nbsp;'.$rwOpcorteextrusion['producnombre'] : $rwOpcorteextrusion['producnombre'] ;
				if($rwOpcorteextrusion['procednombre']) $DESTINOPRODUCCION = ($DESTINOPRODUCCION)? $DESTINOPRODUCCION.'<br>&nbsp;'.strtoupper($rwOpcorteextrusion['procednombre']) : strtoupper($rwOpcorteextrusion['procednombre']) ;
				if($rwOpcorteextrusion['ordproanccxt'] && $rwOpcorteextrusion['ordpropistae']) 
				{
					$CORTEEXTRUSION = ($CORTEEXTRUSION)? $CORTEEXTRUSION.' | '.($rwOpcorteextrusion['ordpropistae'] * $rwOpcorteextrusion['ordproanccxt']) : ($rwOpcorteextrusion['ordpropistae'] * $rwOpcorteextrusion['ordproanccxt']);
					$PISTASEXTRUSION = ($PISTASEXTRUSION)? $PISTASEXTRUSION.' | '.$rwOpcorteextrusion['ordpropistae'].' * '.$rwOpcorteextrusion['ordproanccxt'] : $rwOpcorteextrusion['ordpropistae'].' * '.$rwOpcorteextrusion['ordproanccxt'] ;
				}
			}

			($b % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)" ' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)" ';

			$rsreporteopp = dinamicscanopreporteopp(array( "ordoppcodigo" => $rwCorteExtrusion['ordoppcodigo'], "repopptipo" => 1 ), array("ordoppcodigo" => "=", "repopptipo" => "=") ,$idcon);
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
		<td width="5%" align="center"><a href="javascript:animatedcollapse.toggle('filtrOpp_<?php echo $equipo ?>_<?php echo $b ?>');"><img id="row" align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0"></a></td>
		<td width="5%" class="cont-line">&nbsp;<?php echo ($b + 1) ?>&nbsp;<a onclick="openUpdateOpp('<?php echo $rwCorteExtrusion['ordoppcodigo'] ?>', '<?php echo $equipo ?>')"><span class="ui-icon ui-icon-document" style="float: left; margin-right: .3em;"></span></a></td>
		<td width="5%" class="cont-line">&nbsp;
			<a href="#" title="Kgs Pn [<?php echo number_format($SZreoppncantkg, 2, ",", "."); ?>] - Kgs Pdt [<?php echo number_format($KILOSCORTEEXTRUSION - $SZreoppncantkg, 2, ",", "."); ?>]" style="text-decoration:none;">
				<font color="blue"><b><?php echo str_pad($rwCorteExtrusion['ordoppcodigo'], 4, "0", STR_PAD_LEFT); ?></b></font>
			</a>
		</td>
		<td width="10%" class="cont-line">&nbsp;<font color="brown"><b><?php echo $ITEMPRODUCCION; ?></b></font></td>
		<td width="5%" class="cont-line">&nbsp;<font color="brown"><b><?php echo $FORMULACORTEEXTRUSION; ?></b></font></td>
		<td width="10%" class="cont-line" align="center">&nbsp;<?php echo $ANCHOCORTEEXTRUSION; ?></td>
		<td width="10%" class="cont-line" align="center">&nbsp;<?php echo $CORTEEXTRUSION; ?></td>
		<td width="10%" class="cont-line">&nbsp;<?php echo $CALIBRECORTEEXTRUSION; ?></td>
		<td width="5%" class="cont-line">&nbsp;<?php echo $PISTASEXTRUSION;?></td>
		<td width="10%"class="cont-line">&nbsp;<font color="green"><b><?php echo number_format($KILOSCORTEEXTRUSION, 2, ',', '.'); ?></b></font></td>
		<td width="10%"class="cont-line">&nbsp;<font color="red"><b><?php echo number_format($KILOSCORTEEXTRUSION, 2, ',', '.'); ?></b></font></td>
		<td width="10%"class="cont-line">&nbsp;<font color="green"><b><small>&nbsp;<?php echo date("Y-m-d H:i", strtotime(" {$varDate} + {$$total_equipotmp} minutes")); ?></small></b></font></td>
		<td width="5%" class="cont-line">&nbsp;<span class="<?php echo $SPANEXTRUSION; ?>" style="float: left;"></span></td>
	</tr>
	<tr <?php echo $complement ?>">
		<td colspan="13">
			<div id="filtrOpp_<?php echo $equipo ?>_<?php echo $b ?>" style="display: none;" >
				<table border="0" cellspacing="1" cellpadding="1" style="border-top:none; border-right:none;" align="left" class="ui-widget-content" width="100%">
					<tr>
						<td width="80" class="ui-state-default"><small>PV</small></td>
						<td width="350" class="ui-state-default"><small>Referencia&nbsp;</small></td>	
						<td width="350" class="ui-state-default"><small>Cliente&nbsp;</small></td>
						<td width="180" class="ui-state-default"><small>Destino</small></td>
						<td width="80" class="ui-state-default"><small>Metros</small></td>
					</tr>
					<tr class="<?php echo  $class ?>">
						<td class="NoiseFooterTD" valign="top">&nbsp;<small><?php echo $PEDIDOPRODUCCION; ?></small></td>
						<td class="NoiseFooterTD" valign="top">&nbsp;<small><?php echo $REFPRODUCCION; ?></small></td>
						<td class="NoiseFooterTD" valign="top">&nbsp;<small><?php echo $CLIENTEPRODUCCION; ?></small></td>
						<td class="NoiseFooterTD" valign="top">&nbsp;<small><?php echo $DESTINOPRODUCCION; ?></small></td>
						<td class="NoiseFooterTD" valign="top">&nbsp;<small><?php echo number_format($METROSCORTEEXTRUSION, 2, ',', '.'); ?></small></td>
					</tr>
				</table>
			</div>
		</td>		
	</tr>
<?php
		}
	
	if($b < 13)
	{
		for($c = $b; $c < 35; $c++)
		{
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
			</tr>
<?php
		}
	}
?>
</table>
<input type="hidden" name="<?php echo $total_equipound ?>" id="<?php echo $total_equipound ?>" value="<?php echo $$total_equipound ?>" />
<input type="hidden" name="<?php echo $total_equipokgs ?>" id="<?php echo $total_equipokgs ?>" value="<?php echo $$total_equipokgs ?>" />
<input type="hidden" name="<?php echo $total_equipomts ?>" id="<?php echo $total_equipomts ?>" value="<?php echo $$total_equipomts ?>" />