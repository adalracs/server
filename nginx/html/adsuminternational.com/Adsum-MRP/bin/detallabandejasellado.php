<?php	

	if(!$noAjax)
	{
		include ( '../src/FunPerPriNiv/pktblvistabandejasellado.php');
		include ( '../src/FunPerPriNiv/pktblplaneapadreitem.php');
		include ( '../src/FunPerPriNiv/pktblplanta.php');
		include ( '../src/FunPerPriNiv/pktblpadreitem.php');
		include ( '../src/FunPerSecNiv/fncconn.php');
		include ( '../src/FunPerSecNiv/fncclose.php');
		include ( '../src/FunPerSecNiv/fncfetch.php');
		include ( '../src/FunPerSecNiv/fncnumreg.php');
		include ( '../src/FunGen/cargainput.php');
	}
	//conexion
	$idcon = fncconn();
	//validacion de filtros para la bandeja de sellado
	if($plantacodigo)
	{
		$record['plantacodigo'] = $plantacodigo;
		$recordop['plantacodigo'] = '=';
		$rsOp = dinamicscanopvistabandejasellado($record, $recordop, $idcon);
	}
	else
	{
		$rsOp = fullscanvistabandejasellado($idcon);
	}
	//se valida y consulta el numero de registros de la consulta
	if($rsOp)
		$nrOp = fncnumreg($rsOp);	
?>
<script type="text/javascript">
	Event_animatedcollapse('<?php echo $nrOp ?>', 'filtrOp');
</script>
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">
	<tr>
		<td class="ui-state-default" width="3%"  align="center">---</td> 
		<td class="ui-state-default" width="5%"  align="center">Sel.</td> 
		<td class="ui-state-default" width="6%"  align="center"># OP</td>
		<td class="ui-state-default" width="30%"  align="center">Referencia</td>
		<td class="ui-state-default" width="8%"  align="center">Largo&nbsp;<b>mm</b></td>
		<td class="ui-state-default" width="10%"  align="center">Ancho b.&nbsp;<b>mm</b></td>
		<td class="ui-state-default" width="6%"  align="center">Fuelle</td>
		<td class="ui-state-default" width="8%"  align="center">Kg Millar</td>
		<td class="ui-state-default" width="8%"  align="center">Cantidad</td>
		<td class="ui-state-default" width="8%"  align="center">F. entrega</td>
		<td class="ui-state-default" width="8%"  align="center">Kilogramos</td>
	</tr>
<?php 
	if($nrOp)
	{
		if($arrop)
		{
			$array_tmp = explode(',',$arrop);
			$array_key = array_flip($array_tmp);
		}
	
		for($a = 0; $a < $nrOp; $a++)
		{
			$rwOp = fncfetch($rsOp, $a);
			//sumatoria de unidades , metros, kilogramos
			$total_und = $total_und + 1; 
			$total_kgs = $total_kgs + $rwOp['ordprocantkg'];
			$total_mts = $total_mts + $rwOp['ordprocantmt'];
			($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
				
			if(is_array($array_key))
			{
				$checked = '';
				if(array_key_exists($rwOp['ordprocodigo'], $array_key) || $allop)
					$checked = 'checked';
			}	
?>			
	<tr <?php echo $complement ?>">
		<td><a href="javascript:animatedcollapse.toggle('filtrOp_<?php echo $a ?>');"><img id="row" align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0"></a></td>
<!--		<td><input type="radio" id="chkop" name="chkop" <?php //echo $checked ?> onclick="setArrop(this.value);" value="<?php //echo $rwOp['ordprocodigo'] ?>"></td>-->
		<td class="cont-line">&nbsp;<span class="ui-icon ui-icon-wrench" style="float: left; margin-right: .3em;"></span></td>
		<td class="cont-line">&nbsp;<?php echo str_pad($rwOp['ordprocodigo'], 4, "0", STR_PAD_LEFT) ?></td>
		<td class="cont-line">&nbsp;<?php echo $rwOp['producnombre'] ?></td>
		<td class="cont-line">&nbsp;<?php echo $rwOp['ordprolargom'] ?></td>
		<td class="cont-line">&nbsp;<?php echo $rwOp['ordproancmat'] ?></td>		
		<td class="cont-line">&nbsp;<?php echo $rwOp['ordprofuelle'] ?></td>	
		<td class="cont-line">&nbsp;<?php echo $rwOp['ordpropmilla'] ?></td>	
		<td class="cont-line">&nbsp;<?php echo $rwOp['propedcansol'] ?></td>	
		<td class="cont-line">&nbsp;<?php echo $rwOp['pedvenfecent'] ?></td>
		<td class="cont-line">&nbsp;<?php echo round($rwOp['ordprocantkg'] * 100) / 100 ?></td>	
	</tr>
	<tr>
		<td></td>
		<td colspan="10">
			<div id="filtrOp_<?php echo $a ?>" style="display: none;" >
				<table border="0" cellspacing="1" cellpadding="1" style="border-top:none; border-right:none;" align="left" class="ui-widget-content" width="100%">
					<tr>
						<td width="120" class="ui-state-default">PV&nbsp;</td>
						<td width="120" class="ui-state-default">Tipo PV&nbsp;</td>
						<td width="340" class="ui-state-default">Item&nbsp;</td>
						<td width="340" class="ui-state-default">Cliente&nbsp;</td>
						<td width="120" class="ui-state-default">Metros&nbsp;<b>(mts)</b>&nbsp;</td>						
					</tr>
					<tr class="<?php echo  $class ?>">
						<td class="NoiseFooterTD" valign="top">&nbsp;<?php echo strtoupper($rwOp['pedvennumero']) ?></td>
						<td class="NoiseFooterTD" valign="top">&nbsp;<?php echo strtoupper($rwOp['tipevenombre']) ?></td>
						<td class="NoiseFooterTD" valign="top">&nbsp;<?php echo strtoupper($rwOp['produccoduno']) ?></td>
						<td class="NoiseFooterTD" valign="top">&nbsp;<?php echo strtoupper($rwOp['ordcomrazsoc']) ?></td>
						<td class="NoiseFooterTD" valign="top">&nbsp;<?php echo number_format($rwOp['ordprocantmt'], 2, ',', '.') ?></td>
					</tr>
				</table>
			</div>
		</td>		
	</tr>
<?php
		}
	}
	
	if($a < 13)
	{
		for($b = $a; $b < 35; $b++)
		{
			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td>&nbsp;</td>
				<td>&nbsp;</td>
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
<input type="hidden" name="total_und" id="total_und" value="<?php echo $total_und ?>" />
<input type="hidden" name="total_kgs" id="total_kgs" value="<?php echo $total_kgs ?>" />
<input type="hidden" name="total_mts" id="total_mts" value="<?php echo $total_mts ?>" />