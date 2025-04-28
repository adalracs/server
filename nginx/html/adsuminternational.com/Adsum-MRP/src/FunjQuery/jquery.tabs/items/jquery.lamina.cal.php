<!-- PESTAÑA 2 ESPECIFICACIONES DEL PRODUCTO -->
<div id="opt-tab2">
	<div id="cantidad_seccion">
		<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content"> 	
			<tr>
		  		<td width="20%" class="NoiseFooterTD">&nbsp;Cant. solicitada</td>
	  			<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($cant)? $cant : '---'; ?></td>
	  			<td width="20%" class="NoiseFooterTD">&nbsp;Cant. inventario</td>
	  			<td width="30%" class="NoiseDataTD">&nbsp;---</td>
	  		</tr>
	  		<tr>
		  		<td width="20%" class="NoiseFooterTD">&nbsp;Cant. a producir</td>
	  			<td width="30%" class="NoiseDataTD">&nbsp;---</td>
	  			<td width="20%" class="NoiseFooterTD">&nbsp;Uni. medida</td>
	  			<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($unimedi)? $unimedi : '---' ; ?></td>
	  		</tr>
			<tr> 
				<td class="NoiseFooterTD">&nbsp;Tolerancia cantidad (%)</td> 
				<td class="NoiseDataTD">
					<b>+</b>&nbsp;<?php echo ($tole_cant_ms)? $tole_cant_ms : '**' ; ?>
					<b>-</b>&nbsp;<?php echo ($tole_cant_mn)? $tole_cant_mn  : '**' ;?>
					&nbsp;<input type="checkbox" name="chktole_cant_ms" value="<?php echo $arrCampertipproCOD['tole_cant_ms'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['tole_cant_ms']] > 0){echo 'checked';}?> >
	  			</td>
	  			<td class="NoiseFooterTD">&nbsp;Tipo de estructura</td>
	  			<td class="NoiseDataTD">&nbsp;<?php echo ($tipo_estruc)? strtoupper($tipo_estruc) : '---' ; ?>&nbsp;<input type="checkbox" name="chktipo_estruc" value="<?php echo $arrCampertipproCOD['tipo_estruc'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['tipo_estruc']] > 0){echo 'checked';}?> ></td>
	  		</tr>
		</table>
	</div>
	<div id="item_sessionc">
	  	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr> 
				<td class="NoiseFooterTD" width="20%">&nbsp;Tipo de impresi&oacute;n</td>
	  			<td class="NoiseDataTD">&nbsp;<?php echo ($tipo_impresion)? strtoupper($tipo_impresion) : '---' ; ?>&nbsp;<input type="checkbox" name="chktipo_impresion" value="<?php echo $arrCampertipproCOD['tipo_impresion'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['tipo_impresion']] > 0){echo 'checked';}?> ></td> 
			</tr>
		</table>
	</div>
	<div id="item_sessiond" style="display: <?php if($tipo_impresion == 'sin_impresion') echo 'none'; else echo 'block' ?>;">
		<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
	  		<tr> 
				<td class="NoiseFooterTD" width="20%">&nbsp;Listado de colores</td>
	  			<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo ($list_colors)? strtoupper($list_colors) : '---' ; ?>&nbsp;<input type="checkbox" name="chklist_colors" value="<?php echo $arrCampertipproCOD['list_colors'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['list_colors']] > 0){echo 'checked';}?> ></td> 
			</tr>
			<tr>
				<td class="NoiseFooterTD" width="20%">&nbsp;Productos aprobados por</td> 
	  			<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo ($producto_avaliable)? strtoupper($producto_avaliable) : '---' ; ?>&nbsp;<input type="checkbox" name="chkproducto_avaliable" value="<?php echo $arrCampertipproCOD['producto_avaliable'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['producto_avaliable']] > 0){echo 'checked';}?> ></td> 	  			
			</tr>
			<tr>
				<td class="NoiseFooterTD" width="20%">&nbsp;Colores aprobados por: &nbsp;</td> 
				<td colspan="3" class="NoiseDataTD">
				<?php echo $colorespor ?>
				&nbsp;<input type="checkbox" name="chkpantone" value="<?php echo $arrCampertipproCOD['pantone'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['pantone']] > 0){echo 'checked';}?> >
				</td>
			</tr>
			<tr>
				<td class="NoiseFooterTD" width="20%">&nbsp;Tintas resistentes a:&nbsp;</td> 
				<td colspan="3" class="NoiseDataTD">
				<?php echo $tintasa ?>
				&nbsp;<input type="checkbox" name=chktnt_calor value="<?php echo $arrCampertipproCOD['tnt_calor'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['tnt_calor']] > 0){echo 'checked';}?> >
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
						<b>+</b>&nbsp;<?php echo ($tole_calib_ms)? $tole_calib_ms : '---' ; ?>
						<b>-</b>&nbsp;<?php echo ($tole_calib_mn)? $tole_calib_mn : '---' ; ?>
						&nbsp;<input type="checkbox" name="chktole_calib_ms" value="<?php echo $arrCampertipproCOD['tole_calib_ms'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['tole_calib_ms']] > 0){echo 'checked';}?> >
					</td>
					<td width="20%" class="NoiseFooterTD">&nbsp;Tolerancia gramaje <!--(g)--> (%) </td>
					<td width="30%" class="NoiseDataTD">
						<b>+</b>&nbsp;<?php echo ($tole_grama_ms)? $tole_grama_ms : '---' ; ?>
						<b>-</b>&nbsp;<?php echo ($tole_grama_mn)? $tole_grama_mn : '---' ; ?>
						&nbsp;<input type="checkbox" name="chktole_grama_ms" value="<?php echo $arrCampertipproCOD['tole_grama_ms'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['tole_grama_ms']] > 0){echo 'checked';}?> >
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
			<td width="25%" class="NoiseDataTD">&nbsp;<?php echo ($ancho)? $ancho : '---' ; ?>&nbsp;<input type="checkbox" name="chkancho" value="<?php echo $arrCampertipproCOD['ancho'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['ancho']] > 0){echo 'checked';}?> ></td>
			<td width="20%" class="NoiseFooterTD">&nbsp;Tolerancia del ancho (mm)</td>
			<td width="30%" class="NoiseDataTD">
				<b>+</b>&nbsp;<?php echo ($tole_ancho_ms)? $tole_ancho_ms : '---' ; ?>
				<b>-</b>&nbsp;<?php echo ($tole_ancho_mn)? $tole_ancho_mn : '---' ; ?>
				&nbsp;<input type="checkbox" name="chktole_ancho_ms" value="<?php echo $arrCampertipproCOD['tole_ancho_ms'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['tole_ancho_ms']] > 0){echo 'checked';}?> >
			</td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;Largo (mm)</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<?php echo ($largo)? $largo : '---' ; ?>&nbsp;<input type="checkbox" name="chklargo" value="<?php echo $arrCampertipproCOD['largo'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['largo']] > 0){echo 'checked';}?> ></span></td>
			<td class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;Tolerancia de largo (mm)</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">
				<b>+</b>&nbsp;<?php echo ($tole_largo_ms)? $tole_largo_ms : '**' ; ?>
				<b>-</b>&nbsp;<?php echo ($tole_largo_mn)? $tole_largo_mn : '**' ; ?>
				&nbsp;<input type="checkbox" name="chktole_largo_ms" value="<?php echo $arrCampertipproCOD['tole_largo_ms'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['tole_largo_ms']] > 0){echo 'checked';}?> >
			</span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;Ancho fotocelda (mm)</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<?php echo ($ancho_fotoc)? $ancho_fotoc : '---' ; ?>&nbsp;<input type="checkbox" name="chkdancho_fotoc" value="<?php echo $arrCampertipproCOD['ancho_fotoc'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['ancho_fotoc']] > 0){echo 'checked';}?> ></span></td>
			<td class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;Largo fotocelda (mm)</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<?php echo ($largo_fotoc)? $largo_fotoc : '---' ; ?>&nbsp;<input type="checkbox" name="chkdlargo_fotoc" value="<?php echo $arrCampertipproCOD['largo_fotoc'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['largo_fotoc']] > 0){echo 'checked';}?> ></span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;Distancia fotocelda al borde (mm)</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<?php echo ($dfotoc_borde)? $dfotoc_borde : '---' ; ?>&nbsp;<input type="checkbox" name="chkdfotoc_borde" value="<?php echo $arrCampertipproCOD['dfotoc_borde'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['dfotoc_borde']] > 0){echo 'checked';}?> ></span></td>
			<td class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;Color fotocelda</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<?php echo ($color_fotoc)? strtoupper($color_fotoc) : '---' ; ?>&nbsp;<input type="checkbox" name="chkcolor_fotoc" value="<?php echo $arrCampertipproCOD['color_fotoc'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['color_fotoc']] > 0){echo 'checked';}?> ></span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;Tipo de embobinado</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<?php echo ($tipo_emb)? strtoupper($tipo_emb) : '---' ; ?>&nbsp;<input type="checkbox" name="chktipo_emb" value="<?php echo $arrCampertipproCOD['tipo_emb'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['tipo_emb']] > 0){echo 'checked';}?> ></span></td>
			<td class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;Con respecto</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<?php echo ($con_resp)? strtoupper($con_resp) : '---' ; ?>&nbsp;<input type="checkbox" name="chkcon_resp" value="<?php echo $arrCampertipproCOD['con_resp'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['con_resp']] > 0){echo 'checked';}?> ></span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;C&oacute;digo de barras</span></td>
			<td class="NoiseDataTD" colspan="3"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<?php echo ($cod_barras)? strtoupper($cod_barras) : '---' ; ?>&nbsp;<input type="checkbox" name="chkcobro_fotopo" value="<?php echo $arrCampertipproCOD['cod_barras'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['cod_barras']] > 0){echo 'checked';}?> ></span></td>
		</tr>
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="4">&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD" colspan="4">&nbsp;<?php echo strtoupper($note_product) ?></tr>
	</table>
