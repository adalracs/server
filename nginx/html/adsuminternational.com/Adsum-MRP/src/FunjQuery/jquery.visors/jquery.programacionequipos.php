<?php 
	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncsqlrun.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunGen/cargainput.php';
		include '../../FunPerPriNiv/pktblpriorida.php';
		include '../../FunPerPriNiv/pktbltarea.php';
		include '../../FunPerPriNiv/pktblcomponen.php';
		include '../../FunPerPriNiv/pktbltipocomponen.php';
		include '../../FunPerPriNiv/pktbltipomedi.php';
		include '../../FunPerPriNiv/pktbltipotrab.php';
	endif;
	
	$idcon = fncconn();
	
	$sbSql = "	SELECT * FROM programacion LEFT JOIN tareot ON tareot.progracodigo = programacion.progracodigo 
				WHERE programacion.equipocodigo = '{$equipocodigo}' AND programacion.tipmancodigo = '{$tipmancodigo}' AND 
					tareot.tiptracodigo = '{$tiptracodigo}' AND tareot.ordtracodigo IS NULL ORDER BY programacion.progracodigo";
	$rsProgramacion = fncsqlrun($sbSql, $idcon);
	$nrProgramacion = fncnumreg($rsProgramacion);
?>	
<table width="99%" border="0" cellspacing="1" cellpadding="0" align="center">
	<tr><td class="ui-state-default" colspan="3">&nbsp;Rutinas de mantenimiento</td></tr>
	<tr>		  
		<td>
            <table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
          		<tr class="NoiseFooterTD">
            		<td class="ui-state-default estilo1" width="3%" align="center">#Rut.</td>
            		<td class="ui-state-default estilo1" width="6%" align="center">Prioridad</td>
            		<td class="ui-state-default estilo1" width="18%" align="center">Tarea</td>
            		<td class="ui-state-default estilo1" width="15%" align="center">Tipo Componente</td>
            		<td class="ui-state-default estilo1" width="6%" align="center">Dur. OT</td>
            		<td class="ui-state-default estilo1" width="7%" align="center">Periodo</td>
            		<td class="ui-state-default estilo1" width="40%" align="center">Descripci&oacute;n del trabajo</td>
            		<td class="ui-state-default estilo1" width="5%" align="center">Estado</td>
          		</tr>
          		<?php
          			for ($j = 0; $j < $nrProgramacion; $j++):
						($class == "NoiseDataTD") ? $class = "NoiseFooterTD" : $class = "NoiseDataTD"; 
						$rwProgramacion = fncfetch($rsProgramacion, $j);
						
						if($rwProgramacion[progratiedur] < 1):
							$duaracion = ($rwProgramacion[progratiedur] * 60);
							$opttipo = 2;
						else:
							 $duaracion = $rwProgramacion[progratiedur];
							 $opttipo = 1;
						endif;
						
						$arrRutina = $rwProgramacion['progracodigo'].'||'.$rwProgramacion['tipcomcodigo'].'||'.$rwProgramacion['prioricodigo'].'||'.
									$rwProgramacion['tareacodigo'].'||'.$rwProgramacion['otestacodigo'].'||'.$duaracion.'||'.$opttipo.'||'.$rwProgramacion['prograacti']
									.'||'.$rwProgramacion['progranota'];
						
          		?>
				<tr class="<?php echo $class ?>" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)" onclick="showWindow('<?php echo $rwProgramacion['progracodigo'] ?>');">
					<td class="estilo1" align="center"><b>[<?php echo ($j + 1) ?>]</b><input type="hidden" name="arrrutina<?php echo $rwProgramacion['progracodigo'] ?>" id="arrrutina<?php echo $rwProgramacion['progracodigo'] ?>" value="<?php echo $arrRutina ?>"></td>
					<td class="estilo1" align="left">&nbsp;<?php echo cargapriorinombre($rwProgramacion[prioricodigo], $idcon); ?></td>
					<td class="estilo1" align="left">&nbsp;<?php echo cargatareanombre1($rwProgramacion[tareacodigo], $idcon); ?></td>
					<td class="estilo1" align="left">&nbsp;<?php echo cargatipocomponen($rwProgramacion[tipcomcodigo], $idcon); ?></td>
					<td class="estilo1" align="center"><?php if($rwProgramacion[progratiedur] < 1): echo (int) ($rwProgramacion[progratiedur] * 60).' min.'; else: echo $rwProgramacion[progratiedur].' hr.'; endif; ?></td>
					<td class="estilo1" align="center"><?php echo $rwProgramacion[prografrecue]; ?>&nbsp;<?php echo cargatipmnombre($rwProgramacion[tipmedcodigo], $idcon); ?></td>
					<td class="estilo1" align="left">&nbsp;<?php echo $rwProgramacion[progranota]; ?></td>
					<td class="estilo2" align="center">&nbsp;<?php if($rwProgramacion[prograacti] == 1): echo '<b>Activo</b>'; else: echo '<b>Inactivo</b>'; endif; ?></td>
				</tr>
				<?php 
					endfor; ?>
			</table>
		</td>
	</tr>
</table>