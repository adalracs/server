<html> 
	<head> 
		<title>Consultar en item's cierre</title> 
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
				window.opener.document.form1.arr_items.value = window.frames['lista_items'].document.form2.arr_delitem.value;
				window.opener.document.all("lista_items").src="detallaritemcierre.php?arr_items="+ window.opener.document.form1.arr_items.value + "&arreglo_ite=" + window.opener.document.form1.arreglo_ite.value;
				//alert( window.opener.document.form1.arr_items.value);
				//window.opener.document.form1.masact.focus();
				window.close();
			}
			function carga_list( itemcodigo){
				document.all("lista_items").src="detallarconsultaitem.php?arr_items="+ document.form1.arr_initem.value + "&itemcodigo=" + itemcodigo;
			}
		
		</SCRIPT>
		
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Item's</font></p>
			<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE" width="100%" > 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">&nbsp;Consultar registro</font></span></td></tr> 
				<tr>
					<td>
					<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center">        
	                        				<tr>
								<td>&nbsp;Codigo item &nbsp; <input name="itemcodigo" type="text" size="10" onchange="carga_list(this.value);"></td>
	                            				</tr>	
						</table>
					
					</td>    	
				
				</tr> 
				<tr> 
					<td> 
    						<table width="98%" border="1" cellspacing="1" cellpadding="0" align="center" bgcolor="White" height="300">        
	                        				<tr>
	                              					<td colspan="4" bgcolor="White" valign="top"><iframe src="detallarconsultaitem.php?arr_items=<?php echo $arr_items; ?>" frameborder="0" name="lista_items"  height="100%" width="100%" align="absmiddle"></iframe></td>
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
			<input type="hidden" name="arr_initem" value="<?php echo $arr_initem; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html> 
