<?php 
	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		
		include '../../FunPerPriNiv/pktbltipotrab.php';
	endif;
	
	$idcon = fncconn();
	
	if($usuatipotrabreport):
		$sbSql = "	SELECT * FROM tipotrab WHERE tiptracodigo IN ({$usuatipotrab})";
		$rsTipotrab = fncsqlrun($sbSql, $idcon);
		$nrTipotrab = fncnumreg($rsTipotrab);
	else:
		$rsTipotrab = fullscantipotrab($idcon);
		$nrTipotrab = fncnumreg($rsTipotrab);
	endif;
	
	
?>	
	
<div style="width:648px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="50" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel<input type="checkbox" onclick="setSelectionAll('usuatipotrab',',');" value="1" name="allusuatipotrab" id="allusuatipotrab" <?php if($allusuatipotrab) echo 'checked'; ?> ></td>
				<td width="583" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Tipo de trabajo</td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>

<div style="width:648px; height: 150px; margin:0 auto; position:absolute;  overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:628px; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	if($nrTipotrab):
		if($arrusuatipotrab)
		{
			$array_tmp = explode(',',$arrusuatipotrab);
			$array_key = array_flip($array_tmp);
		}
	
		for($a = 0; $a < $nrTipotrab; $a++):
			$rwTipotrab = fncfetch($rsTipotrab, $a);
		
			if($a % 2)
				$complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"';
			else
				$complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
				
			if(is_array($array_key))
			{
				$checked = '';
				if(array_key_exists($rwTipotrab['tiptracodigo'], $array_key) || $allusuatipotrab)
					$checked = 'checked';
			}	
?>			
			<tr <?php echo $complement ?>">
				<td width="50" style=" border-bottom: 1px solid #fff;"><input type="checkbox" id="chkusuatipotrab" name="chkusuatipotrab" <?php echo $checked ?> onclick="setSelectionRow(this.value, document.getElementById('arrusuatipotrab').value, ',', 'usuatipotrab');" value="<?php echo $rwTipotrab['tiptracodigo'] ?>"></td>
				<td width="580" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwTipotrab['tiptranombre'] ?></td>
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
				<td width="580" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
			endfor;
		endif;	
?>
		</table>
	</div>
</div>