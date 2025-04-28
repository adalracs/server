<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include '../src/FunPerPriNiv/pktblcargo.php';
	include '../src/FunPerPriNiv/pktbldepartam.php';
	include '../src/FunGen/cargainput.php';
	
	if(!$flagborrarhorasextra)
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton); 
	
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');
			
		$idcon = fncconn();
	} 
?>
<html> 
	<head> 
		<title>Borrar de registro de Horas Extra</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.ui.ajax_accionextras.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript">
			$(function(){
				/**
				 * Window Show MSG
				 */
				$("#msgwindowhe").dialog({
					autoOpen: false,
					width: 300,
					height: 150,
					modal: true,
					buttons: {
						"No": function() { 
							$(this).dialog("close"); 
						},
						"Si": function() { 
							$(this).dialog("close");
							document.getElementsByName('accion' + document.form1.sourceaction.value + document.form1.sourcetable.value)[0].value = 1;
							if(document.form1.sourceaction.value == 'consultar' || document.form1.sourceaction.value == 'detallar' || document.form1.sourceaction.value == 'borrar')
								document.form1.action = 'maestabl' + document.form1.sourcetable.value + '.php';
							
							document.form1.submit();
						}
					}
				});
				
				/**
				 * Boton Aceptar
				 */
				$('#aceptarhe').button({ icons: { primary: "ui-icon-circle-check" } }).click(function() {
					if(document.getElementById('arrhecode').value == '')
					{
						document.getElementById('msg2').innerHTML = 'Debe seleccionar los registros que desea eliminar.'
						$('#msgwindow').dialog('open');
					}
					else
					{
						document.getElementById('msg').innerHTML = 'Esta seguro que desea eliminar los registros seleccionados?'
						$('#msgwindowhe').dialog('open');
					}
					
					return false;
				});
			});
		
		</script>
		
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Horas extra</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="650">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Borrar registro</font></span></td></tr> 
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
														<td width="30" class="ui-state-default estilo2">Sel</td>
														<td width="80" class="ui-state-default estilo2">Fecha</td>
														<td width="80" class="ui-state-default estilo2">Hora inicio</td>
														<td width="80" class="ui-state-default estilo2">Hora fin</td>
														<td width="260" class="ui-state-default estilo2">Descripci&oacute;n</td>
														<td width="10" class="ui-state-default estilo2">&nbsp;</td>
													</tr>
												</table>
											</div>
										</div>
										<div style="width:612px; height: 150px; margin:0 auto; overflow:auto;" class="ui-widget-content">
											<div style="width:595px; height: auto;" id="listahoraextra">
												<?php 
													$usuacodigo = $sbreg['usuacodi'];
													include_once '../src/FunPerPriNiv/pktblhorasextra.php'; 
													$noAjax = true;
													include '../src/FunjQuery/jquery.accionextras/jquery.ajax_delHExtra.php'; 
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
							<button id="aceptarhe">Aceptar</button>&nbsp;&nbsp;&nbsp;&nbsp;
							<button id="cancelar">Cancelar</button>
						</div>
					</td>
				</tr>
				<tr><td>&nbsp;</td></tr> 
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
			<input type="hidden" name="usuacodigo" value="<?php echo $sbreg[usuacodi]; ?>">
			<input type="hidden" name="arrhecode" id="arrhecode" value="<?php echo $arrhecode; ?>">
 			<input type="hidden" name="flagborrarhorasextra" value="1"> 
			<input type="hidden" name="accionborrarhorasextra">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="borrar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 
		<div id="msgwindowhe" title="Adsum Kallpa"><span id="msg"></span></div>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg2"></span></div>
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>