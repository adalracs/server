<?php 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	
	if(!$flagborrarfestivo)
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton); 
	
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');
			
		$arr_tipo = array(1 => 'D&iacute;a c&iacute;vico', 2 => 'Fiesta religiosa', 3 => 'Semana santa', 4 => 'Pascua');
		$arr_mes = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Seprtiembre','Octubre','Noviembre','Diciembre');
	} 
?>
<html> 
	<head> 
		<title>Borrar de registro de Festivos</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">D&iacute;a Festivo</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="450">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Borrar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr> 
 								<td width="22%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
  								<td width="78%" class="NoiseDataTD"><?php echo $sbreg[festivcodigo]; ?></td> 
 							</tr> 
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Celebraci&oacute;n</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[festivnombre]; ?></td> 
 							</tr> 
							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Tipo</td>
								<td class="NoiseDataTD"><?php echo $arr_tipo[$sbreg['festivtipo']]; ?></td> 
 							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;A&ntilde;o</td>
								<td class="NoiseDataTD"><?php if($sbreg['festivano']) echo $sbreg['festivano']; else echo 'Todos los A&ntilde;os'; ?></td> 
 							</tr> 
							<tr>
								<td class="NoiseFooterTD">&nbsp;D&iacute;a</td>
								<td class="NoiseDataTD"><?php echo $arr_mes[$sbreg['festivmes']-1].' '.$sbreg['festivdia']; ?></td> 
 							</tr>
							<?php if($sbreg['festivmovdias']): ?>
							<tr><td class="NoiseFooterTD" colspan="2">&nbsp;Trasladarlo de su fecha original, al lunes siguiente</td></tr>
							<?php endif; ?>
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><?php echo $sbreg[festivdescri]; ?></td></tr>
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
			<input type="hidden" name="festivcodigo" value="<?php echo $sbreg[festivcodigo]; ?>">
 			<input type="hidden" name="flagborrarfestivo" value="1"> 
			<input type="hidden" name="accionborrarfestivo">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="borrar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>