<?php 
	if(!$noAjax)
	{
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncsqlrun.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
	}
	
	$idcon = fncconn();

	if($arrusuaplanta)
	{
		$sbSql = "SELECT DISTINCT sistema.* FROM sistema WHERE  sistema.plantacodigo IN ({$arrusuaplanta}) ORDER BY sistema.sistemnombre";
		$rsSistema = fncsqlrun($sbSql, $idcon);
		$nrSistema = fncnumreg($rsSistema);
	}
	
	if($arrusuaplanta && $usuaplantareportop)
	{
		$sbSql = "SELECT DISTINCT sistema.* FROM sistema WHERE  sistema.plantacodigo IN ({$arrusuaplanta}) AND sistema.tipsiscodigo = 2 ORDER BY sistema.sistemnombre";
		$rsSistema = fncsqlrun($sbSql, $idcon);
		$nrSistema = fncnumreg($rsSistema);
	}
	
	
?>	
<div style="width:648px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="50" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel<input type="checkbox" onclick="setSelectionAll('sistema',','); <?php if($usuasistemareport): ?>rldSubfunction(1);<?php endif ?>" value="1" name="allsistema" id="allsistema" <?php if($allsistema) echo 'checked'; ?> ></td>
				<td width="583" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Proceso</td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>

<div style="width:648px; height: 150px; margin:0 auto;overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:628px; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	if($nrSistema)
	{
		if($arrsistema)
		{
			$array_tmp = explode(',',$arrsistema);
			$array_key = array_flip($array_tmp);
		}
	
		for($a = 0; $a < $nrSistema; $a++)
		{
			$rwSistema = fncfetch($rsSistema, $a);
		
			($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
				
			if(is_array($array_key))
			{
				$checked = '';
				if(array_key_exists($rwSistema['sistemcodigo'], $array_key) || $allsistema)
					$checked = 'checked';
			}	
?>			
			<tr <?php echo $complement ?>">
				<td width="50" style=" border-bottom: 1px solid #fff;"><input type="checkbox" id="chksistema" name="chksistema" <?php echo $checked ?> onclick="setSelectionRow(this.value, document.getElementById('arrsistema').value, ',', 'sistema'); <?php if($usuasistemareport): ?>rldSubfunction(1);<?php endif ?>" value="<?php echo $rwSistema['sistemcodigo'] ?>"></td>
				<td width="580" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwSistema['sistemnombre'] ?></td>
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

	unset($a, $b);
?>
		</table>
	</div>
</div>