</div>
<!-- FIN PESTAÑA ESPECIFICACIONES DEL PRODUCTO -->


<!-- PESTAÑA 3 ESPECIFICACIONES DE EMBALAJE -->							
<div id="opt-tab4">
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="23%" class="NoiseFooterTD">&nbsp;Tama&ntilde;o del core (mm)</td>
			<td width="27%" class="NoiseDataTD">&nbsp;<?php echo ($tam_core)? $tam_core : '---' ; ?>&nbsp;<input type="checkbox" name="chktam_core" value="<?php echo $arrCampertipproCOD['tam_core'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['tam_core']] > 0){echo 'checked';}?> ></td>
			<td width="23%" class="NoiseFooterTD">&nbsp;Metros del rollo</td>
			<td width="27%" class="NoiseDataTD">&nbsp;<?php echo ($mrollo)? $mrollo : '---'; ?>&nbsp;<input type="checkbox" name="chkmrollo" value="<?php echo $arrCampertipproCOD['mrollo'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['mrollo']] > 0){echo 'checked';}?> ></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Peso del rollo (Kg)</td>
			<td class="NoiseDataTD">&nbsp;<?php echo ($prollo)? $prollo : '---'; ?>&nbsp;<input type="checkbox" name="chkprollo" value="<?php echo $arrCampertipproCOD['prollo'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['prollo']] > 0){echo 'checked';}?> ></td>
			<td class="NoiseFooterTD">&nbsp;Tolerancia del peso (Kg)</td>
			<td class="NoiseDataTD">
				<b>+</b>&nbsp;<?php echo ($tole_prollo_ms)? $tole_prollo_ms : '**'; ?>
				<b>-</b>&nbsp;<?php echo ($tole_prollo_mn)? $tole_prollo_mn : '**';  ?>
				&nbsp;<input type="checkbox" name="chktole_prollo_ms" value="<?php echo $arrCampertipproCOD['tole_prollo_ms'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['tole_prollo_ms']] > 0){echo 'checked';}?> >
			</td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Diametro del rollo (mm)</td>
			<td class="NoiseDataTD">&nbsp;<?php echo ($drollo)? $drollo: '---'; ?>&nbsp;<input type="checkbox" name="chkdrollo" value="<?php echo $arrCampertipproCOD['drollo'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['drollo']] > 0){echo 'checked';}?> ></td>
			<td class="NoiseFooterTD">&nbsp;Tolerancia del diametro (mm)</td>
			<td class="NoiseDataTD">
				<b>+</b>&nbsp;<?php echo ($tole_drollo_ms)? $tole_drollo_ms : '**'; ?>
				<b>-</b>&nbsp;<?php echo ($tole_drollo_mn)? $tole_drollo_mn : '**'; ?>
				&nbsp;<input type="checkbox" name="chktole_drollo_ms" value="<?php echo $arrCampertipproCOD['tole_drollo_ms'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['tole_drollo_ms']] > 0){echo 'checked';}?> >
			</td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Bandera</td>
			<td class="NoiseDataTD" colspan="3">&nbsp;<?php echo ($flag)? strtoupper($flag) : '---' ; ?>&nbsp;<input type="checkbox" name="chkflag" value="<?php echo $arrCampertipproCOD['flag'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['flag']] > 0){echo 'checked';}?> ></td>
		</tr>
		</table>
		
		<div id="session_bandera" style="display: <?php if($flag == 'si'){ echo 'block'; } else { echo 'none'; } ?>">
			<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
				<tr>
					<td width="23%" class="NoiseFooterTD">&nbsp;Color bandera</td>
					<td width="27%" class="NoiseDataTD">&nbsp;<?php echo ($color_flag)? strtoupper($color_flag) : '---' ; ?>&nbsp;<input type="checkbox" name="chkcolor_flag" value="<?php echo $arrCampertipproCOD['color_flag'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['color_flag']] > 0){echo 'checked';}?> ></td>
					<td width="23%" class="NoiseFooterTD">&nbsp;Ubicaci&oacute;n bandera</td>
					<td width="27%" class="NoiseDataTD">&nbsp;<?php echo ($ubic_flag)? strtoupper($ubic_flag) : '---' ; ?>&nbsp;<input type="checkbox" name="chkubic_flag" value="<?php echo $arrCampertipproCOD['ubic_flag'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['ubic_flag']] > 0){echo 'checked';}?> ></td>
				</tr>
			</table>
		</div>
	
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="23%" class="NoiseFooterTD">&nbsp;No. max empalmes</td>
			<td width="27%" class="NoiseDataTD">&nbsp;<?php echo ($nmax_empal)? strtoupper($nmax_empal) : '---' ; ?>&nbsp;<input type="checkbox" name="chknmax_empal" value="<?php echo $arrCampertipproCOD['nmax_empal'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['nmax_empal']] > 0){echo 'checked';}?> ></td>
			<td width="23%" class="NoiseFooterTD">&nbsp;Ancho de empalme</td>
			<td width="27%" class="NoiseDataTD">&nbsp;<?php echo ($ancho_empal)? strtoupper($ancho_empal) : '---' ; ?>&nbsp;<input type="checkbox" name="chkancho_empal" value="<?php echo $arrCampertipproCOD['ancho_empal'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['ancho_empal']] > 0){echo 'checked';}?> ></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Color Empalme Cara</td>
			<td class="NoiseDataTD">&nbsp;<?php echo ($cempal_cara)? strtoupper($cempal_cara) : '---' ; ?>&nbsp;<input type="checkbox" name="chkcempal_cara" value="<?php echo $arrCampertipproCOD['cempal_cara'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['cempal_cara']] > 0){echo 'checked';}?> ></td>
			<td class="NoiseFooterTD">&nbsp;Color Empalme Dorso</td>
			<td class="NoiseDataTD">&nbsp;<?php echo ($cempal_dorso)? strtoupper($cempal_dorso) : '---' ; ?>&nbsp;<input type="checkbox" name="chkcempal_dorso" value="<?php echo $arrCampertipproCOD['cempal_dorso'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['cempal_dorso']] > 0){echo 'checked';}?> ></td>
		</tr>
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="4">&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD" colspan="4"><?php echo strtoupper($note_embalaje) ?></tr>
	</table>
