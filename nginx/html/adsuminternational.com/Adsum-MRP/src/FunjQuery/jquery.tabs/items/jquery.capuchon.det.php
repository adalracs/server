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
	
	<div id="session_materialimprimir" style="display: <?php if($tipo_estruc == 'compuesto' && $tipo_impresion != 'sin_impresion'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;Material a imprimir</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="mate_imp" id="mate_imp" value="<?php echo $mate_imp ?>" /><?php echo ($mate_imp)? strtoupper($mate_imp) : '---' ;?></td>
				<td class="NoiseFooterTD" width="20%">&nbsp;Posici&oacute;n del material a imprimir</td>
				<td class="NoiseDataTD" width="30%">&nbsp;<input type="hidden" name="pos_imp" id="pos_imp" value="<?php echo $pos_imp ?>" /><?php echo ($pos_imp)? strtoupper($pos_imp) : '---' ;?></td>
			</tr>
		</table>
	</div>
	
	
	<div id="session_numcarasimprimir" style="display: <?php if($tipo_estruc == 'sencillo'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;No. de caras impresas</td>
				<td width="80%" class="NoiseDataTD">&nbsp;<input type="hidden" name="ncaras_imp" id="ncaras_imp" value="<?php echo $ncaras_imp ?>" /><?php echo ($ncaras_imp)? strtoupper($ncaras_imp) : '---' ;?></td>
			</tr>
		</table>
	</div>
	
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
	<tr>
		<td colspan="4" class="ui-state-default">&nbsp;Medidas Capuchon</td>
		</tr>
		<tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;Largo (mm)</td>
			<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="largo" id="largo" value="<?php echo $largo ?>" /><?php echo ($largo) ?$largo : '---' ; ?></td>
			<td width="25%" class="NoiseFooterTD">&nbsp;Tolerancia de largo (mm)</td>
			<td width="25%" class="NoiseDataTD">
				<b>+</b>&nbsp;<input type="hidden" name="tole_largo_ms" id="tole_largo_ms" value="<?php echo $tole_largo_ms ?>" /><?php echo ($tole_largo_ms)? $tole_largo_ms : '**' ; ?>
				<b>-</b>&nbsp;<input type="hidden" name="tole_largo_mn" id="tole_largo_mn" value="<?php echo $tole_largo_mn ?>" /><?php echo ($tole_largo_mn)? $tole_largo_mn : '**' ; ?>
			</td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Pesta&ntilde;a (mm)</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="pestania" id="pestania" value="<?php echo $pestania ?>" /><?php echo ($pestania)? strtoupper($pestania) : '---' ;?></td>
			<td class="NoiseFooterTD">&nbsp;Tolerancia de pesta&ntilde;a (mm)</td>
			<td class="NoiseDataTD">
				<b>+</b>&nbsp;<input type="hidden" name="tole_pestania_ms" id="tole_pestania_ms" value="<?php echo $tole_pestania_ms ?>" /><?php echo ($tole_pestania_ms)? $tole_pestania_ms : '**' ;?>
				<b>-</b>&nbsp;<input type="hidden" name="tole_pestania_mn" id="tole_pestania_mn" value="<?php echo $tole_pestania_mn ?>" /><?php echo ($tole_pestania_mn)? $tole_pestania_mn : '**' ;?>
			</td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Base mayor (mm)</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="bmayor" id="bmayor" value="<?php echo $bmayor ?>" /><?php echo ($bmayor)? strtoupper($bmayor) : '---' ;?></td>
			<td class="NoiseFooterTD">&nbsp;Tol. base mayor (mm)</td>
			<td class="NoiseDataTD">
				<b>+</b>&nbsp;<input type="hidden" name="tole_bmayor_ms" id="tole_bmayor_ms" value="<?php echo $tole_bmayor_ms ?>" /><?php echo ($tole_bmayor_ms)? $tole_bmayor_ms : '**' ;?>
				<b>-</b>&nbsp;<input type="hidden" name="tole_bmayor_mn" id="tole_bmayor_mn" value="<?php echo $tole_bmayor_mn ?>" /><?php echo ($tole_bmayor_mn)? $tole_bmayor_mn : '**' ;?>
			</td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Base menor (mm)</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="bmenor" id="bmenor" value="<?php echo $bmenor ?>" /><?php echo ($bmenor)? strtoupper($bmenor) : '---';?></td>
			<td class="NoiseFooterTD">&nbsp;Tol. base menor (mm)</td>
			<td class="NoiseDataTD">
				<b>+</b>&nbsp;<input type="hidden" name="tole_bmenor_ms" id="tole_bmenor_ms" value="<?php echo $tole_bmenor_ms ?>" /><?php echo ($tole_bmenor_ms)? $tole_bmenor_ms : '**' ;?>
				<b>-</b>&nbsp;<input type="hidden" name="tole_bmenor_mn" id="tole_bmenor_mn" value="<?php echo $tole_bmenor_mn ?>" /><?php echo ($tole_bmenor_mn)? $tole_bmenor_mn : '**' ;?>
			</td>
		</tr>
			<tr>
		<td colspan="4" class="ui-state-default">&nbsp;Accesorios de Capuchon</td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Macroperforaciones</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="macroper" id="macroper" value="<?php echo $macroper ?>" /><?php echo ($macroper)? strtoupper($macroper) : '---' ;?></td>
			<td class="NoiseFooterTD">&nbsp;No. de macroperforaciones</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="nro_macroper" id="nro_macroper" value="<?php echo $nro_macroper ?>" /><?php echo ($nro_macroper)? strtoupper($nro_macroper) : '---' ;?></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Microperforaciones</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="microper" id="microper" value="<?php echo $microper ?>" /><?php echo ($microper)? strtoupper($microper) : '---' ;?></td>
			<td class="NoiseFooterTD">&nbsp;No. caras microperforaciones</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="ncaras_microper" id="ncaras_microper" value="<?php echo $ncaras_microper ?>" /><?php echo ($ncaras_microper)? strtoupper($ncaras_microper) : '---' ;?></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Tipo de microperforaciones</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="tipo_microper" id="tipo_microper" value="<?php echo $tipo_microper ?>" /><?php echo ($tipo_microper)? strtoupper($tipo_microper) : '---' ;?></td>
			<td class="NoiseFooterTD">&nbsp;Distancia Microperforacion (mm)</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="dist_microper" id="dist_microper" value="<?php echo $dist_microper ?>" /><?php echo ($dist_microper)? strtoupper($dist_microper) : '---' ;?></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Troquel</td>
			<td class="NoiseDataTD" >&nbsp;<input type="hidden" name="troquel" id="troquel" value="<?php echo $troquel ?>" /><?php echo ($troquel)? strtoupper($troquel) : '---' ;?></td>
			<td class="NoiseFooterTD">&nbsp;Sello de fondo</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="selle_fondo" id="selle_fondo" value="<?php echo $selle_fondo ?>" /><?php echo ($selle_fondo)? strtoupper($selle_fondo) : '' ;?></td>
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
		<?php
			//se adiciono la correcion de el calculo de el peso millar de  los capuchones
			unset($estructura_n); ($tipo_estruc == 'compuesto')? $estructura_n = 2 : $estructura_n = 1;
		?>
			<td width="20%" class="NoiseFooterTD">&nbsp;Peso millar (Kg)</td>
