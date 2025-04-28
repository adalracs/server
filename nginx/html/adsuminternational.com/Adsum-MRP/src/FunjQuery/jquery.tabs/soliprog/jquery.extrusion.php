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
		$obj_genordeproduccion = 'genordeproduccion_'.$arrMateriales[$a]['paditecodigo'];
		$obj_cantidadkilos = 'cantkilos_'.$arrMateriales[$a]['paditecodigo'];
		$obj_cantidadmetros = 'cantmetros_'.$arrMateriales[$a]['paditecodigo'];
		$objlb_cantidadmetros = 'lbcantmetros_'.$arrMateriales[$a]['paditecodigo'];
		
		if(!$$obj_cantidadkilos)
		 	$$obj_cantidadkilos = round($arrMateriales[$a]['plapadcantkg']* 100) / 100;
		 	
		 if(!$$obj_cantidadmetros)
		 	$$obj_cantidadmetros = ($arrMateriales[$a]['plapadcantkg'] /  ($arrMateriales[$a]['plapadanchoi'] * ($arrMateriales[$a]['plapadcaliba1'] * $arrMateriales[$a]['paditedensid']) ) ) * 1000000;	
?>
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
	<tr>
		<td width="20%" class="NoiseFooterTD" width="20%">&nbsp;Material</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($arrMateriales[$a]['paditenombre'])? $arrMateriales[$a]['paditenombre'] : '---' ; ?>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb['plapadcaliba1_ext']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Calibre</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($arrMateriales[$a]['plapadcaliba1'])? $arrMateriales[$a]['plapadcaliba1'] : '---' ;?>&nbsp;<b>&micro;m</b>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb['plapadcantkg_ext']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Kilogramos</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo  ($arrMateriales[$a]['plapadcantkg'])? number_format($arrMateriales[$a]['plapadcantkg'], 2, ',', '.') : '---' ; ?>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb['plapadcantmt_ext']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Metros</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo  ($arrMateriales[$a]['plapadcantmt'])? number_format($arrMateriales[$a]['plapadcantmt'], 2, ',', '.') : '' ; ?>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb['plapadanchoi_ext']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Ancho planeado&nbsp;<small>(con refile)</small></td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($arrMateriales[$a]['plapadanchoi'])? number_format($arrMateriales[$a]['plapadanchoi'], 2, ',', '.')  : '---' ;?>&nbsp;<b>mm</b>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb['formulnumero_ext']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Formula</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo  ($arrMateriales[$a]['formulnumero'])? $arrMateriales[$a]['formulnumero'] : '---' ; ?>&nbsp;</td>
	</tr>	
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Refile</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($arrMateriales[$a]['plapadrefile'])? number_format($arrMateriales[$a]['plapadrefile'], 2, ',', '.')  : '---' ;?>&nbsp;<b>mm</b>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb[$obj_genordeproduccion]){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Generar op</td>
		<td width="30%" class="NoiseDataTD">&nbsp;
			<select name="<?php echo $obj_genordeproduccion ?>" id="<?php echo $obj_genordeproduccion ?>" >
				<option value="">--Seleccione--</option> 
				<option value="1" <?php if($$obj_genordeproduccion == 1) echo 'selected'; ?> >SI</option> 
				<option value="2" <?php if($$obj_genordeproduccion == 2) echo 'selected'; ?> >NO</option> 
			</select></td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb[$obj_cantidadkilos]){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Kilogramos a extruir</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<input type="text" name="<?php echo $obj_cantidadkilos ?>" id="<?php echo $obj_cantidadkilos ?>" value="<?php echo $$obj_cantidadkilos ?>" size ="15" onkeyup="kilostometros('<?php echo $arrMateriales[$a]['paditecodigo'] ?>','<?php echo $arrMateriales[$a]['paditedensid'] ?>','<?php echo $arrMateriales[$a]['plapadcaliba1'] ?>','<?php echo $arrMateriales[$a]['plapadanchoi'] ?>');" /></td>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb[$obj_cantidadmetros]){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Metros a extruir</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="<?php echo $obj_cantidadmetros ?>" id="<?php echo $obj_cantidadmetros ?>" value="<?php echo $$obj_cantidadmetros ?>" size ="15"/><span id="<?php echo $objlb_cantidadmetros ?>">&nbsp;<?php echo number_format($$obj_cantidadmetros, 2, ',', '.') ?></span></td>
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
<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
	<tr>
		<td class="NoiseFooterTD" width="15%"><?php if($campnomb['materialasig']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Material</td>
		<td class="NoiseDataTD">
			<div class="ui-buttonset">
				<select name="gstmaterial_ext" id="gstmaterial_ext">
					<option value="">--Seleccione--</option>
					<?php
						include('../src/FunGen/floadsoliprog.php');
						floadsoliprogmaterial($arrMateriales,$ges_material);
					?>
				</select>
				<button id="anxmaterial_ext">Gestionar</button>&nbsp;
				<button id="retmaterial_ext">Retirar material</button>&nbsp;
			</div>
		</td>
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
					include '../src/FunjQuery/jquery.visors/jquery.mat_soliextru.php';
				?>
			</div>
			<input type="hidden" name="arrmatsoliextru" id="arrmatsoliextru" size="60"value="<?php echo $arrmatsoliextru ?>" />
			<input type="hidden" name="arrmatsoliextrutmp" id="arrmatsoliextrutmp" size="60"value="<?php echo $arrmatsoliextrutmp ?>" />
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
		<td class="NoiseFooterTD" width="15%">&nbsp;Material</td>
		<td class="NoiseDataTD">
			<div class="ui-buttonset">
				<select name="trtmaterial_ext" id="trtmaterial_ext">
					<option value="">--Seleccione--</option>
					<?php
						$idcon = fncconn();
						floadsoliprogmaterialtarea($arrmatsoliextru,$ges_material,$idcon);
						fncclose($idcon);
					?>
				</select>
				<button id="anxtarea_ext">Generar tarea</button>&nbsp;
				<button id="rettarea_ext">Retirar tarea</button>&nbsp;
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<div id="gestion_tarea">
				<?php
					$noAjax = true;
					include '../src/FunjQuery/jquery.visors/jquery.tar_soliextru.php';
				?>
			</div>
			<input type="hidden" name="arrtarsoliextru" id="arrtarsoliextru" size="60"value="<?php echo $arrtarsoliextru ?>" />
			<input type="hidden" name="arrtarsoliextrutmp" id="arrtarsoliextrutmp" size="60"value="<?php echo $arrtarsoliextrutmp ?>" />
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
		<td>
			<textarea name="ordprodescri_ext" cols="115" rows="3"><?php echo $ordprodescri_ext; ?></textarea>
		</td>
	</tr>
</table>
<!-- FIN OBSERVACIONES -->