<?php 

	$gen_tiposoliprog = 3;//solicitudes de flexografia

	$idcon = fncconn();

	if($arrmatlaminar) $objsarrmatlaminar = explode(":|:", $arrmatlaminar); else unset($objsarrmatlaminar);

	if($arrmaterial) $objsarrmaterial = explode(':|:',$arrmaterial); else unset($objsarrmaterial);
	
	if($arrop) $arrObject = explode(",",$arrop); else unset($arrObject);

	if($arrrutaitem) $objsarrrutaitem = explode(":|:",$arrrutaitem); else unset($objsarrrutaitem);

	if( count($objsarrmatlaminar) > 1){

		for ($a = 0; $a < count($objsarrrutaitem); $a++) { 

			$rwProcedimiento = loadrecordprocedimiento($objsarrrutaitem[$a],$idcon);		

			if( $rwProcedimiento["tipsolcodigo"] == 2){//laminado

				for($b = 1; $b < count($objsarrmatlaminar); $b++){

					$arrrutaitem1 = ($arrrutaitem1)? $arrrutaitem1.":|:".$objsarrrutaitem[$a] : $objsarrrutaitem[$a];
				}

			}

			$arrrutaitem1 = ($arrrutaitem1)? $arrrutaitem1.":|:".$objsarrrutaitem[$a] : $objsarrrutaitem[$a];

		}

	}else{

		$arrrutaitem1 = $arrrutaitem;
	}

	if( count($arrObject) > 0 ){

		if($arrrutaitem1) $objsarrrutaitem = explode(":|:",$arrrutaitem1); else unset($objsarrrutaitem);

		for($a = 0; $a < count($objsarrrutaitem); $a++){

			$rwProcedimiento = loadrecordprocedimiento($objsarrrutaitem[$a],$idcon);		

			if( $rwProcedimiento["tipsolcodigo"] > 1 && $rwProcedimiento["tipsolcodigo"] != 3 ){

				unset($iRegopp, $nrolaminado, $laminado);

				switch ($rwProcedimiento["tipsolcodigo"]) {
					//string(12) "11:|:16:|:19" string(7) "16:|:19" 
					case 2://laminado
						if( count($objsarrmaterial) && count($objsarrmatlaminar) > 0){

							for($b =  0; $b < count($objsarrmaterial); $b++){

								if($objsarrmaterial[$b] > 0){

									for($c =  0; $c < count($objsarrmatlaminar); $c++){

										if($objsarrmatlaminar[$c] == $objsarrmaterial[$b]){

											$objCantKgs = "cantkgs_".$objsarrmaterial[$b].($b + 1);
											$objCantMts = "cantmts_".$objsarrmaterial[$b].($b + 1);
											$objAnchoIdeal = "anchoideal_".$objsarrmaterial[$b].($b + 1);

											$iRegopp["ordoppcantkg"] = $$objCantKgs;
											$iRegopp["ordoppcantmt"] = $$objCantMts;
											$iRegopp["ordoppanchot"] = $$objAnchoIdeal;

											$objsarrmatlaminar[$c] = $objsarrmatlaminar[$c]."//";

											switch ($c) { 
												case 0: $laminado = '1ER LAMINADO';$nrolaminado = "0";break;
												case 1: $laminado = '2DO LAMINADO';$nrolaminado = "1";break;
		    									case 2: $laminado = '3ER LAMINADO';$nrolaminado = "2";break;
		    									case 3: $laminado = '4TO LAMINADO';$nrolaminado = "3";break;
		    									case 4: $laminado = '5TO LAMINADO';$nrolaminado = "5";break;
		    									case 5: $laminado = '6TO LAMINADO';$nrolaminado = "6";break;
											}

											break 2;
										}

									}
								}

							}

						}
						break;
					default:
						$iRegopp["ordoppcantkg"] = $cant_planea;
						$iRegopp["ordoppcantmt"] = $ordoppcantmt;
						$iRegopp["ordoppancref"] = $ordoppancref;
						$iRegopp["ordoppanchot"] = $ordoppanchot;
						break;
				}

				unset($arrtmpopp);

				for ($b = 0; $b < count($arrObject); $b++){

					if($arrObject[$b] > 0){

						$rwOp = loadrecordop($arrObject[$b],$idcon);
						$rwSoliprog = loadrecordsoliprog($rwOp["solprocodigo"],$idcon);
						$sbsql = "
							SELECT op.* FROM op
							LEFT JOIN soliprog ON op.solprocodigo = soliprog.solprocodigo
							LEFT JOIN procedimiento ON op.procedcodigo = procedimiento.procedcodigo ";

						if( $laminado ) $sbsql .= "LEFT JOIN oplaminado ON op.ordprocodigo = oplaminado.ordprocodigo ";

						$sbsql .=
							"WHERE soliprog.produccodigo = '".$rwSoliprog['produccodigo']."' 
							AND op.ordoppcodigo IS NULL AND procedimiento.tipsolcodigo = '".$rwProcedimiento["tipsolcodigo"]."'";

						if( $laminado ) $sbsql .= "AND ordprolamina = '".$laminado."' ";

						unset($laminado);

						$rsOrdenop = fncsqlrun($sbsql,$idcon);
						$nrOrdenop = fncnumreg($rsOrdenop);
						for($c = 0; $c < $nrOrdenop; $c++){
							$rwOrdenop = fncfetch($rsOrdenop,$c);
							$arrtmpopp = ($arrtmpopp)? $arrtmpopp.":|:".$rwOrdenop["ordprocodigo"] : $rwOrdenop["ordprocodigo"];

						}

					}

				}


	//-----------------------------------------------------------------//
	//---------------SE INSERTAN LAS OPP------------------------------//
	//-----------------------------------------------------------------//

				unset($nuidtemp,$nuresult,$nuresult1,$result,$iRegop_opp);

				$nuidtemp = fncnumact(147,$idcon);
				do{
					$nuresult = loadrecordopp($nuidtemp,$idcon);
					if($nuresult == e_empty){
						$iRegopp["ordoppcodigo"] = $nuidtemp;
					}
					$nuidtemp ++;
				}while ($nuresult != e_empty);
					
				$iRegopp["usuacodi"] = $usuacodi;
				$iRegopp["plantacodigo"] = $plantacodigo;
				$iRegopp["ordoppcorte"] = '0';
				$iRegopp["ordoppcomfir"] = 0;

				$result = insrecordopp($iRegopp,$idcon);
				if($result > 0){
					$nuresult1 = fncnumprox(147,$nuidtemp,$idcon);
					if($arrtmpopp) $objsarrtmpopp = explode(":|:", $arrtmpopp); else unset($objsarrtmpopp);

					for($b = 0; $b < count($objsarrtmpopp); $b++){
						//$objPista = 'pista_'.$objsarrtmpopp[$b];  
						//registro de a actualizar
	    				$iRegop_opp["ordprocodigo"] = $objsarrtmpopp[$b];
	    				$iRegop_opp["opestacodigo"] = 2;//programada
	    				//$iRegop_opp["ordpropistap"] = $$objPista;
	    				$iRegop_opp["ordoppcodigo"] = $iRegopp["ordoppcodigo"];
	    				uprecordop_opp($iRegop_opp,$idcon);

					}

					switch ($rwProcedimiento["tipsolcodigo"]) 
					{
						case 2://laminado
							insrecordprogramalaminado(array("ordoppcodigo" => $iRegopp["ordoppcodigo"], "prograindice" => 9999),$idcon);
							break;
						case 3://flexografia
							insrecordprogramaflexo(array("ordoppcodigo" => $iRegopp["ordoppcodigo"], "prograindice" => 9999),$idcon);
							break;
						case 4://corte
							insrecordprogramacorte(array("ordoppcodigo" => $iRegopp["ordoppcodigo"], "prograindice" => 9999),$idcon);
							break;
						case 5://sellado
							insrecordprogramasellado(array("ordoppcodigo" => $iRegopp["ordoppcodigo"], "prograindice" => 9999),$idcon);
							break;
						case 6://troquelado
							insrecordprogramatroquelado(array("ordoppcodigo" => $iRegopp["ordoppcodigo"], "prograindice" => 9999),$idcon);
							break;
						case 7://pauchado
							insrecordprogramapauchado(array("ordoppcodigo" => $iRegopp["ordoppcodigo"], "prograindice" => 9999),$idcon);
							break;
						case 8://doblado
							insrecordprogramadoblado(array("ordoppcodigo" => $iRegopp["ordoppcodigo"], "prograindice" => 9999),$idcon);
							break;
						case 9://microperforado
							insrecordprogramamicroperforado(array("ordoppcodigo" => $iRegopp["ordoppcodigo"], "prograindice" => 9999),$idcon);
							break;
						case 10://corte secundario
							insrecordprogramacorte(array("ordoppcodigo" => $iRegopp["ordoppcodigo"], "prograindice" => 9999),$idcon);
							break;
						case 12://valvulado
							insrecordprogramavalvulado(array("ordoppcodigo" => $iRegopp["ordoppcodigo"], "prograindice" => 9999),$idcon);
							break;
					}

	    		}

	//-----------------------------------------------------------------// 
	//----------------SE INSERTAN LOS MATERIALES-------------------//
	//-----------------------------------------------------------------//

				if($arrmatplan) $objsarrmatplan = explode(":|:",$arrmatplan); else unset($objsarrmatplan);
				//se recorre el array de materiales asignados
				for ($c = 0; $c < count($objsarrmatplan); $c++){

					$rowObject = explode(":-:",$objsarrmatplan[$c]);

					$obj_consumo = "consumo_".$objsarrmatplan[$c];

					if($rowObject[1] > 0){

						$rwProcedimiento1 = loadrecordprocedimiento($rowObject[1],$idcon);
						
						if($rwProcedimiento1["tipsolcodigo"] == $rwProcedimiento["tipsolcodigo"]){

							unset($nuidtemp,$nuresult,$nuresult1,$result,$iRegOppitemdesa);	

							$nuidtemp = fncnumact(233,$idcon);	
							do{
								$nuresult = loadrecordoppitemdesa($nuidtemp,$idcon);
								if($nuresult == e_empty)
									$iRegOppitemdesa["oppitecodigo"] = $nuidtemp;
									$nuidtemp ++;
							}while ($nuresult != e_empty);

							if($rwProcedimiento1["tipsolcodigo"] == 2){//laminado

								if($rowObject[2] == $nrolaminado){

									//se crea el registro para ser insertado
									$iRegOppitemdesa["ordoppcodigo"] = $iRegopp["ordoppcodigo"];
									$iRegOppitemdesa["itedescodigo"] = $rowObject[0];
									$iRegOppitemdesa["oppitecantid"] = $$obj_consumo;
									//se ingresa el resgistro en la base da datos
									$res = insrecordoppitemdesa($iRegOppitemdesa,$idcon); 
									//validacion adicional de error de consecutivo
									if($res == -2){
										//consecutivo para planea item desa
										$nuidtemp = fncnumact(233,$idcon);	
										do{
											$nuresult = loadrecordoppitemdesa($nuidtemp,$idcon);
											if($nuresult == e_empty)
												$iRegOppitemdesa["oppitecodigo"] = $nuidtemp;
											$nuidtemp ++;
										}while ($nuresult != e_empty);
										unset($nuidtemp);unset($objsarrmatplan);
										//se ingresa el registro
										$res = insrecordoppitemdesa($iRegOppitemdesa,$idcon); 
									}

								}

							}else{

								//se crea el registro para ser insertado
								$iRegOppitemdesa["ordoppcodigo"] = $iRegopp["ordoppcodigo"];
								$iRegOppitemdesa["itedescodigo"] = $rowObject[0];
								$iRegOppitemdesa["oppitecantid"] = $$obj_consumo;
								//se ingresa el resgistro en la base da datos
								$res = insrecordoppitemdesa($iRegOppitemdesa,$idcon); 
								//validacion adicional de error de consecutivo
								if($res == -2){
									//consecutivo para planea item desa
									$nuidtemp = fncnumact(233,$idcon);	
									do{
										$nuresult = loadrecordoppitemdesa($nuidtemp,$idcon);
										if($nuresult == e_empty)
											$iRegOppitemdesa["oppitecodigo"] = $nuidtemp;
										$nuidtemp ++;
									}while ($nuresult != e_empty);
									unset($nuidtemp);unset($objsarrmatplan);
									//se ingresa el registro
									$res = insrecordoppitemdesa($iRegOppitemdesa,$idcon); 
								}

							}

						}
					}

				}
				//se actualiza el consecutico de produc padre item
				fncnumprox(233,$iRegOppitemdesa["oppitecodigo"] + 1,$idcon); 

			}

		}

	}
	
	fncclose($idcon);
?>