<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andrés A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Consultar en historiaot</title> 
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
Consultar registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="85%" border="0" cellspacing="0" cellpadding="0" 
align="center"> 
              <tr> 
                <td width="41%">histotcodigo</td> 
<td width="59%"> 
<input type="text" name="histotcodigo" value="<?php 
if(!$flagconsultarhistoriaot){ echo $sbreg[histotcodigo];}else{ echo 
$histotcodigo; } ?>"> 
</td> 
</tr> 
<tr> 
 <td width="41%">histotcodigo</td> 
 <td width="59%"> 
  <input type="text" name="histotcodigo"	value="<?php 
if(!$flagconsultarhistoriaot){ echo $sbreg[histotcodigo];}else{ echo 
$histotcodigo; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%">ordtracodigo</td> 
 <td width="59%"> 
  <input type="text" name="ordtracodigo"	value="<?php 
if(!$flagconsultarhistoriaot){ echo $sbreg[ordtracodigo];}else{ echo 
$ordtracodigo; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%">histothorini</td> 
 <td width="59%"> 
  <input type="text" name="histothorini"	value="<?php 
if(!$flagconsultarhistoriaot){ echo $sbreg[histothorini];}else{ echo 
$histothorini; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%">histotfecini</td> 
 <td width="59%"> 
  <input type="text" name="histotfecini"	value="<?php 
if(!$flagconsultarhistoriaot){ echo $sbreg[histotfecini];}else{ echo 
$histotfecini; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%">histothorfin</td> 
 <td width="59%"> 
  <input type="text" name="histothorfin"	value="<?php 
if(!$flagconsultarhistoriaot){ echo $sbreg[histothorfin];}else{ echo 
$histothorfin; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%">histotfecfin</td> 
 <td width="59%"> 
  <input type="text" name="histotfecfin"	value="<?php 
if(!$flagconsultarhistoriaot){ echo $sbreg[histotfecfin];}else{ echo 
$histotfecfin; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%">histotsecuen</td> 
 <td width="59%"> 
  <input type="text" name="histotsecuen"	value="<?php 
if(!$flagconsultarhistoriaot){ echo $sbreg[histotsecuen];}else{ echo 
$histotsecuen; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%">histotfin</td> 
 <td width="59%"> 
  <input type="text" name="histotfin"	value="<?php 
if(!$flagconsultarhistoriaot){ echo $sbreg[histotfin];}else{ echo $histotfin; 
}?>"> 
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
onclick="form1.accionconsultarhistoriaot.value =  
1;form1.action='maestablhistoriaot.php';"  width="86" height="18" alt="Aceptar" 
border=0> 
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
 <input type="hidden" name="flagconsultarhistoriaot" value="1"> 
<input type="hidden" name="accionconsultarhistoriaot"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="columnas" value="histotcodigo, 
ordtracodigo, 
histothorini, 
histotfecini, 
histothorfin, 
histotfecfin, 
histotsecuen, 
histotfin 
"> 
<input type="hidden" name="nombtabl" value="historiaot"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
