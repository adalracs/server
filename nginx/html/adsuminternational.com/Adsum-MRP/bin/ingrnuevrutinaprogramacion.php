<?php
ob_start();
	include ( '../src/FunGen/fncstrfecha.php');
ob_end_flush();
?>
<html> 
	<head> 
		<title>Nuevo registro de programacion</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.ui.ajax_accionextras.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_ot.js"></script>
		<script type="text/javascript">
			$(function(){
				$("#msgwindowait").dialog({
					autoOpen: false,
					width: 350,
					modal: true
				});
				
				$("#windowoverload").dialog({
					autoOpen: false,
					width: 350,
					modal: true,
					buttons: {
						"Terminar": function() { 
							$(this).dialog("close"); 
						}/*,
						"Ver log de carga": function() {
							$(this).dialog("close");
						}*/
					}
				});



				
				$('#cargarutina').button({ icons: { primary: "ui-icon-circle-check" } }).click(function() {
					$.ajax({	   
						dataType: "html",
						type: "POST",        
						url: "../src/FunPHPExcel/loadrutinaprogramacion.phpexcel.php",
						data: "uploadocumen=" + document.getElementById('uploadocumen').value + '&usuacodi=<?php echo $usuacodi?>',
						beforeSend: function(data){ 
							$('#msgwindowait').dialog('open');
						},
						success: function(requestData){ 
							$('#msgwindowait').dialog('close');
							$('#windowoverload').dialog('open');
						},         
						error: function(requestData, strError, strTipoError){},
						complete: function(requestData, exito){ }                                      
					});
					
					return false; 
				});
				
				$('#salircarga').button({ icons: { primary: "ui-icon-circle-close" } }).click(function() {
					document.form1.action = 'maestablprogramacionequipos.php';
					document.form1.submit();
					
					return false; 
				});

				$( "#cargarutina" ).button({ disabled: true });

			});
		
		
			$(document).ready(function() {
				$("#reportot_file_upload").uploadify({
					'uploader': 'temas/upload/uploadify.swf',
					'cancelImg': 'temas/upload/cancel.png',
					'script': 'uploadify.php',
					'folder': '/doc/upload/temp/',
					'buttonImg': 'temas/upload/button_onload.png',
					'multi' : false,
					'auto' : true,
					'fileExt' : '*.xls',
					'fileDesc' : 'All Files (.xls)',
					'queueID' : 'reportot_custom-queue',
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
			});
			
			/**
			 *
			 */
			function deleteFileUpload(index)
			{
				var file = document.getElementById('uploadocumen').value.split('::');
				var filesize = document.getElementById('uploadocumensize').value.split('::');
				
				accionDeleteFileNormal('../doc/upload/temp/' + file[index]);

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

			
			function loadHTMLUpload(codeot)
			{
				if(document.getElementById('uploadocumen').value != '')
				{
					var file = document.getElementById('uploadocumen').value.split('::');
					var filesize = document.getElementById('uploadocumensize').value.split('::');
					var session = '';
	
					
					for(var i=0; i < file.length; i++)
						session += '<div class="uploadifyQueueItem completed"><div class="cancel"><a href="javascript: void(0);" onclick="deleteFileUpload(' + i + ');"><img border="0" src="temas/upload/cancel.png"></a></div><span class="fileName">' + file[i] + ' (' + filesize[i] + ')</span></div>';
	
					document.getElementById('reportot_file_load').innerHTML = session;
					$( "#cargarutina" ).button({ disabled: false });
				}
				else
				{
					document.getElementById('reportot_file_load').innerHTML = '';
					$( "#cargarutina" ).button({ disabled: true });
				}
			}

			function downloadFile()
			{
				window.open('../doc/formatos/FMT_RUT_MANTENIMIENTO_ADSUM.xls','formatos','status=no,menubar=no,scrollbars=no,resizable=no,left=300,width=100,height=100');
			}
		</script>
		<style type="text/css">
			select,	 #equiponombre {font-size: 12px;}
			.style1 {font-size: 12px}
			.dont-line-1 {border-top:0; border-bottom:0; border-left:0;}
			.dont-line-2 {border:0;}
		</style>
	</head>
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Importar Rutinas de mantenimiento</font></p> 
			<table width="850" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content">
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
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">&nbsp;</font></span></td></tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr><td class="ui-state-default">&nbsp;<small><?php echo strfecha(date("Y-m-d"))  ?></small></td></tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
          						<td class="NoiseFooterTD" width="35%">&nbsp;Formato de mantenimiento</td>
          						<td class="NoiseDataTD" width="65%">&nbsp;<a href="javascript: void(0);" onclick="downloadFile();">Click aqu&iacute; para descargar el formato de rutinas de mantenimiento</a></td>
          					</tr>
							<tr><td class="ui-state-default" colspan="2"></td></tr>
							<tr><td class="ui-state-default" colspan="2"></td></tr>
							<tr>
								<td colspan="2">
									<div style="float:left;">
										<div id="reportot_file_upload">Ocurrio un problema con el sistema!</div>
										<div id="reportot_custom-queue" class="uploadifyQueue"></div>
									</div>
									<div style="height:2px;"></div>
									<div class="ui-widget-content content">
										<div id="reportot_file_load" class="file-upname">
											<?php 
												if($uploadocumen):
													$arrUpload = explode('::', $uploadocumen);
													$arrUploadSize = explode('::', $uploadocumensize);
													
													for($a = 0; $a < count($arrUpload); $a++):
											?>
											<div class="uploadifyQueueItem completed"><div class="cancel"><a href="javascript: void(0);" onclick="deleteFileUpload(<?php echo $a ?>,'<?php echo $rwOt['ordtracodigo'] ?>');"><img border="0" src="temas/upload/cancel.png"></a></div><span class="fileName"><?php echo $arrUpload[$a].' ('.$arrUploadSize[$a].')' ?></span></div>
											<?php													
													endfor;
												endif;
											?>
										</div>
										<input type="hidden" name="uploadocumen" id="uploadocumen">
										<input type="hidden" name="uploadocumensize" id="uploadocumensize">
									</div>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><div class="ui-buttonset">
						<button id="cargarutina">Cargar rutinas</button>&nbsp;&nbsp;&nbsp;&nbsp;
						<button id="salircarga">Salir</button>
					</div></td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td class="NoiseErrorDataTD" colspan="2">&nbsp;</td></tr>
			</table>
			<input type="hidden" name="accionnuevoprogramacionequipos">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="nuevo"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form>
		<div id="msgwindowait" title="Adsum Kallpa [Gestion de mantenimiento]"><span id="msgwait"><img src="../img/loading.gif">&nbsp;Espere mientras se realiza la carga de las rutinas</span></div>
		<div id="windowoverload" title="Adsum Kallpa [Rutinas]">
			<div id="content">La carga de rutinas finalizo, para ver el resultado de la carga de clic en el boton "Ver log de carga"</div>
		</div>
	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>