<!-- PESTAÑA 2 ESPECIFICACIONES DEL PRODUCTO -->
<div id="opt-tab2">
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content"> 	
		<tr> 
	  		<td width="20%" class="NoiseFooterTD">&nbsp;Tipo de estructura</td>
	  		<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="tipo_estruc" id="tipo_estruc" value="<?php echo $tipo_estruc ?>" /><?php echo ($tipo_estruc)? strtoupper($tipo_estruc) : '---' ;?></td>
			<td width="20%" class="NoiseFooterTD">&nbsp;Tipo de impresi&oacute;n</td>
	  		<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="tipo_impresion" id="tipo_impresion" value="<?php echo $tipo_impresion ?>" /><?php echo ($tipo_impresion)? strtoupper($tipo_impresion) : '---' ;?></td>
		</tr>
		<tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;Maquina</td>
			<td colspan="3" class="NoiseDataTD">
			<input type="hidden" name="equipocodigo" id="equipocodigo" value="<?php echo $equipocodigo ?>" />
			<input type="hidden" name="equiponombre" id="equiponombre" value="<?php echo $equiponombre ?>" />
			&nbsp;<?php echo ($equipocodigo)? strtoupper($equipocodigo) : '-------' ; ?> - <?php echo ($equiponombre)? strtoupper($equiponombre) : '-------' ; ?></td>
		</tr>
	</table>
	
	<div id="item_sessiond" style="display: <?php if($tipo_impresion == 'sin_impresion') echo 'none'; else echo 'block' ?>;">
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td colspan="2">
				<div id="filtrlistacolores">
					<?php 
  						$noAjax = true;
  						$flagdetallar = 1;
	  					include '../src/FunjQuery/jquery.visors/jquery.dispensing.php'; 
  					?>
  				</div>
  			</td>
  		</tr>
  		<tr>
			<td class="NoiseFooterTD" width="20%">&nbsp;Productos aprobados por</td> 
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
			<td width="20%" class="NoiseFooterTD">&nbsp;Tintas resistentes a:&nbsp;&nbsp;</td>
			<td width="80%" class="NoiseDataTD">		  		
		  			<input type="hidden" name="tnt_calor" id="tnt_calor" value="<?php echo $tnt_calor ?>" />
		  			<input type="hidden" name="tnt_luz" id="tnt_luz" value="<?php echo $tnt_luz ?>" />
		  			<input type="hidden" name="tnt_acidos" id="tnt_acidos" value="<?php echo $tnt_acidos ?>" />
		  			<input type="hidden" name="tnt_alcalis" id="tnt_alcalis" value="<?php echo $tnt_alcalis ?>" />
		  			<input type="hidden" name="tnt_agua" id="tnt_agua" value="<?php echo $tnt_agua ?>" />
		  			<input type="hidden" name="tnt_grasas" id="tnt_grasas" value="<?php echo $tnt_grasas ?>" />
		  			<input type="hidden" name="tnt_brillo" id="tnt_brillo" value="<?php echo $tnt_brillo ?>" />
		  			<input type="hidden" name="tnt_rayado" id="tnt_rayado" value="<?php echo $tnt_rayado ?>" />
		  			<input type="hidden" name="tintasa" id="tintasa" value="<?php echo $tintasa ?>" />
		  			&nbsp;<?php echo strtoupper($tintasa) ?>
		  	</td>
		  </tr>
		  <tr>
		  	<td colspan="2">
		  		<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content"> 	
					<tr> 
	  					<td width="20%" class="NoiseFooterTD">&nbsp;Version del arte</td>
	  					<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="version_arte" id="version_arte" value="<?php echo $version_arte  ?>" size="7" /><?php echo ($version_arte)? strtoupper($version_arte) : '---' ;?>
	  				</tr>
	  				<tr> 
	  					<td width="20%" class="NoiseFooterTD">&nbsp;Papel Pouch</td>
	  					<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="papel_pouch_imp" id="papel_pouch_imp" value="<?php echo $papel_pouch_imp ?>" /><?php echo ($papel_pouch_imp)? strtoupper($papel_pouch_imp) : '---' ;?></td>
	  					<td width="20%" class="NoiseFooterTD"><span id="lb_papel_pouch_imppor" style="display : <?php if($papel_pouch_imp == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Impreso por </span></td>
	  					<td width="30%" class="NoiseDataTD"><span id="obj_papel_pouch_imppor" style="display : <?php if($papel_pouch_imp == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="hidden" name="papel_pouch_imppor" id="papel_pouch_imppor" value="<?php echo $papel_pouch_imppor ?>" /><?php echo ($papel_pouch_imppor)? strtoupper($papel_pouch_imppor) : '---' ; ?></span></td>
	  				</tr>
	  				<tr> 
	  					<td width="20%" class="NoiseFooterTD">&nbsp;Foil</td>
	  					<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="foil_imp" id="foil_imp" value="<?php echo $foil_imp ?>" /><?php echo ($foil_imp)? strtoupper($foil_imp) : '---' ;?></td>
	  					<td width="20%" class="NoiseFooterTD"><span id="lb_foil_imppor" style="display : <?php if($foil_imp == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Impreso por </span></td>
	  					<td width="30%" class="NoiseDataTD"><span id="obj_foil_imppor" style="display : <?php if($foil_imp == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="hidden" name="foil_imppor" id="foil_imppor" value="<?php echo $foil_imppor ?>"/><?php echo ($foil_imppor)? strtoupper($foil_imppor) : '---' ; ?></span></td>
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
				<td width="20%" class="NoiseFooterTD">&nbsp;Tolerancia calibre <!--(&micro;m)--> (%) </td>
				<td width="30%" class="NoiseDataTD">
					<b>+</b><input type="hidden" name="tole_calib_ms" id="tole_calib_ms" value="<?php echo $tole_calib_ms ?>" />&nbsp;<?php echo ($tole_calib_ms)? $tole_calib_ms : '**' ; ?>
					<b>-</b><input type="hidden" name="tole_calib_mn" id="tole_calib_mn" value="<?php echo $tole_calib_mn ?>" />&nbsp;<?php echo ($tole_calib_mn)? $tole_calib_mn : '**' ; ?>
				</td>
				<td width="20%" class="NoiseFooterTD">&nbsp;Tolerancia gramaje <!--(g)--> (%) </td>
				<td width="30%" class="NoiseDataTD">
				<b>+</b><input type="hidden" name="tole_grama_ms" id="tole_grama_ms" value="<?php echo $tole_grama_ms ?>" />&nbsp;<?php echo ($tole_grama_ms)? $tole_grama_ms : '**' ;?>
				<b>-</b><input type="hidden" name="tole_grama_mn" id="tole_grama_mn" value="<?php echo $tole_grama_mn ?>" />&nbsp;<?php echo ($tole_grama_mn)? $tole_grama_mn : '**' ;?>
				</td>
			</tr>
		</table>
		</div>
	</div>
	
	<br/>
	<div id="medidas_seccion">
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
		<td colspan="4" class="ui-state-default">&nbsp;Medidas Bolsa Pouch Lateral</td>
		</tr>
		<tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;Ancho (mm)</td>
			<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="ancho" id="ancho" value="<?php echo $ancho ?>" /><?php echo ($ancho)? $ancho : '---' ; ?></td>
			<td width="20%" class="NoiseFooterTD">&nbsp;Tolerancia del ancho (mm)</td>
			<td width="30%" class="NoiseDataTD">
				<b>+</b>&nbsp;<input type="hidden" name="tole_ancho_ms" id="tole_ancho_ms" value="<?php echo $tole_ancho_ms ?>" /><?php echo ($tole_ancho_ms)? $tole_ancho_ms : '**' ; ?>
				<b>-</b>&nbsp;<input type="hidden" name="tole_ancho_mn" id="tole_ancho_mn" value="<?php echo $tole_ancho_mn ?>" /><?php echo ($tole_ancho_mn)? $tole_ancho_mn : '**' ; ?>
			</td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Largo (mm)</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="largo" id="largo" value="<?php echo $largo ?>" /><?php echo ($largo) ?$largo : '---' ; ?></td>
			<td class="NoiseFooterTD">&nbsp;Tolerancia de largo (mm)</td>
			<td class="NoiseDataTD">
				<b>+</b>&nbsp;<input type="hidden" name="tole_largo_ms" id="tole_largo_ms" value="<?php echo $tole_largo_ms ?>" /><?php echo ($tole_largo_ms)? $tole_largo_ms : '**' ; ?>
				<b>-</b>&nbsp;<input type="hidden" name="tole_largo_mn" id="tole_largo_mn" value="<?php echo $tole_largo_mn ?>" /><?php echo ($tole_largo_mn)? $tole_largo_mn : '**' ; ?>
			</td>
		</tr>
		<tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;Ancho impresion (mm)</td>
			<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="ancho_impresion" id="ancho_impresion" value="<?php echo $ancho_impresion ?>" /><?php echo ($ancho_impresion)? $ancho_impresion : '---' ; ?></td>
			<td width="20%" class="NoiseFooterTD">&nbsp;Tolerancia ancho imp (mm)</td>
			<td width="30%" class="NoiseDataTD">
				<b>+</b>&nbsp;<input type="hidden" name="tole_ancho_impresion_ms" id="tole_ancho_impresion_ms" value="<?php echo $tole_ancho_impresion_ms ?>" /><?php echo ($tole_ancho_impresion_ms)? $tole_ancho_impresion_ms : '**' ; ?>
				<b>-</b>&nbsp;<input type="hidden" name="tole_ancho_impresion_mn" id="tole_ancho_impresion_mn" value="<?php echo $tole_ancho_impresion_mn ?>" /><?php echo ($tole_ancho_impresion_mn)? $tole_ancho_impresion_mn : '**' ; ?>
			</td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Largo impresion (mm)</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="largo_impresion" id="largo_impresion" value="<?php echo $largo_impresion ?>" /><?php echo ($largo_impresion) ? $largo_impresion : '---' ; ?></td>
			<td class="NoiseFooterTD">&nbsp;Tolerancia largo imp (mm)</td>
			<td class="NoiseDataTD">
				<b>+</b>&nbsp;<input type="hidden" name="tole_largo_impresion_ms" id="tole_largo_impresion_ms" value="<?php echo $tole_largo_impresion_ms ?>" /><?php echo ($tole_largo_impresion_ms)? $tole_largo_impresion_ms : '**' ; ?>
				<b>-</b>&nbsp;<input type="hidden" name="tole_largo_impresion_mn" id="tole_largo_impresion_mn" value="<?php echo $tole_largo_impresion_mn ?>" /><?php echo ($tole_largo_impresion_mn)? $tole_largo_impresion_mn : '**' ; ?>
			</td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><span id="ncaras_imp_lb" style="display : <?php if($tipo_impresion != 'sin_impresion'){echo 'block';}else{'none';}?>">&nbsp;No. de caras impresas</span></td>
			<td class="NoiseDataTD" colspan="3"><span id="ncaras_imp_obj" style="display : <?php if($tipo_impresion != 'sin_impresion'){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="hidden" name="ncaras_imp" id="ncaras_imp" value="<?php echo $ncaras_imp ?>" /><?php echo ($ncaras_imp)? strtoupper($ncaras_imp) : '---' ; ?></span></td>
		</tr>
		<tr>
		<td colspan="4" class="ui-state-default">&nbsp;Accesorios de Bolsa Pouch Lateral</td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Troquel</td>
			<td class="NoiseDataTD" colspan="3">&nbsp;<input type="hidden" name="troquel" id="troquel" value="<?php echo $troquel ?>"><?php echo ($troquel)? strtoupper($troquel) : '---' ; ?></td>
		</tr>
	</table>
	
	<div style="display: <?php if($troquel == 'si'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td class="NoiseFooterTD" width="20%">&nbsp;Tipo de troquel</td>
				<td class="NoiseDataTD" width="80%">&nbsp;<input type="hidden" name="tipo_troquel" id="tipo_troquel" value="<?php echo $tipo_troquel ?>" /><?php echo ($tipo_troquel)? strtoupper($tipo_troquel) : '---' ; ?></td>
			</tr>
		</table>
	</div>
	
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
		<td colspan="4" class="ui-state-default">&nbsp;Especificaciones Bolsa Pouch Lateral</td>
		</tr>
		<tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;No. de sellos</td>
			<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="nro_sellos" id="nro_sellos" value="<?php echo ($nro_sellos)? strtoupper($nro_sellos) : '---' ; ?>" /><?php echo ($nro_sellos)? strtoupper($nro_sellos) : '---' ; ?></td>
	  		<td width="20%" class="NoiseFooterTD">&nbsp;Ancho de selle a las bolsas</td>
	  		<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="aselle_bolsa" id="aselle_bolsa" value="<?php echo $aselle_bolsa; ?>" /><?php echo ($aselle_bolsa)? strtoupper($aselle_bolsa) : '---' ; ?></td>
		</tr>
		<tr>
		<td colspan="4" class="ui-state-default">&nbsp;Accesorios Bolsa Pouch Lateral</td>
		</tr>
		<tr>
	 	  	<td width="20%" class="NoiseFooterTD">&nbsp;V&aacute;lvula</td>
	 	  	<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="valve" id="valve" value="<?php echo $valve ?>" /><?php echo ($valve)? strtoupper($valve) : '---' ; ?></td>
	 	  	<td width="24%" class="NoiseFooterTD">&nbsp;Ancho de selle a las bolsas (mm)</td>
	  		<td width="26%" class="NoiseDataTD">&nbsp;<input type="hidden" name="aselle_bolsa" id="aselle_bolsa" value="<?php echo $aselle_bolsa ?>"><?php echo ($aselle_bolsa)? $aselle_bolsa : '---' ; ?></td>
	  	</tr>
		<tr> 
			<td class="NoiseFooterTD"><span style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Color Tapa V&aacute;lvula</span></td> 
			<td class="NoiseDataTD"><span id="ctapa_valveobj" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="hidden" name="ctapa_valve" id="ctapa_valve" value="<?php echo $ctapa_valve ?>" /><?php echo ($ctapa_valve)? strtoupper($ctapa_valve) : '---' ; ?></span></td>
	  		<td class="NoiseFooterTD"><span id="medi_valvelb" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Medida V&aacute;lvula (mm)</span></td>
	  		<td class="NoiseDataTD"><span id="medi_valveobj" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="hidden" name="medi_valve" id="medi_valve" value="<?php echo $medi_valve ?>" /><?php echo ($medi_valve)? strtoupper($medi_valve) : '---' ; ?></span></td>
	  	</tr>
	  	
		<tr> 
	  		<td class="NoiseFooterTD"><span id="ubic_valvelb" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Ubicaci&oacute;n V&aacute;lvula</span></td>
	  		<td class="NoiseDataTD"><span id="ubic_valveobj" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="hidden" name="ubic_valve" id="ubic_valve" value="<?php echo $ubic_valve ?>" /><?php echo ($ubic_valve)? strtoupper($ubic_valve) : '---' ; ?></span></td>
	  		<td class="NoiseFooterTD"><span id="tipo_valvelb" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Tipo de V&aacute;lvula</span></td>
	 	  	<td class="NoiseDataTD"><span id="tipo_valveobj" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="hidden" name="tipo_valve" id="tipo_valve" value="<?php echo $tipo_valve ?>" /><?php echo ($tipo_valve)? strtoupper($tipo_valve) : '---' ; ?></span></td>
	  	</tr>
	  	<tr>
	  		<td class="NoiseFooterTD"><span id="ziper_lb" style="display : <?php if($valve == 'si'){echo 'none';}else{echo 'block';}?>">&nbsp;Ziper</span></td>
	  		<td class="NoiseDataTD"><span id="ziper_obj" style="display : <?php if($valve == 'si'){echo 'none';}else{echo 'block';}?>">&nbsp;<input type="hidden" name="ziper" id="ziper" value="<?php echo ($ziper)? strtoupper($ziper) : '---' ; ?>" /><?php echo ($ziper)? strtoupper($ziper) : '---' ; ?></span></td>
	  		<td class="NoiseFooterTD"><span id="dist_ziper_lb" style="display : <?php if($ziper == 'si' && $valve == 'no'){echo 'block';}else{echo 'none';}?>">&nbsp;Dist. ziper al borde</span></td>
	  		<td class="NoiseDataTD"><span id="dist_ziper_obj" style="display : <?php if($ziper == 'si' && $valve == 'no'){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="hidden" name="dist_ziper" id="dist_ziper" value="<?php echo $dist_ziper; ?>"><?php echo ($dist_ziper)? strtoupper($dist_ziper) : '---' ; ?></span></td>
	  	</tr>
	  	<tr>
	  		<td class="NoiseFooterTD">&nbsp;Muesca</td>
	  		<td class="NoiseDataTD">&nbsp;<input type="hidden" name="muesca" id="muesca" value="<?php echo ($muesca)? strtoupper($muesca) : '---' ;?>" /><?php echo ($muesca)? strtoupper($muesca) : '---' ;?></td>
	  		<td class="NoiseFooterTD"><span id="dist_muesca_lb" style="display : <?php if($muesca == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Dist. muesca al borde</span></td>
	  		<td class="NoiseDataTD"><span id="dist_muesca_obj" style="display : <?php if($muesca == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="hidden" name="dist_muesca" id="dist_muesca" value="<?php echo $dist_muesca; ?>"><?php echo ($dist_muesca)? strtoupper($dist_muesca) : '---' ; ?></span></td>
	  	</tr>
	  	<tr>
	  		<td class="NoiseFooterTD">&nbsp;Precorte</td>
	  		<td class="NoiseDataTD">&nbsp;<input type="hidden" name="precorte" id="precorte" value="<?php echo $precorte ?>" /><?php echo ($precorte)? strtoupper($precorte) : '---' ; ?></td>
	  		<td class="NoiseFooterTD"><span id="dist_precorte_lb" style="display : <?php if($precorte == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Dist. precorte al borde</span></td>
	  		<td class="NoiseDataTD"><span id="dist_precorte_obj" style="display : <?php if($precorte == 'si'){echo 'block';}else{echo 'none';}?>"><input type="hidden" name="dist_precorte" id="dist_precorte" value="<?php echo $dist_precorte; ?>" /><?php echo ($dist_precorte)? strtoupper($dist_precorte) : '---' ;?></span></td>
	  	</tr>
	</table>
	
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;Llenado</td>
			<td width="30%" class="NoiseDataTD">&nbsp;&nbsp;<input type="hidden" name="tipo_llenado" id="tipo_llenado" value="<?php echo $tipo_llenado ?>" /><?php echo ($tipo_llenado)? strtoupper($tipo_llenado) : '---' ; ?></td>
			<td width="20%" class="NoiseFooterTD "><span id="cod_barras_lb" style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;C&oacute;digo de barras</span></td>
			<td width="30%" class="NoiseDataTD"><span id="cod_barras_obj" style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<input type="hidden" name="cod_barras" id="cod_barras" value="<?php echo $cod_barras ?>" /><?php echo ($cod_barras)? strtoupper($cod_barras) : '---' ; ?></span></td>
		</tr>
		<tr>
			<td width="20%" class="NoiseFooterTD"><span id="color_fondo_barras_lb" style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;Color fondo codigo barras</span></td>
			<td width="30%" class="NoiseDataTD"><span id="color_fondo_barras_obj" style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<input type="hidden" name="color_fondo_barras" id="color_fondo_barras" value="<?php echo $color_fondo_barras ?>" /><?php echo ($color_fondo_barras)? strtoupper($color_fondo_barras) : '---' ;?></span></td>
			<td width="20%" class="NoiseFooterTD "><span id="color_color_barras_lb" style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>"><?php if($campnomb["color_barras"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Color barras</span></td>
			<td width="30%" class="NoiseDataTD"><span id="color_color_barras_obj" style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<input type="hidden" name="color_barras" id="color_barras" value="<?php echo $color_barras ?>"/><?php echo ($color_barras)? strtoupper($color_barras) : '---' ;?></span></td>
		</tr>
	</table>
	<br>
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
	<?php if($tipo_impresion != 'sin_impresion'){?>
		<tr>
  			<td width="20%" class="NoiseFooterTD">&nbsp;Continuo</td>
  			<td width="80%" class="NoiseDataTD">&nbsp;<input type="hidden" name="continuo" id="continuo" value="<?php echo $continuo ?>" /><?php echo ($continuo)? strtoupper($continuo) : '---' ;?></td>
  		</tr>
		<tr>
  			<td width="20%" class="NoiseFooterTD"><span id="nrorepet_lb" style="display : <?php if($continuo == 'si'){echo 'none';}else{'block';}?>">&nbsp;No. Repeticiones</span></td>
  			<td width="80%" class="NoiseDataTD"><span id="nrorepet_obj" style="display : <?php if($continuo == 'si'){echo 'none';}else{'block';}?>">&nbsp;<input type="hidden" name="nrorepet" id="nrorepet" value="<?php echo $nrorepet ?>"/><?php echo ($nrorepet)? strtoupper($nrorepet) : '---' ;?></span></td>
  		</tr>
  		<tr>
  			<td width="20%" class="NoiseFooterTD">&nbsp;Rodillo</td>
  			<td width="80%" class="NoiseDataTD">&nbsp;<input type="hidden" name="rodillo" id="rodillo" value="<?php echo $rodillo ?>" /><?php echo ($rodillo)? strtoupper($rodillo) : '---' ; ?></td>
  		</tr>
  		<?php }?>
		<tr>
  			<td width="20%" class="NoiseFooterTD">&nbsp;No. Pistas</td>
  			<td width="80%" class="NoiseDataTD">&nbsp;<input type="hidden" name="nropistas" id="nropistas" value="<?php echo $nropistas ?>" /><?php echo ($nropistas)? $nropistas : '---' ; ?></td>
  		</tr>
		<tr><td class="ui-state-default" colspan="2"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="2">&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD" colspan="2">&nbsp;<?php echo $note_product; ?></td></tr>
	</table>
	</div>
