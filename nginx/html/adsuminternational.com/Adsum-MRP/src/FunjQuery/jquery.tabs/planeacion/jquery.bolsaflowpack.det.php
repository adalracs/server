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
  			<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="tipo_impresion" value="<?php echo $tipo_impresion ?>"/><?php echo strtoupper($tipo_impresion) ?> </td>
  		</tr>
	</table>
	
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
		<td colspan="4" class="ui-state-default">&nbsp;Medidas Bolsa Flow Pack</td>
		</tr>
		<tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;Ancho (mm)</td>
			<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="ancho" id="ancho" value="<?php echo $ancho ?>" /><?php echo ($ancho) ? $ancho : '-------' ; ?></td>
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
				<b>+</b>&nbsp;<input type="hidden" name="tole_largo_ms" id="tole_largo_ms" value="<?php echo $tole_largo_ms ?>" /><?php echo ($tole_largo_ms)? $tole_largo_ms : '**' ; ?>
				<b>-</b>&nbsp;<input type="hidden" name="tole_largo_mn" id="tole_largo_mn" value="<?php echo $tole_largo_mn ?>" /><?php echo ($tole_largo_mn)? $tole_largo_mn : '**' ; ?>
			</td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Fuelle (mm)</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="fuelle" id="fuelle" value="<?php echo $fuelle ?>" /><?php echo ($fuelle)? $fuelle : '-------' ;?></td>
			<td class="NoiseFooterTD">&nbsp;Tolerancia de fuelle (mm)</td>
			<td class="NoiseDataTD">
				<b>+</b>&nbsp;<input type="hidden" name="tole_fuelle_ms" id="tole_fuelle_ms" value="<?php echo $tole_fuelle_ms ?>" /><?php echo ($tole_fuelle_ms)? $tole_fuelle_ms : '/' ;?>
				<b>-</b>&nbsp;<input type="hidden" name="tole_fuelle_mn" id="tole_fuelle_mn" value="<?php echo $tole_fuelle_mn ?>" /><?php echo ($tole_fuelle_mn)? $tole_fuelle_mn : '/' ;?>
			</td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Traslape (mm)</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="traslape" id="traslape" value="<?php echo $traslape ?>" /><?php echo ($traslape)? $traslape : '-------' ;?></td>
			<td class="NoiseFooterTD">&nbsp;Tolerancia traslape (mm)</td>
			<td class="NoiseDataTD">
				<b>+</b>&nbsp;<input type="hidden" name="tole_traslape_ms" id="tole_traslape_ms" value="<?php echo $tole_traslape_ms ?>" /><?php echo ($tole_traslape_ms)? $tole_traslape_ms : '/'; ?>
				<b>-</b>&nbsp;<input type="hidden" name="tole_traslape_mn" id="tole_traslape_mn" value="<?php echo $tole_traslape_mn ?>" /><?php echo ($tole_traslape_mn)? $tole_traslape_mn : '/' ;?>
			</td> 
		</tr>
		<tr>
			<td class="NoiseFooterTD"><span style="display : <?php if($traslape > 0){echo 'block';}else{echo 'none';}?>">&nbsp;Tipo Traslape </span></td>
			<td class="NoiseDataTD" colspan="3"><span style="display : <?php if($traslape > 0){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="hidden" name="tipo_traslape" id="tipo_traslape" value="<?php echo $tipo_traslape ?>" /><?php echo ($tipo_traslape)? strtoupper($tipo_traslape) : '-------' ;?></span></td>
		</tr>
		<tr>
		<td colspan="4" class="ui-state-default">&nbsp;Accesorios de Bolsa Flow Pack</td>
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
				<td class="NoiseDataTD" width="80%">&nbsp;<input type="hidden" name="tipo_troquel" id="tipo_troquel" value="<?php echo $tipo_troquel ?>" /><?php echo ($tipo_troquel)? strtoupper($tipo_troquel) : '-------' ; ?></td>
			</tr>
		</table>
	</div>
	
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
	 	  	<td width="20%" class="NoiseFooterTD">&nbsp;V&aacute;lvula</td>
	 	  	<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="valve" id="valve" value="<?php echo $valve ?>" /><?php echo ($valve)? strtoupper($valve) : '-------' ;?></td>
	 	  	<td width="24%" class="NoiseFooterTD">&nbsp;Ancho de selle a las bolsas (mm)</td>
	  		<td width="26%" class="NoiseDataTD">&nbsp;<input type="hidden" name="aselle_bolsa" id="aselle_bolsa" value="<?php echo $aselle_bolsa ?>" /><?php echo ($aselle_bolsa)? $aselle_bolsa : '-------' ;?></td>
	  	</tr>
		<tr> 
			<td class="NoiseFooterTD"><span style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Color Tapa V&aacute;lvula</span></td> 
			<td class="NoiseDataTD"><span id="ctapa_valveobj" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="hidden" name="ctapa_valve" id="ctapa_valve" value="<?php echo $ctapa_valve ?>" /><?php echo ($ctapa_valve)? $ctapa_valve : '-------' ;?></span></td>
	  		<td class="NoiseFooterTD"><span id="medi_valvelb" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Medida V&aacute;lvula (mm)</span></td>
	  		<td class="NoiseDataTD"><span id="medi_valveobj" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="hidden" name="medi_valve" id="medi_valve" value="<?php echo $medi_valve ?>" /><?php echo ($medi_valve)? strtoupper($medi_valve) : '-------' ;?></span></td>
	  	</tr>
	  	
		<tr> 
	  		<td class="NoiseFooterTD"><span id="ubic_valvelb" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Ubicaci&oacute;n V&aacute;lvula</span></td>
	  		<td class="NoiseDataTD"><span id="ubic_valveobj" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="hidden" name="ubic_valve" id="ubic_valve" value="<?php echo $ubic_valve ?>" /><?php echo ($ubic_valve)? strtoupper($ubic_valve) : '-------' ;?></span></td>
	  		<td class="NoiseFooterTD"><span id="tipo_valvelb" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Tipo de V&aacute;lvula</span></td>
	 	  	<td class="NoiseDataTD"><span id="tipo_valveobj" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="hidden" name="tipo_valve" id="tipo_valve" value="<?php echo $tipo_valve ?>" /><?php echo ($tipo_valve)? strtoupper($tipo_valve) : '-------' ;?></span></td>
	  	</tr>
	</table>
	
		<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td class="NoiseFooterTD" width="20%">&nbsp;Peso millar (Kg)</td>
			<td class="NoiseDataTD">&nbsp;<span id="pesomillar"><?php echo (round(((($largo / 1000 * 2) + ($traslape / 1000 * 2) + ($fuelle / 1000 * 2)) * ( ( ($ancho / 1000) * 2 )  * $totalgramaje))*100) / 100) / 2 ?></span></td>
			<td class="NoiseFooterTD" width="20%">&nbsp;Llenado</td>
			<td class="NoiseDataTD" width="30%">&nbsp;<input type="hidden" name="tipo_llenado" id="tipo_llenado" value="<?php echo $tipo_llenado ?>" /><?php echo ($tipo_llenado)? strtoupper($tipo_llenado) : '-------' ;?></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;C&oacute;digo de barras</span></td>
			<td class="NoiseDataTD" colspan="3"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<input type="hidden" name="cod_barras" id="cod_barras" value="<?php echo $cod_barras ?>" /><?php echo ($cod_barras)? $cod_barras : '-------' ;?></span></td>
		</tr>
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="4">&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD" colspan="4">&nbsp;<input type="hidden" name="note_product" id="note_product" value="<?php echo $note_product ?>" /><?php echo ($note_product)? strtoupper($note_product) : '-------' ;?></td></tr>
	</table>
		<br>
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
	<?php if($tipo_impresion != 'sin_impresion'){?>
		<tr>
  			<td width="20%" class="NoiseFooterTD">&nbsp;Continuo</td>
  			<td width="80%" class="NoiseDataTD">&nbsp;<input type="hidden" name="continuo" id="continuo" value="<?php echo $continuo ?>"/><?php echo ($continuo)? strtoupper($continuo) : '---' ; ?></td>
  		</tr>
		<tr>
  			<td width="20%" class="NoiseFooterTD"><span id="nrorepet_lb" style="display : <?php if($continuo == 'si'){echo 'none';}else{'block';}?>">&nbsp;No. Repeticiones</span></td>
  			<td width="80%" class="NoiseDataTD"><span id="nrorepet_obj" style="display : <?php if($continuo == 'si'){echo 'none';}else{'block';}?>">&nbsp;<input type="hidden" name="nrorepet" id="nrorepet" value="<?php echo $nrorepet ?>"/><?php echo ($nrorepet)? $nrorepet : '---' ; ?> </span></td>
  		</tr>
  		<tr>
  			<td width="20%" class="NoiseFooterTD">&nbsp;Rodillo</td>
  			<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="rodillo" id="rodillo" value="<?php echo $rodillo ?>"/><?php echo ($rodillo)? $rodillo : '---' ; ?></td>
  		</tr>
  		<?php }?>
		<tr>
  			<td width="20%" class="NoiseFooterTD">&nbsp;No. Pistas</td>
  			<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="nropistas" id="nropistas" value="<?php echo $nropistas ?>"/><?php echo ($nropistas)? $nropistas : '---' ; ?></td>
  		</tr>
  	</table>
  	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="4">&nbsp;Observaciones </td></tr>
		<tr><td class="NoiseDataTD" colspan="4">&nbsp;<?php echo $nota_solicitud; ?></tr>
	</table>
