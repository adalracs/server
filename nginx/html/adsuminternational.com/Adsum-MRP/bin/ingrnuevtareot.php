<?php
	ob_start ();
	session_start ();
	//ext 2917 - 6901010 molano /plasticel
	include ('../src/FunGen/sesion/fncvalses.php');
	include ('../src/FunPerPriNiv/pktblusuario.php');
	include ('../src/FunPerPriNiv/pktblot.php');
	include ('../src/FunPerPriNiv/pktblplanta.php');
	include ('../src/FunPerPriNiv/pktblequipo.php');
	include ('../src/FunPerPriNiv/pktblsistema.php');
	include ('../src/FunPerPriNiv/pktblcomponen.php');
	include ('../src/FunPerPriNiv/pktbltipomant.php');
	include ('../src/FunPerPriNiv/pktblotestado.php');
	include ('../src/FunPerPriNiv/pktblpriorida.php');
	include ('../src/FunPerPriNiv/pktbltipotrab.php');
	include ('../src/FunPerPriNiv/pktbltipocump.php');
	include ('../src/FunPerPriNiv/pktbltarea.php');
	include ('../src/FunPerPriNiv/pktbldocumenot.php');
	include ('../src/FunGen/cargainput.php');
	include ('../src/FunGen/floadtimehours.php');
	include ('../src/FunGen/floadtimeminut.php');
	
	if($accionnuevotareot)
		include ('grabatareot.php');
		
	if($radiobutton)
		$ordtracodigo = str_replace ( "|n,", "", $radiobutton ); //Registro seleccionado

	$idcon = fncconn ();
	$usuacodic = $usuacodi;
	
	if ($ordtracodigo) {

		$sbregot = loadrecordot($ordtracodigo, $idcon);
	
		if ($sbregot < 0)
			$err = "No se encontro la orden de trabajo";
		else 
		{
			include_once ('../src/FunPerPriNiv/pktbltareot.php');
			include_once ('../src/FunPerPriNiv/pktblusuariotareot.php');
			
			$sbregtareot = loadrecordmaxtareot2($sbregot['ordtracodigo'], $idcon);
		
			if ($sbregtareot > 0) 
			{
				$otestacodigo = $sbregtareot["otestacodigo"];
				
				$iRecordusertareot['tareotcodigo'] = $sbregtareot['tareotcodigo'];
				$rs_usuariotareot = dinamicscanusuariotareot($iRecordusertareot, $idcon);
			
				if ($rs_usuariotareot > 0) 
				{
					$nr_usuariotareot = fncnumreg($rs_usuariotareot);
					
					if ($nr_usuariotareot > 0) 
					{
						for($i = 0; $i < $nr_usuariotareot; $i++) 
						{
							$rw_usuariotareot = fncfetch($rs_usuariotareot, $i);
						
							if ($rw_usuariotareot[3] == 't')
							{
								$user_encargado = $rw_usuariotareot[1]." - ".cargausuanombre($rw_usuariotareot[1], $idcon);
								$lider = $rw_usuariotareot[1];
							}
							else 
							{
								$user_aux[] = $rw_usuariotareot[1]." - ".cargausuanombre($rw_usuariotareot[1], $idcon);

								if(!$arreglo_tecnic)
									$arreglo_tecnic = $rw_usuariotareot[1];
								else
									$arreglo_tecnic .= ','.$rw_usuariotareot[1];
							}
						}
					}
				}
			}
		}

		$rsDocumentot = dinamicscanopdocumenot(array("ordtracodigo" => $ordtracodigo), array("ordtracodigo" => "="), $idcon);
		$nrDocumentot = fncnumreg($rsDocumentot);

		for($a = 0; $a < $nrDocumentot; $a++){

			$rwDocumentot = fncfetch($rsDocumentot, $a);

			if($rwDocumentot["docuotnombre"] && $rwDocumentot["docuottamano"]){

				$uploadocumen = ($uploadocumen)? $uploadocumen."::".$rwDocumentot["docuotnombre"] : $rwDocumentot["docuotnombre"];
				$uploadocumensize = ($uploadocumensize)? $uploadocumensize."::".$rwDocumentot["docuottamano"] : $rwDocumentot["docuottamano"];
			}

		}

	}
