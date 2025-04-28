<?php 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	if(!$flagdetallarestadoalarma) 
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton);
		
		if (!$sbreg) 
			include( '../src/FunGen/fnccontfron.php'); 
	} 
	
	$arr_tipo = array(1 => 'Activo', 0 => 'Inactivo');
?> 
<html> 
	<head> 
		<title>Detalle de registro de Estado de Alarma</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
			
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Estado de Alarma</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="450">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Detallar Registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr> 
 								<td width="20%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
  								<td width="80%" class="NoiseDataTD"><?php echo $sbreg[estalacodigo]; ?></td> 
 							</tr> 
							<tr> 
 								<td width="20%" class="NoiseFooterTD">&nbsp;Nombre</td> 
  								<td width="80%" class="NoiseDataTD"><?php echo $sbreg[estalanombre]; ?></td> 
 							</tr> 
							<tr> 
 								<td width="20%" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td> 
  								<td width="80%" class="NoiseDataTD"><?php echo $sbreg[estaladescri]; ?></td> 
 							</tr> 
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr>
							  <td class="NoiseFooterTD">&nbsp;Tipo</td>
							  <td class="NoiseDataTD"><?php echo $arr_tipo[$sbreg[tipalatipo]]; ?></td>
						  </tr>
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
 			<input type="hidden" name="flagdetallarestadoalarma" value="1"> 
			<input type="hidden" name="acciondetallarestadoalarma">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?>
</html>