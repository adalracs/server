<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
if(!$flagborrarherramietemp) 
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
<title>Borrar registro de herramietemp</title> 
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
<p><font class="NoiseFormHeaderFont">herramietemp</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Borrar registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="85%" border="0" cellspacing="0" cellpadding="0" 
align="center"> 
              <tr> 
                <td width="41%">hertemcodigo</td> 
<td width="59%"> 
<input type="text" name="hertemcodigo" value="<?php 
if(!$flagborrarherramietemp){ echo $sbreg[hertemcodigo];}else{ echo 
$hertemcodigo; } ?>"> 
</td> 
</tr> 
<tr> 
 <td width="41%">hertemcodigo</td> 
 <td width="59%"> 
  <input type="text" name="hertemcodigo" value="<?php 
if(!$flagborrarherramietemp){ echo $sbreg[hertemcodigo];}else{ echo 
$hertemcodigo; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="41%">cencoscodigo</td> 
 <td width="59%"> 
  <input type="text" name="cencoscodigo" value="<?php 
if(!$flagborrarherramietemp){ echo $sbreg[cencoscodigo];}else{ echo 
$cencoscodigo; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="41%">hertemnombre</td> 
 <td width="59%"> 
  <input type="text" name="hertemnombre" value="<?php 
if(!$flagborrarherramietemp){ echo $sbreg[hertemnombre];}else{ echo 
$hertemnombre; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="41%">hertemvalor</td> 
 <td width="59%"> 
  <input type="text" name="hertemvalor" value="<?php 
if(!$flagborrarherramietemp){ echo $sbreg[hertemvalor];}else{ echo 
$hertemvalor; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="41%">hertemdescri</td> 
 <td width="59%"> 
  <input type="text" name="hertemdescri" value="<?php 
if(!$flagborrarherramietemp){ echo $sbreg[hertemdescri];}else{ echo 
$hertemdescri; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="41%">hertemdispon</td> 
 <td width="59%"> 
  <input type="text" name="hertemdispon" value="<?php 
if(!$flagborrarherramietemp){ echo $sbreg[hertemdispon];}else{ echo 
$hertemdispon; } ?>" onFocus="if (!agree)this.blur();" > 
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
onclick="form1.accionborrarherramietemp.value =  1; 
form1.action='maestablherramietemp.php';"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablherramietemp.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagborrarherramietemp" value="1"> 
<input type="hidden" name="accionborrarherramietemp"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
