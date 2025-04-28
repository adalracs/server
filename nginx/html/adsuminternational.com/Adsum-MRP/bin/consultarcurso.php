<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
?>
<html> 
	<head> 
		<title>Consultar registro de curso</title> 
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
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
            				<tr> 
 								<td width="22%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
 								<td width="78%" class="NoiseDataTD"><input type="text" name="cursocodigo" id="cursocodigo"  size="20" value="<?php echo $cursocodigo; ?>"></td> 
 							</tr>
            				<tr> 
 								<td width="22%" class="NoiseFooterTD">&nbsp;Curso</td> 
 								<td width="78%" class="NoiseDataTD"><input type="text" name="cursonombre" id="cursonombre"  size="50" value="<?php echo $cursonombre; ?>"></td> 
 							</tr>
							<tr><td class="ui-state-default" colspan="2"></td></tr>							
 							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Objetivo</td></tr>
  							<tr><td colspan="2" class="NoiseFooterTD"><textarea name="cursoobjeti" id="cursoobjeti" rows="3" cols="50" wrap="VIRTUAL"><?php echo $cursoobjeti; ?></textarea></td></tr>
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
 			<input type="hidden" name="flagconsultarcurso" value="1"> 
			<input type="hidden" name="accionconsultarcurso"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar">
			<input type="hidden" name="columnas" value="cursocodigo,cursonombre,cursoobjeti">
			<input type="hidden" name="nombtabl" value="curso"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>