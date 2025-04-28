<?php 

ob_start();

	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerSecNiv/fncsqlrun.php');
	include ( '../src/FunGen/cargainput.php');
	include ( '../src/FunGen/sesion/fnccaf.php');
	
	$idcon = fncconn();
ob_end_flush();

?>
<html>
	<head>
		<title>Informe de formula de tintas </title>
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
					var obj_producfechaini = document.getElementById('producfechaini');
					var obj_producfechafin = document.getElementById('producfechafin');
					//valor de los objetos
					var producfechaini = (obj_producfechaini)? obj_producfechaini.value : '' ; 
					var producfechafin = (obj_producfechafin)? obj_producfechafin.value : '' ; 
					//validacion de error
					var err = '';
					if( (producfechaini != '' && producfechafin == '') || (producfechaini == '' && producfechafin != '') || (producfechaini == '' && producfechafin == ''))
						err = err + 'Advertencia : *** Debe seleccionar ambas fechas.<br>'; 

					if(err == '')
					{
						document.form1.action = 'detallarepformula.php';
						document.form1.submit();
					}
					else
					{
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

				$('#toexcel').button({ icons: { primary: "ui-icon-calculator" } }).click(function() {
					
					$.ajax({	   
						dataType: "html",
						type: "POST",
						url: "../src/FunPHPExcel/infrepformula.php",
						data: {"usuacodigog" : $("#usuacodigog").val(), "producfechaini" : $("#producfechaini").val(), "producfechafin" : $("#producfechafin").val()},
						beforeSend: function(data){ 
							$("#msgwindow").dialog("open");
							$("#msg").html("Espere mientras se carga el archivo xls...");
						},
						success: function(requestData){
							$("#msgwindow").dialog("close");
							window.open('../temp/ADM_InfFormula.xls','Contratistas');
						},         
						error: function(requestData, strError, strTipoError){},
						complete: function(requestData, exito){ }                                      
					});

					
					return false;
				});
			    
			});
			
		</script>
	</head>
<?php if(!$codigo){ echo "<!--";}?> 
	<body bgcolor="FFFFFF" text="#000000">
		<div class="ui-buttonset">
			<button id="toexcel">Exportar a Excel</button>&nbsp;
		</div>
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Informe de formulacion x referencia</font></p>
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="670">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><font color="FFFFFF"> Informe de formulas</font></td></tr>
				<tr>
	    			<td class="NoiseDataTD">
	    				<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="670">
	    					<tr>
	    						<td>
			    					<!-- CONTENIDO A VER -->
									<div style="width: 98%; text-align:left"><div id="campinforme">Ver&nbsp;
										<input type="radio" id="informedet_generico" name="informedet" value="1" checked /><label for="informedet_generico">GENERICO</label>
										<!--<input type="radio" id="informedet_detallado" name="informedet" value="2" /><label for="informedet_detallado">DETALLADO</label>-->
									</div>
			    					<!-- FIN CONTENIDO A VER -->
			    				</td>
			    			</tr>
			    		</table>
			    	</td>
			    </tr>
				<tr> 
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
 				</tr>
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