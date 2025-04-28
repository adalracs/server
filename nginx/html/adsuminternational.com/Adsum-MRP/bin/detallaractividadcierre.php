<?php
ob_start();
	include ( '../src/FunPerPriNiv/pktblclases.php');	
	include ( '../src/FunPerPriNiv/pktblactividades.php');	
	include ( '../src/FunPerPriNiv/pktblunimedida.php');	
	include ( '../src/FunPerSecNiv/fncconn.php');
	
	$arr_delitem = $arr_actividades;
	$arreglo_acti = $arreglo_act;
	
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
	function formatNumber(num,prefix){
		prefix = prefix || '';
		num += '';
		var splitStr = num.split('.');
		var splitLeft = splitStr[0];		
		var splitRight = splitStr.length > 1 ? redonNumber(num) : '00';
		var regx = /(\d+)(\d{3})/;
		while (regx.test(splitLeft)) {
			splitLeft = splitLeft.replace(regx, '$1' + ',' + '$2');
		}
		return prefix + " " + splitLeft + splitRight;
	}

	function redonNumber(num) {
		var number = 1;	
		if(num.length >= 2){
			//if(num[2] > 5){
				//if(num[1] == 9){
					
//					number = number + parseInt(num[1]);
				return '.' + num[0] + num[1];
			//}else{
				//return '.' + num[0] + num[1];
			//}
		}else{
			//if(num.length == 1){
				return '.' + num + '0';
			/*}else{
				return '.' + num;
			}*/ 
		} 
				 
	}
	
 



function carga_arreglo(arreglo, arreglovalor){
	
	var new_arreglo = "";
	var new_arregloval = "";
	var new_arregloval2 = "";
	
	
	var valor_ot = 0;
	//var valor_ot = 0;
	//var valor_ot = 0;
	
	
	new_arregloval = arreglovalor.split(";");
	//alert(new_arregloval);	
	
	arreglogen = arreglo.split(",");
	if( arreglogen != "" ){
		for( var i = 0; i < (arreglogen.length);  i++ ){
			if(document.getElementById(arreglogen[i]).value == ''){
				document.getElementById(arreglogen[i]).value = 0;
			}
			if ( new_arreglo == '' ){
				new_arreglo = arreglogen[i] + ":" + document.getElementById(arreglogen[i]).value;
			}else{
				new_arreglo = new_arreglo + ";" + arreglogen[i] + ":" + document.getElementById(arreglogen[i]).value;
			}
			
			for( var j = 0; j < (new_arregloval.length); j++ ){
				new_arregloval2 = new_arregloval[j].split(":");
				
				if (new_arregloval2[0] == arreglogen[i]){
					valor_ot = valor_ot + ( ( document.getElementById(arreglogen[i]).value * new_arregloval2[2] ) * new_arregloval2[1] );
					//alert(new_arregloval2[0]);
					break;
				}
			
			}
			
			//valor_ot =  ( document.getElementById(arreglogen[i]).value * valorbaremo ) * valorclase;
			
			//alert(valor_ot);
			
			
			
		}	
	}
	//document.form2.valores.value = arreglovalor;
	window.parent.document.form1.arreglo_act.value = new_arreglo;
	window.parent.document.form1.clientvalpro.value = formatNumber(valor_ot,'$');
	window.parent.document.form1.clientvalpro1.value = valor_ot; 
	document.form2.arreglo_acti.value = new_arreglo;
	//alert(window.parent.document.form1.arreglo_act.value);
}

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
}

</script>
<style type="text/css">
.estilo1 {font-size: 85%; font-family : Arial } 
</style>
</head>
<body bgcolor="FFFFFF" text="#000000">
<form name="form2" method="post"  enctype="multipart/form-data">

  <table width="100%" border="0" cellspacing="1" cellpadding="1"  align="center" cols="4">
  	  <td class="NoiseFieldCaptionTD" width="5%"><font color="#FFFFFF">Sel.</font></td>
	  
	  <td class="NoiseFieldCaptionTD" width="15%"><font color="#FFFFFF">&nbsp;C&oacute;digo</font></td>
	  <td class="NoiseFieldCaptionTD" width="80%"><font color="#FFFFFF">&nbsp;Actividad</font></td>
	  <td class="NoiseFieldCaptionTD" width="5%"><font color="#FFFFFF">&nbsp;Unid.</font></td>
	  <td class="NoiseFieldCaptionTD" width="5%"><font color="#FFFFFF">&nbsp;Cantidad</font></td>
	<?php
		include ( '../src/FunGen/fncdetallaactividadservicio.php');
		detallelistactividadcierre($arr_actividades,$arreglo_acti);
	?>		
  </table>
 
  <input type="hidden" name="arr_detall" value="<?php echo $arr_detall; ?>">
  <input type="hidden" name="arr_delitem" value="<?php echo $arr_delitem; ?>">
    <input type="hidden" name="arreglo_acti" value="<?php echo $arreglo_acti; ?>">
    <input type="hidden" name="valores">
</form>
</body>
</html>