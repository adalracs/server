<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ('../src/FunGen/cargainput.php');
	
	if(!$flagdetallarformula) 
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton);
		
		if (!$sbreg) 
			include( '../src/FunGen/fnccontfron.php');
	} 
?>
<html> 
	<head> 
		<title>Detalle de registro de formula</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Formulaci&oacute;n</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="450">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center"> 
            				<tr>
								<td width="25%" class="NoiseFooterTD">&nbsp;Codigo (Formula)&nbsp;</td>
								<td width="75%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[formulnumero]; ?></td>
							</tr>
							<tr>
								<td width="25%" class="NoiseFooterTD">&nbsp;Nombre&nbsp;</td>
								<td width="75%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[formulnombre]; ?></td>
							</tr>
							<tr>
								<td width="25%" class="NoiseFooterTD">&nbsp;Serie&nbsp;</td>
								<td width="75%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[formulserie]; ?></td>
							</tr>
							<tr>
								<td width="25%" class="NoiseFooterTD">&nbsp;Precio&nbsp; <b>COP</b></td>
								<td width="75%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[formulprecio]; ?></td>
							</tr>
							<tr>
								<td width="25%" class="NoiseFooterTD">&nbsp;Solido <b>%</b>&nbsp;</td>
								<td width="75%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[formulsolido]; ?></td>
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
 			<input type="hidden" name="flagdetallarformula" value="1"> 
			<input type="hidden" name="acciondetallarformula">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="columnas" value="formulnumero,formulfecha,formuldescri">
			<input type="hidden" name="formulpadre" id="formulpadre" value="<?php echo $sbreg[formulpadre] ?>" /> 
			<input type="hidden" name="formulnumero" value="<?php if($accionconsultarformula) echo $formulnumero; ?>"> 
 			<input type="hidden" name="formulfecha" value="<?php if($accionconsultarformula) echo $formulfecha; ?>">  
 			<input type="hidden" name="accionconsultarformula" value="<?php echo $accionconsultarformula; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>