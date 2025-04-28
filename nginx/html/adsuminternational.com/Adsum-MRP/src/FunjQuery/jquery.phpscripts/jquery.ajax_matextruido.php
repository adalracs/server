<?php 
	
	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerPriNiv/pktblpadreitem.php';
	endif;
	
if($arrtabla1):
	$array_tmp = explode(':|:',$arrtabla1);
	$idcon = fncconn();
	for($a = 0; $a < count($array_tmp); $a++):
		$rwArray_tmp = explode(':-:', $array_tmp[$a]);
		$rwItem = loadrecordpadreitem($rwArray_tmp[1],$idcon);
		
		if($rwArray_tmp[4] == 't'):
			 //objetos de campos personalizado
			
			$objapli_mate = 'apli_mate_'.($a + 1); // aplicacion del material
			$objcolor = 'color_'.($a + 1); // color de material
			$objtratamiento = 'tratamiento_'.($a + 1); // tratamiento
			$objplano_tratado = 'plano_tratado_'.($a + 1); // tratamiento
			$objtrata_min = 'trata_min_'.($a + 1); // tratamiento minimo
			$objtrata_max = 'trata_max_'.($a + 1); // tratamiento maximo
			$objncaras_trata = 'ncaras_trata_'.($a + 1); // numero de caras tratadas
			$objmat_sellable = 'mat_sellable_'.($a + 1); // material sellable
			$objncaras_sellable = 'ncaras_sellable_'.($a + 1); // numero de caras sellables
			$objcofmax_nt = 'cofmax_nt_'.($a + 1); // cofmax_nt
			$objcofmax_tt = 'cofmax_tt_'.($a + 1); // cofmax_tt
			$objhaze = 'haze_'.($a + 1); // haze
			$objtole_haze_ms = 'tole_haze_ms_'.($a + 1); // tolerancia haze por mas
			$objtole_haze_mn = 'tole_haze_mn_'.($a + 1); // tolerancia haze por menos
			$objnote_extruido = 'note_extruido_'.($a + 1); // nota para material extruido
			
			if($tipo_impresion != 'sin_impresion')
				$$objtratamiento = 'si';
				
			if($rwItem['paditepigmen'] == 'f')
				$$objcolor = 'TRANSPARENTE';
							
