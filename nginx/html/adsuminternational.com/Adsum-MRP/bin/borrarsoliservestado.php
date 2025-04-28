<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
if(!$flagborrarsoliservestado) 
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
<title>Borrar registro de soliservestado</title> 
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
<p><font class="NoiseFormHeaderFont">Estados de Solicitud de Servicio</font></p> 
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
             <table width="85%" border="0" cellspacing="0" cellpadding="3" 
align="center"> 
             
<tr> 
 <td width="41%">C&oacute;digo</td> 
 <td width="59%"> 
  <input type="text" name="estsolcodigo" value="<?php 
if(!$flagborrarsoliservestado){ echo $sbreg[estsolcodigo];}else{ echo 
$estsolcodigo; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="41%">Nombre</td> 
 <td width="59%"> 
  <input type="text" name="estsolnombre" value="<?php 
if(!$flagborrarsoliservestado){ echo $sbreg[estsolnombre];}else{ echo 
$estsolnombre; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
 <tr> 
 <td width="41%">Tipo</td> 
 <td width="59%"> 
  <input type="text" name="estsoltipo" value="<?php
if(!$flagborrarsoliservestado)
{ 
	switch ($sbreg[estsoltipo]) 
	{
		case 1:
			echo 'Activo';
			break;
		case 0:
			echo 'Inactivo';
			break;
		default:
			break;
	}
}
else
{ 
	echo $estsoltipo; 
}?>" onFocus="if 
(!agree)this.blur();" size="5" > 
 </td> 
 </tr> 
<tr> 
 <td width="41%">Descripci&oacute;n</td> 
 <td width="59%"> 
<textarea name="estsoldescri" rows="3" onFocus="if (!agree)this.blur();" wrap="VIRTUAL"><?php if(!$flagborrarsoliservestado){echo $sbreg[estsoldescri];}else {echo $estsoldescri;}?></textarea> 
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
onclick="form1.accionborrarsoliservestado.value =  1; 
form1.action='maestablsoliservestado.php';"  width="86" height="18" 
alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablsoliservestado.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagborrarsoliservestado" value="1"> 
<input type="hidden" name="accionborrarsoliservestado"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
