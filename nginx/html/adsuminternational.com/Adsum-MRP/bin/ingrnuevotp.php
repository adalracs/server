<?php
ob_start();
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerSecNiv/fncsqlrun.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblsistema.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktblcomponen.php');
	include ( '../src/FunPerPriNiv/pktbltarea.php');
	include ( '../src/FunPerPriNiv/pktbltipotrab.php');
	include ( '../src/FunGen/fncstrfecha.php');
	include ( '../src/FunGen/cargainput.php');
	include '../src/FunPerPriNiv/pktblclasifallelec.php';
	include '../src/FunPerPriNiv/pktblrangofallelec.php';
	
	if($accionnuevootp)
		include ( 'grabaotp.php');
		
	if(!$ordtranumpro)
		$ordtranumpro = str_replace('|n','',$radiobutton);
		
	$idcon = fncconn();
	$sbSql = "	SELECT DISTINCT planta.* FROM ot LEFT JOIN planta ON planta.plantacodigo = ot.plantacodigo WHERE ot.ordtranumpro = '{$ordtranumpro}'";
	$rsPlantas = fncsqlrun($sbSql, $idcon);
	$nrPlantas = fncnumreg($rsPlantas);
		
	$sbSqlListOT = "SELECT * FROM ot LEFT JOIN tareot ON tareot.ordtracodigo = ot.ordtracodigo AND tareot.tareotsecuen = '0' WHERE ot.ordtranumpro = '{$ordtranumpro}'";
	$rsOts = fncsqlrun($sbSqlListOT, $idcon);
	$nrOts = fncnumreg($rsOts);
	
	$sbSqlListOT = "SELECT * FROM ot LEFT JOIN tareot ON tareot.ordtracodigo = ot.ordtracodigo AND tareot.tareotsecuen = '0' WHERE ot.ordtranumpro = '{$ordtranumpro}' AND ot.plantacodigo = '[plantacodigo]'";
	
//	$sbSqlUsua = "SELECT DISTINCT usuariotareot.usuacodi, usuariotareot.usutarlider FROM ot LEFT JOIN tareot ON tareot.ordtracodigo = ot.ordtracodigo AND tareot.tareotsecuen = '0' LEFT JOIN usuariotareot ON usuariotareot.tareotcodigo = tareot.tareotcodigo WHERE ot.ordtranumpro = '{$ordtranumpro}'";
//	$rsUsua = fncsqlrun($sbSqlUsua, $idcon);
//	$nrUsua = fncnumreg($rsUsua);
//	$arregloauxusuario = array();
//	
//	for($i = 0; $i < $nrUsua; $i++):
//		$rwUsua = fncfetch($rsUsua, $i);
//		
//		if($rwUsua['usutarlider'] == 't' || $rwUsua['usutarlider'] == '1' )
//			$encargado = cargausuanombre($rwUsua['usuacodi'], $idcon);
//		else
//			$arregloauxusuario[] = cargausuanombre($rwUsua['usuacodi'], $idcon);
//	endfor;	
	
	
	$rsClasfalelc = fullscanclasifallelec($idcon);
	$nrClasfalelc = fncnumreg($rsClasfalelc);
	
	for($i = 0; $i < $nrClasfalelc; $i++):
		$rwClasfalelc = fncfetch($rsClasfalelc, $i);
		$rsRango = loadlistrecordrangofallelec($rwClasfalelc['cfalelcodigo'], $idcon);	
		(!$rsRango[1]['ranfelvalfin']) ? $fin1 = 1000 : $fin1 = $rsRango[1]['ranfelvalfin']; 
		(!$rsRango[2]['ranfelvalfin']) ? $fin2 = 1000 : $fin2 = $rsRango[2]['ranfelvalfin']; 
		
		$subRango[$rwClasfalelc['cfalelhcolor']][1] =  $rsRango[1]['ranfelvalini'].','.$fin1;
		$subRango[$rwClasfalelc['cfalelhcolor']][2] =  $rsRango[2]['ranfelvalini'].','.$fin2;
	endfor;

