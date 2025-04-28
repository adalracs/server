<!-- PESTAÑA 2 ESPECIFICACIONES DEL PRODUCTO -->
<div id="opt-tab2">
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content"> 	
		<tr> 
	  		<td width="20%" class="NoiseFooterTD"><?php if ($campnomb["tipo_estruc"] == 1) { $tipo_estruc = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Tipo de estructura</td>
	  		<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="tipo_estruc" id="tipo_estruc" value="<?php echo $tipo_estruc ?>" /><?php echo ($tipo_estruc)? strtoupper($tipo_estruc) : '---' ;?></td>
			<td width="20%" class="NoiseFooterTD"><?php if ($campnomb["tipo_impresion"] == 1) { $tipo_impresion = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Tipo de impresi&oacute;n</td>
	  		<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="tipo_impresion" id="tipo_impresion" value="<?php echo $tipo_impresion ?>" /><?php echo ($tipo_impresion)? strtoupper($tipo_impresion) : '---' ;?></td>
		</tr>
	</table>
	
	<div id="item_sessiond" style="display: <?php if($tipo_impresion == 'sin_impresion') echo 'none'; else echo 'block' ?>;">
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
	  		<td width="20%" class="NoiseFooterTD"><?php if ($campnomb["equipocodigo"] == 1) { $equipocodigo = null; echo "*";}?>&nbsp;Maquina</td>
  			<td colspan="2" class="NoiseDataTD"><select name="equipocodigo" id="equipocodigo"> 
  				<option value="">--Seleccione--</option>
  					<?php 
  						include '../src/FunGen/floadequipodispensing.php';
  						$idcon = fncconn();
  						floadequipodispensing($equipocodigo,'3','3',$idcon);
  					?>
  				</select>
  			</td>
  		</tr>
  		<tr>
  			<td width="20%" class="NoiseFooterTD"><?php if ($campnomb["arrdispensing"] == 1) { $arrdispensing = null; echo "*";}?>&nbsp;Color</td>
  			<td width="60%" class="NoiseDataTD"><input type="hidden" name="formulcodigo" id="formulcodigo" /><input type="text" name="formulnumero" id="formulnumero" size ="70" /></td>
  			<td width="20%" class="NoiseDataTD">
  				<div class="ui-buttonset" align="right">
					<button id="ingresarcolor">Agregar</button>&nbsp;&nbsp;
		            <button id="quitarcolor">Quitar</button>
				</div>
  			</td>
  		</tr>
		<tr>
			<td colspan="3">
				<div id="filtrlistacolores">
					<?php 
  						$noAjax = true;
  						//$flagdetallar = 1;
	  					include '../src/FunjQuery/jquery.visors/jquery.dispensing.php'; 
	  					unset($flagdetallar);
  					?>
  				</div>
  				<input type="hidden" name="arrdispensing" id="arrdispensing" size="60" value="<?php echo $arrdispensing ?>" />
				<input type="hidden" name="arrdispensingtmp" id="arrdispensingtmp" size="60" value="<?php echo $arrdispensingtmp ?>" />
  			</td>
  		</tr>
  	</table>
  	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
  		<tr>
			<td class="NoiseFooterTD" width="20%"><?php if ($campnomb["producto_avaliable"] == 1) { $producto_avaliable = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Productos aprobados por</td> 
	  		<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="producto_avaliable" id="producto_avaliable" value="<?php echo $producto_avaliable ?>" /><?php echo ($producto_avaliable)? strtoupper($producto_avaliable) : '---' ; ?></td> 	  			
		</tr>
	  	<tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;Colores aprobados por: &nbsp;</td> 
			<td width="80%" class="NoiseDataTD" class="NoiseDataTD">
				<input type="hidden" name="pantone" id="pantone" value="<?php echo $pantone ?>" />
				<input type="hidden" name="muestra" id="muestra" value="<?php echo $muestra ?>" />
				<input type="hidden" name="est_color" id="est_color" value="<?php echo $est_color ?>" />
				<input type="hidden" name="pcolor" id="pcolor" value="<?php echo $pcolor ?>" />
				<input type="hidden" name="colorespor" id="colorespor" value="<?php echo $colorespor ?>" />
				&nbsp;<?php echo $colorespor ?>
			</td>
		</tr>
  		<tr>
  			<td width="20%" class="NoiseFooterTD">&nbsp;Tintas especiales para:</td>
  			<td width="80%" class="NoiseDataTD">
  				<input type="hidden" name="tntesp_laminacion" id="tntesp_laminacion" value="<?php echo $tntesp_laminacion ?>" />
				<input type="hidden" name="tntesp_superficie" id="tntesp_superficie" value="<?php echo $tntesp_superficie ?>" />
				<input type="hidden" name="tntesp_uretelasto" id="tntesp_uretelasto" value="<?php echo $tntesp_uretelasto ?>" />
				<input type="hidden" name="tntesp_nitropolia" id="tntesp_nitropolia" value="<?php echo $tntesp_nitropolia ?>" />
				<input type="hidden" name="tntesp_vinilica" id="tntesp_vinilica" value="<?php echo $tntesp_vinilica ?>" />
				<input type="hidden" name="tntesp_nitrocelu" id="tntesp_nitrocelu" value="<?php echo $tntesp_nitrocelu ?>" />
				<input type="hidden" name="tntesp_nitroure" id="tntesp_nitroure" value="<?php echo $tntesp_nitroure ?>" />
				<input type="hidden" name="tntesp_poliamo" id="tntesp_poliamo" value="<?php echo $tntesp_poliamo ?>" />
				<input type="hidden" name="tinta_espe" id="tinta_espe" value="<?php echo $tinta_espe ?>" />
  				&nbsp;<?php echo strtoupper($tinta_espe) ?> </td>
  		</tr>
  		<tr>
  			<td width="20%" class="NoiseFooterTD">&nbsp;Otros Materiales :</td>
  			<td width="80%" class="NoiseDataTD">
  				<input type="hidden" name="other_pmetali" id="other_pmetali" value="<?php echo $other_pmetali ?>" />
				<input type="hidden" name="other_lacacaliz" id="other_lacacaliz" value="<?php echo $other_lacacaliz ?>" />
				<input type="hidden" name="other_bamiz1" id="other_bamiz1" value="<?php echo $other_bamiz1 ?>" />
				<input type="hidden" name="other_lacatermo" id="other_lacatermo" value="<?php echo $other_lacatermo ?>" />
				<input type="hidden" name="other_hotmelt" id="other_hotmelt" value="<?php echo $other_hotmelt ?>" />
				<input type="hidden" name="other_parafina" id="other_parafina" value="<?php echo $other_parafina ?>" />
				<input type="hidden" name="other_lacaantiperoxido" id="other_lacaantiperoxido" value="<?php echo $other_lacaantiperoxido ?>" />
  				<input type="hidden" name="other" id="other" value="<?php echo $other ?>" />
  				&nbsp;<?php echo strtoupper($other) ?> </td>
  		</tr>
		<tr><td class="ui-state-default" colspan="2"></td></tr>
		<tr>
			<td class="NoiseFooterTD" colspan="2">
		  		&nbsp;Tintas resistentes a:&nbsp;&nbsp;
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
		  <tr>
		  	<td colspan="2">
		  		<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content"> 	
					<tr> 
	  					<td width="20%" class="NoiseFooterTD"><?php if ($campnomb["version_arte"] == 1) { $version_arte = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Version del arte</td>
	  					<td colspan="3" class="NoiseDataTD">&nbsp;<input type="text" name="version_arte" id="version_arte" value="<?php echo $version_arte  ?>" size="7" /><?php //echo ($version_arte)? $version_arte : '---' ; ?></td>
	  				</tr>
	  				<tr> 
	  					<td width="20%" class="NoiseFooterTD"><?php if ($campnomb["papel_pouch_imp"] == 1) { $papel_pouch_imp = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Papel Pouch</td>
	  					<td width="30%" class="NoiseDataTD">&nbsp;Si&nbsp;<input type="radio" name="papel_pouch_imp" id="papel_pouch_imp" onclick="eventPapelpouch_imp(this.value);" value="si" <?php if($papel_pouch_imp == 'si'){echo 'checked';}?> />&nbsp;&nbsp;&nbsp;No&nbsp;<input type="radio" name="papel_pouch_imp" id="papel_pouch_imp" onclick="eventPapelpouch_imp(this.value);" value="no" <?php if($papel_pouch_imp == 'no'){echo 'checked';}?> /></td>
	  					<td width="20%" class="NoiseFooterTD"><span id="lb_papel_pouch_imppor" style="display : <?php if($papel_pouch_imp == 'si'){echo 'block';}else{echo 'none';}?>"><?php if ($campnomb["papel_pouch_imppor"] == 1) { $papel_pouch_imppor = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Impreso por </span></td>
	  					<td width="30%" class="NoiseDataTD"><span id="obj_papel_pouch_imppor" style="display : <?php if($papel_pouch_imp == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Brillante&nbsp;<input type="radio" name="papel_pouch_imppor" id="papel_pouch_imppor" value="brillante" <?php if($papel_pouch_imppor == 'brillante'){echo 'checked';}?> />&nbsp;&nbsp;&nbsp;Opaco&nbsp;<input type="radio" name="papel_pouch_imppor" id="papel_pouch_imppor" value="opaco" <?php if($papel_pouch_imppor == 'opaco'){echo 'checked';}?> /></span></td>
	  				</tr>
	  				<tr> 
	  					<td width="20%" class="NoiseFooterTD"><?php if ($campnomb["foil_imp"] == 1) { $foil_imp = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Foil</td>
	  					<td width="30%" class="NoiseDataTD">&nbsp;Si&nbsp;<input type="radio" name="foil_imp" id="foil_imp" onclick="eventFoil_imp(this.value);" value="si" <?php if($foil_imp == 'si'){echo 'checked';}?> />&nbsp;&nbsp;&nbsp;No&nbsp;<input type="radio" name="foil_imp" id="foil_imp" onclick="eventFoil_imp(this.value);" value="no" <?php if($foil_imp == 'no'){echo 'checked';}?> /></td>
	  					<td width="20%" class="NoiseFooterTD"><span id="lb_foil_imppor" style="display : <?php if($foil_imp == 'si'){echo 'block';}else{echo 'none';}?>"><?php if ($campnomb["foil_imppor"] == 1) { $foil_imppor = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Impreso por </span></td>
	  					<td width="30%" class="NoiseDataTD"><span id="obj_foil_imppor" style="display : <?php if($foil_imp == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Brillante&nbsp;<input type="radio" name="foil_imppor" id="foil_imppor" value="brillante" <?php if($foil_imppor == 'brillante'){echo 'checked';}?> />&nbsp;&nbsp;&nbsp;Opaco&nbsp;<input type="radio" name="foil_imppor" id="foil_imppor" value="opaco" <?php if($foil_imppor == 'opaco'){echo 'checked';}?> /></span></td>
	  				</tr>
				</table>
			</td>		  		
		  </tr>
		</table>
	</div>
	
	<br/>
	<div id="estructura_seccion">
		<div id="filtrlistaestructura">
		<?php
		$noAjax = true;
		include '../src/FunjQuery/jquery.visors/jquery.tabla1.fichatecnica.php';  
		?>
		</div>
		<div>
		<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">	
			<tr>
				<td width="20%" class="NoiseFooterTD"><?php if($campnomb["tole_calib_ms"] == 1 || $campnomb["tole_calib_mn"]){echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Tolerancia calibre <!--(&micro;m)--> (%) </td>
				<td width="30%" class="NoiseDataTD">
					<b>+</b><input type="text" name="tole_calib_ms" id="tole_calib_ms" value="<?php echo $tole_calib_ms ?>" size="7" />&nbsp;<?php //echo ($tole_calib_ms)? $tole_calib_ms : '**' ; ?>
					<b>-</b><input type="text" name="tole_calib_mn" id="tole_calib_mn" value="<?php echo $tole_calib_mn ?>" size="7" />&nbsp;<?php //echo ($tole_calib_mn)? $tole_calib_mn : '**' ; ?>
				</td>
				<td width="20%" class="NoiseFooterTD"><?php if($campnomb["tole_grama_ms"] == 1 || $campnomb["tole_grama_mn"]){echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Tolerancia gramaje <!--(g)--> (%) </td>
				<td width="30%" class="NoiseDataTD">
				<b>+</b><input type="text" name="tole_grama_ms" id="tole_grama_ms" value="<?php echo $tole_grama_ms ?>" size="7" />&nbsp;<?php //echo ($tole_grama_ms)? $tole_grama_ms : '**' ;?>
				<b>-</b><input type="text" name="tole_grama_mn" id="tole_grama_mn" value="<?php echo $tole_grama_mn ?>" size="7" />&nbsp;<?php //echo ($tole_grama_mn)? $tole_grama_mn : '**' ;?>
				</td>
			</tr>
		</table>
		</div>
	</div>
	
	<br/>
	<div id="medidas_seccion">
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
		<td colspan="4" class="ui-state-default">&nbsp;Medidas Bolsa Flow Pack</td>
		</tr>
		<tr>
			<td width="20%" class="NoiseFooterTD"><?php if ($campnomb["ancho"] == 1) { $ancho = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Ancho (mm)</td>
			<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="ancho" id="ancho" value="<?php echo $ancho ?>" /><?php echo ($ancho)? $ancho : '---' ; ?></td>
			<td width="20%" class="NoiseFooterTD"><?php if($campnomb["tole_ancho_ms"] == 1 || $campnomb["tole_ancho_mn"]){echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Tolerancia del ancho (mm)</td>
			<td width="30%" class="NoiseDataTD">
				<b>+</b>&nbsp;<input type="hidden" name="tole_ancho_ms" id="tole_ancho_ms" value="<?php echo $tole_ancho_ms ?>" /><?php echo ($tole_ancho_ms)? $tole_ancho_ms : '**' ; ?>
				<b>-</b>&nbsp;<input type="hidden" name="tole_ancho_mn" id="tole_ancho_mn" value="<?php echo $tole_ancho_mn ?>" /><?php echo ($tole_ancho_mn)? $tole_ancho_mn : '**' ; ?>
			</td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><?php if ($campnomb["largo"] == 1) { $largo = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Largo (mm)</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="largo" id="largo" value="<?php echo $largo ?>" /><?php echo ($largo) ?$largo : '---' ; ?></td>
			<td class="NoiseFooterTD"><?php if($campnomb["tole_largo_ms"] == 1 || $campnomb["tole_largo_mn"]){echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Tolerancia de largo (mm)</td>
			<td class="NoiseDataTD">
				<b>+</b>&nbsp;<input type="hidden" name="tole_largo_ms" id="tole_largo_ms" value="<?php echo $tole_largo_ms ?>" /><?php echo ($tole_largo_ms)? $tole_largo_ms : '**' ; ?>
				<b>-</b>&nbsp;<input type="hidden" name="tole_largo_mn" id="tole_largo_mn" value="<?php echo $tole_largo_mn ?>" /><?php echo ($tole_largo_mn)? $tole_largo_mn : '**' ; ?>
			</td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><?php if ($campnomb["fuelle"] == 1) { $fuelle = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Fuelle (mm)</td>
			<td class="NoiseDataTD">&nbsp;<input type="text" name="fuelle" id="fuelle" value="<?php echo $fuelle ?>" size="7" onkeyup="eventDisabledTolerancia('fuelle');" /><?php //echo($fuelle)? $fuelle : '---' ; ?></td>
			<td class="NoiseFooterTD"><span id="tole_fuelle_lb" style="display : <?php if($fuelle > 0){echo 'block';}else{echo 'none';}?>"><?php if($campnomb["tole_fuelle_ms"] == 1 || $campnomb["tole_fuelle_ms"]){echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Tolerancia de fuelle (mm)</span></td>
			<td class="NoiseDataTD"><span id="tole_fuelle_obj" style="display :<?php if($fuelle > 0){echo 'block';}else{echo 'none';}?>">
				<b>+</b>&nbsp;<input type="text" name="tole_fuelle_ms" id="tole_fuelle_ms" value="<?php echo $tole_fuelle_ms ?>" size="7" /><?php //echo ($tole_fuelle_ms)? $tole_fuelle_ms : '**' ; ?>
				<b>-</b>&nbsp;<input type="text" name="tole_fuelle_mn" id="tole_fuelle_mn" value="<?php echo $tole_fuelle_mn ?>" size="7" /><?php //echo ($tole_fuelle_mn)? $tole_fuelle_mn : '**' ; ?>
			</span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><?php if ($campnomb["traslape"] == 1) { $traslape = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Traslape (mm)</td>
			<td class="NoiseDataTD">&nbsp;<input type="text" name="traslape" id="traslape" value="<?php echo $traslape ?>" size="7" onkeyup="eventDisabledTolerancia('traslape');" /><?php //echo ($traslape)? $traslape : '---' ; ?></td>
			<td class="NoiseFooterTD"><span id="tole_traslape_lb" style="display : <?php if($traslape > 0){echo 'block';}else{echo 'none';}?>"><?php if($campnomb["tole_traslape_ms"] == 1 || $campnomb["tole_traslape_ms"]){echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Tolerancia traslape (mm)</span></td>
			<td class="NoiseDataTD"><span id="tole_traslape_obj" style="display : <?php if($traslape > 0){echo 'block';}else{echo 'none';}?>">
				<b>+</b>&nbsp;<input type="text" name="tole_traslape_ms" id="tole_traslape_ms" value="<?php echo $tole_traslape_ms ?>" size="7" /><?php //echo ($tole_traslape_ms)? $tole_traslape_ms : '**' ; ?>
				<b>-</b>&nbsp;<input type="text" name="tole_traslape_mn" id="tole_traslape_mn" value="<?php echo $tole_traslape_mn ?>" size="7" /><?php //echo ($tole_traslape_mn)? $tole_traslape_mn : '**' ?>
			</span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><span id="tipo_traslape_lb" style="display : <?php if($traslape > 0){echo 'block';}else{echo 'none';}?>"><?php if ($campnomb["tipo_traslape"] == 1) { $tipo_traslape = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Tipo Traslape </span></td>
			<td class="NoiseDataTD" colspan="3"><span id="tipo_traslape_obj" style="display : <?php if($traslape > 0){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="text" name="tipo_traslape" id="tipo_traslape" value="<?php echo $tipo_traslape ?>" size="7" /></span></td>
		</tr>
		<tr>
			<td width="20%" class="NoiseFooterTD"><?php if ($campnomb["ancho_impresion"] == 1) { $ancho_impresion = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Ancho impresion (mm)</td>
			<td width="30%" class="NoiseDataTD">&nbsp;<input type="text" name="ancho_impresion" id="ancho_impresion" value="<?php echo $ancho_impresion ?>" size="7" /></td>
			<td width="20%" class="NoiseFooterTD"><?php if($campnomb["tole_ancho_impresion_ms"] == 1 || $campnomb["tole_ancho_impresion_mn"]){echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Tolerancia ancho imp (mm)</td>
			<td width="30%" class="NoiseDataTD">
				<b>+</b>&nbsp;<input type="text" name="tole_ancho_impresion_ms" id="tole_ancho_impresion_ms" value="<?php echo $tole_ancho_impresion_ms ?>" size="7" />
				<b>-</b>&nbsp;<input type="text" name="tole_ancho_impresion_mn" id="tole_ancho_impresion_mn" value="<?php echo $tole_ancho_impresion_mn ?>" size="7" />
			</td>
		</tr>
		<tr>
		<td colspan="4" class="ui-state-default">&nbsp;Accesorios de Bolsa Flow Pack</td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><?php if ($campnomb["troquel"] == 1) { $troquel = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Troquel</td>
			<td class="NoiseDataTD" colspan="3">&nbsp;<input type="hidden" name="troquel" id="troquel" value="<?php echo $troquel ?>"><?php echo ($troquel)? strtoupper($troquel) : '---' ; ?></td>
		</tr>
	</table>
	
	<div style="display: <?php if($troquel == 'si'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td class="NoiseFooterTD" width="20%"><?php if ($campnomb["tipo_troquel"] == 1) { $tipo_troquel = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Tipo de troquel</td>
				<td class="NoiseDataTD" width="80%">&nbsp;<input type="hidden" name="tipo_troquel" id="tipo_troquel" value="<?php echo $tipo_troquel ?>" /><?php echo ($tipo_troquel)? strtoupper($tipo_troquel) : '---' ; ?></td>
			</tr>
		</table>
	</div>
	
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
	 	  	<td width="20%" class="NoiseFooterTD"><?php if ($campnomb["valve"] == 1) { $valve = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;V&aacute;lvula</td>
	 	  	<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="valve" id="valve" value="<?php echo $valve ?>" /><?php echo ($valve)? strtoupper($valve) : '---' ; ?></td>
	 	  	<td width="24%" class="NoiseFooterTD"><?php if ($campnomb["aselle_bolsa"] == 1) { $aselle_bolsa = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Ancho de selle a las bolsas (mm)</td>
	  		<td width="26%" class="NoiseDataTD">&nbsp;<input type="text" name="aselle_bolsa" id="aselle_bolsa" value="<?php echo $aselle_bolsa ?>" size="9"></td>
	  	</tr>
		<tr> 
			<td class="NoiseFooterTD"><span style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>"><?php if ($campnomb["ctapa_valve"] == 1) { $ctapa_valve = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Color Tapa V&aacute;lvula</span></td> 
			<td class="NoiseDataTD"><span id="ctapa_valveobj" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="text" name="ctapa_valve" id="ctapa_valve" value="<?php echo $ctapa_valve ?>" /><?php //echo ($ctapa_valve)? strtoupper($ctapa_valve) : '---' ; ?></span></td>
	  		<td class="NoiseFooterTD"><span id="medi_valvelb" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>"><?php if ($campnomb["medi_valve"] == 1) { $medi_valve = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Medida V&aacute;lvula (mm)</span></td>
	  		<td class="NoiseDataTD"><span id="medi_valveobj" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="text" name="medi_valve" id="medi_valve" value="<?php echo $medi_valve ?>" /><?php //echo ($medi_valve)? strtoupper($medi_valve) : '---' ; ?></span></td>
	  	</tr>
	  	
		<tr> 
	  		<td class="NoiseFooterTD"><span id="ubic_valvelb" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>"><?php if ($campnomb["ubic_valve"] == 1) { $ubic_valve = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Ubicaci&oacute;n V&aacute;lvula</span></td>
	  		<td class="NoiseDataTD"><span id="ubic_valveobj" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="text" name="ubic_valve" id="ubic_valve" value="<?php echo $ubic_valve ?>" /><?php //echo ($ubic_valve)? strtoupper($ubic_valve) : '---' ; ?></span></td>
	  		<td class="NoiseFooterTD"><span id="tipo_valvelb" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>"><?php if ($campnomb["tipo_valve"] == 1) { $tipo_valve = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Tipo de V&aacute;lvula</span></td>
	 	  	<td class="NoiseDataTD"><span id="tipo_valveobj" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="text" name="tipo_valve" id="tipo_valve" value="<?php echo $tipo_valve ?>" /><?php //echo ($tipo_valve)? strtoupper($tipo_valve) : '---' ; ?></span></td>
	  	</tr>
	</table>
	
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="20%" class="NoiseFooterTD"><?php if ($campnomb["tipo_llenado"] == 1) { $tipo_llenado = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Llenado</td>
			<td width="30%" class="NoiseDataTD">&nbsp;&nbsp;<input type="hidden" name="tipo_llenado" id="tipo_llenado" value="<?php echo $tipo_llenado ?>" /><?php echo ($tipo_llenado)? strtoupper($tipo_llenado) : '---' ; ?></td>
			<td width="20%" class="NoiseFooterTD "><span id="cod_barras_lb" style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>"><?php if ($campnomb["cod_barras"] == 1) { $cod_barras = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;C&oacute;digo de barras</span></td>
			<td width="30%" class="NoiseDataTD"><span id="cod_barras_obj" style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<input type="text" name="cod_barras" id="cod_barras" value="<?php echo $cod_barras ?>" /></span></td>
		</tr>
		<tr>
			<td width="20%" class="NoiseFooterTD"><span id="color_fondo_barras_lb" style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>"><?php if($campnomb["color_fondo_barras"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Color fondo codigo barras</span></td>
			<td width="30%" class="NoiseDataTD"><span id="color_fondo_barras_obj" style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<input type="text" name="color_fondo_barras" id="color_fondo_barras" value="<?php echo $color_fondo_barras ?>"/></span></td>
			<td width="20%" class="NoiseFooterTD "><span id="color_color_barras_lb" style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>"><?php if($campnomb["color_barras"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Color barras</span></td>
			<td width="30%" class="NoiseDataTD"><span id="color_color_barras_obj" style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<input type="text" name="color_barras" id="color_barras" value="<?php echo $color_barras ?>"/></span></td>
		</tr>
	</table>
	<br>
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
	<?php if($tipo_impresion != 'sin_impresion'){?>
		<tr>
  			<td width="20%" class="NoiseFooterTD"><?php if ($campnomb["continuo"] == 1) { $continuo = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Continuo</td>
  			<td width="80%" class="NoiseDataTD">&nbsp;<input type="hidden" name="continuo" id="continuo" value="<?php echo $continuo ?>" /><?php echo ($continuo)? strtoupper($continuo) : '---' ;?></td>
  		</tr>
		<tr>
  			<td width="20%" class="NoiseFooterTD"><span id="nrorepet_lb" style="display : <?php if($continuo == 'si'){echo 'none';}else{'block';}?>"><?php if ($campnomb["nrorepet"] == 1) { $nrorepet = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;No. Repeticiones</span></td>
  			<td width="80%" class="NoiseDataTD"><span id="nrorepet_obj" style="display : <?php if($continuo == 'si'){echo 'none';}else{'block';}?>">&nbsp;<input type="hidden" name="nrorepet" id="nrorepet" value="<?php echo $nrorepet ?>"/><?php echo ($nrorepet)? strtoupper($nrorepet) : '---' ;?></span></td>
  		</tr>
  		<tr>
  			<td width="20%" class="NoiseFooterTD"><?php if ($campnomb["rodillo"] == 1) { $rodillo = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Rodillo</td>
  			<td width="80%" class="NoiseDataTD">&nbsp;<input type="hidden" name="rodillo" id="rodillo" value="<?php echo $rodillo ?>" /><?php echo ($rodillo)? strtoupper($rodillo) : '---' ; ?></td>
  		</tr>
  		<?php }?>
		<tr>
  			<td width="20%" class="NoiseFooterTD"><?php if ($campnomb["nropistas"] == 1) { $nropistas = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;No. Pistas</td>
  			<td width="80%" class="NoiseDataTD">&nbsp;<input type="hidden" name="nropistas" id="nropistas" value="<?php echo $nropistas ?>" /><?php echo ($nropistas)? $nropistas : '---' ; ?></td>
  		</tr>
		<tr><td class="ui-state-default" colspan="2"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="2"><?php if($campnomb["note_product"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD" colspan="2"><textarea name="note_product" cols="116" rows="3"><?php echo $note_product; ?></textarea></tr>
	</table>
	</div>
</div>
<!-- FIN PESTAÑA ESPECIFICACIONES DEL PRODUCTO -->


<!-- PESTAÑA ESPECIFICACIONES DEL EMBALAJE -->
<div id="opt-tab4">
	<div id="esp_emb_seccion">
	<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="22%" class="NoiseFooterTD"><?php if($campnomb["tipo_empaque"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Tipo de empaque</td>
			<td width="28%" class="NoiseDataTD">&nbsp;Caja&nbsp;<input type="radio" name="tipo_empaque" id="tipo_empaque" value="caja" <?php if($tipo_empaque == 'caja') echo ' checked' ?> onclick="eventCaja(this.value);" />&nbsp;&nbsp;&nbsp;Bag&nbsp;<input type="radio" name="tipo_empaque" id="tipo_empaque"  value="bag" <?php if($tipo_empaque == 'bag') echo ' checked' ?> onclick="eventCaja(this.value);" /></td>
			<td width="22%" class="NoiseFooterTD"><?php if($campnomb["uni_empaque"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Unidades por empaque</td>
			<td width="28%" class="NoiseDataTD"><input type="text" name="uni_empaque" id="uni_empaque" size="15" value="<?php echo $uni_empaque ?>" onkeypress="return event.keyCode!=13"/></td>
		</tr>
		<tr>
			<td width="22%" class="NoiseFooterTD"><span id="cod_caja_lb" style="display : <?php if($tipo_empaque == 'caja'){echo 'block';}else{echo 'none';}?>"><?php if($campnomb["cod_caja"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Codigo de caja</span></td>
			<td colspan="3" class="NoiseDataTD"><span id="cod_caja_obj" style="display : <?php if($tipo_empaque == 'caja'){echo 'block';}else{echo 'none';}?>"><input type="hidden" name="cod_caja" id="cod_caja" value="<?php echo $cod_caja ?>"/><input type="text" name="caja_item" id="caja_item" value="<?php echo $caja_item ?>" onkeypress="return event.keyCode!=13" size="40"/></span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><?php if($campnomb["uni_paquete"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Unidades por paquete</td>
			<td class="NoiseDataTD"><input type="text" name="uni_paquete" id="uni_paquete" size="15" value="<?php echo $uni_paquete ?>" onkeypress="return event.keyCode!=13"/></td>
			<td class="NoiseFooterTD"><?php if($campnomb["peso_empaque"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Peso m&aacute;ximo empaque (Kg)</td>
			<td class="NoiseDataTD"><input type="text" name="peso_empaque" id="peso_empaque" size="15" value="<?php echo $peso_empaque ?>" onkeypress="return event.keyCode!=13"/></td>
		</tr>
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr>
			<td class="NoiseFooterTD"><?php if($campnomb["estibado"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Material estibado</td>
			<td class="NoiseDataTD">&nbsp;Si&nbsp;<input type="radio" name="estibado" id="material_estibado" onclick="eventMaterialEstibado(1);" value="si" <?php if($estibado == 'si'){echo 'checked';}?> />&nbsp;&nbsp;&nbsp;No&nbsp;<input type="radio" name="estibado" id="material_estibado" onclick="eventMaterialEstibado(2);"  value="no" <?php if($estibado == 'no'){echo 'checked';}?>/></td>
			<td class="NoiseDataTD">&nbsp;</td>
			<td class="NoiseDataTD">&nbsp;</td>
		</tr>
	</table>
	<div id="session_estibado" style="display: <?php if($estibado == 'si'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td class="NoiseFooterTD" width="22%"><?php if($campnomb["tam_estiba"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Tama&ntilde;o de estiba</td>
				<td class="NoiseDataTD" width="28%"><select name="tam_estiba" id="tam_estiba">
					<option value="">-- Seleccione --</option>
					<option value="170x70"<?php if($tam_estiba == '170x70') echo ' selected' ?>>170cm X 70cm</option>
					<option value="157x70"<?php if($tam_estiba == '157x70') echo ' selected' ?>>157cm X 70cm</option>
					<option value="143x70"<?php if($tam_estiba == '143x70') echo ' selected' ?>>143cm X 70cm</option>
					<option value="142x120"<?php if($tam_estiba == '142x120') echo ' selected' ?>>142cm X 120cm</option>
					<option value="141x120"<?php if($tam_estiba == '141x120') echo ' selected' ?>>141cm X 120cm</option>
					<option value="130x70"<?php if($tam_estiba == '130x70') echo ' selected' ?>>130cm X 70cm</option>
					<option value="129x120"<?php if($tam_estiba == '129x120') echo ' selected' ?>>129cm X 120cm</option>
					<option value="128x80"<?php if($tam_estiba == '128x80') echo ' selected' ?>>128cm X 80cm</option>
					<option value="125x120"<?php if($tam_estiba == '125x120') echo ' selected' ?>>125cm X 120cm</option>
					<option value="126x120"<?php if($tam_estiba == '126x120') echo ' selected' ?>>126cm X 120cm</option>
					<option value="122x120"<?php if($tam_estiba == '122x120') echo ' selected' ?>>122cm X 120cm</option>
					<option value="120x120"<?php if($tam_estiba == '120x120') echo ' selected' ?>>120cm X 120cm</option>
					<option value="120x115"<?php if($tam_estiba == '120x115') echo ' selected' ?>>120cm X 115cm</option>
					<option value="120x110"<?php if($tam_estiba == '120x110') echo ' selected' ?>>120cm X 110cm</option>
					<option value="120x80"<?php if($tam_estiba == '120x80') echo ' selected' ?>>120cm X 80cm</option>
					<option value="118x70"<?php if($tam_estiba == '118x70') echo ' selected' ?>>118cm X 70cm</option>
					<option value="114x120"<?php if($tam_estiba == '114x120') echo ' selected' ?>>114cm X 120cm</option>
					<option value="115x115"<?php if($tam_estiba == '115x115') echo ' selected' ?>>115cm X 115cm</option>
					<option value="115x120"<?php if($tam_estiba == '115x120') echo ' selected' ?>>115cm X 120cm</option>
					<option value="117x120"<?php if($tam_estiba == '117x120') echo ' selected' ?>>117cm X 120cm</option>
					<option value="113x80"<?php if($tam_estiba == '113x80') echo ' selected' ?>>113cm X 80cm</option>
					<option value="112x120"<?php if($tam_estiba == '112x120') echo ' selected' ?>>112cm X 120cm</option>
					<option value="106x120"<?php if($tam_estiba == '106x120') echo ' selected' ?>>106cm X 120cm</option>
					<option value="102x70"<?php if($tam_estiba == '102x70') echo ' selected' ?>>102cm X 70cm</option>
					<option value="101x80"<?php if($tam_estiba == '101x80') echo ' selected' ?>>101cm X 80cm</option>
					<option value="110x120"<?php if($tam_estiba == '110x120') echo ' selected' ?>>110cm X 120cm</option>
					<option value="110x110"<?php if($tam_estiba == '110x110') echo ' selected' ?>>110cm X 110cm</option>
					<option value="100x120"<?php if($tam_estiba == '100x120') echo ' selected' ?>>100cm X 120cm</option>
					<option value="100x100"<?php if($tam_estiba == '100x100') echo ' selected' ?>>100cm X 100cm</option>
					<option value="97x120"<?php if($tam_estiba == '97x120') echo ' selected' ?>>97cm X 120cm</option>
					<option value="96x120"<?php if($tam_estiba == '96x120') echo ' selected' ?>>96cm X 120cm</option>
					<option value="94x120"<?php if($tam_estiba == '94x120') echo ' selected' ?>>94cm X 120cm</option>
					<option value="90x120"<?php if($tam_estiba == '90x120') echo ' selected' ?>>90cm X 120cm</option>
					<option value="90x90"<?php if($tam_estiba == '90x90') echo ' selected' ?>>90cm X 90cm</option>
					<option value="90x70"<?php if($tam_estiba == '90x70') echo ' selected' ?>>90cm X 70cm</option>
					<option value="93x120"<?php if($tam_estiba == '93x120') echo ' selected' ?>>93cm X 120cm</option>
					<option value="89x69"<?php if($tam_estiba == '89x69') echo ' selected' ?>>89cm X 69cm</option>
					<option value="88x120"<?php if($tam_estiba == '88x120') echo ' selected' ?>>88cm X 120cm</option>
					<option value="86x120"<?php if($tam_estiba == '86x120') echo ' selected' ?>>86cm X 120cm</option>
					<option value="85x120"<?php if($tam_estiba == '85x120') echo ' selected' ?>>85cm X 120cm</option>
					<option value="82x120"<?php if($tam_estiba == '82x120') echo ' selected' ?>>82cm X 120cm</option>
					<option value="82x70"<?php if($tam_estiba == '82x70') echo ' selected' ?>>82cm X 70cm</option>
					<option value="81x90"<?php if($tam_estiba == '81x90') echo ' selected' ?>>81cm X 90cm</option>
					<option value="80x120"<?php if($tam_estiba == '80x120') echo ' selected' ?>>80cm X 120cm</option>
					<option value="80x75"<?php if($tam_estiba == '80x75') echo ' selected' ?>>80cm X 75cm</option>
					<option value="75x120"<?php if($tam_estiba == '75x120') echo ' selected' ?>>75cm X 120cm</option>
					<option value="76x120"<?php if($tam_estiba == '76x120') echo ' selected' ?>>76cm X 120cm</option>
					<option value="79x120"<?php if($tam_estiba == '79x120') echo ' selected' ?>>79cm X 120cm</option>
					<option value="64x120"<?php if($tam_estiba == '64x120') echo ' selected' ?>>64cm X 120cm</option>
				</select></td>
				<td class="NoiseFooterTD" width="22%"><?php if($campnomb["tipo_estiba"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Tipo de estiba</td>
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
				<td class="NoiseFooterTD"><?php if($campnomb["alt_pallet"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Altura m&aacute;xima pallet (mm)</td>
				<td class="NoiseDataTD"><input type="text" name="alt_pallet" id="alt_pallet" size="15" value="<?php echo $alt_pallet ?>" onkeypress="return event.keyCode!=13"/></td>
				<td class="NoiseFooterTD"><?php if($campnomb["pes_pallet"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Peso por pallet (Kg)</td>
				<td class="NoiseDataTD"><input type="text" name="pes_pallet" id="peso_pallet" size="15" value="<?php echo $pes_pallet ?>" onkeypress="return event.keyCode!=13"/></td>
			</tr>
			<tr>
				<td class="NoiseFooterTD"><?php if($campnomb["estresado"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Estresado</td>
				<td colspan="3" class="NoiseDataTD">&nbsp;Si&nbsp;<input type="radio" name="estresado" id="estresado" value="si" <?php if($estresado == 'si'){echo ' checked';} ?>/>&nbsp;&nbsp;&nbsp;No&nbsp;<input type="radio" name="estresado" id="estresado" value="no" <?php if($estresado == 'no') echo ' checked' ?>/></td>
			</tr>
			<tr>
				<td class="NoiseFooterTD"><?php if($campnomb["cod_estiba"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Codigo de estiba</td>
				<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name=cod_estiba id="cod_estiba" value="<?php echo $cod_estiba ?>"/><input type="text" name="estiba_item" id="estiba_item" value="<?php echo $estiba_item ?>" onkeypress="return event.keyCode!=13" size="40"/></td>
			</tr>
			<tr>
				<td class="NoiseFooterTD"><?php if($campnomb["niv_estiba"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Nivel x estiba&nbsp;</td>
				<td class="NoiseDataTD">&nbsp;<input type="text" name="niv_estiba" id="niv_estiba" value="<?php echo $niv_estiba ?>" size="9" /></td>
				<td class="NoiseFooterTD"><?php if($campnomb["cant_estiba"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Cantidad x Nivel&nbsp;</td>
				<td class="NoiseDataTD">&nbsp;<input type="text" name="cant_estiba" id="cant_estiba" value="<?php echo $cant_estiba ?>" size="9" /></td>
			</tr>
		</table>
	</div>
	
	<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr><td colspan="4" class="ui-state-default">Tipo de empaque</td></tr>
		<tr>
			<td width="22%" class="NoiseFooterTD"><?php if($campnomb["tipoemp_palletenf"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Pallets/enfardado</td>
			<td width="28%" class="NoiseDataTD">&nbsp;Si&nbsp;<input type="radio" name="tipoemp_palletenf" id="tipoemp_palletenf" value="si" <?php if($tipoemp_palletenf == 'si') echo ' checked' ?> />&nbsp;&nbsp;&nbsp;No&nbsp;<input type="radio" name="tipoemp_palletenf" id="tipoemp_palletenf"  value="no" <?php if($tipoemp_palletenf == 'no') echo ' checked' ?> /></td>
			<td width="22%" class="NoiseFooterTD"><?php if($campnomb["tipoemp_bolsatubpet"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Bolsa tub. peletizada</td>
			<td width="28%" class="NoiseDataTD">&nbsp;Si&nbsp;<input type="radio" name="tipoemp_bolsatubpet" id="tipoemp_bolsatubpet" value="si" <?php if($tipoemp_bolsatubpet == 'si') echo ' checked' ?> />&nbsp;&nbsp;&nbsp;No&nbsp;<input type="radio" name="tipoemp_bolsatubpet" id="tipoemp_bolsatubpet"  value="no" <?php if($tipoemp_bolsatubpet == 'no') echo ' checked' ?> /></td>
		</tr>
		<tr>
			<td width="22%" class="NoiseFooterTD"><?php if($campnomb["tipoemp_caja"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Cajas</td>
			<td width="28%" class="NoiseDataTD">&nbsp;Si&nbsp;<input type="radio" name="tipoemp_caja" id="tipoemp_caja" value="si" <?php if($tipoemp_caja == 'si') echo ' checked' ?> />&nbsp;&nbsp;&nbsp;No&nbsp;<input type="radio" name="tipoemp_caja" id="tipoemp_caja"  value="no" <?php if($tipoemp_caja == 'no') echo ' checked' ?> /></td>
			<td width="22%" class="NoiseFooterTD"><?php if($campnomb["tipoemp_pcore"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Protector de core</td>
			<td width="28%" class="NoiseDataTD">&nbsp;Si&nbsp;<input type="radio" name="tipoemp_pcore" id="tipoemp_pcore" value="si" <?php if($tipoemp_pcore == 'si') echo ' checked' ?> />&nbsp;&nbsp;&nbsp;No&nbsp;<input type="radio" name="tipoemp_pcore" id="tipoemp_pcore"  value="no" <?php if($tipoemp_pcore == 'no') echo ' checked' ?> /></td>
		</tr>
		<tr>
			<td width="22%" class="NoiseFooterTD"><?php if($campnomb["tipoemp_cartonext"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Protector de carton ex.</td>
			<td width="28%" class="NoiseDataTD">&nbsp;Si&nbsp;<input type="radio" name="tipoemp_cartonext" id="tipoemp_cartonext" value="si" <?php if($tipoemp_cartonext == 'si') echo ' checked' ?> />&nbsp;&nbsp;&nbsp;No&nbsp;<input type="radio" name="tipoemp_cartonext" id="tipoemp_cartonext"  value="no" <?php if($tipoemp_cartonext == 'no') echo ' checked' ?> /></td>
			<td width="22%" class="NoiseFooterTD"><?php if($campnomb["tipoemp_separadorc"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Separador de carton</td>
			<td width="28%" class="NoiseDataTD">&nbsp;Si&nbsp;<input type="radio" name="tipoemp_separadorc" id="tipoemp_separadorc" value="si" <?php if($tipoemp_separadorc == 'si') echo ' checked' ?> />&nbsp;&nbsp;&nbsp;No&nbsp;<input type="radio" name="tipoemp_separadorc" id="tipoemp_separadorc"  value="no" <?php if($tipoemp_separadorc == 'no') echo ' checked' ?> /></td>
		</tr>
		<tr>
			<td width="22%" class="NoiseFooterTD"><?php if($campnomb["tipoemp_envueltoc"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Envuelto en corrugado</td>
			<td width="28%" class="NoiseDataTD">&nbsp;Si&nbsp;<input type="radio" name="tipoemp_envueltoc" id="tipoemp_envueltoc" value="si" <?php if($tipoemp_envueltoc == 'si') echo ' checked' ?> />&nbsp;&nbsp;&nbsp;No&nbsp;<input type="radio" name="tipoemp_envueltoc" id="tipoemp_envueltoc"  value="no" <?php if($tipoemp_envueltoc == 'no') echo ' checked' ?> /></td>
			<td width="22%" class="NoiseFooterTD"><?php if($campnomb["tipoemp_suspendido"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Suspendido </td>
			<td width="28%" class="NoiseDataTD">&nbsp;Si&nbsp;<input type="radio" name="tipoemp_suspendido" id="tipoemp_suspendido" value="si" <?php if($tipoemp_suspendido == 'si') echo ' checked' ?> />&nbsp;&nbsp;&nbsp;No&nbsp;<input type="radio" name="tipoemp_suspendido" id="tipoemp_suspendido"  value="no" <?php if($tipoemp_suspendido == 'no') echo ' checked' ?> /></td>
		</tr>
		<tr>
			<td width="22%" class="NoiseFooterTD"><?php if($campnomb["tipoemp_estibaexp"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Estibas tipo exp.</td>
			<td colspan="3" class="NoiseDataTD">&nbsp;Si&nbsp;<input type="radio" name="tipoemp_estibaexp" id="tipoemp_estibaexp" value="si" <?php if($tipoemp_estibaexp == 'si') echo ' checked' ?> />&nbsp;&nbsp;&nbsp;No&nbsp;<input type="radio" name="tipoemp_estibaexp" id="tipoemp_estibaexp"  value="no" <?php if($tipoemp_estibaexp == 'no') echo ' checked' ?> /></td>
		</tr>
	</table>
	
	<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr><td colspan="4" class="ui-state-default">Unidades de medida</td></tr>
		<tr>
			<td width="22%" class="NoiseFooterTD"><?php if($campnomb["unimedi_und"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Unidades</td>
			<td width="28%" class="NoiseDataTD">&nbsp;Si&nbsp;<input type="radio" name="unimedi_und" id="unimedi_und" value="si" <?php if($unimedi_und == 'si') echo ' checked' ?> />&nbsp;&nbsp;&nbsp;No&nbsp;<input type="radio" name="unimedi_und" id="unimedi_und"  value="no" <?php if($unimedi_und == 'no') echo ' checked' ?> /></td>
			<td width="22%" class="NoiseFooterTD"><?php if($campnomb["unimedi_kgs"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Kilos</td>
			<td width="28%" class="NoiseDataTD">&nbsp;Si&nbsp;<input type="radio" name="unimedi_kgs" id="unimedi_kgs" value="si" <?php if($unimedi_kgs == 'si') echo ' checked' ?> />&nbsp;&nbsp;&nbsp;No&nbsp;<input type="radio" name="unimedi_kgs" id="unimedi_kgs"  value="no" <?php if($unimedi_kgs == 'no') echo ' checked' ?> /></td>
		</tr>
		<tr>
			<td width="22%" class="NoiseFooterTD"><?php if($campnomb["unimedi_mill"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Millares</td>
			<td width="28%" class="NoiseDataTD">&nbsp;Si&nbsp;<input type="radio" name="unimedi_mill" id="unimedi_mill" value="si" <?php if($unimedi_mill == 'si') echo ' checked' ?> />&nbsp;&nbsp;&nbsp;No&nbsp;<input type="radio" name="unimedi_mill" id="unimedi_mill"  value="no" <?php if($unimedi_mill == 'no') echo ' checked' ?> /></td>
			<td width="22%" class="NoiseFooterTD"><?php if($campnomb["unimedi_mtr"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Metros</td>
			<td width="28%" class="NoiseDataTD">&nbsp;Si&nbsp;<input type="radio" name="unimedi_mtr" id="unimedi_mtr" value="si" <?php if($unimedi_mtr == 'si') echo ' checked' ?> />&nbsp;&nbsp;&nbsp;No&nbsp;<input type="radio" name="unimedi_mtr" id="unimedi_mtr"  value="no" <?php if($unimedi_mtr == 'no') echo ' checked' ?> /></td>
		</tr>
	</table>
	
	<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr><td class="ui-state-default"></td></tr>
		<tr><td class="NoiseFooterTD"><?php if($campnomb["note_embalaje"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD"><textarea name="note_embalaje" cols="116" rows="3"><?php echo $note_embalaje; ?></textarea></tr>
	</table>
	</div>
</div>
<!-- FIN PESTAÑA ESPECIFICACIONES DEL EMBALAJE -->

<!-- PESTAÑA ESPECIFICACIONES DE MATERIAL EXTRUIDO -->
<div id="opt-tab5">
	<div id="esp_ext_seccion">
		<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td colspan="4" class="ui-state-default">&nbsp;Estructura</td>
			</tr>
			<tr>
				<td colspan="4" >
					<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
						<?php if($tipo_impresion == 'interna' || $tipo_impresion == 'externa'){$idcon = fncconn();?>
						<tr>
							<td width="22%" class="NoiseFooterTD">&nbsp;Material a imprimir</td>
							<td width="78%" class="NoiseDataTD">&nbsp;<input type="hidden" name="product_imp" id="product_imp" value="<?php echo $product_imp ?>" /><input type="hidden" name="product_imp_nomb" id="product_imp_nomb" value="<?php echo $product_imp_nomb ?>" /><?php echo ($product_imp_nomb)? strtoupper($product_imp_nomb) : '---' ;?></td>
						</tr>
							<?php if($tipo_estruc != 'monocapa'){?>
								<?php for($h=0;$h<$valid_produc_imp;$h++){
								$obj_produclam = 'product_lam_'.($h +1);
								$obj_produclam_nomb = 'laminado_'.($h +1);
								$rwPad = loadrecordpadreitem($$obj_produclam,$idcon);
								$$obj_produclam_nomb = $rwPad['paditenombre']
							?>
						<tr>
							<td width="22%" class="NoiseFooterTD">&nbsp;Material a laminar # <?php echo ($h +1 )?></td>
							<td width="78%" class="NoiseDataTD">&nbsp;<input type="hidden" name="<?php echo $obj_produclam ?>" id="<?php echo $obj_produclam ?>" value="<?php echo $$obj_produclam ?>" /><input type="hidden" name="<?php echo $obj_produclam_nomb ?>" id="<?php echo $obj_produclam_nomb ?>" value="<?php echo $$obj_produclam_nomb ?>" /><?php echo ($$obj_produclam_nomb)? strtoupper($$obj_produclam_nomb) : '---' ;?></td>
						</tr>
								<?php }?>
							<?php }?>
						<?php }?>
					</table>
				</td>
			</tr>
		</table>
		<div id="filtrlistamatextruido">
			<?php
				$noAjax = true;
				include '../src/FunjQuery/jquery.phpscripts/jquery.ajax_matextruido.fic.php';  
			?>
		</div>
	</div>
</div>
<!-- FIN PESTAÑA ESPECIFICACIONES DE MATERIAL EXTRUIDO -->

<!-- PESTAÑA LAMINADO -->
<div id="opt-tab6">
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr> 
	  		<td width="20%" class="NoiseFooterTD"><?php if ($campnomb["papel_pouch_lam"] == 1) { $papel_pouch_lam = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Papel Pouch</td>
	  		<td width="30%" class="NoiseDataTD">&nbsp;Si&nbsp;<input type="radio" name="papel_pouch_lam" id="papel_pouch_lam" onclick="eventPapelpouch_lam(this.value);" value="si" <?php if($papel_pouch_lam == 'si'){echo 'checked';}?> />&nbsp;&nbsp;&nbsp;No&nbsp;<input type="radio" name="papel_pouch_lam" id="papel_pouch_lam" onclick="eventPapelpouch_lam(this.value);" value="no" <?php if($papel_pouch_lam == 'no'){echo 'checked';}?> /></td>
	  		<td width="20%" class="NoiseFooterTD"><span id="lb_papel_pouch_lampor" style="display : <?php if($papel_pouch_lam == 'si'){echo 'block';}else{echo 'none';}?>"><?php if ($campnomb["papel_pouch_lampor"] == 1) { $papel_pouch_lampor = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Laminado por </span></td>
	  		<td width="30%" class="NoiseDataTD"><span id="obj_papel_pouch_lampor" style="display : <?php if($papel_pouch_lam == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Brillante&nbsp;<input type="radio" name="papel_pouch_lampor" id="papel_pouch_lampor" value="brillante" <?php if($papel_pouch_lampor == 'brillante'){echo 'checked';}?> />&nbsp;&nbsp;&nbsp;Opaco&nbsp;<input type="radio" name="papel_pouch_lampor" id="papel_pouch_lampor" value="opaco" <?php if($papel_pouch_lampor == 'opaco'){echo 'checked';}?> /></span></td>
	  	</tr>
	  	<tr> 
	  		<td width="20%" class="NoiseFooterTD"><?php if ($campnomb["foil_lam"] == 1) { $foil_lam = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Foil</td>
	  		<td width="30%" class="NoiseDataTD">&nbsp;Si&nbsp;<input type="radio" name="foil_lam" id="foil_lam" onclick="eventFoil_lam(this.value);" value="si" <?php if($foil_lam == 'si'){echo 'checked';}?> />&nbsp;&nbsp;&nbsp;No&nbsp;<input type="radio" name="foil_lam" id="foil_lam" onclick="eventFoil_lam(this.value);" value="no" <?php if($foil_lam == 'no'){echo 'checked';}?> /></td>
	  		<td width="20%" class="NoiseFooterTD"><span id="lb_foil_lampor" style="display : <?php if($foil_lam == 'si'){echo 'block';}else{echo 'none';}?>"><?php if ($campnomb["foil_lampor"] == 1) { $foil_lampor = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Laminado por </span></td>
	  		<td width="30%" class="NoiseDataTD"><span id="obj_foil_lampor" style="display : <?php if($foil_lam == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Brillante&nbsp;<input type="radio" name="foil_lampor" id="foil_lampor" value="brillante" <?php if($foil_lampor == 'brillante'){echo 'checked';}?> />&nbsp;&nbsp;&nbsp;Opaco&nbsp;<input type="radio" name="foil_lampor" id="foil_lampor" value="opaco" <?php if($foil_lampor == 'opaco'){echo 'checked';}?> /></span></td>
	  	</tr>
	</table>
</div>

<!-- FIN PESTAÑA LAMINADO -->

<!-- PESTAÑA CORTE O REFILADO  -->
<div id="opt-tab7">
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="35%" class="NoiseFooterTD"><?php if($campnomb["diametro_core"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Diametro del core </td>
			<td width="15%" class="NoiseDataTD">
				<select name="diametro_core" id="diametro_core">
					<option value="">-- Seleccione --</option>
					<option value="50.8mm"<?php if($diametro_core == '50.8mm') echo ' selected' ?>>50.8 mm</option>
					<option value="76.2mm"<?php if($diametro_core == '76.2mm') echo ' selected' ?>>76.2 mm</option>
					<option value="152.4mm"<?php if($diametro_core == '152.4mm') echo ' selected' ?>>152.4 mm</option>
				</select>
			</td>
			<td width="25%" class="NoiseFooterTD"><?php if($campnomb["trata_corte"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Tratamiento</td>
			<td width="25%" class="NoiseDataTD">
				<select name="trata_corte" id="trata_corte">
					<option value="">-- Seleccione --</option>
					<option value="interno"<?php if($trata_corte == 'interno') echo ' selected' ?>>Interno</option>
					<option value="externo"<?php if($trata_corte == 'externo') echo ' selected' ?>>Externo</option>
					<option value="na"<?php if($trata_corte == 'na') echo ' selected' ?>>N/A</option>
				</select>
			</td>
		</tr>
		<tr>
			<td width="35%" class="NoiseFooterTD"><?php if($campnomb["abundancia"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;abundancia (mm)</td>
			<td width="15%" class="NoiseDataTD"><input type="text" name="abundancia" id="abundancia" size="15" value="<?php echo $abundancia ?>" onkeypress="return event.keyCode!=13"/></td>
			<td width="25%" class="NoiseFooterTD"><?php if($campnomb["tole_abundancia_ms"] == 1 || $campnomb["tole_abundancia_mn"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Tolerancia de abundancia (mm)</td>
			<td width="25%" class="NoiseDataTD">
				<b>+</b><input type="text" name="tole_abundancia_ms" id="tole_abundancia_ms" size="8" <?php if($tole_abundancia_ms == '0') echo ' disabled ' ?> value="<?php echo $tole_abundancia_ms ?>" onkeypress="return event.keyCode!=13"/>&nbsp;
				<b>-</b><input type="text" name="tole_abundancia_mn" id="tole_abundancia_mn" size="8" <?php if($tole_abundancia_mn == '0') echo ' disabled ' ?> value="<?php echo $tole_abundancia_mn ?>" onkeypress="return event.keyCode!=13"/>
			</td>
		</tr>
	</table>
</div>
<!-- FIN PESTAÑA CORTE O REFILADO  -->

<!-- PESTAÑA SELLADO DOBLADO CORTE -->
<div id="opt-tab4a">
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td colspan="4" class="ui-state-default">&nbsp;Sellado</td>
		</tr>
		<tr>
			<td width="20%" class="NoiseFooterTD"><?php if($campnomb["tipo_sellado"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Tipo de sellado</td>
			<td width="30%" class="NoiseDataTD"><select name="tipo_sellado" id="tipo_sellado">
					<option value="">--Seleccione--</option>
					<option value="lateral" <?php if($tipo_sellado == 'lateral'){echo 'selected';}?> >Lateral</option>
					<option value="plano" <?php if($tipo_sellado == 'plano'){echo 'selected';}?> >Plano</option>
					<option value="hilo" <?php if($tipo_sellado == 'hilo'){echo 'selected';}?> >Hilo</option>
				</select>
			</td>
			<td width="20%" class="NoiseFooterTD"><?php if($campnomb["forma_sellado"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Forma sellado</td>
			<td width="30%" class="NoiseDataTD">
				<select name="forma_sellado" id="forma_sellado">
					<option value="">--Seleccione--</option>
					<option value="dorso-dorso" <?php if($forma_sellado == 'dorso-dorso'){echo 'selected';}?> >Dorso - Dorso</option>
					<option value="cara-dorso" <?php if($forma_sellado == 'cara-dorso'){echo 'selected';}?> >Cara - Dorso</option>
					<option value="cara-cara" <?php if($forma_sellado == 'cara-cara'){echo 'selected';}?> >Cara - Cara</option>
				</select>
			</td>
		</tr>
		<tr>
			<td width="20%" class="NoiseFooterTD"><?php if($campnomb["maquina"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Maquina</td>
			<td width="30%" class="NoiseDataTD">
				<select name="maquina" id="maquina">
					<option value="">--Seleccione--</option>
					<option value="pauchadora" <?php if($maquina == 'pauchadora'){echo 'selected';} ?> >Pauchadora</option>
					<option value="lateral" <?php if($maquina == 'lateral'){echo 'selected';} ?> >Lateral</option>
					<option value="china" <?php if($maquina == 'china'){echo 'selected';} ?> >China</option>
					<option value="renova" <?php if($maquina == 'renova'){echo 'selected';} ?> >Renova</option>
				</select>
			</td>
			<td width="25%" class="NoiseFooterTD"><?php if($campnomb["tamano_solapa"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Tama&ntilde;o  solapa (mm)</td>
			<td width="25%" class="NoiseDataTD"><input type="text" name="tamano_solapa" id="tamano_solapa" value="<?php echo $tamano_solapa ?>" size="7" /></td>
		</tr>
		<tr>
			<td width="20%" class="NoiseFooterTD"><?php if($campnomb["dist_precalentadores"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Distancia precalentadores (mm)</td>
			<td colspan="3" class="NoiseDataTD"><input type="text" name="dist_precalentadores" id="dist_precalentadores" value="<?php echo $dist_precalentadores ?>" /></td>
		</tr>
		<tr>
			<td width="25%" class="NoiseFooterTD"><span style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>"><?php if($campnomb["cod_valve"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Valvula</span></td>
			<td colspan="3" class="NoiseDataTD"><span style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>"><input type="hidden" name="cod_valve" id="cod_valve" value="<?php echo $cod_valve ?>"/><input type="text" name="valve_item" id="valve_item" value="<?php echo $valve_item ?>" onkeypress="return event.keyCode!=13" size="40"/></span></td>
		</tr>
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="4">&nbsp;Observaciones </td>
		<tr><td class="NoiseDataTD"  colspan="4"><textarea name="note_sellado" cols="116" rows="3"><?php echo $note_sellado ?></textarea></tr>
	</table>	
	
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td colspan="4" class="ui-state-default"><?php if($campnomb["doblado"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Doblado&nbsp;Si&nbsp;<input type="radio" name="doblado" id="doblado" value="si" <?php if($doblado == 'si'){echo 'checked';}?> onclick="eventDoblado(this.value);" />&nbsp;No&nbsp;<input type="radio" name="doblado" id="doblado" value="no" <?php if($doblado == 'no'){echo 'checked';}?> onclick="eventDoblado(this.value);" /></td>
		</tr>		
		<tr><td class="NoiseFooterTD" colspan="4"><span id="note_doblado_lb" style="display : <?php if($doblado == 'si'){echo 'block';}else{echo 'none';}?>"><?php if($campnomb["note_doblado"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Observaciones</span> </td>
		<tr><td class="NoiseDataTD"  colspan="4"><span id="note_doblado_obj" style="display : <?php if($doblado == 'si'){echo 'block';}else{echo 'none';}?>"><textarea name="note_doblado" id="note_doblado" cols="116" rows="3"><?php echo $note_doblado ?></textarea></span></tr>
	</table>
	
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td colspan="4" class="ui-state-default"><?php if($campnomb["micro"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Micro&nbsp;Si&nbsp;<input type="radio" name="micro" id="micro" value="si" <?php if($micro == 'si'){echo 'checked';}?> onclick="eventMicro(this.value);" />&nbsp;No&nbsp;<input type="radio" name="micro" id="micro" value="no" <?php if($micro == 'no'){echo 'checked';}?> onclick="eventMicro(this.value);" /></td>
		</tr>
		<tr>
			<td width="20%" class="NoiseFooterTD"><span id="mcr_tipo_perforacion_lb" style="display : <?php if($micro == 'si'){echo 'block';}else{echo 'none';}?>"><?php if($campnomb["mcr_tipo_perforacion"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Tipo perforacion</span></td>
			<td width="30%" class="NoiseDataTD"><span id="mcr_tipo_perforacion_obj" style="display : <?php if($micro == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;
				<select name="mcr_tipo_perforacion" id="mcr_tipo_perforacion">
					<option value="">--Seleccione</option>
					<option value="10x10" <?php if($mcr_tipo_perforacion == '10x10'){echo 'selected';} ?> >10 X 10</option>
					<option value="5x5" <?php if($mcr_tipo_perforacion == '5x5'){echo 'selected';} ?> >5 X 5</option>
				</select></span>
			</td>
			<td width="25%" class="NoiseFooterTD"><span id="mrc_cant_cara_microper_lb" style="display : <?php if($micro == 'si'){echo 'block';}else{echo 'none';}?>"><?php if($campnomb["mrc_cant_cara_microper"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Cantidad de caras microperforadas</span></td>
			<td width="25%" class="NoiseDataTD"><span id="mrc_cant_cara_microper_obj" style="display : <?php if($micro == 'si'){echo 'block';}else{echo 'none';}?>"><input type="text" name="mrc_cant_cara_microper" id="mrc_cant_cara_microper" value="<?php echo $mrc_cant_cara_microper ?>" size="7" /></span></td>
		</tr>
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="4"><span id="note_micro_lb" style="display : <?php if($micro == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Observaciones</span></td>
		<tr><td class="NoiseDataTD"  colspan="4"><span id="note_micro_obj" style="display : <?php if($micro == 'si'){echo 'block';}else{echo 'none';}?>"><textarea name="note_micro" cols="116" rows="3"><?php echo $note_micro ?></textarea></span></tr>
	</table>
</div>
<!-- FIN PESTAÑA SELLADO DOBLADO CORTE -->