</div>
<!-- FIN PESTA�A ESPECIFICACIONES DEL PRODUCTO -->

<!-- PESTA�A EXPLOCION DE MATERIA PRIMA -->
<div id="opt-tab5">

	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td colspan="4" class="ui-state-default">&nbsp;Estructura</td>
		</tr>
		<tr>
			<td colspan="4" >
				<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
					<?php if($tipo_impresion == 'interna' || $tipo_impresion == 'externa'){$idcon = fncconn();?>
					<tr>
						<td width="20%" class="NoiseFooterTD">&nbsp;Material a imprimir</td>
						<td width="80%" class="NoiseDataTD">&nbsp;<?php if($product_imp) $rwPad = loadrecordpadreitem($product_imp,$idcon); echo ($rwPad['paditenombre'])? strtoupper($rwPad['paditenombre']) : '-------' ;?></td>
					</tr>
						<?php if($tipo_estruc != 'monocapa'){?>
							<?php for($h=0;$h<$valid_produc_imp;$h++){
							$obj_produclam = "product_lam_".($h +1);
						?>
					<tr>
						<td width="20%" class="NoiseFooterTD">&nbsp;Material a laminar # <?php echo ($h +1 )?></td>
						<td width="80%" class="NoiseDataTD">&nbsp;<?php if($$obj_produclam){ $rwPad = loadrecordpadreitem($$obj_produclam,$idcon); echo ($rwPad['paditenombre'])? strtoupper($rwPad['paditenombre']) : '-------' ;unset($rwPad);?><input type="hidden" name="<?php echo $obj_produclam ?>" id="<?php echo $obj_produclam ?>" value="<?php echo $$obj_produclam ?>" /><?php }?></td>
					</tr>
							<?php }?>
						<?php }?>
					<?php }?>
				</table>
			</td>
		</tr>
  		<tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;Cant. Planeada (<?php echo $unimedi ?>)</td>
			<td width="30%" class="NoiseDataTD"><input type="hidden" name="cant_planea" id="cant_planea" value="<?php echo $cant_planea ?>"/><?php echo ($cant_planea)? $cant_planea : '---' ; ?></td>
			<td width="20%" class="NoiseFooterTD">&nbsp;Criterio </td>
			<td width="30%" class="NoiseDataTD"><input type="hidden" name="criterio_val" id="criterio_val" value="<?php echo $criterio_val ?>" /><select name="criterio" id="criterio"  onchange="cargaCriterio(this.value);" disabled>
			<option value="">--Seleccione--</option>
			<?php 
				$idcon = fncconn();
				floadcriterio($criterio,$idcon);
			?>
			</select></td>
		</tr>
	</table>
	
	<div id="filtrlistaplaneacion">
		<?php
			$noAjax = true;
			include '../src/FunjQuery/jquery.phpscripts/jquery.ajax_planeacion.php';  
		?>
	</div>		
	<br>
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td colspan="2" class="ui-state-default">&nbsp;Asignar Materia prima.</td>
		</tr>
		<tr>
			<td colspan="2">
				<div id="listamateriales">
					<?php
						$noAjax = true;
						$flagdetallar = 1;
						include '../src/FunjQuery/jquery.visors/jquery.mat_planeacion.php';  
					?>
				</div>
			</td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="4">&nbsp;Observaciones materiales</td></tr>
		<tr><td class="NoiseDataTD" colspan="4">&nbsp;<?php echo $nota_materiales; ?></tr>
	</table>