ob_end_flush();
?>
<html> 
	<head> 
		<title>Reportar registro de orden de trabajo programada</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.ui.ajax_accionextras.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_ot.js"></script>
		<script type="text/javascript">
			/**
			 * Function formatNumber
			 */
			function formatNumber(num, prefix)
			{
				prefix = prefix || '';
				num += '';
	
				var splitStr = num.split('.');
				var splitLeft = splitStr[0];
				var splitRight = splitStr.length > 1 ? ',' + splitStr[1] : '';
				var regx = /(\d+)(\d{3})/;
	
				while (regx.test(splitLeft)) {
					splitLeft = splitLeft.replace(regx, '$1' + '.' + '$2');
				}
	
				return prefix + splitLeft + splitRight;
			}
	
			/**
			 * Function reformatNumber
			 */
			function reformatNumber(num) 
			{
				if(num == '')
					return '0';
				num = num.replace(/([^0-9\,\-])/g,'');
				return num.replace(/([^0-9\.\-])/g,'.');
			}

		
			function calDelta(codeot)
			{
				var arrRangos1 = new Array();
				var arrRangos2 = new Array();
				var arrCRangos = new Array();
				<?php 
					$a = 0;
					foreach ($subRango as $key => $value):
						echo "arrRangos1[{$a}] = '".$value[1]."';\n";
						echo "arrRangos2[{$a}] = '".$value[2]."';\n";
						echo "arrCRangos[{$a}] = '".$key."';\n";
						$a++;
					endforeach;
				?>
				
				var arrFases = new Array();
				var tDelta1 = 0;
				var tDelta2 = 0;
				var faseMayor = 0;
				var faseMenor = 100;
				var tempAmbien = reformatNumber(document.getElementById('TAot' + codeot).value);
				
				arrFases[0] = reformatNumber(document.getElementById('FAot' + codeot).value);
				arrFases[1] = reformatNumber(document.getElementById('FBot' + codeot).value);
				arrFases[2] = reformatNumber(document.getElementById('FCot' + codeot).value);


				for(var k=0; k < arrFases.length; k++)
				{
					if(parseFloat(arrFases[k]) > parseFloat(faseMayor))
						faseMayor = arrFases[k];
					
					if(parseFloat(arrFases[k]) < parseFloat(faseMenor) && parseFloat(arrFases[k]) > 0)
						faseMenor = arrFases[k];
				}

				if(faseMenor != 100)
					tDelta1 = parseFloat(faseMayor) - parseFloat(faseMenor);

				if(faseMayor > 0)
					tDelta2 = parseFloat(faseMayor) - parseFloat(tempAmbien);

				for(var k=0; k < arrCRangos.length; k++)
				{
					var rang1 = arrRangos1[k].split(',');
					var rang2 = arrRangos2[k].split(',');
					
					if(tDelta1 >= rang1[0] && tDelta1 <= rang1[1])
						document.getElementById('D1ot' + codeot).style.background = "#" + arrCRangos[k];
					
					if(tDelta2 >= rang2[0] && tDelta2 <= rang2[1])
						document.getElementById('D2ot' + codeot).style.background = "#" + arrCRangos[k];
				}
				
				document.getElementById('D1ot' + codeot).innerHTML = formatNumber(tDelta1.toFixed(2),'');
				document.getElementById('D2ot' + codeot).innerHTML = formatNumber(tDelta2.toFixed(2),'');
				
				document.getElementById('D1v' + codeot).value = tDelta1.toFixed(2);
				document.getElementById('D2v' + codeot).value = tDelta2.toFixed(2);
			}
			<?php 
				for($a = 0; $a < $nrOts; $a++):
					$rwOts = fncfetch($rsOts, $a);
			?>
			$(document).ready(function() {
				$("#reportot_file_upload<?php echo $rwOts['ordtracodigo'] ?>").uploadify({
					'uploader': 'temas/upload/uploadify.swf',
					'cancelImg': 'temas/upload/cancel.png',
					'script': 'uploadify.php',
					'folder': '../doc/upload/temp<?php echo $usuacodi ?>',
					'buttonImg': 'temas/upload/button_onload.png',
					'multi' : false,
					'auto' : true,
					'fileExt' : '*.doc;*.docx;*.pdf;*.jpeg;*.bmp;*.jpg;*.gif;*.png',
					'fileDesc' : 'All Files (.doc, .docx, .pdf, .jpeg, .bmp, .jpg, .gif, .png)',
					'queueID' : 'reportot_custom-queue<?php echo $rwOts['ordtracodigo'] ?>',
					'queueSizeLimit' : 3,
					'simUploadLimit' : 3,
					'removeCompleted': true,
					'onComplete' : function(event, ID, fileObj, response, data) {
						var file = document.getElementById('uploadocumen<?php echo $rwOts['ordtracodigo'] ?>');
						var filesize = document.getElementById('uploadocumensize<?php echo $rwOts['ordtracodigo'] ?>');
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

						loadHTMLUpload('<?php echo $rwOts['ordtracodigo'] ?>');
					}
				});
			});
			
			/**
			 *
			 */
			function deleteFileUpload(index, codeot)
			{
				var file = document.getElementById('uploadocumen' + codeot).value.split('::');
				var filesize = document.getElementById('uploadocumensize' + codeot).value.split('::');
				
				accionDeleteFileNormal('../doc/upload/temp<?php echo $usuacodi ?>/' + file[index]);

				document.getElementById('uploadocumen' + codeot).value = '';
				document.getElementById('uploadocumensize' + codeot).value = '';
				
				
				for(var i=0; i < file.length; i++)
				{
					if(i != index)
					{
						if(document.getElementById('uploadocumen' + codeot).value != '')
						{
							document.getElementById('uploadocumen' + codeot).value = document.getElementById('uploadocumen' + codeot).value + '::' + file[i];
							document.getElementById('uploadocumensize' + codeot).value = document.getElementById('uploadocumensize' + codeot).value + '::' + filesize[i];
						}
						else
						{
							document.getElementById('uploadocumen' + codeot).value = file[i];
							document.getElementById('uploadocumensize' + codeot).value = filesize[i];
						}
					}
				}

				loadHTMLUpload(codeot);
			}

			
			
			animatedcollapse.addDiv('filtr<?php echo $rwOts['ordtracodigo'] ?>', 'fade=0,height=auto');
			<?php endfor ?>
			animatedcollapse.ontoggle = function($, divobj, state){ //fires each time a DIV is expanded/contracted
				//$: Access to jQuery
				//divobj: DOM rsference to DIV being expanded/ collapsed. Use "divobj.id" to get its ID
				//state: "block" or "none", depending on state
			}
			animatedcollapse.init();

			function loadHTMLUpload(codeot)
			{
				if(document.getElementById('uploadocumen' + codeot).value != '')
				{
					var file = document.getElementById('uploadocumen' + codeot).value.split('::');
					var filesize = document.getElementById('uploadocumensize' + codeot).value.split('::');
					var session = '';
	
					
					for(var i=0; i < file.length; i++)
						session += '<div class="uploadifyQueueItem completed"><div class="cancel"><a href="javascript: void(0);" onclick="deleteFileUpload(' + i + ',' + "'" + codeot + "'" + ');"><img border="0" src="temas/upload/cancel.png"></a></div><span class="fileName">' + file[i] + ' (' + filesize[i] + ')</span></div>';
	
					document.getElementById('reportot_file_load' + codeot).innerHTML = session;
				}
				else
					document.getElementById('reportot_file_load' + codeot).innerHTML = '';
			}
		</script>
		
		<style type="text/css">
			select, #equiponombre {font-size: 12px;}
			.style1 {font-size: 12px}
			.head-table-detall {font-size:90%;}
			.table-detall {font-size:11px;}			
		</style>
	</head>
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Orden de trabajo programacion</font></p> 
			<table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content">
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
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Reporta OTP</font></span></td></tr>
				<tr>
					<th scope="col">
						<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr><td class="ui-state-default">&nbsp;<small><?php echo strfecha(date("Y-m-d"))  ?></small></td></tr>
						</table>
					</th>
				</tr>
				<tr>
    				<th scope="col">
      					<table border="0" width="99%" align="center" cellpadding="1" cellspacing="1">
        					<tr>
		  						<td class="ui-widget-header" colspan="2">&nbsp;OTP -&nbsp;<b>
								<?php 
				              		if(strlen($ordtranumpro)== 1) echo "00000".$ordtranumpro;
				              		if(strlen($ordtranumpro)== 2) echo "0000".$ordtranumpro;
				              		if(strlen($ordtranumpro)== 3) echo "000".$ordtranumpro;
				              		if(strlen($ordtranumpro)== 4) echo "00".$ordtranumpro;
				              		if(strlen($ordtranumpro)>= 5) echo "0".$ordtranumpro; 
				              		if(strlen($ordtranumpro)>= 6) echo $ordtranumpro;
					              ?>
								</b></td>
  							</tr>
 						</table>
        			</th>
        		</tr>
				<?php 
        			for($a = 0; $a < $nrPlantas; $a++):
        				$rwPlantas = fncfetch($rsPlantas, $a);
        		?>
        		<tr>
    				<th scope="col">
      					<table border="0" width="99%" align="center" cellpadding="0" cellspacing="1">
      						<tr>
 								<td class="ui-widget-header" width="15%">&nbsp;Ubicaci&oacute;n</td>
 								<td class="NoiseDataTD" width="85%">&nbsp;<?php echo $rwPlantas['plantanombre']; ?></td>
 							</tr>
 							<tr><td colspan="2"></td></tr>
							<tr><td colspan="2" class="ui-state-default" align="center">Ordenes de Trabajo</td></tr>
							<tr>		  
								<td colspan="2">
									<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
		  								<tr>
					  						<td width="3%" class="ui-state-default head-table-detall" rowspan="2">&nbsp;</td>
					  						<td width="7%" class="ui-state-default head-table-detall" rowspan="2">No. OT</td>
							  			  	<td width="12%" class="ui-state-default head-table-detall" rowspan="2">Sistema</td>
							  			  	<td width="28%" class="ui-state-default head-table-detall" rowspan="2">Equipo</td>
							  			  	<td width="12%" class="ui-state-default head-table-detall" rowspan="2">Tipo Trabajo</td>
							  			  	<td width="14%" class="ui-state-default head-table-detall" rowspan="2">Tarea</td>
							  			  	<td class="ui-state-default head-table-detall" rowspan="2"></td>
							  			  	<td width="4%" class="ui-state-default head-table-detall" rowspan="2" align="center">TA &deg;C</td>
							  			  	<td class="ui-state-default head-table-detall" colspan="3" align="center">Fases</td>
							  			  	<td width="4%" class="ui-state-default head-table-detall" rowspan="2" align="center">&Delta; 1 &deg;C</td>
							  			  	<td width="4%" class="ui-state-default head-table-detall" rowspan="2" align="center">&Delta; 2 &deg;C</td>
						  			    </tr>
		  								<tr>
							  			  	<td width="4%" class="ui-state-default head-table-detall" align="center">FA &deg;C</td>
							  			  	<td width="4%" class="ui-state-default head-table-detall" align="center">FB &deg;C</td>
							  			  	<td width="4%" class="ui-state-default head-table-detall" align="center">FC &deg;C</td>
						  			    </tr>
										<?php 
											$rsOt = fncsqlrun(str_replace('[plantacodigo]', $rwPlantas['plantacodigo'], $sbSqlListOT), $idcon);
											$nrOt = fncnumreg($rsOt);

											for($b = 0; $b < $nrOt; $b++):
												$rwOt = fncfetch($rsOt, $b);

												if(!$ordtrafecha) $ordtrafecha = date("Y-m-d h:i a",strtotime($rwOt['ordtrafecini'].' '.$rwOt['ordtrahorini'])); 
												($class == "NoiseFooterTD") ? $class = "NoiseDataTD" : $class = "NoiseFooterTD";
												
												$rsEquipo = loadrecordequipo($rwOt['equipocodigo'], $idcon);
												(trim($rsEquipo[equipodescri])) ? $equiponombre = $rsEquipo['equiponombre'].' / '.$rsEquipo['equipodescri'] : $equiponombre = $rsEquipo['equiponombre']; 
												
										?>
										<tr class="<?php echo $class ?>">
											<td class="table-detall"><a onClick="return verocultar('filtr<?php echo $rwOt['ordtracodigo'] ?>',<?php echo $b ?>);" href="javascript:animatedcollapse.toggle('filtr<?php echo $rwOt['ordtracodigo'] ?>');"><img id="row<?php echo $b ?>" align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0"></a></td>
											<td class="table-detall"><?php echo $rwOt['ordtracodigo'] ?></td>
											<td class="table-detall"><?php echo cargasistemnombre($rwOt['sistemcodigo'], $idcon) ?></td>
											<td class="table-detall"><?php echo $equiponombre ?></td>
											<td class="table-detall"><?php echo cargatiptrabnombre($rwOt['tiptracodigo'], $idcon) ?></td>
											<td class="table-detall"><?php echo cargatareanombre1($rwOt['tareacodigo'], $idcon) ?></td>
											<td class="ui-state-default table-detall"></td>
											<td class="table-detall"><input type="text" class="autoPorccent" onchange="calDelta('<?php echo $rwOt['ordtracodigo'] ?>');" style="font-size: 11px;" name="TAot<?php echo $rwOt['ordtracodigo'] ?>" id="TAot<?php echo $rwOt['ordtracodigo'] ?>" size="4"></td>
											<td class="table-detall"><input type="text" class="autoPorccent" onchange="calDelta('<?php echo $rwOt['ordtracodigo'] ?>');" style="font-size: 11px;" name="FAot<?php echo $rwOt['ordtracodigo'] ?>" id="FAot<?php echo $rwOt['ordtracodigo'] ?>" size="4"></td>
											<td class="table-detall"><input type="text" class="autoPorccent" onchange="calDelta('<?php echo $rwOt['ordtracodigo'] ?>');" style="font-size: 11px;" name="FBot<?php echo $rwOt['ordtracodigo'] ?>" id="FBot<?php echo $rwOt['ordtracodigo'] ?>" size="4"></td>
											<td class="table-detall"><input type="text" class="autoPorccent" onchange="calDelta('<?php echo $rwOt['ordtracodigo'] ?>');" style="font-size: 11px;" name="FCot<?php echo $rwOt['ordtracodigo'] ?>" id="FCot<?php echo $rwOt['ordtracodigo'] ?>" size="4"></td>
											<td class="table-detall"><div id="D1ot<?php echo $rwOt['ordtracodigo'] ?>" align="center"></div><input type="hidden" name="D1v<?php echo $rwOt['ordtracodigo'] ?>" id="D1v<?php echo $rwOt['ordtracodigo'] ?>"></td>
											<td class="table-detall"><div id="D2ot<?php echo $rwOt['ordtracodigo'] ?>" align="center"></div><input type="hidden" name="D2v<?php echo $rwOt['ordtracodigo'] ?>" id="D2v<?php echo $rwOt['ordtracodigo'] ?>"></td>
										</tr>
										<tr>
											<td colspan="13" class="ui-state-default head-table-detall">
												<div id="filtr<?php echo $rwOt['ordtracodigo'] ?>" style="display: none;" >
													<div class="ui-widget-content content">
														<div id="reportot_file_load<?php echo $rwOt['ordtracodigo'] ?>" class="file-upname">
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
														<input type="hidden" name="uploadocumen<?php echo $rwOt['ordtracodigo'] ?>" id="uploadocumen<?php echo $rwOt['ordtracodigo'] ?>">
														<input type="hidden" name="uploadocumensize<?php echo $rwOt['ordtracodigo'] ?>" id="uploadocumensize<?php echo $rwOt['ordtracodigo'] ?>">
													</div>
													<div style="float:left;">
														<div id="reportot_file_upload<?php echo $rwOt['ordtracodigo'] ?>">Ocurrio un problema con el sistema!</div>
														<div id="reportot_custom-queue<?php echo $rwOt['ordtracodigo'] ?>" class="uploadifyQueue"></div>
													</div>
													<div style="height:2px;"></div>
							       				</div>
						       				</td>
						       			</tr>
										<?php endfor ?>											
									</table>			
								</td>
							</tr>
						</table>
        			</th>
        		</tr>
        		<tr><td></td></tr>
        		<?php endfor; ?>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><div class="ui-buttonset">
						<button id="aceptar">Aceptar</button>&nbsp;&nbsp;&nbsp;&nbsp;
						<button id="cancelar">Cancelar</button>
					</div></td>
				</tr>
				<tr><td>&nbsp;</td></tr> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table>

			<input type="hidden" name="accionnuevootp"> 
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="nuevo"> 

			<!-- Datos de otp -->
			<input type="hidden" name="ordtranumpro" value="<?php echo $ordtranumpro; ?>">
			<input type="hidden" name="codigo" id="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="arrordtracodigo" id="arrordtracodigo" value="<?php echo $arrordtracodigo; ?>">
			<input type="hidden" name="flag">
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>