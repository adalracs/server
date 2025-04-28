<!-- NECESIDAD DE PRODUCCION -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr class="ui-state-default">
		<td class="cont-title">&nbsp;Necesidad de producci&oacute;n</td>
	</tr>
</table>
<?php
for($a = 0;$a < count($arrMateriales);$a++)
{
	if($arrMateriales[$a]['paditeextrui'] == 't')
	{
?>
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
	<tr>
		<td width="20%" class="NoiseFooterTD" width="20%">&nbsp;Material</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($arrMateriales[$a]['paditenombre'])? $arrMateriales[$a]['paditenombre'] : '---' ; ?>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Calibre</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($arrMateriales[$a]['plapadcaliba1'])? $arrMateriales[$a]['plapadcaliba1'] : '---' ;?>&nbsp;<b>&micro;m</b>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Kilogramos</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo  ($arrMateriales[$a]['plapadcantkg'])? number_format($arrMateriales[$a]['plapadcantkg'], 2, ',', '.') : '---' ; ?>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Metros</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo  ($arrMateriales[$a]['plapadcantmt'])? number_format($arrMateriales[$a]['plapadcantmt'], 2, ',', '.') : '' ; ?>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Ancho planeado&nbsp;<small>(con refile)</small></td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($arrMateriales[$a]['plapadanchoi'])? number_format($arrMateriales[$a]['plapadanchoi'], 2, ',', '.')  : '---' ;?>&nbsp;<b>mm</b>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Formula</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo  ($arrMateriales[$a]['formulnumero'])? $arrMateriales[$a]['formulnumero'] : '---' ; ?>&nbsp;</td>
	</tr>	
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Refile</td>
		<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo ($arrMateriales[$a]['plapadrefile'])? number_format($arrMateriales[$a]['plapadrefile'], 2, ',', '.')  : '---' ;?>&nbsp;<b>mm</b>&nbsp;</td>
	</tr>
</table>
<?php 
	}
}
?>

<!-- OBSERVACIONES -->
<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
	<tr>
		<td colspan="3" class="ui-state-default">&nbsp;Observaciones</td>
	</tr>
</table>
<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
	<tr>
		<td><?php echo $ordprodescri_ext; ?></td>
	</tr>
</table>
<!-- FIN OBSERVACIONES -->


<!-- ORDENES DE PRODUCCION -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr class="ui-state-default">
		<td class="cont-title">&nbsp;ORDENES DE PRODUCCION PROGRAMADAS</td>	
	</tr>
</table>
<?php 
$idcon = fncconn();
$rsOP = dinamicscanopop2(array('solprocodigo' => $solprocodigo,'tipsolcodigo' => 1),array('solprocodigo' => '=','tipsolcodigo' => '='),$idcon);
$nrOP = fncnumreg($rsOP);
if(!$nrOP)
{
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr>
		<td>
			<div class="ui-widget">
				<div style="margin-top: 1px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all">
					<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span> <b>No se encontraron opp.</b></p>
				</div>
			</div>
		</td>
	</tr>
</table>
<?php
}

