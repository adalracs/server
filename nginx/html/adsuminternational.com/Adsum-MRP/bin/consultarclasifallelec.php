<?php 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
?>
<html> 
	<head> 
		<title>Consultar en clasificacion fallas electricas</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Clasificaci&oacute;n de fallas el&eacute;ctricas</font></p> 
			<table width="450" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content"> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr>
  				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content"> 
							<tr> 
 								<td width="20%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
 								<td width="80%" class="NoiseDataTD"><input type="text" name="cfalelcodigo" id="cfalelcodigo"  size="10" value="<?php echo $cfalelcodigo; ?>"></td> 
 							</tr> 
							<tr> 
 								<td width="20%" class="NoiseFooterTD">&nbsp;Nombre</td> 
 								<td width="80%" class="NoiseDataTD"><input type="text" name="cfalelnombre" id="cfalelnombre"  size="50" value="<?php echo $cfalelnombre; ?>"></td> 
 							</tr> 
							<tr>
     							<td class="NoiseFooterTD"><?php if($campnomb["cfalelhcolor"] == 1){ $cfalelhcolor = null; echo "*";} ?>&nbsp;Color</td>
     							<td class="NoiseDataTD"><select name="cfalelhcolor" id="cfalelhcolor">
     								<option value = "">-- Seleccione --</option>
     								<option value = "40FF00" style="background-color: #40FF00;" <?php if($cfalelhcolor == "40FF00") echo "selected" ?>>- Verde -</option>
     								<option value = "FFFF00" style="background-color: #FFFF00;" <?php if($cfalelhcolor == "FFFF00") echo "selected" ?>>- Amarillo -</option>
     								<option value = "FFBF00" style="background-color: #FFBF00;" <?php if($cfalelhcolor == "FFBF00") echo "selected" ?>>- Naranja -</option>
     								<option value = "FF0000" style="background-color: #FF0000;" <?php if($cfalelhcolor == "FF0000") echo "selected" ?>>- Rojo -</option>
    							</select></td>
							</tr>   
 							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td></tr>
  							<tr><td colspan="2" class="NoiseFooterTD"><textarea name="cfaleldescri" id="cfaleldescri" rows="3" cols="50" wrap="VIRTUAL"><?php echo $cfaleldescri; ?></textarea></td></tr>
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
 			<input type="hidden" name="flagconsultarclasifallelec" value="1"> 
			<input type="hidden" name="accionconsultarclasifallelec">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="columnas" value="cfalelcodigo,cfalelnombre,cfaleldescri,cfalelhcolor"> 
			<input type="hidden" name="nombtabl" value="clasifallelec"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>