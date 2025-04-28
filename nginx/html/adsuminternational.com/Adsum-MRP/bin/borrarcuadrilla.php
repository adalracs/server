<?php 	
	include ('../src/FunGen/sesion/fncvalses.php'); 
	include ('../src/FunPerPriNiv/pktblservicio.php');
	include ('../src/FunPerPriNiv/pktbldepartamento.php');
	include ('../src/FunPerPriNiv/pktblciudad.php');
	include ('../src/FunPerPriNiv/pktblzona.php');
	include ('../src/FunPerPriNiv/pktblsubzona.php');
	include ('../src/FunPerPriNiv/pktblcuadrizona.php');
	include ('../src/FunPerPriNiv/pktblcuadrillausuario.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktbldepartam.php');
	include ('../src/FunPerPriNiv/pktblcalendario.php');
	include ( '../src/FunPerPriNiv/pktblareafuncio.php');
	include ( '../src/FunPerPriNiv/pktblcargo.php');
	include ('../src/FunPerPriNiv/pktblfestivo.php');
	
	if(!$flagdetallarcuadrilla)
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton); 

		if(!$sbreg) 
			include( '../src/FunGen/fnccontfron.php'); 
		
		$idcon = fncconn();
		$rs_cuadrizona = loadrecordcuadrizona($sbreg['cuadricodigo'], $idcon);
		$rs_cuadrillausuario = loadrecordcuadrillausuariousuario($sbreg['cuadricodigo'], $idcon);
		$rs_servicio = loadrecordservicio($sbreg['servicicodigo'], $idcon);
		
		if($sbreg['arefuncodigo'])
			$rs_areafuncio = loadrecordareafuncio($sbreg['arefuncodigo'], $idcon);
			
		if($rs_areafuncio['departcodigo'])
			$rs_departam = loadrecorddepartam($rs_areafuncio['departcodigo'], $idcon);
			
		$arr_estado = array(1 => 'Activo', 2 => 'Inactivo');
		
		//==========
		include '../src/FunGen/fnccalendario.php';
		$jsonCalendar = json_calendar($sbreg['cuadricodigo'], $sbreg['cuadrinombre'], $idcon);
		$jsFestivo = strjs_festivo();
	} 
