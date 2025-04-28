<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblestadoanalisis.php');
	include ( '../src/FunPerPriNiv/pktbltipoanalisisestado.php');
?>
<html> 
	<head> 
		<title>Consultar registro de estados de analisis</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Estados de analisis</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="550">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr>
								<td width="17%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td>
								<td width="83%" class="NoiseDataTD"><input type="text" name="estanacodigo" size="30"	value="<?php echo $estanacodigo; ?>"></td> 
 							</tr>
							<tr>
								<td width="17%" class="NoiseFooterTD">&nbsp;Nombre</td>
								<td width="83%" class="NoiseDataTD"><input type="text" name="estananombre" size="30"	value="<?php echo $estananombre; ?>"></td> 
 							</tr>
 							<tr>
								<td width="17%" class="NoiseFooterTD">&nbsp;Tipo</td>
								<td width="83%" class="NoiseDataTD"><select name="tipestcodigo" id="tipestcodigo"> 
								<option value="">--Seleccione--</option>
								<?php 
									$idcon = fncconn();
									include "../src/FunGen/floadtipoanalisisestado.php";
									floadtipoanalisisestado($tipestcodigo,$idcon);
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
 			<input type="hidden" name="flagconsultarestadoanalisis" value="1"> 
			<input type="hidden" name="accionconsultarestadoanalisis"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar">
			<input type="hidden" name="columnas" value="estanacodigo,tipestcodigo,estananombre,estanadescri"> 
			<input type="hidden" name="nombtabl" value="estanacodigo"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>