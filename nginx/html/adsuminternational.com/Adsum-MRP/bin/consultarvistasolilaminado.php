<?php 
	
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktbltipoproduc.php');

?>
<html> 
	<head> 
		<title>Consultar registro de solicitud de laminado</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">consultar solicitud</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="550">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr>
								<td width="17%" class="NoiseFooterTD">&nbsp;C&oacute;digo CG1</td>
								<td width="83%" class="NoiseDataTD"><input type="text" name="produccoduno" size="30"	value="<?php echo $produccoduno;?>"></td> 
 							</tr>
							<tr>
								<td width="17%" class="NoiseFooterTD">&nbsp;Nombre</td>
								<td width="83%" class="NoiseDataTD"><input type="text" name="producnombre" size="30"	value="<?php echo $producnombre; ?>"></td> 
 							</tr>
 							<tr>
								<td width="17%" class="NoiseFooterTD">&nbsp;No. PV</td>
								<td width="83%" class="NoiseDataTD"><input type="text" name="pedvennumero" size="30"	value="<?php echo $pedvennumero; ?>"></td> 
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
 			<input type="hidden" name="flagconsultarvistasolilaminado" value="1"> 
			<input type="hidden" name="accionconsultarvistasolilaminado"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar">
			<input type="hidden" name="columnas" value="produccoduno, producnombre, pedvennumero">
			<input type="hidden" name="nombtabl" value="vistasolilaminado"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>