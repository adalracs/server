<?php
ob_start();
	include ( '../src/FunPerSecNiv/fncconn.php');
	include ( '../src/FunPerPriNiv/pktbltareot.php');
	
	$idcon = fncconn();
	$sbGestion = loadrecordgestionmaxtareot($ordtracodigo,$idcon);
ob_end_flush();
?>
<html>
	<head>
		<title>Detalle de Gesti&oacute;n</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
		<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js"		type="text/javascript" ></SCRIPT>
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
  			<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" cols="7">
			<?php
				for($i = 0; $i < count($sbGestion); $i++){
					
					$horgen = explode(":",$sbGestion[$i][tareothorini]);	
					
					if($horgen[0] > 12)
						$horatareot = ($horgen[0] - 12).":".$horgen[1]." p.m."; 
					elseif($horgen[0] == 12)
						$horatareot = $horgen[0].":".$horgen[1]." p.m."; 
					elseif($horgen[0] < 12 && $horgen[0] > 0 )
						$horatareot = ($horgen[0] + 0).":".$horgen[1]." a.m.";
					elseif($horgen[0] == '00' )
						$horatareot = "12:".$horgen[1]." a.m.";
					
		 			echo '<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>';
		 			echo '<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr>';
		 			echo '<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>';
		 			
					echo  '<tr class="NoiseFieldCaptionTD estilo1">'."\n";
					echo '<td colspan="2"><font color="FFFFFF">&nbsp;Gesti&oacute;n No.&nbsp;&nbsp;<b>'.($sbGestion[$i][tareotsecuen]).'</b></font></td>'."\n";
					echo '<td colspan="2"><font color="FFFFFF">&nbsp;Fecha | Hora ::&nbsp;'.$sbGestion[$i][tareotfecini].' | '.$horatareot.'</font></td>'."\n";
					echo '</tr>'."\n";
					echo '<tr>'."\n";
		            		echo '<td class="NoiseFooterTD" width="15%">&nbsp;Estado</td>'."\n";
		            		echo '<td colspan="3" class="NoiseDataTD">&nbsp;'.$sbGestion[$i][otestanombre].'</td> '."\n";
					echo '</tr>'."\n";
					echo '<tr>'."\n";
		            		echo '<td class="NoiseFooterTD" width="15%">&nbsp;Empleado</td>'."\n";
	            			echo '<td colspan="3"  class="NoiseDataTD">&nbsp;'.$sbGestion[$i][usuario].'</td> '."\n";
		            		echo '</tr>'."\n";
		            		echo '<tr> '."\n";
		 			echo '<td class="NoiseFooterTD" width="15%">&nbsp;Nota</td> '."\n";
		  			echo '<td colspan="3" class="NoiseDataTD">'.$sbGestion[$i][tareotnota].'</td> '."\n";
		 			echo '</tr>'."\n";
		 			
		 			echo '<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>';
		 			echo '<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr>';
		 			echo '<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>';
		 			echo '<tr><td colspan="4">&nbsp;</td></tr>';
				}
				if(!$i){
					echo '<tr><td colspan="4"><b>No se encontro ninguna gesti&oacute;n anexa a la orden</b></td></tr>';
				}
			?>
			</table>
		</form>
	</body>
</html>