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
		<td><?php echo $ordprodescri_pch; ?></td>
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
$rsOP = dinamicscanopop2(array('solprocodigo' => $solprocodigo,'tipsolcodigo' => 7),array('solprocodigo' => '=','tipsolcodigo' => '='),$idcon);
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
	$KILOSSELLADO = '';
	$METROSELLADO = '';
	//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
	$KILOSPAUCHADO = ($rwOP['ordoppcantid'])? $rwOP['ordoppcantid'] : '---' ;
	$METROPAUCHADO = ($rwOP['ordoppmetros'])? $rwOP['ordoppmetros'] : '---' ;
	for($b = 0;$b < $nrOpproduccion;$b++)
	{
		$rwOpproduccion = fncfetch($rsOpproduccion, $b);
		$rwOppauchado = loadrecordoppauchado($rwOpproduccion['ordprocodigo'],$idcon);
		//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
		if($rwOppauchado['producnombre']) $REFPRODUCCION = ($REFPRODUCCION)? $REFPRODUCCION.'<br>&nbsp;'.$rwOppauchado['producnombre'] : $rwOppauchado['producnombre'] ;
		if($rwOppauchado['ordprolargom']) $LARGOMATERIAL = ($LARGOMATERIAL)? $LARGOMATERIAL.'<br>&nbsp;'.$rwOppauchado['ordprolargom'] : $rwOppauchado['ordprolargom'] ;
		if($rwOppauchado['ordprofuellem']) $FUELLEMATERIAL = ($FUELLEMATERIAL)? $FUELLEMATERIAL.'<br>&nbsp;'.$rwOppauchado['ordprofuellem'] : $rwOppauchado['ordprofuellem'] ;
		if($rwOppauchado['ordproanchom']) $ANCHOMATERIAL = ($ANCHOMATERIAL)? $ANCHOMATERIAL.'<br>&nbsp;'.$rwOppauchado['ordproanchom'] : $rwOppauchado['ordproanchom'] ;
		if($rwOppauchado['ordpropmillar']) $PESOMILLAR = ($PESOMILLAR)? $PESOMILLAR.'<br>&nbsp;'.$rwOppauchado['ordpropmillar'] : $rwOppauchado['ordpropmillar'] ;
		if($rwOppauchado['propedcansol']) $CANTIDADPED = ($CANTIDADPED)? $CANTIDADPED.'<br>&nbsp;'.$rwOppauchado['propedcansol'] : $rwOppauchado['propedcansol'] ;
		if($rwOppauchado['pedvenfecent']) $FECHAENTREGA = ($FECHAENTREGA)? $FECHAENTREGA.'<br>&nbsp;'.strtoupper($rwOppauchado['pedvenfecent']) : strtoupper($rwOppauchado['pedvenfecent']) ;
		//VARIABLES ACUMULABLES A USAR EN OP {ORDENES DE PRODUCCION}
		if($rwOppauchado['pedvennumero']) $PEDIDOPRODUCCION = ($PEDIDOPRODUCCION)? $PEDIDOPRODUCCION.'<br>&nbsp;'.$rwOppauchado['pedvennumero'] : $rwOppauchado['pedvennumero'] ;
		if($rwOppauchado['tipevenombre']) $TIPOPEDIDO = ($TIPOPEDIDO)? $TIPOPEDIDO.'<br>&nbsp;'.$rwOppauchado['tipevenombre'] : $rwOppauchado['tipevenombre'] ;
		if($rwOppauchado['produccoduno']) $ITEMPRODUCCION = ($ITEMPRODUCCION)? $ITEMPRODUCCION.'<br>&nbsp;'.$rwOppauchado['produccoduno'] : $rwOppauchado['produccoduno'] ;
		if($rwOppauchado['ordcomrazsoc']) $CLIENTEPRODUCCION = ($CLIENTEPRODUCCION)? $CLIENTEPRODUCCION.'<br>&nbsp;'.$rwOppauchado['ordcomrazsoc'] : $rwOppauchado['ordcomrazsoc'] ;
		if($rwOppauchado['procednombre']) $DESTINOPEDIDO = ($DESTINOPEDIDO)? $DESTINOPEDIDO.'<br>&nbsp;'.strtoupper($rwOppauchado['procednombre']) : strtoupper($rwOppauchado['procednombre']) ;
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
		<td class="ui-state-default" width="10%"  align="center">Kilogramos</td>  
	</tr>
	<tr <?php echo $complement ?>">
		<td class="cont-line">&nbsp;<?php echo str_pad($rwOP['ordoppcodigo'], 4, "0", STR_PAD_LEFT) ?></td>
		<td class="cont-line">&nbsp;<?php echo $LARGOMATERIAL; ?></td>
		<td class="cont-line">&nbsp;<?php echo $ANCHOMATERIAL; ?></td>
		<td class="cont-line">&nbsp;<?php echo $FUELLEMATERIAL; ?></td>
		<td class="cont-line">&nbsp;<?php echo $PESOMILLAR; ?></td>
		<td class="cont-line">&nbsp;<?php echo $CANTIDADPED;?></td>
		<td class="cont-line">&nbsp;<?php echo $FECHAENTREGA; ?></td>
		<td class="cont-line">&nbsp;<?php echo number_format($KILOSPAUCHADO, 2, ',', '.'); ?></td>
	</tr>
	<tr <?php echo $complement ?>">
		<td class="cont-line" colspan="7">
		<?php 
			$ordoppcodigo = $rwOP['ordoppcodigo'];
			$tiposoliprog = 7;
			include ('jquery.historeporteopp.php');
		?>
		</td>
	</tr>
</table>
<?php 
}
?>