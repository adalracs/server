<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
if(!$flagborrartransitemtemp) 
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
<title>Borrar registro de transitemtemp</title> 
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
<p><font class="NoiseFormHeaderFont">transitemtemp</font></p> 
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
                <td width="41%">traitempcodigo</td> 
<td width="59%"> 
<input type="text" name="traitempcodigo" value="<?php 
if(!$flagborrartransitemtemp){ echo $sbreg[traitempcodigo];}else{ echo 
$traitempcodigo; } ?>"> 
</td> 
</tr> 
<tr> 
 <td width="41%">traitempcodigo</td> 
 <td width="59%"> 
  <input type="text" name="traitempcodigo" value="<?php 
if(!$flagborrartransitemtemp){ echo $sbreg[traitempcodigo];}else{ echo 
$traitempcodigo; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="41%">tipmovcodigo</td> 
 <td width="59%"> 
  <input type="text" name="tipmovcodigo" value="<?php 
if(!$flagborrartransitemtemp){ echo $sbreg[tipmovcodigo];}else{ echo 
$tipmovcodigo; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="41%">itemcodigo</td> 
 <td width="59%"> 
  <input type="text" name="itemcodigo" value="<?php 
if(!$flagborrartransitemtemp){ echo $sbreg[itemcodigo];}else{ echo $itemcodigo; 
} ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="41%">traitempfecha</td> 
 <td width="59%"> 
  <input type="text" name="traitempfecha" value="<?php 
if(!$flagborrartransitemtemp){ echo $sbreg[traitempfecha];}else{ echo 
$traitempfecha; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="41%">traitempcantid</td> 
 <td width="59%"> 
  <input type="text" name="traitempcantid" value="<?php 
if(!$flagborrartransitemtemp){ echo $sbreg[traitempcantid];}else{ echo 
$traitempcantid; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="41%">traitemptotal</td> 
 <td width="59%"> 
  <input type="text" name="traitemptotal" value="<?php 
if(!$flagborrartransitemtemp){ echo $sbreg[traitemptotal];}else{ echo 
$traitemptotal; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="41%">usuacodi</td> 
 <td width="59%"> 
  <input type="text" name="usuacodi" value="<?php 
if(!$flagborrartransitemtemp){ echo $sbreg[usuacodi];}else{ echo $usuacodi; } 
?>" onFocus="if (!agree)this.blur();" > 
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
onclick="form1.accionborrartransitemtemp.value =  1; 
form1.action='maestabltransitemtemp.php';"  width="86" height="18" 
alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestabltransitemtemp.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagborrartransitemtemp" value="1"> 
<input type="hidden" name="accionborrartransitemtemp"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