</div>
<!-- FIN PESTAÑA ESPECIFICACIONES DE EMBALAJE -->


<!-- PESTAÑA 4 MATERIAL EXTRUIDO SOLAMENTE -->
<div id="opt-tab5">
 <div id="esp_ext_seccion">
		<div id="filtrlistamatextruido">
			<?php
				$noAjax = true;
				include '../src/FunjQuery/jquery.phpscripts/jquery.ajax_matextruido.cal.php';  
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
			<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($lado_foil)? strtoupper($lado_foil) : '---' ; ?>&nbsp;<input type="checkbox" name="chklado_foil" value="<?php echo $arrCampertipproCOD['lado_foil'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['lado_foil']] > 0){echo 'checked';}?> ></td>
			<td width="20%" class="NoiseFooterTD">&nbsp; Tipo Adhesion</td>
			<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($tipo_proceso)? strtoupper($tipo_proceso) : '---' ; ?>&nbsp;<input type="checkbox" name="chktipo_proceso" value="<?php echo $arrCampertipproCOD['tipo_proceso'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['tipo_proceso']] > 0){echo 'checked';}?> ></td>
		</tr>
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="4">&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD" colspan="4"><?php echo strtoupper($note_laminacion) ?></tr>
	</table>
</div>
<!-- FIN PESTAÑA LAMINACION -->


