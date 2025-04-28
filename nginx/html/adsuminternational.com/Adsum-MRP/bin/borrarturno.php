<?php 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	
	if(!$flagdetallarturno)
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton); 
	
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');
	} 
?>
<html> 
	<head> 
		<title>Borrar de registro de turno</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Turno</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="450">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Borrar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr> 
 								<td width="22%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
  								<td width="78%" class="NoiseDataTD"><?php echo $sbreg[turnocodigo]; ?></td> 
 							</tr> 
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Turno</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[turnonombre]; ?></td> 
 							</tr> 
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Acr&oacute;nimo</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[turnoacroni]; ?></td> 
 							</tr> 
							<tr>
								<td class="NoiseFooterTD">&nbsp;Periodo</td>
								<td class="NoiseDataTD">De&nbsp;<?php echo date("h:i a", strtotime($sbreg[turnohorini])).' a '.date("h:i a", strtotime($sbreg[turnohorfin])); ?></td> 
 							</tr> 
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
			<input type="hidden" name="turnocodigo" value="<?php echo $sbreg[turnocodigo]; ?>">
 			<input type="hidden" name="flagborrarturno" value="1"> 
			<input type="hidden" name="accionborrarturno">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="borrar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>