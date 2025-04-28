<!-- PESTAÑA 2 ESPECIFICACIONES DEL PRODUCTO -->
<div id="opt-tab2">
	<div id="cantidad_seccion">
		<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content"> 	
			<tr>
		  		<td width="20%" class="NoiseFooterTD">&nbsp;Cant. solicitada</td>
		  		<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="cant" id="cant" value="<?php echo $cant ?>" /><?php echo ($cant)? $cant : '---'; ?></td>
		  		<td width="20%" class="NoiseFooterTD">&nbsp;Cant. inventario</td>
		  		<td width="30%" class="NoiseDataTD">&nbsp;---</td>
		  	</tr>
		  	<tr>
		  		<td width="20%" class="NoiseFooterTD">&nbsp;Cant. a producir</td>
		  		<td width="30%" class="NoiseDataTD">&nbsp;---</td>
		  		<td width="20%" class="NoiseFooterTD">&nbsp;Un. medida</td>
		  		<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="unimedi" id="unimedi" value="<?php echo $unimedi ?>" /><?php echo ($unimedi)? strtoupper($unimedi) : '---' ; ?></td>
		  	</tr>
			<tr> 
				<td class="NoiseFooterTD">&nbsp;Tolerancia cantidad (%)</td> 
				<td class="NoiseDataTD">
					<b>+</b>&nbsp;<input type="hidden" name="tole_cant_ms" id="tole_cant_ms" value="<?php echo $tole_cant_ms ?>" /><?php echo ($tole_cant_ms)? $tole_cant_ms : '**' ; ?>
					<b>-</b>&nbsp;<input type="hidden" name="tole_cant_mn" id="tole_cant_mn" value="<?php echo $tole_cant_mn ?>" /><?php echo ($tole_cant_mn)? $tole_cant_mn : '**' ; ?>
		  		</td>
		  		<td class="NoiseFooterTD">&nbsp;Tipo de estructura</td>
		  		<td class="NoiseDataTD">&nbsp;<input type="hidden" name="tipo_estruc" id="tipo_estruc" value="<?php echo $tipo_estruc ?>" /><?php echo ($tipo_estruc)? strtoupper($tipo_estruc) : '---' ; ?></td>
		  	</tr>
		</table>
	</div>
	<div id="item_sessionc">
	  	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr> 
				<td class="NoiseFooterTD" width="20%">&nbsp;Tipo de impresi&oacute;n</td>
	  			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="tipo_impresion" id="tipo_impresion" value="<?php echo $tipo_impresion ?>" /><?php echo ($tipo_impresion)? strtoupper($tipo_impresion) : '---' ; ?></td> 
			</tr>
		</table>
	</div>
	<div id="item_sessiond" style="display: <?php if($tipo_impresion == 'sin_impresion') echo 'none'; else echo 'block' ?>;">
		<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
	  		<tr> 
				<td class="NoiseFooterTD" width="20%">&nbsp;Listado de colores</td>
	  			<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="list_colors" id="list_colors" value="<?php echo $list_colors ?>" /><?php echo ($list_colors)? strtoupper($list_colors) : '---' ; ?></td> 
			</tr>
			<tr>
				<td class="NoiseFooterTD" width="20%">&nbsp;Productos aprobados por</td> 
	  			<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="producto_avaliable" id="producto_avaliable" value="<?php echo $producto_avaliable ?>" /><?php echo ($producto_avaliable)? strtoupper($producto_avaliable) : '---' ; ?></td> 	  			
			</tr>
			<tr>
				<td class="NoiseFooterTD" width="20%">&nbsp;Colores aprobados por: &nbsp;</td> 
				<td colspan="3" class="NoiseDataTD">
				<input type="hidden" name="pantone" id="pantone" value="<?php echo $pantone ?>" />
				<input type="hidden" name="muestra" id="muestra" value="<?php echo $muestra ?>" />
				<input type="hidden" name="est_color" id="est_color" value="<?php echo $est_color ?>" />
				<input type="hidden" name="pcolor" id="pcolor" value="<?php echo $pcolor ?>" />
				<?php echo $colorespor ?>
				</td>
			</tr>
			<tr>
				<td class="NoiseFooterTD" width="20%">&nbsp;Tintas resistentes a:&nbsp;</td> 
				<td colspan="3" class="NoiseDataTD">
				<input type="hidden" name="tnt_calor" id="tnt_calor" value="<?php echo $tnt_calor ?>" />
				<input type="hidden" name="tnt_luz" id="tnt_luz" value="<?php echo $tnt_luz ?>" />
				<input type="hidden" name="tnt_acidos" id="tnt_acidos" value="<?php echo $tnt_acidos ?>" />
				<input type="hidden" name="tnt_alcalis" id="tnt_alcalis" value="<?php echo $tnt_alcalis ?>" />
				<input type="hidden" name="tnt_agua" id="tnt_agua" value="<?php echo $tnt_agua ?>" />
				<input type="hidden" name="tnt_grasas" id="tnt_grasas" value="<?php echo $tnt_grasas ?>" />
				<input type="hidden" name="tnt_brillo" id="tnt_brillo" value="<?php echo $tnt_brillo ?>" />
				<input type="hidden" name="tnt_rayado" id="tnt_rayado" value="<?php echo $tnt_rayado ?>" />
				<?php echo $tintasa ?>				
				</td> 
			</tr>
		</table>
	</div>
	<div id="estructura_seccion">
		<div id="filtrlistaestructura">
		<?php
			$noAjax = true;
			$flagdetallar = 1;
			include '../src/FunjQuery/jquery.visors/jquery.tabla1.php';  
		?>
		</div>
		<div>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">	
				<tr>
					<td width="20%" class="NoiseFooterTD">&nbsp;Tolerancia calibre <!--(&micro;m)--> (%) </td>
					<td width="30%" class="NoiseDataTD">
						<b>+</b>&nbsp;<input type="hidden" name="tole_calib_ms" id="tole_calib_ms" value="<?php echo $tole_calib_ms ?>" /><?php echo ($tole_calib_ms)? $tole_calib_ms : '**' ; ?>
						<b>-</b>&nbsp;<input type="hidden" name="tole_calib_mn" id="tole_calib_mn" value="<?php echo $tole_calib_mn ?>" /><?php echo ($tole_calib_mn)? $tole_calib_mn : '**' ; ?>
					</td>
					<td width="20%" class="NoiseFooterTD">&nbsp;Tolerancia gramaje <!--(g)--> (%) </td>
					<td width="30%" class="NoiseDataTD">
						<b>+</b>&nbsp;<input type="hidden" name="tole_grama_ms" id="tole_grama_ms" value="<?php echo $tole_grama_ms ?>" /><?php echo ($tole_grama_ms)? $tole_grama_ms : '**'; ?>
						<b>-</b>&nbsp;<input type="hidden" name="tole_grama_mn" id="tole_grama_mn" value="<?php echo $tole_grama_mn ?>" /><?php echo ($tole_grama_mn)? $tole_grama_mn : '**' ; ?>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<br/>
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
		<td colspan="4" class="ui-state-default">&nbsp;Medidas Lamina</td>
		</tr>
		<tr>
			<td width="25%" class="NoiseFooterTD">&nbsp;Ancho (mm)</td>
			<td width="25%" class="NoiseDataTD">&nbsp;<input type="hidden" name="ancho" id="ancho" value="<?php echo $ancho ?>" /><?php echo ($ancho)? $ancho : '---' ; ?></td>
			<td width="20%" class="NoiseFooterTD">&nbsp;Tolerancia del ancho (mm)</td>
			<td width="30%" class="NoiseDataTD">
				<b>+</b>&nbsp;<input type="hidden" name="tole_ancho_ms" id="tole_ancho_ms" value="<?php echo $tole_ancho_ms ?>" /><?php echo ($tole_ancho_ms)? $tole_ancho_ms : '**' ; ?>
				<b>-</b>&nbsp;<input type="hidden" name="tole_ancho_mn" id="tole_ancho_mn" value="<?php echo $tole_ancho_mn ?>" /><?php echo ($tole_ancho_mn)? $tole_ancho_mn : '**' ; ?>
			</td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;Largo (mm)</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<input type="hidden" name="largo" id="largo" value="<?php echo $largo ?>" /><?php echo ($largo)? $largo : '---' ; ?></span></td>
			<td class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;Tolerancia de largo (mm)</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">
				<b>+</b>&nbsp;<input type="hidden" name="tole_largo_ms" id="tole_largo_ms" value="<?php echo $tole_largo_ms ?>" /><?php echo ($tole_largo_ms)? $tole_largo_ms : '**' ; ?>
				<b>-</b>&nbsp;<input type="hidden" name="tole_largo_mn" id="tole_largo_mn" value="<?php echo $tole_largo_mn ?>" /><?php echo ($tole_largo_mn)? $tole_largo_mn : '**' ; ?>
			</span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;Ancho fotocelda (mm)</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<input type="hidden" name="ancho_fotoc" id="ancho_fotoc" value="<?php echo $ancho_fotoc ?>" /><?php echo ($ancho_fotoc)? $ancho_fotoc : '---' ; ?></span></td>
			<td class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;Largo fotocelda (mm)</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<input type="hidden" name="largo_fotoc" id="largo_fotoc" value="<?php echo $largo_fotoc ?>" /><?php echo ($largo_fotoc)? $largo_fotoc : '---' ; ?></span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;Distancia fotocelda al borde (mm)</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<input type="hidden" name="dfotoc_borde" id="dfotoc_borde" value="<?php echo $dfotoc_borde ?>" /><?php echo ($dfotoc_borde)? strtoupper($dfotoc_borde) : '---' ; ?></span></td>
			<td class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;Color fotocelda</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<input type="hidden" name="color_fotoc" id="color_fotoc" value="<?php echo $color_fotoc ?>" /><?php echo ($color_fotoc)? strtoupper($color_fotoc) : '---' ; ?></span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;Tipo de embobinado</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<input type="hidden" name="tipo_emb" id="tipo_emb" value="<?php echo $tipo_emb ?>" /><?php echo ($tipo_emb)? strtoupper($tipo_emb) : '---' ; ?></span></td>
			<td class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;Con respecto</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<input type="hidden" name="con_resp" id="con_resp" value="<?php echo $con_resp ?>" /><?php echo ($con_resp)? strtoupper($con_resp) : '---' ; ?></span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;C&oacute;digo de barras</span></td>
			<td class="NoiseDataTD" colspan="3"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<input type="hidden" name="cod_barras" id="cod_barras" value="<?php echo $cod_barras ?>" /><?php echo ($cod_barras)? strtoupper($cod_barras) : '---' ; ?></span></td>
		</tr>
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="4">&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD" colspan="4">&nbsp;<input type="hidden" name="note_product" id="note_product" value="<?php echo $note_product ?>" /><?php echo strtoupper($note_product) ?></tr>
	</table>
