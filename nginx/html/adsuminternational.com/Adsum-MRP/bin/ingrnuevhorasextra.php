<?php 
ob_start(); 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include ( '../src/FunGen/floadtimehours.php');
	include ( '../src/FunGen/floadtimeminut.php');
	
	if($accionnuevohorasextra)
		include ( 'grabahorasextra.php'); 
		
	$typesource = 'cuadrilladet';
ob_end_flush(); 
?>
<html> 
	<head> 
		<title>Nuevo registro de Horas Extras</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.ui.ajax_accionextras.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		
		<script type="text/javascript">
			$(function(){
				//Botones Visor Tecnicos
				/**
				 * Boton Listado de Empleados
				 */
				$('#hrextecnico').button({ icons: { primary: "ui-icon-person" } }).click(function() {
					window.open('maestablusuariogen.php?negocicodigo=<?php echo $negocicodigo ?>&codigo=<?php echo $codigo?>&function=getListHE','','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');
					document.getElementById('typesource').value = 'userdet';
					return false;
				});

				$('#hrexcuadrilla').button({ icons: { primary: "ui-icon-person" } }).click(function() {
					document.getElementById('typesource').value = 'cuadrilladet';
					window.open('maestablcuadrillagen.php?typesource=cuadrilladet&negocicodigo=<?php echo $negocicodigo ?>&codigo=<?php echo $codigo?>&function=getListHE','','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');
					return false;
				});

				/**
				 * Window Show View Horas Extras
				 */
				$("#windowhoraextra").dialog({
					autoOpen: false,
					width: 570,
					height: 370,
					modal: true,
					buttons: {
						"Cerrar": function() { 
							$(this).dialog("close"); 
						}
					}
				});
				
				$("#horextfecha").datepicker({changeMonth: true,changeYear: true});
				$("#horextfecha").datepicker('option', {dateFormat: 'yy-mm-dd'});
				$("#horextfecha").datepicker($.datepicker.regional['es']);
				<?php if($horextfecha): ?>$("#horextfecha").datepicker("setDate", '<?php echo $horextfecha; ?>');<?php endif ?>
			});
			
			function getListHE()
			{
				var typeseletion = document.getElementById('typesource').value;
				var param = '';
				
				if(typeseletion == 'cuadrilladet')
				{
					param = 'cuadricodigo=' + document.getElementById('lsttecnicoot').value;
				}
				else
				{
					param = 'usuacodigo=' + document.getElementById('usuacodigo').value;
					accionLoadListHE(document.getElementById("usuacodigo").value);
				}
				
				accionLoadListHEot(param);
			}

			function showWindow(idhoraextra)
			{
				accionLoadWindowHEot(idhoraextra, 'jquery.ajax_viewHExtra');
			}

			function loadAsigna(seletion)
			{
				if(seletion == '1')
				{
					document.getElementById('cuadrilla').style.display = 'none';
					document.getElementById('empleado').style.display = 'block';
					document.getElementById('listaextrasusr').style.display = 'block';
					document.getElementById('typesource').value = 'userdet';
					getListHE();
				}
				else if(seletion == '2')
				{
					document.getElementById('cuadrilla').style.display = 'block';
					document.getElementById('empleado').style.display = 'none';					
					document.getElementById('listaextrasusr').style.display = 'none';
					document.getElementById('typesource').value = 'cuadrilladet';
					getListHE();					
				}
			}

			function calculeDiff()
			{
				if(document.getElementById('horextfecha').value != '' && document.getElementById('horexthorfin').value != '')
				{
					var arFecha = document.getElementById('horextfecha').value.split('-');
					var arHorini = document.getElementById('horexthorini').value.split(':'); 
					var arHorfin = document.getElementById('horexthorfin').value.split(':');

					var dateFrom = new Date();
					dateFrom.setDate(parseInt(arFecha[2]));
					dateFrom.setMonth(parseInt(arFecha[1])-1);
					dateFrom.setFullYear(parseInt(arFecha[0]));
					dateFrom.setHours(parseInt(arHorini[0]));
					dateFrom.setMinutes(parseInt(arHorini[1]));
					dateFrom.setSeconds(parseInt(0));

					var dateTo = new Date();
					dateTo.setDate(parseInt(arFecha[2]));
					dateTo.setMonth(parseInt(arFecha[1])-1);
					dateTo.setFullYear(parseInt(arFecha[0]));
					dateTo.setHours(parseInt(arHorfin[0]));
					dateTo.setMinutes(parseInt(arHorfin[1]));
					dateTo.setSeconds(parseInt(0));

					var duracion = dateDiff(dateFrom, dateTo);
					document.getElementById('duracionhe').innerHTML = duracion;  
					document.getElementById('duracion').value = duracion;  
				}
			}
		</script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Hora extra</font></p> 
			<table width="550" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content">
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
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Ingresar nuevo registro</font></span></td></tr>
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr> 
								<td class="NoiseFooterTD" width="20%">&nbsp;Asignar a</td>
								<td class="NoiseDataTD" width="80%"><select name="asignar" id="asignar" onchange="loadAsigna(this.value);">
									<option value="">-- Seleccione --</option>
									<option value="1" <?php if($asignar == 1) echo 'selected' ?>>Empleado</option>
									<option value="2" <?php if($asignar == 2) echo 'selected' ?>>Cuadrilla</option>
								</select>
							</tr>
						</table>
  					</td> 
 				</tr> 
				<tr> 
  					<td>
  						<div id="empleado"  style="display: <?php if($asignar == 1): ?>block;<?php else: ?>none;<?php endif; ?>"> 
	            			<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
								<tr> 
									<td class="NoiseFooterTD" width="20%"><div class="ui-buttonset"><button id="hrextecnico">Empleado</button></div></td>
									<td class="NoiseDataTD" width="80%"><?php if($campnomb["usuacodi"] == 1){ $usuacodigo = null;echo "*";}?><input id="usuacodigo" name="usuacodigo" type="text" value="<?php if(!$flagnuevohorasextra){ echo $usuacodigo;} else {echo $usuacodigo;} ?>" size="8" onFocus="this.blur();"><input name="usuanombre" type="text"	value="<?php if(!$flagnuevohorasextra){ echo $usuanombre;} else {echo $usuanombre;} ?>" size="45" onFocus="this.blur();"></td>
								</tr>
							</table>
						</div>
						<div id="cuadrilla" style="display: <?php if($asignar == 2): ?>block;<?php else: ?>none;<?php endif; ?>">
							<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
								<tr><td class="NoiseFooterTD"><div class="ui-buttonset"><button id="hrexcuadrilla">Cuadrilla</button></div></td></tr>
								<tr>
	  								<td>
	  									<input type="hidden" name="arrlsttecnicoot" id="arrlsttecnicoot" value="<?php echo $arrlsttecnicoot; ?>">
	  									<input type="hidden" name="lsttecnicoot" id="lsttecnicoot" value="<?php echo $lsttecnicoot; ?>">
										<input type="hidden" name="usualider" id="usualider" value="<?php  echo $usualider;  ?>">
	  									<div id="involucrados">
	  									<?php 
											include_once '../src/FunPerPriNiv/pktblcuadrillausuario.php';
											include_once '../src/FunPerPriNiv/pktblusuario.php';
											
											$noAjax = true;
											$iRegArray = $lsttecnicoot;
											include '../src/FunjQuery/jquery.accionextras/jquery.ajax_loadUsuaOt.php'; 
	  									?>
	  									</div> 
									</td>
								</tr>
							</table>
						</div>
  					</td> 
 				</tr> 
				<tr>
					<td>
						<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">						
							<tr>
     							<td class="NoiseFooterTD" width="20%"><?php if($campnomb["horextfecha"] == 1){ $horextfecha = null; echo "*";} ?>&nbsp;Fecha</td>
     							<td class="NoiseDataTD" colspan="3"><input type="text" name="horextfecha" id="horextfecha" size="8" onchange="calculeDiff();"></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD" width="20%"><?php if($campnomb["horexthorini"] == 1){ echo "*";} ?>&nbsp;Hora inicio</td>
								<td class="NoiseDataTD"  width="30%"><select name="horexthorini" id="horexthorini" onChange="resetHour('horexthorini','horexthorfin'); calculeDiff();">
									<option value="">-- --</option>
									<?php
										$hora = '00:00';
										for(;;):
											echo '<option value="'.$hora.'"';
											if($hora == date("H:i", strtotime($horexthorini)) && $flagnuevohorasextra)
												echo ' selected';
											echo '>'.date("h:i a", strtotime($hora)).'</option>';
											
											$hora = date("H:i", strtotime($hora.' + 30 minutes'));
											
											if($hora == '23:30')
												break;
										endfor;
									?>
								</select></td>
								<td class="NoiseFooterTD" width="20%"><?php if($campnomb["horexthorfin"] == 1){ echo "*";} ?>&nbsp;Hora fin</td>
						     	<td class="NoiseDataTD" width="30%"><select name="horexthorfin" id="horexthorfin" onChange="calculeDiff();">
						     		<option value="">-- --</option>
									<?php
										$hora = '00:30';
										for(;;):
											echo '<option value="'.$hora.'"';
											if($hora <= date("H:i", strtotime($horexthorini)) && $flagnuevohorasextra)
												echo ' disabled';
											
											if($hora == date("H:i", strtotime($horexthorfin)) && $flagnuevohorasextra)
												echo ' selected';
											echo '>'.date("h:i a", strtotime($hora)).'</option>';
											
											$hora = date("H:i", strtotime($hora.' + 30 minutes'));
											
											if($hora == '00:00')
												break;
										endfor;
									?>
								</select></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD" width="20%">&nbsp;Duraci&oacute;n</td>
								<td class="NoiseDataTD"  colspan="3"><span id="duracionhe"><?php echo $duracion ?></span><input type="hidden" value="<?php echo $duracion ?>" id="duracion" name="duracion"></td>
							</tr>
							<tr><td class="ui-state-default" colspan="4"></td></tr>							
 							<tr><td colspan="4" class="NoiseFooterTD"><?php if($campnomb["horextdescri"] == 1){ $horextdescri=null; echo "*";} ?>&nbsp;Descripci&oacute;n</td></tr>
  							<tr><td colspan="4" class="NoiseFooterTD"><textarea name="horextdescri" id="horextdescri" rows="3" cols="61" wrap="VIRTUAL"><?php if(!$flagnuevohorasextra){echo $sbreg[horextdescri];}else {echo $horextdescri;}?></textarea></td></tr>
						</table>
  					</td> 
 				</tr> 
				<tr>
					<td>
						<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center">
							<tr><td class="ui-state-default"></td></tr>
							<tr> 
								<td>
									<div>
										<div style="width:506px; height: 14px; padding: 3px; margin:0 auto;" class="ui-state-default">
											<a onClick="return verocultar('filtrahoraextraot',1);" href="javascript:animatedcollapse.toggle('filtrahoraextraot');"><img id="row1" align="middle" align="top"  src="temas/Noise/<?php if($arrheots) echo 'AscOn'; else echo 'DescOn'  ?>.gif" border="0">&nbsp;Listado de Ordenes asiganadas al empleado</a>
										</div>
										<div id="filtrahoraextraot">
											<div style="width:512px; height: 150px; margin:0 auto; overflow:auto;" class="ui-widget-content" id="filtrahoraextraot">
												<div style="width:495px; height: auto;" id="listahoraextraot">
													<?php 
														$noAjax = true;
														include '../src/FunjQuery/jquery.accionextras/jquery.ajax_loadHEot.php'; 
													?>
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
						</table>
       				</td>
       			</tr>
				<tr>
					<td>
						<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center">
							<tr><td class="ui-state-default"></td></tr>
							<tr> 
								<td>
									<div id="listaextrasusr" style="display: <?php if($asignar == 1): ?>block;<?php else: ?>none;<?php endif; ?>">
										<div style="width:512px; height: 18px; margin:0 auto;" class="ui-state-default">
											<div style="width:100%; height: auto;">
												<table width="100%" border="0" cellspacing="0" cellpadding="1" align="center">	
													<tr>
														<td width="80" class="ui-state-default estilo2">Fecha</td>
														<td width="80" class="ui-state-default estilo2">Hora inicio</td>
														<td width="80" class="ui-state-default estilo2">Hora fin</td>
														<td width="260" class="ui-state-default estilo2">Descripci&oacute;n</td>
														<td width="10" class="ui-state-default estilo2">&nbsp;</td>
													</tr>
												</table>
											</div>
										</div>
										<div style="width:512px; height: 150px; margin:0 auto; overflow:auto;" class="ui-widget-content">
											<div style="width:495px; height: auto;" id="listahoraextra">
												<?php 
													include_once '../src/FunPerPriNiv/pktblhorasextra.php'; 
													$noAjax = true;
													include '../src/FunjQuery/jquery.accionextras/jquery.ajax_loadHourExt.php'; 
												?>
											</div>
										</div>
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
			<input type="hidden" name="horextcodigo" value="<?php if(!$flagnuevohorasextra){ echo $sbreg[horextcodigo];}else{ echo $horextcodigo; } ?>"> 
			<input type="hidden" name="arrheots" id="arrheots" value="<?php echo $arrheots; ?>"> 
			<input type="hidden" name="accionnuevohorasextra">
			<input type="hidden" name="typesource" id="typesource" value="<?php echo $typesource; ?>">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="nuevo"> 	
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 
		<div id="windowhoraextra" title="Adsum Kallpa [Hora Extra]"><div id="hextmsg"></div></div>
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>