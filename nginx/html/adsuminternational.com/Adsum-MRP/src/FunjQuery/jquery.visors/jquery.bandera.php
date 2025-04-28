<?php 
	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		
		include '../../FunPerPriNiv/pktblflagproduccion.php';
	endif;
	
	$idcon = fncconn();
	
	if($tipsolcodigo)
	{
		$rsflagproduccion = dinamicscanflagproduccion(array('tipsolcodigo' => $tipsolcodigo),$idcon);
		$nrflagproduccion = fncnumreg($rsflagproduccion);
	}
?>	
	
<div style="width:748px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="50" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel<input type="checkbox" onclick="setSelectionAll('flagproduccion',',');" value="1" name="allflagproduccion" id="allflagproduccion" <?php if($allflagproduccion) echo 'checked'; ?> ></td>
				<td width="600" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Nombre</td>
				<td width="83" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Numero</td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:748px; height: 150px;overflow:auto;" class="ui-widget-content">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	if($nrflagproduccion):
		if($arrflagproduccion)
		{
			$array_tmp = explode(',',$arrflagproduccion);
			$array_key = array_flip($array_tmp);
		}
	
		for($a = 0; $a < $nrflagproduccion; $a++):
			$rwflagproduccion = fncfetch($rsflagproduccion, $a);
			$objsNumeroBanderas = 'txt_numero'.$rwflagproduccion['flaprocodigo'];
		
			if($a % 2)
				$complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"';
			else
				$complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
			
			if(is_array($array_key))
			{
				$checked = '';
				if(array_key_exists($rwflagproduccion['flaprocodigo'], $array_key) || $allflagproduccion)
					$checked = 'checked';
			}	
?>			
			<tr <?php echo $complement ?>">
				<td width="50" style=" border-bottom: 1px solid #fff;"><input type="checkbox" id="chkflagproduccion" name="chkflagproduccion" <?php echo $checked ?> onclick="setSelectionRow(this.value, document.getElementById('arrflagproduccion').value, ',', 'flagproduccion'); <?php if($flagproduccionreport): ?>rldSubfunction();<?php endif ?> <?php if($flagproduccionreportop): ?>reloadSistema();<?php endif ?>" value="<?php echo $rwflagproduccion['flaprocodigo'] ?>"></td>
				<td width="600" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwflagproduccion['flapronombre'] ?></td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<input type="text" name="<?php echo $objsNumeroBanderas; ?>" id="<?php echo $objsNumeroBanderas; ?>" value="<?php echo $$objsNumeroBanderas; ?>" size="5" class="<?php if($campnomb[$objsNumeroBanderas] == 1) echo 'ui-state-error ui-corner-all'; ?>" /></td>
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
				<td width="600" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
			endfor;
		endif;	
?>
		</table>
	</div>
</div>