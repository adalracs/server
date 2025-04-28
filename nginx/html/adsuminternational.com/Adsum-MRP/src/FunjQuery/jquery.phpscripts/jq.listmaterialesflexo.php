<?php 

	if(!$noAjax){
		include_once '../../FunPerPriNiv/pktblvistabandejaflexografia.php';
		include_once '../../FunPerPriNiv/pktblprocedimiento.php';
		include_once '../../FunPerPriNiv/pktblitemdesa.php';
		include_once '../../FunPerSecNiv/fncnumreg.php';
		include_once '../../FunPerSecNiv/fncsqlrun.php';
		include_once '../../FunPerSecNiv/fncclose.php';
		include_once '../../FunPerSecNiv/fncfetch.php';
		include_once '../../FunPerSecNiv/fncconn.php';
		include_once '../../FunPerPriNiv/pktblop.php';

	}

	if($arrmatplan) $objsarrmatplan = explode(":|:", $arrmatplan); else $objsarrmatplan;

	if( count($objsarrmatplan) > 0 ){
		$idcon = fncconn();
?>

<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">		
	<tr>
		<td class="ui-state-default" colspan="6"><?php if($campnomb["arrmatplan"] == 1)echo "*"; ?>&nbsp;Materiales asignados a la orden. </td></tr>
	<tr>
		<td width="10%" class="ui-state-default"><small>Item</small></td>
		<td width="50%" class="ui-state-default"><small>Ref.</small></td>
		<td width="20%" class="ui-state-default"><small>Consumo.<b>(kgs)</b></small></td>
		<td width="20%" class="ui-state-default"><small>Proceso</small></td>
	</tr>
		<?php 
			for($a = 0; $a< count($objsarrmatplan); $a++){

				$rowobjsarrmatplan = explode(":-:",$objsarrmatplan[$a]);
				$rwItemDesa = loadrecorditemdesa($rowobjsarrmatplan[0],$idcon);
				$rwProcedimiento = loadrecordprocedimiento($rowobjsarrmatplan[1],$idcon);
				$objConsumo = "consumo_".$objsarrmatplan[$a];
		?>
	<tr>
		<td class="NoiseDataTD">&nbsp;<?php echo $rwItemDesa["itedescodigo"] ?></td>
		<td class="NoiseDataTD">&nbsp;<?php echo $rwItemDesa["itedesnombre"] ?></td>
		<td class="NoiseDataTD">&nbsp;<input type="hidden" name="<?php echo $objConsumo; ?>" id="<?php echo $objConsumo; ?>" value="<?php echo $$objConsumo; ?>" /><?php echo ($$objConsumo)? $$objConsumo : "---" ;?></td>
		<td class="NoiseDataTD">&nbsp;<?php echo $rwProcedimiento["procednombre"] ?></td>
	</tr>
<?php 
			}
?>
</table>
<?php
 	}else{

     		echo '<div class="ui-widget">';
			echo	'<div style="margin-top: 1px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all">';
			echo		'<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>';
			echo		'<b>No se encontraron ordenes.</b></p>';
			echo	'</div>';
			echo '</div>';

   	}
?>