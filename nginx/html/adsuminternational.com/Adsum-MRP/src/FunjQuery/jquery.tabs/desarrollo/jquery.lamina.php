<?php ini_set('display_errors',1); ?>
<!-- PESTA�A 2 ESPECIFICACIONES DEL PRODUCTO -->
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
  			<td colspan="4" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['other']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if ($campnomb["other"] == 1) { $other = null; echo "*";}?>&nbsp;Otros Productos :</td>
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
		<td colspan="4" class="ui-state-default">&nbsp;Medidas Lamina</td>
		</tr>
		<tr>
			<td width="25%" class="NoiseFooterTD">&nbsp;Ancho (mm)</td>
			<td width="25%" class="NoiseDataTD">&nbsp;<input type="hidden" name="ancho" id="ancho" value="<?php echo $ancho ?>"/><?php echo ($ancho)? $ancho : '-------' ; ?></td>
			<td width="20%" class="NoiseFooterTD">&nbsp;Tolerancia del ancho (mm)</td>
			<td width="30%" class="NoiseDataTD">
				<b>+</b>&nbsp;<input type="hidden" name="tole_ancho_ms" id="tole_ancho_ms" value="<?php echo $tole_ancho_ms ?>" /><?php echo ($tole_ancho_ms)? $tole_ancho_ms : '**' ; ?>
				<b>-</b>&nbsp;<input type="hidden" name="tole_ancho_mn" id="tole_ancho_mn" value="<?php echo $tole_ancho_mn ?>" /><?php echo ($tole_ancho_ms)? $tole_ancho_mn : '**';  ?>
			</td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;Largo (mm)</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<input type="hidden" name="largo" id="largo" value="<?php echo $largo?>" /><?php echo ($largo)? $largo : '-------' ;?></span></td>
			<td class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;Tolerancia de largo (mm)</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">
				<b>+</b>&nbsp;<input type="hidden" name="tole_largo_ms" id="tole_largo_ms" value ="<?php echo $tole_largo_ms ?>" /><?php echo ($tole_largo_ms)? $tole_largo_ms : '**' ;?>
				<b>-</b>&nbsp;<input type="hidden" name="tole_largo_mn" id="tole_largo_mn" value ="<?php echo $tole_largo_mn ?>" /><?php echo ($tole_largo_mn)? $tole_largo_mn : '**' ;?>
			</span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;Ancho fotocelda (mm)</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<input type="hidden" name="ancho_fotoc" id="ancho_fotoc" value ="<?php echo $ancho_fotoc ?>" /><?php echo ($ancho_fotoc)? $ancho_fotoc : '-------' ; ?></span></td>
			<td class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;Largo fotocelda (mm)</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<input type="hidden" name="largo_fotoc" id="largo_fotoc" value ="<?php echo $largo_fotoc ?>" /><?php echo ($largo_fotoc)? $largo_fotoc : '-------' ;?></span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;Distancia fotocelda al borde (mm)</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<input type="hidden" name="dfotoc_borde" id="dfotoc_borde" value ="<?php echo $dfotoc_borde ?>" /><?php echo ($dfotoc_borde)? $dfotoc_borde : '-------' ;?></span></td>
			<td class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;Color fotocelda</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<input type="hidden" name="color_fotoc" id="color_fotoc" value ="<?php echo $color_fotoc ?>" /><?php echo ($color_fotoc)? strtoupper($color_fotoc) : '-------' ;?></span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;Tipo de embobinado</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<input type="hidden" name="tipo_emb" id="tipo_emb" value ="<?php echo $tipo_emb ?>" /><?php echo ($tipo_emb)? strtoupper($tipo_emb) : '-------' ;?></span></td>
			<td class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;Con respecto</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<input type="hidden" name="con_resp" id="con_resp"  value ="<?php echo $con_resp ?>" /><?php echo ($con_resp)? strtoupper($con_resp) : '-------' ;?></span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;C&oacute;digo de barras</span></td>
			<td class="NoiseDataTD" colspan="3"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<input type="hidden" name="cod_barras" id="cod_barras" value ="<?php echo $cod_barras ?>" /><?php echo ($cod_barras)? $cod_barras : '-------' ;?></span></td>
		</tr>
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="4">&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD" colspan="4">&nbsp;<input type="hidden" name="note_product" id="note_product" value ="<?php echo $note_product ?>" /><?php echo strtoupper($note_product) ?>
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
  	</table>
  	<?php endif;?>
  	
