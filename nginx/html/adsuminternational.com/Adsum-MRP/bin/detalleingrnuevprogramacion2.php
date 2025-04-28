<?php
ob_start();


	include ( '../src/FunPerPriNiv/pktbltarea.php');
	//include ( '../src/FunPerPriNiv/pktblparteot.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktblcomponen.php');
	include ( '../src/FunPerPriNiv/pktbltipotrab.php');
	include ( '../src/FunPerPriNiv/pktbltipomedi.php');
	include ( '../src/FunPerSecNiv/fncconn.php');

	if (preg_replace("/,/","",$arr_data) != ''){
		$arr_detalle = explode(":",$arr_data);
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
<SCRIPT LANGUAGE="JavaScript">


function delitemdata(data, arreglo){
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
	document.form2.arr_delitem.value = new_arreglo;
}

</script>
<form name="form2" method="post"  enctype="multipart/form-data">

  <table width="100%" border="0" cellspacing="2" cellpadding="0" align="center" cols="8">
    <tr>
	  <td class="NoiseFieldCaptionTD" width="2%"><font color="#FFFFFF">Colada.</font></td>
	  <td class="NoiseFieldCaptionTD" width="16%"><font color="#FFFFFF">&nbsp;Kg. chatarra</font></td>
	  <td class="NoiseFieldCaptionTD" width="14%"><font color="#FFFFFF">&nbsp;# Cargas</font></td>
	  <td class="NoiseFieldCaptionTD" width="14%"><font color="#FFFFFF">&nbsp;Acero</font></td>
	  <td class="NoiseFieldCaptionTD" width="13%"><font color="#FFFFFF">&nbsp;Supervisor</font></td>
	  <td class="NoiseFieldCaptionTD" width="2%"><font color="#FFFFFF">&nbsp;Kg. producidos</font></td>
	  <td class="NoiseFieldCaptionTD" width="2%"><font color="#FFFFFF">&nbsp;Kg recirc</font></td>
	  <td class="NoiseFieldCaptionTD" width="14%"><font color="#FFFFFF">&nbsp;Medidor</font></td>
	</tr>
	<?php
		include ( '../src/FunGen/fncdetalleprogramacion.php');
		$nureturn = fncdetalleprogramacion($arr_detalle, $idcon);
	?>	
  </table>
  
  <input type="hidden" name="arr_detalle">
  <input type="hidden" name="arr_delitem" value="<? echo $arr_delitem ?>">
</form>
</body>
</html>