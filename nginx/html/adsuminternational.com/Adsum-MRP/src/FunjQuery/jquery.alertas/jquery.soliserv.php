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
	
	$idcon = fncconn();
	$sbSql = "SELECT vistasoliserv.tiptracodigo, COUNT(solsercodigo) AS numreg FROM vistasoliserv WHERE vistasoliserv.plantacodigo IN ({$arrusuaplanta})";
	
	if($arrusuatipotrab)
			$sbSql .= " AND (vistasoliserv.tiptracodigo IN ({$arrusuatipotrab}) OR vistasoliserv.tiptracodigo IS NULL)";

	$sbSql .= ' GROUP BY vistasoliserv.tiptracodigo ORDER BY vistasoliserv.tiptracodigo';
	
	$rsSoliserv = fncsqlrun($sbSql, $idcon);
	$rwSoliserv = fncfetchall($rsSoliserv);
	$arrSoliserv = array();
	$ttSoliserv = 0;
	
	for($a = 0; $a < count($rwSoliserv); $a++):
		($rwSoliserv[$a]['tiptracodigo'] == null) ?  $index = 0 : $index = $rwSoliserv[$a]['tiptracodigo'];
		$arrSoliserv[$rwSoliserv[$a]['plantacodigo']][$index] = $rwSoliserv[$a]['numreg'];
		$ttSoliserv += $rwSoliserv[$a]['numreg'];
	endfor;
	
	if($type == 1): //Tipo Lista
		$reccadena= array("mecoacra" => 'sse',"timecodi" => 4);
		$nuresult = dinamicscanmenucomp($reccadena, $idcon);
	
		if($nuresult > 0)
		{
			$sbRow = fncfetch($nuresult, 0);
			$isbacra['sse'] = $sbRow[mecocodi];
			$cadenwindow[$sbRow[mecocodi]] = $sbRow[mecoscri].'?codigo='.$sbRow[mecocodi];
		}
?>	
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
<?php 
	foreach ($arrSoliserv As $key => $arrSolserpl):
		$nrTipo = count($arrSolserpl);
		$a = 0;
		
		foreach($arrSolserpl As $subkey => $value):
			($subkey === 0) ? $tiptranombre = '------' : $tiptranombre = cargatiptrabnombre($subkey, $idcon); 
			($subkey === 0) ? $subkey = null: $subkey = $subkey;
			echo '<tr>';
			
//			if($a < 1)
//				echo '<td width="50%" rowspan="'.$nrTipo.'" class="ui-state-default">'.cargaplantanombre($key, $idcon).'</td>';
			echo '<td width="80%" class="ui-state-default"><a href="#" onClick="top.frames['."'text'".'].location = '."'{$cadenwindow[$isbacra['sse']]}&tiptracodigo={$subkey}&accionconsultarsoliserv=1&columnas=tiptracodigo';".'">'.$tiptranombre.'</a></td>';	
			echo '<td width="20%" class="NoiseDataTD" align="center"><b><a href="#" onClick="top.frames['."'text'".'].location = '."'{$cadenwindow[$isbacra['sse']]}&tiptracodigo={$subkey}&accionconsultarsoliserv=1&columnas=tiptracodigo';".'">'.$value.'</a></b></td>';	
			echo '</tr>';
			$a++;
		endforeach;
	endforeach;
?>
</table>
<?php 
	elseif($type == 2): // Tipo Cantidad
		echo $ttSoliserv;
	endif;
?>