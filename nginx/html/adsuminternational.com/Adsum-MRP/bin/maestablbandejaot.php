<?php
ob_start();
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunGen/sesion/fncvarsesion.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblsistema.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktbltipotrab.php');
	include ( '../src/FunPerPriNiv/pktbltarea.php');
	include ( '../src/FunPerPriNiv/pktblotestado.php');
	include ( '../src/FunGen/fncnumprox.php');
	include ( '../src/FunGen/fncnumact.php');
	include ( '../src/FunGen/floadtimehours.php');
	include ( '../src/FunGen/floadtimeminut.php');

	if($accionactualizaimprime)
		include ( 'grababandejaot.php');
		
	$idcon = fncconn();
ob_end_flush();
?>
<html>
	<head>
		<title>Bandeja de ordenes programadas</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.ui.ajax_accionextras.js"></script>
		
		<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js"		type="text/javascript" ></SCRIPT>
		<script language=JavaScript src="../src/FunGen/cargarSistema.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/cargarEquipos.js" type="text/javascript" ></script>
<!--		<script language=JavaScript src="../src/FunGen/prototype162.js" type="text/javascript" ></script>-->
<!--        <SCRIPT src="../src/FunGen/achelista.js" type="text/javascript"></SCRIPT>-->
        
        <script type="text/javascript">
			$(function(){
				$("#bandejaotgeneral").tabs({
					ajaxOptions: {
						error: function(xhr, status, index, anchor) {
							$(anchor.hash).html("No se puede cargar esta pesta&ntilde;a. Vamos a tratar de solucionar este problema lo m&aacute;s pronto posible.");
						}
					}
				});

				/**
				 * Window para asignar cuadrillas/usuarios a la orden
				 */
				//Botones Visor Tecnicos
				/**
				 * Boton Anexar Cuadrilla
				 */
				$('#anxotcuadrilla').button({ icons: { primary: "ui-icon-plus" } }).click(function() {
					document.getElementById('typesource').value = 'cuadrilla';
					window.open('maestablcuadrillagen.php?id=' + document.getElementById('lsttecnicoot').value + '&typesource=cuadrilla&negocicodigo=' + document.getElementById('negocicodigo').value + '&codigo=' + document.getElementById('codigo').value,'','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');
					$( "#retottecnico" ).button({ disabled: true });
					return false;
				});

				/**
				 * Boton Anexar Tecnicos
				 */
				$('#anxottecnico').button({ icons: { primary: "ui-icon-plus" } }).click(function() {
					document.getElementById('typesource').value = 'user';
					window.open('consultarcuadrillausuario.php?id=' + document.getElementById('lsttecnicoot').value + '&typesource=cuadrilla&negocicodigo=' + document.getElementById('negocicodigo').value + '&codigo=' + document.getElementById('codigo').value,'','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');
					$( "#retottecnico" ).button({ disabled: false });
					return false;
				});
				
				/**
				 * Boton Retirar Tecnico
				 */
				$('#retottecnico').button({ icons: { primary: "ui-icon-minus" } }).click(function() {
					loadlist_tecncuadrilla(document.getElementById('lsttecnicoot').value, document.getElementById('typesource').value, '');
					return false;
				});

				
				/**
				 * Boton Aceptar
				 */
				$('#updateprint').button({ icons: { primary: "ui-icon-print" } }).click(function() {
					var msg = '';
					
					if(document.getElementById('arr_bandeja').value == '')
						msg = msg + '- Debe seleccionar la(s) actividades por asignar.<br>';
					
					if(document.getElementById('lsttecnicoot').value == '')
						msg = msg + '- Debe asignar los empleados involucrados en la orden.<br>';
					
					if(document.getElementById('usualider').value == '' && document.getElementById('typesource').value == 'user')
						msg = msg + '- Debe seleccionar el lider de ejecucion de la(s) actividades.<br>';
					
					if(msg != '')
					{
						document.getElementById('msg').innerHTML = '<span style="color: red;">Error:</font><br>' + msg;
						$('#msgwindow').dialog('open');

					}
					else
					{
						document.getElementById('accionactualizaimprime').value = 1;
						document.form1.submit();
					}
					
					return false;
				});
				
				

				// Obj Fechas

				var dates = $( "#ordtrafecini" ).datepicker({
					changeMonth: true,
					changeYear: true,
					onSelect: function( selectedDate ) {
						loadlist_tecncuadrilla(document.getElementById('lsttecnicoot').value, document.getElementById('typesource').value, '');
					}
				});

				
//				$("#ordtrafecini").datepicker({changeMonth: true,changeYear: true});
				$("#ordtrafecini").datepicker('option', {dateFormat: 'yy-mm-dd'});
				$("#ordtrafecini").datepicker($.datepicker.regional['es']);
//				$("#ordtrafecini").datepicker({onSelect: function( selectedDate ) { loadlist_tecncuadrilla(document.getElementById('lsttecnicoot').value, document.getElementById('typesource').value, ''); } });

				<?php if($typesource == 'cuadrilla'): ?>$( "#retottecnico" ).button({ disabled: true });<?php endif ?>
				<?php if(!$ordtrafecini) $ordtrafecini = date("Y-m-d");  ?>$("#ordtrafecini").datepicker("setDate", '<?php echo $ordtrafecini; ?>');
			});
		</script>
		
		<script type="text/javascript">
			$(function(){
				/**
				 * Window Show View Novedades
				 */
				$("#windowusuanovedad").dialog({
					autoOpen: false,
					width: 670,
					height: 300,
					modal: true,
					buttons: {
						"Cancelar": function() { 
							$(this).dialog("close"); 
						},
						"Grabar": function() { 
							var arFecini = document.getElementById('usunovfecini').value.split('-');
							var arFecfin = document.getElementById('usunovfecfin').value.split('-');
							var arHorini = document.getElementById('usunovhorini').value.split(':');
							var arHorfin = document.getElementById('usunovhorfin').value.split(':');

							if(arFecini != "" && arFecfin != "" && arHorini != "" && arHorfin != "")
							{
								var dateFrom = new Date();
								var dateTo = new Date();
								
								dateFrom.setDate(parseInt(arFecini[2]));
								dateFrom.setMonth(parseInt(arFecini[1])-1);
								dateFrom.setFullYear(parseInt(arFecini[0]));
								dateFrom.setHours(parseInt(arHorini[0]));
								dateFrom.setMinutes(parseInt(arHorini[1]));
								dateFrom.setSeconds(parseInt(0));

								dateTo.setDate(parseInt(arFecfin[2]));
								dateTo.setMonth(parseInt(arFecfin[1])-1);
								dateTo.setFullYear(parseInt(arFecfin[0]));
								dateTo.setHours(parseInt(arHorfin[0]));
								dateTo.setMinutes(parseInt(arHorfin[1]));
								dateTo.setSeconds(parseInt(0));

								if(dateTo > dateFrom)
								{
									if(document.getElementById('estnovcodigo').value == '')									
									{
										document.getElementById('msg2').innerHTML = 'No es posible guardar, debe seleccionar la novedad del listado de novedades';
										$('#msgwindow').dialog('open');
									}
									else	
									{
										showSaveNovedad();
										$(this).dialog("close");
									} 
								}
								else
								{
									document.getElementById('msg2').innerHTML = 'No es posible guardar, la fecha de inicio debe ser mayor a la fecha fin';
									$('#msgwindow').dialog('open');
								}
							}
							else
							{
								document.getElementById('msg2').innerHTML = 'Debe especificar la fecha/hora de inicio y fecha/hora fin';
								$('#msgwindow').dialog('open');
							}
						}
					}
				});

				$("#usunovfecfin").datepicker({changeMonth: true,changeYear: true, onSelect: function( selectedDate ) { calculeDiff(); }});
				$("#usunovfecfin").datepicker('option', {dateFormat: 'yy-mm-dd'});
				$("#usunovfecfin").datepicker($.datepicker.regional['es']);
				
				$("#usunovfecini").datepicker({changeMonth: true,changeYear: true, onSelect: function( selectedDate ) { calculeDiff(); }});
				$("#usunovfecini").datepicker('option', {dateFormat: 'yy-mm-dd'});
				$("#usunovfecini").datepicker($.datepicker.regional['es']);
			});

			function showWindow(usuacodi)
			{
				var param = 'usuacodigo=' + usuacodi;
				accionLoadWindowView(param,'jquery.ajax_ingrNovedad','usuanovmsg','windowusuanovedad');
			}

			function showSaveNovedad()
			{
				var vestnovcodigo = document.getElementById('estnovcodigo').value; 
				var vusuacodi = document.getElementById('usuacodigo').value; 
				var vusunovfecini = document.getElementById('usunovfecini').value; 
				var vusunovfecfin = document.getElementById('usunovfecfin').value; 
				var vusunovhorini = document.getElementById('usunovhorini').value; 
				var vusunovhorfin = document.getElementById('usunovhorfin').value; 
				var vusunovdescri = document.getElementById('usunovdescri').value;
				
				var strsave = "&usuacodigo=" + vusuacodi + "&estnovcodigo=" + vestnovcodigo + "&usunovfecini=" + vusunovfecini + "&usunovfecfin=" + vusunovfecfin + "&usunovdescri=" + vusunovdescri; 
				strsave+= "&usunovhorini=" + vusunovhorini + "&usunovhorfin=" + vusunovhorfin; 
				accionGrabaDataNovedad(strsave, 'functionot');
			}
		</script>
        
		<SCRIPT LANGUAGE="JavaScript">
			function reloadforresume(planta, tipotrab)
			{
				var $tabs = $('#bandejaotgeneral').tabs();

				var plantacodigo = document.form1.plantacodigo;
				var tiptracodigo = document.form1.tiptracodigo;

				for(var i = 0; i < plantacodigo.length; i++)
				{
					if(plantacodigo.options[i].value == planta)
					{
						plantacodigo.options[i].selected = true;
						break;
					}
				}
				
				for(var i = 0; i < tiptracodigo.length; i++)
				{
					if(tiptracodigo.options[i].value == tipotrab)
					{
						tiptracodigo.options[i].selected = true;
						break;
					}
				}

				
				document.getElementById("detalleprograma").src="detallabandejaot.php?plantacodigo=" + planta + "&sistemcodigo=&equipocodigo=&tiptracodigo=" + tipotrab;
				$tabs.tabs('select', 0)
			}

		
			function loadlista()
			{
				if(document.form1.plantacodigo.value == 'all')
				{
					document.form1.equipocodigo.disabled = true;
					document.form1.sistemcodigo.disabled = true;
				}
				else
				{
					document.form1.equipocodigo.disabled = false;
					document.form1.sistemcodigo.disabled = false;
				}
				
				document.getElementById("detalleprograma").src="detallabandejaot.php?plantacodigo=" + document.form1.plantacodigo.value + "&sistemcodigo=" + document.form1.sistemcodigo.value + "&equipocodigo=" + document.form1.equipocodigo.value + "&tiptracodigo=" + document.form1.tiptracodigo.value + "&tareacodigo=" + document.form1.tareacodigo.value;
			}
		</script>
		<style type="text/css">
			.ui-tabs .ui-tabs-panel {
			    padding: 1px 1px;
			}
			.resum-title {
			    font-size: 80%;
			}
		</style>
	</head>
