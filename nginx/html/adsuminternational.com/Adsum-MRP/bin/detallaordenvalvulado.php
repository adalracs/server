<?php
ini_set('display_errors',1);
	if(!$noAjax)
	{
		include ( '../src/FunPerPriNiv/pktblprogramavalvulado.php');
		include ( '../src/FunPerPriNiv/pktblopvalvulado.php');
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
		$rsValvulado = dinamicscanopprogramavalvulado1($record, $recordop, $idcon);
	}
	else
	{
		$rsValvulado = fullscanprogramavalvulado1($idcon);
	}
	//se valida y consulta el numero de registros de la consulta
	if($rsValvulado)
		$nrValvulado = fncnumreg($rsValvulado);
	//varibles para cantidad por equipos
	$totalopp_und = 0;
	$totalopp_mts = 0;
	$totalopp_kgs = 0;
?>
<script type="text/javascript">
	Event_animatedcollapse('<?php echo $nrValvulado ?>', 'filtrOpp');
</script>
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">
	<tr>
		<td class="ui-state-default" width="2%"  align="center">---</td>
		<td class="ui-state-default" width="3%"  align="center">Sel.</td> 
		<td class="ui-state-default" width="5%"  align="center"># OPP</td>
		<td class="ui-state-default" width="26%"  align="center">Referencia</td>
		<td class="ui-state-default" width="10%"  align="center">Largo&nbsp;<b>mm</b></td>
		<td class="ui-state-default" width="10%"  align="center">Ancho&nbsp;<b>mm</b></td>
		<td class="ui-state-default" width="5%"  align="center">Fuelle</td>
		<td class="ui-state-default" width="10%"  align="center">Kg Millar</td>
		<td class="ui-state-default" width="10%"  align="center">Cantidad</td>
		<td class="ui-state-default" width="10%"  align="center">F. entrega</td>
		<td class="ui-state-default" width="10%"  align="center">Kilogramos</td>
		<td class="ui-state-default" width="2%"  align="center">---</td>
	</tr>
