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
<!-- FIN NECESIDAD DE PRODUCCION -->
<!-- MATERIALES Y SUS GESTIONES -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr>
		<td colspan="3" class="ui-state-default">&nbsp;Gestion de la producci&oacute;n</td>
	</tr>
</table>
<!-- FIN MATERIALES Y SUS GESTIONES -->
<!-- GESTION DE MATERIALES -->
<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
	<tr>
		<td colspan="3" class="ui-state-default">&nbsp;<?php if ($campnomb["arrmatsoliextru"] == 1) {echo "<b style='font-size:15px; color:red;'>*</b>";}?>Materiales Asignados</td>
	</tr>
</table>
<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
	<tr>
		<td>
			<div id="gestion_materiales">
				<?php
					$noAjax = true;
					$flagdetallar = 1;
					include '../src/FunjQuery/jquery.visors/jquery.mat_soliextru.php';
				?>
			</div>
		</td>
	</tr>
</table>
<!-- FIN GESTION DE MATERIALES -->
<!-- GESTION DE TAREAS A PROGRAMAR A LOS MATERIALES -->
<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
	<tr>
		<td colspan="3" class="ui-state-default">&nbsp;Tareas</td>
	</tr>
</table>
<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
	<tr>
		<td colspan="2">
			<div id="gestion_tarea">
				<?php
					$noAjax = true;
					$flagdetallar = 1;
					include '../src/FunjQuery/jquery.visors/jquery.tar_soliextru.php';
				?>
			</div>
		</td>
	</tr>
</table>
<!-- FIN GESTION DE TAREAS A PROGRAMAR A LOS MATERIALES -->
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