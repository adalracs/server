<?php
ob_start();

	include ( '../src/FunPerPriNiv/pktblrequeritiempo.php');
	include ( '../src/FunPerPriNiv/pktblservicio.php');
	include ( '../src/FunPerPriNiv/pktblsubsegmentos.php');
	include ( '../src/FunPerSecNiv/fncconn.php');
	//$campo=0;
ob_end_flush();
?>

<html>
<head>
<title>Detalle Programacion</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="0">
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js"		type="text/javascript" ></SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
function open_window(index_sel){
	
		
		form2.campo.value= 0;
	//alert(form2.campo.value);
}

</script>
<style type="text/css">
.estilo1 {font-size: 85%; font-family : Arial } 
</style>
</head>
<body bgcolor="FFFFFF" text="#000000">
<form name="form2" method="post"  enctype="multipart/form-data">

  <table width="100%" border="0" cellspacing="1" cellpadding="1"  align="center" cols="8">
    <tr>
	  <td class="NoiseFieldCaptionTD" width="4%"><font color="#FFFFFF">Sel.</font></td>
	  
	  <td class="NoiseFieldCaptionTD" width="10%"><font color="#FFFFFF">&nbsp;Proceso</font></td>
	  <td class="NoiseFieldCaptionTD" width="18%"><font color="#FFFFFF">&nbsp;Servicio</font></td>
	  <td class="NoiseFieldCaptionTD" width="18%"><font color="#FFFFFF">&nbsp;Subsegmento</font></td>
	  <td class="NoiseFieldCaptionTD" width="18%"><font color="#FFFFFF">&nbsp;Tipo Ciudad</font></td>
	  <td class="NoiseFieldCaptionTD" width="15%"><font color="#FFFFFF">&nbsp;Plazo en hrs x 100%</font></td> 
	</tr>
	<?php
		include ( '../src/FunGen/fncdetallarequeritiempo.php');
		fncdetallarqueritiempo($segmencodigo);
	?>	
  </table>
 
  <input type="hidden" name="reqtiecodigo" value="<?php echo $reqtiecodigo; ?>">
</form>
</body>
</html>
