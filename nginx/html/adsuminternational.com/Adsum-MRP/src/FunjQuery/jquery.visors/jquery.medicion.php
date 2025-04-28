<?php 

	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerPriNiv/pktblequipo.php';
		include '../../FunPerPriNiv/pktbltipomedi.php';
		include '../../FunPerPriNiv/pktblmedidoequipo.php';
	endif;


?>


<div style="width:800px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="25" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel</td>
				<td width="250" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Equipo / Medidor</td>
				<td width="100" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Lectura Actual</td>
				<td width="100" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Lectura Anterior</td>
				<td width="100" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Dif. Lectura</td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:800px; height: 150px; overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:100%; height: auto;  z-index: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	if($arrmedicion):
		$array_tmp = explode(':|:',$arrmedicion);
		$idcon = fncconn();
		for($a = 0; $a < count($array_tmp); $a++):
			$rwArray_tmp = explode(':-:', $array_tmp[$a]);
			($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
			
			$rwmedidoEquipo = loadrecordmedidoequipo($rwArray_tmp[0],$idcon);
			$rwEquipo = loadrecordequipo($rwmedidoEquipo[equipocodigo],$idcon);
			$rwTipomedi = loadrecordtipomedi($rwmedidoEquipo[tipmedcodigo],$idcon);
			$equimed = $rwEquipo[equiponombre].' - '.$rwTipomedi[tipmednombre];
			
			$sql_l = "SELECT MAX(medicicantid) AS lectura FROM medicion WHERE medequcodigo = ".$rwArray_tmp[0];
			$rs_sql_l = pg_exec($idcon,$sql_l);
			if($rs_sql_l > 0)
				$rw_sql_l = fncfetch($rs_sql_l,0)
?>			
			<tr <?php echo $complement ?>">
				<td width="25" style=" border-bottom: 1px solid #fff;">&nbsp;&nbsp;<?php if(!$fladetallar):?><input type="checkbox" id="chkmedicion" name="chkmedicion" <?php echo $checked ?> onclick="setSelectionRow(this.value, document.getElementById('arrmedicion').value, ':|:', 'medicion');" value="<?php echo $array_tmp[$a] ?>"><?php else:?>&nbsp;<b>X</b><?php endif?></td>
				<td width="250" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $equimed ?> </td>
				<td width="100" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwArray_tmp[1] ?></td>
				<td width="100" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo ($rw_sql_l['lectura']) ? $rw_sql_l['lectura'] : 'SIN LECTURA'; ?></td>
				<td width="100" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo ($rw_sql_l['lectura'] - $rwArray_tmp[1] > 0 )? $rw_sql_l['lectura'] - $rwArray_tmp[1] : ($rw_sql_l['lectura'] - $rwArray_tmp[1])*-1;?></td>
			</tr>
<?php
		endfor;
	endif;
	
	if($a < 13):
		for($b = $a; $b < 13; $b++):
			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="25" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="250" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="100" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="100" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="100" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
			endfor;
		endif;	
?>
		</table>
	</div>
</div>
<input type="hidden" name="arrmedicion" id="arrmedicion" size="60"value="<?php echo $arrmedicion ?>" />