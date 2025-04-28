<?php 

	if(!$noAjax)
	{
		include "../../FunPerPriNiv/pktblitemdesa.php";
		include "../../FunPerPriNiv/pktblsaldo.php";
		include "../../FunPerSecNiv/fncsqlrun.php";
		include "../../FunPerPriNiv/pktbllote.php";
		include "../../FunPerSecNiv/fncnumreg.php";
		include "../../FunPerSecNiv/fncclose.php";
		include "../../FunPerSecNiv/fncfetch.php";
		include "../../FunPerSecNiv/fncconn.php";
		include "../../FunGen/cargainput.php";
		include_once("../../FunGen/floadlotesaldo.php");
	}

	$nrl;
	
?>
<div style="width:800px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="30" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel</td>
				<td width="60" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;No.Rollo</td>
				<td width="50" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Item</td>
				<td width="400" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Material</td>
				<td width="120" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;No.Lote</td>
				<td width="80" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Peso<small>(kgs)</small></td>
				<td width="20" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:800px; height: 95px; overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:100%; height: auto;  z-index: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	$idcon = fncconn();	
	unset($arrObject);
	if($arrbobina) $arrObject = explode(":|:",$arrbobina);

	for($a = 0;$a< count($arrObject);$a++){

		$rowObject = explode(":-:",$arrObject[$a]);
		$obj_consumo = "consumokg_".$arrObject[$a];
		$obj_lote = "nolote_".$arrObject[$a];

		if($rowObject[1] == 't'){
			($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
			$rwSaldo = loadrecordsaldo($rowObject[2],$idcon);
			$rwItemdesa = loadrecorditemdesa($rwSaldo["itedescodigo"],$idcon);
			$rwLote = loadrecordlote($rwSaldo["lotecodigo"],$idcon);
?>
			<tr <?php echo $complement ?> >
				<td width="30" style=" border-bottom: 1px solid #fff;"><?php if(!$flagdetallar):?><input type="checkbox" name="chkarrbobina" id="chkarrbobina" value="<?php echo $arrObject[$a]; ?>" onclick="setSelectionRow(this.value, document.getElementById('arrbobinatmp').value, ':|:', 'arrbobinatmp');" /><?php else:?>&nbsp;&nbsp;&nbsp;<b>X</b><?php endif;?></td>
				<td width="60" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo "---" ?></td>
				<td width="50" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItemdesa["itedescodigo"]; ?> </td>
				<td width="400" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItemdesa["itedesnombre"]; ?>&nbsp;{Saldo}&nbsp;<?php echo "[".$rwSaldo['saldoubicaci']." - ".$rwSaldo['saldoposicio']."]"; ?></td>
				<td width="120" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwLote["lotenumero"]; ?></td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwSaldo["saldocantkgs"], 2, ",", "."); ?></td>
			</tr>
<?php 
		}else{
			($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
			$rwItemdesa = loadrecorditemdesa($rowObject[0],$idcon);
			$itedescodigo = $rwItemdesa["itedescodigo"];

			//var_dump($obj_lote, $itedescodigo, "--".$$obj_lote);
			$nrl++;
?>
			<tr <?php echo $complement ?> >
				<td width="30" style=" border-bottom: 1px solid #fff;"><?php if(!$flagdetallar):?><input type="checkbox" name="chkarrbobina" id="chkarrbobina" value="<?php echo $arrObject[$a]; ?>" onclick="setSelectionRow(this.value, document.getElementById('arrbobinatmp').value, ':|:', 'arrbobinatmp');" /><?php else:?>&nbsp;&nbsp;&nbsp;<b>X</b><?php endif;?></td>
				<td width="60" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $nrl."/".$nrll; ?></td>
				<td width="50" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItemdesa["itedescodigo"]; ?> </td>
				<td width="400" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItemdesa["itedesnombre"]; ?>&nbsp;{Inventario}&nbsp;</td>
				<td width="120" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;
					<?php if(!$flagdetallar){?>
						<select name="<?php echo $obj_lote; ?>" id="<?php echo $obj_lote; ?>" class="<?php if($campnomb[$obj_lote] == 1) echo 'ui-state-error ui-corner-all'; ?>" >
							<option value="">--Seleccione--</option>
							<option value="1" <?php if($$obj_lote == "1"){ echo "selected"; }?>>Prueba</option>
							<?php
								floadlotesaldo1($$obj_lote, $itedescodigo, $idcon);
							?>
						</select>
					<?php }else{?>
						<input type="hidden" name="<?php echo $obj_lote; ?>" id="<?php echo $obj_lote; ?>" value="<?php echo $$obj_lote; ?>" class="<?php if($campnomb[$obj_lote] == 1) echo 'ui-state-error ui-corner-all'; ?>" /><?php echo $$obj_lote; ?>
					<?php } ?>
				</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php if(!$flagdetallar){?><input type="text" name="<?php echo $obj_consumo; ?>" id="<?php echo $obj_consumo; ?>" value="<?php echo $$obj_consumo; ?>" class="<?php if($campnomb[$obj_consumo] == 1) echo 'ui-state-error ui-corner-all'; ?>" size="8" /><?php }else{?><input type="hidden" name="<?php echo $obj_consumo; ?>" id="<?php echo $obj_consumo; ?>" value="<?php echo $$obj_consumo; ?>" class="<?php if($campnomb[$obj_consumo] == 1) echo 'ui-state-error ui-corner-all'; ?>" /><?php echo number_format($$obj_consumo, 2, ",", "."); ?><?php } ?></td>
			</tr>
<?php

		}
}
	
	if($a < 5){
		for($b = $a; $b < 9; $b++){
			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="30" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="60" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="50" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="400" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="120" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
		}
	}
?>
		</table>
	</div>
</div>
<input type="hidden"  name="nrll" value="<?php echo $nrll; ?>" />