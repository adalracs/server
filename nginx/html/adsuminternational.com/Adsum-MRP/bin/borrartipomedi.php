<?php 	
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	
	if(!$flagborrartipomedi)
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton); 
	
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php'); 
			
		if($sbreg[tipmedtiempo] == 1) 
			$tiempo = 'Minutos';
		else if($sbreg[tipmedtiempo] == 2)
			$tiempo = 'Horas';
		else if($sbreg[tipmedtiempo] == 3)
			$tiempo = 'Dias';
		else
			$tiempo = 'DESCONOCIDO';
	} 
?>
<html> 
	<head> 
		<title>Borrar de registro de tipo de medidor</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">tipo de medidor</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="470">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Borrar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr> 
 								<td width="30%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
  								<td width="70%" class="NoiseDataTD"><?php echo $sbreg[tipmedcodigo]; ?></td> 
 							</tr> 
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Nombre</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[tipmednombre]; ?></td> 
 							</tr>  
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Acr&oacute;nimo</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[tipmedacra]; ?></td> 
 							</tr> 
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Tiempo Medidor</td> 
  								<td class="NoiseDataTD"><?php echo $tiempo ?></td> 
 							</tr>  
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><?php echo $sbreg[tipmeddescri]; ?></td></tr>
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
 			<input type="hidden" name="flagborrartipomedi" value="1">
 			<input type="hidden" name="tipmedcodigo1" value="<?php if(!$flagborrartipomedi){ echo $sbreg[tipmedcodigo];}else{ echo $tipmedcodigo1; } ?>">
			<input type="hidden" name="accionborrartipomedi">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="borrar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="columnas" value="tipmedcodigo, tipmednombre, tipmeddescri">
			<input type="hidden" name="tipmedcodigo" value="<?php  if($accionconsultartipomedi) echo $tipmedcodigo; ?>"> 
 			<input type="hidden" name="tipmednombre" value="<?php  if($accionconsultartipomedi) echo $tipmednombre; ?>"> 
 			<input type="hidden" name="tipmeddescri" value="<?php  if($accionconsultartipomedi) echo $tipmeddescri; ?>"> 
 			<input type="hidden" name="accionconsultartipomedi" value="<?php  echo $accionconsultartipomedi; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>