</div>
<!-- FIN PESTA�A ESPECIFICACIONES DEL PRODUCTO -->


<!-- PESTA�A ESPECIFICACIONES DEL EMBALAJE -->
<div id="opt-tab4">
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
			<td width="23%" class="NoiseFooterTD">&nbsp;Tama&ntilde;o del core (mm)</td>
			<td width="27%" class="NoiseDataTD">&nbsp;<input type="hidden" name="tam_core" id="tam_core" value="<?php echo $tam_core ?>" /><?php echo ($tam_core)? $tam_core : '-------' ;?></td>
			<td width="23%" class="NoiseFooterTD">&nbsp;Metros del rollo</td>
			<td width="27%" class="NoiseDataTD">&nbsp;<input type="hidden" name="mrollo" id="mrollo" value="<?php echo $mrollo?>" /><?php echo ($mrollo)? $mrollo : '-------' ;?>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Peso del rollo (Kg)</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="prollo" id="prollo" value="<?php echo $prollo ?>" /><?php echo ($prollo)? $prollo : '-------' ;?></td>
			<td class="NoiseFooterTD">&nbsp;Tolerancia del peso (Kg)</td>
			<td class="NoiseDataTD">
				<b>+</b>&nbsp;<input type="hidden" name="tole_prollo_ms" id="tole_prollo_ms" value="<?php echo $tole_prollo_ms ?>" /><?php echo ($tole_prollo_ms)? $tole_prollo_ms : '**' ;?>
				<b>-</b>&nbsp;<input type="hidden" name="tole_prollo_mn" id="tole_prollo_mn" value="<?php echo $tole_prollo_mn ?>" /><?php echo ($tole_prollo_mn)? $tole_prollo_mn : '**' ; ?>
			</td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Diametro del rollo (mm)</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="drollo" id="drollo" value="<?php echo $drollo ?>" /><?php echo ($drollo)? $drollo : '-------' ;?></td>
			<td class="NoiseFooterTD">&nbsp;Tolerancia del diametro (mm)</td>
			<td class="NoiseDataTD">
				<b>+</b>&nbsp;<input type="hidden" name="tole_drollo_ms" id="tole_drollo_ms" value="<?php echo $tole_drollo_ms?>" /><?php echo ($tole_drollo_ms)? $tole_drollo_ms : '**' ; ?>
				<b>-</b>&nbsp;<input type="hidden" name="tole_drollo_mn" id="tole_drollo_mn" value="<?php echo $tole_drollo_mn?>" /><?php echo ($tole_drollo_mn)? $tole_drollo_mn : '**' ; ?>
			</td>
		</tr>
			<tr>
			<td class="NoiseFooterTD">&nbsp;No. max empalmes</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name=nmax_empal id="nmax_empal" value="<?php echo $nmax_empal ?>" /><?php echo ($nmax_empal)? $nmax_empal : '-------' ; ?></td>
			<td class="NoiseFooterTD">&nbsp;Ancho de empalme</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="ancho_empal" id="ancho_empal" value="<?php echo $ancho_empal ?>" /><?php echo ($ancho_empal)? $ancho_empal : '-------' ; ?></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Color Empalme Cara</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="cempal_cara" id="cempal_cara" value="<?php echo $cempal_cara ?>" /><?php echo ($cempal_cara)? strtoupper($cempal_cara) : '-------' ; ?></td>
			<td class="NoiseFooterTD">&nbsp;Color Empalme Dorso</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="cempal_dorso" id="cempal_dorso" value="<?php echo $cempal_dorso?>" /><?php echo ($cempal_dorso)? strtoupper($cempal_dorso) : '-------' ; ?></td>
		</tr>
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="4">&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD" colspan="4">&nbsp;<input type="hidden" name="note_embalaje" id="note_embalaje" value="<?php echo $note_embalaje ?>" /><?php echo strtoupper($note_embalaje) ?></td>
	</table>
