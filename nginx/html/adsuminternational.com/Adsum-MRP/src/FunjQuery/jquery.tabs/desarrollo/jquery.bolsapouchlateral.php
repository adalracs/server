<!-- PESTAÑA 2 ESPECIFICACIONES DEL PRODUCTO -->
<div id="opt-tab2">
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
  			<td width="20%" class="NoiseFooterTD">&nbsp;Tipo de Producto</td>
  			<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="tipoproducto" value="<?php echo $tipoproducto ?>"/><?php echo $tipoproducto ?> </td>
  			<td width="20%" class="NoiseFooterTD">&nbsp;Estructura</td>
  			<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="tipo_estruc" id="tipo_estruc" value="<?php echo $tipo_estruc ?>" /><?php echo strtoupper($tipo_estruc) ?></td>
  		</tr>
  		<tr>
  			<td width="20%" class="NoiseFooterTD">&nbsp;Tipo de Impresion</td>
  			<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="tipo_impresion" value="<?php echo $tipo_impresion ?>"/><?php echo strtoupper($tipo_impresion) ?> </td>
  			<td width="20%" class="NoiseFooterTD">&nbsp;Documentos Adjuntos</td>
  			<td width="30%" class="NoiseDataTD">&nbsp;</td>
  		</tr>
  		<tr>
  			<td width="20%" class="NoiseFooterTD">&nbsp;Listado de Colores</td>
  			<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="list_colors" value="<?php echo $list_colors ?>"/><?php echo strtoupper($list_colors) ?> </td>
  		</tr>
  		<tr>
  			<td width="20%" class="NoiseFooterTD">&nbsp;Colores Aprobados por:</td>
  			<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="colorespor" value="<?php echo $colorespor ?>" /><?php echo $colorespor ?></td>
  		</tr>
  		<tr>
  			<td width="20%" class="NoiseFooterTD">&nbsp;Impresion</td>
  			<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="tipo_impresion" value="<?php echo $tipo_impresion ?>"/><?php echo strtoupper($tipo_impresion) ?> </td>
  			<td width="20%" class="NoiseFooterTD">&nbsp;Productos Aprobados por:</td>
  			<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="producpor" value="<?php echo $producpor ?>" /><?php echo strtoupper($producpor) ?></td>
  		</tr>
  		<tr>
  			<td width="20%" class="NoiseFooterTD">&nbsp;Tintas Resistentas a:</td>
  			<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="tintasa" value="<?php echo $tintasa ?>"/><?php echo strtoupper($tintasa) ?> </td>
  		</tr>
  		<tr>
  			<td colspan="4" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['tinta_espe']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if ($campnomb["tinta_espe"] == 1) { $tinta_espe = null; echo "*";}?>&nbsp;Tintas Especiales para:</td>
  		</tr>
  		<tr>
  			<td colspan="4" class="NoiseDataTD"><div id="tintas_especiales_para">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  				<input type="checkbox" name="tntesp_laminacion" id="tntesp_laminacion" value="1" <?php if($tntesp_laminacion){echo 'checked';}?>><label for="tntesp_laminacion">Laminacion</label>&nbsp;&nbsp;
		  		<input type="checkbox" name="tntesp_superficie" id="tntesp_superficie" value="1" <?php if($tntesp_superficie){echo 'checked';}?>><label for="tntesp_superficie">Superficie</label>&nbsp;&nbsp;
		  		<input type="checkbox" name="tntesp_uretelasto" id="tntesp_uretelasto" value="1" <?php if($tntesp_uretelasto){echo 'checked';}?>><label for="tntesp_uretelasto">Uretano Elastom&eacute;rico</label>&nbsp;&nbsp;
		  		<input type="checkbox" name="tntesp_nitropolia" id="tntesp_nitropolia" value="1" <?php if($tntesp_nitropolia){echo 'checked';}?>><label for="tntesp_nitropolia">Nitropoliamida</label>&nbsp;&nbsp;
		  		<input type="checkbox" name="tntesp_vinilica" id="tntesp_vinilica" value="1" <?php if($tntesp_vinilica){echo 'checked';}?>><label for="tntesp_vinilica">Vin&iacute;lica</label>&nbsp;&nbsp;
				<input type="checkbox" name="tntesp_nitrocelu" id="tntesp_nitrocelu" value="1" <?php if($tntesp_nitrocelu){echo 'checked';}?>><label for="tntesp_nitrocelu">Nitrocelulosa</label>&nbsp;&nbsp;
	  			<input type="checkbox" name="tntesp_nitroure" id="tntesp_nitroure" value="1" <?php if($tntesp_nitroure){echo 'checked';}?>><label for="tntesp_nitroure">Nitro-Uretano</label>&nbsp;&nbsp;
  				<input type="checkbox" name="tntesp_poliamo" id="tntesp_poliamo" value="1" <?php if($tntesp_poliamo){echo 'checked';}?>><label for="tntesp_poliamo">Poliamoda</label>&nbsp;&nbsp;
  			</div>
  			</td>
  		</tr>
  		<tr>
  			<td colspan="4" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['other']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if ($campnomb["other"] == 1) { $tinta_espe = null; echo "*";}?>&nbsp;Otros Productos :</td>
  		</tr>
  		<tr>
  			<td colspan="4" class="NoiseDataTD"><div id="otros_productos">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  				<input type="checkbox" name="other_pmetali" id="other_pmetali" value="1" <?php if($other_pmetali){echo 'checked';}?>><label for="other_pmetali">Primer Metalizado</label>&nbsp;&nbsp;
		  		<input type="checkbox" name="other_lacacaliz" id="other_lacacaliz" value="1" <?php if($other_lacacaliz){echo 'checked';}?>><label for="other_lacacaliz">Laca Anti-Alcaliz</label>&nbsp;&nbsp;
		  		<input type="checkbox" name="other_bamiz1" id="other_bamiz1" value="1" <?php if($other_bamiz1){echo 'checked';}?>><label for="other_bamiz1">Bamiz Pigmentos me1</label>&nbsp;&nbsp;
		  		<input type="checkbox" name="other_lacatermo" id="other_lacatermo" value="1" <?php if($other_lacatermo){echo 'checked';}?>><label for="other_lacatermo">Laca Termosellable</label>&nbsp;&nbsp;
		  		<input type="checkbox" name="other_hotmelt" id="other_hotmelt" value="1" <?php if($other_hotmelt){echo 'checked';}?>><label for="other_hotmelt">Hot-Melt</label>&nbsp;&nbsp;
				<input type="checkbox" name="other_parafina" id="other_parafina" value="1" <?php if($other_parafina){echo 'checked';}?>><label for="other_parafina">Parafinas</label>&nbsp;&nbsp;
  				<input type="checkbox" name="other_lacaantiperoxido" id="other_lacaantiperoxido" value="1" <?php if($other_lacaantiperoxido){echo 'checked';}?>><label for="other_lacaantiperoxido">Laca Antiperoxido</label>&nbsp;&nbsp;
  			</div>
  			</td>
  		</tr>
  		<tr>
  			<td colspan="4" class="NoiseFooterTD">&nbsp;Observaciones Flexo</td>
  		</tr>
  		<tr>
  			<td colspan="4" class="NoiseDataTD ui-buttonset"><textarea name="note_flexo_desa" cols="120" rows="3"><?php echo $note_flexo_desa; ?></textarea></td>
  		</tr>
  		<tr>
  			<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['apli_tinta_mt2']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if ($campnomb["apli_tinta_mt2"] == 1) { $apli_tinta_mt2 = null; echo "*";}?>&nbsp;Aplicacion Tinta gr/mt2</td>
  			<td colspan="3" class="NoiseDataTD ui-buttonset">&nbsp;<input type="text" name="apli_tinta_mt2" id="apli_tinta_mt2" value="<?php echo $apli_tinta_mt2 ?>"/>&nbsp;<button id="ingr_apli_tinta">Ingresar</button></td>
  		</tr>
	</table>
	
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td colspan="2">
				<div id="filtrlistaestructura">
				<?php
				$noAjax = true;
				include '../src/FunjQuery/jquery.visors/jquery.tabla2.php';  
				?>
				</div>
			</td>
		</tr>
