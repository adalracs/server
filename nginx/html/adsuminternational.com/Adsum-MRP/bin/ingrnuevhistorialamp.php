<?php 

ob_start();
	include ( '../src/FunPerPriNiv/pktblestadoanalisis.php');
	include ( '../src/FunPerPriNiv/pktblmpvaranalisis.php');
	include ( '../src/FunPerPriNiv/pktbltipoitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblvaranalisis.php');
	include ( '../src/FunPerPriNiv/pktblfabricante.php');
	include ( '../src/FunPerPriNiv/pktblitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblproveedo.php');	
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktbldefecto.php');
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktbllote.php');
	include ( '../src/FunPerPriNiv/pktblcausa.php');
	include ( '../src/FunGen/cargainput.php');	
ob_end_flush();

	if($accionnuevohistorialamp){ 
		include ( 'grabanoconformemp.php'); 
		$flagnuevohistorialamp = $flagnuevonoconformemp;
	}

	if(!$flagnuevohistorialamp)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');

		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');

		$idcon = fncconn();

		$analiscodigo = $sbreg["analiscodigo"];
		$tipitemcodigo = $sbreg["tipitemcodigo"];
		$lotecodigo = $sbreg["lotecodigo"];
		$itedescodigo = $sbreg["itedescodigo"];
		$usuacodigo = $sbreg["usuacodi"];
		$analisfecha = $sbreg["analisfecha"];
		$estanacodigo = $sbreg["estanacodigo"];
		$analisdescri = $sbreg["analisdescri"];

		$rwLote = loadrecordlote($lotecodigo,$idcon);
		$rwItemdesa = loadrecorditemdesa($itedescodigo,$idcon);

		$lotenumero = $rwLote["lotenumero"];
		$proveecodigo = $rwLote["proveecodigo"];
		$fabricodigo = $rwLote["fabricodigo"];
		
		fncclose($idcon);

	}

$idcon = fncconn();

	$rwItemdesa = loadrecorditemdesa($itedescodigo,$idcon);

	$rsMpvaranalisis = dinamicscanopmpvaranalisis(array("analiscodigo" => $analiscodigo), array("analiscodigo" => "="), $idcon);
	$nrMpvaranalisis = fncnumreg($rsMpvaranalisis);

	for( $a = 0; $a < $nrMpvaranalisis; $a++){

		$rwMpvaranalisis = fncfetch($rsMpvaranalisis,$a);

		$varValor = 'txtvalor'.$rwMpvaranalisis['varanacodigo'];
		$$varValor = $rwMpvaranalisis["mpvaravalor"];

	}
