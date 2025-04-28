<?php 

	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		
		include '../../FunPerPriNiv/pktblajustepn.php';
	endif;
	
	$idcon = fncconn();
	
	if($tipsolcodigo)
	{
		$ircrecord['tipsolcodigo'] = $tipsolcodigo;
		$ircrecordop['tipsolcodigo'] = '=';
	}
	
	if($equipocodigo)
	{
		$ircrecord['equipocodigo'] = $equipocodigo;
		$ircrecordop['equipocodigo'] = '=';
	}
	
	$rsajustepn = dinamicscanopajustepn($ircrecord,$ircrecordop,$idcon);
	$nrajustepn = fncnumreg($rsajustepn);
?>	
	
<div style="width:770px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="50" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel<input type="checkbox" onclick="setSelectionAll('ajustepn',',');" value="1" name="allajustepn" id="allajustepn" <?php if($allajustepn) echo 'checked'; ?> ></td>
				<td width="583" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Nombre</td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:770px; height: 100px;overflow:auto;" class="ui-widget-content">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	if($nrajustepn):
		if($arrajustepn)
		{
			$array_tmp = explode(',',$arrajustepn);
			$array_key = array_flip($array_tmp);
		}
		
		for($a = 0; $a < $nrajustepn; $a++):
			$rwajustepn = fncfetch($rsajustepn, $a);
		
			if($a % 2)
				$complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"';
			else
				$complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
			
			if(is_array($array_key))
			{
				$checked = '';
				if(array_key_exists($rwajustepn['ajustecodigo'], $array_key) || $allajustepn)
					$checked = 'checked';
			}	
?>			
			<tr <?php echo $complement ?>">
				<td width="50" style=" border-bottom: 1px solid #fff;"><input type="checkbox" id="chkajustepn" name="chkajustepn" <?php echo $checked ?> onclick="setSelectionRow(this.value, document.getElementById('arrajustepn').value, ',', 'ajustepn'); <?php if($ajustepnreport): ?>rldSubfunction();<?php endif ?> <?php if($ajustepnreportop): ?>reloadSistema();<?php endif ?>" value="<?php echo $rwajustepn['ajustecodigo'] ?>"></td>
				<td width="580" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwajustepn['ajustenombre'] ?></td>
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