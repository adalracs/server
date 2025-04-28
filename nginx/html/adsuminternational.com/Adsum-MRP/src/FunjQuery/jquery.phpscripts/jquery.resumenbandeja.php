<?php 
	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunPerSecNiv/fncclose.php';
	include '../../FunPerSecNiv/fncnumreg.php';
	include '../../FunPerSecNiv/fncfetch.php';
	include '../../FunGen/cargainput.php';
	include '../../FunPerPriNiv/pktblplanta.php';
	include '../../FunPerPriNiv/pktbltipotrab.php';
	
	$arr_plantas = array();
	$arr_tipotraba = array();
	$arr_activ = array();
	$arr_subttb = array();
	
	if($arr_tipotrab)
		$query = " AND tiptracodigo IN ({$arr_tipotrab})";
	
	$idcon = fncconn();
	$sbSQL = "SELECT vistabandejaot.tiptracodigo, vistabandejaot.plantacodigo, COUNT(vistabandejaot.ordtracodigo) AS num_ot FROM vistabandejaot
				WHERE vistabandejaot.plantacodigo IN ({$arr_planta}) {$query} GROUP BY vistabandejaot.plantacodigo, vistabandejaot.tiptracodigo
				ORDER BY vistabandejaot.plantacodigo";

	
	$rs_vistabandejaot = pg_exec($idcon, $sbSQL);
	$nr_vistabandejaot = fncnumreg($rs_vistabandejaot);
	
	for($a = 0; $a < $nr_vistabandejaot; $a++):
		$rw_vistabandejaot = fncfetch($rs_vistabandejaot, $a);
		$arr_tipotraba[$rw_vistabandejaot[0]] = cargatiptrabnombre($rw_vistabandejaot[0], $idcon);
		$arr_plantas[$rw_vistabandejaot[1]] = cargaplantanombre($rw_vistabandejaot[1], $idcon);
		$arr_activ[$rw_vistabandejaot[1]][$rw_vistabandejaot[0]] = $rw_vistabandejaot[2];
	endfor;
	if($nr_vistabandejaot > 0):
		$width = 80 / count($arr_tipotraba);
?>

<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
	<tr>
		<td width="20">&nbsp;</td>
		<?php foreach($arr_tipotraba as $key => $tiptranombre): ?>
		<td class="ui-state-default resum-title" width="<?php echo $width ?>%"><?php echo $tiptranombre; $arr_subttb[] = $key; ?></td>
		<?php endforeach;?>
	</tr>
	<?php foreach($arr_plantas as $key_a => $plantanombre): ?>
	<tr>
		<td class="ui-state-default resum-title"><?php echo $plantanombre ?></td>
		<?php for($a = 0; $a < count($arr_subttb); $a++): ?>
		<td class="NoiseDataTD resum-title" align="center"><a href="javascript:reloadforresume('<?php echo $key_a ?>','<?php echo $arr_subttb[$a] ?>');"><b><?php echo $arr_activ[$key_a][$arr_subttb[$a]] ?> ot(s)</b></a></td>
		<?php endfor;?>
	</tr>
	<?php endforeach; ?>
</table>
<?php else: ?>
<div class="ui-widget">
	<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
		<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
		No se encontraron actividades.</p>
	</div>
</div>
<?php endif; ?>