<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
?> 
<html> 
<head> 
<title>Consultar en centcost</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<SCRIPT LANGUAGE="JavaScript"> 
<!-- Begin 
agree = 0; 
//  End --> 
</script> 
<script language="JavaScript" src="motofech.js"></script> 
</head> 
<?php 
    if(!$codigo) 
    { echo "<!--";} 
?> 
<body bgcolor="FFFFFF" text="#000000"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Centro de costo</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE">
  				<tr>
    				<td class="NoiseErrorDataTD">&nbsp;</td>
  				</tr>
  				<tr>
          			<td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Consultar registro</font></span></td>
          		</tr>
				<tr>
					<td>
    			<table width="85%" border="0" cellspacing="0" cellpadding="0" align="center">
              				<tr>
 								<td width="41%">C&oacute;digo contable</td>
  								<td width="25%"><input type="text" name="cencosnumero" size="20" value="<?php if(!$flagconsultarcentcost){echo $sbreg[cencosnumero];}else {echo $cencosnumero;}?>"></td>
  								<td colspan="2">&nbsp;</td>
 							</tr>
    						<tr>
	                			<td>Nombre</td>
	                			<td colspan="3"><input type="text" name="cencosnombre" size="40" value="<?php if(!$flagconsultarcentcost){echo $sbreg[cencosnombre];}else {echo $cencosnombre;}?>"></td>
              				</tr>
              				<tr>
 								<td width="41%">Responsable</td>
  								<td colspan="3"><input type="text" name="cencosbenefi" size="40" value="<?php if(!$flagconsultarcentcost){echo $sbreg[cencosbenefi];}else {echo $cencosbenefi;}?>"></td>
 							</tr>
 							<tr>
 								<td width="41%">Direcci&oacute;n</td>
  								<td width="25%"><input type="text" name="cencosdirecc"	value="<?php if(!$flagconsultarcentcost){echo $sbreg[cencosdirecc];}else {echo $cencosdirecc;}?>"></td>
  								<td width="41%">Tel&eacute;fono</td>
  								<td width="25%"><input type="text" name="cencostelefo" size="20" value="<?php if(!$flagconsultarcentcost){echo $sbreg[cencostelefo];}else {echo $cencostelefo;}?>"></td>
 							</tr>
							<tr>
 								<td width="41%">Fax</td>
  								<td width="25%"><input type="text" name="cencosfax" size="20" value="<?php if(!$flagconsultarcentcost){echo $sbreg[cencosfax];}else {echo $cencosfax;}?>"></td>
  								<td width="41%">email</td>
  								<td width="25%"><input type="text" name="cencosemail"	value="<?php if(!$flagconsultarcentcost){echo $sbreg[cencosemail];}else {echo $cencosemail;}?>"></td>
 							</tr>
 							<tr>
 								<td width="41%">Descripci&oacute;n</td>
  								<td colspan="3" rowspan="2"><textarea name="cencosdescri" rows="3" cols="50" wrap="VIRTUAL"><?php if(!$flagconsultarcentcost){ echo $sbreg[cencosdescri];}else {echo $cencosdescri;}?></textarea></td> 
 							</tr>
 							<tr>
  								<td width="41%">&nbsp;</td>
 							</tr>
						</table>
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionconsultarcentcost.value =  1; 
form1.action='maestablcentcost.php';"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablcentcost.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagconsultarcentcost" value="1"> 
<input type="hidden" name="accionconsultarcentcost"> 
<input type="hidden" name="cencoscodigo"	value="<?php if(!$flagconsultarcentcost){echo $sbreg[cencoscodigo];}else {echo $cencoscodigo;}?>">
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="columnas" value="cencoscodigo, 
cencosnombre, 
cencosbenefi,
cencosnumero,
cencosdirecc,
cencostelefo,
cencosfax,
cencosemail,
cencosdescri 
"> 
<input type="hidden" name="nombtabl" value="centcost"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