<!-- PESTAÑA 6 CONDICIONES DE PROCESO PARA EL DESARROLLO -->
<div id="opt-tab7">
	<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;Producto a empacar</td>
			<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($product_empa)? strtoupper($product_empa) : '---' ; ?>&nbsp;<input type="checkbox" name="chkproduct_empa" value="<?php echo $arrCampertipproCOD['product_empa'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['product_empa']] > 0){echo 'checked';}?> ></td>
			<td width="25%" class="NoiseFooterTD">&nbsp;Temperatura de empacado (C)</td>
			<td width="25%" class="NoiseDataTD">&nbsp;<?php echo ($temp_empa)? strtoupper($temp_empa) : '---' ; ?>&nbsp;<input type="checkbox" name="chktemp_empa" value="<?php echo $arrCampertipproCOD['temp_empa'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['temp_empa']] > 0){echo 'checked';}?> ></td>
		</tr>
		
		<tr>
			<td class="NoiseFooterTD">&nbsp;Tipo de sellado</td>
			<td class="NoiseDataTD">&nbsp;<?php echo ($tipo_sellado)? strtoupper($tipo_sellado) : '---' ; ?>&nbsp;<input type="checkbox" name="chktipo_sellado" value="<?php echo $arrCampertipproCOD['tipo_sellado'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['tipo_sellado']] > 0){echo 'checked';}?> ></td>
			<td class="NoiseFooterTD">&nbsp;Velocidad (Unid/min)</td>
			<td class="NoiseDataTD">&nbsp;<?php echo ($vel_empa)? strtoupper($vel_empa) : '---' ; ?>&nbsp;<input type="checkbox" name="chkvel_empa" value="<?php echo $arrCampertipproCOD['vel_empa'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['vel_empa']] > 0){echo 'checked';}?>  ></td>
		</tr>
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="4">&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD" colspan="4"><?php echo strtoupper($note_proces) ?></tr>
	</table>
