<?php 

	if(!$noAjax)
	{
		include '../../FunGen/cargainput.php';
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerSecNiv/fncsqlrun.php';
		include '../../FunPerPriNiv/pktbldesperdiciopn.php';
	}
	
	$idcon = fncconn();
	$rsDesperdiciopn = dinamicscandesperdiciopn(array('tipsolcodigo'=> $tipsolcodigo), $idcon);	
		
	if($rsDesperdiciopn)
		$nrDesperdiciopn = fncnumreg($rsDesperdiciopn);
		
?>
<div style="width:800px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="30" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel</td>
				<td width="755" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Nombre&nbsp;</td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:800px; height: 250px; overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:100%; height: auto;  z-index: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 

 if($nrDesperdiciopn)
 {
	if($arrdesperdiciopn)
	{
		$array_tmp = explode(',',$arrdesperdiciopn);
		$array_key = array_flip($array_tmp);
	}
	
	for($a = 0;$a< $nrDesperdiciopn;$a++){
		$rwDesperdiciopn = fncfetch($rsDesperdiciopn,$a);
		($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
		
		if(is_array($array_key))
		{
			$checked = '';
			if(array_key_exists($rwDesperdiciopn['despercodigo'], $array_key))
				$checked = 'checked';
		}
?>
			<tr <?php echo $complement ?>">
				<td width="30" style=" border-bottom: 1px solid #fff;"><input type="checkbox" name="chkarrdesperdiciopn" id="chkarrdesperdiciopn" <?php echo $checked ?> value="<?php echo $rwDesperdiciopn['despercodigo'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrdesperdiciopn').value, ',', 'arrdesperdiciopn');" /></td>
				<td width="753" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwDesperdiciopn['despernombre']; ?></td>
			</tr>
<?php 
	}
 }
	
	if($a < 20){
		for($b = $a; $b < 20; $b++){
			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="30" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="753" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
			}
		}
?>
		</table>
	</div>
</div>