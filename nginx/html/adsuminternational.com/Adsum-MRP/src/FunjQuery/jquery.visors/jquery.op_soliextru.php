<?php 

	if(!$noAjax)
	{
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerSecNiv/fncsqlrun.php';
		include '../../FunPerPriNiv/pktblpadreitem.php';
		include '../../FunGen/cargainput.php';
	}
	
?>
<div style="width:740px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="30" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel</td>
				<td width="40" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;OP</td>
				<td width="297" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Material</td>
				<td width="70" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Refile</td>
				<td width="130" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;<?php if ($campnomb["cantidad_"] == 1) {echo "<b style='font-size:15px; color:red;'>*</b>";}?>Cantidad producci&oacute;n</td>
				<td width="125" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;<?php if ($campnomb["ancho_"] == 1) {echo "<b style='font-size:15px; color:red;'>*</b>";}?>Ancho producci&oacute;n</td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:740px; height: 70px; overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:100%; height: auto;  z-index: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	$idcon = fncconn();
	if($arropsoliext) $arrObject = explode(':|:',$arropsoliext);
	for($a = 0;$a< count($arrObject);$a++){
		$arr = explode(':-:',$arrObject[$a]);
		$rwPadreitem = loadrecordpadreitem($arr[1],$idcon);
		//variables a usar
		$obj_cantidad = 'cantidad_'.$rwPadreitem['paditecodigo'].'_'.$a;
		$obj_ancho = 'ancho_'.$rwPadreitem['paditecodigo'].'_'.$a;
		$obj_refile = 'refile_'.$rwPadreitem['paditecodigo'].'_'.$a;
		$obj_ancho_lb = 'ancho_lb_'.$rwPadreitem['paditecodigo'].'_'.$a;
		//valor de las varibles
		$$obj_ancho = (!$$obj_ancho)? $arr[3] : $$obj_ancho;
		($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
?>
			<tr <?php echo $complement ?>">
				<td width="30" style=" border-bottom: 1px solid #fff;"><?php if(!$flagdetallar):?><input type="checkbox" name="chkarropsoliext" id="chkarropsoliext" value="<?php echo $arrObject[$a] ?>" onclick="setSelectionRow(this.value, document.getElementById('arropsoliexttmp').value, ',', 'arropsoliexttmp');" /><?php else:?>&nbsp;&nbsp;&nbsp;<b>X</b><?php endif;?></td>
				<td width="40" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $arr[0] ?></td>
				<td width="297" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwPadreitem['paditenombre']?> </td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php if(!$flagdetallar){?><input type="text" name="<?php echo $obj_refile ?>" id="<?php echo $obj_refile ?>" value="<?php echo $$obj_refile ?>" size="5" onkeyup="eventRefile('<?php echo $rwPadreitem['paditecodigo'] ?>','<?php echo $a ?>','<?php echo $arr[3] ?>');" /><?php }else{?><input type="hidden" name="<?php echo $obj_refile ?>" id="<?php echo $obj_refile ?>" value="<?php echo $$obj_refile ?>" /><?php echo $$obj_refile ?><?php } ?></td>
				<td width="129" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php if(!$flagdetallar){?><input type="text" name="<?php echo $obj_cantidad ?>" id="<?php echo $obj_cantidad ?>" value="<?php echo $$obj_cantidad ?>" size="5" /><?php }else{?><input type="hidden" name="<?php echo $obj_cantidad ?>" id="<?php echo $obj_cantidad ?>" value="<?php echo $$obj_cantidad ?>" /><?php echo $$obj_cantidad ?><?php } ?></td>
				<td width="124" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php if(!$flagdetallar){?><input type="hidden" name="<?php echo $obj_ancho ?>" id="<?php echo $obj_ancho ?>" value="<?php echo $$obj_ancho ?>" /><span id="<?php echo $obj_ancho_lb ?>"><?php echo $$obj_ancho ?></span><?php }else{?><input type="hidden" name="<?php echo $obj_ancho ?>" id="<?php echo $obj_ancho ?>" value="<?php echo $$obj_ancho ?>" /><?php echo $$obj_ancho ?><?php } ?></td>
			</tr>
<?php 
	}
	
	if($a < 5){
		for($b = $a; $b < 5; $b++){
			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="30" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="40" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="297" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="129" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="124" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
			}
		}
?>
		</table>
	</div>
</div>
<input type="hidden" name="arropsoliext" id="arropsoliext" size="60"value="<?php echo $arropsoliext ?>" />
<input type="hidden" name="arropsoliexttmp" id="arropsoliexttmp" size="60"value="<?php echo $arropsoliexttmp ?>" />