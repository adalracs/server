<?php 
ob_start();
	include ( '../src/FunGen/sesion/fncvalses.php');
	if($accioneditarnegocio)
	{
		include ( 'editanegocio.php');
		$flageditarnegocio = 1;
	}
	ob_end_flush();
	
	if(!$flageditarnegocio)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');
	}
?>
<html> 
	<head> 
		<title>Editar registro de negocio</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head>
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Negocio</font></p> 
			<table width="470" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content">
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
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr> 
 								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["negocinombre"] == 1){$negocinombre = null; echo "*";}?>&nbsp;Negocio</td> 
 								<td width="75%" class="NoiseDataTD"><input type="text" name="negocinombre" id="negocinombre"  size="50" value="<?php if(!$flageditarnegocio){echo $sbreg[negocinombre];}else{ echo $negocinombre; }?>"></td> 
 							</tr> 
							<tr> 
 								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["negocicacint"] == 1){$negocinombre = null; echo "*";}?>&nbsp;C&oacute;digo Integraci&oacute;n</td> 
 								<td width="75%" class="NoiseDataTD"><input type="text" name="negocicacint" id="negocicacint"  size="14" value="<?php if(!$flageditarnegocio){echo $sbreg[negocicacint];}else{ echo $negocicacint; }?>"></td> 
 							</tr> 
 							<tr><td colspan="2" class="NoiseFooterTD"><?php if($campnomb["negocidescri"] == 1){ $negocidescri=null; echo "*";} ?>&nbsp;Descripci&oacute;n</td></tr>
  							<tr><td colspan="2" class="NoiseFooterTD"><textarea name="negocidescri" id="negocidescri" rows="3" cols="53" wrap="VIRTUAL"><?php if(!$flageditarnegocio){echo $sbreg[negocidescri];}else {echo $negocidescri;}?></textarea></td></tr>
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
			<input type="hidden" name="negocicodigo1" value="<?php if(!$flageditarnegocio){ echo $sbreg[negocicodigo];}else{ echo $negocicodigo1; } ?>"> 
			<input type="hidden" name="accioneditarnegocio">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="editar">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>