<?php
ob_start();
	include ( '../src/FunPerPriNiv/pktblvistacuadrillas.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerSecNiv/fncconn.php');
	include ( '../src/FunPerSecNiv/fncclose.php');
	
ob_end_flush();
?>

<html>
<head>
<title>Detalle Cuadrilla</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="0">
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js"		type="text/javascript" ></SCRIPT>
<SCRIPT language="JavaScript">
	function open_window(){
	
		
		
	alert('mm');
}

</script>
<style type="text/css">
.estilo1 {font-size: 95%; font-family : Arial } 
</style>
</head>
<body bgcolor="FFFFFF" text="#000000">
<form name="form2" method="post"  enctype="multipart/form-data">

  <table width="100%" border="0" cellspacing="2" cellpadding="2" align="center">
    <tr>
    	<table width="100%" border="0" cellspacing="1" cellpadding="2" align="center" cols="7">
    		<tr>
    			<!--<td class="NoiseFieldCaptionTD" width="2%" rowspan="2"><font color="#FFFFFF"><small>Sel.</small></font></td>-->
	  		<td class="NoiseFieldCaptionTD" width="20%" rowspan="2"><font color="#FFFFFF"><small>&nbsp;Cuadrilla / Tecnico</small></font></td>
	  		<td class="NoiseFieldCaptionTD" width="11%" align="left"><font color="#FFFFFF"><small>&nbsp;7:00 a.m.</small></font></td>
	  		<td class="NoiseFieldCaptionTD" width="11%" align="left"><font color="#FFFFFF"><small>&nbsp;9:00 a.m.</small></font></td>
	  		<td class="NoiseFieldCaptionTD" width="11%" align="left"><font color="#FFFFFF"><small>&nbsp;11:00 a.m.</small></font></td>
	  		<td class="NoiseFieldCaptionTD" width="11%" align="left"><font color="#FFFFFF"><small>&nbsp;1:00 p.m.</small></font></td>
	  		<td class="NoiseFieldCaptionTD" width="11%" align="left"><font color="#FFFFFF"><small>&nbsp;3:00 p.m.</small></font></td>
	  		<td class="NoiseFieldCaptionTD" width="11%" align="left"><font color="#FFFFFF"><small>&nbsp;5:00 p.m.</small></font></td>
	  		<td class="NoiseFieldCaptionTD" width="11%" align="left"><font color="#FFFFFF"><small>&nbsp;7:00 p.m.</small></font></td>
	  		<td class="NoiseFieldCaptionTD" width="2%" rowspan="2"><font color="#FFFFFF"><small>&nbsp;Num. OT's</small></font></td>
    		</tr>
    		<tr>
			  <td class="NoiseFieldCaptionTD" width="11%" align="right"><font color="#FFFFFF"><small>9:00 a.m.&nbsp;</small></font></td>
			  <td class="NoiseFieldCaptionTD" width="11%" align="right"><font color="#FFFFFF"><small>11:00 a.m.&nbsp;</small></font></td>
			  <td class="NoiseFieldCaptionTD" width="11%" align="right"><font color="#FFFFFF"><small>1:00 p.m.&nbsp;</small></font></td>
			  <td class="NoiseFieldCaptionTD" width="11%" align="right"><font color="#FFFFFF"><small>3:00 p.m.&nbsp;</small></font></td>
			  <td class="NoiseFieldCaptionTD" width="11%" align="right"><font color="#FFFFFF"><small>5:00 p.m.&nbsp;</small></font></td>
			  <td class="NoiseFieldCaptionTD" width="11%" align="right"><font color="#FFFFFF"><small>7:00 p.m.&nbsp;</small></font></td>
			  <td class="NoiseFieldCaptionTD" width="11%" align="right"><font color="#FFFFFF"><small>7:00 a.m.&nbsp;</small></font></td>
	  	</tr>
	</tr>
	<?php
		include ( '../src/FunGen/fncdetallaagendacuadrilla.php');
		$nureturn = fncdetallaagendacuadrilla($servicio,$zona,$subzona,$fecreg,$ciudadcodigo);
	?>	
  </table>
  
  <input type="hidden" name="arr_detall" value="<?php echo $arr_detall; ?>">
  <input type="hidden" name="arr_delitem" value="<?php echo $arr_delitem ?>">
  <input type="hidden" name="lider">
</form>
</body>
</html>