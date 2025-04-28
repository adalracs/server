<?php 
ob_start(); 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktbltiposoliprog.php');
	 
	
	if($accionnuevoestadoalarma)
		include ('grabaestadoalarma.php');
	
		
		$arr_tipo = array(1 => 'Activo', 0 => 'Inactivo');
ob_end_flush(); 

?>
<html> 
	<head> 
		<title>Nuevo Registro de Estado</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Estado de Alarma</font></p> 
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
								<td width="10%" class="NoiseFooterTD"><?php if($campnomb["estalanombre"] == 1){ $estalanombre = null; echo "*";}?>&nbsp;Nombre&nbsp;</td>
								<td width="40%" class="NoiseDataTD"><input type="text" name="estalanombre" size="30" value="<?php if(!$flagnuevoestadoalarma){ echo $sbreg[estalanombre];}else{ echo $estalanombre; }?>"></td>
 							</tr>
 							<tr>
								<td width="10%" class="NoiseFooterTD"><?php if($campnomb["estaladescri"] == 1){ $estaladescri = null; echo "*";}?>&nbsp;Descripcion&nbsp;</td>
							  <td width="40%" class="NoiseDataTD"><textarea name="estaladescri" rows="3" cols="63"><?php if(!$flagnuevoestadoalarma){ echo $sbreg[estaladescri];}else{ echo $estaladescri;} ?></textarea>
						  </tr>
 							<tr>
 								<td width="10%" class="NoiseFooterTD"></td>
 							</tr>
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr>
							  <td class="NoiseFooterTD"><?php if($campnomb["tipalatipo"] == 1){ $tipalatipo = null; echo "*";}?>
							    &nbsp;Tipo Estado&nbsp;</td>
							  <td class="NoiseDataTD"><select name="tipalatipo" id="tipalatipo">
					          <option value="">--Seleccione--</option>
					          <option value="1" <?php if($tipalatipo == 1){echo 'selected';}?> >Activo</option>
							  <option value="0" <?php if($tipalatipo == '0'){echo 'selected';}?> >Inactivo</option>
	
					          </select></td>
						  </tr>
							<tr>
							  <td colspan="2" rowspan="2" class="NoiseDataTD">&nbsp;</td></tr>
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
			<input type="hidden" name="accionnuevoestadoalarma">  
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="nuevo">						
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 	
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>