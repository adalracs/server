<?php 	
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	
	if(!$flagborrarubicaccapaci)
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton); 
	
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php'); 
	} 
?>
<html> 
	<head> 
		<title>Borrar de registro de ubicaciones</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">ubicaciones</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="470">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Borrar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr> 
 								<td width="25%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
  								<td width="75%" class="NoiseDataTD"><?php echo $sbreg[ubicapcodigo]; ?></td> 
 							</tr> 
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Nombre</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[ubicapnombre]; ?></td> 
 							</tr> 
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><?php echo $sbreg[ubicapdescri]; ?></td></tr>
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
 			<input type="hidden" name="flagborrarubicaccapaci" value="1">
 			<input type="hidden" name="ubicapcodigo1" value="<?php if(!$flagborrarubicaccapaci){ echo $sbreg[ubicapcodigo];}else{ echo $ubicapcodigo1; } ?>">
			<input type="hidden" name="accionborrarubicaccapaci">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="borrar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="columnas" value="ubicapcodigo, ubicapnombre, ubicapdescri">
			<input type="hidden" name="ubicapcodigo" value="<?php  if($accionconsultarubicaccapaci) echo $ubicapcodigo; ?>"> 
 			<input type="hidden" name="ubicapnombre" value="<?php  if($accionconsultarubicaccapaci) echo $ubicapnombre; ?>"> 
 			<input type="hidden" name="ubicapdescri" value="<?php  if($accionconsultarubicaccapaci) echo $ubicapdescri; ?>"> 
 			<input type="hidden" name="accionconsultarubicaccapaci" value="<?php  echo $accionconsultarubicaccapaci; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>