<?php 
	
	include ( '../src/FunGen/sesion/fncvalses.php');

?>
<html> 
	<head> 
		<title>Consultar registro de tipo de medidor</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">tipo de medidor</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="550">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
            				<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Nombre&nbsp;</td>
								<td width="80" class="NoiseDataTD" colspan="2"><input type="text" name="tipmedcodigo" size="30"	value="<?php echo $tipmedcodigo; ?>"></td>
 							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Nombre&nbsp;</td>
								<td width="80" class="NoiseDataTD" colspan="2"><input type="text" name="tipmednombre" size="30"	value="<?php echo $tipmednombre; ?>"></td>
 							</tr>
 							<tr>
								<td width="10%" class="NoiseFooterTD">&nbsp;Acr&oacute;nimo&nbsp;</td>
								<td width="80%" class="NoiseDataTD" colspan="2"><input type="text" name="tipmedacra" size="10"	value="<?php echo $tipmedacra; ?>"></td>
 							</tr>
 							<tr>
      							<td width="20%" class="NoiseFooterTD">Tiempo Medidor</td>
      							<td width="80%" class="NoiseErrorDataTD"><select name="tipmedtiempo">
        							<option value="">Seleccione</option>
        							<option value="1" <?php if($tipmedtiempo == 1) echo 'selected'; ?>>Minuto(s)</option>
        							<option value="2" <?php if($tipmedtiempo == 2) echo 'selected'; ?>>Hora(s)</option>
        							<option value="3" <?php if($tipmedtiempo == 3) echo 'selected'; ?>>Dia(s)</option>
        							<option value="4" <?php if($tipmedtiempo == 4) echo 'selected'; ?>>Mes(es)</option>
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
 			<input type="hidden" name="flagconsultartipomedi" value="1"> 
			<input type="hidden" name="accionconsultartipomedi"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar">
			<input type="hidden" name="columnas" value="tipmedcodigo, tipmednombre, tipmedacra, tipmedtiempo">
			<input type="hidden" name="nombtabl" value="tipomedi"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>