<?php 
ob_start();
	include ('../src/FunGen/sesion/fncvalses.php');	
	include ('../src/FunPerPriNiv/pktblservicio.php');
	include('../src/FunPerPriNiv/pktbldepartamento.php');
	include('../src/FunPerPriNiv/pktblciudad.php');
	include('../src/FunPerPriNiv/pktblzona.php');
	include('../src/FunPerPriNiv/pktblsubzona.php');
	include('../src/FunPerPriNiv/pktblusuario.php');
	include ('../src/FunPerPriNiv/pktblturno.php');
	include('../src/FunPerPriNiv/pktbldepartam.php');
	include('../src/FunPerPriNiv/pktblareafuncio.php');
	include ( '../src/FunGen/fncseeknegocio.php');
	include '../src/FunGen/fnccalendario.php';
	include ('../src/FunPerPriNiv/pktblfestivo.php');
	
	if($accioneditarcuadrilla)
	{ 
		include ( 'editacuadrilla.php'); 
		$flageditarcuadrilla = 1; 
	} 
ob_end_flush(); 

	if(!$flageditarcuadrilla)
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton);
		 
		if (!$sbreg) 
			include( '../src/FunGen/fnccontfron.php');

		$idcon = fncconn();
		//=========
		$rs_areafuncio = loadrecordareafuncio($sbreg['arefuncodigo'], $idcon);
		$departcodigo = $rs_areafuncio['departcodigo'];
		$arefuncodigo = $rs_areafuncio['arefuncodigo'];
		//=========
		
		$servicicodigo = $sbreg['servicicodigo'];
		$cuadrinombre = $sbreg['cuadrinombre'];

		include_once '../src/FunPerPriNiv/pktblcuadrizona.php';
		include_once '../src/FunPerPriNiv/pktblcuadrillausuario.php';
		$rs_cuadrizona = loadrecordcuadrizona($sbreg['cuadricodigo'], $idcon);
		$rs_cuadrillausuario = loadrecordcuadrillausuariousuario($sbreg['cuadricodigo'], $idcon);
		
		
		if($rs_cuadrillausuario > 0)
		{
			for($a = 0; $a < count($rs_cuadrillausuario); $a++)
			{
				if(!$lsttecnico)
					$lsttecnico = $rs_cuadrillausuario[$a]['usuacodi'];
				else
					$lsttecnico = $lsttecnico.",".$rs_cuadrillausuario[$a]['usuacodi'];
					
				if($rs_cuadrillausuario[$a]['cuausulider'] == 't')
					$usualider = $rs_cuadrillausuario[$a]['usuacodi'];
			}
		}
		
		if($rs_cuadrizona > 0)
		{
			$arr_val = array();
			
			for($a = 0; $a < count($rs_cuadrizona); $a++)
			{
				if(!array_key_exists($rs_cuadrizona[$a]['zonacodigo'], $arr_val))
				{
					if(!$lstzona)
						$lstzona = $rs_cuadrizona[$a]['zonacodigo'];
					else
						$lstzona = $lstzona.",".$rs_cuadrizona[$a]['zonacodigo'];
						
					$arr_val[$rs_cuadrizona[$a]['zonacodigo']] = ';)'; 
				}
				
				if($rs_cuadrizona[$a]['subzoncodigo'])
				{
					if(!$lstsubzona)
						$lstsubzona = $rs_cuadrizona[$a]['zonacodigo'].'|'.$rs_cuadrizona[$a]['subzoncodigo'];
					else
						$lstsubzona = $lstsubzona.",".$rs_cuadrizona[$a]['zonacodigo'].'|'.$rs_cuadrizona[$a]['subzoncodigo'];
				}
			}
		}
		
		//======
		include_once '../src/FunPerPriNiv/pktblcalendario.php';
		$jsonCalendar = json_calendar($sbreg['cuadricodigo'], $sbreg['cuadrinombre'], $idcon);
	}
	else
		$jsonCalendar = strjson_calendar($arrcalendario, $cuadrinombre);
			
	$jsFestivo = strjs_festivo();
			/** Filtro Adcional para lista de usuarios por anexar **/
	$idcon = fncconn();
	$rs_usuario = loadrecordusuario($usuacodi, $idcon);
	$rs_departam = loadrecorddepartam($rs_usuario['departcodigo'], $idcon);
		/** Filtro Adcional para lista de usuarios por anexar **/
	
?> 


