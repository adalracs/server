<?php
ob_start();


	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblmedicion.php');
	include ( '../src/FunPerSecNiv/fncconn.php');
	
	$idconn = fncconn();
	$ircrecord[medequcodigo] = $medequcodigo;
	$ircrecordop[medequcodigo] = "=";
		
	$iResult = dinamicscanopmedicion($ircrecord, $ircrecordop, $idconn);

	if ($iResult){
		$nuCantRow = pg_numrows($iResult);		
		if ($nuCantRow > 0){
			for($i = 0; $i < $nuCantRow; $i++){
				$nuCantFields = pg_numfields($iResult);
				$sbRow = pg_fetch_row ($iResult,$i);
				
				$usuarionombre = loadrecordusuario($sbRow[4], $idconn);

				$sbLista[$i] = array(
					"fechareg"=>$sbRow[3],
					"cantidad"=>$sbRow[2],
					"usuario" => $usuarionombre[usuanombre]." ".$usuarionombre[usuapriape]." ".$usuarionombre[usuasegape]
				);
			}
		}
	}
	
	
	
ob_end_flush();
?>

<html>
<head>
<title>Detalle Medicion</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="0">
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js"		type="text/javascript" ></SCRIPT>
<style type="text/css">
.estilo1 {font-size: 95%; font-family : Arial } 
</style>
</head>
<body bgcolor="FFFFFF" text="#000000">
<form name="form2" method="post"  enctype="multipart/form-data">

  <table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" cols="7">
    <tr>
	  <td class="NoiseFieldCaptionTD" width="25%"><font color="#FFFFFF">Fecha de registro</font></td>
	  <td class="NoiseFieldCaptionTD" width="15%"><font color="#FFFFFF">Cantidad</font></td>
	  <td class="NoiseFieldCaptionTD" width="35%"><font color="#FFFFFF">Encargado</font></td>
    </tr>
	<?php
		for($i = 0; $i < count($sbLista); $i++){
			if (($i % 2) == 0){
				echo '              <tr>'."\n";
			}else{
				echo '<tr class="NoiseDataTD">'."\n";
			}
			
			echo '<td width="25%" class="estilo1">&nbsp;'.$sbLista[$i][fechareg].'</td>'."\n";
			echo '<td width="15%" class="estilo1">&nbsp;'.$sbLista[$i][cantidad].'</td>'."\n";
			echo '<td width="35%" class="estilo1">&nbsp;'.$sbLista[$i][usuario].'</td>'."\n";
			echo '</tr>'."\n";
		}
	?>	
  </table>
  
  <input type="hidden" name="arr_detalle">
  <input type="hidden" name="arr_delitem" value="<? echo $arr_delitem ?>">
</form>
</body>
</html>