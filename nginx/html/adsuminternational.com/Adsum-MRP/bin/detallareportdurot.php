<?php
	include ('../src/FunGen/sesion/fncvalsesion.php');
	include ('../src/FunPerSecNiv/fncnumreg.php');
	include ('../src/FunPerSecNiv/fncfetch.php');
	include ('../src/FunPerSecNiv/fncfetchall.php');
	include ('../src/FunGen/cargainput.php');
	include '../src/FunPerSecNiv/fncsqlrun.php';
	include ('../src/FunGen/fncdatediff.php');
	
	include '../src/FunPerPriNiv/pktblusuario.php';
	include '../src/FunPerPriNiv/pktblplanta.php';
	include '../src/FunPerPriNiv/pktblotestado.php';
	include '../src/FunPerPriNiv/pktblsistema.php';
	include '../src/FunPerPriNiv/pktblequipo.php';
	include '../src/FunPerPriNiv/pktbltipotrab.php';
	include '../src/FunPerPriNiv/pktbltipomant.php';	
//	
//	//++++++++
//	
	if(empty($arrusuaplanta)) $arrusuaplanta = $usuaplanta;
	if(empty($arrusuatipotrab)) $arrusuatipotrab = $usuatipotrab;

	
	$idcon = fncconn();
	
	$sbSql = "	SELECT DISTINCT ot.*, tareot.tiptracodigo
				FROM ot 
					LEFT JOIN tareot ON tareot.ordtracodigo = ot.ordtracodigo 
					LEFT JOIN usuariotareot ON usuariotareot.tareotcodigo = tareot.tareotcodigo
					LEFT JOIN planta ON planta.plantacodigo = ot.plantacodigo
				WHERE 
					ot.plantacodigo IN ({$arrusuaplanta}) AND 
					tareot.tareotfecini BETWEEN '{$consulfecini}' AND '{$consulfecfin}' AND 
					tareot.tiptracodigo IN ({$arrusuatipotrab}) AND 
					tareot.tareotsecuen = '0'
				ORDER BY ot.ordtracodigo";
	
	$rsOt = fncsqlrun($sbSql, $idcon);
	$nrOt = fncnumreg($rsOt);
	
	$arrsubPlantas = explode(',', $arrusuaplanta);
	
	
	include ( '../src/FunPerPriNiv/pktbltareot.php');

