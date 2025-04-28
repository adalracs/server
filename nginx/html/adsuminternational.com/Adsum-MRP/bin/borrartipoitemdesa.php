<?php 	
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	
	if(!$flagborrartipoitemdesa)
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton); 
	
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php'); 
	} 
	
	$idcon = fncconn();
?>
<html> 
	<head> 
		<title>Borrar de registro de inspecci&oacute;n</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Inspecci&oacute;n</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="470">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Borrar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr> 
 								<td width="22%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
  								<td width="78%" class="NoiseDataTD"><?php echo $sbreg[tipitemcodigo]; ?></td> 
 							</tr> 
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Nombre</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[tipitemnombre]; ?></td> 
 							</tr>  
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><?php echo $sbreg[tipitemdescri]; ?></td></tr>
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
 			<input type="hidden" name="flagborrartipoitemdesa" value="1">
 			<input type="hidden" name="tipitemcodigo1" value="<?php if(!$flagborrartipoitemdesa){ echo $sbreg[tipitemcodigo];}else{ echo $tipitemcodigo1; } ?>">
			<input type="hidden" name="accionborrartipoitemdesa">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="borrar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="columnas" value="tipitemcodigo,tipitemnombre,tipitemdescri"> 
			<input type="hidden" name="tipitemcodigo" value="<?php if($accionconsultartipoitemdesa) echo $tipitemcodigo; ?>"> 
			<input type="hidden" name="tipitemnombre" value="<?php if($accionconsultartipoitemdesa) echo $tipitemnombre; ?>"> 
			<input type="hidden" name="tipitemdescri" value="<?php if($accionconsultartipoitemdesa) echo $tipitemdescri; ?>"> 
 			<input type="hidden" name="accionconsultartipoitemdesa" value="<?php echo $accionconsultartipoitemdesa; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>