<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblestadosolitran.php');
	include ( '../src/FunPerPriNiv/pktbltipoestadosolitran.php');
	
?>
<html> 
	<head> 
		<title>Consultar registro de estados de translado</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Estados de translado</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="550">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr>
								<td width="17%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td>
								<td width="83%" class="NoiseDataTD"><input type="text" name="estsolcodigo" size="30"	value="<?php echo $estsolcodigo; ?>"></td> 
 							</tr>
							<tr>
								<td width="17%" class="NoiseFooterTD">&nbsp;Nombre</td>
								<td width="83%" class="NoiseDataTD"><input type="text" name="estsolnombre" size="30"	value="<?php echo $estsolnombre; ?>"></td> 
 							</tr>
 							<tr>
								<td width="17%" class="NoiseFooterTD">&nbsp;Tipo</td>
								<td width="83%" class="NoiseDataTD"><select name="tipestcodigo" id="tipestcodigo"> 
								<option value="">--Seleccione--</option>
								<?php 
									$idcon = fncconn();
									include "../src/FunGen/floadtipoestadosolitran.php";
									floadtipoestadosolitran($tipestcodigo,$idcon);
								?>
								</select> 
								</td>
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
 			<input type="hidden" name="flagconsultarestadosolitran" value="1"> 
			<input type="hidden" name="accionconsultarestadosolitran"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar">
			<input type="hidden" name="columnas" value="estsolcodigo,estsolnombre,estsoldescri,tipestcodigo"> 
			<input type="hidden" name="nombtabl" value="estsolcodigo"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>