<?php 
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktblservicioplanta.php');
include ( '../src/FunPerPriNiv/pktblciudad.php');
include ( '../src/FunPerPriNiv/pktblunimedida.php');
if(!$flagborrarplanta)
{
	include ( '../src/FunGen/sesion/fnccarga.php');
	$sbreg = fnccarga($nombtabl,$radiobutton);
	if (!$sbreg)
	{
		include( '../src/FunGen/fnccontfron.php');
	}
	$idcon = fncconn();
	$sbregciudad = loadrecordciudad($sbreg[ciudadcodigo],$idcon);
	
	$sbregunimedida = loadrecordunimedida($sbreg[unidadcodigo],$idcon);
	fncclose($idcon);
}
?> 
<html> 
<head> 
<title>Borrar registro de Planta</title> 
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
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Ubicaciones</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td width="500" class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Borrar registro</font></span></td></tr> 
<tr> 
  <td> 
              <table width="99%" border="0" cellspacing="0" cellpadding="3" 
align="center"> 
<tr> 
 <td width="35%">C&oacute;digo</td> 
  <td colspan="2"> 
   <input type="text" name="plantacodigo"	value="<?php if(!$flagborrarplanta){ 
echo $sbreg[plantacodigo];}else {echo $plantacodigo;}?>" onFocus="if (!agree)this.blur();"> 
  </td> 
 </tr> 
<tr> 
 <td width="35%">C&oacute;digo Inmueble</td> 
  <td colspan="2"> 
   <input type="text" name="plantabieninmu"	value="<?php if(!$flagborrarplanta){ 
echo $sbreg[plantabieninmu];}else {echo $plantabieninmu;}?>" onFocus="if (!agree)this.blur();"> 
  </td> 
 </tr> 
<tr> 
 <td width="35%">Nombre</td> 
  <td colspan="2"> 
   <input type="text" name="plantanombre"	value="<?php if(!$flagborrarplanta){ 
echo $sbreg[plantanombre];}else {echo $plantanombre;}?>" onFocus="if (!agree)this.blur();"> 
  </td> 
 </tr> 
<tr>
 <td width="35%">Profesional de Operaci&oacute;n</td> 
  <td colspan="2"> 
   <input type="text" name="plantaencarg"	value="<?php if(!$flagborrarplanta){ 
echo $sbreg[plantaencarg];}else {echo $plantaencarg;}?>" size="35" onFocus="if (!agree)this.blur();"> 
  </td> 
 </tr> 
  <tr>
 <td width="35%">Profesional de Mantenimiento</td> 
  <td colspan="2"> 
   <input type="text" name="plantaencman"	value="<?php if(!$flagborrarplanta){ 
echo $sbreg[plantaencman];}else {echo $plantaencman;}?>" size="35" onFocus="if (!agree)this.blur();"> 
  </td> 
 </tr> 
 <tr> 
 <td width="35%">Ciudad</td> 
  <td colspan="2"> 
  <input type="text" name="ciudadcodigo" value="<?php if(!$flagborrarplanta){ echo $sbregciudad[ciudadnombre];}else {echo $ciudadcodigo;}?>" onFocus="if (!agree)this.blur();"> 
   </td> 
 </tr> 
 
<tr> 
 <td width="35%">Ubicaci&oacute;n</td> 
  <td colspan="2"> 
   <input type="text" name="plantaubicac"	value="<?php if(!$flagborrarplanta){ 
echo $sbreg[plantaubicac];}else {echo $plantaubicac;}?>" onFocus="if (!agree)this.blur();"> 
  </td> 
 </tr> 
<tr> 
 <td width="35%">Capacidad</td> 
  <td colspan="2"><input type="text" name="plantacapaci"	value="<?php if(!$flagborrarplanta){ 
echo $sbreg[plantacapaci];}else {echo $plantacapaci;}?>"size="13" onFocus="if (!agree)this.blur();">&nbsp;&nbsp;<?php echo $sbregunimedida[unidadacra];?></td>
   </tr> 
<tr> 
 <td width="35%">Descripci&oacute;n</td> 
  <td colspan="2" rowspan="2"> 
    <textarea name="plantadescri" cols="35" rows="3" wrap="VIRTUAL" onFocus="if (!agree)this.blur();"><?php if(!$flagborrarplanta){ echo $sbreg[plantadescri];} else {echo $plantadescri;}?></textarea>
  </td> 
 </tr>
<tr>
  <td colspan="3">&nbsp;</td>
</tr>
 <tr> 
  <td colspan="3"><hr></td> 
 </tr> 
 <tr> 
 <td>Servicios</td>
  <td colspan="2">Servicios<br>
<select name="serviciselec" size="3">
<?
include("../src/FunGen/floadservicioplanta.php");
$idcon = fncconn();
floadservicioplanta($sbreg["plantacodigo"], $idcon, false);
fncclose($idcon);
?>
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
onclick="form1.accionborrarplanta.value =  1; 
form1.action='maestablplanta.php';"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablplanta.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagborrarplanta" value="1"> 
<input type="hidden" name="accionborrarplanta"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 
