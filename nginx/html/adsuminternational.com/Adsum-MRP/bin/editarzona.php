<?php 
ob_start(); 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include('../src/FunPerPriNiv/pktbldepartamento.php');
	include('../src/FunPerPriNiv/pktblciudad.php');
	
	if($accioneditarzona)
	{ 
		include ( 'editazona.php'); 
		$flageditarzona = 1; 
	} 
ob_end_flush(); 

	if(!$flageditarzona)
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton); 
		if (!$sbreg) 
			include( '../src/FunGen/fnccontfron.php');
			
		$ciudadcodigo = $sbreg['ciudadcodigo'];	
//		$idcon = fncconn();
//		$rs_ciudad = loadrecordciudad($sbreg['ciudadcodigo'],$idcon);
	} 
?>
<html> 
	<head> 
		<title>Editar registro de zona</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Zona</font></p> 
			<table width="450" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content">
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
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Editar registro</font></span></td></tr>
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center">
            				<tr> 
 								<td width="22%" class="NoiseFooterTD"><?php if($campnomb["zonanombre"] == 1){$zonanombre = null; echo "*";}?>&nbsp;Zona</td> 
 								<td width="78%" class="NoiseDataTD"><input type="text" name="zonanombre"  size="50" value="<?php if(!$flageditarzona){echo $sbreg[zonanombre];}else{ echo $zonanombre; }?>"></td> 
 							</tr> 
							<tr>
     							<td class="NoiseFooterTD"><?php if($campnomb["ciudadcodigo"] == 1){ $ciudadcodigo = null; echo "*";} ?>&nbsp;Ciudad</td>
     							<td class="NoiseDataTD"><select name="ciudadcodigo" id="ciudadcodigo">
     								<option value = "">-- Seleccione --</option>
	     							<?php
										include ('../src/FunGen/floadciudad.php');
										$idcon = fncconn();
										floadciudad($idcon, $ciudadcodigo);
										fncclose($idcon);
									?>
    							</select></td>
							</tr>   
 							<tr><td colspan="2" class="NoiseFooterTD"><?php if($campnomb["zonadescri"] == 1){ $zonadescri=null; echo "*";} ?>&nbsp;Descripci&oacute;n</td></tr>
  							<tr><td colspan="2" class="NoiseFooterTD"><textarea name="zonadescri" id="zonadescri" rows="3" cols="50" wrap="VIRTUAL"><?php if(!$flageditarzona){echo $sbreg[zonadescri];}else {echo $zonadescri;}?></textarea></td></tr>
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
			<input type="hidden" name="zonacodigo" value="<?php if(!$flageditarzona){ echo $sbreg[zonacodigo];}else{ echo $zonacodigo; } ?>"> 
			<input type="hidden" name="accioneditarzona"> 
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="editar"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>