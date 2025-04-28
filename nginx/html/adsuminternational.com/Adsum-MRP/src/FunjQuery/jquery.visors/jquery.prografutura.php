<?php 
session_start();
	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerSecNiv/fncsqlrun.php';
		include '../../FunPerPriNiv/pktblparametro.php';
		include '../../FunGen/fncparametro.php';
		include '../../FunGen/fncdatediff.php';
	endif;
	

	$idconn = fncconn();
	$filfecini = date("Y-m").'-01';
	$cols = 12;	
	$widtgrid = 1680;

	if($arrParametros['activa_campo_componen'])
	{
		$cols++;
		$widtgrid += 210;
	}
		
	if($arrParametros['activa_campo_parte'])
	{
		$cols++;
		$widtgrid += 210;
	}
	
	
	$sbSql = "	SELECT programacion.progracodigo,
					tarea.tareanombre,
					programacion.progranota,
					equipo.equiponombre, componen.componnombre, parte.partenombre, tipotrab.tiptranombre, 
					programacion.progratiedur,
					programacion.prografrecue,
					tipomedi.tipmednombre,
					tipomedi.tipmeddescri,
					tipomedi.tipmedtiempo,
					programacion.prografecini,
					programacion.prograrepot
				FROM
					programacion 
					INNER JOIN tareot ON tareot.progracodigo = programacion.progracodigo AND tareot.ordtracodigo IS NULL
					INNER JOIN equipo ON equipo.equipocodigo = programacion.equipocodigo
					INNER JOIN sistema ON sistema.sistemcodigo = equipo.sistemcodigo
					INNER JOIN planta ON planta.plantacodigo = sistema.plantacodigo
					LEFT JOIN componen ON componen.componcodigo = programacion.componcodigo
					LEFT JOIN parte ON parte.partecodigo = programacion.partecodigo
					INNER JOIN tipotrab ON tipotrab.tiptracodigo = tareot.tiptracodigo
					INNER JOIN tarea ON tarea.tareacodigo = tareot.tareacodigo
					INNER JOIN tipomedi ON tipomedi.tipmedcodigo = programacion.tipmedcodigo
				WHERE programacion.prograacti = '1' AND (tipomedi.tipmeddescri IS NOT NULL AND tipomedi.tipmedtiempo IS NOT NULL)";
	//-Filtros
	$sbSql .= (($usuaplanta && !$plantacodigo) ? " AND planta.plantacodigo IN ({$usuaplanta})" : "");
	$sbSql .= (($plantacodigo) ? " AND planta.plantacodigo IN ({$plantacodigo})" : "");
	$sbSql .= (($sistemcodigo) ? " AND sistema.sistemcodigo = '{$sistemcodigo}'" : "");
	$sbSql .= (($equipocodigo) ? " AND programacion.equipocodigo = '{$equipocodigo}'" : "");
	$sbSql .= ($usuatipotrab && !$tiptracodigo) ? " AND tareot.tiptracodigo IN ({$usuatipotrab})" : "";
	$sbSql .= (($tiptracodigo) ? " AND tareot.tiptracodigo = '{$tiptracodigo}'" : "");
	$sbSql .= (($tareacodigo) ? " AND tareot.tareacodigo = '{$tareacodigo}'" : "");
	//-Filtros
	
	$rsProgramacion = fncsqlrun($sbSql, $idconn);
	$nrProgramacion = fncnumreg($rsProgramacion);

	
	
	
	
	if($nrProgramacion > 0)
	{
		if($arrotprograma)
		{
			$array_tmp = explode(',', $arrotprograma);
			$array_key = array_flip($array_tmp);
		}

		$arrYear = array();
		$cont = 0;
		$arrTipo = array(1 => "minutes", 2 => "hours", 3 => "days", 4 => "months");
		
						
		for($a = 0; $a < $nrProgramacion; $a++)
		{
			$rwProgramacion = fncfetch($rsProgramacion, $a);
			
			if(is_array($array_key))
			{
				$checked = '';
				if(array_key_exists($rwProgramacion['progracodigo'], $array_key) || $allotprograma)
					$checked = 'checked';
			}	
			
			

			$strFechaing = "{$rwProgramacion['prografecini']} + ".($rwProgramacion['prografrecue'] * $rwProgramacion['tipmeddescri'])." ".$arrTipo[$rwProgramacion['tipmedtiempo']];
			$prograprxgen = date("Y-m-d", strtotime($strFechaing));
			$difDias = datediff("d", date("Y-m-d"), $prograprxgen);
			$numWeek = date("W",strtotime($prograprxgen));
			$numYear = date("Y",strtotime($prograprxgen));
			
			
			
			$arrYear[$numYear][$numWeek] .= '<tr class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)">'."\n";
			//$arrYear[$numYear][$numWeek] .= '<td width="45" class="maestabl-row-list" style="border-bottom: 1px solid #fff;">';
			//$arrYear[$numYear][$numWeek] .= ($rwProgramacion['prograrepot'] == 'f' && $rwProgramacion['prograreacon'] == 1) ? '----' : '<input type="checkbox" id="chkotprograma" name="chkotprograma" '.$checked.' onclick="setSelectionRow(this.value, document.getElementById('."'arrotprograma'".').value, '."','".', '."'otprograma'".');" value="'.$rwProgramacion['progracodigo'].'">';
			//$arrYear[$numYear][$numWeek] .= '</td>';
			$arrYear[$numYear][$numWeek] .= '<td width="70" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;'.$rwProgramacion['progracodigo'].'</td>'."\n";
			
			if($rwProgramacion['prograrepot'] == 'f' && $rwProgramacion['prograreacon'] == 1)
				$arrYear[$numYear][$numWeek] .= '<td '.(($nrProgramacion > 1) ? 'width="250" colspan="3"' : 'width="252"').' class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<b>POR REPORTAR</b></td>'."\n";
			else
			{
				$arrYear[$numYear][$numWeek] .= '<td width="100" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;'.$rwProgramacion['prografecini'].'</td>'."\n";
				$arrYear[$numYear][$numWeek] .= '<td width="100" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;'.$prograprxgen.'</td>'."\n";
				$arrYear[$numYear][$numWeek] .= '<td width="50" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;'.$difDias.'</td>'."\n";
			}
			
			$arrYear[$numYear][$numWeek] .= '<td width="80" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;'.((strpos($rwProgramacion['progratiedur'], '.')) ? ($rwProgramacion['progratiedur'] * 60).' min.' : $rwProgramacion['progratiedur'].' hr.').'</td>'."\n";
			$arrYear[$numYear][$numWeek] .= '<td width="80" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;'.$rwProgramacion['prografrecue'].' '.$rwProgramacion['tipmednombre'].'</td>'."\n";
			$arrYear[$numYear][$numWeek] .= '<td width="150" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;'.$rwProgramacion['tareanombre'].'</td>'."\n";
			$arrYear[$numYear][$numWeek] .= '<td width="400" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;'.$rwProgramacion['progranota'].'</td>'."\n";
			$arrYear[$numYear][$numWeek] .= '<td width="305" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;'.$rwProgramacion['equipocodigo'].' - '.$rwProgramacion['equiponombre'].'</td>'."\n";
			if($arrParametros['activa_campo_componen'])
				$arrYear[$numYear][$numWeek] .= '<td width="210" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;'.$rwProgramacion['componnombre'].'</td>'."\n";
			if($arrParametros['activa_campo_parte'])
				$arrYear[$numYear][$numWeek] .= '<td width="210" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;'.$rwProgramacion['partenombre'].'</td>'."\n";
			
			$arrYear[$numYear][$numWeek] .= '<td width="150" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;'.$rwProgramacion['tiptranombre'].'</td>'."\n";
			$arrYear[$numYear][$numWeek] .= '<td width="150" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;'.(($rwProgramacion['prograreacon'] == 1) ? "SI" : "NO").'</td>'."\n";
			$arrYear[$numYear][$numWeek] .= '</tr>'."\n";
			
			$cont++;
		}
	}
