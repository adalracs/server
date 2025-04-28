<?php 
ob_start();
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunGen/cargainput.php');
	include ( '../src/FunPerPriNiv/pktblcurso.php');
	include ( '../src/FunPerPriNiv/pktblgrupcapa.php');
	include ( '../src/FunPerPriNiv/pktblmateapoy.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktbltema.php');
	include ( '../src/FunPerPriNiv/pktblcargo.php');
	include ( '../src/FunPerPriNiv/pktbldepartam.php');
	
	include ( '../src/FunPerPriNiv/pktblubicaccapaci.php'); 
	include ( '../src/FunPerPriNiv/pktblsaloncapaci.php');
	include ( '../src/FunPerPriNiv/pktblcapacitema.php');
	include ( '../src/FunPerPriNiv/pktblcapaciusuario.php');
	
	if($accioneditarcapacitacion) 
	{ 
		include ( 'editaccapacitacion.php'); 
		$flageditarcapacitacion = 1;
	}
ob_end_flush();
	if(!$flageditarcapacitacion)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');

		$cursocodigo = $sbreg['cursocodigo'];
		$ubicapcodigo = $sbreg['ubicapcodigo'];
		$salcapcodigo = $sbreg['salcapcodigo'];
		$departcodigo = $sbreg['departcodigo'];
		$usuacodigo = $sbreg['usuacodi'];
		$capacicodigo = $sbreg['capacicodigo'];
		$capacifecini = date("Y-m-d h:i a", strtotime($sbreg['capacifecini'].' '.$sbreg['capacihorini']));
	}
	
	$idcon = fncconn();
	$rsCurso = loadrecordcurso($cursocodigo, $idcon);
	$rsUbicacion = loadrecordubicaccapaci($ubicapcodigo, $idcon);
	$rsSalon = loadrecordsaloncapaci($salcapcodigo, $idcon);
	$rsDepartam = ($departcodigo) ? loadrecorddepartam($departcodigo, $idcon) : null;
	$rsUsuario = loadrecordusuario($usuacodigo, $idcon);
	
	$rsCapacitema = dinamicscancapacitema(array('capacicodigo' => $capacicodigo), $idcon);
	$nrCapacitema = fncnumreg($rsCapacitema);
	
	$rsCapaciusuario = dinamicscancapaciusuario(array('capacicodigo' => $capacicodigo), $idcon);
	$nrCapaciusuario = fncnumreg($rsCapaciusuario);
?>
<html> 
	<head> 
		<title>Nuevo calificacion de capacitacion</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
			<script type="text/javascript">
		</script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Calificaci&oacute;n de capacitaci&oacute;n</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="700">
<?php if($campnomb): ?>
				<tr><td><div class="ui-widget">
					<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
						<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
						<strong>Advertencia:</strong> Corrija los campos marcados con *</p>
					</div>
				</div></td></tr>
