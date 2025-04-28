<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
?> 
<html> 
	<head> 
		<title>Consultar en bienes inmueble</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
		<script language="JavaScript" src="motofech.js"></script> 
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Bienes inmuebles temporales</font></p> 
			<table width="40%" border="0" align="center" cellpadding="2" cellspacing="1" class="NoiseFormTABLE"> 
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Consultar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr> 
 								<td width="20%" valign="top" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
  								<td width="80%" class="NoiseFooterTD"><input type="text" name="bieninmucodigo" value="<?php echo $bieninmucodigo; ?>"></td> 
 							</tr> 
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Nombre</td> 
  								<td class="NoiseFooterTD"><input type="text" name="bieninmunombre"	value="<?php echo $bieninmunombre; ?>"></td> 
 							</tr> 
							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td></tr>
  							<tr><td colspan="2" class="NoiseFooterTD"><textarea name="bieninmudescri" rows="3" cols="60" wrap="VIRTUAL"><?php echo $bieninmudescri; ?></textarea></td></tr>
					  </table> 
  					</td> 
 				</tr> 
 				<tr> 
					<td> 
						<div align="center"> 
  							<input type="image" name="aceptar"  src="../img/aceptar.gif" onClick="form1.accionconsultarbienesinmueble.value =  1; form1.action='maestablbienesinmu.php';"  width="86" height="18" alt="Aceptar" border=0> 
  							<input type="image" name="cancelar" src="../img/cancelar.gif" onClick="form1.action='maestablbienesinmu.php';"  width="86" height="18" alt="Cancelar" border=0> 
						</div> 
					</td> 
 				</tr> 
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td> </tr> 
			</table> 
			 <input type="hidden" name="flagconsultarbienesinmueble" value="1"> 
			<input type="hidden" name="accionconsultarbienesinmueble"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="columnas" value="bieninmucodigo,bieninmunombre,bieninmudescri"> 
			<input type="hidden" name="nombtabl" value="bienesinmueble"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; }?> 
</html>