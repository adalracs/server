<?php 
	if(!$noAjax)
	{
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerSecNiv/fncsqlrun.php';
		include '../../FunPerPriNiv/pktblfabricante.php';
		include '../../FunGen/cargainput.php';
	}

	$idcon = fncconn();
	$a = 0;
	$b = 0;
?>	
<div style="width:955px; height: 18px; margin:0 auto;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="50" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel</td>
				<td width="200" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Razon social</td>
				<td width="250" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Nit</td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:955px; height: 100px; margin:0 auto; overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:936px; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	if($arrfabricanteprovee)
	{
		unset($arrfabricante);
		$arrfabricante = explode(",", $arrfabricanteprovee);
		

		for($a = 0; $a < count($arrfabricante); $a++)
		{
			$rwFabricante=loadrecordfabricante($arrfabricante[$a],$idcon);
			$complement = ($a % 2) ? ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
			if(!$flagDetallar)
			{
?>
			<tr <?php echo $complement; ?>>
				<td width="50" class="maestabl-row-list" style=" border-bottom: 1px solid #fff;"><input type="checkbox" id="chkplantastockequipo" name="chkplantastockequipo" <?php echo $checked; ?> onclick="setSelectionRow(this.value, document.getElementById('arrfabricanteprovee').value,',','fabricanteprovee');" value="<?php echo $rwFabricante['fabricodigo']; ?>"></td>
				<td width="200" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwFabricante['fabrirazsol'];?></td>
				<td width="250" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwFabricante['fabrinit']; ?></td>
			</tr>
<?php 
			}else{
?>
			<tr <?php echo $complement; ?>>
				<td width="50" class="maestabl-row-list" style=" border-bottom: 1px solid #fff;"><b>&nbsp;&nbsp;X</b></td>
				<td width="200" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwFabricante['fabrirazsol']; ?></td>
				<td width="250" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwFabricante['fabrinit']; ?></td>
			</tr>
<?php 
			}
		}
	}

	if($a < 8)
	{
		for($b = $a; $b < 8; $b++)
		{
			$class = ($b % 2) ? "NoiseDataTD" : "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="50" class="maestabl-row-list" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="200" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="250" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php  
		}
	} 

	fncclose($idcon);
?>
		</table>
	</div>
</div>