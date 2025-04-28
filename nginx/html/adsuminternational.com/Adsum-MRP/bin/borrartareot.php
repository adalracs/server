<?php 
include ( '../src/FunGen/sesion/fncvalses.php');
if(!$flagborrartareot)
{
	include ( '../src/FunGen/sesion/fnccarga.php');
	$sbreg = fnccarga($nombtabl,$radiobutton);
	if (!$sbreg)
	{
		include( '../src/FunGen/fnccontfron.php');
	}
}
?> 
<html> 
<head> 
<title>Borrar registro de tareot</title> 
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
<p><font class="NoiseFormHeaderFont">Tareas por orden de trabajo</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Borrar registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="85%" border="0" cellspacing="0" cellpadding="0" 
align="center"> 
              <tr> 
 <td width="25%">Código</td> 
  <td width="25%"> 
   <input type="text" name="tareotcodigo" value="<?php if(!$flagborrartareot){ 
echo $sbreg[tareotcodigo];}else{ echo $tareotcodigo;} ?>" onFocus="if 
(!agree)this.blur();" > 
  </td> 
 <td width="25%">Tarea</td> 
  <td width="25%"> 
   <input type="text" name="tareacodigo" value="<?php if(!$flagborrartareot){ 
echo $sbreg[tareacodigo];}else{ echo $tareacodigo;} ?>" onFocus="if 
(!agree)this.blur();" > 
  </td> 
 </tr> 
<tr> 
 <td width="25%">OT</td> 
  <td width="25%"> 
   <input type="text" name="ordtracodigo" value="<?php if(!$flagborrartareot){ 
echo $sbreg[ordtracodigo];}else{ echo $ordtracodigo;} ?>" onFocus="if 
(!agree)this.blur();" > 
  </td> 
 <td width="25%">Herramientas</td> 
  <td width="25%"> 
   <input type="text" name="herramcodigo" value="<?php if(!$flagborrartareot){ 
echo $sbreg[herramcodigo];}else{ echo $herramcodigo;} ?>" onFocus="if 
(!agree)this.blur();" > 
  </td> 
 </tr> 
<tr> 
 <td width="25%">Insumos</td> 
  <td width="25%"> 
   <input type="text" name="insumocodigo" value="<?php if(!$flagborrartareot){ 
echo $sbreg[insumocodigo];}else{ echo $insumocodigo;} ?>" onFocus="if 
(!agree)this.blur();" > 
  </td> 
 <td width="25%">Tipo de trabajos </td> 
  <td width="25%"> 
   <input type="text" name="tiptracodigo" value="<?php if(!$flagborrartareot){ 
echo $sbreg[tiptracodigo];}else{ echo $tiptracodigo;} ?>" onFocus="if 
(!agree)this.blur();" > 
  </td> 
 </tr> 
<tr> 
 <td width="25%">Equipo</td> 
  <td width="25%"> 
   <input type="text" name="equipocodigo" value="<?php if(!$flagborrartareot){ 
echo $sbreg[equipocodigo];}else{ echo $equipocodigo;} ?>" onFocus="if 
(!agree)this.blur();" > 
  </td> 
 <td width="25%">Colaborador</td> 
  <td width="25%"> 
   <input type="text" name="empleacodigo" value="<?php if(!$flagborrartareot){ 
echo $sbreg[empleacodigo];}else{ echo $empleacodigo;} ?>" onFocus="if 
(!agree)this.blur();" > 
  </td> 
 </tr> 
<tr> 
 <td width="25%">Operaci&oacute;n</td> 
  <td width="25%"> 
   <input type="text" name="operaccodigo" value="<?php if(!$flagborrartareot){ 
echo $sbreg[operaccodigo];}else{ echo $operaccodigo;} ?>" onFocus="if 
(!agree)this.blur();" > 
  </td> 
 <td width="25%">Inventario</td> 
  <td width="25%"> 
   <input type="text" name="inventcodigo" value="<?php if(!$flagborrartareot){ 
echo $sbreg[inventcodigo];}else{ echo $inventcodigo;} ?>" onFocus="if 
(!agree)this.blur();" > 
  </td> 
 </tr> 
<tr> 
 <td width="25%">Orden de actividades </td> 
  <td width="25%"> 
   <input type="text" name="tareotorden" value="<?php if(!$flagborrartareot){ 
echo $sbreg[tareotorden];}else{ echo $tareotorden;} ?>" onFocus="if 
(!agree)this.blur();" > 
  </td> 
 <td width="25%">Duraci&oacute;n</td> 
  <td width="25%"> 
   <input type="text" name="tareottiedur" value="<?php if(!$flagborrartareot){ 
echo $sbreg[tareottiedur];}else{ echo $tareottiedur;} ?>" onFocus="if 
(!agree)this.blur();" > 
  </td> 
 </tr> 
<tr> 
 <td width="25%">Nota</td> 
  <td colspan="3"> 
    <textarea name="tareotnota" rows="3" wrap="VIRTUAL" onFocus="if 
(!agree)this.blur();"><?php if(!$flagborrartareot){ 
echo $sbreg[tareotnota];}else{ echo $tareotnota;} ?>
    </textarea> 
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
onclick="form1.accionborrartareot.value =  1; 
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
 <input type="hidden" name="flagborrartareot" value="1"> 
<input type="hidden" name="accionborrartareot"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 
