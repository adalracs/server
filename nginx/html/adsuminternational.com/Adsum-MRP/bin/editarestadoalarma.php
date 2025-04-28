<?php 
ob_start(); 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	if($accioneditarestadoalarma) 
	{ 
		include ('editaestadoalarma.php'); 
		$flageditarestadoalarma = 1; 
	} 
ob_end_flush(); 

	if(!$flageditarestadoalarma) 
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton); 
		
		$estalacodigo = $sbreg['estalacodigo'];
		
		if (!$sbreg) 
			include( '../src/FunGen/fnccontfron.php'); 
	} 
?>
<html>
	<head>
		<title>Editar registro de Estado de Alarma</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		<link rel="stylesheet" media="screen" type="text/css" href="temas/colorpicker/colorpicker.css" />
		<script type="text/javascript" src="../src/FunjQuery/external/colorpicker/colorpicker.js"></script>
	</head>
<?php if(!$codigo){ echo "<!--";}?> 
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Estado de Alarma</font></p>
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
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Editar Registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["estalanombre"] == 1){ $estalanombre = null; echo "*";}?>&nbsp;Nombre</td>
								<td width="80%" class="NoiseDataTD"><input type="text" name="estalanombre" size="50"	value="<?php if(!$flageditarestadoalarma){ echo $sbreg[estalanombre];}else {echo $estalanombre; }?>"></td> 
 							</tr>
 							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["estaladescri"] == 1){ $estaladescri = null; echo "*";}?>&nbsp;Descripci&oacute;n</td>
								<td width="80%" class="NoiseDataTD"><textarea name="estaladescri" rows="3" cols="50"><?php if(!$flageditarestadoalarma){ echo $sbreg[estaladescri];}else{ echo $estaladescri;} ?></textarea></td> 
 							</tr>
 							<tr><td colspan="2" class="ui-state-default"></td></tr>
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
 							<tr>
 							  <td class="NoiseFooterTD"><?php if($campnomb["tipalatipo"] == 1){ $tipalatipo = null; echo "*";}?>
 							    &nbsp;Tipo</td>
 							  <td class="NoiseDataTD"><select name="tipalatipo">
 							    <option value="1" <?php if(!$flageditarestadoalarma){ if($tipalatipo == 1) { echo 'selected'; }}?>>Activo</option>
 							    <option value="0" <?php if(!$flageditarestadoalarma){ if($tipalatipo == '0') { echo 'selected'; }}?>>Inactivo</option>
						      </select></td>
						  </tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD">&nbsp;</td></tr>
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
			<input type="hidden" name="estalacodigo" value="<?php if(!$flageditarestadoalarma){ echo $sbreg[estalacodigo];}else{ echo $estalacodigo; } ?>"> 
			<input type="hidden" name="accioneditarestadoalarma"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="editar">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>