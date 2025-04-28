<?php 
ob_start(); 
include ( '../src/FunGen/sesion/fncvalses.php'); 
if($accionnuevoregistprogram) 
{ 
	include ( 'grabaregistprogram.php'); 
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
<title>Nuevo registro de registprogram</title> 
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
<p><font class="NoiseFormHeaderFont">registprogram</font></p> 
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
            <table width="85%" border="0" cellspacing="0" cellpadding="0" 
align="center"> 
<tr> 
 <td width="41%"><?php if($campnomb == "regprocodigo"){$regprocodigo = null; 
echo "*";}?>regprocodigo</td> 
 <td width="59%"> 
  <input type="text" name="regprocodigo"	value="<?php 
if(!$flagnuevoregistprogram){ echo $sbreg[regprocodigo];}else{ echo 
$regprocodigo; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "progracodigo"){$progracodigo = null; 
echo "*";}?>progracodigo</td> 
 <td width="59%"> 
  <input type="text" name="progracodigo"	value="<?php 
if(!$flagnuevoregistprogram){ echo $sbreg[progracodigo];}else{ echo 
$progracodigo; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "regprovalor"){$regprovalor = null; echo 
"*";}?>regprovalor</td> 
 <td width="59%"> 
  <input type="text" name="regprovalor"	value="<?php 
if(!$flagnuevoregistprogram){ echo $sbreg[regprovalor];}else{ echo 
$regprovalor; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "regprofecha"){$regprofecha = null; echo 
"*";}?>regprofecha</td> 
 <td width="59%"> 
  <input type="text" name="regprofecha"	value="<?php 
if(!$flagnuevoregistprogram){ echo $sbreg[regprofecha];}else{ echo 
$regprofecha; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "regprohora"){$regprohora = null; echo 
"*";}?>regprohora</td> 
 <td width="59%"> 
  <input type="text" name="regprohora"	value="<?php 
if(!$flagnuevoregistprogram){ echo $sbreg[regprohora];}else{ echo $regprohora; 
}?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "regpronota"){$regpronota = null; echo 
"*";}?>regpronota</td> 
 <td width="59%"> 
  <input type="text" name="regpronota"	value="<?php 
if(!$flagnuevoregistprogram){ echo $sbreg[regpronota];}else{ echo $regpronota; 
}?>"> 
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
onclick="form1.accionnuevoregistprogram.value =  1;"  width="86" height="18" 
alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablregistprogram.php';"  width="86" height="18" 
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
*</font>';} 
?> 
<input type="hidden" name="regprocodigo" value="<?php 
if(!$flagnuevoregistprogram){ echo $sbreg[regprocodigo];}else{ echo 
$regprocodigo; } ?>"> 
<input type="hidden" name="accionnuevoregistprogram"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
