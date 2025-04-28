<?php
ob_start();
	include ( '../src/FunPerPriNiv/pktbltipotrab.php');	
	include ( '../src/FunPerSecNiv/fncconn.php');
	
	//$arr_delitem = $arrdata;
	//$arreglo_sel = str_replace(",","",$arrdata)."";
	//$campo=0;
ob_end_flush();
?>

<html>
<head>
<title>Detalle tipos de trabajo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="0">
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js"		type="text/javascript" ></SCRIPT>
<script language=JavaScript src="../src/FunGen/colorfooter.js" type="text/javascript" ></script>
<SCRIPT LANGUAGE="JavaScript">
function verificdata(){
	var enc = 0;
	var err = 0;
	var arrnew =document.form1.arr_delitem.value;
	var arrold = document.form1.alltipotrab.value;
	var new_arreglo = "";
	var odl_arreglo = "";
	
	new_arreglo = arrnew.split(",");
	old_arreglo = arrold.split(",");
	if((new_arreglo.length) == (old_arreglo.length)){
		window.parent.document.form1.tipotra.checked = true;
	}else{
		window.parent.document.form1.tipotra.checked = flase;
	}
	
	if (new_arreglo != ""){
		for(var o=0; o < (old_arreglo.length); o++){
			for(var n=0; n < (new_arreglo.length); n++){
				if (new_arreglo[o] == old_arreglo[n]){
					enc = 1;
					break;
				}
			}
			if(enc != 1){
				window.parent.document.form1.tipotra.checked = false;
				window.parent.document.form1.tipotrabtmp.value = 0;
				err = 1;
				break;
			}
			enc = 0;
		}
		if(err != 1){
			window.parent.document.form1.tipotra.checked = true;
			window.parent.document.form1.tipotrabtmp.value = 1;
		}
	}
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
	document.form1.arr_delitem.value = new_arreglo;
	window.parent.document.form1.arrtipotrab.value = new_arreglo;
	verificdata();
}

</script>
<style type="text/css">
.estilo1 {font-size: 85%; font-family : Arial } 
</style>
</head>
<body bgcolor="White" text="#000000">
<form name="form1" method="post"  enctype="multipart/form-data">
  <table width="100%" border="0" cellspacing="1" cellpadding="1"  align="center"  >
   	<?php
  		
   	$nuConn = fncconn();
		$sql = "SELECT tiptracodigo,tiptranombre from tipotrab";
		
		$nuResult = pg_exec($nuConn,$sql);
		
  		if($nuResult > 0){
  			$nuCantRow = pg_numrows($nuResult); 
		
			for($i = 0; $i < $nuCantRow; $i++){
				$sbRow = pg_fetch_row ($nuResult,$i); 
				
				
				if (($i % 2) == 0){
					echo '              <tr bgcolor="#f0f6ff"  id="fila'.($i+ 1).'" onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out1(this)">'." \n";
				}else{
					echo '<tr bgcolor="#E8F0F6"  id="fila'.($i+1).'" onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out2(this)">'." \n";
				}

				echo '<td width="5%"   class="estilo1">';
				echo '<input type="checkbox" name="tipotra"  value="'.$sbRow[0].'" onclick = "delitemdata(this.value,document.form1.arr_delitem.value);" ';

				if ($arrdata  != true Or $plantall){
					//echo 'checked';
					if($arr_delitem)
						$arr_delitem = $arr_delitem.",".$sbRow[0];
					else 
						$arr_delitem = $sbRow[0];
				}else{
					$unless = 1;
				}
				
				
				if($arr_temp)
					$arr_temp = $arr_temp.",".$sbRow[0];
				else
					$arr_temp = $sbRow[0];
				
				echo '></td>'." \n";
				echo '<td width="95%"  class="estilo1" >&nbsp;'.$sbRow[1].'</td>'." \n";
				echo '<tr>'." \n";					
			}
			if($i < 4){
				for($j = $i; $j < 4; $j++){
					if (($j % 2) == 0){
						echo '              <tr bgcolor="#f0f6ff"><td>&nbsp;</td><td>&nbsp;</td></tr>'." \n";
					}else{
						echo '<tr bgcolor="#E8F0F6"><td>&nbsp;</td><td>&nbsp;</td></tr>'." \n";
					}
				}
			}
			
		}
		echo '<SCRIPT LANGUAGE="JavaScript">'."\n";		
		if($unless){
			echo 'window.parent.document.form1.tipotra.checked = false;'."\n";
			echo 'window.parent.document.form1.tipotrabtmp.value = 0;'."\n";
		}else{
			echo 'window.parent.document.form1.tipotra.checked = true;'."\n";
			echo 'window.parent.document.form1.tipotrabtmp.value = 1;'."\n";
		}
		echo 'window.parent.document.form1.arrtipotrab.value = "'.$arr_delitem.'";'."\n";
		echo '</script>';
	?>		
  </table>
  <input type="hidden" name="arr_detall" value="<?php echo $arr_detall; ?>">
  <input type="hidden" name="arr_delitem" value="<?php echo $arr_delitem; ?>">
  <input type="hidden" name="alltipotrab" value="<?php echo $arr_temp; ?>">

</form>
</body>
</html>