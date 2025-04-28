<?php
ob_start();
	include ( '../src/FunPerSecNiv/fncconn.php');
	include ( '../src/FunPerPriNiv/pktbltareot.php');
	include ( '../src/FunGen/fncdatediff.php');
	
	$idcon = fncconn();
	$sbGestion = loadrecordgestiontareot($ordtracodigo,$idcon);
ob_end_flush();
?>
<html>
	<head>
		<title>Detalle de Gesti&oacute;n</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		
		<style type="text/css"> 
			body {
				margin-left: 0px;
				margin-top: 0px;
				margin-right: 0px;
				margin-bottom: 0px;
			}
			.estilo1 {font-size: 95%; font-family : Arial } 
		</style>
	</head>
	<body bgcolor="#f7f7f7" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
  			<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
		 		<?php for($i = 0; $i < count($sbGestion); $i++): ?>
		 		<tr>
		 			<td>
		 				<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center"  class="ui-widget-content">
							<tr class="ui-widget-header">
								<td class="cont-title" width="50%">&nbsp;Gesti&oacute;n No.&nbsp;&nbsp;<?php echo ($sbGestion[$i]['tareotsecuen'] + 1) ?></td>
								<td class="cont-title" width="50%">&nbsp;Fecha/Hora:&nbsp;&nbsp;<?php  echo date('Y-m-d h:i a', strtotime($sbGestion[$i]['tareotfecini'].' '.$sbGestion[$i]['tareothorini'])) ?></td>
							</tr>
						</table>
						<table width="99%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td width="25%" class="NoiseFooterTD">Duraci&oacute;n del estado</td>
								<td width="75%" class="NoiseErrorDataTD"><?php 
									if($sbGestion[$i + 1]['tareotfecini'])
					            	{
					            		$min = 0;
					            		
										$fecha_a = $sbGestion[$i]['tareotfecini'].' '.$sbGestion[$i]['tareothorini'];
										$fecha_b = $sbGestion[$i + 1]['tareotfecini'].' '.$sbGestion[$i + 1]['tareothorini'];
							
	            						$dias = datediff('d', $fecha_a, $fecha_b);
				            			
				            			if($dias == '0' && datediff('n', $fecha_a, $fecha_b) < 1440)
				            				$dias = 1;
	            			
				            			$temp_min = 0;
				            			
				            			for($a = 0; $a <= $dias; $a++)
				            			{
				            				if($fecha_b >= date("Y-m-d H:i", strtotime($sbGestion[$i]['tareotfecini']." 16:30 + ".$a." days")))
				            				{
					            				if($fecha_a < $fecha_b)
					            				{
					            					$temp_min += datediff('n', $fecha_a, date("Y-m-d H:i", strtotime($sbGestion[$i]['tareotfecini']." 16:30 + ".$a." days")));
					            					$fecha_a = date("Y-m-d H:i", strtotime($sbGestion[$i]['tareotfecini']." 07:00 + ".($a + 1)." days"));
					            				}
				            				}
				            				else
				            				{
				            					$temp_min += datediff('n', $fecha_a, $fecha_b);
				            					break;
				            				}
				            			}
				            			
				            			$time = explode('.', ($temp_min / 60));
				            			if($time[1])
				            				$err = @eval("\$min = (round(((0.$time[1]) * 60) * 100) / 100);");
		            		
		            					echo $time[0].' hrs '.$min.' min.';
					            	}
					            	else
					            		echo '0';
								?></td>
							</tr>
							<tr><td class="ui-state-default" colspan="2"></td></tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Estado</td>
								<td class="NoiseDataTD">&nbsp;<?php echo $sbGestion[$i]['otestanombre'] ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Gestionado por</td>
								<td class="NoiseDataTD">&nbsp;<?php echo $sbGestion[$i]['usuario'] ?></td>
							</tr>
							<tr><td class="ui-state-default" colspan="2"></td></tr>
							<tr><td class="NoiseFooterTD" colspan="2">&nbsp;Motivo</td></tr>
							<tr><td class="NoiseDataTD" colspan="2">&nbsp;<?php echo $sbGestion[$i]['tareotnota'] ?></td></tr>
						</table>
					</td>
				</tr>
		 		<tr><td colspan="4">&nbsp;</td></tr>
		 		<?php 
		 			endfor; 
		 			
		 			if(!$i)
						echo '<tr><td colspan="4"><b>No se encontro ninguna gesti&oacute;n anexa a la orden</b></td></tr>';	
		 		?>
			</table>
		</form>
	</body>
</html>