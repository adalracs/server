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
		$ancholam = $arrMateriales[$a]['plapadanchoi'];
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
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo  ($arrMateriales[$a]['plapadrefile'])? number_format($arrMateriales[$a]['plapadrefile'], 2, ',', '.') : '' ; ?>&nbsp;<b>mm</b>&nbsp;</td>
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
		<td>
			<textarea name="ordprodescri_flx" cols="115" rows="3"><?php echo $ordprodescri_flx; ?></textarea>
		</td>
	</tr>
</table>
<!-- FIN OBSERVACIONES -->