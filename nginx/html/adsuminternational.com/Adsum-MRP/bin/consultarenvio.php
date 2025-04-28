<?php
include ( '../src/FunGen/sesion/fncvalses.php'); 
include ( '../src/FunPerPriNiv/pktbltiporuta.php'); 
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andrés A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Consultar en envio</title> 
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
<p><font class="NoiseFormHeaderFont">Envio</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Consultar envio</font></span></td></tr> 
<tr> 
  <td> 
            <table width="85%" border="0" cellspacing="0" cellpadding="3" 
align="center"> 
<tr> 
 <td width="41%">C&oacute;digo</td> 
 <td width="59%"> 
  <input type="text" name="enviocodigo"	value="<?php if(!$flagconsultarenvio){ 
echo $sbreg[enviocodigo];}else{ echo $enviocodigo; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%">Compra</td> 
 <td width="59%"> 
  <input type="text" name="compracodigo" onFocus="if(!agree)this.blur();" value="<?php 
  if(!$flagconsultarenvio){ echo $sbreg[compracodigo];}else{ echo $compracodigo; }?>"> 
<input type="Button" name="buscar" value="Buscar"
onclick="window.open('consultarcompra2.php?codigo=<?php echo $codigo?>','consultarcompra2','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=600,height=600');">
 </td> 
 </tr> 
<tr> 
 <td width="41%">Tipo de ruta</td> 
 <td width="59%"> 
<select name="tiprutcodigo">
<option value="">Seleccione</option>;
<?php
include('../src/FunGen/floadtiporuta.php');
$idcon=fncconn();
floadtiporuta($idcon);
fncclose($idcon);
?>
</option>
</select>
 </td> 
 </tr> 
<tr> 
 <td width="41%">Fecha de salida</td> 
 <td width="59%"> 
  <input type="text" name="annosal" size="4" maxlength="4" value="<?php if(!$flagconsultarenvio){
echo $sbreg[annosal];}else{echo $annosal;}?>">-
  <input type="text" name="messal" size="2" maxlength="2" value="<?php if(!$flagconsultarenvio){
echo $sbreg[messal];}else{echo $messal;}?>">-
  <input type="text" name="diasal" size="2" maxlength="2" value="<?php if(!$flagconsultarenvio){
echo $sbreg[diasal];}else{echo $diasal;}?>">&nbsp;"aaaa-mm-dd"
 </td> 
 </tr> 
<tr> 
 <td width="41%">Fecha de llegada</td> 
 <td width="59%"> 
  <input type="text" name="annolleg" size="4" maxlength="4" value="<?php if(!$flagconsultarenvio){
echo $sbreg[annolleg];}else{echo $annolleg;}?>">-
  <input type="text" name="meslleg" size="2" maxlength="2" value="<?php if(!$flagconsultarenvio){
echo $sbreg[meslleg];}else{echo $meslleg;}?>">-
  <input type="text" name="dialleg" size="2" maxlength="2" value="<?php if(!$flagconsultarenvio){
echo $sbreg[dialleg];}else{echo $dialleg;}?>">&nbsp;"aaaa-mm-dd"
 </td> 
 </tr> 
<tr> 
 <td width="41%">Porcentaje del descuento</td> 
 <td width="59%"> 
  <input type="text" name="enviodespor"	value="<?php if(!$flagconsultarenvio){ 
echo $sbreg[enviodespor];}else{ echo $enviodespor; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%">Valor del descuento</td> 
 <td width="59%"> 
  <input type="text" name="enviodesval"	value="<?php if(!$flagconsultarenvio){ 
echo $sbreg[enviodesval];}else{ echo $enviodesval; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%">Costo</td> 
 <td width="59%"> 
  <input type="text" name="enviocosto"	value="<?php if(!$flagconsultarenvio){ 
echo $sbreg[enviocosto];}else{ echo $enviocosto; }?>"> 
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
onclick="
if(window.document.form1.annosal.value != '' && window.document.form1.messal.value != '' &&
window.document.form1.diasal.value != '')
{
 window.document.form1.enviofecsal.value = window.document.form1.annosal.value+'-'+
 window.document.form1.messal.value+'-'+window.document.form1.diasal.value;
}
else
{
 window.document.form1.enviofecsal.value = '';
}

if(window.document.form1.annolleg.value != '' && window.document.form1.meslleg.value != '' &&
window.document.form1.dialleg.value != '')
{
 window.document.form1.enviofeclleg.value = window.document.form1.annolleg.value+'-'+
 window.document.form1.meslleg.value+'-'+window.document.form1.dialleg.value;
}
else
{
 window.document.form1.enviofeclleg.value = '';
}
form1.accionconsultarenvio.value =  1;form1.action='maestablenvio.php';"  width="86" height="18" 
alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablenvio.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
<a href= "javascript:;"><input type="image" name="cancelar2" src="../img/ayuda.gif" width="86" height="18" alt="Cancelar" border=0> </a>
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
<input type="hidden" name="enviofecsal">
<input type="hidden" name="enviofeclleg">
 <input type="hidden" name="flagconsultarenvio" value="1"> 
<input type="hidden" name="accionconsultarenvio"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="columnas" value="enviocodigo, 
compracodigo, 
tiprutcodigo, 
enviofecsal, 
enviofeclleg, 
enviodespor,
enviodesval,
enviocosto
">
<input type="hidden" name="nombtabl" value="envio">
</form>
</body>
<?php
    if(!$codigo)
    { echo " -->"; }
?>
</html>
