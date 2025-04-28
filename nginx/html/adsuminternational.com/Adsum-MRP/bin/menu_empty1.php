<?php 
	include ( '../src/FunGen/sesion/fncvalsesion.php');
	include ( '../src/FunPerPriNiv/pktblalertas.php');
	include '../src/FunPerSecNiv/fncsqlrun.php';
	include '../src/FunPerSecNiv/fncfetchall.php';
	include '../src/FunPerSecNiv/fncfetch.php';
	include '../src/FunPerSecNiv/fncnumreg.php';
	include '../src/FunGen/cargainput.php';
	include '../src/FunPerPriNiv/pktbltipotrab.php';
	include '../src/FunPerPriNiv/pktblplanta.php';
	include '../src/FunPerPriNiv/pktblusuagrup.php'; 
	include '../src/FunPerPriNiv/pktblgrupcomp.php';
	include '../src/FunPerPriNiv/pktblmenucomp.php';
	

	$arrusuaplanta = trim($GLOBALS[usuaplanta]);
	$arrusuatipotrab = trim($GLOBALS[usuatipotrab]);
	$noAjax = 1;
	
	include '../src/FunjQuery/jquery.alertas/jquery.soliserv.php';
	include '../src/FunjQuery/jquery.alertas/jquery.ot.php';
	include '../src/FunjQuery/jquery.alertas/jquery.bandejaot.php';

	$idcon = fncconn();
	
	$nuconn = fncconn();
	$rsUsuagrup = loadrecordusuagr($GLOBALS[usuacodi], $idcon);
			
	if($rsUsuagrup > 0)
	{
		$isbacra = array(1 => 'sse', 2 => 'otm', 3 => 'botp');
		
		foreach ($isbacra as $value) 
		{
			$reccadena= array("mecoacra" => $value,"timecodi" => 4);
			$nuresult = dinamicscanmenucomp($reccadena, $idcon);
	
			if($nuresult > 0)
			{
				$sbRow = fncfetch($nuresult, 0);
				$isbacra[$value] = $sbRow[mecocodi];
				
				$rs_grupcomp = loadrecordgrupcomp($rsUsuagrup[grupcodi], $sbRow[mecocodi], $idcon);
					
				if($rs_grupcomp > 0)
				{
					$cadenwindow[$sbRow[mecocodi]] = $sbRow[mecoscri].'?codigo='.$sbRow[mecocodi];
					
					$record= array("mecocopa" => $sbRow[mecocodi], "timecodi" => 5);
					$recordop= array("mecocopa" => '=',"timecodi" => '=');
					$rs_submenucomp = dinamicscanopgrupcomp($record, $recordop, $idcon);
					
					$num_row = fncnumreg($rs_submenucomp);
					
					for($a = 0; $a < $num_row; $a++)
					{
						$sbRow_mc = fncfetch($rs_submenucomp, 0);
						$rs_subgrupcomp = loadrecordgrupcomp($rsUsuagrup[grupcodi], $sbRow_mc[mecocodi], $idcon);
						
						if($rs_subgrupcomp > 0)
							$cadenwindow[$sbRow[mecocodi]] .= $sbRow_mc[meconomb].'=1';
					}
				}
			}
		}
	}

