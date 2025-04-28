<?php 

ob_start();
	include ( '../src/FunPerPriNiv/pktbldocumentnoconformemp.php');
	include ( '../src/FunPerPriNiv/pktblestadoanalisis.php');
	include ( '../src/FunPerPriNiv/pktblmpvaranalisis.php');
	include ( '../src/FunPerPriNiv/pktbltipoitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblvaranalisis.php');
	include ( '../src/FunPerPriNiv/pktblanalisismp.php');
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

	if(!$flagdetallarnocomformemp)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');

		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');

		$idcon = fncconn();

		$nocomcodigo = $sbreg["nocomcodigo"];
		$analiscodigo = $sbreg["analiscodigo"];
		$usuacodi1 = $sbreg["usuacodi1"];
		$usuacodi2 = $sbreg["usuacodi2"];
		$nocomfecha = $sbreg["nocomfecha"];
		$nocomhora = $sbreg["nocomhora"];
		$nocomdescri = $sbreg["nocomdescri"];

		$rwAnalisisMp = loadrecordanalisismp($analiscodigo,$idcon);

		$tipitemcodigo = $rwAnalisisMp["tipitemcodigo"];
		$lotecodigo = $rwAnalisisMp["lotecodigo"];
		$itedescodigo = $rwAnalisisMp["itedescodigo"];
		$usuacodigo = $rwAnalisisMp["usuacodi"];
		$analisfecha = $rwAnalisisMp["analisfecha"];
		$estanacodigo = $rwAnalisisMp["estanacodigo"];
		$analisdescri = $rwAnalisisMp["analisdescri"];

		$rwItemdesa = loadrecorditemdesa($itedescodigo,$idcon);

		$rsMpvaranalisis = dinamicscanopmpvaranalisis(array("analiscodigo" => $analiscodigo), array("analiscodigo" => "="), $idcon);
		$nrMpvaranalisis = fncnumreg($rsMpvaranalisis);

		for( $a = 0; $a < $nrMpvaranalisis; $a++){

			$rwMpvaranalisis = fncfetch($rsMpvaranalisis,$a);

			$varValor = 'txtvalor'.$rwMpvaranalisis['varanacodigo'];
			$$varValor = $rwMpvaranalisis["mpvaravalor"];

		}

		$rsdocumentnoconformemp = dinamicscanopdocumentnoconformemp(array("nocomcodigo" => $nocomcodigo),array("nocomcodigo" => "="),$idcon);
		$nrdocumentnoconformemp = fncnumreg($rsdocumentnoconformemp);

		for( $a = 0; $a < $nrdocumentnoconformemp; $a++){

			$rwdocumentnoconformemp = fncfetch($rsdocumentnoconformemp,$a);

			$uploadocumen = ($uploadocumen)? $uploadocumen."::".$rwdocumentnoconformemp["uploadocumen"] : $rwdocumentnoconformemp["uploadocumen"] ;
			$uploadocumensize = ($uploadocumensize)? $uploadocumensize."::".$rwdocumentnoconformemp["uploadocumensize"] : $rwdocumentnoconformemp["uploadocumensize"] ;
		}


		$rwLote = loadrecordlote($lotecodigo,$idcon);
		$rwItemdesa = loadrecorditemdesa($itedescodigo,$idcon);

		$lotenumero = $rwLote["lotenumero"];
		$proveecodigo = $rwLote["proveecodigo"];
		$fabricodigo = $rwLote["fabricodigo"];
		
		fncclose($idcon);

	}

$idcon = fncconn();
?>
<html> 
	<head> 
		<title>Editar registro de analisis de materias primas</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript">
			$(function(){
				$('#imprimir').button({ icons: { primary: "ui-icon-document" } }).click(function() {
					window.open('imprimirnoconformeamp.php?codigo=<?php echo $nocomcodigo; ?>','impresion','status=no,menubar=no,scrollbars=yes,resizable=yes,width=880,height=650');
					location ="maestablnoconformemp.php?codigo=<?php echo $codigo; ?>;"
					return false;
				});
			});
		</script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont"> No conforme materias primas</font></p> 
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
            				<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo ($nocomcodigo)? $nocomcodigo : "---" ; ?></td> 
 							</tr>
							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Descripci&oacute;n Defectos de calidad</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><?php echo $nocomdescri; ?></td></tr>
						</table> 
  					</td> 
 				</tr> 
 				<tr>
 					<td>
 						<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
      						<tr>
      							<td>
      								<div id="filuploadfile">
										<table border="0" cellspacing="1" cellpadding="1" align="center" width="100%">
											<tr><td class="ui-state-default">&nbsp;Documentos </td></tr>					
											<tr>
												<td>
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
																	<a href="javascript: void(0);" onclick="window.open('http://75.98.171.118/plasticel/doc/upload/noconforme/<?php echo $arrUpload[$a] ?>','impresion','status=no,menubar=no,scrollbars=yes,resizable=yes,width=880,height=650');">Detallar</a>
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
					<td class="NoiseErrorDataTD" align="center"><?php $imprimir=1;include '../def/jquery.button_formdetall.php'; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
			</table> 
			<input type="hidden" name="acciondetallarnoconformemp">
			<input type="hidden" name="flagdetallarnoconformemp" value="1">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">  
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>