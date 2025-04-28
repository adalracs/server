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
  			<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="tipo_impresion" value="<?php echo $tipo_impresion ?>"/><?php echo strtoupper($tipo_impresion) ?> </td>
  		</tr>
  	</table>

	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
		<td colspan="4" class="ui-state-default">&nbsp;Medidas Lamina</td>
		</tr>
		<tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;Ancho (mm)</td>
			<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="ancho" id="ancho" value="<?php echo $ancho ?>"/><?php echo ($ancho)? $ancho : '---' ; ?></td>
			<td width="20%" class="NoiseFooterTD">&nbsp;Tolerancia del ancho (mm)</td>
			<td width="30%" class="NoiseDataTD">
				<b>+</b>&nbsp;<input type="hidden" name="tole_ancho_ms" id="tole_ancho_ms" value="<?php echo $tole_ancho_ms ?>" /><?php echo ($tole_ancho_ms)? $tole_ancho_ms : '**' ; ?>
				<b>-</b>&nbsp;<input type="hidden" name="tole_ancho_mn" id="tole_ancho_mn" value="<?php echo $tole_ancho_mn ?>" /><?php echo ($tole_ancho_ms)? $tole_ancho_mn : '**';  ?>
			</td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;Largo (mm)</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<input type="hidden" name="largo" id="largo" value="<?php echo $largo?>" /><?php echo ($largo)? $largo : '---' ;?></span></td>
			<td class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;Tolerancia de largo (mm)</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">
				<b>+</b>&nbsp;<input type="hidden" name="tole_largo_ms" id="tole_largo_ms" value ="<?php echo $tole_largo_ms ?>" /><?php echo ($tole_largo_ms)? $tole_largo_ms : '**' ;?>
				<b>-</b>&nbsp;<input type="hidden" name="tole_largo_mn" id="tole_largo_mn" value ="<?php echo $tole_largo_mn ?>" /><?php echo ($tole_largo_mn)? $tole_largo_mn : '**' ;?>
			</span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;Ancho fotocelda (mm)</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<input type="hidden" name="ancho_fotoc" id="ancho_fotoc" value ="<?php echo $ancho_fotoc ?>" /><?php echo ($ancho_fotoc)? $ancho_fotoc : '---' ; ?></span></td>
			<td class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;Largo fotocelda (mm)</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<input type="hidden" name="largo_fotoc" id="largo_fotoc" value ="<?php echo $largo_fotoc ?>" /><?php echo ($largo_fotoc)? $largo_fotoc : '---' ;?></span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;Distancia fotocelda al borde (mm)</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<input type="hidden" name="dfotoc_borde" id="dfotoc_borde" value ="<?php echo $dfotoc_borde ?>" /><?php echo ($dfotoc_borde)? $dfotoc_borde : '---' ;?></span></td>
			<td class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;Color fotocelda</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<input type="hidden" name="color_fotoc" id="color_fotoc" value ="<?php echo $color_fotoc ?>" /><?php echo ($color_fotoc)? strtoupper($color_fotoc) : '---' ;?></span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;Tipo de embobinado</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<input type="hidden" name="tipo_emb" id="tipo_emb" value ="<?php echo $tipo_emb ?>" /><?php echo ($tipo_emb)? strtoupper($tipo_emb) : '---' ;?></span></td>
			<td class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;Con respecto</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<input type="hidden" name="con_resp" id="con_resp"  value ="<?php echo $con_resp ?>" /><?php echo ($con_resp)? strtoupper($con_resp) : '---' ;?></span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;C&oacute;digo de barras</span></td>
			<td class="NoiseDataTD" colspan="3"><span style="display : <?php if($tipo_impresion == 'sin_impresion'){echo 'none';}else{echo 'block';}?>">&nbsp;<input type="hidden" name="cod_barras" id="cod_barras" value ="<?php echo $cod_barras ?>" /><?php echo ($cod_barras)? $cod_barras : '---' ;?></span></td>
		</tr>
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="4">&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD" colspan="4">&nbsp;<input type="hidden" name="note_product" id="note_product" value ="<?php echo $note_product ?>" /><?php echo strtoupper($note_product) ?>
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
  			<td width="20%" class="NoiseFooterTD"><?php if ($campnomb["rodillo"] == 1) { $nropistas = null; echo "*";}?>&nbsp;Rodillo</td>
  			<td width="30%" class="NoiseDataTD">&nbsp;<input type="text" name="rodillo" id="rodillo" value="<?php echo $rodillo ?>" /></td>
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
<!-- FIN PESTAÑA ESPECIFICACIONES DEL PRODUCTO -->

