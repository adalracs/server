<?php
	include('../src/FunPerSecNiv/fncclose.php');
	include('../src/FunPerSecNiv/fncconn.php');
	include('../src/FunPerSecNiv/fncnumreg.php');
	include('../src/FunPerSecNiv/fncfetch.php');
	include ( '../src/FunPerPriNiv/pktblclases.php');

?>
<html> 
	<head> 
		<title>Consultar en actividades cierre</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
		<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js"		type="text/javascript" ></SCRIPT>
		<SCRIPT LANGUAGE="JavaScript"> 
			<!-- Begin 
			agree = 0; 
			//  End --> 
		</script> 
		<SCRIPT LANGUAGE="JavaScript">
			function carga_array(){
				window.opener.document.form1.arr_actividades.value = window.frames['lista_actividades'].document.form2.arr_delitem.value;
				//alert(window.frames['lista_actividades'].document.form2.arr_delitem.value);
				window.opener.document.all("lista_actividades").src="detallaractividadcierre.php?arr_actividades="+ window.opener.document.form1.arr_actividades.value + "&arreglo_act=" + window.opener.document.form1.arreglo_act.value;
				
				//window.opener.document.form1.masact.focus();
				window.close();
			}
			function carga_list(clasecodigo, activicodigo){
				document.all("lista_actividades").src="detallarconsultaactividad.php?arr_actividades="+ document.form1.arr_iniact.value + "&clasecodigo=" + clasecodigo + "&activicodigo=" + document.form1.activicodigo.value;
			}
		</SCRIPT>
		
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Actividades</font></p>
			<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE" width="100%" > 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">&nbsp;Consultar registro</font></span></td></tr> 
				<tr>
					<td>
					<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center">        
	                        				<tr>
	                              					<td>&nbsp;Clases</td>
	                              					<td width="20%"><select name="clasecodigo" onChange="carga_list(this.value, form1.activicodigo.value);">
								<?php
									$clasecodigo1 = $clasecodigo;
									
									echo '<option value = "">Todos</option>';
									$idcon = fncconn();
									$result = fullscanclases($idcon);
																
									if($result > 0)
										$numReg = fncnumreg($result);
																
									if($numReg){
										for ($i=0;$i<$numReg;$i++){
											$arr=fncfetch($result,$i);
					
											if($arr[clasecodigo] != 0){
								    				echo '<option value ="'.$arr[clasecodigo].'" ';
								    						
								    				if($clasecodigo1 == $arr[clasecodigo])
									    				echo "selected";
								    			}	
								    			echo ">".$arr[clasenombre]."</option>"."\n";
										}
									}
								?>
					      	  		</select></td>
								<td>&nbsp;Codigo actiividad</td>
								<td><input name="activicodigo" type="text" size="10" onkeyup="carga_list( form1.clasecodigo.value, this.value);" onkeydown="carga_list( form1.clasecodigo.value, this.value);"></td>
	                            				</tr>	
						</table>
					
					</td>    	
				
				</tr> 
				<tr> 
					<td> 
    						<table width="98%" border="1" cellspacing="1" cellpadding="0" align="center" bgcolor="White" height="300">        
	                        				<tr>
	                              					<td colspan="4" bgcolor="White" valign="top"><iframe src="detallarconsultaactividad.php?arr_actividades=<?php echo $arr_actividades; ?>" frameborder="0" name="lista_actividades"  height="100%" width="100%" align="absmiddle"></iframe></td>
	                            				</tr>	
						</table>
					</td>
				</tr>
				<tr><td width="41%">&nbsp;</td></tr> 
				<tr> 
					<td> 
						<div align="center"> 
								<input type="image" name="aceptar"  src="../img/aceptar.gif" onclick="carga_array();"  width="86" height="18" alt="Aceptar" border=0> 
								<input type="image" name="cancelar" src="../img/cancelar.gif" onclick="window.close();"  width="86" height="18" alt="Cancelar" border=0> 
						</div> 
					</td> 
				</tr> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="arr_iniact" value="<?php echo $arr_iniact; ?>"> 			
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html> 
