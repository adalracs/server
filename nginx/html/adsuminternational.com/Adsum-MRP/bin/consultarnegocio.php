<?php 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
?>
<html> 
	<head> 
		<title>Consultar en negocio</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head>
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Negocio</font></p> 
			<table width="470" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Consultar registro</font></span></td></tr>
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr> 
 								<td width="25%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
 								<td width="75%" class="NoiseDataTD"><input type="text" name="negocicodigo" id="negocicodigo"  size="14" value="<?php  echo $negocicodigo; ?>"></td> 
 							</tr> 
							<tr> 
 								<td width="25%" class="NoiseFooterTD">&nbsp;Negocio</td> 
 								<td width="75%" class="NoiseDataTD"><input type="text" name="negocinombre" id="negocinombre"  size="50" value="<?php  echo $negocinombre; ?>"></td> 
 							</tr> 
							<tr> 
 								<td width="25%" class="NoiseFooterTD">&nbsp;C&oacute;digo Integraci&oacute;n</td> 
 								<td width="75%" class="NoiseDataTD"><input type="text" name="negocicacint" id="negocicacint"  size="14" value="<?php  echo $negocicacint; ?>"></td> 
 							</tr> 
 							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td></tr>
  							<tr><td colspan="2" class="NoiseFooterTD"><textarea name="negocidescri" id="negocidescri" rows="3" cols="53" wrap="VIRTUAL"><?php echo $negocidescri; ?></textarea></td></tr>
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
			<input type="hidden" name="flagconsultarnegocio" value="1"> 
			<input type="hidden" name="accionconsultarnegocio">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="columnas" value="negocicodigo,negocinombre,negocidescri,negocicacint"> 
			<input type="hidden" name="nombtabl" value="negocio"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>