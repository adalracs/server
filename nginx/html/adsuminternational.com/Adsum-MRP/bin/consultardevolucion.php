<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblservicio.php');
?>
<html> 
	<head> 
		<title>Consultar registro de devolucion</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript">
			$(function(){
				$("#usuanombre").autocomplete({
						source: "../src/FunjQuery/jquery.phpcombobox/jquery.cmbx_usuario.php",
						minLength: 0,
						select: function(event, ui) {
							if(ui.item)
							{
								document.getElementById('usuacodi').value = ui.item.id;
							}
							else
							{
								document.getElementById('usuacodi').value = '';
							}
						}
					});
			});
		</script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">consultar devolucion</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="550">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr>
								<td width="25%" class="NoiseFooterTD">&nbsp;C&oacute;digo </td>
								<td width="75%" class="NoiseDataTD"><input type="text" name="devolucodigo" size="20"	value="<?php echo $devolucodigo;?>"></td> 
 							</tr>
 							<tr>
								<td width="25%" class="NoiseFooterTD">&nbsp;Reclamo No.&nbsp;</td>
								<td width="75%" class="NoiseDataTD"><input type="text" name="reclamcodigo" id="reclamcodigo" size="20"	value="<?php echo $reclamcodigo; ?>"></td> 
 							</tr>
 							<tr>
								<td width="25%" class="NoiseFooterTD">&nbsp;Fecha&nbsp;</td>
								<td width="75%" class="NoiseDataTD"><input type="text" name="devolufecha" id="devolufecha" size="20"	value="<?php echo $devolufecha; ?>"></td> 
 							</tr>
 							<tr>
								<td width="25%" class="NoiseFooterTD">&nbsp;Vendedor</td>
								<td width="75%" class="NoiseDataTD"><input type="text" name="usuanombre" id="usuanombre" size="33" value="<?php echo $usuanombre ?>" /><input type="hidden" name="usuacodi" id="usuacodi" value=""/></td>
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
 			<input type="hidden" name="flagconsultardevolucion" value="1"> 
			<input type="hidden" name="accionconsultardevolucion"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar">
			<input type="hidden" name="columnas" value="devolucodigo, reclamcodigo, devolufecha, usuacodi">
			<input type="hidden" name="nombtabl" value="devolucion"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>