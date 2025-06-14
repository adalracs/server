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
		<td colspan="4" class="ui-state-default">&nbsp;Medidas Bolsa Pouch Lateral</td>
		</tr>
		<tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;Ancho (mm)</td>
			<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="ancho" id="ancho" value="<?php echo $ancho ?>" /><?php echo ($ancho)? $ancho : '---' ;?></td>
			<td width="20%" class="NoiseFooterTD">&nbsp;Tolerancia del ancho (mm)</td>
			<td width="30%" class="NoiseDataTD">
				<b>+</b>&nbsp;<input type="hidden" name="tole_ancho_ms" id="tole_ancho_ms" value="<?php echo $tole_ancho_ms ?>" /><?php echo ($tole_ancho_ms)? $tole_ancho_ms : '**' ;?>
				<b>-</b>&nbsp;<input type="hidden" name="tole_ancho_mn" id="tole_ancho_mn" value="<?php echo $tole_ancho_mn ?>" /><?php echo ($tole_ancho_mn)? $tole_ancho_mn : '**' ;?>
			</td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Largo (mm)</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="largo" id="largo" value="<?php echo $largo ?>" /><?php echo ($largo)? $largo : '---' ;?></td>
			<td class="NoiseFooterTD">&nbsp;Tolerancia de largo (mm)</td>
			<td class="NoiseDataTD">
				<b>+</b>&nbsp;<input type="hidden" name="tole_largo_ms" id="tole_largo_ms" value="<?php echo $tole_largo_ms ?>" /><?php echo ($tole_largo_ms)? $tole_largo_ms : '**' ;?>
				<b>-</b>&nbsp;<input type="hidden" name="tole_largo_mn" id="tole_largo_mn" value="<?php echo $tole_largo_mn ?>" /><?php echo ($tole_largo_mn)? $tole_largo_mn : '**' ;?>
			</td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><span id="ncaras_imp_lb" style="display : <?php if($tipo_impresion != 'sin_impresion'){echo 'block';}else{'none';}?>">&nbsp;No. de caras impresas</span></td>
			<td class="NoiseDataTD" colspan="3"><span id="ncaras_imp_obj" style="display : <?php if($tipo_impresion != 'sin_impresion'){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="hidden" name="ncaras_imp" id="ncaras_imp" value="<?php echo $ncaras_imp ?>" /><?php echo ($ncaras_imp)? $ncaras_imp : '---' ;?></span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Troquel</td>
			<td class="NoiseDataTD" colspan="3">&nbsp;<input type="hidden" name="troquel" id="troquel" value="<?php echo $troquel ?>" /><?php echo ($troquel)? strtoupper($troquel) : '---' ;?></td>
		</tr>
	</table>
	
	<div style="display: <?php if($troquel == 'si'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td class="NoiseFooterTD" width="20%">&nbsp;Tipo de troquel</td>
				<td class="NoiseDataTD" width="80%">&nbsp;<input type="hidden" name="tipo_troquel" id="tipo_troquel" value="<?php echo $tipo_troquel ?>" /><?php echo ($tipo_troquel)? strtoupper($tipo_troquel) : '---' ;?></td>
			</tr>
		</table>
	</div>
	
	
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
		<td colspan="4" class="ui-state-default">&nbsp;Especificaciones Bolsa Pouch Lateral</td>
		</tr>
		<tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;No. de sellos</td>
			<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="nro_sellos" id="nro_sellos" value="<?php echo $nro_sellos ?>" /><?php echo ($nro_sellos)? $nro_sellos : '---' ;?></td>
		</tr>
		<tr>
	  		<td width="20%" class="NoiseFooterTD">&nbsp;Ancho de selle a las bolsas</td>
	  		<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="aselle_bolsa" id="aselle_bolsa" value="<?php echo $aselle_bolsa ?>" /><?php echo ($aselle_bolsa)? $aselle_bolsa : '---' ;?></td>
	  		<td width="20%" class="NoiseFooterTD">&nbsp;Peso millar (Kg)</td>
			<td width="30%" class="NoiseDataTD">&nbsp;<span id="pesomillar"><?php echo round(((($solapa / 1000) + ($largo / 1000 * 2) + ($solapa / 1000 * 2) + ($fuelle / 1000 * 2)) * (($ancho / 1000) * $totalgramaje))*100) / 100 ?></span></td>
		</tr>
		<tr>
		<td colspan="4" class="ui-state-default">&nbsp;Accesorios Bolsa Pouch Lateral</td>
		</tr>
		<tr>
	 	  	<td class="NoiseFooterTD">&nbsp;V&aacute;lvula</td>
	 	  	<td class="NoiseDataTD" colspan="3">&nbsp;<input type="hidden" name="valve" id="valve" value="<?php echo $valve ?>" /><?php echo ($valve)? strtoupper($valve) : '---' ;?></td>
	  	</tr>
		<tr> 
			<td class="NoiseFooterTD"><span style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Color Tapa V&aacute;lvula</span></td> 
			<td class="NoiseDataTD"><span id="ctapa_valveobj" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="hidden" name="ctapa_valve" id="ctapa_valve" value="<?php echo $ctapa_valve ?>" /><?php echo ($ctapa_valve)? strtoupper($ctapa_valve) : '---' ;?></span></td>
	  		<td class="NoiseFooterTD"><span id="medi_valvelb" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Medida V&aacute;lvula (mm)</span></td>
	  		<td class="NoiseDataTD"><span id="medi_valveobj" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="hidden" name="medi_valve" id="medi_valve" value="<?php echo $medi_valve ?>" /><?php echo ($medi_valve)? strtoupper($medi_valve) : '---' ;?></span></td>
	  	</tr>
	  	
		<tr> 
	  		<td class="NoiseFooterTD"><span id="ubic_valvelb" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Ubicaci&oacute;n V&aacute;lvula</span></td>
	  		<td class="NoiseDataTD"><span id="ubic_valveobj" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="hidden" name="ubic_valve" id="ubic_valve" value="<?php echo $ubic_valve ?>" /><?php echo ($ubic_valve)? strtoupper($ubic_valve) : '---' ;?></span></td>
	  		<td class="NoiseFooterTD"><span id="tipo_valvelb" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Tipo de V&aacute;lvula</span></td>
	 	  	<td class="NoiseDataTD"><span id="tipo_valveobj" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="hidden" name="tipo_valve" id="tipo_valve" value="<?php echo $tipo_valve ?>" /><?php echo ($tipo_valve)? strtoupper($tipo_valve) : '---' ;?></span></td>
	  	</tr>
		<tr>
			<td class="NoiseFooterTD"><span id="ziper_lb" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Ziper</span></td>
	  		<td class="NoiseDataTD"><span id="ziper_obj" style="display : <?php if($valve == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="hidden" name="ziper" id="ziper" value="<?php echo $ziper ?>" /><?php echo ($ziper)? strtoupper($ziper) : '---' ;?></span></td>
	  		<td class="NoiseFooterTD"><span id="dist_ziper_lb" style="display : <?php if($ziper == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Dist. ziper al borde</span></td>
	 	  	<td class="NoiseDataTD"><span id="dist_ziper_obj" style="display : <?php if($ziper == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="hidden" name="dist_ziper" id="dist_ziper" value="<?php echo $dist_ziper ?>" /><?php echo ($dist_ziper)? $dist_ziper : '---' ;?></span></td>
	  	</tr>
	  	<tr>
			<td class="NoiseFooterTD">&nbsp;Muesca</td>
	  		<td class="NoiseDataTD">&nbsp;<input type="hidden" name="muesca" id="muesca" value="<?php echo $muesca ?>" /><?php echo ($muesca)? strtoupper($muesca) : '---' ;?></td>
	  		<td class="NoiseFooterTD"><span id="dist_muesca_lb" style="display : <?php if($muesca == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Dist. muesca al borde</span></td>
	 	  	<td class="NoiseDataTD"><span id="dist_muesca_obj" style="display : <?php if($muesca == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="hidden" name="dist_muesca" id="dist_muesca" value="<?php echo $dist_muesca ?>" /><?php echo ($dist_muesca)? $dist_muesca : '---' ;?></span></td>
	  	</tr>
	  	<tr>
			<td class="NoiseFooterTD">&nbsp;Precorte</td>
	  		<td class="NoiseDataTD">&nbsp;<input type="hidden" name="precorte" id="precorte" value="<?php echo $precorte ?>" /><?php echo ($precorte)? strtoupper($precorte) : '---' ;?></td>
	  		<td class="NoiseFooterTD"><span id="dist_precorte_lb" style="display : <?php if($precorte == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Dist. precorte al borde</span></td>
	 	  	<td class="NoiseDataTD"><span id="dist_precorte_obj" style="display : <?php if($precorte == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<input type="hidden" name="dist_precorte" id="dist_precorte" value="<?php echo $dist_precorte ?>" /><?php echo ($dist_precorte)? $dist_precorte : '---' ;?></span></td>
	  	</tr>
	</table>
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td class="NoiseFooterTD" width="20%">&nbsp;Llenado</td>
			<td class="NoiseDataTD" width="30%">&nbsp;<input type="hidden" name="tipo_llenado" id="tipo_llenado" value="<?php echo $tipo_llenado ?>" /><?php echo ($tipo_llenado)? strtoupper($tipo_llenado) : '---' ;?></td>
			<td class="NoiseFooterTD" width="20%">&nbsp;C&oacute;digo de barras</td>
			<td class="NoiseDataTD" width="30%">&nbsp;<input type="hidden" name="cod_barras" id="cod_barras" value="<?php echo $cod_barras ?>" /><?php echo ($cod_barras)? $cod_barras : '---' ;?></td>
		</tr>
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="4">&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD" colspan="4">&nbsp;<input type="hidden" name="note_product" id="note_product" value="<?php echo $note_product ?>" /><?php echo strtoupper($note_product)?></td></tr>
	</table>
		<br>
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
	<?php if($tipo_impresion != 'sin_impresion'){?>
		<tr>
  			<td width="20%" class="NoiseFooterTD"><?php if ($campnomb["continuo"] == 1) { $continuo = null; echo "*";}?>&nbsp;Continuo</td>
  			<td width="80%" class="NoiseDataTD">&nbsp;Si&nbsp;<input type="radio" name="continuo" id="continuo1" value="si" onclick="eventContinuo(this.value);" <?php if($continuo == 'si'){echo 'checked';}?> />&nbsp;No&nbsp;<input type="radio" name="continuo" id="continuo2" value="no" onclick="eventContinuo(this.value);" <?php if($continuo == 'no'){echo 'checked';}?> /></td>
  		</tr>
		<tr>
  			<td width="20%" class="NoiseFooterTD"><span id="nrorepet_lb" style="display : <?php if($continuo == 'si'){echo 'none';}else{'block';}?>"><?php if ($campnomb["nrorepet"] == 1) { $nrorepet = null; echo "*";}?>&nbsp;No. Repeticiones</span></td>
  			<td width="80%" class="NoiseDataTD"><span id="nrorepet_obj" style="display : <?php if($continuo == 'si'){echo 'none';}else{'block';}?>">&nbsp;<input type="text" name="nrorepet" id="nrorepet" value="<?php echo $nrorepet ?>" onkeyup="eventRodillo(this.value);" /></span></td>
  		</tr>
  		<tr>
  			<td width="20%" class="NoiseFooterTD"><?php if ($campnomb["rodillo"] == 1) { $rodillo = null; echo "*";}?>&nbsp;Rodillo</td>
  			<td width="30%" class="NoiseDataTD">&nbsp;<input type="text" name="rodillo" id="rodillo" value="<?php echo $rodillo ?>" class="tip" title="ejemplo" /></td>
  		</tr>
  		<?php }?>
		<tr>
  			<td width="20%" class="NoiseFooterTD <?php if($arrCampertipproCAL[$arrCampertipproCOD['nropistas']] > 0){echo 'ui-state-error ui-corner-all';}?>"><?php if ($campnomb["nropistas"] == 1) { $nropistas = null; echo "*";}?>&nbsp;No. Pistas</td>
  			<td colspan="3" class="NoiseDataTD">&nbsp;<input type="text" name="nropistas" id="nropistas" value="<?php echo $nropistas ?>" onkeyup="accionReloadAjax_planeacion();"/></td>
  		</tr>
  	</table>
  	<br>
  	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="4"><?php if($campnomb["nota_solicitud"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD" colspan="4"><textarea name="nota_solicitud" cols="116" rows="3"><?php echo $nota_solicitud; ?></textarea></tr>
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
			<td width="20%" class="NoiseFooterTD"><?php if ($campnomb["cant_planea"] == 1) { $cant_planea = null; echo "*";}?>&nbsp;Cant. Planeada (<?php echo $unimedi ?>)</td>
			<td width="30%" class="NoiseDataTD"><input type="text" name="cant_planea" id="cant_planea" value="<?php echo $cant_planea ?>" onkeyup="validaCantplaneada(this.value);" /></td>
			<td width="20%" class="NoiseFooterTD"><?php if ($campnomb["criterio"] == 1) { $criterio = null; echo "*";}?>&nbsp;Criterio </td>
			<td width="30%" class="NoiseDataTD"><input type="hidden" name="criterio_val" id="criterio_val" value="<?php echo $criterio_val ?>" /><select name="criterio" id="criterio"  onchange="cargaCriterio(this.value);">
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
				<div class="ui-buttonset ui-state-default NoiseDataTD">&nbsp;
					<?php if($campnomb["material"] == 1){ $paditekeylin = null; echo "*";}?>Material&nbsp;
					<select name="idmaterial" id="idmaterial"> 
						<option value="">--Seleccione--</option>
						<?php 
							$array_tmp = explode(':|:',$arrtabla2);	
							if($formulcodigo) $arr_formul = explode(',',$formulcodigo);	
							$idcon = fncconn();
							for($a = 0; $a < count($array_tmp); $a++)
							{
								$rwArray_tmp = explode(':-:', $array_tmp[$a]);
								$rwItem = loadrecordpadreitem($rwArray_tmp[1],$idcon);
								//$rwItem['paditeextrui'] == 'f' && 
								if($rwItem['paditecodigo'] != 25)
								{
									echo '<option value="'.$rwItem['paditecodigo'].'">'.$rwItem['paditenombre'].'</option>';
								}
							}
						?>
					</select>
					<button id="anxmaterial">Agregar a la lista</button>&nbsp;
					<button id="retmaterial">Quitar de la lista</button>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<div id="listamateriales">
					<?php
						$noAjax = true;
						include '../src/FunjQuery/jquery.visors/jquery.mat_planeacion.php';  
					?>
				</div>
			</td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="4"><?php if($campnomb["nota_materiales"] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Observaciones materiales</td></tr>
		<tr><td class="NoiseDataTD" colspan="4"><textarea name="nota_materiales" cols="116" rows="3"><?php echo $nota_materiales; ?></textarea></tr>
	</table>
</div>
<!-- FIN PESTA�A EXPLOCION DE MATERIA PRIMA  -->

<!-- PESTA�A RUTAS -->
<div id="opt-tab4">
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
	  		<tr>
	  			<td width="100%" valign="top">
		  			<table width="100%" border="0" cellspacing="1" cellpadding="0" align="left" class="ui-widget-content"> 	
						<tr>
		  					<td width="40%" class="NoiseFooterTD"><?php if ($campnomb["rutaitem_est"] == 1) { $rutaitem_est = null; echo "*";}?>&nbsp;Ruta Item Estandar</td>
		  					<td width="60%" class="NoiseDataTD"><select name="r_item_est" id="r_item_est">
		  					<option value="">--Seleccione--</option>
								<?php 
									$idcon = fncconn();
									include "../src/FunGen/floadprocedimiento.php";
									floadprocedimiento($tipsolcodigo,$idcon);
								?>
							</select>
		  					</td>
		  				</tr>
						<tr>
		  					<td colspan="2" class="NoiseDataTD">
		  						<div class="ui-buttonset" align="right">
									<button id="ingresaritem_est">Agregar</button>&nbsp;&nbsp;
		            				<button id="quitaritem_est">Quitar</button>
								</div>
		  					</td>
		  				</tr>
						<tr>
		  					<td colspan="2" class="NoiseDataTD">
		  						<div id="filtrrutaitem_est"><?php $noAjax = true;include '../src/FunjQuery/jquery.visors/jquery.rutaitem_est.php'; ?></div>
								<input type="hidden" name="rutaitem_est" id="rutaitem_est" value="<?php echo $rutaitem_est; ?>">
								<input type="hidden" name="rutaitem_esttmp" id="rutaitem_esttmp" value="<?php echo $rutaitem_esttmp; ?>">
		  					</td>
		  				</tr>
					</table>
	  			</td>
		  	</tr>
	</table>
	<br>
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
		  	<td width="20%" class="NoiseFooterTD">&nbsp;Ruta</td>
		  	<td width="30%" class="NoiseDataTD"><select name="ruta" id="ruta" onchange="eventCorte_r(this.value);">
		  		<option value="">--Seleccione--</option>
					<?php 
						$idcon = fncconn();
						include_once "../src/FunGen/floadprocedimiento.php";
						floadprocedimiento($tipsolcodigo,$idcon);
					?>
				</select>
		  	</td>
		  	<td width="20%" class="NoiseFooterTD"><span id="material_lb" style="display : <?php if($ruta == 'corte_r'){ echo 'block';}else{echo 'none';} ?>">&nbsp;Material</span></td>
		  	<td width="30%" class="NoiseDataTD">
		  		<span id="material_obj" style="display : none">
		  			<input type="hidden" name="material_rep" id="material_rep"/>
		  			<select name="material_ruta" id="material_ruta"> 
					<option value="">--Seleccione--</option>
				</select>
				</span>
			</td>
		</tr>
		<tr>
			<td colspan="4" class="NoiseDataTD">
		  		<div class="ui-buttonset" align="right">
					<button id="ingresaritem_pv">Agregar</button>&nbsp;&nbsp;
		           	<button id="quitaritem_pv">Quitar</button>
				</div>
		  	</td>
		</tr>
		<tr>
		  	<td colspan="4" class="NoiseDataTD">
		  		<div id="filtrrutaitem"><?php include '../src/FunjQuery/jquery.visors/jquery.rutaitem.php'; ?></div>
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