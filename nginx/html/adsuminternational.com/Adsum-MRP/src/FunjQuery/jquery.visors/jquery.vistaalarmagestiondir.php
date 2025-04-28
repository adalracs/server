<?php 

	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		//include '../../FunPerPriNiv/pktblitemdesa.php';
		include '../../FunPerPriNiv/pktblmodulo2.php';		
	endif;

?>
<div style="width:750px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="30" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel</td>
				
				<td width="435" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;M&oacute;dulo</td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:750px; height: 100px; overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:100%; height: auto;  z-index: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	if($arrmodulocodigodir):
		$array_tmp = explode(',',$arrmodulocodigodir);
		$idcon = fncconn();
		for($a = 0; $a < count($array_tmp); $a++):
			($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
			$rwItem = loadrecordmodulo($array_tmp[$a],$idcon);
?>			
			<tr <?php echo $complement ?>">
				<td width="30" style=" border-bottom: 1px solid #fff;"><?php if(!$flagdetallardir):?><input type="checkbox" id="chkmodulocodigodir" name="chkmodulocodigodir" <?php echo $checked ?> onclick="setSelectionRow(this.value, document.getElementById('arrmodulocodigodirtmp').value, ':,:', 'modulocodigodirtmp');" value="<?php echo $array_tmp[$a] ?>"><?php else:?>&nbsp;&nbsp;&nbsp;<b>X</b><?php endif;?></td>
				
				<td width="535" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItem['modulonombre']?></td>
			</tr>
<?php
		endfor;
	endif;
	
	
	if($a < 10):
		for($b = $a; $b < 6; $b++):
			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="30" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				
			</tr>
<?php
			endfor;
		endif;	
?>
		</table>
	</div>
</div>
<input type="hidden" name="arrmodulocodigodir" id="arrmodulocodigodir" size="60"value="<?php echo $arrmodulocodigodir ?>" />
<input type="hidden" name="arrmodulocodigodirtmp" id="arrmodulocodigodirtmp" size="60"value="<?php echo $arrmodulocodigodirtmp ?>" />

