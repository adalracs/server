<?php 	
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	
	if(!$flagborrarfabricante)
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
		<title>Borrar de registro de fabricante de calidad</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Fabricante</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="470">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Borrar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr> 
 								<td width="22%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
  								<td width="78%" class="NoiseDataTD"><?php echo $sbreg[fabricodigo]; ?></td> 
 							</tr> 
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Nombre</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[fabrirazsol]; ?></td> 
 							</tr>  
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;NIT</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[fabrinit]; ?></td> 
 							</tr> 
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Pais</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[fabripais]; ?></td> 
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
 			<input type="hidden" name="flagborrarfabricante" value="1">
 			<input type="hidden" name="fabricodigo1" value="<?php if(!$flagborrarfabricante){ echo $sbreg[fabricodigo];}else{ echo $fabricodigo1; } ?>">
			<input type="hidden" name="accionborrarfabricante">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="borrar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="columnas" value="fabricodigo,fabrirazsol,fabrinit"> 
			<input type="hidden" name="fabricodigo" value="<?php if($accionconsultarfabricante) echo $fabricodigo; ?>"> 
			<input type="hidden" name="fabrirazsol" value="<?php if($accionconsultarfabricante) echo $fabrirazsol; ?>"> 
			<input type="hidden" name="fabrinit" value="<?php if($accionconsultarfabricante) echo $fabrinit; ?>"> 
 			<input type="hidden" name="accionconsultarfabricante" value="<?php echo $accionconsultarfabricante; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>