<?php
ob_start();
	include ( '../src/FunPerPriNiv/pktblcomponen.php');	
	include('../src/FunPerSecNiv/fncfetch.php');
	include('../src/FunPerSecNiv/fncnumreg.php');
	include ( '../src/FunPerSecNiv/fncconn.php');
ob_end_flush();
?>

<html>
	<head>
		<title>Detalle Componentes</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
		<link rel="stylesheet" type="text/css" href="temas/Noise/help.css">
		<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js"		type="text/javascript" ></SCRIPT>
		<script language=JavaScript src="../src/FunGen/colorfooter.js" type="text/javascript" ></script>
		<SCRIPT LANGUAGE="JavaScript">

		</script>
		<style type="text/css">
			.estilo1 {font-size: 100%; font-family : Arial } 
			.estilo21 {font-size: 85%; font-family : Arial } 
		</style>
	</head>
	<body bgcolor="White" text="#000000">
	<form name="form1" method="post"  enctype="multipart/form-data">
		<table width="100%" border="0" cellspacing="1" cellpadding="1"  align="center"  >
			<tr>
				<td width="10%" class="NoiseFieldCaptionTD"><span class="style5"><font color="#FFFFFF">Sel.&nbsp;</font></span></td> 
				<td width="15%" class="NoiseFieldCaptionTD"><span class="style5"><font color="#FFFFFF">C&oacute;digo</font></span></td> 
				<td width="45%" class="NoiseFieldCaptionTD"><span class="style5"><font color="#FFFFFF">Nombre</font></span></td> 
			</tr> 		
			<?php
				$idcon = fncconn();
				$irecComponente[equipocodigo] = $equipocodigo; 
				$result = dinamicscancomponen($irecComponente,$idcon);
				
				if($result > 0)
					$numReg = fncnumreg($result);
				
				if($numReg){
					for ($i = 0; $i < $numReg; $i++){
						$arr = fncfetch($result,$i);
						
						if (($i % 2) == 0){
							echo '              <tr bgcolor="#f0f6ff">'." \n";
						}else{
							echo '<tr bgcolor="#E8F0F6">'." \n";
						}

						echo '<td class= "estilo21"><a href="javascript:void(0);" onClick="window.open('."'detallarcomponen.php?codigo=Endadsum&radiobutton=" .$arr[componcodigo]."|s&nombtabl=componen','','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=550');".'" >Ver detalle</a></td>'."\n";
						echo '<td  class= "estilo1">'.$arr[componcodigo]."</td>"."\n";
						echo '<td  class= "estilo1">'.$arr[componnombre]."</td>"."\n";
						echo "</tr>"."\n";
					}
				}
				
				if($i < 4){
					for($j = $i; $j < 4; $j++){
						if (($j % 2) == 0){
							echo '              <tr bgcolor="#f0f6ff"><td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td></tr>'." \n";
						}else{
							echo '<tr bgcolor="#E8F0F6">
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td></tr>'." \n";
						}
					}
				}
			?>		
  </table>

</form>
</body>
</html>