<?php 
	include ('../src/FunGen/sesion/fncvalses.php'); 
	include ('../src/FunPerSecNiv/fncsqlrun.php'); 
	$idcon = fncconn();
?> 
<html>
	<head>
		<title>Parametros de Consulta - Capacitaciones</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript">
			$(function(){
				$( "#tipoinforme" ).buttonset();
				
				/**
				 * Boton aceptar informe
				 */
				$('#aceptarinforme').button({ icons: { primary: "ui-icon-circle-check" } }).click(function() {
					var err = '';
					
//					if(document.getElementById('lsttecnico').value == '')
//						err = err + '* Debe especificar el/los funcionario(s).<br>';
					
					if(document.getElementById('flagtipoinforme').value == '')
						err = err + '* Debe especificar el tipo de informe por (Empleado/Area/Curso/Tema).';
					
					if(document.getElementById('consulfecfin').value == '' || document.getElementById('consulfecini').value == '')
						(err != '') ? err = err + '<br>* Debe especificar la fecha de inicio y fecha fin.' : err = err + '* Debe especificar la fecha de inicio y fecha fin.' ;
					else if(document.getElementById('consulfecfin').value < document.getElementById('consulfecini').value)
						(err != '') ? err = err + '<br>* La fecha de inicio debe se mayor a la fecha fin.' : err = err + '* La fecha de inicio debe se mayor a la fecha fin.';

					if(err == '')
					{
						document.form1.action = 'detallainfrepcapaci.php';
						document.form1.submit();
					}
					else
					{
						document.getElementById('msg').innerHTML = '<font color="red">Error:</font><br>' + err;
						$('#msgwindow').dialog('open');
					}
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
<?php if(!$codigo){ echo "<!--";}?> 
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Consulta - Capacitaci&oacute;n</font></p>
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="670">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Total Ordenes por Ejecutados</font></span></td></tr>
	  			<tr>
					<td align="center"><div style="width: 98%; text-align:left"><div id="tipoinforme">Tipo de consulta 
						<input type="radio" id="tipoinfo1" name="tipoinfo" value="1" onclick="document.getElementById('flagtipoinforme').value = this.value; document.getElementById('empleado').style.display = 'block';" /><label for="tipoinfo1">Empleado</label>
						<input type="radio" id="tipoinfo2" name="tipoinfo" value="2" onclick="document.getElementById('flagtipoinforme').value = this.value; document.getElementById('empleado').style.display = 'none';" /><label for="tipoinfo2">Area</label>
						<input type="radio" id="tipoinfo3" name="tipoinfo" value="3" onclick="document.getElementById('flagtipoinforme').value = this.value; document.getElementById('empleado').style.display = 'none';" /><label for="tipoinfo3">Curso</label>
						<input type="radio" id="tipoinfo4" name="tipoinfo" value="4" onclick="document.getElementById('flagtipoinforme').value = this.value; document.getElementById('empleado').style.display = 'none';" /><label for="tipoinfo4">Tema</label>
					</div></div></td>
				</tr>
				<tr>
	    			<td>
	    				<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr><td colspan="2" class="ui-state-default">*&nbsp;Periodo</td></tr>
							<tr class="NoiseDataTD">
								<td>&nbsp;Desde&nbsp;&nbsp;<input name="consulfecini" id="consulfecini" type="text" size="8"></td>
								<td>&nbsp;Hasta&nbsp;&nbsp;<input name="consulfecfin" id="consulfecfin" type="text" size="8"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<div style="display:none;" id="empleado">
							<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center">
								<tr><td colspan="2" class="ui-state-default">*&nbsp;Empleado</td></tr>
								<tr>
	  								<td class="NoiseFooterTD">&nbsp;<input type="text" name="usuacodigo" id="usuacodigo" size="15" /><input type="text" name="usuanombre" id="usuanombre"  size="50" /></td>
								</tr>
							</table>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center">
							<tr>
  								<td>
  									<div style="width:648px; height: 14px; margin:0 auto;" class="ui-state-default">&nbsp;
										<a onClick="return verocultar('fildepartam',3);" href="javascript:animatedcollapse.toggle('fildepartam');"><img id="row3" align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0">&nbsp;&Aacute;reas</a>
									</div>
  									<div id="fildepartam">
										<?php 
											include_once '../src/FunPerPriNiv/pktbldepartam.php';
											$noAjax = true;
											include '../src/FunjQuery/jquery.visors/jquery.departam.php'; 
										?>
									</div>
									<input type="hidden" name="arrlstdepartam" id="arrlstdepartam" value="<?php echo $arrlstdepartam; ?>">
								</td>
							</tr>
						</table>
					</td>
				</tr>
	  			<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center">
							<tr>
  								<td>
  									<div style="width:648px; height: 14px; margin:0 auto;" class="ui-state-default">&nbsp;
										<a onClick="return verocultar('filcursos',1);" href="javascript:animatedcollapse.toggle('filcursos');"><img id="row1" align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0">&nbsp;Cursos</a>
									</div>
  									<div id="filcursos">
										<?php 
											include_once '../src/FunPerPriNiv/pktblcurso.php';
											$noAjax = true;
											include '../src/FunjQuery/jquery.visors/jquery.cursos.php'; 
										?>
									</div>
									<input type="hidden" name="arrlstcursos" id="arrlstcursos" value="<?php echo $arrlstcursos; ?>">
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center">
							<tr>
  								<td>
  									<div style="width:648px; height: 14px; margin:0 auto;" class="ui-state-default">&nbsp;
										<a onClick="return verocultar('filtemas',2);" href="javascript:animatedcollapse.toggle('filtemas');"><img id="row2" align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0">&nbsp;Temas</a>
									</div>
  									<div id="filtemas">
										<?php 
											include_once '../src/FunPerPriNiv/pktbltema.php';
											$noAjax = true;
											include '../src/FunjQuery/jquery.visors/jquery.temas.php'; 
										?>
									</div>
									<input type="hidden" name="arrlsttemas" id="arrlsttemas" value="<?php echo $arrlsttemas; ?>">
								</td>
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
			<input name="flagtipoinforme" id="flagtipoinforme" type="hidden" value="<?php echo $flagtipoinforme ?>">
			<input name="codigo" id="codigo" type="hidden" value="<?php echo $codigo ?>">
			<input name="negocicodigo" id="negocicodigo" type="hidden" value="<?php echo $negocicodigo ?>">
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>