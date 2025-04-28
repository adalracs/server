<?php
	include ('../src/FunGen/sesion/fncvalsesion.php');
	include ('../src/FunPerPriNiv/pktblot.php');
	include ( '../src/FunPerSecNiv/fncnumreg.php');
	include ( '../src/FunPerSecNiv/fncfetch.php');
	include ( '../src/FunPerSecNiv/fncsqlrun.php');
	include ( '../src/FunGen/fncformat.php');
	include ('../src/FunGen/cargainput.php');
	include ('../src/FunGen/fncdatediff.php');
//	
//	//++++++++
//	
	$sbSql = "	SELECT sistema.sistemnombre, tipoequipo.tipequnombre, equipo.equipocodigo, equipo.equiponombre
				FROM tipoequipo
					INNER JOIN equipo ON equipo.tipequcodigo = tipoequipo.tipequcodigo
					INNER JOIN sistema ON sistema.sistemcodigo = equipo.sistemcodigo
				WHERE  sistema.plantacodigo IN ({$arrusuaplanta}) AND tipoequipo.tipequcodigo IN ({$arrtipoequipo}) ORDER BY sistema.sistemnombre";
	
	$idcon = fncconn ();
	$rsEquipo = fncsqlrun($sbSql, $idcon);
	$nrEquipo = fncnumreg($rsEquipo);
	$arrEquipos = array();
	
	
	for($a = 0; $a < $nrEquipo; $a++)
	{
		$rwEquipo = fncfetch($rsEquipo, $a);
		$arrEquipos[$rwEquipo['sistemnombre']][] = $rwEquipo;
	}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF8" />
		<meta http-equiv="X-UA-Compatible" content="IE=9" >
		<title>Tiempo medio entre fallas</title>
		<?php include('../def/jquery.library_maestro.php');?>
		<style type="text/css">
			<!--
			.head-title-report {font-family: Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold;}
			.head-title-table {font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold;}
			.cont-table-report {font-family: Arial, Helvetica, sans-serif; font-size: 10px;}
			.tick-title-report {font-family: Arial, Helvetica, sans-serif; font-size: 10px; text-align: center; font-weight: bold;}
			
			
			.borde-tabla {border-right: 1px solid #2F2F2F; border-bottom: 1px solid #2F2F2F;}
			.borde-cell {border-top: 1px solid #2F2F2F; border-left: 1px solid #2F2F2F;}
			.borde-line {border-top: 1px solid #2F2F2F;}
			.saltopagina{ page-break-after: always; }
			.Estilo6 {font-size: 14px; }
			.back-sty {background-color: #F2F2F2; }
			.currency-align { text-align:right; }
			.contenido-general { margin-bottom: 2px; min-width: 810px;  float:left;}
			
			.session-borde {
				-moz-border-radius: 5px;
				-webkit-border-radius: 5px;
				border-radius:  5px;
			}
			-->
			.console-buttons-float-topright { display:scroll; position:fixed; top:0px; right:0px; }
			.console-buttons-float-topleft { display:scroll; position:fixed; top:0px; left:0px; }
			.console-buttons-float-bottomleft { display:scroll; position:fixed; bottom:0px; left:0px; }
			.console-buttons-float-bottomright { display:scroll; position:fixed; bottom:0px; right:0px; }
			
			
		</style>

		<script type="text/javascript">
			$(function(){
				$('#viewinf').button({ icons: { primary: "ui-icon-search" } }).click(function() {
					if(document.getElementById('tiporeport').value == 1)
						document.getElementById('tiporeport').value = 2;
					else
						document.getElementById('tiporeport').value = 1;
	
					document.form1.submit();
					
					return false;
				});
			
				$('#aplicobserv').button({ icons: { primary: "ui-icon-comment" } }).click(function() {
					$("#msgaplicobserv").dialog("open");
					return false;
				});
				
				$('#imprimirrep').button({ icons: { primary: "ui-icon-print" } }).click(function() {
					window.print();
					return false;
				});
				
				$("#msgwindowait").dialog({
					autoOpen: false,
					width: 350,
					modal: true,
					closeOnEscape: false
				});
				
				$("#msgaplicobserv").dialog({
					autoOpen: false,
					width: 540,
					modal: true,
					closeOnEscape: false,
					buttons: {
						"Cancelar": function() {
							document.getElementById('observtexto').value = document.getElementById('consulobserv').value;
							$(this).dialog("close"); 
						},
						"Aplicar": function() { 
							document.getElementById('consulobserv').value = document.getElementById('observtexto').value;
							document.getElementById('subobservacion').innerHTML = '&nbsp;' + document.getElementById('observtexto').value;
							$(this).dialog("close"); 
						}
					}
				});
				
			});
		
		
		</script>
		<style type="text/css">
			body { magin: 60px }
			.table_data { 
				border-top: 1px solid #C4C6C8;
				border-left: 1px solid #C4C6C8; 
			}
			
			.cell-borleft-enc { border-left: 1px solid #C4C6C8; }
			.cell-borright-enc { border-right: 1px solid #C4C6C8; }
			.cell-borbottom-enc { border-bottom: 1px solid #C4C6C8; }
			.cell-bortop-enc { border-top: 1px solid #C4C6C8; }
			
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
		<form name="form1" method="post"  enctype="multipart/form-data">
			<table width="98%" border="0" cellpadding="1" cellspacing="1" align="center">
	        	<tr><td>
					<div style="padding: 6px; float:left;">
						<div class="contenido-general">
							<div style="padding: 8px 0;">
								<table width="100%" border="0" cellspacing="0" cellpadding="1">
			      					<tr>
			        					<td class="head-title-report" align="center">INFORME DE TIEMPO MEDIO ENTRE FALLAS</td>
			      					</tr>
					    		</table>
							</div>
						</div>
						<div class="contenido-general session-borde" style="border: 1px solid #2F2F2F;">
							<table width="100%" border="0" cellspacing="0" cellpadding="1">
								<tr>
									<td width="200" class="NoiseFooterTD borde-cell tick-title-report" style="border-top: 0; border-left: 0;">Seccion</td>
									<td width="300" class="NoiseFooterTD borde-cell tick-title-report" style="border-top: 0;">Maquina</td>
									<td width="150" class="NoiseFooterTD borde-cell tick-title-report" style="border-top: 0;">Horas de Operaci&oacute;n</td>
									<td width="150" class="NoiseFooterTD borde-cell tick-title-report" style="border-top: 0;">Total de fallas encontradas</td>
									<td width="150" class="NoiseFooterTD borde-cell tick-title-report" style="border-top: 0;">TMF</td>
								</tr>
								<?php 
									foreach ($arrEquipos as $key => $arrValequ)
									{
										for($a = 0; $a < count($arrValequ); $a++)
										{
											$arrRecord = array('ordtrafecini' => $consulfecini, 'ordtrafecfin' => $consulfecfin, 'tipmancodigo' => 2, 'equipocodigo' => $arrValequ[$a]['equipocodigo']);
											$arrOprecord = array('ordtrafecini' => '>=', 'ordtrafecfin' => '<=', 'tipmancodigo' => '=', 'equipocodigo' => '=');
											$rsOt = dinamicscanopot($arrRecord, $arrOprecord, $idcon);
											$nrOt = fncnumreg($rsOt);	
											$hrOperacion = 'hroperacion_'.str_replace("-","_",$arrValequ[$a]['equipocodigo']);
											$numHoras = ($$hrOperacion) ? $$hrOperacion / $nrOt : 0;
								?>
								<tr>
									<td class="borde-cell cont-table-report" style="border-left: 0;">&nbsp;<?php echo $arrValequ[$a]['sistemnombre'] ?></td>
									<td class="borde-cell cont-table-report">&nbsp;<?php echo $arrValequ[$a]['equipocodigo'].'-'.$arrValequ[$a]['equiponombre'] ?></td>
									<td class="borde-cell cont-table-report" align="center"><?php echo ($$hrOperacion) ? $$hrOperacion : 0 ?></td>
									<td class="borde-cell cont-table-report" align="center"><?php echo $nrOt ?></td>
									<td class="borde-cell cont-table-report" align="center"><?php echo round($numHoras, 1) ?> hora(s)</td>
								</tr>
								<?php 
										}
									}
								?>
							</table>
						</div>
					</div>
				</td></tr>
	      	</table>
	      	<div class="console-buttons-float-topright">
				<div class="ui-widget">
					<div class="ui-state-highlight ui-corner-all" style="padding: .5em .5em;"> 
						<div class="ui-buttonset">
<!--							<button id="viewinf"><?php if($tiporeport == 1): ?>Agrupar por tipo<?php else: ?>Ver detallado<?php endif ?></button>&nbsp;-->
<!--							<button id="aplicobserv">Aplicar observaci&oacute;n</button>&nbsp;-->
							<button id="imprimirrep">Imprimir</button>&nbsp;
<!--							<button id="expexcel">Exportar a Excel</button>&nbsp;-->
						</div>
					</div>
				</div>
			</div>
	      	<input type="hidden" id="tiporeport" name="tiporeport" value="<?php echo $tiporeport ?>">
	      	<input type="hidden" id="arrusuaplanta" name="arrusuaplanta" value="<?php echo $arrusuaplanta ?>">
	      	<input type="hidden" id="arrtipoequipo" name="arrtipoequipo" value="<?php echo $arrtipoequipo ?>">
	      	<input type="hidden" id="consulobserv" name="consulobserv" value="<?php echo $consulobserv ?>">
	      	<input type="hidden" id="consulfecini" name="consulfecini" value="<?php echo $consulfecini ?>">
	      	<input type="hidden" id="consulfecfin" name="consulfecfin" value="<?php echo $consulfecfin ?>">
	      </form>
	      <div id="msgwindowait" title="Adsum Kallpa [Gestion de mantenimiento]"><span id="msgwait"><img src="../img/loading.gif">&nbsp;Espere mientras se genera el archivo excel</span></div>
	      <div id="msgaplicobserv" title="Adsum Kallpa [Gestion de mantenimiento]"><span id="observacion"><textarea name="text" cols="80" name="observtexto" id="observtexto" rows="7" wrap="VIRTUAL"><?php echo $consulobserv ?></textarea></span></div>
	</body>
</html>