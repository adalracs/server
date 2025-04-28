<?php
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerSecNiv/fncsqlrun.php');
	include ( '../src/FunPerPriNiv/pktblprogramacion.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblsistema.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktbltipomant.php');
	include ( '../src/FunPerPriNiv/pktblcomponen.php');
	include ( '../src/FunPerPriNiv/pktbltipocomponen.php');
	include ( '../src/FunPerPriNiv/pktblparte.php');
	include ( '../src/FunPerPriNiv/pktbltarea.php');
	include ( '../src/FunPerPriNiv/pktbltipomedi.php');
	include ( '../src/FunPerPriNiv/pktbltipotrab.php');
	include ( '../src/FunPerPriNiv/pktblpriorida.php');
	include ( '../src/FunPerPriNiv/pktbltareot.php');
	
	if(!$flagdetallarprogramacion)
	{
		$equipocodigo1 = $equipocodigo; 
		$plantacodigo1 = $plantacodigo; 
		$sistemcodigo1 = $sistemcodigo; 
		$tiptracodigo1 = $tiptracodigo; 
		$tipmancodigo1 = $tipmancodigo; 
		
		if($radiobutton)
			include('detallaprogramacion.php');
		else 
		{
			$nombtabl = 'programacionequipos';
			include( '../src/FunGen/fnccontfron.php');
		}
	}
?>
<html>
	<head>
		<title>Detalle de registro programacion mantenimiento de equipos</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		<style type="text/css">
			.estilo1 {font-size: 90%; font-family : Arial } 
			.estilo2 {font-size: 90%; font-family : Arial; color: red; } 
		</style>
	</head>
<?php if(!$codigo) { echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Programaci&oacute;n Mantenimiento de Equipos</font></p>
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="900">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Detallar porgramac&oacute;n</font></span></td></tr>
				<tr>
					<td>
       					<table width="99%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
       						<tr>
          						<td width="20%" class="NoiseFooterTD">&nbsp;Ubicaci&oacute;n</td>
          						<td width="80%" class="NoiseDataTD">&nbsp;<?php echo $rsPlanta['plantanombre'] ?></td>
          					</tr>
       						<tr>
          						<td class="NoiseFooterTD">&nbsp;Sistema</td>
          						<td class="NoiseDataTD">&nbsp;<?php echo $rsSistema['sistemnombre'] ?></td>
          					</tr>
       						<tr>
          						<td class="NoiseFooterTD">&nbsp;Equipo</td>
          						<td class="NoiseDataTD">&nbsp;<b><?php echo $rsEquipo['equiponombre'] ?></b></td>
          					</tr>
       						<tr>
          						<td class="NoiseFooterTD">&nbsp;Mantenimiento</td>
          						<td class="NoiseDataTD">&nbsp;<?php echo $tipmannombre ?></td>
          					</tr>
       						<tr>
          						<td class="NoiseFooterTD">&nbsp;Tipo trabajo</td>
          						<td class="NoiseDataTD">&nbsp;<b><?php echo $tiptranombre ?></b></td>
          					</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="99%" border="0" cellspacing="1" cellpadding="0" align="center">
							<tr><td class="ui-state-default" colspan="3">&nbsp;Rutinas de mantenimiento</td></tr>
							<?php 
								$idcon = fncconn();
								$sbSql = "	SELECT * FROM programacion LEFT JOIN tareot ON tareot.progracodigo = programacion.progracodigo 
											WHERE programacion.equipocodigo = '{$equipocodigo}' AND programacion.tipmancodigo = '{$tipmancodigo}' AND 
												tareot.tiptracodigo = '{$tiptracodigo}' AND tareot.ordtracodigo IS NULL";
								$rsProgramacion = fncsqlrun($sbSql, $idcon);
								$nrProgramacion = fncnumreg($rsProgramacion);
								
								if($nrProgramacion > 0):
							?>
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
          									$idconn = fncconn();
          									for ($j = 0; $j < $nrProgramacion; $j++):
												($class == "NoiseDataTD") ? $class = "NoiseFooterTD" : $class = "NoiseDataTD"; 
												$rwProgramacion = fncfetch($rsProgramacion, $j);
          								?>
										<tr class="<?php echo $class ?>">
											<td class="estilo1" align="center"><b>[<?php echo ($j + 1) ?>]</b></td>
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
							<?php else: ?>
							<tr><td><div class="ui-widget">
								<div style="margin-top: 0; padding: 0 .7em;" class="ui-state-highlight ui-corner-all"> 
									<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
									<b>No se encontraron rutinas para este equipo</b></p>
								</div>
							</div></td></tr>
							<?php endif ?>
						</table>
					</td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_formdetall.php'; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr> 
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
			</table>
			<input type="hidden" name="flagdetallarprogramacionequipos" value="1">
			<input type="hidden" name="acciondetallarprogramacionequipos">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar">
			<input type="hidden" name="columnas" value="plantacodigo,sistemcodigo,equipocodigo,tipmancodigo,tiptracodigo"> 
			<input type="hidden" name="equipocodigo" value="<?php if($accionconsultarprogramacionequipos) echo $equipocodigo1; ?>"> 
 			<input type="hidden" name="sistemcodigo" value="<?php if($accionconsultarprogramacionequipos) echo $sistemcodigo1; ?>"> 
 			<input type="hidden" name="plantacodigo" value="<?php if($accionconsultarprogramacionequipos) echo $plantacodigo1; ?>"> 
			<input type="hidden" name="tipmancodigo" value="<?php if($accionconsultarprogramacionequipos) echo $tipmancodigo1; ?>">
			<input type="hidden" name="tiptracodigo" value="<?php if($accionconsultarprogramacionequipos) echo $tiptracodigo1; ?>">
 			<input type="hidden" name="accionconsultarprogramacionequipos" value="<?php echo $accionconsultarprogramacionequipos; ?>">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
		</form>
	</body>
</html>