<?php 
	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerPriNiv/pktblpedidoventa.php';
	endif;
	
	$idcon = fncconn();

	if($pedvencodven || $pedvenvendedor ){
		$ircrecord['pedvencodven'] = $pedvencodven;
		$ircrecordop['pedvencodven'] = 'like';
		$ircrecord['pedvenvendedor'] = $pedvenvendedor;
		$ircrecordop['pedvenvendedor'] = 'like';

		$rsVendedor = dinamicscanoppedidoventavendedor($ircrecord, $ircrecordop, $idcon, 1);

	}else{

		$rsVendedor = fullscanpedidoventavendedor($idcon);
	}

	if($rsVendedor)
		$nrVendedor = fncnumreg($rsVendedor);
?>	
	
<div style="width:648px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="50" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel</td>
				<td width="150" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Cod.</td>
				<td width="433" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Vendedor</td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:648px; height: 150px; margin: 0 auto;overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:628px;z-index: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	if($nrVendedor):

		if($arrvendedorpv)
		{
			$array_tmp = explode(',',$arrvendedorpv);
			$array_key = array_flip($array_tmp);
		}
	
		for($a = 0; $a < $nrVendedor; $a++):
			$rwVendedor = fncfetch($rsVendedor, $a);
		
			if($a % 2)
				$complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"';
			else
				$complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
			
			if(is_array($array_key))
			{
				$checked = '';
				if(array_key_exists($rwVendedor['pedvencodven'], $array_key) || $allvendedorpv)
					$checked = 'checked';
			}	
?>			
			<tr <?php echo $complement ?> >
				<td width="50" style=" border-bottom: 1px solid #fff;"><input type="checkbox" id="chkvendedorpv" name="chkvendedorpv" <?php echo $checked ?> onclick="setSelectionRow(this.value, document.getElementById('arrvendedorpv').value, ',', 'vendedorpv'); " value="<?php echo $rwVendedor['pedvencodven']; ?>"></td>
				<td width="150" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwVendedor['pedvencodven']; ?></td>
				<td width="430" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwVendedor['pedvenvendedor']; ?></td>
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
				<td width="150" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="430" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
			endfor;
		endif;	
?>
		</table>
	</div>
</div>