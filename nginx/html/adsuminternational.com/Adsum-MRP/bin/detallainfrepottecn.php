<?php
	include ('../src/FunGen/sesion/fncvalsesion.php');
	include '../src/FunPerPriNiv/pktblvistarepcierre.php';
	include '../src/FunPerPriNiv/pktblvistacierreot.php';
	include '../src/FunPerPriNiv/pktblvistamaxtareot.php';
	include '../src/FunPerPriNiv/pktblplanta.php';
	include '../src/FunPerPriNiv/pktblotestado.php';
	include '../src/FunPerPriNiv/pktblsistema.php';
	include '../src/FunPerPriNiv/pktblequipo.php';
	include '../src/FunPerPriNiv/pktbltipotrab.php';
	include '../src/FunPerPriNiv/pktbltarea.php';
	include '../src/FunPerPriNiv/pktblusuario.php';
	include '../src/FunPerPriNiv/pktbltipomant.php';
	include '../src/FunPerSecNiv/fncsqlrun.php';
	include '../src/FunPerSecNiv/fncnumreg.php';
	include '../src/FunPerSecNiv/fncfetchall.php';
	include '../src/FunPerSecNiv/fncfetch.php';
	include '../src/FunGen/cargainput.php';
	$URL = explode('bin', $GLOBALS['HTTP_REFERER']);
	
//	($lsttecnico) ? $arrUsuarios = explode(',', $lsttecnico) : $arrUsuarios = null; 
//	($arrusuaplanta) ? $arrPlantas = explode(',', $arrusuaplanta) : $arrPlantas = null; 
//	($arrusuatipotrab) ? $arrTipotrab = explode(',', $arrusuatipotrab) : $arrTipotrab = null; 
	
	if(empty($arrusuaplanta)) $arrusuaplanta = $usuaplanta;
	if(empty($arrusuatipotrab)) $arrusuatipotrab = $usuatipotrab;
	if(!empty($lsttecnico)) $subSql = "AND usuariotareot.usuacodi IN ({$lsttecnico})" ;
	
	$idcon = fncconn();
	
	$sbSql = "	SELECT ot.plantacodigo, planta.plantanombre, MAX(tareot.tareotsecuen) 
				FROM ot 
					LEFT JOIN tareot ON tareot.ordtracodigo = ot.ordtracodigo 
					LEFT JOIN usuariotareot ON usuariotareot.tareotcodigo = tareot.tareotcodigo
					LEFT JOIN planta ON planta.plantacodigo = ot.plantacodigo
				WHERE ot.plantacodigo IN ({$arrusuaplanta}) AND ot.ordtrafecini BETWEEN '{$consulfecini}' AND '{$consulfecfin}' AND tareot.tiptracodigo IN ({$arrusuatipotrab}) {$subSql}
				GROUP BY ot.plantacodigo, planta.plantanombre";
	$rsOt = fncsqlrun($sbSql, $idcon);
	$nrOt = fncnumreg($rsOt);
	
	if($nrOt > 0)
		$rwOtAll = fncfetchall($rsOt);
