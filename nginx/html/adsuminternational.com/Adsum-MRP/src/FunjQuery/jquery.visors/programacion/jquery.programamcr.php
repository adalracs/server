<?php
	//conexion
	$idcon = fncconn();
	$rsMicroperforado = dinamicscanopprogramamicroperforado1(array('equipocodigo' => $equipo),array('equipocodigo' => '='),$idcon);
	//se consulta el numero de registros
	$nrMicroperforado = fncnumreg($rsMicroperforado);
	//objetos para el total por maquina
	$total_equipound = $equipo.'_und';
	$total_equipomts = $equipo.'_mts';
	$total_equipokgs = $equipo.'_kgs';
	echo "<script type='text/javascript'>Event_animatedcollapse('".$nrMicroperforado."', 'filtrOpp_".$equipo."');</script>";
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
		for($b = 0; $b < $nrMicroperforado; $b++):
			$rwMicroperforado = fncfetch($rsMicroperforado, $b);
			//sumatoria de unidades , metros, kilogramos
			$$total_equipound = $$total_equipound + 1; 
			$$total_equipokgs = $$total_equipokgs + $rwMicroperforado['ordoppcantkg'];
			$$total_equipomts = $$total_equipomts + $rwMicroperforado['ordoppcantmt'];
			//rutina para traer las op's que contienen la opp madre
			$rsOpproduccion = dinamicscanopop(array('ordoppcodigo' => $rwMicroperforado['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
			$nrOpproduccion = fncnumreg($rsOpproduccion);
			//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
			$REFPRODUCCION = '';
			$LARGOMATERIAL = '';
			$FUELLEMATERIAL = '';
			$ANCHOMATERIAL = '';
			$PESOMILLAR = '';	
			$CANTIDADPED = '';
			$FECHAENTREGA = '';
			$KILOSMICROPERFORADO = '';
			$METROMICROPERFORADO = '';
			//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
			$PEDIDOPRODUCCION = '';
			$TIPOPEDIDO = '';
			$ITEMPRODUCCION = '';
			$CLIENTEPRODUCCION = '';
			$DESTINOPEDIDO = '';		
			//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
			$KILOSMICROPERFORADO = ($rwMicroperforado['ordoppcantkg'])? $rwMicroperforado['ordoppcantkg'] : '---' ;
			$METROMICROPERFORADO = ($rwMicroperforado['ordoppcantmt'])? $rwMicroperforado['ordoppcantmt'] : '---' ;
			$APROBADOMICROPERFORADO = ($rwMicroperforado['ordoppcomfir'] > 0)? '<font color="#000080"><b>Si</b></font>' : '<font color="#FF0000"><b>No</b></font>' ;
			//se recorren las ordenes de produccion {op} asociadas en la opp
			for($c = 0;$c < $nrOpproduccion;$c++)
			{
				$rwOpproduccion = fncfetch($rsOpproduccion, $c);
				$rwOpmicroperforado = loadrecordopmicroperforado($rwOpproduccion['ordprocodigo'],$idcon);
				//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
				if($rwOpmicroperforado['producnombre']) $REFPRODUCCION = ($REFPRODUCCION)? $REFPRODUCCION.'<br>&nbsp;'.$rwOpmicroperforado['producnombre'] : $rwOpmicroperforado['producnombre'] ;
				if($rwOpmicroperforado['ordprolargom']) $LARGOMATERIAL = ($LARGOMATERIAL)? $LARGOMATERIAL.'<br>&nbsp;'.$rwOpmicroperforado['ordprolargom'] : $rwOpmicroperforado['ordprolargom'] ;
				if($rwOpmicroperforado['ordprofuelle']) $FUELLEMATERIAL = ($FUELLEMATERIAL)? $FUELLEMATERIAL.'<br>&nbsp;'.$rwOpmicroperforado['ordprofuelle'] : $rwOpmicroperforado['ordprofuelle'] ;
				if($rwOpmicroperforado['ordproancmat']) $ANCHOMATERIAL = ($ANCHOMATERIAL)? $ANCHOMATERIAL.'<br>&nbsp;'.$rwOpmicroperforado['ordproancmat'] : $rwOpmicroperforado['ordproancmat'] ;
				if($rwOpmicroperforado['ordpropmilla']) $PESOMILLAR = ($PESOMILLAR)? $PESOMILLAR.'<br>&nbsp;'.$rwOpmicroperforado['ordpropmilla'] : $rwOpmicroperforado['ordpropmilla'] ;
				if($rwOpmicroperforado['propedcansol']) $CANTIDADPED = ($CANTIDADPED)? $CANTIDADPED.'<br>&nbsp;'.$rwOpmicroperforado['propedcansol'] : $rwOpmicroperforado['propedcansol'] ;
				if($rwOpmicroperforado['pedvenfecent']) $FECHAENTREGA = ($FECHAENTREGA)? $FECHAENTREGA.'<br>&nbsp;'.strtoupper($rwOpmicroperforado['pedvenfecent']) : strtoupper($rwOpmicroperforado['pedvenfecent']) ;
				//VARIABLES ACUMULABLES A USAR EN OP {ORDENES DE PRODUCCION}
				if($rwOpmicroperforado['pedvennumero']) $PEDIDOPRODUCCION = ($PEDIDOPRODUCCION)? $PEDIDOPRODUCCION.'<br>&nbsp;'.$rwOpmicroperforado['pedvennumero'] : $rwOpmicroperforado['pedvennumero'] ;
				if($rwOpmicroperforado['tipevenombre']) $TIPOPEDIDO = ($TIPOPEDIDO)? $TIPOPEDIDO.'<br>&nbsp;'.$rwOpmicroperforado['tipevenombre'] : $rwOpmicroperforado['tipevenombre'] ;
				if($rwOpmicroperforado['produccoduno']) $ITEMPRODUCCION = ($ITEMPRODUCCION)? $ITEMPRODUCCION.'<br>&nbsp;'.$rwOpmicroperforado['produccoduno'] : $rwOpmicroperforado['produccoduno'] ;
				if($rwOpmicroperforado['ordcomrazsoc']) $CLIENTEPRODUCCION = ($CLIENTEPRODUCCION)? $CLIENTEPRODUCCION.'<br>&nbsp;'.$rwOpmicroperforado['ordcomrazsoc'] : $rwOpmicroperforado['ordcomrazsoc'] ;
				if($rwOpmicroperforado['procednombre']) $DESTINOPEDIDO = ($DESTINOPEDIDO)? $DESTINOPEDIDO.'<br>&nbsp;'.strtoupper($rwOpmicroperforado['procednombre']) : strtoupper($rwOpmicroperforado['procednombre']) ;
			}
			($b % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
?>			
	<tr <?php echo $complement; ?>>
		<td><a href="javascript:animatedcollapse.toggle('filtrOpp_<?php echo $equipo ?>_<?php echo $b ?>');"><img id="row" align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0"></a></td>
		<td class="cont-line">&nbsp;&nbsp;<?php echo ($b + 1) ?>&nbsp;<a onclick="openUpdateOpp('<?php echo $rwMicroperforado['ordoppcodigo'] ?>', '<?php echo $equipo ?>')"><span class="ui-icon ui-icon-document" style="float: left; margin-right: .3em;"></span></a></td>
		<td class="cont-line">&nbsp;<?php echo str_pad($rwOpmicroperforado['solprocodigo'], 4, "0", STR_PAD_LEFT) ?></td>
		<td class="cont-line">&nbsp;<?php echo $REFPRODUCCION; ?></td>
		<td class="cont-line">&nbsp;<?php echo $LARGOMATERIAL; ?></td>
		<td class="cont-line">&nbsp;<?php echo $ANCHOMATERIAL; ?></td>
		<td class="cont-line">&nbsp;<?php echo $FUELLEMATERIAL; ?></td>
		<td class="cont-line">&nbsp;<?php echo $PESOMILLAR; ?></td>
		<td class="cont-line">&nbsp;<?php echo $CANTIDADPED;?></td>
		<td class="cont-line">&nbsp;<?php echo $FECHAENTREGA; ?></td>
		<td class="cont-line">&nbsp;<?php echo number_format($KILOSMICROPERFORADO, 2, ',', '.'); ?></td>
		<td class="cont-line">&nbsp;<?php echo $APROBADOMICROPERFORADO; ?></td>
	</tr>
	<tr <?php echo $complement; ?>>
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
						<td class="NoiseFooterTD" valign="top">&nbsp;<?php echo number_format($METROMICROPERFORADO, 2, ',', '.'); ?></td>
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