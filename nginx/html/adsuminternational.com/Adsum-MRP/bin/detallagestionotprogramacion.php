<?php
ob_start();
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerSecNiv/fncconn.php');
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
<SCRIPT LANGUAGE="JavaScript">


function coditemdata(data, arreglo){
	var enc = 0;
	var new_arreglo ="";
	
	arreglogen = arreglo.split(",");
	
	if (arreglogen != ""){
		for(var i=0; i < (arreglogen.length); i++){
			if (arreglogen[i] == data){
				enc = 1;
			}else{
				if (i == 0){
					new_arreglo = arreglogen[i];
				}else{
					new_arreglo = new_arreglo + "," + arreglogen[i];
				}			
			}
		}
	}
	
	if (enc == 0) {
		if (new_arreglo == ""){
			new_arreglo = data;	
		}else{
			new_arreglo = data + "," + new_arreglo;
		}
	}
	document.form2.arr_coditem.value = new_arreglo;
	alert(document.form2.arr_coditem.value);
}

</script>
<form name="form2" method="post"  enctype="multipart/form-data">

  <table width="100%" border="0" cellspacing="2" cellpadding="0" align="center" cols="8">
    <tr>
	  <td class="NoiseFieldCaptionTD" width="2%"><font color="#FFFFFF">Sel.</font></td>
	  <td class="NoiseFieldCaptionTD" width="15%"><font color="#FFFFFF">&nbsp;Num. OT</font></td>
	  <td class="NoiseFieldCaptionTD" width="25%"><font color="#FFFFFF">&nbsp;Sistema</font></td>
	  <td class="NoiseFieldCaptionTD" width="28%"><font color="#FFFFFF">&nbsp;Tipo de Mantenimiento</font></td>
	  <td class="NoiseFieldCaptionTD" width="30%"><font color="#FFFFFF">&nbsp;Encargado</font></td>

	</tr>
	<?php	
		include ( '../src/FunGen/fncdetalleprogramacion.php');
		$nureturn = fncdetallegestionotprogramacion();
	?>	
  </table>

  <input type="hidden" name="arr_coditem" value="<? echo $arr_coditem ?>">
</form>
</body>
</html>