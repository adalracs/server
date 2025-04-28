<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblunimedida.php');
	include ( '../src/FunPerPriNiv/pktblrecepcionmercancia.php');
	include ( '../src/FunPerPriNiv/pktblbodega.php');
	include ( '../src/FunPerPriNiv/pktbltipoitemdesa.php');
	$nuconn = fncconn();
?>
<html> 
	<head> 
		<title>Consultar registro de recepcion de mercancia</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Recepcion de mercancia</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="550">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
            				<tr>
								<td class="NoiseFooterTD">&nbsp;C&oacute;digo</td>
								<td colspan="3" class="NoiseDataTD"><input type="text" name="recmercodigo" size="20" value="<?php echo $recmercodigo; ?>"></td> 
 							</tr>
 							<tr>
								<td class="NoiseFooterTD">&nbsp;Item</td>
								<td colspan="3" class="NoiseDataTD"><input type="text" name="itedescodigo" size="20"	value="<?php echo $itedescodigo; ?>"></td> 
 							</tr>
      						<tr>
								<td class="NoiseFooterTD">&nbsp;Cantidad</td>
								<td colspan="3" class="NoiseDataTD"><input type="text" name="recmercantidad" size="20"	value="<?php echo $recmercantidad; ?>"></td> 
 							</tr>
 							<tr>
								<td class="NoiseFooterTD">&nbsp;Orden de compra</td>
								<td colspan="3" class="NoiseDataTD"><input type="text" name="recmerordcomp" size="20"	value="<?php echo $recmerordcomp; ?>"></td> 
 							</tr>
 							<tr>
								<td class="NoiseFooterTD">&nbsp;IR</td>
								<td colspan="3" class="NoiseDataTD"><input type="text" name="recmernoir" size="20"	value="<?php echo $recmernoir; ?>"></td> 
 							</tr>
 							<tr>
								<td class="NoiseFooterTD">&nbsp;Factura</td>
								<td colspan="3" class="NoiseDataTD"><input type="text" name="recmernofact" size="20"	value="<?php echo $recmernofact; ?>"></td> 
 							</tr>
							 <tr>
 								<td class="NoiseFooterTD">&nbsp;Bodega</td>
     							<td class="NoiseDataTD"><select name="bodegacodigo" id="bodegacodigo">
     								<option value = "">-- Seleccione --</option>
	     							<?php
										include ('../src/FunGen/floadbodega.php');
										floadbodega($nuconn);
									?>
    							</select></span></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD"><?php if($campnomb["recmercertificado"] == 1){ $recmercertificado = null; echo "*";}?>&nbsp;Certificado</td>
								<td colspan="3" class="NoiseDataTD"><input type="text" name="recmercertificado" size="20"	value="<?php echo $recmercertificado; ?>"></td> 
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
 			<input type="hidden" name="flagconsultarrecepcionmercancia" value="1"> 
			<input type="hidden" name="accionconsultarrecepcionmercancia"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar">
			<input type="hidden" name="columnas" value="recmercodigo,itedescodigo,recmercantidad,recmerordcomp,recmernoir,recmernofact,bodegacodigo">
			<input type="hidden" name="nombtabl" value="recepcionmercancia"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>