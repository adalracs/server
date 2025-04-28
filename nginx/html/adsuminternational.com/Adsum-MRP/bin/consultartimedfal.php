<?php
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblsistema.php');
	include ( '../src/FunPerSecNiv/fncsqlrun.php');
	include ( '../src/FunGen/sesion/fnccaf.php');
	$reccomact = fnccaf($GLOBALS[usuacodi], $_SERVER["SCRIPT_FILENAME"]);
?>
<html> 
	<head> 
		<title>Tiempo medio entre fallas</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript">
			function rldSubfunction(tipo = '')
			{
				if(tipo != '')
				{
					var paramt = 'arrusuaplanta=' + document.getElementById('arrusuaplanta').value + '&arrtipoequipo=' + document.getElementById('arrtipoequipo').value;
					accionReloadvisorEquipo(paramt)
				}
				else
				{
					var paramt = 'arrusuaplanta=' + document.getElementById('arrusuaplanta').value + '&tipoequiporeport=1&arrtipoequipo=' + document.getElementById('arrtipoequipo').value;
					accionReloadvisorTipoequipo(paramt);
				}
			}
			
			/***
			 * Function accionReloadvisorTipoequipo
			 * @param paramt
			 * @return
			 */
			function accionReloadvisorTipoequipo(paramt)
			{
				$.ajax({	   
					dataType: "html", type: "POST", url: "../src/FunjQuery/jquery.visors/jquery.tipoequipo.php", data: paramt,
					success: function(requestData){
						if(requestData != '')
							document.getElementById('filtipoequipo').innerHTML = requestData;
					},         
				});
			}
			
			/***
			 * Function accionReloadvisorEquipo
			 * @param paramt
			 * @return
			 */
			function accionReloadvisorEquipo(paramt)
			{
				var arrCampos = document.getElementById('strcampos').value.split(',');

				if (arrCampos != '')
				{
					for(var i=0; i < (arrCampos.length); i++)
					{
						if(document.getElementById(arrCampos[i]))
							paramt = paramt + '&' + arrCampos[i] + '=' + document.getElementById(arrCampos[i]).value;
					}
				}
				
				$.ajax({	   
					dataType: "html", type: "POST", url: "../src/FunjQuery/jquery.visors/jquery.equiporeport.php", data: paramt,
					success: function(requestData){
						if(requestData != '')
							document.getElementById('filequipo').innerHTML = requestData;
					},         
				});
			}

			$(function(){
				$( "#tipoinforme" ).buttonset();
				
				/**
				 * Boton Aceptar
				 */
				$('#aceptarrep').button({ icons: { primary: "ui-icon-circle-check" } }).click(function() {
					var err = '';

					if(document.getElementById('consulfecfin').value == '' || document.getElementById('consulfecini').value == '')
						(err != '') ? err = err + '<br>* Debe especificar el periodo a consultar.' : err = err + '* Debe especificar el periodo a consultar.' ;
					else if(document.getElementById('consulfecfin').value < document.getElementById('consulfecini').value)
						(err != '') ? err = err + '<br>* La fecha de inicio debe se mayor a la fecha fin.' : err = err + '* La fecha de inicio debe se mayor a la fecha fin.';
					
					if (document.getElementById('arrusuaplanta').value == "")
						err = err + "<br>* Debe Seleccionar una ubicaci&oacute;n";

					if (document.getElementById('arrtipoequipo').value == "")
						err = err + "<br>* Debe indicar los tipo de equipo que desea consultar";


					if(err != '')
					{
						document.getElementById('msg').innerHTML = '<font color="red">Error:</font><br>' + err;
						$('#msgwindow').dialog('open');
					}
					else
					{
						document.form1.action = 'reporttimedfal.php';
						document.form1.submit();
					}

					return false;
				});
				
				/**
				 * Boton Cancelar
				 */
				$('#cancelarrep').button({ icons: { primary: "ui-icon-circle-close" } }).click(function() {
					document.form1.action='main.php';
					document.form1.submit();
					return false;
				});

				/**
				 * Fecha inicio y Fecha fin
				 */
				var dates = $( "#consulfecini, #consulfecfin" ).datepicker({
					changeMonth: true,
					changeYear: true,
					numberOfMonths: 1,
					onSelect: function( selectedDate ) {
						var option = this.id == "consulfecini" ? "minDate" : "maxDate",
							instance = $( this ).data( "datepicker" ),
							date = $.datepicker.parseDate(
								instance.settings.dateFormat ||
								$.datepicker._defaults.dateFormat,
								selectedDate, instance.settings );
						dates.not( this ).datepicker( "option", option, date );
					}
				});

				$("#consulfecini").datepicker({changeMonth: true,changeYear: true});
				$("#consulfecini").datepicker('option', {dateFormat: 'yy-mm-dd'});
				$("#consulfecini").datepicker($.datepicker.regional['es']);
				
				$("#consulfecfin").datepicker({changeMonth: true,changeYear: true});
				$("#consulfecfin").datepicker('option', {dateFormat: 'yy-mm-dd'});
				$("#consulfecfin").datepicker($.datepicker.regional['es']);

				/**
				 * Pestañas(Tab) en General
				 * Activa el objeto "Pestañas (Tab)" en los formularios de la palicacion
				 */
				$("#tabgeneral").tabs({
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
			<p><font class="NoiseFormHeaderFont">Tiempo Medio Entre Fallas</font></p>
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="670">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Disponibilidad</font></span></td></tr>
  				<tr>
					<td>
						<div id="tabgeneral">
							<ul>
								<li><a href="#tabs-1"><small>&nbsp;Consultar</small></a></li>
								<li><a href="#tabs-2"><small>&nbsp;Maquinas</small></a></li>
							</ul>
							<!-- Session 1 -->
							<div id="tabs-1">
								<div style="margin-bottom: 5px;">
									<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">										
			             				<tr>
			        						<td width="50%" class="ui-state-default" align="center">Periodo a consultar</td>
			        					</tr>
			        					<tr>
			                        		<td class="NoiseErrorDataTD">
				                				&nbsp;del&nbsp;<input type="text" name="consulfecini" id="consulfecini" size="8">&nbsp;&nbsp;
				                				al&nbsp;<input type="text" name="consulfecfin" id="consulfecfin" size="8">
							                </td>
			  							</tr>
			        				</table>
			        			</div>
								<div style="margin-bottom: 5px;">
									<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
										<tr>
			  								<td align="center">
			  									<div style="width:648px; height: 14px; margin:0 auto;" class="ui-state-default">
													&nbsp;Ubicaci&oacute;n
												</div>
			  									<div id="filplantas">
													<?php 
														$noAjax = true;
														$usuaplantareport = true;
														include '../src/FunjQuery/jquery.visors/jquery.plantas.php'; 
													?>
												</div>
												<input type="hidden" name="arrusuaplanta" id="arrusuaplanta" value="<?php echo $arrusuaplanta; ?>">
											</td>
										</tr>
									</table>
								</div>
								<div style="margin-bottom: 5px;">
									<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
										<tr>
			  								<td align="center">
			  									<div style="width:648px; height: 14px; margin:0 auto;" class="ui-state-default">
													&nbsp;Tipo de equipo
												</div>
			  									<div id="filtipoequipo">
													<?php 
														$noAjax = true;
														$tipoequiporeport = true;
														include '../src/FunjQuery/jquery.visors/jquery.tipoequipo.php'; 
													?>
												</div>
												<input type="hidden" name="arrtipoequipo" id="arrtipoequipo" value="<?php echo $arrtipoequipo; ?>">
											</td>
										</tr>
									</table>
								</div>
			        		</div>
			        		<div id="tabs-2">
			        			<div style="margin-bottom: 5px;">
									<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
										<tr>
			  								<td align="center">
			  									<div style="width:715px; height: 14px; margin:0 auto;" class="ui-state-default">
													&nbsp;Maquinas
												</div>
			  									<div id="filequipo">
													<?php 
														$noAjax = true;
														include '../src/FunjQuery/jquery.visors/jquery.equiporeport.php'; 
													?>
												</div>
											</td>
										</tr>
									</table>
			        			</div>
			        		</div>
			        	</div>
  					</td>
 				</tr>
 				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center">
						<div class="console-buttons-float-topright">
							<div class="ui-widget">
								<div class="ui-state-highlight ui-corner-all" style="padding: .5em .5em;">
									<div class="ui-buttonset">
										<button id="aceptarrep">Aceptar</button>&nbsp;&nbsp;&nbsp;&nbsp;
										<button id="cancelarrep">Cancelar</button>
									</div>
								</div>
							</div>
						</div>
					</td>
				</tr>
				<tr><td>&nbsp;</td></tr> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table>
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>