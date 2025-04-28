<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
if(!$flagdetallarreporotherramie) 
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
<title>Detalle de registro de reporotherramie</title> 
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
<p><font class="NoiseFormHeaderFont">reporotherramie</font></p> 
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
            <table width="85%" border="0" cellspacing="0" cellpadding="0" 
align="center"> 
              <tr> 
                <td width="41%">rephercodigo</td> 
<td width="59%"> 
<input type="text" name="rephercodigo" value="<?php 
if(!$flagdetallarreporotherramie){ echo $sbreg[rephercodigo];}else{ echo 
$rephercodigo; } ?>"> 
</td> 
</tr> 
<tr> 
 <td width="41%">rephercodigo</td> 
 <td width="59%"> 
  <input type="text" name="rephercodigo" value="<?php 
if(!$flagdetallarreporotherramie){ echo $sbreg[rephercodigo];}else{ echo 
$rephercodigo; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="41%">reportcodigo</td> 
 <td width="59%"> 
  <input type="text" name="reportcodigo" value="<?php 
if(!$flagdetallarreporotherramie){ echo $sbreg[reportcodigo];}else{ echo 
$reportcodigo; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="41%">transhercodigo</td> 
 <td width="59%"> 
  <input type="text" name="transhercodigo" value="<?php 
if(!$flagdetallarreporotherramie){ echo $sbreg[transhercodigo];}else{ echo 
$transhercodigo; } ?>" onFocus="if (!agree)this.blur();" > 
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
onclick="form1.action='maestablreporotherramie.php';"  width="86" height="18" 
alt="Aceptar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagdetallarreporotherramie" value="1"> 
<input type="hidden" name="acciondetallarreporotherramie"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