?>
<html>
	<head>
		<title>Nueva gestion de orden de trabajo</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript">

			$(document).ready(function() {

				$("#gestionot_file_upload").uploadify({
					'uploader': 'temas/upload/uploadify.swf',
					'cancelImg': 'temas/upload/cancel.png',
					'script': 'uploadify.php',
					'folder': '/doc/upload/gestionot/',
					'buttonImg': 'temas/upload/button_onload.png',
					'multi' : false,
					'auto' : true,
					'fileExt' : '*.doc;*.docx;*.pdf;*.jpeg;*.bmp;*.jpg;*.gif;*.png;*.txt;*.msg;*.xls;*.xlsx;',
					'fileDesc' : 'All Files (.doc, .docx, .pdf, .jpeg, .bmp, .jpg, .gif, .png, .txt, .msg, .xls, .xlsx)',
					'queueID' : 'gestionot_custom-queue',
					'queueSizeLimit' : 3,
					'simUploadLimit' : 3,
					'removeCompleted': true,
					'onComplete' : function(event, ID, fileObj, response, data) {			
						var file = document.getElementById('uploadocumen');
						var filesize = document.getElementById('uploadocumensize');
						var l = Math.round(fileObj.size/1024*100)*0.01;
						var m = " Kb";

						if(l > 1000)
						{
							l = Math.round(l*0.001*100)*0.01;
							m = " Mb";
						}

						if(file.value != '')
						{
							file.value = file.value + '::' + fileObj.name;
							filesize.value = filesize.value + '::' + l + m;
						}
						else
						{
							file.value = fileObj.name;
							filesize.value = l + m;
						}

						loadHTMLUpload();
					}
				});

				function loadHTMLUpload(codeot){

					if(document.getElementById('uploadocumen').value != '')
					{
						var file = document.getElementById('uploadocumen').value.split('::');
						var filesize = document.getElementById('uploadocumensize').value.split('::');
						var session = '';

						
						for(var i=0; i < file.length; i++)
							session += '<div class="uploadifyQueueItem completed"><div class="cancel"><a href="javascript: void(0);" onclick="deleteFileUpload(' + i + ');"><img border="0" src="temas/upload/cancel.png"></a></div><span class="fileName">' + file[i] + ' (' + filesize[i] + ')</span></div>';

						document.getElementById('gestionot_file_load').innerHTML = session;
					}
					else
					{
						document.getElementById('gestionot_file_load').innerHTML = '';
					}
				}

				function deleteFileUpload(index){

					var file = document.getElementById('uploadocumen').value.split('::');
					var filesize = document.getElementById('uploadocumensize').value.split('::');
					
					accionDeleteFileNormal('../doc/upload/gestionot/' + file[index]);

					document.getElementById('uploadocumen').value = '';
					document.getElementById('uploadocumensize').value = '';
					
					for(var i=0; i < file.length; i++)
					{
						if(i != index)
						{
							if(document.getElementById('uploadocumen').value != '')
							{
								document.getElementById('uploadocumen').value = document.getElementById('uploadocumen').value + '::' + file[i];
								document.getElementById('uploadocumensize').value = document.getElementById('uploadocumensize').value + '::' + filesize[i];
							}
							else
							{
								document.getElementById('uploadocumen').value = file[i];
								document.getElementById('uploadocumensize').value = filesize[i];
							}
						}
					}

					loadHTMLUpload();
				}


			});


		</script>	
	</head>
	
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Gesti&oacute;n orden de trabajo</font></p> 
			<table width="750" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content">
