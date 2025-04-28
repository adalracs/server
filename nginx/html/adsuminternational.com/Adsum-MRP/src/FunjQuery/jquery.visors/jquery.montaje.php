<?php 

	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerPriNiv/pktblformula.php';
	endif;

?>
<div style="width:800px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="30" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel.</td>
				<td width="80" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Codigo</td>
				<td width="200" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Color</td>
				<td width="50" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Anilox</td>
				<td width="50" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Grupo</td>
				<td width="80" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;C. Sugerida</td>
				<td width="80" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;C. Impresa</td>
				<td width="195" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Novedades</td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:800px; height: 150px; overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:783px; height: auto;  z-index: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	if($arrdispensing):
		$array_tmp = explode(':|:',$arrdispensing);
		$idcon = fncconn();
		for($a = 0; $a < count($array_tmp); $a++):
			$rwArray_tmp = explode(':-:', $array_tmp[$a]);
			($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
			$rwItem = loadrecordformula($rwArray_tmp[1],$idcon);
			$objCintasug = 'cintasug_'.$rwArray_tmp[1];
			$objCintaimp = 'cintaimp_'.$rwArray_tmp[1];
			$objNovedades = 'novedades_'.$rwArray_tmp[1];
?>			
			<tr <?php echo $complement ?>">
				<td width="30" style=" border-bottom: 1px solid #fff;">&nbsp;&nbsp;<?php if(!$flagdetallar): ?><input type="checkbox" id="chkdispensing" name="chkdispensing" <?php echo $checked ?> onclick="setSelectionRow(this.value, document.getElementById('arrdispensingtmp').value, ':|:', 'arrdispensingtmp');" value="<?php echo $array_tmp[$a] ?>"><?php else:?>&nbsp;&nbsp;<b>X</b><?php endif; ?></td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItem['formulnumero'] ?></td>
				<td width="200" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo strtoupper($rwItem['formulnombre']) ?></td>
				<td width="50" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwArray_tmp[2] ?></td>
				<td width="50" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwArray_tmp[3] ?></td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<input type="hidden" name="<?php echo $objCintasug ?>" id="<?php echo $objCintasug ?>" value="<?php echo $$objCintasug ?>" /> <?php echo ($$objCintasug)? strtoupper($$objCintasug) : '---' ; ?></td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;&nbsp;<?php if(!$flagdetallar){?><input type="text" name="<?php echo $objCintaimp ?>" id="<?php echo $objCintaimp ?>" value="<?php echo $$objCintaimp ?>" class="<?php if($campnomb[$objCintaimp] == 1) echo 'ui-state-error ui-corner-all'; ?>" size="7" /><?php }else{?>&nbsp;<?php echo ($$objCintaimp)? strtoupper($$objCintaimp) : '---' ; ?><?php }?> </td>
				<td width="195" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php if(!$flagdetallar){?><input type="text" name="<?php echo $objNovedades ?>" id="<?php echo $objNovedades ?>" value="<?php echo $$objNovedades ?>" class="<?php if($campnomb[$objNovedades] == 1) echo 'ui-state-error ui-corner-all'; ?>" size="25" /><?php }else{?>&nbsp;<?php echo ($$objNovedades)? strtoupper($$objNovedades) : '---' ; ?><?php }?> </td>
			</tr>
<?php
		endfor;
	endif;
	
	if($a < 10):
		for($b = $a; $b < 15; $b++):
			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="30" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="200" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="50" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="50" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="195" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
			endfor;
		endif;	
?>
		</table>
	</div>
</div>
<input type="hidden" name="arrdispensing" id="arrdispensing" size="60" value="<?php echo $arrdispensing ?>" />
<input type="hidden" name="arrdispensingtmp" id="arrdispensingtmp" size="60" value="<?php echo $arrdispensingtmp ?>" />
<input type="hidden" name="indexarrdispensing" id="indexarrdispensing" size="60"value="<?php echo ($indexarrdispensing > 0)? $indexarrdispensing : count($array_tmp) ;  ?>" />