<?php
	//conexion
	$idcon = fncconn();
	$rsTroquelado = dinamicscanopprogramatroquelado1(array('equipocodigo' => $equipo, 'ordoppcomfir' => '1'),array('equipocodigo' => '=', 'ordoppcomfir' => '='),$idcon, $rtr = 1);
	//se consulta el numero de registros
	$nrTroquelado = fncnumreg($rsTroquelado);
	//objetos para el total por maquina
	$total_equipound = $equipo.'_und';
	$total_equipomts = $equipo.'_mts';
	$total_equipokgs = $equipo.'_kgs';
	echo "<script type='text/javascript'>Event_animatedcollapse('".$nrTroquelado."', 'filtrOpp_".$equipo."');</script>";
?>
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">
	<tr>
		<td class="ui-state-default" width="2%"  align="center">---</td>
		<td class="ui-state-default" width="5%"  align="center"><span class="ui-icon ui-icon-person"></span></td>
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
	</tr>
<?php 
		for($b = 0; $b < $nrTroquelado; $b++):
			$rwTroquelado = fncfetch($rsTroquelado, $b);
			//sumatoria de unidades , metros, kilogramos
			$$total_equipound = $$total_equipound + 1; 
			$$total_equipokgs = $$total_equipokgs + $rwTroquelado['ordoppcantkg'];
			$$total_equipomts = $$total_equipomts + $rwTroquelado['ordoppcantmt'];
			//rutina para traer las op's que contienen la opp madre
			$rsOpproduccion = dinamicscanopop(array('ordoppcodigo' => $rwTroquelado['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
			$nrOpproduccion = fncnumreg($rsOpproduccion);
			//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
			$REFPRODUCCION = '';
			$LARGOMATERIAL = '';
			$FUELLEMATERIAL = '';
			$ANCHOMATERIAL = '';
			$PESOMILLAR = '';	
			$CANTIDADPED = '';
			$FECHAENTREGA = '';
			$KILOSTROQUELADO = '';
			$METROSTROQUELADO = '';
			//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
			$PEDIDOPRODUCCION = '';
			$TIPOPEDIDO = '';
			$ITEMPRODUCCION = '';
			$CLIENTEPRODUCCION = '';
			$DESTINOPEDIDO = '';		
			//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
			$KILOSTROQUELADO = ($rwTroquelado['ordoppcantkg'])? $rwTroquelado['ordoppcantkg'] : '---' ;
			$METROSTROQUELADO = ($rwTroquelado['ordoppcantmt'])? $rwTroquelado['ordoppcantmt'] : '---' ;
			$APROBADOTROQUELADO = ($rwTroquelado['ordoppcomfir'] > 0)? '<font color="#000080"><b>Si</b></font>' : '<font color="#FF0000"><b>No</b></font>' ;
			//se recorren las ordenes de produccion {op} asociadas en la opp
			for($c = 0;$c < $nrOpproduccion;$c++)
			{
				$rwOpproduccion = fncfetch($rsOpproduccion, $c);
				$rwOptroquelado = loadrecordoptroquelado($rwOpproduccion['ordprocodigo'],$idcon);
				//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
				if($rwOptroquelado['producnombre']) $REFPRODUCCION = ($REFPRODUCCION)? $REFPRODUCCION.'<br>&nbsp;'.$rwOptroquelado['producnombre'] : $rwOptroquelado['producnombre'] ;
				if($rwOptroquelado['ordprolargom']) $LARGOMATERIAL = ($LARGOMATERIAL)? $LARGOMATERIAL.'<br>&nbsp;'.$rwOptroquelado['ordprolargom'] : $rwOptroquelado['ordprolargom'] ;
				if($rwOptroquelado['ordprofuelle']) $FUELLEMATERIAL = ($FUELLEMATERIAL)? $FUELLEMATERIAL.'<br>&nbsp;'.$rwOptroquelado['ordprofuelle'] : $rwOptroquelado['ordprofuelle'] ;
				if($rwOptroquelado['ordproancmat']) $ANCHOMATERIAL = ($ANCHOMATERIAL)? $ANCHOMATERIAL.'<br>&nbsp;'.$rwOptroquelado['ordproancmat'] : $rwOptroquelado['ordproancmat'] ;
				if($rwOptroquelado['ordpropmilla']) $PESOMILLAR = ($PESOMILLAR)? $PESOMILLAR.'<br>&nbsp;'.$rwOptroquelado['ordpropmilla'] : $rwOptroquelado['ordpropmilla'] ;
				if($rwOptroquelado['propedcansol']) $CANTIDADPED = ($CANTIDADPED)? $CANTIDADPED.'<br>&nbsp;'.$rwOptroquelado['propedcansol'] : $rwOptroquelado['propedcansol'] ;
				if($rwOptroquelado['pedvenfecent']) $FECHAENTREGA = ($FECHAENTREGA)? $FECHAENTREGA.'<br>&nbsp;'.strtoupper($rwOptroquelado['pedvenfecent']) : strtoupper($rwOptroquelado['pedvenfecent']) ;
				//VARIABLES ACUMULABLES A USAR EN OP {ORDENES DE PRODUCCION}
				if($rwOptroquelado['pedvennumero']) $PEDIDOPRODUCCION = ($PEDIDOPRODUCCION)? $PEDIDOPRODUCCION.'<br>&nbsp;'.$rwOptroquelado['pedvennumero'] : $rwOptroquelado['pedvennumero'] ;
				if($rwOptroquelado['tipevenombre']) $TIPOPEDIDO = ($TIPOPEDIDO)? $TIPOPEDIDO.'<br>&nbsp;'.$rwOptroquelado['tipevenombre'] : $rwOptroquelado['tipevenombre'] ;
				if($rwOptroquelado['produccoduno']) $ITEMPRODUCCION = ($ITEMPRODUCCION)? $ITEMPRODUCCION.'<br>&nbsp;'.$rwOptroquelado['produccoduno'] : $rwOptroquelado['produccoduno'] ;
				if($rwOptroquelado['ordcomrazsoc']) $CLIENTEPRODUCCION = ($CLIENTEPRODUCCION)? $CLIENTEPRODUCCION.'<br>&nbsp;'.$rwOptroquelado['ordcomrazsoc'] : $rwOptroquelado['ordcomrazsoc'] ;
				if($rwOptroquelado['procednombre']) $DESTINOPEDIDO = ($DESTINOPEDIDO)? $DESTINOPEDIDO.'<br>&nbsp;'.strtoupper($rwOptroquelado['procednombre']) : strtoupper($rwOptroquelado['procednombre']) ;
			}
			($b % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
?>			
	<tr <?php echo $complement; ?> >
		<td><a href="javascript:animatedcollapse.toggle('filtrOpp_<?php echo $equipo ?>_<?php echo $b ?>');"><img id="row" align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0"></a></td>
		<td width="5%" class="cont-line">&nbsp;<input type="radio" name="radiobutton1" id="radiobutton1" value="<?php echo $rwTroquelado['ordoppcodigo']; ?>" onclick="setOrdoppcodigo(this.value);" /></td>
		<td class="cont-line">&nbsp;&nbsp;<?php echo ($b + 1) ?></td>
		<td class="cont-line">&nbsp;<?php echo str_pad($rwTroquelado['solprocodigo'], 4, "0", STR_PAD_LEFT) ?></td>
		<td class="cont-line">&nbsp;<?php echo $REFPRODUCCION; ?></td>
		<td class="cont-line">&nbsp;<?php echo $LARGOMATERIAL; ?></td>
		<td class="cont-line">&nbsp;<?php echo $ANCHOMATERIAL; ?></td>
		<td class="cont-line">&nbsp;<?php echo $FUELLEMATERIAL; ?></td>
		<td class="cont-line">&nbsp;<?php echo $PESOMILLAR; ?></td>
		<td class="cont-line">&nbsp;<?php echo $CANTIDADPED;?></td>
		<td class="cont-line">&nbsp;<?php echo $FECHAENTREGA; ?></td>
		<td class="cont-line">&nbsp;<?php echo number_format($KILOSTROQUELADO, 2, ',', '.'); ?></td>
		<td class="cont-line">&nbsp;<?php echo $APROBADOTROQUELADO; ?></td>
	</tr>
	<tr <?php echo $complement; ?> >
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
						<td class="NoiseFooterTD" valign="top">&nbsp;<?php echo number_format($METROSTROQUELADO, 2, ',', '.'); ?></td>
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