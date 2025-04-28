<?php 	
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	
	if(!$flagdetallarestadonoveda)
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton); 
	
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');
	} 
?>
<html> 
	<head> 
		<title>Detalle de registro de Novedades</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Novedad</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="450">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr> 
 								<td width="22%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
  								<td width="78%" class="NoiseDataTD"><?php echo $sbreg[estnovcodigo]; ?></td> 
 							</tr> 
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Novedad</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[estnovnombre]; ?></td> 
 							</tr> 
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Acr&oacute;nimo</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[estnovacroni]; ?></td> 
 							</tr> 
							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<?php if($sbreg['estnovactusu']): ?>
							<tr><td class="NoiseDataTD" colspan="2">&nbsp;Inactivar usuario para la asignaci&oacute;n de ordenes de trabajo</td></tr>
							<?php endif; ?>
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><?php echo $sbreg[estnovdescri]; ?></td></tr>
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
 			<input type="hidden" name="flagdetallarestadonoveda" value="1"> 
			<input type="hidden" name="acciondetallarestadonoveda">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="columnas" value="estnovcodigo,estnovnombre,estnovdescri,estnovactusu,estnovacroni"> 
 			<input type="hidden" name="estnovcodigo" value="<?php if($accionconsultarestadonoveda) echo $estnovcodigo; ?>"> 
 			<input type="hidden" name="estnovnombre" value="<?php if($accionconsultarestadonoveda) echo $estnovnombre; ?>"> 
 			<input type="hidden" name="estnovdescri" value="<?php if($accionconsultarestadonoveda) echo $estnovdescri; ?>"> 
 			<input type="hidden" name="estnovacroni" value="<?php if($accionconsultarestadonoveda) echo $estnovacroni; ?>"> 
 			<input type="hidden" name="estnovactusu" value="<?php if($accionconsultarestadonoveda) echo $estnovactusu; ?>">
 			<input type="hidden" name="accionconsultarestadonoveda" value="<?php echo $accionconsultarestadonoveda; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>