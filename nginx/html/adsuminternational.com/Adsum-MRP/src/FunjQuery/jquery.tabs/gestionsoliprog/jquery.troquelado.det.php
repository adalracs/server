<!-- NECESIDAD DE PRODUCCION -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr class="ui-state-default">
		<td class="cont-title">&nbsp;Necesidad de producci&oacute;n</td>
	</tr>
</table>
<?php
for($a = 0;$a < 1;$a++)
{
?>
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Calibre</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($arrMateriales[$a]['plapadcalib'])? $arrMateriales[$a]['plapadcalib'] : '---' ;?>&nbsp;<b>&micro;m</b>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Ancho planeado</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($arrMateriales[$a]['plapadanchoi'])? number_format($arrMateriales[$a]['plapadanchoi'], 2, ',', '.')  : '---' ;?>&nbsp;<b>mm</b>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Kilogramos</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo  ($cantplanea_kgs)? number_format($cantplanea_kgs, 2, ',', '.') : '---' ; ?>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Metros</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo  ($arrMateriales[$a]['plapadcantmt'])? number_format($arrMateriales[$a]['plapadcantmt'], 2, ',', '.') : '' ; ?>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD"><?php if($arrMateriales[$a]['plapadcantkg_']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;<?php echo $unimedi; ?></td>
		<td width="30%"  class="NoiseDataTD">&nbsp;<?php echo  ($cant_planea)? number_format($cant_planea, 2, ',', '.') : '---' ; ?>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Peso millar</td>
		<td width="30%"  class="NoiseDataTD">&nbsp;<?php echo  ($pmillar)? number_format($pmillar, 2, ',', '.') : '---' ; ?>&nbsp;</td>
	</tr>
</table>
<?php
}
?>
<!-- FIN NECESIDAD DE PRODUCCION -->
<!-- OBSERVACIONES -->
<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
	<tr>
		<td colspan="3" class="ui-state-default">&nbsp;Observaciones</td>
	</tr>
</table>
<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
	<tr>
		<td><?php echo $ordprodescri_tql; ?></td>
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
$rsOP = dinamicscanopop2(array('solprocodigo' => $solprocodigo,'tipsolcodigo' => 6),array('solprocodigo' => '=','tipsolcodigo' => '='),$idcon);
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
	$REFPRODUCCION = '';
	$LARGOMATERIAL = '';
	$FUELLEMATERIAL = '';
	$ANCHOMATERIAL = '';
	$PESOMILLAR = '';	
	$CANTIDADPED = '';
	$FECHAENTREGA = '';
	$KILOSTROQUELADO = '';
	$METROSTROQUELADO = '';
	//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
	$KILOSTROQUELADO = ($rwTroquelado['ordoppcantkg'])? $rwTroquelado['ordoppcantkg'] : '---' ;
	$METROSTROQUELADO = ($rwTroquelado['ordoppcantmt'])? $rwTroquelado['ordoppcantmt'] : '---' ;
	for($b = 0;$b < $nrOpproduccion;$b++)
	{
		$rwOpproduccion = fncfetch($rsOpproduccion, $b);
		$rwOptroquelado = loadrecordoptroquelado($rwOpproduccion['ordprocodigo'],$idcon);
		//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
		if($rwOptroquelado['ordprolargom']) $LARGOMATERIAL = ($LARGOMATERIAL)? $LARGOMATERIAL.'<br>&nbsp;'.$rwOptroquelado['ordprolargom'] : $rwOptroquelado['ordprolargom'] ;
		if($rwOptroquelado['ordprofuelle']) $FUELLEMATERIAL = ($FUELLEMATERIAL)? $FUELLEMATERIAL.'<br>&nbsp;'.$rwOptroquelado['ordprofuelle'] : $rwOptroquelado['ordprofuelle'] ;
		if($rwOptroquelado['ordproancmat']) $ANCHOMATERIAL = ($ANCHOMATERIAL)? $ANCHOMATERIAL.'<br>&nbsp;'.$rwOptroquelado['ordproancmat'] : $rwOptroquelado['ordproancmat'] ;
		if($rwOptroquelado['ordpropmilla']) $PESOMILLAR = ($PESOMILLAR)? $PESOMILLAR.'<br>&nbsp;'.$rwOptroquelado['ordpropmilla'] : $rwOptroquelado['ordpropmilla'] ;
		if($rwOptroquelado['propedcansol']) $CANTIDADPED = ($CANTIDADPED)? $CANTIDADPED.'<br>&nbsp;'.$rwOptroquelado['propedcansol'] : $rwOptroquelado['propedcansol'] ;
		if($rwOptroquelado['pedvenfecent']) $FECHAENTREGA = ($FECHAENTREGA)? $FECHAENTREGA.'<br>&nbsp;'.strtoupper($rwOptroquelado['pedvenfecent']) : strtoupper($rwOptroquelado['pedvenfecent']) ;
	}
	
	($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)" ' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)" ';
?>
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
	<tr>
		<td class="ui-state-default" width="10%"  align="center"># OPP</td>
		<td class="ui-state-default" width="10%"  align="center">Largo&nbsp;<b>mm</b></td>
		<td class="ui-state-default" width="10%"  align="center">Ancho&nbsp;<b>mm</b></td>
		<td class="ui-state-default" width="10%"  align="center">Fuelle</td>
		<td class="ui-state-default" width="10%"  align="center">Kg Millar</td>
		<td class="ui-state-default" width="10%"  align="center">Cantidad</td>
		<td class="ui-state-default" width="10%"  align="center">F. entrega</td>
		<td class="ui-state-default" width="10%"  align="center"><b>Kgs Pr.</b></td>
	</tr>
	<tr <?php echo $complement ?>">
		<td class="cont-line" rowspan="2">&nbsp;<?php echo str_pad($rwOP['ordoppcodigo'], 4, "0", STR_PAD_LEFT) ?></td>
		<td class="cont-line">&nbsp;<?php echo $LARGOMATERIAL; ?></td>
		<td class="cont-line">&nbsp;<?php echo $ANCHOMATERIAL; ?></td>
		<td class="cont-line">&nbsp;<?php echo $FUELLEMATERIAL; ?></td>
		<td class="cont-line">&nbsp;<?php echo $PESOMILLAR; ?></td>
		<td class="cont-line">&nbsp;<?php echo $CANTIDADPED;?></td>
		<td class="cont-line">&nbsp;<?php echo $FECHAENTREGA; ?></td>
		<td class="cont-line">&nbsp;<?php echo number_format($KILOSTROQUELADO, 2, ',', '.'); ?></td>
	</tr>
	<tr <?php echo $complement ?>">
		<td class="cont-line" colspan="7">
		<?php 
			$ordoppcodigo = $rwOP['ordoppcodigo'];
			$tiposoliprog = 6;
			include ('jquery.historeporteopp.php');
		?>
		</td>
	</tr>
</table>
<?php 
}
?>