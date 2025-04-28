<?php 
ob_start(); 
	include ( '../src/FunGen/sesion/fncvalses.php');
	
	if($accioneditarestadonoveda)
	{ 
		include ( 'editaestadonoveda.php'); 
		$flageditarestadonoveda = 1; 
	} 
ob_end_flush(); 

	if(!$flageditarestadonoveda)
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton); 
		if (!$sbreg) 
			include( '../src/FunGen/fnccontfron.php');
			
		$estnovactusu = $sbreg['estnovactusu'];
	} 
?>
<html> 
	<head> 
		<title>Editar registro de estadonoveda</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">D&iacute;a estadonoveda</font></p> 
			<table width="450" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content">
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
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Editar registro</font></span></td></tr>
				<tr> 
  					<td>
						<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr> 
 								<td width="22%" class="NoiseFooterTD"><?php if($campnomb["estnovnombre"] == 1){$estnovnombre = null; echo "*";}?>&nbsp;Novedad</td> 
 								<td width="78%" class="NoiseDataTD"><input type="text" name="estnovnombre" id="estnovnombre"  size="50" value="<?php if(!$flageditarestadonoveda){echo $sbreg[estnovnombre];}else{ echo $estnovnombre; }?>"></td> 
 							</tr>
							<tr> 
 								<td width="22%" class="NoiseFooterTD"><?php if($campnomb["estnovacroni"] == 1){$estnovacroni = null; echo "*";}?>&nbsp;Acr&oacute;nimo</td> 
 								<td width="78%" class="NoiseDataTD"><input type="text" name="estnovacroni" id="estnovacroni"  size="10" value="<?php if(!$flageditarestadonoveda){echo $sbreg[estnovacroni];}else{ echo $estnovacroni; }?>"></td> 
 							</tr>
							<tr><td class="ui-state-default" colspan="2"></td></tr>							
							<tr><td class="NoiseDataTD" colspan="2"><input type="checkbox" name="estnovactusu" id="estnovactusu" <?php if($estnovactusu) echo 'checked'; ?> value="1">Inactivar usuario para la asignaci&oacute;n de ordenes de trabajo</td></tr>
							<tr><td class="ui-state-default" colspan="2"></td></tr>							
 							<tr><td colspan="2" class="NoiseFooterTD"><?php if($campnomb["estnovdescri"] == 1){ $estnovdescri=null; echo "*";} ?>&nbsp;Descripci&oacute;n</td></tr>
  							<tr><td colspan="2" class="NoiseFooterTD"><textarea name="estnovdescri" id="estnovdescri" rows="3" cols="50" wrap="VIRTUAL"><?php if(!$flageditarestadonoveda){echo $sbreg[estnovdescri];}else {echo $estnovdescri;}?></textarea></td></tr>
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
			<input type="hidden" name="estnovcodigo" value="<?php if(!$flageditarestadonoveda){ echo $sbreg[estnovcodigo];}else{ echo $estnovcodigo; } ?>"> 
			<input type="hidden" name="accioneditarestadonoveda"> 
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="editar"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>