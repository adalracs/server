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
		<title>Disponibilidad</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript">
			function rldSubfunction(tipo = '')
			{
				if(tipo != '')
				{
					if(document.getElementById('arrsistema').value)
						var paramttipo = 'arrsistema=' + document.getElementById('arrsistema').value + '&arrtipoequipo=' + document.getElementById('arrtipoequipo').value;
					else
						var paramttipo = 'arrusuaplanta=' + document.getElementById('arrusuaplanta').value + '&arrtipoequipo=' + document.getElementById('arrtipoequipo').value;
				}
				else
				{
					var paramttipo = 'arrusuaplanta=' + document.getElementById('arrusuaplanta').value + '&arrtipoequipo=' + document.getElementById('arrtipoequipo').value;
					var paramtsistema = 'arrusuaplanta=' + document.getElementById('arrusuaplanta').value + '&usuasistemareport=1&arrsistema=' + document.getElementById('arrsistema').value;
					accionReloadvisorSistema(paramtsistema);
				}
				accionReloadvisorTipoequipo(paramttipo);
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
			 * Function accionReloadvisorSistema
			 * @param paramt
			 * @return
			 */
			function accionReloadvisorSistema(paramt)
			{
				$.ajax({	   
					dataType: "html", type: "POST", url: "../src/FunjQuery/jquery.visors/jquery.sistema.php", data: paramt,
					beforeSend: function(data){ },        
					success: function(requestData){
						if(requestData != '')
							document.getElementById('filsistema').innerHTML = requestData;
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
						document.form1.action = 'detallareportdispon.php';
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

				
			});
		</script>
	</head>
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Disponibilidad</font></p>
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="670">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Disponibilidad</font></span></td></tr>
  				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center">
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
					</td>
				</tr>
  				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center">
							<tr>
  								<td align="center">
  									<div style="width:648px; height: 14px; margin:0 auto;" class="ui-state-default">
										&nbsp;Proceso
									</div>
  									<div id="filsistema">
										<?php 
											$noAjax = true;
											$usuasistemareport = true;
											include_once '../src/FunPerSecNiv/fncsqlrun.php';
											include '../src/FunjQuery/jquery.visors/jquery.sistema.php'; 
										?>
									</div>
									<input type="hidden" name="arrsistema" id="arrsistema" value="<?php echo $arrsistema; ?>">
								</td>
							</tr>
						</table>
					</td>
				</tr>
  				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center">
							<tr>
  								<td align="center">
  									<div style="width:648px; height: 14px; margin:0 auto;" class="ui-state-default">
										&nbsp;Tipo de equipo
									</div>
  									<div id="filtipoequipo">
										<?php 
											$noAjax = true;
											include '../src/FunjQuery/jquery.visors/jquery.tipoequipo.php'; 
										?>
									</div>
									<input type="hidden" name="arrtipoequipo" id="arrtipoequipo" value="<?php echo $arrtipoequipo; ?>">
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">										
	             			<!--<tr>
	  			 				<td colspan="4" class="NoiseFooterTD"><span id="labelnumhoras"></span>
	  			 					&nbsp;N&uacute;mero de horas x equipo&nbsp;&nbsp;<input type="text" name="numerohoras" size="8">
	  			 				</td>
	             			</tr>-->
             				<tr>
        						<td width="50%" class="ui-state-default" align="center">Periodo a consultar</td>
        						<td width="50%" class="ui-state-default" align="center">Tipo reporte</td>
        					</tr>
        					<tr>
                        		<td class="NoiseErrorDataTD">
	                				del&nbsp;<input type="text" name="consulfecini" id="consulfecini" size="8">&nbsp;&nbsp;
	                				al&nbsp;<input type="text" name="consulfecfin" id="consulfecfin" size="8">
				                </td>
        		                <td align="center" class="NoiseErrorDataTD"><div style="width: 98%; text-align:left"><div id="tipoinforme">
									<input type="radio" id="tiporeport1" name="tiporeport" value="1" checked /><label for="tiporeport1">Detallado</label>
									<input type="radio" id="tiporeport2" name="tiporeport" value="2" /><label for="tiporeport2">Agrupar por tipo</label>
								</div></div></td>
  							</tr>
        				</table>
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