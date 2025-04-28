<?php 

	if(!$noAjax)
	{
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerSecNiv/fncsqlrun.php';
		include '../../FunPerPriNiv/pktblitemdesa.php';
		include '../../FunPerPriNiv/pktblprocedimiento.php';
		include '../../FunGen/cargainput.php';
	}
	
?>
<div style="width:740px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="30" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel</td>
				<td width="55" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Item</td>
				<td width="263" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Proceso</td>
				<td width="50" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;<?php if ($campnomb["anchomaterial_"] == 1) {echo "<b style='font-size:15px; color:red;'>*</b>";}?>Ancho</td>
				<td width="60" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;<?php if ($campnomb["anchocorte_"] == 1) {echo "<b style='font-size:15px; color:red;'>*</b>";}?>Ancho(c)</td>
				<td width="70" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;<?php if ($campnomb["diferenciamm_"] == 1) {echo "<b style='font-size:15px; color:red;'>*</b>";}?>Dif. <b>(mm)</b></td>
				<td width="70" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;<?php if ($campnomb["diferenciakg_"] == 1) {echo "<b style='font-size:15px; color:red;'>*</b>";}?>Dif. <b>(kg)</b></td>
				<td width="100" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;<?php if ($campnomb["proceddestin_"] == 1) {echo "<b style='font-size:15px; color:red;'>*</b>";}?>Destino.</td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:740px; height: 70px; overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:100%; height: auto;  z-index: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	unset($arrObject);$idcon = fncconn();

	if($arrtarsoliextru) $arrObject = explode(':|:',$arrtarsoliextru);

	for($a = 0;$a< count($arrObject);$a++){
		$rowsObject = explode(':-:',$arrObject[$a]);
		$rwItemdesa = loadrecorditemdesa($rowsObject[0],$idcon);
		$rwProcedimiento = loadrecordprocedimiento($rowsObject[1],$idcon);
		//objetos a utilizar
		$anchomaterial_ = 'anchomaterial_'.$arrObject[$a];
		$anchocorte_ = 'anchocorte_'.$arrObject[$a];
		$diferenciamm_ = 'diferenciamm_'.$arrObject[$a];
		$lbl_diferenciamm_ = 'lbl_diferenciamm_'.$arrObject[$a];
		$diferenciakg_ = 'diferenciakg_'.$arrObject[$a];
		$lbl_diferenciakg_ = 'lbl_diferenciakg_'.$arrObject[$a];
		$proceddestin_ = 'proceddestin_'.$arrObject[$a];
		//asignacion
		$$anchomaterial_ = ($rwItemdesa['itedesancho'] > 0)? $rwItemdesa['itedesancho'] : '0' ;
		($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
?>
			<tr <?php echo $complement ?>">
				<td width="30" style=" border-bottom: 1px solid #fff;"><?php if(!$flagdetallar):?><input type="checkbox" name="chkarrtarsoliextru" id="chkarrtarsoliextru" value="<?php echo $arrObject[$a]; ?>" onclick="setSelectionRow(this.value, document.getElementById('arrtarsoliextrutmp').value, ',', 'arrtarsoliextrutmp');" /><?php else:?>&nbsp;&nbsp;&nbsp;<b>X</b><?php endif;?></td>
				<td width="55" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItemdesa['itedescodigo']; ?></td>
				<td width="263" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwProcedimiento['procednombre'];//$rwItemdesa['itedesnombre']?> </td>
				<td width="50" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<input type="hidden" name="<?php echo $anchomaterial_ ?>" id="<?php echo $anchomaterial_ ?>" value="<?php echo $$anchomaterial_ ?>" /><?php echo ($$anchomaterial_)? $$anchomaterial_ : '0' ; ?></td>
				<td width="60" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<input type="text" name="<?php echo $anchocorte_ ?>" id="<?php echo $anchocorte_ ?>" value="<?php echo $$anchocorte_?>" size="5" onkeyup="eventAnchoc(this.value,'<?php echo $arrObject[$a]; ?>');" /></td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<input type="hidden" name="<?php echo $diferenciamm_ ?>" id="<?php echo $diferenciamm_ ?>" value="<?php echo $$diferenciamm_ ?>" /><span id="<?php echo $lbl_diferenciamm_ ?>"> <?php echo ($$diferenciamm_)? $$diferenciamm_ : '0' ;  ?></span></td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<input type="hidden" name="<?php echo $diferenciakg_ ?>" id="<?php echo $diferenciakg_ ?>" value="<?php echo $$diferenciakg_ ?>" /><span id="<?php echo $lbl_diferenciakg_ ?>"> <?php echo ($$diferenciakg_)? round($$diferenciakg_ * 100) / 100 : '0' ;  ?></span></td>
				<td width="98" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;
					<small>
					<select name="<?php echo $proceddestin_ ?>" id="<?php echo $proceddestin_ ?>" >
						<option value="">--Sel.</option>
						<option value="tirilla" <?php if($$proceddestin_ == 'tirilla'){echo 'selected';}?> >Tirilla</option>
			  			<option value="extra_ancho" <?php if($$proceddestin_ == 'extra_ancho'){echo 'selected';}?> >Extra-ancho</option>
			  			<option value="item" <?php if($$proceddestin_ == 'item'){echo 'selected';}?>>Item</option>
					</select>
					</small>
				</td>
			</tr>
<?php 
	}
	
	if($a < 5){
		for($b = $a; $b < 5; $b++){
			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="30" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="55" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="263" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="50" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="60" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="98" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
			}
		}
?>
		</table>
	</div>
</div>