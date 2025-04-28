<?php 

	if(!$noAjax)
	{
		include '../../FunGen/cargainput.php';
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerSecNiv/fncsqlrun.php';
		include '../../FunPerPriNiv/pktblitemdesa.php';
		include '../../FunPerPriNiv/pktblprocedimiento.php';
		include '../../FunPerPriNiv/pktblreporteopp.php';
		include '../../FunPerPriNiv/pktblreporteoppreportepn.php';
		include '../../FunPerPriNiv/pktblplanearutaitempv.php';
		include '../../FunPerPriNiv/pktblgestionoppreporte.php';
	}
	
	$idcon = fncconn();
	//consulta para obtener las bobinas reportadas de materia prima
	$sbsqlMtprima = " 
		SELECT  gestionopp.gesoppcodigo,gestionoppreporte.geoprecodigo,gestionoppreporte.gesoppcodigo,
					gestionoppreporte.itedescodigo,gestionoppreporte.gesoppcantkg,gestionoppreporte.gesoppcantmt,
 					gestionoppreporte.gesoppbobina,gestionoppreporte.gesoppnolote FROM gestionopp
		LEFT JOIN gestionoppreporte ON gestionopp.gesoppcodigo = gestionoppreporte.gesoppcodigo
		WHERE gestionoppreporte.gesoppcodigo is not null AND gestionopp.ordoppcodigo = ' ".$ordoppcodigo." ' ";
	
	$rsGestionoppreporte = fncsqlrun($sbsqlMtprima,$idcon);
	$nrGestionoppreporte = fncnumreg($rsGestionoppreporte);
	
	//se consulta la tabla planearutaitempv que contiene la ruta de cada pedido con su respecivo orden
	//lo anterior para saber que materiales le han entregado o reportado del proceso anterios
	$rsPlanearutaitempv = dinamicscanplanearutaitempv(array('produccodigo' => $produccodigo ),$idcon);
	$nrPlanearutaitempv = fncnumreg($rsPlanearutaitempv);
	$procedcodigo1 = 0;
	for( $a = 0; $a < $nrPlanearutaitempv; $a++)
	{
		$rwPlanearutaitempv = fncfetch($rsPlanearutaitempv,$a);
		if($rwPlanearutaitempv['procedcodigo'] == $procedcodigo && $a > 0)
		{
			$rwPlanearutaitempv1 = fncfetch($rsPlanearutaitempv,$a-1);
			$procedcodigo1 = $rwPlanearutaitempv1['procedcodigo'];
		}
		if($procedcodigo1 > 0)
		{
			break;
		}
	}
	//se consulta las ordenes de opp que sean del proceso antes para consultar sus reportes
	$sbsqlMtproceso = "
		SELECT 
  			DISTINCT op.ordoppcodigo,op.solprocodigo,reporteopp.repoppcodigo,reporteoppreportepn.reoppncodigo,reporteoppreportepn.reoppncantkg, 
  			reporteoppreportepn.reoppncantmt, reporteoppreportepn.reoppncantun,reporteoppreportepn.reoppnbobina, 
  			reporteoppreportepn.reoppndescri FROM op 
  		LEFT JOIN reporteopp ON op.ordoppcodigo = reporteopp.ordoppcodigo
		LEFT JOIN reporteoppreportepn ON reporteopp.repoppcodigo= reporteoppreportepn.repoppcodigo
		WHERE op.procedcodigo = '".$procedcodigo1."' AND op.solprocodigo = '".$solprocodigo."' AND reporteopp.repoppcodigo is not null ";
	
	$rwProcedimiento = loadrecordprocedimiento($procedcodigo1,$idcon);
	$rsGestionoppreporte1 = fncsqlrun($sbsqlMtproceso,$idcon);
	$nrGestionoppreporte1 = fncnumreg($rsGestionoppreporte1);
