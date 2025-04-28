<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblservicio.php');
?>
<html> 
	<head> 
		<title>Consultar registro de reclamos</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript">
			$(function(){
				
				$("#reclamfecrec").datepicker({
					buttonImageOnly : 'false',
					changeYear : 'true',
					numberOfMonths : 1,
					dateFormat : 'yy-mm-dd'
					});

				$("#reclamfecrad").datepicker({
					buttonImageOnly : 'false',
					changeYear : 'true',
					numberOfMonths : 1,
					dateFormat : 'yy-mm-dd'
					});

				$("#reclamclinom").autocomplete({
					source: "../src/FunjQuery/jquery.phpcombobox/items/jquery.atccliente.php",
					minLength: 0,
					select: function(event, ui) {
						if(ui.item)
						{
							document.getElementById('reclamnit').value = ui.item.id;
						}
						else
						{
							document.getElementById('reclamnit').value = '';
						}
					}
				});
				
			});
		</script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">consultar reclamo</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="550">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr>
								<td width="25%" class="NoiseFooterTD">&nbsp;C&oacute;digo </td>
								<td width="75%" class="NoiseDataTD"><input type="text" name="reclamcodigo" size="20"	value="<?php echo $reclamcodigo;?>"></td> 
 							</tr>
							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["servicicodigo"] == 1){ $servicicodigo = null; echo "*";}?>&nbsp;Planta/Servicio</td>
								<td width="75%" colspan="3" class="NoiseDataTD"><select name="servicicodigo">
								<option value="">--Seleccione--</option>
								<?php 
								include '../src/FunGen/floadservicio.php';
								$idcon =fncconn();
								floadservicio($idcon,$servicicodigo);
								?>
								</select></td>
 							</tr> 
 							<tr>
								<td width="25%" class="NoiseFooterTD">&nbsp;Fecha Reclamo&nbsp;</td>
								<td width="75%" class="NoiseDataTD"><input type="text" name="reclamfecrec" id="reclamfecrec" size="20"	value="<?php echo $reclamfecrec; ?>"></td> 
 							</tr>
 							<tr>
								<td width="25%" class="NoiseFooterTD">&nbsp;Fecha de Radicacion&nbsp;</td>
								<td width="75%" class="NoiseDataTD"><input type="text" name="reclamfecrad" id="reclamfecrad" size="20"	value="<?php echo $reclamfecrad; ?>"></td> 
 							</tr>
 							<tr>
								<td width="25%" class="NoiseFooterTD">&nbsp;Nombre Cliente</td>
								<td width="75%" class="NoiseDataTD"><input type="text" name="reclamclinom" id="reclamclinom" size="33" value="<?php echo $reclamclinom ?>" /><input type="hidden" name="reclamnit" id="reclamnit" value="<?php echo $reclamnit ?>" /></td>
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
 			<input type="hidden" name="flagconsultarreclamo" value="1"> 
			<input type="hidden" name="accionconsultarreclamo"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar">
			<input type="hidden" name="columnas" value="reclamcodigo, servicicodigo, reclamfecrec, reclamfecrad, reclamnit">
			<input type="hidden" name="nombtabl" value="reclamo"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>