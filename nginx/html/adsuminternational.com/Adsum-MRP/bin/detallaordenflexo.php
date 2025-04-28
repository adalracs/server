<?php
ini_set('display_errors',1);
	if(!$noAjax)
	{
		include ( '../src/FunPerPriNiv/pktblformula.php');
		include ( '../src/FunPerPriNiv/pktblsoliprog.php');
		include ( '../src/FunPerPriNiv/pktblprogramaflexo.php');
		include ( '../src/FunPerPriNiv/pktblopflexo.php');
		include ( '../src/FunPerPriNiv/pktblplanta.php');
		include ( '../src/FunPerPriNiv/pktblproducto.php');
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
	if($plantacodigo || $ordprorodill || $ordprocalibr || $ordproestruc)
	{
		$record['plantacodigo'] = $plantacodigo;
		$recordop['plantacodigo'] = '=';
		$record['ordprorodill'] = $ordprorodill;
		$recordop['ordprorodill'] = '=';
		$record['ordprocalibr'] = $ordprocalibr;
		$recordop['ordprocalibr'] = '=';
		$record['ordproestruc'] = $ordproestruc;
		$recordop['ordproestruc'] = '=';
		$rsFlexografia = dinamicscanopprogramaflexo1($record, $recordop, $idcon);
	}
	else
	{
		$rsFlexografia = fullscanprogramaflexo1($idcon);
	}
	//se valida y consulta el numero de registros de la consulta
	if($rsFlexografia)
		$nrFlexografia = fncnumreg($rsFlexografia);
	//varibles para cantidad por equipos
	$totalopp_und = 0;
	$totalopp_mts = 0;
	$totalopp_kgs = 0;
?>
<script type="text/javascript">
	Event_animatedcollapse('<?php echo $nrFlexografia ?>', 'filtrOpp');
</script>
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">
	<tr>
		<td class="ui-state-default" width="5%"  align="center"><span class="ui-icon ui-icon-arrowthickstop-1-s"></span></td>
		<td class="ui-state-default" width="5%"  align="center">Sel.</td> 
		<td class="ui-state-default" width="5%"  align="center"># OPP</td>
		<td class="ui-state-default" width="10%"  align="center">Item</td>
		<td class="ui-state-default" width="15%"  align="center">Referencia</td>
		<td class="ui-state-default" width="15%"  align="center">Material</td>
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
			$totalopp_und = $totalopp_und + 1; 
			$totalopp_kgs = $totalopp_kgs + $rwFlexografia['ordoppcantkg'];
			$totalopp_mts = $totalopp_mts + $rwFlexografia['ordoppcantmt'];
			//rutina para traer las op's que contienen la opp madre
			$rsOpproduccion = dinamicscanopop(array('ordoppcodigo' => $rwFlexografia['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
			$nrOpproduccion = fncnumreg($rsOpproduccion);
			//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
			$ANCHOIMPRESION = '';
			$KILOSIMPRESION = '';
			$METROSIMPRESION = '';
			$APROBADOIMPRESION = '';
			$SPANIMPRESION = '';
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
			$SPANIMPRESION = ($rwFlexografia['equipocodigo'])? 'ui-icon ui-icon-check' : 'ui-icon ui-icon-help' ;
			//se recorren las ordenes de produccion {op} asociadas en la opp
			for($c = 0;$c < $nrOpproduccion;$c++)
			{
				$rwOpproduccion = fncfetch($rsOpproduccion, $c);
				$rwOpflexografia = loadrecordopflexo($rwOpproduccion['ordprocodigo'],$idcon);
				$rwOpsoliprog = loadrecordsoliprog($rwOpproduccion['solprocodigo'],$idcon);
				$rwProducto = loadrecordproducto($rwOpsoliprog['produccodigo'],$idcon);
				if( $rwProducto["producpadre"] > 0 ){
					$rwOpflexografia1 = loadrecordcantformula1($rwProducto['producpadre'],$idcon);
				}else{
					$rwOpflexografia1 = loadrecordcantformula1($rwProducto['produccodigo'],$idcon);
				}
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
?>			
	<tr <?php echo $complement; ?> >
		<td width="5%"><a href="javascript:animatedcollapse.toggle('filtrOpp_<?php echo $b ?>');"><img id="row" align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0"></a></td>
		<td width="5%"><input type="radio" id="chkopp" name="chkopp" <?php echo $checked ?> onclick="setArropp(this.value);" value="<?php echo $rwFlexografia['ordoppcodigo'] ?>"></td>
		<td width="5%" class="cont-line">&nbsp;<font color="blue"><b><?php echo str_pad($rwOpflexografia['solprocodigo'], 4, "0", STR_PAD_LEFT); ?></b></font></td>
		<td width="10%" class="cont-line">&nbsp;<font color="brown"><b><?php echo $ITEMPRODUCCION; ?></b></font></td>
		<td width="20%" class="cont-line">&nbsp;<font color="blue"><small><?php echo $REFPRODUCCION; ?></small></font></td>
		<td width="15%" class="cont-line">&nbsp;<font color="brown"><small><?php echo $MATERIALIMPRESION; ?></small></font></td>
		<td width="5%" class="cont-line">&nbsp;<?php echo $ANCHOIMPRESION; ?></td>
		<td width="10%" class="cont-line">&nbsp;<font color="green"><b><?php echo number_format($KILOSIMPRESION, 0, ',', '.'); ?></font></td>
		<td width="5%" class="cont-line">&nbsp;<font color="green"><b><?php echo number_format($METROSIMPRESION, 0, ',', '.'); ?></font></td>
		<td width="5%" class="cont-line">&nbsp;<?php echo $TIPOIMPRESION; ?></td>
		<td width="5%" class="cont-line">&nbsp;<?php echo $FECHAENTREGA; ?></td>
		<td width="5%" class="cont-line">&nbsp;<?php echo $RODILLOIMPRESION; ?></td>
		<td width="5%" class="cont-line">&nbsp;<?php echo $COLORESIMPRESION; ?></td>
		<td width="5%" class="cont-line">&nbsp;<span class="<?php echo $SPANIMPRESION; ?>" style="float: left;"></span></td>
	</tr>
	<tr <?php echo $complement; ?> >
		<td colspan="14">
			<div id="filtrOpp_<?php echo $b ?>" style="display: none;" >
				<table border="0" cellspacing="1" cellpadding="1" style="border-top:none; border-right:none;" align="left" class="ui-widget-content" width="100%">
					<tr>
						<td width="120" class="ui-state-default"><small>PV</small></td>
						<td width="120" class="ui-state-default"><small>TIPO PV&nbsp;</small></td>
						<td width="800" class="ui-state-default"><small>Cliente&nbsp;</small></td>
					</tr>
					<tr class="<?php echo  $class ?>">
						<td class="NoiseFooterTD" valign="top"><small>&nbsp;<?php echo $PEDIDOPRODUCCION; ?></small></td>
						<td class="NoiseFooterTD" valign="top"><small>&nbsp;<?php echo $TIPOPEDIDOVENTA; ?></small></td>
						<td class="NoiseFooterTD" valign="top"><small>&nbsp;<?php echo $CLIENTEPRODUCCION; ?></small></td>
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
			</tr>
<?php
			endfor;
		endif;	
?>
</table>
<input type="hidden" name="totalopp_und" id="totalopp_und" value="<?php echo $totalopp_und ?>" />
<input type="hidden" name="totalopp_kgs" id="totalopp_kgs" value="<?php echo $totalopp_kgs ?>" />
<input type="hidden" name="totalopp_mts" id="totalopp_mts" value="<?php echo $totalopp_mts ?>" />