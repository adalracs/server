<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblcurso.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktbltema.php');
	include ( '../src/FunPerPriNiv/pktblcargo.php');
	include ( '../src/FunPerPriNiv/pktbldepartam.php');
	
	include ( '../src/FunPerPriNiv/pktblubicaccapaci.php'); 
	include ( '../src/FunPerPriNiv/pktblsaloncapaci.php'); 
	$idcon = fncconn();
?>
<html> 
	<head> 
		<title>Consultar en capacitacion</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.fnccapacitacion.js"></script>

	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Capacitaci&oacute;n</font></p> 
			<table width="600" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content"> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr> 
				<tr> 
  					<td>
  						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
  							<tr> 
 								<td width="22%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
 								<td width="78%" class="NoiseDataTD"><input type="text" name="capacicodigo" id="capacicodigo" value="<?php echo $capacicodigo; ?>"></td> 
 							</tr>
 							<tr>
								<td class="NoiseFooterTD">&nbsp;Curso</td>
								<td class="NoiseDataTD"><select name="cursocodigo" id="cursocodigo">
									<option value="">-- Seleccione --</option>
									<?php 
										include '../src/FunGen/floadcurso.php';
										floadcurso($cursocodigo,$idcon);
								?>
								</select></td> 
 							</tr>
 							<tr>
								<td class="NoiseFooterTD">&nbsp;Ubicacion&nbsp;</td>
								<td class="NoiseDataTD" colspan="2"><select name="ubicapcodigo" id="ubicapcodigo" onchange="accionLoadSelect(this.value, 'saloncapaci', 'salcapcodigo');">
									<option value="">-- Seleccione --</option>
									<?php 
										include '../src/FunGen/floadubicaccapaci.php';
										floadubicaccapaci($ubicapcodigo,$idcon);
									?>
								</select></td>
 							</tr>
 							<tr>
								<td class="NoiseFooterTD">&nbsp;Salon&nbsp;</td>
								<td class="NoiseDataTD" colspan="2"><select name="salcapcodigo" id="salcapcodigo">
									<option value="">-- Seleccione --</option>
									<?php 
										include '../src/FunGen/floadsaloncapaci.php';
										floadsaloncapaci($salcapcodigo, $ubicapcodigo, $idcon);
									?>
								</select></td>
 							</tr>
 							<tr>
								<td class="NoiseFooterTD">&nbsp;Fecha&nbsp;</td>
								<td class="NoiseDataTD"><input type="text" name="capacifecini" id="capacifecini" size="20"></td>
 							</tr>
 							<tr><td colspan="2" class="ui-state-default"></td></tr>
 							<tr>
 								<td class="NoiseFooterTD">&nbsp;Departamento&nbsp;</td>
 								<td class="NoiseDataTD"><div id="tecnico">
	        						<input type="hidden" name="departcodigo1" id="departcodigo1" value="<?php echo $departcodigo1;  ?>" size="7">
	        						<input type="text" name="departnombre" id="departnombre" value="<?php echo $departnombre;  ?>" size="40" >
	        					</div></td>
 							</tr>
 							<tr>
 								<td class="NoiseFooterTD">&nbsp;<b>Responsable</b>&nbsp;</td>
 								<td class="NoiseDataTD"><div id="tecnico">
	        						<input type="text" name="usuacodigo" id="usuacodigo" value="<?php echo $usuacodigo;  ?>" size="7" >
	        						<input type="text" name="usuanombre" id="usuanombre" value="<?php echo $usuanombre;  ?>" size="40" >
	        					</div></td>
 							</tr>
 							<tr><td class="ui-state-default" colspan="2"></td></tr>							
 							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Nota</td></tr>
  							<tr><td colspan="2" class="NoiseFooterTD"><textarea name="capaciobjeti" id="capaciobjeti" rows="3" cols="50" wrap="VIRTUAL"><?php echo $capaciobjeti; ?></textarea></td></tr>
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
 			<input type="hidden" name="flagconsultarcapacitacion" value="1"> 
			<input type="hidden" name="accionconsultarcapacitacion">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="columnas" value="capacicodigo,cursocodigo,ubicapcodigo,salcapcodigo,capacifecgen,capacifecini,capacihorini,capacihorfin,usuacodi,departcodigo,capacigenera,capaciobjeti"> 
			<input type="hidden" name="nombtabl" value="capacitacion"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>