<?php 
		for($b = 0; $b < $nrValvulado; $b++):
			$rwValvulado = fncfetch($rsValvulado, $b);
			//sumatoria de unidades , metros, kilogramos
			$totalopp_und = $totalopp_und + 1; 
			$totalopp_kgs = $totalopp_kgs + $rwValvulado['ordoppcantkg'];
			$totalopp_mts = $totalopp_mts + $rwValvulado['ordoppcantmt'];
			//rutina para traer las op's que contienen la opp madre
			$rsOpproduccion = dinamicscanopop(array('ordoppcodigo' => $rwValvulado['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
			$nrOpproduccion = fncnumreg($rsOpproduccion);
			//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
			$REFPRODUCCION = '';
			$LARGOMATERIAL = '';
			$FUELLEMATERIAL = '';
			$ANCHOMATERIAL = '';
			$PESOMILLAR = '';	
			$CANTIDADPED = '';
			$FECHAENTREGA = '';
			$KILOSVALVULADO = '';
			$METROSVALVULADO = '';
			$SPANVALVULADO = '';
			//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
			$PEDIDOPRODUCCION = '';
			$TIPOPEDIDO = '';
			$ITEMPRODUCCION = '';
			$CLIENTEPRODUCCION = '';
			$DESTINOPEDIDO = '';		
			//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
			$KILOSVALVULADO = ($rwValvulado['ordoppcantkg'])? $rwValvulado['ordoppcantkg'] : '---' ;
			$METROSVALVULADO = ($rwValvulado['ordoppcantmt'])? $rwValvulado['ordoppcantmt'] : '---' ;
			$SPANVALVULADO = ($rwValvulado['equipocodigo'])? 'ui-icon ui-icon-check' : 'ui-icon ui-icon-help' ;
			//se recorren las ordenes de produccion {op} asociadas en la opp
			for($c = 0;$c < $nrOpproduccion;$c++)
			{
				$rwOpproduccion = fncfetch($rsOpproduccion, $c);
				$rwOpvalvulado = loadrecordopvalvulado($rwOpproduccion['ordprocodigo'],$idcon);
				//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
				if($rwOpvalvulado['producnombre']) $REFPRODUCCION = ($REFPRODUCCION)? $REFPRODUCCION.'<br>&nbsp;'.$rwOpvalvulado['producnombre'] : $rwOpvalvulado['producnombre'] ;
				if($rwOpvalvulado['ordprolargom']) $LARGOMATERIAL = ($LARGOMATERIAL)? $LARGOMATERIAL.'<br>&nbsp;'.$rwOpvalvulado['ordprolargom'] : $rwOpvalvulado['ordprolargom'] ;
				if($rwOpvalvulado['ordprofuelle']) $FUELLEMATERIAL = ($FUELLEMATERIAL)? $FUELLEMATERIAL.'<br>&nbsp;'.$rwOpvalvulado['ordprofuelle'] : $rwOpvalvulado['ordprofuelle'] ;
				if($rwOpvalvulado['ordproancmat']) $ANCHOMATERIAL = ($ANCHOMATERIAL)? $ANCHOMATERIAL.'<br>&nbsp;'.$rwOpvalvulado['ordproancmat'] : $rwOpvalvulado['ordproancmat'] ;
				if($rwOpvalvulado['ordpropmilla']) $PESOMILLAR = ($PESOMILLAR)? $PESOMILLAR.'<br>&nbsp;'.$rwOpvalvulado['ordpropmilla'] : $rwOpvalvulado['ordpropmilla'] ;
				if($rwOpvalvulado['propedcansol']) $CANTIDADPED = ($CANTIDADPED)? $CANTIDADPED.'<br>&nbsp;'.$rwOpvalvulado['propedcansol'] : $rwOpvalvulado['propedcansol'] ;
				if($rwOpvalvulado['pedvenfecent']) $FECHAENTREGA = ($FECHAENTREGA)? $FECHAENTREGA.'<br>&nbsp;'.strtoupper($rwOpvalvulado['pedvenfecent']) : strtoupper($rwOpvalvulado['pedvenfecent']) ;
				//VARIABLES ACUMULABLES A USAR EN OP {ORDENES DE PRODUCCION}
				if($rwOpvalvulado['pedvennumero']) $PEDIDOPRODUCCION = ($PEDIDOPRODUCCION)? $PEDIDOPRODUCCION.'<br>&nbsp;'.$rwOpvalvulado['pedvennumero'] : $rwOpvalvulado['pedvennumero'] ;
				if($rwOpvalvulado['tipevenombre']) $TIPOPEDIDO = ($TIPOPEDIDO)? $TIPOPEDIDO.'<br>&nbsp;'.$rwOpvalvulado['tipevenombre'] : $rwOpvalvulado['tipevenombre'] ;
				if($rwOpvalvulado['produccoduno']) $ITEMPRODUCCION = ($ITEMPRODUCCION)? $ITEMPRODUCCION.'<br>&nbsp;'.$rwOpvalvulado['produccoduno'] : $rwOpvalvulado['produccoduno'] ;
				if($rwOpvalvulado['ordcomrazsoc']) $CLIENTEPRODUCCION = ($CLIENTEPRODUCCION)? $CLIENTEPRODUCCION.'<br>&nbsp;'.$rwOpvalvulado['ordcomrazsoc'] : $rwOpvalvulado['ordcomrazsoc'] ;
				if($rwOpvalvulado['procednombre']) $DESTINOPEDIDO = ($DESTINOPEDIDO)? $DESTINOPEDIDO.'<br>&nbsp;'.strtoupper($rwOpvalvulado['procednombre']) : strtoupper($rwOpvalvulado['procednombre']) ;
			}
			($b % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
?>			
	<tr <?php echo $complement ?>">
		<td><a href="javascript:animatedcollapse.toggle('filtrOpp_<?php echo $b ?>');"><img id="row" align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0"></a></td>
		<td><input type="radio" id="chkopp" name="chkopp" <?php echo $checked ?> onclick="setArropp(this.value);" value="<?php echo $rwValvulado['ordoppcodigo'] ?>"></td>
		<td class="cont-line">&nbsp;<?php echo str_pad($rwOpvalvulado['solprocodigo'], 4, "0", STR_PAD_LEFT) ?></td>
		<td class="cont-line">&nbsp;<?php echo $REFPRODUCCION; ?></td>
		<td class="cont-line">&nbsp;<?php echo $LARGOMATERIAL; ?></td>
		<td class="cont-line">&nbsp;<?php echo $ANCHOMATERIAL; ?></td>
		<td class="cont-line">&nbsp;<?php echo $FUELLEMATERIAL; ?></td>
		<td class="cont-line">&nbsp;<?php echo $PESOMILLAR; ?></td>
		<td class="cont-line">&nbsp;<?php echo $CANTIDADPED;?></td>
		<td class="cont-line">&nbsp;<?php echo $FECHAENTREGA; ?></td>
		<td class="cont-line">&nbsp;<?php echo number_format($KILOSVALVULADO, 2, ',', '.'); ?></td>
		<td class="cont-line">&nbsp;<span class="<?php echo $SPANVALVULADO; ?>" style="float: left; margin-right: .3em;"></span></td>
	</tr>
	<tr <?php echo $complement ?>">
		<td></td>
		<td colspan="11">
			<div id="filtrOpp_<?php echo $b ?>" style="display: none;" >
				<table border="0" cellspacing="1" cellpadding="1" style="border-top:none; border-right:none;" align="left" class="ui-widget-content" width="100%">
					<tr>
						<td width="120" class="ui-state-default">PV&nbsp;</td>
						<td width="120" class="ui-state-default">Tipo PV&nbsp;</td>
						<td width="120" class="ui-state-default">Item&nbsp;</td>
						<td width="360" class="ui-state-default">Cliente&nbsp;</td>
						<td width="120" class="ui-state-default">Metros&nbsp;<b>(mts)</b>&nbsp;</td>						
						<td width="180" class="ui-state-default">Destino</td>
					</tr>
					<tr class="<?php echo  $class ?>">
						<td class="NoiseFooterTD" valign="top">&nbsp;<?php echo $PEDIDOPRODUCCION; ?></td>
						<td class="NoiseFooterTD" valign="top">&nbsp;<?php echo $TIPOPEDIDO;?></td>
						<td class="NoiseFooterTD" valign="top">&nbsp;<?php echo $ITEMPRODUCCION; ?></td>
						<td class="NoiseFooterTD" valign="top">&nbsp;<?php echo $CLIENTEPRODUCCION; ?></td>
						<td class="NoiseFooterTD" valign="top">&nbsp;<?php echo number_format($METROSVALVULADO, 2, ',', '.'); ?></td>
						<td class="NoiseFooterTD" valign="top">&nbsp;<?php echo $DESTINOPEDIDO; ?></td>
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
			</tr>
<?php
			endfor;
		endif;	
?>
</table>
<input type="hidden" name="totalopp_und" id="totalopp_und" value="<?php echo $totalopp_und ?>" />
<input type="hidden" name="totalopp_kgs" id="totalopp_kgs" value="<?php echo $totalopp_kgs ?>" />
<input type="hidden" name="totalopp_mts" id="totalopp_mts" value="<?php echo $totalopp_mts ?>" />