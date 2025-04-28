<?php 
	include_once '../../FunPerSecNiv/fncconn.php';
	include_once '../../FunPerSecNiv/fncclose.php';
	include_once '../../FunPerSecNiv/fncnumreg.php';
	include_once '../../FunPerSecNiv/fncfetch.php';
	include_once '../../FunPerPriNiv/pktblmateapoy.php';
	
	
	$idcon = fncconn();
	
	
	$rsItem = fullscanmateapoy($idcon);
	
	$nrItem = fncnumreg($rsItem);
?>	


<div style="width:550px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="50" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel<input type="checkbox" onclick="setSelectionlistsAll('item',',',document.getElementById('arritem').value);" value="1" name="allitem" id="allitem" <?php if($allitem) echo 'checked'; ?> ></td>
				<td width="485" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Nombre</td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:550px; height: 150px; margin:0 auto; overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:530px; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	if($nrItem):
		if($arritem)
		{
			$array_tmp = explode(',',$arritem);
			$array_key = array_flip($array_tmp);
		}
	
		for($a = 0; $a < $nrItem; $a++):
			$rwItem = fncfetch($rsItem, $a);
		
			($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
				
			if(is_array($array_key))
			{
				$checked = '';
				if(array_key_exists($rwItem['matapocodigo'], $array_key) || $allitem)
					$checked = 'checked';
			}	
?>			
			<tr <?php echo $complement ?>">
				<td width="50" style=" border-bottom: 1px solid #fff;"><input type="checkbox" id="chkitem" name="chkitem" <?php echo $checked ?> onclick="setSelectionRow(this.value, document.getElementById('arritem').value, ',', 'arritem');" value="<?php echo $rwItem['matapocodigo'] ?>"></td>
				<td width="485" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItem['mataponombre'] ?></td>
			</tr>
<?php
		endfor;
	endif;
	
	if($a < 13):
		for($b = $a; $b < 13; $b++):
			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="50" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="485" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
			endfor;
		endif;	
?>
		</table>
	</div>
</div>