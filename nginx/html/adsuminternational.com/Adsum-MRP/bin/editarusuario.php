<?php
ini_set('display_errors', '1');
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblgrupo.php');
	include ( '../src/FunGen/fncusuagrup.php');
	include ('../src/FunPerPriNiv/pktblcargo.php');
	include ('../src/FunPerPriNiv/pktbldepartam.php');
	include ('../src/FunPerPriNiv/pktbltipousuario.php');
	include ( '../src/FunPerPriNiv/pktblciudad.php');
	include ('../src/FunPerPriNiv/pktblusuaplanta.php');
	include ('../src/FunPerPriNiv/pktblusuatipotrab.php');

	if($accioneditarusuario) 
	{
		if($usuapass != $usuapass1)
	    {
			$flageditarusuario = 1;
			echo '<script language = "javascript">';
			echo '<!--//'."\n";
			echo 'alert("Claves no coinciden");';
			echo '//-->'."\n";
			echo '</script>';
			$flageditarusuario = 1;
	    }
	    else
	    {
	    	include ( 'editausuario.php');
			$flageditarusuario = 1;
	    }
	}
	
	if(!$flageditarusuario)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');
			
		$_SESSION["auxpass"] = $sbreg[usuapass];		
		
		$idcon = fncconn();
		$arrusuaplanta = loadrecordusuaplanta($sbreg[usuacodi], $idcon);
		$usuacodi2 = $sbreg[usuacodi];
		$arrusuatipotrab1 = loadrecordusuatipotrab($sbreg[usuacodi], $idcon);
		$arrusuatipotrab = ( $arrusuatipotrab1 > 0)? $arrusuatipotrab1 : "";
		$grupcodi = fncusuagrup($sbreg[usuacodi],$idcon);
		$tipusucodigo = $sbreg[tipusucodigo];
		$departcodigo = $sbreg[departcodigo];
		$cargocodigo = $sbreg[cargocodigo];
		$ciudadcodigo = $sbreg[ciudadcodigo];
		$usuaacti = $sbreg[usuaacti];
		$usuasolser = $sbreg['usuasolser'];
		$usuabandeja = $sbreg['usuabandeja'];
	}