<?php else: ?> 		
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
<?php endif; ?>
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Calificar</font></span></td></tr> 
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
							<tr>
								<td class="NoiseFooterTD">&nbsp;C&oacute;digo</td>
								<td colspan="3" class="NoiseDataTD"><?php echo $capacicodigo; ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Curso</td>
								<td colspan="3" class="NoiseDataTD"><?php echo $rsCurso['cursonombre']; ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Ubicaci&oacute;n</td>
								<td colspan="3" class="NoiseDataTD"><?php echo $rsUbicacion['ubicapnombre']; ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Salon</td>
								<td colspan="3" class="NoiseDataTD"><?php echo $rsSalon['salcapnombre']; ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Fecha</td>
								<td colspan="3" class="NoiseDataTD"><?php echo $capacifecini; ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Departamento</td>
								<td colspan="3" class="NoiseDataTD"><?php echo $rsDepartam['departnombre']; ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Responsable</td>
								<td colspan="3" class="NoiseDataTD"><?php echo $rsUsuario['usuanombre'].' '.$rsUsuario['usuapriape'].' '.$rsUsuario['usuasegape']; ?></td>
							</tr>
						</table>
					</td>
				</tr>	
				<tr><td></td></tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr><td class="ui-state-default">&nbsp;Instructor</td></tr>
						</table>
						<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
						<?php 
							if($nrCapacitema > 0)
							{
						?>
							<tr>
								<td class="ui-state-default">&nbsp;Nombre</td>
								<td class="ui-state-default">&nbsp;Cargo</td>
								<td class="ui-state-default">&nbsp;Contenido</td>
								<td class="ui-state-default">&nbsp;No. Horas</td>
								<td class="ui-state-default">&nbsp;Valor</td>
							</tr>
						<?php 
								for($a = 0; $a < $nrCapacitema; $a++)
								{
									$rwCapacitema = fncfetch($rsCapacitema, $a);
									$rsCUsuario = loadrecordusuario($rwCapacitema['usuacodi'], $idcon);
									$rsCCargo = ($rsCUsuario['cargocodigo']) ? loadrecordcargo($rsCUsuario['cargocodigo'], $idcon) : null;
									$rsCTema = ($rwCapacitema['temacodigo']) ? loadrecordtema($rwCapacitema['temacodigo'], $idcon) : null;
									$nrHoras = (strpos($rwCapacitema['captemtiedur'], '.')) ? ($rwCapacitema['captemtiedur'] * 60).' min' : $rwCapacitema['captemtiedur'].' hr'; 
						?>
							<tr class="NoiseDataTD">
								<td>&nbsp;<?php echo $rsCUsuario['usuanombre'].' '.$rsCUsuario['usuapriape'].' '.$rsCUsuario['usuasegape'] ?></td>
								<td>&nbsp;<?php echo $rsCCargo['cargonombre'] ?></td>
								<td>&nbsp;<?php echo $rsCTema['temanombre'] ?></td>
								<td>&nbsp;<?php echo $nrHoras ?></td>
								<td>&nbsp;<?php echo $rwCapacitema['captemvalor'] ?></td>
							</tr>
						<?php 
								}
							} else {
						?>
							<tr><td class="ui-state-default">&nbsp;No asignado</td></tr>
						<?php } ?>
						</table>
					</td>
				</tr>
				<tr><td></td></tr>	
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr><td class="ui-state-default">&nbsp;Empleados involucrados en la capacitacion</td></tr>
						</table>
						<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
						<?php 
							if($nrCapaciusuario > 0)
							{
						?>
							<tr>
								<td class="ui-state-default">&nbsp;ID</td>
								<td class="ui-state-default">&nbsp;Nombre</td>
								<td class="ui-state-default">&nbsp;Departamento</td>
								<td class="ui-state-default">&nbsp;Calificaci&oacute;n</td>
							</tr>
						<?php 
								for($a = 0; $a < $nrCapaciusuario; $a++)
								{
									$rwCapaciusuario = fncfetch($rsCapaciusuario, $a);
									$rsCUsuario = loadrecordusuario($rwCapaciusuario['usuacodi'], $idcon);
									$rsCDepartam = ($rwCapaciusuario['departcodigo']) ? loadrecorddepartam($rwCapaciusuario['departcodigo'], $idcon) : null;
									$objCalificacion = 'capusucalifi_'.$rwCapaciusuario['capusucodigo'];
									$$objCalificacion = $rwCapaciusuario['capusucalifi'];
						?>
							<tr class="NoiseDataTD">
								<td class="maestabl-row-list">&nbsp;<?php echo $rsCUsuario['usuacodi'] ?></td>
								<td class="maestabl-row-list">&nbsp;<?php echo $rsCUsuario['usuanombre'].' '.$rsCUsuario['usuapriape'].' '.$rsCUsuario['usuasegape'] ?></td>
								<td class="maestabl-row-list">&nbsp;<?php echo $rsCDepartam['departnombre'] ?></td>
								<td class="maestabl-row-list"><input type="text" name="<?php echo $objCalificacion ?>" value="<?php echo $$objCalificacion ?>"></td>
							</tr>
						<?php 
								}
							} else {
						?>
							<tr><td class="ui-state-default">&nbsp;No asignado</td></tr>
						<?php } ?>
						</table>
					</td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_form.php'; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
			</table> 
			<input type="hidden" name="accioneditarcapacitacion">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="editar">
			
			<input type="hidden" name="capacicodigo" value="<?php echo $capacicodigo ?>">
			<input type="hidden" name="cursocodigo" value="<?php echo $cursocodigo ?>">
			<input type="hidden" name="ubicapcodigo" value="<?php echo $ubicapcodigo ?>">
			<input type="hidden" name="salcapcodigo" value="<?php echo $salcapcodigo ?>">
			<input type="hidden" name="departcodigo" value="<?php echo $departcodigo ?>">
			<input type="hidden" name="capacifecini" value="<?php echo $capacifecini ?>">
			<input type="hidden" name="usuacodigo" value="<?php echo $usuacodigo ?>">
			<input type="hidden" id="codigo" name="codigo" value="<?php echo $codigo; ?>"> 
		</form>
		<div id="msgwindowformc"><span id="msgformc"></span></div>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>