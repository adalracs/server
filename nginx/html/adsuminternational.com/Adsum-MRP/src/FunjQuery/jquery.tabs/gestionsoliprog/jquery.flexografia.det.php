<!-- NECESIDAD DE PRODUCCION -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr class="ui-state-default">
		<td class="cont-title">&nbsp;Necesidad de producci&oacute;n</td>
	</tr>
</table>
<?php
for($a = 0;$a < count($arrMateriales);$a++)
{
	if($arrMateriales[$a]['paditecodigo'] == $product_imp)
	{
?>
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
	<tr>
		<td width="20%" class="NoiseFooterTD" width="20%">&nbsp;Material</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($arrMateriales[$a]['paditenombre'])? $arrMateriales[$a]['paditenombre'] : '---' ; ?>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb['plapadcaliba1_flx']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Calibre</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($arrMateriales[$a]['plapadcaliba1'])? $arrMateriales[$a]['plapadcaliba1'] : '---' ;?>&nbsp;<b>&micro;m</b>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb['plapadcantkg_flx']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Kilogramos</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo  ($arrMateriales[$a]['plapadcantkg'])? number_format($arrMateriales[$a]['plapadcantkg'], 2, ',', '.') : '---' ; ?>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb['plapadcantmt_flx']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Metros</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo  ($arrMateriales[$a]['plapadcantmt'])? number_format($arrMateriales[$a]['plapadcantmt'], 2, ',', '.') : '' ; ?>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb['plapadanchoi_flx']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Ancho planeado&nbsp;<small>(con refile)</small></td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($arrMateriales[$a]['plapadanchoi'])? number_format($arrMateriales[$a]['plapadanchoi'], 2, ',', '.')  : '---' ;?>&nbsp;<b>mm</b>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb['plapadcantmt_flx']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Refile</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo  ($arrMateriales[$a]['plapadrefile'])? number_format($arrMateriales[$a]['plapadrefile'], 2, ',', '.') : '' ; ?>&nbsp;</td>
	</tr>	
</table>
<?php 
	}
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
		<td><?php echo $ordprodescri_flx; ?></td>
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
$rsOP = dinamicscanopop2(array('solprocodigo' => $solprocodigo,'tipsolcodigo' => 3),array('solprocodigo' => '=','tipsolcodigo' => '='),$idcon);
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
	$ANCHOIMPRESION = '';
	$KILOSIMPRESION = '';
	$METROSIMPRESION = '';
	$APROBADOIMPRESION = '';
	//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
	$MATERIALIMPRESION = '';
	$TIPOIMPRESION = '';
	$FECHAENTREGA = '';
	$RODILLOIMPRESION = '';
	//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
	$ANCHOIMPRESION = ($rwOP['ordoppanchot'])? $rwOP['ordoppanchot'] : '---' ;
	$KILOSIMPRESION = ($rwOP['ordoppcantkg'])? $rwOP['ordoppcantkg'] : '---' ;
	$METROSIMPRESION = ($rwOP['ordoppcantmt'])? $rwOP['ordoppcantmt'] : '---' ;
	for($b = 0;$b < $nrOpproduccion;$b++)
	{
		$rwOpproduccion = fncfetch($rsOpproduccion, $b);
		$rwOpflexografia = loadrecordopflexo($rwOpproduccion['ordprocodigo'],$idcon);
		//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
		$MATERIALIMPRESION = ($rwOpflexografia['paditenombre'])? $rwOpflexografia['paditenombre'] : '---' ;
		$TIPOIMPRESION = ($rwOpflexografia['ordprotipimp'])? strtoupper($rwOpflexografia['ordprotipimp']) : '---' ;
		$RODILLOIMPRESION = ($rwOpflexografia['ordprorodill'])? $rwOpflexografia['ordprorodill'] : '---' ;
		//VARIABLES ACUMULABLES A USAR EN OP {ORDENES DE PRODUCCION}
		if($rwOpflexografia['pedvenfecent']) $FECHAENTREGA = ($FECHAENTREGA)? $FECHAENTREGA.'<br>&nbsp;'.strtoupper($rwOpflexografia['pedvenfecent']) : strtoupper($rwOpflexografia['pedvenfecent']) ;
	}
	
	($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)" ' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)" ';
?>
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
	<tr> 
		<td class="ui-state-default" width="10%"  align="center"># OPP</td>
		<td class="ui-state-default" width="30%"  align="center">Material</td>
		<td class="ui-state-default" width="10%"  align="center">Ancho</td>
		<td class="ui-state-default" width="10%"  align="center"><b>Kgs Pr.</b></td>
		<td class="ui-state-default" width="10%"  align="center"><b>Mts Pr.</b></td>  
		<td class="ui-state-default" width="10%"  align="center">Impresion</td>
		<td class="ui-state-default" width="10%"  align="center">F. Entega</td>
		<td class="ui-state-default" width="10%"  align="center">Rodillo</td>
	</tr>
	<tr <?php echo $complement ?>">
		<td class="cont-line" rowspan="2">&nbsp;<?php echo str_pad($rwOP['ordoppcodigo'], 4, "0", STR_PAD_LEFT); ?></td>
		<td class="cont-line">&nbsp;<?php echo $MATERIALIMPRESION; ?></td>
		<td class="cont-line">&nbsp;<?php echo $ANCHOIMPRESION; ?></td>
		<td class="cont-line">&nbsp;<?php echo number_format($KILOSIMPRESION, 2, ',', '.'); ?></td>
		<td class="cont-line">&nbsp;<?php echo number_format($METROSIMPRESION, 2, ',', '.'); ?></td>
		<td class="cont-line">&nbsp;<?php echo $TIPOIMPRESION; ?></td>
		<td class="cont-line">&nbsp;<?php echo $FECHAENTREGA; ?></td>
		<td class="cont-line">&nbsp;<?php echo $RODILLOIMPRESION; ?></td>
	</tr>
	<tr <?php echo $complement ?>">
		<td class="cont-line" colspan="7">
		<?php 
			$ordoppcodigo = $rwOP['ordoppcodigo'];
			$tiposoliprog = 3;
			include ('jquery.historeporteopp.php');
		?>
		</td>
	</tr>
</table>
<?php 
}
?>