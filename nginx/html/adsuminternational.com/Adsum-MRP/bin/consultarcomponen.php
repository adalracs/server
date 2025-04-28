<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
include ( '../src/FunPerPriNiv/pktblestado.php');
include ( '../src/FunPerPriNiv/pktblequipo.php');
if(!$flagconsultarcomponen)
	$equipocodigo = null;
?> 
<html> 
<head> 
<title>Consultar en componen</title> 
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
<p><font class="NoiseFormHeaderFont">Componente</font></p> 
<table width="70%" border="0" align="center" cellpadding="2" cellspacing="1" 
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
            <table width="95%" border="0" cellspacing="1" cellpadding="0" 
align="center"> 
              <tr class="NoiseFooterTD"> 
 <td width="20%">C&oacute;digo</td> 
  <td width="30%"><input name="componcodigo" type="text"	value="<?php if(!$flagconsultarcomponen){ 
echo $sbreg[componcodigo];}else {echo $componcodigo;}?>" size="20">  </td> 
 <td colspan="2">&nbsp;</td> 
  </tr> 
              <tr> 
 <td width="20%" class="NoiseFooterTD">Nombre</td> 
  <td colspan="3" class="NoiseFooterTD"><input name="componnombre" type="text"	value="<?php if(!$flagconsultarcomponen){ 
echo $sbreg[componnombre];}else {echo $componnombre;}?>" size="50">  </td> 
 </tr> 
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
	               					<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
<tr> 
 <td width="20%" class="NoiseErrorDataTD"><input name="radio1"  type="button" value="Equipo" onClick="window.open('maestablequipogen.php?codigo=<?php echo $codigo?>','equipogen','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" alt="Cancelar" border=0 href="#" target="_parent"></td>
 <td colspan="3" class="NoiseErrorDataTD"><input name="equiponombre" type="text"	value="<?php if(!$flagnuevocomponen){ 
echo $equiponombre;} else {echo $equiponombre;} ?>" size="50" onFocus="if (!agree)this.blur();"> </td>
 </tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
	               					<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
 <tr class="NoiseFooterTD">
   <td width="20%">Fabricante</td> 
  <td width="30%"><input name="componfabric" type="text"	value="<?php if(!$flagconsultarcomponen){ 
echo $sbreg[componfabric];} else {echo $componfabric;} ?>" size="20">  </td> 
  <td>Marca </td> 
  <td><input name="componmarca" type="text"	value="<?php if(!$flagconsultarcomponen){ 
echo $sbreg[componmarca];}else {echo $componmarca;}?>" size="20"></td>
 </tr> 
<tr class="NoiseFooterTD"> 
 <td width="20%">Modelo</td> 
  <td width="30%"><input name="componmodelo" type="text"	value="<?php if(!$flagconsultarcomponen){ 
echo $sbreg[componmodelo];} else {echo $componmodelo;} ?>" size="20"></td> 
 <td width="20%">No. serie </td> 
  <td width="30%"><input name="componserie" type="text"	value="<?php if(!$flagconsultarcomponen){ 
echo $sbreg[componserie];} else {echo $componserie;}?>" size="20"></td> 
 </tr> 
<tr class="NoiseFooterTD">
  <td>No. inventario</td>
  <td><input name="componcinv" type="text"	value="<?php if(!$flagconsultarcomponen){ 
echo $sbreg[componcinv];} else {echo $componcinv;}?>" size="20"></td>
  <td>Ubicaci&oacute;n</td>
  <td><input name="componubicac" type="text"	value="<?php if(!$flagconsultarcomponen){ 
echo $sbreg[componubicac];} else {echo $componubicac;}?>" size="20"></td>
</tr>
<tr class="NoiseFooterTD">
  <td>Vida &uacute;til </td>
  <td><input name="componviduti" type="text"	value="<?php if(!$flagconsultarcomponen){ 
echo $sbreg[componviduti];}else {echo $componviduti;}?>" size="14"></td>
  <td>Fecha compra</td>
  <td><input type="text" name="componfeccom"	value="<?php if(!$flagconsultarcomponen){ 
echo $sbreg[componfeccom];} else {echo $componfeccom;}?>" onFocus="if(!agree)this.blur();" size="14">
    <img src="../img/cal.gif" border="0" onClick="window.open('formcalendario.php?calencodigo=componfeccom','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');"></td>
</tr>
<tr class="NoiseFooterTD">
  <td>Fec. instalaci&oacute;n</td>
  <td><input type="text" name="componfecins" onFocus="if(!gree)this.blur();" value="<?php if(!$flagconsultarcomponen){ 
echo $sbreg[componfecins];} else {echo $componfecins;}?>" size="14">
    <img src="../img/cal.gif" border="0" onClick="window.open('formcalendario.php?calencodigo=componfecins','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');"></td>
  <td>Venc. garantia</td> 
  <td><input type="text" name="componvengar" onFocus="if(!agree)this.blur();" value="<?php if(!$flagconsultarcomponen){ 
echo $sbreg[componvengar];} else {echo $componvengar;}?>" size="14">
    <img src="../img/cal.gif" border="0" onClick="window.open('formcalendario.php?calencodigo=componvengar','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');"></td>
</tr>
<tr class="NoiseFooterTD">
  <td>Alto</td>
  <td><input name="componalto" type="text"	value="<?php if(!$flagconsultarcomponen){ 
echo $sbreg[componalto];}else {echo $componalto;}?>" size="17"></td>
  <td>Largo</td>
  <td><input name="componlargo" type="text"	value="<?php if(!$flagconsultarcomponen){ 
echo $sbreg[componlargo];}else {echo $componlargo;}?>" size="17"></td>
</tr>
<tr class="NoiseFooterTD">
  <td>Ancho</td>
            <td><input name="componancho" type="text"	value="<?php if(!$flagconsultarcomponen){ 
echo $sbreg[componancho];}else {echo $componancho;}?>" size="17"></td>
<td>Peso</td>
<td><input name="componpeso" type="text"	value="<?php if(!$flagconsultarcomponen){ 
echo $sbreg[componpeso];} else {echo $componpeso;}?>" size="17"></td>
</tr> 
 <tr class="NoiseFooterTD">
   <td>Descripci&oacute;n</td>
   <td colspan="3" rowspan="2"><textarea name="compondescri" cols="34" rows="3" wrap="VIRTUAL"><?php if(!$flagconsultarcomponen){ 
echo $sbreg[compondescri];} else {echo $compondescri;}?></textarea></td>
   </tr>
 <tr class="NoiseFooterTD">
   <td>&nbsp;</td>
 </tr>
 <tr> 
  <td width="20%">&nbsp;</td> 
 </tr> 
</table> 
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionconsultarcomponen.value =  1;
form1.action='maestablcomponen.php';"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablcomponen.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagconsultarcomponen" value="1"> 
<input type="hidden" name="accionconsultarcomponen"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="equipocodigo" value="<?php echo $equipocodigo; ?>">
<input type="hidden" name="columnas" value="componcodigo, 
equipocodigo, 
componnombre, 
compondescri, 
componfabric, 
componmarca, 
componmodelo, 
componserie, 
componfeccom, 
componfecins, 
componcinv, 
componvengar, 
componviduti, 
componubicac, 
componalto, 
componlargo, 
componancho, 
componpeso,
tipcomcodigo
"> 
<input type="hidden" name="nombtabl" value="componen"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
