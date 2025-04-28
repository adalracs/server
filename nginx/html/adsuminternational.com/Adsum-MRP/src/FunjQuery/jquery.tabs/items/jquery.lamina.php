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
	  			<!--td width="30%" class="NoiseDataTD"><input type="hidden" name="unimedi" id="unimedi" value="<?php  echo $unimedi ?>" /><span id="unimedi_lb"><?php //if(!$flagnuevoproducto){echo ($unimedi)? $unimedi : '[NINGUNO]';}else{echo ($unimedi)? $unimedi : '[NINGUNO]' ;}?></span></td-->
	  			<td width="30%" class="NoiseDataTD"><input type="text" name="unimedi" id="unimedi" value="<?php  echo $unimedi ?>" /><!--span id="unimedi_lb"><?php //if(!$flagnuevoproducto){echo ($unimedi)? $unimedi : '[NINGUNO]';}else{echo ($unimedi)? $unimedi : '[NINGUNO]' ;}?></span--></td>
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
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['tole_cant_ms']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if ($campnomb["tole_cant_ms"] == 1 || $campnomb["tole_cant_mn"] == 1) { $tole_cant_ms = null;$tole_cant_mn = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Tolerancia cantidad (%)</td> 
			<td class="NoiseDataTD">
				<b>+</b>&nbsp;<input type="text" name="tole_cant_ms" id="tole_cant_ms"	value="<?php echo $tole_cant_ms; ?>" <?php if($cantidad_solicitada == '0') echo ' disabled ' ?> size="10" onkeypress="return event.keyCode!=13"/>
				<b>-</b>&nbsp;<input type="text" name="tole_cant_mn" id="tole_cant_mn"	value="<?php echo $tole_cant_mn; ?>" <?php if($cantidad_solicitada == '0') echo ' disabled ' ?> size="10" onkeypress="return event.keyCode!=13"/>
	  		</td>
	  		<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['tipo_estruc']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if ($campnomb["tipo_estruc"] == 1) { $tipo_estruc = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Tipo de estructura</td>
	  		<td class="NoiseDataTD"><select name="tipo_estruc" id="tipo_estruc" onchange="eventEstructura(this.value);">
	  				<option value="">-- Seleccione --</option>
	  				<option value="monocapa"<?php if($tipo_estruc == 'monocapa') echo ' selected' ?>>Monocapa</option>
	  				<option value="bilaminado"<?php if($tipo_estruc == 'bilaminado') echo ' selected' ?>>Bilaminado</option>
	  				<option value="trilaminado"<?php if($tipo_estruc == 'trilaminado') echo ' selected' ?>>Trilaminado</option>
	  				<option value="tetralaminado"<?php if($tipo_estruc == 'tetralaminado') echo ' selected' ?>>Tetralaminado</option>
	  				<option value="multilaminado"<?php if($tipo_estruc == 'multilaminado') echo ' selected' ?>>Multilaminado</option>
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
								<input type="checkbox" name="est_color" id="est_color" value="1"<?php if($est_color) echo ' checked' ?>><label for="est_color">Estandar color</label>
								<input type="checkbox" name="pcolor" id="pcolor" value="1"<?php if($pcolor) echo ' checked' ?>><label for="pcolor">Prueba color</label>
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
	</div>
	<br/>
	<div id="medidas_seccion">
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
		<td colspan="4" class="ui-state-default">&nbsp;Medidas Lamina</td>
		</tr>
		<tr>
			<td width="25%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['ancho']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["ancho"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Ancho (mm)</td>
			<td width="25%" class="NoiseDataTD"><input type="text" name="ancho" id="ancho" onchange="eventPesomillar(); eventDisabledTolerancia('ancho');" size="15" value="<?php echo $ancho ?>" onkeypress="return event.keyCode!=13"/></td>
			<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['tole_ancho_ms']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["tole_ancho_ms"] == 1 || $campnomb["tole_ancho_mn"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Tolerancia del ancho (mm)</td>
			<td width="30%" class="NoiseDataTD">
				<b>+</b><input type="text" name="tole_ancho_ms" id="tole_ancho_ms" size="8" <?php if($ancho == '0') echo ' disabled ' ?> value="<?php echo $tole_ancho_ms ?>" onkeypress="return event.keyCode!=13"/>&nbsp;
				<b>-</b><input type="text" name="tole_ancho_mn" id="tole_ancho_mn" size="8" <?php if($ancho == '0') echo ' disabled ' ?> value="<?php echo $tole_ancho_mn ?>" onkeypress="return event.keyCode!=13"/>
			</td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><span id="largo_lb" class="<?php if($arrCampertipproCAL[$arrCampertipproCOD['largo']] > 0){echo 'ui-state-error ui-corner-all';}?>" style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>"><?php if($campnomb["largo"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Largo (mm)</span></td>
			<td class="NoiseDataTD"><span id="largo_obj" style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>"><input type="text" name="largo" id="largo" onchange="eventPesomillar(); eventDisabledTolerancia('largo');" size="15" value="<?php echo $largo ?>" onkeypress="return event.keyCode!=13"/></span></td>
			<td class="NoiseFooterTD"><span id="tolelargo_lb" class="<?php if($arrCampertipproCAL[$arrCampertipproCOD['tole_largo_ms']] > 0){echo 'ui-state-error ui-corner-all';}?>" style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>"><?php if($campnomb["tole_largo_ms"] == 1 || $campnomb["tole_largo_mn"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Tolerancia de largo (mm)</span></td>
			<td class="NoiseDataTD"><span id="tolelargo_obj" style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">
				<b>+</b><input type="text" name="tole_largo_ms" id="tole_largo_ms" size="8" <?php if($largo == '0') echo ' disabled ' ?> value="<?php echo $tole_largo_ms ?>" onkeypress="return event.keyCode!=13"/>&nbsp;
				<b>-</b><input type="text" name="tole_largo_mn" id="tole_largo_mn" size="8" <?php if($largo == '0') echo ' disabled ' ?> value="<?php echo $tole_largo_mn ?>" onkeypress="return event.keyCode!=13"/>
				</span>
			</td>
		</tr>
		<tr>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['ancho_fotoc']] > 0){echo 'ui-state-error ui-corner-all';}?>"><span id="anchofotoc_lb" style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>"><?php if($campnomb["ancho_fotoc"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Ancho fotocelda (mm)</span></td>
			<td class="NoiseDataTD"><span id="anchofotoc_obj" style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>"><input type="text" name="ancho_fotoc" id="ancho_fotoc" size="15" value="<?php echo $ancho_fotoc ?>" onkeypress="return event.keyCode!=13"/></span></td>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['largo_fotoc']] > 0){echo 'ui-state-error ui-corner-all';}?>"><span id="largo_fotoc_lb" style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>"><?php if($campnomb["largo_fotoc"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Largo fotocelda (mm)</span></td>
			<td class="NoiseDataTD"><span id="largo_fotoc_obj" style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>"><input type="text" name="largo_fotoc" id="largo_fotoc" size="15" value="<?php echo $largo_fotoc ?>" onkeypress="return event.keyCode!=13"/></span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><span id="dfotoc_lb" class="<?php if($arrCampertipproCAL[$arrCampertipproCOD['dfotoc_borde']] > 0){echo 'ui-state-error ui-corner-all';}?>" style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>"><?php if($campnomb["dfotoc_borde"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Distancia fotocelda al borde (mm)</span></td>
			<td class="NoiseDataTD"><span id="dfotoc_obj" style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>"><input type="text" name="dfotoc_borde" id="dfotoc_borde" size="15" value="<?php echo $dfotoc_borde ?>" onkeypress="return event.keyCode!=13"/></span></td>
			<td class="NoiseFooterTD"><span id="colorfotoc_lb" class="<?php if($arrCampertipproCAL[$arrCampertipproCOD['color_fotoc']] > 0){echo 'ui-state-error ui-corner-all';}?>" style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>"><?php if($campnomb["color_fotoc"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Color fotocelda</span></td>
			<td class="NoiseDataTD"><span id="colorfotoc_obj" style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>"><input type="text" name="color_fotoc" id="color_fotoc" size="15" value="<?php echo $color_fotoc ?>" onkeypress="return event.keyCode!=13"/></span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><span id="tipoemb_lb" class="<?php if($arrCampertipproCAL[$arrCampertipproCOD['tipo_emb']] > 0){echo 'ui-state-error ui-corner-all';}?>" style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>"><?php if($campnomb["tipo_emb"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Tipo de embobinado</span></td>
			<td class="NoiseDataTD"><span id="tipoemb_obj" style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>"><input type="text" name="tipo_emb" id="tipo_emb" size="15" value="<?php echo $tipo_emb ?>" onkeypress="return event.keyCode!=13"/></span></td>
			<td class="NoiseFooterTD"><span id="conresp_lb" class="<?php if($arrCampertipproCAL[$arrCampertipproCOD['con_resp']] > 0){echo 'ui-state-error ui-corner-all';}?>" style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>"><?php if($campnomb["con_resp"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Con respecto</span></td>
			<td class="NoiseDataTD"><span id="conresp_obj" style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>"><select name="con_resp" id="con_resp">
				<option value="">-- Seleccione --</option>
				<option value="codigo_de_barras" <?php if($con_resp == 'codigo_de_barras') echo ' selected' ?>>C&oacute;digo de Barras</option>
				<option value="cara_principal" <?php if($con_resp == 'cara_principal') echo ' selected' ?>>Cara principal</option>
				<option value="tabla_nutricional" <?php if($con_resp == 'tabla_nutricional') echo ' selected' ?>>Tabla nutricional</option>
				<option value="orientacion_embobinado" <?php if($con_resp == 'orientacion_embobinado') echo ' selected' ?>>Orientaci&oacute;n embobinado</option>
			</select></span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><span id="cod_barras_lb" class="<?php if($arrCampertipproCAL[$arrCampertipproCOD['cod_barras']] > 0){echo 'ui-state-error ui-corner-all';}?>" style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>"><?php if($campnomb["cod_barras"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;C&oacute;digo de barras</span></td>
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
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="23%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['tam_core']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["tam_core"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Tama&ntilde;o del core (mm)</td>
			<td width="27%" class="NoiseDataTD"><select name="tam_core" id="tam_core">
				<option value="">-- Seleccione --</option>
				<option value="50.8mm"<?php if($tam_core == '50.8mm') echo ' selected' ?>>50.8 mm</option>
				<option value="76.2mm"<?php if($tam_core == '76.2mm') echo ' selected' ?>>76.2 mm</option>
				<option value="152.4mm"<?php if($tam_core == '152.4mm') echo ' selected' ?>>152.4 mm</option>
			</select></td>
			<td width="23%" class="NoiseFooterTD"><span id="metros_rollolb" class="<?php if($arrCampertipproCAL[$arrCampertipproCOD['mrollo']] > 0){echo 'ui-state-error ui-corner-all';}?>" style="display : <?php if(!$mrollo && !$prollo && !$drollo){echo 'block';}else if(!$mrollo){echo 'none';}?>"><?php if($campnomb["mrollo"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Metros del rollo</span></td>
			<td width="27%" class="NoiseDataTD"><span id="metros_rolloobj" style="display : <?php if(!$mrollo && !$prollo && !$drollo){echo 'block';}else if(!$mrollo){echo 'none';}else{echo 'block';}?>"><input type="text" name="mrollo" id="mrollo" onkeyup="eventMetrosrollo(this.value);" value="<?php echo $mrollo?>" onkeypress="return event.keyCode!=13"/></span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><span id="peso_rollolb"  class="<?php if($arrCampertipproCAL[$arrCampertipproCOD['prollo']] > 0){echo 'ui-state-error ui-corner-all';}?>" style="display : <?php if(!$mrollo && !$prollo && !$drollo){echo 'block';}else if(!$prollo){echo 'none';}else{echo 'block';}?>"><?php if($campnomb["prollo"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Peso del rollo (Kg)</span></td>
			<td class="NoiseDataTD"><span id="peso_rolloobj" style="display : <?php if(!$mrollo && !$prollo && !$drollo){echo 'block';}else if(!$prollo){echo 'none';}else{echo 'block';}?>"><input type="text" name="prollo" id="prollo" onkeyup="eventPesorollo(this.value);" size="15" value="<?php echo $prollo ?>" onkeypress="return event.keyCode!=13"/></span></td>
			<td class="NoiseFooterTD"><span id="tole_pesolb" class="<?php if($arrCampertipproCAL[$arrCampertipproCOD['tole_prollo_ms']] > 0){echo 'ui-state-error ui-corner-all';}?>" style="display : <?php if(!$mrollo && !$prollo && !$drollo){echo 'block';}else if(!$prollo){echo 'none';}else{echo 'block';}?>"><?php if($campnomb["tole_prollo_ms"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Tolerancia del peso (Kg)</span></td>
			<td class="NoiseDataTD"><span id="tole_pesoobj" style="display : <?php if(!$mrollo && !$prollo && !$drollo){echo 'block';}else if(!$prollo){echo 'none';}else{echo 'block';}?>">
				<b>+</b><input type="text" name="tole_prollo_ms" id="tole_prollo_ms" size="8" value="<?php echo $tole_prollo_ms ?>" onkeypress="return event.keyCode!=13"/>&nbsp;
				<b>-</b><input type="text" name="tole_prollo_mn" id="tole_prollo_mn" size="8" value="<?php echo $tole_prollo_mn ?>" onkeypress="return event.keyCode!=13"/>
			</span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><span id="diam_rollolb" class="<?php if($arrCampertipproCAL[$arrCampertipproCOD['drollo']] > 0){echo 'ui-state-error ui-corner-all';}?>" style="display : <?php if(!$mrollo && !$prollo && !$drollo){echo 'block';}else if(!$drollo){echo 'none';}else{echo 'block';}?>"><?php if($campnomb["drollo"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Diametro del rollo (mm)</span></td>
			<td class="NoiseDataTD"><span id="diam_rolloobj" style="display : <?php if(!$mrollo && !$prollo && !$drollo){echo 'block';}else if(!$drollo){echo 'none';}else{echo 'block';}?>"><input type="text" name="drollo" id="drollo" onkeyup="eventDiamrollo(this.value);" size="15" value="<?php echo $drollo ?>" onkeypress="return event.keyCode!=13"/></span></td>
			<td class="NoiseFooterTD"><span id="tole_diametrolb" class="<?php if($arrCampertipproCAL[$arrCampertipproCOD['tole_drollo_ms']] > 0){echo 'ui-state-error ui-corner-all';}?>" style="display : <?php if(!$mrollo && !$prollo && !$drollo){echo 'block';}else if(!$drollo){echo 'none';}else{echo 'block';}?>"><?php if($campnomb["tole_drollo_ms"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Tolerancia del diametro (mm)</span></td>
			<td class="NoiseDataTD"><span id="tole_diametroobj" style="display : <?php if(!$mrollo && !$prollo && !$drollo){echo 'block';}else if(!$drollo){echo 'none';}else{echo 'block';}?>">
				<b>+</b><input type="text" name="tole_drollo_ms" id="tole_drollo_ms" size="8" value="<?php echo $tole_drollo_ms ?>" onkeypress="return event.keyCode!=13"/>&nbsp;
				<b>-</b><input type="text" name="tole_drollo_mn" id="tole_drollo_mn" size="8" value="<?php echo $tole_drollo_mn ?>" onkeypress="return event.keyCode!=13"/>
			</span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['flag']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["flag"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Bandera</td>
			<td class="NoiseDataTD" colspan="3">&nbsp;Si&nbsp;<input type="radio" name="flag" id="flag" value="si" onclick="eventBandera(1);" <?php if($flag == 'si') echo 'checked'; ?> />&nbsp;&nbsp;&nbsp;No&nbsp;<input type="radio" name="flag" id="flag" value="no" onclick="eventBandera(2);" <?php if($flag == 'no') echo 'checked'; ?> /></td>
		</tr>
		</table>
			<div id="session_bandera" style="display: <?php if($flag == 'si'){ echo 'block'; } else { echo 'none'; } ?>">
				<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
					<tr>
						<td width="23%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['color_flag']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["color_flag"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Color bandera</td>
						<td width="27%" class="NoiseDataTD"><select name="color_flag" id="color_flag">
							<option value="">--Seleccione--</option>
							<option value="verde"<?php if($color_flag == 'verde') echo ' selected' ?>>Verde</option>
							<option value="rojo"<?php if($color_flag == 'rojo') echo ' selected' ?>>Rojo</option>
							<option value="azul"<?php if($color_flag == 'azul') echo ' selected' ?>>Azul</option>
							<option value="negro"<?php if($color_flag == 'negro') echo ' selected' ?>>Negro</option>
							<option value="transparente"<?php if($color_flag == 'transparente') echo ' selected' ?>>Transparente</option>
							<option value="blanco"<?php if($color_flag == 'blanco') echo ' selected' ?>>Blanco</option>
							<option value="metalizada"<?php if($color_flag == 'metalizada') echo ' selected' ?>>Metalizada</option>
							</select>
						</td>
						<td width="23%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['ubic_flag']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["ubic_flag"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Ubicaci&oacute;n bandera</td>
						<td width="27%" class="NoiseDataTD" width="30%"><select name="ubic_flag" id="ubic_flag">
							<option value="">--Seleccione--</option>
							<option value="ladofotoc" <?php if($ubic_flag == 'ladofotoc'){echo 'selected';}?>>Lado Fotocelda</option>
							<option value="ladoopuesto" <?php if($ubic_flag == 'ladoopuesto'){echo 'selected';}?>>Lado Opuesto</option>
							<option value="NA" <?php if($ubic_flag == 'NA'){echo 'selected';}?>>N/A</option>
							</select>
						</td>
					</tr>
				</table>
			</div>
			
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="23%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['nmax_empal']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["nmax_empal"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;No. max empalmes</td>
			<td width="27%" class="NoiseDataTD"><input type="text" name="nmax_empal" id="nmax_empal" size="15" value="<?php echo $nmax_empal ?>" onkeypress="return event.keyCode!=13" onkeyup="eventMaxempalmes(this.value);"/></td>
			<td width="23%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['ancho_empal']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["ancho_empal"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Ancho de empalme</td>
			<td width="27%" class="NoiseDataTD"><select name="ancho_empal" id="ancho_empal">
				<option value="">-- Seleccione --</option>
				<option value="12.7" <?php if(trim($ancho_empal) == '12.7.5') echo ' selected' ?>>12.7 (mm)</option>
				<option value="25.4" <?php if(trim($ancho_empal) == '25.4') echo ' selected' ?>>25.4 (mm)</option>
				<option value="48" <?php if(trim($ancho_empal) == '38.1') echo ' selected' ?>>38.1 (mm)</option>
				<option value="48" <?php if(trim($ancho_empal) == '50.8 ') echo ' selected' ?>>50.8 (mm)</option>
				<option value="NA" <?php if(trim($ancho_empal) == 'NA') echo ' selected' ?>>N/A</option>
			</select></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['cempal_cara']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["cempal_cara"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Color Empalme Cara</td>
			<td class="NoiseDataTD"><select name="cempal_cara" id="cempal_cara">
				<option value="">-- Seleccione --</option>
				<option value="verde"<?php if($cempal_cara == 'verde') echo ' selected' ?>>Verde</option>
				<option value="rojo"<?php if($cempal_cara == 'rojo') echo ' selected' ?>>Rojo</option>
				<option value="azul"<?php if($cempal_cara == 'azul') echo ' selected' ?>>Azul</option>
				<option value="negro"<?php if($cempal_cara == 'negro') echo ' selected' ?>>Negro</option>
				<option value="transparente"<?php if($cempal_cara == 'transparente') echo ' selected' ?>>Transparente</option>
				<option value="blanco"<?php if($cempal_cara == 'blanco') echo ' selected' ?>>Blanco</option>
				<option value="metalizada"<?php if($cempal_cara == 'metalizada') echo ' selected' ?>>Metalizada</option>
				<option value="NA"<?php if($cempal_cara == 'NA') echo ' selected' ?>>N/A</option>
			</select></td>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['cempal_dorso']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["cempal_dorso"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Color Empalme Dorso</td>
			<td class="NoiseDataTD"><select name="cempal_dorso" id=cempal_dorso>
				<option value="">-- Seleccione --</option>
				<option value="verde"<?php if($cempal_dorso == 'verde') echo ' selected' ?>>Verde</option>
				<option value="rojo"<?php if($cempal_dorso == 'rojo') echo ' selected' ?>>Rojo</option>
				<option value="azul"<?php if($cempal_dorso == 'azul') echo ' selected' ?>>Azul</option>
				<option value="negro"<?php if($cempal_dorso == 'negro') echo ' selected' ?>>Negro</option>
				<option value="transparente"<?php if($cempal_dorso == 'transparente') echo ' selected' ?>>Transparente</option>
				<option value="blanco"<?php if($cempal_dorso == 'blanco') echo ' selected' ?>>Blanco</option>
				<option value="metalizada"<?php if($cempal_dorso == 'metalizada') echo ' selected' ?>>Metalizada</option>
				<option value="NA"<?php if($cempal_dorso == 'NA') echo ' selected' ?>>N/A</option>
			</select></td>
		</tr>
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="4"><?php if($campnomb["note_embalaje"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD" colspan="4"><textarea name="note_embalaje" cols="116" rows="3"><?php echo $note_embalaje; ?></textarea></tr>
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
<div id="opt-tab6">
	<div id="laminacion_seccion">
	<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['lado_foil']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["lado_foil"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Lado brillante del foil</td>
			<td width="30%" class="NoiseDataTD">&nbsp;Arriba&nbsp;<input type="radio" name="lado_foil" id="lado_foi" value="arriba" <?php if($lado_foil == 'arriba'){echo 'checked';}?>/>&nbsp;Abajo&nbsp;<input type="radio" name="lado_foil" id="lado_foi" value="abajo"  <?php if($lado_foil == 'abajo'){echo 'checked';}?>/>&nbsp;N/A&nbsp;<input type="radio" name="lado_foil" id="lado_foi" value="NA"  <?php if($lado_foil == 'NA'){echo 'checked';}?>/></td>
			<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['tipo_proceso']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["tipo_proceso"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp; Tipo Adhesion</td>
			<td width="30%" class="NoiseDataTD">&nbsp;Coldseal&nbsp;<input type="radio" name="tipo_proceso" id="tipo_proc" value="coldseal" <?php if($tipo_proceso == 'coldseal'){echo 'checked';}?>/>&nbsp;Hotmelt&nbsp;<input type="radio" name="tipo_proceso" id="tipo_proc" value="hotmelt"  <?php if($tipo_proceso == 'hotmelt'){echo 'checked';}?>/>&nbsp;N/A&nbsp;<input type="radio" name="tipo_proceso" id="tipo_proc" value="NA"  <?php if($tipo_proceso == 'NA'){echo 'checked';}?>/></td>
		</tr>
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="4"><?php if($campnomb["note_laminacion"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD" colspan="4"><textarea name="note_laminacion" cols="116" rows="3"><?php echo $note_laminacion; ?></textarea></tr>
	</table>
	</div>
</div>
<!-- FIN PESTAÑA LAMINACION -->

<!-- PESTAÑA 6 CONDICIONES DE PROCESO PARA EL DESARROLLO -->
<div id="opt-tab7">
<div id="desarrollo_seccion">
	<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['product_empa']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["product_empa"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Producto a empacar</td>
			<td width="30%" class="NoiseDataTD"><input type="text" name="product_empa" id="product_empa" size="15" value="<?php echo $product_empa ?>" onkeypress="return event.keyCode!=13"/></td>
			<td width="25%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['temp_empa']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["temp_empa"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Temperatura de empacado (C)</td>
			<td width="25%" class="NoiseDataTD"><input type="text" name="temp_empa" id="temp_empa" size="15" value="<?php echo $temp_empa ?>" onkeypress="return event.keyCode!=13"/></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['tipo_sellado']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["tipo_sellado"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Tipo de sellado</td>
			<td class="NoiseDataTD"><select name="tipo_sellado" id="tipo_sellado">
				<option value="">-- Seleccione --</option>
				<option value="dorso_dorso"<?php if($tipo_sellado == 'dorso_dorso') echo ' selected' ?>>Dorso/Dorso</option>
				<option value="cara_dorso"<?php if($tipo_sellado == 'cara_dorso') echo ' selected' ?>>Cara/Dorso</option>
				<option value="NA"<?php if($tipo_sellado == 'NA') echo ' selected' ?>>N/A</option>
			</select></td>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['vel_empa']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["vel_empa"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Velocidad (Unid/min)</td>
			<td class="NoiseDataTD"><input type="text" name="vel_empa" id="vel_empa" size="15" value="<?php echo $vel_empa ?>" onkeypress="return event.keyCode!=13"/></td>
		</tr>
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="4"><?php if($campnomb["note_proces"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD" colspan="4"><textarea name="note_proces" cols="116" rows="3"><?php echo $note_proces; ?></textarea></tr>
	</table>
</div>
</div>
<!-- FIN PESTAÑA 6 CONDICIONES DE PROCESO PARA EL DESARROLLO -->

<!-- PESTAÑA 4 FORMA EMPAQUE -->
<div id="opt-tab4a">
	<div id="empaque_seccion">
	<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['form_empa']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["form_empa"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Forma de empaque</td>
			<td width="80%" class="NoiseDataTD"><select name="form_empa" id="form_empa" onchange="eventFormaempaque(this.value);">
				<option value="">-- Seleccione --</option>
				<option value="suspendido"<?php if($form_empa == 'suspendido') echo ' selected' ?>>Suspendido</option>
				<option value="caja"<?php if($form_empa == 'caja') echo ' selected' ?>>Caja</option>
				<option value="bolsa_plastica"<?php if($form_empa == 'bolsa_plastica') echo ' selected' ?>>Bolsa pl&aacute;stica</option>
				<option value="carton_extremos"<?php if($form_empa == 'carton_extremos') echo ' selected' ?>>Cart&oacute;n extremos</option>
				<option value="cubierto_extremos"<?php if($form_empa == 'cubierto_extremos') echo ' selected' ?>>Cubierto Carton</option>
			</select></td>
		<tr>
	</table>
	
	<div id="seccion_formempa_suspendido" style="display: <?php if($form_empa == 'suspendido'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['niv_estiba']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["niv_estiba"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Niveles por estiba</td>
				<td width="30%" class="NoiseDataTD"><input type="text" name="niv_estiba" id="niv_estiba" size="15" value="<?php if($form_empa == 'suspendido') echo $niv_estiba  ?>" onkeypress="return event.keyCode!=13"/></td>
				<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['peso_estiba']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["peso_estiba"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Peso por estiba (Kg)</td>
				<td width="30%" class="NoiseDataTD"><input type="text" name="peso_estiba" id="peso_estiba" size="15" value="<?php if($form_empa == 'suspendido') echo $peso_estiba ?>" onkeypress="return event.keyCode!=13"/></td>
			<tr>
			<tr>
				<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['bolsa_plastica']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["bolsa_plastica"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Bolsa pl&aacute;stica</td>
				<td colspan="3" class="NoiseDataTD">&nbsp;Si&nbsp;<input type="radio" name="bolsa_plastica_suspendido" id="bolsa_plastic" value="si" <?php if($form_empa == 'suspendido'){ if($bolsa_plastica == 'si'){echo 'checked';} } ?>/>&nbsp;No&nbsp;<input type="radio" name="bolsa_plastica_suspendido" id="bolsa_plastic" value="no"  <?php if($form_empa == 'suspendido'){ if($bolsa_plastica == 'no'){echo 'checked';} }?>/></td>
			</tr>
		</table>
	</div>
	
	<div id="seccion_formempa_caja" style="display: <?php if($form_empa == 'caja'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['pro_core']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["pro_core"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Protector core</td>
				<td width="30%" class="NoiseDataTD">&nbsp;Si&nbsp;<input type="radio" name="pro_core_caja" id="pro_core" value="si" <?php if($form_empa == 'caja'){ if($pro_core == 'si') echo ' checked'; }?> />&nbsp;No&nbsp;<input type="radio" name="pro_core_caja" id="pro_core" value="no" <?php if($form_empa == 'caja'){ if($pro_core == 'no') echo ' checked'; } ?> /></td>
				<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['bolsa_plastica']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["bolsa_plastica"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Bolsa pl&aacute;stica</td>
				<td width="30%" class="NoiseDataTD">&nbsp;Si&nbsp;<input type="radio" name="bolsa_plastica_caja" id="bolsa_plastic" value="si" <?php if($form_empa == 'caja'){ if($bolsa_plastica == 'si'){echo 'checked';}}?> />&nbsp;No&nbsp;<input type="radio" name="bolsa_plastica_caja" id="bolsa_plastic" value="no"  <?php if($form_empa == 'caja'){ if($bolsa_plastica == 'no'){echo 'checked';}}?> /></td>
			<tr>
			<tr>
				<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['peso_max']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["peso_max"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Peso Maximo por caja (kg)</td>
				<td colspan="3" class="NoiseDataTD"><input type="text" name="peso_max_caja" id="peso_max" size="15" value="<?php if($form_empa == 'caja'){ echo $peso_max; } ?>" onkeypress="return event.keyCode!=13"/></td>
			</tr>
		</table>
	</div>
	
	
	<div id="seccion_formempa_bolsa_plastica" style="display: <?php if($form_empa == 'bolsa_plastica'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['pro_core']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["pro_core"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Protector core</td>
				<td width="30%" class="NoiseDataTD">&nbsp;Si&nbsp;<input type="radio" name="pro_core_bolsa_plastica" id="pro_core" value="si" <?php if($form_empa == 'bolsa_plastica'){ if($pro_core == 'si') echo ' checked'; } ?> />&nbsp;No&nbsp;<input type="radio" name="pro_core_bolsa_plastica" id="pro_core" value="no" <?php if($form_empa == 'bolsa_plastica'){ if($pro_core == 'no') echo ' checked'; } ?> /></td>
				<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['peso_max']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["peso_max"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Peso Maximo por bolsa (kg)</td>
				<td colspan="3" class="NoiseDataTD"><input type="text" name="peso_max_bolsa_plastica" id="peso_max" size="15" value="<?php if($form_empa == 'bolsa_plastica'){ echo $peso_max; } ?>" onkeypress="return event.keyCode!=13"/></td>
			</tr>
		</table>
	</div>
	
	<div id="seccion_formempa_carton_extremos" style="display: <?php if($form_empa == 'carton_extremos'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['pro_core']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["pro_core"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Protector core</td>
				<td width="30%" class="NoiseDataTD">&nbsp;Si&nbsp;<input type="radio" name="pro_core_carton_extremos" id="pro_core" value="si" <?php  if($form_empa == 'carton_extremos'){ if($pro_core == 'si') echo ' checked'; } ?> />&nbsp;No&nbsp;<input type="radio" name="pro_core_carton_extremos" id="pro_core" value="no" <?php  if($form_empa == 'carton_extremos'){ if($pro_core == 'no') echo ' checked'; } ?> /></td>
				<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['bolsa_plastica']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["bolsa_plastica"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Bolsa pl&aacute;stica</td>
				<td width="30%" class="NoiseDataTD">&nbsp;Si&nbsp;<input type="radio" name="bolsa_plastica_carton_extremos" id="bolsa_plastic" value="si" <?php  if($form_empa == 'carton_extremos'){ if($bolsa_plastica == 'si'){echo 'checked';} } ?> />&nbsp;No&nbsp;<input type="radio" name="bolsa_plastica_carton_extremos" id="bolsa_plastic" value="no"  <?php  if($form_empa == 'carton_extremos'){ if($bolsa_plastica == 'no'){echo 'checked';} } ?> /></td>
			<tr>
			<tr>
				<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['no_rollos']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["no_rollos"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;No. Rollos</td>
				<td colspan="3" class="NoiseDataTD"><input type="text" name="no_rollos_carton_extremos" id="no_rollos" size="15" value="<?php  if($form_empa == 'carton_extremos'){ echo $no_rollos; } ?>" onkeypress="return event.keyCode!=13"/></td>
			</tr>
		</table>
	</div>
	
	<div id="seccion_formempa_cubierto_extremos" style="display: <?php if($form_empa == 'cubierto_extremos'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['pro_core']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["pro_core"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Protector core</td>
				<td width="30%" class="NoiseDataTD">&nbsp;Si&nbsp;<input type="radio" name="pro_core_cubierto_extremos" id="pro_core" value="si" <?php if($form_empa == 'cubierto_extremos'){ if($pro_core == 'si'){ echo ' checked'; } } ?> />&nbsp;No&nbsp;<input type="radio" name="pro_core_cubierto_extremos" id="pro_core" value="no" <?php if($form_empa == 'cubierto_extremos'){ if($pro_core == 'no'){ echo ' checked'; } }?> /></td>
				<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['bolsa_plastica']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["bolsa_plastica"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Bolsa pl&aacute;stica</td>
				<td width="30%" class="NoiseDataTD">&nbsp;Si&nbsp;<input type="radio" name="bolsa_plastica_cubierto_extremos" id="bolsa_plastic" value="si" <?php if($form_empa == 'cubierto_extremos'){ if($bolsa_plastica == 'si'){echo 'checked';} }?> />&nbsp;No&nbsp;<input type="radio" name="bolsa_plastica_cubierto_extremos" id="bolsa_plastic" value="no"  <?php if($form_empa == 'cubierto_extremos'){ if($bolsa_plastica == 'no'){echo 'checked';} } ?> /></td>
			<tr>
			<tr>
				<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['no_rollos']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["no_rollos"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;No. Rollos</td>
				<td colspan="3" class="NoiseDataTD"><input type="text" name="no_rollos_cubierto_extremos" id="no_rollos" size="15" value="<?php if($form_empa == 'cubierto_extremos'){ echo $no_rollos; } ?>" onkeypress="return event.keyCode!=13"/></td>
			</tr>
		</table>
	</div>

	<br/>
	<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['estibado']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["estibado"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Material estibado</td>
			<td width="30%" class="NoiseDataTD">&nbsp;Si&nbsp;<input type="radio" name="estibado" id="material_estibado" onclick="eventMaterialEstibado(1);" value="si" <?php if($estibado == 'si'){echo 'checked';}?> />&nbsp;&nbsp;&nbsp;No&nbsp;<input type="radio" name="estibado" id="material_estibado" onclick="eventMaterialEstibado(2);"  value="no" <?php if($estibado == 'no'){echo 'checked';}?>/></td>
			<td width="20%"class="NoiseDataTD">&nbsp;</td>
			<td width="30%"class="NoiseDataTD">&nbsp;</td>
		</tr>
	</table>
	<div id="session_estibado" style="display: <?php if($estibado == 'si'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['tam_estiba']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["tam_estiba"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Tama&ntilde;o de estiba</td>
				<td width="30%" class="NoiseDataTD"><select name="tam_estiba" id="tam_estiba">
					<option value="">-- Seleccione --</option>
					<option value="100x120"<?php if($tam_estiba == '100x120') echo ' selected' ?>>100cm X 120cm</option>
					<option value="115x115"<?php if($tam_estiba == '115x115') echo ' selected' ?>>115cm X 115cm</option>
					<option value="120x120"<?php if($tam_estiba == '120x120') echo ' selected' ?>>120cm X 120cm</option>
					<option value="varias"<?php if($tam_core == 'varias') echo ' selected' ?>>Varias</option>
				</select></td>
				<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['tipo_estiba']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["tipo_estiba"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Tipo de estiba</td>
				<td width="30%" class="NoiseDataTD"><select name="tipo_estiba" id="tipo_estiba">
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
		<tr><td class="NoiseFooterTD"><?php if($campnomb["note_formaempaque"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD"><textarea name="note_formaempaque" cols="116" rows="3"><?php echo $note_formaempaque; ?></textarea></tr>
	</table>
	</div>
</div>
<!-- FIN PESTAÑA FORMA EMPAQUE -->

<!-- PESTAÑA 7 NOTAS DE MODIFICACION -->
<?php if($tipevecodigo == 2):?>
<div id="opt-tab8">
	<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="30%" class="NoiseDataTD"><?php if($campnomb["calibre_estructura"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Calibre/Estructura&nbsp;<input type="checkbox" name="calibre_estructura" id="calibre_estructura" value="1" onclick="eventNotacalibre_estructura();" /></td>
			<td width="30%" class="NoiseDataTD"><?php if($campnomb["disenio_textos_colores"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Dise&ntilde;o/Textos/Colores&nbsp;<input type="checkbox" name="disenio_textos_colores" id="disenio_textos_colores" value="1" onclick="eventNotadisenio_textos_colores();"/></td>
			<td width="40%" class="NoiseDataTD"><?php if($campnomb["medidas"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Medidas&nbsp;<input type="checkbox" name="medidas" id="medidas" value="1" onclick="eventNotamedidas();"/></td>
		</tr>
		<tr>
			<td class="NoiseDataTD"><?php if($campnomb["esp_emb"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Especificaci&oacute;n de embalaje<input type="checkbox" name="esp_emb" id="esp_emb" value="1" onclick="eventNotaesp_emb();"/></td>
			<td class="NoiseDataTD"><?php if($campnomb["esp_ext"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Especificaciones de Material extruido<input type="checkbox" name="esp_ext" id="esp_ext" value="1" onclick="eventNotaesp_ext();"/></td>
			<td class="NoiseDataTD"><?php if($campnomb["empaque"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Forma de empaque<input type="checkbox" name="empaque" id="empaque" value="1" onclick="eventNotaempaque_seccion();"/></td>
		</tr>
		<tr><td class="ui-state-default" colspan="7"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="7"><?php if($campnomb["note_notas"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD" colspan="7"><textarea name="note_notas" cols="116" rows="3"><?php echo $note_notas; ?></textarea></tr>
	</table>
</div>
<script type="text/javascript">eventNotamedidas();eventNotacalibre_estructura();eventNotadisenio_textos_colores();eventNotaesp_emb();eventNotaesp_ext();eventNotalaminacion_seccion();eventNotadesarrollo_seccion();eventNotaempaque_seccion();</script>
<?php endif;?>
<!-- PESTAÑA 7 NOTAS DE MODIFICACION -->