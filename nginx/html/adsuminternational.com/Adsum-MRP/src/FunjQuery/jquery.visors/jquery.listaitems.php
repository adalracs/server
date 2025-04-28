<?php 
ini_set("display_erros", 1);
	include_once ( "../../FunPerPriNiv/pktbloppitemdesa.php");
	include_once ( "../../FunPerPriNiv/pktblitemdesa.php");
	include_once ( "../../FunPerPriNiv/pktblpadreitem.php");
	include_once ( "../../FunPerPriNiv/pktblsaldo.php");
	include_once ( "../../FunPerSecNiv/fncnumreg.php");
	include_once ( "../../FunPerSecNiv/fncclose.php");
	include_once ( "../../FunPerSecNiv/fncfetch.php");
	include_once ( "../../FunPerSecNiv/fncconn.php");

	$idcon = fncconn();	

	if($tipsolcodigo != 1 && $tipsolcodigo > 0){

		$rsOppitemdesa = dinamicscanopoppitemdesa(array( "ordoppcodigo" => $ordoppcodigo),array("ordoppcodigo" => '='),$idcon);
	}

	if($itedescodigo || $itedesancho || $itedescalib || $tipsolcodigo){

		$record["saldo.itedescodigo"] = $itedescodigo;
		$recordop["saldo.itedescodigo"] = "like";
		$record["itemdesa.itedesancho"] = $itedesancho;
		$recordop["itemdesa.itedesancho"] = "=";
		$record["itemdesa.itedescalib"] = $itedescalib;
		$recordop["itemdesa.itedescalib"] = "=";
		$record["tipestcodigo"] = 1;//disponible
		$recordop["tipestcodigo"] = "=";
		$record["saldotipoinv"] = ($tipsolcodigo > 1)? 1 : 2 ;
		$recordop["saldotipoinv"] = "=";
		$rsSaldo = dinamicscanopsaldo1($record, $recordop, $idcon);

	}else{

		$record["tipestcodigo"] = 1;//disponible
		$recordop["tipestcodigo"] = "=";
		$rsSaldo = dinamicscanopsaldo($record, $recordop, $idcon);
	}
	
	if($rsSaldo){//consulta de saldos

		$nrSaldo = fncnumreg($rsSaldo);	 
	}

	if($rsOppitemdesa){//consulta de material a asignar
		$nrOppitemdesa = fncnumreg($rsOppitemdesa); 
	}

?>	
<div style="width:970px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="50" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel</td>
				<td width="50" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Codigo</td>
				<td width="350" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Nombre</td>
				<td width="80" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Ancho&nbsp;<b>(mm)</b></td>
				<td width="80" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Calibre&nbsp;<b>(&micro;m)</b></td>
				<td width="80" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Ubicacion</td>
				<td width="80" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Posicion</td>
				<td width="80" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Metros</td>
				<td width="80" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Kilogramos</td>
				<td width="20" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:970px; height: 150px; margin:0 auto; overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:950px; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	if($nrSaldo > 0){//listado de saldos a asignar

		if($arritem){

			$array_tmp = explode(":|:",$arritem);
			$array_key = array_flip($array_tmp);
		}
	
		for($a = 0; $a < $nrSaldo; $a++){

			$rwSaldo = fncfetch($rsSaldo, $a);
			$rwItemdesa = loadrecorditemdesa($rwSaldo["itedescodigo"],$idcon);
			$idcheck = $rwItemdesa["itedescodigo"].":-:t:-:".$rwSaldo['saldocodigo'];
			($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
				
			if(is_array($array_key)){

				$checked = '';

				if( array_key_exists($idcheck, $array_key) ){
					$checked = 'checked';
				}
			}
?>			
			<tr <?php echo $complement ?> >
				<td width="50" style=" border-bottom: 1px solid #fff;"><input type="checkbox" id="chkitem" name="chkitem" <?php echo $checked; ?> value="<?php echo $idcheck; ?>" onclick="setSelectionRow(this.value, document.getElementById('arritem').value, ':|:', 'arritem');" /></td>
				<td width="50" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwSaldo["itedescodigo"]; ?></td>
				<td width="350" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItemdesa["itedesnombre"]; ?>&nbsp;{Saldo}</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwItemdesa["itedesancho"], 2, ",", "."); ?></td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwItemdesa["itedescalib"], 2, ",", "."); ?></td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo ($rwSaldo["saldoubicaci"])? $rwSaldo["saldoubicaci"]: "---" ;  ?></td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo ($rwSaldo["saldoposicio"])? $rwSaldo["saldoposicio"]: "---" ;  ?></td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwSaldo["saldocantmts"], 2, ",", "."); ?></td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwSaldo["saldocantkgs"], 2, ",", "."); ?></td>
			</tr>
<?php
		}
	}
	
	if($nrOppitemdesa > 0){//listado de necesidad de produccion

		if($arritem){

			$array_tmp = explode(":|:",$arritem);
			$array_key = array_flip($array_tmp);
		}

		for($b = 0; $b < $nrOppitemdesa; $b++){

			$rwOppitemdesa = fncfetch($rsOppitemdesa, $b);
			$rwItemdesa = loadrecorditemdesa($rwOppitemdesa["itedescodigo"],$idcon);
			$rwPadreitem = loadrecordpadreitemxkeylinea($rwItemdesa['keylinea'],$idcon);
			//FORMULA DE METROS VULTIMA 20130827 
			$oppitecantmt = ( $rwItemdesa['itedesinvent'] / ($rwItemdesa['itedesancho'] * $rwItemdesa['itedescalib'] * $rwPadreitem['paditedensid']) ) * 1000000 ;

			$idcheck = $rwOppitemdesa["itedescodigo"].":-:f";
			($b % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';

			if(is_array($array_key)){

				$checked = '';

				if( array_key_exists($idcheck, $array_key) ){
					$checked = 'checked';
				}
			}
?>
			<tr <?php echo $complement ?> >
				<td width="50" style=" border-bottom: 1px solid #fff;"><input type="checkbox" id="chkitem" name="chkitem" <?php echo $checked; ?> value="<?php echo $idcheck; ?>" onclick="setSelectionRow(this.value, document.getElementById('arritem').value, ':|:', 'arritem');" /></td>
				<td width="50" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItemdesa["itedescodigo"]; ?></td>
				<td width="350" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItemdesa["itedesnombre"]; ?>&nbsp;{Inventario}</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwItemdesa["itedesancho"], 2, ",", "."); ?></td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwItemdesa["itedescalib"], 2, ",", "."); ?></td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;---</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;---</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($oppitecantmt, 2, ",", "."); ?></td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwItemdesa["itedesinvent"], 2, ",", "."); ?></td>
			</tr>
<?php

		}
	}

	if( ($a + $b) < 13 ){

		for( $c = ($a + $b); $c < 13; $c++){

			($c % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="50" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="50" style=" border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="350" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
			}
		}
?>
		</table>
	</div>
</div>
