<?php
	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerPriNiv/pktblpadreitem.php';
	endif;
	
if($arrtabla1)
{
	$array_tmp = explode(':|:',$arrtabla1);
	$idcon = fncconn();
	for($a = 0; $a < count($array_tmp); $a++)
	{
		$rwArray_tmp = explode(':-:', $array_tmp[$a]);
		$rwItem = loadrecordpadreitem($rwArray_tmp[1],$idcon);
		
		if($rwArray_tmp[4] == 't')
		{
			 //objetos de campos personalizado
			
			$objapli_mate = 'apli_mate_'.($a + 1); // aplicacion del material
			$objcolor = 'color_'.($a + 1); // color de material
			$objtratamiento = 'tratamiento_'.($a + 1); // tratamiento
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
			$objcore = 'core_'.($a + 1); // core
			$objtemp_sellado= 'temp_sellado_'.($a + 1); // temperatura de sellado
			$objfuerza_sellado= 'fuerza_sellado_'.($a + 1); // fuerza de sellado
			$objr_soplado= 'r_soplado_'.($a + 1); // relacion de soplasdo
			$objbrillo= 'brillo_'.($a + 1); // brillo
			$objclaridad= 'claridad_'.($a + 1); // claridad
			$objtransmitancia = 'transmitancia_'.($a + 1); // transmitancia
			$objtipo= 'tipo_'.($a + 1); // tipo
			$objplano_tratado= 'plano_tratado_'.($a + 1); // plano_tratado
			$objdardo= 'dardo_'.($a + 1); // prueba al dardo
			$objrasgado_md= 'rasgado_md_'.($a + 1); // rasgado_md
			$objrasgado_td= 'rasgado_td_'.($a + 1); // rasgado_td
			$objelongacion_md= 'elongacion_md_'.($a + 1); // elongacion_md
			$objelongacion_td= 'elongacion_td_'.($a + 1); // elongacion_td
			$objruptura_td= 'ruptura_td_'.($a + 1); // ruptura_td
			$objruptura_md= 'ruptura_md_'.($a + 1); // ruptura_md_
			
			
			$objformul_cod = 'formulcodigo_'.($a + 1); // formulacion codigo
			$objformul_num = 'formulnumero_'.($a + 1); // formiulacion numero
			$objbutton = 'formulbutton_'.($a + 1); // boton de formiulacion 
				
			if($rwItem['paditepigmen'] == 'f')
				$$objcolor = 'TRANSPARENTE';
							
?>
<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
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
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD[$objtratamiento]] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb[$objtratamiento] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Tratamiento</td>
			<td class="NoiseDataTD">&nbsp;
				<select name="<?php echo $objtratamiento ?>" id="<?php echo $objtratamiento ?>" onchange="eventOcultaTratamiento(this.value,'<?php echo ($a + 1) ?>');">
					<option value="">-- Seleccione --</option>
					<option value="interno"<?php if($$objtratamiento == 'interno') echo ' selected' ?>>Interno</option>
					<option value="externo"<?php if($$objtratamiento == 'externo') echo ' selected' ?>>Externo</option>
					<option value="na"<?php if($$objtratamiento == '152.4mm') echo ' selected' ?>>N/A</option>
				</select>
			</td>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD[$objcore]] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb[$objcore] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Core&nbsp;</td>
			<td class="NoiseDataTD">
				<select name="<?php echo $objcore ?>" id="<?php echo $objcore ?>">
					<option value="">-- Seleccione --</option>
					<option value="50.8mm"<?php if($$objcore == '50.8mm') echo ' selected' ?>>50.8 mm</option>
					<option value="76.2mm"<?php if($$objcore == '76.2mm') echo ' selected' ?>>76.2 mm</option>
					<option value="152.4mm"<?php if($$objcore == '152.4mm') echo ' selected' ?>>152.4 mm</option>
				</select>
			</td>
		</tr>
			<tr>
			<td class="NoiseFooterTD"><?php if($campnomb[$objformul_cod] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Formulacion</td>
			<td class="NoiseDataTD" colspan="3">
				<div class="ui-buttonset" align="left">
					
					<input type="hidden" name="<?php echo $objformul_cod ?>" id="<?php echo $objformul_cod ?>" value="<?php echo $$objformul_cod ?>" />
					<input type="text" name="<?php echo $objformul_num ?>" id="<?php echo $objformul_num ?>" value="<?php echo $$objformul_num ?>" size="15" onkeyup="autoformulacion(<?php echo ($a + 1) ?>);" />
					
					&nbsp;&nbsp;<button id="formulbutton_<?php echo ($a + 1) ?>" onclick="openFormulacion('<?php echo ($a + 1) ?>');">Detallar Formulacion</button>
				
				</div>
			</td>
		</tr>
		<tr>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD[$objtrata_min]] > 0){echo 'ui-state-error ui-corner-all';}?>"><span id="trata_min_lb_<?php echo ($a + 1) ?>" class="" style="display : <?php if($$objtratamiento == 'si'){echo 'block';}else{echo 'none';}?>"><?php if($campnomb[$objtrata_min] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Tratamiento Min. (Dinas)</span></td>
			<td class="NoiseDataTD"><span id="trata_min_obj_<?php echo ($a + 1) ?>" style="display : <?php if($$objtratamiento == 'si'){echo 'block';}else{echo 'none';}?>"><input type="text" name="<?php echo $objtrata_min ?>" id="<?php echo $objtrata_min ?>" size="15" value="<?php echo $$objtrata_min ?>" <?php if($$objmat_sellable == 'no'){echo 'checked';}?> onkeypress="return event.keyCode!=13"/></span></td>
			<td class="NoiseFooterTD class="<?php if($arrCampertipproCAL[$arrCampertipproCOD[$objtrata_max]] > 0){echo 'ui-state-error ui-corner-all';}?>"><span id="trata_max_lb_<?php echo ($a + 1) ?>" style="display : <?php if($$objtratamiento == 'si'){echo 'block';}else{echo 'none';}?>"><?php if($campnomb[$objtrata_max] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Tratamiento Max. (Dinas)</span></td>
			<td class="NoiseDataTD"><span id="trata_max_obj_<?php echo ($a + 1) ?>" style="display : <?php if($$objtratamiento == 'si'){echo 'block';}else{echo 'none';}?>"><input type="text" name="<?php echo $objtrata_max ?>" id="<?php echo $objtrata_max ?>" size="15" value="<?php echo $$objtrata_max ?>" onkeypress="return event.keyCode!=13"/></span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD[$objcofmax_nt]] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb[$objcofmax_nt] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;<b>COF</b> Cara no tratada max</td>
			<td class="NoiseDataTD"><input type="text" name="<?php echo $objcofmax_nt ?>" id="<?php echo $objcofmax_nt ?>" size="15" value="<?php echo $$objcofmax_nt?>" onkeypress="return event.keyCode!=13"/></td>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD[$objcofmax_tt]] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb[$objcofmax_tt] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;<b>COF</b> Cara tratada max</td>
			<td class="NoiseDataTD"><input type="text" name="<?php echo $objcofmax_tt ?>" id="<?php echo $objcofmax_tt ?>" size="15" value="<?php echo $$objcofmax_tt?>" onkeypress="return event.keyCode!=13"/></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD[$objncaras_trata]] > 0){echo 'ui-state-error ui-corner-all';}?>"><span id="ncaras_trata_lb_<?php echo ($a + 1) ?>" style="display : <?php if($$objtratamiento == 'si'){echo 'block';}else{echo 'none';}?>"><?php if($campnomb[$objncaras_trata] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;#n caras tratadas</span></td>
			<td class="NoiseDataTD"><span id="ncaras_trata_obj_<?php echo ($a + 1) ?>" style="display : <?php if($$objtratamiento == 'si'){echo 'block';}else{echo 'none';}?>"><input type="text" name="<?php echo $objncaras_trata ?>" id="<?php echo $objncaras_trata ?>" size="7" value="<?php echo $$objncaras_trata ?>" onkeypress="return event.keyCode!=13"/></span></td>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD[$objplano_tratado]] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb[$objplano_tratado] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Plano tratado</td>
			<td class="NoiseDataTD">&nbsp;Si&nbsp;<input type="radio" name="<?php echo $objplano_tratado ?>" id="<?php echo $objplano_tratado ?>" value="si" <?php if($$objplano_tratado == 'si'){echo 'checked';}?>/>&nbsp;&nbsp;&nbsp;No&nbsp;<input type="radio" name="<?php echo $objplano_tratado ?>" id="<?php echo $objplano_tratado ?>" value="no" <?php if($$objplano_tratado == 'no'){echo 'checked';}?>/></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD[$objmat_sellable]] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb[$objmat_sellable] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Material Sellable</td>
			<td class="NoiseDataTD">&nbsp;Si&nbsp;<input type="radio" name="<?php echo $objmat_sellable ?>" id="<?php echo $objmat_sellable ?>" value="si" <?php if($$objmat_sellable == 'si'){echo 'checked';}?> onclick="eventOcultaMaterialsellable(this.value,'<?php echo ($a + 1) ?>');" <?php if($$objmat_sellable == 'si' && $tipitecodigo==6){echo 'checked';}?> />&nbsp;&nbsp;&nbsp;No&nbsp;<input type="radio" name="<?php echo $objmat_sellable ?>" id="<?php echo $objmat_sellable ?>" value="no" onclick="eventOcultaMaterialsellable(this.value,'<?php echo ($a + 1) ?>');" <?php if($$objmat_sellable == 'no'){echo 'checked';}?> /></td>
			<td class="NoiseFooterTD"><span id="ncara_sellable_lb_<?php echo ($a + 1) ?>" class="<?php if($arrCampertipproCAL[$arrCampertipproCOD['ncaras_sellable']] > 0){echo 'ui-state-error ui-corner-all';}?>" style="display : <?php if($$objmat_sellable == 'si'){echo 'block';}else{echo 'none';}?>"><?php if($campnomb[$objncaras_sellable] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Nro Caras Sellables</span></td>
			<td class="NoiseDataTD"><span id="ncara_sellable_obj_<?php echo ($a + 1) ?>" style="display : <?php if($$objmat_sellable == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;1&nbsp;<input type="radio" name="<?php echo $objncaras_sellable ?>" id="<?php echo $objncaras_sellable ?>" value="1" <?php if($$objncaras_sellable == '1'){echo 'checked';}?> />&nbsp;&nbsp;&nbsp;2&nbsp;<input type="radio" name="<?php echo $objncaras_sellable ?>" id="<?php echo $objncaras_sellable ?>" value="2" <?php if($$objncaras_sellable == '2'){echo 'checked';}?> /></span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD[$objtemp_sellado]] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb[$objtemp_sellado] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Temperatura de sellado&nbsp;<b>C</b></td>
			<td class="NoiseDataTD"><input type="text" name="<?php echo $objtemp_sellado ?>" id="<?php echo $objtemp_sellado ?>" size="15" value="<?php echo $$objtemp_sellado?>" onkeypress="return event.keyCode!=13"/></td>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD[$objfuerza_sellado]] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb[$objfuerza_sellado] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Fuerza de sellado&nbsp;<b>gf/pul</b></td>
			<td class="NoiseDataTD"><input type="text" name="<?php echo $objfuerza_sellado ?>" id="<?php echo $objfuerza_sellado ?>" size="15" value="<?php echo $$objfuerza_sellado?>" onkeypress="return event.keyCode!=13"/></td>
		</tr>
		<tr>
			
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD[$objbrillo]] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb[$objbrillo] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Brillo&nbsp;<b>%</b></td>
			<td class="NoiseDataTD"><input type="text" name="<?php echo $objbrillo ?>" id="<?php echo $objbrillo ?>" size="15" value="<?php echo $$objbrillo?>" onkeypress="return event.keyCode!=13"/></td>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD[$objclaridad]] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb[$objclaridad] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Claridad&nbsp;<b>%</b></td>
			<td class="NoiseDataTD"><input type="text" name="<?php echo $objclaridad ?>" id="<?php echo $objclaridad ?>" size="15" value="<?php echo $$objclaridad?>" onkeypress="return event.keyCode!=13"/></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD[$objtransmitancia]] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb[$objtransmitancia] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Transmitancia&nbsp;<b>%</b></td>
			<td class="NoiseDataTD"><input type="text" name="<?php echo $objtransmitancia ?>" id="<?php echo $objtransmitancia ?>" size="15" value="<?php echo $$objtransmitancia?>" onkeypress="return event.keyCode!=13"/></td>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD[$objtipo]] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb[$objtipo] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Tipo</td>
			<td class="NoiseDataTD">
				<select name="<?php echo $objtipo?>" id="<?php echo $objtipo ?>"> 
					<option value="">--Seleccione--</option>
					<option value="lamina" <?php if($$objtipo == 'lamina'){echo 'selected';}?> >Lamina</option>
					<option value="tobular" <?php if($$objtipo == 'tobular'){echo 'selected';}?> >Tobular</option>
					<option value="semi_tobular" <?php if($$objtipo == 'semi_tobular'){echo 'selected';}?> >Semi-Tobular</option>
				</select>
			</td>
		</tr>
		<tr>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD[$objdardo]] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb[$objdardo] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Prueba al dardo&nbsp;<b>g</b></td>
			<td class="NoiseDataTD"><input type="text" name="<?php echo $objdardo ?>" id="<?php echo $objdardo ?>" size="15" value="<?php echo $$objdardo?>" onkeypress="return event.keyCode!=13"/></td>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD[$objr_soplado]] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb[$objr_soplado] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Relacion de soplado</td>
			<td class="NoiseDataTD"><input type="text" name="<?php echo $objr_soplado ?>" id="<?php echo $objr_soplado ?>" size="15" value="<?php echo $$objr_soplado?>" onkeypress="return event.keyCode!=13"/></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD[$objrasgado_md]] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb[$objrasgado_md] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Rasgado MD&nbsp;<b>g</b></td>
			<td class="NoiseDataTD"><input type="text" name="<?php echo $objrasgado_md ?>" id="<?php echo $objrasgado_md ?>" size="15" value="<?php echo $$objrasgado_md?>" onkeypress="return event.keyCode!=13"/></td>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD[$objrasgado_td]] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb[$objrasgado_td] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Rasgado TD&nbsp;<b>g</b></td>
			<td class="NoiseDataTD"><input type="text" name="<?php echo $objrasgado_td ?>" id="<?php echo $objrasgado_td ?>" size="15" value="<?php echo $$objrasgado_td?>" onkeypress="return event.keyCode!=13"/></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD[$objelongacion_md]] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb[$objelongacion_md] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Elongacion MD&nbsp;<b>%</b></td>
			<td class="NoiseDataTD"><input type="text" name="<?php echo $objelongacion_md ?>" id="<?php echo $objelongacion_md ?>" size="15" value="<?php echo $$objelongacion_md?>" onkeypress="return event.keyCode!=13"/></td>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD[$objelongacion_td]] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb[$objelongacion_td] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Elongacion TD&nbsp;<b>%</b></td>
			<td class="NoiseDataTD"><input type="text" name="<?php echo $objelongacion_td ?>" id="<?php echo $objelongacion_td ?>" size="15" value="<?php echo $$objelongacion_td?>" onkeypress="return event.keyCode!=13"/></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD[$objruptura_md]] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb[$objruptura_md] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Ruptura MD&nbsp;<b>N/mm^2</b></td>
			<td class="NoiseDataTD"><input type="text" name="<?php echo $objruptura_md ?>" id="<?php echo $objruptura_md ?>" size="15" value="<?php echo $$objruptura_md?>" onkeypress="return event.keyCode!=13"/></td>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD[$objruptura_td]] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb[$objruptura_td] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Ruptura TD&nbsp;<b>N/mm^2</b></td>
			<td class="NoiseDataTD"><input type="text" name="<?php echo $objruptura_td ?>" id="<?php echo $objruptura_td ?>" size="15" value="<?php echo $$objruptura_td?>" onkeypress="return event.keyCode!=13"/></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD[$objhaze]] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb[$objhaze] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Haze&nbsp;<b>%</b></td>
			<td class="NoiseDataTD"><input type="text" name="<?php echo $objhaze ?>" id="<?php echo $objhaze ?>" size="15" value="<?php echo $$objhaze?>" onkeypress="return event.keyCode!=13"/></td>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD[$objtole_haze_ms]] > 0 || $arrCampertipproCAL[$arrCampertipproCOD[$objtole_haze_mn]] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb[$objtole_haze_ms] == 1 || $campnomb[$objtole_haze_mn] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Tolerancia Haze&nbsp;<b>%</b></td>
			<td class="NoiseDataTD">
				<b>+</b>&nbsp;<input type="text" name="<?php echo $objtole_haze_ms ?>" id="<?php echo $objtole_haze_ms ?>" value="<?php echo $$objtole_haze_ms ?>" size="7" />
				<b>-</b>&nbsp;<input type="text" name="<?php echo $objtole_haze_mn ?>" id="<?php echo $objtole_haze_mn ?>" value="<?php echo $$objtole_haze_mn ?>" size="7" />
			</td>
		</tr>
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="4"><?php if($campnomb[$objnote_extruido] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD" colspan="4"><textarea name="<?php echo $objnote_extruido ?>" cols="116" rows="3"><?php echo $$objnote_extruido; ?></textarea></tr>
	</table>
	<script type="text/javascript">
			$('#formulbutton_<?php echo ($a + 1) ?>').button({ icons: { primary: "ui-icon-script" }, text: false }).click(function() {
				return false;
			});
	</script>
<?php 	
		}
	}
}