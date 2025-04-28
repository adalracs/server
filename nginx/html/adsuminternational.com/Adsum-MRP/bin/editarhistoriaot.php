<?php 
ob_start(); 
include ( '../src/FunGen/sesion/fncvalses.php'); 
if($accioneditarhistoriaot) 
{ 
	include ( 'editahistoriaot.php'); 
	$flageditarhistoriaot = 1; 
} 
ob_end_flush(); 
if(!$flageditarhistoriaot) 
{ 
include ( '../src/FunGen/sesion/fnccarga.php'); 
$sbreg = fnccarga($nombtabl,$radiobutton); 
if (!$sbreg) 
	{ 
		include( '../src/FunGen/fnccontfron.php'); 
	} 
} 
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andrés A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Editar registro de historiaot</title> 
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
<p><font class="NoiseFormHeaderFont">historiaot</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Editar registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="85%" border="0" cellspacing="0" cellpadding="0" 
align="center"> 
<tr> 
 <td width="41%"><?php if($campnomb == "histotcodigo"){$histotcodigo = null; 
echo "*";}?>histotcodigo</td> 
 <td width="59%"> 
  <input type="text" name="histotcodigo"	value="<?php 
if(!$flageditarhistoriaot){ echo $sbreg[histotcodigo];}else{ echo 
$histotcodigo; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "ordtracodigo"){$ordtracodigo = null; 
echo "*";}?>ordtracodigo</td> 
 <td width="59%"> 
  <input type="text" name="ordtracodigo"	value="<?php 
if(!$flageditarhistoriaot){ echo $sbreg[ordtracodigo];}else{ echo 
$ordtracodigo; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "histothorini"){$histothorini = null; 
echo "*";}?>histothorini</td> 
 <td width="59%"> 
  <input type="text" name="histothorini"	value="<?php 
if(!$flageditarhistoriaot){ echo $sbreg[histothorini];}else{ echo 
$histothorini; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "histotfecini"){$histotfecini = null; 
echo "*";}?>histotfecini</td> 
 <td width="59%"> 
  <input type="text" name="histotfecini"	value="<?php 
if(!$flageditarhistoriaot){ echo $sbreg[histotfecini];}else{ echo 
$histotfecini; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "histothorfin"){$histothorfin = null; 
echo "*";}?>histothorfin</td> 
 <td width="59%"> 
  <input type="text" name="histothorfin"	value="<?php 
if(!$flageditarhistoriaot){ echo $sbreg[histothorfin];}else{ echo 
$histothorfin; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "histotfecfin"){$histotfecfin = null; 
echo "*";}?>histotfecfin</td> 
 <td width="59%"> 
  <input type="text" name="histotfecfin"	value="<?php 
if(!$flageditarhistoriaot){ echo $sbreg[histotfecfin];}else{ echo 
$histotfecfin; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "histotsecuen"){$histotsecuen = null; 
echo "*";}?>histotsecuen</td> 
 <td width="59%"> 
  <input type="text" name="histotsecuen"	value="<?php 
if(!$flageditarhistoriaot){ echo $sbreg[histotsecuen];}else{ echo 
$histotsecuen; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "histotfin"){$histotfin = null; echo 
"*";}?>histotfin</td> 
 <td width="59%"> 
  <input type="text" name="histotfin"	value="<?php if(!$flageditarhistoriaot){ 
echo $sbreg[histotfin];}else{ echo $histotfin; }?>"> 
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
<input type="image" name="cancelar2" src="../img/ayuda.gif" width="86" 
height="18" alt="Cancelar" border=0> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accioneditarhistoriaot.value =  1;"  width="86" height="18" 
alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablhistoriaot.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
<?php 
if($campnomb){echo '<font face = "Verdana" >Corregir los capos marcados con 
*</font>}';} 
?> 
<input type="hidden" name="histotcodigo" value="<?php 
if(!$flageditarhistoriaot){ echo $sbreg[histotcodigo];}else{ echo 
$histotcodigo; } ?>"> 
<input type="hidden" name="accioneditarhistoriaot"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