</div>
<!-- FIN PESTAÑA 6 CONDICIONES DE PROCESO PARA EL DESARROLLO -->

<!-- PESTAÑA 4 FORMA EMPAQUE -->
<div id="opt-tab4a">
	<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;Forma de empaque</td>
			<td width="80%" class="NoiseDataTD">&nbsp;<?php echo ($form_empa)? strtoupper($form_empa) : '---' ; ?>&nbsp;<input type="checkbox" name="chkform_empa" value="<?php echo $arrCampertipproCOD['form_empa'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['form_empa']] > 0){echo 'checked';}?> ></td>
		<tr>
	</table>
	
	<div id="seccion_formempa_suspendido" style="display: <?php if($form_empa == 'suspendido'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;Niveles por estiba</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($niv_estiba)? $niv_estiba : '---' ; ?>&nbsp;<input type="checkbox" name="chkniv_estiba" value="<?php echo $arrCampertipproCOD['niv_estiba'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['niv_estiba']] > 0){echo 'checked';}?> ></td>
				<td width="20%" class="NoiseFooterTD">&nbsp;Peso por estiba (Kg)</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($peso_estiba)? $peso_estiba : '---' ; ?>&nbsp;<input type="checkbox" name="chkpeso_estiba" value="<?php echo $arrCampertipproCOD['peso_estiba'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['peso_estiba']] > 0){echo 'checked';}?> ></td>
			<tr>
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;Bolsa pl&aacute;stica</td>
				<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo ($bolsa_plastica)? strtoupper($bolsa_plastica) : '---'; ?>&nbsp;<input type="checkbox" name="chkbolsa_plastica" value="<?php echo $arrCampertipproCOD['bolsa_plastica'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['bolsa_plastica']] > 0){echo 'checked';}?> ></td>
			</tr>
		</table>
	</div>
	
	<div id="seccion_formempa_caja" style="display: <?php if($form_empa == 'caja'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;Protector core</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($pro_core)? strtoupper($pro_core) : '---'; ?>&nbsp;<input type="checkbox" name="chkpro_core" value="<?php echo $arrCampertipproCOD['pro_core'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['pro_core']] > 0){echo 'checked';}?> ></td>
				<td width="20%" class="NoiseFooterTD">&nbsp;Bolsa pl&aacute;stica</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($bolsa_plastica)? strtoupper($bolsa_plastica) : '---'; ?>&nbsp;<input type="checkbox" name="chkbolsa_plastica" value="<?php echo $arrCampertipproCOD['bolsa_plastica'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['bolsa_plastica']] > 0){echo 'checked';}?> ></td>
			<tr>
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;Peso Maximo por caja (kg)</td>
				<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo ($peso_max)? $peso_max : '---' ; ?>&nbsp;<input type="checkbox" name="chkpeso_max" value="<?php echo $arrCampertipproCOD['peso_max'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['peso_max']] > 0){echo 'checked';}?> ></td>
			</tr>
		</table>
	</div>
	
	<div id="seccion_formempa_bolsa_plastica" style="display: <?php if($form_empa == 'bolsa_plastica'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;Protector core</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($pro_core)? strtoupper($pro_core) : '---'; ?>&nbsp;<input type="checkbox" name="chkpro_core" value="<?php echo $arrCampertipproCOD['pro_core'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['pro_core']] > 0){echo 'checked';}?> ></td>
				<td width="20%" class="NoiseFooterTD">&nbsp;Peso Maximo por bolsa (kg)</td>
				<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo ($peso_max)? $peso_max : '---' ; ?>&nbsp;<input type="checkbox" name="chkpeso_max" value="<?php echo $arrCampertipproCOD['peso_max'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['peso_max']] > 0){echo 'checked';}?> ></td>
			</tr>
		</table>
	</div>
	
	<div id="seccion_formempa_carton_extremos" style="display: <?php if($form_empa == 'carton_extremos'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;Protector core</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($pro_core)? strtoupper($pro_core) : '---'; ?>&nbsp;<input type="checkbox" name="chkpro_core" value="<?php echo $arrCampertipproCOD['pro_core'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['pro_core']] > 0){echo 'checked';}?> ></td>
				<td width="20%" class="NoiseFooterTD">&nbsp;Bolsa pl&aacute;stica</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($bolsa_plastica)? strtoupper($bolsa_plastica) : '---'; ?>&nbsp;<input type="checkbox" name="chkbolsa_plastica" value="<?php echo $arrCampertipproCOD['bolsa_plastica'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['bolsa_plastica']] > 0){echo 'checked';}?> ></td>
			<tr>
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;No. Rollos</td>
				<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo ($no_rollos)? $no_rollos : '---'; ?>&nbsp;<input type="checkbox" name="chkno_rollos" value="<?php echo $arrCampertipproCOD['no_rollos'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['no_rollos']] > 0){echo 'checked';}?> ></td>
			</tr>
		</table>
	</div>
	
	<div id="seccion_formempa_cubierto_extremos" style="display: <?php if($form_empa == 'cubierto_extremos'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;Protector core</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($pro_core)? strtoupper($pro_core) : '---'; ?>&nbsp;<input type="checkbox" name="chkpro_core" value="<?php echo $arrCampertipproCOD['pro_core'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['pro_core']] > 0){echo 'checked';}?> ></td>
				<td width="20%" class="NoiseFooterTD">&nbsp;Bolsa pl&aacute;stica</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($bolsa_plastica)? strtoupper($bolsa_plastica) : '---'; ?>&nbsp;<input type="checkbox" name="chkbolsa_plastica" value="<?php echo $arrCampertipproCOD['bolsa_plastica'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['bolsa_plastica']] > 0){echo 'checked';}?> ></td>
			<tr>
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;No. Rollos</td>
				<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo ($no_rollos)? $no_rollos : '---' ;?>&nbsp;<input type="checkbox" name="chkno_rollos" value="<?php echo $arrCampertipproCOD['no_rollos'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['no_rollos']] > 0){echo 'checked';}?> ></td>
			</tr>
		</table>
	</div>
	
	<br/>
	<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;Material estibado</td>
			<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($estibado)? strtoupper($estibado) : '---' ; ?>&nbsp;<input type="checkbox" name="chkestibado" value="<?php echo $arrCampertipproCOD['estibado'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['estibado']] > 0){echo 'checked';}?> ></td>
			<td width="20%" class="NoiseDataTD">&nbsp;</td>
			<td width="30%" class="NoiseDataTD">&nbsp;</td>
		</tr>
	</table>
	<div id="session_estibado" style="display: <?php if($estibado == 'si'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;Tama&ntilde;o de estiba</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($tam_estiba)? $tam_estiba : '---' ; ?>&nbsp;<input type="checkbox" name="chktam_estiba" value="<?php echo $arrCampertipproCOD['tam_estiba'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['tam_estiba']] > 0){echo 'checked';}?> ></td>
				<td width="20%" class="NoiseFooterTD">&nbsp;Tipo de estiba</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($tipo_estiba)? strtoupper($tipo_estiba) : '---' ; ?>&nbsp;<input type="checkbox" name="chktipo_estiba" value="<?php echo $arrCampertipproCOD['tipo_estiba'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['tipo_estiba']] > 0){echo 'checked';}?> ></td>
			</tr>
			<tr><td class="ui-state-default" colspan="4"></td></tr>
			<tr>
				<td class="NoiseFooterTD">&nbsp;Altura m&aacute;xima pallet (mm)</td>
				<td class="NoiseDataTD">&nbsp;<?php echo ($alt_pallet)? $alt_pallet : '---'; ?>&nbsp;<input type="checkbox" name="chkalt_pallet" value="<?php echo $arrCampertipproCOD['alt_pallet'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['alt_pallet']] > 0){echo 'checked';}?> ></td>
				<td class="NoiseFooterTD">&nbsp;Peso por pallet (Kg)</td>
				<td class="NoiseDataTD">&nbsp;<?php echo ($pes_pallet)? $pes_pallet: '---'; ?>&nbsp;<input type="checkbox" name="chkpes_pallet" value="<?php echo $arrCampertipproCOD['pes_pallet'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['pes_pallet']] > 0){echo 'checked';}?> ></td>
			</tr>
			<tr>
				<td class="NoiseFooterTD">&nbsp;Estresado</td>
				<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo ($estresado)? strtoupper($estresado) : '---' ; ?>&nbsp;<input type="checkbox" name="chkestresado" value="<?php echo $arrCampertipproCOD['estresado'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['estresado']] > 0){echo 'checked';}?> ></td>
			</tr>
		</table>
	</div>
	<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr><td class="ui-state-default"></td></tr>
		<tr><td class="NoiseFooterTD">&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD"><?php echo strtoupper($note_formaempaque) ?></tr>
	</table>
