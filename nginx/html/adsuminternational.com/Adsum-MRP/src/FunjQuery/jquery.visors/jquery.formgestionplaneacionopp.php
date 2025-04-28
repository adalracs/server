<?php 

	include ("../../FunPerPriNiv/pktblplaneaitemdesa.php");
	include ("../../FunPerPriNiv/pktbloppitemdesa.php");
	include ("../../FunPerPriNiv/pktblpadreitem.php");
	include ("../../FunPerSecNiv/fncconn.php");
	include ("../../FunPerSecNiv/fncclose.php");
	include ("../../FunPerSecNiv/fncnumreg.php");
	include ("../../FunPerSecNiv/fncfetch.php");
	include ("../../FunPerSecNiv/fncsqlrun.php");
	include ("../../FunGen/cargainput.php");

	$idcon = fncconn();
	
	if($paditecodigo){

		$rwPadreitem = loadrecordpadreitem($paditecodigo,$idcon);

		if($rwPadreitem['paditekeylin'] > 0){

			//$paditekeylin = $rwPadreitem["paditekeylin"];

			if($rwPadreitem["paditekeylin"]) $arrObjsKeyLine = explode(",", $rwPadreitem["paditekeylin"]); else unset($arrObjsKeyLine);

			$paditekeylin_ = "";

			for($a = 0; $a < count($arrObjsKeyLine); $a++){

				$paditekeylin_ = ($paditekeylin_)? $paditekeylin_.",'".$arrObjsKeyLine[$a]."'" : "'".$arrObjsKeyLine[$a]."'";
			}


			$sql = "SELECT * FROM itemdesa WHERE keylinea IN ({$paditekeylin_}) ORDER BY (itedescalib,itedesancho) ";
			$rsItemdesa = fncsqlrun($sql,$idcon);
			$nrItemdesa = fncnumreg($rsItemdesa);
		}

	}

?>
<div style="width:900px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="30" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel</td>
				<td width="70" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Material</td>
				<td width="335" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Material</td>
				<td width="100" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Disponible.</td>
				<td width="100" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Consumo pdt.</td>
				<td width="250" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Saldo <b>FINAL</b></td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:900px; height: 350px; overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:100%; height: auto;  z-index: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 

	if($arrplaneacionopp){
		$array_tmp = explode(",",$arrplaneacionopp);
		$array_key = array_flip($array_tmp);
	}

	for($a = 0; $a < $nrItemdesa; $a++){

		$rwItemdesa = fncfetch($rsItemdesa,$a);
		$objConsumo = "consumo_".$rwItemdesa["itedescodigo"];

		if(is_array($array_key)){

			$checked = "";
			if(array_key_exists($rwItemdesa["itedescodigo"], $array_key)){
				$checked = "checked";
			}

		}

		($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';

		$rwPlaneaItemDesa = loadrecordplaneaitemdesasum($rwItemdesa["itedescodigo"], $idcon);
		$rwOppItemDesa = loadrecordoppitemdesasumopp($rwItemdesa["itedescodigo"], $idcon);
?>
			<tr <?php echo $complement; ?>>
				<td width="30" style=" border-bottom: 1px solid #fff;"><input type="checkbox" name="chkarrplaneacionopp" id="chkarrplaneacionopp" value="<?php echo $rwItemdesa['itedescodigo'] ?>" <?php echo $checked; ?> onclick="setSelectionRow(this.value, document.getElementById('arrplaneacionopp').value, ',', 'arrplaneacionopp');" /></td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItemdesa['itedescodigo']; ?></td>
				<td width="335" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItemdesa['itedesnombre']; ?>
				<td width="100" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwItemdesa['itedesinvent'], 2, ",", "."); ?> </td>
				<td width="100" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwPlaneaItemDesa["plaitecantid"], 2, ",", "."); ?></td>
				<td width="248" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwItemdesa["itedesinvent"] - $rwPlaneaItemDesa["plaitecantid"], 2, ",", "."); ?></td>
			</tr>
<?php
	}
	
	if($a < 30){

		for($b = $a; $b < 30; $b++){

			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class; ?>">
				<td width="30" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="335" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="100" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="100" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="248" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
			}
		}
?>
		</table>
	</div>
</div>