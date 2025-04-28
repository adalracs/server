<?php
//include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerSecNiv/fncclose.php');
include ( '../src/FunPerSecNiv/fncconn.php');
include ( '../src/FunPerSecNiv/fncfetch.php');
include ( '../src/FunPerSecNiv/fncnumreg.php');
include ( '../src/FunPerPriNiv/pktblestado.php');
include ( '../src/FunPerPriNiv/pktblequipo.php');
if(!$flagconsultarcomponen)
	$equipocodigo = null;
?>
<html>
<head>
<title>Consultar componente</title>
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
<body bgcolor="FFFFFF" text="#000000" onload="this.focus();">
<form name="form1" method="post"  enctype="multipart/form-data">
<p><font class="NoiseFormHeaderFont">Componente</font></p>
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
            <table width="85%" border="0" cellspacing="0" cellpadding="1"
align="center">
              <tr>
 <td width="41%">C&oacute;digo</td>
  <td width="25%"><input name="componcodigo" type="text"	value="<?php if(!$flagconsultarcomponen){
echo $sbreg[componcodigo];}else {echo $componcodigo;}?>" size="14">
  </td>
 <td width="25%">&nbsp;</td>
  <td width="25%">&nbsp;</td>
              </tr>
              <tr>
 <td width="41%">Nombre</td>
  <td colspan="2"><input name="componnombre" type="text"	value="<?php if(!$flagconsultarcomponen){
echo $sbreg[componnombre];}else {echo $componnombre;}?>" size="20">
  </td>
 <td>&nbsp;</td>
              </tr>
<tr>
<td colspan="4"><hr></td>
</tr>
<tr>
 <td width="41%">Equipo</td>
 <td>Cod.&nbsp;<input name="equipocodigo" type="text"	value="<?php if(!$flagnuevocomponen){
echo $equipocodigo;}else{ echo $equipocodigo;} ?>" size="8"></td>
 <td>Nombre</td>
 <td><input name="equiponombre" type="text"	value="<?php if(!$flagnuevocomponen){
echo $equiponombre;} else {echo $equiponombre;} ?>" size="14" onFocus="if (!agree)this.blur();"> </td>
 </tr>
 <tr>
<td colspan="4"><hr></td>
</tr>
 <tr>
   <td width="25%">Fabricante</td>
  <td width="25%"><input name="componfabric" type="text"	value="<?php if(!$flagconsultarcomponen){
echo $sbreg[componfabric];} else {echo $componfabric;} ?>" size="14">
  </td>
  <td colspan="2">&nbsp;
  </td>
 </tr>
<tr>
 <td width="41%">Marca</td>
  <td width="25%"><input name="componmarca" type="text"	value="<?php if(!$flagconsultarcomponen){
echo $sbreg[componmarca];}else {echo $componmarca;}?>" size="14">
  </td>
 <td width="25%">Modelo</td>
  <td width="25%"><input name="componmodelo" type="text"	value="<?php if(!$flagconsultarcomponen){
echo $sbreg[componmodelo];} else {echo $componmodelo;} ?>" size="17">
  </td>
 </tr>
<tr>
  <td>No. de serie </td>
  <td><input name="componserie" type="text"	value="<?php if(!$flagconsultarcomponen){
echo $sbreg[componserie];} else {echo $componserie;}?>" size="14"></td>
  <td>Vida &uacute;til </td>
  <td><input name="componviduti" type="text"	value="<?php if(!$flagconsultarcomponen){
echo $sbreg[componviduti];}else {echo $componviduti;}?>" size="17"></td>
</tr>
<tr>
  <td>Ubicaci&oacute;n</td>
  <td><input name="componubicac" type="text"	value="<?php if(!$flagconsultarcomponen){
echo $sbreg[componubicac];} else {echo $componubicac;}?>" size="14"></td>
  <td>Costo de inversi&oacute;n </td>
  <td><input name="componcinv" type="text"	value="<?php if(!$flagconsultarcomponen){
echo $sbreg[componcinv];} else {echo $componcinv;}?>" size="17"></td>
</tr>
<tr>
  <td>Alto</td>
  <td><input name="componalto" type="text"	value="<?php if(!$flagconsultarcomponen){
echo $sbreg[componalto];}else {echo $componalto;}?>" size="14"></td>
  <td>Largo</td>
  <td><input name="componlargo" type="text"	value="<?php if(!$flagconsultarcomponen){
echo $sbreg[componlargo];}else {echo $componlargo;}?>" size="17"></td>
</tr>
<tr>
  <td>Ancho</td>
  <td><input name="componancho" type="text"	value="<?php if(!$flagconsultarcomponen){
echo $sbreg[componancho];}else {echo $componancho;}?>" size="14"></td>
  <td>Peso</td>
  <td><input name="componpeso" type="text"	value="<?php if(!$flagconsultarcomponen){
echo $sbreg[componpeso];} else {echo $componpeso;}?>" size="17"></td>
</tr>
<tr>
  <td>Fecha de compra </td>
            <td colspan="3"><input type="text" name="componfeccom"	value="<?php if(!$flagconsultarcomponen){
echo $sbreg[componfeccom];} else {echo $componfeccom;}?>" size="10">&nbsp;aaaa-mm-dd</td>
</tr>
<tr>
 <td width="41%">Fecha de instalaci&oacute;n</td>
            <td colspan="3"><input type="text" name="componfecins"	value="<?php if(!$flagconsultarcomponen){
echo $sbreg[componfecins];} else {echo $componfecins;}?>" size="10">&nbsp;aaaa-mm-dd</td>
</tr>
<tr>
  <td>Vencimiento de garantia</td>
            <td colspan="3"><input type="text" name="componvengar"	value="<?php if(!$flagconsultarcomponen){
echo $sbreg[componvengar];} else {echo $componvengar;}?>" size="10">&nbsp;aaaa-mm-dd</td>
</tr>
 <tr>
   <td>Descripci&oacute;n</td>
   <td colspan="3" rowspan="2"><textarea name="compondescri" cols="34" rows="3" wrap="VIRTUAL"><?php if(!$flagconsultarcomponen){
echo $sbreg[compondescri];} else {echo $compondescri;}?></textarea></td>
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
onclick="form1.accionconsultarcomponen.value =  1;
form1.action='maestablcomponenindgen.php';"  width="86" height="18" alt="Aceptar"
border=0>
  <input type="image" name="cancelar" src="../img/cancelar.gif"
onclick="window.close();"  width="86" height="18"
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
componpeso
">
<input type="hidden" name="nombtabl" value="componen">
</form>
</body>
<?php
    if(!$codigo)
    { echo " -->"; }
?>
</html>