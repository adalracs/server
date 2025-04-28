<?php 
ob_start(); 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include '../src/FunPerPriNiv/pktblcargo.php';
	include '../src/FunPerPriNiv/pktbldepartam.php';
	include '../src/FunGen/cargainput.php';
	
ob_end_flush(); 

	if(!$flageditarhorasextra)
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
		<title>Editar registro de Horas Extra</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.ui.ajax_accionextras.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript"> 
			$(function(){
				/**
				 * Window Show View Horas Extras
				 */
				$("#windowhoraextra").dialog({
					autoOpen: false,
					width: 570,
					height: 440,
					modal: true,
					buttons: {
						"Cancelar": function() { 
							$(this).dialog("close"); 
						},
						"Grabar": function() { 
							showSaveHoraExtra();
							$(this).dialog("close"); 
						}
					}
				});
				
				$("#horextfecha").datepicker({changeMonth: true,changeYear: true});
				$("#horextfecha").datepicker('option', {dateFormat: 'yy-mm-dd'});
				$("#horextfecha").datepicker($.datepicker.regional['es']);
			});
			
			function getListHE()
			{
				accionLoadListHE(document.getElementById("usuacodigo").value);
				accionLoadListHEot(document.getElementById("usuacodigo").value);
			}
	
			function showWindow(idhoraextra, strDate)
			{
				$("#horextfecha").datepicker("setDate", strDate);
				accionLoadWindowHEot(idhoraextra, 'jquery.ajax_editHExtra');
			}
			
			function showReloadList()
			{
				accionReLoadListHE(document.getElementById('usuacodigo').value);
			}
			
			function showSaveHoraExtra()
			{
				var vhorextcodigo = document.getElementById('horextcodigo').value; 
				var vusuacodi = document.getElementById('usuacodigo').value; 
				var vhorextfecha = document.getElementById('horextfecha').value; 
				var vhorexthorini = document.getElementById('horexthorini').value; 
				var vhorexthorfin = document.getElementById('horexthorfin').value; 
				var vhorextdescri = document.getElementById('horextdescri').value;
				
				var strsave = "horextcodigo=" + vhorextcodigo + "&usuacodigo=" + vusuacodi + "&horextfecha=" + vhorextfecha + "&horexthorini=" + vhorexthorini + "&horexthorfin=" + vhorexthorfin + "&horextdescri=" + vhorextdescri; 
				strsave = strsave + "&arrheots=" + document.getElementById('arrheots').value;
				
				accionEditDataHE(strsave, document.getElementById('usuacodigo').value);
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
			<p><font class="NoiseFormHeaderFont">Horas extra</font></p> 
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
										<div style="width:512px; height: 20px; margin:0 auto;" class="ui-state-default">
											<div style="width:100%; height: auto;">
												<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">	
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
													$usuacodigo = $sbreg['usuacodi'];
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
			<input type="hidden" name="accioneditarhorasextra"> 
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="editar"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form>
		<div id="windowhoraextra" title="Adsum Kallpa [Hora Extra]">
			<div id="hextmsgs">
				<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">						
					<tr>
     					<td class="NoiseFooterTD" width="20%">&nbsp;Fecha</td>
     					<td class="NoiseDataTD" colspan="3"><input type="text" name="horextfecha" id="horextfecha" size="12" onchange="calculeDiff();"></td>
					</tr>
				</table>
			</div>
			<div id="hextmsg"></div>
		</div> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>