<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
?> 
<html> 
<head> 
<title>Consultar en tareot</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<SCRIPT LANGUAGE="JavaScript"> 
<!-- Begin 
agree = 0; 
//  End --> 
</script> 
<script language="JavaScript" src="motofech.js"></script> 
</head> 
<?php 
    if(!$codigo) 
    { echo "<!--";} 
?> 
<body bgcolor="FFFFFF" text="#000000">
 <font class="NoiseFormHeaderFont">Tarea por orden de trabajo</font>
 <form name="form1" method="post"  enctype="multipart/form-data">
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
 <td width="25%">Código</td> 
  <td width="25%"> 
   <input type="text" name="tareotcodigo"	value="<?php 
if(!$flagconsultartareot){ echo $sbreg[tareotcodigo];}else{ echo 
$tareotcodigo;} ?>"> 
  </td> 
 <td width="25%">Tarea</td> 
  <td width="25%"> 
   <input type="text" name="tareacodigo"	value="<?php 
if(!$flagconsultartareot){ echo $sbreg[tareacodigo];}else{ echo $tareacodigo;} 
?>"> 
  </td> 
 </tr> 
<tr> 
 <td width="25%">Orden de trabajo </td> 
  <td width="25%"> 
   <input type="text" name="ordtracodigo"	value="<?php 
if(!$flagconsultartareot){ echo $sbreg[ordtracodigo];}else{ echo 
$ordtracodigo;} ?>"> 
  </td> 
 <td width="25%">Herramientas</td> 
  <td width="25%"> 
   <input type="text" name="herramcodigo"	value="<?php 
if(!$flagconsultartareot){ echo $sbreg[herramcodigo];}else{ echo 
$herramcodigo;} ?>"> 
  </td> 
 </tr> 
<tr> 
 <td width="25%">Insumo</td> 
  <td width="25%"> 
   <input type="text" name="insumocodigo"	value="<?php 
if(!$flagconsultartareot){ echo $sbreg[insumocodigo];}else{ echo 
$insumocodigo;} ?>"> 
  </td> 
 <td width="25%">Tipo de trabajo </td> 
  <td width="25%"> 
   <input type="text" name="tiptracodigo"	value="<?php 
if(!$flagconsultartareot){ echo $sbreg[tiptracodigo];}else{ echo 
$tiptracodigo;} ?>"> 
  </td> 
 </tr> 
<tr> 
 <td width="25%">Equipo</td> 
  <td width="25%"> 
   <input type="text" name="equipocodigo"	value="<?php 
if(!$flagconsultartareot){ echo $sbreg[equipocodigo];}else{ echo 
$equipocodigo;} ?>"> 
  </td> 
 <td width="25%">Colaborador</td> 
  <td width="25%"> 
   <input type="text" name="empleacodigo"	value="<?php 
if(!$flagconsultartareot){ echo $sbreg[empleacodigo];}else{ echo 
$empleacodigo;} ?>"> 
  </td> 
 </tr> 
<tr> 
 <td width="25%">Operaci&oacute;n</td> 
  <td width="25%"> 
   <input type="text" name="operaccodigo"	value="<?php 
if(!$flagconsultartareot){ echo $sbreg[operaccodigo];}else{ echo 
$operaccodigo;} ?>"> 
  </td> 
 <td width="25%">Inventario</td> 
  <td width="25%"> 
   <input type="text" name="inventcodigo"	value="<?php 
if(!$flagconsultartareot){ echo $sbreg[inventcodigo];}else{ echo 
$inventcodigo;} ?>"> 
  </td> 
 </tr> 
<tr> 
 <td width="25%">Orden de trabajos </td> 
  <td width="25%"> 
   <input type="text" name="tareotorden"	value="<?php 
if(!$flagconsultartareot){ echo $sbreg[tareotorden];}else{ echo $tareotorden;} 
?>"> 
  </td> 
 <td width="25%">Duraci&oacute;n</td> 
  <td width="25%"> 
   <input type="text" name="tareottiedur"	value="<?php 
if(!$flagconsultartareot){ echo $sbreg[tareottiedur];}else{ echo 
$tareottiedur;} ?>"> 
  </td> 
 </tr> 
<tr> 
 <td width="25%">Nota</td> 
  <td colspan="3" rowspan="2"> 
    <textarea name="tareotnota" rows="3" wrap="VIRTUAL"><?php if(!$flagconsultartareot){ 
echo $sbreg[tareotnota];}else{ echo $tareotnota;} ?></textarea> 
  </td> 
 </tr>
<tr>
  <td>&nbsp;</td>
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
onclick="form1.accionconsultartareot.value =  1; 
form1.action='maestabltareot.php';"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestabltareot.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagconsultartareot" value="1"> 
<input type="hidden" name="accionconsultartareot"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="columnas" value="tareotcodigo, 
tareacodigo, 
ordtracodigo, 
herramcodigo, 
insumocodigo, 
tiptracodigo, 
equipocodigo, 
empleacodigo, 
operaccodigo, 
inventcodigo, 
tareotorden, 
tareottiedur, 
tareotnota, 
componubicac, 
componalto, 
componlargo, 
componancho, 
componpeso, 
componestado, 
componactivo 
"> 
<input type="hidden" name="nombtabl" value="tareot"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
