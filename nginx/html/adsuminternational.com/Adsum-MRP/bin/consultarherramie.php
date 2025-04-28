<?php 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include('../src/FunPerPriNiv/pktblcentcost.php');
?>
<html> 
	<head> 
		<title>Consultar registro de herramienta</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Herramienta</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="550">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr>
				<tr>
					<td>
       					<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
       						<tr> 
 								<td width="25%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
  								<td width="75%" class="NoiseDataTD"><input type="text" name="herramcodigo"	value="<?php echo $herramcodigo; ?>" size="10"></td> 
 							</tr>
       						<tr> 
 								<td class="NoiseFooterTD">&nbsp;Nombre</td> 
  								<td class="NoiseDataTD"><input type="text" name="herramnombre"	value="<?php echo $herramnombre; ?>" size="50"></td> 
 							</tr>
 							<tr>
								<td class="NoiseFooterTD">&nbsp;C&oacute;digo financiero</td>
								<td class="NoiseDataTD"><select name="cencoscodigo">
									<option value = "">-- Seleccione --</option>
								 	<?php
										include ('../src/FunGen/floadcentcost.php');
										$idcon = fncconn();
										floadcentcost($cencoscodigo,$idcon);
								 	?>
								</select></td>
					    	</tr>
					    	<tr>
							 	<td class="NoiseFooterTD">&nbsp;Valor</td>
							 	<td class="NoiseDataTD"><input name="herramvalor" type="text"	value="<?php echo $herramvalor; ?>" size="20"></td>
							</tr>
					    	<tr>
							 	<td class="NoiseFooterTD">&nbsp;Cantidad disponible</td>
							 	<td class="NoiseDataTD"><input name="herramdispon" type="text"	value="<?php echo $herramdispon; ?>" size="20"></td>
							</tr>
							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><textarea name="herramdescri" rows="3" cols="63"><?php echo $herramdescri; ?></textarea>  </td></tr>
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
			<input type="hidden" name="flagconsultarherramie" value="1">
			<input type="hidden" name="accionconsultarherramie">
			<input type="hidden" name="columnas" value="herramcodigo,cencoscodigo,herramnombre,herramvalor,herramdescri,herramdispon">
			<input type="hidden" name="nombtabl" value="herramie">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>