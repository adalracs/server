<?php 	
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include ( '../src/FunPerPriNiv/pktblitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblprocedimiento.php');
	include ( '../src/FunGen/cargainput.php');
	
	if(!$flagborrarpadreitem)
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton); 
	
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php'); 
			
		$extruido = ($sbreg['paditeextrui'] == 't')? 'Si' : 'No';
		$pigmen = ($sbreg['paditepigmen'] == 't')? 'Si' : 'No';
		$procedcodigo = $sbreg[procedcodigo];
	} 
	
	$idcon = fncconn();
?>
<html> 
	<head> 
		<title>Borrar de registro de padre item</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Padre item</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="470">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Borrar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr> 
 								<td width="22%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
  								<td width="78%" class="NoiseDataTD"><?php echo $sbreg[paditecodigo]; ?></td> 
 							</tr> 
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Nombre</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[paditenombre]; ?></td> 
 							</tr>  
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Extruido</td> 
  								<td class="NoiseDataTD"><?php echo $extruido; ?></td> 
 							</tr> 
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Procedimiento</td> 
  								<td class="NoiseDataTD"><?php echo cargaprocedimientonombre($procedcodigo,$idcon); ?></td> 
 							</tr> 
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Pigmentado</td> 
  								<td class="NoiseDataTD"><?php echo $pigmen; ?></td> 
 							</tr> 
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Densidad</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[paditedensid]; ?></td> 
 							</tr>
 							<tr>
 								<td colspan="2" class="ui-state-default">&nbsp;<small>Refile</small></td>
 							</tr>
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Laminado (mm)</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[paditelamind]; ?></td> 
 							</tr>
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Flexo (mm)</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[paditeflexo]; ?></td> 
 							</tr>
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><?php echo $sbreg[paditedescri]; ?></td></tr>
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
 			<input type="hidden" name="flagborrarpadreitem" value="1">
 			<input type="hidden" name="paditecodigo1" value="<?php if(!$flagborrarpadreitem){ echo $sbreg[paditecodigo];}else{ echo $paditecodigo1; } ?>">
			<input type="hidden" name="accionborrarpadreitem">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="borrar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="columnas" value="paditecodigo, paditenombre, paditedescri">
			<input type="hidden" name="paditecodigo" value="<?php  if($accionconsultarpadreitem) echo $paditecodigo; ?>"> 
 			<input type="hidden" name="paditenombre" value="<?php  if($accionconsultarpadreitem) echo $paditenombre; ?>"> 
 			<input type="hidden" name="paditedescri" value="<?php  if($accionconsultarpadreitem) echo $paditedescri; ?>"> 
 			<input type="hidden" name="accionconsultarpadreitem" value="<?php  echo $accionconsultarpadreitem; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>