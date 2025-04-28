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
				<td width="40" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel.</td>
				<td width="90" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Codigo</td>
				<td width="420" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Color</td>
				<td width="100" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Anilox</td>
				<td width="135" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Grupo</td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:800px; height: 190px; overflow:auto; border-top:0;" class="ui-widget-content">
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
			$obj_anilox = 'anilox_'.$rwArray_tmp[1];
			$obj_grupo = 'grupo_'.$rwArray_tmp[1];
?>			
			<tr <?php echo $complement ?> >
				<td width="40" style=" border-bottom: 1px solid #fff;">&nbsp;&nbsp;<?php if(!$flagdetallar): ?><input type="checkbox" id="chkdispensing" name="chkdispensing" <?php echo $checked ?> onclick="setSelectionRow(this.value, document.getElementById('arrdispensingtmp').value, ':|:', 'arrdispensingtmp');" value="<?php echo $array_tmp[$a] ?>"><?php else:?>&nbsp;&nbsp;<b>X</b><?php endif; ?></td>
				<td width="90" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItem['formulnumero'] ?></td>
				<td width="420" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo strtoupper($rwItem['formulnombre']) ?></td>
				<td width="100" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php if(!$flagdetallar){ ?><input type="text" name="<?php echo $obj_anilox ?>" id="<?php echo $obj_anilox ?>" value="<?php echo $$obj_anilox ?>" size="7" onkeyup="validaEntero(this,this.value);" class="<?php if($campnomb[$obj_anilox] == 1) echo 'ui-state-error ui-corner-all'; ?>" /><?php }else{echo ($$obj_anilox)? $$obj_anilox : '---' ;}?></td>
				<td width="135" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php if(!$flagdetallar){ ?><input type="text" name="<?php echo $obj_grupo ?>" id="<?php echo $obj_grupo ?>" value="<?php echo $$obj_grupo ?>" size="7" onkeyup="validaEntero(this,this.value);" class="<?php if($campnomb[$obj_grupo] == 1) echo 'ui-state-error ui-corner-all'; ?>" /><?php }else{echo ($$obj_grupo)? $$obj_grupo : '---' ;}?></td>
			</tr>
<?php
		endfor;
	endif;
	
	if($a < 10):
		for($b = $a; $b < 15; $b++):
			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="40" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="90" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="420" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="100" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="135" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
			endfor;
		endif;	
?>
		</table>
	</div>
</div>
<input type="hidden" name="indexarrdispensing" id="indexarrdispensing" size="60"value="<?php echo ($indexarrdispensing > 0)? $indexarrdispensing : count($array_tmp) ;  ?>" />