<?php 
ob_start();
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	if($accionnuevotipomovi)
		include ( 'grabatipomovi.php');
ob_end_flush();
?>
<html> 
	<head> 
		<title>Nuevo registro de tipo de movimiento</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Tipo de movimiento</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="450">
<?php if($campnomb): ?>
				<tr><td><div class="ui-widget">
					<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
						<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
						<strong>Advertencia:</strong> Corrija los campos marcados con *</p>
					</div>
				</div></td></tr>
<?php else: ?> 		
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
<?php endif; ?> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Ingresar nuevo registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["tipmovnombre"] == 1){ $tipmovnombre = null; echo "*";}?>&nbsp;Nombre</td>
								<td width="80%" class="NoiseDataTD"><input type="text" name="tipmovnombre" size="50"	value="<?php if(!$flagnuevotipomovi){ echo $sbreg[tipmovnombre];}else {echo $tipmovnombre; }?>"></td> 
 							</tr> 
							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["tipmovtipo"] == 1){ $tipmovtipo = null; echo "*";}?>&nbsp;Tipo</td>
								<td width="80%" class="NoiseDataTD"><select name="tipmovtipo">
									<option value="">-- Seleccione --</option>
									<option value="1" <?php if($flagnuevotipomovi){ if($tipmovtipo == 1) { echo 'selected'; }}?>>Ingreso</option>
									<option value="0" <?php if($flagnuevotipomovi){ if($tipmovtipo == 0) { echo 'selected'; }}?>>Egreso</option>
								</select></td> 
 							</tr> 
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD"><?php if($campnomb["tipmovdescri"]	 == 1){$tipmovdescri = null; echo "*";}?>&nbsp;Descripci&oacute;n</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><textarea name="tipmovdescri" rows="3" cols="50"><?php if(!$flagnuevotipomovi){ echo $sbreg[tipmovdescri];}else{ echo $tipmovdescri;} ?></textarea>  </td></tr>
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
			<input type="hidden" name="accionnuevotipomovi"> 
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="nuevo">			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 	
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>