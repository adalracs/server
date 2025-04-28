<?php 
	
	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerPriNiv/pktblpadreitem.php';
	endif;
	
if($arrtabla1)
{
	$array_tmp = explode(':|:',$arrtabla1);
	$idcon = fncconn();
	for($a = 0; $a < count($array_tmp); $a++)
	{
		$rwArray_tmp = explode(':-:', $array_tmp[$a]);
		$rwItem = loadrecordpadreitem($rwArray_tmp[1],$idcon);
		
		if($rwArray_tmp[4] == 't')
		{
			 //objetos de campos personalizado
			
			$objapli_mate = 'apli_mate_'.($a + 1); // aplicacion del material
			$objcolor = 'color_'.($a + 1); // color de material
			$objtratamiento = 'tratamiento_'.($a + 1); // tratamiento
			$objtrata_min = 'trata_min_'.($a + 1); // tratamiento minimo
			$objtrata_max = 'trata_max_'.($a + 1); // tratamiento maximo
			$objncaras_trata = 'ncaras_trata_'.($a + 1); // numero de caras tratadas
			$objmat_sellable = 'mat_sellable_'.($a + 1); // material sellable
			$objncaras_sellable = 'ncaras_sellable_'.($a + 1); // numero de caras sellables
			$objcofmax_nt = 'cofmax_nt_'.($a + 1); // cofmax_nt
			$objcofmax_tt = 'cofmax_tt_'.($a + 1); // cofmax_tt
			$objhaze = 'haze_'.($a + 1); // haze
			$objtole_haze_ms = 'tole_haze_ms_'.($a + 1); // tolerancia haze por mas
			$objtole_haze_mn = 'tole_haze_mn_'.($a + 1); // tolerancia haze por menos
			$objnote_extruido = 'note_extruido_'.($a + 1); // nota para material extruido
			$objcore = 'core_'.($a + 1); // core
			$objtemp_sellado= 'temp_sellado_'.($a + 1); // temperatura de sellado
			$objfuerza_sellado= 'fuerza_sellado_'.($a + 1); // fuerza de sellado
			$objr_soplado= 'r_soplado_'.($a + 1); // relacion de soplasdo
			$objbrillo= 'brillo_'.($a + 1); // brillo
			$objclaridad= 'claridad_'.($a + 1); // claridad
			$objtransmitancia = 'transmitancia_'.($a + 1); // transmitancia
			$objtipo= 'tipo_'.($a + 1); // tipo
			$objplano_tratado= 'plano_tratado_'.($a + 1); // plano_tratado
			$objdardo= 'dardo_'.($a + 1); // prueba al dardo
			$objrasgado_md= 'rasgado_md_'.($a + 1); // rasgado_md
			$objrasgado_td= 'rasgado_td_'.($a + 1); // rasgado_td
			$objelongacion_md= 'elongacion_md_'.($a + 1); // elongacion_md
			$objelongacion_td= 'elongacion_td_'.($a + 1); // elongacion_td
			$objruptura_td= 'ruptura_td_'.($a + 1); // ruptura_td
			$objruptura_md= 'ruptura_md_'.($a + 1); // ruptura_md_
			
			
			$objformul_cod = 'formulcodigo_'.($a + 1); // formulacion codigo
			$objformul_num = 'formulnumero_'.($a + 1); // formiulacion numero
			$objbutton = 'formulbutton_'.($a + 1); // boton de formiulacion 
			
			
			if($tipo_impresion != 'sin_impresion')
				$$objtratamiento = 'si';
				
			if($rwItem['paditepigmen'] == 'f')
				$$objcolor = 'TRANSPARENTE';
							
?>
<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
		<td colspan="4" class="ui-state-default">&nbsp;<b>Sustrato # <?php echo ($a + 1) ?> <?php echo $rwItem['paditenombre'] ?> Calibre <?php echo $rwArray_tmp[3] ?></b></td>
		</tr>
		<tr>
			<td width="22%" class="NoiseFooterTD">&nbsp;Aplicaci&oacute;n del Material</td>
			<td width="28%" class="NoiseDataTD">&nbsp;<?php echo ($$objapli_mate)? strtoupper($$objapli_mate) : '---' ;?></td>
			<td width="22%" class="NoiseFooterTD">&nbsp;Color</td>
			<td width="28%" class="NoiseDataTD">&nbsp;<?php echo ($$objcolor)? strtoupper($$objcolor) : '---' ;?></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Tratamiento</td>
			<td class="NoiseDataTD">&nbsp;<?php echo ($$objtratamiento)? strtoupper($$objtratamiento)  : '---' ;?></td>
			<td class="NoiseFooterTD">&nbsp;Core&nbsp;</td>
			<td class="NoiseDataTD">&nbsp;<?php echo ($$objcore)? strtoupper($$objcore) : '---' ; ?></td>
		</tr>
			<tr>
			<td class="NoiseFooterTD">&nbsp;Formulacion</td>
			<td class="NoiseDataTD" colspan="3">&nbsp;<?php echo ($$objformul_num)? strtoupper($$objformul_num) : '---' ;?></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><span style="display : <?php if($$objtratamiento == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Tratamiento Min. (Dinas)</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($$objtratamiento == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<?php echo ($$objtrata_min)? strtoupper($$objtrata_min) : '---' ;?></span></td>
			<td class="NoiseFooterTD"><span style="display : <?php if($$objtratamiento == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Tratamiento Max. (Dinas)</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($$objtratamiento == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<?php echo ($$objtrata_max)? strtoupper($$objtrata_max) : '---' ;?></span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;<b>COF</b> Cara no tratada max</td>
			<td class="NoiseDataTD">&nbsp;<?php echo ($$objcofmax_nt)? strtoupper($$objcofmax_nt) : '---' ;?></td>
			<td class="NoiseFooterTD">&nbsp;<b>COF</b> Cara tratada max</td>
			<td class="NoiseDataTD">&nbsp;<?php echo ($$objcofmax_tt)? strtoupper($$objcofmax_tt) : '---' ;?></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><span style="display : <?php if($$objtratamiento == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;#n caras tratadas</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($$objtratamiento == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<?php echo ($$objncaras_trata)? strtoupper($$objncaras_trata) : '---' ;?></span></td>
			<td class="NoiseFooterTD">&nbsp;Plano tratado</td>
			<td class="NoiseDataTD">&nbsp;<?php echo ($$objplano_tratado)? strtoupper($$objplano_tratado) : '---' ;?></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Material Sellable</td>
			<td class="NoiseDataTD">&nbsp;<?php echo ($$objmat_sellable)? strtoupper($$objmat_sellable) : '---' ;?></td>
			<td class="NoiseFooterTD"><span style="display : <?php if($$objmat_sellable == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Nro Caras Sellables</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($$objmat_sellable == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<?php echo ($$objncaras_sellable)? strtoupper($$objncaras_sellable) : '---' ;?></span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Temperatura de sellado&nbsp;<b>C</b></td>
			<td class="NoiseDataTD">&nspb;<?php echo ($$objtemp_sellado)? strtoupper($$objtemp_sellado) : '---' ;?></td>
			<td class="NoiseFooterTD">&nbsp;Fuerza de sellado&nbsp;<b>gf/pul</b></td>
			<td class="NoiseDataTD">&nbsp;<?php echo ($$objfuerza_sellado)? strtoupper($$objfuerza_sellado) : '---' ;?></td>
		</tr>
		<tr>
			
			<td class="NoiseFooterTD">&nbsp;Brillo&nbsp;<b>%</b></td>
			<td class="NoiseDataTD">&nbsp;<?php echo ($$objbrillo)? strtoupper($$objbrillo) : '---' ;?></td>
			<td class="NoiseFooterTD">&nbsp;Claridad&nbsp;<b>%</b></td>
			<td class="NoiseDataTD">&nbsp;<?php echo ($$objclaridad)? strtoupper($$objclaridad) : '---' ;?></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Transmitancia&nbsp;<b>%</b></td>
			<td class="NoiseDataTD">&nbsp;<?php echo ($$objtransmitancia)? $$objtransmitancia : '---' ;?></td>
			<td class="NoiseFooterTD"><?php if($campnomb[$objtipo] == 1)echo "<b style='font-size:15px; color:red;'>*</b>"; ?>&nbsp;Tipo</td>
			<td class="NoiseDataTD">&nbsp;<?php echo ($$objtipo)? strtoupper($$objtipo) : '---' ;?></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Prueba al dardo&nbsp;<b>g</b></td>
			<td class="NoiseDataTD">&nbsp;<?php echo ($$objdardo)? strtoupper($$objdardo) : '---' ;?></td>
			<td class="NoiseFooterTD">&nbsp;Relacion de soplado</td>
			<td class="NoiseDataTD">&nbsp;<?php echo ($$objr_soplado)? strtoupper($$objr_soplado) : '---' ;?></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Rasgado MD&nbsp;<b>g</b></td>
			<td class="NoiseDataTD">&nbsp;<?php echo ($$objrasgado_md)? strtoupper($$objrasgado_md) : '---' ;?></td>
			<td class="NoiseFooterTD">&nbsp;Rasgado TD&nbsp;<b>g</b></td>
			<td class="NoiseDataTD">&nbsp;<?php echo ($$objrasgado_td)? strtoupper($$objrasgado_td) : '---' ;?></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Elongacion MD&nbsp;<b>%</b></td>
			<td class="NoiseDataTD">&nbsp;<?php echo ($$objelongacion_md)? strtoupper($$objelongacion_md) : '---' ;?><td>
			<td class="NoiseFooterTD">&nbsp;Elongacion TD&nbsp;<b>%</b></td>
			<td class="NoiseDataTD">&nbsp;<?php echo ($$objelongacion_td)? strtoupper($$objelongacion_td) : '---' ;?></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Ruptura MD&nbsp;<b>N/mm^2</b></td>
			<td class="NoiseDataTD">&nbsp;<?php echo ($$objruptura_md)? strtoupper($$objruptura_md) : '---' ;?></td>
			<td class="NoiseFooterTD">&nbsp;Ruptura TD&nbsp;<b>N/mm^2</b></td>
			<td class="NoiseDataTD">&nbsp;<?php echo ($$objruptura_td)? strtoupper($$objruptura_td) : '---' ;?></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Haze&nbsp;<b>%</b></td>
			<td class="NoiseDataTD">&nbsp;<?php echo ($$objhaze)? strtoupper($$objhaze) : '---' ;?></td>
			<td class="NoiseFooterTD">&nbsp;Tolerancia Haze&nbsp;<b>%</b></td>
			<td class="NoiseDataTD">&nbsp;
				<b>+</b>&nbsp;<?php echo ($$objtole_haze_ms)? strtoupper($$objtole_haze_ms) : '**' ;?>
				<b>-</b>&nbsp;<?php echo ($$objtole_haze_mn)? strtoupper($$objtole_haze_mn) : '**' ;?>
			</td>
		</tr>
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="4">&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD" colspan="4">&nbsp;<?php echo strtoupper($$objnote_extruido) ?></td></tr>
	</table>
<?php 	
		}
	}
}