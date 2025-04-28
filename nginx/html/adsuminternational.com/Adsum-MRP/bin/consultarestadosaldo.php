<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblestadosaldo.php');
	include ( '../src/FunPerPriNiv/pktbltipoestadosaldo.php');
?>
<html> 
	<head> 
		<title>Consultar registro de estados de saldos</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Estados de saldos</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="550">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr>
								<td width="17%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td>
								<td width="83%" class="NoiseDataTD"><input type="text" name="estsalcodigo" size="30"	value="<?php echo $estsalcodigo; ?>"></td> 
 							</tr>
							<tr>
								<td width="17%" class="NoiseFooterTD">&nbsp;Nombre</td>
								<td width="83%" class="NoiseDataTD"><input type="text" name="estsalnombre" size="30"	value="<?php echo $estsalnombre; ?>"></td> 
 							</tr>
 							<tr>
								<td width="17%" class="NoiseFooterTD">&nbsp;Tarea</td>
								<td width="83%" class="NoiseDataTD"><select name="tipestcodigo" id="tipestcodigo"> 
								<option value="">--Seleccione--</option>
								<?php 
									$idcon = fncconn();
									include "../src/FunGen/floadtipoestadosaldo.php";
									floadtipoestadosaldo($tipestcodigo,$idcon);
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
 			<input type="hidden" name="flagconsultarestadosaldo" value="1"> 
			<input type="hidden" name="accionconsultarestadosaldo"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar">
			<input type="hidden" name="columnas" value="estsalcodigo,estsalnombre,estsaldescri,tipestcodigo"> 
			<input type="hidden" name="nombtabl" value="estsalcodigo"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>