<?php 
	include ('../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblubicaccapaci.php');
?> 
<!-- Propiedad intelectual de Adsum SAS (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andrés A. Riascos D. 
Fecha: 20120110 
GenVers: 4.8 -->
<html> 
	<head> 
		<title>Consultar registro de salon de capacitacion</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=UTF8"> 
		<meta http-equiv="expires" content="0"> 
		<meta http-equiv="X-UA-Compatible" content="IE=9"> 
		<?php include ('../def/jquery.library_maestro.php'); ?> 
	</head> 
<?php if (! $codigo) { echo "<!--"; } ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post" enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Salon de capacitaci&oacute;n</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="550"> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr>
				<tr>
					<td> 
						<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr> 
								<td width="20%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
								<td width="80%" class="NoiseDataTD"><input type="text" name="salcapcodigo"	value="<?php echo $salcapcodigo; ?>" size="20"></td> 
							</tr> 
							<tr> 
								<td width="20%" class="NoiseFooterTD">&nbsp;Salon</td> 
								<td width="80%" class="NoiseDataTD"><input type="text" name="salcapnombre"	value="<?php echo $salcapnombre; ?>" size="50"></td> 
							</tr> 
							<tr> 
								<td class="NoiseFooterTD">&nbsp;Ubicaci&oacute;n</td> 
								<td class="NoiseDataTD"><select name="ubicapcodigo" id="ubicapcodigo">
									<option value="">-- Seleccione --</option>
									<?php 
										include '../src/FunGen/floadubicaccapaci.php';
										$idcon = fncconn();
										floadubicaccapaci($ubicapcodigo,$idcon);
									?>
								</select></td> 
							</tr> 
							<tr><td class="NoiseFooterTD" colspan="2">&nbsp;Descripci&oacute;n</td></tr> 
							<tr><td class="NoiseDataTD" colspan="2"><textarea name="salcapdescri" rows="3" cols="63"><?php echo $salcapdescri; ?></textarea></td></tr> 
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
			<input type="hidden" name="flagconsultarsaloncapaci" value="1"> 
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>"> 
			<input type="hidden" name="sourceaction" value="consultar"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="accionconsultarsaloncapaci"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="columnas" value="salcapcodigo,salcapnombre,ubicapcodigo,salcapdescri"> 
			<input type="hidden" name="nombtabl" value="saloncapaci"> 
		</form> 
	</body> 
<?php if (! $codigo) { echo " -->"; } ?> 
</html>