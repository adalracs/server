<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
<?php 
if($equipocodigo):
	$rsCamperequipopn = dinamicscancamperequipopn(array('equipocodigo' => $equipocodigo),$idcon);
	$nrCamperequipopn = fncnumreg($rsCamperequipopn);
	$trkey= 0;$tdkey = 0;
	for( $a = 0; $a < $nrCamperequipopn; $a++):
		$rwCamperequipopn = fncfetch($rsCamperequipopn,$a);
		$objCamperquipopn = $rwCamperequipopn['cpeqpnnombre'];
		if(!$trkey):
			echo '<tr>';
			$trkey = 1;
		endif;
			
		if(!($a % 2) && $a == ($nrCamperequipopn -1)):
			$colskey = 'colspan="3"';
		endif;
		
		echo '<td width="30%" class="NoiseFooterTD">&nbsp;';
		if($campnomb[$objCamperquipopn] == 1){ $patestcodigo = null; echo "*";}
		echo $rwCamperequipopn['cpeqpnforcam'].'</td>';
		echo '<td width="20%" '.$colskey.' class="NoiseDataTD">&nbsp;<input type="text" name="'.$objCamperquipopn.'" id='.$objCamperquipopn.'" value="'.$$objCamperquipopn.'" size="10" /></td>';
		
		$tdkey++;
		
		if($tdkey >= 2):
			echo '</tr>';
			$trkey = 0;
			$tdkey = 0;
		endif;
		
	endfor;
else:
?>
	<tr>
		<td>
			<div class="ui-widget">
				<div style="margin-top: 1px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all"> 
				  	<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
				  	<b>No se encontraron parametros para el equipo.</b></p>
				 </div>
			</div>
		</td>
	</tr>
<?php endif;?>
</table>