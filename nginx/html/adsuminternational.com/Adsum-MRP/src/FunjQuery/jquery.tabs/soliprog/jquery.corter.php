<!-- NECESIDAD DE PRODUCCION -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr class="ui-state-default">
		<td class="cont-title">&nbsp;Necesidad de producci&oacute;n</td>
	</tr>
</table>
<?php
for($a = 0;$a < count($arrCorteS);$a++)
{
?>
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
	<tr>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb['itedescodigo_crt']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Item</td>
		<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo ($arrCorteS[$a]['itedescodigo'])? $arrCorteS[$a]['itedescodigo'] : '---' ;?>&nbsp;-&nbsp;<?php echo ($arrCorteS[$a]['itedesnombre'])? strtoupper($arrCorteS[$a]['itedesnombre'])  : '---' ;?>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb['itedesancho_crt']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Ancho</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($arrCorteS[$a]['itedesancho'])? number_format($arrCorteS[$a]['itedesancho'], 2, ',', '.')  : '---' ;?>&nbsp;<b>(mm)</b>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb['anchocortes_crt']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Ancho corte</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo  ($arrCorteS[$a]['anchocortes'])? number_format($arrCorteS[$a]['anchocortes'], 2, ',', '.') : '' ; ?>&nbsp;<b>(mm)</b>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb['desperdiciomm_crt']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Desperdicio </td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($arrCorteS[$a]['desperdiciomm'])? number_format($arrCorteS[$a]['desperdiciomm'], 2, ',', '.')  : '---' ;?>&nbsp;<b>(mm)</b>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb['desperdiciokg_crt']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Desperdicio</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo  ($arrCorteS[$a]['desperdiciokg'])? number_format($arrCorteS[$a]['desperdiciokg'], 2, ',', '.') : '' ; ?>&nbsp;<b>(kgs)</b>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb['desperdiciodt_crt']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Destino </td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($arrCorteS[$a]['desperdiciodt'])? strtoupper($arrCorteS[$a]['desperdiciodt']) : '---' ;?>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb['itedescalib_crt']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Calibre&nbsp;<b>(&micro;m)</b>&nbsp;</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($arrCorteS[$a]['itedescalib'])? number_format($arrCorteS[$a]['itedescalib'], 2, ',', '.') : '---' ;?>&nbsp;</td>
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
			<textarea name="ordprodescri_crt" cols="115" rows="3"><?php echo $ordprodescri_crt; ?></textarea>
		</td>
	</tr>
</table>
<!-- FIN OBSERVACIONES -->