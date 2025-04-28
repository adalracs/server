<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
if(!$flagdetallartipobarra) 
{ 
include ( '../src/FunGen/sesion/fnccarga.php'); 
$sbreg = fnccarga($nombtabl,$radiobutton); 
if (!$sbreg) 
	{ 
		include( '../src/FunGen/fnccontfron.php'); 
	} 
} 
include ( '../src/FunPerPriNiv/pktblestado.php');
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andrés A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Detalle de registro de tipo de barra</title> 
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
<p><font class="NoiseFormHeaderFont">Tipo de barra</font></p> 
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
<tr> 
 <td width="41%">C&oacute;digo</td> 
 <td width="59%"> 
  <input type="text" name="tipbarcodigo" value="<?php 
if(!$flagdetallartipobarra){ echo $sbreg[tipbarcodigo];}else{ echo 
$tipbarcodigo; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="41%">Nombre</td> 
 <td width="59%"> 
  <input type="text" name="tipbarnombre" value="<?php 
if(!$flagdetallartipobarra){ echo $sbreg[tipbarnombre];}else{ echo 
$tipbarnombre; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr>
 <td width="25%">Estado</td>
 <td width="25%">
  <input type="text" name="estadocodigo" value="<?php if(!$flagdetallartipobarra)
{
	$idcon = fncconn();
	$sbregnombestado=loadrecordestado($sbreg[estadocodigo],$idcon);
	echo $sbregnombestado[estadonombre];
	fncclose($idcon);
}else{ echo $estadococodigo;}
?>"
onFocus="if(!agree)this.blur();" >
 </td>
</tr>
<tr> 
 <td width="41%">Descriopci&oacute;n</td> 
 <td width="59%"> 
  <textarea name="tipbardescri" cols="24" wrap="VIRTUAL" rows="3" 
onFocus="if (!agree)this.blur();"><?php if(!$flagdetallartipobarra){ echo $sbreg[tipbardescri];}
else{ echo $tipbardescri; } ?></textarea>
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
onclick="form1.action='maestabltipobarra.php';"  width="86" height="18" 
alt="Aceptar" border=0> 
<input type="image" name="cancelar2" src="../img/ayuda.gif" width="86" 
height="18" alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagdetallartipobarra" value="1"> 
<input type="hidden" name="acciondetallartipobarra"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