for($a = 0;$a < $nrOP;$a++)
{
	$rwOP = fncfetch($rsOP,$a);
	$rsOpproduccion = dinamicscanopop(array('ordoppcodigo' => $rwOP['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
	$nrOpproduccion = fncnumreg($rsOpproduccion);
	//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
	$ANCHOEXTRUSION = '';
	$CALIBREEXTRUSION = '';
	$KILOSEXTRUSION = '';
	$METROSEXTRUSION = '';
	//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
	$FORMULAEXTRUSION = '';
	$CORTEEXTRUSION = '';
	$PISTASEXTRUSION = '';
	//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
	$ANCHOEXTRUSION = ($rwOP['ordoppanchot'])? $rwOP['ordoppanchot'] : '---' ;
	$KILOSEXTRUSION = ($rwOP['ordoppcantkg'])? $rwOP['ordoppcantkg'] : '---' ;
	$METROSEXTRUSION = ($rwOP['ordoppcantmt'])? $rwOP['ordoppcantmt'] : '---' ;
	for($b = 0;$b < $nrOpproduccion;$b++)
	{
		$rwOpproduccion = fncfetch($rsOpproduccion, $b);
		$rwOpextrusion = loadrecordopextrusion($rwOpproduccion['ordprocodigo'],$idcon);
		//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
		$FORMULAEXTRUSION = ($rwOpextrusion['formulnumero'])? $rwOpextrusion['formulnumero'] : '---' ;
		$CALIBREEXTRUSION = ($rwOpextrusion['ordprocalibr'])? $rwOpextrusion['ordprocalibr'] : '---' ;
		//VARIABLES ACUMULABLES A USAR EN OP {ORDENES DE PRODUCCION}
		if($rwOpextrusion['itedescodigo']) $ITEMPRODUCCION = ($ITEMPRODUCCION)? $ITEMPRODUCCION.' | '.$rwOpextrusion['itedescodigo'] : $rwOpextrusion['itedescodigo'] ;
		if($rwOpextrusion['ordproancext'] && $rwOpextrusion['ordpropistae']) 
		{
			$CORTEEXTRUSION = ($CORTEEXTRUSION)? $CORTEEXTRUSION.' | '.($rwOpextrusion['ordpropistae'] * $rwOpextrusion['ordproancext']) : ($rwOpextrusion['ordpropistae'] * $rwOpextrusion['ordproancext']);
			$PISTASEXTRUSION = ($PISTASEXTRUSION)? $PISTASEXTRUSION.' | '.$rwOpextrusion['ordpropistae'].' * '.$rwOpextrusion['ordproancext'] : $rwOpextrusion['ordpropistae'].' * '.$rwOpextrusion['ordproancext'] ;
		}
	}
	
	($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)" ' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)" ';
?>
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
	<tr>
		<td class="ui-state-default" width="10%"  align="center"># OPP</td>
		<td class="ui-state-default" width="10%"  align="center">Mezcla</td>
		<td class="ui-state-default" width="10%"  align="center">Ancho&nbsp;<b>(mm)</b></td>
		<td class="ui-state-default" width="20%"  align="center">A. Corte&nbsp;<b>(mm)</b></td>
		<td class="ui-state-default" width="10%"  align="center">Pistas&nbsp;</td>
		<td class="ui-state-default" width="10%"  align="center">Calibre&nbsp;<b>(&micro;m)</b></td>
		<td class="ui-state-default" width="10%"  align="center">Item&nbsp;<b>Pr.</b></td> 
		<td class="ui-state-default" width="10%"  align="center"><b>Kgs Pr.</b></td>
		<td class="ui-state-default" width="10%"  align="center"><b>Mts Pr.</b></td>  
	</tr>
	<tr <?php echo $complement ?>">
		<td class="cont-line" rowspan="2">&nbsp;<?php echo str_pad($rwOP['ordoppcodigo'], 4, "0", STR_PAD_LEFT); ?></td>
		<td class="cont-line">&nbsp;<?php echo $FORMULAEXTRUSION; ?></td>
		<td class="cont-line">&nbsp;<?php echo $ANCHOEXTRUSION; ?></td>
		<td class="cont-line">&nbsp;<?php echo $CORTEEXTRUSION; ?></td>
		<td class="cont-line">&nbsp;<?php echo $PISTASEXTRUSION;?></td>
		<td class="cont-line">&nbsp;<?php echo $CALIBREEXTRUSION; ?></td>
		<td class="cont-line">&nbsp;<?php echo $ITEMPRODUCCION; ?></td>
		<td class="cont-line">&nbsp;<?php echo number_format($KILOSEXTRUSION, 2, ',', '.'); ?></td>
		<td class="cont-line">&nbsp;<?php echo number_format($METROSEXTRUSION, 2, ',', '.'); ?></td>
	</tr>
	<tr <?php echo $complement ?>">
		<td class="cont-line" colspan="8">
		<?php 
			$ordoppcodigo = $rwOP['ordoppcodigo'];
			$tiposoliprog = 1;
			include ('jquery.historeporteopp.php');
		?>
		</td>
	</tr>
</table>
<?php 
}
?>