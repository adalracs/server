<?php

	if(!$noAjax)
	{
		include '../../FunGen/cargainput.php';
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerSecNiv/fncsqlrun.php';
		include '../../FunPerPriNiv/pktbltiempopn.php';
	}
	
?>
<div style="width:800px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="30" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel</td>
				<td width="565" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Nombre</td>
				<td width="100" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Hora Inicio&nbsp;</td>
				<td width="100" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Hora Fin&nbsp;</td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:800px; height: 95px; overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:100%; height: auto;  z-index: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	unset($arrObject);
	$idcon = fncconn();
	if($arrtiempopn) $arrObject = explode(',',$arrtiempopn);
	for($a = 0;$a< count($arrObject);$a++){
		$rwTiempopn = loadrecordtiempopn($arrObject[$a],$idcon);
		$objrephoraini = 'rephoraini_'.$arrObject[$a];
		$objrephorafin = 'rephorafin_'.$arrObject[$a];
		($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
?>
			<tr <?php echo $complement ?>">
				<td width="30" style=" border-bottom: 1px solid #fff;"><?php if(!$flagdetallar):?><input type="checkbox" name="chkarrtiempopn" id="chkarrtiempopn" value="<?php echo $rwTiempopn['tiempocodigo'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrtiempopntmp').value, ',', 'arrtiempopntmp');" /><?php else:?>&nbsp;&nbsp;&nbsp;<b>X</b><?php endif;?></td>
				<td width="565" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwTiempopn['tiemponombre']; ?></td>
				<td width="100" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<input type="text" name="<?php echo $objrephoraini ?>" id="<?php echo $objrephoraini ?>" value="<?php echo $$objrephoraini ?>" size="10" /></td>
				<td width="98" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<input type="text" name="<?php echo $objrephorafin ?>" id="<?php echo $objrephorafin ?>" value="<?php echo $$objrephorafin ?>" size="10" /></td>
			</tr>
<?php 
	}
	
	if($a < 20){
		for($b = $a; $b < 20; $b++){
			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="30" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="565" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="100" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="98" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
			}
		}
?>
		</table>
	</div>
</div>