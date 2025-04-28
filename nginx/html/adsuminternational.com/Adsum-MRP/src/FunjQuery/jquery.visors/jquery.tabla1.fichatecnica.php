<?php 

	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerPriNiv/pktblpadreitem.php';
	endif;


?>


<div style="width:800px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="25" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel</td>
				<td width="390" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Material</td>
				<td width="70" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;<?php if ($campnomb["tabla1_color"] == 1) { $foil_imp = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>Color</td>
				<td width="70" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Calibre</td>
				<td width="80" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;<?php if ($campnomb["tabla1_calib_a1"] == 1) { $foil_imp = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>Calibre A1</td>
				<td width="80" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;<?php if ($campnomb["tabla1_calib_a2"] == 1) { $foil_imp = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>Calibre A2</td>
				<td width="70" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Gramaje</td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:800px; height: 100px; overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:783px; height: auto;  z-index: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	unset($total_gramaje,$total_calibre);
	if($arrtabla1):
		$array_tmp = explode(':|:',$arrtabla1);
		$idcon = fncconn();
		for($a = 0; $a < count($array_tmp); $a++):
			$rwArray_tmp = explode(':-:', $array_tmp[$a]);
			$rwArray_tmp_adh = explode(',',$rwArray_tmp[4]);
			($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
			
			//objetos adicionales
			$rwItem = loadrecordpadreitem($rwArray_tmp[1],$idcon);
			$objColor = 'color_'.$rwArray_tmp[0].'_'.$rwArray_tmp[1];
			$objNombre = 'objnombre_'.$rwArray_tmp[0].'_'.$rwArray_tmp[1];
			$$objNombre = $rwItem['paditenombre'];
			$objCalibreA1 = 'calibre_a1_'.$rwArray_tmp[0].'_'.$rwArray_tmp[1];
			$objCalibreA2 = 'calibre_a2_'.$rwArray_tmp[0].'_'.$rwArray_tmp[1];
			$total_gramaje += ($rwArray_tmp[3] * $rwArray_tmp[2]);
			$total_calibre += $rwArray_tmp[3];
			
			
			
?>			
			<tr <?php echo $complement ?>">
				<td width="25" style=" border-bottom: 1px solid #fff;"><?php if(!$flagdetallar):?><input type="checkbox" id="chktabla1" name="chktabla1" <?php echo $checked ?> onclick="setSelectionRow(this.value, document.getElementById('arrtabla1tmp').value, ':|:', 'tabla1tmp');" value="<?php echo $array_tmp[$a] ?>"><?php else:?>&nbsp;&nbsp;&nbsp;<b>X</b><?php endif;?></td>
				<td width="390" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItem['paditenombre'] ?>&nbsp;<?php if($rwArray_tmp_adh[1]){ echo ($rwArray_tmp_adh[1])? '|&nbsp;Desempe&ntilde;o ('.$rwArray_tmp_adh[1].')' : '-------' ;}?>&nbsp;<?php if($rwArray_tmp_adh[2]){echo ($rwArray_tmp_adh[2])? '|&nbsp;Tipo ('.$rwArray_tmp_adh[2].')' : '-------' ;}?></td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php if($rwItem['paditepigmen'] == 't'): ?><?php if(!$flagdetallar){?><input type="text" name="<?php echo $objColor ?>" id="<?php echo $objColor ?>" value="<?php echo $$objColor ?>" onchange="accionColorPelicula(this.value);" size="10" /><?php }else{?><?php echo ($$objColor)? strtoupper($$objColor) : '---' ;?><?php } else: ?>---<?php endif;?></td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwArray_tmp[3] ?></td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php if(!$flagdetallar){?><input type="text" name="<?php echo $objCalibreA1 ?>" id="<?php echo $objCalibreA1 ?>" value="<?php echo $$objCalibreA1 ?>" size="7" /><?php }else{ echo ($$objCalibreA1)? $$objCalibreA1 : '---' ;}?></td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php if(!$flagdetallar){?><input type="text" name="<?php echo $objCalibreA2 ?>" id="<?php echo $objCalibreA2 ?>" value="<?php echo $$objCalibreA2 ?>" size="7" /><?php }else{ echo ($$objCalibreA2)? $$objCalibreA2 : '---' ;}?></td>
				<td width="68" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo ($rwArray_tmp[3] * $rwArray_tmp[2]) ?><input type="hidden" name="<?php echo $objNombre?>" id="<?php echo $objNombre?>" value="<?php echo $$objNombre ?>"/></td>
			</tr>
<?php
		endfor;
	endif;
	
	
	if($a < 10):
		for($b = $a; $b < 10; $b++):
			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="25" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="390" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="68" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
			endfor;
		endif;	
?>
		</table>
	</div>
</div>
<div>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
		<tr>
			<td width="20%" class="ui-state-default">&nbsp;Total calibre</td>
			<td width="30%" class="NoiseDataTD">&nbsp;<span id="total_calibre"><?php if($tipo_estruc == 'compuesto'){echo $total_calibre/2;}else{echo $total_calibre;} ?></span></td>
			<td width="20%" class="ui-state-default">&nbsp;Total gramaje</td>
			<td width="30%" class="NoiseDataTD">&nbsp;<span id="total_gramaje"><?php  if($tipo_estruc == 'compuesto'){echo $total_gramaje/2;}else{echo $total_gramaje;} ?></span></td>
		</tr>
	</table>
</div>
<input type="hidden" name="arrtabla1" id="arrtabla1" size="60"value="<?php echo $arrtabla1 ?>" />
<input type="hidden" name="arrtabla1tmp" id="arrtabla1tmp" size="60"value="<?php echo $arrtabla1tmp ?>" />
<input type="hidden" name="indexarrtabla1" id="indexarrtabla1" size="60"value="<?php echo ($indexarrtabla1 > 0)? $indexarrtabla1 : count($array_tmp) ;  ?>" />
<input type="hidden" name="total_gramaje" id="total_gramaje" value="<?php  if($tipo_estruc == 'compuesto'){echo $total_gramaje/2;}else{echo $total_gramaje;} ?>" />
<input type="hidden" name="total_calibre" id="total_calibre" value="<?php if($tipo_estruc == 'compuesto'){echo $total_gramaje/2;}else{echo $total_calibre;} ?>" />