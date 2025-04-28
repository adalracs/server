<?php
	//conexion
	$idcon = fncconn();
	$rsDoblado = dinamicscanopprogramadoblado1(array('equipocodigo' => $equipo),array('equipocodigo' => '='),$idcon);
	//se consulta el numero de registros
	$nrDoblado = fncnumreg($rsDoblado);
	//objetos para el total por maquina
	$total_equipound = $equipo.'_und';
	$total_equipomts = $equipo.'_mts';
	$total_equipokgs = $equipo.'_kgs';
	echo "<script type='text/javascript'>Event_animatedcollapse('".$nrDoblado."', 'filtrOpp_".$equipo."');</script>";
?>
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">
	<tr>
		<td class="ui-state-default" width="2%"  align="center">---</td>
		<td class="ui-state-default" width="8%"  align="center">O.E</td>
		<td class="ui-state-default" width="5%"  align="center"># OPP</td>
		<td class="ui-state-default" width="28%"  align="center">Referencia</td>
		<td class="ui-state-default" width="8%"  align="center">Largo&nbsp;<b>mm</b></td>
		<td class="ui-state-default" width="10%"  align="center">Ancho&nbsp;<b>mm</b></td>
		<td class="ui-state-default" width="6%"  align="center">Fuelle</td>
		<td class="ui-state-default" width="8%"  align="center">Kg Millar</td>
		<td class="ui-state-default" width="8%"  align="center">Cantidad</td>
		<td class="ui-state-default" width="8%"  align="center">F. entrega</td>
		<td class="ui-state-default" width="8%"  align="center">Kilogramos</td>
		<td class="ui-state-default" width="5%"  align="center">Pr.</td>  
	</tr>
