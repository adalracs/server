<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	
	if(!$flagborrarcurso)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');
	}
?> 
<html> 
	<head> 
		<title>Borrar de registro de curso</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Curso</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="450">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Borrar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr> 
 								<td width="22%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
  								<td width="78%" class="NoiseDataTD"><?php echo $sbreg[cursocodigo]; ?></td> 
 							</tr> 
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Curso</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[cursonombre]; ?></td> 
 							</tr> 
 							
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Instructor</td> 
 								<td class="NoiseDataTD"><?php echo $sbreg[cursoinstru]; ?></td> 
 							</tr>
 							
 							
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Fecha</td> 
 								<td class="NoiseDataTD"><?php echo $sbreg[cursofecha]; ?></td> 
 							</tr>
 							
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Ubicaci&oacute;n</td> 
 								<td class="NoiseDataTD"><?php echo $sbreg[cursoubicac]; ?></td> 
 							</tr>
 							
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Objetivo</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><p>&nbsp;<?php echo $sbreg[cursoobjeti]; ?></p></td></tr>
						
							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Contenido</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><p>&nbsp;<?php echo $sbreg[cursoconten]; ?></p></td></tr>
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
			<input type="hidden" name="cursocodigo" value="<?php echo $sbreg[cursocodigo]; ?>">
 			<input type="hidden" name="flagborrarcurso" value="1"> 
			<input type="hidden" name="accionborrarcurso">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="borrar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>