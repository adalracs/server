<?php 
ob_start(); 
include ( '../src/FunGen/sesion/fncvalses.php'); 
if($accioneditarprioridad) 
{ 
	include ( 'editaprioridad.php'); 
	$flageditarprioridad = 1; 
} 
ob_end_flush(); 
if(!$flageditarprioridad) 
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
<title>Editar registro de prioridad</title> 
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
<p><font class="NoiseFormHeaderFont">Prioridad</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
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
            <table width="85%" border="0" cellspacing="0" cellpadding="3" 
align="center"> 
<tr> 
 <td width="41%"><?php if($campnomb == "prioricodigo"){$prioricodigo = null; 
echo "*";}?>C&oacute;digo</td> 
 <td width="59%"> 
  <input type="text" name="prioricodigo" onFocus="if (!agree)this.blur();" value="<?php 
if(!$flageditarprioridad){ echo $sbreg[prioricodigo];}else{ echo $prioricodigo; 
}?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "priorinombre"){$priorinombre = null; 
echo "*";}?>Nombre</td> 
 <td width="59%"> 
  <input type="text" name="priorinombre"	value="<?php 
if(!$flageditarprioridad){ echo $sbreg[priorinombre];}else{ echo $priorinombre; 
}?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "prioridescri"){$prioridescri = null; 
echo "*";}?>Descripci&oacute;n</td> 
 <td width="59%"> 
  <textarea name="prioridescri"	cols="24" wrap="VIRTUAL" rows="3"><?php 
if(!$flageditarprioridad){ echo $sbreg[prioridescri];}else{ echo $prioridescri; 
}?></textarea>
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
onclick="form1.accioneditarprioridad.value =  1;"  width="86" height="18" 
alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablprioridad.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
<a href= "javascript:;"><input type="image" name="cancelar2" src="../img/ayuda.gif" width="86" height="18" alt="Cancelar" border=0></a> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
<?php 
if($campnomb){echo '<font face = "Verdana" >Corregir los campos marcados con 
*</font>}';} 
?> 
<input type="hidden" name="prioricodigo" value="<?php 
if(!$flageditarprioridad){ echo $sbreg[prioricodigo];}else{ echo $prioricodigo; 
} ?>"> 
<input type="hidden" name="accioneditarprioridad"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
