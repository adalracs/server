<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblciudad.php');
	include ( '../src/FunPerPriNiv/pktbldepartamento.php');	
?>
<html> 
	<head> 
		<title>Consultar registro de bodega</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Bodega</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="550">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td>
								<td width="80%" class="NoiseDataTD"><input type="text" name="bodegacodigo" size="8"	value="<?php echo $bodegacodigo; ?>"></td> 
 							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Nombre</td>
								<td width="80%" class="NoiseDataTD"><input type="text" name="bodeganombre" size="50"	value="<?php echo $bodeganombre; ?>"></td> 
 							</tr>
 							<tr>
	        					<td class="NoiseFooterTD"><?php if($campnomb["bodegaencargado"] == 1){ $usuacodigo = null; echo "*";}?>&nbsp;Encargado</td>
	        					<td class="NoiseDataTD">
	        						<input type="text" name="usuacodigo" id="usuacodigo" value="<?php echo $usuacodigo; ?>" size="10" >
	        						<input type="text" name="usuanombre" id="usuanombre" value="<?php echo $usuanombre; ?>" size="50" >
	        					</td>
      						</tr>
      						<!-- <tr>
     							<td class="NoiseFooterTD">&nbsp;Departamento</td>
     							<td class="NoiseDataTD"><select name="deptocodigo" onChange="accionLoadListGen(document.getElementById('ciudadcodigo').value, this.value, 'ciudad');">
     								<option value = "">-- Seleccione --</option>
	     							<?php
//										$idcon = fncconn();
//										include ('../src/FunGen/floaddepartamento.php');
//										floaddepartamento($deptocodigo,$idcon);
									?>
    							</select></td>
    						</tr>
      						<tr>
     							<td class="NoiseFooterTD">&nbsp;Ciudad</td>
     							<td class="NoiseDataTD"><span id="ciudad"><select name="ciudadcodigo" id="ciudadcodigo">
     								<option value = "">-- Seleccione --</option>
	     							<?php
//										include ('../src/FunGen/floadciudad.php');
//										floadciudaddep($ciudadcodigo, $deptocodigo, $idcon);
									?>
    							</select></span></td>
							</tr> -->
      						<tr>
								<td class="NoiseFooterTD">&nbsp;Ubicaci&oacute;n</td>
								<td class="NoiseDataTD"><input type="text" name="bodegaubicac" size="50"	value="<?php echo $bodegaubicac; ?>"></td> 
 							</tr>
      						<tr>
								<td class="NoiseFooterTD">&nbsp;&Aacute;rea</td>
								<td class="NoiseDataTD"><input type="text" name="bodegacapaci" size="8"	value="<?php echo $bodegacapaci; ?>">&nbsp;&nbsp;mts&sup2;</td> 
 							</tr>
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Nota</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><textarea name="bodeganota" rows="3" cols="63"><?php echo $bodeganota; ?></textarea>  </td></tr>
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
 			<input type="hidden" name="flagconsultarbodega" value="1"> 
			<input type="hidden" name="accionconsultarbodega"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar">
			<input type="hidden" name="columnas" value="bodegacodigo,bodeganombre,usuacodi,bodegaubicac,bodegacapaci,bodeganota,ciudadcodigo">
			<input type="hidden" name="cencoscodigo"> 
			<input type="hidden" name="nombtabl" value="bodega"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>