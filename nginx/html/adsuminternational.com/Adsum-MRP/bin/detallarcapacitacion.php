<?php 
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

	if(!$flagdetallarcapacitacion)
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');
		
		$idcon = fncconn();
		
		$rsCurso = loadrecordcurso($sbreg['cursocodigo'], $idcon);
		$rsUbicacion = loadrecordubicaccapaci($sbreg['ubicapcodigo'], $idcon);
		$rsSalon = loadrecordsaloncapaci($sbreg['salcapcodigo'], $idcon);
		$rsDepartam = ($sbreg['departcodigo']) ? loadrecorddepartam($sbreg['departcodigo'], $idcon) : null;
		$rsUsuario = loadrecordusuario($sbreg['usuacodi'], $idcon);
		$rsCapacitema = dinamicscancapacitema(array('capacicodigo' => $sbreg['capacicodigo']), $idcon);
		$nrCapacitema = fncnumreg($rsCapacitema);
		
		$rsCapaciusuario = dinamicscancapaciusuario(array('capacicodigo' => $sbreg['capacicodigo']), $idcon);
		$nrCapaciusuario = fncnumreg($rsCapaciusuario);
	}
?> 
<html> 
	<head> 
		<title>Detalle de registro de capacitaci&oacute;n</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0">
		 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script> 
		
		<style type="text/css">
			#reportot_file_load a {
			    color: #1372A2;
			    font: 12px Arial;
			    text-decoration: none;
			}
			
			#reportot_file_load a:hover {
				text-decoration: underline;	
			}
		</style>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
  	<body bgcolor="FFFFFF" text="#000000"> 
    	<form name="form1" method="post"  enctype="multipart/form-data"> 
      		<p><font class="NoiseFormHeaderFont">Capacitaci&oacute;n</font></p> 
			<table border="0" cellspacing="1" cellpadding="0" align="center"class="ui-widget-content" width="750"> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Detallar registro</font></span></td></tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
							<tr>
								<td class="NoiseFooterTD">&nbsp;C&oacute;digo</td>
								<td colspan="3" class="NoiseDataTD"><?php echo $sbreg['capacicodigo']; ?></td>
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
								<td colspan="3" class="NoiseDataTD"><?php echo date("Y-m-d",strtotime($sbreg['capacifecini'])); ?></td>
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
						?>
							<tr class="NoiseDataTD">
								<td>&nbsp;<?php echo $rsCUsuario['usuacodi'] ?></td>
								<td>&nbsp;<?php echo $rsCUsuario['usuanombre'].' '.$rsCUsuario['usuapriape'].' '.$rsCUsuario['usuasegape'] ?></td>
								<td>&nbsp;<?php echo $rsCDepartam['departnombre'] ?></td>
								<td>&nbsp;<?php echo ($rwCapaciusuario['capusucalifi']) ? $rwCapaciusuario['capusucalifi'] : '---' ?></td>
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
					<td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_formdetall.php'; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr> 
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
	  		</table> 
			<input type="hidden" name="flagdetallarcapacitacion" value="1"> 
			<input type="hidden" name="acciondetallarcapacitacion">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar"> 	
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			
			<input type="hidden" name="columnas" value="capacicodigo,cursocodigo,ubicapcodigo,salcapcodigo,capacifecgen,capacifecini,capacihorini,capacihorfin,usuacodi,departcodigo,capacigenera,capaciobjeti"> 
			<input type="hidden" name="capacicodigo" value="<?php if($accionconsultarcapacitacion) echo $capacicodigo; ?>"> 
			<input type="hidden" name="cursocodigo" value="<?php if($accionconsultarcapacitacion) echo $cursocodigo; ?>"> 
			<input type="hidden" name="ubicapcodigo" value="<?php if($accionconsultarcapacitacion) echo $ubicapcodigo; ?>"> 
			<input type="hidden" name="salcapcodigo" value="<?php if($accionconsultarcapacitacion) echo $salcapcodigo; ?>"> 
			<input type="hidden" name="capacifecgen" value="<?php if($accionconsultarcapacitacion) echo $capacifecgen; ?>"> 
			<input type="hidden" name="capacifecini" value="<?php if($accionconsultarcapacitacion) echo $capacifecini; ?>"> 
			<input type="hidden" name="capacihorini" value="<?php if($accionconsultarcapacitacion) echo $capacihorini; ?>"> 
			<input type="hidden" name="capacihorfin" value="<?php if($accionconsultarcapacitacion) echo $capacihorfin; ?>"> 
			<input type="hidden" name="usuacodigo" value="<?php if($accionconsultarcapacitacion) echo $usuacodigo; ?>"> 
			<input type="hidden" name="usuanombre" value="<?php if($accionconsultarcapacitacion) echo $usuanombre; ?>"> 
			<input type="hidden" name="departcodigo1" value="<?php if($accionconsultarcapacitacion) echo $departcodigo1; ?>"> 
			<input type="hidden" name="departnombre" value="<?php if($accionconsultarcapacitacion) echo $departnombre; ?>"> 
			<input type="hidden" name="capacigenera" value="<?php if($accionconsultarcapacitacion) echo $capacigenera; ?>"> 
			<input type="hidden" name="capaciobjeti" value="<?php if($accionconsultarcapacitacion) echo $capaciobjeti; ?>"> 
			<input type="hidden" name="accionconsultarcapacitacion" value="<?php echo $accionconsultarcapacitacion; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html> 