</div>
<!-- FIN PESTAÑA ESPECIFICACIONES DEL PRODUCTO -->


<!-- PESTAÑA 3 ESPECIFICACIONES DE EMBALAJE -->							
<div id="opt-tab4">
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="23%" class="NoiseFooterTD">&nbsp;Tama&ntilde;o del core (mm)</td>
			<td width="27%" class="NoiseDataTD">&nbsp;<input type="hidden" name="tam_core" id="tam_core" value="<?php echo $tam_core ?>" /><?php echo ($tam_core)? $tam_core : '---' ; ?></td>
			<td width="23%" class="NoiseFooterTD">&nbsp;Metros del rollo</td>
			<td width="27%" class="NoiseDataTD">&nbsp;<input type="hidden" name="mrollo" id="mrollo" value="<?php echo $mrollo ?>" /><?php echo ($mrollo)? $mrollo : '---'; ?></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Peso del rollo (Kg)</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="prollo" id="prollo" value="<?php echo $prollo ?>" /><?php echo ($prollo)? $prollo : '---'; ?></td>
			<td class="NoiseFooterTD">&nbsp;Tolerancia del peso (Kg)</td>
			<td class="NoiseDataTD">
				<b>+</b>&nbsp;<input type="hidden" name="tole_prollo_ms" id="tole_prollo_ms" value="<?php echo $tole_prollo_ms ?>" /><?php echo ($tole_prollo_ms)? $tole_prollo_ms : '**'; ?>
				<b>-</b>&nbsp;<input type="hidden" name="tole_prollo_mn" id="tole_prollo_mn" value="<?php echo $tole_prollo_mn ?>" /><?php echo ($tole_prollo_mn)? $tole_prollo_mn : '**';  ?>
			</td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Diametro del rollo (mm)</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="drollo" id="drollo" value="<?php echo $drollo ?>" /><?php echo ($drollo)? $drollo: '---'; ?></td>
			<td class="NoiseFooterTD">&nbsp;Tolerancia del diametro (mm)</td>
			<td class="NoiseDataTD">
				<b>+</b>&nbsp;<input type="hidden" name="tole_drollo_ms" id="tole_drollo_ms" value="<?php echo $tole_drollo_ms ?>" /><?php echo ($tole_drollo_ms)? $tole_drollo_ms : '**'; ?>
				<b>-</b>&nbsp;<input type="hidden" name="tole_drollo_mn" id="tole_drollo_mn" value="<?php echo $tole_drollo_mn ?>" /><?php echo ($tole_drollo_mn)? $tole_drollo_mn : '**'; ?>
			</td>
		</tr>
		
		<tr>
			<td class="NoiseFooterTD">&nbsp;Bandera</td>
			<td class="NoiseDataTD" colspan="3">&nbsp;<input type="hidden" name="flag" id="flag" value="<?php echo $flag ?>" /><?php echo ($flag)? strtoupper($flag) : '---' ; ?></td>
		</tr>
		</table>
		
		<div id="session_bandera" style="display: <?php if($flag == 'si'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td width="23%" class="NoiseFooterTD">&nbsp;Color bandera</td>
				<td width="27%" class="NoiseDataTD">&nbsp;<input type="hidden" name="color_flag" id="color_flag" value="<?php echo $color_flag ?>" /><?php echo ($color_flag)? strtoupper($color_flag) : '---' ; ?></td>
				<td width="23%" class="NoiseFooterTD">&nbsp;Ubicaci&oacute;n bandera</td>
				<td width="27%" class="NoiseDataTD">&nbsp;<input type="hidden" name="ubic_flag" id="ubic_flag" value="<?php echo $ubic_flag ?>" /><?php echo ($ubic_flag)? strtoupper($ubic_flag) : '---' ; ?></td>
			</tr>
		</table>
		</div>
		
		<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="23%" class="NoiseFooterTD">&nbsp;No. max empalmes</td>
			<td width="27%" class="NoiseDataTD">&nbsp;<input type="hidden" name="nmax_empal" id="nmax_empal" value="<?php echo $nmax_empal ?>" /><?php echo ($nmax_empal)? $nmax_empal : '---' ; ?></td>
			<td width="23%" class="NoiseFooterTD">&nbsp;Ancho de empalme</td>
			<td width="27%" class="NoiseDataTD">&nbsp;<input type="hidden" name="ancho_empal" id="ancho_empal" value="<?php echo $ancho_empal ?>" /><?php echo ($ancho_empal)? $ancho_empal : '---' ; ?> </td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Color Empalme Cara</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="cempal_cara" id="cempal_cara" value="<?php echo $cempal_cara ?>" /><?php echo ($cempal_cara)? strtoupper($cempal_cara) : '---' ; ?></td>
			<td class="NoiseFooterTD">&nbsp;Color Empalme Dorso</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="cempal_dorso" id="cempal_dorso" value="<?php echo $cempal_dorso ?>" /><?php echo ($cempal_dorso)? strtoupper($cempal_dorso) : '---' ; ?></td>
		</tr>
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="4">&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD" colspan="4"><input type="hidden" name="note_embalaje" id="note_embalaje" value="<?php echo $note_embalaje ?>" /><?php echo strtoupper($note_embalaje) ?></tr>
	</table>
