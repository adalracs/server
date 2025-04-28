<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
include('../src/FunPerPriNiv/pktblunimedida.php');
include('../src/FunPerPriNiv/pktblciudad.php');
?> 
<html> 
<head> 
<title>Consultar en Planta</title> 
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
Consultar registro</font></span></td></tr> 
<tr> 
  <td> 
                        <table width="99%" border="0" cellspacing="0" cellpadding="3" 
align="center"> 
<tr> 
 <td width="35%">C&oacute;digo</td> 
  <td colspan="2"> 
   <input type="text" name="plantacodigo"	value="<?php if(!$flagconsultarplanta){ 
echo $sbreg[plantacodigo];}else {echo $plantacodigo;}?>"> 
  </td> 
 </tr> 
<tr> 
 <td width="35%">C&oacute;digo Inmueble</td>
  <td colspan="2"> 
   <input type="text" name="plantabieninmu"	value="<?php if(!$flagconsultarplanta){ 
echo $sbreg[plantabieninmu];}else {echo $plantabieninmu;}?>"> 
  </td> 
 </tr> 
<tr> 
 <td width="35%">Nombre</td> 
  <td colspan="2"> 
   <input type="text" name="plantanombre"	value="<?php if(!$flagconsultarplanta){ 
echo $sbreg[plantanombre];}else {echo $plantanombre;}?>"> 
  </td> 
 </tr> 
<tr>
 <td width="35%">Profesional de Operaci&oacute;n</td> 
  <td colspan="2"> 
   <input type="text" name="plantaencarg"	value="<?php if(!$flagconsultarplanta){ 
echo $sbreg[plantaencarg];}else {echo $plantaencarg;}?>" size="35"> 
  </td> 
 </tr> 
 
 <tr>
 <td width="35%">Profesional de Mantenimiento</td> 
  <td colspan="2"> 
   <input type="text" name="plantaencman"	value="<?php if(!$flagconsultarplanta){ 
echo $sbreg[plantaencman];}else {echo $plantaencman;}?>" size="35"> 
  </td> 
 </tr> 
 <tr> 
 <td width="35%">Ciudad</td> 
  <td colspan="2"> 
   <select name="ciudadcodigo">
   <option value="">Seleccione</option>
   <?php
    	$idcon = fncconn();
   		include('../src/FunGen/floadciudad.php');
   		floadciudad($idcon);
   		fncclose($idcon);
   ?>
   </select>
  </td> 
 </tr> 
 
<tr> 
 <td width="35%">Ubicaci&oacute;n</td> 
  <td colspan="2"> 
   <input type="text" name="plantaubicac"	value="<?php if(!$flagconsultarplanta){ 
echo $sbreg[plantaubicac];}else {echo $plantaubicac;}?>"> 
  </td> 
 </tr> 
<tr> 
 <td width="35%">Capacidad</td> 
  <td> 
   <input type="text" name="plantacapaci"	value="<?php if(!$flagconsultarplanta){ 
echo $sbreg[plantacapaci];}else {echo $plantacapaci;}?>"size="13">
	</td>
   <td>
   <select name="unidadcodigo">
   <option value="">Seleccione</option>
   <?php
    	$idcon = fncconn();
   		include('../src/FunGen/floadunimedida.php');
   		floadunimedida($idcon);
   		fncclose($idcon);
   ?>
   </select>
   </td> 
 </tr> 
<tr> 
 <td width="35%">Descripci&oacute;n</td> 
  <td colspan="2" rowspan="2"> 
    <textarea name="plantadescri" cols="35" rows="3" wrap="VIRTUAL"><?php if(!$flagconsultarplanta){ 
echo $sbreg[plantadescri];} else {echo $plantadescri;}?></textarea>
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
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionconsultarplanta.value =  1; 
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
 <input type="hidden" name="flagconsultarplanta" value="1"> 
<input type="hidden" name="accionconsultarplanta"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="columnas" value="plantacodigo, 
plantanombre, 
plantaencarg, 
plantaubicac, 
plantaarea, 
plantadescri,
ciudadcodigo,
plantaencman,
plantacapaci,
unidadcodigo,
plantabieninmu
"> 
<input type="hidden" name="nombtabl" value="planta"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
