<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
if(!$flagborrarnormaseguri) 
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
<title>Borrar registro de normaseguri</title> 
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
<p><font class="NoiseFormHeaderFont">Norma de seguridad</font></p> 
<table width="47%" border="0" align="center" cellpadding="2" cellspacing="1" 
class="NoiseFormTABLE"> 
  <tr> 
    <td width="430" class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Borrar registro</font></span></td></tr> 
<tr> 
  <td> 
              <table width="90%" border="0" cellspacing="1" cellpadding="0" 
align="center"> 
<tr> 
 <td width="24%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
 <td width="76%" class="NoiseDataTD"><?php if(!$flagborrarnormaseguri){ echo $sbreg[norsegcodigo];}else{ echo $norsegcodigo; }?> </td> 
 </tr> 
<tr> 
 <td width="24%" class="NoiseFooterTD">&nbsp;Nombre</td> 
 <td width="76%" class="NoiseDataTD"><?php if(!$flagborrarnormaseguri){ echo $sbreg[norsegnombre];}else{ echo $norsegnombre; }?> </td> 
 </tr> 
<tr> 
 <td width="24%" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td> 
 <td width="76%" rowspan="2" valign="top" class="NoiseDataTD"><?php if(!$flagborrarnormaseguri){ echo $sbreg[norsegdescri];}else{ echo $norsegdescri; }?> </td> 
 </tr> 
 <tr class="NoiseFooterTD"> 
  <td>&nbsp;</td> 
 </tr> 
</table> 
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionborrarnormaseguri.value =  1; 
form1.action='maestablnormaseguri.php';"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablnormaseguri.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagborrarnormaseguri" value="1"> 
<input type="hidden" name="accionborrarnormaseguri"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
<input type="hidden" name="norsegcodigo" value="<?php if(!$flagborrarnormaseguri){ echo $sbreg[norsegcodigo];}else{ echo $norsegcodigo; }?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
