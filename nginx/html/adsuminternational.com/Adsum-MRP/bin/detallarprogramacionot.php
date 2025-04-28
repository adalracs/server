<?php
ini_set('display_errors',1);
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktblprogramacion.php');
include ( '../src/FunPerPriNiv/pktblplanta.php');
include ( '../src/FunPerPriNiv/pktblsistema.php');
include ( '../src/FunPerPriNiv/pktblequipo.php');
include ( '../src/FunPerPriNiv/pktbltipomant.php');
include ( '../src/FunPerPriNiv/pktblcomponen.php');
include ( '../src/FunPerPriNiv/pktblparte.php');
include ( '../src/FunPerPriNiv/pktbltarea.php');
include ( '../src/FunPerPriNiv/pktbltipomedi.php');
include ( '../src/FunPerPriNiv/pktbltipotrab.php');
include ( '../src/FunPerPriNiv/pktbltareot.php');
	
if(!$flagdetallarprogramacion){
	if($radiobutton)
		include('detallaprogramacion.php');
	else {
		$nombtabl='programacionequipos';
		include( '../src/FunGen/fnccontfron.php');
		
	}
}
?>
<html>
	<head>
		<title>Detalle de registro deprogramacion</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
		<SCRIPT LANGUAGE="JavaScript">
			<!-- Begin
			agree = 0;
			//  End -->
			function MM_openBrWindow(theURL,winName,features)
			{ //v2.0
				window.open(theURL,winName,features);
			}
		</script>
		<script language="JavaScript" src="motofech.js"></script>
		<style type="text/css">
			.estilo1 {font-size: 85%; font-family : Arial } 
		</style>
	</head>
<?php if(!$codigo) { echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Programaci&oacute;n</font></p>
			<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE" width="98%">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Detallar registro</font></span></td></tr>
				<tr>
					<td>
						<table width="97%" border="0" cellspacing="1" cellpadding="0" align="center">
							<tr><td class="NoiseErrorDataTD" colspan ="4"></td></tr> 
							<tr><td class="NoiseFieldCaptionTD" colspan ="4"></td></tr> 
  							<tr>
  								<td class="NoiseSeparatorTD" width = "20%">&nbsp;Planta</td>
  								<td class="NoiseFooterTD" width = "30%">&nbsp;<?php echo $plantanombre; ?></td>
  								<td class="NoiseSeparatorTD" width = "20%">&nbsp;Sistema</td>
  								<td class="NoiseFooterTD" width = "30%">&nbsp;<?php echo $sistemnombre; ?></td>
  							</tr>
  							<tr>
  								<td class="NoiseSeparatorTD" width = "20%">&nbsp;Equipo</td>
  								<td class="NoiseFooterTD" width = "30%">&nbsp;<?php echo $equiponombre; ?></td>
  								<td class="NoiseSeparatorTD" width = "20%">&nbsp;Tipo de Mantenimiento</td>
  								<td class="NoiseFooterTD" width = "30%">&nbsp;<?php echo $tipmannombre; ?></td>
  							</tr>
							<tr><td class="NoiseFieldCaptionTD" colspan ="4"></td></tr>
							<tr>		  
								<td colspan="4">
            						<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
         								<tr><td class="NoiseErrorDataTD" colspan ="9"></td></tr> 
										<tr><td class="NoiseFieldCaptionTD" colspan ="9"></td></tr>
          								<tr><td class="NoiseErrorDataTD" colspan="9" align="center">&nbsp;<font color="black"><b>Programaci&oacute;n</b></font></td></tr>
          								<tr class="NoiseFooterTD">
            								<td class="NoiseFieldCaptionTD estilo1" width="3%"><font color="#FFFFFF">&nbsp;<strong>Prg.</strong></font></td>
            								<td class="NoiseFieldCaptionTD estilo1" width="15%"><font color="#FFFFFF">&nbsp;<strong>Tarea</strong></font></td>
            								<td class="NoiseFieldCaptionTD estilo1" width="15%"><font color="#FFFFFF">&nbsp;<strong>Componente</strong></font></td>
            								<td class="NoiseFieldCaptionTD estilo1" width="13%"><font color="#FFFFFF">&nbsp;<strong>Parte</strong></font></td>
            								<td class="NoiseFieldCaptionTD estilo1" width="13%"><font color="#FFFFFF">&nbsp;<strong>Tipo Trabajo</strong></font></td>
            								<td class="NoiseFieldCaptionTD estilo1" width="6%"><font color="#FFFFFF">&nbsp;<strong>Dur. hrs.</strong></font></td>
            								<td class="NoiseFieldCaptionTD estilo1" width="4%"><font color="#FFFFFF">&nbsp;<strong>Frec.</strong></font></td>
            								<td class="NoiseFieldCaptionTD estilo1" width="9%"><font color="#FFFFFF">&nbsp;<strong>Medidor</strong></font></td>
            								<td class="NoiseFieldCaptionTD estilo1" width="6%"><font color="#FFFFFF">&nbsp;<strong>Estado</strong></font></td>
          								</tr>
          								<?php
          									$idconn = fncconn();
          									for ($j = 0; $j < $irecNumreg; $j++){
												if (($j % 2) == 0)
													echo '<tr class="NoiseFooterTD">'."\n";
												else
													echo '<tr class="NoiseDataTD">'."\n";
												
												$irecRecord = fncfetch($sbregProgram, $j);
												$irecTareot = loadrecordtareotprog($irecRecord['progracodigo'], $idconn);

												echo '<td class="estilo1" align="center">'.($j + 1).'</td>';
												echo '<td class="estilo1">'.cargatareanombre1($irecTareot['tareacodigo'], $idconn).'</td>';
												echo '<td class="estilo1">'.cargacomponnombre($irecRecord['componcodigo'], $idconn).'</td>';
												echo '<td class="estilo1">'.cargapartenombre($irecRecord['partecodigo'], $idconn).'</td>';
												echo '<td class="estilo1">'.cargatiptrabnombre($irecTareot['tiptracodigo'], $idconn).'</td>';
												echo '<td class="estilo1" align="center">'.$irecRecord['progratiedur'].'&nbsp;hr.</td>';
												echo '<td class="estilo1" align="center">'.$irecRecord['prografrecue'].'</td>';
												echo '<td class="estilo1">'.cargatipmnombre($irecRecord['tipmedcodigo'], $idconn).'</td>';
												if($irecRecord['prograacti'] == 1)
													$activo = '<font color="red"><b>Activo</b></font>';
												else 
													$activo = '<b>Inactivo</b>';
													
												echo '<td class="estilo1" align="center">'.$activo.'</td>';
												echo '</tr>';
											}
										?>
										<tr><td class="NoiseFieldCaptionTD" colspan ="9"></td></tr>
										<tr><td class="NoiseErrorDataTD" colspan ="9"></td></tr> 
									</table>
								</td>
							</tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
						</table>
					</td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td><div align="center">
						<input type="image" name="aceptar"  src="../img/aceptar.gif" onclick="form1.action='maestablprogramacionequipos.php';"  width="86" height="18" alt="Aceptar" border=0>
					</div></td>
				</tr>
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
			</table>
			<input type="hidden" name="$flagdetallarprogramacion" value="1">
			<input type="hidden" name="acciondetallarprogramacion">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
		</form>
	</body>
</html>