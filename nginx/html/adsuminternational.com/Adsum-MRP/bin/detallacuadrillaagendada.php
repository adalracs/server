<?php
ob_start();
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblcargo.php');
	include ( '../src/FunPerSecNiv/fncconn.php');
	include ( '../src/FunPerSecNiv/fncclose.php');
	include('../src/FunPerPriNiv/pktblcuadrillausuario.php');
	
ob_end_flush();
?>

<html>
<head>
<title>Detalle Cuadrilla</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="0">
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js"		type="text/javascript" ></SCRIPT>
<style type="text/css">
.estilo1 {font-size: 85%; font-family : Arial } 
</style>
</head>
<body bgcolor="FFFFFF" text="#000000">
<form name="form2" method="post"  enctype="multipart/form-data">

  <table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" cols="7">
    <tr>
	  <td class="NoiseFieldCaptionTD" width="10%"><font color="#FFFFFF">&nbsp;Cedula</font></td>
	  <td class="NoiseFieldCaptionTD" width="40%"><font color="#FFFFFF">&nbsp;Nombre</font></td>
	  <td class="NoiseFieldCaptionTD" width="40%"><font color="#FFFFFF">&nbsp;Cargo</font></td>
	  <td class="NoiseFieldCaptionTD" width="8%"><font color="#FFFFFF">&nbsp;Lider</font></td>
	</tr>
		<?php
			include_once( '../src/FunGen/fncdetallausuacuadrilla.php');
			$nureturn = fncdetallacuadrilla($ccuadrilla);
		?>
  </table>
  
  <input type="hidden" name="arr_detall" value="<?php echo $arr_detall; ?>">
  <input type="hidden" name="arr_delitem" value="<?php echo $arr_delitem ?>">
  <input type="hidden" name="lider">
</form>
</body>
</html>