<!-- MATERIAL A IMPRIMIR / MATERIAL A LAMINAR -->		
		<?php 
			if($tipo_impresion == 'interna' || $tipo_impresion == 'externa'){
		?>
		<tr>
			<td width="20%" class="NoiseFooterTD"><?php if ($campnomb["product_imp"] == 1) { $tinta_espe = null; echo "*";}?>&nbsp;Material a imprimir</td>
			<td width="80%" class="NoiseDataTD">&nbsp;<select name="product_imp" id="product_imp">
			<option value="">--Seleccione--</option>
			<?php 
				include_once '../src/FunGen/floadpadreitem.php';
				floadpadreitem1($product_imp,$produccodigo,$idcon);
			?>
			</select>
			</td>
		</tr>
		<?php }

			if($tipo_estruc != 'monocapa'){

				for($h=0;$h<$valid_produc_imp;$h++){

					$obj_produclam = "product_lam_".($h +1);
		?>
		<tr>
			<td width="20%" class="NoiseFooterTD"><?php if ($campnomb[$obj_produclam] == 1) { $$obj_produclam = null; echo "*";}?>&nbsp;Material a laminar # <?php echo ($h +1 )?></td>
			<td width="80%" class="NoiseDataTD">&nbsp;<select name="<?php echo $obj_produclam ?>" id="<?php echo $obj_produclam ?>" onchange="validaProduc_lam(this.value,'<?php echo ($h +1 )?>');" >
			<option value="">--Seleccione--</option>
			<?php 
				include_once '../src/FunGen/floadpadreitem.php';
				floadpadreitem1($$obj_produclam,$produccodigo,$idcon);
			?>
			</select>
			</td>
		</tr>
		<?php
				} 
			}
		?>
	</table>
	
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
		<td colspan="4" class="ui-state-default">&nbsp;Medidas Bolsa Pouch Lateral</td>
		</tr>
		<tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;Ancho (mm)</td>
			<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="ancho" id="ancho" value="<?php echo $ancho ?>" /><?php echo ($ancho)? $ancho : '-------' ;?></td>
			<td width="20%" class="NoiseFooterTD">&nbsp;Tolerancia del ancho (mm)</td>
			<td width="30%" class="NoiseDataTD">
				<b>+</b>&nbsp;<input type="hidden" name="tole_ancho_ms" id="tole_ancho_ms" value="<?php echo $tole_ancho_ms ?>" /><?php echo ($tole_ancho_ms)? $tole_ancho_ms : '**' ;?>
				<b>-</b>&nbsp;<input type="hidden" name="tole_ancho_mn" id="tole_ancho_mn" value="<?php echo $tole_ancho_mn ?>" /><?php echo ($tole_ancho_mn)? $tole_ancho_mn : '**' ;?>
			</td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Largo (mm)</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="largo" id="largo" value="<?php echo $largo ?>" /><?php echo ($largo)? $largo : '-------' ;?></td>
			<td class="NoiseFooterTD">&nbsp;Tolerancia de largo (mm)</td>
			<td class="NoiseDataTD">
				<b>+</b>&nbsp;<input type="hidden" name="tole_largo_ms" id="tole_largo_ms" value="<?php echo $tole_largo_ms ?>" /><?php echo ($tole_largo_ms)? $tole_largo_ms : '**' ;?>
				<b>-</b>&nbsp;<input type="hidden" name="tole_largo_mn" id="tole_largo_mn" value="<?php echo $tole_largo_mn ?>" /><?php echo ($tole_largo_mn)? $tole_largo_mn : '**' ;?>
			</td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><span id="ncaras_imp_lb" style="display : <?php if($tipo_impresion != 'sin_impresion'){echo 'block';}else{'none';}?>">&nbsp;No. de caras impresas</span></td>
			<td class="NoiseDataTD" colspan="3"><span id="ncaras_imp_obj" style="display : <?php if($tipo_impresion != 'sin_impresion'){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="hidden" name="ncaras_imp" id="ncaras_imp" value="<?php echo $ncaras_imp ?>" /><?php echo ($ncaras_imp)? $ncaras_imp : '-------' ;?></span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Troquel</td>
			<td class="NoiseDataTD" colspan="3">&nbsp;<input type="hidden" name="troquel" id="troquel" value="<?php echo $troquel ?>" /><?php echo ($troquel)? strtoupper($troquel) : '-------' ;?></td>
		</tr>
	</table>
	
	<div style="display: <?php if($troquel == 'si'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td class="NoiseFooterTD" width="20%">&nbsp;Tipo de troquel</td>
				<td class="NoiseDataTD" width="80%">&nbsp;<input type="hidden" name="tipo_troquel" id="tipo_troquel" value="<?php echo $tipo_troquel ?>" /><?php echo ($tipo_troquel)? strtoupper($tipo_troquel) : '-------' ;?></td>
			</tr>
		</table>
	</div>
	
	
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
		<td colspan="4" class="ui-state-default">&nbsp;Especificaciones Bolsa Pouch Lateral</td>
		</tr>
		<tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;No. de sellos</td>
			<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="nro_sellos" id="nro_sellos" value="<?php echo $nro_sellos ?>" /><?php echo ($nro_sellos)? $nro_sellos : '-------' ;?></td>
		</tr>
		<tr>
	  		<td width="20%" class="NoiseFooterTD">&nbsp;Ancho de selle a las bolsas</td>
	  		<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="aselle_bolsa" id="aselle_bolsa" value="<?php echo $aselle_bolsa ?>" /><?php echo ($aselle_bolsa)? $aselle_bolsa : '-------' ;?></td>
	  		<td width="20%" class="NoiseFooterTD">&nbsp;Peso millar (Kg)</td>
			<td width="30%" class="NoiseDataTD">&nbsp;<span id="pesomillar"><?php echo round(((($solapa / 1000) + ($largo / 1000 * 2) + ($solapa / 1000 * 2) + ($fuelle / 1000 * 2)) * (($ancho / 1000) * $totalgramaje))*100) / 100 ?></span></td>
		</tr>
		<tr>
		<td colspan="4" class="ui-state-default">&nbsp;Accesorios Bolsa Pouch Lateral</td>
		</tr>
		<tr>
	 	  	<td class="NoiseFooterTD">&nbsp;V&aacute;lvula</td>
	 	  	<td class="NoiseDataTD" colspan="3">&nbsp;<input type="hidden" name="valve" id="valve" value="<?php echo $valve ?>" /><?php echo ($valve)? strtoupper($valve) : '-------' ;?></td>
	  	</tr>
		<tr> 
			<td class="NoiseFooterTD"><span style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Color Tapa V&aacute;lvula</span></td> 
			<td class="NoiseDataTD"><span id="ctapa_valveobj" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="hidden" name="ctapa_valve" id="ctapa_valve" value="<?php echo $ctapa_valve ?>" /><?php echo ($ctapa_valve)? strtoupper($ctapa_valve) : '-------' ;?></span></td>
	  		<td class="NoiseFooterTD"><span id="medi_valvelb" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Medida V&aacute;lvula (mm)</span></td>
	  		<td class="NoiseDataTD"><span id="medi_valveobj" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="hidden" name="medi_valve" id="medi_valve" value="<?php echo $medi_valve ?>" /><?php echo ($medi_valve)? strtoupper($medi_valve) : '-------' ;?></span></td>
	  	</tr>
	  	
		<tr> 
	  		<td class="NoiseFooterTD"><span id="ubic_valvelb" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Ubicaci&oacute;n V&aacute;lvula</span></td>
	  		<td class="NoiseDataTD"><span id="ubic_valveobj" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="hidden" name="ubic_valve" id="ubic_valve" value="<?php echo $ubic_valve ?>" /><?php echo ($ubic_valve)? strtoupper($ubic_valve) : '-------' ;?></span></td>
	  		<td class="NoiseFooterTD"><span id="tipo_valvelb" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Tipo de V&aacute;lvula</span></td>
	 	  	<td class="NoiseDataTD"><span id="tipo_valveobj" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="hidden" name="tipo_valve" id="tipo_valve" value="<?php echo $tipo_valve ?>" /><?php echo ($tipo_valve)? strtoupper($tipo_valve) : '-------' ;?></span></td>
	  	</tr>
		<tr>
			<td class="NoiseFooterTD"><span id="ziper_lb" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Ziper</span></td>
	  		<td class="NoiseDataTD"><span id="ziper_obj" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="hidden" name="ziper" id="ziper" value="<?php echo $ziper ?>" /><?php echo ($ziper)? strtoupper($ziper) : '-------' ;?></span></td>
	  		<td class="NoiseFooterTD"><span id="dist_ziper_lb" style="display : <?php if($ziper == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Dist. ziper al borde</span></td>
	 	  	<td class="NoiseDataTD"><span id="dist_ziper_obj" style="display : <?php if($ziper == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="hidden" name="dist_ziper" id="dist_ziper" value="<?php echo $dist_ziper ?>" /><?php echo ($dist_ziper)? $dist_ziper : '-------' ;?></span></td>
	  	</tr>
	  	<tr>
			<td class="NoiseFooterTD">&nbsp;Muesca</td>
	  		<td class="NoiseDataTD">&nbsp;<input type="hidden" name="muesca" id="muesca" value="<?php echo $muesca ?>" /><?php echo ($muesca)? strtoupper($muesca) : '-------' ;?></td>
	  		<td class="NoiseFooterTD"><span id="dist_muesca_lb" style="display : <?php if($muesca == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Dist. muesca al borde</span></td>
	 	  	<td class="NoiseDataTD"><span id="dist_muesca_obj" style="display : <?php if($muesca == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="hidden" name="dist_muesca" id="dist_muesca" value="<?php echo $dist_muesca ?>" /><?php echo ($dist_muesca)? $dist_muesca : '-------' ;?></span></td>
	  	</tr>
	  	<tr>
			<td class="NoiseFooterTD">&nbsp;Precorte</td>
	  		<td class="NoiseDataTD">&nbsp;<input type="hidden" name="precorte" id="precorte" value="<?php echo $precorte ?>" /><?php echo ($precorte)? strtoupper($precorte) : '-------' ;?></td>
	  		<td class="NoiseFooterTD"><span id="dist_precorte_lb" style="display : <?php if($precorte == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Dist. precorte al borde</span></td>
	 	  	<td class="NoiseDataTD"><span id="dist_precorte_obj" style="display : <?php if($precorte == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="hidden" name="dist_precorte" id="dist_precorte" value="<?php echo $dist_precorte ?>" /><?php echo ($dist_precorte)? $dist_precorte : '-------' ;?></span></td>
	  	</tr>
	</table>
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td class="NoiseFooterTD" width="20%">&nbsp;Llenado</td>
			<td class="NoiseDataTD" width="30%">&nbsp;<input type="hidden" name="tipo_llenado" id="tipo_llenado" value="<?php echo $tipo_llenado ?>" /><?php echo ($tipo_llenado)? strtoupper($tipo_llenado) : '-------' ;?></td>
			<td class="NoiseFooterTD" width="20%">&nbsp;C&oacute;digo de barras</td>
			<td class="NoiseDataTD" width="30%">&nbsp;<input type="hidden" name="cod_barras" id="cod_barras" value="<?php echo $cod_barras ?>" /><?php echo ($cod_barras)? $cod_barras : '-------' ;?></td>
		</tr>
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="4">&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD" colspan="4">&nbsp;<input type="hidden" name="note_product" id="note_product" value="<?php echo $note_product ?>" /><?php echo strtoupper($note_product)?></td></tr>
	</table>
	
	<?php if($tipevecodigo == 4): ?>
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
  			<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['nrorepet']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if ($campnomb["nrorepet"] == 1) { $tinta_espe = null; echo "*";}?>&nbsp;No. Repeticiones</td>
  			<td width="30%" class="NoiseDataTD">&nbsp;<input type="text" name="nrorepet" value="<?php echo $nrorepet ?>" /></td>
  			<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['rodillo']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if ($campnomb["rodillo"] == 1) { $tinta_espe = null; echo "*";}?>&nbsp;Rodillo</td>
  			<td width="30%" class="NoiseDataTD">&nbsp;<input type="text" name="rodillo" value="<?php echo $rodillo ?>" /></td>
  		</tr>
		<tr>
  			<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['nropistas']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if ($campnomb["nropistas"] == 1) { $tinta_espe = null; echo "*";}?>&nbsp;No. Pistas</td>
  			<td colspan="3" class="NoiseDataTD">&nbsp;<input type="text" name="nropistas" value="<?php echo $nropistas ?>" /></td>
  		</tr>
  		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="4"><?php if($campnomb["notedes_product"] == 1)echo "*"; ?>&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD" colspan="4"><textarea name="notedes_product" cols="126" rows="3"><?php echo $notedes_product; ?></textarea></tr>
  	</table>
  	<?php endif;?>
  	
