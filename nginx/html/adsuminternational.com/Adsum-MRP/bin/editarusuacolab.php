<?php 
ob_start();
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblgrupo.php');
	include('../src/FunPerPriNiv/pktblcargo.php');
	include('../src/FunPerPriNiv/pktbldepartam.php');
	include('../src/FunPerPriNiv/pktbltipousuario.php');
	if($accioneditarusuario){ 
			include ( 'editausuacolab.php'); 
			$flageditarusuario = 1;
	}
ob_end_flush();

	if(!$flageditarusuario){
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		
		if (!$sbreg){
			include( '../src/FunGen/fnccontfron.php');
		}
		if($sbreg[usuacodi])
			include('validausuariopersonal.php');
			
		$idcon = fncconn();
		$cargocodigo = $sbreg[cargocodigo];
		$departcodigo = $sbreg[departcodigo];
		$tipusucodigo = $sbreg[tipusucodigo];
	}
?> 
<html> 
	<head> 
		<title>Editar registro de empleados</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
		<SCRIPT LANGUAGE="JavaScript"> 
			<!-- Begin
			agree = 0;
			//  End -->
		</script> 
		<script language="JavaScript" src="motofech.js"></script> 
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Empleado</font></p> 
			<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE" width="60%"> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF"> Editar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            					<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr>
            							<td class="NoiseFooterTD"><?php if($campnomb["cargocodigo"] == 1){ $cargocodigo = null; echo "*";} ?>&nbsp;Cargo</td>
            							<td colspan="3" class="NoiseFooterTD"><select name="cargocodigo">
              							<?php
							 		/*if(!$cargocodigo)
			  							$cargocodigo = $sbreg[cargocodigo];*/
	
									echo '<option value = "">Seleccione</option>';
									
									include ('../src/FunGen/floadcargo.php');
									$idcon = fncconn();
									floadcargo($cargocodigo,$idcon);
									fncclose($idcon);
								?>
            							</select></td>
          							</tr>          
          							<tr>
            							<td class="NoiseFooterTD"><?php if($campnomb["departcodigo"] == 1){ $departcodigo = null; echo "*";} ?>&nbsp;Depart&aacute;mento</td>
            							<td colspan="3" class="NoiseFooterTD"><select name="departcodigo">
            							<?php
							 		
									echo '<option value = "">Seleccione</option>';
									
									include ('../src/FunGen/floaddepartam.php');
									$idcon = fncconn();
									floaddepartam($departcodigo,$idcon);
									fncclose($idcon);
								?>
            							</select></td>
          							</tr>   
							<tr>
            							<td class="NoiseFooterTD"><?php if($campnomb["tipusucodigo"] == 1){ $tipusucodigo = null; echo "*";} ?>&nbsp;Tipo de usuario</td>
            							<td colspan="3" class="NoiseFooterTD"><select name="tipusucodigo">
								<?php
							 	
	
									echo '<option value = "">Seleccione</option>';
									
									include ('../src/FunGen/floadtipousuario.php');
									$idcon = fncconn();
									floadtipousuario($tipusucodigo,$idcon);
									fncclose($idcon);
								?>
    								</select></td>
          							</tr>                     
          							<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr>
          							<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr class="NoiseErrorDataTD">
            							<td><?php if($campnomb["usuadocume"] == 1){ $usuadocume = null; echo "*";}?>&nbsp;No. de Identidad</td>
            							<td colspan="3"><input name="usuadocume" type="text" value="<?php if(!$flageditarusuario){ echo $sbreg[usuadocume];}else{ echo $usuadocume;} ?>" size="14"></td>
          							</tr>  
          							<tr>
            							<td class="NoiseFooterTD"><?php if($campnomb["usuanombre"] == 1){ $usuanombre = null; echo "*";}?>&nbsp;Nombre</td>
            							<td class="NoiseFooterTD"><input name="usuanombre" type="text" value="<?php if(!$flageditarusuario){ echo $sbreg[usuanombre];}else{ echo $usuanombre;} ?>" size="14">            </td>
            							<td class="NoiseFooterTD"><?php if($campnomb["usuapriape"] == 1){ $usuapriape = null; echo "*";} ?>&nbsp;Apellido</td>
            							<td class="NoiseFooterTD"><input name="usuapriape" type="text" value="<?php if(!$flageditarusuario){ echo $sbreg[usuapriape];}else{ echo $usuapriape;} ?>" size="17"></td>
          							</tr>
          							<tr>
            							<td width="22%" class="NoiseFooterTD"><?php if($campnomb["usuasegape"] == 1){ $usuasegape = null; echo "*";}?>&nbsp;Seg. Apellido</td>
            							<td class="NoiseFooterTD"><input name="usuasegape" type="text" value="<?php if(!$flageditarusuario){ echo $sbreg[usuasegape];}else{ echo $usuasegape;} ?>" size="14"></td>
            							<td class="NoiseFooterTD"><?php if($campnomb["usuatelefo"] == 1){ $usuatelefo = null; echo "*";} ?>&nbsp;Tel&eacute;fono</td>
            							<td class="NoiseFooterTD"><input name="usuatelefo" type="text" value="<?php if(!$flageditarusuario){ echo $sbreg[usuatelefo];}else{ echo $usuatelefo;} ?>" size="17"></td>
          							</tr>
          							<tr>
            							<td class="NoiseFooterTD"><?php if($campnomb["usuatelef2"] == 1){ $usuatelef2 = null; echo "*";} ?>&nbsp;Seg. Tel&eacute;fono</td>
            							<td class="NoiseFooterTD"><input name="usuatelef2" type="text" value="<?php if(!$flageditarusuario){ echo $sbreg[usuatelef2];}else{ echo $usuatelef2;} ?>" size="14"></td>
            							<td class="NoiseFooterTD"><?php if($campnomb["usuavalhor"] == 1){ $usuavalhor = null; echo "*";} ?>&nbsp;Valor hora</td>
            							<td class="NoiseFooterTD"><input name="usuavalhor" type="text" value="<?php if(!$flageditarusuario){ echo $sbreg[usuavalhor];}else{ echo $usuavalhor;} ?>" size="17"></td>
          							</tr>
          							<tr>
            							<td class="NoiseFooterTD"><?php if($campnomb["usuadirecc"] == 1){ $usuadirecc = null; echo "*";} ?>&nbsp;Direcci&oacute;n</td>
            							<td colspan="3" rowspan="2" class="NoiseFooterTD"><textarea name="usuadirecc" cols="36" rows="3" wrap="VIRTUAL"><?php if(!$flageditarusuario){ echo $sbreg[usuadirecc];}else{ echo $usuadirecc;} ?></textarea></td>
          							</tr>
          							<tr><td class="NoiseFooterTD" height="52">&nbsp;</td></tr>
          							<tr>
            							<td class="NoiseFooterTD"><?php if($campnomb["usuaemail"] == 1){ $usuaemail = null; echo "*";} ?>&nbsp;E-mail</td>
            							<td class="NoiseFooterTD" colspan="3"><input name="usuaemail" type="text" value="<?php if(!$flageditarusuario){ echo $sbreg[usuaemail];}else{ echo $usuaemail;} ?>" size="46"></td>
          							</tr>
							<tr>
            							<td class="NoiseFooterTD"><?php if($campnomb["usuacontac"] == 1){ $usuacontac = null; echo "*";}?>&nbsp;Contacto</td>
            							<td colspan="3" class="NoiseFooterTD"><input name="usuacontac" type="text" value="<?php if(!$flageditarusuario){ echo $sbreg[usuacontac];}else{ echo $usuacontac;} ?>" size="46"></td>
          							</tr>          
          							<tr>
            							<td class="NoiseFooterTD"><?php if($campnomb["usuatelcon"] == 1){ $usuatelcon = null; echo "*";} ?>&nbsp;Tel&eacute;fono</td>
            							<td class="NoiseFooterTD"><input name="usuatelcon" type="text" value="<?php if(!$flageditarusuario){ echo $sbreg[usuatelcon];}else{ echo $usuatelcon;} ?>" size="14"></td>
            							<td class="NoiseFooterTD" colspan="2">&nbsp;</td>
          							</tr>          
						</table> 
  					</td> 
 				</tr> 
 				<tr> 
					<td><div align="center"> 
  						<input type="image" name="aceptar"  src="../img/aceptar.gif" onclick="form1.accioneditarusuario.value =  1; "  width="86" height="18" alt="Aceptar" border=0> 
  						<input type="image" name="cancelar" src="../img/cancelar.gif" onclick="form1.action='maestablusuacolab.php';"  width="86" height="18" alt="Cancelar" border=0> 
					</div></td> 
 				</tr> 
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
<?php if($campnomb){ echo '<font face="Verdana" >Corregir los campos marcados con *</font>';}  ?>
			<input type= "hidden" name ="usuacodic" value="<?php if(!$flageditarusuario){ echo $sbreg[usuacodi];} else {echo $usuacodic;}?>">
			<input type= "hidden" name ="usuanomb" value="<?php if(!$flageditarusuario){ echo $sbreg[usuanomb];} else {echo $usuanomb;}?>">
			<input type= "hidden" name ="usuapass" value="<?php if(!$flageditarusuario){ echo $sbreg[usuapass];} else {echo $usuapass;}?>">
			<input type= "hidden" name ="usuaacti" value="<?php if(!$flageditarusuario){ echo $sbreg[usuaacti];} else {echo $usuaacti;}?>">
			<input type= "hidden" name ="usuaactiot" value="<?php if(!$flageditarusuario){ echo $sbreg[usuaactiot];} else {echo $usuaactiot;}?>">
			<input type="hidden" name="accioneditarusuario"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html> 
