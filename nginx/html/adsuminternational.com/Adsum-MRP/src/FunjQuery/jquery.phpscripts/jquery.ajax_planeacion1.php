<?php 

	if(!$noAjax){
		include_once "../../FunGen/fncobtenercampertippro1.php";
		include_once "../../FunPerPriNiv/pktblpadreitem.php";
		include_once "../../FunPerPriNiv/pktblproducto.php";
		include_once "../../FunPerPriNiv/pktblsoliprog.php";
		include_once "../../FunPerSecNiv/fncnumreg.php";
		include_once "../../FunPerSecNiv/fncsqlrun.php";
		include_once "../../FunPerSecNiv/fncclose.php";
		include_once "../../FunPerSecNiv/fncfetch.php";
		include_once "../../FunPerSecNiv/fncconn.php";
		include_once "../../FunPerPriNiv/pktblop.php";

		if($arrop) $objsarrop = explode(",", $arrop); else $objsarrop;
	}

?>
<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
	<tr>
		<td width="50%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Material</td>
		<td width="5%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Cal.</td>
		<td width="5%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Gra.</td>
		<td width="5%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;%</td>
		<td width="5%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Refile</td>
		<td width="10%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Ancho (mm)</td>
		<td width="7%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;(kgs)</td>
		<td width="8%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;(mts)</td>
	</tr>
