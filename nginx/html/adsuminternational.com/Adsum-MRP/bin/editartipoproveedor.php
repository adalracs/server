<?php 
ob_start();
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunGen/cargainput.php');
	
	if($accioneditartipoproveedor) 
	{ 
		include ( 'editatipoproveedor.php'); 
		$flageditartipoproveedor = 1;
	}
ob_end_flush();
	if(!$flageditartipoproveedor)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');
		
	}
?>
<html> 
	<head> 
		<title>Editar registro de tipo de proveedor</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Tipo de proveedor</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="700">
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
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Editar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" > 
							<tr>
								<td width="10%" class="NoiseFooterTD"><?php if($campnomb["tipprocodigo"] == 1){ $tipprocodigo = null; echo "*";}?>&nbsp;Codigo&nbsp;</td>
								<td width="30%" class="NoiseDataTD"><?php if(!$flageditartipoproveedor){echo $sbreg[tipprocodigo];}else{echo $tipprocodigo;}?></td> 
 							</tr> 
 							<tr>
								<td width="10%" class="NoiseFooterTD"><?php if($campnomb["tippronombre"] == 1){ $tippronombre = null; echo "*";}?>&nbsp;Nombre&nbsp;</td>
								<td width="40%" class="NoiseDataTD"><input type="text" name="tippronombre" size="30"	value="<?php if(!$flageditartipoproveedor){ echo $sbreg[tippronombre];}else {echo $tippronombre; }?>"></td>
 							</tr>
 							<tr>
 								<td width="10%" class="NoiseFooterTD"></td>
 							</tr>
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD"><?php if($campnomb["tipprodescri"] == 1){$tipprodescri = null; echo "*";}?>&nbsp;Descripcion</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><textarea name="tipprodescri" rows="3" cols="63"><?php if(!$flageditartipoproveedor){ echo $sbreg[tipprodescri];}else{ echo $tipprodescri;} ?></textarea></td></tr>																
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
			<input type="hidden" name="accioneditartipoproveedor">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="tipprocodigo" value="<?php if(!$flageditartipoproveedor){echo $sbreg[tipprocodigo];}else{echo $tipprocodigo;}?>">
			<input type="hidden" name="sourceaction" value="editar">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>