?>
<html>
	<head>
		<title>Parametros de Informe - Funcionarios Total Ordenes por Ejecutados</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		<?php if($flagtipoinforme == 1): ?>
		<script type="text/javascript" src="../src/FunChart/js/json/json2.js"></script>
		<script type="text/javascript" src="../src/FunChart/js/swfobject.js"></script>
		<script type="text/javascript">
		<?php 	for($a = 0; $a < $nrOt; $a++): ?>
			swfobject.embedSWF("../src/FunChart/open-flash-chart.swf", "graph_data<?php echo $rwOtAll[$a]['plantacodigo'] ?>", "1000", "450", "9.0.0", "expressInstall.swf", {"data-file":"../src/FunjQuery/ofc.graph.charts/ofc.infrepottecn.php?parameter=<?php echo $rwOtAll[$a]['plantacodigo'] ?>[::]<?php echo $arrusuatipotrab ?>[::]<?php echo $lsttecnico ?>[::]<?php echo $consulfecini ?>[::]<?php echo $consulfecfin ?>","loading":"Escribiendo la grafica..."},false);
		<?php endfor ?>
		</script>
		<script type="text/javascript">
			// The chart object
			function chart(name) {
				this.name = name;
			 
				this.image_saved = function(id) {
					alert('saved:' + this.name + ', id:' + id );
				};
			}
				 
			// create a new chart object
			var graph_data = new chart('chart 1');
		 
			function done(id)
			{
				alert("Finished upload. Id:"+id);
			}
		 
			function post_image(debug, chart)
			{
				url = "<?php echo $URL[0] ?>src/FunChart/php-ofc-library/ofc_upload_image.php?name=" + chart + ".png";
				var ofc = findSWF(chart);
				
				x = ofc.post_image( url, 'done', debug );
			}
	
			function ofc_ready()
			{ }
			 
			function findSWF(movieName) {
				return document[movieName];
			}
	
			$(function(){
				<?php 	for($a = 0; $a < $nrOt; $a++): ?>
				$('#expimage<?php echo $rwOtAll[$a]['plantacodigo'] ?>').button({ icons: { primary: "ui-icon-image" } }).click(function() {
					post_image(null, 'graph_data<?php echo $rwOtAll[$a]['plantacodigo'] ?>'); 
					setTimeout("window.open('<?php echo $URL[0] ?>src/FunChart/tmp-upload-images/graph_data<?php echo $rwOtAll[$a]['plantacodigo'] ?>.png','gestion_mantenimiento')",2000);
					return false;
				});
				<?php endfor ?>
			});
		</script>
		<?php endif ?>
		
		<script type="text/javascript">
			$(function(){
				$('#viewinf').button({ icons: { primary: "ui-icon-image" } }).click(function() {
					if(document.getElementById('flagtipoinforme').value == 1)
						document.getElementById('flagtipoinforme').value = 2;
					else
						document.getElementById('flagtipoinforme').value = 1;
	
					document.form1.submit();
					
					return false;
				});
				
				$('#expconciliado').button({ icons: { primary: "ui-icon-image" } }).click(function() {
					<?php 	for($a = 0; $a < $nrOt; $a++): ?>
					post_image(null, 'graph_data<?php echo $rwOtAll[$a]['plantacodigo'] ?>');
					<?php 	endfor; ?>
					setTimeout("window.open('<?php echo $URL[0] ?>src/FunCompress/comprimir.php?plantas=<?php echo $arrusuaplanta ?>','gestion_mantenimiento')",2000);
					return false;
				});
				
				$('#expexcel').button({ icons: { primary: "ui-icon-image" } }).click(function() {
					return false;
				});
			});
		</script>
		<style type="text/css">
			.head-title-table {font-family: Arial, Helvetica, sans-serif; font-size: 11px;}
			.tick-title-report, .cont-table-report {font-family: Arial, Helvetica, sans-serif; font-size: 11px;}

			.table_data { 
				border-top: 1px solid #C4C6C8;
				border-left: 1px solid #C4C6C8; 
			}
			.cell_data_enc { 
				border-bottom: 1px solid #C4C6C8;
				border-right: 1px solid #C4C6C8;
				text-align: center; 
			}
			.cell_data { 
				border-bottom: 1px solid #C4C6C8;
				border-right: 1px solid #C4C6C8; 
			}
			
			.NoiseFooterTD {font-size: 11px;}
			.NoiseDataTD {font-size: 11px;}
		</style>
	</head>
	<body bgcolor="FFFFFF" text="#000000">
		<p><font class="NoiseFormHeaderFont">Funcionarios - Total Ordenes por Ejecutados</font></p>
		<form name="form1" method="post"  enctype="multipart/form-data">
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="1000" style="margin-bottom: 5px;">
	  			<tr>
	    			<td class="ui-state-default"><div class="ui-buttonset">
						<button id="viewinf"><?php if($flagtipoinforme == 1): ?>Ver detallado<?php else: ?>Ver consiliado<?php endif ?></button>&nbsp;
						<button id="expconciliado">Exportar todos como imagen</button>&nbsp;
						<button id="expexcel">Exportar a Excel</button>&nbsp;
					</div></td>
				</tr>
			</table>
			<?php 
				if($flagtipoinforme == 1): 	
					if($nrOt > 0):
						for($a = 0; $a < $nrOt; $a++): ?>
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="800" style="margin-bottom: 5px;">
	  			<tr>
	    			<td class="ui-state-default">Planta <?php echo strtoupper($rwOtAll[$a]['plantanombre']); ?></td>
				</tr>
	  			<tr>
	    			<td>
	    				<table  border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr> 
	 							<td><div id="graph_data<?php echo $rwOtAll[$a]['plantacodigo'] ?>"></div></td>  
							</tr>
						</table>
					</td>
				</tr>
				<tr>
	    			<td>
	    				<div class="ui-buttonset">
							<button id="expimage<?php echo $rwOtAll[$a]['plantacodigo'] ?>">Exportar como imagen</button>
						</div>
					</td>
				</tr>
			</table>
			<?php 		
						endfor;
					else:	?>
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="800" style="margin-bottom: 5px;">
				<tr><td><div class="ui-widget">
					<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"> 
						<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
						No se encontraron ordenes relacionadas.</p>
					</div>
				</div></td></tr>
			</table>
			<?php 	endif;
				else: 
					if(!$lsttecnico):
						for($a = 0; $a < $nrOt; $a++): ?>
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="98%" style="margin-bottom: 5px;">
	  			<tr>
	    			<td class="ui-state-default">Planta <?php echo strtoupper($rwOtAll[$a]['plantanombre']); ?></td>
				</tr>
				<tr>
					<td>
						<table width="100%" border="0" cellpadding="1" cellspacing="0" class="table_data">
							<tr>
								<td class="NoiseFooterTD cell_data_enc"># Orden</td>
								<td class="NoiseFooterTD cell_data_enc">Proceso/td>
								<td class="NoiseFooterTD cell_data_enc">Equipo</td>
								<td class="NoiseFooterTD cell_data_enc">Mantenimiento</td>
								<td class="NoiseFooterTD cell_data_enc">Tipo trabajo</td>
								<td class="NoiseFooterTD cell_data_enc">Tarea</td>
								<td class="NoiseFooterTD cell_data_enc">Fecha inicio</td>
								<td class="NoiseFooterTD cell_data_enc">Encargado</td>
							</tr>
			<?php 
						//DB
						$sbSql = "	SELECT ot.*, tareot.tiptracodigo, tareot.tareacodigo, usuariotareot.usuacodi AS encargado 
								FROM ot 
									LEFT JOIN tareot ON tareot.ordtracodigo = ot.ordtracodigo 
									LEFT JOIN usuariotareot ON usuariotareot.tareotcodigo = tareot.tareotcodigo
								WHERE ot.plantacodigo = '{$rwOtAll[$a]['plantacodigo']}' AND ot.ordtrafecini BETWEEN '{$consulfecini}' AND '{$consulfecfin}' AND tareot.tiptracodigo IN ({$arrusuatipotrab})
									AND tareot.tareotsecuen = '0' AND usuariotareot.usutarlider = 't'
								ORDER BY tiptracodigo";
			
						$rsOttipo = fncsqlrun($sbSql, $idcon);
						$nrOttipo = fncnumreg($rsOttipo);
			
						for($b = 0; $b < $nrOttipo; $b++):
							$rwOttipo = fncfetch($rsOttipo, $b);	
			?>
							<tr>
								<td class="NoiseDataTD cell_data">&nbsp;<?php echo $rwOttipo['ordtracodigo'] ?></td>
								<td class="NoiseDataTD cell_data">&nbsp;<?php echo cargasistemnombre($rwOttipo['sistemcodigo'], $idcon) ?></td>
								<td class="NoiseDataTD cell_data">&nbsp;<?php echo cargaequiponombre($rwOttipo['equipocodigo'], $idcon) ?></td>
								<td class="NoiseDataTD cell_data">&nbsp;<?php echo cargatipmannombre1($rwOttipo['tipmancodigo'], $idcon) ?></td>
								<td class="NoiseDataTD cell_data">&nbsp;<?php echo cargatiptrabnombre($rwOttipo['tiptracodigo'], $idcon) ?></td>
								<td class="NoiseDataTD cell_data">&nbsp;<?php echo cargatareanombre1($rwOttipo['tareacodigo'], $idcon) ?></td>
								<td class="NoiseDataTD cell_data">&nbsp;<?php echo date("Y-m-d",strtotime($rwOttipo['ordtrafecini'])) ?></td>
								<td class="NoiseDataTD cell_data">&nbsp;<?php echo cargausuanombre($rwOttipo['encargado'], $idcon) ?></td>
							</tr>
			<?php		endfor; ?>
							<tr>
								<td class="NoiseDataTD cell_data" colspan="8">&nbsp;Total Ordenes&nbsp;<?php echo $nrOttipo ?></td>
							</tr>
						</table>
					</td>
				</tr>			
			</table>
			<?php 		endfor;
					else:
						$arrTecnico = explode(',', $lsttecnico);
						
						for($a = 0; $a < count($arrTecnico); $a++):
			?> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="98%" style="margin-bottom: 5px;">
	  			<tr>
	    			<td class="ui-state-default">Funcionario <?php echo strtoupper(cargausuanombre($arrTecnico[$a], $idcon)); ?></td>
				</tr>
				<tr>
					<td>
						<table width="100%" border="0" cellpadding="1" cellspacing="0" class="table_data">
							<tr>
								<td class="NoiseFooterTD cell_data_enc"># Orden</td>
								<td class="NoiseFooterTD cell_data_enc">Planta</td>
	<!--							<td class="NoiseFooterTD cell_data_enc">Sistema</td>-->
								<td class="NoiseFooterTD cell_data_enc">Equipo</td>
								<td class="NoiseFooterTD cell_data_enc">Mantenimiento</td>
								<td class="NoiseFooterTD cell_data_enc">Tipo trabajo</td>
								<td class="NoiseFooterTD cell_data_enc">Tarea</td>
								<td class="NoiseFooterTD cell_data_enc">Fecha inicio</td>
								<td class="NoiseFooterTD cell_data_enc">Asignado como:</td>
							</tr>
			<?php 
						//DB
						$sbSql = "	SELECT ot.*, tareot.tiptracodigo, tareot.tareacodigo, usuariotareot.usutarlider 
									FROM ot 
										LEFT JOIN tareot ON tareot.ordtracodigo = ot.ordtracodigo 
										LEFT JOIN usuariotareot ON usuariotareot.tareotcodigo = tareot.tareotcodigo
									WHERE ot.plantacodigo IN ({$arrusuaplanta}) AND ot.ordtrafecini BETWEEN '{$consulfecini}' AND '{$consulfecfin}' AND tareot.tiptracodigo IN ({$arrusuatipotrab})
										AND tareot.tareotsecuen = (SELECT max(tareot.tareotsecuen) FROM tareot WHERE tareot.ordtracodigo = ot.ordtracodigo)
										AND usuariotareot.usuacodi = '$arrTecnico[$a]'
									ORDER BY tiptracodigo, plantacodigo";	
		
						
						
						$rsOttipo = fncsqlrun($sbSql, $idcon);
						$nrOttipo = fncnumreg($rsOttipo);
			
						for($b = 0; $b < $nrOttipo; $b++):
							$rwOttipo = fncfetch($rsOttipo, $b);	
			?>
							<tr>
								<td class="NoiseDataTD cell_data">&nbsp;<?php echo $rwOttipo['ordtracodigo'] ?></td>
								<td class="NoiseDataTD cell_data">&nbsp;<?php echo cargaplantanombre($rwOttipo['plantacodigo'], $idcon) ?></td>
	<!--							<td class="NoiseDataTD cell_data">&nbsp;<?php //echo cargasistemnombre($rwOttipo['sistemcodigo'], $idcon) ?></td>-->
								<td class="NoiseDataTD cell_data">&nbsp;<?php echo cargaequiponombre($rwOttipo['equipocodigo'], $idcon) ?></td>
								<td class="NoiseDataTD cell_data">&nbsp;<?php echo cargatipmannombre1($rwOttipo['tipmancodigo'], $idcon) ?></td>
								<td class="NoiseDataTD cell_data">&nbsp;<?php echo cargatiptrabnombre($rwOttipo['tiptracodigo'], $idcon) ?></td>
								<td class="NoiseDataTD cell_data">&nbsp;<?php echo cargatareanombre1($rwOttipo['tareacodigo'], $idcon) ?></td>
								<td class="NoiseDataTD cell_data">&nbsp;<?php echo date("Y-m-d",strtotime($rwOttipo['ordtracodigo'])) ?></td>
								<td class="NoiseDataTD cell_data">&nbsp;<?php if($rwOttipo['usutarlider'] == 't') echo 'ENCARGADO'; else echo 'AUXILIAR'; ?></td>
							</tr>
			<?php		endfor; ?>
							<tr>
								<td class="NoiseDataTD cell_data" colspan="8">&nbsp;Total Ordenes&nbsp;<?php echo $nrOttipo ?></td>
							</tr>
						</table>
					</td>
				</tr>			
			</table>
			<?php 		endfor;	
					endif; 
				endif; ?>
			<input type="hidden" name="arrusuaplanta" id="arrusuaplanta" value="<?php echo $arrusuaplanta ?>">
			<input type="hidden" name="arrusuatipotrab" id="arrusuatipotrab" value="<?php echo $arrusuatipotrab ?>">
			<input type="hidden" name="consulfecini" id="consulfecini" value="<?php echo $consulfecini ?>">
			<input type="hidden" name="consulfecfin" id="consulfecfin" value="<?php echo $consulfecfin ?>">
			<input type="hidden" name="lsttecnico" id="lsttecnico" value="<?php echo $lsttecnico ?>">
			<input type="hidden" name="flagtipoinforme" id="flagtipoinforme" value="<?php echo $flagtipoinforme ?>">
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
	</body>
</html>