<html> 
	<head> 
		<title>Editar registro de cuadrilla</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<link rel="stylesheet" type="text/css" href="temas/themes/fullcalendar.css">
		<script type="text/javascript" src="../src/FunjQuery/external/fullcalendar.js"></script>
		<script type="text/javascript">
			$(function(){
				$("#tabscuadrilla").tabs({
					ajaxOptions: {
						error: function(xhr, status, index, anchor) {
							$(anchor.hash).html("No se puede cargar esta pesta&ntilde;a. Vamos a tratar de solucionar este problema lo m&aacute;s pronto posible.");
						}
					}
				});
				
				//Botones Visor Tecnicos
				/**
				 * Boton Anexar Tecnico
				 */
				$('#anxctecnico').button({ icons: { primary: "ui-icon-plus" } }).click(function() {
					window.open('maestablcuadrillausuario.php?id=' + document.getElementById('lsttecnico').value + '&negocicodigo=<?php echo $negocicodigo ?>&codigo=<?php echo $codigo?>','','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');
					return false;
				});
				
				/**
				 * Boton Retirar Tecnico
				 */
				$('#retctecnico').button({ icons: { primary: "ui-icon-minus" } }).click(function() {
					ret_tecn(window.frames['lsttecnicovisor'].document.getElementById('arr_delitem').value);
					return false;
				});
			}); 
		</script>
		<script type="text/javascript">
			$(function(){
				var milseg = parseInt(24 * 60 * 60 * 1000);
				var dias = 0;
				var inicio = '';
				var fin = '';
				var evento = '';
				var now = new Date();
				
				var calendar = $('#calendar').fullCalendar({
					theme: true,
					header: {
						left: 'prev,next today now',
						center: 'title',
						right: 'month,agendaWeek,agendaDay'
					},
					
					selectable: true,
					selectHelper: true,
					editable: false,
					
					events: [<?php echo $jsonCalendar ?>],
					timeFormat: 'h:mm tt{ - h:mm tt}',

				    select: function( startDate, endDate, allDay, jsEvent, view ) {
//						if((startDate >= now && endDate >= now) || (startDate < now && endDate >= now))
//						{
							var diferencia = endDate.getTime() - startDate.getTime();
							
							dias = Math.floor(diferencia / milseg) + 1; 
							inicio = startDate;
							fin = endDate;
		
							if(inicio == fin)
								var strDate = startDate.getFullYear() + '-' + fmtnumber(startDate.getMonth() + 1) + '-' + fmtnumber(startDate.getDate());
							else
								var strDate = 'Entre ' + startDate.getFullYear() + '-' + fmtnumber(startDate.getMonth() + 1) + '-' + fmtnumber(startDate.getDate()) + ' / ' + endDate.getFullYear() + '-' + fmtnumber(endDate.getMonth() + 1) + '-' + fmtnumber(endDate.getDate());
		
							document.getElementById('periodo').innerHTML = strDate;
							$("#msgeditevent").dialog("open");
//						}
//						else
//						{
//							$("#msgwindow").dialog("open");
//						}
					},
					eventClick: function(event, element) {
						if(event.id != 'old')
						{
							evento = event;
							$("#msgdelevent").dialog("open");
				        	//event.title = "CLICKED!";
				        	//$('#calendar').fullCalendar('updateEvent', event);
						}
				    },
				     
	//				eventDrop: function(event, delta) {
	//					alert(event.title + ' was moved ' + delta + ' days\n' + '(should probably update your database)');
	//				},
	//
					loading: function(bool) {
						if (bool) $('#loading').show();
						else $('#loading').hide();
					},
					dayFestivo: <?php echo $jsFestivo; ?>
					
				});
	
	
				$("#msgeditevent").dialog({
					autoOpen: false,
					width: 550,
					modal: true,
					buttons: {
						"Cancelar": function() {
							calendar.fullCalendar('unselect');
							$(this).dialog("close"); 
						},
						"Asignar turno": function() {
							var subinicio = new Date(inicio);
							var subfin = new Date(inicio);
							var turno = document.getElementById('turnovalor').value;
							var allday = false;
							var title = document.getElementById('titlecuadrilla').value;
							
							if(turno == 'desc')
							{
								allday = true;
								turno = '{-}00,00,00,00';
								title = 'DESCANSO';
							}


							var tieturno = turno.split("{-}");
							
							var turid = tieturno[0];
							var arrTurno = tieturno[1].split(",");
							var events = calendar.fullCalendar('clientEvents');
							var intlen = events.length;
							
							for(var a = 0; a < dias; a++)
							{
								if(parseInt(arrTurno[2]) < parseInt(arrTurno[0]))
								{
									tiempo = subfin.getTime();
									total = subfin.setTime(parseInt(tiempo + milseg));
								}
								else
									subfin = subinicio;

//								if(subinicio >= now)
//								{
									var idn = 'n' + intlen;
									
									calendar.fullCalendar('renderEvent',{ 
																			id: idn, 
																			title: title, 
																			turid: turid, 
																			start: new Date(subinicio.getFullYear(),subinicio.getMonth(),subinicio.getDate(),arrTurno[0],arrTurno[1]),
																			end: new Date(subfin.getFullYear(),subfin.getMonth(),subfin.getDate(),arrTurno[2], arrTurno[3]),
																			allDay: allday
																		}, true // make the event "stick"
															);
									intlen ++;
//								}
								
								tiempo = subinicio.getTime();
								total = subinicio.setTime(parseInt(tiempo + milseg));
							}
	
							loadEvent();
							calendar.fullCalendar('unselect');
							$(this).dialog("close"); 
						}
					}
				});

				$("#msgdelevent").dialog({
					autoOpen: false,
					width: 550,
					modal: true,
					buttons: {
						"No": function() {
							$(this).dialog("close"); 
						},
						"Si": function() {
							if(document.getElementById('arrcaldelete').value != '')
								document.getElementById('arrcaldelete').value = document.getElementById('arrcaldelete').value + ',' + evento.id;
							else
								document.getElementById('arrcaldelete').value = evento.id;
							
							calendar.fullCalendar( 'removeEvents', evento.id );
							loadEvent();
							$(this).dialog("close");
						}
					}
				});

				function loadEvent()
				{
					var events = calendar.fullCalendar('clientEvents');
					var intlen = events.length;
					var allday = 0;
					var memory = '';
					
					if(intlen > 0)
					{
						var id = '';
						
						for(var a = 0; a < intlen; a++)
						{
							events[a].id ? id = events[a].id : id = '0';
							events[a].allDay == true ? allday = 1 : allday = 0;
							
							if(memory == '')
								memory =  id + '::' + fmtDate(events[a].start) + '::' + fmtDate(events[a].end) + '::' + allday + '::' + events[a].turid;
							else
								memory = memory + ':-:' + id + '::' + fmtDate(events[a].start) + '::' + fmtDate(events[a].end) + '::' + allday + '::' + events[a].turid;
						}
					}
					document.getElementById('arrcalendario').value = memory;
				}

				
			});

			function fmtnumber(number)
			{
				if(number < 10)
					return '0' + number;
				else
					return number;
			}
		
			function fmtDate(date)
			{
				if(date != null)
				{
					var day = date.getDate();
					var month = date.getMonth() + 1;
					var year = date.getFullYear();
					var hour = date.getHours();
					var min = date.getMinutes();
					var seg = date.getSeconds();
	
					return year + '-' + fmtnumber(month) + '-' + fmtnumber(day) + '::' + fmtnumber(hour) + ':' + fmtnumber(min);
				}
				else
					return ' :: ';
				/*
				getDate() - Devuelve el día del mes de 1 a 31
				getDay() - Devuelve el día de la semana de 0 a 6
				getMonth() - Devuelve el mes actual de 0 a 11, si queremos mostrar la fecha en formato dd/mm/yyy, tendremos que sumar uno a este valor.
				getFullYear() - Devuelve el año en formato YYYY
				getYear() - Devuelve el año en formato YY
				getHours() - Devuelve la hora de 0 a 23
				getMinutes() - Devuelve los minutos de 0 a 59
				getSeconds() - Devuelve los segundos de 0 a 59
				getMilliseconds() - Devuelve los milisegundos (0-999)
				getTime() - Devuelve la fecha unix (Número de milisegundos desde medianoche del 1 de enero de 1970)
				getTimezoneOffset() - Zona horária del visitante
				*/
			}
		</script>
		<style type="text/css">
			#loading { position: absolute; top: 5px; right: 5px; }
			#calendar { width: 800px; margin: 0 auto; }
		</style>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Cuadrilla</font></p>
			<div style="width: 850px; margin:0 auto;" >
				<div id="tabscuadrilla">
					<ul>
						<li><a href="#tabs-1">Nueva cuadrilla</a></li>
						<li><a href="#tabs-2"><span class="ui-icon ui-icon-calendar" style="float: left; margin-right: .3em;"></span>Calendario - Turno</a></li>
					</ul>
					<div id="tabs-1">  
						<table width="800" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content">
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
			            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
										<tr> 
			 								<td width="22%" class="NoiseFooterTD"><?php if($campnomb["cuadrinombre"] == 1){$cuadrinombre = null; echo "*";}?>&nbsp;Cuadrilla</td> 
			 								<td width="78%" class="NoiseDataTD"><input type="text" name="cuadrinombre" id="cuadrinombre"  onchange="document.getElementById('cuadriname').innerHTML = this.value; document.getElementById('titlecuadrilla').value = this.value" size="50" value="<?php if(!$flageditarcuadrilla){echo $sbreg[cuadrinombre];}else{ echo $cuadrinombre; }?>"></td> 
			 							</tr> 
										<tr>
			     							<td class="NoiseFooterTD"><?php if($campnomb["servicicodigo"] == 1){ $servicicodigo = null; echo "*";} ?>&nbsp;Servicio</td>
			     							<td class="NoiseDataTD"><select name="servicicodigo" id="servicicodigo">
			     								<option value = "">-- Seleccione --</option>
				     							<?php
													include ('../src/FunGen/floadservicio.php');
													$idcon = fncconn();
													floadservicionegocio($idcon, $servicicodigo, $negocicodigo);
												?>
			    							</select></td>
										</tr>  
										<tr>
			     							<td class="NoiseFooterTD"><?php if($campnomb["departcodigo"] == 1){ $departcodigo = null; echo "*";} ?>&nbsp;Departamento</td>
			     							<td class="NoiseDataTD"><select name="departcodigo" id="departcodigo" onChange="accionCmbxAreaFuncio(this.value,'');">
			     								<option value = "">-- Seleccione --</option>
				     							<?php
													include ('../src/FunGen/floaddepartam.php');
													floaddepartamnegocio($departcodigo, $negocicodigo, $idcon);
												?>
			    							</select></td>
										</tr> 
										<tr>
			     							<td class="NoiseFooterTD"><?php if($campnomb["arefuncodigo"] == 1){ $arefuncodigo = null; echo "*";} ?>&nbsp;&Aacute;rea funcional</td>
			     							<td class="NoiseDataTD"><span id="cmbxareafuncio"><select name="arefuncodigo" id="arefuncodigo">
			     								<option value = "">-- Seleccione --</option>
				     							<?php
													include ('../src/FunGen/floadareafuncio.php');
													floadareafunciodep($idcon, $departcodigo, $arefuncodigo);
												?>
			    							</select></span></td>
										</tr>  
										<tr>
			     							<td class="NoiseFooterTD"><?php if($campnomb["cuadriacti"] == 1){ $cuadriacti = null; echo "*";} ?>&nbsp;Estado</td>
			     							<td class="NoiseDataTD"><select name="cuadriacti" id="cuadriacti">
			     								<option value = "1" <?php if($cuadriacti == 1) echo 'selected'; ?>>Activo</option>
			     								<option value = "2" <?php if($cuadriacti == 2) echo 'selected'; ?>>Inactivo</option>
			    							</select></td>
										</tr>   
									</table> 
			  					</td> 
			 				</tr> 
			 				<tr> 
			  					<td> 
			       					<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
				                   		<tr>
			  								<td class="ui-state-default">&nbsp;<a onClick="return verocultar('filtrzonasubzona',0);" href="javascript:animatedcollapse.toggle('filtrzonasubzona');"><img id="row0" align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0">&nbsp;Zona | Sub Zona</a>
												<div id="filtrzonasubzona" style="padding: 2px 2px 2px 2px; display:none" >
							        				<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
							                   			<tr>
							                   				<td height="110" class="ui-widget-content">
							                   					<iframe src="detallarlistasvisor.php?form_data=lstzona&iReg_array=<?php echo $lstzona; ?>&alldata=<?php echo $alllstzonatmp; ?>&subvisors=lstsubzonavisor" frameborder="0" name="lstzonavisor" id = "lstzonavisor"  height="110" width="100%" align="absmiddle"></iframe>
							                   					<input type="hidden" name="alllstzonatmp" id="alllstzonatmp" value="<?php echo $alllstzonatmp; ?>">
																<input type="hidden" name="lstzona" id="lstzona" value="<?php echo $lstzona; ?>">
							                   				</td>
							                   			</tr>
							                   			<tr> 
							                   				<td height="110" class="ui-widget-content">
							                   					<iframe src="detallarlistasvisor.php?form_data=lstsubzona&iReg_array=<?php echo $lstzona; ?>&iReg_array2=<?php echo $lstsubzona; ?>&alldata=<?php echo $alllstsubzonatmp; ?>" frameborder="0" name="lstsubzonavisor" id = "lstsubzonavisor"  height="110" width="100%" align="absmiddle"></iframe>
							                   					<input type="hidden" name="alllstsubzonatmp" id="alllstsubzonatmp" value="<?php echo $alllstsubzonatmp; ?>">
																<input type="hidden" name="lstsubzona" id="lstsubzona" value="<?php echo $lstsubzona; ?>">
							                   				</td>
							                   			</tr>
							                   		</table>
							                   	</div> 
											</td>
										</tr>
									</table>		
			               		</td>
							</tr>
							<tr>
								<td>
									<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
				                   		<tr>
				                   			<td class="ui-state-default">
												<div id="filservicios" style="display: block;" >
													<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
						                   				<tr>
						                   					<td height="140" class="ui-widget-content">
						                   						<iframe src="detallarlistasvisor.php?form_data=lsttecnico&iReg_array=<?php echo $lsttecnico; ?>&usualider=<?php echo $usualider; ?>&alldata=<?php echo $alllsttecnicotmp; ?>" frameborder="0" name="lsttecnicovisor" id = "lsttecnicovisor"  height="140" width="100%" align="absmiddle"></iframe>
						                   						<input type="hidden" name="alllsttecnicotmp" id="alllsttecnicotmp" value="<?php echo $alllsttecnicotmp; ?>">
																<input type="hidden" name="lsttecnico" id="lsttecnico" value="<?php echo $lsttecnico; ?>">
																<input type="hidden" name="usualider" id="usualider" value="<?php  echo $usualider;  ?>">	
						                   					</td>
						                   				</tr>
						                   				<tr><td></td></tr>
						                   				<tr><td><div class="ui-buttonset">
															<button id="anxctecnico">Agregar a la lista</button>&nbsp;&nbsp;&nbsp;
															<button id="retctecnico">Quitar de la lista</button>
														</div></td></tr>
													</table>
												</div>
											</td>
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
					</div>
					<div id="tabs-2">
						<table width="800" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content">
							<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
							<tr>
								<td>
			       					<div id='calendar'></div>
			       				</td>
			       			</tr>
			     		</table>
					</div>
				</div>
			</div>
			<input type="hidden" name="cuadricodigo" value="<?php if(!$flageditarcuadrilla){ echo $sbreg[cuadricodigo]; }else{ echo $cuadricodigo; } ?>"> 
			<input type="hidden" name="arrcalendario" id="arrcalendario" value="<?php echo $arrcalendario; ?>"> 
			<input type="hidden" name="arrcaldelete" id="arrcaldelete" value="<?php echo $arrcaldelete; ?>"> 
			<input type="hidden" name="accioneditarcuadrilla"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="editar"> 
		</form>
		<div id="msgeditevent" title="Adsum Kallpa [Calendario]">
   			<div>
   				<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center"> 
					<tr> 
 						<td width="22%" class="NoiseFooterTD">&nbsp;Cuadrilla</td> 
  						<td width="78%" class="NoiseDataTD"><span id="cuadriname"><?php echo $cuadrinombre; ?></span><input type="hidden" name="titlecuadrilla" id="titlecuadrilla" value="<?php echo $cuadrinombre ?>"></td> 
 					</tr> 
					<tr> 
 						<td class="NoiseFooterTD">&nbsp;Turno</td> 
  						<td class="NoiseDataTD"><select name="turnovalor" id="turnovalor">
  							<option value="desc">-- DESCANSO --</option>
  							<?php 
  								include '../src/FunGen/floadturno.php';
  								floadtimeturno($idcon);
  							?>
  						</select></td> 
 					</tr> 
					<tr>
						<td class="NoiseFooterTD">&nbsp;Periodo</td>
						<td class="NoiseDataTD"><span id="periodo"></span></td> 
 					</tr> 
				</table> 
   			</div>
   		</div>
		<div id="msgdelevent" title="Adsum Kallpa [Calendario]"><span>Desea eliminar este turno?</span></div>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg">No es posible asignar jornada para este rango de fechas.</span></div>
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html> 
