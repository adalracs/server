<?php 
	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerPriNiv/pktblusuario.php';
		include '../../FunPerPriNiv/pktblcargo.php';
	endif;
	
	function innerHTML($fecini, $fecfin, $rs_usuario, $usualider, $index, $noAjax, $typesource, $idcon)
	{ 
		//===== Config HTML =====
		if($index % 2)
			$complement = ' class="NoiseDataTD" id="fila'.$index.'" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"';
		else
			$complement = ' class="NoiseFooterTD" id="fila'.$index.'" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';

		if($rs_usuario['cargocodigo'])
			$rs_cargo = loadrecordcargo($rs_usuario['cargocodigo'], $idcon);	
			
		echo '<tr'.$complement.'>'."\n";
		echo '<td width="30" style=" border-bottom: 1px solid #fff;"><input type="checkbox" name="chklsttecnico" id="chklsttecnico" onclick="setSelectionRow(this.value, '."document.getElementById('lsttecnico').value, ',', 'lsttecnico'".');" value="'.$rs_usuario['usuacodi'].'"></td>'."\n";

		if($noAjax):
			echo '<td width="349" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;" class="adm-ui-row-list">&nbsp;'.$rs_usuario['usuanombre'].' '.$rs_usuario['usuapriape'].' '.$rs_usuario['usuasegape'].'</td>'."\n";
			echo '<td width="252" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;" class="adm-ui-row-list">&nbsp;'.$rs_cargo['cargonombre'].'</td>'."\n";
		else:
			echo '<td width="349" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;" class="adm-ui-row-list">&nbsp;'.$rs_usuario['usuanombre'].' '.$rs_usuario['usuapriape'].' '.$rs_usuario['usuasegape'].'</td>'."\n";
			echo '<td width="252" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;" class="adm-ui-row-list">&nbsp;'.$rs_cargo['cargonombre'].'</td>'."\n";
		endif;
		echo '</tr>'."\n";
	}

	unset($a);
?>

<div style="width:648px; height: 14px; margin:0 auto;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="30" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel</td>
				<td width="350" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Nombre</td>
				<td width="253" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Cargo</td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>

<div style="width:648px; height: 150px; margin:0 auto; overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:628px; height: auto;" id="listatecnicos">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
		if($iRegArray):
			$idcon = fncconn();
		
			$array_key_tec = explode(',', $iRegArray); 
				
			for($a = 0; $a < count($array_key_tec); $a++):
				$rs_usuario = loadrecordusuario($array_key_tec[$a], $idcon);
			
				if($rs_usuario > 0)
					innerHTML($fecini, $fecfin, $rs_usuario, $usualider, $a, $noAjax, $typesource, $idcon);
			endfor;				
		endif;
	
		if($a < 13):
			for($b = $a; $b < 13; $b++):
			
				if($b % 2)
					$class = "NoiseDataTD";
				else
					$class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="30" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="349" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="252" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
			endfor;
		endif;	
?>
		</table>
	</div>
</div>