</div>
<!-- FIN PESTAÑA FORMA EMPAQUE -->

<!-- PESTAÑA 7 NOTAS DE MODIFICACION -->
<?php if($tipevecodigo == 2):?>
<div id="opt-tab8">
	<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="30%" class="NoiseDataTD">&nbsp;Calibre/Estructura&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($calibre_estructura)? 'SI': 'NO';?></td>
			<td width="30%" class="NoiseDataTD">&nbsp;Dise&ntilde;o/Textos/Colores&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($disenio_textos_colores)? 'SI': 'NO';?></td>
			<td width="40%" class="NoiseDataTD">&nbsp;Medidas&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($medidas)? 'SI': 'NO';?></td>
		</tr>
		<tr>
			<td colspan="2" class="NoiseDataTD">&nbsp;Especificaci&oacute;n de embalaje&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($esp_emb)? 'SI': 'NO';?></td>
			<td colspan="2" class="NoiseDataTD">&nbsp;Especificaciones de Material extruido&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($esp_ext)? 'SI': 'NO';?></td>
		</tr>
		<tr><td class="ui-state-default" colspan="7"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="7">&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD" colspan="7"><?php echo strtoupper($note_notas) ?></tr>
	</table>
</div>
<script type="text/javascript"></script>
<?php endif;?>
<!-- PESTAÑA 7 NOTAS DE MODIFICACION -->