<!-- PESTAÑA EXPLOCION DE MATERIA PRIMA -->
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
						<td width="80%" class="NoiseDataTD">&nbsp;<?php if($product_imp) $rwPad = loadrecordpadreitem($product_imp,$idcon); echo ($rwPad['paditenombre'])? strtoupper($rwPad['paditenombre']) : '---' ;?></td>
					</tr>
						<?php if($tipo_estruc != 'monocapa'){?>
							<?php for($h=0;$h<$valid_produc_imp;$h++){
							$obj_produclam = "product_lam_".($h +1);
						?>
					<tr>
						<td width="20%" class="NoiseFooterTD">&nbsp;Material a laminar # <?php echo ($h +1 )?></td>
						<td width="80%" class="NoiseDataTD">&nbsp;<?php if($$obj_produclam){ $rwPad = loadrecordpadreitem($$obj_produclam,$idcon); echo ($rwPad['paditenombre'])? strtoupper($rwPad['paditenombre']) : '---' ;unset($rwPad);?><input type="hidden" name="<?php echo $obj_produclam ?>" id="<?php echo $obj_produclam ?>" value="<?php echo $$obj_produclam ?>" /><?php }?></td>
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
								/*$rwItem['paditeextrui'] == 'f' && */
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
<!-- FIN PESTAÑA EXPLOCION DE MATERIA PRIMA -->

<!-- PESTAÑA RUTAS -->
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
<!-- FIN PESTAÑA RUTAS -->


<!-- PESTAÑA CONDICIONES DEPROCESO PARA EL DESARROLLO  -->
<div id="opt-tab7">
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;Producto a empacar</td>
			<td width="30%" class="NoiseDataTD"><input type="hidden" name="product_empa" id="product_empa" value="<?php echo $product_empa ?>" /><?php echo ($product_empa)? strtoupper($product_empa) : '---' ;?></td>
			<td width="25%" class="NoiseFooterTD">&nbsp;Temperatura de empacado (C)</td>
			<td width="25%" class="NoiseDataTD"><input type="hidden" name="temp_empa" id="temp_empa" value="<?php echo $temp_empa ?>" /><?php echo ($temp_empa)? strtoupper($temp_empa) : '---' ;?></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Tipo de sellado</td>
			<td class="NoiseDataTD"><input type="hidden" name="tipo_sellado" id="tipo_sellado" value="<?php echo $tipo_sellado ?>" /><?php echo ($tipo_sellado)? strtoupper($tipo_sellado) : '---' ;?></td>
			<td class="NoiseFooterTD">&nbsp;Velocidad (Unid/min)</td>
			<td class="NoiseDataTD"><input type="hidden" name="vel_empa" id="vel_empa" value="<?php echo $vel_empa ?>" /><?php echo ($vel_empa)? strtoupper($vel_empa) : '---' ;?></td>
		</tr>
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="4">&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD" colspan="4"><input type="hidden" name="note_proces" id="note_proces" value="<?php echo $note_proces?>" /><?php echo strtoupper($note_proces) ?></td>
	</table>
</div>
<!-- FIN PESTAÑA CONDICIONES DEPROCESO PARA EL DESARROLLO  -->

<!-- PESTAÑA FORMA EMPAQUE -->
<div id="opt-tab4a">
	<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;Forma de empaque</td>
			<td width="80%" class="NoiseDataTD">&nbsp;<input type="hidden" name="form_empa" id="form_empa" value="<?php echo $form_empa ?>" /><?php echo ($largo)? strtoupper($form_empa) : '---'; ?></td>
		<tr>
	</table>
	
	<div id="seccion_formempa_suspendido" style="display: <?php if($form_empa == 'suspendido'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;Niveles por estiba</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="niv_estiba" id="niv_estiba" value="<?php echo $niv_estiba ?>" /><?php echo ($niv_estiba)? $niv_estiba : '---' ; ?></td>
				<td width="20%" class="NoiseFooterTD">&nbsp;Peso por estiba (Kg)</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="peso_estiba" id="peso_estiba" value="<?php echo $peso_estiba ?>" /><?php echo ($peso_estiba)? $peso_estiba : '---'; ?></td>
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
				<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="pro_core" id="pro_core" value="<?php echo $pro_core ?>" /><?php echo ($pro_core)? strtoupper($pro_core) : '---' ;?></td>
				<td width="20%" class="NoiseFooterTD">&nbsp;Bolsa pl&aacute;stica</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="bolsa_plastica" id="bolsa_plastica" value="<?php echo $bolsa_plastica ?>" /><?php echo ($bolsa_plastica)? strtoupper($bolsa_plastica) : '---' ;?></td>
			<tr>
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;Peso Maximo por caja (kg)</td>
				<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="peso_max" id="peso_max" value="<?php echo $peso_max ?>" /><?php echo ($peso_max)? $peso_max : '---' ;?></td>
			</tr>
		</table>
	</div>
	
	<div id="seccion_formempa_bolsa_plastica" style="display: <?php if($form_empa == 'bolsa_plastica'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;Protector core</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="pro_core" id="pro_core" value="<?php echo $pro_core ?>" /><?php echo ($pro_core)? strtoupper($pro_core) : '---' ;?></td>
				<td width="20%" class="NoiseFooterTD">&nbsp;Peso Maximo por bolsa (kg)</td>
				<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="peso_max" id="peso_max" value="<?php echo $peso_max ?>" /><?php echo ($peso_max)? $peso_max : '---' ;?></td>
			</tr>
		</table>
	</div>
	
	<div id="seccion_formempa_carton_extremos" style="display: <?php if($form_empa == 'carton_extremos'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;Protector core</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="pro_core" id="pro_core" value="<?php echo $pro_core ?>" /><?php echo ($pro_core)? strtoupper($pro_core) : '---' ;?></td>
				<td width="20%" class="NoiseFooterTD">&nbsp;Bolsa pl&aacute;stica</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="bolsa_plastica" id="bolsa_plastica" value="<?php echo $bolsa_plastica ?>" /><?php echo ($bolsa_plastica)? strtoupper($bolsa_plastica) : '---' ;?></td>
			<tr>
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;No. Rollos</td>
				<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="no_rollos" id="no_rollos" value="<?php echo $no_rollos ?>" /><?php echo ($no_rollos)? $no_rollos : '---' ;?></td>
			</tr>
		</table>
	</div>
	
	<div id="seccion_formempa_cubierto_extremos" style="display: <?php if($form_empa == 'cubierto_extremos'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;Protector core</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="pro_core" id="" value="<?php echo $pro_core ?>" /><?php echo ($pro_core)? strtoupper($pro_core) : '---' ;?></td>
				<td width="20%" class="NoiseFooterTD">&nbsp;Bolsa pl&aacute;stica</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="bolsa_plastica" id="bolsa_plastica" value="<?php echo $bolsa_plastica ?>" /><?php echo ($bolsa_plastica)? strtoupper($bolsa_plastica) : '---' ;?>
			<tr>
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;No. Rollos</td>
				<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="no_rollos" id="no_rollos" value="<?php echo $no_rollos?>" /><?php echo ($no_rollos)? $no_rollos : '---' ; ?></td>
			</tr>
		</table>
	</div>
	
	<br/>
	<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;Material estibado</td>
			<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="estibado" id="estibado" value="<?php echo $estibado ?>" /><?php echo ($estibado)? strtoupper($estibado) : '---' ;?></td>
			<td width="20%" class="NoiseDataTD">&nbsp;</td>
			<td width="30%"class="NoiseDataTD">&nbsp;</td>
		</tr>
	</table>
	<div id="session_estibado" style="display: <?php if($arrCampertippro['estibado'] == 'si'){ echo 'block'; } else { echo 'none'; } ?>">
		<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;Tama&ntilde;o de estiba</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="tam_estiba" id="tam_estiba" value="<?php echo $tam_estiba ?>" /><?php echo ($tam_estiba)? strtoupper($tam_estiba) : '---' ;?></td>
				<td width="20%" class="NoiseFooterTD">&nbsp;Tipo de estiba</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="tipo_estiba" id="tipo_estiba" value="<?php echo $tipo_estiba ?>" /><?php echo ($tipo_estiba)? strtoupper($tipo_estiba) : '---' ;?>
			</tr>
			<tr><td class="ui-state-default" colspan="4"></td></tr>
			<tr>
				<td class="NoiseFooterTD">&nbsp;Altura m&aacute;xima pallet (mm)</td>
				<td class="NoiseDataTD">&nbsp;<input type="hidden" name="alt_pallet" id="alt_pallet" value="<?php echo $alt_pallet ?>" /><?php echo ($alt_pallet)? $alt_pallet : '---' ;?></td>
				<td class="NoiseFooterTD">&nbsp;Peso por pallet (Kg)</td>
				<td class="NoiseDataTD">&nbsp;<input type="hidden" name="peso_pallet" id="peso_pallet" value="<?php echo $peso_pallet?>" /><?php echo ($peso_pallet)? $peso_pallet : '---' ;?></td>
			</tr>
			<tr>
				<td class="NoiseFooterTD">&nbsp;Estresado</td>
				<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="estresado" id="estresado" value="<?php echo $estresado ?>" /><?php echo ($estresado)? strtoupper($estresado) : '---' ;?></td>
			</tr>
		</table>
	</div>
	<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr><td class="ui-state-default"></td></tr>
		<tr><td class="NoiseFooterTD">&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD"><input type="hidden" name="note_formaempaque" id="note_formaempaque" value="<?php echo $note_formaempaque ?>" /><?php echo strtoupper($note_formaempaque) ?></td>
	</table>
</div>
<!-- FIN PESTAÑA FORMA EMPAQUE -->