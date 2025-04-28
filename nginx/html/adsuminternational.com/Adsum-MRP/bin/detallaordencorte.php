<?php
ini_set('display_errors',1);
	if(!$noAjax)
	{
		include ( '../src/FunPerPriNiv/pktblreporteoppreportepn.php');
		include ( '../src/FunPerPriNiv/pktblprogramacorte.php');
		include ( '../src/FunPerPriNiv/pktblopcorte.php');
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
	//validacion de filtros para la bandeja de extrusion
	if($plantacodigo || $ordproancmat)
	{
		$record['plantacodigo'] = $plantacodigo;
		$recordop['plantacodigo'] = '=';
		$record['ordproancmat'] = $ordproancmat;
		$recordop['ordproancmat'] = '=';
		$rsCorte = dinamicscanopprogramacorte1($record, $recordop, $idcon);
	}
	else
	{
		$rsCorte = fullscanprogramacorte1($idcon);
	}
	//se valida y consulta el numero de registros de la consulta
	if($rsCorte)
		$nrCorte = fncnumreg($rsCorte);
	//varibles para cantidad por equipos
	$totalopp_und = 0;
	$totalopp_mts = 0;
	$totalopp_kgs = 0;
?>
<script type="text/javascript">
	Event_animatedcollapse('<?php echo $nrCorte ?>', 'filtrOpp');
</script>
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">
	<tr>
		<td class="ui-state-default" width="5%"  align="center"><span class="ui-icon ui-icon-arrowthickstop-1-s"></span></td>
		<td class="ui-state-default" width="5%"  align="center">Sel.</td> 
		<td class="ui-state-default" width="5%"  align="center"># OPP</td>
		<td class="ui-state-default" width="7%"  align="center"># PV</td>
		<td class="ui-state-default" width="20%"  align="center">Referencia</td>
		<td class="ui-state-default" width="10%"  align="center">Ancho&nbsp;<b>mm</b></td>
		<td class="ui-state-default" width="10%"  align="center">A. Corte&nbsp;<b>mm</b></td>
		<td class="ui-state-default" width="10%"  align="center">F. Entrega</td>
		<td class="ui-state-default" width="10%"  align="center">Kilogramos&nbsp;</td>
		<td class="ui-state-default" width="10%"  align="center">Metros&nbsp;</td>
		<td class="ui-state-default" width="5%"  align="center"><span class="ui-icon ui-icon-person"></span></td>
	</tr>
<?php 
		for($b = 0; $b < $nrCorte; $b++):
			$rwCorte = fncfetch($rsCorte, $b);
			//sumatoria de unidades , metros, kilogramos
			$totalopp_und = $totalopp_und + 1; 
			$totalopp_kgs = $totalopp_kgs + $rwCorte['ordoppcantkg'];
			$totalopp_mts = $totalopp_mts + $rwCorte['ordoppcantmt'];
			//rutina para proceso de impresion
			$MATLAMINADO = '';
			$CANTLAMINADO = 0;
			$METROSLAMINADO = 0;
			$rwOp = loadrecordop1($rwCorte['ordoppcodigo'],$idcon);
			$rsProgramaLaminado = dinamicscanopop1(array( 'solprocodigo' => $rwOp['solprocodigo'], 'tipsolcodigo' => 2 ), array( 'solprocodigo' => '=', 'tipsolcodigo' => '=' ), $idcon);
			$nrProgramaLaminado = fncnumreg($rsProgramaLaminado);

			if($nrProgramaLaminado < 0 || !$nrProgramaLaminado)
				$MATLAMINADO = strtoupper('sin laminado');

			for($c = 0; $c < $nrProgramaLaminado; $c++)
			{
				$rwProgramaLaminado = fncfetch($rsProgramaLaminado, $c);
				
				if($rwProgramaLaminado["ordoppcodigo"] > 0){

					$rsReporteoppReportepn = dinamicscanopreporteoppreportepn1( array( 'ordoppcodigo' => $rwProgramaLaminado['ordoppcodigo'] ), array( 'ordoppcodigo' => '='), $idcon);
					$nrReporteoppReportepn = fncnumreg($rsReporteoppReportepn);
					for($d = 0; $d < $nrReporteoppReportepn; $d++)
					{
						$rwReporteoppReportepn = fncfetch($rsReporteoppReportepn, $d);
						$CANTLAMINADO += $rwReporteoppReportepn['reoppncantkg'];
						$METROSLAMINADO += $rwReporteoppReportepn['reoppncantmt'];
					}
				}

			}

			if($CANTLAMINADO > 0 && $METROSLAMINADO > 0)
				$MATLAMINADO = strtoupper('Kgs: '.number_format($CANTLAMINADO,2 , ',', '.').' Mts: '.number_format($METROSLAMINADO, 2, ',', '.'));
			else
				$MATLAMINADO = strtoupper('no laminado');

			//rutina para traer las op's que contienen la opp madre
			$rsOpproduccion = dinamicscanopop(array('ordoppcodigo' => $rwCorte['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
			$nrOpproduccion = fncnumreg($rsOpproduccion);
			//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
			$ANCHOBOBINA = '';
			$ANCHOCORTE = '';
			$KILOSCORTE = '';
			$METROSCORTE = '';
			$APROBADOCORTE = '';
			$SPANCORTE = '';
			//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
			$TAMANOCORE = '';
			$ANCHOCORTE = '';
			$PISTACORTE = '';
			$FECHAENTREGA = '';
			$PEDIDOPRODUCCION = '';
			$TIPOPVCORTE = '';			
			$ITEMPRODUCCION = '';
			$REFPRODUCCION = '';
			$CLIENTEPRODUCCION = '';
			//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
			$ANCHOBOBINA = ($rwCorte['ordoppanchot'])? $rwCorte['ordoppanchot'] : '---' ;
			$KILOSCORTE = ($rwCorte['ordoppcantkg'])? $rwCorte['ordoppcantkg'] : '---' ;
			$METROSCORTE = ($rwCorte['ordoppcantmt'])? $rwCorte['ordoppcantmt'] : '---' ;
			$SPANCORTE = ($rwCorte['equipocodigo'])? 'ui-icon ui-icon-check' : 'ui-icon ui-icon-help' ;
			//se recorren las ordenes de produccion {op} asociadas en la opp
			for($c = 0;$c < $nrOpproduccion;$c++)
			{
				$rwOpproduccion = fncfetch($rsOpproduccion, $c);
				$rwOpcorte = loadrecordopcorte($rwOpproduccion['ordprocodigo'],$idcon);
				//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
				$TAMANOCORE = ($rwOpcorte['ordprotacore'])? $rwOpcorte['ordprotacore'] : '---' ;
				//VARIABLES ACUMULABLES A USAR EN OP {ORDENES DE PRODUCCION}
				if($rwOpcorte['pedvennumero']) $PEDIDOPRODUCCION = ($PEDIDOPRODUCCION)? $PEDIDOPRODUCCION.'<br>&nbsp;'.$rwOpcorte['pedvennumero'] : $rwOpcorte['pedvennumero'] ;
				if($rwOpcorte['tipevenombre']) $TIPOPVCORTE = ($TIPOPVCORTE)? $TIPOPVCORTE.'<br>&nbsp;'.$rwOpcorte['tipevenombre'] : $rwOpcorte['tipevenombre'] ;
				if($rwOpcorte['ordcomrazsoc']) $CLIENTEPRODUCCION = ($CLIENTEPRODUCCION)? $CLIENTEPRODUCCION.'<br>&nbsp;'.$rwOpcorte['ordcomrazsoc'] : $rwOpcorte['ordcomrazsoc'] ;
				if($rwOpcorte['produccoduno']) $ITEMPRODUCCION = ($ITEMPRODUCCION)? $ITEMPRODUCCION.'<br>&nbsp;'.$rwOpcorte['produccoduno'] : $rwOpcorte['produccoduno'] ;
				if($rwOpcorte['producnombre']) $REFPRODUCCION = ($REFPRODUCCION)? $REFPRODUCCION.'<br>&nbsp;'.$rwOpcorte['producnombre'] : $rwOpcorte['producnombre'] ;
				if($rwOpcorte['pedvenfecent']) $FECHAENTREGA = ($FECHAENTREGA)? $FECHAENTREGA.'<br>&nbsp;'.strtoupper($rwOpcorte['pedvenfecent']) : strtoupper($rwOpcorte['pedvenfecent']) ;
				if($rwOpcorte['ordproancmat'] && $rwOpcorte['ordpropistap']) 
				{
					$ANCHOCORTE = ($ANCHOCORTE)? $ANCHOCORTE.' | '.$rwOpcorte['ordproancmat'] : $rwOpcorte['ordproancmat'];
					$PISTACORTE = ($PISTACORTE)? $PISTACORTE.' | '.$rwOpcorte['ordpropistap'].' * '.$rwOpcorte['ordproancmat'] : $rwOpcorte['ordpropistap'].' * '.$rwOpcorte['ordproancmat'] ;
				}
			}
			($b % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
?>			
	<tr <?php echo $complement ?>">
		<td width="5%" align="center"><a href="javascript:animatedcollapse.toggle('filtrOpp_<?php echo $b ?>');"><img id="row" align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0"></a></td>
		<td width="5%"><input type="radio" id="chkopp" name="chkopp" <?php echo $checked ?> onclick="setArropp(this.value);" value="<?php echo $rwCorte['ordoppcodigo'] ?>"></td>
		<td width="5%" class="cont-line">&nbsp;<font color="blue"><b><?php echo str_pad($rwOpcorte['solprocodigo'], 4, "0", STR_PAD_LEFT); ?></b></font></td>
		<td width="7%" class="cont-line">&nbsp;<font color="brown"><b><?php echo $PEDIDOPRODUCCION; ?></b></font></td>
		<td width="20%" class="cont-line">&nbsp;<font color="blue"><small><?php echo $REFPRODUCCION; ?></small></font></td>
		<td width="10%" class="cont-line">&nbsp;<?php echo $ANCHOBOBINA; ?></td>
		<td width="10%" class="cont-line">&nbsp;<?php echo $ANCHOCORTE; ?></td>
		<td width="10%" class="cont-line">&nbsp;<?php echo $FECHAENTREGA; ?></td>
		<td width="10%" class="cont-line">&nbsp;<font color="green"><b><?php echo number_format($KILOSCORTE, 2, ',', '.'); ?></b></font></td>
		<td width="10%" class="cont-line">&nbsp;<font color="green"><b><?php echo number_format($METROSCORTE, 2, ',', '.'); ?></b></font></td>
		<td width="5%" class="cont-line" align="center">&nbsp;<span class="<?php echo $SPANCORTE; ?>" style="float: left;"></span></td>
	</tr>
	<tr <?php echo $complement ?>">
		<td colspan="12">
			<div id="filtrOpp_<?php echo $b ?>" style="display: none;" >
				<table border="0" cellspacing="1" cellpadding="1" style="border-top:none; border-right:none;" align="left" class="ui-widget-content" width="100%">
					<tr>
						<td width="100" class="ui-state-default"><small>Tipo PV&nbsp;</small></td>
						<td width="100" class="ui-state-default"><small>Item&nbsp;</small></td>
						<td width="340" class="ui-state-default"><small>Cliente&nbsp;</small></td>
						<td width="120" class="ui-state-default"><small>Tama&ntilde;o Core&nbsp;</small></td>
						<td width="170" class="ui-state-default"><small>Pistas&nbsp;</small></td>
						<td width="210" class="ui-state-default"><small>Estado&nbsp;</small></td>
					</tr>
					<tr class="<?php echo  $class ?>">
						<td class="NoiseFooterTD" valign="top">&nbsp;<small><?php echo $TIPOPVCORTE; ?></small></td>
						<td class="NoiseFooterTD" valign="top">&nbsp;<small><?php echo $ITEMPRODUCCION; ?></small></td>
						<td class="NoiseFooterTD" valign="top">&nbsp;<small><?php echo $CLIENTEPRODUCCION; ?></small></td>
						<td class="NoiseFooterTD" valign="top">&nbsp;<small><?php echo $TAMANOCORE; ?></small></td>
						<td class="NoiseFooterTD" valign="top">&nbsp;<small><?php echo $PISTACORTE; ?></small></td>
						<td class="NoiseFooterTD" valign="top">&nbsp;<small><?php echo $MATLAMINADO; ?></small></td>
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
				<td width="5%" class="cont-line">&nbsp;</td>
				<td width="5%" class="cont-line">&nbsp;</td>
				<td width="5%" class="cont-line">&nbsp;</td>
				<td width="7%" class="cont-line">&nbsp;</td>
				<td width="20%" class="cont-line">&nbsp;</td>
				<td width="10%" class="cont-line">&nbsp;</td>				
				<td width="10%" class="cont-line">&nbsp;</td>				
				<td width="10%" class="cont-line">&nbsp;</td>				
				<td width="10%" class="cont-line">&nbsp;</td>				
				<td width="10%" class="cont-line">&nbsp;</td>					
				<td width="10%" class="cont-line">&nbsp;</td>				
				<td width="5%" class="cont-line">&nbsp;</td>				
			</tr>
<?php
			endfor;
		endif;	
?>
</table>
<input type="hidden" name="totalopp_und" id="totalopp_und" value="<?php echo $totalopp_und ?>" />
<input type="hidden" name="totalopp_kgs" id="totalopp_kgs" value="<?php echo $totalopp_kgs ?>" />
<input type="hidden" name="totalopp_mts" id="totalopp_mts" value="<?php echo $totalopp_mts ?>" />