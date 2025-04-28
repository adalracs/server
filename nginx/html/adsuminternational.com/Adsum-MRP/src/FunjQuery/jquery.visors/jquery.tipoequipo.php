<?php 
	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncsqlrun.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
	endif;
	
	$idcon = fncconn();
	
	if($arrusuaplanta)
	{
		$sbSql = "	SELECT DISTINCT tipoequipo.* 
					FROM planta
						LEFT JOIN sistema ON sistema.plantacodigo = planta.plantacodigo
						LEFT JOIN equipo ON equipo.sistemcodigo = sistema.sistemcodigo
						LEFT JOIN tipoequipo ON tipoequipo.tipequcodigo = equipo.tipequcodigo   
					WHERE  planta.plantacodigo IN ({$arrusuaplanta}) AND tipoequipo.tipequcodigo IS NOT NULL ORDER BY tipoequipo.tipequnombre";
		$rsTipoequipo = fncsqlrun($sbSql, $idcon);
		$nrTipoequipo = fncnumreg($rsTipoequipo);
	}
	elseif($arrsistema)
	{
		$sbSql = "	SELECT DISTINCT tipoequipo.* 
					FROM sistema
						LEFT JOIN equipo ON equipo.sistemcodigo = sistema.sistemcodigo
						LEFT JOIN tipoequipo ON tipoequipo.tipequcodigo = equipo.tipequcodigo   
					WHERE  sistema.sistemcodigo IN ({$arrsistema}) AND tipoequipo.tipequcodigo IS NOT NULL ORDER BY tipoequipo.tipequnombre";
		$rsTipoequipo = fncsqlrun($sbSql, $idcon);
		$nrTipoequipo = fncnumreg($rsTipoequipo);
	}
?>	
<div style="width:648px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="50" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel<input type="checkbox" onclick="setSelectionAll('tipoequipo',','); <?php if($tipoequiporeport): ?>rldSubfunction(1);<?php endif ?>" value="1" name="alltipoequipo" id="alltipoequipo" <?php if($alltipoequipo) echo 'checked'; ?> ></td>
				<td width="583" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Tipo de equipo</td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>

<div style="width:648px; height: 150px; margin:0 auto;  overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:628px; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	if($nrTipoequipo):
		if($arrtipoequipo)
		{
			$array_tmp = explode(',',$arrtipoequipo);
			$array_key = array_flip($array_tmp);
		}
	
		for($a = 0; $a < $nrTipoequipo; $a++):
			$rwTipoequipo = fncfetch($rsTipoequipo, $a);
		
			($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
				
			if(is_array($array_key))
			{
				$checked = '';
				if(array_key_exists($rwTipoequipo['tipequcodigo'], $array_key) || $alltipoequipo)
					$checked = 'checked';
			}	
?>			
			<tr <?php echo $complement ?>">
				<td width="50" style=" border-bottom: 1px solid #fff;"><input type="checkbox" id="chktipoequipo" name="chktipoequipo" <?php echo $checked ?> onclick="setSelectionRow(this.value, document.getElementById('arrtipoequipo').value, ',', 'tipoequipo'); <?php if($tipoequiporeport): ?>rldSubfunction(1);<?php endif ?>" value="<?php echo $rwTipoequipo['tipequcodigo'] ?>"></td>
				<td width="580" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwTipoequipo['tipequnombre'] ?></td>
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

	unset($a, $b);
?>
		</table>
	</div>
</div>