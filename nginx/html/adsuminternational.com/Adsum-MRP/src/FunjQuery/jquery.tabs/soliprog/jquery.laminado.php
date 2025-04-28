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
		$obj_ancholam = 'anchlam2_'.$arrMateriales[$a]['paditecodigo'];
		$$obj_ancholam = ($$obj_ancholam)? $$obj_ancholam : $ancholam ;
?>
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
	<tr>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb['laminado_lmn']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Laminado&nbsp;</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($arrMateriales[$a]['laminado'])? $arrMateriales[$a]['laminado'] : '---' ; ?>&nbsp;</td>	
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb['plapaddesem_lmn']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Desempe&ntilde;o&nbsp;</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($arrMateriales[$a]['plapaddesem'])? $arrMateriales[$a]['plapaddesem'] : '---' ;?>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb['plapadtipo_lmn']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Tipo&nbsp;</td>
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
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb['plapadcaliba1_lmn']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Calibre</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($arrMateriales[$b]['plapadcaliba1'])? $arrMateriales[$b]['plapadcaliba1'] : '---' ;?>&nbsp;<b>&micro;m</b>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb['plapadcantkg_lmn']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Kilogramos</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo  ($arrMateriales[$b]['plapadcantkg'])? number_format($arrMateriales[$b]['plapadcantkg'], 2, ',', '.') : '---' ; ?>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb['plapadcantmt_lmn']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Metros</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo  ($arrMateriales[$b]['plapadcantmt'])? number_format($arrMateriales[$b]['plapadcantmt'], 2, ',', '.') : '' ; ?>&nbsp;</td>
	</tr>
	<?php 
			}
			if($objbreak > 0)
				break;
		}
		$produclam++;
	?>
	<tr>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb['plapadanchoi_lmn']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Ancho M.T&nbsp;<small>(con refile)</small></td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($arrMateriales[$a]['plapadanchoi'])? number_format($arrMateriales[$a]['plapadanchoi'], 2, ',', '.')  : '---' ;?>&nbsp;<b>mm</b>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb[$obj_ancholam]){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Ancho P.R&nbsp;<small>(con refile)</small></td>
		<td width="30%" class="NoiseDataTD">&nbsp;<input type="text" name="<?php echo $obj_ancholam; ?>" id="<?php echo $obj_ancholam; ?>" value="<?php echo $$obj_ancholam; ?>" size ="15" />&nbsp;<b>mm</b>&nbsp;</td>
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
			<textarea name="ordprodescri_lmn" cols="115" rows="3"><?php echo $ordprodescri_lmn; ?></textarea>
		</td>
	</tr>
</table>
<!-- FIN OBSERVACIONES -->