</div>
<!-- FIN PESTAÑA ESPECIFICACIONES DEL PRODUCTO -->


<!-- PESTAÑA ESPECIFICACIONES DEL EMBALAJE -->
<div id="opt-tab4">
	<div id="esp_emb_seccion">
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="23%" class="NoiseFooterTD">&nbsp;Tipo de empaque</td>
			<td width="27%" class="NoiseDataTD">&nbsp;<input type="hidden" name="tipo_empaque" id="tipo_empaque" value="<?php echo $tipo_empaque ?>" /><?php echo ($tipo_empaque)? strtoupper($tipo_empaque) : '---' ; ?></td>
			<td width="23%" class="NoiseFooterTD">&nbsp;Unidades por empaque</td>
			<td width="27%" class="NoiseDataTD">&nbsp;<input type="hidden" name="uni_empaque" id="uni_empaque" value="<?php echo $uni_empaque ?>" /><?php echo ($uni_empaque)? strtoupper($uni_empaque) : '---' ; ?></td>
		</tr>
		<tr>
			<td width="23%" class="NoiseFooterTD"><span id="cod_caja_lb" style="display : <?php if($tipo_empaque == 'caja'){echo 'block';}else{echo 'none';}?>">&nbsp;Codigo de caja</span></td>
			<td colspan="3" class="NoiseDataTD"><span id="cod_caja_obj" style="display : <?php if($tipo_empaque == 'caja'){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="hidden" name="cod_caja" id="cod_caja" value="<?php echo $cod_caja ?>"/><input type="hidden" name="caja_item" id="caja_item" value="<?php echo $caja_item ?>" /><?php echo ($caja_item)? strtoupper($caja_item) : '---' ; ?></span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Unidades por paquete</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="uni_paquete" id="uni_paquete" value="<?php echo $uni_paquete ?>" /><?php echo ($uni_paquete)? strtoupper($uni_paquete) : '---' ;?></td>
			<td class="NoiseFooterTD">&nbsp;Peso m&aacute;ximo empaque (Kg)</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="peso_empaque" id="peso_empaque" value="<?php echo $peso_empaque ?>" /><?php echo ($peso_empaque)? strtoupper($peso_empaque) : '---' ;?></td>
		</tr>
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Material estibado</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="estibado" id="estibado" value="<?php echo $estibado ?>" /><?php echo ($estibado)? strtoupper($estibado) : '---' ; ?></td>
			<td class="NoiseDataTD">&nbsp;</td>
			<td class="NoiseDataTD">&nbsp;</td>
		</tr>
	</table>
	<div id="session_estibado" style="display: <?php if($estibado == 'si'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td width="23%" class="NoiseFooterTD">&nbsp;Tama&ntilde;o de estiba</td>
				<td width="27%" class="NoiseDataTD">&nbsp;<input type="hidden" name="tam_estiba" id="tam_estiba" value="<?php echo $tam_estiba ?>" /><?php echo ($tam_estiba)? $tam_estiba : '---' ; ?> </td>
				<td width="23%" class="NoiseFooterTD">&nbsp;Tipo de estiba</td>
				<td width="27%" class="NoiseDataTD">&nbsp;<input type="hidden" name="tipo_estiba" id="tipo_estiba" value="<?php echo $tipo_estiba ?>" /><?php echo ($tipo_estiba)? strtoupper($tipo_estiba) : '---' ; ?></td>
			</tr>
			<tr><td class="ui-state-default" colspan="4"></td></tr>
			<tr>
				<td class="NoiseFooterTD">&nbsp;Altura m&aacute;xima pallet (mm)</td>
				<td class="NoiseDataTD">&nbsp;<input type="hidden" name="alt_pallet" id="alt_pallet" value="<?php echo $alt_pallet ?>" /><?php echo ($alt_pallet)? $alt_pallet : '---'; ?></td>
				<td class="NoiseFooterTD">&nbsp;Peso por pallet (Kg)</td>
				<td class="NoiseDataTD">&nbsp;<input type="hidden" name="pes_pallet" id="peso_pallet" value="<?php echo $pes_pallet ?>" /><?php echo ($pes_pallet)? $pes_pallet: '---'; ?></td>
			</tr>
			<tr>
				<td class="NoiseFooterTD">&nbsp;Estresado</td>
				<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="estresado" id="estresado" value="<?php echo $estresado ?>" /><?php echo ($estresado)? strtoupper($estresado) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="23%" class="NoiseFooterTD">&nbsp;Codigo de estiba</td>
				<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name=cod_estiba id="cod_estiba" value="<?php echo $cod_estiba ?>"/><input type="hidden" name="estiba_item" id="estiba_item" value="<?php echo $estiba_item ?>" /><?php echo ($estiba_item)? strtoupper($estiba_item) : '---' ;?></td>
			</tr>
			<tr>
				<td class="NoiseFooterTD">&nbsp;Nivel x estiba&nbsp;</td>
				<td class="NoiseDataTD">&nbsp;<input type="hidden" name="niv_estiba" id="niv_estiba" value="<?php echo $niv_estiba ?>" /><?php echo ($niv_estiba)? $niv_estiba : "---"; ?> </td>
				<td class="NoiseFooterTD">&nbsp;Cantidad x Nivel&nbsp;</td>
				<td class="NoiseDataTD">&nbsp;<input type="hidden" name="cant_estiba" id="cant_estiba" value="<?php echo $cant_estiba ?>"  /><?php echo ($cant_estiba)? $cant_estiba : "---"; ?> </td>
			</tr>
		</table>
	</div>
	
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr><td colspan="4" class="ui-state-default">Tipo de empaque</td></tr>
		<tr>
			<td width="23%" class="NoiseFooterTD">&nbsp;Pallets/enfardado</td>
			<td width="27%" class="NoiseDataTD">&nbsp;<input type="hidden" name="tipoemp_palletenf" id="tipoemp_palletenf" value="<?php echo $tipoemp_palletenf ?>" /><?php echo ($tipoemp_palletenf)? strtoupper($tipoemp_palletenf) : '---' ; ?></td>
			<td width="23%" class="NoiseFooterTD">&nbsp;Bolsa tub. peletizada</td>
			<td width="27%" class="NoiseDataTD">&nbsp;<input type="hidden" name="tipoemp_bolsatubpet" id="tipoemp_bolsatubpet" value="<?php echo ($tipoemp_bolsatubpet)? strtoupper($tipoemp_bolsatubpet) : '---' ;?>" /><?php echo ($tipoemp_bolsatubpet)? strtoupper($tipoemp_bolsatubpet): '---' ;?></td>
		</tr>
		<tr>
			<td width="23%" class="NoiseFooterTD">&nbsp;Cajas</td>
			<td width="27%" class="NoiseDataTD">&nbsp;<input type="hidden" name="tipoemp_caja" id="tipoemp_caja" value="<?php echo $tipoemp_caja ?>" /><?php echo ($tipoemp_caja)? strtoupper($tipoemp_caja) : '---' ;?></td>
			<td width="23%" class="NoiseFooterTD">&nbsp;Protector de core</td>
			<td width="27%" class="NoiseDataTD">&nbsp;<input type="hidden" name="tipoemp_pcore" id="tipoemp_pcore" value="<?php echo $tipoemp_pcore ?>" /><?php echo ($tipoemp_pcore)? strtoupper($tipoemp_pcore) : '---' ;?></td>
		</tr>
		<tr>
			<td width="23%" class="NoiseFooterTD">&nbsp;Protector de carton ex.</td>
			<td width="27%" class="NoiseDataTD">&nbsp;<input type="hidden" name="tipoemp_cartonext" id="tipoemp_cartonext" value="<?php echo $tipoemp_cartonext ?>" /><?php echo ($tipoemp_cartonext)? strtoupper($tipoemp_cartonext) : '---' ;?></td>
			<td width="23%" class="NoiseFooterTD">&nbsp;Separador de carton</td>
			<td width="27%" class="NoiseDataTD">&nbsp;<input type="hidden" name="tipoemp_separadorc" id="tipoemp_separadorc" value="<?php echo $tipoemp_separadorc ?>" /><?php echo ($tipoemp_separadorc)? strtoupper($tipoemp_separadorc) : '---' ;?></td>
		</tr>
		<tr>
			<td width="23%" class="NoiseFooterTD">&nbsp;Envuelto en corrugado</td>
			<td width="27%" class="NoiseDataTD">&nbsp;<input type="hidden" name="tipoemp_envueltoc" id="tipoemp_envueltoc" value="<?php echo $tipoemp_envueltoc ?>" /><?php echo ($tipoemp_envueltoc)? strtoupper($tipoemp_envueltoc) : '---' ;?></td>
			<td width="23%" class="NoiseFooterTD">&nbsp;Suspendido </td>
			<td width="27%" class="NoiseDataTD">&nbsp;<input type="hidden" name="tipoemp_suspendido" id="tipoemp_suspendido" value="<?php echo $tipoemp_suspendido ?>" /><?php echo ($tipoemp_suspendido)? strtoupper($tipoemp_suspendido) : '---' ;?></td>
		</tr>
		<tr>
			<td width="23%" class="NoiseFooterTD">&nbsp;Estibas tipo exp.</td>
			<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="tipoemp_estibaexp" id="tipoemp_estibaexp" value="<?php echo $tipoemp_estibaexp ?>" /><?php echo ($tipoemp_estibaexp)? strtoupper($tipoemp_estibaexp) : '---' ;?></td>
		</tr>
	</table>
	
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr><td colspan="4" class="ui-state-default">Unidades de medida</td></tr>
		<tr>
			<td width="23%" class="NoiseFooterTD">&nbsp;Unidades</td>
			<td width="27%" class="NoiseDataTD">&nbsp;<input type="hidden" name="unimedi_und" id="unimedi_und" value="<?php echo $unimedi_und ?>" /><?php echo ($unimedi_und)? strtoupper($unimedi_und) : '---' ;?></td>
			<td width="23%" class="NoiseFooterTD">&nbsp;Kilos</td>
			<td width="27%" class="NoiseDataTD">&nbsp;<input type="hidden" name="unimedi_kgs" id="unimedi_kgs" value="<?php echo $unimedi_kgs ?>" /><?php echo ($unimedi_kgs)? strtoupper($unimedi_kgs) : '---' ;?></td>
		</tr>
		<tr>
			<td width="23%" class="NoiseFooterTD">&nbsp;Millares</td>
			<td width="27%" class="NoiseDataTD">&nbsp;<input type="hidden" name="unimedi_mill" id="unimedi_mill" value="<?php echo $unimedi_mill ?>" /><?php echo ($unimedi_mill)? strtoupper($unimedi_mill) : '---' ;?></td>
			<td width="23%" class="NoiseFooterTD">&nbsp;Metros</td>
			<td width="27%" class="NoiseDataTD">&nbsp;<input type="hidden" name="unimedi_mtr" id="unimedi_mtr" value="<?php echo $unimedi_mtr ?>" /><?php echo ($unimedi_mtr)? strtoupper($unimedi_mtr) : '---' ;?></td>
		</tr>
	</table>
		
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr><td class="ui-state-default"></td></tr>
		<tr><td class="NoiseFooterTD">&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD">&nbsp;<?php echo $note_embalaje; ?></tr>
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
				include '../src/FunjQuery/jquery.phpscripts/jquery.ajax_matextruido.det.php';  
			?>
		</div>
	</div>