<?php if(!$codigo){echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Bandeja de ordenes programadas</font></p>
			<div id="bandejaotgeneral">
				<ul>
					<li><a href="#tabs-1">Bandeja de ordenes</a></li>
					<li><a href="../src/FunjQuery/jquery.phpscripts/jquery.resumenbandeja.php?arr_planta=<?php echo $usuaplanta?>&arr_tipotrab=<?php echo $usuatipotrab ?>&usuacodi=<?php echo $usuacodi ?>">Resumen bandeja de ordenes</a></li>
				</ul>
				<div id="tabs-1">
					<table width="100%" align="center" cellpadding="1" cellspacing="1">
			    		<tr>
							<td>
								<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
									<tr>
		  								<td class="ui-state-default">&nbsp;<a onClick="return verocultar('filtraplansistequi',1);" href="javascript:animatedcollapse.toggle('filtraplansistequi');"><img id="row1" align="middle" align="top"  src="temas/Noise/AscOn.gif" border="0">&nbsp;Filtros de la bandeja</a>
											<div id="filtraplansistequi" style="padding: 2px 2px 2px 2px; display:block" >
						        				<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
						        					<tr>
														<td width="5%"  class="NoiseFooterTD">&nbsp;Planta</td>
														<td width="55%"  class="NoiseFooterTD"><select name="plantacodigo" onChange="loadlista();cargarSistemas(this.value);">
															<option value = "">-- Seleccione --</option>
															<option value = "all">-- Todas asignadas --</option>
															<?php
																include ('../src/FunGen/floadplanta.php');
																floadplanta($plantacodigo,$idcon);
															?>
														</select></td>
														<td width="10%"  class="NoiseFooterTD">&nbsp;Sistema</td>
														<td width="30%"  class="NoiseFooterTD"><select name="sistemcodigo" onChange="loadlista();cargarEquipos(this.value);">
															<option value = "">-- Seleccione --</option>
															<?php
																include ('../src/FunGen/floadsistemaot.php');
																floadsistemaot($sistemcodigo,$plantacodigo,$idcon);
															?>
														</select></td>
													</tr>
													<tr>
														<td class="NoiseFooterTD">&nbsp;Equipo</td>
														<td class="NoiseFooterTD"><select name="equipocodigo"  id="equipocodigo" onChange="loadlista();">
															<option value = "">-- Seleccione --</option>
															<?php
																include ('../src/FunGen/floadequipoot.php');
																floadequipoot($equipocodigo, $sistemcodigo,$idcon);
															?>
														</select></td>
														<td class="NoiseFooterTD">&nbsp;Tipo de Trabajo</td>
														<td class="NoiseFooterTD"><select name="tiptracodigo" onChange="loadlista();">
															<option value = "">-- Seleccione --</option>
															<?php
																include ('../src/FunGen/floadtipotrab.php');
																floadtipotrab($tiptracodigo,$idcon, $usuatipotrab);
															?>
														</select></td>
													</tr>
													<tr>
														<td class="NoiseFooterTD">&nbsp;Tarea</td>
														<td class="NoiseFooterTD"><select name="tareacodigo"  id="tareacodigo" onChange="loadlista();">
															<option value = "">-- Seleccione --</option>
															<?php
																include ('../src/FunGen/floadtarea.php');
																floadtarea($tareacodigo,$idcon);
															?>
														</select></td>
														<td class="NoiseFooterTD" colspan="2">&nbsp;</td>
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
								<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
									<tr>
		  								<td class="ui-state-default">&nbsp;&nbsp;Ordenes de trabajo
											<div id="filtraplansistequi" style="padding: 2px 2px 2px 2px; display:block" >
						        				<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
						        					<tr>
														<td class="NoiseFooterTD"><td bgcolor="White"><iframe src="detallabandejaot.php?plantacodigo=<?php echo $plantacodigo ?>&sistemcodigo=<?php echo $sistemcodigo ?>&equipocodigo=<?php echo $equipocodigo ?>&tiptracodigo=<?php echo $tiptracodigo ?>&tareacodigo=<?php echo $tareacodigo ?>&arr_data=<?php echo $arr_bandeja ?>&alldata=<?php echo $allarr_bandejatmp; ?>" frameborder="0" name="detalleprograma" id="detalleprograma" frameborder="0"  height="370" width="100%" align="absmiddle"></iframe></td>
													</tr>
						        					<tr><td class="NoiseFooterTD"><td>No. registros:&nbsp;&nbsp;<span id="activite"></span></td></tr>
						                   		</table>
						                   	</div> 
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>
								<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">
									<tr>
										<td width="10%"  class="NoiseFooterTD"><?php if($campnomb["ordtrafecini"] == 1){$ordtrafecini = null; echo "*";}?>&nbsp;Fecha inicio</td>
										<td width="30%"  class="NoiseDataTD">
											<input type="text" name="ordtrafecini" id="ordtrafecini" size="12">&nbsp;
											<select name="horini">
											<?php
							 					if(!$flagnuevoprogramacion)
							 					{
													$horini = date("h");
													if(date("a") == 'pm')
														$pasadmerini = 1;
							 					}				 		
												floadtimehours($horini);
							  				?>
											</select>
											:
											<select name="minini">
											<?php
												if(!$flagnuevoprogramacion)
													$minini = date("i");
							 					floadtimeminut($minini);
							 				?>
											</select>
											<input type="checkbox" name="pasadmerini" <?php if($flagnuevoprogramacion){if($pasadmerini)echo "CHECKED";}else{if($pasadmerini)echo "CHECKED";}?>>&nbsp;p.m
										</td>
										<td width="10%"  class="NoiseFooterTD">&nbsp;Estado Orden(s)</td>
										<td width="50%"  class="NoiseDataTD"><select name="otestacodigo">
		<!--									<option value = "">-- Seleccione --</option>-->
											<?php
												include('../src/FunGen/floadotestadoot.php');
												floadotestadoot($otestacodigo,$idcon);
											?>
										</select></td>
									</tr>
								</table>
							</td>
						</tr>
						<!--<tr>
							<td>
								<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
									<tr>
		  								<td class="ui-state-default" colspan="2">&nbsp;<a onClick="return verocultar('filtrasistecnico',2);" href="javascript:animatedcollapse.toggle('filtrasistecnico');"><img id="row2" align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0"><?php if($campnomb["usualider"] == 1){$usualider = null; echo "*";}?>&nbsp;Empleados involucrados en la(s) orden(s)</a>
											<div id="filtrasistecnico" style="padding: 2px 2px 2px 2px; display:none" >
						        				<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
						                   			<tr>
					                   					<td height="110"  class="ui-widget-content">
					                   						<iframe src="detallarlistasvisor.php?form_data=lsttecnicoot&iReg_array=<?php echo $lsttecnicoot; ?>&usualider=<?php echo $usualider; ?>&typesource=user&alldata=<?php echo $alllsttecnicoottmp; ?>" frameborder="0" name="lsttecnicootvisor" id = "lsttecnicootvisor"  height="110" width="100%" align="absmiddle"></iframe>
					                   						<input type="hidden" name="alllsttecnicoottmp" id="alllsttecnicoottmp" value="<?php echo $alllsttecnicoottmp; ?>">
															<input type="hidden" name="lsttecnicoot" id="lsttecnicoot" value="<?php echo $lsttecnicoot; ?>">
															<input type="hidden" name="usualider" id="usualider" value="<?php  echo $usualider;  ?>">
															<input type="hidden" name="typesource" id="typesource" value="<?php  echo $typesource;  ?>">
					                   					</td>
						                   			</tr>
						                   			<tr><td></td></tr>
					                   				<tr><td><div class="ui-buttonset">
														<button id="anxottecnico">Agregar a la lista</button>&nbsp;&nbsp;&nbsp;
														<button id="retottecnico">Quitar de la lista</button>
													</div></td></tr>
						                   		</table>
						                   	</div> 
										</td>
									</tr>
								</table>
							</td>
						</tr>
						-->
						<tr>
							<td class="NoiseFooterTD">
								<table width="719" border="0" cellspacing="1" cellpadding="0" align="left">
									<tr>
		  								<td >
		  									<div style="width:778px; height: 14px; margin:0 auto;" class="ui-state-default">
												<a onClick="return verocultar('involucrados',2);" href="javascript:animatedcollapse.toggle('involucrados');"><img id="row2" align="middle" align="top"  src="temas/Noise/<?php if($arrheots) echo 'AscOn'; else echo 'DescOn'  ?>.gif" border="0">&nbsp;Empleados involucrados en la orden</a>
											</div>
		  									<div id="involucrados">
												<?php 
													include_once '../src/FunPerPriNiv/pktblcalendario.php';
													include_once '../src/FunPerPriNiv/pktblcuadrilla.php';
													include_once '../src/FunPerPriNiv/pktblcuadrillausuario.php';
													include_once '../src/FunPerPriNiv/pktblcargo.php';
													include_once '../src/FunPerPriNiv/pktblusuanovedad.php';
													include_once '../src/FunPerPriNiv/pktblestadonoveda.php';
													include_once '../src/FunPerPriNiv/pktblusuario.php';
													
													$fecini = $ordtrafecini;
													$fecfin = $ordtrafecfin;
													$iRegArray = $lsttecnicoot;
													$noAjax = true;
													include '../src/FunjQuery/jquery.accionextras/jquery.ajax_loadUsuaOt.php'; 
												?>
											</div>
											<input type="hidden" name="alllsttecnicoottmp" id="alllsttecnicoottmp" value="<?php echo $alllsttecnicoottmp; ?>">
											<input type="hidden" name="lsttecnicoot" id="lsttecnicoot" value="<?php echo $lsttecnicoot; ?>">
											<input type="hidden" name="usualider" id="usualider" value="<?php  echo $usualider;  ?>">
											<input type="hidden" name="typesource" id="typesource" value="<?php  echo $typesource;  ?>">
											<input type="hidden" name="negocicodigo" id="negocicodigo" value="<?php  echo $negocicodigo;  ?>">
										</td>
									</tr>
									<tr><td><div class="ui-buttonset" style="width:770px;">
										<button id="anxotcuadrilla">Agregar cuadrilla</button>&nbsp;&nbsp;&nbsp;
										<button id="anxottecnico">Agregar t&eacute;cnico a la lista</button>&nbsp;
										<button id="retottecnico">Quitar t&eacute;cnico de la lista</button>
									</div></td></tr>
								</table>
							</td>
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td class="NoiseErrorDataTD" align="center"><div class="ui-buttonset">
								<button id="updateprint">Actualizar / Imprimir</button>
							</div></td>
						</tr>
						<tr><td>&nbsp;</td></tr> 
			  		</table>
			  	</div>
			  	<div id="tabs-2">
			  	</div>
			</div>
  			<input type="hidden" name="accionactualizaimprime" id="accionactualizaimprime">
	  		
			<div style="display:none;"><select name="componcodigo"><option>-- Seleccione --</option></select></div>
			<input type="hidden" name="indice" id="indice" value="<?php echo $indice; ?>">
	  		<input type="hidden" name="arr_bandeja" id="arr_bandeja" value="<?php echo $arr_bandeja; ?>">
	  		<input type="hidden" name="allarr_bandejatmp" id="allarr_bandejatmp" value="<?php echo $allarr_bandejatmp; ?>">
	  		<input type="hidden" name="arreglo_del" id="arreglo_del" value="<?php echo $arreglo_del; ?>">
			<input type="hidden" name="codigo" id="codigo" value="<?php echo $codigo; ?>">
		</form>
		<div id="windowusuanovedad" title="Adsum Kallpa [Novedad]">
			<div id="usuanovmsgs">
				<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">						
					<tr>
     					<td class="NoiseFooterTD" width="15%">&nbsp;Fecha inicio</td>
     					<td class="NoiseDataTD" width="35%">
     						<input type="text" name="usunovfecini" id="usunovfecini" size="12">
     						<select name="usunovhorini" id="usunovhorini" onChange="calculeDiff();">
								<?php
									$hora = '00:00';
									for(;;):
										echo '<option value="'.$hora.'">'.date("h:i a", strtotime($hora)).'</option>';
										$hora = date("H:i", strtotime($hora.' + 30 minutes'));
										
										if($hora == '23:30')
											break;
									endfor;
								?>
							</select>	
     					</td>
     					<td class="NoiseFooterTD" width="15%">&nbsp;Fecha fin</td>
     					<td class="NoiseDataTD" width="35%">
     						<input type="text" name="usunovfecfin" id="usunovfecfin" size="12">
     						<select name="usunovhorfin" id="usunovhorfin" onChange="calculeDiff();">
								<?php
									$hora = '00:00';
									for(;;):
										echo '<option value="'.$hora.'">'.date("h:i a", strtotime($hora)).'</option>';
										$hora = date("H:i", strtotime($hora.' + 30 minutes'));
										
										if($hora == '23:30')
											break;
									endfor;
								?>
							</select>
     					</td>
					</tr>
					<tr>
						<td class="NoiseFooterTD">&nbsp;Duraci&oacute;n</td>
						<td class="NoiseDataTD"  colspan="3"><span id="duracionhe"><?php echo $duracion ?></span><input type="hidden" value="<?php echo $duracion ?>" id="duracion" name="duracion"></td>
					</tr>
				</table>
			</div>
			<div id="usuanovmsg"></div>
		</div>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
		<div id="msgwindowtecncuadrilla" title="Adsum Kallpa"><span id="msgottecncuadri"></span></div>
  	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>