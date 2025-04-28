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
		<td colspan="4" class="ui-state-default">&nbsp;Medidas Bolsa Lateral</td>
		</tr>
		<tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;Ancho (mm)</td>
			<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($ancho)? $ancho : '---' ; ?>&nbsp;<input type="checkbox" name="chkancho" value="<?php echo $arrCampertipproCOD['ancho'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['ancho']] > 0){echo 'checked';}?> ></td>
			<td width="20%" class="NoiseFooterTD">&nbsp;Tolerancia del ancho (mm)</td>
			<td width="30%" class="NoiseDataTD">
				<b>+</b>&nbsp;<?php echo ($tole_ancho_ms)? $tole_ancho_ms : '**' ; ?>
				<b>-</b>&nbsp;<?php echo ($tole_ancho_mn)? $tole_ancho_mn : '**' ; ?>
				&nbsp;<input type="checkbox" name="chktole_ancho_ms" value="<?php echo $arrCampertipproCOD['tole_ancho_ms'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['tole_ancho_ms']] > 0){echo 'checked';}?> >
			</td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Largo (mm)</td>
			<td class="NoiseDataTD">&nbsp;<?php echo ($largo)? $largo : '---' ; ?>&nbsp;<input type="checkbox" name="chklargo" value="<?php echo $arrCampertipproCOD['largo'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['largo']] > 0){echo 'checked';}?> ></td>
			<td class="NoiseFooterTD">&nbsp;Tolerancia de largo (mm)</td>
			<td class="NoiseDataTD">
				<b>+</b>&nbsp;<?php echo ($tole_largo_ms)? $tole_largo_ms : '**' ; ?>
				<b>-</b>&nbsp;<?php echo ($tole_largo_mn)? $tole_largo_mn : '**' ; ?>
				&nbsp;<input type="checkbox" name="chktole_largo_ms" value="<?php echo $arrCampertipproCOD['tole_largo_ms'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['tole_largo_ms']] > 0){echo 'checked';}?> >
			</td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Fuelle (mm)</td>
			<td class="NoiseDataTD">&nbsp;<?php echo ($fuelle)? $fuelle : '---' ; ?>&nbsp;<input type="checkbox" name="chkfuelle" value="<?php echo $arrCampertipproCOD['fuelle'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['fuelle']] > 0){echo 'checked';}?> ></td>
			<td class="NoiseFooterTD">&nbsp;Tolerancia de fuelle (mm)</td>
			<td class="NoiseDataTD">
				<b>+</b>&nbsp;<?php echo ($tole_fuelle_ms)? $tole_fuelle_ms : '**' ?>
				<b>-</b>&nbsp;<?php echo ($tole_fuelle_mn)? $tole_fuelle_mn : '**' ?>
				&nbsp;<input type="checkbox" name="chktole_fuelle_ms" value="<?php echo $arrCampertipproCOD['tole_fuelle_ms'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['tole_fuelle_ms']] > 0){echo 'checked';}?> >
			</td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Solapa (mm)</td>
			<td class="NoiseDataTD">&nbsp;<?php echo ($solapa)? $solapa : '---'; ?>&nbsp;<input type="checkbox" name=chksolapa value="<?php echo $arrCampertipproCOD['solapa'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['solapa']] > 0){echo 'checked';}?> ></td>
			<td class="NoiseFooterTD"><span id="ncaras_imp_lb" style="display : <?php if($tipo_impresion != 'sin_impresion'){echo 'block';}else{'none';}?>">&nbsp;No. de caras impresas</span></td>
			<td class="NoiseDataTD" colspan="3"><span id="ncaras_imp_obj" style="display : <?php if($tipo_impresion != 'sin_impresion'){echo 'block';}else{echo 'none';}?>">&nbsp;<?php echo ($ncaras_imp)? $ncaras_imp : '---' ; ?>&nbsp;<input type="checkbox" name="chkncaras_imp" value="<?php echo $arrCampertipproCOD['ncaras_imp'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['ncaras_imp']] > 0){echo 'checked';}?>></span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Wicket</td>
			<td class="NoiseDataTD">&nbsp;<?php echo ($wicket)? strtoupper($wicket) : '---' ; ?>&nbsp;<input type="checkbox" name="chkwicket" value="<?php echo $arrCampertipproCOD['wicket'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['wicket']] > 0){echo 'checked';}?>></td>
			<td class="NoiseFooterTD">&nbsp;Peso millar (Kg)</td>
			<td class="NoiseDataTD">&nbsp;<span id="pesomillar"><?php echo round((((double) $solapa / 1000) + ((double) $largo / 1000 * 2) + ((double)  $solapa / 1000 * 2) + ((double)  $fuelle / 1000 * 2)) * (((double)  $ancho / 1000) * ((double) $total_gramaje)) * 100 ) / 100 ?></span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Troquel</td>
			<td class="NoiseDataTD" colspan="3">&nbsp;<?php echo ($troquel)? strtoupper($troquel) : '---' ; ?>&nbsp;<input type="checkbox" name="chktroquel" value="<?php echo $arrCampertipproCOD['troquel'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['troquel']] > 0){echo 'checked';}?> ></td>
		</tr>
	</table>
	
	<div style="display: <?php if($troquel == 'si'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td class="NoiseFooterTD" width="20%">&nbsp;Tipo de troquel</td>
				<td class="NoiseDataTD" width="80%">&nbsp;<?php echo ($tipo_troquel)? strtoupper($tipo_troquel) : '---' ; ?>&nbsp;<input type="checkbox" name="chktipo_troquel" value="<?php echo $arrCampertipproCOD['tipo_troquel'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['tipo_troquel']] > 0){echo 'checked';}?> ></td>
			</tr>
		</table>
	</div>
	
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;Llenado</td>
			<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($tipo_llenado)? strtoupper($tipo_llenado) : '---' ; ?>&nbsp;<input type="checkbox" name="chktipo_llenado" value="<?php echo $arrCampertipproCOD['tipo_llenado'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['tipo_llenado']] > 0){echo 'checked';}?> ></td>
			<td width="20%" class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;C&oacute;digo de barras</span></td>
			<td width="30%" class="NoiseDataTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<?php echo ($cod_barras)? strtoupper($cod_barras) : '---' ; ?>&nbsp;<input type="checkbox" name="chkcod_barras" value="<?php echo $arrCampertipproCOD['cod_barras'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['cod_barras']] > 0){echo 'checked';}?> ></span></td>
		</tr>
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="4">&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD" colspan="4"><?php echo strtoupper($note_product)  ?></tr>
	</table>
