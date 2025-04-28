<?php 
	include ( '../src/FunPerSecNiv/fncconn.php');
	include ( '../src/FunPerSecNiv/fncclose.php');
	include ( '../src/FunPerSecNiv/fncnumreg.php');
	include ( '../src/FunPerSecNiv/fncfetch.php');
	include('../src/FunPerPriNiv/pktblcargo.php');
	include('../src/FunPerPriNiv/pktbldepartam.php');
	include('../src/FunPerPriNiv/pktbltipousuario.php');
		include('../src/FunPerPriNiv/pktblusuario.php');
?> 
<html> 
	<head> 
		<title>Consultar empleado</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
		<SCRIPT LANGUAGE="JavaScript"> 
			<!-- Begin 
			agree = 0; 
			//  End --> 
		</script> 
		<script language="JavaScript" src="motofech.js"></script> 
		<script language=JavaScript src="../src/FunGen/prototype162.js" type="text/javascript" ></script>
        <SCRIPT src="../src/FunGen/aches.js" type="text/javascript"></SCRIPT>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Empleado</font></p> 
			<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE" width="75%"> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr> 
								<tr> 
  					<td> 
            					<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center"> 
              						<tr>
            								<td width="22%" class="NoiseFooterTD">&nbsp;Registro</td>
            								<td class="NoiseFooterTD" width="25%"><input name="usuacodigo" type="text" value="<?php if(!$flagconsultarusuario){ echo $sbreg[usuacodigo];}else{ echo $usuacodigo;} ?>" size="14"></td>
            								<td colspan="2" class="NoiseFooterTD">&nbsp;</td>
          							</tr>
								<tr class="NoiseErrorDataTD">
          							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
          							<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr>
          							<tr>
            							<td class="NoiseFooterTD"><?php if($campnomb["cargocodigo"] == 1){ $cargocodigo = null; echo "*";} ?>&nbsp;Cargo</td>
            								<td colspan="3" class="NoiseFooterTD"><select id="cargocodigo" name="cargocodigo"> 
              							<?php
							 			if(!$cargocodigo)
			  								$cargocodigo = $sbreg[cargocodigo];
	
										echo '<option value = "">Seleccione</option>';
									
										include ('../src/FunGen/floadcargo.php');
										$idcon = fncconn();
										$cargocodigo='';
										floadcargo($cargocodigo,$idcon);
										fncclose($idcon);
									?>
            							</select>
            								
            					 <IMG 
      onclick="filtradorselect('cargocodigo') ; " 
      src="filter.png" border=0>
      <SCRIPT type=text/javascript>
				Event.observe($('cargocodigo'),'keyup', function(f){ if (f.keyCode==113)filtradorselect('cargocodigo')} );
				
				</SCRIPT>			
            								
            								
            								
            								
            								</td>
          							</tr>          
          							<tr>
            								<td class="NoiseFooterTD"><?php if($campnomb["departcodigo"] == 1){ $departcodigo = null; echo "*";} ?>&nbsp;Depart&aacute;mento</td> 
            								<td colspan="3" class="NoiseFooterTD"> <select id="departcodigo" name="departcodigo">
            								<?php
							 			if(!$departcodigo)
			  								$departcodigo = $sbreg[departcodigo];
	
										echo '<option value = "">Seleccione</option>';
									
										include ('../src/FunGen/floaddepartam.php');
										$idcon = fncconn();
										$departcodigo='';
										floaddepartam($departcodigo,$idcon);
										fncclose($idcon);
									?>
            								</select>
            								 <IMG 
      onclick="filtradorselect('departcodigo') ; " 
      src="filter.png" border=0>
      <SCRIPT type=text/javascript>
				Event.observe($('departcodigo'),'keyup', function(f){ if (f.keyCode==113)filtradorselect('departcodigo')} );
				
				</SCRIPT>			
            								</td>
          							</tr>   
								<tr>
            							<!--	<td class="NoiseFooterTD"><?php // if($campnomb["tipusucodigo"] == 1){ $tipusucodigo = null; echo "*";} ?>&nbsp;Tipo de usuario</td>-->
            								<td colspan="3" class="NoiseFooterTD"><!-- <select name="tipusucodigo">
									<?php
							 			/*if(!$tipusucodigo)
			  								$tipusucodigo = $sbreg[tipusucodigo];
			
										echo '<option value = "">Seleccione</option>';
									
										include ('../src/FunGen/floadtipousuario.php');
										$idcon = fncconn();
										floadtipousuario($tipusucodigo,$idcon);
										fncclose($idcon);*/
									?>
									
									<?php
							 			
									
										include ('../src/FunGen/floadusuariohidden.php');
										$idcon = fncconn();
										
										floadusuariohidden($_SESSION["usuacodi"],$idcon);
										fncclose($idcon);
										
									?>
    									</select>--></td>
          							</tr> 
          							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
          							<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr>
								<tr class="NoiseErrorDataTD">
            								<td><?php if($campnomb["usuadocume"] == 1){ $usuadocume = null; echo "*";}?>&nbsp;No. de Identidad</td>
            								<td colspan="3"><input name="usuadocume" type="text" value="<?php if(!$flagnuevousuario){ echo $sbreg[usuadocume];}else{ echo $usuadocume;} ?>" size="14"></td>
          							</tr>  
          							<tr>
            								<td class="NoiseFooterTD"><?php if($campnomb["usuanombre"] == 1){ $usuanombre = null; echo "*";}?>&nbsp;Nombre</td>
            								<td class="NoiseFooterTD"><input name="usuanombre" type="text" value="<?php if(!$flagnuevousuario){ echo $sbreg[usuanombre];}else{ echo $usuanombre;} ?>" size="14">            </td>
            								<td class="NoiseFooterTD"><?php if($campnomb["usuapriape"] == 1){ $usuapriape = null; echo "*";} ?>&nbsp;Apellido</td>
            								<td class="NoiseFooterTD"><input name="usuapriape" type="text" value="<?php if(!$flagnuevousuario){ echo $sbreg[usuapriape];}else{ echo $usuapriape;} ?>" size="17"></td>
          							</tr>
          							<tr>
            								<td width="22%" class="NoiseFooterTD"><?php if($campnomb["usuasegape"] == 1){ $usuasegape = null; echo "*";}?>&nbsp;Seg. Apellido</td>
            								<td class="NoiseFooterTD"><input name="usuasegape" type="text" value="<?php if(!$flagnuevousuario){ echo $sbreg[usuasegape];}else{ echo $usuasegape;} ?>" size="14"></td>
            								<td class="NoiseFooterTD"><?php if($campnomb["usuatelefo"] == 1){ $usuatelefo = null; echo "*";} ?>&nbsp;Tel&eacute;fono</td>
            								<td class="NoiseFooterTD"><input name="usuatelefo" type="text" value="<?php if(!$flagnuevousuario){ echo $sbreg[usuatelefo];}else{ echo $usuatelefo;} ?>" size="17"></td>
          							</tr>
          							<tr>
            								<td class="NoiseFooterTD"><?php if($campnomb["usuatelef2"] == 1){ $usuatelef2 = null; echo "*";} ?>&nbsp;Seg. Tel&eacute;fono</td>
            								<td class="NoiseFooterTD"><input name="usuatelef2" type="text" value="<?php if(!$flagnuevousuario){ echo $sbreg[usuatelef2];}else{ echo $usuatelef2;} ?>" size="14"></td>
            								<td class="NoiseFooterTD"><?php if($campnomb["usuavalhor"] == 1){ $usuavalhor = null; echo "*";} ?>&nbsp;Valor hora</td>
            								<td class="NoiseFooterTD"><input name="usuavalhor" type="text" value="<?php if(!$flagnuevousuario){ echo $sbreg[usuavalhor];}else{ echo $usuavalhor;} ?>" size="17"></td>
          							</tr>
          							<tr>
            								<td class="NoiseFooterTD"><?php if($campnomb["usuadirecc"] == 1){ $usuadirecc = null; echo "*";} ?>&nbsp;Direcci&oacute;n</td>
            								<td colspan="3" rowspan="2" class="NoiseFooterTD"><textarea name="usuadirecc" cols="36" rows="3" wrap="VIRTUAL"><?php if(!$flagnuevousuario){ echo $sbreg[usuadirecc];}else{ echo $usuadirecc;} ?></textarea>            </td>
          							</tr>
          							<tr><td class="NoiseFooterTD" height="52">&nbsp;</td></tr>
          							<tr>
            								<td class="NoiseFooterTD"><?php if($campnomb["usuaemail"] == 1){ $usuaemail = null; echo "*";} ?>&nbsp;E-mail</td>
            								<td class="NoiseFooterTD" colspan="3"><input name="usuaemail" type="text" value="<?php if(!$flagnuevousuario){ echo $sbreg[usuaemail];}else{ echo $usuaemail;} ?>" size="46">            </td>
          							</tr>
								<tr>
            								<td class="NoiseFooterTD"><?php if($campnomb["usuacontac"] == 1){ $usuacontac = null; echo "*";}?>&nbsp;Contacto</td>
            								<td colspan="3" class="NoiseFooterTD"><input name="usuacontac" type="text" value="<?php if(!$flagnuevousuario){ echo $sbreg[usuacontac];}else{ echo $usuacontac;} ?>" size="46"></td>
          							</tr>          
          							<tr>
            								<td class="NoiseFooterTD"><?php if($campnomb["usuatelcon"] == 1){ $usuatelcon = null; echo "*";} ?>&nbsp;Tel&eacute;fono</td>
            								<td class="NoiseFooterTD"><input name="usuatelcon" type="text" value="<?php if(!$flagnuevousuario){ echo $sbreg[usuatelcon];}else{ echo $usuatelcon;} ?>" size="14"></td>
            								<td class="NoiseFooterTD">&nbsp;</td>
            								<td class="NoiseFooterTD">&nbsp;</td>
          							</tr>          					
						</table>  
  					</td> 
 				</tr> 
				<tr> 
					<td><div align="center"> 
						<input type="image" name="aceptar"  src="../img/aceptar.gif" onclick="form1.reaccionconsultarusuario.value =  1;form1.accionconsultarusuario.value =  0; form1.action='maestablusuacuadri.php';"  width="86" height="18" alt="Aceptar" border=0> 
						<input type="image" name="cancelar" src="../img/cancelar.gif" onclick="window.close();"  width="86" height="18" alt="Cancelar" border=0> 
					</div></td> 
				</tr> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
			<input type="hidden" name="flagnuevoot" value="1"> 
			<input type="hidden" name="flagconsultarusuario" value="1"> 
			<input type="hidden" name="reaccionconsultarusuario"> 
			<input type="hidden" name="accionconsultarusuario"> 
			<input type="hidden" name="empleacod" value="<?php echo $empleacod; ?>"> 
			
			
			
			
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
usuaactiot"> 
			<input type="hidden" name="nombtabl" value="usuario">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; }  ?> 
</html> 
