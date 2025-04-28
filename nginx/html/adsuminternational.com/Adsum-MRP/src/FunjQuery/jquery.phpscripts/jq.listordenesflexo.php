<?php 
ini_set("display_error", 1);
	if(!$noAjax){
		include_once '../../FunPerPriNiv/pktblvistabandejaflexografia.php';
		include_once '../../FunPerPriNiv/pktblsoliprog.php';
		include_once '../../FunPerSecNiv/fncnumreg.php';
		include_once '../../FunPerSecNiv/fncsqlrun.php';
		include_once '../../FunPerSecNiv/fncclose.php';
		include_once '../../FunPerSecNiv/fncfetch.php';
		include_once '../../FunPerSecNiv/fncconn.php';
		include_once '../../FunPerPriNiv/pktblop.php';

		if($arrop) $objsarrop = explode(",", $arrop); else $objsarrop;
	}

	if( count($objsarrop) > 0){

		for ($a = 0; $a < count($objsarrop); $a++){

    		$rwOp = loadrecordop($objsarrop[$a],$idcon);
      		$rwSoliprog = loadrecordsoliprog($rwOp["solprocodigo"],$idcon);
      		$rwBandejaFlexografia = loadrecordvistabandejaflexografia($objsarrop[$a],$idcon);

      		$objPista = 'pista_'.$objsarrop[$a];      					
?>
		<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">		
			<tr>
				<td class="ui-state-default" colspan="6">&nbsp;Datos de la OP # <?php echo str_pad($rwOp['ordprocodigo'], 4, "0", STR_PAD_LEFT); ?></td></tr>
			<tr>
				<td colspan="6" class="NoiseDataTD">&nbsp;Orden de producci&oacute;n generada apartir de la solicitud de flexografia (#<?php echo str_pad($rwSoliprog['solprocodigo'], 4, "0", STR_PAD_LEFT); ?>) de <b><?php echo  cargausuanombre($rwSoliprog['usuacodi'],$idcon); ?></b>
				</td>
			</tr>
			<tr>
				<td width="10%" class="ui-state-default"><small>Item</small></td>
				<td width="44%" class="ui-state-default"><small>Ref.</small></td>
				<td width="20%" class="ui-state-default"><small>Cliente</small></td>
				<td width="8%" class="ui-state-default"><small>Anc.<b>(mm)</b></small></td>
				<td width="8%" class="ui-state-default"><small><b>(kgs)</b></small></td>
				<td width="8%" class="ui-state-default"><?php if($campnomb[$objPista] == 1)echo "*"; ?><small># Pistas</small></td>
			</tr>
			<tr>
				<td class="NoiseDataTD">&nbsp;<?php echo ($rwBandejaFlexografia["produccoduno"])? $rwBandejaFlexografia["produccoduno"] : "---" ; ?></td>
				<td class="NoiseDataTD">&nbsp;<?php echo ($rwBandejaFlexografia["producnombre"])? $rwBandejaFlexografia["producnombre"] : "---" ; ?></td>
				<td class="NoiseDataTD">&nbsp;<?php echo ($rwBandejaFlexografia["ordcomrazsoc"])? $rwBandejaFlexografia["ordcomrazsoc"] : "---" ; ?></td>
				<td class="NoiseDataTD">&nbsp;<?php echo ($rwBandejaFlexografia["ordproancflx"])? $rwBandejaFlexografia["ordproancflx"] : "---" ;?></td>
				<td class="NoiseDataTD">&nbsp;<?php echo ($rwBandejaFlexografia["ordprocantkg"])? number_format($rwBandejaFlexografia["ordprocantkg"], 2, ',', '.') : "---" ;?></td>
				<td class="NoiseDataTD">&nbsp;<input type="hidden" name="<?php echo $objPista; ?>" id="<?php echo $objPista; ?>" value="<?php echo $$objPista; ?>" /><?php echo ($objPista)? $$objPista : "---" ; ?></td>
			</tr>
			<tr><td class="ui-state-default" colspan="7"></td></tr>
		</table>
<?php
		}

     }else{

     		echo '<div class="ui-widget">';
			echo	'<div style="margin-top: 1px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all">';
			echo		'<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>';
			echo		'<b>No se encontraron ordenes.</b></p>';
			echo	'</div>';
			echo '</div>';

     }
?>