?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
		<title>Informe mensual</title>
		<style type="text/css">
			body { magin: 60px }
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
	<body>
		<table width="95%" border="0" cellpadding="1" cellspacing="1" align="center">
			<tr><td colspan="2">&nbsp;</td></tr>
        	<tr><td colspan="2"><strong>DURACI&Oacute;N DEL TRABAJO</strong></td></tr>
        	<tr><td colspan="2">&nbsp;</td></tr>
        	<tr>
          		<td colspan="2">
          			<table width="200" border="0" cellpadding="0" cellspacing="0" class="table_data">
            			<tr><td class="NoiseFieldCaptionTD" colspan="3" align="center"><font color="ffffff">FECHA</font></td></tr>
            			<tr>
              				<td class="NoiseFooterTD cell_data_enc" width="66" align="center">DIA</td>
              				<td class="NoiseFooterTD cell_data_enc" width="66" align="center">MES</td>
              				<td class="NoiseFooterTD cell_data_enc" width="66" align="center">A&Ntilde;O</td>
            			</tr>
            			<tr>
			              	<td class="NoiseDataTD cell_data_enc"><?php echo date('d')  ?></td>
			              	<td class="NoiseDataTD cell_data_enc"><?php echo date('m')  ?></td>
			              	<td class="NoiseDataTD cell_data_enc"><?php echo date('Y')  ?></td>
            			</tr>
          			</table>
          		</td>
        	</tr>
        	<tr><td colspan="2">&nbsp;</td></tr>
			<tr>
				<td width="15%" class="NoiseFooterTD">&nbsp;Planta</td>
				<td width="85%">
					<table width="100%" border="0" cellpadding="1" cellspacing="0">
						<?php for($a = 0; $a < count($arrsubPlantas); $a++, $a++, $a++): ?>
            			<tr>
              				<td class="NoiseFooterTD cell_data_enc" width="30%">&nbsp;<?php echo cargaplantanombre($arrsubPlantas[$a], $idcon) ?></td>
              				<td class="NoiseFooterTD cell_data_enc" width="5%">&nbsp;</td>
              				<td class="NoiseFooterTD cell_data_enc" width="30%">&nbsp;<?php echo cargaplantanombre($arrsubPlantas[$a + 1], $idcon) ?></td>
              				<td class="NoiseFooterTD cell_data_enc" width="5%">&nbsp;</td>
              				<td class="NoiseFooterTD cell_data_enc" width="30%">&nbsp;<?php echo cargaplantanombre($arrsubPlantas[$a + 2], $idcon) ?></td>
            			</tr>
            			<?php endfor; ?>
          			</table>				
				</td>
			</tr>
			<tr>
          		<td class="NoiseFooterTD">&nbsp;Periodo</td>
          		<td class="NoiseDataTD">&nbsp;Desde&nbsp;<?php echo $consulfecini ?>&nbsp;&nbsp;Hasta&nbsp;<?php echo $consulfecfin ?></td>
        	</tr>
        	<tr>
          		<td class="NoiseFooterTD">&nbsp;Numero de ordenes</td>
          		<td class="NoiseDataTD">&nbsp;<?php echo $nrOt ?></td>
        	</tr>
        	<tr>
          		<td class="NoiseFooterTD">&nbsp;Generado por.</td>
          		<td class="NoiseDataTD">&nbsp;<?php echo cargausuanombre ( $usuacodi, $idcon ) ?></td>
        	</tr>
        	<tr><td colspan="2">&nbsp;</td></tr>
			<tr>
				<td colspan="2">
					<table width="100%" border="0" cellpadding="1" cellspacing="0" class="table_data">
						<tr>
							<td class="NoiseFooterTD cell_data_enc">#</td>
							<td class="NoiseFooterTD cell_data_enc"># Orden</td>
							<td class="NoiseFooterTD cell_data_enc">Proceso</td>
							<td class="NoiseFooterTD cell_data_enc">Equipo</td>
							<td class="NoiseFooterTD cell_data_enc">Mantenimiento</td>
							<td class="NoiseFooterTD cell_data_enc">Tipo trabajo</td>
							<td class="NoiseFooterTD cell_data_enc">Estado actual</td>
							<td class="NoiseFooterTD cell_data_enc">Dur. trabajo</td>
							<td class="NoiseFooterTD cell_data_enc">Dur. Estimado</td>
						</tr>
						<?php 
							if($nrOt > 0):
							
								$idcon = fncconn();
								
								for($a = 0; $a < $nrOt; $a++):	
									$rwOt = fncfetch($rsOt, $a);
									unset($badeja);
									
									if($rwOt['ordtraprogen'] != 't'):
										
										$sbSql = "	SELECT tareot.*, otestado.otestanombre, otestado.otestatipo FROM tareot, otestado 
													WHERE  ordtracodigo = '{$rwOt['ordtracodigo']}' AND otestado.otestacodigo = tareot.otestacodigo ORDER BY tareotsecuen";
	
										$rsTareot = fncsqlrun($sbSql, $idcon);
										$nrTareot = fncnumreg($rsTareot);
										$rwTareots = fncfetchall($rsTareot);
										
										$time_all = 0;
										$time_ot = 0;
										unset($estimado);
										
										for($b = 0; $b < $nrTareot; $b++):
											if($rwTareots[$b + 1]['tareotfecini']):
												$min = 0;
			            		
												$fecha_a = $rwTareots[$b]['tareotfecini'].' '.$rwTareots[$b]['tareothorini'];
												$fecha_b = $rwTareots[$b + 1]['tareotfecini'].' '.$rwTareots[$b + 1]['tareothorini'];
												
												$d1 = datediff('n', $fecha_a, $fecha_b);
												$d2 = datediff('d', $fecha_a, $fecha_b);
												$d3 = ($d1 - ($d2 * 24 * 60));
												($d3 > 0) ? $dias = $d2 + 1 : $dias = $d2;
						            			$tmp_time = 0;
						            			
						            			for($c = 0; $c <= $dias; $c++):
						            				if($fecha_b >= date("Y-m-d H:i", strtotime($rwTareots[$b]['tareotfecini']." 16:30 + ".$c." days"))):
							            				if($fecha_a < $fecha_b):
							            					$tmp_time += datediff('n', $fecha_a, date("Y-m-d H:i", strtotime($rwTareots[$b]['tareotfecini']." 16:30 + ".$c." days")));
							            					$fecha_a = date("Y-m-d H:i", strtotime($rwTareots[$b]['tareotfecini']." 07:00 + ".($c + 1)." days"));
							            				endif;
						            				else:
						            					$tmp_time += datediff('n', $fecha_a, $fecha_b);
						            					break;
						            				endif;
						            			endfor;
			            					else:
			            						$tmp_time = 0;
			            					endif;
			            					
											$time_all +=  $tmp_time;
											
											if($rwTareots[$b]['otestatipo'] == 2 && $tmp_time > 0)
												$time_ot += $tmp_time;
												
											if($rwTareots[$b]['otestatipo'] == 6 || $rwTareots[$b]['otestatipo'] == 3 || $rwTareots[$b]['otestatipo'] == 4)
												$otestado = '<b>'.$rwTareots[$b]['otestanombre'].'</b>';
											else	
												$otestado = $rwTareots[$b]['otestanombre'];
												
											if($rwTareots[$b]['tareottiedur'] && !$estimado)
												$estimado = $rwTareots[$b]['tareottiedur'];
										endfor;
										
										$time = explode('.', ($time_ot / 60));
										
				            			if($time[1])
				            				$err = @eval("\$min = (round(((0.$time[1]) * 60) * 100) / 100);");
					            		
				            			$min_est = 0;
				            				
										if(!$estimado):
											$estimado = datediff('h', $rwOt['ordtrafecini'].' '.$rwOt['ordtrahorini'], $rwOt['ordtrafecfin'].' '.$rwOt['ordtrahorfin']);
											
											$fecha_a = $rwOt['ordtrafecini'].' '.$rwOt['ordtrahorini'];
											$fecha_b = $rwOt['ordtrafecfin'].' '.$rwOt['ordtrahorfin'];
											
					            			$dias = datediff('d', $fecha_a, $fecha_b);
					            			
					            			if($dias == '0' && datediff('n', $fecha_a, $fecha_b) < 1440)
					            				$dias = 1;
					            			
					            			$tmp_time = 0;
					            			
					            			for($c = 0; $c <= $dias; $c++):
					            				if($fecha_b >= date("Y-m-d H:i", strtotime($rwOt['ordtrafecini']." 16:30 + ".$c." days"))):
						            				if($fecha_a < $fecha_b):
						            					$tmp_time += datediff('n', $fecha_a, date("Y-m-d H:i", strtotime($rwOt['ordtrafecini']." 16:30 + ".$c." days")));
						            					$fecha_a = date("Y-m-d H:i", strtotime($rwOt['ordtrafecini']." 07:00 + ".($c + 1)." days"));
						            				endif;
					            				else:
					            					$tmp_time += datediff('n', $fecha_a, $fecha_b);
					            					break;
					            				endif;
					            			endfor;
					            			
					            			$time_est = explode('.', ($tmp_time / 60));
					            			($time_est[1]) ? $err = @eval("\$min_est = (round(((0.$time_est[1]) * 60) * 100) / 100);") : $err = null;
					            				
										else:
											$time_est[0] = $estimado;
										endif;
									else:
										$badeja = 1;
									endif;
									
						?>
						<tr>
							<td class="NoiseDataTD cell_data">&nbsp;<?php echo ($a + 1) ?></td>
							<td class="NoiseDataTD cell_data">&nbsp;<?php echo $rwOt['ordtracodigo'] ?></td>
							<td class="NoiseDataTD cell_data">&nbsp;<?php echo cargasistemnombre($rwOt['sistemcodigo'], $idcon) ?></td>
							<td class="NoiseDataTD cell_data">&nbsp;<?php echo cargaequiponombre($rwOt['equipocodigo'], $idcon) ?></td>
							<td class="NoiseDataTD cell_data">&nbsp;<?php echo cargatipmannombre1($rwOt['tipmancodigo'], $idcon) ?></td>
							<td class="NoiseDataTD cell_data">&nbsp;<?php echo cargatiptrabnombre($rwOt['tiptracodigo'], $idcon) ?></td>
							<?php if(!$badeja): ?>
							<td class="NoiseDataTD cell_data">&nbsp;<?php echo $otestado ?></td>
							<td class="NoiseDataTD cell_data">&nbsp;<?php echo $time[0].' hr(s). '//.$min.' min.'; ?></td>
							<?php else: ?>
							<td class="NoiseDataTD cell_data" colspan="2">&nbsp;<b>Programado: En bandeja</b></td>
							<?php endif; ?>
							<td class="NoiseDataTD cell_data">&nbsp;<?php echo $time_est[0].' hr(s). '//.$min_est.' min.'; ?></td>
						</tr>
						<?php 	
								endfor;
							endif; 		 ?>
					</table>
				</td>
			</tr>
			<tr><td colspan="2">&nbsp;</td></tr>
        	<tr><td colspan="2">OBSERVACIONES</td></tr>
        	<tr>
          		<td colspan="2">
          			<table width="100%" border="0" cellpadding="2" cellspacing="0" class="table_data">
            			<tr><td class="cell_data">&nbsp;</td></tr>
            			<tr><td class="cell_data">&nbsp;</td></tr>
            			<tr><td class="cell_data">&nbsp;</td></tr>
            			<tr><td class="cell_data">&nbsp;</td></tr>
            			<tr><td class="cell_data">&nbsp;</td></tr>
            			<tr><td class="cell_data">&nbsp;</td></tr>
            			<tr><td class="cell_data">&nbsp;</td></tr>
          			</table>
          		</td>
        	</tr>
        	<tr><td colspan="2">&nbsp;</td></tr>
        	<tr><td colspan="2">&nbsp;</td></tr>
        	<tr><td colspan="2">&nbsp;_________________________________________________</td></tr>
        	<tr><td colspan="2">&nbsp;FIRMA JEFE DE MANTENIMIENTO PLANTA</td></tr>
        	<tr><td colspan="2">&nbsp;</td></tr>
      	</table>
      	<div align="center">
      		<input type="image" name="imprimir" src="../img/imprimir.gif" onClick='window.print();'  width="86" height="18" alt="Imprimir" border="0">
      	</div>
	</body>
</html>
