<?php 	

	include_once ( '../src/FunGen/sesion/fncvalses.php');
	include_once ('../src/FunPerSecNiv/fncconn.php');
	include_once ('../src/FunPerSecNiv/fncclose.php');
	include_once ('../src/FunPerSecNiv/fncsqlrun.php');
	include_once ('../src/FunPerSecNiv/fncfetch.php');
	include_once ('../src/FunPerSecNiv/fncnumreg.php');	

	$idcon = fncconn();
?>
<html> 
	<head> 
		<title>Consultar tipo de cuenta</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Tipo de cuenta</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="550">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Codigo</td>
								<td width="80%" class="NoiseDataTD"><input type="text" name="tipcuecodigo" size="30" value="<?php echo $tipcuecodigo; ?>"></td> 
 							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Nombre</td>
								<td width="80%" class="NoiseDataTD"><input type="text" name="tipcuenombre" size="30" value="<?php echo $tipcuenombre; ?>"></td> 
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
 			<input type="hidden" name="flagconsultartipocuenta" value="1"> 
			<input type="hidden" name="accionconsultartipocuenta"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar">
			<input type="hidden" name="columnas" value="tipcuecodigo, tipcuenombre">
			<input type="hidden" name="nombtabl" value="tipocuenta"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>