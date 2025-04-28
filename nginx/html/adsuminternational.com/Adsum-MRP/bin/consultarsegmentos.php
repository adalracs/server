<?php 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: cbedoya
Fecha: 30-November-2007 
GenVers: 3.1 --> 
<html> 
	<head> 
		<title>Consultar Segmento</title> 
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
			<p><font class="NoiseFormHeaderFont">Segmento</font></p> 
			<table width="350" border="0" align="center" cellpadding="0" cellspacing="0" class="NoiseFormTABLE"> 
  				<tr><td width="300" class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Consultar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="85%" border="0" cellspacing="1" cellpadding="0" align="center"> 
              				<tr> 
                				<td width="41%" class="NoiseDataTD">&nbsp;C&oacute;digo</td> 
								<td width="59%"><input type="text" name="segmencodigo" value="<?php if(!$flagconsultarsegmentos){ echo $sbreg[segmencodigo];}else{ echo $segmencodigo; } ?>"></td> 
							</tr> 
							<tr> 
 								<td width="41%" class="NoiseDataTD">&nbsp;Nombre</td> 
 								<td width="59%"><input type="text" name="segmennombre"	value="<?php if(!$flagconsultarsegmentos){ echo $sbreg[segmennombre];}else{ echo $segmennombre; }?>"></td> 
 							</tr> 
  							<tr>
 								<td width="41%" class="NoiseDataTD">&nbsp;Descripci&oacute;n</td>
  								<td rowspan="2"><textarea name="segmendescri" rows="3" wrap="VIRTUAL"><?php if(!$flagconsultarsegmentos){echo $sbreg[segmendescri];}else {echo $segmendescri;}?></textarea></td>
 							</tr>
							<tr class="NoiseDataTD"><td width="41%">&nbsp;</td></tr> 
						</table> 
  					</td> 
 				</tr> 
 				<tr> 
					<td><div align="center"> 
  						<input type="image" name="aceptar"  src="../img/aceptar.gif" onclick="form1.accionconsultarsegmentos.value = 1;form1.action='maestablsegmentos.php';"  width="86" height="18" alt="Aceptar" border=0> 
  						<input type="image" name="cancelar" src="../img/cancelar.gif" onclick="form1.action='maestablsegmentos.php';"  width="86" height="18" alt="Cancelar" border=0>
  					</div></td> 
 				</tr> 
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
 			
			<input type="hidden" name="flagconsultarsegmentos" value="1"> 
			<input type="hidden" name="accionconsultarsegmentos"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="columnas" value="segmencodigo, 
segmennombre,
segmendescri
"> 
			<input type="hidden" name="nombtabl" value="segmentos"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html> 