</div>
<!-- FIN PESTAÑA ESPECIFICACIONES DE EMBALAJE -->


<!-- PESTAÑA 4 MATERIAL EXTRUIDO SOLAMENTE -->
<div id="opt-tab5">
 <div id="esp_ext_seccion">
		<div id="filtrlistamatextruido">
			<?php
				$noAjax = true;
				include '../src/FunjQuery/jquery.phpscripts/jquery.ajax_matextruido.det.php';  
			?>
		</div>
	</div>
</div>
<!-- FIN PESTAÑA MATERIAL EXTRUIDO SOLAMENTE -->


<!-- PESTAÑA 5 LAMINACION -->
<div id="opt-tab6">
	<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;Lado brillante del foil</td>
			<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="lado_foil" id="lado_foil" value="<?php echo $lado_foil ?>" /><?php echo ($lado_foil)? strtoupper($lado_foil) : '---' ; ?></td>
			<td width="20%" class="NoiseFooterTD">&nbsp; Tipo Adhesion</td>
			<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="tipo_proceso" id="tipo_proceso" value="<?php echo $tipo_proceso ?>" /><?php echo ($tipo_proceso)? strtoupper($tipo_proceso) : '---' ; ?></td>
		</tr>
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="4">&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD" colspan="4"><input type="hidden" name="note_laminacion" id="note_laminacion" value="<?php echo $note_laminacion ?>" /><?php echo strtoupper($note_laminacion) ?></tr>
	</table>
