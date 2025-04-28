<?php 
ob_start(); 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	if($accioneditarunimedida) 
	{ 
		include ( 'editaunimedida.php'); 
		$flageditarunimedida = 1; 
	} 
ob_end_flush(); 
	if(!$flageditarunimedida) 
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton); 
		if (!$sbreg) 
			include( '../src/FunGen/fnccontfron.php'); 
	} 
?>
<html> 
	<head> 
		<title>Editar registro de unidad de medida</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Unidad de medida</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="450">
<?php if($campnomb): ?>
				<tr><td><div class="ui-widget">
					<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
						<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
						<strong>Advertencia:</strong> Corrija los campos marcados con *</p>
					</div>
				</div></td></tr>
<?php else: ?> 		
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
<?php endif; ?> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Editar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["unidadcodigo"] == 1){ $unidadcodigo1 = null; echo "*";}?>&nbsp;C&oacute;digo</td>
								<td width="80%" class="NoiseDataTD"><input type="text" name="unidadcodigo1" size="20"	value="<?php if(!$flageditarunimedida){ echo $sbreg[unidadcodigo];}else {echo $unidadcodigo1; }?>"></td> 
 							</tr> 
							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["unidadnombre"] == 1){ $unidadnombre = null; echo "*";}?>&nbsp;Nombre</td>
								<td width="80%" class="NoiseDataTD"><input type="text" name="unidadnombre" size="50"	value="<?php if(!$flageditarunimedida){ echo $sbreg[unidadnombre];}else {echo $unidadnombre; }?>"></td> 
 							</tr> 
							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["unidadacra"] == 1){ $unidadacra = null; echo "*";}?>&nbsp;Acr&oacute;nimo</td>
								<td width="80%" class="NoiseDataTD"><input type="text" name="unidadacra" size="15"	value="<?php if(!$flageditarunimedida){ echo $sbreg[unidadacra];}else {echo $unidadacra; }?>"></td> 
 							</tr> 
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD"><?php if($campnomb["unidaddescri"] == 1){$unidaddescri = null; echo "*";}?>&nbsp;Descripci&oacute;n</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><textarea name="unidaddescri" rows="3" cols="50"><?php if(!$flageditarunimedida){ echo $sbreg[unidaddescri];}else{ echo $unidaddescri;} ?></textarea>  </td></tr>
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
			<input type="hidden" name="accioneditarunimedida">
			<input type="hidden" name="unidadcodigo" value="<?php if(!$flageditarunimedida){ echo $sbreg[unidadcodigo];}else{ echo $unidadcodigo; } ?>">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="editar">			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 	
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>