?>

<div style="width:1098px; height: 400px;  overflow:auto;" class="ui-widget-content">
	<div style="width:<?php echo $widtgrid ?>px; height: auto;">
		<table width="<?php echo $widtgrid ?>" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<!--<th width="45" rowspan="2" class="ui-state-default maestabl-row-list" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel<input type="checkbox" onclick="setSelectionAll('otprograma',',');" value="1" name="allotprograma" id="allotprograma" <?php //if($allotprograma) echo 'checked'; ?> ></th>-->
				<th width="70" rowspan="2" class="ui-state-default maestabl-row-list" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Codigo</th>
				<th width="100" rowspan="2" class="ui-state-default maestabl-row-list" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Fecha ultima generaci&oacute;n</th>
				<th colspan="2" class="ui-state-default maestabl-row-list" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Proxima generaci&oacute;n</th>
				<th width="80" rowspan="2" class="ui-state-default maestabl-row-list" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Duraci&oacute;n Hr.</th>
				<th width="80" rowspan="2" class="ui-state-default maestabl-row-list" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Frecuencia</th>
				<th width="150" rowspan="2" class="ui-state-default maestabl-row-list" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Tarea (Actividad)</th>
				<th width="400" rowspan="2" class="ui-state-default maestabl-row-list" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Descripci&oacute;n</th>
				<th width="305" rowspan="2" class="ui-state-default maestabl-row-list" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Equipo</th>
				<?php if($arrParametros['activa_campo_componen']) { ?><th width="210" rowspan="2" class="ui-state-default maestabl-row-list" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Componente</th><?php } ?>
				<?php if($arrParametros['activa_campo_parte']) { ?><th width="210" rowspan="2" class="ui-state-default maestabl-row-list" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Parte</th><?php } ?>
				<th width="150" rowspan="2" class="ui-state-default maestabl-row-list" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Tipo de trabajo</th>
				<th width="150" rowspan="2" class="ui-state-default maestabl-row-list" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Reprograma al reportar</th>
			</tr>
			<tr>
				<th width="100" class="ui-state-default maestabl-row-list" style="border-bottom:0; border-left:0;">&nbsp;Fecha</th>
				<th width="50" class="ui-state-default maestabl-row-list" style="border-bottom:0; border-left:0;">&nbsp;Dias</th>
			</tr>
		</table>
