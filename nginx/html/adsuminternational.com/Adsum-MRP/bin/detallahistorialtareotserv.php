<?php
ob_start();
	include ( '../src/FunPerSecNiv/fncconn.php');
	$cnxConn=fncconn();
	$sbSql = "SELECT tareot.tareotsecuen, otestado.otestanombre,usuario.usuanombre, usuario.usuapriape,usuario.usuasegape,tareot.tareotnota 
			  , tareot.tareotfecgen, tareot.tareothorgen FROM tareot, usuario, otestado 
			  WHERE tareot.ordtracodigo='$ordtracodigo' AND usuario.usuacodi=tareot.usuacodi AND otestado.otestacodigo=tareot.otestacodigo ORDER BY  tareot.tareotsecuen DESC;";

	$nuResult = pg_exec($cnxConn,$sbSql);
	unset($sbSql);
	
	if ($nuResult){ 
		$nuCantRow = pg_numrows($nuResult);
		for($i=0; $i<$nuCantRow; $i++){
			//$nuCantFields = pg_numfields($nuResult);
			$sbRow = pg_fetch_row ($nuResult,$i);
			$sbGestion[$i] = array(
				"tareotsecuen"=>$sbRow[0],
				"otestanombre"=>$sbRow[1],
				"usuario"=>$sbRow[2]." ".$sbRow[3]." ".$sbRow[4],
				"tareotnota"=>$sbRow[5],
				"tareotfecgen"=>$sbRow[6],
				"tareothorgen"=>$sbRow[7]
				);
		}
	}	
ob_end_flush();
?>

<html>
<head>
<title>Detalle Programacion</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="0">
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js"		type="text/javascript" ></SCRIPT>
<style type="text/css">
.estilo1 {font-size: 95%; font-family : Arial } 
</style>
</head>
<body bgcolor="FFFFFF" text="#000000">
<form name="form1" method="post"  enctype="multipart/form-data">

  <table width="100%" border="0" cellspacing="0" cellpadding="2" align="center" cols="7">
	<?php
		for($j=0; $j < $nuCantRow; $j++){

			$horafin = strtok($sbGestion[$j][tareothorgen],":");
			$minutofin = strtok(":");

			if ($horafin == 00){
				$horafin = 12;
				$pm = true;
			}elseif ($horafin > 12){
				$horafin -= 12;
				if ($horafin < 10){
					$horafin = "0".$horafin;
				}
				$pm =  true;
			}

			echo  '<tr class="NoiseFieldCaptionTD">
					<td colspan="2"><span class="style5"><font color="FFFFFF">Fecha:&nbsp;&nbsp;'.$sbGestion[$j][tareotfecgen].'</font></span></td>
					<td>&nbsp;</td>
					<td colspan="2"><span class="style5"><font color="FFFFFF">Hora:&nbsp;&nbsp;'.$horafin.":".$minutofin;if($pm == true){echo " p.m.";}else{echo "a.m.";}'</font></span></td>
					</tr>';
			echo '<tr>';
            echo '<td class="NoiseFooterTD">Gestion N&uacute;mero</td>';
            echo '<td>'.($nuCantRow -($j)).'</td> ';
            echo '<td>&nbsp;</td>';
            echo '<td>&nbsp;</td>';
            echo '<td>&nbsp;</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td class="NoiseFooterTD">Estado</td>';
            echo '<td colspan="2">'.$sbGestion[$j][otestanombre].'</td> ';
            echo '<td class="NoiseFooterTD"> Emplado</td>';
            echo '<td>'.$sbGestion[$j][usuario].'</td> ';
            echo '</tr>           ';
            echo '<tr> ';
 			echo '<td class="NoiseFooterTD">Nota</td> ';
  			echo '<td colspan="4">'.$sbGestion[$j][tareotnota].'</td> ';
 			echo '</tr>';
 			echo '<tr><td colsopan="5">&nbsp;</td></tr>';
 			
		}
 	?>	
	
	              	
	
	
  </table>
  
  <input type="hidden" name="arr_detalle">
  <input type="hidden" name="arr_delitem" value="<? echo $arr_delitem ?>">
</form>
</body>
</html>