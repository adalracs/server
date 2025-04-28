<?php 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include ( '../src/FunPerPriNiv/pktbldepartamento.php');
	include ( '../src/FunPerPriNiv/pktblciudad.php');
	
	if(!$flagborrarzona)
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton); 
		
		if (!$sbreg) 
			include( '../src/FunGen/fnccontfron.php'); 
		
		$idconn = fncconn();
		$rs_ciudad = loadrecordciudad($sbreg[ciudadcodigo],$idconn);
		$rs_depto = loadrecorddepartamento($rs_ciudad[deptocodigo], $idconn);
	} 
?>
<html> 
	<head> 
		<title>Borrar de registro de zona</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Zona</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="450">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Borrar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr> 
 								<td width="22%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
  								<td width="78%" class="NoiseDataTD"><?php echo $sbreg[zonacodigo]; ?></td> 
 							</tr> 
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Zona</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[zonanombre]; ?></td> 
 							</tr> 
							<tr>
								<td class="NoiseFooterTD">&nbsp;Ciudad</td>
								<td class="NoiseDataTD"><?php echo $rs_ciudad[ciudadnombre] ?></td> 
 							</tr> 
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><?php echo $sbreg[zonadescri]; ?></td></tr>
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
			<input type="hidden" name="zonacodigo" value="<?php echo $sbreg[zonacodigo]; ?>">
 			<input type="hidden" name="flagborrarzona" value="1"> 
			<input type="hidden" name="accionborrarzona">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="borrar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>