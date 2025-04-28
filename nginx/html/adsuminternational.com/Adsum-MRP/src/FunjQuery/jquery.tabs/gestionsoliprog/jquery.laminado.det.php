<!-- NECESIDAD DE PRODUCCION -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr class="ui-state-default">
		<td class="cont-title">&nbsp;Necesidad de producci&oacute;n</td>
	</tr>
</table>
<?php
$produclam = 1;
ini_set('display_errors',1);
for($a = 0;$a < count($arrMateriales);$a++)
{
	if($arrMateriales[$a]['paditecodigo'] == '23')//23 codigo de los adhesivos
	{
?>
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
	<tr>
		<td width="20%" class="NoiseFooterTD"><?php if($arrMateriales[$a]['laminado_']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Laminado&nbsp;</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($arrMateriales[$a]['laminado'])? $arrMateriales[$a]['laminado'] : '---' ; ?>&nbsp;</td>	
		<td width="20%" class="NoiseFooterTD"><?php if($arrMateriales[$a]['plapaddesem_']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Desempe&ntilde;o&nbsp;</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($arrMateriales[$a]['plapaddesem'])? $arrMateriales[$a]['plapaddesem'] : '---' ;?>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD"><?php if($arrMateriales[$a]['plapadtipo_']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Tipo&nbsp;</td>
		<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo ($arrMateriales[$a]['plapadtipo'])? $arrMateriales[$a]['plapadtipo'] : '---' ; ?>&nbsp;</td>
	</tr>
	<?php 
		$objbreak = 0;
		for($b = 0;$b < count($arrMateriales);$b++)
		{
			$obj_product_lam = 'product_lam_'.($produclam);
			if($arrMateriales[$b]['paditecodigo'] == $$obj_product_lam)
			{
				$objbreak = 1;
	?>
	<tr>
		<td width="20%" class="NoiseFooterTD" width="20%">&nbsp;Material</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($arrMateriales[$b]['paditenombre'])? $arrMateriales[$b]['paditenombre'] : '---' ; ?>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD"><?php if($arrMateriales[$a]['plapadcaliba1_']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Calibre</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($arrMateriales[$b]['plapadcaliba1'])? $arrMateriales[$b]['plapadcaliba1'] : '---' ;?>&nbsp;<b>&micro;m</b>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD"><?php if($arrMateriales[$b]['plapadcantkg_']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Kilogramos</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo  ($arrMateriales[$b]['plapadcantkg'])? number_format($arrMateriales[$b]['plapadcantkg'], 2, ',', '.') : '---' ; ?>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD"><?php if($arrMateriales[$b]['plapadcantmt_']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Metros</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo  ($arrMateriales[$b]['plapadcantmt'])? number_format($arrMateriales[$b]['plapadcantmt'], 2, ',', '.') : '' ; ?>&nbsp;</td>
	</tr>
	<?php 
			}
			if($objbreak > 0)
				break;
		}
		//se asignan lo valores en kilos y metros a laminar 
		$arrMateriales[$a]['plapadcantkg'] = $arrMateriales[$b]['plapadcantkg'];
		$arrMateriales[$a]['plapadcantmt'] = $arrMateriales[$b]['plapadcantmt'];
		$arrMateriales[$a]['plapadcaliba1'] = $arrMateriales[$b]['plapadcaliba1'];
		$produclam++;
	?>
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
		<td><?php echo $ordprodescri_lmn; ?></td>
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
$rsOP = dinamicscanopop2(array('solprocodigo' => $solprocodigo,'tipsolcodigo' => 2),array('solprocodigo' => '=','tipsolcodigo' => '='),$idcon);
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
	$ANCHOLAMINADO = '';
	$KILOSLAMINADO = '';
	$METROSLAMINADO = '';
	//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
	$TIPOADHESIVO = '';
	$DESEMPENOADHESIVO = '';
	$LAMINADOADHESIVO = '';
	$FECHAENTREGA = '';
	//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
	$ANCHOLAMINADO = ($rwOP['ordoppanchot'])? $rwOP['ordoppanchot'] : '---' ;
	$KILOSLAMINADO = ($rwOP['ordoppcantkg'])? $rwOP['ordoppcantkg'] : '---' ;
	$METROSLAMINADO = ($rwOP['ordoppcantmt'])? $rwOP['ordoppcantmt'] : '---' ;
	for($b = 0;$b < $nrOpproduccion;$b++)
	{
		$rwOpproduccion = fncfetch($rsOpproduccion, $b);
		$rwOplaminado = loadrecordoplaminado($rwOpproduccion['ordprocodigo'],$idcon);
		//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
		$TIPOADHESIVO = ($rwOplaminado['ordprotiposo'])? strtoupper($rwOplaminado['ordprotiposo']) : '---' ;
		$DESEMPENOADHESIVO = ($rwOplaminado['ordprodesemp'])? strtoupper($rwOplaminado['ordprodesemp']) : '---' ;
		$LAMINADOADHESIVO = ($rwOplaminado['ordprolamina'])? strtoupper($rwOplaminado['ordprolamina']) : '---' ;				
		//VARIABLES ACUMULABLES A USAR EN OP {ORDENES DE PRODUCCION}
		if($rwOplaminado['pedvenfecent']) $FECHAENTREGA = ($FECHAENTREGA)? $FECHAENTREGA.'<br>&nbsp;'.strtoupper($rwOplaminado['pedvenfecent']) : strtoupper($rwOplaminado['pedvenfecent']) ;
	}
	
	($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)" ' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)" ';
?>
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
	<tr>
		<td class="ui-state-default" width="10%"  align="center"># OPP</td>
		<td class="ui-state-default" width="10%"  align="center">Adhesivo</td>
		<td class="ui-state-default" width="10%"  align="center">Desempe&ntilde;o</td>
		<td class="ui-state-default" width="15%"  align="center">Laminado</td>
		<td class="ui-state-default" width="15%"  align="center">Ancho.&nbsp;<b>mm</b></td>
		<td class="ui-state-default" width="10%"  align="center">F. Entrega</td>
		<td class="ui-state-default" width="10%"  align="center"><b>Kgs Pr.</b></td>
		<td class="ui-state-default" width="10%"  align="center"><b>Mts Pr.</b></td>  
	</tr>
	<tr <?php echo $complement ?>">
		<td class="cont-line" rowspan="2">&nbsp;<?php echo str_pad($rwOP['ordoppcodigo'], 4, "0", STR_PAD_LEFT) ?></td>
		<td class="cont-line">&nbsp;<?php echo $TIPOADHESIVO; ?></td>
		<td class="cont-line">&nbsp;<?php echo $DESEMPENOADHESIVO; ?></td>
		<td class="cont-line">&nbsp;<?php echo $LAMINADOADHESIVO; ?></td>
		<td class="cont-line">&nbsp;<?php echo $ANCHOLAMINADO;  ?></td>
		<td class="cont-line">&nbsp;<?php echo $FECHAENTREGA; ?></td>
		<td class="cont-line">&nbsp;<?php echo number_format($KILOSLAMINADO, 2, ',', '.'); ?></td>
		<td class="cont-line">&nbsp;<?php echo number_format($METROSLAMINADO, 2, ',', '.'); ?></td>
	</tr>
	<tr <?php echo $complement ?>">
		<td class="cont-line" colspan="7">
		<?php 
			$ordoppcodigo = $rwOP['ordoppcodigo'];
			$tiposoliprog = 2;
			include ('jquery.historeporteopp.php');
		?>
		</td>
	</tr>
</table>
<?php 
}
?>