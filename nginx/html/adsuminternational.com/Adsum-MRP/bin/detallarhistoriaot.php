<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
if(!$flagdetallarhistoriaot) 
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
Autor: Andr�s A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Detalle de registro de Gesti&oacute;n de OT</title> 
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
<p><font class="NoiseFormHeaderFont">Gesti&oacute;n de &Oacute;rdenes de trabajo</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Detallar registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="85%" border="0" cellspacing="0" cellpadding="3" 
align="center">  
</tr> 
<tr> 
 <td width="41%">C&oacute;digo</td> 
 <td width="59%"> 
  <input type="text" name="histotcodigo" value="<?php 
if(!$flagdetallarhistoriaot){ echo $sbreg[histotcodigo];}else{ echo 
$histotcodigo; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="41%">Orden de trabajo</td> 
 <td width="59%"> 
  <input type="text" name="ordtracodigo" value="<?php 
if(!$flagdetallarhistoriaot){ echo $sbreg[ordtracodigo];}else{ echo 
$ordtracodigo; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="41%">Hora de inicio</td> 
 <td width="59%"> 
  <input type="text" name="histothorini" value="<?php 
if(!$flagdetallarhistoriaot){ echo $sbreg[histothorini];}else{ echo 
$histothorini; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="41%">Fecha de inicio</td> 
 <td width="59%"> 
  <input type="text" name="histotfecini" value="<?php 
if(!$flagdetallarhistoriaot){ echo $sbreg[histotfecini];}else{ echo 
$histotfecini; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="41%">Hora de fin</td> 
 <td width="59%"> 
  <input type="text" name="histothorfin" value="<?php 
if(!$flagdetallarhistoriaot){ echo $sbreg[histothorfin];}else{ echo 
$histothorfin; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="41%">Fecha de fin</td> 
 <td width="59%"> 
  <input type="text" name="histotfecfin" value="<?php 
if(!$flagdetallarhistoriaot){ echo $sbreg[histotfecfin];}else{ echo 
$histotfecfin; } ?>" onFocus="if (!agree)this.blur();" > 
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
onclick="form1.action='maestablhistoriaot.php';"  width="86" height="18" 
alt="Aceptar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagdetallarhistoriaot" value="1"> 
<input type="hidden" name="acciondetallarhistoriaot"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html>