<?php 
	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		
		include '../../FunPerPriNiv/pktbltema.php';
	endif;
	
	unset($a);
	
	$idcon = fncconn();
	$rsTema = fullscantema($idcon);
	$nrTema = fncnumreg($rsTema);
?>	
	
<div style="width:648px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="50" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel<input type="checkbox" onclick="setSelectionAll('lsttemas',',');" value="1" name="alllsttemas" id="alllsttemas" <?php if($alllsttemas) echo 'checked'; ?> ></td>
				<td width="583" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Temas</td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:648px; height: 150px; margin: 0 auto; position:absolute;  overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:628px; height: auto;  z-index: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	if($nrTema)
	{
		if($arrlsttemas)
		{
			$array_tmp = explode(',',$arrlsttemas);
			$array_key = array_flip($array_tmp);
		}
	
		for($a = 0; $a < $nrTema; $a++)
		{
			$rwTema = fncfetch($rsTema, $a);
			$complement = ($a % 2) ? ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
				
			
				if(is_array($array_key))
				{
					$checked = '';
					if(array_key_exists($rwTema['temacodigo'], $array_key) || $alllsttemas)
						$checked = 'checked';
				}	
?>			
			<tr <?php echo $complement ?>">
				<td width="50" style=" border-bottom: 1px solid #fff;"><input type="checkbox" id="chklsttemas" name="chklsttemas" <?php echo $checked ?> onclick="setSelectionRow(this.value, document.getElementById('arrlsttemas').value, ',', 'lsttemas');" value="<?php echo $rwTema['temacodigo'] ?>"></td>
				<td width="580" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwTema['temanombre'] ?></td>
			</tr>
<?php
		}
	}		
	
	
	if($a < 13)
	{
		for($b = $a; $b < 13; $b++)
		{
			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="50" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="580" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
		}
	}
?>
		</table>
	</div>
</div>