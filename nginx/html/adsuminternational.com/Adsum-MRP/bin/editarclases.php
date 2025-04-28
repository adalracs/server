<?php 
ob_start(); 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	
	if($accioneditarclase){ 
		include ( 'editaclases.php'); 
		$flageditarclase = 1; 
	} 
ob_end_flush(); 

	if(!$flageditarclase){ 
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
Fecha: 30-Noviembre-2007
GenVers: 3.1 --> 
<html> 
	<head> 
		<title>Editar registro de clases</title> 
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
			<table width="350" border="0" align="center" cellpadding="0" cellspacing="0" class="NoiseFormTABLE"> 
  				<tr><td width="300" class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF"> Editar registro</font></span></td></tr> 
  				<tr> 
  					<td> 
            			<table width="85%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr> 
 								<td width="41%" class="NoiseDataTD"><?php if($campnomb["clasenombre"] == 1){$clasenombre = null; echo "*";} ?>&nbsp;Nombre</td> 
 								<td width="59%"><input type="text" name="clasenombre"	value="<?php if(!$flageditarclase){ echo $sbreg[clasenombre];}else{ echo $clasenombre; }?>"></td> 
 							</tr>
							<tr>
							  <td class="NoiseDataTD">&nbsp;Valor clase</td>
							  <td><input type="text" name="clasevalor"	value="<?php if(!$flageditarclase){ echo $sbreg[clasevalor];}else{ echo $clasevalor; }?>"></td>
						  </tr> 
  							<tr>
 								<td width="41%" class="NoiseDataTD"> <?php if($campnomb["clasedescri"] == 1){ $clasedescri=null; echo "*";} ?>&nbsp;Descripci&oacute;n</td>
  								<td rowspan="2"><textarea name="clasedescri" rows="3" wrap="VIRTUAL"><?php if(!$flageditarclase){echo $sbreg[clasedescri];}else {echo $clasedescri;}?></textarea></td>
 							</tr>
 							<tr class="NoiseDataTD"><td width="41%">&nbsp;</td></tr> 
						</table> 
  					</td> 
 				</tr> 
 				<tr> 
					<td><div align="center"> 
  						<input type="image" name="aceptar"  src="../img/aceptar.gif" onClick="form1.accioneditarclase.value =  1;"  width="86" height="18" alt="Aceptar" border=0> 
  						<input type="image" name="cancelar" src="../img/cancelar.gif" onClick="form1.action='maestablclases.php';"  width="86" height="18" alt="Cancelar" border=0> 
					</div></td> 
 				</tr> 
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
<?php if($campnomb){echo '<font face = "Verdana" >Corregir los capos marcados con *</font>';} ?> 
			<input type="hidden" name="clasecodigo" value="<?php if(!$flageditarclase){ echo $sbreg[clasecodigo];}else{ echo $clasecodigo; } ?>"> 
			<input type="hidden" name="accioneditarclase"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html> 
