<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	
	
	if(!$flagdetallarfabricante) 
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton);
		
		if (!$sbreg) 
			include( '../src/FunGen/fnccontfron.php');
	} 
?>
<html> 
	<head> 
		<title>Detalle de registro de fabricantes</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Fabricante</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="450">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr> 
 								<td width="22%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
  								<td width="78%" class="NoiseDataTD"><?php echo $sbreg[fabricodigo]; ?></td> 
 							</tr> 
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Razon social</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[fabrirazsol]; ?></td> 
 							</tr>    
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Nit</td> 
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
					<td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_formdetall.php'; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr> 
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
 			<input type="hidden" name="flagdetallarfabricante" value="1"> 
			<input type="hidden" name="acciondetallarfabricante">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="columnas" value="fabricodigo,fabrirazsol,fabrinit,fabripais"> 
			<input type="hidden" name="fabricodigo" value="<?php if($accionconsultarfabricante) echo $fabricodigo; ?>"> 
			<input type="hidden" name="fabrirazsol" value="<?php if($accionconsultarfabricante) echo $fabrirazsol; ?>"> 
			<input type="hidden" name="fabrinit" value="<?php if($accionconsultarfabricante) echo $fabrinit; ?>"> 
			<input type="hidden" name="fabripais" value="<?php if($accionconsultarfabricante) echo $fabripais; ?>"> 
 			<input type="hidden" name="accionconsultarfabricante" value="<?php echo $accionconsultarfabricante; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>