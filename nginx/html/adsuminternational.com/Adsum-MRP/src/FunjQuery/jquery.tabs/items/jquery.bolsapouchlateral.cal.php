<!-- PESTA�A 2 ESPECIFICACIONES DEL PRODUCTO -->
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
		<td colspan="4" class="ui-state-default">&nbsp;Medidas Bolsa Pouch Lateral</td>
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
			<td class="NoiseFooterTD"><span id="ncaras_imp_lb" style="display : <?php if($tipo_impresion != 'sin_impresion'){echo 'block';}else{'none';}?>">&nbsp;No. de caras impresas</span></td>
			<td class="NoiseDataTD" colspan="3"><span id="ncaras_imp_obj" style="display : <?php if($tipo_impresion != 'sin_impresion'){echo 'block';}else{echo 'none';}?>">&nbsp;<?php echo ($ncaras_imp)? $ncaras_imp : '---' ; ?>&nbsp;<input type="checkbox" name="chkncaras_imp" value="<?php echo $arrCampertipproCOD['ncaras_imp'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['ncaras_imp']] > 0){echo 'checked';}?> ></span></td>
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
		<td colspan="4" class="ui-state-default">&nbsp;Especificaciones Bolsa Pouch Lateral</td>
		</tr>
		<tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;No. de sellos</td>
			<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo ($nro_sellos)? $nro_sellos : '---' ;?>&nbsp;<input type="checkbox" name="chknro_sellos" value="<?php echo $arrCampertipproCOD['nro_sellos'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['nro_sellos']] > 0){echo 'checked';}?> ></td>
		</tr>
		<tr>
	  		<td width="20%" class="NoiseFooterTD">&nbsp;Ancho de selle a las bolsas</td>
	  		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($aselle_bolsa)? $aselle_bolsa : '---' ;?>&nbsp;<input type="checkbox" name="chkaselle_bolsa" value="<?php echo $arrCampertipproCOD['aselle_bolsa'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['aselle_bolsa']] > 0){echo 'checked';}?> ></td>
			<td width="20%" class="NoiseFooterTD">&nbsp;Peso millar (Kg)</td>
			<td width="30%" class="NoiseDataTD">&nbsp;<span id="pesomillar"><?php echo round((((double) $solapa / 1000) + ((double) $largo / 1000 * 2) + ((double)  $solapa / 1000 * 2) + ((double)  $fuelle / 1000 * 2)) * (((double)  $ancho / 1000) * ((double) $total_gramaje)) * 100 ) / 100 ?></span></td>
		</tr>
		<tr>
		<td colspan="4" class="ui-state-default">&nbsp;Accesorios Bolsa Pouch Lateral</td>
		</tr>
		<tr>
	 	  	<td class="NoiseFooterTD">&nbsp;V&aacute;lvula</td>
	 	  	<td class="NoiseDataTD" colspan="3">&nbsp;<?php echo ($valve)? strtoupper($valve) : '---' ;?>&nbsp;<input type="checkbox" name="chkvalve" value="<?php echo $arrCampertipproCOD['valve'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['valve']] > 0){echo 'checked';}?> ></td>
	  	</tr>
		<tr> 
			<td class="NoiseFooterTD"><span style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Color Tapa V&aacute;lvula</span></td> 
			<td class="NoiseDataTD"><span id="ctapa_valveobj" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<?php echo ($ctapa_valve)? strtoupper($ctapa_valve) : '---' ;?>&nbsp;<input type="checkbox" name="chkctapa_valve" value="<?php echo $arrCampertipproCOD['ctapa_valve'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['ctapa_valve']] > 0){echo 'checked';}?> ></span></td>
	  		<td class="NoiseFooterTD"><span id="medi_valvelb" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Medida V&aacute;lvula (mm)</span></td>
	  		<td class="NoiseDataTD"><span id="medi_valveobj" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<?php echo ($medi_valve)? strtoupper($medi_valve) : '---' ; ?>&nbsp;<input type="checkbox" name="chkmedi_valve" value="<?php echo $arrCampertipproCOD['medi_valve'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['medi_valve']] > 0){echo 'checked';}?> ></span></td>
	  	</tr>
	  	
		<tr> 
	  		<td class="NoiseFooterTD"><span id="ubic_valvelb" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Ubicaci&oacute;n V&aacute;lvula</span></td>
	  		<td class="NoiseDataTD"><span id="ubic_valveobj" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<?php echo ($ubic_valve)? strtoupper($ubic_valve) : '---' ; ?>&nbsp;<input type="checkbox" name="chkubic_valve" value="<?php echo $arrCampertipproCOD['ubic_valve'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['ubic_valve']] > 0){echo 'checked';}?> ></span></td>
	  		<td class="NoiseFooterTD"><span id="tipo_valvelb" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Tipo de V&aacute;lvula</span></td>
	 	  	<td class="NoiseDataTD"><span id="tipo_valveobj" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<?php echo ($tipo_valve)? strtoupper($tipo_valve) : '---'; ?>&nbsp;<input type="checkbox" name="chktipo_valve" value="<?php echo $arrCampertipproCOD['tipo_valve'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['tipo_valve']] > 0){echo 'checked';}?> ></span></td>
	  	</tr>
	  	<tr>
			<td class="NoiseFooterTD"><span id="ziper_lb" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Ziper</span></td>
	  		<td class="NoiseDataTD"><span id="ziper_obj" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<?php echo ($ziper)? strtoupper($ziper) : '---' ;?>&nbsp;<input type="checkbox" name="chkziper" value="<?php echo $arrCampertipproCOD['ziper'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['ziper']] > 0){echo 'checked';}?> ></span></td>
	  		<td class="NoiseFooterTD"><span id="dist_ziper_lb" style="display : <?php if($ziper == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Dist. ziper al borde</span></td>
	 	  	<td class="NoiseDataTD"><span id="dist_ziper_obj" style="display : <?php if($ziper == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<?php echo ($dist_ziper)? strtoupper($dist_ziper) : '---' ;?>&nbsp;<input type="checkbox" name="chkdist_ziper" value="<?php echo $arrCampertipproCOD['dist_ziper'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['dist_ziper']] > 0){echo 'checked';}?> ></span></td>
	  	</tr>
	  	<tr>
			<td class="NoiseFooterTD">&nbsp;Muesca</td>
	  		<td class="NoiseDataTD">&nbsp;<?php echo ($muesca)? strtoupper($muesca) : '---' ; ?>&nbsp;<input type="checkbox" name="chkmuesca" value="<?php echo $arrCampertipproCOD['muesca'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['muesca']] > 0){echo 'checked';}?> ></td>
	  		<td class="NoiseFooterTD"><span id="dist_muesca_lb" style="display : <?php if($muesca == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Dist. muesca al borde</span></td>
	 	  	<td class="NoiseDataTD"><span id="dist_muesca_obj" style="display : <?php if($muesca == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<?php echo ($dist_muesca)? strtoupper($dist_muesca) : '---' ; ?>&nbsp;<input type="checkbox" name="chkdist_muesca" value="<?php echo $arrCampertipproCOD['dist_muesca'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['dist_muesca']] > 0){echo 'checked';}?> ></span></td>
	  	</tr>
	  	<tr>
			<td class="NoiseFooterTD">&nbsp;Precorte</td>
	  		<td class="NoiseDataTD">&nbsp;<?php echo ($precorte)? strtoupper($precorte) : '---' ; ?>&nbsp;<input type="checkbox" name="chkprecorte" value="<?php echo $arrCampertipproCOD['precorte'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['precorte']] > 0){echo 'checked';}?> ></td>
	  		<td class="NoiseFooterTD"><span id="dist_precorte_lb" style="display : <?php if($precorte == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Dist. precorte al borde</span></td>
	 	  	<td class="NoiseDataTD"><span id="dist_precorte_obj" style="display : <?php if($precorte == 'si'){echo 'block';}else{echo 'none';}?>"><?php echo ($dist_precorte)? strtoupper($dist_precorte) : '---' ; ?>&nbsp;<input type="checkbox" name="chkdist_precorte" value="<?php echo $arrCampertipproCOD['dist_precorte'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['dist_precorte']] > 0){echo 'checked';}?> ></span></td>
	  	</tr>
	</table>
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td class="NoiseFooterTD" width="20%">&nbsp;Llenado</td>
			<td class="NoiseDataTD" width="30%">&nbsp;<?php echo ($tipo_llenado)? strtoupper($tipo_llenado): '---' ;?>&nbsp;<input type="checkbox" name="chktipo_llenado" value="<?php echo $arrCampertipproCOD['tipo_llenado'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['tipo_llenado']] > 0){echo 'checked';}?> ></td>
			<td class="NoiseFooterTD" width="20%">&nbsp;C&oacute;digo de barras</td>
			<td class="NoiseDataTD" width="30%">&nbsp;<?php echo ($cod_barras)? strtoupper($cod_barras): '---' ; ?>&nbsp;<input type="checkbox" name="chkcod_barras" value="<?php echo ($arrCampertippro['cod_barras'])? $arrCampertipproCOD['cod_barras'] : '-------' ; ?>" onclick="setSelectionRow(this.value, document.getElementById('arrRatings').value, ',', 'arrRatings');" <?php if($arrCampertipproCAL[$arrCampertipproCOD['cod_barras']] > 0){echo 'checked';}?> ></td>
		</tr>
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="4">&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD" colspan="4">&nbsp;<?php echo strtoupper($note_product) ?></tr>
	</table>
	
</div>
<!-- FIN PESTA�A ESPECIFICACIONES DEL PRODUCTO -->


<!-- PESTA�A 3 ESPECIFICACIONES DE EMBALAJE -->							
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
<!-- FIN PESTA�A ESPECIFICACIONES DE EMBALAJE -->


<!-- PESTA�A 4 MATERIAL EXTRUIDO SOLAMENTE -->
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
<!-- FIN PESTA�A MATERIAL EXTRUIDO SOLAMENTE -->


<!-- PESTA�A 5 LAMINACION -->
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
<!-- FIN PESTA�A LAMINACION -->


<!-- PESTA�A 6 CONDICIONES DE PROCESO PARA EL DESARROLLO -->
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
<!-- FIN PESTA�A 6 CONDICIONES DE PROCESO PARA EL DESARROLLO -->

<!-- PESTA�A 7 NOTAS DE MODIFICACION -->
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
<!-- PESTA�A 7 NOTAS DE MODIFICACION -->
