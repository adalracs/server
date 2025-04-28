<?php 
ob_start(); 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include ('../src/FunPerPriNiv/pktblusuario.php');
	include ('../src/FunPerPriNiv/pktblciudad.php');
	include ('../src/FunPerPriNiv/pktblservicio.php');
	include ('../src/FunPerPriNiv/pktblpedidoventa.php');
	include ('../src/FunPerPriNiv/pktblproducpedido.php');
	include ('../src/FunPerPriNiv/pktblproducto.php');
	include ('../src/FunGen/cargainput.php');
	
	if($accionnuevoreclamo)
		include ( 'grabareclamo.php');
		
	$idcon = fncconn();
	$nombre = cargausuanombre($usuacodi, $idcon);
	
ob_end_flush(); 
?>
<html> 
	<head> 
		<title>Nuevo registro de reclamo</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript">
			$(function(){
				$("#pedvennumero").autocomplete({
					source: function (request, response){
						$.ajax({	  
							url: "../src/FunjQuery/jquery.phpcombobox/items/jquery.atcpedido.php", 
							dataType: "json",    
							data: {term : request.term,cliente : document.getElementById('reclamnit').value},
							success : function (data){
										response(data);
							}
						});
					},
					minLength: 0,
					select: function(event, ui) {
						if(ui.item)
						{
							document.getElementById('pedvencodigo').value = ui.item.id;
						}
						else
						{
							document.getElementById('pedvencodigo').value = '';
						}
					}
				});


				$("#reclamclinom").autocomplete({
					source: "../src/FunjQuery/jquery.phpcombobox/items/jquery.atccliente.php",
					minLength: 0,
					select: function(event, ui) {
						if(ui.item)
						{
							document.getElementById('reclamnit').value = ui.item.id;
						}
						else
						{
							document.getElementById('reclamnit').value = '';
						}
					}
				});

				$('#ingresarpedido').button().click(function() {
					var err = '';

					if(document.getElementById('reclamnit').value == '')
						err = err + 'Error: *** Debe digitar Cliente... <br>';

					if(document.getElementById('pedvencodigo').value == '')
						err = err + 'Error: *** Debe digitar No Pedido de venta... <br>';

					if(err != '')
					{
						document.getElementById('msg').innerHTML = err;
						$("#msgwindow").dialog("open");
						return false;
					}
					
					var arrPedido = document.getElementById('arrpedven').value.split(',');
					var enc = 0;

					for(var a = 0; a < (arrPedido.length); a++)
					{
						if(arrPedido[a] == document.getElementById('pedvencodigo').value)
						{
							enc = 1;
							break;
						}
					}

					if(enc == 0)
					{
						if(document.getElementById('arrpedven').value != '')
							document.getElementById('arrpedven').value = document.getElementById('arrpedven').value + ',' + document.getElementById('pedvencodigo').value;
						else
							document.getElementById('arrpedven').value = document.getElementById('pedvencodigo').value;
					}

					document.getElementById('pedvencodigo').value = '';
					document.getElementById('pedvennumero').value = '';
					reLoadListPedido();
					return false;
				});

				$('#quitarpedido').button().click(function() {
					document.getElementById('pedvencodigo').value = '';
					document.getElementById('pedvennumero').value = '';
					reLoadListPedido();
					return false;
				});

				/*
				$("#reclamfecrec").datepicker({changeMonth: true,changeYear: true});
				$("#reclamfecrec").datepicker('option', {dateFormat: 'yy-mm-dd'});
				$("#reclamfecrec").datepicker($.datepicker.regional['es']);
				*/
				
				$("#reclamfecrec").datepicker({
					buttonImageOnly : 'false',
					changeYear : 'true',
					numberOfMonths : 1,
					dateFormat : 'yy-mm-dd'
					});
				
			});

			function ajaxListaPedido(objparams)
			{
				$.ajax({	   
					dataType: "html",
					type: "POST",        
					url: "../src/FunjQuery/jquery.visors/jquery.reclamo.php",
					data: objparams,
					beforeSend: function(data){},        
					success: function(requestData){
						document.getElementById('listadoreclamo').innerHTML = requestData;
					},         
					error: function(requestData, strError, strTipoError){ },
					complete: function(requestData, exito){}                                      
				});
				
			}

			function reLoadListPedido(){
				
				var arrObjItems = document.getElementById('arrpedven').value.split(','); //el comodin ',' es separador de filas
				if(arrObjItems != '')
				{
					$("#reclamclinom").bind("focus", function(){$(this).blur();});
				}
				else
				{
					$("#reclamclinom").unbind("focus");
				}
					
				var objparams = 'arrpedven=' + document.getElementById('arrpedven').value;

				for( i = 0; i < arrObjItems.length; i++ )
				{
					if(document.getElementById('recpectiprecpr_' + arrObjItems[i]))
					{
						if(document.getElementById('recpectiprecpr_' + arrObjItems[i]).checked)
							objparams = objparams + '&recpectiprecpr_' + arrObjItems[i] + '=' + document.getElementById('recpectiprecpr_' + arrObjItems[i]).value;
						
						if(document.getElementById('recpectiprecas_' + arrObjItems[i]).checked)
							objparams = objparams + '&recpectiprecas_' + arrObjItems[i] + '=' + document.getElementById('recpectiprecas_' + arrObjItems[i]).value; 

						if(document.getElementById('recpectiprecel_' + arrObjItems[i]).checked)
							objparams = objparams + '&recpectiprecel_' + arrObjItems[i] + '=' + document.getElementById('recpectiprecel_' + arrObjItems[i]).value;

						if(document.getElementById('recpeddevolu_' + arrObjItems[i] + '_1').checked)
							objparams = objparams  + '&recpeddevolu_' + arrObjItems[i] + '=' + document.getElementById('recpeddevolu_' + arrObjItems[i] + '_1').value;

						if(document.getElementById('recpeddevolu_' + arrObjItems[i] + '_2').checked)
							objparams = objparams  + '&recpeddevolu_' + arrObjItems[i] + '=' + document.getElementById('recpeddevolu_' + arrObjItems[i] + '_2').value;
						
						objparams = objparams + '&recpedcantid_' + arrObjItems[i] + '=' + document.getElementById('recpedcantid_' + arrObjItems[i]).value + '&recpeddescri_' + arrObjItems[i] + '=' + document.getElementById('recpeddescri_' + arrObjItems[i]).value;
					}
				}
				
				ajaxListaPedido(objparams);
			}

			function validaCliente(campo)
			{
				var err = '';

				if(document.getElementById('reclamnit').value == '')
					err = err + 'Error: *** Debe digitar Cliente... <br>';

				if(err != '')
				{
					document.getElementById('msg').innerHTML = err;
					$("#msgwindow").dialog("open");
					document.getElementById(campo).blur();
					return false;
				}
			}
		</script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Reclamo</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="950px">
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
								<td colspan="4" class="ui-state-default" align="center">&nbsp;<b>Datos Generales</b></td>
							</tr>
							<tr>
								<td colspan="4" class="NoiseFooterTD"></td>
 							<tr>
							<tr>
								<td colspan="1" class="NoiseFooterTD"><?php if($campnomb["servicicodigo"] == 1){ $servicicodigo = null; echo "*";}?>&nbsp;Planta/Servicio</td>
								<td colspan="3" class="NoiseDataTD"><select name="servicicodigo">
								<option value="">--Seleccione--</option>
								<?php 
								include '../src/FunGen/floadservicio.php';
								$idcon =fncconn();
								floadservicio($idcon,$servicicodigo);
								?>
								</select></td>
 							</tr> 
 							<tr>
								<td width="15%" class="NoiseFooterTD"><?php if($campnomb["reclamfecrec"] == 1){ $reclamfecrec = null; echo "*";}?>&nbsp;Fecha Reclamo&nbsp;</td>
								<td width="25%" class="NoiseDataTD"><input type="text" name="reclamfecrec" id="reclamfecrec" size="20" value="<?php if(!$flagnuevoreclamo){ echo $sbreg[reclamfecrec];}else {echo $reclamfecrec; }?>" onfocus="this.blur();"/></td>
 								<td width="25%" class="NoiseFooterTD">&nbsp;Fecha de Radicacion</td>
								<td width="35%" class="NoiseDataTD">&nbsp;<b><?php echo date('Y-m-d');?></b></td>
 							</tr> 
 							<tr>
								<td width="15%" class="NoiseFooterTD"><?php if($campnomb["reclamclinom"] == 1){ $reclamclinom = null; echo "*";}?>&nbsp;Nombre Cliente</td>
								<td width="25%" class="NoiseDataTD"><input type="text" name="reclamclinom" id="reclamclinom" size="33" value="<?php echo $reclamclinom ?>" /><input type="hidden" name="reclamnit" id="reclamnit" value="<?php echo $reclamnit ?>" /></td>
								<td width="25%" class="NoiseFooterTD">&nbsp;Vendedor</td>
								<td width="35%" class="NoiseDataTD">&nbsp;<?php echo $nombre ?></td>
 							</tr>
 							<tr>
								<td colspan="4" class="ui-state-default" align="center">&nbsp;<b>Datos del Cliente</b></td>
							</tr>
							<tr>
								<td colspan="4" class="NoiseFooterTD"></td>
 							<tr>
								<td width="15%" class="NoiseFooterTD"><?php if($campnomb["reclamnomcon"] == 1){ $reclamnomcon = null; echo "*";}?>&nbsp;Nombre Del Contacto</td>
								<td width="25%" class="NoiseDataTD"><input type="text" name="reclamnomcon" size="33"	value="<?php if(!$flagnuevoreclamo){ echo $sbreg[reclamnomcon];}else {echo $reclamnomcon; }?>"></td>
 								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["reclamcargo"] == 1){ $reclamcargo = null; echo "*";}?>&nbsp;Cargo&nbsp;</td>
								<td width="35%" class="NoiseDataTD"><input type="text" name="reclamcargo" size="20"	value="<?php if(!$flagnuevoreclamo){ echo $sbreg[reclamcargo];}else {echo $reclamcargo; }?>"></td>
 							</tr>  
 							<tr>
								<td width="15%" class="NoiseFooterTD"><?php if($campnomb["ciudadcodigo"] == 1){ $ciudadcodigo = null; echo "*";}?>&nbsp;Ciudad</td>
								<td width="25%" class="NoiseDataTD"><select name="ciudadcodigo">
								<option value=""></option>
								<?php 
								include '../src/FunGen/floadciudad.php';
								$idcon = fncconn();
								floadciudad($idcon,$ciudadcodigo);
								?>
								</select></td>
 								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["reclamtelefono"] == 1){ $reclamtelefono = null; echo "*";}?>&nbsp;Telefono&nbsp;</td>
								<td width="35%" class="NoiseDataTD"><input type="text" name="reclamtelefono" size="20"	value="<?php if(!$flagnuevoreclamo){ echo $sbreg[reclamtelefono];}else {echo $reclamtelefono; }?>"></td>
 							</tr> 
 							<tr>
								<td width="15%" class="NoiseFooterTD"><?php if($campnomb["reclammail"] == 1){ $reclammail = null; echo "*";}?>&nbsp;E-Mail</td>
								<td width="25%" class="NoiseDataTD"><input type="text" name="reclammail" size="33"	value="<?php if(!$flagnuevoreclamo){ echo $sbreg[reclammail];}else {echo $reclammail; }?>"></td>
 								<td width="25%" class="NoiseFooterTD">&nbsp;No Pedido Venta&nbsp;</td>
		  						<td width="35%" class="NoiseDataTD"><input type="text" name="pedvennumero" id="pedvennumero" size="20" onfocus="validaCliente(this.id);"/><input type="hidden" name="pedvencodigo" id="pedvencodigo">
		  							<div class="ui-buttonset" style="float:right;" align="right">
											<button id="ingresarpedido">Agregar</button>&nbsp;&nbsp;
		            				<button id="quitarpedido">Quitar</button>
									</div>
									</td>
 							</tr>
		  					<tr>
		  						<td colspan="4">
		  							<div id="listadoreclamo">
										<?php
											$noAjax = true;
											include '../src/FunjQuery/jquery.visors/jquery.reclamo.php';  
										?>
									</div>
								</td>
		  					</tr>
 							<tr>
 								<td colspan="4" class="NoiseFooterTD"></td>
 							</tr>
 							<tr><td colspan="4" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="4" class="NoiseFooterTD"><?php if($campnomb["reclamdescri"]	 == 1){$reclamdescri = null; echo "*";}?>&nbsp;Observaciones</td></tr>
							<tr><td colspan="4" rowspan="2" class="NoiseDataTD"><textarea name="reclamdescri" rows="2" cols="95"><?php if(!$flagnuevoreclamo){ echo $sbreg[reclamdescri];}else{ echo $reclamdescri;} ?></textarea>  </td></tr>
							<tr>
 								<td colspan="4" class="NoiseFooterTD"></td>
 							</tr>
							<tr>
								<td width="15%" class="NoiseFooterTD"><?php if($campnomb["acuercodigo"] == 1){ $acuercodigo = null; echo "*";}?>&nbsp;Acuerdos con el cliente</td>
								<td width="25%" class="NoiseDataTD"><input type="text" name="acuercodigo" size="33"	value="<?php if(!$flagnuevoreclamo){ echo $sbreg[acuercodigo];}else {echo $acuercodigo; }?>"></td>
 								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["reclamotros"] == 1){ $reclamotros = null; echo "*";}?>&nbsp;Otros&nbsp;</td>
								<td width="35%" class="NoiseDataTD"><input type="text" name="reclamotros" size="20"	value="<?php if(!$flagnuevoreclamo){ echo $sbreg[reclamotros	];}else {echo $reclamotros; }?>"></td>
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
			<input type="hidden" name="accionnuevoreclamo">  
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="nuevo">						
			<input type="hidden" name="reclamfecrad" value="<?php echo date('Y-m-d');?>">						
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 	
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>