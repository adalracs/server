<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblfabricante.php'); 
?>
<html> 
	<head> 
		<title>Consultar registro de fabricante</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Fabricante</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="550">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr>
								<td width="17%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td>
								<td width="83%" class="NoiseDataTD"><input type="text" name="fabricodigo" size="30"	value="<?php echo $fabricodigo; ?>"></td> 
 							</tr>
							<tr>
								<td width="17%" class="NoiseFooterTD">&nbsp;Nombre</td>
								<td width="83%" class="NoiseDataTD"><input type="text" name="fabrirazsol" size="30"	value="<?php echo $fabrirazsol; ?>"></td> 
 							</tr>
 							<tr>
								<td width="17%" class="NoiseFooterTD">&nbsp;Nit</td>
								<td width="83%" class="NoiseDataTD"><input type="text" name="fabrinit" size="30"	value="<?php echo $fabrinit; ?>"></td> 
 							</tr>
 							<tr>
								<td width="17%" class="NoiseFooterTD">&nbsp;Pais</td>
								<td width="83%" class="NoiseDataTD"><input type="text" name="fabripais" size="30"	value="<?php echo $fabripais; ?>"></td> 
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
 			<input type="hidden" name="flagconsultarfabricante" value="1"> 
			<input type="hidden" name="accionconsultarfabricante"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar">
			<input type="hidden" name="columnas" value="fabricodigo,fabrirazsol,fabrinit,fabripais"> 
			<input type="hidden" name="nombtabl" value="fabricodigo"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>