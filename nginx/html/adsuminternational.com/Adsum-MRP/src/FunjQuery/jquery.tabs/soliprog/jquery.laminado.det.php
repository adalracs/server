<!-- NECESIDAD DE PRODUCCION -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr class="ui-state-default">
		<td class="cont-title">&nbsp;Necesidad de producci&oacute;n</td>
	</tr>
</table>
<?php
$produclam = 1;
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