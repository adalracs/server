<?php
	$termino = strtolower($_GET["term"]);
	
	if (!$termino) return;

	include "../../jquery.service/jquery.array_json.php";
	include "../../../FunPerPriNiv/pktblitemdesa.php";
	include "../../../FunPerSecNiv/fncnumreg.php";
	include "../../../FunPerSecNiv/fncfetch.php";
	include "../../../FunPerSecNiv/fncconn.php";
	include "../../../FunPerSecNiv/fncclose.php";
	include "../../../FunPerPriNiv/pktblrecepcionmercancia.php";

	
	$record["itedescodigo"] = $termino;
	$record["itedesnombre"] = $termino;
	$record["lotecodigo"] = $lotecodigo;

	$recordop["itedescodigo"] = "like";
	$recordop["itedesnombre"] = "like";
	$recordop["lotecodigo"] = "=";

	if($lotecodigo){
	
		$idcon = fncconn();

		$rs_item = dinamicscanoprecepcionmercancia($record, $recordop, $idcon, 1);
		$nr_item = fncnumreg($rs_item);
			
		$result = array();	
			
		if($nr_item){

			for ($i = 0; $i < $nr_item; $i++){

				$rw_item = fncfetch($rs_item, $i);

				$rwItemdesa = loadrecorditemdesa($rw_item["itedescodigo"],$idcon);
				$registro = array();
						
				$registro = array("id" => $rwItemdesa["itedescodigo"], "label" => $rwItemdesa["itedescodigo"]." - ".$rwItemdesa["itedesnombre"] , "value" => strip_tags($rwItemdesa["itedescodigo"]." - ".$rwItemdesa["itedesnombre"]));	
						
				array_push($result, $registro);

				if (count($result) > 15){
					break;
				}
					
			}

		}

	}
	
	echo array_to_json($result);