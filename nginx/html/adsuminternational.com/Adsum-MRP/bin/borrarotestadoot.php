<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
if(!$flagborrarotestadoot) 
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
<title>Borrar registro de otestadoot</title> 
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
<p><font class="NoiseFormHeaderFont">otestadoot</font></p> 
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
                <td width="41%">otestcodigo</td> 
<td width="59%"> 
<input type="text" name="otestcodigo" value="<?php if(!$flagborrarotestadoot){ 
echo $sbreg[otestcodigo];}else{ echo $otestcodigo; } ?>"> 
</td> 
</tr> 
<tr> 
 <td width="41%">otestcodigo</td> 
 <td width="59%"> 
  <input type="text" name="otestcodigo" value="<?php 
if(!$flagborrarotestadoot){ echo $sbreg[otestcodigo];}else{ echo $otestcodigo; 
} ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="41%">ordtracodigo</td> 
 <td width="59%"> 
  <input type="text" name="ordtracodigo" value="<?php 
if(!$flagborrarotestadoot){ echo $sbreg[ordtracodigo];}else{ echo 
$ordtracodigo; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="41%">otestacodigo</td> 
 <td width="59%"> 
  <input type="text" name="otestacodigo" value="<?php 
if(!$flagborrarotestadoot){ echo $sbreg[otestacodigo];}else{ echo 
$otestacodigo; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="41%">otestorigen</td> 
 <td width="59%"> 
  <input type="text" name="otestorigen" value="<?php 
if(!$flagborrarotestadoot){ echo $sbreg[otestorigen];}else{ echo $otestorigen; 
} ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="41%">otestfecini</td> 
 <td width="59%"> 
  <input type="text" name="otestfecini" value="<?php 
if(!$flagborrarotestadoot){ echo $sbreg[otestfecini];}else{ echo $otestfecini; 
} ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="41%">otesthorini</td> 
 <td width="59%"> 
  <input type="text" name="otesthorini" value="<?php 
if(!$flagborrarotestadoot){ echo $sbreg[otesthorini];}else{ echo $otesthorini; 
} ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="41%">otestfecfin</td> 
 <td width="59%"> 
  <input type="text" name="otestfecfin" value="<?php 
if(!$flagborrarotestadoot){ echo $sbreg[otestfecfin];}else{ echo $otestfecfin; 
} ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="41%">otesthorfin</td> 
 <td width="59%"> 
  <input type="text" name="otesthorfin" value="<?php 
if(!$flagborrarotestadoot){ echo $sbreg[otesthorfin];}else{ echo $otesthorfin; 
} ?>" onFocus="if (!agree)this.blur();" > 
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
onclick="form1.accionborrarotestadoot.value =  1; 
form1.action='maestablotestadoot.php';"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablotestadoot.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagborrarotestadoot" value="1"> 
<input type="hidden" name="accionborrarotestadoot"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