?>
<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
		<td colspan="4" class="ui-state-default">&nbsp;<b>Sustrato # <?php echo ($a + 1) ?> <?php echo $rwItem['paditenombre'] ?> Calibre <?php echo $rwArray_tmp[3] ?></b></td>
		</tr>
		<tr>
			<td width="22%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD[$objapli_mate]] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb[$objapli_mate] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Aplicaci&oacute;n del Material</td>
			<td width="28%" class="NoiseDataTD">
			<select name="<?php echo $objapli_mate ?>" id="<?php echo $objapli_mate ?>" onchange="eventAplicacion(this.value);";">
				<option value="">--Seleccione--</option>
				<option value="empaque" <?php if($$objapli_mate == 'empaque'){echo 'selected';}?>>Empaque</option>
				<option value="reempaque" <?php if($$objapli_mate == 'reempaque'){echo 'selected';}?>>Reempaque</option>
			</select>
			<td width="22%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD[$objcolor]] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb[$objcolor] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Color</td>
			<td width="28%" class="NoiseDataTD"><input type="text" name="<?php echo $objcolor ?>" id="<?php echo $objcolor ?>" size="15" value="<?php echo $$objcolor ?>" onkeypress="return event.keyCode!=13"/></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['tratamiento']] > 0){echo 'ui-state-error ui-corner-all';}?>"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'block';}else{echo 'none';}?>"><?php if($campnomb[$objtratamiento] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Tratamiento</span></td>
			<td class="NoiseDataTD" colspan="3"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'block';}else{echo 'none';}?>">&nbsp;Si&nbsp;<input type="radio" name="<?php echo $objtratamiento ?>" id="<?php echo $objtratamiento ?>" value="si" onclick="eventOcultaTratamiento(this.value,'<?php echo ($a + 1) ?>');"<?php if($$objtratamiento == 'si'){echo 'checked';}?>/>&nbsp;&nbsp;&nbsp;No&nbsp;<input type="radio" name="<?php echo $objtratamiento ?>" id="<?php echo $objtratamiento ?>" value="no" onclick="eventOcultaTratamiento(this.value,'<?php echo ($a + 1) ?>');" <?php if($$objtratamiento == 'no'){echo 'checked';}?>/></span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'block';}else{echo 'none';}?>"><span id="trata_min_lb_<?php echo ($a + 1) ?>" class="<?php if($arrCampertipproCAL[$arrCampertipproCOD['trata_min']] > 0){echo 'ui-state-error ui-corner-all';}?>" style="display : <?php if($$objtratamiento == 'si'){echo 'block';}else{echo 'none';}?>"><?php if($campnomb[$objtrata_min] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Tratamiento Min. (Dinas)</span></span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'block';}else{echo 'none';}?>"><span id="trata_min_obj_<?php echo ($a + 1) ?>" style="display : <?php if($$objtratamiento == 'si'){echo 'block';}else{echo 'none';}?>"><input type="text" name="<?php echo $objtrata_min ?>" id="<?php echo $objtrata_min ?>" size="15" value="<?php echo $$objtrata_min ?>" <?php if($$objmat_sellable == 'no'){echo 'checked';}?> onkeypress="return event.keyCode!=13"/></span></span></td>
			<td class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'block';}else{echo 'none';}?>"><span id="trata_max_lb_<?php echo ($a + 1) ?>" class="<?php if($arrCampertipproCAL[$arrCampertipproCOD['trata_max']] > 0){echo 'ui-state-error ui-corner-all';}?>" style="display : <?php if($$objtratamiento == 'si'){echo 'block';}else{echo 'none';}?>"><?php if($campnomb[$objtrata_max] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Tratamiento Max. (Dinas)</span></span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'block';}else{echo 'none';}?>"><span id="trata_max_obj_<?php echo ($a + 1) ?>" style="display : <?php if($$objtratamiento == 'si'){echo 'block';}else{echo 'none';}?>"><input type="text" name="<?php echo $objtrata_max ?>" id="<?php echo $objtrata_max ?>" size="15" value="<?php echo $$objtrata_max ?>" onkeypress="return event.keyCode!=13"/></span></span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['mat_sellable']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb[$objmat_sellable] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Material Sellable</td>
			<td class="NoiseDataTD">&nbsp;Si&nbsp;<input type="radio" name="<?php echo $objmat_sellable ?>" id="<?php echo $objmat_sellable ?>" value="si" <?php if($$objmat_sellable == 'si'){echo 'checked';}?> onclick="eventOcultaMaterialsellable(this.value,'<?php echo ($a + 1) ?>');" <?php if($$objmat_sellable == 'si' && $tipitecodigo==6){echo 'checked';}?> />&nbsp;&nbsp;&nbsp;No&nbsp;<input type="radio" name="<?php echo $objmat_sellable ?>" id="<?php echo $objmat_sellable ?>" value="no" onclick="eventOcultaMaterialsellable(this.value,'<?php echo ($a + 1) ?>');" <?php if($$objmat_sellable == 'no'){echo 'checked';}?> /></td>
			<td class="NoiseFooterTD"><span id="ncara_sellable_lb_<?php echo ($a + 1) ?>" class="<?php if($arrCampertipproCAL[$arrCampertipproCOD['ncaras_sellable']] > 0){echo 'ui-state-error ui-corner-all';}?>" style="display : <?php if($$objmat_sellable == 'si' && $tipitecodigo==6){echo 'block';}else{echo 'none';}?>"><?php if($campnomb[$objncaras_sellable] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Nro Caras Sellables</span></td>
			<td class="NoiseDataTD"><span id="ncara_sellable_obj_<?php echo ($a + 1) ?>" style="display : <?php if($$objmat_sellable == 'si'  && $tipitecodigo==6 ){echo 'block';}else{echo 'none';}?>">&nbsp;1&nbsp;<input type="radio" name="<?php echo $objncaras_sellable ?>" id="<?php echo $objncaras_sellable ?>" value="1" <?php if($$objncaras_sellable == '1'){echo 'checked';}?> />&nbsp;&nbsp;&nbsp;2&nbsp;<input type="radio" name="<?php echo $objncaras_sellable ?>" id="<?php echo $objncaras_sellable ?>" value="2" <?php if($$objncaras_sellable == '2'){echo 'checked';}?> /></span></td>
		</tr>
		<?php if($tipitecodigo == 6):?>
		<tr>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['cofmax_nt']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb[$objcofmax_nt] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;<b>COF</b> Cara no tratada max</td>
			<td class="NoiseDataTD"><input type="text" name="<?php echo $objcofmax_nt ?>" id="<?php echo $objcofmax_nt ?>" size="15" value="<?php echo $$objcofmax_nt?>" onkeypress="return event.keyCode!=13"/></td>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['cofmax_tt']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb[$objcofmax_tt] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;<b>COF</b> Cara tratada max</td>
			<td class="NoiseDataTD"><input type="text" name="<?php echo $objcofmax_tt ?>" id="<?php echo $objcofmax_tt ?>" size="15" value="<?php echo $$objcofmax_tt?>" onkeypress="return event.keyCode!=13"/></td>
		</tr>
		<?php endif;?>
<!--		
		<tr>
			<td class="NoiseFooterTD <?php //if($arrCampertipproCAL[$arrCampertipproCOD['haze']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php //if($campnomb[$objhaze] == 1)echo "*"; ?>&nbsp;Opacidad Haze (%)</td>
			<td class="NoiseDataTD"><input type="text" name="<?php //echo $objhaze ?>" id="<?php //echo $objhaze ?>" size="15" value="<?php //echo $$objhaze ?>" onkeypress="return event.keyCode!=13"/></td>
			<td class="NoiseFooterTD <?php //if($arrCampertipproCAL[$arrCampertipproCOD['tole_haze_ms']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php //if($campnomb[$objtole_haze_ms] == 1 || $campnomb[$objtole_haze_mn] == 1)echo "*"; ?>&nbsp;Tolerancia Haze (%)</td>
			<td class="NoiseDataTD">
			<b>+</b>&nbsp;<input type="text" name="<?php //echo $objtole_haze_ms ?>" id="<?php //echo $objtole_haze_ms ?>" size="8" value="<?php //echo $$objtole_haze_ms ?>" onkeypress="return event.keyCode!=13"/>&nbsp;
			<b>-</b>&nbsp;<input type="text" name="<?php //echo $objtole_haze_mn ?>" id="<?php //echo $objtole_haze_mn ?>" size="8" value="<?php //echo $$objtole_haze_mn ?>" onkeypress="return event.keyCode!=13"/>
			</td>
		</tr>
-->
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="4"><?php if($campnomb[$objnote_extruido] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD" colspan="4"><textarea name="<?php echo $objnote_extruido ?>" cols="116" rows="3"><?php echo $$objnote_extruido; ?></textarea></tr>
	</table>
<?php 	
		endif;
	endfor;
endif;