?>
<html>
	<head>
		<title>Editar registro de Usuarios</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.funtionsusers.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.uploadimage.js"></script>
		<script language='JavaScript'>
			$(function(){
				/**
				 * Boton Consultar
				 */
				$('#compdisponibilidad').button({ icons: { primary: "ui-icon-person" }, text: false }).click(function() {
					if(document.form1.usuanomb.value != '')
						accionComprobardisponibilidad(document.form1.usuanomb.value);
					
					return false;
				});
			});
		</script>
		<style type="text/css">
			#compdisponibilidad.ui-button-icon-only .ui-button-text, #compdisponibilidad.ui-button-icons-only .ui-button-text  {
    			padding: 1px;
			}
		
		</style>
	</head>
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="#FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Usuario</font></p>
			<table width="670" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content">
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
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Editar usuario</font></span></td></tr>
				<tr>
					<td>
       					<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center">
      						<tr><td class="ui-state-default">&nbsp;Datos de Logueo</td></tr>
      						<tr>
								<td>
									<div id="fillogue" style="display: block;" >
										<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
				      						<tr>
				        						<td class="NoiseFooterTD"><?php if($campnomb["usuanomb"] == 1): $usuanomb = null; ?><span style="color:red;">*</span><?php else:  echo "*"; endif; ?>&nbsp;Login</td>
				        						<td class="NoiseDataTD"><input name="usuanomb" type="text" value="<?php if(!$flageditarusuario){ echo $sbreg[usuanomb];}else{ echo $usuanomb;} ?>" size="14"></td>
				        						<td class="NoiseDataTD" colspan="2"><button id="compdisponibilidad">Comprueba login</button>&nbsp;&nbsp;<span id="compdispon"></span></td>
				      						</tr>
				      						<tr>
					        					<td width="20%" class="NoiseFooterTD"><?php if($campnomb["usuapass"] == 1): $usuapass = null; ?><span style="color:red;">*</span><?php else:  echo "*"; endif; ?>&nbsp;Contrase&ntilde;a</td>
					        					<td width="28%" class="NoiseDataTD"><input name="usuapass" type="password" value="<?php if(!$flageditarusuario){ echo $sbreg[usuapass];} ?>" size="17"></td>
					        					<td width="22%" class="NoiseFooterTD"><?php if($campnomb["usuapass"] == 1): $usuapass = null; ?><span style="color:red;">*</span><?php else:  echo "*"; endif; ?>&nbsp;Confirmar contrase&ntilde;a</td>
					        					<td width="30%" class="NoiseDataTD"><input name="usuapass1" type="password" value = "<?php if(!$flageditarusuario){echo $sbreg[usuapass];} ?>" size="17" ></td>
				      						</tr>
				      						<tr><td colspan="4" class="NoiseErrorDataTD"></td></tr>
				       					</table>
				       					<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
				       						<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
				      						<tr>
				            					<td width="20%" class="NoiseFooterTD"><?php if($campnomb["grupcodi"] == 1): $grupcodi = null; ?><span style="color:red;">*</span><?php else:  echo "*"; endif; ?>&nbsp;Grupo</td>
				            					<td width="80%" class="NoiseFooterTD"><select name="grupcodi">
				            						<option value = "">-- Seleccione --</option>
													<?php
														$idcon = fncconn();
														include ('../src/FunGen/floadgrup.php');
														floadgrup($grupcodi,$idcon);
													?>            							
				              					</select></td>
				          					</tr>
				          					<tr>
				            					<td class="NoiseFooterTD"><?php if($campnomb["tipusucodigo"] == 1){ $tipusucodigo = null; echo "*";} ?>&nbsp;Tipo de usuario</td>
				            					<td class="NoiseFooterTD"><select name="tipusucodigo">
				            						<option value = "">-- Seleccione --</option>
													<?php
														include ('../src/FunGen/floadtipousuario.php');
														floadtipousuario($tipusucodigo,$idcon);
													?>
				    							</select></td>
				          					</tr>
				          					<tr>
				            					<td class="NoiseFooterTD"><?php if($campnomb["departcodigo"] == 1){ $departcodigo = null; echo "*";} ?>&nbsp;Depart&aacute;mento</td>
				            					<td class="NoiseFooterTD"><select name="departcodigo">
				            						<option value = "">-- Seleccione --</option>
				            						<?php
														include ('../src/FunGen/floaddepartam.php');
														floaddepartam($departcodigo,$idcon);
													?>
				            					</select></td>
          									</tr>   
				      						<tr>
					        					<td width="20%" class="NoiseFooterTD"><?php if($campnomb["usuasolser"] == 1){ $usuasolser = null; echo "*";} ?>&nbsp;Ver solicitudes</td>
					        					<td class="NoiseFooterTD"><select name="usuasolser">
				            						<option value = "1" <?php if($usuasolser == 1){ echo "selected";} ?>>Solicitadas</option>
				            						<option value = "2" <?php if($usuasolser == 2){ echo "selected";} ?>>Todas</option>          							
				              					</select></td>
				      						</tr>
				      						<tr>
					        					<td width="20%" class="NoiseFooterTD"><?php if($campnomb["usuaacti"] == 1){ $usuaacti = null; echo "*";} ?>&nbsp;Estado</td>
					        					<td class="NoiseFooterTD"><select name="usuaacti">
				            						<option value = "1" <?php if($usuaacti == 1){ echo "selected";} ?>>Activo</option>
				            						<option value = "2" <?php if($usuaacti == 2){ echo "selected";} ?>>Inactivo</option>          							
				              					</select></td>
				      						</tr>
				      						<tr>
					        					<td width="20%" class="NoiseFooterTD"><?php if($campnomb["usuabandeja"] == 1){ $usuabandeja = null; echo "*";} ?>&nbsp;Ver Alertas Mant</td>
					        					<td class="NoiseFooterTD"><select name="usuabandeja">
				            						<option value = "0" <?php if($usuabandeja == '0'){ echo "selected";} ?> >No</option>
				            						<option value = "1" <?php if($usuabandeja == '1'){ echo "selected";} ?> >Si</option>          							
				              					</select></td>
				      						</tr>
				       					</table>
				       				</div>
		       					</td>
		       				</tr>
		       			</table>
       				</td>
       			</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center">
							<tr>
  								<td>
  									<div style="width:648px; height: 14px; margin:0 auto;" class="ui-state-default">&nbsp;
										<a onClick="return verocultar('filplantas',1);" href="javascript:animatedcollapse.toggle('filplantas');"><img id="row1" align="middle" align="top"  src="temas/Noise/<?php if($arrheots) echo 'AscOn'; else echo 'DescOn'  ?>.gif" border="0">&nbsp;Ubicaci&oacute;n</a>
									</div>
  									<div id="filplantas">
										<?php 
											include_once '../src/FunPerPriNiv/pktblplanta.php';
											$noAjax = true;
											include '../src/FunjQuery/jquery.visors/jquery.plantas.php'; 
										?>
									</div>
									<input type="hidden" name="arrusuaplanta" id="arrusuaplanta" value="<?php echo $arrusuaplanta; ?>">
								</td>
							</tr>
						</table>
					</td>
				</tr>	
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center">
							<tr>
  								<td>
  									<div style="width:648px; height: 14px; margin:0 auto;" class="ui-state-default">&nbsp;
										<a onClick="return verocultar('filtipotrabajo',2);" href="javascript:animatedcollapse.toggle('filtipotrabajo');"><img id="row2" align="middle" align="top"  src="temas/Noise/<?php if($arrheots) echo 'AscOn'; else echo 'DescOn'  ?>.gif" border="0">&nbsp;Tipo de trabajo</a>
									</div>
  									<div id="filtipotrabajo">
										<?php 
											include_once '../src/FunPerPriNiv/pktbltipotrab.php';
											$noAjax = true;
											include '../src/FunjQuery/jquery.visors/jquery.tipotrabajo.php'; 
										?>
									</div>
									<input type="hidden" name="arrusuatipotrab" id="arrusuatipotrab" value="<?php echo $arrusuatipotrab; ?>">
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
  					<td>
  						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center">
      						<tr><td class="ui-state-default">&nbsp;Datos Basicos</td></tr>
      						<tr>
								<td>
									<div id="fillogue" style="display: block;" >
										<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
											<!-- <tr class="NoiseErrorDataTD">
				           						<td><?php if($campnomb["usuaactiot"] == 1){ $usuaactiot = null; echo "*";}?>&nbsp;Empleado</td>
				           						<td><input type="checkbox" name="usuaactiot" value="3" <?php if($flageditarusuario){ if($usuaactiot){ echo "checked";}} ?>></td>
				     						</tr> --> 
											<tr class="NoiseErrorDataTD">
				           						<td><?php if($campnomb["usuacodi"] == 1): $usuacodigo = null; ?><span style="color:red;">*</span><?php else:  echo "*"; endif; ?>&nbsp;Registro</td>
				           						<td colspan="3"><input name="usuacodigo" type="text" value="<?php if(!$flageditarusuario){ echo $sbreg[usuacodi];}else{ echo $usuacodigo;} ?>" size="20" onkeypress="if(event.keyCode < 45 || event.keyCode > 57){ event.returnValue = false; }"></td>
				     						</tr>  
											<tr class="NoiseErrorDataTD">
				           						<td><?php if($campnomb["usuadocume"] == 1): $usuadocume = null; ?><span style="color:red;">*</span><?php else:  echo "*"; endif; ?>&nbsp;No. de Identidad</td>
				           						<td colspan="3"><input name="usuadocume" type="text" value="<?php if(!$flageditarusuario){ echo $sbreg[usuadocume];}else{ echo $usuadocume;} ?>" size="20" onkeypress="if(event.keyCode < 45 || event.keyCode > 57){ event.returnValue = false; }"></td>
				     						</tr>  
				          					<tr>
				            					<td class="NoiseFooterTD" width="20%"><?php if($campnomb["usuanombre"] == 1): $usuanombre = null; ?><span style="color:red;">*</span><?php else:  echo "*"; endif; ?>&nbsp;Nombre</td>
				            					<td class="NoiseFooterTD" width="30%"><input name="usuanombre" type="text" value="<?php if(!$flageditarusuario){ echo $sbreg[usuanombre];}else{ echo $usuanombre;} ?>" size="25"></td>
				            					<td class="NoiseFooterTD" width="20%"><?php if($campnomb["usuapriape"] == 1): $usuapriape = null; ?><span style="color:red;">*</span><?php else:  echo "*"; endif; ?>&nbsp;Apellido</td>
				            					<td class="NoiseFooterTD" width="30%"><input name="usuapriape" type="text" value="<?php if(!$flageditarusuario){ echo $sbreg[usuapriape];}else{ echo $usuapriape;} ?>" size="25"></td>
				          					</tr>
				            				<tr>
				            					<td class="NoiseFooterTD"><?php if($campnomb["usuasegape"] == 1){ $usuasegape = null; echo "*";}?>&nbsp;Seg. Apellido</td>
				            					<td class="NoiseFooterTD" colspan="3"><input name="usuasegape" type="text" value="<?php if(!$flageditarusuario){ echo $sbreg[usuasegape];}else{ echo $usuasegape;} ?>" size="25"></td>
				          					</tr>
				          					<tr>
				            					<td class="NoiseFooterTD"><?php if($campnomb["cargocodigo"] == 1){ $cargocodigo = null; echo "*";} ?>&nbsp;Cargo</td>
				            					<td class="NoiseFooterTD" colspan="3"><select name="cargocodigo">
				            						<option value = "">-- Seleccione --</option>
				              						<?php
												 		if(!$flageditarusuario)
								  							unset($cargocodigo);
											
														include ('../src/FunGen/floadcargo.php');
														floadcargo($cargocodigo,$idcon);
													?>
				            					</select></td>
				          					</tr>
				          				</table>
				          				<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
				          					<tr>
				            					<td class="NoiseFooterTD" width="20%"><?php if($campnomb["usuatelefo"] == 1): $usuatelefo = null; ?><span style="color:red;">*</span><?php else:  echo "*"; endif; ?>&nbsp;Tel&eacute;fono</td>
				            					<td class="NoiseFooterTD" width="30%"><input name="usuatelefo" type="text" value="<?php if(!$flageditarusuario){ echo $sbreg[usuatelefo];}else{ echo $usuatelefo;} ?>" size="20"></td>
				            					<td class="NoiseFooterTD" width="20%"><?php if($campnomb["usuatelef2"] == 1){ $usuatelef2 = null; echo "*";} ?>&nbsp;Celular</td>
				            					<td class="NoiseFooterTD" width="30%"><input name="usuatelef2" type="text" value="<?php if(!$flageditarusuario){ echo $sbreg[usuatelef2];}else{ echo $usuatelef2;} ?>" size="20"></td>
				            				</tr>
				          					<tr>
				            					<td class="NoiseFooterTD" width="20%"><?php if($campnomb["usuavalhor"] == 1): $usuavalhor = null; ?><span style="color:red;">*</span><?php else:  echo "*"; endif; ?>&nbsp;Valor hora</td>
				            					<td class="NoiseFooterTD" width="30%"><input name="usuavalhor" type="text" value="<?php if(!$flageditarusuario){ echo $sbreg[usuavalhor];}else{ echo $usuavalhor;} ?>" size="15"></td>
				            					<td class="NoiseFooterTD" colspan="2"></td>
				            				</tr>
				                   			<tr>
				           						<td class="NoiseFooterTD"><?php if($campnomb["usuaemail"] == 1): $usuaemail = null; ?><span style="color:red;">*</span><?php else:  echo "*"; endif; ?>&nbsp;E-mail</td>
				           						<td class="NoiseDataTD" colspan="3"><input name="usuaemail" type="text" value="<?php if(!$flageditarusuario){ echo $sbreg[usuaemail];}else{ echo $usuaemail;} ?>" size="46"></td>
				         					</tr>
				         					<tr>
				     							<!-- <td class="NoiseFooterTD"><?php if($campnomb["deptocodigo"] == 1): $deptocodigo = null; ?><span style="color:red;">*</span><?php else:  echo "*"; endif; ?>&nbsp;Departamento</td>
				     							<td class="NoiseDataTD"><select name="deptocodigo" onChange="accionLoadListGen(document.getElementById('ciudadcodigo').value, this.value, 'ciudad');">
				     								<option value = "">-- Seleccione --</option>
					     							<?php
