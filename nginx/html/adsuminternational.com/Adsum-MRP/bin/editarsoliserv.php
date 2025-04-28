<?php 
ob_start();
	include ('../src/FunGen/floadsoliservplantasistemequipo.php');
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblsistema.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktbltipofall.php');
	include ( '../src/FunPerPriNiv/pktbltipotrab.php');
	include ( '../src/FunPerPriNiv/pktblsoliservestado.php');
	include ( '../src/FunGen/cargainput.php');
	include('validasesion.php');
	
	if($accioneditarsoliserv) 
		include ( 'editasoliserv.php');

ob_end_flush();

	if(!$flageditarsoliserv)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');
		$estsolcodigo = $sbreg['estsolcodigo'];
		$solsercodigo = $sbreg['solsercodigo']; 
		$solserfecha = $sbreg['solserfecha']; 
		$plantacodigo = $sbreg['plantacodigo']; 
		$sistemcodigo = $sbreg['sistemcodigo']; 
		$equipocodigo = $sbreg['equipocodigo']; 
		$componcodigo = $sbreg['componcodigo']; 
		$tipfalcodigo = $sbreg['tipfalcodigo']; 
		$tiptracodigo = $sbreg['tiptracodigo']; 
		$solsermotivo = $sbreg['solsermotivo']; 
		$usuacodigo = $sbreg['usuacodi']; 
	}
	$idcon = fncconn();
	$rsValidasesion = validasesion($GLOBALS['usuacodi'], 352, $idcon);
