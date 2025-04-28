<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
?>
<html> 
	<head> 
		<title>Consultar en turno</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Turno</font></p> 
			<table width="450" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content"> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr> 
 								<td width="22%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
 								<td width="78%" class="NoiseDataTD"><input type="text" name="turnocodigo" id="turnocodigo"  size="8" value="<?php echo $turnocodigo; ?>"></td> 
 							</tr> 
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Turno</td> 
 								<td class="NoiseDataTD"><input type="text" name="turnonombre" id="turnonombre" size="50" value="<?php echo $turnonombre; ?>"></td> 
 							</tr>
 							<tr> 
 								<td width="22%" class="NoiseFooterTD">&nbsp;Acr&oacute;nimo</td> 
 								<td width="78%" class="NoiseDataTD"><input type="text" name="turnoacroni" id="turnoacroni"  size="10" value="<?php echo $turnoacroni; ?>"></td> 
 							</tr>
							<tr><td class="ui-state-default" colspan="2"></td></tr>
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Hora inicio</td> 
 								<td class="NoiseDataTD"><select name="turnohorini" id="turnohorini">
										<option value = "">-- --</option>
										<?php
											include ('../src/FunGen/floadhoraturno.php');
											floadhoraturno($turnohorini);
										?>
								</select></td> 
 							</tr>
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Hora inicio</td> 
 								<td class="NoiseDataTD"><select name="turnohorfin" id="turnohorfin">
									<option value = "">-- --</option>
									<?php
										floadhoraturno($turnohorfin);
									?>
								</select></td> 
 							</tr>
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
 			<input type="hidden" name="flagconsultarturno" value="1"> 
			<input type="hidden" name="accionconsultarturno">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="columnas" value="turnocodigo,turnonombre,turnoacroni,turnohorini,turnohorfin"> 
			<input type="hidden" name="nombtabl" value="turno"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>