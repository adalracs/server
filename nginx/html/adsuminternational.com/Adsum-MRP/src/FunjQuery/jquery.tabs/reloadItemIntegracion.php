<?php

	$idc = fncconn();

	unset($arrdispensing, $arrtabla1);

	if($produccoduno > 0){

		$rwItemIntegracion = loadrecorditemintegracion($produccoduno,$idc);

		$rsDataItemIntegracion = dinamicscanopdataitemintegracion(array( "iteintcodigo" => $rwItemIntegracion["iteintcodigo"] ), array("iteintcodigo" => "="),$idc);
		$nrDataItemIntegracion = fncnumreg($rsDataItemIntegracion);

		for( $a = 0; $a < $nrDataItemIntegracion; $a++){

			$rwDataItemIntegracion = fncfetch($rsDataItemIntegracion,$a);

			$datitenombre = str_replace("(mm)", "", $rwDataItemIntegracion["datitenombre"]);
			$datitenombre = str_replace("(mtr)", "", $datitenombre);
			$datitenombre = str_replace("(kg)", "", $datitenombre);
			$datitenombre = str_replace("(kgs)", "", $datitenombre);
			$datitenombre = str_replace(" ", "", $datitenombre);
			$datitenombre = str_replace(",", ".", $datitenombre);
			$objCampoIntegracion = $datitenombre;
			$$objCampoIntegracion = strtolower($rwDataItemIntegracion["datitedescri"]);

			if($objCampoIntegracion == "tipo_estruc" && $$objCampoIntegracion != "monocapa"){

				$lmn = 1;
			}

		}

		if(!$arrdispensing){

			$rsColorItemIntegracion = dinamicscanopcoloritemintegracion(array( "iteintcodigo" => $rwItemIntegracion["iteintcodigo"] ), array("iteintcodigo" => "="),$idc);
			$nrColorItemIntegracion = fncnumreg($rsColorItemIntegracion);

			for( $a = 0; $a < $nrColorItemIntegracion; $a++){
				$rwColorItemIntegracion = fncfetch($rsColorItemIntegracion,$a);

				$rwFormula = loadrecordformula($rwColorItemIntegracion["formulcodigo"],$idc);

				if($rwFormula > 0 ){

					$arrdispensing = ($arrdispensing)? $arrdispensing.":|:".($a + 1).":-:".$rwFormula["formulcodigo"] : ($a + 1).":-:".$rwFormula["formulcodigo"] ;

				}

			}
		}

		if(!$arrtabla1){

			$rsEstructuraItemIntegracion = dinamicscanopestructuraitemintegracion(array( "iteintcodigo" => $rwItemIntegracion["iteintcodigo"] ), array("iteintcodigo" => "="),$idc);
			$nrEstructuraItemIntegracion = fncnumreg($rsEstructuraItemIntegracion);

			for( $a = 0; $a < $nrEstructuraItemIntegracion; $a++){
				$rwEstructuraItemIntegracion = fncfetch($rsEstructuraItemIntegracion,$a);

				$rwPadreitem = loadrecordpadreitem($rwEstructuraItemIntegracion["paditecodigo"],$idc);

				if($rwPadreitem > 0){

					if($rwPadreitem["paditeextrui"] == "t"){
						$flagextrusion = 1;
						$ext = 1;
					}

					$calibre = str_replace(",", ".", $rwEstructuraItemIntegracion["estitecalibr"]);

					$arrtabla1 = ($arrtabla1)? $arrtabla1.":|:".($a + 1).":-:".$rwPadreitem["paditecodigo"].":-:".$rwPadreitem["paditedensid"].":-:".$calibre.":-:".$rwPadreitem["paditeextrui"] : ($a + 1).":-:".$rwPadreitem["paditecodigo"].":-:".$rwPadreitem["paditedensid"].":-:".$calibre.":-:".$rwPadreitem["paditeextrui"];
					$totalgramaje += ($rwEstructuraItemIntegracion["estitecalibr"] * $rwPadreitem["paditedensid"]);
					$totalcalibre += $rwEstructuraItemIntegracion["estitecalibr"];

					$objColor = "color_".($a +1)."_".$rwPadreitem['paditecodigo'];
					$$objColor = $rwEstructuraItemIntegracion['estitecolord'];
				}

			}
		}

	}

	fncclose($idc);
	unset($flagnuevoitemintegracion);

?>