</div>
<!-- FIN PESTA�A ESPECIFICACIONES DEL EMBALAJE -->

<!-- PESTA�A ESPECIFICACIONES DE MATERIAL EXTRUIDO -->
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
<!-- FIN PESTA�A ESPECIFICACIONES DE MATERIAL EXTRUIDO -->

<!-- PESTA�A LAMINADO -->
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
  			<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['apli_tinta_mt2']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if($campnomb["apli_adhe_mt2"] == 1)echo "*"; ?>&nbsp;Aplicacion g/m2</td>
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

<!-- FIN PESTA�A LAMINADO -->

<!-- PESTA�A CONDICIONES DEPROCESO PARA EL DESARROLLO  -->
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
<!-- FIN PESTA�A CONDICIONES DEPROCESO PARA EL DESARROLLO  -->

<!-- PESTA�A FORMA EMPAQUE -->
<div id="opt-tab4a">
	<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;Forma de empaque</td>
			<td width="80%" class="NoiseDataTD">&nbsp;<input type="hidden" name="form_empa" id="form_empa" value="<?php echo $form_empa ?>" /><?php echo ($largo)? strtoupper($form_empa) : '-------'; ?></td>
		<tr>
	</table>
	
	<div id="seccion_formempa_suspendido" style="display: <?php if($form_empa == 'suspendido'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;Niveles por estiba</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="niv_estiba" id="niv_estiba" value="<?php echo $niv_estiba ?>" /><?php echo ($niv_estiba)? $niv_estiba : '-------' ; ?></td>
				<td width="20%" class="NoiseFooterTD">&nbsp;Peso por estiba (Kg)</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="peso_estiba" id="peso_estiba" value="<?php echo $peso_estiba ?>" /><?php echo ($peso_estiba)? $peso_estiba : '-------'; ?></td>
			<tr>
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;Bolsa pl&aacute;stica</td>
				<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="bolsa_plastica" id="bolsa_plastica" value="<?php echo $bolsa_plastica ?>" /><?php echo ($bolsa_plastica)? strtoupper($bolsa_plastica) : '-------'; ?></td>
			</tr>
		</table>
	</div>
	
	<div id="seccion_formempa_caja" style="display: <?php if($form_empa == 'caja'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;Protector core</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="pro_core" id="pro_core" value="<?php echo $pro_core ?>" /><?php echo ($pro_core)? strtoupper($pro_core) : '-------' ;?></td>
				<td width="20%" class="NoiseFooterTD">&nbsp;Bolsa pl&aacute;stica</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="bolsa_plastica" id="bolsa_plastica" value="<?php echo $bolsa_plastica ?>" /><?php echo ($bolsa_plastica)? strtoupper($bolsa_plastica) : '-------' ;?></td>
			<tr>
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;Peso Maximo por caja (kg)</td>
				<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="peso_max" id="peso_max" value="<?php echo $peso_max ?>" /><?php echo ($peso_max)? $peso_max : '-------' ;?></td>
			</tr>
		</table>
	</div>
	
	<div id="seccion_formempa_bolsa_plastica" style="display: <?php if($form_empa == 'bolsa_plastica'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;Protector core</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="pro_core" id="pro_core" value="<?php echo $pro_core ?>" /><?php echo ($pro_core)? strtoupper($pro_core) : '-------' ;?></td>
				<td width="20%" class="NoiseFooterTD">&nbsp;Peso Maximo por bolsa (kg)</td>
				<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="peso_max" id="peso_max" value="<?php echo $peso_max ?>" /><?php echo ($peso_max)? $peso_max : '-------' ;?></td>
			</tr>
		</table>
	</div>
	
	<div id="seccion_formempa_carton_extremos" style="display: <?php if($form_empa == 'carton_extremos'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;Protector core</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="pro_core" id="pro_core" value="<?php echo $pro_core ?>" /><?php echo ($pro_core)? strtoupper($pro_core) : '-------' ;?></td>
				<td width="20%" class="NoiseFooterTD">&nbsp;Bolsa pl&aacute;stica</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="bolsa_plastica" id="bolsa_plastica" value="<?php echo $bolsa_plastica ?>" /><?php echo ($bolsa_plastica)? strtoupper($bolsa_plastica) : '-------' ;?></td>
			<tr>
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;No. Rollos</td>
				<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="no_rollos" id="no_rollos" value="<?php echo $no_rollos ?>" /><?php echo ($no_rollos)? $no_rollos : '-------' ;?></td>
			</tr>
		</table>
	</div>
	
	<div id="seccion_formempa_cubierto_extremos" style="display: <?php if($form_empa == 'cubierto_extremos'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;Protector core</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="pro_core" id="" value="<?php echo $pro_core ?>" /><?php echo ($pro_core)? strtoupper($pro_core) : '-------' ;?></td>
				<td width="20%" class="NoiseFooterTD">&nbsp;Bolsa pl&aacute;stica</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="bolsa_plastica" id="bolsa_plastica" value="<?php echo $bolsa_plastica ?>" /><?php echo ($bolsa_plastica)? strtoupper($bolsa_plastica) : '-------' ;?>
			<tr>
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;No. Rollos</td>
				<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="no_rollos" id="no_rollos" value="<?php echo $no_rollos?>" /><?php echo ($no_rollos)? $no_rollos : '-------' ; ?></td>
			</tr>
		</table>
	</div>
	
	<br/>
	<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;Material estibado</td>
			<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="estibado" id="estibado" value="<?php echo $estibado ?>" /><?php echo ($estibado)? strtoupper($estibado) : '-------' ;?></td>
			<td width="20%" class="NoiseDataTD">&nbsp;</td>
			<td width="30%"class="NoiseDataTD">&nbsp;</td>
		</tr>
	</table>
	<div id="session_estibado" style="display: <?php if($arrCampertippro['estibado'] == 'si'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;Tama&ntilde;o de estiba</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="tam_estiba" id="tam_estiba" value="<?php echo $tam_estiba ?>" /><?php echo ($tam_estiba)? strtoupper($tam_estiba) : '-------' ;?></td>
				<td width="20%" class="NoiseFooterTD">&nbsp;Tipo de estiba</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="tipo_estiba" id="tipo_estiba" value="<?php echo $tipo_estiba ?>" /><?php echo ($tipo_estiba)? strtoupper($tipo_estiba) : '-------' ;?>
			</tr>
			<tr><td class="ui-state-default" colspan="4"></td></tr>
			<tr>
				<td class="NoiseFooterTD">&nbsp;Altura m&aacute;xima pallet (mm)</td>
				<td class="NoiseDataTD">&nbsp;<input type="hidden" name="alt_pallet" id="alt_pallet" value="<?php echo $alt_pallet ?>" /><?php echo ($alt_pallet)? $alt_pallet : '-------' ;?></td>
				<td class="NoiseFooterTD">&nbsp;Peso por pallet (Kg)</td>
				<td class="NoiseDataTD">&nbsp;<input type="hidden" name="peso_pallet" id="peso_pallet" value="<?php echo $peso_pallet?>" /><?php echo ($peso_pallet)? $peso_pallet : '-------' ;?></td>
			</tr>
			<tr>
				<td class="NoiseFooterTD">&nbsp;Estresado</td>
				<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="estresado" id="estresado" value="<?php echo $estresado ?>" /><?php echo ($estresado)? strtoupper($estresado) : '-------' ;?></td>
			</tr>
		</table>
	</div>
	<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr><td class="ui-state-default"></td></tr>
		<tr><td class="NoiseFooterTD">&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD"><input type="hidden" name="note_formaempaque" id="note_formaempaque" value="<?php echo $note_formaempaque ?>" /><?php echo strtoupper($note_formaempaque) ?></td>
	</table>
</div>
<!-- FIN PESTA�A FORMA EMPAQUE -->