</div>
<!-- FIN PESTAÑA LAMINACION -->


<!-- PESTAÑA 6 CONDICIONES DE PROCESO PARA EL DESARROLLO -->
<div id="opt-tab7">
	<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;Producto a empacar</td>
			<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="product_empa" id="product_empa" value="<?php echo $product_empa ?>" /><?php echo ($product_empa)? strtoupper($product_empa) : '---' ; ?></td>
			<td width="25%" class="NoiseFooterTD">&nbsp;Temperatura de empacado (C)</td>
			<td width="25%" class="NoiseDataTD">&nbsp;<input type="hidden" name="temp_empa" id="temp_empa" value="<?php echo $temp_empa ?>" /><?php echo ($temp_empa)? strtoupper($temp_empa) : '---' ; ?></td>
		</tr>
		
		<tr>
			<td class="NoiseFooterTD">&nbsp;Tipo de sellado</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="tipo_sellado" id="tipo_sellado" value="<?php echo $tipo_sellado ?>" /><?php echo ($tipo_sellado)? strtoupper($tipo_sellado) : '---' ; ?></td>
			<td class="NoiseFooterTD">&nbsp;Velocidad (Unid/min)</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="vel_empa" id="vel_empa" value="<?php echo $vel_empa ?>" /><?php echo ($vel_empa)? strtoupper($vel_empa) : '---' ; ?></td>
		</tr>
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="4">&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD" colspan="4"><input type="hidden" name="note_proces" id="note_proces" value="<?php echo $note_proces ?>" /><?php echo strtoupper($note_proces) ?></tr>
	</table>