</div>
<!-- FIN PESTAÑA ESPECIFICACIONES DEL PRODUCTO -->


<!-- PESTAÑA ESPECIFICACIONES DEL EMBALAJE -->
<div id="opt-tab4">
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
  			<td width="20%" class="NoiseFooterTD">&nbsp;Tipo de Empaque</td>
  			<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="tipo_empaque" value="<?php echo $tipo_empaque ?>" /><?php echo strtoupper($tipo_empaque) ?></td>
  			<td width="20%" class="NoiseFooterTD">&nbsp;Unidades por Empaque</td>
  			<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="uni_empaque" value="<?php echo $uni_empaque ?>" /><?php echo strtoupper($uni_empaque) ?></td>
  		</tr>
  		<tr>
  			<td width="20%" class="NoiseFooterTD">&nbsp;Unidades por Paquete</td>
  			<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="uni_paquete" value="<?php echo $uni_paquete ?>" /><?php echo strtoupper($uni_paquete) ?></td>
  			<td width="20%" class="NoiseFooterTD">&nbsp;Peso maximo empaque</td>
  			<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="peso_empaque" value="<?php echo $peso_empaque ?>" /><?php echo strtoupper($peso_empaque) ?></td>
  		</tr>
	</table>
</div>
<!-- FIN PESTAÑA ESPECIFICACIONES DEL EMBALAJE -->

