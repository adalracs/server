<?php 
ob_start();
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblprocedimiento.php');
	include ( '../src/FunGen/cargainput.php');
	
	if($accioneditarpadreitem) 
	{ 
		include ( 'editapadreitem.php'); 
		$flageditarpadreitem = 1;
	}
	
	
ob_end_flush();
	if(!$flageditarpadreitem)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');

		$arrkeylinea = $sbreg[paditekeylin];
		$procedcodigo = $sbreg[procedcodigo];
	}
	$idcon = fncconn();
?>
<html> 
	<head> 
		<title>Editar registro de padre item</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript">
				$(function(){
					// 	Boton Anexar Mueble
					$('#anxmueble').button({ icons: { primary: "ui-icon-plus" }, text: false }).click(function() {
						//objetos a utilizar
						var obj_arrkeylinea = document.getElementById('arrkeylinea');
						var obj_keylinea = document.getElementById('keylinea');
						var obj_itedeslinea = document.getElementById('itedeslinea');
						//valor de los objetos
						var keylinea = (obj_keylinea)? obj_keylinea.value : '' ;
						var itedeslinea = (obj_itedeslinea)? obj_itedeslinea.value : '' ;
						var err = '';

						//validaciones de error
						if(keylinea == '' || itedeslinea == '')
							err = err + 'Advertencia : *** Debe de seleccionar linea.' ;

						//accion del boton
						if(err == '')
						{
							loadArraylist(keylinea, 'arrkeylinea', ',');
							accionReloadLinea();
						}
						else
						{
							document.getElementById('msg').innerHTML = err;
							$('#msgwindow').dialog('open');
						}

						//limpiar objetos
						obj_keylinea.value = '' ;
						obj_itedeslinea.value = '' ;
					
						return false;
					});
		
					// 		Boton Retirar Mueble
					$('#retmueble').button({ icons: { primary: "ui-icon-minus" }, text: false }).click(function() {
						loadArraylistdelete('arrkeylinea', ',');
						accionReloadLinea();
						return false;
						});

					$("#itedeslinea").autocomplete({
						source: "../src/FunjQuery/jquery.phpcombobox/jquery.cmbx_itemdesa.php",
						minLength: 1,
						select: function(event, ui) {
							ui.item ? document.getElementById('keylinea').value = ui.item.id : document.getElementById('keylinea').value = "";
						}
					});
					
				});	

				function accionReloadLinea()
				{
					//objetos a utilizar 
					var obj_arrkeylinea = document.getElementById('arrkeylinea');
					//valor de los objetos
					var arrkeylinea = (obj_arrkeylinea)? obj_arrkeylinea.value : '' ;
					//evento a usar
					var parameters;
					parameters = 'arrkeylinea=' + arrkeylinea;
					//evento ajax
					$.ajax({	   
						dataType: "html",
						type: "POST",        
						url: "../src/FunjQuery/jquery.visors/jquery.padreitem.php", 	
						data: parameters,
						beforeSend: function(data){ },        
						success: function(requestData){
							if(requestData != '')
								document.getElementById('filtrlistapadreitem').innerHTML = requestData;
						},         
						error: function(requestData, strError, strTipoError){   
							alert("Error " + strTipoError +': ' + strError);
						},
						complete: function(requestData, exito){ }                                      
					});
				}
		</script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Padre item</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="450">
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
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Editar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" > 
            				<tr>
								<td width="10%" class="NoiseFooterTD">&nbsp;Codigo</td>
								<td width="40%" class="NoiseDataTD">&nbsp;<?php if(!$flageditarpadreitem){echo $sbreg[paditecodigo];}else{echo $paditecodigo;}?></td>
 							</tr>
							<tr>
								<td width="10%" class="NoiseFooterTD"><?php if($campnomb["paditenombre"] == 1){ $paditenombre = null; echo "*";}?>&nbsp;Nombre&nbsp;</td>
								<td width="40%" class="NoiseDataTD"><input type="text" name="paditenombre" size="30"	value="<?php if(!$flageditarpadreitem){ echo $sbreg[paditenombre];}else {echo $paditenombre; }?>"></td>
 							</tr>
 							<tr>
								<td width="10%" class="NoiseFooterTD"><?php if($campnomb["paditeextrui"] == 1){ $paditeextrui = null; echo "*";}?>&nbsp;Extruido&nbsp;</td>
								<td width="40%" class="NoiseDataTD"><select name="paditeextrui" id="paditeextrui">
								<?php if(!$flageditarpadreitem){$paditeextrui = $sbreg['paditeextrui'];} ?>
								<option value="">--Seleccione--</option>
								<option value="t" <?php if($paditeextrui == 't'){echo 'selected';}?> >Si</option>
								<option value="f" <?php if($paditeextrui == 'f'){echo 'selected';}?> >No</option>
								</select>
								</td>
 							</tr>
 							<tr>
								<td width="10%" class="NoiseFooterTD"><?php if($campnomb["procedcodigo"] == 1){ $procedcodigo = null; echo "*";}?>&nbsp;Proceso&nbsp;</td>
								<td width="40%" class="NoiseDataTD" colspan="2">
									<select name="procedcodigo" id="procedcodigo">
										<option value="">--Seleccione--</option>
										<?php 
											include ('../src/FunGen/floadprocedimiento.php');
											floadprocedimiento1($procedcodigo,$idcon);
										?>
									</select>
								</td>
 							</tr>
 							<tr>
								<td width="10%" class="NoiseFooterTD"><?php if($campnomb["paditepigmen"] == 1){ $paditepigmen = null; echo "*";}?>&nbsp;Pigmentado&nbsp;</td>
								<td width="40%" class="NoiseDataTD"><select name="paditepigmen" id="paditepigmen">
								<?php if(!$flageditarpadreitem){$paditepigmen = $sbreg['paditepigmen'];} ?>
								<option value="">--Seleccione--</option>
								<option value="t" <?php if($paditepigmen == 't'){echo 'selected';}?> >Si</option>
								<option value="f" <?php if($paditepigmen == 'f'){echo 'selected';}?> >No</option>
								</select>
								</td>
 							</tr>
 							<tr>
								<td width="10%" class="NoiseFooterTD"><?php if($campnomb["paditedensid"] == 1){ $paditedensid = null; echo "*";}?>&nbsp;Densidad&nbsp;</td>
								<td width="30%" class="NoiseDataTD"><input type="text" name="paditedensid" size="7" value="<?php if(!$flageditarpadreitem){ echo $sbreg[paditedensid];}else {echo $paditedensid; }?>"></td> 
 							</tr>
 							<tr>
 								<td colspan="2" class="ui-state-default">&nbsp;<small>Refile</small></td>
 							</tr>
 							<tr>
								<td width="10%" class="NoiseFooterTD"><?php if($campnomb["paditelamind"] == 1){ $paditelamind = null; echo "*";}?>&nbsp;Laminado (mm) &nbsp;</td>
								<td width="30%" class="NoiseDataTD"><input type="text" name="paditelamind" size="7" value="<?php if(!$flageditarpadreitem){ echo $sbreg[paditelamind];}else {echo $paditelamind; }?>"></td> 
 							</tr>
 							<tr>
								<td width="10%" class="NoiseFooterTD"><?php if($campnomb["paditeflexo"] == 1){ $paditeflexo = null; echo "*";}?>&nbsp;Flexo (mm) &nbsp;</td>
								<td width="30%" class="NoiseDataTD"><input type="text" name="paditeflexo" size="7" value="<?php if(!$flageditarpadreitem){ echo $sbreg[paditeflexo];}else {echo $paditeflexo; }?>"></td> 
 							</tr>
 							<tr>
 								<td colspan="2">
 									<div class="ui-buttonset ui-state-default NoiseDataTD" style="width:550px; padding: 1px;">&nbsp;
										<?php if($campnomb["paditekeylin"] == 1){ $paditekeylin = null; echo "*";}?>Lineas&nbsp;<input type="text" name="itedeslinea" id="itedeslinea" size="60">
										<input type="hidden" name="keylinea" id="keylinea">
										<button id="anxmueble">Agregar a la lista</button>&nbsp;
										<button id="retmueble">Quitar de la lista</button>
									</div>
 									<div id="filtrlistapadreitem">
										<?php
											$noAjax = true;
											include '../src/FunjQuery/jquery.visors/jquery.padreitem.php';  
										?>
									</div>
 								</td>
 							</tr>
 							<tr>
 								<td width="10%" class="NoiseFooterTD"></td>
 							</tr>
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD"><?php if($campnomb["paditedescri"]	 == 1){$paditedescri = null; echo "*";}?>&nbsp;Nota</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><textarea name="paditedescri" rows="3" cols="63"><?php if(!$flageditarpadreitem){ echo $sbreg[paditedescri];}else{ echo $paditedescri;} ?></textarea>  </td></tr>
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
			<input type="hidden" name="accioneditarpadreitem">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="paditecodigo" value="<?php if(!$flageditarpadreitem){echo $sbreg[paditecodigo];}else{echo $paditecodigo;}?>">
			<input type="hidden" name="sourceaction" value="editar">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>