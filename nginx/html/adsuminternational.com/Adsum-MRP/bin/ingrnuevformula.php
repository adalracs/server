<?php 
ob_start(); 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include ( '../src/FunPerPriNiv/pktblitemdesa.php'); 
	if($accionnuevoformula)
		include ( 'grabaformula.php');
		
	
ob_end_flush(); 
?>
<html> 
	<head> 
		<title>Nuevo registro de formula</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.desarrollo.js"></script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Formula</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="750">
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
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["formulnumero"] == 1){ $formulnumero = null; echo "*";}?>&nbsp;Codigo (Mezcla)&nbsp;</td>
								<td width="75%" class="NoiseDataTD"><input type="text" name="formulnumero" size="30"	value="<?php if(!$flagnuevoformula){ echo $sbreg[formulnumero];}else {echo $formulnumero; }?>"></td>
							</tr>
							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["formulnombre"] == 1){ $formulnombre = null; echo "*";}?>&nbsp;Nombre&nbsp;</td>
								<td width="75%" class="NoiseDataTD"><input type="text" name="formulnombre" size="30"	value="<?php if(!$flagnuevoformula){ echo $sbreg[formulnombre];}else {echo $formulnombre; }?>"></td>
							</tr>
							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["formulserie"] == 1){ $formulserie = null; echo "*";}?>&nbsp;Serie&nbsp;</td>
								<td width="75%" class="NoiseDataTD"><input type="text" name="formulserie" size="30"	value="<?php if(!$flagnuevoformula){ echo $sbreg[formulserie];}else {echo $formulserie; }?>"></td>
							</tr>
							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["formulprecio"] == 1){ $formulprecio = null; echo "*";}?>&nbsp;Precio&nbsp; <b>COP</b></td>
								<td width="75%" class="NoiseDataTD"><input type="text" name="formulprecio" size="30"	value="<?php if(!$flagnuevoformula){ echo $sbreg[formulprecio];}else {echo $formulprecio; }?>"></td>
							</tr>
							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["formulsolido"] == 1){ $formulsolido = null; echo "*";}?>&nbsp;Solido <b>%</b>&nbsp;</td>
								<td width="75%" class="NoiseDataTD"><input type="text" name="formulsolido" size="30"	value="<?php if(!$flagnuevoformula){ echo $sbreg[formulsolido];}else {echo $formulsolido; }?>"></td>
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
			<input type="hidden" name="accionnuevoformula">  
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="nuevo">						
			<input type="hidden" name="formulfecha" value="<?php echo date('Y-m-d') ?>">						
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<script type="text/javascript">validaPorcentaje();</script>
		</form> 	
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>