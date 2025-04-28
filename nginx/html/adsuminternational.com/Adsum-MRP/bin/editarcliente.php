<?php
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblgrupo.php');
	include ( '../src/FunGen/fncusuagrup.php');
	include ('../src/FunPerPriNiv/pktblcargo.php');

	if($accioneditarcliente) 
	{
    	include ( 'editacliente.php');
    	$flageditarusuario = 1;
	}
	
	if(!$flageditarusuario)
	{	
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga('vistaclientegrup',$radiobutton);
		
		if (!$sbreg)
		{
			include( '../src/FunGen/fnccontfron.php');
		}
	   	$grupcodi = $sbreg[grupcodi];
	   	$cargocodigo = $sbreg[cargocodigo];
	   	$usuanomb = $sbreg[usuanomb];
	   	$usuaacti = $sbreg[usuaacti];
	   	$ciudadcodigo = $sbreg[ciudadcodigo];

	   	$usuaacti = $sbreg[usuaacti];
	}
	$idcon = fncconn();
?>
<html>
	<head>
		<title>Editar registro de Contratistas</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.funtionsusers.js"></script>
		<script language='JavaScript'>
			$(function(){
				$('#compdisponibilidad').click(function(){
					if(document.form1.usuanomb.value != '')
						accionComprobardisponibilidad(document.form1.usuanomb.value);
				});	
			});
		</script>
	</head>
<?php if(!$codigo) { echo "<!--";} ?>
	<body bgcolor="#FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Clientes</font></p>
			<table width="650" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content">
<?php if($campnomb): ?>
				<tr><td><div class="ui-widget">
					<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
						<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
						<strong>Advertencia:</strong> Corrija los campos marcados con *</p>
					</div>
				</div></td></tr>
