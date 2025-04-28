<?php 
ob_start(); 
include ( '../src/FunGen/sesion/fncvalses.php'); 
if($accioneditarreportotitem) 
{ 
	include ( 'editareportotitem.php'); 
	$flageditarreportotitem = 1; 
} 
ob_end_flush(); 
if(!$flageditarreportotitem) 
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
<title>Editar registro de reportotitem</title> 
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
<p><font class="NoiseFormHeaderFont">reportotitem</font></p> 
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
            <table width="85%" border="0" cellspacing="0" cellpadding="0" 
align="center"> 
<tr> 
 <td width="41%"><?php if($campnomb == "repitemcodigo"){$repitemcodigo = null; 
echo "*";}?>repitemcodigo</td> 
 <td width="59%"> 
  <input type="text" name="repitemcodigo"	value="<?php 
if(!$flageditarreportotitem){ echo $sbreg[repitemcodigo];}else{ echo 
$repitemcodigo; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "reportcodigo"){$reportcodigo = null; 
echo "*";}?>reportcodigo</td> 
 <td width="59%"> 
  <input type="text" name="reportcodigo"	value="<?php 
if(!$flageditarreportotitem){ echo $sbreg[reportcodigo];}else{ echo 
$reportcodigo; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "transitecodigo"){$transitecodigo = 
null; echo "*";}?>transitecodigo</td> 
 <td width="59%"> 
  <input type="text" name="transitecodigo"	value="<?php 
if(!$flageditarreportotitem){ echo $sbreg[transitecodigo];}else{ echo 
$transitecodigo; }?>"> 
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
onclick="form1.accioneditarreportotitem.value =  1;"  width="86" height="18" 
alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablreportotitem.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
<?php 
if($campnomb){echo '<font face = "Verdana" >Corregir los capos marcados con 
*</font>}';} 
?> 
<input type="hidden" name="repitemcodigo" value="<?php 
if(!$flageditarreportotitem){ echo $sbreg[repitemcodigo];}else{ echo 
$repitemcodigo; } ?>"> 
<input type="hidden" name="accioneditarreportotitem"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
