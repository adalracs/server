<?php 
ob_start(); 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include ( '../src/FunPerPriNiv/pktblestadonoveda.php'); 
	
	if($accionnuevousuanovedad)
		include ( 'grabausuanovedad.php'); 
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
				$('#usunovtecnico').button({ icons: { primary: "ui-icon-person" } }).click(function() {
					window.open('maestablusuariogen.php?negocicodigo=<?php echo $negocicodigo ?>&codigo=<?php echo $codigo?>&function=getListNovedad','','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');
					return false;
				});

				/**
				 * Window Show View Horas Extras
				 */
				$("#windowusuanovedad").dialog({
					autoOpen: false,
					width: 570,
					height: 400,
					modal: true,
					buttons: {
						"Cerrar": function() { 
							$(this).dialog("close"); 
						}
					}
				});


				var dates = $( "#usunovfecini, #usunovfecfin" ).datepicker({
					changeMonth: true,
					changeYear: true,
					numberOfMonths: 1,
					onSelect: function( selectedDate ) {
						var option = this.id == "usunovfecini" ? "minDate" : "maxDate",
							instance = $( this ).data( "datepicker" ),
							date = $.datepicker.parseDate(
								instance.settings.dateFormat ||
								$.datepicker._defaults.dateFormat,
								selectedDate, instance.settings );
						dates.not( this ).datepicker( "option", option, date );
						calculeDiff();
					}
				});
				
				
				$("#usunovfecfin").datepicker({changeMonth: true,changeYear: true});
				$("#usunovfecfin").datepicker('option', {dateFormat: 'yy-mm-dd'});
				$("#usunovfecfin").datepicker($.datepicker.regional['es']);
				<?php if($usunovfecfin && $flagnuevousuanovedad): ?>$("#usunovfecfin").datepicker("setDate", '<?php echo $usunovfecfin; ?>');<?php endif ?>
				
				$("#usunovfecini").datepicker({changeMonth: true,changeYear: true});
				$("#usunovfecini").datepicker('option', {dateFormat: 'yy-mm-dd'});
				$("#usunovfecini").datepicker($.datepicker.regional['es']);
				<?php if($usunovfecini && $flagnuevousuanovedad): ?>$("#usunovfecini").datepicker("setDate", '<?php echo $usunovfecini; ?>');<?php endif ?>
			});
			
			function getListNovedad()
			{
				accionLoadListNovedad(document.getElementById("usuacodigo").value);
				accionLoadListHEotNov('usuacodigo=' + document.getElementById("usuacodigo").value);
			}

