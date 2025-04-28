<?php 
ini_set("display_errors", 1);
	//include_once "../../../def/configvarphp.php";
	include "../../FunPerPriNiv/pktblreporteoppreportepn.php";
	include "../../FunPerPriNiv/pktblgestionoppreporte.php";
	include "../../FunPerPriNiv/pktblplanearutaitempv.php";
	include "../../FunPerPriNiv/pktblestadoanalisis.php";
	include "../../FunPerPriNiv/pktblprocedimiento.php";
	include "../../FunPerPriNiv/pktblreporteopp.php";
	include "../../FunPerPriNiv/pktblanalisismp.php";
	include "../../FunPerPriNiv/pktblanalisispr.php";
	include "../../FunPerSecNiv/fncsqlrun.php";
	include "../../FunPerSecNiv/fncnumreg.php";
	include "../../FunPerSecNiv/fncfetch.php";
	include "../../FunPerSecNiv/fncclose.php";
	include "../../FunPerSecNiv/fncconn.php";
	include "../../FunGen/cargainput.php";
	include "../../FunGen/fncdatediff.php";
	
	function innerHTML (&$html, $sbRow, $tipmat, $swth_sel,$sbarray){
		
		$html .= '<tr><td colspan="2" class="ui-state-default estilo2"></td></tr>'."\n";
		$html .= '<tr><td colspan="2" class="ui-state-default estilo2"></td></tr>'."\n";
	
		$html .= '<tr><td valign="top" width="50%">'."\n";
		$html .= '<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content" valign="top">'."\n";
		
		$html .= '<tr><td colspan="2" class="ui-widget-header estilo2">';

		$html .= '<input type="checkbox" name="chkselstar" value="'.$sbarray.'" '.$swth_sel.' onclick="'."setSelectionRow(this.value, document.getElementById('arrmatsaldo').value, ':|:', 'arrmatsaldo');".'">&nbsp;'.$sbRow['idmat'].'-'.$sbRow['nmat'].'</input>';


		$html .= '</td></tr>'."\n";
		
		$html .= '<tr>'."\n";
		$html .= '<td class="ui-widget-header estilo2"  width="35%">&nbsp;Lote:&nbsp;</td>'."\n";
		$html .= '<td class="estilo2">&nbsp;'.$sbRow['nrolote'].'</td>'."\n";
		$html .= '</tr>'."\n";
		
		$html .= '<tr>'."\n";
		$html .= '<td class="ui-widget-header estilo2"  width="35%">&nbsp;Bobina Nro:&nbsp;</td>'."\n";
		$html .= '<td class="estilo2">&nbsp;'.$sbRow['nrobobina'].'</td>'."\n";
		$html .= '</tr>'."\n";
		
		$html .= '<tr>'."\n";
		$html .= '<td class="ui-widget-header estilo2"  width="35%">&nbsp;Kilogramos:&nbsp;</td>'."\n";
		$html .= '<td class="estilo2">&nbsp;'.number_format($sbRow['cantkg'], 2, ",", ".").'</td>'."\n";
		$html .= '</tr>'."\n";
		
		$html .= '<tr>'."\n";
		$html .= '<td class="ui-widget-header estilo2"  width="35%">&nbsp;Metros:&nbsp;</td>'."\n";
		$html .= '<td class="estilo2">&nbsp;'.number_format($sbRow['cantmt'], 2, ",", ".").'</td>'."\n";
		$html .= '</tr>'."\n";
		
		$html .= '</table>'."\n";
		$html .= '</td>'."\n";
		
		$html .= '<td valign="top" width="50%">'."\n";
		
		$html .= '<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content" valign="top">'."\n";
		$html .= '<tr><td colspan="2" class="ui-widget-header estilo2">&nbsp;Observaciones :&nbsp;</td></tr>'."\n";
		
		$html .= '<tr>'."\n";
		$html .= '<td colspan="2" class="estilo2">&nbsp;'.strtoupper($sbRow['desc']).'</td>'."\n";
		$html .= '</tr>'."\n";
		
		$html .= '<tr>'."\n";
		$html .= '<td class="ui-widget-header estilo2"  width="35%">&nbsp;Entregado por:&nbsp;</td>'."\n";
		$html .= '<td class="estilo2">&nbsp;'.$sbRow['aproced'].'</td>'."\n";
		$html .= '</tr>'."\n";
		
		$html .= '<tr>'."\n";
		$html .= '<td class="ui-widget-header estilo2"  width="35%">&nbsp;Calidad:&nbsp;</td>'."\n";
		$html .= '<td class="estilo2">&nbsp;'.strtoupper($sbRow['nest']).'</td>'."\n";
		$html .= '</tr>'."\n";

		$html .= '<tr>'."\n";
		$html .= '<td class="ui-widget-header estilo2"  width="35%">&nbsp;Aclaraci&oacute;n:&nbsp;</td>'."\n";
		$html .= '<td class="estilo2">&nbsp;'.strtoupper($sbRow['aest']).'</td>'."\n";
		$html .= '</tr>'."\n";
		
		$html .= '</table>'."\n";
		
		$html .= '</td>'."\n";
		
		$html .= '</tr>'."\n";	
	}

	//Consulta para materia prima entregada y recibida a la orden
	$idcon = fncconn();
	
	if($arrmatsaldo){
		$array_tmp = explode(':|:',$arrmatsaldo);
		$array_key = array_flip($array_tmp);
	}
	
	$sbsqlMtprima = " 
		SELECT  gestionopp.gesoppcodigo , gestionoppreporte.geoprecodigo AS idtran ,gestionoppreporte.gesoppcodigo, 
					gestionoppreporte.itedescodigo AS idmat,itemdesa.itedesnombre AS nmat, gestionoppreporte.gesoppcantkg AS cantkg ,gestionoppreporte.gesoppcantmt AS cantmt,
 					gestionoppreporte.gesoppnorollo AS nrobobina ,lote.lotecodigo ,lote.lotenumero AS nrolote ,gestionopp.gesoppdescri AS desc
 		 FROM gestionopp
		LEFT JOIN gestionoppreporte ON gestionopp.gesoppcodigo = gestionoppreporte.gesoppcodigo
		LEFT JOIN lote  ON gestionoppreporte.lotecodigo = lote.lotecodigo
		LEFT JOIN itemdesa ON gestionoppreporte.itedescodigo = itemdesa.itedescodigo
		WHERE gestionoppreporte.gesoppcodigo is not null 
		AND gestionoppreporte.geopreestado > 0
		AND gestionopp.ordoppcodigo = ' ".$ordoppcodigo." ' ";
	
	$rsMtprima = fncsqlrun($sbsqlMtprima,$idcon);
	$nrMtprima = fncnumreg($rsMtprima);

	$idcon = fncconn();

	for( $a = 0; $a < $nrMtprima; $a++){

		$rwMtprima = fncfetch($rsMtprima,$a);
		$rwMtprima['aproced'] = 'Bodega MP';
		$sbarray = $rwMtprima['idtran'].':-:0';//0 para identificar que es materia prima

		$rsAnalisisMp = dinamicscanopanalisismp(array("lotecodigo" => $rwMtprima["lotecodigo"], "analisestado" => "2"), array("lotecodigo" => "=", "analisestado" => "="), $idcon);
		$nrAnalisisMp = fncnumreg($rsAnalisisMp);

		if($nrAnalisisMp > 0){

			$rwAnalisisMp = fncfetch($rsAnalisisMp,0);
			$rwEstadoAnalisis = loadrecordestadoanalisis($rwAnalisisMp["analisestado"], $idcon);

			$rwMtprima["nest"] = $rwEstadoAnalisis["estananombre"];
			$rwMtprima["aest"] = $rwAnalisisMp["analisdescri"];
		}else{

			$rwMtprima["nest"] = "cuarentena";
			$rwMtprima["aest"] = "";
		}

		if(is_array($array_key)){

			$swth_sel = '';
			if(array_key_exists($sbarray, $array_key))
				$swth_sel = 'checked';
		}
		
		innerHTML($materiaprima, $rwMtprima, 0, $swth_sel, $sbarray); 
	}

	//Consulta para saldos entregada y recibida a la orden 
	$idcon = fncconn();

	$sbsqlMtsaldo = " 
		SELECT  gestionopp.gesoppcodigo , gestionoppreportesaldo.geoprecodigo AS idtran ,gestionoppreportesaldo.gesoppcodigo, 
					saldo.itedescodigo AS idmat,itemdesa.itedesnombre AS nmat, saldo.saldocantkgs AS cantkg ,saldo.saldocantmts AS cantmt,
 					lote.lotecodigo, lote.lotenumero AS nrolote ,gestionopp.gesoppdescri AS desc
 		 FROM gestionopp
		LEFT JOIN gestionoppreportesaldo ON gestionopp.gesoppcodigo = gestionoppreportesaldo.gesoppcodigo
		LEFT JOIN saldo ON gestionoppreportesaldo.saldocodigo = saldo.saldocodigo
		LEFT JOIN lote  ON saldo.lotecodigo = lote.lotecodigo
		LEFT JOIN itemdesa ON saldo.itedescodigo = itemdesa.itedescodigo
		WHERE gestionoppreportesaldo.gesoppcodigo is not null 
		AND gestionoppreportesaldo.geopreestado > 0
		AND gestionopp.ordoppcodigo = '{$ordoppcodigo}' ";


	$rsMtsaldo = fncsqlrun($sbsqlMtsaldo,$idcon);
	$nrMtsaldo = fncnumreg($rsMtsaldo);

	$idcon = fncconn();
	
	for( $a = 0; $a < $nrMtsaldo; $a++){

		$rwMtsaldo = fncfetch($rsMtsaldo,$a);

		$rwMtsaldo['aproced'] = 'Bodega MP';
		$sbarray = $rwMtsaldo['idtran'].':-:2';//2 para identificar que es saldo

		$rsAnalisisMp = dinamicscanopanalisismp(array("lotecodigo" => $rwMtsaldo["lotecodigo"], "analisestado" => "2"), array("lotecodigo" => "=", "analisestado" => "="), $idcon);
		$nrAnalisisMp = fncnumreg($rsAnalisisMp);

		if($nrAnalisisMp > 0){

			$rwAnalisisMp = fncfetch($rsAnalisisMp,0);
			$rwEstadoAnalisis = loadrecordestadoanalisis($rwAnalisisMp["analisestado"], $idcon);

			$rwMtsaldo["nest"] = $rwEstadoAnalisis["estananombre"];
			$rwMtsaldo["aest"] = $rwAnalisisMp["analisdescri"];
		}else{

			$rwMtsaldo["nest"] = "cuarentena";
			$rwMtsaldo["aest"] = "";
		}

		if(is_array($array_key)){

			$swth_sel = '';
			if(array_key_exists($sbarray, $array_key))
				$swth_sel = 'checked';
		}
		
		innerHTML($materialsaldo, $rwMtsaldo, 0, $swth_sel, $sbarray); 
	}

	//se consulta los reportes de produccion de las ordenes pasadas.
	$idcon = fncconn();
	
	$rsPlanearutaitempv = dinamicscanplanearutaitempv(array('produccodigo' => $produccodigo ),$idcon);
	$nrPlanearutaitempv = fncnumreg($rsPlanearutaitempv);
	$procedcodigo1 = 0;

	for( $a = 0; $a < $nrPlanearutaitempv; $a++){

		$rwPlanearutaitempv = fncfetch($rsPlanearutaitempv,$a);
		if($rwPlanearutaitempv['procedcodigo'] == $procedcodigo && $a > 0){

			$rwPlanearutaitempv1 = fncfetch($rsPlanearutaitempv,$a-1);
			$procedcodigo1 = $rwPlanearutaitempv1['procedcodigo'];
		}

		if($procedcodigo1 > 0){
			break;
		}

	}

	$sbsqlMtproceso = "
		SELECT 
  			DISTINCT op.ordoppcodigo, op.solprocodigo,reporteopp.repoppcodigo,reporteoppreportepn.reoppncodigo AS idtran,
  			reporteoppreportepn.reoppncantkg AS cantkg, reporteoppreportepn.reoppncantmt AS cantmt, reporteoppreportepn.reoppncantun AS cantun,
  			reporteoppreportepn.reoppnbobina AS nrobobina, procedimiento.procednombre AS aproced ,reporteoppreportepn.reoppndescri AS desc FROM op 
  		LEFT JOIN reporteopp ON op.ordoppcodigo = reporteopp.ordoppcodigo
		LEFT JOIN reporteoppreportepn ON reporteopp.repoppcodigo= reporteoppreportepn.repoppcodigo
		LEFT JOIN procedimiento ON op.procedcodigo= procedimiento.procedcodigo
		WHERE op.procedcodigo = '{$procedcodigo1}' AND op.solprocodigo = '{$solprocodigo}' AND reporteopp.repoppcodigo is not null ";
	
	$rsMtproceso = fncsqlrun($sbsqlMtproceso,$idcon);
	$nrMtproceso = fncnumreg($rsMtproceso);

	$idcon = fncconn();
	
	for( $a = 0; $a < $nrMtproceso; $a++){

		$rwMtproceso = fncfetch($rsMtproceso,$a);

		$rwMtproceso['idmat'] = $produccoduno;
		$rwMtproceso['nmat'] = $producnombre;
		$rwMtproceso['nrolote'] = $solprocodigo.'-'.$ordoppcodigo.'-'.$rwMtproceso['repoppcodigo'];
		$sbarray = $rwMtproceso['idtran'].':-:1';//1 para identificar que es material en proceso

		$rsAnalisisPr = dinamicscanopanalisispr(array("ordoppcodigo" => $rwMtproceso["ordoppcodigo"], "estanacodigo" => "2"), array("lotecodigo" => "=", "estanacodigo" => "="), $idcon);
		$nrAnalisisPr = fncnumreg($rsAnalisisPr);

		if($nrAnalisisPr > 0){

			$rwAnalisisPr = fncfetch($rsAnalisisPr,0);
			$rwEstadoAnalisis = loadrecordestadoanalisis($rwAnalisisPr["estanacodigo"], $idcon);

			$rwMtproceso["nest"] = $rwEstadoAnalisis["estananombre"];
			$rwMtproceso["aest"] = $rwAnalisisPr["analisdescri"];
		}else{

			$rwMtproceso["nest"] = "cuarentena";
			$rwMtproceso["aest"] = "";
		}


		if(is_array($array_key)){

			$swth_sel = '';
			if(array_key_exists($sbarray, $array_key)){
				$swth_sel = 'checked';
			}

		}
		
		innerHTML($materialproceso, $rwMtproceso, 0, $swth_sel, $sbarray); 
	}

?>
	<table width="900px" border="0" cellspacing="1" cellpadding="0" align="left">
		<tr><td class="ui-state-highlight estilo2" colspan="2">&nbsp;<b>Materia prima.</b></td></tr>
<?php 
	echo $materiaprima;
?>
		<tr><td colspan="2" class="ui-state-default estilo2"></td></tr>
		<tr><td colspan="2" class="ui-state-default estilo2"></td></tr>
		<tr><td class="ui-state-highlight estilo2" colspan="2">&nbsp;<b>Saldos.</b></td></tr>
<?php
	echo $materialsaldo;
?>
		<tr><td colspan="2" class="ui-state-default estilo2"></td></tr>
		<tr><td colspan="2" class="ui-state-default estilo2"></td></tr>
		<tr><td class="ui-state-highlight estilo2" colspan="2">&nbsp;<b>Material de producto en proceso.</b></td></tr>
<?php 
	echo $materialproceso;
?>
</table>