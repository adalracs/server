<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include('../src/FunPerPriNiv/pktbldepartamento.php');
?>
<html> 
	<head> 
		<title>Consultar en ciudad</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Ciudad</font></p> 
			<table width="450" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content"> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr> 
 								<td width="22%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
 								<td width="78%" class="NoiseDataTD"><input type="text" name="ciudadcodigo" id="ciudadcodigo"  size="8" value="<?php echo $ciudadcodigo; ?>"></td> 
 							</tr> 
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Ciudad</td> 
 								<td class="NoiseDataTD"><input type="text" name="ciudadnombre" id="ciudadnombre" size="50" value="<?php echo $ciudadnombre; ?>"></td> 
 							</tr> 
							<tr>
     							<td class="NoiseFooterTD">&nbsp;Departamento</td>
     							<td class="NoiseDataTD"><select name="deptocodigo" id="deptocodigo">
     								<option value = "">-- Seleccione --</option>
	     							<?php
										include ('../src/FunGen/floaddepartamento.php');
										$idcon = fncconn();
										floaddepartamento($idcon, $deptocodigo);
										fncclose($idcon);
									?>
    							</select></td>
							</tr>   
 							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td></tr>
  							<tr><td colspan="2" rowspan="2" class="NoiseFooterTD"><textarea name="ciudaddescri" id="ciudaddescri" rows="3" cols="50" wrap="VIRTUAL"><?php echo $ciudaddescri; ?></textarea></td></tr>
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
 			<input type="hidden" name="flagconsultarciudad" value="1"> 
			<input type="hidden" name="accionconsultarciudad">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="columnas" value="ciudadcodigo,ciudadnombre,ciudaddescri,deptocodigo"> 
			<input type="hidden" name="nombtabl" value="ciudad"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>