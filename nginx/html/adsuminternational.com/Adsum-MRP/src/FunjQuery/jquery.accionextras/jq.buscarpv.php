 <?php 
	//ini_set("display_errors", 1);
	include ("../../FunPerPriNiv/pktblproductoseguimiento.php");	
	include ("../../FunPerPriNiv/pktblproducpedido.php");	
	include ("../../FunPerPriNiv/pktblpedidoventa.php");
	//include ("../jquery.service/jquery.array_json.php");
	include ("../../FunPerPriNiv/pktblproducto.php");
	include ("../../FunPerPriNiv/pktblsoliprog.php");
	include ("../../FunPerPriNiv/pktblusuario.php");
	include ("../../FunPerPriNiv/pktblmodulo.php");
	include ("../../FunPerSecNiv/fncsqlrun.php");
	include ("../../FunPerSecNiv/fncnumreg.php");
	include ("../../FunPerSecNiv/fncclose.php");
	include ("../../FunPerSecNiv/fncfetch.php");
	include ("../../FunPerSecNiv/fncconn.php");
	include ("../../FunPerPriNiv/pktblop.php");
	include ("../../FunGen/cargainput.php");
	include ("../../JSON/JSON.php");

	$producproces = 0;

	$modulo = "";

	if($pedvennumero > 0){

		$idcon = fncconn();

		$rsPedidoVenta = dinamicscanoppedidoventa(array("pedvennumero" => $pedvennumero ),array("pedvennumero" => "=") ,$idcon);
		$nrPedidoVenta = fncnumreg($rsPedidoVenta);

		for($a = 0; $a < $nrPedidoVenta; $a++){

			$rwPedidoVenta = fncfetch($rsPedidoVenta,$a);

			//$rwPedidoVenta = loadrecordpedidoventaPER($rwPedidoVenta["pedvennumero"], $idcon);

			$rwProducPedido = loadrecordproducpedido($rwPedidoVenta["pedvencodigo"],$idcon);

			$rwProducto = loadrecordproducto($rwProducPedido["produccodigo"],$idcon);

			if($rwProducto["producdelrec"] > 0){

				$producproces = $rwProducto["producproces"];
				$produccodigo = $rwProducto["produccodigo"];
				break;
			}			

		}

		fncclose($idcon);

	}


	$respuesta[0]["producproces"] = $producproces;
	$respuesta[0]["produccodigo"] = $produccodigo;

	if($producproces > 5){

		$complemento = "";

		$idcon = fncconn();

		$rsSoliprog = dinamicscanopsoliprog(array("produccodigo" => $produccodigo),array("produccodigo" => "="),$idcon);
		$nrSoliprog = fncnumreg($rsSoliprog);

		for($a = 0; $a < $nrSoliprog; $a++){
			$rwSoliprog = fncfetch($rsSoliprog, $a);

			$solprocodigo = $rwSoliprog["solprocodigo"];

			if($solprocodigo > 0){				
				break;
			}

		}

		$rsOp = dinamicscanopop(array("solprocodigo" => $solprocodigo), array("solprocodigo" => "="), $idcon);
		$nrOp = fncnumreg($rsOp);

		if($nrOp > 0){

			$rsOpp = dinamicscanopop(array("solprocodigo" => $solprocodigo, "ordoppcodigo" => ""), array("solprocodigo" => "=", "ordoppcodigo" => "isnotnull"), $idcon);
			$nrOpp = fncnumreg($rsOpp);

			if($nrOpp > 0){

				$complemento = " - [ OPP Programada ] ";//: [OPP ".$solprocodigo."]";
			}else{

				$complemento = " - [ Bandeja * ] ";
			}

		}else{

			$complemento = " - Solicitudes : [Solicitud No. ".$solprocodigo."]";
		}

		fncclose($idcon);

	}

	switch ($producproces) {
		case 1:
			$respuesta[0]['modulo'] = "Ventas";
			break;
		case 2:
			$respuesta[0]['modulo'] = "Bandeja PV";
			break;
		case 3:
			$respuesta[0]['modulo'] = "Desarrollo";
			break;
		case 4:
			$respuesta[0]['modulo'] = "Dispensing";
			break;
		case 5:
			$respuesta[0]['modulo'] = "Planeacion";
			break;
		case 6:
			$respuesta[0]['modulo'] = "Programacion ".$complemento;
			break;
		case 7:
			$respuesta[0]['modulo'] = "Producccion /Ficha Tecnica ".$complemento;
			break;
		default:
			$respuesta[0]['arrequipo'] = "No se encontro PV";
			break;
	}

	$idcon = fncconn();

	$json = new Services_JSON();

	$rsProductoSeguimiento = dinamicscanopproductoseguimiento(array("produccodigo" => $produccodigo ),array("produccodigo" => "=") ,$idcon);

	$nrProductoSeguimiento = fncnumreg($rsProductoSeguimiento);

	if($nrProductoSeguimiento > 0){


		$strSeguimiento = '';

		$strSeguimiento .= '<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="700">';
		$strSeguimiento .= '<tr>';
		$strSeguimiento .= '<th width="10%" class="NoiseFooterTD">&nbsp;No.</th>';
		$strSeguimiento .= '<th width="20%" class="NoiseFooterTD">&nbsp;Responsable</th>';
		$strSeguimiento .= '<th width="15%" class="NoiseFooterTD">&nbsp;Modulo Origen</th>';
		$strSeguimiento .= '<th width="15%" class="NoiseFooterTD">&nbsp;Modulo Destino</th>';
		$strSeguimiento .= '<th width="10%" class="NoiseFooterTD">&nbsp;Fecha</th>';
		$strSeguimiento .= '<th width="10%" class="NoiseFooterTD">&nbsp;Hora</th>';
		$strSeguimiento .= '<th width="20%" class="NoiseFooterTD">&nbsp;Nota</th>';
		$strSeguimiento .= '</tr>';

  		for($a = 0; $a < $nrProductoSeguimiento; $a++){

  			$rwProductoSeguimiento = fncfetch($rsProductoSeguimiento, $a);

  			$strSeguimiento .= '<tr>';

  			$strSeguimiento .= '<td width="10%" class="NoiseDataTD">&nbsp;'.$rwProductoSeguimiento["prosegcodigo"].'</td>';
  			$strSeguimiento .= '<td width="20%" class="NoiseDataTD">&nbsp;'.cargausuanombre($rwProductoSeguimiento["usuacodi"],$idcon).'</td>';
  			$strSeguimiento .= '<td width="15%" class="NoiseDataTD">&nbsp;'.strtoupper(carganombremodulo($rwProductoSeguimiento["modulocodigoorg"], $idcon)).'</td>';
  			$strSeguimiento .= '<td width="15%" class="NoiseDataTD">&nbsp;'.strtoupper(carganombremodulo($rwProductoSeguimiento["modulocodigodes"], $idcon)).'</td>';
  			$strSeguimiento .= '<td width="10%" class="NoiseDataTD">&nbsp;'.$rwProductoSeguimiento["prosegfecha"].'</td>';
  			$strSeguimiento .= '<td width="10%" class="NoiseDataTD">&nbsp;'.$rwProductoSeguimiento["proseghora"].'</td>';
  			$strSeguimiento .= '<td width="20%" class="NoiseDataTD">&nbsp;'.( ($rwProductoSeguimiento["prosegdescri"])? $rwProductoSeguimiento["prosegdescri"] : '---' ).'</td>';
  			$strSeguimiento .= '</tr>';

  			$strSeguimiento .= '<tr>';
  			$strSeguimiento .= '<td colspan="7" class="NoiseFooterTD">&nbsp;Listado seguimiento Pv No.'.$pedvennumero.'</td>';
  			$strSeguimiento .= '</tr>';
  		}

		$strSeguimiento .= '</table>';

		$respuesta[0]['seguimiento'] = $strSeguimiento;

	}else{

		$strSeguimiento = '';

		$strSeguimiento .= '<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="700">';

		$strSeguimiento .= '<tr>';
		$strSeguimiento .= '<td>';
		$strSeguimiento .= '<div class="ui-widget">';
		$strSeguimiento .= '<div class="ui-state-highlight ui-corner-all" style="padding: 0 .7em;"> ';
		$strSeguimiento .= '<p>';
		$strSeguimiento .= '<span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>';
		$strSeguimiento .= '<strong>Mensaje :</strong>&nbsp;No se encontraron registros Pv No.'.$pedvennumero;		
		$strSeguimiento .= '</p>';

		$strSeguimiento .= '</table>';

		$respuesta[0]['seguimiento'] = $strSeguimiento;

	}

	fncclose($idcon);

	echo $json->encode($respuesta[0]);


?>