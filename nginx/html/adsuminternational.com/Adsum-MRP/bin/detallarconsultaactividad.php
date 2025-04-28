<?php
ob_start();
	include ( '../src/FunPerPriNiv/pktblclases.php');	
	include ( '../src/FunPerPriNiv/pktblactividades.php');	
	include ( '../src/FunPerPriNiv/pktblservicio.php');	
	include ( '../src/FunPerPriNiv/pktblunimedida.php');	
	include ( '../src/FunPerSecNiv/fncconn.php');
	
	$arr_delitem = $arr_actividades;
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
	window.parent.document.form1.arr_iniact.value = new_arreglo;

	//alert(document.form2.arr_delitem.value);
}

</script>
<style type="text/css">
.estilo1 {font-size: 85%; font-family : Arial } 
</style>
</head>
<body bgcolor="FFFFFF" text="#000000">
<form name="form2" method="post"  enctype="multipart/form-data">

  <table width="100%" border="0" cellspacing="1" cellpadding="1"  align="center" cols="4">

	<?php
		include ( '../src/FunGen/fncdetallaactividadservicio.php');
		fncdetallacierreactividadgen($clasecodigo,$activicodigo, $arr_actividades);
	?>		
  </table>
 
  <input type="hidden" name="arr_detall" value="<?php echo $arr_detall; ?>">
  <input type="hidden" name="arr_delitem" value="<?php echo $arr_delitem; ?>">
</form>
</body>
</html>