<?php 
		for($b = 0; $b < $nrDoblado; $b++):
			$rwDoblado = fncfetch($rsDoblado, $b);
			//sumatoria de unidades , metros, kilogramos
			$$total_equipound = $$total_equipound + 1; 
			$$total_equipokgs = $$total_equipokgs + $rwDoblado['ordoppcantkg'];
			$$total_equipomts = $$total_equipomts + $rwDoblado['ordoppcantmt'];
			//rutina para traer las op's que contienen la opp madre
			$rsOpproduccion = dinamicscanopop(array('ordoppcodigo' => $rwDoblado['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
			$nrOpproduccion = fncnumreg($rsOpproduccion);
			//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
			$REFPRODUCCION = '';
			$LARGOMATERIAL = '';
			$FUELLEMATERIAL = '';
			$ANCHOMATERIAL = '';
			$PESOMILLAR = '';	
			$CANTIDADPED = '';
			$FECHAENTREGA = '';
			$KILOSDOBLADO = '';
			$METROSDOBLADO = '';
			//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
			$PEDIDOPRODUCCION = '';
			$TIPOPEDIDO = '';
			$ITEMPRODUCCION = '';
			$CLIENTEPRODUCCION = '';
			$DESTINOPEDIDO = '';		
			//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
			$KILOSDOBLADO = ($rwDoblado['ordoppcantkg'])? $rwDoblado['ordoppcantkg'] : '---' ;
			$METROSDOBLADO = ($rwDoblado['ordoppcantmt'])? $rwDoblado['ordoppcantmt'] : '---' ;
			$APROBADODOBLADO = ($rwDoblado['ordoppcomfir'] > 0)? '<font color="#000080"><b>Si</b></font>' : '<font color="#FF0000"><b>No</b></font>' ;
			//se recorren las ordenes de produccion {op} asociadas en la opp
			for($c = 0;$c < $nrOpproduccion;$c++)
			{
				$rwOpproduccion = fncfetch($rsOpproduccion, $c);
				$rwOpdoblado = loadrecordopdoblado($rwOpproduccion['ordprocodigo'],$idcon);
				//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
				if($rwOpdoblado['producnombre']) $REFPRODUCCION = ($REFPRODUCCION)? $REFPRODUCCION.'<br>&nbsp;'.$rwOpdoblado['producnombre'] : $rwOpdoblado['producnombre'] ;
				if($rwOpdoblado['ordprolargom']) $LARGOMATERIAL = ($LARGOMATERIAL)? $LARGOMATERIAL.'<br>&nbsp;'.$rwOpdoblado['ordprolargom'] : $rwOpdoblado['ordprolargom'] ;
				if($rwOpdoblado['ordprofuelle']) $FUELLEMATERIAL = ($FUELLEMATERIAL)? $FUELLEMATERIAL.'<br>&nbsp;'.$rwOpdoblado['ordprofuelle'] : $rwOpdoblado['ordprofuelle'] ;
				if($rwOpdoblado['ordproancmat']) $ANCHOMATERIAL = ($ANCHOMATERIAL)? $ANCHOMATERIAL.'<br>&nbsp;'.$rwOpdoblado['ordproancmat'] : $rwOpdoblado['ordproancmat'] ;
				if($rwOpdoblado['ordpropmilla']) $PESOMILLAR = ($PESOMILLAR)? $PESOMILLAR.'<br>&nbsp;'.$rwOpdoblado['ordpropmilla'] : $rwOpdoblado['ordpropmilla'] ;
				if($rwOpdoblado['propedcansol']) $CANTIDADPED = ($CANTIDADPED)? $CANTIDADPED.'<br>&nbsp;'.$rwOpdoblado['propedcansol'] : $rwOpdoblado['propedcansol'] ;
				if($rwOpdoblado['pedvenfecent']) $FECHAENTREGA = ($FECHAENTREGA)? $FECHAENTREGA.'<br>&nbsp;'.strtoupper($rwOpdoblado['pedvenfecent']) : strtoupper($rwOpdoblado['pedvenfecent']) ;
				//VARIABLES ACUMULABLES A USAR EN OP {ORDENES DE PRODUCCION}
				if($rwOpdoblado['pedvennumero']) $PEDIDOPRODUCCION = ($PEDIDOPRODUCCION)? $PEDIDOPRODUCCION.'<br>&nbsp;'.$rwOpdoblado['pedvennumero'] : $rwOpdoblado['pedvennumero'] ;
				if($rwOpdoblado['tipevenombre']) $TIPOPEDIDO = ($TIPOPEDIDO)? $TIPOPEDIDO.'<br>&nbsp;'.$rwOpdoblado['tipevenombre'] : $rwOpdoblado['tipevenombre'] ;
				if($rwOpdoblado['produccoduno']) $ITEMPRODUCCION = ($ITEMPRODUCCION)? $ITEMPRODUCCION.'<br>&nbsp;'.$rwOpdoblado['produccoduno'] : $rwOpdoblado['produccoduno'] ;
				if($rwOpdoblado['ordcomrazsoc']) $CLIENTEPRODUCCION = ($CLIENTEPRODUCCION)? $CLIENTEPRODUCCION.'<br>&nbsp;'.$rwOpdoblado['ordcomrazsoc'] : $rwOpdoblado['ordcomrazsoc'] ;
				if($rwOpdoblado['procednombre']) $DESTINOPEDIDO = ($DESTINOPEDIDO)? $DESTINOPEDIDO.'<br>&nbsp;'.strtoupper($rwOpdoblado['procednombre']) : strtoupper($rwOpdoblado['procednombre']) ;
			}
			($b % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
?>			
	<tr <?php echo $complement ?>">
		<td><a href="javascript:animatedcollapse.toggle('filtrOpp_<?php echo $equipo ?>_<?php echo $b ?>');"><img id="row" align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0"></a></td>
		<td class="cont-line">&nbsp;&nbsp;<?php echo ($b + 1) ?>&nbsp;<a onclick="openUpdateOpp('<?php echo $rwDoblado['ordoppcodigo'] ?>', '<?php echo $equipo ?>')"><span class="ui-icon ui-icon-document" style="float: left; margin-right: .3em;"></span></a></td>
		<td class="cont-line">&nbsp;<?php echo str_pad($rwOpdoblado['solprocodigo'], 4, "0", STR_PAD_LEFT) ?></td>
		<td class="cont-line">&nbsp;<?php echo $REFPRODUCCION; ?></td>
		<td class="cont-line">&nbsp;<?php echo $LARGOMATERIAL; ?></td>
		<td class="cont-line">&nbsp;<?php echo $ANCHOMATERIAL; ?></td>
		<td class="cont-line">&nbsp;<?php echo $FUELLEMATERIAL; ?></td>
		<td class="cont-line">&nbsp;<?php echo $PESOMILLAR; ?></td>
		<td class="cont-line">&nbsp;<?php echo $CANTIDADPED;?></td>
		<td class="cont-line">&nbsp;<?php echo $FECHAENTREGA; ?></td>
		<td class="cont-line">&nbsp;<?php echo number_format($KILOSDOBLADO, 2, ',', '.'); ?></td>
		<td class="cont-line">&nbsp;<?php echo $APROBADODOBLADO; ?></td>
	</tr>
	<tr <?php echo $complement ?>">
		<td></td>
		<td colspan="11">
			<div id="filtrOpp_<?php echo $equipo ?>_<?php echo $b ?>" style="display: none;" >
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
						<td class="NoiseFooterTD" valign="top">&nbsp;<?php echo number_format($METROSDOBLADO, 2, ',', '.'); ?></td>
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
<input type="hidden" name="<?php echo $total_equipound ?>" id="<?php echo $total_equipound ?>" value="<?php echo $$total_equipound ?>" />
<input type="hidden" name="<?php echo $total_equipokgs ?>" id="<?php echo $total_equipokgs ?>" value="<?php echo $$total_equipokgs ?>" />
<input type="hidden" name="<?php echo $total_equipomts ?>" id="<?php echo $total_equipomts ?>" value="<?php echo $$total_equipomts ?>" />