//														if(!$flageditarusuario)
//															unset($deptocodigo);
//														
//														include ('../src/FunGen/floaddepartamento.php');
//														floaddepartamento($deptocodigo,$idcon);
													?>
				    							</select></td>-->
				     							<td class="NoiseFooterTD"><?php if($campnomb["ciudadcodigo"] == 1): $ciudadcodigo = null; ?><span style="color:red;">*</span><?php else:  echo "*"; endif; ?>&nbsp;Ciudad</td>
				     							<td class="NoiseDataTD"  colspan="3"><span id="ciudad"><select name="ciudadcodigo" id="ciudadcodigo">
				     								<option value = "">-- Seleccione --</option>
					     							<?php
														include ('../src/FunGen/floadciudad.php');
														floadciudad($idcon,$ciudadcodigo);
													?>
				    							</select></span></td>
											</tr> 
				         					<tr><td class="NoiseFooterTD" colspan="4"><?php if($campnomb["usuadirecc"] == 1){ $usuadirecc = null; echo "*";} ?>&nbsp;Direcci&oacute;n</td></tr>
				       						<tr><td colspan="4" class="NoiseDataTD" align="center"><textarea name="usuadirecc" cols="78" rows="2" wrap="VIRTUAL"><?php if(!$flageditarusuario){ echo $sbreg[usuadirecc];}else{ echo $usuadirecc;} ?></textarea></td></tr>
				           					<tr><td colspan="4" class="NoiseErrorDataTD"></td></tr>
				           				</table>
				           				<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
											<tr>
				            					<td class="NoiseFooterTD" width="20%"><?php if($campnomb["usuacontac"] == 1){ $usuacontac = null; echo "*";}?>&nbsp;Contacto</td>
				            					<td class="NoiseFooterTD"><input name="usuacontac" type="text" value="<?php if(!$flageditarusuario){ echo $sbreg[usuacontac];}else{ echo $usuacontac;} ?>" size="46"></td>
				          					</tr>          
				          					<tr>
				            					<td class="NoiseFooterTD"><?php if($campnomb["usuatelcon"] == 1){ $usuatelcon = null; echo "*";} ?>&nbsp;Tel&eacute;fono</td>
				            					<td class="NoiseFooterTD"><input name="usuatelcon" type="text" value="<?php if(!$flagnuevousuario){ echo $sbreg[usuatelcon];}else{ echo $usuatelcon;} ?>" size="20"></td>
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
			<input type="hidden" name="usuaactiot" value="<?php if(!$flageditarusuario){ echo $sbreg[usuaactiot]; }else { echo $usuaactiot; } ?>">
			<input type="hidden" name="accioneditarusuario">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="editar">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="usuacodi2" value="<?php echo $usuacodi2; ?>">
			<input type="hidden" name="plantatmp" value="<?php echo $plantatmp; ?>">
			<input type="hidden" name="arrplantas" value="<?php echo $arrplantas; ?>">

		</form>
	</body>
<?php if(!$codigo){ echo " -->"; }?>
</html>