?>
<div style="width:950px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="30" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel</td>
				<td width="70" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Item</td>
				<td width="325" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Material</td>
				<td width="70" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Kilos&nbsp;<b>(kgs)</b></td>
				<td width="90" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Metros&nbsp;<b>(mts)</b></td>
				<td width="80" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;# Bobina</td>
				<td width="70" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Lote</td>
				<td width="150" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Entregado por</td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:950px; height: 250px; overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:100%; height: auto;  z-index: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 

 if($nrGestionoppreporte)
 {
	if($arrmatrep)
	{
		$array_tmp = explode(':|:',$arrmatrep);
		$array_key = array_flip($array_tmp);
	}
	
	unset($newRow);
	for($a = 0;$a< $nrGestionoppreporte;$a++){
		$rwGestionoppreporte = fncfetch($rsGestionoppreporte,$a);
		$newRow = $rwGestionoppreporte['geoprecodigo'].':-:0';
		$rwItemdesa = loadrecorditemdesa($rwGestionoppreporte['itedescodigo'],$idcon);
		($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
		
		if(is_array($array_key))
		{
			$checked = '';
			if(array_key_exists($newRow, $array_key))
				$checked = 'checked';
		}
?>
			<tr <?php echo $complement ?>">
				<td width="30" style=" border-bottom: 1px solid #fff;"><?php if(!$flagdetallar):?><input type="checkbox" name="chkarrmatrep" id="chkarrmatrep" <?php echo $checked ?> value="<?php echo $newRow ?>" onclick="setSelectionRow(this.value, document.getElementById('arrmatrep').value, ':|:', 'arrmatrep');" /><?php else:?>&nbsp;&nbsp;&nbsp;<b>X</b><?php endif;?></td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItemdesa['itedescodigo']; ?></td>
				<td width="325" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItemdesa['itedesnombre']; ?> </td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwGestionoppreporte['gesoppcantkg']; ?></td>
				<td width="90" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwGestionoppreporte['gesoppcantmt']; ?></td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwGestionoppreporte['gesoppbobina']; ?></td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwGestionoppreporte['gesoppnolote']; ?></td>
				<td width="148" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;Bodegas</td>
			</tr>
<?php 
	}
	
	
unset($newRow);
 for($c = 0;$c< $nrGestionoppreporte1;$c++){
	$rwGestionoppreporte1 = fncfetch($rsGestionoppreporte1,$c);
	$newRow = $rwGestionoppreporte1['reoppncodigo'].':-:1';
	$a++;
	($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
		
		if(is_array($array_key))
		{
			$checked = '';
			if(array_key_exists($newRow, $array_key))
				$checked = 'checked';
		}
?>
			<tr <?php echo $complement ?>">
				<td width="30" style=" border-bottom: 1px solid #fff;"><?php if(!$flagdetallar):?><input type="checkbox" name="chkarrmatrep" id="chkarrmatrep" <?php echo $checked ?> value="<?php echo $newRow ?>" onclick="setSelectionRow(this.value, document.getElementById('arrmatrep').value, ':|:', 'arrmatrep');" /><?php else:?>&nbsp;&nbsp;&nbsp;<b>X</b><?php endif;?></td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $produccoduno; ?></td>
				<td width="325" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $producnombre; ?> </td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwGestionoppreporte1['reoppncantkg']; ?></td>
				<td width="90" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwGestionoppreporte1['reoppncantmt']; ?></td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwGestionoppreporte1['reoppnbobina']; ?></td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwGestionoppreporte1['solprocodigo'].'-'.$rwGestionoppreporte1['ordoppcodigo'].'-'.$rwGestionoppreporte1['repoppcodigo']; ?></td>
				<td width="148" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwProcedimiento['procednombre']; ?></td>
			</tr>
<?php 
	}
	
	
 }
	
	if($a < 20){
		for($b = $a; $b < 20; $b++){
			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="30" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="325" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="90" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="148" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
			}
		}
?>
		</table>
	</div>
</div>