<?php

	if(is_array($arrYear))
	{
		foreach($arrYear as $nrYear => $arrWeek)
		{
			ksort($arrWeek);
			foreach($arrWeek as $nrSem => $rwValue)
			{
?>
		<table width="<?php echo $widtgrid ?>" border="0" cellspacing="0" cellpadding="0"  align="center">
			<tr><th colspan="<?php echo $cols ?>" class="ui-widget-header maestabl-row-list">Semana <?php echo $nrSem.' ['.$nrYear.']' ?></th></tr>			
<?php		echo $rwValue ?>
		</table>			
<?php 			
			}
		}
	}
?>
		<table width="<?php echo $widtgrid ?>" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	if($cont < 26)
	{
		for($a = $cont; $a < 26; $a++)
		{
?>
			<tr class="NoiseDataTD">
				<!--<td width="45" class="maestabl-row-list" style=" border-bottom: 1px solid #fff;">&nbsp;</td>-->
				<td width="70" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="100" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="100" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="50" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="150" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="400" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="305" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<?php if($arrParametros['activa_campo_componen']) { ?><td width="210" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td><?php } ?>
				<?php if($arrParametros['activa_campo_parte']) { ?><td width="210" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td><?php } ?>
				<td width="150" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="150" class="maestabl-row-list" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
		}
	}
?>
		</table>		
	</div>
</div>
<div style="width:1100px; height: 20px;">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<th class="ui-state-default">&nbsp;No. registros:&nbsp;&nbsp;<span id="activite"><?php echo $nrProgramacion ?></span></th>
			</tr>
		</table>
	</div>
</div>