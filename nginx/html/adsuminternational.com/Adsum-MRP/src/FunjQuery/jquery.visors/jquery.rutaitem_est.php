<?php 
	if(!$noAjax)
	{
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerSecNiv/fncsqlrun.php';
		include '../../FunPerPriNiv/pktblprocedimiento.php';
		include '../../FunGen/cargainput.php';
	}
	
	$idcon = fncconn();

?>

<div style="width:100%; height: 120px;  overflow:auto; border-left:0; border-right:0; border-bottom:0;" class="ui-widget-content">
	<div style="width:100%; height: auto;  z-index: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	if($rutaitem_est):
		$arrTmp = explode(',',$rutaitem_est);
	
		for($a = 0; $a < count($arrTmp); $a++):
			$rwProcedimiento = loadrecordprocedimiento($arrTmp[$a],$idcon);
			($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
?>			
			<tr <?php echo $complement ?>">
				<td width="50" style=" border-bottom: 1px solid #fff;"><?php if(!$flagdetallar){?><input type="checkbox" id="chkrutaitem_est" name="chkrutaitem_est" <?php echo $checked ?> onclick="setSelectionRow(this.value, document.getElementById('rutaitem_esttmp').value, ',', 'rutaitem_esttmp');" value="<?php echo $arrTmp[$a] ?>"><?php }else{?>&nbsp;&nbsp;&nbsp;<b>X</b><?php }?></td>
				<td width="310" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo ($rwProcedimiento['procednombre'])? strtoupper($rwProcedimiento['procednombre']) : '---' ; ?></td>
			</tr>
<?php
		endfor;
	else:
		unset($a);
	endif;
	
	if($a < 12):
		for($b = $a; $b < 12; $b++):
			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="5%" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="95%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
		endfor;
	endif;	
?>
		</table>
	</div>
</div>