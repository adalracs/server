<?php
ini_set('display_errors',1);
	if(!$noAjax)
	{
		include ( '../src/FunPerPriNiv/pktblprogramacorteextrusion.php');
		include ( '../src/FunPerPriNiv/pktblopcorteextrusion.php');
		include ( '../src/FunPerPriNiv/pktblplanta.php');
		include ( '../src/FunPerPriNiv/pktblop.php');
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
	//validacion de filtros para la bandeja de corte extrusion
	if($plantacodigo || $formulnumero || $ordprocalibr || $ordproanccxt || $paditecodigo)
	{
		$record['plantacodigo'] = $plantacodigo;
		$recordop['plantacodigo'] = '=';
		$record['formulnumero'] = $formulnumero;
		$recordop['formulnumero'] = '=';
		$record['ordprocalibr'] = $ordprocalibr;
		$recordop['ordprocalibr'] = '=';
		$record['ordoppanchot'] = $ordproanccxt;
		$recordop['ordoppanchot'] = '=';
		$record['paditecodigo'] = $paditecodigo;
		$recordop['paditecodigo'] = '=';
		$rsCorteExtrusion = dinamicscanopprogramacorteextrusion1($record, $recordop, $idcon);
	}
	else
	{
		$rsCorteExtrusion = fullscanprogramacorteextrusion1($idcon);
	}
	//se valida y consulta el numero de registros de la consulta
	if($rsCorteExtrusion)
		$nrCorteExtrusion = fncnumreg($rsCorteExtrusion);
	//varibles para cantidad por equipos
	$totalopp_und = 0;
	$totalopp_mts = 0;
	$totalopp_kgs = 0;
?>
<script type="text/javascript">
	Event_animatedcollapse('<?php echo $nrCorteExtrusion ?>', 'filtrOpp');
</script>
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">
	<tr>
		<td class="ui-state-default" width="5%"  align="center"><span class="ui-icon ui-icon-arrowthickstop-1-s"></span></td>
		<td class="ui-state-default" width="5%"  align="center">Sel.</td> 
		<td class="ui-state-default" width="5%"  align="center"># OPP</td>
		<td class="ui-state-default" width="10%"  align="center">Item&nbsp;<small><b>(Pr)</b></small></td> 
		<td class="ui-state-default" width="5%"  align="center">Mezcla</td>
		<td class="ui-state-default" width="10%"  align="center">A.Extr.&nbsp;<small><b>(mm)</b></small></td>
		<td class="ui-state-default" width="10%"  align="center">A.Cort.&nbsp;<small><b>(mm)</b></small></td>
		<td class="ui-state-default" width="10%"  align="center">Calibre&nbsp;<small><b>(&micro;m)</b></small></td>
		<td class="ui-state-default" width="10%"  align="center">Pistas&nbsp;<small><b>(mm)</b></small></td>
		<td class="ui-state-default" width="10%"  align="center">Kilogramos&nbsp;</td>
		<td class="ui-state-default" width="10%"  align="center">Metros&nbsp;</td>  
		<td class="ui-state-default" width="5%"  align="center"><span class="ui-icon ui-icon-person"></span></td>
	</tr>
<?php 
		for($b = 0; $b < $nrCorteExtrusion; $b++)
		{
			$rwCorteExtrusion = fncfetch($rsCorteExtrusion, $b);
			//sumatoria de unidades , metros, kilogramos
			$totalopp_und = $totalopp_und + 1; 
			$totalopp_kgs = $totalopp_kgs + $rwCorteExtrusion['ordoppcantkg'];
			$totalopp_mts = $totalopp_mts + $rwCorteExtrusion['ordoppcantmt'];
			//rutina para traer las op's que contienen la opp madre
			$rsOpproduccion = dinamicscanopop(array('ordoppcodigo' => $rwCorteExtrusion['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
			$nrOpproduccion = fncnumreg($rsOpproduccion);
			//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
			$ANCHOEXTRUSION = '';
			$CALIBREEXTRUSION = '';
			$KILOSEXTRUSION = '';
			$METROSEXTRUSION = '';
			$APROBADOEXTRUSION = '';
			$SPANEXTRUSION = '';
			//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
			$FORMULAEXTRUSION = '';
			$CORTEEXTRUSION = '';
			$PISTASEXTRUSION = '';
			$ITEMPRODUCCION = '';
			$CLIENTEPRODUCCION = '';
			$REFPRODUCCION = '';
			$PEDIDOPRODUCCION = '';
			$DESTINOPRODUCCION = '';
			//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
			$ANCHOEXTRUSION = ($rwCorteExtrusion['ordoppanchot'])? $rwCorteExtrusion['ordoppanchot'] : '---' ;
			$KILOSEXTRUSION = ($rwCorteExtrusion['ordoppcantkg'])? $rwCorteExtrusion['ordoppcantkg'] : '---' ;
			$METROSEXTRUSION = ($rwCorteExtrusion['ordoppcantmt'])? $rwCorteExtrusion['ordoppcantmt'] : '---' ;
			$APROBADOEXTRUSION = ($rwCorteExtrusion['ordoppcomfir'] > 0)? '<font color="#000080"><b>Si</b></font>' : '<font color="#FF0000"><b>No</b></font>' ;
			$SPANEXTRUSION = ($rwCorteExtrusion['equipocodigo'])? 'ui-icon ui-icon-check' : 'ui-icon ui-icon-help' ;
			//se recorren las ordenes de produccion {op} asociadas en la opp
			for($c = 0;$c < $nrOpproduccion;$c++)
			{
				$rwOpproduccion = fncfetch($rsOpproduccion, $c);
				$rwOpextrusion = loadrecordopcorteextrusion($rwOpproduccion['ordprocodigo'],$idcon);
				//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
				$FORMULAEXTRUSION = ($rwOpextrusion['formulnumero'])? $rwOpextrusion['formulnumero'] : '---' ;
				$CALIBREEXTRUSION = ($rwOpextrusion['ordprocalibr'])? $rwOpextrusion['ordprocalibr'] : '---' ;
				//VARIABLES ACUMULABLES A USAR EN OP {ORDENES DE PRODUCCION}
				if($rwOpextrusion['itedescodigo']) $ITEMPRODUCCION = ($ITEMPRODUCCION)? $ITEMPRODUCCION.' | '.$rwOpextrusion['itedescodigo'] : $rwOpextrusion['itedescodigo'] ;
				if($rwOpextrusion['pedvennumero']) $PEDIDOPRODUCCION = ($PEDIDOPRODUCCION)? $PEDIDOPRODUCCION.'<br>&nbsp;'.$rwOpextrusion['pedvennumero'] : $rwOpextrusion['pedvennumero'] ;
				if($rwOpextrusion['ordcomrazsoc']) $CLIENTEPRODUCCION = ($CLIENTEPRODUCCION)? $CLIENTEPRODUCCION.'<br>&nbsp;'.$rwOpextrusion['ordcomrazsoc'] : $rwOpextrusion['ordcomrazsoc'] ;
				if($rwOpextrusion['producnombre']) $REFPRODUCCION = ($REFPRODUCCION)? $REFPRODUCCION.'<br>&nbsp;'.$rwOpextrusion['producnombre'] : $rwOpextrusion['producnombre'] ;
				if($rwOpextrusion['procednombre']) $DESTINOPRODUCCION = ($DESTINOPRODUCCION)? $DESTINOPRODUCCION.'<br>&nbsp;'.strtoupper($rwOpextrusion['procednombre']) : strtoupper($rwOpextrusion['procednombre']) ;
				if($rwOpextrusion['ordproanccxt'] && $rwOpextrusion['ordpropistae']) 
				{
					$CORTEEXTRUSION = ($CORTEEXTRUSION)? $CORTEEXTRUSION.' | '.($rwOpextrusion['ordpropistae'] * $rwOpextrusion['ordproanccxt']) : ($rwOpextrusion['ordpropistae'] * $rwOpextrusion['ordproanccxt']);
					$PISTASEXTRUSION = ($PISTASEXTRUSION)? $PISTASEXTRUSION.' | '.$rwOpextrusion['ordpropistae'].' * '.$rwOpextrusion['ordproanccxt'] : $rwOpextrusion['ordpropistae'].' * '.$rwOpextrusion['ordproanccxt'] ;
				}
			}
			($b % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
?>		
	<tr <?php echo $complement ?>">
		<td width="5%" align="center"><a href="javascript:animatedcollapse.toggle('filtrOpp_<?php echo $b; ?>');"><img id="row" align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0"></a></td>
		<td width="5%" class="cont-line"><input type="radio" id="chkopp" name="chkopp" <?php echo $checked; ?> onclick="setArropp(this.value);" value="<?php echo $rwCorteExtrusion['ordoppcodigo'] ?>"></td>
		<td width="5%" class="cont-line">&nbsp;<font color="blue"><b><?php echo str_pad($rwCorteExtrusion['ordoppcodigo'], 4, "0", STR_PAD_LEFT); ?></b></font></td>
		<td width="10%" class="cont-line" align="center">&nbsp;<font color="brown"><b><?php echo $ITEMPRODUCCION; ?></b></font></td>
		<td width="5%" class="cont-line">&nbsp;<font color="brown"><b><?php echo $FORMULAEXTRUSION; ?></b></font></td>
		<td width="10%" class="cont-line">&nbsp;<?php echo $ANCHOEXTRUSION; ?></td>
		<td width="10%" class="cont-line">&nbsp;<?php echo $CORTEEXTRUSION; ?></td>
		<td width="10%" class="cont-line">&nbsp;<?php echo $CALIBREEXTRUSION; ?></td>
		<td width="10%" class="cont-line">&nbsp;<?php echo $PISTASEXTRUSION;?></td>
		<td width="10%" class="cont-line">&nbsp;<font color="green"><b><?php echo number_format($KILOSEXTRUSION, 2, ',', '.'); ?></b></font></td>
		<td width="10%" class="cont-line">&nbsp;<font color="green"><b><?php echo number_format($METROSEXTRUSION, 2, ',', '.'); ?></b></font></td>
		<td width="5" class="cont-line">&nbsp;<span class="<?php echo $SPANEXTRUSION; ?>" style="float: left;"></span></td>
	</tr>
	<tr <?php echo $complement ?>">
		<td colspan="12">
			<div id="filtrOpp_<?php echo $b ?>" style="display: none;" >
				<table border="0" cellspacing="1" cellpadding="1" style="border-top:none; border-right:none;" align="left" class="ui-widget-content" width="100%">
					<tr>
						<td width="100" class="ui-state-default"><small>PV</small></td>
						<td width="100" class="ui-state-default"><small>Item</small></td>
						<td width="340" class="ui-state-default"><small>Referencia&nbsp;</small></td>	
						<td width="340" class="ui-state-default"><small>Cliente&nbsp;</small></td>
						<td width="160" class="ui-state-default"><small>Destino</small></td>
					</tr>
					<tr class="<?php echo  $class ?>">
						<td class="NoiseFooterTD" valign="top">&nbsp;<small><?php echo $PEDIDOPRODUCCION; ?></small></td>
						<td class="NoiseFooterTD" valign="top">&nbsp;<small><?php echo $ITEMPRODUCCION; ?></small></td>
						<td class="NoiseFooterTD" valign="top">&nbsp;<small><?php echo $REFPRODUCCION; ?></small></td>
						<td class="NoiseFooterTD" valign="top">&nbsp;<small><?php echo $CLIENTEPRODUCCION; ?></small></td>
						<td class="NoiseFooterTD" valign="top">&nbsp;<small><?php echo $DESTINOPRODUCCION; ?></small></td>
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
			</tr>
<?php
		}
	}
?>
</table>
<input type="hidden" name="totalopp_und" id="totalopp_und" value="<?php echo $totalopp_und ?>" />
<input type="hidden" name="totalopp_kgs" id="totalopp_kgs" value="<?php echo $totalopp_kgs ?>" />
<input type="hidden" name="totalopp_mts" id="totalopp_mts" value="<?php echo $totalopp_mts ?>" />