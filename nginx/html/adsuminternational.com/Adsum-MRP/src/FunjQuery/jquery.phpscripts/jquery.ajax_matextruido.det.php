<?php 
	
	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerPriNiv/pktblpadreitem.php';
	endif;
	
if($arrtabla1):
	$array_tmp = explode(':|:',$arrtabla1);
	$idcon = fncconn();
	for($a = 0; $a < count($array_tmp); $a++):
		$rwArray_tmp = explode(':-:', $array_tmp[$a]);
		$rwItem = loadrecordpadreitem($rwArray_tmp[1],$idcon);	
		
		if($rwArray_tmp[4] == 't'):
			//objetos de campos personalizados
		
			$objapli_mate = 'apli_mate_'.($a + 1); // aplicacion del material
			$objcolor = 'color_'.($a + 1); // color de material
			$objtratamiento = 'tratamiento_'.($a + 1); // tratamiento
			$objplano_tratado = 'plano_tratado_'.($a + 1); // tratamiento
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
?>
<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
		<td colspan="4" class="ui-state-default">&nbsp;<b>Sustrato # <?php echo ($a + 1) ?> <?php echo $rwItem['paditenombre'] ?> Calibre <?php echo $rwArray_tmp[3] ?></b></td>
		</tr>
		<tr>
			<td width="22%" class="NoiseFooterTD">&nbsp;Aplicaci&oacute;n del Material</td>
			<td width="28%" class="NoiseDataTD">&nbsp;<?php echo ($$objapli_mate)? strtoupper($$objapli_mate) : '-------' ; ?></td>
			<td width="22%" class="NoiseFooterTD">&nbsp;Color</td>
			<td width="28%" class="NoiseDataTD">&nbsp;<?php echo ($$objcolor)? strtoupper($$objcolor) : '-------' ;?></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Tratamiento</td>
			<td class="NoiseDataTD">&nbsp;<?php echo ($$objtratamiento)? strtoupper($$objtratamiento) : '-------' ;?></td>
			<td class="NoiseFooterTD"><span style="display : <?php if($$objtratamiento == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Plano tratado</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($$objtratamiento == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<?php echo ($$objplano_tratado)? strtoupper($$objplano_tratado) : '-------' ;?></span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD"><span style="display : <?php if($$objtratamiento == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Tratamiento Min. (Dinas)</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($$objtratamiento == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<?php echo ($$objtrata_min)? strtoupper($$objtrata_min) : '-------' ;?></span></td>
			<td class="NoiseFooterTD"><span style="display : <?php if($$objtratamiento == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Tratamiento Max. (Dinas)</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($$objtratamiento == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<?php echo ($$objtrata_max)? strtoupper($$objtrata_max) : '-------' ;?></span></td>
		</tr>
		<tr>
				<td class="NoiseFooterTD "><span style="display : <?php if($$objtratamiento == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Nro Caras tratadas</span></td>
				<td class="NoiseDataTD" colspan="3"><span style="display : <?php if($$objtratamiento == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<?php echo ($$objncaras_trata)? strtoupper($$objncaras_trata) : '-------' ;?></span></td>
		</tr>
		<tr>
			<td class="NoiseFooterTD">&nbsp;Material Sellable</td>
			<td class="NoiseDataTD">&nbsp;<?php echo ($$objmat_sellable)? strtoupper($$objmat_sellable) : '-------' ;?></td>
			<td class="NoiseFooterTD"><span style="display : <?php if($$objmat_sellable == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;Nro Caras Sellables</span></td>
			<td class="NoiseDataTD"><span style="display : <?php if($$objmat_sellable == 'si'){echo 'block';}else{echo 'none';}?>">&nbsp;<?php echo ($$objncaras_sellable)? strtoupper($$objncaras_sellable) : '-------' ;?></span></td>
		</tr>
		<?php if($tipitecodigo == 6):?>
		<tr>
			<td class="NoiseFooterTD">&nbsp;<b>COF</b> Cara no tratada max</td>
			<td class="NoiseDataTD">&nbsp;<?php echo ($$objcofmax_nt)? strtoupper($$objcofmax_nt) : '-------' ;?></td>
			<td class="NoiseFooterTD">&nbsp;<b>COF</b> Cara tratada max</td>
			<td class="NoiseDataTD">&nbsp;<?php echo ($$objcofmax_tt)? strtoupper($$objcofmax_tt) : '-------' ;?></td>
		</tr>
		<?php endif;?>
<!--		
		<tr>
			<td class="NoiseFooterTD">&nbsp;Opacidad Haze (%)</td>
			<td class="NoiseDataTD">&nbsp;<?php //echo ($$objhaze)? strtoupper($$objhaze) : '-------' ;?></td>
			<td class="NoiseFooterTD">&nbsp;Tolerancia Haze (%)</td>
			<td class="NoiseDataTD">
			<b>+</b>&nbsp;<?php //echo ($$objtole_haze_ms)? strtoupper($$objtole_haze_ms) : '**' ;?>
			<b>-</b>&nbsp;<?php //echo ($$objtole_haze_mn)? strtoupper($$objtole_haze_mn) : '**' ;?>
			</td>
		</tr>
-->
		<tr><td class="ui-state-default" colspan="4"></td></tr>
		<tr><td class="NoiseFooterTD" colspan="4">&nbsp;Observaciones</td></tr>
		<tr><td class="NoiseDataTD" colspan="4">&nbsp;<?php echo strtoupper($$objnote_extruido) ?></td>
	</table>
<?php 	
		endif;
	endfor;
else:
?>
<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
	<tr>
		<td colspan="4" class="ui-state-default">&nbsp;</td>
	</tr>
</table>
<?php endif;?>