<!--		no borrar peso millar pasado con error reflejado en planta		
			<td width="30%" class="NoiseDataTD">&nbsp;
				<span id="pesomillar">
					<?php //echo round( (((((double) $bmayor / 1000) + ((double) $bmenor / 1000 )) / 2 ) * ( (((double)  $largo / 1000) * 2) + (((double) $pestania / 1000) * 2)))*$totalgramaje  * 100 ) / 100 ?>
				</span>
			</td>
-->
			<td width="30%" class="NoiseDataTD">&nbsp;<span id="pesomillar"><?php echo round(((((($bmayor / 1000) + ($bmenor / 1000)) / 2)  * ((($largo / 1000) * 2) + ($pestania / 1000 ) * 2)) *  (($totalgramaje / $estructura_n))) * 100) / 100; ?></span></td>
			<td width="25%"class="NoiseFooterTD">&nbsp;C&oacute;digo de barras</td>
			<td width="25%" class="NoiseDataTD">&nbsp;<input type="hidden" name="cod_barras" id="cod_barras" value="<?php echo $cod_barras ?>" /><?php echo ($cod_barras)? strtoupper($cod_barras) : '---' ;?></td>
		</tr>
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="4">&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD" colspan="4">&nbsp;<input type="hidden" name="note_product" id="note_product" value="<?php echo $note_product ?>" /><?php echo strtoupper($note_product) ?></td>
	</table>
