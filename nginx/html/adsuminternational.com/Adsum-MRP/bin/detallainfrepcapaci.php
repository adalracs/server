<?php
	ini_set("display_errors", 1);
	
	include ('../src/FunGen/sesion/fncvalsesion.php');
	include '../src/FunPerPriNiv/pktbldepartam.php';
	include '../src/FunPerPriNiv/pktblcurso.php';
	include '../src/FunPerPriNiv/pktbltema.php';
	include '../src/FunPerPriNiv/pktblusuario.php';
	include '../src/FunPerPriNiv/pktblcapacitacion.php';
	include '../src/FunPerPriNiv/pktblcapacitema.php';
	include '../src/FunPerPriNiv/pktblcapaciusuario.php';
	include '../src/FunPerSecNiv/fncsqlrun.php';
	include '../src/FunPerSecNiv/fncnumreg.php';
	include '../src/FunPerSecNiv/fncfetchall.php';
	include '../src/FunPerSecNiv/fncfetch.php';
	include '../src/FunGen/cargainput.php';
	
	
	$idcon = fncconn();
?>
<html>
	<head>
		<title>Parametros de Consulta - Capacitacion</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript">
			$(function(){

				$('#imprimirrep').button({ icons: { primary: "ui-icon-print" } }).click(function() {
					window.print();
					return false;
				});
				
				$('#expexcel').button({ icons: { primary: "ui-icon-calculator" } }).click(function() {
					$.ajax({	   
						dataType: "html",
						type: "POST",        
						url: "../src/FunPHPExcel/infrepottecn.phpexcel.php",
						data: 'usuaplanta=<?php echo $arrusuaplanta ?>&usuatipotrab=<?php echo $arrusuatipotrab ?>&lsttecnico=<?php echo $lsttecnico ?>&consulfecini=<?php echo $consulfecini ?>&consulfecfin=<?php echo $consulfecfin ?>',
						beforeSend: function(data){ 
							$("#msgwindowait").dialog("open");
						},        
						success: function(requestData){
							$("#msgwindowait").dialog("close");
							window.open('../temp/ADM_InfOrdenEjecutado.xls','mantenimiento');
						},         
						error: function(requestData, strError, strTipoError){},
						complete: function(requestData, exito){ }                                      
					});

					
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
		<p><font class="NoiseFormHeaderFont">Consulta - Capacitaci&oacute;n</font></p>
		<form name="form1" method="post"  enctype="multipart/form-data">
			<!-- <div class="console-buttons-float-topright">
				<div class="ui-widget">
					<div class="ui-state-highlight ui-corner-all" style="padding: .5em .5em;"> 
						<div class="ui-buttonset">
							<button id="imprimirrep">Imprimir</button>&nbsp;
							<button id="expexcel">Exportar a Excel</button>&nbsp;
						</div>
					</div>
				</div>
			</div>  -->
			<?php 	
				if($flagtipoinforme == 1)
				{
					$sqlusuario = ($usuacodigo) ? " capaciusuario.usuacodi = '{$usuacodigo}'" : " capaciusuario.usuacodi IS NOT NULL";
					$sqldepartam = ($arrlstdepartam) ? " AND capaciusuario.departcodigo IN ({$arrlstdepartam})" : "";
					$sqlcursos = ($arrlstcursos) ? " AND capacitacion.cursocodigo IN ({$arrlstcursos})" : "";
					$sqltemas = ($arrlsttemas) ? " AND capacitema.temacodigo IN ({$arrlsttemas})" : "";
					
					
					$sbSql = "	SELECT DISTINCT capaciusuario.usuacodi FROM capaciusuario
									INNER JOIN capacitacion ON capacitacion.capacicodigo = capaciusuario.capacicodigo
									INNER JOIN capacitema ON capacitema.capacicodigo = capaciusuario.capacicodigo
								WHERE {$sqlusuario} {$sqldepartam} {$sqlcursos} {$sqltemas}";
					 
					$rsUsuarios = fncsqlrun($sbSql, $idcon);
					$nrUsuarios = fncnumreg($rsUsuarios);
					
					if($nrUsuarios > 0)
					{
						for($a = 0; $a < $nrUsuarios; $a++)
						{
							$rwUsuarios = fncfetch($rsUsuarios, $a);
			?> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="98%" style="margin-bottom: 5px;">
	  			<tr>
	    			<td class="ui-state-default">Empleado: <?php echo strtoupper(cargausuanombre($rwUsuarios['usuacodi'], $idcon)); ?></td>
				</tr>
				<tr>
					<td>
						<table width="100%" border="0" cellpadding="1" cellspacing="0" class="table_data">
							<tr>
								<td class="NoiseFooterTD cell_data_enc" width="10%">Fecha</td>
								<td class="NoiseFooterTD cell_data_enc" width="25%">Curso</td>
								<td class="NoiseFooterTD cell_data_enc" width="30%">Temas</td>
								<td class="NoiseFooterTD cell_data_enc" width="10%">Duraci&oacute;n</td>
								<td class="NoiseFooterTD cell_data_enc" width="25%">&Aacute;rea</td>
								<td class="NoiseFooterTD cell_data_enc" width="10%">Calificacion</td>
							</tr>
			<?php 
							//DB
							$sbSql = "	SELECT DISTINCT capacitacion.capacicodigo, capacitacion.capacifecini, capacitacion.capacihorini,
												capacitacion.cursocodigo, capaciusuario.*  FROM capacitacion 
											INNER JOIN capaciusuario ON capaciusuario.capacicodigo = capacitacion.capacicodigo
										WHERE
											capaciusuario.usuacodi = '{$rwUsuarios['usuacodi']}' AND
											capacitacion.capacifecini BETWEEN '{$consulfecini}' AND '{$consulfecfin}'
											{$sqlcursos}
										ORDER BY capacitacion.capacihorini, capacitacion.capacifecini";	
							
							$rsCapacitacion = fncsqlrun($sbSql, $idcon);
							$nrCapacitacion = fncnumreg($rsCapacitacion);
						
							for($b = 0; $b < $nrCapacitacion; $b++)
							{
								$rwCapacitacion = fncfetch($rsCapacitacion, $b);	
								
								$sbSql = "	SELECT DISTINCT capacitema.* FROM capacitema WHERE capacitema.capacicodigo = '{$rwCapacitacion['capacicodigo']}' {$sqltemas}";
								$rsCapacitema = fncsqlrun($sbSql, $idcon);
								$nrCapacitema = fncnumreg($rsCapacitema);
								
								if($nrCapacitema > 0)
								{
			?>
							<tr><td colspan="6" class="NoiseFooterTD cell_data_enc"></td></tr>
			<?php 
									for($c = 0; $c < $nrCapacitema; $c++)
									{
										$rwCapacitema = fncfetch($rsCapacitema, $c);
			?>
							<tr>
								<?php if($c < 1){ ?>
								<td class="NoiseDataTD cell_data" rowspan="<?php echo $nrCapacitema ?>">&nbsp;<?php echo $rwCapacitacion['capacifecini'] ?></td>
								<td class="NoiseDataTD cell_data" rowspan="<?php echo $nrCapacitema ?>">&nbsp;<?php echo cargacursonombre($rwCapacitacion['cursocodigo'], $idcon) ?></td>
								<?php } ?>
								<td class="NoiseDataTD cell_data">&nbsp;<?php echo (($rwCapacitema['temacodigo']) ? cargatemanombre($rwCapacitema['temacodigo'], $idcon) : '-----') ?></td>
								<td class="NoiseDataTD cell_data">&nbsp;<?php echo (($rwCapacitema['captemtiedur'] < 1) ? ($rwCapacitema['captemtiedur']*60).' min.': $rwCapacitema['captemtiedur'].' hr.') ?></td>
								<?php if($c < 1){ ?>
								<td class="NoiseDataTD cell_data" rowspan="<?php echo $nrCapacitema ?>">&nbsp;<?php echo cargadepartnombre($rwCapacitacion['departcodigo'], $idcon) ?></td>
								<td class="NoiseDataTD cell_data" rowspan="<?php echo $nrCapacitema ?>">&nbsp;<?php echo (($rwCapacitacion['capusucalifi']) ? $rwCapacitacion['capusucalifi'] : 'N/A') ?></td>
								<?php } ?>
							</tr>
			<?php		 
									}
								}
							}
			?>
							<tr><td colspan="6" class="NoiseFooterTD cell_data_enc"></td></tr>
						</table>
					</td>
				</tr>			
			</table>
			<?php 		
						}	
					} else {
			?>
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="98%" style="margin-bottom: 5px;">
				<tr><td class="ui-state-default">Empleado: <?php echo strtoupper(cargausuanombre($usuacodigo, $idcon)); ?></td></tr>
				<tr><td class="ui-state-default">&nbsp;No se encontraron datos registrados</td></tr>
			</table>
			<?php
					} 
				}
			?>
			<?php 	
				if($flagtipoinforme == 2)
				{
					$sqldepartam = ($arrlstdepartam) ? "capacitacion.departcodigo IN ({$arrlstdepartam})" : "capacitacion.departcodigo IS NOT NULL";
					$sqlcursos = ($arrlstcursos) ? " AND capacitacion.cursocodigo IN ({$arrlstcursos})" : "";
					$sqltemas = ($arrlsttemas) ? " AND capacitema.temacodigo IN ({$arrlsttemas})" : "";
					
					
					$sbSql = "	SELECT DISTINCT capacitacion.departcodigo FROM capacitacion
									INNER JOIN capacitema ON capacitema.capacicodigo = capacitacion.capacicodigo
								WHERE {$sqldepartam} {$sqlcursos} {$sqltemas}";
					 
					
					$rsDepartam = fncsqlrun($sbSql, $idcon);
					$nrDepartam = fncnumreg($rsDepartam);
					
					if($nrDepartam > 0)
					{
						for($a = 0; $a < $nrDepartam; $a++)
						{
							$rwDepartam = fncfetch($rsDepartam, $a);
			?> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="98%" style="margin-bottom: 5px;">
	  			<tr>
	    			<td class="ui-state-default">Area: <?php echo strtoupper(cargadepartnombre($rwDepartam['departcodigo'], $idcon)); ?></td>
				</tr>
				<tr>
					<td>
						<table width="100%" border="0" cellpadding="1" cellspacing="0" class="table_data">
							<tr>
								<td class="NoiseFooterTD cell_data_enc" width="10%">Fecha</td>
								<td class="NoiseFooterTD cell_data_enc" width="20%">Curso</td>
								<td class="NoiseFooterTD cell_data_enc" width="20%">Responsable</td>
								<td class="NoiseFooterTD cell_data_enc" width="20%">Temas</td>
								<td class="NoiseFooterTD cell_data_enc" width="20%">Instructor</td>
								<td class="NoiseFooterTD cell_data_enc" width="10%">Duraci&oacute;n</td>
							</tr>
			<?php 
							//DB
							$sbSql = "	SELECT DISTINCT capacitacion.capacicodigo, capacitacion.capacifecini, capacitacion.capacihorini,
												capacitacion.cursocodigo, capacitacion.usuacodi FROM capacitacion
										WHERE
											capacitacion.departcodigo = '{$rwDepartam['departcodigo']}' AND 
											capacitacion.capacifecini BETWEEN '{$consulfecini}' AND '{$consulfecfin}'
											{$sqlcursos}
										ORDER BY capacitacion.capacihorini, capacitacion.capacifecini";	
							
							$rsCapacitacion = fncsqlrun($sbSql, $idcon);
							$nrCapacitacion = fncnumreg($rsCapacitacion);
						
							for($b = 0; $b < $nrCapacitacion; $b++)
							{
								$rwCapacitacion = fncfetch($rsCapacitacion, $b);	
								
								$sbSql = "	SELECT DISTINCT capacitema.* FROM capacitema WHERE capacitema.capacicodigo = '{$rwCapacitacion['capacicodigo']}' {$sqltemas}";
								$rsCapacitema = fncsqlrun($sbSql, $idcon);
								$nrCapacitema = fncnumreg($rsCapacitema);
								
								if($nrCapacitema > 0)
								{
			?>
							<tr><td colspan="6" class="NoiseFooterTD cell_data_enc"></td></tr>
			<?php 
									for($c = 0; $c < $nrCapacitema; $c++)
									{
										$rwCapacitema = fncfetch($rsCapacitema, $c);
			?>
							<tr>
								<?php if($c < 1){ ?>
								<td class="NoiseDataTD cell_data" rowspan="<?php echo $nrCapacitema ?>">&nbsp;<?php echo $rwCapacitacion['capacifecini'] ?></td>
								<td class="NoiseDataTD cell_data" rowspan="<?php echo $nrCapacitema ?>">&nbsp;<?php echo cargacursonombre($rwCapacitacion['cursocodigo'], $idcon) ?></td>
								<td class="NoiseDataTD cell_data" rowspan="<?php echo $nrCapacitema ?>">&nbsp;<?php echo cargausuanombre($rwCapacitacion['usuacodi'], $idcon) ?></td>
								<?php } ?>
								<td class="NoiseDataTD cell_data">&nbsp;<?php echo (($rwCapacitema['temacodigo']) ? cargatemanombre($rwCapacitema['temacodigo'], $idcon) : '-----') ?></td>
								<td class="NoiseDataTD cell_data">&nbsp;<?php echo (($rwCapacitema['usuacodi']) ? cargausuanombre($rwCapacitema['usuacodi'], $idcon) : '-----') ?></td>
								<td class="NoiseDataTD cell_data">&nbsp;<?php echo (($rwCapacitema['captemtiedur'] < 1) ? ($rwCapacitema['captemtiedur']*60).' min.': $rwCapacitema['captemtiedur'].' hr.') ?></td>
							</tr>
			<?php		 
									}
								}
							}
			?>
							<tr><td colspan="6" class="NoiseFooterTD cell_data_enc"></td></tr>
						</table>
					</td>
				</tr>			
			</table>
			<?php 		
						}	
					} else {
			?>
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="98%" style="margin-bottom: 5px;">
				<tr><td class="ui-state-default">&nbsp;No se encontraron datos registrados</td></tr>
			</table>
			<?php
					} 
				}
			?>
			<?php 	
				if($flagtipoinforme == 3)
				{
					$sqlcursos = ($arrlstcursos) ? "capacitacion.cursocodigo IN ({$arrlstcursos})" : "capacitacion.cursocodigo IS NOT NULL";
					$sqldepartam = ($arrlstdepartam) ? " AND capacitacion.departcodigo IN ({$arrlstdepartam})" : "";
					$sqltemas = ($arrlsttemas) ? " AND capacitema.temacodigo IN ({$arrlsttemas})" : "";
					
					$sbSql = "	SELECT DISTINCT capacitacion.cursocodigo FROM capacitacion
									INNER JOIN capacitema ON capacitema.capacicodigo = capacitacion.capacicodigo
								WHERE {$sqlcursos} {$sqldepartam} {$sqltemas}";
					 
					$rsCurso = fncsqlrun($sbSql, $idcon);
					$nrCurso = fncnumreg($rsCurso);
					
					if($nrCurso > 0)
					{
						for($a = 0; $a < $nrCurso; $a++)
						{
							$rwCurso = fncfetch($rsCurso, $a);
			?> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="98%" style="margin-bottom: 5px;">
	  			<tr>
	    			<td class="ui-state-default">Curso: <?php echo strtoupper(cargacursonombre($rwCurso['cursocodigo'], $idcon)); ?></td>
				</tr>
				<tr>
					<td>
						<table width="100%" border="0" cellpadding="1" cellspacing="0" class="table_data">
							<tr>
								<td class="NoiseFooterTD cell_data_enc" width="10%">Fecha</td>
								<td class="NoiseFooterTD cell_data_enc" width="20%">Area</td>
								<td class="NoiseFooterTD cell_data_enc" width="20%">Responsable</td>
								<td class="NoiseFooterTD cell_data_enc" width="20%">Temas</td>
								<td class="NoiseFooterTD cell_data_enc" width="20%">Instructor</td>
								<td class="NoiseFooterTD cell_data_enc" width="10%">Duraci&oacute;n</td>
							</tr>
			<?php 
							//DB
							$sbSql = "	SELECT DISTINCT capacitacion.capacicodigo, capacitacion.capacifecini, capacitacion.capacihorini,
												capacitacion.departcodigo, capacitacion.usuacodi FROM capacitacion
										WHERE
											capacitacion.cursocodigo = '{$rwCurso['cursocodigo']}' AND 
											capacitacion.capacifecini BETWEEN '{$consulfecini}' AND '{$consulfecfin}'
											{$sqldepartam}
										ORDER BY capacitacion.capacihorini, capacitacion.capacifecini";	
							
							$rsCapacitacion = fncsqlrun($sbSql, $idcon);
							$nrCapacitacion = fncnumreg($rsCapacitacion);
						
							for($b = 0; $b < $nrCapacitacion; $b++)
							{
								$rwCapacitacion = fncfetch($rsCapacitacion, $b);	
								
								$sbSql = "	SELECT DISTINCT capacitema.* FROM capacitema WHERE capacitema.capacicodigo = '{$rwCapacitacion['capacicodigo']}' {$sqltemas}";
								$rsCapacitema = fncsqlrun($sbSql, $idcon);
								$nrCapacitema = fncnumreg($rsCapacitema);
								
								if($nrCapacitema > 0)
								{
			?>
							<tr><td colspan="6" class="NoiseFooterTD cell_data_enc"></td></tr>
			<?php 
									for($c = 0; $c < $nrCapacitema; $c++)
									{
										$rwCapacitema = fncfetch($rsCapacitema, $c);
			?>
							<tr>
								<?php if($c < 1){ ?>
								<td class="NoiseDataTD cell_data" rowspan="<?php echo $nrCapacitema ?>">&nbsp;<?php echo $rwCapacitacion['capacifecini'] ?></td>
								<td class="NoiseDataTD cell_data" rowspan="<?php echo $nrCapacitema ?>">&nbsp;<?php echo cargadepartnombre($rwCapacitacion['departcodigo'], $idcon) ?></td>
								<td class="NoiseDataTD cell_data" rowspan="<?php echo $nrCapacitema ?>">&nbsp;<?php echo cargausuanombre($rwCapacitacion['usuacodi'], $idcon) ?></td>
								<?php } ?>
								<td class="NoiseDataTD cell_data">&nbsp;<?php echo (($rwCapacitema['temacodigo']) ? cargatemanombre($rwCapacitema['temacodigo'], $idcon) : '-----') ?></td>
								<td class="NoiseDataTD cell_data">&nbsp;<?php echo (($rwCapacitema['usuacodi']) ? cargausuanombre($rwCapacitema['usuacodi'], $idcon) : '-----') ?></td>
								<td class="NoiseDataTD cell_data">&nbsp;<?php echo (($rwCapacitema['captemtiedur'] < 1) ? ($rwCapacitema['captemtiedur']*60).' min.': $rwCapacitema['captemtiedur'].' hr.') ?></td>
							</tr>
			<?php		 
									}
								}
							}
			?>
							<tr><td colspan="6" class="NoiseFooterTD cell_data_enc"></td></tr>
						</table>
					</td>
				</tr>			
			</table>
			<?php 		
						}	
					} else {
			?>
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="98%" style="margin-bottom: 5px;">
				<tr><td class="ui-state-default">&nbsp;No se encontraron datos registrados</td></tr>
			</table>
			<?php
					} 
				}
			?>
			<input type="hidden" name="arrusuaplanta" id="arrusuaplanta" value="<?php echo $arrusuaplanta ?>">
			<input type="hidden" name="arrusuatipotrab" id="arrusuatipotrab" value="<?php echo $arrusuatipotrab ?>">
			<input type="hidden" name="consulfecini" id="consulfecini" value="<?php echo $consulfecini ?>">
			<input type="hidden" name="consulfecfin" id="consulfecfin" value="<?php echo $consulfecfin ?>">
			<input type="hidden" name="lsttecnico" id="lsttecnico" value="<?php echo $lsttecnico ?>">
			<input type="hidden" name="flagtipoinforme" id="flagtipoinforme" value="<?php echo $flagtipoinforme ?>">
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
<!--		<div id="msgwindowait" title="Adsum Kallpa [Gestion de mantenimiento]"><span id="msgwait"><img src="../img/loading.gif">&nbsp;Espere mientras se genera el archivo excel</span></div>-->
	</body>
</html>