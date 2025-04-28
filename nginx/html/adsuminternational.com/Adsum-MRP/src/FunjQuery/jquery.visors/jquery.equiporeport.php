<?php 
	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncsqlrun.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
	endif;
	
	$idcon = fncconn();
	
	if($arrtipoequipo && $arrusuaplanta)
	{
		$sbSql = "	SELECT DISTINCT equipo.equipocodigo, equipo.equiponombre, sistema.sistemnombre
					FROM tipoequipo
						INNER JOIN equipo ON equipo.tipequcodigo = tipoequipo.tipequcodigo
						INNER JOIN sistema ON sistema.sistemcodigo = equipo.sistemcodigo
					WHERE  sistema.plantacodigo IN ({$arrusuaplanta}) AND tipoequipo.tipequcodigo IN ({$arrtipoequipo}) ORDER BY sistema.sistemnombre";
		$rsEquipo = fncsqlrun($sbSql, $idcon);
		$nrEquipo = fncnumreg($rsEquipo);
		
	}
?>	
<div style="width:715px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="250" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Proceso</td>
				<td width="300" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Maquina</td>
				<td width="150" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Hrs. Operaci&oacute;n</td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>

<div style="width:715px; height: 200px; margin:0 auto;  overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:695px; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	if($nrEquipo)
	{
		for($a = 0; $a < $nrEquipo; $a++)
		{
			$rwEquipo = fncfetch($rsEquipo, $a);
		
			($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
			$hrOperacion = 'hroperacion_'.str_replace("-","_",$rwEquipo['equipocodigo']);
			
			$strCampos .= (($strCampos) ? "," : "").$hrOperacion;
			$strCodequ .= (($strCampos) ? "," : "").$rwEquipo['equipocodigo'];
?>			
			<tr <?php echo $complement ?>">
				<td width="250" style=" border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwEquipo['sistemnombre'] ?></td>
				<td width="300" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwEquipo['equiponombre'] ?></td>
				<td width="145" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;"><input type="text" name="<?php echo $hrOperacion ?>" id="<?php echo $hrOperacion ?>" value="<?php echo $$hrOperacion ?>"></td>
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
				<td width="250" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="300" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="145" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
		}
	}

	unset($a, $b);
?>
		</table>
		<input type="hidden" name="strcampos" id="strcampos" value="<?php echo $strCampos ?>">
		<input type="hidden" name="strcodequ" id="strcodequ" value="<?php echo $strCodequ ?>">
	</div>
</div>