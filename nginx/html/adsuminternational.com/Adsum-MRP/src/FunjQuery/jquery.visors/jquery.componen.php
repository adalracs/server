<?php 
	if (! $noAjax){
		include ('../../FunPerSecNiv/fncconn.php');
		include ('../../FunPerSecNiv/fncclose.php');
		include ('../../FunPerSecNiv/fncnumreg.php');
		include ('../../FunPerSecNiv/fncfetch.php');
		include ('../../FunPerPriNiv/pktblcomponen.php');
		include ('../../FunPerPriNiv/pktbltipocomponen.php');
		include ('../../FunGen/cargainput.php');
	}
			
	if($equipocodigosel){
		$idcon = fncconn();
		$rsComponen = dinamicscancomponen(array('equipocodigo' => $equipocodigosel), $idcon);
		$nrComponen = fncnumreg($rsComponen);
	}
?>	
	
<div style="width:778px; height: 14px; margin:0 auto;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="10%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;C&oacute;digo</td>
				<td width="45%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Tipo de componente</td>
				<td width="40%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Componente</td>
				<td width="5%" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>

<div style="width:778px; height: 150px; margin:0 auto; overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:759px; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	if($nrComponen):
		for($a = 0; $a < $nrComponen; $a++):
			$rwComponen = fncfetch($rsComponen, $a);
		
			if($a % 2)
				$complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"';
			else
				$complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
			
?>			
			<tr <?php echo $complement ?> onClick="window.open('detallarcomponen.php?codigo=Endadsum&radiobutton=<?php echo $rwComponen['componcodigo'].'|s' ?>&nombtabl=componen','','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=550');">
				<td width="10%" style=" border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwComponen['componcodigo'] ?></td>
				<td width="45%" style=" border-bottom: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo cargatipocomponen($rwComponen['tipcomcodigo'],$idcon); ?></td>
				<td width="40%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwComponen['componnombre'] ?></td>
			</tr>
<?php
		endfor;
	endif;
	
	if($a < 13):
		for($b = $a; $b < 13; $b++):
			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="149" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="613" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
			endfor;
		endif;	
?>
		</table>
	</div>
</div>