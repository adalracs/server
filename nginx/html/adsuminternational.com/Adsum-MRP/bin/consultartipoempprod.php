<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andr�s A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Consultar en tipoempprod</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<SCRIPT LANGUAGE="JavaScript"> 
<!-- Begin 
agree = 0; 
//  End --> 
</script> 
</head> 
<?php 
    if(!$codigo) 
    { echo "<!--";} 
?> 
<body bgcolor="FFFFFF" text="#000000"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Tipos de colaboradores de producci&oacute;n</font></p> 
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
 <td width="59%"> 
  <input type="text" name="tipempprocodigo"	value="<?php 
if(!$flagconsultartipoempprod){ echo $sbreg[tipempprocodigo];}else{ echo 
$tipempprocodigo; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%">Nombre</td> 
 <td width="59%"> 
  <input type="text" name="tipemppronombre"	value="<?php 
if(!$flagconsultartipoempprod){ echo $sbreg[tipemppronombre];}else{ echo 
$tipemppronombre; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%">Descripci&oacute;n</td> 
 <td width="59%"> 
  <textarea name="tipempprodescri" rows="3" wrap="VIRTUAL"><?php 
if(!$flagconsultartipoempprod){ echo $sbreg[tipempprodescri];}else{ echo 
$tipempprodescri; }?></TEXTAREA>
 </td> 
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
onclick="form1.accionconsultartipoempprod.value =  
1;form1.action='maestabltipoempprod.php';"  width="86" height="18" 
alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestabltipoempprod.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
<input type="image" name="cancelar2" src="../img/ayuda.gif" width="86" 
height="18" alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagconsultartipoempprod" value="1"> 
<input type="hidden" name="accionconsultartipoempprod"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="columnas" value="tipempprocodigo, 
tipemppronombre, 
tipempprodescri 
"> 
<input type="hidden" name="nombtabl" value="tipoempprod"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
