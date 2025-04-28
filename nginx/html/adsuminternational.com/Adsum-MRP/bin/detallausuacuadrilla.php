<?php
ob_start();
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblcargo.php');
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
<style type="text/css">
.estilo1 {font-size: 85%; font-family : Arial } 
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
				if( arreglogen[i] != ''){
					if (new_arreglo == ''){
						new_arreglo = arreglogen[i];
					}else{
						new_arreglo = new_arreglo + "," + arreglogen[i];
					}			
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
	//alert(document.form2.arr_delitem.value);
}

</script>
<form name="form2" method="post"  enctype="multipart/form-data">

  <table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" cols="7">
    <tr>
	  <td class="NoiseFieldCaptionTD" width="2%"><font color="#FFFFFF">Sel.</font></td>
	  <td class="NoiseFieldCaptionTD" width="10%"><font color="#FFFFFF">&nbsp;Cedula</font></td>
	  <td class="NoiseFieldCaptionTD" width="40%"><font color="#FFFFFF">&nbsp;Nombre</font></td>
	  <td class="NoiseFieldCaptionTD" width="40%"><font color="#FFFFFF">&nbsp;Cargo</font></td>
	  <td class="NoiseFieldCaptionTD" width="8%"><font color="#FFFFFF">&nbsp;Lider</font></td>
	</tr>
	<?php
		include ( '../src/FunGen/fncdetallausuacuadrilla.php');
		$nureturn = fncdetallausuacuadrilla($arr_detall,$lider);
	?>	
  </table>
  
  <input type="hidden" name="arr_detall" value="<?php echo $arr_detall; ?>">
  <input type="hidden" name="arr_delitem" value="<?php echo $arr_delitem ?>">
  <input type="hidden" name="lider">
</form>
</body>
</html>