<?php
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblgrupo.php');
	include ( '../src/FunPerPriNiv/pktblcargo.php');

	if($accionnuevocliente){
    	include('grabacliente.php');
	}
	
	$idcon = fncconn();
?>
<!-- C�digo creado por:
Andr�s Riascos
Fecha: 12012002 -->
<html> 
	<head> 
		<title>Nuevo registro de Contratistas</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.funtionsusers.js"></script>
		<script language='JavaScript'>
			$(function(){
				$('#compdisponibilidad').click(function(){
					if(document.form1.usuanomb.value != '')
						accionComprobardisponibilidad(document.form1.usuanomb.value);
				});

				$("#tabscliente").tabs({
					ajaxOptions: {
						error: function(xhr, status, index, anchor) {
							$(anchor.hash).html("No se puede cargar esta pesta&ntilde;a. Vamos a tratar de solucionar este problema lo m&aacute;s pronto posible.");
						}
					}
				});	
			});
		</script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Ingresar cliente</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="90%">
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
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Ingresar nuevo registro</font></span></td></tr> 
				<tr> 
  					<td> 
  					<div id="tabscliente">
  						<ul>
							<li><a href="#tabs-0"><span class="ui-icon ui-icon-document" style="float: left; margin-right: .3em;"></span>General</a></li>
							<li><a href="#tabs-1"><span class="ui-icon ui-icon-person" style="float: left; margin-right: .3em;"></span>Bienes raices y veh&iacute;culo </a></li>
							<li><a href="#tabs-2"><span class="ui-icon ui-icon-person" style="float: left; margin-right: .3em;"></span>Referencias comerciales</a></li>
							<li><a href="#tabs-3"><span class="ui-icon ui-icon-person" style="float: left; margin-right: .3em;"></span>Referencias bancarias</a></li>
							<li><a href="#tabs-4"><span class="ui-icon ui-icon-person" style="float: left; margin-right: .3em;"></span>Referencias familiares</a></li>
							<li><a href="#tabs-5"><span class="ui-icon ui-icon-document" style="float: left; margin-right: .3em;"></span>Area comercial</a></li>
						</ul>
						<div id="tabs-0">
            			<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center">
							<tr class="NoiseErrorDataTD"><td width="15%" class="NoiseFooterTD"><?php if($campnomb["usuadocume"] == 1): $usuadocume = null; ?><span style="color:red;">*</span><?php else:  echo "*"; endif; ?>&nbsp;NIT</td>
				           		<td><input name="usuadocume" type="text" value="<?php if(!$flagnuevousuario){ echo $sbreg[usuadocume];}else{ echo $usuadocume;} ?>" size="20" onkeypress="if(event.keyCode < 45 || event.keyCode > 57){ event.returnValue = false; }"></td>
				     			<td width="15%" class="NoiseFooterTD"><?php if($campnomb["usuanombre"] == 1): $usuanombre = null; ?><span style="color:red;">*</span><?php else:  echo "*"; endif; ?>&nbsp;Raz&oacute;n Social</td>
				            	<td class="NoiseDataTD"><input name="usuanombre" type="text" value="<?php if(!$flagnuevousuario){ echo $sbreg[usuanombre];}else{ echo $usuanombre;} ?>" size="20"></td>
				     		</tr>  
				          	<tr>
				            	<td class="NoiseFooterTD" width="15%"><?php if($campnomb["usuatelefo"] == 1): $usuatelefo = null; ?><span style="color:red;">*</span><?php else:  echo "*"; endif; ?>&nbsp;Tel&eacute;fono</td>
				            	<td class="NoiseDataTD"><input name="usuatelefo" type="text" value="<?php if(!$flagnuevousuario){ echo $sbreg[usuatelefo];}else{ echo $usuatelefo;} ?>" size="20"></td>
				            	<td class="NoiseFooterTD" width="15%"><?php if($campnomb["usuatelef2"] == 1){ $usuatelef2 = null; echo "*";} ?>&nbsp;Fax</td>
				            	<td class="NoiseDataTD"><input name="usuatelef2" type="text" value="<?php if(!$flagnuevousuario){ echo $sbreg[usuatelef2];}else{ echo $usuatelef2;} ?>" size="20"></td>
				          	</tr>
				         	<tr>
				         		<td class="NoiseFooterTD"><?php if($campnomb["usuadirecc"] == 1): $usuadirecc = null; ?><span style="color:red;">*</span><?php else:  echo "*"; endif; ?>&nbsp;Direcci&oacute;n</td>
				       			<td colspan="3" class="NoiseDataTD" rowspan="2"><textarea name="usuadirecc" cols="60" rows="2"><?php if(!$flagnuevousuario){ echo $sbreg[usuadirecc];}else{ echo $usuadirecc;} ?></textarea></td></tr>
				           		<tr><td class="NoiseFooterTD">&nbsp;</td>
				           	</tr>
				           	<tr>
				            	<td class="NoiseFooterTD" width="15%"><?php if($campnomb["usuacontac"] == 1): $usuacontac = null; ?><span style="color:red;">*</span><?php else:  echo "*"; endif; ?>&nbsp;Contacto comercial</td>
				            	<td class="NoiseDataTD"><input name="usuacontac" type="text" value="<?php if(!$flagnuevousuario){ echo $sbreg[usuacontac];}else{ echo $usuacontac;} ?>" size="46"></td>
				            	<td class="NoiseFooterTD" width="15%">&nbsp;Cargo</td>
				            	<td class="NoiseDataTD"><input name="usuaricarcon" type="text" value="<?php if(!$flagnuevousuario){ echo $sbreg[usuaricarcon];}else{ echo $usuaricarcon;} ?>" size="25"></td>
				          	</tr>
				          	<tr>
				           		<td class="NoiseFooterTD"><?php if($campnomb["usuaemail"] == 1): $usuaemail = null; ?><span style="color:red;">*</span><?php else:  echo "*"; endif; ?>&nbsp;Correo electr&oacute;nico</td>
				           		<td class="NoiseDataTD"><input name="usuaemail" type="text" value="<?php if(!$flagnuevousuario){ echo $sbreg[usuaemail];}else{ echo $usuaemail;} ?>" size="46"></td>
				            	<td class="NoiseFooterTD"><?php if($campnomb["usuatelcon"] == 1){ $usuatelcon = null; echo "*";} ?>&nbsp;Tel&eacute;fono</td>
				            	<td class="NoiseDataTD"><input name="usuatelcon" type="text" value="<?php if(!$flagnuevousuario){ echo $sbreg[usuatelcon];}else{ echo $usuatelcon;} ?>" size="20"></td>
				          	</tr>
				          	<tr>
				            	<td class="NoiseFooterTD" width="15%"><?php if($campnomb["usuaacti"] == 1){ $usuaacti = null; echo "*";} ?>&nbsp;Estado</td>
				            	<td class="NoiseDataTD"><select name="usuaacti">
				            		<option value="1" <?php if($usuaacti == 1) echo 'selected'; ?> >Activo</option>
				            		<option value="2" <?php if($usuaacti == 2) echo 'selected'; ?> >Inactivo</option>
				            		</select></td>
								<td width="15%" class="NoiseFooterTD"> <?php if ($campnomb == "tisouscodigo") { $tisouscodigo = null; echo "*";}?>Tipo de solicitud</td> 
								<td class="NoiseDataTD"><input type="text" name="tisouscodigo"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[tisouscodigo];}else{ echo $tisouscodigo; }?>"> </td>
							</tr>
							<tr> 
								<td width="15%" class="NoiseFooterTD"> <?php if ($campnomb == "clausucodigo") { $clausucodigo = null; echo "*";}?>Clase de usuario</td> 
								<td class="NoiseDataTD"> <input type="text" name="clausucodigo"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[clausucodigo];}else{ echo $clausucodigo; }?>"></td> 
								<td width="15%" class="NoiseFooterTD"> <?php if ($campnomb == "solusufecha") { $solusufecha = null; echo "*";}?>Fecha de la solicitud</td> 
								<td class="NoiseDataTD"> <input type="text" name="solusufecha"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusufecha];}else{ echo $solusufecha; }?>"></td> 
 							</tr> 
							<tr> 
								<td width="15%" class="NoiseFooterTD"> <?php if ($campnomb == "solusuperaca") { $solusuperaca = null; echo "*";}?>Personas a cargo</td> 
								<td class="NoiseDataTD"><input type="text" name="solusuperaca"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusuperaca];}else{ echo $solusuperaca; }?>"></td> 
								<td width="15%" class="NoiseFooterTD"> <?php if ($campnomb == "solusumatmer") { $solusumatmer = null; echo "*";}?>Matricula mercantil</td> 
								<td class="NoiseDataTD"> <input type="text" name="solusumatmer"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusumatmer];}else{ echo $solusumatmer; }?>"></td> 
 							</tr> 
							<tr> 
								<td width="15%" class="NoiseFooterTD"> <?php if ($campnomb == "solusumatfec") { $solusumatfec = null; echo "*";}?>Fecha de la matricula mercantil</td> 
								<td class="NoiseDataTD"><input type="text" name="solusumatfec"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusumatfec];}else{ echo $solusumatfec; }?>"> </td> 
								<td width="15%" class="NoiseFooterTD"> <?php if ($campnomb == "solusudircom") { $solusudircom = null; echo "*";}?>Direcci&oacute;n comercial</td> 
								<td class="NoiseDataTD"><input type="text" name="solusudircom"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusudircom];}else{ echo $solusudircom; }?>"></td> 
 							</tr> 
							<tr> 
								<td width="15%" class="NoiseFooterTD"> <?php if ($campnomb == "solusutelcom") { $solusutelcom = null; echo "*";}?>Tel&eacute;fono comercial</td><td class="NoiseDataTD"><input type="text" name="solusutelcom"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusutelcom];}else{ echo $solusutelcom; }?>"></td>
								<td width="15%" class="NoiseFooterTD"> <?php if ($campnomb == "solusufaxcom") { $solusufaxcom = null; echo "*";}?>Fax comercial</td> 
								<td class="NoiseDataTD"><input type="text" name="solusufaxcom"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusufaxcom];}else{ echo $solusufaxcom; }?>"> </td> 
 							</tr> 
							<tr> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusunacexp") { $solusunacexp = null; echo "*";}?>Nacional/Exportaci&oacute;n</td> 
								<td class="NoiseDataTD"><input type="text" name="solusunacexp"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusunacexp];}else{ echo $solusunacexp; }?>"> </td> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusuprisuc") { $solusuprisuc = null; echo "*";}?>Principal/Sucursal</td> 
								<td class="NoiseDataTD"><input type="text" name="solusuprisuc"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusuprisuc];}else{ echo $solusuprisuc; }?>"> </td> 
 							</tr> 
							<tr> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusulocprop") { $solusulocprop = null; echo "*";}?>Local propio</td> 
								<td class="NoiseDataTD"><input type="text" name="solusulocprop"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusulocprop];}else{ echo $solusulocprop; }?>"></td> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusuareloc") { $solusuareloc = null; echo "*";}?>Area local</td> 
								<td class="NoiseDataTD"><input type="text" name="solusuareloc"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusuareloc];}else{ echo $solusuareloc; }?>"></td> 
 							</tr> 
							<tr> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusuarrend") { $solusuarrend = null; echo "*";}?>Arrendatario</td> 
								<td class="NoiseDataTD"><input type="text" name="solusuarrend"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusuarrend];}else{ echo $solusuarrend; }?>"></td> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusutelarr") { $solusutelarr = null; echo "*";}?>Tel&eacute;fono arrendatario</td> 
								<td class="NoiseDataTD"><input type="text" name="solusutelarr"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusutelarr];}else{ echo $solusutelarr; }?>"></td> 
 							</tr> 
							<tr>
							 	<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusuantneg") { $solusuantneg = null; echo "*";}?>Antiguedad del negocio</td> 
								<td class="NoiseDataTD"><input type="text" name="solusuantneg"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusuantneg];}else{ echo $solusuantneg; }?>"></td> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusuacteco") { $solusuacteco = null; echo "*";}?>Actividad econ&oacute;mica</td> 
								<td class="NoiseDataTD"><input type="text" name="solusuacteco"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusuacteco];}else{ echo $solusuacteco; }?>"></td> 
 							</tr>
 							<tr>
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusuactcod") { $solusuactcod = null; echo "*";}?>C&oacute;digo de la actividad</td> 
								<td class="NoiseDataTD"><input type="text" name="solusuactcod"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusuactcod];}else{ echo $solusuactcod; }?>"></td> 
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr> 
 							</table>
							</div>
							<div id="tabs-1">
            				<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center">
            				<tr>
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusumatinm") { $solusumatinm = null; echo "*";}?>Matr&iacute;cula inmobiliaria</td> 
								<td class="NoiseDataTD"><input type="text" name="solusumatinm"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusumatinm];}else{ echo $solusumatinm; }?>"></td> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusutipinm") { $solusutipinm = null; echo "*";}?>Tipo de inmueble</td> 
								<td class="NoiseDataTD"><input type="text" name="solusutipinm"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusutipinm];}else{ echo $solusutipinm; }?>"></td> 
 							</tr> 
							<tr> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusudirecc") { $solusudirecc = null; echo "*";}?>Direcci&oacute;n</td> 
								<td class="NoiseDataTD" colspan="3"><input type="text" name="solusudirecc"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusudirecc];}else{ echo $solusudirecc; }?>"></td> 
 							</tr> 
							<tr> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusuvalcom") { $solusuvalcom = null; echo "*";}?>Valor comercial</td> 
								<td class="NoiseDataTD"><input type="text" name="solusuvalcom"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusuvalcom];}else{ echo $solusuvalcom; }?>"></td> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusutipinm1") { $solusutipinm1 = null; echo "*";}?>Tipo de inmueble</td> 
								<td class="NoiseDataTD"><input type="text" name="solusutipinm1"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusutipinm1];}else{ echo $solusutipinm1; }?>"></td> 
 							</tr> 
							<tr> 
								<td width="15" class="NoiseFooterTD"><?php if ($campnomb == "solusumatinm1") { $solusumatinm1 = null; echo "*";}?>Matr&iacute;cula inmobiliaria</td> 
								<td class="NoiseDataTD"><input type="text" name="solusumatinm1"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusumatinm1];}else{ echo $solusumatinm1; }?>"></input></td> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusudirecc1") { $solusudirecc1 = null; echo "*";}?>Direcci&oacute;n</td> 
								<td class="NoiseDataTD"><input type="text" name="solusudirecc1"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusudirecc1];}else{ echo $solusudirecc1; }?>"></td> 
 							</tr> 
 							<tr>
 								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusuvalcom1") { $solusuvalcom1 = null; echo "*";}?>Valor comercial</td> 
								<td class="NoiseDataTD"><input type="text" name="solusuvalcom1"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusuvalcom1];}else{ echo $solusuvalcom1; }?>"></td> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusuvehicu") { $solusuvehicu = null; echo "*";}?>Veh&iacute;culo</td> 
								<td class="NoiseDataTD"><input type="text" name="solusuvehicu"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusuvehicu];}else{ echo $solusuvehicu; }?>"></td> 
 							</tr> 
							<tr> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusuvehmod") { $solusuvehmod = null; echo "*";}?>Modelo</td> 
								<td class="NoiseDataTD"><input type="text" name="solusuvehmod"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusuvehmod];}else{ echo $solusuvehmod; }?>"></td> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusuvehpla") { $solusuvehpla = null; echo "*";}?>Placa</td> 
								<td class="NoiseDataTD"><input type="text" name="solusuvehpla"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusuvehpla];}else{ echo $solusuvehpla; }?>"></td> 
 							</tr>
							<tr> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusuprefav") { $solusuprefav = null; echo "*";}?>Prenda a favor de</td> 
								<td class="NoiseDataTD"><input type="text" name="solusuprefav"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusuprefav];}else{ echo $solusuprefav; }?>"></td> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusuvevaco") { $solusuvevaco = null; echo "*";}?>Valor comercial</td> 
								<td class="NoiseDataTD"><input type="text" name="solusuvevaco"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusuvevaco];}else{ echo $solusuvevaco; }?>"></td> 
							</tr>
							<tr> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusuvehicu1") { $solusuvehicu1 = null; echo "*";}?>Veh&iacute;culo</td> 
								<td class="NoiseDataTD"><input type="text" name="solusuvehicu1"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusuvehicu1];}else{ echo $solusuvehicu1; }?>"></td> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusuvehmod1") { $solusuvehmod1 = null; echo "*";}?>Modelo</td> 
								<td class="NoiseDataTD"><input type="text" name="solusuvehmod1"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusuvehmod1];}else{ echo $solusuvehmod1; }?>"></td> 
 							</tr> 
							<tr> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusuvehpla1") { $solusuvehpla1 = null; echo "*";}?>Placa</td> 
								<td class="NoiseDataTD"><input type="text" name="solusuvehpla1"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusuvehpla1];}else{ echo $solusuvehpla1; }?>"></td> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusuprefav1") { $solusuprefav1 = null; echo "*";}?>Prenda a favor de</td> 
								<td class="NoiseDataTD"><input type="text" name="solusuprefav1"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusuprefav1];}else{ echo $solusuprefav1; }?>"></td> 
 							</tr> 
							<tr> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusuvevaco1") { $solusuvevaco1 = null; echo "*";}?>Valor comercial</td> 
								<td class="NoiseDataTD"><input type="text" name="solusuvevaco1"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusuvevaco1];}else{ echo $solusuvevaco1; }?>"></td> 
								<td>&nbsp;</td>
								<td>&nbsp;</td> 
            				</table>
            				</div>
            			<div id="tabs-2">
            			<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center">
            				<tr>
            					<td colspan="2" class="NoiseFooterTD"><?php if ($campnomb == "solusunomrec") { $solusunomrec = null; echo "*";}?>Nombre de referencia comercial</td> 
								<td colspan="2" class="NoiseDataTD"><input type="text" name="solusunomrec"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusunomrec];}else{ echo $solusunomrec; }?>"></td> 
 							</tr> 
							<tr> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusucuprec") { $solusucuprec = null; echo "*";}?>Cupo</td> 
								<td class="NoiseDataTD"><input type="text" name="solusucuprec"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusucuprec];}else{ echo $solusucuprec; }?>"></td> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusutelrec") { $solusutelrec = null; echo "*";}?> Tel&eacute;fono de refer&eacute;ncia</td> 
								<td class="NoiseDataTD"><input type="text" name="solusutelrec"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusutelrec];}else{ echo $solusutelrec; }?>"></td> 
 							</tr> 
							<tr> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusudirrec") { $solusudirrec = null; echo "*";}?>Dirreci&oacute;n</td> 
								<td class="NoiseDataTD"><input type="text" name="solusudirrec"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusudirrec];}else{ echo $solusudirrec; }?>"></td> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusuciurec") { $solusuciurec = null; echo "*";}?>Ciudad</td> 
								<td class="NoiseDataTD"><input type="text" name="solusuciurec"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusuciurec];}else{ echo $solusuciurec; }?>"></td> 
 							</tr> 
							<tr>
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusunomrec1") { $solusunomrec1 = null; echo "*";}?>Nombre de refer&eacute;ncia</td> 
								<td class="NoiseDataTD"><input type="text" name="solusunomrec1"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusunomrec1];}else{ echo $solusunomrec1; }?>"></td> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusucuprec1") { $solusucuprec1 = null; echo "*";}?>Cupo</td> 
								<td class="NoiseDataTD"><input type="text" name="solusucuprec1"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusucuprec1];}else{ echo $solusucuprec1; }?>"></td> 
 							</tr> 
							<tr> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusutelrec1") { $solusutelrec1 = null; echo "*";}?>Tel&eacute;fono de refer&eacute;ncia</td> 
								<td class="NoiseDataTD"><input type="text" name="solusutelrec1"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusutelrec1];}else{ echo $solusutelrec1; }?>"></td> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusudirrec1") { $solusudirrec1 = null; echo "*";}?>Dirreci&oacute;n</td> 
								<td class="NoiseDataTD"><input type="text" name="solusudirrec1"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusudirrec1];}else{ echo $solusudirrec1; }?>"></td> 
 							</tr> 
							<tr> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusuciurec1") { $solusuciurec1 = null; echo "*";}?>Ciudad</td> 
								<td class="NoiseDataTD"><input type="text" name="solusuciurec1"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusuciurec1];}else{ echo $solusuciurec1; }?>"></td> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusunomrec2") { $solusunomrec2 = null; echo "*";}?>Nombre de refer&eacute;ncia</td> 
								<td class="NoiseDataTD"><input type="text" name="solusunomrec2"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusunomrec2];}else{ echo $solusunomrec2; }?>"></td> 
 							</tr>
							<tr> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusucuprec2") { $solusucuprec2 = null; echo "*";}?>Cupo</td> 
								<td class="NoiseDataTD"><input type="text" name="solusucuprec2"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusucuprec2];}else{ echo $solusucuprec2; }?>"></td> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusutelrec2") { $solusutelrec2 = null; echo "*";}?>Tel&eacute;fono</td> 
								<td class="NoiseDataTD"><input type="text" name="solusutelrec2"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusutelrec2];}else{ echo $solusutelrec2; }?>"></td> 
 							</tr> 
							<tr> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusudirrec2") { $solusudirrec2 = null; echo "*";}?>Dirreci&oacute;n</td> 
								<td class="NoiseDataTD"><input type="text" name="solusudirrec2"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusudirrec2];}else{ echo $solusudirrec2; }?>"></td> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusuciurec2") { $solusuciurec2 = null; echo "*";}?>Ciudad</td> 
								<td class="NoiseDataTD"><input type="text" name="solusuciurec2"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusuciurec2];}else{ echo $solusuciurec2; }?>"></td> 
 							</tr> 
            			</table>
            			</div>
            		<div id="tabs-3">
            			<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center">
            				<tr> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusubanco") { $solusubanco = null; echo "*";}?>Banco</td> 
								<td class="NoiseDataTD"><input type="text" name="solusubanco"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusubanco];}else{ echo $solusubanco; }?>"></td> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusutipcue") { $solusutipcue = null; echo "*";}?>Tipo de cuenta</td> 
								<td class="NoiseDataTD"><input type="text" name="solusutipcue"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusutipcue];}else{ echo $solusutipcue; }?>"></td> 
 							</tr> 
							<tr> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusunumcue") { $solusunumcue = null; echo "*";}?>N&uacute;mero de cuenta</td> 
								<td class="NoiseDataTD"><input type="text" name="solusunumcue"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusunumcue];}else{ echo $solusunumcue; }?>"></td> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solususucurs") { $solususucurs = null; echo "*";}?>Sucursal</td> 
								<td class="NoiseDataTD"><input type="text" name="solususucurs"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solususucurs];}else{ echo $solususucurs; }?>"></td> 
 							</tr>
            				<tr> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusutelefo") { $solusutelefo = null; echo "*";}?>Tel&eacute;fono</td> 
								<td class="NoiseDataTD"><input type="text" name="solusutelefo"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusutelefo];}else{ echo $solusutelefo; }?>"></td> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusuciudad") { $solusuciudad = null; echo "*";}?>Ciudad</td> 
								<td class="NoiseDataTD"><input type="text" name="solusuciudad"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusuciudad];}else{ echo $solusuciudad; }?>"></td> 
 							</tr> 
 							<tr> 
									<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusubanco1") { $solusubanco1 = null; echo "*";}?>Banco</td> 
									<td class="NoiseDataTD"><input type="text" name="solusubanco1"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusubanco1];}else{ echo $solusubanco1; }?>"></td> 
									<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusutipcue1") { $solusutipcue1 = null; echo "*";}?>Tipo de cuenta</td> 
									<td class="NoiseDataTD"><input type="text" name="solusutipcue1"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusutipcue1];}else{ echo $solusutipcue1; }?>"></td> 
 							</tr> 
							<tr> 
									<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusunumcue1") { $solusunumcue1 = null; echo "*";}?>N&uacute;mero de cuenta</td> 
									<td class="NoiseDataTD"><input type="text" name="solusunumcue1"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusunumcue1];}else{ echo $solusunumcue1; }?>"></td> 
									<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solususucurs1") { $solususucurs1 = null; echo "*";}?>Sucursal</td> 
									<td class="NoiseDataTD"><input type="text" name="solususucurs1"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solususucurs1];}else{ echo $solususucurs1; }?>"></td> 
 							</tr>
 							<tr> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusutelefo1") { $solusutelefo1 = null; echo "*";}?>Tel&eacute;fono</td> 
								<td class="NoiseDataTD"><input type="text" name="solusutelefo1"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusutelefo1];}else{ echo $solusutelefo1; }?>"></td> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusuciudad1") { $solusuciudad1 = null; echo "*";}?>Ciudad</td> 
								<td class="NoiseDataTD"><input type="text" name="solusuciudad1"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusuciudad1];}else{ echo $solusuciudad1; }?>"></td> 
 							</tr> 
							<tr> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusubanco2") { $solusubanco2 = null; echo "*";}?>Banco</td> 
								<td class="NoiseDataTD"><input type="text" name="solusubanco2"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusubanco2];}else{ echo $solusubanco2; }?>"></td> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusutipcue2") { $solusutipcue2 = null; echo "*";}?>Tipo de cuenta</td> 
								<td class="NoiseDataTD"><input type="text" name="solusutipcue2"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusutipcue2];}else{ echo $solusutipcue2; }?>"></td> 
 							</tr> 
							<tr> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusunumcue2") { $solusunumcue2 = null; echo "*";}?>N&uacute;mero de cuenta</td> 
								<td class="NoiseDataTD"><input type="text" name="solusunumcue2"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusunumcue2];}else{ echo $solusunumcue2; }?>"></td> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solususucurs2") { $solususucurs2 = null; echo "*";}?>Sucursal</td> 
								<td class="NoiseDataTD"><input type="text" name="solususucurs2"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solususucurs2];}else{ echo $solususucurs2; }?>"></td> 
 							</tr> 
							<tr>
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusutelefo2") { $solusutelefo2 = null; echo "*";}?>Tel&eacute;fono</td> 
								<td class="NoiseDataTD"><input type="text" name="solusutelefo2"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusutelefo2];}else{ echo $solusutelefo2; }?>"></td> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusuciudad2") { $solusuciudad2 = null; echo "*";}?>Ciudad</td> 
								<td class="NoiseDataTD"><input type="text" name="solusuciudad2"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusuciudad2];}else{ echo $solusuciudad2; }?>"></td> 
 							</tr> 	
            			</table>
            		</div>
            		<div id="tabs-4">
            			<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center">
 							<tr> 
 								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusunomrfa") { $solusunomrfa = null; echo "*";}?>Nombre de referencia</td> 
								<td class="NoiseDataTD"><input type="text" name="solusunomrfa"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusunomrfa];}else{ echo $solusunomrfa; }?>"></td> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusuparrfa") { $solusuparrfa = null; echo "*";}?>Parentesco</td> 
								<td class="NoiseDataTD"><input type="text" name="solusuparrfa"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusuparrfa];}else{ echo $solusuparrfa; }?>"></td> 
 							</tr>
 							<tr> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusutelrfa") { $solusutelrfa = null; echo "*";}?>Tel&eacute;fono</td> 
								<td class="NoiseDataTD"><input type="text" name="solusutelrfa"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusutelrfa];}else{ echo $solusutelrfa; }?>"></td> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusudirrfa") { $solusudirrfa = null; echo "*";}?>Direcci&oacute;n</td> 
								<td class="NoiseDataTD"><input type="text" name="solusudirrfa"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusudirrfa];}else{ echo $solusudirrfa; }?>"></td> 
 							</tr> 
 							<tr> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusuciurfa") { $solusuciurfa = null; echo "*";}?>Ciudad</td> 
								<td class="NoiseDataTD"><input type="text" name="solusuciurfa"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusuciurfa];}else{ echo $solusuciurfa; }?>"></td> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusunomrfa1") { $solusunomrfa1 = null; echo "*";}?>Nombre de refer&eacute;ncia</td> 
								<td class="NoiseDataTD"><input type="text" name="solusunomrfa1"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusunomrfa1];}else{ echo $solusunomrfa1; }?>"></td> 
 							</tr> 
							<tr> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusuparrfa1") { $solusuparrfa1 = null; echo "*";}?>Parentesco</td> 
								<td class="NoiseDataTD"><input type="text" name="solusuparrfa1"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusuparrfa1];}else{ echo $solusuparrfa1; }?>"></td> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusutelrfa1") { $solusutelrfa1 = null; echo "*";}?>Tel&eacute;fono</td> 
								<td class="NoiseDataTD"><input type="text" name="solusutelrfa1"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusutelrfa1];}else{ echo $solusutelrfa1; }?>"></td> 
 							</tr> 
							<tr>
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusudirrfa1") { $solusudirrfa1 = null; echo "*";}?>Direcci&oacute;n</td> 
								<td class="NoiseDataTD"><input type="text" name="solusudirrfa1"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusudirrfa1];}else{ echo $solusudirrfa1; }?>"></td> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusuciurfa1") { $solusuciurfa1 = null; echo "*";}?>Ciudad</td> 
								<td class="NoiseDataTD"><input type="text" name="solusuciurfa1"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusuciurfa1];}else{ echo $solusuciurfa1; }?>"></td> 
 							</tr> 
							<tr> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusunomrfa2") { $solusunomrfa2 = null; echo "*";}?>Nombre de refer&eacute;ncia</td> 
								<td class="NoiseDataTD"><input type="text" name="solusunomrfa2"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusunomrfa2];}else{ echo $solusunomrfa2; }?>"></td> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusuparrfa2") { $solusuparrfa2 = null; echo "*";}?>Parentesco</td> 
								<td class="NoiseDataTD"><input type="text" name="solusuparrfa2"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusuparrfa2];}else{ echo $solusuparrfa2; }?>"></td> 
							</tr> 
							<tr> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusutelrfa2") { $solusutelrfa2 = null; echo "*";}?>Tel&eacute;fono</td> 
								<td class="NoiseDataTD"><input type="text" name="solusutelrfa2"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusutelrfa2];}else{ echo $solusutelrfa2; }?>"></td> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusudirrfa2") { $solusudirrfa2 = null; echo "*";}?>Direcci&oacute;n</td> 
								<td class="NoiseDataTD"><input type="text" name="solusudirrfa2"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusudirrfa2];}else{ echo $solusudirrfa2; }?>"></td> 
 							</tr> 
							<tr> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusuciurfa2") { $solusuciurfa2 = null; echo "*";}?>Ciudad</td> 
								<td class="NoiseDataTD"><input type="text" name="solusuciurfa2"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusuciurfa2];}else{ echo $solusuciurfa2; }?>"></td> 
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
						</table>
						</div>
						<div id="tabs-5">
					<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center">
							<tr>
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusucupsol") { $solusucupsol = null; echo "*";}?>Cupo solicitado</td> 
								<td class="NoiseDataTD"><input type="text" name="solusucupsol"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusucupsol];}else{ echo $solusucupsol; }?>"></td>
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusuplasol") { $solusuplasol = null; echo "*";}?>Plazo solicitado</td> 
								<td class="NoiseDataTD"><input type="text" name="solusuplasol"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusuplasol];}else{ echo $solusuplasol; }?>"></td> 
							</tr> 
							<tr> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusucontac") { $solusucontac = null; echo "*";}?>Contacto</td> 
								<td class="NoiseDataTD" colspan="3"><input type="text" name="solusucontac"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusucontac];}else{ echo $solusucontac; }?>"></td> 
 							</tr>
 							<tr>
 								<td class="NoiseFooterTD" colspan="4">Si su negocio est&aacute; reci&eacute;n establecido (menos de un a&ntilde;o) indique a qu&eacute; actividad se dedicaba anteriormente</td>
 							</tr>
							<tr> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusuobserv") { $solusuobserv = null; echo "*";}?>Observaciones</td> 
								<td class="NoiseDataTD"><input type="text" name="solusuobserv"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusuobserv];}else{ echo $solusuobserv; }?>"></td> 
								<td width="15%" class="NoiseFooterTD"><?php if ($campnomb == "solusucupsug") { $solusucupsug = null; echo "*";}?>Cupo sugerido</td> 
								<td class="NoiseDataTD"><input type="text" name="solusucupsug"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusucupsug];}else{ echo $solusucupsug; }?>"></td> 
 							</tr> 
							<tr> 
								<td width="25%" class="NoiseFooterTD"><?php if ($campnomb == "solusucupaut") { $solusucupaut = null; echo "*";}?>Cupo autorizado</td> 
								<td width="25%" class="NoiseDataTD"><input type="text" name="solusucupaut"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusucupaut];}else{ echo $solusucupaut; }?>"></td> 
								<td width="25%" class="NoiseFooterTD"><?php if ($campnomb == "solusuplacon") { $solusuplacon = null; echo "*";}?>Plazo concedido</td> 
								<td width="25%" class="NoiseDataTD"><input type="text" name="solusuplacon"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusuplacon];}else{ echo $solusuplacon; }?>"></td> 
 							</tr> 
							<tr> 
								<td width="25%" class="NoiseFooterTD"><?php if ($campnomb == "solusuobserv1") { $solusuobserv1 = null; echo "*";}?>Observaciones</td> 
								<td width="25%" class="NoiseDataTD"><input type="text" name="solusuobserv1"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusuobserv1];}else{ echo $solusuobserv1; }?>"></td> 
								<td width="25%" class="NoiseFooterTD"><?php if ($campnomb == "solusuprecli") { $solusuprecli = null; echo "*";}?>PRESENTACION DEL CLIENTE POR PARTE DEL AREA COMERCIAL</td> 
								<td width="25%" class="NoiseDataTD"><input type="text" name="solusuprecli"	value="<?php if(!$flagnuevosoliciusuario){ echo $sbreg[solusuprecli];}else{ echo $solusuprecli; }?>"></td> 
 							</tr> 
						</table>
					</div>
					</div>
    				</td>
    			</tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_form.php'; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  			</table>
			<input type="hidden" name= "accionnuevocliente">
			<input name="usuavalhor" type="hidden" value="0">
			<input name="usuapriape" type="hidden" value="CLIENTE/EMPRESA">
			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="nuevo"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; }?>
</html>
