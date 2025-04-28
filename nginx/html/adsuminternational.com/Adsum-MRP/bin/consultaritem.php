<?php 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include('../src/FunPerPriNiv/pktblproveedo.php');
	include('../src/FunPerPriNiv/pktblcentcost.php');
	include('../src/FunPerPriNiv/pktblunimedida.php');
?>
<html> 
	<head> 
		<title>Consultar registro de Item</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Item</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="600">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr>
				<tr>
					<td>
       					<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
       						<tr> 
 								<td class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
  								<td colspan="3" class="NoiseDataTD"><input type="text" name="itemcodigo"	value="<?php echo $itemcodigo; ?>" size="30"></td> 
 							</tr>
       						<tr> 
 								<td class="NoiseFooterTD">&nbsp;Nombre</td> 
  								<td colspan="3" class="NoiseDataTD"><input type="text" name="itemnombre"	value="<?php echo $itemnombre; ?>" size="50"></td> 
 							</tr>
 							<tr>
								<td class="NoiseFooterTD">&nbsp;C&oacute;digo financiero</td>
								<td colspan="3" class="NoiseDataTD"><select name="cencoscodigo">
									<option value = "">-- Seleccione --</option>
								 	<?php
										include ('../src/FunGen/floadcentcost.php');
										$idcon = fncconn();
										floadcentcost($cencoscodigo,$idcon);
								 	?>
								</select></td>
					    	</tr>
					    	<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Unidad de medida</td>
								<td width="30%" class="NoiseDataTD"><select name="unidadcodigo">
							  		<option value = "">-- Seleccione --</option>
								 	<?php
										include ('../src/FunGen/floadunimedida.php');
										floadunimedidasel($unidadcodigo, $idcon);
								 	?>
								</select></td>
							 	<td width="20%" class="NoiseFooterTD">&nbsp;Valor</td>
							 	<td width="30%" class="NoiseDataTD"><input name="itemvalor" type="text"	value="<?php echo $itemvalor; ?>" size="20"></td>
							</tr>
					    	<tr>
							 	<td class="NoiseFooterTD">&nbsp;Cantidad M&iacute;nima</td>
							 	<td class="NoiseDataTD"><input name="itemcanmin" type="text"	value="<?php echo $itemcanmin; ?>" size="20"></td>
							 	<td class="NoiseFooterTD">&nbsp;Cantidad M&aacute;xima</td>
							 	<td class="NoiseDataTD"><input name="itemcanmax" type="text"	value="<?php echo $itemcanmax; ?>" size="20"></td>
							</tr>
					    	<tr>
							 	<td class="NoiseFooterTD">&nbsp;Cantidad Disponible</td>
							 	<td class="NoiseDataTD"><input name="itemdispon" type="text"	value="<?php echo $itemdispon; ?>" size="20"></td>
							 	<td class="NoiseFooterTD">&nbsp;Extruido</td>
							 	<td class="NoiseDataTD"><select name="itemextru" id="itemextru"> 
							 	<option value="">--Selecione--</option>
							 	<option value="t" <?php if($itemextru == 't'){echo 'selected';}?>>Si</option>
							 	<option value="f" <?php if($itemextru == 'f'){echo 'selected';}?>>No</option>
							 	</select></td>
							</tr>
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Pigmentado</td> 
  								<td colspan="3" class="NoiseDataTD"><select name="itempigme" id="itempigme"> 
							 	<option value="">--Selecione--</option>
							 	<option value="t" <?php if($itempigme == 't'){echo 'selected';}?>>Si</option>
							 	<option value="f" <?php if($itempigme == 'f'){echo 'selected';}?>>No</option>
							 	</select></td> 
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
			<input type="hidden" name="flagconsultaritem" value="1">
			<input type="hidden" name="accionconsultaritem">
			<input type="hidden" name="columnas" value="itemcodigo,cencoscodigo,bodegacodigo,unidadcodigo,cencoscodigo,itemnombre,itemcanmin,itemcanmax,itemvalor,itemnota,itemdispon,itemextru,itempigme">
			<input type="hidden" name="nombtabl" value="item">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar">
			<input type="hidden" name="flagerror" value="<?php echo $flagerror; ?>"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>