<?php if($campnomb || $err): ?>
				<tr><td><div class="ui-widget">
					<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
						<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
						<strong>Advertencia:</strong> <?php if($err): echo $err; else: ?> Corrija los campos marcados con *<?php endif; ?></p>
					</div>
				</div></td></tr>
<?php else: ?> 		
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
<?php endif; ?>
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Nueva gesti&oacute;n</font></span></td></tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
							<tr class="ui-widget-header">
								<td width="50%" class="cont-title">&nbsp;Orden de trabajo No.&nbsp;<?php if (!$flagnuevotareot){ echo $sbregot [ordtracodigo]; } else{ echo $ordtracodigo; } ?></td>
								<td width="50%" class="cont-title">&nbsp;Generado.&nbsp;<?php if($sbregot['ordtrafecgen']) echo $sbregot['ordtrafecgen']." " .date("h:i a", strtotime($sbregot['ordtrahorgen'])) ?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center"  class="ui-widget-content">
							<tr class="ui-state-default"><td class="cont-title">&nbsp;Datos de la orden</td></tr>
						</table>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td class="NoiseFooterTD">&nbsp;Ubicaci&oacute;n</td>
								<td colspan="3" class="NoiseDataTD"><?php echo cargaplantanombre($sbregot['plantacodigo'], $idcon); ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Sistema</td>
								<td colspan="3" class="NoiseDataTD"><?php echo cargasistemnombre($sbregot['sistemcodigo'], $idcon); ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Equipo</td>
								<td colspan="3" class="NoiseDataTD"><?php echo cargaequiponombre($sbregot['equipocodigo'], $idcon); ?></td>
							</tr>
							<?php if($sbregot['componcodigo']): ?>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Componente</td>
								<td colspan="3" class="NoiseDataTD"><?php echo cargacomponnombre($sbregot['componcodigo'], $idcon); ?></td>
							</tr>
							<?php endif ?>
							<tr><td class="ui-state-default" colspan="4"></td></tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Prioridad</td>
								<td colspan="3" class="NoiseDataTD"><?php echo cargapriorinombre($sbregtareot['prioricodigo'], $idcon); ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Mantenimiento</td>
								<td colspan="3" class="NoiseDataTD"><?php echo cargatipmannombre($sbregot['ordtracodigo'], $idcon); ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Tarea</td>
								<td colspan="3" class="NoiseDataTD"><?php if ($sbregot['ordtracodigo'] != null) echo cargatareanombre($sbregot[ordtracodigo], $idcon); ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Tipo de trabajo</td>
								<td colspan="3" class="NoiseDataTD"><?php echo cargadetalleprogtiptrab($sbregtareot['tiptracodigo'], $idcon); ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Descripcion del Trabajo</td>
								<td colspan="3" class="NoiseDataTD"><?php echo $sbregtareot['ordtradescri']; ?></td>
							</tr>
							<tr><td class="ui-state-default" colspan="4"></td></tr>
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Fecha de inicio</td>
								<td width="30%" class="NoiseErrorDataTD">&nbsp;<b><?php if($sbregot['ordtrafecini'])  echo $sbregot['ordtrafecini'].' '.date("h:i a", strtotime($sbregot['ordtrahorini'])); ?></b></td>
								<td width="20%" class="NoiseFooterTD">&nbsp;Fecha estimada a finalizar</td>
								<td width="30%" class="NoiseErrorDataTD">&nbsp;<b><?php if($sbregot['ordtrafecfin'])  echo $sbregot['ordtrafecfin'].' '.date("h:i a", strtotime($sbregot['ordtrahorfin'])); ?></b></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;</td>
								<td class="NoiseFooterTD">&nbsp;aaaa-mm-dd h:mm am/pm</td>
								<td class="NoiseFooterTD">&nbsp;</td>
								<td class="NoiseFooterTD">&nbsp;aaaa-mm-dd h:mm am/pm</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center"  class="ui-widget-content">
							<tr class="ui-state-default"><td class="cont-title">&nbsp;Empleado de Mantenimiento</td></tr>
						</table>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td width="20%" class="NoiseFooterTD">Encargado</td>
								<td width="80%" class="NoiseErrorDataTD"><?php echo $user_encargado; ?></td>
							</tr>
							<tr><td class="ui-state-default" colspan="2"></td></tr>
							<tr>
								<td class="NoiseFooterTD" rowspan="<?php echo count ( $user_aux ); ?>">Auxiliar</td>
								<td class="NoiseDataTD"> <?php echo $user_aux[0]; ?></td>
							</tr>
							<?php for($i = 1; $i <= count ( $user_aux ); $i ++): ?>
							<tr><td class="NoiseDataTD"> <?php echo $user_aux [$i]; ?></td></tr>
							<?php endfor ?>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr class="NoiseErrorDataTD">
								<td width="20%">&nbsp;Estado</td>
								<td width="80%"><select name="otestacodigo" id="otestacodigo">
									<option value="">-- Seleccione --</option>
									<?php
										include ('../src/FunGen/floadotestadootservicio.php');
										floadotestadoot($otestacodigo, $idcon);
									?> 						  		
      						  	</select></td>
							</tr>
							<tr><td colspan="2" class="NoiseFooterTD"><?php if ($campnomb ["tareotnota"] == 1) { $tareotnota = null; echo "*"; } ?>&nbsp;Motivo</td></tr>
							<tr><td colspan="2" class="NoiseFooterTD"><textarea name="tareotnota" cols="87" rows="3"><?php if (! $flagnuevotareot){ echo $sbreg['tareotnota']; } else{ echo $tareotnota; } ?></textarea></td></tr>
						</table>
					</td>
				</tr>
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
							<tr><td class="ui-state-default">&nbsp;Archivos a importar  </td></tr>					
							<tr>
								<td>
				
			       					<div style="float:left;">
										<div id="gestionot_file_upload">Ocurrio un problema con el sistema!</div>
										<div id="gestionot_custom-queue" class="uploadifyQueue"></div>
									</div>

									<div style="height:2px;"></div>
									<div class="ui-widget-content content">
										<div id="gestionot_file_load" class="file-upname">
											<?php

												if($uploadocumen):
													$arrUpload = explode('::', $uploadocumen);
													$arrUploadSize = explode('::', $uploadocumensize);
													
													for($a = 0; $a < count($arrUpload); $a++):
											?>
											<div class="uploadifyQueueItem completed"><div class="cancel"><a href="javascript: void(0);" onclick="deleteFileUpload('<?php echo $a ?>');"><img border="0" src="temas/upload/cancel.png"></a></div><span class="fileName"><?php echo $arrUpload[$a].' ('.$arrUploadSize[$a].')' ?></span></div>
											<?php												
													endfor;
												endif;
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
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_form.php'; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
			</table> 
			<input type="hidden" name="tareotcodigo" value="<?php if (! $flagnuevotareot){ echo $sbreg[tareotcodigo]; } else{ echo $tareotcodigo; } ?>">
			<input type="hidden" name="accionnuevotareot">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="nuevo">
			<!-- 	empleados de mantenimiento    -->
			<input type="hidden" name="lider" value="<?php echo $lider; ?>"> 
			<input type="hidden" name="arreglo_tecnic" value="<?php echo $arreglo_tecnic; ?>"> 
			<!--	*	*	*	*	*	--> 
			<input type="hidden" name="arreglo_ite" value="<?php echo $arreglo_ite; ?>"> 
			<input type="hidden" name="arreglo_herr" value="<?php echo $arreglo_herr; ?>"> 
			<!--	*	*	*	*	*	-->
			<input type="hidden" name="ordtracodigo" size="13" value="<?php if (!$flagnuevotareot) { echo $sbregot [ordtracodigo]; } else { echo $ordtracodigo; } ?>" > 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
		</form>
	</body> 
<?php if (! $codigo) { echo " -->"; } ?> 
</html>