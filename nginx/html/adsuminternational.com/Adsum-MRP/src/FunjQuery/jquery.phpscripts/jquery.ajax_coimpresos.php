<?php if($estado == 'inicio'):?>

<?php 

	if(!$noAjax):
		include_once ('../../FunPerSecNiv/fncconn.php');
		include_once ('../../FunPerSecNiv/fncclose.php');
		include_once ('../../FunPerSecNiv/fncnumreg.php');
		include_once ('../../FunPerSecNiv/fncfetch.php');
		include_once ('../../FunPerPriNiv/pktblpadreitem.php');
		include_once ('../../FunGen/floadpadreitem.php');
	endif;

?>
<p class="validateTips">Todos los campos son necesarios.</p>


	<table width="350" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="40%" class="NoiseFooterTD">&nbsp;Rodillo (mm)</td>
			<td width="60%" class="NoiseDataTD"><input type="text" name="largo" id="largo" class="text ui-widget-content ui-corner-all"/></td>
		</tr>
		<tr>
			<td width="40%"  class="NoiseFooterTD">&nbsp;Colores</td>
			<td width="60%" class="NoiseDataTD"><input type="text" name="color" id="color" class="text ui-widget-content ui-corner-all"/></td>
		</tr>
		<tr>
			<td width="40%" class="NoiseFooterTD">&nbsp;Material</td>
			<td width="60%" class="NoiseDataTD"><select name="estruc" id="estruc" class="text ui-widget-content ui-corner-all">
			<option value="">--Seleccione--</option> 
			<?php 
			$idcon = fncconn();
			floadpadreitem($material,$idcon);
			?>
			</select>
			</td>
		</tr>
		<tr>
			<td width="40%" class="NoiseFooterTD">&nbsp;Calibre</td>
			<td width="60%" class="NoiseDataTD"><input type="text" name="calib" id="calib" class="text ui-widget-content ui-corner-all"/></td>
		</tr>
</table>


<?php else:?>
<p><font class="NoiseFormHeaderFont">Bandeja coimpresos</font></p> 
<div style="width:950px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="50" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel</td>
				<td width="80" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Grupo</td>
				<td width="80" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Item</td>
				<td width="80" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;PV</td>
				<td width="80" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Cliente</td>
				<td width="80" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Ref.</td>
				<td width="80" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Colores</td>
				<td width="80" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Estructura</td>
				<td width="80" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Pistas Dist.</td>
				<td width="80" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Rodillo</td>
				<td width="80" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Kg</td>
				<td width="80" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Fecha Ent.</td>
				<td width="20" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>

<div style="width:950px; height: 150px; overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:100%; height: auto;  z-index: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	if($arrtabla1):
		$array_tmp = explode(':|:',$arrtabla1);
		$idcon = fncconn();
		for($a = 0; $a < count($array_tmp); $a++):
			$rwArray_tmp = explode(':-:', $array_tmp[$a]);
			($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
			
			$rwItem = loadrecorditemventas($rwArray_tmp[0],$idcon);
			$objColor = 'color_'.$rwArray_tmp[0];
			
			$objNombre = 'objnombre_'.$rwArray_tmp[0];
			$$objNombre = $rwItem['itevennombre'];
			
			$total_gramaje += ($rwArray_tmp[2] * $rwArray_tmp[1]);
			$total_calibre += $rwArray_tmp[2];
			
			
			
?>			
			<tr <?php echo $complement ?>">
				<td width="50" style=" border-bottom: 1px solid #fff;"><?php if(!$flagdetallar):?><input type="checkbox" id="chktabla1" name="chktabla1" <?php echo $checked ?> onclick="setSelectionRow(this.value, document.getElementById('arrtabla1').value, ':|:', 'tabla1');" value="<?php echo $array_tmp[$a] ?>"><?php else:?>&nbsp;&nbsp;&nbsp;<b>X</b><?php endif;?></td>
				<td width="100" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="100" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="100" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="100" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="100" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="100" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="100" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="100" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="100" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="100" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="98" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
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
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="82" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
			endfor;
		endif;	
?>
		</table>
	</div>
</div>
<?php endif;?>