</div>
<!-- FIN PESTAÑA 6 CONDICIONES DE PROCESO PARA EL DESARROLLO -->

<!-- PESTAÑA 4 FORMA EMPAQUE -->
<div id="opt-tab4a">
	<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;Forma de empaque</td>
			<td width="80%" class="NoiseDataTD">&nbsp;<input type="hidden" name="" id="" value="" /><?php echo ($form_empa)? strtoupper($form_empa) : '---' ; ?></td>
		<tr>
	</table>
	
	<div id="seccion_formempa_suspendido" style="display: <?php if($form_empa == 'suspendido'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;Niveles por estiba</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="niv_estiba" id="niv_estiba" value="<?php echo $niv_estiba ?>" /><?php echo ($niv_estiba)? $niv_estiba : '---' ; ?></td>
				<td width="20%" class="NoiseFooterTD">&nbsp;Peso por estiba (Kg)</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="peso_estiba" id="peso_estiba" value="<?php echo $peso_estiba ?>" /><?php echo ($peso_estiba)? $peso_estiba : '---' ; ?></td>
			<tr>
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;Bolsa pl&aacute;stica</td>
				<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="bolsa_plastica" id="bolsa_plastica" value="<?php echo $bolsa_plastica ?>" /><?php echo ($bolsa_plastica)? strtoupper($bolsa_plastica) : '---'; ?></td>
			</tr>
		</table>
	</div>
	
	<div id="seccion_formempa_caja" style="display: <?php if($form_empa == 'caja'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;Protector core</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="pro_core" id="pro_core" value="<?php echo $pro_core ?>" /><?php echo ($pro_core)? strtoupper($pro_core) : '---'; ?></td>
				<td width="20%" class="NoiseFooterTD">&nbsp;Bolsa pl&aacute;stica</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="bolsa_plastica" id="bolsa_plastica" value="<?php echo $bolsa_plastica ?>" /><?php echo ($bolsa_plastica)? strtoupper($bolsa_plastica) : '---'; ?></td>
			<tr>
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;Peso Maximo por caja (kg)</td>
				<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="peso_max" id="peso_max" value="<?php echo $peso_max ?>" /><?php echo ($peso_max)? $peso_max : '---' ; ?></td>
			</tr>
		</table>
	</div>
	
	<div id="seccion_formempa_bolsa_plastica" style="display: <?php if($form_empa == 'bolsa_plastica'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;Protector core</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="pro_core" id="pro_core" value="<?php echo $pro_core ?>" /><?php echo ($pro_core)? strtoupper($pro_core) : '---'; ?></td>
				<td width="20%" class="NoiseFooterTD">&nbsp;Peso Maximo por bolsa (kg)</td>
				<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="peso_max" id="peso_max" value="<?php echo $peso_max ?>" /><?php echo ($peso_max)? $peso_max : '---' ; ?></td>
			</tr>
		</table>
	</div>
	
	<div id="seccion_formempa_carton_extremos" style="display: <?php if($form_empa == 'carton_extremos'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;Protector core</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="pro_core" id="pro_core" value="<?php echo $pro_core ?>" /><?php echo ($pro_core)? strtoupper($pro_core) : '---'; ?></td>
				<td width="20%" class="NoiseFooterTD">&nbsp;Bolsa pl&aacute;stica</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="bolsa_plastica" id="bolsa_plastica" value="<?php echo $bolsa_plastica ?>" /><?php echo ($bolsa_plastica)? strtoupper($bolsa_plastica) : '---'; ?></td>
			<tr>
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;No. Rollos</td>
				<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="no_rollos" id="no_rollos" value="<?php echo $no_rollos ?>" /><?php echo ($no_rollos)? $no_rollos : '---' ; ?></td>
			</tr>
		</table>
	</div>
	
	<div id="seccion_formempa_cubierto_extremos" style="display: <?php if($form_empa == 'cubierto_extremos'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;Protector core</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="pro_core" id="pro_core" value="<?php echo $pro_core ?>" /><?php echo ($pro_core)? strtoupper($pro_core) : '---'; ?></td>
				<td width="20%" class="NoiseFooterTD">&nbsp;Bolsa pl&aacute;stica</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="bolsa_plastica" id="bolsa_plastica" value="<?php echo $bolsa_plastica ?>" /><?php echo ($bolsa_plastica)? strtoupper($bolsa_plastica) : '---'; ?></td>
			<tr>
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;No. Rollos</td>
				<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="no_rollos" id="no_rollos" value="<?php echo $no_rollos ?>" /><?php echo ($no_rollos)? $no_rollos : '---' ; ?></td>
			</tr>
		</table>
	</div>
	
	<br/>
	<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;Material estibado</td>
			<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="estibado" id="estibado" value="<?php echo $estibado ?>" /><?php echo ($estibado)? strtoupper($estibado) : '---' ; ?></td>
			<td width="20%" class="NoiseDataTD">&nbsp;</td>
			<td width="30%"class="NoiseDataTD">&nbsp;</td>
		</tr>
	</table>
	<div id="session_estibado" style="display: <?php if($estibado == 'si'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;Tama&ntilde;o de estiba</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="tam_estiba" id="tam_estiba" value="<?php echo $tam_estiba ?>" /><?php echo ($tam_estiba)? $tam_estiba : '---' ; ?> </td>
				<td width="20%" class="NoiseFooterTD">&nbsp;Tipo de estiba</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="tipo_estiba" id="tipo_estiba" value="<?php echo $tipo_estiba ?>" /><?php echo ($tipo_estiba)? strtoupper($tipo_estiba) : '---' ; ?></td>
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
		</table>
	</div>
	<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr><td class="ui-state-default"></td></tr>
		<tr><td class="NoiseFooterTD">&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD"><input type="hidden" name="note_formaempaque" id="note_formaempaque" value="<?php echo $note_formaempaque ?>" /><?php echo strtoupper($note_formaempaque) ?></tr>
	</table>
