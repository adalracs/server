<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
?> 
<html> 
<head> 
<title>Consultar en plano</title> 
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
<p><font class="NoiseFormHeaderFont">Planos</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Consultar registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="85%" border="0" cellspacing="0" cellpadding="3" 
align="center"> 
<tr> 
 <td width="41%">C&oacute;digo</td> 
  <td><input type="text" name="planocodigo"	value="<?php if(!$flagconsultarplano){ 
echo $sbreg[planocodigo];}else {echo $planocodigo;}?>"> 
  </td> 
 </tr> 
<tr> 
 <td width="41%">Nombre</td> 
  <td><input type="text" name="planonombre"	value="<?php if(!$flagconsultarplano){ 
echo $sbreg[planonombre];}else {echo $planonombre;}?>"> 
  </td> 
 </tr> 
<tr>
  <td width="41%">Ruta</td>
  <td><input type="text" name="planoruta"	value="<?php if(!$flagconsultarplano){ echo 
$sbreg[planoruta];}else {echo $planoruta;}?>"></td>
  </tr>
<tr> 
 <td width="41%">Descripci&oacute;n</td> 
  <td rowspan="2"> 
    <textarea name="planodescri" rows="3" wrap="VIRTUAL"><?php if(!$flagconsultarplano){ 
echo $sbreg[planodescri];}else {echo $planodescri;}?></textarea> 
  </td> 
 </tr>
<tr>
  <td>&nbsp;</td>
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
onclick="form1.accionconsultarplano.value =  1; 
form1.action='maestablplano.php';"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablplano.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
<img src="../img/ayuda.gif" border="0" alt="Ayuda">
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagconsultarplano" value="1"> 
<input type="hidden" name="accionconsultarplano"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="columnas" value="planocodigo, 
planonombre, 
planoruta, 
planodescri
"> 
<input type="hidden" name="nombtabl" value="plano"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