<!-- PESTAÑA ESPECIFICACIONES DE MATERIAL EXTRUIDO -->
<div id="opt-tab5">
	<div id="esp_ext_seccion">
			<div id="filtrlistamatextruido">
				<?php
					$noAjax = true;
					$arrtabla1 = $arrtabla2;
					include '../src/FunjQuery/jquery.phpscripts/jquery.ajax_matextruido.des.php'; 
				?>
			</div>
	</div>
	<br>
</div>
<!-- FIN PESTAÑA ESPECIFICACIONES DE MATERIAL EXTRUIDO -->

<!-- PESTAÑA LAMINADO -->
<div id="opt-tab6">
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
  			<td width="20%" class="NoiseFooterTD">&nbsp;Desempe&ntilde;o</td>
  			<td width="30%" class="NoiseDataTD">
  				<select name="desempenio" id="desempenio">
		  			<option value="">--Seleccione--</option>
		  			<option value="alto" <?php if($desempenio == 'alto'){echo 'selected';}?>>Alto</option>
		  			<option value="medio" <?php if($desempenio == 'medio'){echo 'selected';}?>>Medio</option>
		  			<option value="bajo" <?php if($desempenio == 'bajo'){echo 'selected';}?>>Bajo</option>
		  			<option value="alifatico" <?php if($desempenio == 'alifatico'){echo 'selected';}?>>Alifatico</option>
  				</select>
  			</td>
  			<td width="20%" class="NoiseFooterTD">&nbsp;Tipo</td>
  			<td width="30%" class="NoiseDataTD">
  				<select name="tipo" id="tipo">
  					<option value="">--Seleccione--</option>
  					<option value="base_solvente" <?php if($tipo == 'base_solvente'){echo 'selected';}?>>Base-Solvente</option>
  					<option value="sin_solvente" <?php if($tipo == 'sin_solvente'){echo 'selected';}?>>Sin-Solvente</option>
  				</select>
  			</td>
  		</tr>
  		<tr>
  			<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['apli_adhe_mt2']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["apli_adhe_mt2"] == 1)echo "*"; ?>&nbsp;Aplicacion g/m2</td>
  			<td colspan="3" class="NoiseDataTD">&nbsp;<input type="text" name="apli_adhe_mt2" id="apli_adhe_mt2" value="<?php echo $apli_adhe_mt2 ?>" />&nbsp;<button id="ingr_apli_adhe">Ingresar</button>&nbsp;<button id="quitar_apli_adhe">Quitar</button></td>
  		</tr>
  		<tr>
			<td colspan="4">
				<div id="filtrlistaestructura2">
				<?php
				$noAjax = true;
				include '../src/FunjQuery/jquery.visors/jquery.tabla2.php';  
				?>
				</div>
			</td>
		</tr>
		<tr>
  			<td colspan="4" class="NoiseFooterTD">&nbsp;Observaciones Laminacion</td>
  		</tr>
  		<tr>
  			<td colspan="4" class="NoiseDataTD ui-buttonset"><textarea name="note_lam_desa" cols="120" rows="3"><?php echo $note_lam_desa; ?></textarea></td>
  		</tr>
	</table>
