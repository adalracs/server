<?php
	include ('../src/FunGen/sesion/fncvalsesion.php');
	include '../src/FunPerPriNiv/pktblplanta.php';
	include '../src/FunPerPriNiv/pktblestado.php';
	include '../src/FunPerPriNiv/pktblsistema.php';
	include '../src/FunPerPriNiv/pktblnegocio.php';
	include '../src/FunPerPriNiv/pktbltipoequipo.php';
	include '../src/FunPerSecNiv/fncsqlrun.php';
	include '../src/FunPerSecNiv/fncnumreg.php';
	include '../src/FunPerSecNiv/fncfetchall.php';
	include '../src/FunPerSecNiv/fncfetch.php';
	include '../src/FunGen/cargainput.php';
	
	$idcon = fncconn();
	
	$sbSql = "	SELECT * FROM vistaequipoplanta WHERE vistaequipoplanta.plantacodigo IN ({$arrusuaplanta}) ORDER BY vistaequipoplanta.plantacodigo, vistaequipoplanta.sistemcodigo, vistaequipoplanta.equipocodigo";
	$rsEquipos = fncsqlrun($sbSql, $idcon);
	$nrEquipos = fncnumreg($rsEquipos);
	$arrListado = array();
	$numGenRows = 0;
	
	for($a = 0; $a < $nrEquipos; $a++):
		$rwEquipo = fncfetch($rsEquipos, $a);
		$arrListado[$rwEquipo['plantacodigo']]['listaequipo'][] = array(
			'plantanombre' => cargaplantanombre($rwEquipo['plantacodigo'], $idcon),	
			'sistemnombre' => cargasistemnombre($rwEquipo['sistemcodigo'], $idcon),	
			'equipocodigo' => $rwEquipo['equipocodigo'],	
			'equiponombre' => $rwEquipo['equiponombre'],	
			'estadonombre' => cargaestadonombre($rwEquipo['estadocodigo'], $idcon),	
//			'tipequnombre' => cargatipequnombre($rwEquipo['tipequcodigo'], $idcon),	
			'equipomarca' => $rwEquipo['equipomarca'],	
			'equipomodelo' => $rwEquipo['equipomodelo'],	
			'equipoviduti' => $rwEquipo['equipoviduti'],
			'codigosrf' => $rwEquipo['codigosrf'],
			'equipodescri' => $rwEquipo['equipodescri']
		);
		
		$sbSql = "	SELECT * FROM componen WHERE componen.equipocodigo = '{$rwEquipo['equipocodigo']}' ORDER BY componnombre";
		$rsComponente = fncsqlrun($sbSql, $idcon);
		$nrComponente = fncnumreg($rsComponente);
		
		if($nrComponente > 0):
			for($b = 0; $b < $nrComponente; $b++):
				$rwComponente = fncfetch($rsComponente, $b);
				$arrListado[$rwEquipo['plantacodigo']][$rwEquipo['equipocodigo']]['componen'][] = array('componcodigo' => $rwComponente['componcodigo'], 'componnombre' => $rwComponente['componnombre']);
				$arrListado[$rwEquipo['plantacodigo']]['explo']++;
				$arrListado[$rwEquipo['plantacodigo']][$rwEquipo['equipocodigo']]['explo']++;
				$numGenRows++;
			endfor;
		else:
			$arrListado[$rwEquipo['plantacodigo']]['explo']++;
			$arrListado[$rwEquipo['plantacodigo']][$rwEquipo['equipocodigo']]['explo']++;
			$numGenRows++;
		endif;
	endfor;
