<?php 
ini_set("display_errors", 1);
	if(!$noAjax){
		include_once ("../../FunPerPriNiv/pktblvistabandejaflexografia.php");
		include_once ("../../FunGen/fncobtenercampertippro1.php");
		include_once ("../../FunPerPriNiv/pktblpadreitem.php");
		include_once ("../../FunPerSecNiv/fncnumreg.php");
		include_once ("../../FunPerSecNiv/fncsqlrun.php");
		include_once ("../../FunPerSecNiv/fncclose.php");
		include_once ("../../FunPerSecNiv/fncfetch.php");
		include_once ("../../FunPerSecNiv/fncconn.php");
		include_once ("../../FunPerPriNiv/pktblop.php");

		if($arrop) $objsarrop = explode(",", $arrop); else $objsarrop;
	}

	if( count($objsarrop) > 0 ){
?>
<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
	<tr>
		<td class="ui-state-default" width="3%"  align="center" style="border-top:0; border-bottom:0; border-left:0;"># OP</td>
		<td class="ui-state-default" width="23%"  align="center" style="border-top:0; border-bottom:0; border-left:0;">Cliente</td>
		<td class="ui-state-default" width="5%"  align="center" style="border-top:0; border-bottom:0; border-left:0;">Item</td>
		<td class="ui-state-default" width="25%"  align="center" style="border-top:0; border-bottom:0; border-left:0;">Referencia</td>
		<td class="ui-state-default" width="5%"  align="center" style="border-top:0; border-bottom:0; border-left:0;">AnchoM</td>
		<td class="ui-state-default" width="6%"  align="center" style="border-top:0; border-bottom:0; border-left:0;"># Pistas</td>
		<td class="ui-state-default" width="5%"  align="center" style="border-top:0; border-bottom:0; border-left:0;">Pistas</td>
		<td class="ui-state-default" width="5%"  align="center" style="border-top:0; border-bottom:0; border-left:0;"><b>kgs</b>&nbsp;PV</td>
		<td class="ui-state-default" width="5%"  align="center" style="border-top:0; border-bottom:0; border-left:0;"><b>kgs</b>&nbsp;OP</td>
		<td class="ui-state-default" width="5%"  align="center" style="border-top:0; border-bottom:0; border-left:0;"><b>kgs</b>&nbsp;PL</td>
		<td class="ui-state-default" width="5%"  align="center" style="border-top:0; border-bottom:0; border-left:0;"><b>%</b></td>
		<td class="ui-state-default" width="7%"  align="center" style="border-top:0; border-bottom:0; border-left:0;">Ancho ideal</td>
	</tr>
<?php

		$idcon = fncconn();

		for($a =  0; $a < count($objsarrop); $a++){

			$rwOp= loadrecordvistabandejaflexografia($objsarrop[$a],$idcon);
			$calibre = $rwOp["ordprocalibr"];
			$rwPadreItem = loadrecordpadreitem($rwOp["paditecodigo"], $idcon);
			($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';

			$objPista = "pista_".$objsarrop[$a];
			$objProcentaje = "porcentaje_".$objsarrop[$a];
			$objCantKgs = "cantkgs_".$objsarrop[$a];
			$objCantKgsDif = "cantkgsdif_".$objsarrop[$a];
			$objAncho = "ancho_".$objsarrop[$a];

			fncobtenercampertippro($rwOp["produccodigo"], $ancho, $largo, $traslape, $fuelle, $pestania, $solapa,$bmayor, $bmenor);
			(float)$anchoproceso = 0;

			if( (int)$rwOp["tipprocodigo"] == 1){//producto => {bolsa flow pack}

				$anchoproceso = ( ( (float)$ancho + (float)$traslape + (float)$fuelle) * 2);

			}else if( (int)$rwOp["tipprocodigo"] == 2 || (int)$rwOp["tipprocodigo"] == 3 || (int)$rwOp["tipprocodigo"] == 4){//producto => {bolsa lateral ,bolsa doy pack, bolsa pouch lateral}

				$anchoproceso = ( ( (float)$largo + (float)$fuelle) * 2);

			}else if( (int)$rwOp["tipprocodigo"] == 5){//producto => {capuchon}
				
				$anchoproceso = ( ( (float)$largo + (float)$pestania) * 2);

			}else if( (int)$rwOp["tipprocodigo"] == 6){//producto => {lamina}

				$anchoproceso = (float)$ancho;
			}

			if( !$$objPista )  $$objPista = ($rwOp["ordpropistap"])? $rwOp["ordpropistap"] : 1 ;
			$$obj_anchot = $anchoproceso * $$objPista;
			$$objProcentaje = ($anchoproceso * $$objPista)  / $ordoppanchot;
			$$objCantKgs = ($$objProcentaje * $cant_planea) * ( ($rwOp["ordprocalibr"] * $rwPadreItem["paditedensid"]) / $totalgramaje);
			$$objAncho = $anchoproceso;

?>
		<tr <?php echo $complement; ?> >
			<td class="cont-line">&nbsp;<?php echo str_pad($rwOp["ordprocodigo"], 4, "0", STR_PAD_LEFT); ?></td>
			<td class="cont-line">&nbsp;<?php echo $rwOp["ordcomrazsoc"]; ?></td>
			<td class="cont-line">&nbsp;<?php echo $rwOp["produccoduno"]; ?></td>
			<td class="cont-line">&nbsp;<?php echo $rwOp["producnombre"]; ?></td>
			<td class="cont-line">&nbsp;<?php echo ($anchoproceso)? $anchoproceso : "---"; ?><input type="hidden" name="<?php echo $objAncho; ?>" id="<?php echo $objAncho; ?>" value="<?php echo $$objAncho; ?>" /></td>
			<td class="cont-line">&nbsp;---</td>
			<td class="cont-line">&nbsp;<input type="text" name="<?php echo $objPista; ?>" id="<?php echo $objPista; ?>" value="<?php echo $$objPista; ?>" size="3" onchange="accionReloadAjax_similacionflx();" /></td>
			<td class="cont-line">&nbsp;<?php echo ($rwOp["propedcansol"])? number_format($rwOp["propedcansol"], 2, ",", ".") : "---" ; ?></td>
			<td class="cont-line">&nbsp;<?php echo ($rwOp["ordprocantkg"])? number_format($rwOp["ordprocantkg"], 2, ",", ".") : "---" ; ?></td>
			<td class="cont-line">&nbsp;<?php echo ($$objCantKgs)? number_format($$objCantKgs, 2, ",", ".") : "---" ;?></span></td>
			<td class="cont-line">&nbsp;<?php echo ($$objProcentaje)? number_format( ($$objProcentaje) * 100 , 2, ",", ".") : "---" ; ?></span></td>
			<td class="cont-line">&nbsp;<?php echo ($$obj_anchot)? number_format($$obj_anchot, 2, ",", ".") : "---" ;?></span></td>
		</tr>

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
</table>