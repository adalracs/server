<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
?>
<html> 
	<head> 
		<title>Consultar en Novedades</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>

	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Novedades</font></p> 
			<table width="450" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content"> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr> 
				<tr> 
  					<td>
						<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr> 
 								<td width="22%" class="NoiseFooterTD">&nbsp;Novedad</td> 
 								<td width="78%" class="NoiseDataTD"><input type="text" name="estnovnombre" id="estnovnombre"  size="50" value="<?php echo $estnovnombre; ?>"></td> 
 							</tr>
							<tr> 
 								<td width="22%" class="NoiseFooterTD">&nbsp;Acr&oacute;nimo</td> 
 								<td width="78%" class="NoiseDataTD"><input type="text" name="estnovacroni" id="estnovacroni"  size="50" value="<?php echo $estnovacroni; ?>"></td> 
 							</tr>
							<tr><td class="ui-state-default" colspan="2"></td></tr>							
							<tr><td class="NoiseDataTD" colspan="2"><input type="checkbox" name="estnovactusu" id="estnovactusu" <?php if($estnovactusu) echo 'checked'; ?> value="1">Inactivar usuario para la asignaci&oacute;n de ordenes de trabajo</td></tr>
							<tr><td class="ui-state-default" colspan="2"></td></tr>							
 							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td></tr>
  							<tr><td colspan="2" class="NoiseFooterTD"><textarea name="estnovdescri" id="estnovdescri" rows="3" cols="50" wrap="VIRTUAL"><?php echo $estnovdescri; ?></textarea></td></tr>
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
 			<input type="hidden" name="flagconsultarestadonoveda" value="1"> 
			<input type="hidden" name="accionconsultarestadonoveda">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="columnas" value="estnovcodigo,estnovnombre,estnovdescri,estnovactusu,estnovacroni"> 
			<input type="hidden" name="nombtabl" value="estadonoveda"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>