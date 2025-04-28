<?php 
ob_start(); 
include ( '../src/FunGen/sesion/fncvalses.php'); 
if($accioneditarnormaseguri) 
{ 
	include ( 'editanormaseguri.php'); 
	$flageditarnormaseguri = 1; 
} 
ob_end_flush(); 
if(!$flageditarnormaseguri) 
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
<title>Editar registro de normaseguri</title> 
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
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Editar registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="90%" border="0" cellspacing="1" cellpadding="0" 
align="center"> 
<tr> 
 <td width="28%" class="NoiseFooterTD"><?php if($campnomb["norsegnombre"] == 1){$norsegnombre = null; 
echo "*";}?>&nbsp;Nombre</td> 
 <td width="72%" class="NoiseDataTD"> 
  <input type="text" name="norsegnombre" value="<?php if(!$flageditarnormaseguri){ echo $sbreg[norsegnombre];}else{ echo $norsegnombre; }?>" size="40"> 
 </td> 
 </tr> 
<tr> 
 <td width="28%" class="NoiseFooterTD"><?php if($campnomb["norsegdescri"] == 1){$norsegdescri = null; 
echo "*";}?>&nbsp;Descripci&oacute;n</td> 
 <td width="72%" rowspan="2" class="NoiseDataTD"> 
  <textarea name="norsegdescri" rows="3" cols="30" wrap="VIRTUAL"><?php if(!$flageditarnormaseguri){ echo $sbreg[norsegdescri];}else{ echo $norsegdescri; }?></textarea> 
 </td> 
 </tr> 
 <tr class="NoiseFooterTD"> 
  <td height="52">&nbsp;</td> 
 </tr> 
</table> 
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accioneditarnormaseguri.value =  1;"  width="86" height="18" 
alt="Aceptar" border=0> 
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
<?php if($campnomb){echo '<font face = "Verdana" >Corregir los capos marcados con *</font>';} ?> 
<input type="hidden" name="norsegcodigo" value="<?php if(!$flageditarnormaseguri){ echo $sbreg[norsegcodigo];}else{ echo $norsegcodigo; } ?>"> 
<input type="hidden" name="accioneditarnormaseguri"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
