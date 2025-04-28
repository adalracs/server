<?php 	
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include '../src/FunPerPriNiv/pktblcargo.php';
	include '../src/FunPerPriNiv/pktbldepartam.php';
	include '../src/FunGen/cargainput.php';
	
	if(!$flagdetallarhorasextra)
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
		<title>Detalle de registro de Horas Extras</title> 
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
					height: 370,
					modal: true,
					buttons: {
						"Cerrar": function() { 
							$(this).dialog("close"); 
						}
					}
				});
			});

			function showWindow(idhoraextra)
			{
				accionLoadWindowHEot(idhoraextra, 'jquery.ajax_viewHExtra');
			}
		</script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Horas extra</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="550">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr> 
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
					<td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_formdetall.php'; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr> 
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
 			<input type="hidden" name="flagdetallarhorasextra" value="1"> 
			<input type="hidden" name="acciondetallarhorasextra">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="columnas" value="usuacodigo,cargocodigo,departcodigo,usuadocume,usuanombre,usuapriape,usuasegape"> 
 			<input type="hidden" name="usuacodigo" value="<?php if($accionconsultarhorasextra) echo $usuacodigo; ?>"> 
 			<input type="hidden" name="usuanombre" value="<?php if($accionconsultarhorasextra) echo $usuanombre; ?>"> 
 			<input type="hidden" name="usuapriape" value="<?php if($accionconsultarhorasextra) echo $usuapriape; ?>"> 
 			<input type="hidden" name="usuasegape" value="<?php if($accionconsultarhorasextra) echo $usuasegape; ?>"> 
 			<input type="hidden" name="usuadocume" value="<?php if($accionconsultarhorasextra) echo $usuadocume; ?>"> 
 			<input type="hidden" name="cargocodigo" value="<?php if($accionconsultarhorasextra) echo $cargocodigo; ?>"> 
 			<input type="hidden" name="departcodigo" value="<?php if($accionconsultarhorasextra) echo $departcodigo; ?>">
 			<input type="hidden" name="accionconsultarhorasextra" value="<?php echo $accionconsultarhorasextra; ?>">
		</form>
		<div id="windowhoraextra" title="Adsum Kallpa [Hora Extra]"><div id="hextmsg"></div></div>
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>