</div>
<!-- FIN PESTAÑA ESPECIFICACIONES DE MATERIAL EXTRUIDO -->

<!-- PESTAÑA LAMINADO -->
<div id="opt-tab6">
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr> 
	  		<td width="20%" class="NoiseFooterTD">&nbsp;Papel Pouch</td>
	  		<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="papel_pouch_lam" id="papel_pouch_lam" value="<?php echo $papel_pouch_lam ?>" /><?php echo ($papel_pouch_lam)? strtoupper($papel_pouch_lam) : '---' ;?></td>
	  		<td width="20%" class="NoiseFooterTD"><span id="lb_papel_pouch_lampor" style="display : <?php if($papel_pouch_lam == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Laminado por </span></td>
	  		<td width="30%" class="NoiseDataTD"><span id="obj_papel_pouch_lampor" style="display : <?php if($papel_pouch_lam == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="hidden" name="papel_pouch_lampor" id="papel_pouch_lampor" value="<?php echo $papel_pouch_lampor ?>" /><?php echo ($papel_pouch_lampor)? strtoupper($papel_pouch_lampor) : '---' ;?></span></td>
	  	</tr>
	  	<tr> 
	  		<td width="20%" class="NoiseFooterTD">&nbsp;Foil</td>
	  		<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="foil_lam" id="foil_lam" value="<?php echo $foil_lam ?>" /><?php echo ($foil_lam)? strtoupper($foil_lam) : '---' ;?></td>
	  		<td width="20%" class="NoiseFooterTD"><span id="lb_foil_lampor" style="display : <?php if($foil_lam == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Laminado por </span></td>
	  		<td width="30%" class="NoiseDataTD"><span id="obj_foil_lampor" style="display : <?php if($foil_lam == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="hidden" name="foil_lampor" id="foil_lampor" value="<?php echo $foil_lampor ?>" /><?php echo ($foil_lampor)? strtoupper($foil_lampor) : '---' ;?></span></td>
	  	</tr>
	</table>