</div>
<!-- FIN PESTA�A EXPLOCION DE MATERIA PRIMA -->

<!-- PESTA�A RUTAS -->
<div id="opt-tab4">
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
	  		<tr>
	  			<td width="100%" valign="top">
		  			<table width="100%" border="0" cellspacing="1" cellpadding="0" align="left" class="ui-widget-content"> 	
						<tr>
		  					<td colspan="2" class="NoiseFooterTD">&nbsp;Ruta Item Estandar</td>
		  				</tr>
						<tr>
		  					<td colspan="2" class="NoiseDataTD">
		  						<div id="filtrrutaitem_est"><?php $noAjax = true;$flagdetallar = 1;include '../src/FunjQuery/jquery.visors/jquery.rutaitem_est.php'; ?></div>
								<input type="hidden" name="rutaitem_est" id="rutaitem_est" value="<?php echo $rutaitem_est; ?>">
		  					</td>
		  				</tr>
					</table>
	  			</td>
		  	</tr>
	</table>
	<br>
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td colspan="2" class="NoiseFooterTD">&nbsp;Ruta Item Estandar</td>
		</tr>
		<tr>
		  	<td colspan="2" class="NoiseDataTD">
		  		<div id="filtrrutaitem"><?php $noAjax = true;$flagdetallar = 1;include '../src/FunjQuery/jquery.visors/jquery.rutaitem.php'; ?></div>
		  		<input type="hidden" name="arrrutaitem" id="arrrutaitem" value="<?php echo $arrrutaitem; ?>">
				<input type="hidden" name="arrrutaitemtmp" id="arrrutaitemtmp" value="<?php echo $arrrutaitemtmp; ?>">
		  	</td>
		</tr>
	</table>
