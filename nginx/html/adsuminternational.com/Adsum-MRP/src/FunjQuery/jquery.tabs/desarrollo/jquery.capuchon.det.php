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
  			<td colspan="4" class="NoiseFooterTD">&nbsp;Tintas Especiales para:</td>
  		</tr>
  		<tr>
  			<td colspan="4" class="NoiseDataTD">&nbsp;<input type="hidden" name="tinta_espe" value="<?php echo $tinta_espe ?>"/><?php echo strtoupper($tinta_espe) ?> </td>
  		</tr>
  		<tr>
  			<td colspan="4" class="NoiseFooterTD">&nbsp;Otros Productos :</td>
  		</tr>
  		<tr>
  			<td colspan="4" class="NoiseDataTD">&nbsp;<input type="hidden" name="other" value="<?php echo $other ?>"/><?php echo strtoupper($other) ?> </td>
  		</tr>
  		<tr>
  			<td colspan="4" class="NoiseFooterTD">&nbsp;Observacion</td>
  		</tr>
  		<tr>
  			<td colspan="4" class="NoiseDataTD">&nbsp;<input type="hidden" name="note_flexo_desa" value="<?php echo $note_flexo_desa ?>" /><?php echo strtoupper($note_flexo_desa) ?></td>
  		</tr>
	</table>
	
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td colspan="2">
				<div id="filtrlistaestructura">
				<?php
				$noAjax = true;
				$flagdetallar = 1;
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
			<td width="20%" class="NoiseFooterTD">&nbsp;Material a imprimir</td>
			<td width="80%" class="NoiseDataTD">&nbsp;<?php if($product_imp) $rwPad = loadrecordpadreitem($product_imp,$idcon); echo ($rwPad['paditenombre'])? strtoupper($rwPad['paditenombre']) : '-------' ;?></td>
		</tr>
		<?php
			}
						
			if($tipo_estruc != 'monocapa'){

				for($h=0;$h<$valid_produc_imp;$h++){

					$obj_produclam = "product_lam_".($h +1);
		?>
		<tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;Material a laminar # <?php echo ($h +1 )?></td>
			<td width="80%" class="NoiseDataTD">&nbsp;<?php if($$obj_produclam) $rwPad = loadrecordpadreitem($$obj_produclam,$idcon); echo ($rwPad['paditenombre'])? strtoupper($rwPad['paditenombre']) : '-------' ;unset($rwPad);?></td>
		</tr>
		<?php 
				}
			}
		?>
	</table>
	
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
	<tr>
		<td colspan="4" class="ui-state-default">&nbsp;Medidas Capuchon</td>
		</tr>
		<tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;Largo (mm)</td>
			<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="largo" id="largo" value="<?php echo $largo ?>" /><?php echo ($largo)? $largo : '-------' ;?></td>
			<td width="25%" class="NoiseFooterTD">&nbsp;Tolerancia de largo (mm)</td>
			<td width="25%" class="NoiseDataTD">
				<b>+</b>&nbsp;<input type="hidden" name="tole_largo_ms" id="tole_largo_ms" value="<?php echo $tole_largo_ms ?>" /><?php echo ($tole_largo_ms)? $tole_largo_ms : '**' ;?>
				<b>-</b>&nbsp;<input type="hidden" name="tole_largo_mn" id="tole_largo_mn" value="<?php echo $tole_largo_mn ?>" /><?php echo ($tole_largo_mn)? $tole_largo_mn : '**' ;?>
			</td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Pesta&ntilde;a (mm)</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="pestania" id="pestania" value="<?php echo $pestania ?>" /><?php echo ($pestania)? $pestania : '-------' ;?></td>
			<td class="NoiseFooterTD">&nbsp;Tolerancia de pesta&ntilde;a (mm)</td>
			<td class="NoiseDataTD">
				<b>+</b>&nbsp;<input type="hidden" name="tole_pestania_ms" id="tole_pestania_ms" value="<?php echo $tole_pestania_ms ?>" /><?php echo ($tole_pestania_ms)? $tole_pestania_ms : '**' ;?>
				<b>-</b>&nbsp;<input type="hidden" name="tole_pestania_mn" id="tole_pestania_mn" value="<?php echo $tole_pestania_mn ?>" /><?php echo ($tole_pestania_mn)? $tole_pestania_mn : '**' ;?>
			</td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Base mayor (mm)</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="bmayor" id="bmayor" value="<?php echo $bmayor ?>" /><?php echo ($bmayor)? $bmayor : '-------' ;?></td>
			<td class="NoiseFooterTD">&nbsp;Tol. base mayor (mm)</td>
			<td class="NoiseDataTD">
				<b>+</b>&nbsp;<input type="hidden" name="tole_bmayor_ms" id="tole_bmayor_ms" value="<?php echo $tole_bmayor_ms ?>" /><?php echo ($tole_bmayor_ms)? $tole_bmayor_ms : '**' ;?>
				<b>-</b>&nbsp;<input type="hidden" name="tole_bmayor_mn" id="tole_bmayor_mn" value="<?php echo $tole_bmayor_mn ?>" /><?php echo ($tole_bmayor_mn)? $tole_bmayor_mn : '**' ;?>
			</td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Base menor (mm)</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="bmenor" id="bmenor" value="<?php echo $bmenor ?>" /><?php echo ($bmenor)? $bmenor : '-------' ;?></td>
			<td class="NoiseFooterTD">&nbsp;Tol. base menor (mm)</td>
			<td class="NoiseDataTD">
				<b>+</b>&nbsp;<input type="hidden" name="tole_bmenor_ms" id="tole_bmenor_ms" value="<?php echo $tole_bmenor_ms ?>" /><?php echo ($tole_bmenor_ms)? $tole_bmenor_ms : '**' ; ?>
				<b>-</b>&nbsp;<input type="hidden" name="tole_bmenor_mn" id="tole_bmenor_mn" value="<?php echo $tole_bmenor_mn ?>" /><?php echo ($tole_bmenor_mn)? $tole_bmenor_mn : '**' ;?>
			</td>
		</tr>
			<tr>
		<td colspan="4" class="ui-state-default">&nbsp;Accesorios de Capuchon</td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Macroperforaciones</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="macroper" id="macroper" value="<?php echo $macroper ?>" /><?php echo ($macroper)? strtoupper($macroper) : '-------' ;?></td>
			<td class="NoiseFooterTD">&nbsp;No. de macroperforaciones</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="nro_macroper" id="nro_macroper" value="<?php echo $nro_macroper ?>" /><?php echo ($nro_macroper)? $nro_macroper : '-------' ;?></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Microperforaciones</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="microper" id="microper" value="<?php echo $microper ?>" /><?php echo ($microper)? strtoupper($microper) : '-------' ;?></td>
			<td class="NoiseFooterTD">&nbsp;No. caras microperforaciones</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="ncaras_microper" id="ncaras_microper" value="<?php echo $ncaras_microper ?>" /><?php echo ($ncaras_microper)? $ncaras_microper :'-------' ;?></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Tipo de microperforaciones</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="tipo_microper" id="tipo_microper" value="<?php echo $tipo_microper ?>" /><?php echo ($tipo_microper)? strtoupper($tipo_microper) : '-------' ;?></td>
			<td class="NoiseFooterTD">&nbsp;Distancia Microperforacion (mm)</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="dist_microper" id="dist_microper" value="<?php echo $dist_microper ?>" /><?php echo ($dist_microper)? $dist_microper : '-------' ;?></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Troquel</td>
			<td class="NoiseDataTD" >&nbsp;<input type="hidden" name="troquel" id="troquel" value="<?php echo $troquel ?>" /><?php echo ($troquel)? strtoupper($troquel) : '-------' ;?></td>
			<td class="NoiseFooterTD">&nbsp;Sello de fondo</td>
			<td class="NoiseDataTD">&nbsp;<input type="hidden" name="selle_fondo" id="selle_fondo" value="<?php echo $selle_fondo ?>" /><?php echo ($selle_fondo)? strtoupper($selle_fondo) : '-------' ;?></td>
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
		<?php
			//se adiciono la correcion de el calculo de el peso millar de  los capuchones
			unset($estructura_n); ($arrtabla1)? $estructura_n = count(explode(':|:',$arrtabla1)) : $estructura_n = 1;
		?>
		<tr>
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
			<td width="25%" class="NoiseDataTD">&nbsp;<input type="hidden" name="cod_barras" id="cod_barras" value="<?php echo $cod_barras ?>" /><?php echo ($cod_barras)? $cod_barras : '-------' ;?></td>
		</tr>
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="4">&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD" colspan="4">&nbsp;<input type="hidden" name="note_product" id="note_product" value="<?php echo $note_product ?>" /><?php echo strtoupper($note_product) ?></td>
	</table>
	
	<?php if($tipevecodigo == 4): ?>
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
  			<td width="20%" class="NoiseFooterTD">&nbsp;No. Repeticiones</td>
  			<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="nrorepet" value="<?php echo $nrorepet ?>" /><?php echo ($nrorepet)? $nrorepet : '-------' ;?></td>
  			<td width="20%" class="NoiseFooterTD">&nbsp;Rodillo</td>
  			<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="rodillo" value="<?php echo $rodillo ?>" /><?php echo ($rodillo)? strtoupper($rodillo) : '-------' ;?></td>
  		</tr>
		<tr>
  			<td width="20%" class="NoiseFooterTD">&nbsp;No. Pistas</td>
  			<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="nropistas" value="<?php echo $nropistas ?>" /><?php echo ($nropistas)? $nropistas : '-------' ;?></td>
  		</tr>
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
					include '../src/FunjQuery/jquery.phpscripts/jquery.ajax_matextruido.des.det.php'; 
				?>
			</div>
	</div>
</div>
<!-- FIN PESTAÑA ESPECIFICACIONES DE MATERIAL EXTRUIDO -->