<?php else: ?> 		
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
<?php endif; ?> 
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Editar registro</font></span></td></tr>
   				<!-- <tr>
					<td>
       					<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center">
      						<tr><td class="ui-state-default">&nbsp;<input name="logueo" type="checkbox" <?php if($logueo || $whitlogin){ echo ' checked '; } if($whitlogin){ echo ' disabled ';} ?> onclick="animatedcollapse.toggle('fillogue');"  >&nbsp;Datos de Logueo</td></tr>
      						<tr>
								<td>
									<div id="fillogue" style="display:<?php if($logueo || $whitlogin){ echo 'block'; }else{ echo 'none'; } ?>" >
										<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
											<?php if(!$whitlogin): ?>
				      						<tr>
				        						<td width="21%" class="NoiseFooterTD"><?php if($campnomb["usuanomb"] == 1){ $usuanomb = null; echo "*";} ?>&nbsp;Login</td>
				        						<td class="NoiseDataTD" width="29%"><input name="usuanomb" type="text" value="<?php if(!$flageditarusuario){ echo $sbreg[usuanomb];}else{ echo $usuanomb;} ?>" size="14"></td>
				        						<td class="NoiseDataTD"><ul id="icons" class="ui-widget ui-helper-clearfix"><li id="compdisponibilidad" class="ui-state-default ui-corner-all" title="Comprobar disponibilidad"><span class="ui-icon ui-icon-person"></span></li></ul></td>
				        						<td class="NoiseDataTD"><span id="compdispon"></span></td>
				      						</tr>
				      						<tr>
					        					<td width="21%" class="NoiseFooterTD"><?php if($campnomb["usuapass"] == 1){ $usuapass = null; echo "*";} ?>&nbsp;Contrase&ntilde;a</td>
					        					<td width="29%" class="NoiseDataTD"><input name="usuapass" type="password" value="<?php if(!$flageditarusuario){ echo $sbreg[usuapass];} ?>" size="17"></td>
					        					<td width="21%" class="NoiseFooterTD"><?php if($campnomb["usuapass"] == 1){ $usuapass = null; echo "*";}?>&nbsp;Confirmar contrase&ntilde;a</td>
					        					<td width="29%" class="NoiseDataTD"><input name="usuapass1" type="password" value = "<?php if(!$flageditarusuario){echo $sbreg[usuapass1];} ?>" size="17" ></td>
				      						</tr>
				      						<?php else: ?>
				      						<tr>
				        						<td width="20%" class="NoiseFooterTD">&nbsp;Login</td>
				        						<td width="30%" class="NoiseDataTD"><?php echo $usuanomb; ?><input type="hidden" name="usuanomb" value="<?php if(!$flageditarusuario){ echo $sbreg[usuanomb];}else{ echo $usuanomb;} ?>"></td>
				        						<td width="20%" class="NoiseFooterTD">&nbsp;Clave</td>
				        						<td width="30%" class="NoiseDataTD"><?php if($whitlogin){ echo "**********"; } else{ echo "- - - - - - - -"; } ?></td>
				      						</tr>
				      						<?php endif; ?>
				      						<tr><td colspan="4" class="NoiseErrorDataTD"></td></tr>
				       					</table>
				       					<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
				       						<tr><td colspan="4" class="NoiseErrorDataTD"></td></tr>
				      						<tr>
				            					<td class="NoiseFooterTD"><?php if($campnomb["grupcodi"] == 1){ $grupcodi = null; echo "*";} ?>&nbsp;Grupo</td>
				            					<td colspan="3" class="NoiseFooterTD"><select name="grupcodi">
				            						<option value = "">-- Seleccione --</option>
													<?php
														include ('../src/FunGen/floadgrup.php');
														floadgrup($grupcodi,$idcon);
													?>            							
				              					</select></td>
				          					</tr>
				      						<tr>
					        					<td width="20%" class="NoiseFooterTD"><?php if($campnomb["usuaacti"] == 1){ $usuaacti = null; echo "*";} ?>&nbsp;Estado</td>
					        					<td colspan="3" class="NoiseFooterTD"><select name="usuaacti">
				            						<option value = "1" <?php if($usuaacti == 1){ echo "selected";} ?>>Activo</option>
				            						<option value = "2" <?php if($usuaacti == 2){ echo "selected";} ?>>Inactivo</option>          							
				              					</select></td>
				      						</tr>
				       					</table>
				       				</div>
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
									<div id="fildatoscliente" style="display: block;" >
										<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
											<tr class="NoiseErrorDataTD">
				           						<td><?php if($campnomb["usuadocume"] == 1): $usuadocume = null; ?><span style="color:red;">*</span><?php else:  echo "*"; endif; ?>&nbsp;NIT</td>
				           						<td colspan="3"><input name="usuadocume" type="text" value="<?php if(!$flageditarusuario){ echo $sbreg[usuadocume];}else{ echo $usuadocume;} ?>" size="20" onkeypress="if(event.keyCode < 45 || event.keyCode > 57){ event.returnValue = false; }"></td>
				     						</tr>
				     						<tr>
				            					<td class="NoiseFooterTD"><?php if($campnomb["usuanombre"] == 1): $usuanombre = null; ?><span style="color:red;">*</span><?php else:  echo "*"; endif; ?>&nbsp;Raz&oacute;n Social</td>
				            					<td class="NoiseFooterTD" colspan="3"><input name="usuanombre" type="text" value="<?php if(!$flageditarusuario){ echo $sbreg[usuanombre];}else{ echo $usuanombre;} ?>" size="73"></td>
				          					</tr>
				          					<tr>
				            					<td class="NoiseFooterTD" width="20%"><?php if($campnomb["usuatelefo"] == 1): $usuatelefo = null; ?><span style="color:red;">*</span><?php else:  echo "*"; endif; ?>&nbsp;Tel&eacute;fono</td>
				            					<td class="NoiseFooterTD" width="30%"><input name="usuatelefo" type="text" value="<?php if(!$flageditarusuario){ echo $sbreg[usuatelefo];}else{ echo $usuatelefo;} ?>" size="20"></td>
				            					<td class="NoiseFooterTD" width="20%"><?php if($campnomb["usuatelef2"] == 1){ $usuatelef2 = null; echo "*";} ?>&nbsp;Fax</td>
				            					<td class="NoiseFooterTD" width="30%"><input name="usuatelef2" type="text" value="<?php if(!$flageditarusuario){ echo $sbreg[usuatelef2];}else{ echo $usuatelef2;} ?>" size="20"></td>
				          					</tr>
				         					<tr><td class="NoiseFooterTD" colspan="4"><?php if($campnomb["usuadirecc"] == 1): $usuadirecc = null; ?><span style="color:red;">*</span><?php else:  echo "*"; endif; ?>&nbsp;Direcci&oacute;n</td></tr>
				       						<tr><td colspan="4" class="NoiseDataTD" align="center"><textarea name="usuadirecc" cols="75" rows="2" wrap="VIRTUAL"><?php if(!$flageditarusuario){ echo $sbreg[usuadirecc];}else{ echo $usuadirecc;} ?></textarea></td></tr>
				           					<tr><td colspan="4" class="NoiseErrorDataTD"></td></tr>
				           				</table>
										<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
				           					<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
											<tr>
				            					<td class="NoiseFooterTD" width="20%"><?php if($campnomb["usuacontac"] == 1): $usuacontac = null; ?><span style="color:red;">*</span><?php else:  echo "*"; endif; ?>&nbsp;Contacto comercial</td>
				            					<td class="NoiseFooterTD" width="80%"><input name="usuacontac" type="text" value="<?php if(!$flageditarusuario){ echo $sbreg[usuacontac];}else{ echo $usuacontac;} ?>" size="46"></td>
				          					</tr>
				          					<tr>
				            					<td class="NoiseFooterTD" width="20%"><?php if($campnomb["usuaricarcon"] == 1): $usuaricarcon = null; ?><span style="color:red;">*</span><?php else:  echo "*"; endif; ?>&nbsp;Cargo</td>
				            					<td class="NoiseFooterTD" width="80%"><input name="usuaricarcon" type="text" value="<?php if(!$flageditarusuario){ echo $sbreg[usuaricarcon];}else{ echo $usuaricarcon;} ?>" size="25"></td>
				          					</tr>
				          					<tr>
				           						<td class="NoiseFooterTD"><?php if($campnomb["usuaemail"] == 1): $usuaemail = null; ?><span style="color:red;">*</span><?php else:  echo "*"; endif; ?>&nbsp;Correo electr&oacute;nico</td>
				           						<td class="NoiseDataTD" colspan="3"><input name="usuaemail" type="text" value="<?php if(!$flageditarusuario){ echo $sbreg[usuaemail];}else{ echo $usuaemail;} ?>" size="46"></td>
				         					</tr>
				          					<tr>
				            					<td class="NoiseFooterTD"><?php if($campnomb["usuatelcon"] == 1){ $usuatelcon = null; echo "*";} ?>&nbsp;Tel&eacute;fono</td>
				            					<td class="NoiseFooterTD"><input name="usuatelcon" type="text" value="<?php if(!$flageditarusuario){ echo $sbreg[usuatelcon];}else{ echo $usuatelcon;} ?>" size="20"></td>
				          					</tr>
				          					<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
				          					<tr>
				            					<td class="NoiseFooterTD"><?php if($campnomb["usuaacti"] == 1){ $usuaacti = null; echo "*";} ?>&nbsp;Estado</td>
				            					<td class="NoiseFooterTD"><select name="usuaacti">
				            						<option value="1" <?php if($usuaacti == 1) echo 'selected'; ?> >Activo</option>
				            						<option value="2" <?php if($usuaacti == 2) echo 'selected'; ?> >Inactivo</option>
				            					</select></td>
				          					</tr>
				      					</table>
				      				</div>
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
  			<input type="hidden" name="usuacodigo" value="<?php if(!$flageditarusuario){ echo $sbreg[usuacodi];}else{ echo $usuacodigo;} ?>">
  			<input name="whitlogin" type="hidden" value="<?php echo $whitlogin; ?>">
  			<input name="usuavalhor" type="hidden" value="0">
			<input name="usuapriape" type="hidden" value="CLIENTE/EMPRESA">
			<input name="usuadocume1" type="hidden" value="<?php if(!$flageditarusuario){ echo $sbreg[usuadocume];}else{ echo $usuadocume1;} ?>">
			<input type="hidden" name="accioneditarcliente">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="editar">
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>