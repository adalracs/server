<?php 
ob_start(); 
include ( '../src/FunGen/sesion/fncvalses.php'); 
if($accionnuevotransacherramietemp) 
{ 
	include ( 'grabatransacherramietemp.php'); 
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
<title>Nuevo registro de transacherramietemp</title> 
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
<p><font class="NoiseFormHeaderFont">transacherramietemp</font></p> 
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
 <td width="41%"><?php if($campnomb == "trahetemcodigo"){$trahetemcodigo = 
null; echo "*";}?>trahetemcodigo</td> 
 <td width="59%"> 
  <input type="text" name="trahetemcodigo"	value="<?php 
if(!$flagnuevotransacherramietemp){ echo $sbreg[trahetemcodigo];}else{ echo 
$trahetemcodigo; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "tipmovcodigo"){$tipmovcodigo = null; 
echo "*";}?>tipmovcodigo</td> 
 <td width="59%"> 
  <input type="text" name="tipmovcodigo"	value="<?php 
if(!$flagnuevotransacherramietemp){ echo $sbreg[tipmovcodigo];}else{ echo 
$tipmovcodigo; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "herramcodigo"){$herramcodigo = null; 
echo "*";}?>herramcodigo</td> 
 <td width="59%"> 
  <input type="text" name="herramcodigo"	value="<?php 
if(!$flagnuevotransacherramietemp){ echo $sbreg[herramcodigo];}else{ echo 
$herramcodigo; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "trahetemfecha"){$trahetemfecha = null; 
echo "*";}?>trahetemfecha</td> 
 <td width="59%"> 
  <input type="text" name="trahetemfecha"	value="<?php 
if(!$flagnuevotransacherramietemp){ echo $sbreg[trahetemfecha];}else{ echo 
$trahetemfecha; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "trahetemcanti"){$trahetemcanti = null; 
echo "*";}?>trahetemcanti</td> 
 <td width="59%"> 
  <input type="text" name="trahetemcanti"	value="<?php 
if(!$flagnuevotransacherramietemp){ echo $sbreg[trahetemcanti];}else{ echo 
$trahetemcanti; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "trahetemtotal"){$trahetemtotal = null; 
echo "*";}?>trahetemtotal</td> 
 <td width="59%"> 
  <input type="text" name="trahetemtotal"	value="<?php 
if(!$flagnuevotransacherramietemp){ echo $sbreg[trahetemtotal];}else{ echo 
$trahetemtotal; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "usuacodi"){$usuacodi = null; echo 
"*";}?>usuacodi</td> 
 <td width="59%"> 
  <input type="text" name="usuacodi"	value="<?php 
if(!$flagnuevotransacherramietemp){ echo $sbreg[usuacodi];}else{ echo 
$usuacodi; }?>"> 
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
onclick="form1.accionnuevotransacherramietemp.value =  1;"  width="86" 
height="18" alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestabltransacherramietemp.php';"  width="86" 
height="18" alt="Cancelar" border=0> 
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
<input type="hidden" name="trahetemcodigo" value="<?php 
if(!$flagnuevotransacherramietemp){ echo $sbreg[trahetemcodigo];}else{ echo 
$trahetemcodigo; } ?>"> 
<input type="hidden" name="accionnuevotransacherramietemp"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