?>
<html>
	<head>
		<title>Alertas</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/ui/jquery.ui.accordion.js"></script>
		<script>
			$(function() {
				$( "#accordion" ).accordion({
					fillSpace: true
				});
			});

			function reloadContent()
			{
				<?php	if($isbacra['sse']):?>
				accionLoadAlerts('sstotal', 'soliserv', '<?php echo $arrusuaplanta ?>', '<?php echo $arrusuatipotrab ?>', 2);
				accionLoadAlerts('sslist', 'soliserv', '<?php echo $arrusuaplanta ?>', '<?php echo $arrusuatipotrab ?>', 1);
				<?php 	endif; 
						if($isbacra['otm']):?>
				accionLoadAlerts('ottotal', 'ot', '<?php echo $arrusuaplanta ?>', '<?php echo $arrusuatipotrab ?>', 2);
				accionLoadAlerts('otlist', 'ot', '<?php echo $arrusuaplanta ?>', '<?php echo $arrusuatipotrab ?>', 1);
				<?php 	endif; 
						if($isbacra['botp']):?>
				accionLoadAlerts('bottotal', 'bandejaot', '<?php echo $arrusuaplanta ?>', '<?php echo $arrusuatipotrab ?>', 2);
				accionLoadAlerts('botlist', 'bandejaot', '<?php echo $arrusuaplanta ?>', '<?php echo $arrusuatipotrab ?>', 1);
				<?php 	endif; ?>
			}
		</script>
		<style type="text/css">
			body { background-color: #DFE8F6;  margin:0; }
			.Estilo1 { color: #FFFFFF; font-weight: bold; }
			.Estilo3 {font-size: 10}
			#accordion a, .ui-state-default, .NoiseDataTD {font-size: 9px;}
	</style>
	</head>
	<body onload="setInterval('reloadContent();',60000);"><!--  300000 mseg = 3 min  -->
		<div id="accordionResizer" style="width:100%; height:230px;">
			<div id="accordion">
				<?php	if($isbacra['sse']):?>
				<!-- Solicitudes de servicio -->
				<h3><a href="#">Solicitudes de servicio (<span id="sstotal"><?php echo $ttSoliserv ?></span>)</a></h3>
				<div style="padding: 5px;" id="sslist">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
					<?php 
						foreach ($arrSoliserv As $key => $arrSolserpl):
							$nrTipo = count($arrSolserpl);
							$a = 0;
							
							foreach($arrSolserpl As $subkey => $value):
								($subkey === 0) ? $tiptranombre = '------' : $tiptranombre = cargatiptrabnombre($subkey, $idcon); 
								($subkey === 0) ? $subkey = null: $subkey = $subkey;
								
								echo '<tr>';
								
			//					if($a < 1)
			//						echo '<td width="50%" rowspan="'.$nrTipo.'" class="ui-state-default">'.cargaplantanombre($key, $idcon).'</td>';
								echo '<td width="80%" class="ui-state-default"><a href="#" onClick="top.frames['."'text'".'].location = '."'{$cadenwindow[$isbacra['sse']]}&tiptracodigo={$subkey}&accionconsultarsoliserv=1&columnas=tiptracodigo';".'">'.$tiptranombre.'</a></td>';	
								echo '<td width="20%" class="NoiseDataTD" align="center"><b><a href="#" onClick="top.frames['."'text'".'].location = '."'{$cadenwindow[$isbacra['sse']]}&tiptracodigo={$subkey}&accionconsultarsoliserv=1&columnas=tiptracodigo';".'">'.$value.'</a></b></td>';	
								echo '</tr>';
								$a++;
							endforeach;
						endforeach;
					?>
					</table> 
				</div>
				<?php 	endif; 
						if($isbacra['otm']):?>
				<!-- Ordenes de trabajo -->
				<h3><a href="#">Ordenes de trabajo (<span id="ottotal"><?php echo $ttOt ?></span>)</a></h3>
				<div style="padding: 5px;" id="otlist">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
					<?php 
						foreach ($arrOt As $key => $arrOtpl):
							$nrTipo = count($arrOtpl);
							$a = 0;
							
							foreach($arrOtpl As $subkey => $value):
								($subkey === 0) ? $tiptranombre = '------' : $tiptranombre = cargatiptrabnombre($subkey, $idcon); 
								($subkey === 0) ? $subkey = null: $subkey = $subkey;
								
								echo '<tr>';
								
					//			if($a < 1)
					//				echo '<td width="50%" rowspan="'.$nrTipo.'" class="ui-state-default">'.cargaplantanombre($key, $idcon).'</td>';
								echo '<td width="80%" class="ui-state-default"><a href="#" onClick="top.frames['."'text'".'].location = '."'{$cadenwindow[$isbacra['otm']]}&tiptracodigo={$subkey}&accionconsultarot=1&columnas=tiptracodigo';".'">'.$tiptranombre.'</a></td>';	
								echo '<td width="20%" class="NoiseDataTD" align="center"><b><a href="#" onClick="top.frames['."'text'".'].location = '."'{$cadenwindow[$isbacra['otm']]}&tiptracodigo={$subkey}&accionconsultarot=1&columnas=tiptracodigo';".'">'.$value.'</a></b></td>';	
								echo '</tr>';
								$a++;
							endforeach;
						endforeach;
					?>
					</table>
				</div>
				<?php 	endif; 
						if($isbacra['botp']):?>
				<!-- Bandeja programaciones -->
				<h3><a href="#">Bandeja programacion (<span id="bottotal"><?php echo $ttBandejaOt ?></span>)</a></h3>
				<div style="padding: 5px;" id="botlist">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
					<?php 
						foreach ($arrBandejaOt As $key => $arrBandejaOtpl):
							$nrTipo = count($arrBandejaOtpl);
							$a = 0;
							
							foreach($arrBandejaOtpl As $subkey => $value):
								($subkey === 0) ? $tiptranombre = '------' : $tiptranombre = cargatiptrabnombre($subkey, $idcon); 
								($subkey === 0) ? $subkey = null: $subkey = $subkey;
								
								echo '<tr>';
								
					//			if($a < 1)
					//				echo '<td width="50%" rowspan="'.$nrTipo.'" class="ui-state-default">'.cargaplantanombre($key, $idcon).'</td>';
								echo '<td width="80%" class="ui-state-default"><a href="#" onClick="top.frames['."'text'".'].location = '."'{$cadenwindow[$isbacra['botp']]}&tiptracodigo={$subkey}&columnas=tiptracodigo';".'">'.$tiptranombre.'</a></td>';	
								echo '<td width="20%" class="NoiseDataTD" align="center"><b><a href="#" onClick="top.frames['."'text'".'].location = '."'{$cadenwindow[$isbacra['botp']]}&tiptracodigo={$subkey}&columnas=tiptracodigo';".'">'.$value.'</a></b></td>';	
								echo '</tr>';
								$a++;
							endforeach;
						endforeach;
					?>
					</table>
				</div>
				<?php 	endif; ?>
				
			</div>
		</div>
	</body>
</html>