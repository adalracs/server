<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');


?>
<html> 
	<head> 
		<title>Consultar registro de formula</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">formula</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="550">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr>
								<td width="17%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td>
								<td width="83%" class="NoiseDataTD"><input type="text" name="formulnumero" size="30"	value="<?php echo $formulnumero; ?>"></td> 
 							</tr>
 							<tr>
								<td width="17%" class="NoiseFooterTD">&nbsp;Nombre</td>
								<td width="83%" class="NoiseDataTD"><input type="text" name="formulnombre" size="30"	value="<?php echo $formulnombre; ?>"></td> 
 							</tr>
 							<tr>
								<td width="17%" class="NoiseFooterTD">&nbsp;Serie</td>
								<td width="83%" class="NoiseDataTD"><input type="text" name="formulserie" size="30"	value="<?php echo $formulserie; ?>"></td> 
 							</tr>
 							<tr>
								<td width="17%" class="NoiseFooterTD">&nbsp;Precio <b>COP</b></td>
								<td width="83%" class="NoiseDataTD"><input type="text" name="formulprecio" size="30"	value="<?php echo $formulprecio; ?>"></td> 
 							</tr>
 							<tr>
								<td width="17%" class="NoiseFooterTD">&nbsp;Solido <b>%</b></td>
								<td width="83%" class="NoiseDataTD"><input type="text" name="formulsolido" size="30"	value="<?php echo $formulsolido; ?>"></td> 
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
 			<input type="hidden" name="flagconsultarformula" value="1"> 
			<input type="hidden" name="accionconsultarformula"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="sourcetable" value="formula">
			<input type="hidden" name="sourceaction" value="consultar">
			<input type="hidden" name="columnas" value="formulnumero, formulnombre, formulserie, formulprecio, formulsolido">
			<input type="hidden" name="nombtabl" value="formula"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>