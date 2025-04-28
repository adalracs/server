<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktbltipomedi.php');

?>
<html> 
	<head> 
		<title>Consultar registro de Medidores por Equipo</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Medidores por Equipo</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="550">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center"> 
 							<tr>
								<td width="30%" class="NoiseFooterTD">&nbsp;
								<input name="radio1"  type="button" onClick="window.open('consultarequipogen.php?codigo=<?php echo $codigo; ?>&usuplantas=<?php echo $GLOBALS[usuaplanta]; ?>','equipogen','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" value="Buscar equipo" alt="Cancelar" width="86" height="18" border=0></td>
								<td width="70%" class="NoiseDataTD">
								<input name="equipocodigo" type="text" value="<?php echo $equipocodigo ?>" size="7" onFocus="this.blur();"/>&nbsp;
   								<input name="equiponombre" type="text" value="<?php echo $equiponombre ?>" size="25" onFocus="this.blur();"/></td>
 							</tr>
 							<tr>
								<td width="30%" class="NoiseFooterTD">&nbsp;Tipo de medidor</td>
								<td width="70%" class="NoiseDataTD" colspan="2"><select name="tipmedcodigo">
								<option value="">--Seleccione--</option>
								<?php 
								include '../src/FunGen/floadtipomedi.php';
								$idcon = fncconn();
								floadtipomedi($tipmedcodigo,$idcon);
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
 			<input type="hidden" name="flagconsultarmedidoequipo" value="1"> 
			<input type="hidden" name="accionconsultarmedidoequipo"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar">
			<input type="hidden" name="columnas" value="medequcodigo, tipmedcodigo, equipocodigo">
			<input type="hidden" name="nombtabl" value="medidoequipo"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>