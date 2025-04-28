<?php 
	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		
		include '../../FunPerPriNiv/pktblplanta.php';
		include '../../FunPerSecNiv/fncsqlrun.php';
	endif;
	
	$idcon = fncconn();
	
	if($negocicodigo1):
		$sbSql = "	SELECT DISTINCT planta.plantacodigo, planta.plantanombre, servicio.negocicodigo 
					FROM  
						planta LEFT JOIN servicioplanta ON servicioplanta.plantacodigo = planta.plantacodigo
						LEFT JOIN servicio ON servicio.servicicodigo = servicioplanta.servicicodigo
					WHERE servicio.negocicodigo = '{$negocicodigo1}' 
				 	ORDER BY servicio.negocicodigo, planta.plantanombre";
		$rsPlanta = fncsqlrun($sbSql, $idcon);
		$nrPlanta = fncnumreg($rsPlanta);
	endif;
?>	
	
<div style="width:648px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="50" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel<input type="checkbox" onclick="setSelectionAll('usuaplanta',','); <?php if($usuaplantareport): ?>rldSubfunction();<?php endif ?>" value="1" name="allusuaplanta" id="allusuaplanta" <?php if($allusuaplanta) echo 'checked'; ?> ></td>
				<td width="583" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Ubicaci&oacute;n</td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:648px; height: 150px; margin: 0 auto; position:absolute;  overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:628px; height: auto;  z-index: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	if($nrPlanta):
		if($arrusuaplanta)
		{
			$array_tmp = explode(',',$arrusuaplanta);
			$array_key = array_flip($array_tmp);
		}
	
		for($a = 0; $a < $nrPlanta; $a++):
			$rwPlanta = fncfetch($rsPlanta, $a);
		
			if($a % 2)
				$complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"';
			else
				$complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
			
			if(is_array($array_key))
			{
				$checked = '';
				if(array_key_exists($rwPlanta['plantacodigo'], $array_key) || $allusuaplanta)
					$checked = 'checked';
			}	
?>			
			<tr <?php echo $complement ?>">
				<td width="50" style=" border-bottom: 1px solid #fff;"><input type="checkbox" id="chkusuaplanta" name="chkusuaplanta" <?php echo $checked ?> onclick="setSelectionRow(this.value, document.getElementById('arrusuaplanta').value, ',', 'usuaplanta'); <?php if($usuaplantareport): ?>rldSubfunction();<?php endif ?>" value="<?php echo $rwPlanta['plantacodigo'] ?>"></td>
				<td width="580" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwPlanta['plantanombre'] ?></td>
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