</div>
<!-- FIN PESTAÑA ESPECIFICACIONES DEL PRODUCTO -->


<!-- PESTAÑA 3 ESPECIFICACIONES DE EMBALAJE -->							
<div id="opt-tab4">
	<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="22%" class="NoiseFooterTD">&nbsp;Tipo de empaque</td>
			<td width="28%" class="NoiseDataTD">&nbsp;<input type="hidden" name="tipo_empaque" id="tipo_empaque" value="<?php echo $tipo_empaque ?>" /><?php echo ($tipo_empaque)? strtoupper($tipo_empaque) : '---' ; ?></td>
			<td width="22%" class="NoiseFooterTD">&nbsp;Unidades por empaque</td>
			<td width="28%" class="NoiseDataTD">&nbsp;<input type="hidden" name="uni_empaque" id="uni_empaque" value="<?php echo $uni_empaque ?>" /><?php echo ($uni_empaque)? strtoupper($uni_empaque) : '---' ; ?></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Unidades por paquete</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="uni_paquete" id="uni_paquete" value="<?php echo $uni_paquete ?>" /><?php echo ($uni_paquete)? $uni_paquete : '---' ; ?></td>
			<td class="NoiseFooterTD">&nbsp;Peso m&aacute;ximo empaque (Kg)</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="peso_empaque" id="peso_empaque" value="<?php echo $peso_empaque ?>" /><?php echo ($peso_empaque)? $peso_empaque : '' ; ?></td>
		</tr>
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Material estibado</td>
			<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="estibado" id="estibado" value="<?php echo $estibado ?>" /><?php echo ($estibado)? strtoupper($estibado) : '---' ; ?></td>
		</tr>
	</table>
	<div id="session_estibado" style="display: <?php if($estibado == 'si'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td class="NoiseFooterTD" width="22%">&nbsp;Tama&ntilde;o de estiba</td>
				<td class="NoiseDataTD" width="28%">&nbsp;<input type="hidden" name="tam_estiba" id="tam_estiba" value="<?php echo $tam_estiba?>" /><?php echo ($tam_estiba)? $tam_estiba : '---'; ?> </td>
				<td class="NoiseFooterTD" width="22%">&nbsp;Tipo de estiba</td>
				<td class="NoiseDataTD" width="28%">&nbsp;<input type="hidden" name="tipo_estiba" id="tipo_estiba" value="<?php echo $tipo_estiba ?>" /><?php echo ($tipo_estiba)? strtoupper($tipo_estiba) : '---' ; ?></td>
			</tr>
			<tr><td class="ui-state-default" colspan="4"></td></tr>
			<tr>
				<td class="NoiseFooterTD">&nbsp;Altura m&aacute;xima pallet (mm)</td>
				<td class="NoiseDataTD">&nbsp;<input type="hidden" name="alt_pallet" id="alt_pallet" value="<?php echo $alt_pallet ?>" /><?php echo ($alt_pallet)? $alt_pallet : '---'; ?></td>
				<td class="NoiseFooterTD">&nbsp;Peso por pallet (Kg)</td>
				<td class="NoiseDataTD">&nbsp;<input type="hidden" name="pes_pallet" id="pes_pallet" value="<?php echo $pes_pallet ?>" /><?php echo ($pes_pallet)? $pes_pallet : '---'; ?></td>
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
		<tr><td class="NoiseDataTD">&nbsp;<input type="hidden" name="note_embalaje" id="note_embalaje" value="<?php echo $note_embalaje ?>" /><?php echo strtoupper($note_embalaje) ?></td>
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
