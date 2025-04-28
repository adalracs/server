<?php 
   	include ( '../src/FunGen/sesion/fncvalses.php'); 
   	include('../src/FunPerPriNiv/pktblgrupo.php');
   	include('../src/FunPerPriNiv/pktblcargo.php');
	
	$idcon = fncconn();
?> 
<!-- C�digo creado por:
Andr�s Riascos
Fecha: 12012002 -->
<html> 
	<head> 
		<title>Consultar en Contratistas</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head>
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="#FFFFFF" class="NoisePageBODY">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Clientes</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="650">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Consultar cliente</font></span></td></tr>
     			<!-- <tr>
					<td>
       					<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center">
      						<tr><td class="ui-state-default">&nbsp;Datos de Logueo</td></tr>
      						<tr>
								<td>
									<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			      						<tr>
			        						<td width="20%" class="NoiseFooterTD">&nbsp;Login</td>
			        						<td class="NoiseDataTD"><input name="usuanomb" type="text" value="<?php echo $usuanomb; ?>" size="14"></td>
			      						</tr>
			      						<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
			       					</table>
			       					<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			       						<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
			      						<tr>
			            					<td class="NoiseFooterTD"><?php if($campnomb["grupcodi"] == 1){ $grupcodi = null; echo "*";} ?>&nbsp;Grupo</td>
			            					<td class="NoiseFooterTD"><select name="grupcodi">
			            						<option value = "">-- Seleccione --</option>
												<?php
													include ('../src/FunGen/floadgrup.php');
													floadgrup($grupcodi,$idcon);
												?>            							
			              					</select></td>
			          					</tr>
			      						<tr>
				        					<td width="20%" class="NoiseFooterTD"><?php if($campnomb["usuaacti"] == 1){ $usuaacti = null; echo "*";} ?>&nbsp;Estado</td>
				        					<td class="NoiseFooterTD"><select name="usuaacti">
			            						<option value = "">-- Seleccione --</option>
			            						<option value = "1" <?php if($usuaacti == 1){ echo "selected";} ?>>Activo</option>
			            						<option value = "2" <?php if($usuaacti == 2){ echo "selected";} ?>>Inactivo</option>          							
			              					</select></td>
			      						</tr>
			       					</table>
		       					</td>
		       				</tr>
		       			</table>
       				</td>
       			</tr>-->
    			<tr> 
  					<td>
        				<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center">
        					<tr><td class="ui-state-default">&nbsp;Datos de Contratista</td></tr>
        					<tr>
								<td>
									<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			        					<!-- <tr class="NoiseErrorDataTD">	
											<td width="20%">&nbsp;C&oacute;digo</td>
			       							<td colspan="3"><input name="usuacodigo" type="text" value="<?php echo $usuacodigo; ?>" size="14"></td>
			        					</tr> -->
			        					<tr class="NoiseErrorDataTD">
			           						<td>&nbsp;NIT</td>
			           						<td colspan="3"><input name="usuadocume" type="text" value="<?php echo $usuadocume; ?>" size="20" onkeypress="if(event.keyCode < 45 || event.keyCode > 57){ event.returnValue = false; }"></td>
			     						</tr>  
			          					<tr>
			            					<td class="NoiseFooterTD">&nbsp;Raz&oacute;n Social</td>
			            					<td class="NoiseFooterTD" colspan="3"><input name="usuanombre" type="text" value="<?php echo $usuanombre; ?>" size="73"></td>
			          					</tr>
			          					<tr>
			            					<td class="NoiseFooterTD" width="20%">&nbsp;Tel&eacute;fono</td>
			            					<td class="NoiseFooterTD" width="30%"><input name="usuatelefo" type="text" value="<?php echo $usuatelefo; ?>" size="20"></td>
			            					<td class="NoiseFooterTD" width="20%">&nbsp;Fax</td>
			            					<td class="NoiseFooterTD" width="30%"><input name="usuatelef2" type="text" value="<?php echo $usuatelef2; ?>" size="20"></td>
			          					</tr>
			         					<tr><td class="NoiseFooterTD" colspan="4">&nbsp;Direcci&oacute;n</td></tr>
			       						<tr><td colspan="4" class="NoiseDataTD" align="center"><textarea name="usuadirecc" cols="75" rows="2" wrap="VIRTUAL"><?php echo $usuadirecc; ?></textarea></td></tr>
			           					<tr><td colspan="4" class="NoiseErrorDataTD"></td></tr>
			      					</table>
			           				<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			           					<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
										<tr>
			            					<td class="NoiseFooterTD" width="20%">&nbsp;Contacto comercial</td>
			            					<td class="NoiseFooterTD" width="80%"><input name="usuacontac" type="text" value="<?php echo $usuacontac; ?>" size="46"></td>
			          					</tr>
			          					<tr>
			            					<td class="NoiseFooterTD" width="20%">&nbsp;Cargo</td>
			            					<td class="NoiseFooterTD" width="80%"><input name="usuaricarcon" type="text" value="<?php echo $usuaricarcon; ?>" size="25"></td>
			          					</tr>
			          					<tr>
			           						<td class="NoiseFooterTD">&nbsp;Correo electr&oacute;nico</td>
			           						<td class="NoiseDataTD" colspan="3"><input name="usuaemail" type="text" value="<?php echo $usuaemail; ?>" size="46"></td>
			         					</tr>
			          					<tr>
			            					<td class="NoiseFooterTD">&nbsp;Tel&eacute;fono</td>
			            					<td class="NoiseFooterTD"><input name="usuatelcon" type="text" value="<?php echo $usuatelcon; ?>" size="20"></td>
			          					</tr>
			          					<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
			      					</table>
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
			<input type="hidden" name="flagconsultarcliente" value="1">
			<input type="hidden" name="accionconsultarcliente">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar"> 				
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="columnas" value="usuacodi,
cargocodigo,
departcodigo,
tipusucodigo,
usuanomb,
usuapass,
usuaacti,
usuadocume,
usuanombre,
usuapriape,
usuasegape,
usuatelefo,
usuatelef2,
usuacontac,
usuatelcon,
usuadirecc,
usuaemail,
usuavalhor,
usuaactiot,
deptocodigo,
ciudadcodigo,
usuaricarcon,
grupcodi">
			<input type="hidden" name="nombtabl" value="vistaclientegrup">
			<input type="hidden" name="soliserv" value="<?php echo $soliserv ?>">
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>