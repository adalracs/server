<?php 
ob_start(); 
include ( '../src/FunGen/sesion/fncvalses.php'); 
if($accionnuevotransitemtemp) 
{ 
	include ( 'grabatransitemtemp.php'); 
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
<title>Nuevo registro de transitemtemp</title> 
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
<p><font class="NoiseFormHeaderFont">transitemtemp</font></p> 
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
 <td width="41%"><?php if($campnomb == "traitempcodigo"){$traitempcodigo = 
null; echo "*";}?>traitempcodigo</td> 
 <td width="59%"> 
  <input type="text" name="traitempcodigo"	value="<?php 
if(!$flagnuevotransitemtemp){ echo $sbreg[traitempcodigo];}else{ echo 
$traitempcodigo; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "tipmovcodigo"){$tipmovcodigo = null; 
echo "*";}?>tipmovcodigo</td> 
 <td width="59%"> 
  <input type="text" name="tipmovcodigo"	value="<?php 
if(!$flagnuevotransitemtemp){ echo $sbreg[tipmovcodigo];}else{ echo 
$tipmovcodigo; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "itemcodigo"){$itemcodigo = null; echo 
"*";}?>itemcodigo</td> 
 <td width="59%"> 
  <input type="text" name="itemcodigo"	value="<?php 
if(!$flagnuevotransitemtemp){ echo $sbreg[itemcodigo];}else{ echo $itemcodigo; 
}?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "traitempfecha"){$traitempfecha = null; 
echo "*";}?>traitempfecha</td> 
 <td width="59%"> 
  <input type="text" name="traitempfecha"	value="<?php 
if(!$flagnuevotransitemtemp){ echo $sbreg[traitempfecha];}else{ echo 
$traitempfecha; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "traitempcantid"){$traitempcantid = 
null; echo "*";}?>traitempcantid</td> 
 <td width="59%"> 
  <input type="text" name="traitempcantid"	value="<?php 
if(!$flagnuevotransitemtemp){ echo $sbreg[traitempcantid];}else{ echo 
$traitempcantid; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "traitemptotal"){$traitemptotal = null; 
echo "*";}?>traitemptotal</td> 
 <td width="59%"> 
  <input type="text" name="traitemptotal"	value="<?php 
if(!$flagnuevotransitemtemp){ echo $sbreg[traitemptotal];}else{ echo 
$traitemptotal; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "usuacodi"){$usuacodi = null; echo 
"*";}?>usuacodi</td> 
 <td width="59%"> 
  <input type="text" name="usuacodi"	value="<?php if(!$flagnuevotransitemtemp){ 
echo $sbreg[usuacodi];}else{ echo $usuacodi; }?>"> 
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
onclick="form1.accionnuevotransitemtemp.value =  1;"  width="86" height="18" 
alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestabltransitemtemp.php';"  width="86" height="18" 
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
<input type="hidden" name="traitempcodigo" value="<?php 
if(!$flagnuevotransitemtemp){ echo $sbreg[traitempcodigo];}else{ echo 
$traitempcodigo; } ?>"> 
<input type="hidden" name="accionnuevotransitemtemp"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
