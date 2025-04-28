<?php 
ob_start();
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include ( '../src/FunPerPriNiv/pktblproveestado.php');
	include ( '../src/FunPerPriNiv/pktblciudad.php');
	include ( '../src/FunPerPriNiv/pktbldepartamento.php');
	include ( '../src/FunPerPriNiv/pktbltipoproveedor.php');
	include ('../src/FunPerPriNiv/pktblfabricante.php');
	if($accionnuevoproveedo1)
		include ( 'grabaproveedo1.php');
ob_end_flush();
?>
<html> 
	<head> 
		<title>Nuevo registro de proveedor</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_provfabri.js"></script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Proveedor</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="650">
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
            			<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr>
								<td class="NoiseFooterTD"><?php if($campnomb["proveenombre"] == 1){ $proveenombre = null; echo "*";}?>&nbsp;Nombre</td>
								<td colspan="3" class="NoiseDataTD"><input type="text" name="proveenombre" size="60"	value="<?php if(!$flagnuevoproveedo1){ echo $sbreg[proveenombre];}else {echo $proveenombre; }?>"></td> 
 							</tr>
							<tr>
     							<td class="NoiseFooterTD"><?php if($campnomb["proestcodigo"] == 1): $proestcodigo = null; ?><span style="color:black;">*</span><?php endif; ?>&nbsp;Estado</td>
     							<td colspan="3" class="NoiseDataTD"><select name="proestcodigo">
     								<option value = "">-- Seleccione --</option>
	     							<?php
										if(!$flagnuevoproveedo1)
											unset($proestcodigo);
										
										$idcon = fncconn();
										include ('../src/FunGen/floadproveestado.php');
										floadproveestadosel($proestcodigo,$idcon);
									?>
    							</select></td>
    						</tr>
							<tr>
								<td class="NoiseFooterTD"><?php if($campnomb["proveerepleg"] == 1){ $proveerepleg = null; echo "*";}?>&nbsp;Representante legal</td>
								<td colspan="3" class="NoiseDataTD"><input type="text" name="proveerepleg" size="50"	value="<?php if(!$flagnuevoproveedo1){ echo $sbreg[proveerepleg];}else {echo $proveerepleg; }?>"></td> 
 							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["proveetelefo"] == 1){ $proveetelefo = null; echo "*";}?>&nbsp;Tel&eacute;fono</td>
								<td width="30%" class="NoiseDataTD"><input type="text" name="proveetelefo" size="15"	value="<?php if(!$flagnuevoproveedo1){ echo $sbreg[proveetelefo];}else {echo $proveetelefo; }?>"></td> 
								<td width="14%" class="NoiseFooterTD"><?php if($campnomb["proveefax"] == 1){ $proveefax = null; echo "*";}?>&nbsp;FAX</td>
								<td width="36%" class="NoiseDataTD"><input type="text" name="proveefax" size="15"	value="<?php if(!$flagnuevoproveedo1){ echo $sbreg[proveefax];}else {echo $proveefax; }?>"></td> 
 							</tr>
      						<tr>
								<td class="NoiseFooterTD"><?php if($campnomb["proveepais"] == 1){ $proveepais = null; echo "*";}?>&nbsp;Pa&iacute;s</td>
								<td colspan="3" class="NoiseDataTD"><input type="text" name="proveepais" size="40"	value="<?php if(!$flagnuevoproveedo1){ echo $sbreg[proveepais];}else {echo $proveepais; }?>"></td> 
 							</tr>
      						<tr>
     							<td class="NoiseFooterTD"><?php if($campnomb["ciudadcodigo"] == 1): $ciudadcodigo = null; ?><span style="color:black;">*</span><?php endif; ?>&nbsp;Departamento</td>
     							<td class="NoiseDataTD"><select name="deptocodigo" onChange="accionLoadListGen(document.getElementById('ciudadcodigo').value, this.value, 'ciudad');">
     								<option value = "">-- Seleccione --</option>
	     							<?php
										if(!$flagnuevoproveedo1)
											unset($deptocodigo);
										
										include ('../src/FunGen/floaddepartamento.php');
										floaddepartamento($deptocodigo,$idcon);
									?>
    							</select></td>
     							<td class="NoiseFooterTD"><?php if($campnomb["ciudadcodigo"] == 1): $ciudadcodigo = null; ?><span style="color:black;">*</span><?php endif; ?>&nbsp;Ciudad</td>
     							<td class="NoiseDataTD"><span id="ciudad"><select name="ciudadcodigo" id="ciudadcodigo">
     								<option value = "">-- Seleccione --</option>
	     							<?php
										if(!$flagnuevoproveedo1)
											unset($ciudadcodigo);
										
										include ('../src/FunGen/floadciudad.php');
										floadciudaddep($idcon, $deptocodigo, $ciudadcodigo);
									?>
    							</select></span></td>
							</tr>
      						<tr>
								<td class="NoiseFooterTD"><?php if($campnomb["proveepostal"] == 1){ $proveepostal = null; echo "*";}?>&nbsp;C&oacute;digo postal</td>
								<td colspan="3" class="NoiseDataTD"><input type="text" name="proveepostal" size="20"	value="<?php if(!$flagnuevoproveedo1){ echo $sbreg[proveepostal];}else {echo $proveepostal; }?>"></td> 
 							</tr>
 							<tr>
								<td class="NoiseFooterTD"><?php if($campnomb["proveedirecc"] == 1){ $proveedirecc = null; echo "*";}?>&nbsp;Direcci&oacute;n</td>
								<td colspan="3" class="NoiseDataTD"><input type="text" name="proveedirecc" size="60"	value="<?php if(!$flagnuevoproveedo1){ echo $sbreg[proveedirecc];}else {echo $proveedirecc; }?>"></td> 
 							</tr>
 							<tr>
								<td class="NoiseFooterTD"><?php if($campnomb["proveeemail"] == 1){ $proveeemail = null; echo "*";}?>&nbsp;E-mail</td>
								<td colspan="3" class="NoiseDataTD"><input type="text" name="proveeemail" size="50"	value="<?php if(!$flagnuevoproveedo1){ echo $sbreg[proveeemail];}else {echo $proveeemail; }?>"></td> 
 							</tr>
 							<tr>
								<td class="NoiseFooterTD"><?php if($campnomb["proveeurl"] == 1){ $proveeurl = null; echo "*";}?>&nbsp;URL</td>
								<td colspan="3" class="NoiseDataTD"><input type="text" name="proveeurl" size="50"	value="<?php if(!$flagnuevoproveedo1){ echo $sbreg[proveeurl];}else {echo $proveeurl; }?>"></td> 
 							</tr>
 							<tr>
								<td class="NoiseFooterTD"><?php if($campnomb["proveecontac"] == 1){ $proveecontac = null; echo "*";}?>&nbsp;Contacto</td>
								<td colspan="3" class="NoiseDataTD"><input type="text" name="proveecontac" size="50"	value="<?php if(!$flagnuevoproveedo1){ echo $sbreg[proveecontac];}else {echo $proveecontac; }?>"></td> 
 							</tr>
							<tr>
								<td class="NoiseFooterTD"><?php if($campnomb["proveetelcon"] == 1){ $proveetelcon = null; echo "*";}?>&nbsp;Tel&eacute;fono</td>
								<td colspan="4" class="NoiseDataTD"><input type="text" name="proveetelcon" size="15"	value="<?php if(!$flagnuevoproveedo1){ echo $sbreg[proveetelcon];}else {echo $proveetelcon; }?>"></td> 
								
 							</tr>
 							<tr>
 								<td class="NoiseFooterTD"><?php if($campnomb["tipprocodigo"] == 1): $tipprocodigo = null; ?><span style="color:black;">*</span><?php endif; ?>&nbsp;Tipo de proveedor</td>
     							<td colspan="4" class="NoiseDataTD"><select name="tipprocodigo" id="tipprocodigo">
     								<option value = "">-- Seleccione --</option>
	     							<?php
										if(!$flagnuevoproveedo1)
											unset($tipprocodigo);
										
										include ('../src/FunGen/floadtipoproveedor.php');
										floadtipoproveedor($tipprocodigo,$idcon);
									?>
    							</select></span></td>
							</tr>
							<tr>
            					<td colspan="4">
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
										<tr class="ui-state-default">
											<td  class="cont-title"><?php if($campnomb['arrfabricanteprovee'] == 1){$arrfabricanteprovee = null; echo "*";}?>&nbsp;Fabricantes</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="4">
								<table width="100%" border="0" cellspacing="0" cellpadding="2" align="center" class="ui-widget-content">
					                <tr>
					                    <td class="NoiseDataTD">
					                        <div class="ui-buttonset" style="width:700px;">
					                              <button id="anxlistref">Agregar a la lista</button>&nbsp;&nbsp;&nbsp;
					                              <button id="retlistref">Quitar de la lista</button>
					                         </div>
					                    </td>
					                </tr>
					             </table>
 								<!-- Contenido de Listado de referencias a reportar -->
               					<div class="contenido-general" style="width:958px;">
					                		<div id="listreprefefabricante" style="width:958px;">
					                            <?php 
						                           $noAjax = true;
						                            include '../src/FunjQuery/jquery.visors/jq.vproveedorfabricante.php';
						                        ?>
				                             </div>
					             <input type="hidden" name="arrfabricanteprovee" id="arrfabricanteprovee" value="<?php echo $arrfabricanteprovee; ?>">
					           	</div>
					           </td>
					         </tr> 
 							<tr><td colspan="4" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="4" class="NoiseFooterTD"><?php if($campnomb["proveenota"]	 == 1){$proveenota = null; echo "*";}?>&nbsp;Nota</td></tr>
							<tr><td colspan="4" rowspan="2" class="NoiseDataTD"><textarea name="proveenota" rows="3" cols="110"><?php if(!$flagnuevoproveedo1){ echo $sbreg[proveenota];}else{ echo $proveenota;} ?></textarea>  </td></tr>
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
 			<input type="hidden" name="proveecodigo" value="<?php if(!$flagnuevoproveedo1){ echo $sbreg[proveecodigo];}else{ echo $proveecodigo;} ?>">
			<input type="hidden" name="accionnuevoproveedo1">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="nuevo">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
		<div id="windowreferencia" title="Adsum Kallpa [Referencias]"><div id="contreferencia"></div></div>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>