<?php
		if($arrmaterial) $objsarrmaterial = explode(':|:',$arrmaterial); else unset($objsarrmaterial);
		if($arrcalibre) $objsarrcalibre = explode(':|:',$arrcalibre); else unset($objsarrcalibre);

		if( count($objsarrmaterial) > 0 ){

			$idcon = fncconn();

			for($a =  0; $a < count($objsarrmaterial); $a++){

				$rwPadreItem = loadrecordpadreitem($objsarrmaterial[$a],$idcon);
				//objetos a usar
				$objCantKgs = "cantkgs_".$rwPadreItem["paditecodigo"].($a + 1);
				$objCantMts = "cantmts_".$rwPadreItem["paditecodigo"].($a + 1);
				$objCantKgsPv = 'cantkgspb_'.$rwPadreItem["paditecodigo"].($a + 1);
				$objAnchoIdeal = 'anchoideal_'.$rwPadreItem["paditecodigo"].($a + 1);
				$objCalibre = "calibre_".$rwPadreItem["paditecodigo"].($a + 1);
				$objRefile = "refile_".$rwPadreItem["paditecodigo"].($a + 1);
				//valor de los objetos a  usar
				$$objCalibre = ($$objCalibre)? $$objCalibre : $objsarrcalibre[$a] ;
				$$objRefile = ($$objRefile)? $$objRefile : 0 ;

				$anchoproceso = 0;

				for($b = 0; $b < count($objsarrop); $b++){

					$rwOp = loadrecordop($objsarrop[$b], $idcon);
					$rwSoliprog = loadrecordsoliprog($rwOp["solprocodigo"],$idcon);

					$ancho = 0;
					$largo = 0;
					$traslape = 0;
					$fuelle = 0;
					$pestania = 0;
					$solapa = 0;
					$bmayor = 0;
					$bmenor = 0;

					$nropistas = 1;

					fncobtenercampertippro($rwSoliprog["produccodigo"], $ancho, $largo, $traslape, $fuelle, $pestania, $solapa,$bmayor, $bmenor);

					//producto => {bolsa flow pack}
					if($tipprocodigo == 1){

						$$objAnchoIdeal = $ordoppanchot + $$objRefile;
						$anchoproceso = ( ($ancho + $traslape + $fuelle) * 2);

						switch ($unimedi) {
    						case "KGS":
    							$$objCantKgsPv = $cant_planea;
        						break;
    						case "UND":
        						$$objCantKgsPv = ( ($cant_planea / 1000) * ( ( ($solpa / 1000) + ($largo / 1000 * 2) + ($solapa / 1000 * 2) + ($fuelle / 1000 * 2) ) * ($ancho / 1000) * $totalgramaje) ) /2;
        						break;
    						case "MIL":
        						$$objCantKgsPv = $cant_planea * ( ( ($solapa / 1000) + ($largo / 1000 * 2) + ($solapa / 1000 * 2) + ($fuelle / 1000 * 2) ) * ( ($ancho / 1000) * $totalgramaje ) ) / 2;
        					break;
						}

					}else if($tipprocodigo == 2 || $tipprocodigo == 3 || $tipprocodigo == 4){//producto => {bolsa lateral ,bolsa doy pack, bolsa pouch lateral}

						$$objAnchoIdeal = $ordoppanchot + $$objRefile;
						$anchoproceso = ( ($largo + $fuelle) * 2);

						switch ($unimedi) {
    						case "KGS":
    							$$objCantKgsPv = $cant_planea;
        						break;
    						case "UND":
        						$$objCantKgsPv = ($cant_planea / 1000) * ( ($solapa / 1000) + ($largo / 1000 * 2) + ($solapa / 1000 * 2) + ($fuelle / 1000 * 2) ) * ( ( $ancho / 1000) * $totalgramaje );
        						break;
    						case "MIL":
        						$$objCantKgsPv = $cant_planea * ( ($solapa / 1000) + ($largo / 1000 * 2) + ($solapa / 1000 * 2) + ($fuelle / 1000 * 2) ) * ( ($ancho / 1000) * $totalgramaje );
        					break;
						}

					}else if($tipprocodigo == 5){//producto => {capuchon}

						$$objAnchoIdeal = $ordoppanchot + $$objRefile;
						$anchoproceso = ( ($largo + $pestania) * 2);

						if($arrmaterial) $estructura_n = count( explode(":|:", $arrmaterial) ); else $estructura_n = 1;

						switch ($unimedi) {
    						case "KGS":
    							$$objCantKgsPv = $cant_planea;
        						break;
    						case "UND":
    							$$objCantKgsPv = ($cant_planea / 1000) * ( ( ($bmayor / 1000) + ($bmenor / 1000) ) / 2 ) * ( ($largo / 1000) * 2 ) + ( ($pestania / 1000) * 2) * $totalgramaje;
        						break;
    						case "MIL":
        						$$objCantKgsPv = $cant_planea * ( ( ($bmayor / 1000) + ($bmenor / 1000) ) / 2 ) * ( ($largo / 1000 ) * 2 ) + ( ($pestania / 1000) * 2 ) * ($totalgramaje / $estructura_n );
        					break;
						}

					}else if($tipprocodigo == 6){//producto => {lamina}
						$$objAnchoIdeal = $ordoppanchot + $$objRefile;
						$anchoproceso = $ancho;

						switch ($unimedi) {
    						case "KGS":
    							$$objCantKgsPv = $cant_planea;
        						break;
						}

					}
					
					$$objCantKgs = $$objCantKgsPv * ( ( $$objCalibre * $rwPadreItem["paditedensid"] ) / $totalgramaje );
					if($$objAnchoIdeal > 0) $$objCantKgs = $$objCantKgs + ( ($$objRefile / $ordoppanchot) * $$objCantKgs);
					if($$objAnchoIdeal > 0) $$objCantMts = ( $$objCantKgs / ( $$objCalibre * $rwPadreItem["paditedensid"] * $$objAnchoIdeal) )  * 1000000;


				}
?>
	<tr>
		<td width="50%" class="NoiseFooterTD">&nbsp;<?php echo ($rwPadreItem['paditenombre'])? $rwPadreItem['paditenombre'] : "---"; ?></td>
		<td width="5%" class="NoiseFooterTD">&nbsp;<input type="hidden" name="<?php echo $objCalibre; ?>" id="<?php echo $objCalibre; ?>" value="<?php echo $$objCalibre; ?>"/><?php echo ($$objCalibre)? $$objCalibre : "---"; ?></td>
		<td width="5%" class="NoiseFooterTD">&nbsp;<?php echo ( ($$objCalibre * $rwPadreItem["paditedensid"]) > 0)? $$objCalibre * $rwPadreItem["paditedensid"] : "---"; ?></td>
		<td width="5%" class="NoiseFooterTD">&nbsp;<?php echo ( ( ( $$objCalibre * $rwPadreItem["paditedensid"] ) / $totalgramaje ) > 0)? number_format( ( ( $$objCalibre * $rwPadreItem["paditedensid"] ) / $totalgramaje ) * 100, 2, ",", ".") : "---" ?></td>
		<td width="5%" class="NoiseFooterTD">&nbsp;<input type="text" name="<?php echo $objRefile; ?>" id="<?php echo $objRefile ?>" value="<?php echo $$objRefile ?>" size="3" onchange="accionReloadAjax_planeacion();"  /></td>
		<td width="10%" class="NoiseFooterTD">&nbsp;<input type="hidden" name="<?php echo $objAnchoIdeal; ?>" id="<?php echo $objAnchoIdeal; ?>" value="<?php echo $$objAnchoIdeal; ?>" /><?php echo ($$objAnchoIdeal)? $$objAnchoIdeal : "---"; ?></td>
		<td width="7%" class="NoiseFooterTD">&nbsp;<input type="hidden" name="<?php echo $objCantKgs; ?>" id="<?php echo $objCantKgs; ?>" value="<?php echo $$objCantKgs; ?>"/><?php echo ($$objCantKgs)? number_format($$objCantKgs, 2, ",", ".") : "---"; ?></td>
		<td width="8%" class="NoiseFooterTD">&nbsp;<input type="hidden" name="<?php echo $objCantMts; ?>" id="<?php echo $objCantMts; ?>" value="<?php echo $$objCantMts; ?>" /><?php echo ($$objCantMts)? number_format($$objCantMts, 2, ",", ".") : "---"; ?></td>
	</tr>
<?php
		}

		}else{

			echo '<div class="ui-widget">';
			echo	'<div style="margin-top: 1px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all">';
			echo		'<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>';
			echo		'<b>No se encontraron materiales.</b></p>';
			echo	'</div>';
			echo '</div>';

		}
?>
</table>
<input type="hidden" name="anchoproceso" id="anchoproceso" value="<?php echo $anchoproceso ?>" />