//			function resetHour()
//			{
//				var horfin = document.getElementById('usunovhorfin');
//				var horini = document.getElementById('usunovhorini');
//
//				horfin.options[horini.selectedIndex + 1].selected = true;
//
//				
//				for(var i=1; i<horfin.length; i++)
//				{
//					if(i <= horini.selectedIndex)
//						horfin.options[i].disabled = true;
//					else
//						horfin.options[i].disabled = false;
//				} 
//			}

			function showWindow(idusuanovedad)
			{
				var param = 'usunovcodigo=' + idusuanovedad;
				accionLoadWindowView(param,'jquery.ajax_viewNovedad','usunovmsg','windowusuanovedad');
			}
		</script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Novedades</font></p> 
			<table width="650" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content">
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
								<td class="NoiseFooterTD" width="20%"><div class="ui-buttonset"><button id="usunovtecnico">Empleado</button></div></td>
								<td class="NoiseDataTD" width="80%"><?php if($campnomb["usuacodi"] == 1){ $usuacodigo = null;echo "*";}?><input id="usuacodigo" name="usuacodigo" type="text" value="<?php if(!$flagnuevousuanovedad){ echo $usuacodigo;} else {echo $usuacodigo;} ?>" size="8" onFocus="this.blur();"><input name="usuanombre" type="text"	value="<?php if(!$flagnuevousuanovedad){ echo $usuanombre;} else {echo $usuanombre;} ?>" size="45" onFocus="this.blur();"></td>
							</tr>
						</table>
  					</td> 
 				</tr> 
				<tr>
					<td>
						<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">						
							<tr>
     							<td class="NoiseFooterTD" width="20%"><?php if($campnomb["usunovfecini"] == 1 || $campnomb["usunovhorini"] == 1){ $usunovfecini = null; echo "*";} ?>&nbsp;Fecha inicio</td>
     							<td class="NoiseDataTD" width="30%">
     								<input type="text" name="usunovfecini" id="usunovfecini" size="8" onChange="calculeDiff();">
     								<select name="usunovhorini" id="usunovhorini" onChange="calculeDiff();">
										<?php
											$hora = '00:00';
											for(;;):
												echo '<option value="'.$hora.'"';
												if($hora == date("H:i", strtotime($usunovhorini)) && $flagnuevousuanovedad)
													echo ' selected';
												echo '>'.date("h:i a", strtotime($hora)).'</option>';
												
												$hora = date("H:i", strtotime($hora.' + 30 minutes'));
												
												if($hora == '23:30')
													break;
											endfor;
										?>
									</select>
     							</td>
     							<td class="NoiseFooterTD" width="20%"><?php if($campnomb["usunovfecfin"] == 1 || $campnomb["usunovhorfin"] == 1){ echo "*";} ?>&nbsp;Fecha fin</td>
     							<td class="NoiseDataTD" width="30%">
     								<input type="text" name="usunovfecfin" id="usunovfecfin" size="8" onChange="calculeDiff();">
     								<select name="usunovhorfin" id="usunovhorfin" onChange="calculeDiff();">
										<?php
											$hora = '00:00';
											for(;;):
												echo '<option value="'.$hora.'"';
												
												if($hora == date("H:i", strtotime($usunovhorfin)) && $flagnuevousuanovedad)
													echo ' selected';
												echo '>'.date("h:i a", strtotime($hora)).'</option>';
												
												$hora = date("H:i", strtotime($hora.' + 30 minutes'));
												
												if($hora == '23:30')
													break;
											endfor;
										?>
									</select>
     							</td>
							</tr>
							<tr>
								<td class="NoiseFooterTD" width="20%">&nbsp;Duraci&oacute;n</td>
								<td class="NoiseDataTD"  colspan="3"><span id="duracionhe"><?php echo $duracion ?></span><input type="hidden" value="<?php echo $duracion ?>" id="duracion" name="duracion"></td>
							</tr>
							<tr>
     							<td class="NoiseFooterTD" width="20%"><?php if($campnomb["estnovcodigo"] == 1){ echo "*";} ?>&nbsp;Novedad</td>
     							<td class="NoiseDataTD"  colspan="3"><select name="estnovcodigo" id="estnovcodigo">
									<option value = "">-- Seleccione --</option>
									<?php
										if(!$flagnuevousuanovedad)
											unset($estnovcodigo);
									
										include '../src/FunGen/floadestadonoveda.php';
									
										$idcon = fncconn();
										floadestadonoveda($estnovcodigo, $idcon);
									?>
								</select></td>
							</tr>
							<tr><td class="ui-state-default" colspan="4"></td></tr>							
 							<tr><td colspan="4" class="NoiseFooterTD"><?php if($campnomb["usunovdescri"] == 1){ $usunovdescri=null; echo "*";} ?>&nbsp;Descripci&oacute;n</td></tr>
  							<tr><td colspan="4" class="NoiseFooterTD"><textarea name="usunovdescri" id="usunovdescri" rows="3" cols="73" wrap="VIRTUAL"><?php if(!$flagnuevousuanovedad){echo $sbreg[usunovdescri];}else {echo $usunovdescri;}?></textarea></td></tr>
						</table>
  					</td> 
 				</tr>
 				<tr>
					<td>
						<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center">
							<tr><td class="ui-state-default"></td></tr>
							<tr> 
								<td>
									<div style="width:612px; height: 18px; margin:0 auto;" class="ui-state-default">
										&nbsp;<a onClick="return verocultar('filtrahoraextraot',1);" href="javascript:animatedcollapse.toggle('filtrahoraextraot');"><img id="row1" align="middle" align="top"  src="temas/Noise/<?php if($arrhecode) echo 'AscOn'; else echo 'DescOn'  ?>.gif" border="0">&nbsp;Listado de Ordenes asiganadas al empleado [Horas Extras]</a>
									</div>
									<div id="filtrahoraextraot" style="display: <?php if($arrhecode) echo "block;"; else echo "none;" ?>">
										<div style="width:612px; height: 18px; margin:0 auto;" class="ui-state-default">
											<div style="width:100%; height: auto;">
												<table width="100%" border="0" cellspacing="0" cellpadding="1" align="center">	
													<tr>
														<td width="5" class="ui-state-default estilo2">&nbsp;</td>
														<td width="30" class="ui-state-default estilo2">Sel</td>
														<td width="80" class="ui-state-default estilo2">Fecha</td>
														<td width="80" class="ui-state-default estilo2">Desde</td>
														<td width="80" class="ui-state-default estilo2">Hasta</td>
														<td width="70" class="ui-state-default estilo2">Orden #</td>
														<td width="255" class="ui-state-default estilo2">Descripci&oacute;n</td>
														<td width="10" class="ui-state-default estilo2">&nbsp;</td>
													</tr>
												</table>
											</div>
										</div>
										<div style="width:612px; height: 150px; margin:0 auto; overflow:auto;" class="ui-widget-content">
											<div style="width:595px; height: auto;" id="listahoraextraot">
												<?php 
//													include_once '../src/FunPerPriNiv/pktblusuanovedad.php'; 
													$noAjax = true;
													include '../src/FunjQuery/jquery.accionextras/jquery.ajax_loadExtrasNov.php'; 
												?>
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
									<div>
										<div style="width:612px; height: 18px; margin:0 auto;" class="ui-state-default">
											<div style="width:100%; height: auto;">
												<table width="100%" border="0" cellspacing="0" cellpadding="1" align="center">	
													<tr>
														<td width="180" class="ui-state-default estilo2">Novedad</td>
														<td width="80" class="ui-state-default estilo2">Desde</td>
														<td width="80" class="ui-state-default estilo2">Hasta</td>
														<td width="260" class="ui-state-default estilo2">Descripci&oacute;n</td>
														<td width="10" class="ui-state-default estilo2">&nbsp;</td>
													</tr>
												</table>
											</div>
										</div>
										<div style="width:612px; height: 150px; margin:0 auto; overflow:auto;" class="ui-widget-content">
											<div style="width:595px; height: auto;" id="listanovedades">
												<?php 
													include_once '../src/FunPerPriNiv/pktblusuanovedad.php'; 
													$noAjax = true;
													include '../src/FunjQuery/jquery.accionextras/jquery.ajax_loadNovedad.php'; 
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
			<input type="hidden" name="usunovcodigo" value="<?php if(!$flagnuevousuanovedad){ echo $sbreg[usunovcodigo];}else{ echo $usunovcodigo; } ?>"> 
			<input type="hidden" name="arrheots" id="arrheots" value="<?php echo $arrheots; ?>"> 
			<input type="hidden" name="accionnuevousuanovedad">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="nuevo"> 	
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 
		<div id="windowusuanovedad" title="Adsum Kallpa [Novedad]"><div id="usunovmsg"></div></div>
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>