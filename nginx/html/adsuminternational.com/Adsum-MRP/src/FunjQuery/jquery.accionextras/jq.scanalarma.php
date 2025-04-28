<?php
	//by ralvear 2014-01-17
	ini_set("display_errors", 1);
	include_once("../../FunPerPriNiv/pktblvistaalarmagestion.php");	
	include_once("../../FunPerPriNiv/pktblalarmamodulo.php");	
	include_once("../../FunPerPriNiv/pktblalarmaitem.php");	
	include_once("../../FunPerPriNiv/pktblusuario.php");	
	include_once("../../FunPerPriNiv/pktblalarma.php");	
	include_once("../../FunPerSecNiv/fncsqlrun.php");
	include_once("../../FunPerSecNiv/fncnumreg.php");
	include_once("../../FunPerSecNiv/fncclose.php");
	include_once("../../FunPerSecNiv/fncfetch.php");
	include_once("../../FunPerSecNiv/fncconn.php");
	include_once("../../FunGen/cargainput.php");
	include_once("../../JSON/JSON.php");

	$idconAlarma = fncconn();

	$json = new Services_JSON();

	$arrAlarmas = array();

	$redirect = 0;

	if($produccoduno > 0 && $modulocodigo > 0){

		$rsAlarma = dinamicscanopalarma(array("nivalacodigo" => "1"), array("nivalacodigo" => "="), $idconAlarma);
		$nrAlarma = fncnumreg($rsAlarma);

		if($nrAlarma > 0){

			for($a = 0; $a < $nrAlarma; $a++){

				$rwAlarma = fncfetch($rsAlarma,$a);

				$rsAlarmaItem = dinamicscanopalarmaitem(array("alarmacodigo" => $rwAlarma["alarmacodigo"], "produccoduno" => $produccoduno), array("alarmacodigo" => "=", "produccoduno" => "="), $idconAlarma);
				$nrAlarmaItem = fncnumreg($rsAlarmaItem);

				if($nrAlarmaItem > 0){

					$rsAlarmaModulo = dinamicscanopalarmamodulo(array("alarmacodigo" => $rwAlarma["alarmacodigo"], "modulocodigo" => $modulocodigo), array("alarmacodigo" => "=", "modulocodigo" => "="), $idconAlarma);
					$nrAlarmaModulo = fncnumreg($rsAlarmaModulo);

					$rsAlarmaGestion = dinamicscanopvistaalarmagestion(array("alarmacodigo" => $rwAlarma["alarmacodigo"]), array("alarmacodigo" => "="), $idconAlarma);
					$nrAlarmaGestion = fncnumreg($rsAlarmaGestion);

					if($nrAlarmaModulo > 0 && $nrAlarmaGestion > 0){

						if($rwAlarma["tipoalacodigo"] > 1) $redirect = 1;

						$arrAlarmas[] = array(
							"alarmacodigo" => $rwAlarma["alarmacodigo"], 
							"tipoalacodigo" => $rwAlarma["tipoalacodigo"],
							"tipoalarma" => ($rwAlarma["tipoalacodigo"] > 1)? "Restrictivo" : "Informativo" ,
							"nivelalarma" => ($rwAlarma["nivalacodigo"] > 1)? "Cliente" : "Item" ,
							"alarmafecelb" => $rwAlarma["alarmafecelb"],
							"responsable" => cargausuanombre($rwAlarma["usuacodi"],$idconAlarma),
							"alarmamensaj" => $rwAlarma["alarmamensaj"],
							"alarmadescri" => $rwAlarma["alarmadescri"]
						);

					}

				}

			}

		}

	}


	if($ordcomcodcli > 0 && $modulocodigo > 0){

		$rsAlarma = dinamicscanopalarma(array("nivalacodigo" => "2", "ordcomcodcli" => $ordcomcodcli), array("nivalacodigo" => "=", "ordcomcodcli" => "="), $idconAlarma);
		$nrAlarma = fncnumreg($rsAlarma);		

		if($nrAlarma > 0){

			for($a = 0; $a < $nrAlarma; $a++){

				$rwAlarma = fncfetch($rsAlarma,$a);

				$rsAlarmaModulo = dinamicscanopalarmamodulo(array("alarmacodigo" => $rwAlarma["alarmacodigo"], "modulocodigo" => $modulocodigo), array("alarmacodigo" => "=", "modulocodigo" => "="), $idconAlarma);
				$nrAlarmaModulo = fncnumreg($rsAlarmaModulo);

				$rsAlarmaGestion = dinamicscanopvistaalarmagestion(array("alarmacodigo" => $rwAlarma["alarmacodigo"]), array("alarmacodigo" => "="), $idconAlarma);
				$nrAlarmaGestion = fncnumreg($rsAlarmaGestion);

				if($nrAlarmaModulo > 0 && $nrAlarmaGestion > 0){

					if($rwAlarma["tipoalacodigo"] > 1) $redirect = 1;

					$arrAlarmas[] = array(
						"alarmacodigo" => $rwAlarma["alarmacodigo"], 
						"tipoalacodigo" => $rwAlarma["tipoalacodigo"],
						"tipoalarma" => ($rwAlarma["tipoalacodigo"] > 1)? "Restrictivo" : "Informativo" ,
						"nivelalarma" => ($rwAlarma["nivalacodigo"] > 1)? "Cliente" : "Item" ,
						"alarmafecelb" => $rwAlarma["alarmafecelb"],
						"responsable" => cargausuanombre($rwAlarma["usuacodi"],$idconAlarma),
						"alarmamensaj" => $rwAlarma["alarmamensaj"],
						"alarmadescri" => $rwAlarma["alarmadescri"]
					);

				}


			}

		}

	}

	fncclose($idconAlarma);


	if(count($arrAlarmas)){

		$strAlarma = '';

		$strAlarma .= '<table>';

		$strAlarma .= '<tr>';

		$strAlarma .= '<td width="100%" class="NoiseFooterTD">&nbsp;<b>Listado de alarmas<b></td>';

		$strAlarma .= '</tr>';

		for($a = 0; $a < count($arrAlarmas); $a++){

			$strAlarma .= '<tr>';

			$strAlarma .= '<td width="100%">';

			$strAlarma .= '<div class="ui-widget">';

			$strAlarma .= '<div class="' .( ($arrAlarmas[$a]["tipoalacodigo"] > 1)? "ui-state-error ui-corner-all" : "ui-state-highlight ui-corner-all"). '" style="padding: 0 .7em;">';

			$strAlarma .= '<p>';
			$strAlarma .= '<span class="ui-icon ui-icon-bullet" style="float: left; margin-right: .3em;"></span>';
			$strAlarma .= '<strong>No. Alarma:</strong>&nbsp;'.$arrAlarmas[$a]["alarmacodigo"];
			$strAlarma .= '</p>';

			$strAlarma .= '<p>';
			$strAlarma .= '<span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>';
			$strAlarma .= '<strong>Tipo Alarma:</strong>&nbsp;'.$arrAlarmas[$a]["tipoalarma"];
			$strAlarma .= '</p>';

			$strAlarma .= '<p>';
			$strAlarma .= '<span class="ui-icon ui-icon-tag" style="float: left; margin-right: .3em;"></span>';
			$strAlarma .= '<strong>Nivel Alarma:</strong>&nbsp;'.$arrAlarmas[$a]["nivelalarma"];
			$strAlarma .= '</p>';

			$strAlarma .= '<p>';
			$strAlarma .= '<span class="ui-icon ui-icon-calendar" style="float: left; margin-right: .3em;"></span>';
			$strAlarma .= '<strong>Fecha :</strong>&nbsp;'.$arrAlarmas[$a]["alarmafecelb"];
			$strAlarma .= '</p>';

			$strAlarma .= '<p>';
			$strAlarma .= '<span class="ui-icon ui-icon-person" style="float: left; margin-right: .3em;"></span>';
			$strAlarma .= '<strong>Responsable:</strong>&nbsp;'.$arrAlarmas[$a]["responsable"];
			$strAlarma .= '</p>';

			$strAlarma .= '<p>';
			$strAlarma .= '<span class="ui-icon ui-icon-notice" style="float: left; margin-right: .3em;"></span>';
			$strAlarma .= '<strong>Mensaje :</strong>&nbsp;'.$arrAlarmas[$a]["alarmamensaj"];
			$strAlarma .= '</p>';

			$strAlarma .= '<p>';
			$strAlarma .= '<span class="ui-icon ui-icon-comment" style="float: left; margin-right: .3em;"></span>';
			$strAlarma .= '<strong>Descripci&oacute;n :</strong>&nbsp;'.$arrAlarmas[$a]["alarmadescri"];
			$strAlarma .= '</p>';

			$strAlarma .= '</div>';
			$strAlarma .= '</div>';

			$strAlarma .= '</td>';

			$strAlarma .= '</tr>';
		}

		$strAlarma .= '</table>';
	}

	if($windetallar > 0){

		$redirect = 0;
	}

	echo $json->encode(array("html" => $strAlarma, "redirect" => $redirect));
	
?>