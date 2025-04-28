<?php 	
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	
	if(!$flagborrarmateapoy)
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton); 
	
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php'); 
	} 
?>
<html> 
	<head> 
		<title>Borrar de registro de material de apoyo</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Material de Apoyo</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="470">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Borrar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr> 
 								<td width="25%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
  								<td width="75%" class="NoiseDataTD"><?php echo $sbreg[matapocodigo]; ?></td> 
 							</tr> 
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Nombre</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[mataponombre]; ?></td> 
 							</tr> 
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><?php echo $sbreg[matapodescri]; ?></td></tr>
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
 			<input type="hidden" name="flagborrarmateapoy" value="1">
 			<input type="hidden" name="matapocodigo1" value="<?php if(!$flagborrarmateapoy){ echo $sbreg[matapocodigo];}else{ echo $matapocodigo1; } ?>">
			<input type="hidden" name="accionborrarmateapoy">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="borrar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="columnas" value="matapocodigo, mataponombre, matapodescri">
			<input type="hidden" name="matapocodigo" value="<?php echo $sbreg[matapocodigo] ?>"> 
 			<input type="hidden" name="mataponombre" value="<?php  if($accionconsultarmateapoy) echo $mataponombre; ?>"> 
 			<input type="hidden" name="matapodescri" value="<?php  if($accionconsultarmateapoy) echo $matapodescri; ?>"> 
 			<input type="hidden" name="accionconsultarmateapoy" value="<?php  echo $accionconsultarmateapoy; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>