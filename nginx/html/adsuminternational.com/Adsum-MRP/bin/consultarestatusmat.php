<?php 
ob_start();
	include ( "../src/FunPerPriNiv/pktblitemdesa.php");
	include ( "../src/FunGen/sesion/fncvalses.php");
	include ( "../src/FunPerSecNiv/fncsqlrun.php");
	include ( "../src/FunGen/sesion/fnccaf.php");
	include ( "../src/FunGen/cargainput.php");
	
	$idcon = fncconn();
ob_end_flush();
?>
<html>
	<head>
		<title>Informe estatus de materiales </title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript">
			$(function(){

				$("#campinforme").buttonset();

				$('#aceptarinforme').button({ icons: { primary: "ui-icon-circle-check" } }).click(function() {
					$( "#aceptarinforme" ).button( "option", "disabled", true );
					//objetos a utilzar
					var obj_producfechaini = document.getElementById("producfechaini");
					var obj_producfechafin = document.getElementById("producfechafin");
					//valor de los objetos
					var producfechaini = (obj_producfechaini)? obj_producfechaini.value : "" ; 
					var producfechafin = (obj_producfechafin)? obj_producfechafin.value : "" ; 
					//validacion de error
					var err = "";

					/*if( (producfechaini != "" && producfechafin == "") || (producfechaini == "" && producfechafin != "") || (producfechaini == "" && producfechafin == "")){
						err = err + 'Advertencia : *** Debe seleccionar ambas fechas.<br>'; 
					}*/

					if(err == ""){

						document.form1.action = "detallarepestatusmat.php";
						document.form1.submit();
					}else{

						$( "#aceptarinforme" ).button( "option", "disabled", false );
						document.getElementById('msg').innerHTML = err;
						$('#msgwindow').dialog('open');
					}
					return false;
				});
				
				var dates = $('#producfechaini,#producfechafin').datepicker({
			        dateFormat : 'yy-mm-dd',
			        changeMonth : true,
			        changeYear : true,
			        onSelect: function(selectedDate) {
			            var option = this.id == "producfechaini" ? "minDate" : "maxDate";
			            var instance = $(this).data("datepicker");
			            var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
			            dates.not(this).datepicker("option", option, date);
			        }
			    });

			    /*$("#txtlineas").autocomplete({
					source: "../src/FunjQuery/jquery.phpcombobox/jquery.atcordencompracliente.php",
					minLength: 0,
					select: function(event, ui) {
						if(ui.item)
						{
							document.getElementById('txtlineas').value = ui.item.label;
						}
						else
						{
							document.getElementById('txtlineas').value = "";
						}
					}
				});*/
			    
			});

			/*function accionReloadCliente( valor )
			{
				$.ajax({	   
					dataType: "html",
					type: "POST",        
					url: "../src/FunjQuery/jquery.visors/jquery.ordencompra.cliente.php", 	
					data: { ordcomcodcli : valor , ordcomrazsoc : valor, arrclienteoc : $("#arrclienteoc").val() },
					beforeSend: function(data){ 
						$('#listcliente').block({ theme : true , message : '<img src="../img/loading.gif">&nbsp;Espere mientras cargan los clientes.</img>'});
					},     
					success: function(requestData){
						if(requestData != '')
							document.getElementById('listcliente').innerHTML = requestData;
					},         
					error: function(requestData, strError, strTipoError){ 
						$('#listcliente').block({ theme : true , message : 'Error'});
					},
					complete: function(requestData, exito){ 
						$('#listcliente').unblock();
					}                                      
				});
			}

			function accionReloadVendedor( valor )
			{
				$.ajax({	   
					dataType: "html",
					type: "POST",        
					url: "../src/FunjQuery/jquery.visors/jquery.pedidoventa.vendedor.php", 	
					data: { pedvencodven : valor , pedvenvendedor : valor, arrvendedorpv : $("#arrvendedorpv").val() },
					beforeSend: function(data){ 
						$('#listvenedor').block({ theme : true , message : '<img src="../img/loading.gif">&nbsp;Espere mientras cargan los clientes.</img>'});
					},     
					success: function(requestData){
						if(requestData != '')
							document.getElementById('listvenedor').innerHTML = requestData;
					},         
					error: function(requestData, strError, strTipoError){ 
						$('#listvenedor').block({ theme : true , message : 'Error'});
					},
					complete: function(requestData, exito){ 
						$('#listvenedor').unblock();
					}                                      
				});
			}*/
			
		</script>
	</head>
