<?php 
ob_start(); 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include '../src/FunPerPriNiv/pktblcargo.php';
	include '../src/FunPerPriNiv/pktbldepartam.php';
	include '../src/FunPerPriNiv/pktblestadonoveda.php';
	include '../src/FunGen/cargainput.php';
	
ob_end_flush(); 

	if(!$flageditarusuanovedad)
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton); 
		if (!$sbreg) 
			include( '../src/FunGen/fnccontfron.php');
	} 
	$idcon = fncconn();
?>
<html> 
	<head> 
		<title>Editar registro de Novedades por Empleado</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.ui.ajax_accionextras.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript"> 
			$(function(){
				/**
				 * Window Show View Novedad
				 */
				$("#windowusuanovedad").dialog({
					autoOpen: false,
					width: 670,
					height: 480,
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
									showSaveNovedad();
									$(this).dialog("close"); 
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
				
				$("#usunovfecfin").datepicker({changeMonth: true,changeYear: true, onSelect: function(selectedDate){ calculeDiff(); }});
				$("#usunovfecfin").datepicker('option', {dateFormat: 'yy-mm-dd'});
				$("#usunovfecfin").datepicker($.datepicker.regional['es']);
				
				$("#usunovfecini").datepicker({changeMonth: true,changeYear: true, onSelect: function(selectedDate){ calculeDiff(); } });
				$("#usunovfecini").datepicker('option', {dateFormat: 'yy-mm-dd'});
				$("#usunovfecini").datepicker($.datepicker.regional['es']);
			});
			
//			function resetHour()
//			{
//				var horfin = document.getElementById('horexthorfin');
//				var horini = document.getElementById('horexthorini');
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
	
			function showWindow(idusuanovedad, strDatefrom, strDateto, strTimefrom, strTimeto)
			{
				$("#usunovfecini").datepicker("setDate", strDatefrom);
				$("#usunovfecfin").datepicker("setDate", strDateto);
				selectObjList('usunovhorini', strTimefrom);
				selectObjList('usunovhorfin', strTimeto);

				var param = 'usunovcodigo=' + idusuanovedad + '&usuacodigo=' + document.getElementById('usuacodigo').value;
				accionLoadWindowView(param,'jquery.ajax_editNovedad','usuanovmsg','windowusuanovedad');
			}
			
			function showReloadList()
			{
				accionLoadListNovedad(document.getElementById("usuacodigo").value);
			}
			
			function showSaveNovedad()
			{
				var vusunovcodigo = document.getElementById('usunovcodigo').value; 
				var vestnovcodigo = document.getElementById('estnovcodigo').value; 
				var vusuacodi = document.getElementById('usuacodigo').value; 
				var vusunovfecini = document.getElementById('usunovfecini').value; 
				var vusunovfecfin = document.getElementById('usunovfecfin').value; 
				var vusunovhorini = document.getElementById('usunovhorini').value; 
				var vusunovhorfin = document.getElementById('usunovhorfin').value; 
				var vusunovdescri = document.getElementById('usunovdescri').value;
				var varrhecode = document.getElementById('arrhecode').value;
				
				var strsave = "usunovcodigo=" + vusunovcodigo + "&usuacodigo=" + vusuacodi + "&estnovcodigo=" + vestnovcodigo + "&usunovfecini=" + vusunovfecini + "&usunovfecfin=" + vusunovfecfin + "&usunovdescri=" + vusunovdescri; 
				strsave+= "&usunovhorini=" + vusunovhorini + "&usunovhorfin=" + vusunovhorfin + "&arrhecode=" + varrhecode; 
				accionEditDataNovedad(strsave);
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
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Editar registro</font></span></td></tr>
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr> 
 								<td width="22%" class="NoiseFooterTD">&nbsp;Registro</td> 
  								<td width="78%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[usuacodi]; ?></td> 
 							</tr> 
							<tr> 
 								<td width="22%" class="NoiseFooterTD">&nbsp;C&eacute;dula</td> 
  								<td width="78%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[usuadocume]; ?></td> 
 							</tr> 
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Nombre</td> 
  								<td class="NoiseDataTD">&nbsp;<?php echo $sbreg[usuanombre].' '.$sbreg[usuapriape].' '.$sbreg[usuasegape]; ?></td> 
 							</tr> 
							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Cargo</td>
								<td class="NoiseDataTD">&nbsp;<?php echo cargacargonombre($sbreg['cargocodigo'], $idcon); ?></td> 
 							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Departamento</td>
								<td class="NoiseDataTD">&nbsp;<?php echo cargadepartnombre($sbreg['departcodigo'], $idcon); ?></td> 
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
										<div style="width:612px; height: 20px; margin:0 auto;" class="ui-state-default">
											<div style="width:100%; height: auto;">
												<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">	
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
													$usuacodigo = $sbreg['usuacodi'];
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
					<td class="NoiseErrorDataTD" align="center">
						<div class="ui-buttonset">
							<button id="cancelar">Salir</button>
						</div>
					</td>
				</tr>
				<tr><td>&nbsp;</td></tr> 
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
			</table> 
			<input type="hidden" name="usuacodigo" id="usuacodigo" value="<?php echo $sbreg[usuacodi]; ?>"> 
			<input type="hidden" name="accioneditarusuanovedad"> 
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="editar"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
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
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg2"></span></div>
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>