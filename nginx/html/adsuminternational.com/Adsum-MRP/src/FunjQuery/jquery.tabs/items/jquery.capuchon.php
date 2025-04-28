<!-- PESTAÑA 2 ESPECIFICACIONES DEL PRODUCTO -->
<div id="opt-tab2">

	<div id="cantidad_seccion">
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content"> 	
			<?php if($tipevecodigo != 4): ?>
	  		<tr>
	  			<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['cant']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if ($campnomb["cant"] == 1) { $cant = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Cant. solicitada</td>
	  			<td width="30%" class="NoiseDataTD"><input type="hidden" name="cant" id="cant" value="<?php echo $cant?>" /><span id="cant_lb"><?php if(!$flagnuevoproducto){echo ($cant)? $cant : '[NINGUNO]' ;}else{echo ($cant)? $cant : '[NINGUNO]' ;}?></span></td>
	  			<td width="20%" class="NoiseFooterTD"><?php if ($campnomb["propedcaninv"] == 1) { $propedcaninv = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Cant. inventario</td>
	  			<td width="30%" class="NoiseDataTD"><input type="hidden" name="propedcaninv" id="propedcaninv" value="<?php  echo $propedcaninv ?>" /><span id="propedcaninv_lb"><?php if(!$flagnuevoproducto){echo ($propedcaninv)? $propedcaninv : '[NINGUNO]';}else{echo ($propedcaninv)? $propedcaninv : '[NINGUNO]' ;}?></span></td>
	  		</tr>
	  		<tr>
	  			<td width="20%" class="NoiseFooterTD"><?php if ($campnomb["propedcanpro"] == 1) { $propedcanpro = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Cant. a producir</td>
	  			<td width="30%" class="NoiseDataTD"><input type="hidden" name="propedcanpro" id="propedcanpro" value="<?php echo $propedcanpro?>" /><span id="propedcanpro_lb"><?php if(!$flagnuevoproducto){echo ($propedcanpro)? $propedcanpro : '[NINGUNO]' ;}else{echo ($propedcanpro)? $propedcanpro : '[NINGUNO]' ;}?></span></td>
	  			<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['unimedi']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if ($campnomb["unimedi"] == 1) { $unimedcodigo = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Uni. medida</td>
	  			<td width="30%" class="NoiseDataTD"><input type="hidden" name="unimedi" id="unimedi" value="<?php  echo $unimedi ?>" /><span id="unimedi_lb"><?php if(!$flagnuevoproducto){echo ($unimedi)? $unimedi : '[NINGUNO]';}else{echo ($unimedi)? $unimedi : '[NINGUNO]' ;}?></span></td>
	  		</tr>
	  		<?php else: ?>
	  		<tr>
	  		<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['cant']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if ($campnomb["cant"] == 1) { $cant = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Cant. solicitada</td>
	  		<td width="30%" class="NoiseDataTD"><input type="text" id="cant" name="cant" onchange="eventDisabledTolerancia('cant');" value="<?php echo $cant ?>"  onkeypress="return event.keyCode!=13"/></td>
	  		<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['unimedi']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if ($campnomb["unimedi"] == 1) { $unimedi = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Un. medida</td>
	  		<td width="30%" class="NoiseDataTD"><select name="unimedi" id="unimedi" onchange="">
	  			<option value="">-- Seleccione --</option>
	  			<option value="MIL"<?php if($unimedi == 'MIL') echo ' selected' ?>>Millares</option>
	  			<option value="UND"<?php if($unimedi == 'UND') echo ' selected' ?>>Unidades</option>
	  			<option value="KGS"<?php if($unimedi == 'KGS') echo ' selected' ?>>Kilogramos</option>
	  		</select></td>
	  		</tr>
	  		<?php endif ?>
		<tr> 
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['tole_cant_ms']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if ($campnomb["tole_cant_ms"] == 1 || $campnomb["tole_cant_mn"] == 1) { $tole_cant_ms = null;$tole_cant_mn = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Tolerancia cantidad (%) </td> 
			<td class="NoiseDataTD">
				<b>+</b>&nbsp;<input type="text" name="tole_cant_ms" id="tole_cant_ms"	value="<?php echo $tole_cant_ms; ?>" <?php if($cantidad_solicitada == '0') echo ' disabled ' ?> size="10" onkeypress="return event.keyCode!=13"/>
				<b>-</b>&nbsp;<input type="text" name="tole_cant_mn" id="tole_cant_mn"	value="<?php echo $tole_cant_mn; ?>" <?php if($cantidad_solicitada == '0') echo ' disabled ' ?> size="10" onkeypress="return event.keyCode!=13"/>
	  		</td>
	  		<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['tipo_estruc']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if ($campnomb["tipo_estruc"] == 1) { $tipo_estruc = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Tipo de capuchon</td>
	  		<td class="NoiseDataTD"><select name="tipo_estruc" id="tipo_estruc" onchange="eventEstructura(this.value);">
	  				<option value="">-- Seleccione --</option>
	  				<option value="sencillo"<?php if($tipo_estruc == 'sencillo') echo ' selected' ?>>Sencillo</option>
	  				<option value="compuesto"<?php if($tipo_estruc == 'compuesto') echo ' selected' ?>>Compuesto</option>
	  		</select></td>
	  	</tr>
	</table>
	</div>

	<div id="item_sessionc">
	  	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr> 
				<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['tipo_impresion']] > 0){echo 'ui-state-error ui-corner-all';}?>" width="20%"><?php if ($campnomb["tipo_impresion"] == 1) { $tipo_impresion = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Tipo de impresi&oacute;n</td>
	  			<td class="NoiseDataTD"><select name="tipo_impresion" id="tipo_impresion" onchange="eventTipoimpresion(this.value);">
	  				<option value="">-- Seleccione --</option>
	  				<option value="interna"<?php if($tipo_impresion == 'interna') echo ' selected' ?>>Interna</option>
	  				<option value="externa"<?php if($tipo_impresion == 'externa') echo ' selected' ?>>Externa</option>
	  				<option value="sin_impresion"<?php if($tipo_impresion == 'sin_impresion') echo ' selected' ?>>Sin Impresi&oacute;n</option>
	  			</select></td> 
			</tr>
		</table>
	</div>
	<div id="item_sessiond" style="display: <?php if($tipo_impresion == 'sin_impresion') echo 'none'; else echo 'block' ?>;">
		<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
	  		<tr>
	  			<td width="50%" valign="top">
		  			<table width="100%" border="0" cellspacing="1" cellpadding="0" align="left" class="ui-widget-content"> 	
						<tr>
		  					<td width="40%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['list_colors']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if ($campnomb["list_colors"] == 1) { $list_colors = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Listado de colores</td>
		  					<td width="60%" class="NoiseDataTD"><input type="text" name="l_color" id="l_color" size="28" onkeypress="return event.keyCode!=13"/><input type="hidden" name="ncolor" id="ncolor" value="<?php echo $ncolor; ?>"/><b>#</b>&nbsp;<span id="nrocolors"><?php echo ($ncolor > 0)? $ncolor : 0;?></span></td>
		  				</tr>
						<tr>
		  					<td colspan="2" class="NoiseDataTD">
		  						<div class="ui-buttonset" align="right">
									<button id="ingresarcolor">Agregar</button>&nbsp;&nbsp;
		            				<button id="quitarcolor">Quitar</button>
								</div>
		  					</td>
		  				</tr>
						<tr>
		  					<td colspan="2" class="NoiseDataTD">
		  						<div id="filtrlistacolores"><?php include '../src/FunjQuery/jquery.visors/jquery.listacolores.php'; ?></div>
								<input type="hidden" name="list_colors" id="list_colors" value="<?php echo $list_colors; ?>">
		  					</td>
		  				</tr>
					</table>
	  			</td>
	  			<td width="50%" valign="top" class="NoiseDataTD">
	  				<div id="item_sessiond1" style="display: <?php if(($tipo_impresion == 'interna' || $tipo_impresion == 'externa')  && $tipevecodigo == 4 ) echo 'none'; else echo 'block' ?>;">
						<table width="100%" border="0" cellspacing="1" cellpadding="0" align="right" class="ui-widget-content">
							<tr><td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['producto_avaliable']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if ($campnomb["producto_avaliable"] == 1) { $producto_avaliable = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Productos aprobados por<br/>
								<div id="productos_aprobados_por" >
									<input type="radio" name="producto_avaliable" id="producto_avaliable1" value="comercial" <?php if($producto_avaliable == 'comercial'){echo 'checked';}?> /><label for="producto_avaliable1">Comercial</label>
									<input type="radio" name="producto_avaliable" id="producto_avaliable2" value="cliente" <?php if($producto_avaliable == 'cliente'){echo 'checked';}?> /><label for="producto_avaliable2">Cliente</label>
									<input type="radio" name="producto_avaliable" id="producto_avaliable3" value="calidad" <?php if($producto_avaliable == 'calidad'){echo 'checked';}?> /><label for="producto_avaliable3">Calidad</label>
									<input type="radio" name="producto_avaliable" id="producto_avaliable4" value="calidad_comercial" <?php if($producto_avaliable == 'calidad_comercial'){echo 'checked';}?> /><label for="producto_avaliable4">Calidad/Comercial</label>
								</div>
							</td></tr>
						</table>		  				
					</div>
					<table width="100%" border="0" cellspacing="1" cellpadding="0" align="right" class="ui-widget-content"> 	
						<tr><td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['pantone']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if ($campnomb["colors_avaliable"] == 1) { $colors_avaliable = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Colores aprobados<br/>
							<div id="colores_aprobados" >
								<input type="checkbox" name="pantone" id="pantone" value="1"<?php if($pantone) echo ' checked' ?>><label for="pantone">Pantone</label>
								<input type="checkbox" name="muestra" id="muestra" value="1"<?php if($muestra) echo ' checked' ?>><label for="muestra">Muestra</label>
								<input type="checkbox" name="estandar_color" id="estandar_color" value="1"<?php if($estandar_color) echo ' checked' ?>><label for="estandar_color">Estandar color</label>
								<input type="checkbox" name="prueba_color" id="prueba_color" value="1"<?php if($prueba_color) echo ' checked' ?>><label for="prueba_color">Prueba color</label>
							</div>
						</td></tr>
					</table>
		  		</td>
		  	</tr>
		  	<tr><td class="ui-state-default" colspan="2"></td></tr>
		  	<tr>
		  		<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['tnt_calor']] > 0){echo 'ui-state-error ui-corner-all';}?>" colspan="2">
		  			<?php if ($campnomb["tinta_avaliable"] == 1) { $tinta_avaliable = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Tintas resistentes a:&nbsp;&nbsp;
		  			<div id="tintas_resistentes_a">
		  				<input type="checkbox" name="tnt_calor" id="tnt_calor" value="1" <?php if($tnt_calor){echo 'checked';}?>><label for="tnt_calor">Calor</label>
		  				<input type="checkbox" name="tnt_luz" id="tnt_luz" value="1" <?php if($tnt_luz){echo 'checked';}?>><label for="tnt_luz">Luz</label>
		  				<input type="checkbox" name="tnt_acidos" id="tnt_acidos" value="1" <?php if($tnt_acidos){echo 'checked';}?>><label for="tnt_acidos">Acidos</label>
		  				<input type="checkbox" name="tnt_alcalis" id="tnt_alcalis" value="1" <?php if($tnt_alcalis){echo 'checked';}?>><label for="tnt_alcalis">Alcalis</label>
		  				<input type="checkbox" name="tnt_agua" id="tnt_agua" value="1" <?php if($tnt_agua){echo 'checked';}?>><label for="tnt_agua">Agua</label>
		  				<input type="checkbox" name="tnt_grasas" id="tnt_grasas" value="1" <?php if($tnt_grasas){echo 'checked';}?>><label for="tnt_grasas">Grasas</label>
		  				<input type="checkbox" name="tnt_brillo" id="tnt_brillo" value="1" <?php if($tnt_brillo){echo 'checked';}?>><label for="tnt_brillo">Brillo</label>
		  				<input type="checkbox" name="tnt_rayado" id="tnt_rayado" value="1" <?php if($tnt_rayado){echo 'checked';}?>><label for="tnt_rayado">Rayado</label>
		  			</div>	
		  		</td>
		  	</tr>
		</table>
	</div>

	
	<br/>
	<div id="estructura_seccion">
		<table width="100%" border="0" cellspacing="1" cellpadding="0" class="ui-widget-content"> 
			<tr>
		  		<td width="50%" class="NoiseFooterTD"><?php if ($campnomb["material"] == 1) { $material = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Material</td>
		  		<td width="30%" class="NoiseFooterTD"><?php if ($campnomb["calibre"] == 1) { $material = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Calibre (&micro;m)</td>
		  		<td width="20%" class="NoiseDataTD" rowspan="2">
		  			<div class="ui-buttonset" align="right">
						<button id="ingresarestructura">Agregar</button>&nbsp;&nbsp;
		            	<button id="quitarestructura">Quitar</button>
					</div>
		  		</td>
		  	</tr>
			<tr>
		  		<td class="NoiseDataTD">
		  			<input type="text" name="material" id="material" size="60" onkeypress="return event.keyCode!=13"/>
		  			<input type="hidden" name="idmaterial" id="idmaterial">
		  			<input type="hidden" name="iddensidad" id="iddensidad">
		  			<input type="hidden" name="idextruido" id="idextruido">
		  		</td>
		  		<td class="NoiseDataTD"><input type="text" name="calibre" id="calibre" size="35" onkeypress="return event.keyCode!=13"/></td>
		  	</tr>
		</table>
		<div id="filtrlistaestructura">
		<?php
		$noAjax = true;
		include '../src/FunjQuery/jquery.visors/jquery.tabla1.php';  
		?>
		</div>
		<div>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">	
				<tr>
					<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['tole_calib_ms']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["tole_calib_ms"] == 1 || $campnomb["tole_calib_mn"]){echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Tolerancia calibre <!--(&micro;m)--> (%) </td>
					<td width="30%" class="NoiseDataTD">
						<b>+</b><input type="text" name="tole_calib_ms" id="tole_calib_ms" size="8" value="<?php echo $tole_calib_ms ?>" onkeypress="return event.keyCode!=13"/>&nbsp;
						<b>-</b><input type="text" name="tole_calib_mn" id="tole_calib_mn" size="8" value="<?php echo $tole_calib_mn ?>" onkeypress="return event.keyCode!=13"/>
					</td>
					<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['tole_grama_ms']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["tole_grama_ms"] == 1 || $campnomb["tole_grama_mn"]){echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Tolerancia gramaje <!--(g)--> (%) </td>
					<td width="30%" class="NoiseDataTD">
						<b>+</b><input type="text" name="tole_grama_ms" id="tole_grama_ms" size="8" value="<?php echo $tole_grama_ms ?>" onkeypress="return event.keyCode!=13"/>&nbsp;
						<b>-</b><input type="text" name="tole_grama_mn" id="tole_grama_mn" size="8" value="<?php echo $tole_grama_mn ?>" onkeypress="return event.keyCode!=13"/>
					</td>
				</tr>
			</table>
		</div>
	
	<br/>
	
	<div id="session_materialimprimir" style="display: <?php if($tipo_estruc == 'compuesto' && $tipo_impresion != 'sin_impresion'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['mate_imp']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["mate_imp"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Material a imprimir</td>
				<td width="30%" class="NoiseDataTD"><select name="mate_imp" id="mate_imp">
				<option value="">-- Seleccione --</option>
				<?php 
					if($arrtabla1)$arrt = explode(':|:',$arrtabla1);
					$idcon = fncconn();
					for($i = 0; $i < count($arrt); $i++):
					 	$rwArray = explode(':-:', $arrt[$i]);
					 	$rwItem = loadrecordpadreitem($rwArray[1],$idcon);
					 	
					 	echo '<option value="'.$rwArray[1].'" ';
					 	
					 	if($mate_imp == $rwArray[1])
							echo 'selected';
					 	
					 	echo '>'.$rwItem['paditenombre'].'</option>'.'/n';
					endfor;
		?>
				</select></td>
				<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['pos_imp']] > 0){echo 'ui-state-error ui-corner-all';}?>" width="20%"><?php if($campnomb["pos_imp"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Posici&oacute;n del material a imprimir</td>
				<td class="NoiseDataTD" width="30%"><select name="pos_imp" id="pos_imp">
					<option value="">-- Seleccione --</option>
					<option value="cara"<?php if($pos_imp == 'cara') echo ' selected ' ?>>Cara</option>
					<option value="dorso"<?php if($pos_imp == 'dorso') echo ' selected ' ?>>Dorso</option>
				</select></td>
			</tr>
		</table>
	</div>
	<div id="session_numcarasimprimir" style="display: <?php if($tipo_estruc == 'sencillo'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['ncaras_imp']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["ncaras_imp"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;No. de caras impresas</td>
				<td width="80%" class="NoiseDataTD">&nbsp;1&nbsp;<input type="radio" name="ncaras_imp" id="ncaras_imp" value="1" <?php if($ncaras_imp == 1) echo 'checked' ?> />&nbsp;&nbsp;&nbsp;2&nbsp;<input type="radio" name="ncaras_imp" id="ncaras_imp" value="2" <?php if($ncaras_imp == 2) echo 'checked' ?> /></td>
			</tr>
		</table>
	</div>
	</div>
	
	<div id="medidas_seccion">
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
	<tr>
		<td colspan="4" class="ui-state-default">&nbsp;Medidas Capuchon</td>
		</tr>
		<tr>
			<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['largo']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["largo"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Largo (mm)</td>
			<td width="30%" class="NoiseDataTD"><input type="text" name="largo" id="largo" onkeyup="eventPesomillarCapuchon(); eventDisabledTolerancia('largo');" size="15" value="<?php echo $largo ?>" onkeypress="return event.keyCode!=13"/></td>
			<td width="25%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['tole_largo_ms']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["tole_largo_ms"] == 1 || $campnomb["tole_largo_mn"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Tolerancia de largo (mm)</td>
			<td width="25%" class="NoiseDataTD">
				<b>+</b><input type="text" name="tole_largo_ms" id="tole_largo_ms" size="8" <?php if($largo == '0') echo ' disabled ' ?> value="<?php echo $tole_largo_ms ?>" onkeypress="return event.keyCode!=13"/>&nbsp;
				<b>-</b><input type="text" name="tole_largo_mn" id="tole_largo_mn" size="8" <?php if($largo == '0') echo ' disabled ' ?> value="<?php echo $tole_largo_mn ?>" onkeypress="return event.keyCode!=13"/>
			</td>
		</tr>
		<tr>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['pestania']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["pestania"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Pesta&ntilde;a (mm)</td>
			<td class="NoiseDataTD"><input type="text" name="pestania" id="pestania" size="15" onkeyup="eventPesomillarCapuchon();eventDisabledTolerancia('pestania');" value="<?php echo $pestania ?>" onkeypress="return event.keyCode!=13"/></td>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['tole_pestania_ms']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["tole_pestania_ms"] == 1 || $campnomb["tole_pestania_mn"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Tolerancia de pesta&ntilde;a (mm)</td>
			<td class="NoiseDataTD">
				<b>+</b><input type="text" name="tole_pestania_ms" id="tole_pestania_ms" <?php if($pestania == '0') echo ' disabled ' ?> size="8" value="<?php echo $tole_pestania_ms ?>" onkeypress="return event.keyCode!=13"/>&nbsp;
				<b>-</b><input type="text" name="tole_pestania_mn" id="tole_pestania_mn" <?php if($pestania == '0') echo ' disabled ' ?> size="8" value="<?php echo $tole_pestania_mn ?>" onkeypress="return event.keyCode!=13"/>
			</td>
		</tr>
		<tr>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['bmayor']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["bmayor"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Base mayor (mm)</td>
			<td class="NoiseDataTD"><input type="text" name="bmayor" id="bmayor" size="15" onkeyup="eventPesomillarCapuchon();eventDisabledTolerancia('bmayor');" value="<?php echo $bmayor ?>" onkeypress="return event.keyCode!=13"/></td>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['tole_bmayor_ms']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["tole_bmayor_ms"] == 1 || $campnomb["tole_bmayor_mn"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Tol. base mayor (mm)</td>
			<td class="NoiseDataTD">
				<b>+</b><input type="text" name="tole_bmayor_ms" id="tole_bmayor_ms" size="8" <?php if($bmayor == '0') echo ' disabled ' ?> value="<?php echo $tole_bmayor_ms ?>" onkeypress="return event.keyCode!=13"/>&nbsp;
				<b>-</b><input type="text" name="tole_bmayor_mn" id="tole_bmayor_mn" size="8" <?php if($bmayor == '0') echo ' disabled ' ?> value="<?php echo $tole_bmayor_mn ?>" onkeypress="return event.keyCode!=13"/>
			</td>
		</tr>
		<tr>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['bmenor']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["bmenor"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Base menor (mm)</td>
			<td class="NoiseDataTD"><input type="text" name="bmenor" id="bmenor" size="15" onkeyup="eventPesomillarCapuchon();eventDisabledTolerancia('bmenor');" value="<?php echo $bmenor ?>" onkeypress="return event.keyCode!=13"/></td>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['tole_bmenor_ms']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["tole_bmenor_ms"] == 1 || $campnomb["tole_bmenor_mn"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Tol. base menor (mm)</td>
			<td class="NoiseDataTD">
				<b>+</b><input type="text" name="tole_bmenor_ms" id="tole_bmenor_ms" size="8" <?php if($bmenor == '0') echo ' disabled ' ?> value="<?php echo $tole_bmenor_ms ?>" onkeypress="return event.keyCode!=13"/>&nbsp;
				<b>-</b><input type="text" name="tole_bmenor_mn" id="tole_bmenor_mn" size="8" <?php if($bmenor == '0') echo ' disabled ' ?> value="<?php echo $tole_bmenor_mn ?>" onkeypress="return event.keyCode!=13"/>
			</td>
		</tr>
		</table>
	</div>
	
	<div id="accesorios_seccion">
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
		<td colspan="4" class="ui-state-default">&nbsp;Accesorios de Capuchon</td>
		</tr>
		<tr>
			<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['macroper']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["macroper"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Macroperforaciones</td>
			<td width="30%" class="NoiseDataTD">&nbsp;Si&nbsp;<input type="radio" onclick="eventOcultaMacroperforaciones(1);" name="macroper" id="macroperforaciones" value="si" <?php if($macroper == 'si'){ echo 'checked';} ?> />&nbsp;&nbsp;&nbsp;No&nbsp;<input type="radio" onclick="eventOcultaMacroperforaciones(2);" name="macroper" id="macroperforaciones" value="no" <?php if($macroper == 'no'){ echo 'checked';} ?> /></td>
			<td width="25%" class="NoiseFooterTD"><span id="n_macroperflbl" class="<?php if($arrCampertipproCAL[$arrCampertipproCOD['nro_macroper']] > 0){echo 'ui-state-error ui-corner-all';}?>" style="display: <?php if($macroper == 2){ echo 'none'; } else { echo 'block'; } ?>"><?php if($campnomb["nro_macroper"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;No. de macroperforaciones</span></td>
			<td width="25%" class="NoiseDataTD"><span id="n_macroperfobj" style="display: <?php if($macroper == 2){ echo 'none'; } else { echo 'block'; } ?>"><input type="text" name="nro_macroper" id="nro_macroper" size="15" value="<?php echo $nro_macroper ?>" onkeypress="return event.keyCode!=13"/></span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['microper']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["microper"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Microperforaciones</td>
			<td class="NoiseDataTD">&nbsp;Si&nbsp;<input type="radio" onclick="eventOcultaMicroperforaciones(1);" name="microper" id="microperforaciones" value="si" <?php if($microper == 'si') echo 'checked'; ?> />&nbsp;&nbsp;&nbsp;No&nbsp;<input type="radio" onclick="eventOcultaMicroperforaciones(2);" name="microper" id="microperforaciones" value="no" <?php if($microper == 'no') echo 'checked'; ?> /></td>
			<td class="NoiseFooterTD"><span id="n_caras_microperflbl" class="<?php if($arrCampertipproCAL[$arrCampertipproCOD['ncaras_microper']] > 0){echo 'ui-state-error ui-corner-all';}?>" style="display: <?php if($microper == "si"){ echo 'block'; } else { echo 'none'; } ?>"><?php if($campnomb["ncaras_microper"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;No. caras microperforaciones</span></td>
			<td class="NoiseDataTD"><span id="n_caras_microperfobj" style="display: <?php if($microper == "si"){ echo 'block'; } else { echo 'none'; } ?>">&nbsp;1&nbsp;<input type="radio" name="ncaras_microper" id="ncaras_microper" value="1" <?php if($ncaras_microper == 1 && $microper == "si") echo 'checked'; ?> />&nbsp;&nbsp;&nbsp;2&nbsp;<input type="radio" name="ncaras_microper" id="ncaras_microper" value="2" <?php if($ncaras_microper == 2 && $microper == "si") echo 'checked'; ?> /></span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><span id="tipo_microperlbl" class="<?php if($arrCampertipproCAL[$arrCampertipproCOD['tipo_microper']] > 0){echo 'ui-state-error ui-corner-all';}?>" style="display: <?php if($microper=="si"){echo 'block';}else{echo 'none';}?>"><?php if($campnomb["tipo_microper"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Tipo de microperforaciones</span></td>
			<td class="NoiseDataTD"><span id="tipo_microperobj" style="display: <?php if($microper=="si"){echo 'block';}else{echo 'none';}?>"><select name="tipo_microper" id="tipo_microper">
				<option value="">-- Seleccione --</option>
				<option value="5x5"<?php if($tipo_microper == '5x5' && $microper == "si") echo ' selected' ?>>5 X 5</option>
				<option value="10x10"<?php if($tipo_microper == '10x10' && $microper == "si") echo ' selected' ?>>10 X 10</option>
			</select></span></td>
			<td class="NoiseFooterTD"><span id="dist_microper_lb" class="<?php if($arrCampertipproCAL[$arrCampertipproCOD['dist_microper']] > 0){echo 'ui-state-error ui-corner-all';}?>" style="display: <?php if($microper=="si"){echo 'block';}else{echo 'none';}?>"><?php if($campnomb["dist_microper"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Distancia Microperforacion (mm)</span></td>
			<td class="NoiseDataTD"><span id="dist_microper_obj" style="display: <?php if($microper=="si"){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="text" name="dist_microper" id="dist_microper" value="<?php echo $dist_microper ?>" onkeypress="return event.keyCode!=13"/></span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['troquel']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["troquel"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Troquel</td>
			<td class="NoiseDataTD">&nbsp;Si&nbsp;<input type="radio" name="troquel" id="troquel" onclick="eventTroquel(1);" value="si" <?php if($troquel == 'si'){echo 'checked';}?> />&nbsp;&nbsp;&nbsp;No&nbsp;<input type="radio" name="troquel" id="troquel" onclick="eventTroquel(2);" value="no" <?php if($troquel == 'no'){echo 'checked';}?> /></td>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['selle_fondo']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["selle_fondo"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Sello de fondo</td>
			<td class="NoiseDataTD">&nbsp;Si&nbsp;<input type="radio" name="selle_fondo" id="selle_fondo" value="si" <?php if($selle_fondo == 'si') echo 'checked'; ?> />&nbsp;&nbsp;&nbsp;No&nbsp;<input type="radio" name="selle_fondo" id="selle_fondo" value="no" <?php if($selle_fondo == 'no') echo 'checked'; ?> /></td>
		</tr>
	</table>
	<div id="session_tipotroquel" style="display: <?php if($troquel == 'si'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['tipo_troquel']] > 0){echo 'ui-state-error ui-corner-all';}?>" width="20%"><?php if($campnomb["tipo_troquel"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Tipo de troquel</td>
				<td class="NoiseDataTD" width="80%"><input type="text" name="tipo_troquel" id="tipo_troquel" size="15" value="<?php echo $tipo_troquel ?>" onkeypress="return event.keyCode!=13"/></td>
			</tr>
		</table>
	</div>
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<?php
			//se adiciono la correcion de el calculo de el peso millar de  los capuchones
			unset($estructura_n); ($tipo_estruc == 'compuesto')? $estructura_n = 2 : $estructura_n = 1;
		?>
		<tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;Peso millar (Kg)</td>
<!--		no borrar peso millar pasado con error reflejado en planta	
			<td width="30%" class="NoiseDataTD">&nbsp;
				<span id="pesomillar">
					<?php //echo round( (((((double) $bmayor / 1000) + ((double) $bmenor / 1000 )) / 2 ) * ( (((double)  $largo / 1000) * 2) + (((double) $pestania / 1000) * 2)))*$totalgramaje  * 100 ) / 100 ?>
				</span>
			</td>
-->
			<td width="30%" class="NoiseDataTD">&nbsp;<span id="pesomillar"><?php echo round(((((($bmayor / 1000) + ($bmenor / 1000)) / 2)  * ((($largo / 1000) * 2) + ($pestania / 1000 ) * 2)) *  (($totalgramaje / $estructura_n))) * 100) / 100; ?></span></td>
			<td width="25%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['dist_perf_pestania']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["dist_perf_pestania"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Dist. perf. pesta&ntilde;a (mm)</td>
			<td width="25%" class="NoiseDataTD"><input type="text" name="dist_perf_pestania" id="dist_perf_pestania" value="<?php echo $dist_perf_pestania ?>" onkeypress="return event.keyCode!=13"/></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD" ><span id="cod_barras_lb" class="<?php if($arrCampertipproCAL[$arrCampertipproCOD['cod_barras']] > 0){echo 'ui-state-error ui-corner-all';}?>" style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>"><?php if($campnomb["cod_barras"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;C&oacute;digo de barras</span></td>
			<td class="NoiseDataTD" colspan="3"><span id="cod_barras_obj" style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>"><input type="text" name="cod_barras" id="cod_barras" size="15" value="<?php echo $cod_barras ?>" onkeypress="return event.keyCode!=13"/></span></td>
		</tr>
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="4"><?php if($campnomb["note_product"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD" colspan="4"><textarea name="note_product" cols="116" rows="3"><?php echo $note_product; ?></textarea></tr>
	</table>
	</div>
</div>
<!-- FIN PESTAÑA ESPECIFICACIONES DEL PRODUCTO -->


<!-- PESTAÑA 3 ESPECIFICACIONES DE EMBALAJE -->							
<div id="opt-tab4">
	<div id="esp_emb_seccion">
	<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="22%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['tipo_empaque']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["tipo_empaque"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Tipo de empaque</td>
			<td width="28%" class="NoiseDataTD">&nbsp;Caja&nbsp;<input type="radio" name="tipo_empaque" id="tipo_empaque" value="caja" <?php if($tipo_empaque == 'caja') echo ' checked' ?> />&nbsp;&nbsp;&nbsp;Bag&nbsp;<input type="radio" name="tipo_empaque" id="tipo_empaque"  value="bag" <?php if($tipo_empaque == 'bag') echo ' checked' ?> /></td>
			<td width="22%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['uni_empaque']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["uni_empaque"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Unidades por empaque</td>
			<td width="28%" class="NoiseDataTD"><input type="text" name="uni_empaque" id="uni_empaque" size="15" value="<?php echo $uni_empaque ?>" onkeypress="return event.keyCode!=13"/></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['uni_paquete']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["uni_paquete"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Unidades por paquete</td>
			<td class="NoiseDataTD"><input type="text" name="uni_paquete" id="uni_paquete" size="15" value="<?php echo $uni_paquete ?>" onkeypress="return event.keyCode!=13"/></td>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['peso_empaque']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["peso_empaque"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Peso m&aacute;ximo empaque (Kg)</td>
			<td class="NoiseDataTD"><input type="text" name="peso_empaque" id="peso_empaque" size="15" value="<?php echo $peso_empaque ?>" onkeypress="return event.keyCode!=13"/></td>
		</tr>
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['estibado']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["estibado"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Material estibado</td>
			<td class="NoiseDataTD">&nbsp;Si&nbsp;<input type="radio" name="estibado" id="material_estibado" onclick="eventMaterialEstibado(1);" value="si" <?php if($estibado == 'si'){echo 'checked';}?> />&nbsp;&nbsp;&nbsp;No&nbsp;<input type="radio" name="estibado" id="material_estibado" onclick="eventMaterialEstibado(2);"  value="no" <?php if($estibado == 'no'){echo 'checked';}?>/></td>
			<td class="NoiseDataTD">&nbsp;</td>
			<td class="NoiseDataTD">&nbsp;</td>
		</tr>
	</table>
	<div id="session_estibado" style="display: <?php if($estibado == 'si'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['tam_estiba']] > 0){echo 'ui-state-error ui-corner-all';}?>" width="22%"><?php if($campnomb["tam_estiba"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Tama&ntilde;o de estiba</td>
				<td class="NoiseDataTD" width="28%"><select name="tam_estiba" id="tam_estiba">
					<option value="">-- Seleccione --</option>
					<option value="100x120"<?php if($tam_estiba == '100x120') echo ' selected' ?>>100cm X 120cm</option>
					<option value="115x115"<?php if($tam_estiba == '115x115') echo ' selected' ?>>115cm X 115cm</option>
					<option value="120x120"<?php if($tam_estiba == '120x120') echo ' selected' ?>>120cm X 120cm</option>
				</select></td>
				<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['tipo_estiba']] > 0){echo 'ui-state-error ui-corner-all';}?>" width="22%"><?php if($campnomb["tipo_estiba"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Tipo de estiba</td>
				<td class="NoiseDataTD" width="28%"><select name="tipo_estiba" id="tipo_estiba">
					<option value="">-- Seleccione --</option>
					<option value="madera_arrume"<?php if($tipo_estiba == 'madera_arrume') echo ' selected' ?>>Madera Arrume</option>
					<option value="madera_sencilla"<?php if($tipo_estiba == 'madera_sencilla') echo ' selected' ?>>Madera Sencilla</option>
					<option value="plastica_arrume"<?php if($tipo_estiba == 'plastica_arrume') echo ' selected' ?>>Pl&aacute;stica arrume</option>
					<option value="plastica_sencilla"<?php if($tipo_estiba == 'plastica_sencilla') echo ' selected' ?>>Pl&aacute;stica sencilla</option>
				</select></td>
			</tr>
			<tr><td class="ui-state-default" colspan="4"></td></tr>
			<tr>
				<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['alt_pallet']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["alt_pallet"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Altura m&aacute;xima pallet (mm)</td>
				<td class="NoiseDataTD"><input type="text" name="alt_pallet" id="alt_pallet" size="15" value="<?php echo $alt_pallet ?>" onkeyup="eventOcultaPallet(this.value);" onkeypress="return event.keyCode!=13"/></td>
				<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['pes_pallet']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["pes_pallet"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Peso por pallet (Kg)</td>
				<td class="NoiseDataTD"><input type="text" name="pes_pallet" id="peso_pallet" size="15" value="<?php echo $pes_pallet ?>" onkeyup="eventOcultaAltPallet(this.value);" onkeypress="return event.keyCode!=13"/></td>
			</tr>
			<tr>
				<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['estresado']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["estresado"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Estresado</td>
				<td class="NoiseDataTD">&nbsp;Si&nbsp;<input type="radio" name="estresado" id="estresado" value="si" <?php if($estresado == 'si'){echo 'checked';}?> />&nbsp;&nbsp;&nbsp;No&nbsp;<input type="radio" name="estresado" id="estresado" value="no" <?php if($estresado == 'no'){echo 'checked';}?> /></td>
				<td class="NoiseDataTD">&nbsp;</td>
				<td class="NoiseDataTD">&nbsp;</td>
			</tr>
		</table>
	</div>
	
	<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr><td class="ui-state-default"></td></tr>
		<tr><td class="NoiseFooterTD"><?php if($campnomb["note_embalaje"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD"><textarea name="note_embalaje" cols="116" rows="3"><?php echo $note_embalaje; ?></textarea></tr>
	</table>
	</div>
</div>
<!-- FIN PESTAÑA ESPECIFICACIONES DE EMBALAJE -->

<!-- PESTAÑA 4 MATERIAL EXTRUIDO SOLAMENTE -->
<div id="opt-tab5">
 <div id="esp_ext_seccion">
		<div id="filtrlistamatextruido">
			<?php
				$noAjax = true;
				include '../src/FunjQuery/jquery.phpscripts/jquery.ajax_matextruido.php';  
			?>
		</div>
	</div>
</div>
<!-- FIN PESTAÑA MATERIAL EXTRUIDO SOLAMENTE -->
							
<!-- PESTAÑA 5 LAMINACION -->
<!-- FIN PESTAÑA LAMINACION -->

<!-- PESTAÑA 6 CONDICIONES DE PROCESO PARA EL DESARROLLO -->
<!-- FIN PESTAÑA 6 CONDICIONES DE PROCESO PARA EL DESARROLLO -->

<!-- PESTAÑA 7 NOTAS DE MODIFICACION -->
<?php if($tipevecodigo == 2):?>
<div id="opt-tab8">
	<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="30%" class="NoiseDataTD"><?php if($campnomb["calibre_estructura"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Calibre/Estructura&nbsp;<input type="checkbox" name="calibre_estructura" id="calibre_estructura" value="1" onclick="eventNotacalibre_estructura();" /></td>
			<td width="30%" class="NoiseDataTD"><?php if($campnomb["disenio_textos_colores"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Dise&ntilde;o/Textos/Colores&nbsp;<input type="checkbox" name="disenio_textos_colores" id="disenio_textos_colores" value="1" onclick="eventNotadisenio_textos_colores();"/></td>
			<td width="20%" class="NoiseDataTD"><?php if($campnomb["medidas"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Medidas&nbsp;<input type="checkbox" name="medidas" id="medidas" value="1" onclick="eventNotamedidas();"/></td>
			<td width="20%" class="NoiseDataTD"><?php if($campnomb["accesorios"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Accesorios&nbsp;<input type="checkbox" name="accesorios" id="accesorios" value="1" onclick="eventNotaaccesorios_seccion();"/></td>
		</tr>
		<tr>
			<td colspan="2" class="NoiseDataTD"><?php if($campnomb["esp_emb"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Especificaci&oacute;n de embalaje<input type="checkbox" name="esp_emb" id="esp_emb" value="1" onclick="eventNotaesp_emb();"/></td>
			<td colspan="2" class="NoiseDataTD"><?php if($campnomb["esp_ext"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Especificaciones de Material extruido<input type="checkbox" name="esp_ext" id="esp_ext" value="1" onclick="eventNotaesp_ext();"/></td>
		</tr>
		<tr><td class="ui-state-default" colspan="7"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="7"><?php if($campnomb["note_notas"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD" colspan="7"><textarea name="note_notas" cols="116" rows="3"><?php echo $note_notas; ?></textarea></tr>
	</table>
</div>
<script type="text/javascript">eventNotamedidas();eventNotacalibre_estructura();eventNotadisenio_textos_colores();eventNotaaccesorios_seccion();eventNotaesp_emb();eventNotaesp_ext();</script>
<?php endif;?>
<!-- PESTAÑA 7 NOTAS DE MODIFICACION -->