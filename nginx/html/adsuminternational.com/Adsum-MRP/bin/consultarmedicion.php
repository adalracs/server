<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktbltipomedi.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktblmedicion.php');
	include ( '../src/FunPerPriNiv/pktblmedidoequipo.php');

?>
<html> 
	<head> 
		<title>Consultar registro de tipo de medidor</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript">
			$(function(){
				$("#medicifecmed").datepicker("setDate","<?php echo $medicifecmed?>");
			});
			
		</script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">tipo de medidor</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="550">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
            				<tr>
								<td width="30%" class="NoiseFooterTD"><?php if($campnomb["medequcodigo"] == 1){ $medequcodigo = null; echo "*";}?>&nbsp;Equipo / Medidor &nbsp;</td>
								<td width="70%" class="NoiseDataTD"><select name="medequcodigo" id="medequcodigo">
								<option value="">--Seleccione--</option>
								<?php 
								include '../src/FunGen/floadmedicion.php';
								$idcon = fncconn();
								floadmedicion($medequcodigo,$idcon);
								?>
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
 			<input type="hidden" name="flagconsultarmedicion" value="1"> 
			<input type="hidden" name="accionconsultarmedicion"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar">
			<input type="hidden" name="columnas" value="medequcodigo">
			<input type="hidden" name="nombtabl" value="medicion"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>