</div>

<!-- FIN PESTAÑA LAMINADO -->

<!-- PESTAÑA CONDICIONES DEPROCESO PARA EL DESARROLLO  -->
<div id="opt-tab7">
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['product_empa']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["product_empa"] == 1)echo "*"; ?>&nbsp;Producto a empacar</td>
			<td width="30%" class="NoiseDataTD"><input type="text" name="product_empa" id="product_empa" size="15" value="<?php echo $product_empa ?>" /></td>
			<td width="25%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['temp_empa']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["temp_empa"] == 1)echo "*"; ?>&nbsp;Temperatura de empacado (C)</td>
			<td width="25%" class="NoiseDataTD"><input type="text" name="temp_empa" id="temp_empa" size="15" value="<?php echo $temp_empa ?>" /></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['tipo_sellado']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["tipo_sellado"] == 1)echo "*"; ?>&nbsp;Tipo de sellado</td>
			<td class="NoiseDataTD"><select name="tipo_sellado" id="tipo_sellado">
				<option value="">-- Seleccione --</option>
				<option value="dorso_dorso"<?php if($tipo_sellado == 'dorso_dorso') echo ' selected' ?>>Dorso/Dorso</option>
				<option value="cara_dorso"<?php if($tipo_sellado == 'cara_dorso') echo ' selected' ?>>Cara/Dorso</option>
				<option value="NA"<?php if($tipo_sellado == 'NA') echo ' selected' ?>>N/A</option>
			</select></td>
			<td class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['vel_empa']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["vel_empa"] == 1)echo "*"; ?>&nbsp;Velocidad (Unid/min)</td>
			<td class="NoiseDataTD"><input type="text" name="vel_empa" id="vel_empa" size="15" value="<?php echo $vel_empa ?>" /></td>
		</tr>
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="4"><?php if($campnomb["note_proces"] == 1)echo "*"; ?>&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD" colspan="4"><textarea name="note_proces" cols="116" rows="3"><?php echo $note_proces; ?></textarea></tr>
	</table>
</div>
<!-- FIN PESTAÑA CONDICIONES DEPROCESO PARA EL DESARROLLO  -->