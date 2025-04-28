<?php 
ob_start(); 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include ( '../src/FunPerPriNiv/pktblitemdesa.php'); 
	
	if($accionnuevotipoembobinado)
		include ( 'grabatipoembobinado.php');
	
		$link = 1;
ob_end_flush(); 
?>
<html> 
	<head> 
		<title>Nuevo registro de tipos de embobinado</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.uploadtipoembobinado.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.delfileequ.js"></script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Tipos de embobinado</font></p> 
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
								<td class="NoiseErrorDataTD"  rowspan="6" colspan="2" width="30%" align="center">&nbsp;
            						<img name="fotoimage" name="fotoimage" alt="Buscar imagen..." width="170" height="145" src="../img/pics_embobinados/<?php if(!$rutafoto){ echo 'no_image.jpg';}else{echo $rutafoto; }?>">
            						<a href="#" id="cargarEmbobinado" class="ui-state-default ui-corner-all <?php if($campnomb['rutafoto'] == 1){echo 'ui-state-error';}?>"><span class="ui-icon ui-icon-circle-close"></span>Subir imagen</a>
            					</td>
							</tr>
 							<tr>
								<td width="10%" class="NoiseFooterTD"><?php if($campnomb["tipembnombre"] == 1){ $tipembnombre = null; echo "*";}?>&nbsp;Nombre&nbsp;</td>
								<td width="40%" class="NoiseDataTD"><input type="text" name="tipembnombre" size="30"	value="<?php if(!$flagnuevotipoembobinado){ echo $sbreg[tipembnombre];}else {echo $tipembnombre; }?>"></td>
 							</tr>
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD"><?php if($campnomb["tipembdescri"]	 == 1){$tipembdescri = null; echo "*";}?>&nbsp;Nota</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><textarea name="tipembdescri" rows="3" cols="63"><?php if(!$flagnuevotipoembobinado){ echo $sbreg[tipembdescri];}else{ echo $tipembdescri;} ?></textarea>  </td></tr>
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
			<input type="hidden" name="accionnuevotipoembobinado">  
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="nuevo">						
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" id="rutafoto" name="rutafoto" value="<?php echo $rutafoto  ?>">
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div> 	
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>