<?php
/*
 -Todos los derechos reservados-
 Propiedad intelectual de Adsum (c).
 Funcion         : grabareporte
 Decripcion      : Valida la data a grabar y la lleva al paquete.
 Parametros      : Descripicion
 $iRegreporte         Arreglo de datos.
 $flagnuevoreporte    Bandera de validacion
 Retorno         :
 true	= 1
 false	= 0
 Autor           : ariascos
 Escrito con     : WAG Adsum versi�n 3.1.1
 Fecha           : 18082004
 Historial de modificaciones
 | Fecha | Motivo				| Autor 	|
 */
	include ('../src/FunGen/cargainput.php');
	include ('../src/FunGen/fncformat.php');
	include ('../src/FunPerPriNiv/pktblusuario.php');
	include ('../src/FunGen/sesion/fncvalsesion.php');
	include ('../src/FunPerPriNiv/pktbltipotrab.php');
	include ('../src/FunPerPriNiv/pktblplanta.php');
	include ('../src/FunPerPriNiv/pktblotestado.php');
	include ('../src/FunPerSecNiv/fncsqlrun.php');
	include ('../src/FunPerSecNiv/fncnumreg.php');
	include ('../src/FunPerSecNiv/fncfetch.php');

// -------- Se construye la consulta --------
	$idcon = fncconn ();
	$fecini = $data_ano.'-'.$data_mes.'-01';
	$fecfin = $data_ano.'-'.$data_mes.'-'.strftime("%d", mktime(0, 0, 0, $data_mes + 1, 0, $data_ano));
	$arrOtEjec = array();
	$arrOtMeta = array();
	$arrProgEj = array();
	$prjProgramacion = array();
	$prjChequeo = array();
	$arr_method = array_keys($_POST);
	$Otgenera_total = 0;
	$otestacodigo  = cargaotestadotipo(6, $idcon); //Anulado
	
	for($i = 0; $i < count($arr_method); $i++): 
		if (ereg("tipotrab", $arr_method[$i]))
			($inttipotrab)	? $inttipotrab .= ','.substr($arr_method[$i], 8) : $inttipotrab = substr($arr_method[$i], 8);
	endfor;
	
	$arrTipotrab = explode(",", $inttipotrab);
	
	$sbSql = "	SELECT 
						programacion.prografrecue, 
						tipomedi.tipmeddescri, 
						tipomedi.tipmedtiempo, 
						programacion.prografechfutur,
						tareot.tiptracodigo,
						programacion.progracodigo
					FROM 
						tareot, 
						programacion, 
						tipomedi 
					WHERE 
						programacion.equipocodigo IN (SELECT equipocodigo FROM vistaequipoplanta LEFT JOIN estado ON estado.estadocodigo = vistaequipoplanta.estadocodigo WHERE vistaequipoplanta.plantacodigo IN (".$arrplantas."))
						AND tareot.progracodigo = programacion.progracodigo 
						AND tareot.ordtracodigo IS NULL 
						AND tareot.tiptracodigo IN (".$inttipotrab.") 
						AND tipomedi.tipmedcodigo = programacion.tipmedcodigo
						AND programacion.prograacti = '1'";

	$rsMeta = fncsqlrun($sbSql, $idcon);
	$nrMeta = fncnumreg($rsMeta);
	
	for($a = 0; $a < $nrMeta; $a++ ):
		$rwMeta = fncfetch($rsMeta, $a);	
		$iniProject = $rwMeta['prografechfutur'];
		$ranProject = $rwMeta['tipmeddescri'] * $rwMeta['prografrecue'];

		switch ($rwMeta['tipmedtiempo']):
			case 1 : $regOp = "minutes"; break; //Minutos
			case 2 : $regOp = "hours"; break;//Horas
			case 3 : $regOp = "days"; break;//Dias
			case 4 : $regOp = "months"; break;//Meses
		endswitch;
									
		for(;;):
			$iniProject = date("Y-m-d", strtotime($iniProject.' + '.$ranProject." ".$regOp));
			
			if(date("Y-m-d", strtotime($iniProject)) <= date("Y-m-d", strtotime($fecfin))):
				if(date("Y-m-d", strtotime($iniProject)) >= date("Y-m-d", strtotime($fecini))):
					$arrProgEj[$rwMeta['progracodigo']] ++;
					$prjProgramacion[$rwMeta['tiptracodigo']][$rwMeta['progracodigo']] = 1;
				endif;					
			else:
				break;
			endif;
		endfor;
	endfor;
	
	foreach($prjProgramacion as $tiptracodigo => $arrProgracodigo):
		foreach($arrProgracodigo as $progracodigo => $value):
			$arrMetaDato = 0;
			//$sbSql = "SELECT * FROM  historiarutinas WHERE progracodigo = '{$rwMeta['progracodigo']}' AND hisrutfeceje = '".date("Y-m-d", strtotime($iniProject))."'";
			$sbSql = "SELECT * FROM  historiarutinas WHERE progracodigo = '{$progracodigo}' AND hisrutfeceje BETWEEN '".date("Y-m-d", strtotime($fecini))."' AND '".date("Y-m-d", strtotime($fecfin))."'";
			$rsHistprog = fncsqlrun($sbSql, $idcon);
			$nrHistprog = fncnumreg($rsHistprog);
			
			for($b = 0; $b < $nrHistprog; $b++):
				$rwHistprog = fncfetch($rsHistprog, $b);
				
				if($rwHistprog['ordtracodigo']):		//Valida si la programacion genero orden, en caso que no se genere no lo cuenta en la Meta
					$arrOtMeta[$tiptracodigo] ++; 	//Este caso se presente en el momento que el equipo se encuentre en 'Fuera de Servicio'
					$arrMetaDato ++;
				endif;
			endfor;
			
			$prjChequeo[$tiptracodigo][] = array(
					'progracodigo' => $progracodigo,
					'projectado' => $arrProgEj[$progracodigo],
					'registrado' => $nrHistprog,
					'ejecutado' => $arrMetaDato
			);
		endforeach;
	endforeach;

	//codigo para verificar si las projecciones las esta haciendo correctamente...
