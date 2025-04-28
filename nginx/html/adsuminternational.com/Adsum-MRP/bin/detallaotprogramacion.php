<?php
	include ( '../src/FunGen/sesion/fncvalsesion.php');
	include ( '../src/FunPerPriNiv/pktblprogramacion.php');
	include ( '../src/FunPerPriNiv/pktbltarea.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktbltipomant.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	
	
	include ( '../src/FunPerPriNiv/pktblcomponen.php');
	include ( '../src/FunPerPriNiv/pktbltipotrab.php');
	include ( '../src/FunPerPriNiv/pktbltipomedi.php');

if($arr_data)
	$arrayDatos = explode(",",",".$arr_data);
	
?>

<html>
	<head>
		<title>Detalle Programacion</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
		<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js"		type="text/javascript" ></SCRIPT>
		<style type="text/css"> 
			body {
				margin-left: 0px;
				margin-top: 0px;
				margin-right: 0px;
				margin-bottom: 0px;
			}
		</style>
	</head>
	<body bgcolor="FFFFFF" text="#000000">
		<SCRIPT LANGUAGE="JavaScript">
			function coditemdata(data, arreglo){
				var enc = 0;
				var new_arreglo ="";
				
				arreglogen = arreglo.split(":?:");
				if (arreglogen != ""){
					for(var i=0; i < (arreglogen.length); i++){
						if (arreglogen[i] == data){
							enc = 1;
						}else{
							if( arreglogen[i] != ''){
								if (new_arreglo == ''){
									new_arreglo = arreglogen[i];
								}else{
									new_arreglo = new_arreglo + ":?:" + arreglogen[i];
								}			
							}
						}	
					}
				}

				if (enc == 0) {
					if (new_arreglo == ""){
						new_arreglo = data;	
					}else{
						new_arreglo = data + ":?:" + new_arreglo;
					}
				}
				var arreglo_cnt = new_arreglo.split(":?:");

				if(arreglo_cnt.length == document.form2.iRegcantidad.value){
					document.form2.All.checked = true;
					document.form2.alldata.value = 1;
				}else if(arreglo_cnt.length < document.form2.iRegcantidad.value){
					document.form2.All.checked = false;
					document.form2.alldata.value = 0;
				}
				
				document.form2.arr_coditem.value = new_arreglo;
				//alert(document.form2.arr_coditem.value);
			}

			function state(){
			    document.form2.arr_coditem.value ='';
			    for(var i=0; i < (document.form2.iRegcantidad.value); i++){
			    	
			    	document.all('D'+i).checked = document.form2.All.checked;
			    	if (document.form2.All.checked == true){
			    		document.form2.alldata.value = 1;
			    	   	if(document.form2.arr_coditem.value==''){
			    	   		document.form2.arr_coditem.value = document.all('D'+i).value;
			    	   	}else{
			    	   		document.form2.arr_coditem.value = document.form2.arr_coditem.value + ':?:' + document.all('D'+i).value;	
			    	   	}    	   
			    	}
			    }
			   //alert(document.form2.arr_coditem.value);
			}
		</script>
		<form name="form2" method="post"  enctype="multipart/form-data">
	  		<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" cols="10">
    			<tr>
					<td  class="NoiseFieldCaptionTD" width="5%"  align="center" style="font-size: 90%; color: #ffffff">&nbsp;Sel.<input type="checkbox" name="All" <?php if($alldata){echo "checked"; } ?> onclick="state();" ></td>
					
					<td class="NoiseFieldCaptionTD" width="5%"  align="center" style="font-size: 90%; color: #ffffff">&nbsp;C&oacute;digo</td>
					<td class="NoiseFieldCaptionTD" width="10%"  align="center" style="font-size: 90%; color: #ffffff">&nbsp;Tarea</td>
					<td class="NoiseFieldCaptionTD" width="20%"  align="center" style="font-size: 90%; color: #ffffff">&nbsp;Descripcion</td>
					<td class="NoiseFieldCaptionTD" width="15%"  align="center" style="font-size: 90%; color: #ffffff">&nbsp;Equipo/Componente</td>
					<td class="NoiseFieldCaptionTD" width="10%"  align="center" style="font-size: 90%; color: #ffffff">&nbsp;Tipo de trabajo</td>
					<td class="NoiseFieldCaptionTD" width="5%"  align="center" style="font-size: 90%; color: #ffffff">&nbsp;Dur. hr.</td>
					<td class="NoiseFieldCaptionTD" width="5%"  align="center" style="font-size: 90%; color: #ffffff">&nbsp;Frec.</td>
					<td class="NoiseFieldCaptionTD" width="5%"  align="center" style="font-size: 90%; color: #ffffff">&nbsp;Medidor</td> 
					<td class="NoiseFieldCaptionTD" width="6%"  align="center" style="font-size: 90%; color: #ffffff">&nbsp;Fecha de contador</td>
					<!--<td class="NoiseFieldCaptionTD" width="6%"  align="center" style="font-size: 90%; color: #ffffff">&nbsp;F. Actual</td>-->
					<td class="NoiseFieldCaptionTD" width="5%"  align="center" style="font-size: 90%; color: #ffffff">&nbsp;Planta</td>						
					<td class="NoiseFieldCaptionTD" width="6%"  align="center" style="font-size: 90%; color: #ffffff">&nbsp;Fecha generacion</td> 
					
				</tr>
				<?php
					include ( '../src/FunGen/fncdetalleprogramacion.php');
					$irecprogramacion["plantacodigo"] = $plantacodigo;
					$irecprogramacion["ingplantas"] = $ingplantas;
					$irecprogramacion["sistemcodigo"] = $sistemcodigo;
					$irecprogramacion["tipequcodigo"] = $tipequcodigo;
					$irecprogramacion["equipocodigo"] = $equipocodigo;
					$irecprogramacion["prograrepot"] = $estadoprogra;
					$irecprogramacion["prografechfutur"] = $prografechfutur;
					$irecprogramacion["tiptracodigo"] = $tiptracodigo;
					$iregdata = fncdetalleotprogramacion(  $irecprogramacion, $arrayDatos);
					$iregarr_data = explode(";--;",$iregdata);
					//$arr_coditem = $iregarr_data[0];
					$iRegcantidad = $iregarr_data[1];
				?>	
	  		</table>
	  		<input type="hidden" name="arr_coditem" value="<?php echo $arr_coditem ?>">
  			<input type="hidden" name="iRegcantidad" value="<?php echo $iRegcantidad ?>">
  			<input type="hidden" name="alldata" value="<?php echo $alldata ?>">
		</form> 
	</body>
</html>