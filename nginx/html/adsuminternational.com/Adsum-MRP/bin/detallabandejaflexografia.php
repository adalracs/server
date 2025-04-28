<?php	

	if(!$noAjax)
	{
		include ( '../src/FunPerPriNiv/pktblvistabandejaflexografia.php');
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
	//validacion de filtros para la bandeja de flexografia
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
		$rsOp = dinamicscanopvistabandejaflexografia($record, $recordop, $idcon);
	}
	else
	{
		$rsOp = fullscanvistabandejaflexografia($idcon);
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
		<td class="ui-state-default" width="5%"  align="center"><span class="ui-icon ui-icon-arrowthickstop-1-s"></span></td>
		<td class="ui-state-default" width="5%"  align="center">Sel.</td> 
		<td class="ui-state-default" width="5%"  align="center"># OP</td>
		<td class="ui-state-default" width="10%"  align="center">Item</td>
		<td class="ui-state-default" width="20%"  align="center">Referencia</td>
		<td class="ui-state-default" width="15%"  align="center">Material</td>
		<td class="ui-state-default" width="5%"  align="center">Anc.&nbsp;mm</td>
		<td class="ui-state-default" width="10%"  align="center">Kilogramos</td>
		<td class="ui-state-default" width="5%"  align="center">Metros</td>
		<td class="ui-state-default" width="5%"  align="center">Impresion</td>
		<td class="ui-state-default" width="5%"  align="center">F. Entega</td>
		<td class="ui-state-default" width="5%"  align="center">Rodillo</td>
		<td class="ui-state-default" width="5%"  align="center">Clr</td>
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
	<tr <?php echo $complement ?> >
		<td width="5%" align="center"><a href="javascript:animatedcollapse.toggle('filtrOp_<?php echo $a; ?>');"><img id="row" align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0"></a></td>
		<td width="5%"><input type="checkbox" id="chkop" name="chkop" <?php echo $checked ?> onclick="setSelectionRow(this.value, document.getElementById('arrop').value, ',', 'arrop');" value="<?php echo $rwOp['ordprocodigo']; ?>"></td>
		<td width="5%" class="cont-line">&nbsp;<font color="blue"><b><?php echo str_pad($rwOp['ordprocodigo'], 4, "0", STR_PAD_LEFT); ?></b></font></td>
		<td width="10%" class="cont-line">&nbsp;<font color="brown"><b><?php echo $rwOp['produccoduno']; ?></b></font></td>
		<td width="20%" class="cont-line">&nbsp;<font color="blue"><small><?php echo $rwOp['producnombre']; ?></small></font></td>
		<td width="15%" class="cont-line">&nbsp;<font color="brown"><small><?php echo cargapadreitemnombre($rwOp['paditecodigo'],$idcon);?></small></font></td>		
		<td width="5%" class="cont-line">&nbsp;<?php echo $rwOp['ordproancflx']; ?></td>		
		<td width="10%" class="cont-line">&nbsp;<font color="green"><b><?php echo number_format($rwOp['ordprocantkg'],2,',','.');?></b></font></td>	
		<td width="5%" class="cont-line">&nbsp;<font color="green"><b><?php echo number_format($rwOp['ordprocantmt'],2,',','.');?></b></font></td>	
		<td width="5%" class="cont-line">&nbsp;<?php echo strtoupper($rwOp['ordprotipimp']); ?></td>		
		<td width="5%" class="cont-line">&nbsp;<?php echo strtoupper($rwOp['pedvenfecent']); ?></td>		
		<td width="5%" class="cont-line">&nbsp;<?php echo $rwOp['ordprorodill']; ?></td>	
		<td width="5%" class="cont-line">&nbsp;<?php echo ($rwOp['colorcantun'])? $rwOp['colorcantun'] : $rwOp['colorcantunt']; ?></td>	
	</tr>
	<tr>
		<td colspan="13">
			<div id="filtrOp_<?php echo $a ?>" style="display: none;" >
				<table border="0" cellspacing="1" cellpadding="1" style="border-top:none; border-right:none;" align="left" class="ui-widget-content" width="100%">
					<tr>
						<td width="120" class="ui-state-default"><small>PV</small></td>
						<td width="120" class="ui-state-default"><small>TIPO PV&nbsp;</small></td>
						<td width="800" class="ui-state-default"><small>Cliente&nbsp;</small></td>
					</tr>
					<tr class="<?php echo  $class ?>">
						<td class="NoiseFooterTD" valign="top"><small>&nbsp;<?php echo strtoupper($rwOp['pedvennumero']); ?></small></td>
						<td class="NoiseFooterTD" valign="top"><small>&nbsp;<?php echo strtoupper($rwOp['tipevenombre']); ?></small></td>
						<td class="NoiseFooterTD" valign="top"><small>&nbsp;<?php echo $rwOp['ordcomrazsoc']; ?></small></td>
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