<?php 	
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	
	if(!$flagdetallarclase){ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton); 
	
		if (!$sbreg){ 
			include( '../src/FunGen/fnccontfron.php'); 
		} 
	} 
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: cbedoya
Fecha: 30-November-2007 
GenVers: 3.1 --> 
<html> 
	<head> 
		<title>Detalle de registro de clases</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
		<SCRIPT LANGUAGE="JavaScript"> 
			<!-- Begin 
			agree = 0; 
			//  End --> 
		</script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Clases</font></p> 
			<table width="400" border="0" align="center" cellpadding="0" cellspacing="0" class="NoiseFormTABLE"> 
  				<tr><td width="400" class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="85%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr> 
 								<td class="NoiseDataTD" width="40%">&nbsp;C&oacute;digo</td> 
 								<td><?php if(!$flagdetallarclase){ echo $sbreg[clasecodigo];}else{ echo $clasecodigo; } ?></td> 
 							</tr> 
							<tr> 
 								<td class="NoiseDataTD">&nbsp;Clases</td> 
 								<td><?php if(!$flagdetallarclase){ echo $sbreg[clasenombre];}else{ echo $clasenombre; } ?></td> 
 							</tr>
							<tr>
							  <td class="NoiseDataTD">&nbsp;Valor Clase </td>
							  <td><?php if(!$flagdetallarclase){ echo $sbreg[clasevalor];}else{ echo $clasevalor; } ?></td>
						  </tr> 
 							<tr>
 								<td class="NoiseDataTD">&nbsp;Descripci&oacute;n</td>
  								<td rowspan="2" valign="top" ><?php if(!$flagdetallarclase){echo $sbreg[clasedescri];}else {echo $clasedescri;}?></td>
 							</tr>
 							<tr class="NoiseDataTD"><td>&nbsp;</td></tr> 
						</table> 
  					</td> 
 				</tr> 
 				<tr> 
					<td><div align="center"> 
  						<input type="image" name="aceptar"  src="../img/aceptar.gif" onClick="form1.action='maestablclases.php';"  width="86" height="18" alt="Aceptar" border=0> 
					</div></td> 
 				</tr> 
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
 			
			<input type="hidden" name="flagdetallarclase" value="1"> 
			<input type="hidden" name="acciondetallarclase"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html> 
