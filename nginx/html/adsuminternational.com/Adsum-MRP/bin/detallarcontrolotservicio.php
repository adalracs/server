<?php
ob_start();

	include ( '../src/FunPerPriNiv/pktblvistaotservicio.php');
	include ( '../src/FunPerPriNiv/pktblservicio.php');
	include ( '../src/FunPerPriNiv/pktbldepartam.php');
	include ( '../src/FunPerPriNiv/pktblsemaforoestado.php');
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
<link href="temas/Noise/semaforo.css" rel="stylesheet" type="text/css" />
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
   	<!--  <td class="NoiseFieldCaptionTD" width="4%" rowspan="2"><font color="#FFFFFF">Sel.</font></td>-->
	  <td class="NoiseFieldCaptionTD" width="30%" rowspan="2"><font color="#FFFFFF">&nbsp;Departamento</font></td>
	  <td class="NoiseFieldCaptionTD" width="18%" rowspan="2"><font color="#FFFFFF">&nbsp;Servicio</font></td
    	 <td colspan="4" class="NoiseFieldCaptionTD" align="center"><font color="#FFFFFF">Estado</font></td></tr>
	 </tr>
     
    <tr>
	  
	  <td class="NoiseFieldCaptionTD" width="12%" id="verde" ><font color="#FFFFFF">&nbsp;Verde</font></td>
	  <td class="NoiseFieldCaptionTD" width="12%" id="naranja"><font color="#FFFFFF">&nbsp;Naranja</font></td>
	  <td class="NoiseFieldCaptionTD" width="12%" id="rojo"><font color="#FFFFFF">&nbsp;Rojo</font></td> 
	  <td class="NoiseFieldCaptionTD" width="12%" id="negro"><font color="#FFFFFF">&nbsp;Negro</font></td> 
	</tr>
	<?php
		include ( '../src/FunGen/fncdetallagencontrolotservicio.php');
		$nureturn = fncdetallarqueritiempo($departcodigo,$servicicodigo);
	?>	
  </table>
 
  <input type="hidden" name="reqtiecodigo" value="<?php echo $reqtiecodigo; ?>">
</form>
</body>
</html>