<?php 	
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	
	if(!$flagborraritemventas)
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton); 
	
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php'); 
	} 
?>
<html> 
	<head> 
		<title>Borrar de registro de item</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">item</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="470">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Borrar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr> 
 								<td width="25%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
  								<td width="75%" class="NoiseDataTD"><?php echo $sbreg[itevencodigo]; ?></td> 
 							</tr> 
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Nombre</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[itevennombre]; ?></td> 
 							</tr> 
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Densidad</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[itevendensid]; ?></td> 
 							</tr>  
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Extruido</td> 
  								<td class="NoiseDataTD"><?php echo ($sbreg[itevenextru] == 't')? 'Si':'No' ; ?></td> 
 							</tr>  
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Pigmentado</td> 
  								<td class="NoiseDataTD"><?php echo ($sbreg[itevenpigme] == 't')? 'Si':'No' ; ?></td> 
 							</tr>  
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><?php echo $sbreg[itevendescri]; ?></td></tr>
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
 			<input type="hidden" name="flagborraritemventas" value="1">
 			<input type="hidden" name="itevencodigo1" value="<?php if(!$flagborraritemventas){ echo $sbreg[itevencodigo];}else{ echo $itevencodigo1; } ?>">
			<input type="hidden" name="accionborraritemventas">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="borrar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="columnas" value="itevencodigo, itevennombre, itevendescri">
			<input type="hidden" name="itevencodigo" value="<?php  if($accionconsultaritemventas) echo $itevencodigo; ?>"> 
 			<input type="hidden" name="itevennombre" value="<?php  if($accionconsultaritemventas) echo $itevennombre; ?>"> 
 			<input type="hidden" name="itevendescri" value="<?php  if($accionconsultaritemventas) echo $itevendescri; ?>"> 
 			<input type="hidden" name="accionconsultaritemventas" value="<?php  echo $accionconsultaritemventas; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>