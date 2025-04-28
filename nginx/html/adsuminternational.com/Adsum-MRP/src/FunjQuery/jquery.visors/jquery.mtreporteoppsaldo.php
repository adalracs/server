<?php

	if(!$noAjax){

		include "../../FunGen/cargainput.php";
		include "../../FunPerSecNiv/fncconn.php";
		include "../../FunPerSecNiv/fncclose.php";
		include "../../FunPerSecNiv/fncfetch.php";
		include "../../FunPerSecNiv/fncsqlrun.php";
		include "../../FunPerPriNiv/pktbllote.php";
		include "../../FunPerSecNiv/fncnumreg.php";
		include "../../FunPerPriNiv/pktblsaldo.php";
		include "../../FunPerPriNiv/pktblitemdesa.php";
		include "../../FunPerPriNiv/pktblgestionoppreporte.php";
		include "../../FunPerPriNiv/pktblreporteoppreportepn.php";
		include "../../FunPerPriNiv/pktblgestionoppreportesaldo.php";
	}
	
?>
<div style="width:850px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="30" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel</td>
				<td width="70" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Item</td>
				<td width="325" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Material</td>
				<td width="40" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;# Bo.</td>
				<td width="90" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Kilos&nbsp;<b>(kgs)</b></td>
				<td width="90" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Metros&nbsp;<b>(mts)</b></td>
				<td width="80" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Lote</td>
				<td width="50" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Kgs</td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:850px; height: 95px; overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:100%; height: auto;  z-index: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 

	$idcon = fncconn();
	
	if($arrmatsaldo) $arrobjsmatsaldo = explode(":|:",$arrmatsaldo); else unset($arrobjsmatsaldo);

	for($a = 0;$a< count($arrobjsmatsaldo);$a++){

		$objReporteSaldo = "reportesaldo_".$arrobjsmatsaldo[$a];
		$rowarrmatsaldo = explode(":-:",$arrobjsmatsaldo[$a]);

		($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';

		if($rowarrmatsaldo[1] == "2"){

			$rwGestionoppreportesaldo = loadrecordgestionoppreportesaldo($rowarrmatsaldo[0],$idcon);
			$rwSaldo = loadrecordsaldo($rwGestionoppreportesaldo["saldocodigo"],$idcon);
			$rwItemdesa = loadrecorditemdesa($rwSaldo["itedescodigo"],$idcon);
			$rwLote = loadrecordlote($rwSaldo["lotecodigo"],$idcon);
?>
			<tr <?php echo $complement ?> >
				<td width="30" style=" border-bottom: 1px solid #fff;"><input type="checkbox" name="chkarrmatsaldo" id="chkarrmatsaldo" value="<?php echo $arrobjsmatsaldo[$a]; ?>" onclick="setSelectionRow(this.value, document.getElementById('arrmatsaldotmp').value, ':|:', 'arrmatsaldotmp');" /></td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItemdesa["itedescodigo"]."::SL"; ?></td>
				<td width="325" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItemdesa["itedesnombre"]; ?> </td>
				<td width="40" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;---</td>
				<td width="90" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwSaldo["saldocantkgs"], 2, ",", "."); ?></td>
				<td width="90" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwSaldo["saldocantmts"], 2, ",", "."); ?></td>
				<td width="78" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwLote["lotenumero"]; ?></td>
				<td width="50" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<input type="text" name="<?php echo $objReporteSaldo; ?>" id="<?php echo $objReporteSaldo; ?>" value="<?php echo $$objReporteSaldo; ?>" size="5" class="<?php if($campnomb[$objReporteSaldo] == 1) echo 'ui-state-error ui-corner-all'; ?>" /></td>
			</tr>
<?php

		}elseif($rowarrmatsaldo[1] == "1"){

			$rwReporteoppreportepn = loadrecordreporteoppreportepn($rowarrmatsaldo[0],$idcon);
?>
			<tr <?php echo $complement ?> >
				<td width="30" style=" border-bottom: 1px solid #fff;"><input type="checkbox" name="chkarrmatsaldo" id="chkarrmatsaldo" value="<?php echo $arrobjsmatsaldo[$a]; ?>" onclick="setSelectionRow(this.value, document.getElementById('arrmatsaldotmp').value, ':|:', 'arrmatsaldotmp');" /></td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $produccoduno."::PR"; ?></td>
				<td width="325" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $producnombre; ?> </td>
				<td width="40" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwReporteoppreportepn["gesoppnorollo"]; ?></td>
				<td width="90" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwReporteoppreportepn["reoppncantkg"], 2, ",", "."); ?></td>
				<td width="90" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwReporteoppreportepn["reoppncantmt"], 2, ",", "."); ?></td>
				<td width="78" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $solprocodigo."-".$ordoppcodigo."-".$rwReporteoppreportepn["repoppcodigo"]; ?></td>
				<td width="50" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<input type="text" name="<?php echo $objReporteSaldo; ?>" id="<?php echo $objReporteSaldo; ?>" value="<?php echo $$objReporteSaldo; ?>" size="5" class="<?php if($campnomb[$objReporteSaldo] == 1) echo 'ui-state-error ui-corner-all'; ?>" /></td>
			</tr>
<?php 	
		}elseif($rowarrmatsaldo[1] == "0"){

			$rwGestionoppreporte = loadrecordgestionoppreporte($rowarrmatsaldo[0],$idcon);
			$rwItemdesa = loadrecorditemdesa($rwGestionoppreporte["itedescodigo"],$idcon);
			$rwLote = loadrecordlote($rwGestionoppreporte["lotecodigo"],$idcon);
?>
			<tr <?php echo $complement ?> >
				<td width="30" style=" border-bottom: 1px solid #fff;"><input type="checkbox" name="chkarrmatsaldo" id="chkarrmatsaldo" value="<?php echo $arrobjsmatsaldo[$a]; ?>" onclick="setSelectionRow(this.value, document.getElementById('arrmatsaldotmp').value, ':|:', 'arrmatsaldotmp');" /></td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItemdesa["itedescodigo"]."::MT"; ?></td>
				<td width="325" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItemdesa["itedesnombre"]; ?> </td>
				<td width="40" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwGestionoppreporte["gesoppnorollo"]; ?></td>
				<td width="90" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwGestionoppreporte["gesoppcantkg"], 2, ",", "."); ?></td>
				<td width="90" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwGestionoppreporte["gesoppcantmt"], 2, ",", "."); ?></td>
				<td width="78" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwLote["lotenumero"]; ?></td>
				<td width="50" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<input type="text" name="<?php echo $objReporteSaldo; ?>" id="<?php echo $objReporteSaldo; ?>" value="<?php echo $$objReporteSaldo; ?>" size="5" class="<?php if($campnomb[$objReporteSaldo] == 1) echo 'ui-state-error ui-corner-all'; ?>" /></td>
			</tr>
<?php 
		}

	}
	
	if($a < 20){

		for($b = $a; $b < 20; $b++){

			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="30" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="325" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="40" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="90" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="90" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="78" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="50" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
		}
	}
?>
		</table>
	</div>
</div>