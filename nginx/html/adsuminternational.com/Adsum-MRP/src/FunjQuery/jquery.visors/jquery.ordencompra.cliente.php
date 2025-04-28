<?php 
	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerPriNiv/pktblordencompra.php';
	endif;
	
	$idcon = fncconn();


	if($ordcomcodcli || $ordcomrazsoc ){
		$ircrecord['ordcomcodcli'] = $ordcomcodcli;
		$ircrecordop['ordcomcodcli'] = 'like';
		$ircrecord['ordcomrazsoc'] = $ordcomrazsoc;
		$ircrecordop['ordcomrazsoc'] = 'like';

		$rsCliente = dinamicscanopordencompracliente($ircrecord, $ircrecordop, $idcon, 1);

	}else{

		$rsCliente = fullscanordencompracliente($idcon);
	}

	if($rsCliente)
		$nrCliente = fncnumreg($rsCliente);
	
?>	
	
<div style="width:648px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="50" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel</td>
				<td width="150" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Nit</td>
				<td width="433" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Razon social</td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:648px; height: 150px; margin: 0 auto;overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:628px; height: auto;  z-index: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	if($nrCliente):
		if($arrclienteoc)
		{
			$array_tmp = explode(',',$arrclienteoc);
			$array_key = array_flip($array_tmp);
		}
	
		for($a = 0; $a < $nrCliente; $a++):
			$rwCliente = fncfetch($rsCliente, $a);

			if($a % 2)
				$complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"';
			else
				$complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
			
			if(is_array($array_key))
			{
				$checked = '';
				if(array_key_exists($rwCliente['ordcomcodcli'], $array_key) || $allclienteoc)
					$checked = 'checked';
			}	
?>			
			<tr <?php echo $complement; ?> >
				<td width="50" style="border-bottom: 1px solid #fff;"><input type="checkbox" id="chkclienteoc" name="chkclienteoc" <?php echo $checked ?> onclick="setSelectionRow(this.value, document.getElementById('arrclienteoc').value, ',', 'clienteoc'); " value="<?php echo $rwCliente['ordcomcodcli']; ?>"></td>
				<td width="150" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwCliente['ordcomcodcli']; ?></td>
				<td width="430" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwCliente['ordcomrazsoc'];?></td>
			</tr>
<?php
		endfor;
	endif;
	$a = 0;
	if($a < 13):
		for($b = $a; $b < 13; $b++):
			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class; ?>" >
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