//	foreach($prjChequeo as $key => $fli)
//		for($c = 0; $c < count($fli); $c++)
//			echo $key.','.$fli[$c]['progracodigo'].','.$fli[$c]['projectado'].','.$fli[$c]['registrado'].','.$fli[$c]['ejecutado'].'<br>';

	$arrsubPlantas = explode(",", $arrplantas);
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
		</style>
	</head>
	<body>
		<table width="95%" border="0" cellpadding="0" cellspacing="1" bordercolor="#000000">
			<tr><td colspan="2">&nbsp;</td></tr>
        	<tr><td colspan="2"><strong>INDICE DE CUMPLIMIENTO DE MANTENIMIENTO PREVENTIVO</strong></td></tr>
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
          		<td class="NoiseDataTD">&nbsp;Desde&nbsp;<?php echo $fecini ?>&nbsp;&nbsp;Hasta&nbsp;<?php echo $fecfin ?></td>
        	</tr>
        	<tr>
          		<td class="NoiseFooterTD">&nbsp;Generado por.</td>
          		<td class="NoiseDataTD">&nbsp;<?php echo cargausuanombre ( $usuacodi, $idcon ) ?></td>
        	</tr>
        	<tr><td colspan="2">&nbsp;</td></tr>
        	<tr>
          		<td colspan="2">
					<table width="100%" border="0" cellpadding="1" cellspacing="0" class="table_data">
						<tr><td class="NoiseFooterTD cell_data_enc" align="center">PROGRAMA DE MANTENIMIENTO PREVENTIVO</td></tr>
					</table>
					<table width="100%" border="0" cellpadding="1" cellspacing="0" class="table_data">
						<tr>
							<td class="NoiseFooterTD cell_data_enc">TIPO DE TRABAJO</td>
							<td class="NoiseFooterTD cell_data_enc">META</td>
							<td class="NoiseFooterTD cell_data_enc">EJECUTADAS</td>
							<td class="NoiseFooterTD cell_data_enc">ANULADAS</td>
							<td class="NoiseFooterTD cell_data_enc">%EJECUCI&Oacute;N</td>
						</tr>
						<?php
							for($o = 0; $o < count($arrTipotrab); $o++):
	
								$sbSql = "	SELECT tareot.tiptracodigo, ot.ordtracodigo, tareot.progracodigo, reportot.reportcodigo, cierreot.cierotcodigo, cierreot.cierotfecfin
											FROM 
												ot LEFT JOIN tareot ON (tareot.ordtracodigo = ot.ordtracodigo) 
												LEFT JOIN reportot ON (reportot.ordtracodigo = ot.ordtracodigo ) 
												LEFT JOIN cierreot ON (cierreot.reportcodigo = reportot.reportcodigo)
											WHERE 
												ot.plantacodigo IN ({$arrplantas})
												AND ot.ordtrafecini BETWEEN '{$fecini}' AND '{$fecfin}'
												AND tareot.tareotsecuen = 0
												AND tareot.tiptracodigo IN ({$arrTipotrab[$o]}) 
												AND ot.ordtranumpro IS NOT NULL";
	
								$rsEjeot = fncsqlrun($sbSql, $idcon);
								$nrEjeot = fncnumreg($rsEjeot);
								unset($arrOtEjec);
								
								for($a = 0; $a < $nrEjeot; $a++):
									$rwEjeot = fncfetch($rsEjeot, $a);
									
									if(array_key_exists($rwEjeot['progracodigo'], $arrProgEj)):
										if(!$rwEjeot['cierotcodigo'] && !$rwEjeot['reportcodigo']):
											$sbSql = "SELECT otestacodigo FROM vistamaxtareot WHERE ordtracodigo = '{$rwEjeot['ordtracodigo']}' AND otestacodigo = '{$otestacodigo}'";
											$rsEstado = fncsqlrun($sbSql, $idcon);
											$nrEstado = fncnumreg($rsEstado);
											
											if($nrEstado > 0):
												$arrOtEjec[$rwEjeot['tiptracodigo']]['anuladas'] ++; $Otcumpli_total++;
											else:
												$arrOtEjec[$rwEjeot['tiptracodigo']]['nocerradas'] ++;
											endif;
										elseif(!$rwEjeot['cierotcodigo'] && $rwEjeot['reportcodigo']):
											$arrOtEjec[$rwEjeot['tiptracodigo']]['nocerradas'] ++;
										else:
											if($rwEjeot['cierotfecfin'] > $fecfin)
												$arrOtEjec[$rwEjeot['tiptracodigo']]['cerradasfuera'] ++;
											else
											{
												$arrOtEjec[$rwEjeot['tiptracodigo']]['cerradas'] ++; $Otcumpli_total++;
											}
										endif;
									endif; 
								endfor;
								
								//En caso que una programacion no se encuentre registrado en la tabla de 'historiarutinas' [Excepcion aceptable para el mes de Agosto de 2011 hacia atras...] Para cuadrar los informes de mantenimiento
								if($arrOtMeta[$arrTipotrab[$o]] < ($arrOtEjec[$arrTipotrab[$o]]['cerradas'] + $arrOtEjec[$arrTipotrab[$o]]['anuladas'])):
									$arrOtMeta[$arrTipotrab[$o]] = $arrOtEjec[$arrTipotrab[$o]]['cerradas'] + $arrOtEjec[$arrTipotrab[$o]]['anuladas'];
								endif;
								//En caso que una programacion no se encuentre registrado en la tabla de 'historiarutinas' [Excepcion aceptable para el mes de Agosto de 2011 hacia atras...] Para cuadrar los informes de mantenimiento
								
								$Otgenera_total += $arrOtMeta[$arrTipotrab[$o]];
						?>	
						<tr>
							<td class="NoiseDataTD cell_data"><?php echo cargatiptrabnombre($arrTipotrab[$o], $idcon) ?></td>
							<td class="NoiseDataTD cell_data"><?php echo (int) $arrOtMeta[$arrTipotrab[$o]] ?></td>
							<td class="NoiseDataTD cell_data"><?php echo (int) $arrOtEjec[$arrTipotrab[$o]]['cerradas'] ?></td>
							<td class="NoiseDataTD cell_data"><?php echo (int) $arrOtEjec[$arrTipotrab[$o]]['anuladas'] ?></td>
							<td class="NoiseDataTD cell_data"><?php echo droundCurrency(($arrOtEjec[$arrTipotrab[$o]]['cerradas'] * 100) / $arrOtMeta[$arrTipotrab[$o]]) ?> %</td>
						</tr>
						<?php 
							endfor; ?>
					</table>
				</td>
			</tr>
			<tr><td colspan="2">&nbsp;</td></tr>
        	<tr>
          		<td colspan="2">
          			<table width="100%" border="0" cellpadding="1" cellspacing="0" class="table_data">
            			<tr>
              				<td class="NoiseErrorDataTD cell_data" width="40%">TOTAL DE OT PREVENTIVAS PROGRAMADAS</td>
              				<td class="cell_data" width="10%" align="center"><?php echo $Otgenera_total ?></td>
              				<td class="NoiseErrorDataTD cell_data" width="40%">TOTAL DE OT PREVENTIVAS PROGRAMADAS REALIZADAS</td>
              				<td class="cell_data" width="10%" align="center"><?php echo $Otcumpli_total ?></td>
            			</tr>
          			</table>
          		</td>
        	</tr>
        	<tr><td colspan="2">&nbsp;</td></tr>
        	<tr>
          		<td colspan="2">
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
              				<td width="30%">
			          			<table width="100%" border="0" cellpadding="1" cellspacing="0"  class="table_data">
            						<tr>
            							<td class="NoiseColumnTD cell_data">% OT Ejecutadas</td>
			              				<td align="center" class="cell_data">
			              				<?php
              								if ($Otgenera_total && $Otcumpli_total): 
												($Otcumpli_total > $Otgenera_total) ? $OtValAb = $Otgenera_total : $OtValAb = $Otcumpli_total;
												$PorcEjec = ($OtValAb * 100) / $Otgenera_total;
											else: 
												$PorcEjec = " -- ";
											endif;		
											
											echo droundCurrency($PorcEjec); 
										?>&nbsp;%</td>
									</tr>
									<tr>
			              				<td class="NoiseColumnTD">% OT no Ejecutadas</td>
			              				<td align="center" class="cell_data">
										<?php
											($PorcEjec) ? $PorcNoEje = 100 - $PorcEjec : $PorcNoEje = " -- ";
											echo droundCurrency($PorcNoEje);
										?>&nbsp;%</td>
            						</tr>
			          			</table>
							</td>
							<td width="10%">&nbsp;</td>
							<td width="60%">
			          			<table width="100%" border="0" cellpadding="1" cellspacing="0"  class="table_data">
									<tr>
			              				<td width="44%" class="NoiseColumnTD cell_data">Porcentaje aceptable</td>
										<td width="56%" class="cell_data" align="center">90%</td>
				            		</tr>		
            						<tr>
              							<td class="NoiseColumnTD cell_data">F&oacute;rmula de cumplimiento de preventivo</td>
              							<td class="cell_data">∑ OT cumplidas *100/∑ Total de metas</td>
            						</tr>
          						</table>
          					</td>
          				</tr>
          			</table>
          		</td>
        	</tr>
        	<tr><td colspan="2">&nbsp;</td></tr>
        	<tr><td colspan="2">OBSERVACIONES</td>
			<tr><td colspan="2"><textarea name="text" cols="75" rows="7" wrap="VIRTUAL"></textarea></td></tr>
			<tr><td colspan="2">&nbsp;</td></tr>
        	<tr><td colspan="2">&nbsp;</td></tr>
        	<tr><td colspan="2">&nbsp;_________________________________________________</td></tr>
        	<tr><td colspan="2">&nbsp;FIRMA JEFE DE MANTENIMIENTO PLANTA</td></tr>
        	<tr><td colspan="2">&nbsp;</td></tr>
        	<tr><td colspan="2" align="right">____________________________________________________</td>
        	<tr><td colspan="2" align="right"></td>
        	
			<tr><td colspan="2"><div align="center">
      				<input type="image" name="imprimir" src="../img/imprimir.gif" onClick='window.print();'  width="86" height="18" alt="Imprimir" border="0">
      		</div></td></tr> 
		</table>
	</body>
</html>