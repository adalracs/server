<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
include ( '../src/FunPerPriNiv/pktblarticulo.php');
if(!$flagborrarimagen) 
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
<title>Borrar registro de imagen</title> 
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
<p><font class="NoiseFormHeaderFont">Imagen</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Borrar imagen</font></span></td></tr> 
<tr> 
  <td> 
            <table width="85%" border="0" cellspacing="0" cellpadding="3" 
align="center"> 
<tr> 
 <td width="41%">C&oacute;digo</td> 
 <td width="59%"> 
  <input type="text" name="imagencodigo" value="<?php if(!$flagborrarimagen){ 
echo $sbreg[imagencodigo];}else{ echo $imagencodigo; } ?>" onFocus="if 
(!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="41%">Art&iacute;culo</td> 
 <td width="59%"> 
  <textarea name="articucodigo" cols="24" wrap="VIRTUAL" rows="3" onFocus="if(!agree)this.blur();" ><?php
if(!$flagborrarimagen)
{
	$idcon = fncconn();
	$sbregnombarticulo=loadrecordarticulo($sbreg[articucodigo],$idcon);
	echo $sbregnombarticulo[articutitulo];
	fncclose($idcon);
}else{ echo $articucodigo;}
?></textarea>
 </td> 
 </tr> 
<tr> 
 <td width="41%">N&uacute;mero</td> 
 <td width="59%"> 
  <input type="text" name="imagennumero" value="<?php if(!$flagborrarimagen){ 
echo $sbreg[imagennumero];}else{ echo $imagennumero; } ?>" onFocus="if 
(!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="41%">Nombre</td> 
 <td width="59%"> 
  <input type="text" name="imagennombre" value="<?php if(!$flagborrarimagen){ 
echo $sbreg[imagennombre];}else{ echo $imagennombre; } ?>" onFocus="if 
(!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="41%">Descripci&oacute;n</td> 
 <td width="59%"> 
  <textarea name="imagendescri" cols="24" wrap="VIRTUAL" rows="3" onFocus="if(!agree)this.blur();"><?php
if(!$flagborrarimagen){ echo $sbreg[imagendescri];}else{ echo $imagendescri; } ?></textarea> 
 </td> 
 </tr> 
 <tr>
 <td width="41%">Imagen</td>
 <td width="59%">
 <img src="<?php echo $sbreg[imagennombre];?>">
</td>
 </tr> <tr> 
  <td width="41%">&nbsp;</td> 
 </tr> 
</table> 
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionborrarimagen.value =  1; 
form1.action='maestablimagen.php';"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablimagen.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
<a href= "javascript:;"><input type="image" name="cancelar2" src="../img/ayuda.gif" width="86" height="18" alt="Cancelar" border=0> </a>
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
<input type="hidden" name="flagborrarimagen" value="1"> 
<input type="hidden" name="accionborrarimagen"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
