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
	$sbSql = "SELECT vistaotnew.tiptracodigo, COUNT(ordtracodigo) AS numreg FROM vistaotnew WHERE vistaotnew.plantacodigo IN ({$arrusuaplanta})";
	
	if($arrusuatipotrab)
			$sbSql .= " AND (vistaotnew.tiptracodigo IN ({$arrusuatipotrab}) OR vistaotnew.tiptracodigo IS NULL)";

	$sbSql .= ' GROUP BY vistaotnew.tiptracodigo ORDER BY vistaotnew.tiptracodigo';
	
	$rsOt = fncsqlrun($sbSql, $idcon);
	$rwOt = fncfetchall($rsOt);
	$arrOt = array();
	$ttOt = 0;
	
	for($a = 0; $a < count($rwOt); $a++):
		($rwOt[$a]['tiptracodigo'] == null) ?  $index = 0 : $index = $rwOt[$a]['tiptracodigo'];
		$arrOt[$rwOt[$a]['plantacodigo']][$index] = $rwOt[$a]['numreg'];
		$ttOt += $rwOt[$a]['numreg'];
	endfor;
	
	if($type == 1): //Tipo Lista
		$reccadena= array("mecoacra" => 'otm',"timecodi" => 4);
		$nuresult = dinamicscanmenucomp($reccadena, $idcon);
	
		if($nuresult > 0)
		{
			$sbRow = fncfetch($nuresult, 0);
			$isbacra['otm'] = $sbRow[mecocodi];
			$cadenwindow[$sbRow[mecocodi]] = $sbRow[mecoscri].'?codigo='.$sbRow[mecocodi];
		}
	
?>	
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
<?php 
	foreach ($arrOt As $key => $arrOtpl):
		$nrTipo = count($arrOtpl);
		$a = 0;
		
		foreach($arrOtpl As $subkey => $value):
			($subkey === 0) ? $tiptranombre = '------' : $tiptranombre = cargatiptrabnombre($subkey, $idcon); 
			($subkey === 0) ? $subkey = null: $subkey = $subkey;
			echo '<tr>';
			
//			if($a < 1)
//				echo '<td width="50%" rowspan="'.$nrTipo.'" class="ui-state-default">'.cargaplantanombre($key, $idcon).'</td>';
			echo '<td width="80%" class="ui-state-default"><a href="#" onClick="top.frames['."'text'".'].location = '."'{$cadenwindow[$isbacra['otm']]}&tiptracodigo={$subkey}&accionconsultarot=1&columnas=tiptracodigo';".'">'.$tiptranombre.'</a></td>';	
			echo '<td width="20%" class="NoiseDataTD" align="center"><b><a href="#" onClick="top.frames['."'text'".'].location = '."'{$cadenwindow[$isbacra['otm']]}&tiptracodigo={$subkey}&accionconsultarot=1&columnas=tiptracodigo';".'">'.$value.'</a></b></td>';	
			echo '</tr>';
			$a++;
		endforeach;
	endforeach;
?>
</table>
<?php 
	elseif($type == 2): // Tipo Cantidad
		echo $ttOt;
	endif;
?>