?> 
<html> 
	<head> 
		<title>Borrar registro de cuadrilla</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
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
				
				var calendar = $('#calendar').fullCalendar({
					theme: true,
					header: {
						left: 'prev,next today now',
						center: 'title',
						right: 'month,agendaWeek,agendaDay'
					},
					
					selectable: false,
					selectHelper: false,
					editable: false,
					events: [<?php echo $jsonCalendar ?>],
					timeFormat: 'h:mm tt{ - h:mm tt}',
					loading: function(bool) {
						if (bool) $('#loading').show();
						else $('#loading').hide();
					},
					dayFestivo: <?php echo $jsFestivo; ?>
					
				});
			});
		</script>
		<style type="text/css">
			#loading { position: absolute; top: 5px; right: 5px; }
			#calendar { width: 800px; margin: 0 auto; }
			.sub-style { font-size: 95%; font-family : Arial }
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
						<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="800">
			  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Borrar registro</font></span></td></tr>
			  				<tr> 
			  					<td> 
			            			<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content"> 
										<tr> 
			 								<td width="22%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
			  								<td width="78%" class="NoiseDataTD"><?php echo $sbreg['cuadricodigo']; ?></td> 
			 							</tr> 
										<tr> 
			 								<td class="NoiseFooterTD">&nbsp;Cuadrilla</td> 
			  								<td class="NoiseDataTD"><?php echo $sbreg['cuadrinombre']; ?></td> 
			 							</tr> 
										<tr>
											<td class="NoiseFooterTD">&nbsp;Servicio</td>
											<td class="NoiseDataTD"><?php echo $rs_servicio['servicinombre'] ?></td> 
			 							</tr> 
										<tr>
											<td class="NoiseFooterTD">&nbsp;Departamento</td>
											<td class="NoiseDataTD"><?php echo $rs_departam['departnombre'] ?></td> 
			 							</tr>
			 							<tr>
											<td class="NoiseFooterTD">&nbsp;&Aacute;rea funcional</td>
											<td class="NoiseDataTD"><?php echo $rs_areafuncio['arefunnombre'] ?></td> 
			 							</tr>
			 							<tr> 
			 								<td class="NoiseFooterTD">&nbsp;Estado</td> 
			  								<td class="NoiseDataTD"><?php echo $arr_estado[$sbreg['cuadriacti']]; ?></td> 
			 							</tr>
									</table> 
								</td>
							</tr>
							<tr> 
			  					<td> 
			  						<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
										<tr> 
											<td width="50%" class="ui-state-default">Zona - Sub zona</td> 
											<td width="50%" class="ui-state-default">Ciudad</td> 
										</tr>
										<?php 
											for($a = 0; $a < count($rs_cuadrizona); $a++):
												if($class == "NoiseFooterTD")
													$class = "NoiseDataTD";
												else
													$class = "NoiseFooterTD"; 
													
												unset($rs_zona, $rs_ciudad, $rs_subzona);	
													
												$rs_zona = loadrecordzona($rs_cuadrizona[$a]['zonacodigo'], $idcon);
												$rs_ciudad = loadrecordciudad($rs_zona['ciudadcodigo'], $idcon);
												
												if($rs_cuadrizona[$a]['subzoncodigo'])
													$rs_subzona = loadrecordsubzona($rs_cuadrizona[$a]['subzoncodigo'], $idcon);
										?>
										<tr class="<?php echo $class ?>"> 
											<td class="sub-style"><?php echo $rs_zona['zonanombre']; if($rs_subzona) echo ' - '.$rs_subzona['subzonnombre'];  ?></td> 
											<td class="sub-style"><?php echo $rs_ciudad['ciudadnombre']; ?></td> 
										</tr>
										<?php endfor; ?>
			                   		</table>
			               		</td>
							</tr>
							<tr> 
			  					<td> 
			       					<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center">
				                   		<tr><td class="ui-state-default" align="center">Asignados</td></tr>
			  							<tr>
			  								<td>	
			  									<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
													<tr> 
														<td width="10%" class="ui-state-default">Registro</td> 
														<td width="40%" class="ui-state-default">Nombre</td> 
														<td width="40%" class="ui-state-default">Cargo</td> 
														<td width="10%" class="ui-state-default">&nbsp;</td> 
													</tr>
													<?php 
														for($a = 0; $a < count($rs_cuadrillausuario); $a++):
															if($class == "NoiseFooterTD")
																$class = "NoiseDataTD";
															else
																$class = "NoiseFooterTD"; 
																
															unset($rs_usuario, $rs_cargo);
															$rs_usuario = loadrecordusuario($rs_cuadrillausuario[$a]['usuacodi'], $idcon);	
															
															if($rs_usuario['cargocodigo'])
																$rs_cargo = loadrecordcargo($rs_usuario['cargocodigo'], $idcon);
													?>
													<tr class="<?php echo $class ?>"> 
														<td class="sub-style"><b><?php echo $rs_usuario['usuacodi'];  ?></b></td> 
														<td class="sub-style"><?php echo $rs_usuario['usuanombre'].' '.$rs_usuario['usuapriape'].' '.$rs_usuario['usuasegape'];  ?></td> 
														<td class="sub-style"><?php if($rs_cargo) echo $rs_cargo['cargonombre']; ?></td> 
														<td class="sub-style" align="center"><b><?php if($rs_cuadrillausuario[$a]['cuausulider'] == 't') echo 'Lider'; ?></b></td> 
													</tr>
													<?php endfor; ?>
						                   		</table>
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
			<input type="hidden" name="cuadricodigo" value="<?php echo $sbreg[cuadricodigo]; ?>">
 			<input type="hidden" name="flagborrarcuadrilla" value="1"> 
			<input type="hidden" name="accionborrarcuadrilla">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="borrar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html> 
