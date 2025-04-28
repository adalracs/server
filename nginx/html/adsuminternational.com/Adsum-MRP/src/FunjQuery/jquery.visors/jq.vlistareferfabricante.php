<?php 
	if(!$noAjax)
	{
		
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerSecNiv/fncsqlrun.php';
		include '../../FunPerPriNiv/pktblfabricante.php';
		
			$idcon = fncconn();
			$rsfabricante = fullscanfabricante($idcon);
			$nrfabricante=fncnumreg($rsfabricante,$idcon);
	}

	$a = 0;
	$b = 0;
?>	
<div style="width:675px; height: 18px; margin:0 auto;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="50" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel<input type="checkbox" value="1" name="alllistrefequipo" id="alllistrefequipo" <?php if(isset($alllistrefequipo)) echo 'checked'; ?> ></td>
				<td width="250" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Razon social</td>
				<td width="180" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Nit</td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>

<div style="width:675px; height: 200px; margin:0 auto; overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:656px; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	if($nrfabricante)
	{
		$array_key = null;
		
		if(isset($arrlistreffabricante))
			$array_key = array_flip(explode(',',$arrlistreffabricante));

		for($a = 0; $a < $nrfabricante; $a++)
		{
			$arwfabricante = fncfetch($rsfabricante, $a);
			$complement = ($a % 2) ? ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';

			$checked = '';

			if(is_array($array_key))
			{
				if(array_key_exists($arwfabricante['fabricodigo'], $array_key) || isset($alllistreffabricante))
					$checked = 'checked';
			}
?>
			<tr <?php echo $complement; ?>>
				<td width="50" class="maestabl-row-list" style=" border-bottom: 1px solid #fff;"><input type="checkbox" id="chklistreffabricante" name="chklistreffabricante" <?php echo $checked; ?> onclick="setSelectionRow(this.value, document.getElementById('arrlistreffabricante').value, ',', 'listreffabricante');" value="<?php echo $arwfabricante['fabricodigo']; ?>"></td>
				<td width="250" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $arwfabricante['fabrirazsol'] ?></td>
				<td width="180" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $arwfabricante['fabrinit'] ?></td>
			</tr>
<?php 
		}
	}

	if($a < 15)
	{
		for($b = $a; $b < 15; $b++)
		{
			$class = ($b % 2) ? "NoiseDataTD" : "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="50" class="maestabl-row-list" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="250" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="180" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php  
		}
	} 
?>
		</table>
		<input type="hidden" name="arrlistreffabricante" id="arrlistreffabricante" value="<?php echo $arrlistreffabricante; ?>">
	</div>
</div>