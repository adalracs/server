<?php 
ini_set("display_errors", 1);
ob_start(); 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktbldefecto.php'); 
	include ( '../src/FunPerPriNiv/pktblcausa.php'); 
	 
	
	if($accionnuevodefecto)
		include ( 'grabadefecto.php');
	
ob_end_flush(); 

?>
<html> 
	<head> 
		<title>Nuevo registro de defecto de calidad</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript">
				$(function(){
					// Boton Anexar Mueble
					$('#anxcausa').button({ icons: { primary: "ui-icon-plus" }, text: false }).click(function() {
						//objetos a utilizar
						var objArrcausas = document.getElementById("arrcausas");
						var objCausacodigo = document.getElementById("causacodigo");
						var objCausanombre = document.getElementById("causanombre");
						//valor de los objetos
						var causacodigo = (objCausacodigo)? objCausacodigo.value : "" ;
						var causanombre = (objCausanombre)? objCausanombre.value : "" ;
						var err = '';

						//validaciones de error
						if(causacodigo == "" || causanombre == "")
							err = err + "Advertencia : *** Debe de seleccionar causa." ;

						//accion del boton
						if(err == '')
						{
							loadArraylist(causacodigo, "arrcausas", ",");
							accionReloadCausa();
						}
						else
						{
							document.getElementById("msg").innerHTML = err;
							$('#msgwindow').dialog("open");
						}

						//limpiar objetos
						if(objCausacodigo) objCausacodigo.value = "";
						if(objCausanombre) objCausanombre.value = "";
					
						return false;
					});
		
					//Boton Retirar Mueble
					$('#retcausa').button({ icons: { primary: "ui-icon-minus" }, text: false }).click(function() {
						loadArraylistdelete('arrcausas', ',');
						accionReloadCausa();
						return false;
						});

					$("#causanombre").autocomplete({
						source: "../src/FunjQuery/jquery.phpcombobox/jquery.cmbx_causa.php",
						minLength: 1,
						select: function(event, ui) {
							ui.item ? document.getElementById('causacodigo').value = ui.item.id : document.getElementById('causacodigo').value = "";
						}
					});
					
				});	

				function accionReloadCausa()
				{
					//objetos a utilizar 
					var objArrcausas = document.getElementById("arrcausas");
					//valor de los objetos
					var arrcausas = (objArrcausas)? objArrcausas.value : "" ;
					//evento a usar
					var parameters;
					parameters = 'arrcausas=' + arrcausas;
					//evento ajax
					$.ajax({	   
						dataType: "html",
						type: "POST",        
						url: "../src/FunjQuery/jquery.visors/jquery.defecto.php", 	
						data: parameters,
						beforeSend: function(data){ 
							$('#filtrlistadefecto').block({ theme : true , message : '<img src="../img/loading.gif">&nbsp;Espere mientras cargan las causas.</img>'});
						},        
						success: function(requestData){

							if(requestData != ''){
								document.getElementById('filtrlistadefecto').innerHTML = requestData;
							}

						},         
						error: function(requestData, strError, strTipoError){   
							alert("Error " + strTipoError +': ' + strError);
						},
						complete: function(requestData, exito){
							$('#filtrlistadefecto').unblock();
						}                                      
					});
				}
		</script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Defecto de calidad</font></p> 
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
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Ingresar nuevo registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center">
 							<tr>
								<td width="10%" class="NoiseFooterTD"><?php if($campnomb["defectnombre"] == 1){ $defectnombre = null; echo "*";}?>&nbsp;Nombre&nbsp;</td>
								<td width="40%" class="NoiseDataTD"><input type="text" name="defectnombre" size="30"	value="<?php if(!$flagnuevodefecto){ echo $sbreg[defectnombre];}else {echo $defectnombre; }?>"></td>
 							</tr>
 							<tr>
 								<td colspan="2" class="NoiseFooterTD"></td>
 							</tr>
 							<tr>
 								<td colspan="2">
 									<div class="ui-buttonset ui-state-default NoiseDataTD" style="width:550px; padding: 1px;">&nbsp;
										<?php if($campnomb["arrcausas"] == 1){ $arrcausas = null; echo "*";}?>Causas del defecto&nbsp;<input type="text" name="causanombre" id="causanombre" size="60">
										<input type="hidden" name="causacodigo" id="causacodigo">
										<button id="anxcausa">Agregar a la lista</button>&nbsp;
										<button id="retcausa">Quitar de la lista</button>
									</div>
 									<div id="filtrlistadefecto">
										<?php
											$noAjax = true;
											include '../src/FunjQuery/jquery.visors/jquery.defecto.php';  
										?>
									</div>
									<input type="hidden" name="arrcausas" id="arrcausas" size="60"value="<?php echo $arrcausas; ?>" />
									<input type="hidden" name="arrcausastmp" id="arrcausastmp" size="60"value="<?php echo $arrcausastmp; ?>" />
 								</td>
 							</tr>
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD"><?php if($campnomb["defectdescri"] == 1){$defectdescri = null; echo "*";}?>&nbsp;Descripcion</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><textarea name="defectdescri" rows="3" cols="63"><?php echo $defectdescri; ?></textarea>  </td></tr>
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
			<input type="hidden" name="accionnuevodefecto">  
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="nuevo">						
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div> 	 	
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>