?>
<html> 
	<head> 
		<title>Nuevo registro de no conforme</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jq.fncanalisismp.js"></script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">No conforme materias primas</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="650">
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
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Analisis Materia Prima</font></span></td></tr> 
  				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo ($analiscodigo)? $analiscodigo : "---" ; ?></td> 
 							</tr>
 							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Responsable</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo ($usuacodigo)? cargausuanombre($usuacodigo,$idcon) : "---" ; ?></td> 
 							</tr>
 							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Fecha</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo ($analisfecha)? $analisfecha : "---" ;?></td> 
 							</tr>
 							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Proveedor</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo ($proveecodigo)? cargaprovnombre($proveecodigo,$idcon) : "---" ;  ?></td> 
 							</tr>
 							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Fabricante</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo ($fabricodigo)? carganombrefabricante($fabricodigo,$idcon) : "---" ;  ?></td> 
 							</tr>
 							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Lote</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo ($lotenumero)? $lotenumero : "---" ;  ?></td> 
 							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Item</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo ($rwItemdesa > 0)? $rwItemdesa["itedescodigo"]. " - ".$rwItemdesa["itedesnombre"] : "---" ; ?></td> 
 							</tr>
							<tr>
								<td width="20%" width="20%" class="NoiseFooterTD">&nbsp;Estado</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo ($estanacodigo)? carganombreestado($estanacodigo,$idcon) : "---" ;?></td> 
							</tr>
							<tr>
								<td width="20%" width="20%" class="NoiseFooterTD">&nbsp;Plan de Inspecc&oacute;n</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo ($tipitemcodigo)? carganombretipoitemdesa($tipitemcodigo, $idcon) : "---" ; ?></td> 
							</tr>
							<tr>
								<td colspan="2">
 									<div class="ui-buttonset ui-state-default NoiseDataTD">&nbsp;Especificaciones&nbsp;</div>
 										<div id="filtrlistavaranalisis">
											<?php
												$flagDetallar=1;
												$noAjax = true;
												include '../src/FunjQuery/jquery.visors/jq.vanalisismp.php';  
											?>
										</div>
									</div>
 								</td>
 							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo $analisdescri; ?></td> 
 							</tr>
						</table> 
  					</td> 
 				</tr> 
 				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Generar no conforme</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr><td colspan="4" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="4" class="NoiseFooterTD"><?php if($campnomb["nocomdescri"]== 1){$nocomdescri = null; echo "*";}?>&nbsp;Descripci&oacute;n Defectos de calidad</td></tr>
							<tr><td colspan="4" rowspan="2" class="NoiseDataTD"><textarea name="nocomdescri" rows="3" cols="95"><?php echo $nocomdescri; ?></textarea></td></tr>
						</table> 
  					</td> 
 				</tr> 
 				<tr>
 					<td>
 						<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
  							<tr>
								<td>
									<div id="filuploadfile">
										<div class="ui-widget">
											<div class="ui-state-Highlight ui-corner-all" style="padding: 0 .7em;"> 
												<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span> 
													Selecciona los archivos que deseas importar</p>
											</div>
										</div>
					
										<table border="0" cellspacing="1" cellpadding="1" align="center" width="100%">
											<tr>
												<td class="ui-state-default">&nbsp;Archivos a importar  </td>
											</tr>					
											<tr>
												<td>
		       										<div style="float:left;">
														<div id="reportot_file_upload">Ocurrio un problema con el sistema!</div>
														<div id="reportot_custom-queue" class="uploadifyQueue"></div>
													</div>

													<div style="height:2px;"></div>
													<div class="ui-widget-content content">
														<div id="reportot_file_load" class="file-upname">
														<?php 
															if($uploadocumen){
																$arrUpload = explode('::', $uploadocumen);
																$arrUploadSize = explode('::', $uploadocumensize);
												
																for($a = 0; $a < count($arrUpload); $a++){
														?>
															<div class="uploadifyQueueItem completed">
																<div class="cancel">
																	<a href="javascript: void(0);" onclick="deleteFileUpload('<?php echo $a ?>');"><img border="0" src="temas/upload/cancel.png"></a>
																</div>
																<span class="fileName"><?php echo $arrUpload[$a].' ('.$arrUploadSize[$a].')' ?></span>
															</div>
														<?php												
																}
															}	
														?>
														</div>
													<input type="hidden" name="uploadocumen" id="uploadocumen" value="<?php echo $uploadocumen?>">
													<input type="hidden" name="uploadocumensize" id="uploadocumensize" value="<?php echo $uploadocumensize ?>">
													</div>
												</td>
											</tr>
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
 			<input type="hidden" name="analiscodigo" value="<?php echo $analiscodigo; ?>">
 			<input type="hidden" name="tipitemcodigo" value="<?php echo $tipitemcodigo; ?>">
 			<input type="hidden" name="lotecodigo" value="<?php echo $lotecodigo; ?>">
 			<input type="hidden" name="itedescodigo" value="<?php echo $itedescodigo; ?>">
 			<input type="hidden" name="lotenumero" value="<?php echo $lotenumero; ?>">
 			<input type="hidden" name="fabricodigo" value="<?php echo $fabricodigo; ?>">
 			<input type="hidden" name="proveecodigo" value="<?php echo $proveecodigo; ?>">
 			<input type="hidden" name="usuacodigo" value="<?php echo $usuacodigo; ?>"> 
 			<input type="hidden" name="analisfecha" value="<?php echo $analisfecha; ?>"> 
 			<input type="hidden" name="estanacodigo" value="<?php echo $estanacodigo; ?>"> 
 			<input type="hidden" name="analisdescri" value="<?php echo $analisdescri; ?>"> 
			<input type="hidden" name="accionnuevohistorialamp">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="nuevo">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>