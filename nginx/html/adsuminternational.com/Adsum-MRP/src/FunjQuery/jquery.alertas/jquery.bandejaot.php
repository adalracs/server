<?php 
	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncsqlrun.php';
		include '../../FunPerSecNiv/fncfetchall.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunGen/cargainput.php';
		include '../../FunPerPriNiv/pktblmenucomp.php';
		include '../../FunPerPriNiv/pktbltipotrab.php';
		include '../../FunPerPriNiv/pktblplanta.php';
	endif;
	
	$fecini = date("Y-m").'-01';
	$fecfin = date("Y-m").'-'.strftime("%d", mktime(0, 0, 0, date("m") + 1, 0, date("Y")));
	
	
	$idcon = fncconn();
	$sbSql = "	SELECT vistabandejaot.tiptracodigo, COUNT(ordtracodigo) AS numreg FROM vistabandejaot 
				WHERE vistabandejaot.plantacodigo IN ({$arrusuaplanta}) AND vistabandejaot.ordtrafecini BETWEEN '{$fecini}' AND '{$fecfin}'";
	
	if($arrusuatipotrab)
			$sbSql .= " AND (vistabandejaot.tiptracodigo IN ({$arrusuatipotrab}) OR vistabandejaot.tiptracodigo IS NULL)";

	$sbSql .= ' GROUP BY vistabandejaot.tiptracodigo ORDER BY vistabandejaot.tiptracodigo';
	
	$rsBandejaOt = fncsqlrun($sbSql, $idcon);
	$rwBandejaOt = fncfetchall($rsBandejaOt);
	$arrBandejaOt = array();
	$ttBandejaOt = 0;
	
	for($a = 0; $a < count($rwBandejaOt); $a++):
		($rwBandejaOt[$a]['tiptracodigo'] == null) ?  $index = 0 : $index = $rwBandejaOt[$a]['tiptracodigo'];
		$arrBandejaOt[$rwBandejaOt[$a]['plantacodigo']][$index] = $rwBandejaOt[$a]['numreg'];
		$ttBandejaOt += $rwBandejaOt[$a]['numreg'];
	endfor;
	
	if($type == 1): //Tipo Lista
		$reccadena= array("mecoacra" => 'botp',"timecodi" => 4);
		$nuresult = dinamicscanmenucomp($reccadena, $idcon);
	
		if($nuresult > 0)
		{
			$sbRow = fncfetch($nuresult, 0);
			$isbacra['botp'] = $sbRow[mecocodi];
			$cadenwindow[$sbRow[mecocodi]] = $sbRow[mecoscri].'?codigo='.$sbRow[mecocodi];
		}
?>	
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
<?php 
	foreach ($arrBandejaOt As $key => $arrBandejaOtpl):
		$nrTipo = count($arrBandejaOtpl);
		$a = 0;
		
		foreach($arrBandejaOtpl As $subkey => $value):
			($subkey === 0) ? $tiptranombre = '------' : $tiptranombre = cargatiptrabnombre($subkey, $idcon); 
			($subkey === 0) ? $subkey = null: $subkey = $subkey;
			echo '<tr>';
			
//			if($a < 1)
//				echo '<td width="50%" rowspan="'.$nrTipo.'" class="ui-state-default">'.cargaplantanombre($key, $idcon).'</td>';
			echo '<td width="80%" class="ui-state-default"><a href="#" onClick="top.frames['."'text'".'].location = '."'{$cadenwindow[$isbacra['botp']]}&tiptracodigo={$subkey}&columnas=tiptracodigo';".'">'.$tiptranombre.'</a></td>';	
								echo '<td width="20%" class="NoiseDataTD" align="center"><b><a href="#" onClick="top.frames['."'text'".'].location = '."'{$cadenwindow[$isbacra['botp']]}&tiptracodigo={$subkey}&columnas=tiptracodigo';".'">'.$value.'</a></b></td>';	
			echo '</tr>';
			$a++;
		endforeach;
	endforeach;
?>
</table>
<?php 
	elseif($type == 2): // Tipo Cantidad
		echo $ttBandejaOt;
	endif;
?>