</div>
<!-- FIN PESTA�A RUTAS -->

<!-- PESTA�A CONDICIONES DEPROCESO PARA EL DESARROLLO  -->
<div id="opt-tab7">
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;Producto a empacar</td>
			<td width="30%" class="NoiseDataTD"><input type="hidden" name="product_empa" id="product_empa" value="<?php echo $product_empa ?>" /><?php echo ($product_empa)? strtoupper($product_empa) : '-------' ;?></td>
			<td width="25%" class="NoiseFooterTD">&nbsp;Temperatura de empacado (C)</td>
			<td width="25%" class="NoiseDataTD"><input type="hidden" name="temp_empa" id="temp_empa" value="<?php echo $temp_empa ?>" /><?php echo ($temp_empa)? strtoupper($temp_empa) : '-------' ;?></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Tipo de sellado</td>
			<td class="NoiseDataTD"><input type="hidden" name="tipo_sellado" id="tipo_sellado" value="<?php echo $tipo_sellado ?>" /><?php echo ($tipo_sellado)? strtoupper($tipo_sellado) : '-------' ;?></td>
			<td class="NoiseFooterTD">&nbsp;Velocidad (Unid/min)</td>
			<td class="NoiseDataTD"><input type="hidden" name="vel_empa" id="vel_empa" value="<?php echo $vel_empa ?>" /><?php echo ($vel_empa)? strtoupper($vel_empa) : '-------' ;?></td>
		</tr>
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="4">&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD" colspan="4"><input type="hidden" name="note_proces" id="note_proces" value="<?php echo $note_proces?>" /><?php echo strtoupper($note_proces) ?></td>
	</table>
</div>
<!-- FIN PESTA�A CONDICIONES DEPROCESO PARA EL DESARROLLO  -->