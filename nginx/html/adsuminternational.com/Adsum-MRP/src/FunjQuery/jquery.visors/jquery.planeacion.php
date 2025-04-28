<?php 
ini_set("display_errors", 1);
	include ("../../FunPerPriNiv/pktblplaneaitemdesa.php");
	include ("../../FunPerPriNiv/pktblprocedimiento.php");
	include ("../../FunPerPriNiv/pktbloppitemdesa.php");
	include ("../../FunPerPriNiv/pktblpadreitem.php");
	include ("../../FunPerSecNiv/fncnumreg.php");
	include ("../../FunPerSecNiv/fncsqlrun.php");
	include ("../../FunPerSecNiv/fncclose.php");
	include ("../../FunPerSecNiv/fncfetch.php");
	include ("../../FunPerSecNiv/fncconn.php");
	include ("../../FunGen/cargainput.php");

	$idcon = fncconn();

	if($paditecodigo){

		$rwPadreitem = loadrecordpadreitem($paditecodigo,$idcon);

		if($rwPadreitem['paditekeylin'] > 0){

			if($rwPadreitem["paditekeylin"]) $arrObjsKeyLine = explode(",", $rwPadreitem["paditekeylin"]); else unset($arrObjsKeyLine);

			$paditekeylin_ = "";

			for($a = 0; $a < count($arrObjsKeyLine); $a++){

				$paditekeylin_ = ($paditekeylin_)? $paditekeylin_.",'".$arrObjsKeyLine[$a]."'" : "'".$arrObjsKeyLine[$a]."'";
			}

			$sql = "SELECT * FROM itemdesa where keylinea::text IN (".$paditekeylin_.") order by (itedescalib,itedesancho) ";

			$rsItemdesa = fncsqlrun($sql,$idcon);
			$nrItemdesa = fncnumreg($rsItemdesa);
		}
	}
?>
<span id="mensaje"></span>
<div style="width:900px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="30" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel</td>
				<td width="70" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Material</td>
				<td width="335" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Material</td>
				<td width="100" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Disponible.</td>
				<td width="100" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Consumo pdt.</td>
				<td width="100" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Saldo <b>FINAL</b></td>
				<td width="150" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Proceso</td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:900px; height: 350px; overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:100%; height: auto;  z-index: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	for($a = 0;$a< $nrItemdesa;$a++){

		$rwItemdesa = fncfetch($rsItemdesa,$a);
		$objConsumo = 'consumo_'.$rwItemdesa['itedescodigo'];
		$objProcedimiento = 'procedimiento_'.$rwItemdesa['itedescodigo'];

		($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';

		$rwPlaneaItemDesa = loadrecordplaneaitemdesasum($rwItemdesa["itedescodigo"], $idcon);
		$rwOppItemDesa = loadrecordoppitemdesasumopp($rwItemdesa["itedescodigo"], $idcon);
?>
			<tr <?php echo $complement ?>>
				<td width="30" style=" border-bottom: 1px solid #fff;"><?php if(!$flagdetallar):?><input type="checkbox" name="chkarrplan" id="chkarrplan" value="<?php echo $rwItemdesa['itedescodigo'] ?>" <?php echo $checked ?> onclick="setSelectionRow(this.value, document.getElementById('arrplan').value, ',', 'arrplan');" /><?php else:?>&nbsp;&nbsp;&nbsp;<b>X</b><?php endif;?></td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItemdesa['itedescodigo']; ?></td>
				<td width="335" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItemdesa['itedesnombre']; ?>
				<td width="100" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwItemdesa['itedesinvent'], 2, ",", "."); ?> </td>
				<td width="100" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwPlaneaItemDesa["plaitecantid"], 2, ",", "."); ?></td>
				<td width="100" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format(($rwEstatusMat["itedesinvent"] + $rwOppItemDesa["oppitecantid"]) - $rwPlaneaItemDesa["plaitecantid"], 2, ",", "."); ?></td>
				<td width="148" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<small>
					<select name="<?php echo $objProcedimiento ?>" id="<?php echo $objProcedimiento ?>">
						<option value="">--Seleccione--</option>
							<?php 
								include_once('../../FunGen/floadprocedimiento.php');
								floadprocedimiento2($$objProcedimiento,$arrrutaitem,$idcon);
							?>

						<option value="15" >EPT</option>
					</select></small>
				</td>
			</tr>
<?php
	}
	
	if($a < 20){
		for($b = $a; $b < 20; $b++){
			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="30" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="335" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="100" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="100" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="100" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="148" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
			}
		}
?>
		</table>
	</div>
</div>
<input type="hidden" name="arrplan" id="arrplan" size="60" value="<?php echo $arrplan ?>" />
<input type="hidden" name="paditecodigo" id="paditecodigo" value="<?php echo $paditecodigo; ?>">