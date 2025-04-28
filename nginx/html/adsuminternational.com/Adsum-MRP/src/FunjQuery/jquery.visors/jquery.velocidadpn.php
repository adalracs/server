<?php 

	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		
		include '../../FunPerPriNiv/pktblvelocidadpn.php';
	endif;
	
	$idcon = fncconn();
	
	if($tipsolcodigo)
	{
		$ircrecord['tipsolcodigo'] = $tipsolcodigo;
		$ircrecordop['tipsolcodigo'] = '=';
	}
	
	if($equipocodigo)
	{
		$ircrecord['equipocodigo'] = $equipocodigo;
		$ircrecordop['equipocodigo'] = '=';
	}
	
	$rsvelocidadpn = dinamicscanopvelocidadpn($ircrecord,$ircrecordop,$idcon);
	$nrvelocidadpn = fncnumreg($rsvelocidadpn);
?>	
	
<div style="width:770px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="50" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel<input type="checkbox" onclick="setSelectionAll('velocidadpn',',');" value="1" name="allvelocidadpn" id="allvelocidadpn" <?php if($allvelocidadpn) echo 'checked'; ?> ></td>
				<td width="583" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Nombre</td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:770px; height: 75px;overflow:auto;" class="ui-widget-content">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	if($nrvelocidadpn):
		if($arrvelocidadpn)
		{
			$array_tmp = explode(',',$arrvelocidadpn);
			$array_key = array_flip($array_tmp);
		}
	
		for($a = 0; $a < $nrvelocidadpn; $a++):
			$rwvelocidadpn = fncfetch($rsvelocidadpn, $a);
		
			if($a % 2)
				$complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"';
			else
				$complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
			
			if(is_array($array_key))
			{
				$checked = '';
				if(array_key_exists($rwvelocidadpn['velocicodigo'], $array_key) || $allvelocidadpn)
					$checked = 'checked';
			}	
?>			
			<tr <?php echo $complement ?>">
				<td width="50" style=" border-bottom: 1px solid #fff;"><input type="checkbox" id="chkvelocidadpn" name="chkvelocidadpn" <?php echo $checked ?> onclick="setSelectionRow(this.value, document.getElementById('arrvelocidadpn').value, ',', 'velocidadpn'); <?php if($velocidadpnreport): ?>rldSubfunction();<?php endif ?> <?php if($velocidadpnreportop): ?>reloadSistema();<?php endif ?>" value="<?php echo $rwvelocidadpn['velocicodigo'] ?>"></td>
				<td width="580" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwvelocidadpn['velocinombre'] ?></td>
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
				<td width="580" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
			endfor;
		endif;	
?>
		</table>
	</div>
</div>