?>
<html>
	<head>
		<title>Listado de equipos</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
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
			.link-tab {font-size: 11px;}
		</style>
	</head>
	<body bgcolor="FFFFFF" text="#000000" onLoad="window.print()">
		<p><font class="NoiseFormHeaderFont">Listado de equipos por planta</font></p>
		<form name="form1" method="post"  enctype="multipart/form-data">
			<div id="tabs-">
				<table border="0" cellpadding="1" cellspacing="0" class="table_data" width="1270">
					<tr>
						<td width="150" class="NoiseFooterTD cell_data_enc">UNIDAD GENERADORA DE EFECTIVO</td>
						<td width="120" class="NoiseFooterTD cell_data_enc">UBICACI&Oacute;N</td>
						<td width="100" class="NoiseFooterTD cell_data_enc">C&Oacute;DIGO ACTIVO</td>
						<td width="200" class="NoiseFooterTD cell_data_enc">ACTIVO</td>
						<td width="100" class="NoiseFooterTD cell_data_enc">VIDA UTIL (Meses)</td>
						<td width="100" class="NoiseFooterTD cell_data_enc">C&Oacute;DIGO COMPONENTE</td>
						<td width="200" class="NoiseFooterTD cell_data_enc">COMPONENTE</td>
						<td width="100" class="NoiseFooterTD cell_data_enc">VIDA UTIL (Meses)</td>
						<td width="200" class="NoiseFooterTD cell_data_enc">PARTE/REPUESTO</td>
					</tr>
			<?php 
					foreach($arrListado as $key => $arrValue):
						for($b = 0; $b < count($arrValue['listaequipo']); $b++): 
			?>
					<tr>
						<?php if($numRow < 1): ?><td class="NoiseDataTD cell_data" rowspan="<?php echo $numGenRows ?>">&nbsp;<?php if($negocicodigo1) echo carganegocinombre($negocicodigo1, $idcon) ?></td><?php endif ?>
						<?php if($keyActual != $key): ?><td class="NoiseDataTD cell_data" rowspan="<?php echo $arrValue['explo'] ?>">&nbsp;<?php echo $arrValue['listaequipo'][$b]['plantanombre'] ?></td><?php endif;?>
						<td class="NoiseDataTD cell_data" rowspan="<?php echo $arrValue[$arrValue['listaequipo'][$b]['equipocodigo']]['explo'] ?>">&nbsp;<?php echo $arrValue['listaequipo'][$b]['equipocodigo'] ?></td>
						<td class="NoiseDataTD cell_data" rowspan="<?php echo $arrValue[$arrValue['listaequipo'][$b]['equipocodigo']]['explo'] ?>">&nbsp;<?php echo $arrValue['listaequipo'][$b]['equiponombre'] ?></td>
						<td class="NoiseDataTD cell_data" rowspan="<?php echo $arrValue[$arrValue['listaequipo'][$b]['equipocodigo']]['explo'] ?>">&nbsp;<?php echo $arrValue['listaequipo'][$b]['equipoviduti'] ?></td>
						<?php if(count($arrValue[$arrValue['listaequipo'][$b]['equipocodigo']]['componen']) > 0): ?>
						<td class="NoiseDataTD cell_data">&nbsp;<?php echo $arrValue[$arrValue['listaequipo'][$b]['equipocodigo']]['componen'][0]['componcodigo'] ?></td>
						<td class="NoiseDataTD cell_data">&nbsp;<?php echo $arrValue[$arrValue['listaequipo'][$b]['equipocodigo']]['componen'][0]['componnombre'] ?></td>
						<td class="NoiseDataTD cell_data">&nbsp;</td>
						<td class="NoiseDataTD cell_data">&nbsp;</td>
						<?php else: ?>
						<td class="NoiseDataTD cell_data">&nbsp;</td>
						<td class="NoiseDataTD cell_data">&nbsp;</td>
						<td class="NoiseDataTD cell_data">&nbsp;</td>
						<td class="NoiseDataTD cell_data">&nbsp;</td>
						<?php endif; ?>
					</tr>
			<?php 			for($a = 1; $a < count($arrValue[$arrValue['listaequipo'][$b]['equipocodigo']]['componen']); $a++): ?>
					<tr>
						<td class="NoiseDataTD cell_data">&nbsp;<?php echo $arrValue[$arrValue['listaequipo'][$b]['equipocodigo']]['componen'][$a]['componcodigo'] ?></td>
						<td class="NoiseDataTD cell_data">&nbsp;<?php echo $arrValue[$arrValue['listaequipo'][$b]['equipocodigo']]['componen'][$a]['componnombre'] ?></td>
						<td class="NoiseDataTD cell_data">&nbsp;</td>
						<td class="NoiseDataTD cell_data">&nbsp;</td>
					</tr>
						
			<?php	
							endfor;
							$numRow++;
							$keyActual = $key;
						endfor;
					endforeach;  ?>
				</table>
			</div>
		</form>
<!--		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>-->
<!--		<div id="msgwindowait" title="Adsum Kallpa"><span id="msgwait"><img src="../img/loading.gif">&nbsp;Espere mientras se genera el archivo excel</span></div>-->
	</body>
</html>