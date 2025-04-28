<?php 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
?> 
<html>
	<head>
		<title>Consultar registro de Estado de Alarma</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
			
		<?php include('../def/jquery.library_maestro.php');?>
	</head>
<?php if(!$codigo){ echo "<!--";}?> 
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Estado solicitud de mercancia</font></p>
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="450">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td>
								<td width="80%" class="NoiseDataTD"><input type="text" name="estalacodigo" size="8"	value="<?php echo $estalacodigo; ?>"></td> 
 							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Nombre</td>
								<td width="80%" class="NoiseDataTD"><input type="text" name="estalanombre" size="50"	value="<?php echo $estalanombre; ?>"></td> 
 							</tr>
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
 							<tr>
 							  <td class="NoiseFooterTD">Tipo</td>
 							  <td class="NoiseDataTD"><select name="tipalatipo">
 							    <option value="">-- Seleccione --</option>
 							    <option value="1" <?php if($estsoltipo == 1) { echo 'selected'; }?>>Activo</option>
 							    <option value="2" <?php if($estsoltipo == 2) { echo 'selected'; }?>>Inactivo</option>
						      </select></td>
						  </tr>
							<tr>
							  <td colspan="2" rowspan="2" class="NoiseDataTD">&nbsp;</td></tr>
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
 			<input type="hidden" name="flagconsultarestadoalarma" value="1"> 
			<input type="hidden" name="accionconsultarestadoalarma">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar">  
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="columnas" value="estalacodigo,estalanombre,estaladescri,tipalatipo"> 
			<input type="hidden" name="nombtabl" value="estadoalarma"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>