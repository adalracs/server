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
		<td width="20%" class="NoiseFooterTD"><?php if($arrMateriales[$a]['plapadcalib_']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Calibre</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($arrMateriales[$a]['plapadcalib'])? $arrMateriales[$a]['plapadcalib'] : '---' ;?>&nbsp;<b>&micro;m</b>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD"><?php if($arrMateriales[$a]['plapadanchoi_']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Ancho planeado</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($arrMateriales[$a]['plapadanchoi'])? number_format($arrMateriales[$a]['plapadanchoi'], 2, ',', '.')  : '---' ;?>&nbsp;<b>mm</b>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD"><?php if($arrMateriales[$a]['plapadcantkg_']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Kilogramos</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo  ($cantplanea_kgs)? number_format($cantplanea_kgs, 2, ',', '.') : '---' ; ?>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD"><?php if($arrMateriales[$a]['plapadcantmt_']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Metros</td>
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
		<td>
			<textarea name="ordprodescri_pch" cols="115" rows="3"><?php echo $ordprodescri_pch; ?></textarea>
		</td>
	</tr>
</table>
<!-- FIN OBSERVACIONES -->