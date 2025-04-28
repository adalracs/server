<?php 
ini_set('display_errors',1);
	//include_once "../../../def/configvarphp.php";
	include '../../FunPerPriNiv/pktblreporteoppreportepn.php';
	include '../../FunPerPriNiv/pktblreporteoppestado.php';
	include '../../FunPerPriNiv/pktblprocedimiento.php';
	include '../../FunPerPriNiv/pktblreporteopp.php';
	include '../../FunPerSecNiv/fncnumreg.php';
	include '../../FunPerSecNiv/fncfetch.php';
	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunPerSecNiv/fncclose.php';
	include '../../FunPerSecNiv/fncsqlrun.php';
	include '../../FunGen/cargainput.php';
	include '../../FunGen/fncdatediff.php';
	
	function innerHTML (&$html, $sbRow, $tipmat, $swth_sel,$sbarray)
	{
		$idcon = fncconn();
		
		$html .= '<tr><td colspan="2" class="ui-state-default estilo2"></td></tr>'."\n";
		$html .= '<tr><td colspan="2" class="ui-state-default estilo2"></td></tr>'."\n";
	
		$html .= '<tr><td valign="top" width="50%">'."\n";
		$html .= '<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content" valign="top">'."\n";
		
		$html .= '<tr><td colspan="2" class="ui-widget-header estilo2"><input type="checkbox" name="chkselstar" value="'.$sbarray.'" '.$swth_sel.' onclick="'."setSelectionRow(this.value, document.getElementById('arroe').value, ',', 'arroe');".'">&nbsp;'.$sbRow['idmat'].'-'.$sbRow['nmat'].'</input></td></tr>'."\n";
		
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
		$html .= '<td class="estilo2">&nbsp;'.number_format($sbRow['cantkg'],2,',','.').'</td>'."\n";
		$html .= '</tr>'."\n";
		
		$html .= '<tr>'."\n";
		$html .= '<td class="ui-widget-header estilo2"  width="35%">&nbsp;Metros:&nbsp;</td>'."\n";
		$html .= '<td class="estilo2">&nbsp;'.number_format($sbRow['cantmt'],2,',','.').'</td>'."\n";
		$html .= '</tr>'."\n";
		
		$html .= '<tr>'."\n";
		$html .= '<td class="ui-widget-header estilo2"  width="35%">&nbsp;Unidades:&nbsp;</td>'."\n";
		$html .= '<td class="estilo2">&nbsp;'.number_format($sbRow['cantun'],2,',','.').'</td>'."\n";
		$html .= '</tr>'."\n";
		
		$html .= '</table>'."\n";
		$html .= '</td>'."\n";
		
		$html .= '<td valign="top" width="50%">'."\n";
		
		$html .= '<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content" valign="top">'."\n";
		$html .= '<tr><td colspan="2" class="ui-widget-header estilo2">&nbsp;Observaciones :&nbsp;</td></tr>'."\n";
		
		$html .= '<tr>'."\n";
		$html .= '<td class="estilo2">&nbsp;'.strtoupper($sbRow['desc']).'</td>'."\n";
		$html .= '</tr>'."\n";
		
		$html .= '<tr>'."\n";
		$html .= '<td class="ui-widget-header estilo2"  width="35%">&nbsp;Entrado por:&nbsp;</td>'."\n";
		$html .= '<td class="estilo2">&nbsp;'.$sbRow['aproced'].'</td>'."\n";
		$html .= '</tr>'."\n";
		
		$html .= '<tr>'."\n";
		$html .= '<td class="ui-widget-header estilo2"  width="35%">&nbsp;Estado:&nbsp;</td>'."\n";
		$html .= '<td class="estilo2">&nbsp;'.$sbRow['nest'].'</td>'."\n";
		$html .= '</tr>'."\n";
		
		$html .= '</table>'."\n";
		
		$html .= '</td>'."\n";
		
		$html .= '</tr>'."\n";
		
		fncclose($idcon);
	}
	
	if($arroe)
	{
		$array_tmp = explode(',',$arroe);
		$array_key = array_flip($array_tmp);
	}
	
	$idcon = fncconn();
	
	$rsReporteopp = dinamicscanopreporteopp(array('ordoppcodigo' => $ordoppcodigo, 'repopptipo' => 1),array('ordoppcodigo' => '=', 'repopptipo' => '='),$idcon);
	$nrReporteopp = fncnumreg($rsReporteopp);

	for($a = 0; $a < $nrReporteopp; $a++)
	{
		$idcon = fncconn();//conexion adicional
		$rwReporteopp = fncfetch($rsReporteopp,$a);
		$rsReporteoppreportepn = dinamicscanopreporteoppreportepn(array('repoppcodigo' => $rwReporteopp['repoppcodigo']),array('repoppcodigo' => '='),$idcon);
		$nrReporteoppreportepn = fncnumreg($rsReporteoppreportepn);
		for($b = 0; $b < $nrReporteoppreportepn; $b++)
		{
			$rwReporteoppreportepn = fncfetch($rsReporteoppreportepn,$b);
			$rwReport['idmat'] = $produccoduno;
			$rwReport['nmat'] = $producnombre;
			$rwReport['nrolote'] = $solprocodigo.'-'.$ordoppcodigo.'-'.$rwReporteopp['repoppcodigo'];
			$rwReport['nrobobina'] = $rwReporteoppreportepn['reoppnbobina'];
			$rwReport['cantkg'] = $rwReporteoppreportepn['reoppncantkg'];
			$rwReport['cantmt'] = $rwReporteoppreportepn['reoppncantmt'];
			$rwReport['cantun'] = $rwReporteoppreportepn['reoppncantun'];
			$rwReport['desc'] = $rwReporteoppreportepn['reoppndescri'];
			$rwReport['aproced'] = $procednombre;
			$rwReport['nest'] = cargareproteoppestanombre($rwReporteopp['roestacodigo'],$idcon);
			
			if(is_array($array_key))
			{
				$swth_sel = '';
				if(array_key_exists($rwReporteoppreportepn['reoppncodigo'], $array_key))
					$swth_sel = 'checked';
			}
		
			innerHTML($reporteOE, $rwReport, 0, $swth_sel, $rwReporteoppreportepn['reoppncodigo']); 	
		}
	}	
?>
	<table width="900px" border="0" cellspacing="1" cellpadding="0" align="left">
		<tr><td class="ui-state-highlight estilo2" colspan="2">&nbsp;<b>Reportes Produccion.</b></td></tr>
<?php 
	echo $reporteOE;
?>
		<tr><td colspan="2" class="ui-state-default estilo2"></td></tr>
		<tr><td colspan="2" class="ui-state-default estilo2"></td></tr>
</table>