<?php if(!$codigo){ echo "<!--";}?> 
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Informe estatus de materiales</font></p>
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="670">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><font color="FFFFFF"> Informe estatus de materiales</font></td></tr>
				<!--<tr>
	    			<td class="NoiseDataTD">
	    				<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="670">
	    					<tr>
	    						<td>
									<div style="width: 98%; text-align:left"><div id="campinforme">Ver&nbsp;
										<input type="radio" id="informedet_generico" name="informedet" value="1" checked /><label for="informedet_generico">GENERICO</label>
										<input type="radio" id="informedet_detallado" name="informedet" value="2" /><label for="informedet_detallado">DETALLADO</label>
									</div>
			    				</td>
			    			</tr>
			    		</table>
			    	</td>
			    </tr>-->
			    <tr>
	    			<td class="NoiseDataTD">
	    				<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="670">
	    					<tr>
	    						<td>
		  							<div id="listcliente" style="width:648px;" class="ui-state-default">
										<?php 
											include_once '../src/FunPerPriNiv/pktblitemdesa.php';
											$noAjax = true;
											include '../src/FunjQuery/jquery.visors/jquery.keylinea.itemdesa.php'; 
										?>
									</div>
									<input type="hidden" name="arrkeylinea" id="arrkeylinea" value="<?php echo $arrkeylinea; ?>">
	    						</td>
	    					</tr>
	    				</table>
	    			</td>
	    		</tr>
	    		<!--<tr>
	    			<td class="NoiseDataTD">
	    				<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="670">
	    					<tr>
	    						<td>
									<div>
										<div style="width:648px; height: 25px;padding: 1px;">
											&nbsp;Vendedor&nbsp;<input type="text" id="txtvendedor" name="txtvendedor" onkeyup="accionReloadVendedor(this.value);" />
										</div>
		  								<div id="listvenedor" style="width:648px;">
											<?php 
												include_once '../src/FunPerPriNiv/pktblpedidoventa.php';
												$noAjax = true;
												include '../src/FunjQuery/jquery.visors/jquery.pedidoventa.vendedor.php'; 
											?>
										</div>
										<input type="hidden" name="arrvendedorpv" id="arrvendedorpv" value="<?php echo $arrvendedorpv; ?>">
									</div>
			    				</td>
			    			</tr>
			    		</table>
					</td>
				</tr>-->
				<!--<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
 							<tr>
 								<td width="15%" class="NoiseFooterTD"><?php if($campnomb["producfechaini"] == 1){ $producfechaini = null; echo "*";}?>&nbsp;Desde</td> 
 								<td width="45%" class="NoiseDataTD">&nbsp;<input type="text" name="producfechaini" id="producfechaini" value="<?php echo $producfechaini; ?>" /></td>
 								<td width="15%" class="NoiseFooterTD"><?php if($campnomb["producfechafin"] == 1){ $producfechafin = null; echo "*";}?>&nbsp;Hasta</td> 
 								<td width="25%" class="NoiseDataTD">&nbsp;<input type="text" name="producfechafin" id="producfechafin" value="<?php echo $producfechafin; ?>" /></td>
 							</tr>
 						</table>
 					</td>
 				</tr>-->
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><div class="ui-buttonset">
						<button id="aceptarinforme">Aceptar</button>&nbsp;
					</div></td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
			</table> 
			<input name="codigo" id="codigo" type="hidden" value="<?php echo $codigo ?>">
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>