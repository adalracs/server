<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andrés A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Consultar en itemtemp</title> 
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
<p><font class="NoiseFormHeaderFont">itemtemp</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Consultar registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="85%" border="0" cellspacing="0" cellpadding="0" 
align="center"> 
              <tr> 
                <td width="41%">itetemcodigo</td> 
<td width="59%"> 
<input type="text" name="itetemcodigo" value="<?php 
if(!$flagconsultaritemtemp){ echo $sbreg[itetemcodigo];}else{ echo 
$itetemcodigo; } ?>"> 
</td> 
</tr> 
<tr> 
 <td width="41%">itetemcodigo</td> 
 <td width="59%"> 
  <input type="text" name="itetemcodigo"	value="<?php 
if(!$flagconsultaritemtemp){ echo $sbreg[itetemcodigo];}else{ echo 
$itetemcodigo; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%">unidadcodigo</td> 
 <td width="59%"> 
  <input type="text" name="unidadcodigo"	value="<?php 
if(!$flagconsultaritemtemp){ echo $sbreg[unidadcodigo];}else{ echo 
$unidadcodigo; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%">cencoscodigo</td> 
 <td width="59%"> 
  <input type="text" name="cencoscodigo"	value="<?php 
if(!$flagconsultaritemtemp){ echo $sbreg[cencoscodigo];}else{ echo 
$cencoscodigo; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%">itetemnombre</td> 
 <td width="59%"> 
  <input type="text" name="itetemnombre"	value="<?php 
if(!$flagconsultaritemtemp){ echo $sbreg[itetemnombre];}else{ echo 
$itetemnombre; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%">itetemcanmin</td> 
 <td width="59%"> 
  <input type="text" name="itetemcanmin"	value="<?php 
if(!$flagconsultaritemtemp){ echo $sbreg[itetemcanmin];}else{ echo 
$itetemcanmin; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%">itetemcanmax</td> 
 <td width="59%"> 
  <input type="text" name="itetemcanmax"	value="<?php 
if(!$flagconsultaritemtemp){ echo $sbreg[itetemcanmax];}else{ echo 
$itetemcanmax; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%">itetemvalor</td> 
 <td width="59%"> 
  <input type="text" name="itetemvalor"	value="<?php 
if(!$flagconsultaritemtemp){ echo $sbreg[itetemvalor];}else{ echo $itetemvalor; 
}?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%">itetemnota</td> 
 <td width="59%"> 
  <input type="text" name="itetemnota"	value="<?php 
if(!$flagconsultaritemtemp){ echo $sbreg[itetemnota];}else{ echo $itetemnota; 
}?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%">itetemdispon</td> 
 <td width="59%"> 
  <input type="text" name="itetemdispon"	value="<?php 
if(!$flagconsultaritemtemp){ echo $sbreg[itetemdispon];}else{ echo 
$itetemdispon; }?>"> 
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
onclick="form1.accionconsultaritemtemp.value =  
1;form1.action='maestablitemtemp.php';"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablitemtemp.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagconsultaritemtemp" value="1"> 
<input type="hidden" name="accionconsultaritemtemp"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="columnas" value="itetemcodigo, 
unidadcodigo, 
cencoscodigo, 
itetemnombre, 
itetemcanmin, 
itetemcanmax, 
itetemvalor, 
itetemnota, 
itetemdispon 
"> 
<input type="hidden" name="nombtabl" value="itemtemp"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