</div>
<!-- FIN PESTAÑA ESPECIFICACIONES DEL PRODUCTO -->


<!-- PESTAÑA 3 ESPECIFICACIONES DE EMBALAJE -->							
<div id="opt-tab4">
	<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="22%" class="NoiseFooterTD">&nbsp;Tipo de empaque</td>
			<td width="28%" class="NoiseDataTD">&nbsp;<?php echo ($tipo_empaque)? strtoupper($tipo_empaque) : '---' ; ?>&nbsp;<input type="checkbox" name="chktipo_empaque" value="<?php echo $arrCampertipproCOD['tipo_empaque'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['tipo_empaque']] > 0){echo 'checked';}?> ></td>
			<td width="22%" class="NoiseFooterTD">&nbsp;Unidades por empaque</td>
			<td width="28%" class="NoiseDataTD">&nbsp;<?php echo ($uni_empaque)? strtoupper($uni_empaque) : '---' ; ?>&nbsp;<input type="checkbox" name="chkuni_empaque" value="<?php echo $arrCampertipproCOD['uni_empaque'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['uni_empaque']] > 0){echo 'checked';}?> ></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Unidades por paquete</td>
			<td class="NoiseDataTD">&nbsp;<?php echo ($uni_paquete)? $uni_paquete : '---' ; ?>&nbsp;<input type="checkbox" name="chkuni_paquete" value="<?php echo $arrCampertipproCOD['uni_paquete'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['uni_paquete']] > 0){echo 'checked';}?> ></td>
			<td class="NoiseFooterTD">&nbsp;Peso m&aacute;ximo empaque (Kg)</td>
			<td class="NoiseDataTD">&nbsp;<?php echo ($peso_empaque)? $peso_empaque : '---' ; ?>&nbsp;<input type="checkbox" name="chkpeso_empaque" value="<?php echo $arrCampertipproCOD['peso_empaque'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['peso_empaque']] > 0){echo 'checked';}?> ></td>
		</tr>
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Material estibado</td>
			<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo ($estibado)? strtoupper($estibado) : '---' ; ?>&nbsp;<input type="checkbox" name="chkestibado" value="<?php echo $arrCampertipproCOD['estibado'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['estibado']] > 0){echo 'checked';}?> ></td>
		</tr>
	</table>
	<div id="session_estibado" style="display: <?php if($estibado == 'si'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td class="NoiseFooterTD" width="22%">&nbsp;Tama&ntilde;o de estiba</td>
				<td class="NoiseDataTD" width="28%">&nbsp;<?php echo ($tam_estiba)? strtoupper($tam_estiba) : '---' ; ?>&nbsp;<input type="checkbox" name="chktam_estiba" value="<?php echo $arrCampertipproCOD['tam_estiba'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['tam_estiba']] > 0){echo 'checked';}?> > </td>
				<td class="NoiseFooterTD" width="22%">&nbsp;Tipo de estiba</td>
				<td class="NoiseDataTD" width="28%">&nbsp;<?php echo ($tipo_estiba)? strtoupper($tipo_estiba) : '---' ; ?>&nbsp;<input type="checkbox" name="chktipo_estiba" value="<?php echo $arrCampertipproCOD['tipo_estiba'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['tipo_estiba']] > 0){echo 'checked';}?> ></td>
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
		<tr><td class="NoiseDataTD">&nbsp;<?php echo strtoupper($note_embalaje) ?></td>
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
		<tr><td class="NoiseDataTD" colspan="4"><?php echo ($note_laminacion)? strtoupper($note_laminacion) : '---' ; ?></tr>
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
			<td width="25%" class="NoiseDataTD">&nbsp;<?php echo ($temp_empa)? $temp_empa : '---' ; ?>&nbsp;<input type="checkbox" name="chktemp_empa" value="<?php echo $arrCampertipproCOD['temp_empa'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['temp_empa']] > 0){echo 'checked';}?> ></td>
		</tr>
		
		<tr>
			<td class="NoiseFooterTD">&nbsp;Tipo de sellado</td>
			<td class="NoiseDataTD" colspan="3">&nbsp;<?php echo ($tipo_sellado)? strtoupper($tipo_sellado) : '---' ; ?>&nbsp;<input type="checkbox" name="chktipo_sellado" value="<?php echo $arrCampertipproCOD['tipo_sellado'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['tipo_sellado']] > 0){echo 'checked';}?> ></td>
		</tr>
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="4">&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD" colspan="4"><?php echo strtoupper($note_proces) ?></tr>
	</table>
</div>
<!-- FIN PESTAÑA 6 CONDICIONES DE PROCESO PARA EL DESARROLLO -->

<!-- PESTAÑA 7 NOTAS DE MODIFICACION -->
<?php if($tipevecodigo == 2):?>
<div id="opt-tab8">
	<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="30%" class="NoiseDataTD">&nbsp;Calibre/Estructura&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($calibre_estructura)? 'SI': 'NO';?></td>
			<td width="30%" class="NoiseDataTD">&nbsp;Dise&ntilde;o/Textos/Colores&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($disenio_textos_colores)? 'SI': 'NO';?></td>
			<td width="20%" class="NoiseDataTD">&nbsp;Medidas&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($medidas)? 'SI': 'NO';?></td>
			<td width="20%" class="NoiseDataTD">&nbsp;Accesorios&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($accesorios)? 'SI': 'NO';?></td>
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
