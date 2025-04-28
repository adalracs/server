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
				<td width="50" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel</td>
				<td width="445" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Material</td>
				<td width="100" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Color</td>
				<td width="100" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Calibre</td>
				<td width="100" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Gramaje</td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:800px; height: 100px; overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:783px; height: auto;  z-index: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	if($arrtabla2):
		$array_tmp = explode(':|:',$arrtabla2);
		$idcon = fncconn();
		unset($total_gramaje);unset($total_calibre);
		for($a = 0; $a < count($array_tmp); $a++):
			$rwArray_tmp = explode(':-:', $array_tmp[$a]);
			$rwArray_tmp_adh = explode(',',$rwArray_tmp[4]);
			($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
			
			$rwItem = loadrecordpadreitem($rwArray_tmp[1],$idcon);
			$objColor = 'color_'.$rwArray_tmp[0].'_'.$rwArray_tmp[1];
			
			$objNombre = 'objnombre_'.$rwArray_tmp[1];
			$$objNombre = $rwItem['itevennombre'];
			
			$total_gramaje += ($rwArray_tmp[3] * $rwArray_tmp[2]);
			$total_calibre += $rwArray_tmp[3];
			
			
			
?>			
			<tr <?php echo $complement ?>">
				<td width="50" style=" border-bottom: 1px solid #fff;">&nbsp;&nbsp;<?php if($rwArray_tmp[1] == '23' && !$flagdetallar): ?><input type="checkbox" id="chktabla2" name="chktabla2" <?php echo $checked ?> onclick="setSelectionRow(this.value, document.getElementById('arrtabla2').value, ':|:', 'tabla2');" value="<?php echo $array_tmp[$a] ?>"><?php else:?>&nbsp;&nbsp;<b>X</b><?php endif; ?></td>
				<td width="445" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItem['paditenombre'] ?>&nbsp;<?php if($rwArray_tmp_adh[1]){ echo ($rwArray_tmp_adh[1])? '|&nbsp;Desempe&ntilde;o ('.$rwArray_tmp_adh[1].')' : '-------' ;}?>&nbsp;<?php if($rwArray_tmp_adh[2]){echo ($rwArray_tmp_adh[2])? '|&nbsp;Tipo ('.$rwArray_tmp_adh[2].')' : '-------' ;}?></td>
				<td width="100" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo ($$objColor)? strtoupper($$objColor) : '-------' ; ?></td>
				<td width="100" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwArray_tmp[3] ?></td>
				<td width="98" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo ($rwArray_tmp[3] * $rwArray_tmp[2]) ?><input type="hidden" name="<?php echo $objNombre?>" id="<?php echo $objNombre?>" value="<?php echo $$objNombre ?>"/></td>
			</tr>
<?php
		endfor;
	endif;
	
	if($a < 10):
		for($b = $a; $b < 10; $b++):
			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="50" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="445" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="100" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="100" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="98" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
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
<input type="hidden" name="arrtabla2" id="arrtabla2" size="60"value="<?php echo $arrtabla2 ?>" />
<input type="hidden" name="totalgramaje" id="totalgramaje" value="<?php  if($tipo_estruc == 'compuesto'){echo $total_gramaje/2;}else{echo $total_gramaje;} ?>" />
<input type="hidden" name="totalcalibre" id="totalcalibre" value="<?php if($tipo_estruc == 'compuesto'){echo $total_gramaje/2;}else{echo $total_calibre;} ?>" />