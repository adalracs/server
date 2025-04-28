<?php 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
?>
<html> 
	<head> 
		<title>Nuevo registro de tipo de movimiento</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Tipo de movimiento</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="450">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td>
								<td width="80%" class="NoiseDataTD"><input type="text" name="tipmovnombre" size="12"	value="<?php echo $tipmovcodigo; ?>"></td> 
 							</tr> 
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Nombre</td>
								<td width="80%" class="NoiseDataTD"><input type="text" name="tipmovnombre" size="50"	value="<?php echo $tipmovnombre; ?>"></td> 
 							</tr> 
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Tipo</td>
								<td width="80%" class="NoiseDataTD"><select name="tipmovtipo">
									<option value="">-- Seleccione --</option>
									<option value="1" <?php if($tipmovtipo == 1) { echo 'selected'; }?>>Ingreso</option>
									<option value="0" <?php if($tipmovtipo == 0) { echo 'selected'; }?>>Egreso</option>
								</select></td> 
 							</tr> 
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><textarea name="tipmovdescri" rows="3" cols="50"><?php echo $tipmovdescri; ?></textarea>  </td></tr>
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
			<input type="hidden" name="accionconsultartipomovi">
			<input type="hidden" name="flagconsultartipomovi" value="1">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="columnas" value="tipmovcodigo,tipmovnombre,tipmovdescri,tipmovtipo"> 
			<input type="hidden" name="nombtabl" value="tipomovi">
			<input type="hidden" name="sourceaction" value="consultar">			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 	
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>