?> 
<html> 
	<head> 
    	<title>Editar registro de solicitud de servicio</title> 
    	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
    	<meta http-equiv="expires" content="0">
    	<?php include('../def/jquery.library_maestro.php');?>
    	<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
  		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_ot.js"></script>
    	<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js"		type="text/javascript" ></SCRIPT>
		<script language=JavaScript src="../src/FunGen/cargarSistema.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/cargarEquipos.js" type="text/javascript" ></script>
		<script type="text/javascript">
			$(function(){
				<?php if($rsValidasesion > 0): ?>
				$('#generaot').button({ icons: { primary: "ui-icon-note" } }).click(function() {
					document.form1.accionnuevosoliot.value = 1; 
					document.form1.action='ingrnuevsoliot.php';
					document.form1.submit();
					return false;
				});
				<?php endif; ?>
			});
		</script>
  </head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Solicitud de servicio</font></p> 
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
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
							<tr class="ui-widget-header">
								<td width="50%" class="cont-title">&nbsp;Solicitud de servicio No.&nbsp;<?php echo $solsercodigo; ?></td>
								<td width="50%" class="cont-title">&nbsp;Fecha.&nbsp;<?php echo $solserfecha ?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center"  class="ui-widget-content">
							<tr class="ui-state-default"><td class="cont-title">&nbsp;Datos de la solicitud</td></tr>
						</table>
						<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
							<tr>
								<td class="NoiseFooterTD" width="15%">&nbsp;Ubicaci&oacute;n</td>
								<td class="NoiseDataTD"><?php echo cargaplantanombre($plantacodigo, $idcon); ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Proceso</td>
								<td class="NoiseDataTD"><?php echo cargasistemnombre($sistemcodigo, $idcon); ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Equipo</td>
								<td class="NoiseDataTD"><?php echo cargaequiponombre($equipocodigo, $idcon); ?></td>
							</tr>
							<tr><td class="ui-state-default" colspan="2"></td></tr>
							<tr>
  								<td class="ui-state-default" colspan="2">&nbsp;<a onClick="return verocultar('filtrdatosequipo',0);" href="javascript:animatedcollapse.toggle('filtrdatosequipo');"><img id="row0" align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0">&nbsp;Datos del equipo</a>
									<div id="filtrdatosequipo" style="padding: 2px 2px 2px 2px; display:none" >
				        				<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
				                   			<tr>
			                   					<td height="190"  class="ui-widget-content"><iframe  frameborder="0" name="detalleotequipo" id="detalleotequipo"  height="190" width="100%" align="absmiddle" src="detallarotequipo.php?equipocodigo=<?php  echo $equipocodigo; ?>&usuaplanta=<?php echo $GLOBALS['usuaplanta'];  ?>"></iframe></td>
				                   			</tr>
				                   		</table>
				                   	</div> 
								</td>
							</tr>
							<?php if($sbreg['componcodigo']): ?>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Componente</td>
								<td class="NoiseDataTD"><?php echo cargacomponnombre($componcodigo, $idcon); ?></td>
							</tr>
							<tr>
  								<td class="ui-state-default" colspan="2">&nbsp;<a onClick="return verocultar('filtrdatoscomponen',1);" href="javascript:animatedcollapse.toggle('filtrdatoscomponen');"><img id="row1" align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0">&nbsp;Datos del componente</a>
									<div id="filtrdatoscomponen" style="padding: 2px 2px 2px 2px; display:none" >
				        				<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
				                   			<tr>
			                   					<td height="190"  class="ui-widget-content"><iframe  frameborder="0" name="detalleotcomponen" id="detalleotcomponen"  height="190" width="100%" align="absmiddle" src="detallarotcomponen.php?componcodigo=<?php echo $componcodigo; ?>&equipocodigo=<?php echo $equipocodigo; ?>&usuaplanta=<?php echo $GLOBALS['usuaplanta'];  ?>"></iframe></td>
				                   			</tr>
				                   		</table>
				                   	</div> 
								</td>
							</tr>
							<?php endif ?>
							<tr><td class="ui-state-default" colspan="2"></td></tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Solicitante</td>
								<td class="NoiseDataTD"><?php echo cargausuanombre($usuacodigo, $idcon); ?></td>
							</tr>
						</table>
						<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
							<tr>
								<td class="NoiseFooterTD" width="15%">&nbsp;Tipo de trabajo</td>
								<td class="NoiseDataTD"><?php echo cargatiptrabnombre($tiptracodigo, $idcon); ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD" width="15%">&nbsp;Tipo de falla</td>
								<td class="NoiseDataTD"><?php echo cargatipfalnombre($tipfalcodigo, $idcon); ?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td width="15%" class="NoiseFooterTD"><?php if($campnomb["tiptracodigo"] == 1){$tiptracodigo = null; echo "*";}?>&nbsp;Tipo trabajo</td>
								<td width="85%" class="NoiseDataTD"><select name="tiptracodigo">
									<option value="">-- Seleccione --</option>
									<?php
										include ('../src/FunGen/floadtipotrab.php');
										floadtipotrab($tiptracodigo,$idcon);
									?>
								</select></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
							<tr>
								<td class="ui-state-default" width="30%">Usuario</td>
								<td class="ui-state-default" width="18%">Fecha</td>
								<td class="ui-state-default" width="52%">Motivo / Aclaraci&oacute;n</td>
							</tr>
							<?php 
								$texto = split("::", $solsermotivo);
								for($i = 0; $i < count($texto); $i++):
									if(trim($texto[$i])):
										$texto1 = split("--", $texto[$i]);
							?>
							<tr>
								<td class="NoiseDataTD row-soliserv">&nbsp;<?php echo $texto1[0] ?></td>
								<td class="NoiseDataTD row-soliserv">&nbsp;<?php echo date("Y-m-d h:i a", strtotime($texto1[1].' '.$texto1[2])) ?></td>
								<td class="NoiseDataTD row-soliserv">&nbsp;<?php echo $texto1[3] ?></td>
							</tr>
							<?php
									endif; 
								endfor; ?>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td width="15%" class="NoiseFooterTD">&nbsp;<?php if($campnomb["estsolcodigo"] == 1){ $estsolcodigo = null; echo "*";}?>Estado</td>
	  			   				<td class="NoiseDataTD"><select name="estsolcodigo">
	     			   				<?php
	     			     				include ('../src/FunGen/floadsoliservestado.php');
					     			     floadsoliservestadoexest($idcon, $estsolcodigo);
					   				?>
	   			     			</select></td>
 		     				</tr>
							<tr><td class="ui-state-default" colspan="2"></td></tr>
							<tr><td class="NoiseFooterTD" colspan="2"><?php if($campnomb["solsermotivo"] == 1){$solsermotivo1 = null; echo "*";} ?>&nbsp;Aclaraci&oacute;n</td></tr>
							<tr><td class="NoiseDataTD" colspan="2"><textarea name="solsermotivo1" cols="86" rows="2" wrap="VIRTUAL"><?php echo $solsermotivo1; ?></textarea></td></tr>
						</table>
					</td>
				</tr>
    			<tr><td>&nbsp;</td></tr>
    			<tr>
					<td class="NoiseErrorDataTD" align="center"><div class="ui-buttonset">
						<button id="aceptar">Aceptar</button>&nbsp;&nbsp;&nbsp;&nbsp;
						<button id="cancelar">Cancelar</button>
    		  			<?php if($rsValidasesion > 0): ?>&nbsp;&nbsp;&nbsp;&nbsp;<button id="generaot">Generar OT</button><?php endif; ?>
					</div></td>
				</tr>
				<tr><td>&nbsp;</td></tr>
     		</table> 
     		<input type="hidden" name="accionnuevosoliot">
     		<input type="hidden" name="accioneditarsoliserv">
   			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="editar">
     		<input type="hidden" name="solsercodigo" value="<?php echo $solsercodigo; ?>"> 
     		<input type="hidden" name="solserfecha" value="<?php echo $solserfecha; ?>"> 
     		<input type="hidden" name="plantacodigo" value="<?php echo $plantacodigo; ?>"> 
     		<input type="hidden" name="sistemcodigo" value="<?php echo $sistemcodigo; ?>"> 
     		<input type="hidden" name="equipocodigo" value="<?php echo $equipocodigo; ?>">
     		<input type="hidden" name="componcodigo" value="<?php echo $componcodigo; ?>">
     		<input type="hidden" name="tipfalcodigo" value="<?php echo $tipfalcodigo; ?>">
     		<input type="hidden" name="solsermotivo" value="<?php echo $solsermotivo; ?>">
     		<input type="hidden" name="usuacodigo" value="<?php echo $usuacodigo; ?>">
     		<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
   		</form> 
 	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>