</div>

<!-- FIN PESTAÑA LAMINADO -->

<!-- PESTAÑA CORTE O REFILADO  -->
<div id="opt-tab7">
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="35%" class="NoiseFooterTD">&nbsp;Diametro del core </td>
			<td width="15%" class="NoiseDataTD">&nbsp;<input type="hidden" id="diametro_core" name="diametro_core" value="<?php echo $diametro_core ?>" /><?php echo ($diametro_core)? strtoupper($diametro_core) : '---'; ?></td>
			<td width="25%" class="NoiseFooterTD">&nbsp;Tratamiento</td>
			<td width="25%" class="NoiseDataTD">&nbsp;<input type="hidden" id="trata_corte" name="trata_corte" value="<?php echo $trata_corte ?>" /><?php echo ($trata_corte)? strtoupper($trata_corte) : '---'; ?></td>
		</tr>
		<tr>
			<td width="35%" class="NoiseFooterTD">&nbsp;abundancia (mm)</td>
			<td width="15%" class="NoiseDataTD">&nbsp;<input type="hidden" name="abundancia" id="abundancia" size="15" value="<?php echo $abundancia ?>" /><?php echo ($abundancia)? strtoupper($abundancia) : '---';?></td>
			<td width="25%" class="NoiseFooterTD">&nbsp;Tolerancia de abundancia (mm)</td>
			<td width="25%" class="NoiseDataTD">
				<b>+</b><input type="hidden" name="tole_abundancia_ms" id="tole_abundancia_ms" size="8" value="<?php echo $tole_abundancia_ms ?>" />&nbsp;<?php echo ($tole_abundancia_ms)? strtoupper($tole_abundancia_ms) : '---' ;?>
				<b>-</b><input type="hidden" name="tole_abundancia_mn" id="tole_abundancia_mn" size="8" value="<?php echo $tole_abundancia_mn ?>" />&nbsp;<?php echo ($tole_abundancia_mn)? strtoupper($tole_abundancia_mn) : '---' ; ?>
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
			<td width="20%" class="NoiseFooterTD">&nbsp;Forma sellado</td>
			<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="forma_sellado" id="forma_sellado" value="<?php echo $forma_sellado ?>" /><?php echo ($forma_sellado)? strtoupper($forma_sellado) : '---' ;?></td>
			<td width="20%" class="NoiseFooterTD">&nbsp;Distancia precalentadores (mm)</td>
			<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="dist_precalentadores" id="dist_precalentadores" value="<?php echo $dist_precalentadores ?>" /><?php echo ($dist_precalentadores)? strtoupper($dist_precalentadores) : '---' ;?></td>
		</tr>
		<tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;Maquina</td>
			<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="maquina" id="maquina" value="<?php echo $maquina ?>"/><?php echo ($maquina)? strtoupper($maquina) : '---' ; ?></td>
			<td width="25%" class="NoiseFooterTD">&nbsp;Tama&ntilde;o  solapa (mm)</td>
			<td width="25%" class="NoiseDataTD"><input type="hidden" name="tamano_solapa" id="tamano_solapa" value="<?php echo $tamano_solapa ?>" /><?php echo ($tamano_solapa)? strtoupper($tamano_solapa) : '---' ;?></td>
		</tr>
		<tr>
			<td width="25%" class="NoiseFooterTD"><span style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Valvula</span></td>
			<td colspan="3" class="NoiseDataTD"><span style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>"><input type="hidden" name="cod_valve" id="cod_valve" value="<?php echo $cod_valve ?>"/><input type="hidden" name="valve_item" id="valve_item" value="<?php echo $valve_item ?>" /><?php echo ($valve_item)? strtoupper($valve_item) : '---' ; ?></span></td>
		</tr>
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="4">&nbsp;Observaciones </td>
		<tr><td class="NoiseDataTD"  colspan="4">&nbsp;<?php echo $note_sellado ?></tr>
	</table>	
	
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td colspan="4" class="ui-state-default">&nbsp;Doblado&nbsp;<input type="hidden" name="doblado" id="doblado" value="<?php echo $doblado ?>" /><?php echo ($doblado)? strtoupper($doblado) : '---' ; ?></td>
		</tr>		
		<tr><td class="NoiseFooterTD" colspan="4"><span id="note_doblado_lb" style="display : <?php if($doblado == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Observaciones</span> </td>
		<tr><td class="NoiseDataTD"  colspan="4"><span id="note_doblado_obj" style="display : <?php if($doblado == 'si'){echo 'block';}else{echo 'none';}?>"><?php echo $note_doblado ?></span></tr>
	</table>
	
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td colspan="4" class="ui-state-default">&nbsp;Micro&nbsp;<input type="hidden" name="micro" id="micro" value="<?php echo $micro ?>" /><?php echo ($micro)? strtoupper($micro) : '---' ;?></td>
		</tr>
		<tr>
			<td width="20%" class="NoiseFooterTD"><span id="mcr_tipo_perforacion_lb" style="display : <?php if($micro == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Tipo perforacion</span></td>
			<td width="30%" class="NoiseDataTD"><span id="mcr_tipo_perforacion_obj" style="display : <?php if($micro == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="hidden" name="mcr_tipo_perforacion" id="mcr_tipo_perforacion" value="<?php echo $mcr_tipo_perforacion ?>"/><?php echo ($mcr_tipo_perforacion)? strtoupper($mcr_tipo_perforacion) : '---' ;?></span></td>
			<td width="25%" class="NoiseFooterTD"><span id="mrc_cant_cara_microper_lb" style="display : <?php if($micro == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Cantidad de caras microperforadas</span></td>
			<td width="25%" class="NoiseDataTD"><span id="mrc_cant_cara_microper_obj" style="display : <?php if($micro == 'si'){echo 'block';}else{echo 'none';}?>"><input type="hidden" name="mrc_cant_cara_microper" id="mrc_cant_cara_microper" value="<?php echo $mrc_cant_cara_microper ?>"  /><?php echo ($mrc_cant_cara_microper)? strtoupper($mrc_cant_cara_microper) : '---' ;?></span></td>
		</tr>
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="4"><span id="note_micro_lb" style="display : <?php if($micro == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Observaciones</span></td>
		<tr><td class="NoiseDataTD"  colspan="4"><span id="note_micro_obj" style="display : <?php if($micro == 'si'){echo 'block';}else{echo 'none';}?>"><?php echo $note_micro ?></span></tr>
	</table>
</div>
<!-- FIN PESTAÑA SELLADO DOBLADO CORTE -->