</div>
<!-- FIN PESTAÑA FORMA EMPAQUE -->

<!-- PESTAÑA 7 NOTAS DE MODIFICACION -->
<?php if($tipevecodigo == 2):?>
<div id="opt-tab8">
	<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="30%" class="NoiseDataTD">&nbsp;Calibre/Estructura&nbsp;&nbsp;&nbsp;&nbsp;<input type="hidden" name="calibre_estructura" id="calibre_estructura" value="<?php echo $calibre_estructura ?>" /><?php echo ($calibre_estructura)? 'SI': 'NO';?></td>
			<td width="30%" class="NoiseDataTD">&nbsp;Dise&ntilde;o/Textos/Colores&nbsp;&nbsp;&nbsp;&nbsp;<input type="hidden" name="disenio_textos_colores" id="disenio_textos_colores" value="<?php echo $disenio_textos_colores ?>"/><?php echo ($disenio_textos_colores)? 'SI': 'NO';?></td>
			<td width="20%" class="NoiseDataTD">&nbsp;Medidas&nbsp;&nbsp;&nbsp;&nbsp;<input type="hidden" name="medidas" id="medidas" value="<?php echo $medidas ?>" /><?php echo ($medidas)? 'SI': 'NO';?></td>
			<td width="20%" class="NoiseDataTD">&nbsp;Accesorios&nbsp;&nbsp;&nbsp;&nbsp;<input type="hidden" name="accesorios" id="accesorios" value="<?php echo $accesorios ?>" /><?php echo ($accesorios)? 'SI': 'NO';?></td>
		</tr>
		<tr>
			<td colspan="2" class="NoiseDataTD">&nbsp;Especificaci&oacute;n de embalaje&nbsp;&nbsp;&nbsp;&nbsp;<input type="hidden" name="esp_emb" id="esp_emb" value="<?php echo $esp_emb ?>" /><?php echo ($esp_emb)? 'SI': 'NO';?></td>
			<td colspan="2" class="NoiseDataTD">&nbsp;Especificaciones de Material extruido&nbsp;&nbsp;&nbsp;&nbsp;<input type="hidden" name="esp_ext" id="esp_ext" value="<?php echo $esp_ext ?>" /><?php echo ($esp_ext)? 'SI': 'NO';?></td>
		</tr>
		<tr><td class="ui-state-default" colspan="7"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="7">&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD" colspan="7">&nbsp;<input type="hidden" name="note_notas" id="note_notas" value="<?php echo $note_notas ?>" /><?php echo strtoupper($note_notas) ?></tr>
	</table>
</div>
<script type="text/javascript"></script>
<?php endif;?>
<!-- PESTAÑA 7 NOTAS DE MODIFICACION -->