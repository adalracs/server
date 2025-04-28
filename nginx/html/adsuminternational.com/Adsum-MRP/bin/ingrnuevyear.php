<?php 
ob_start(); 
include ( '../src/FunGen/sesion/fncvalses.php'); 
if($accionnuevoyear) 
{ 
	include ( 'grabayear.php'); 
} 
ob_end_flush(); 
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andrés A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Nuevo registro de year</title> 
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
<p><font class="NoiseFormHeaderFont">A&ntilde;os</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Ingresar nuevo registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="85%" border="0" cellspacing="0" cellpadding="3" 
align="center">  
<tr> 
 <td width="41%"><?php if($campnomb == "yearnombre"){$yearnombre = null; echo 
"*";}?>Nombre</td> 
 <td width="59%"> 
  <input type="text" name="yearnombre"	value="<?php if(!$flagnuevoyear){ echo 
$sbreg[yearnombre];}else{ echo $yearnombre; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "yeardescri"){$yeardescri = null; echo 
"*";}?>Descripción</td> 
 <td width="59%"> 
<textarea cols="24" rows="3" name="yeardescri"><?php if(!$flagnuevoyear){ echo 
$sbreg[yeardescri];}else{ echo $yeardescri; }?></textarea> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "yearestado"){$yearestado = null; echo 
"*";}?>Estado</td>  
 <td width="59%"> 
  <select name="yearestado">
  <?php if(!$flagnuevoyear)
  { 
		echo $sbreg[yearestado];
  }
  else{ echo $yearestado; }?>"> 
	<option value="">Seleccione
	<option value="1">MOSTRAR
	<option value="2">OCULTAR
	</select>
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
onclick="form1.accionnuevoyear.value =  1;"  width="86" height="18" 
alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablyear.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
<a href= "javascript:;"><input type="image" name="cancelar2" src="../img/ayuda.gif" width="86" height="18" alt="Ayuda" border=0> </a>
  </div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
<?php 
if($campnomb){echo '<font face = "Verdana" >Corregir los capos marcados con 
*</font>';} 
?> 
<input type="hidden" name="yearcodigo" value="<?php if(!$flagnuevoyear){ echo 
$sbreg[yearcodigo];}else{ echo $yearcodigo; } ?>"> 
<input type="hidden" name="accionnuevoyear"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
