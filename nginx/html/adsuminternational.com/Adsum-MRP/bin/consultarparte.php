<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
include ( '../src/FunPerPriNiv/pktblcomponen.php'); 
?> 
<html> 
<head> 
<title>Consultar en parte</title> 
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
<p><font class="NoiseFormHeaderFont">Parte</font></p> 
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
  <td width="25%"><input name="partecodigo" type="text"	value="<?php if(!$flagconsultarparte){ 
echo $sbreg[partecodigo];} else {echo $partecodigo;}?>" size="14"> 
  </td> 
 <td width="25%">&nbsp;</td> 
  <td width="25%">&nbsp;</td> 
 </tr> 
<tr> 
 <td width="41%">Nombre</td> 
  <td colspan="2"><input name="partenombre" type="text"	value="<?php if(!$flagconsultarparte){ 
echo $sbreg[partenombre];} else {echo $partenombre;}?>" size="20"> 
  </td> 
   <td>&nbsp;</td>
              </tr> 
 <tr>
<td colspan="4"><hr></td>              
</tr>
<tr>
 <td width="41%">Componente
<input name="radio1"  type="radio" onclick="window.open('consultarcomponengen.php?codigo=<?php echo $codigo?>','componengen','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" alt="Cancelar" border=0 href="#" target="_parent"></td>
 <td>Cod.&nbsp;<input name="componcodigo" type="text"	value="<?php if(!$flagconsultarparte){ 
echo $componcodigo;} else {echo $componcodigo;} ?>" size="8"></td>
 <td>Nombre</td>
 <td><input name="componnombre" type="text"	value="<?php if(!$flagconsultarparte){ 
echo $componnombre;} else {echo $componnombre;} ?>" size="14" onFocus="if (!agree)this.blur();"></td>
 </tr>
 <tr>
<td colspan="4"><hr></td>               
</tr>
<tr> 
 <td width="41%">Fabricante</td> 
  <td width="25%"><input name="partefabric" type="text"	value="<?php if(!$flagconsultarparte){ 
echo $sbreg[partefabric];}else {echo $partefabric;}?>" size="14"> 
  </td> 
 <td width="25%">Marca</td> 
  <td width="25%"><input name="partemarca" type="text"	value="<?php if(!$flagconsultarparte){ echo 
$sbreg[partemarca];} else {echo $partemarca;}?>" size="17">
  </td> 
 </tr> 
<tr> 
 <td width="41%">Modelo</td> 
  <td width="25%"> 
   <input name="partemodelo" type="text"	value="<?php if(!$flagconsultarparte){ 
echo $sbreg[partemodelo];} else {echo $partemodelo;}?>" size="14"> 
  </td> 
 <td width="25%">No. serie </td> 
  <td width="25%">
   <input name="parteserie" type="text"	value="<?php if(!$flagconsultarparte){ echo 
$sbreg[parteserie];}else {echo $parteserie;}?>" size="17"> 
  </td> 
 </tr>
<tr>
 <td width="41%">Fecha de compra </td> 
<td><input type="text" name="partefeccom"	value="<?php if(!$flagconsultarparte){ echo $sbreg[partefeccom];} else {echo $partefeccom;}?>" size="13" onfocus="if(!agree) this.blur();"></td>
<td colspan = "3"><img src="../img/cal.gif" border="0" onclick="window.open('formcalendario.php?calencodigo=partefeccom','','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');"></td>
 </tr> 
<tr>
  <td>Fecha de instalaci&oacute;n </td>
            <td><input type="text" name="partefecins"	value="<?php if(!$flagconsultarparte){ 
echo $sbreg[partefecins];} else {echo $partefecins;}?>" size="14" onfocus="if(!agree) this.blur();"></td>
<td colspan = "3"><img src="../img/cal.gif" border="0" onclick="window.open('formcalendario.php?calencodigo=partefecins','','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');"></td>
 </tr>
<tr>
  <td>Vencimiento de garant&iacute;a</td>
            <td><input type="text" name="partevengar"	value="<?php if(!$flagconsultarparte){ 
echo $sbreg[partevengar];} else {echo $partevengar;}?>" size="14" onfocus="if(!agree) this.blur();"></td>
<td colspan = "3"><img src="../img/cal.gif" border="0" onclick="window.open('formcalendario.php?calencodigo=partevengar','','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');"></td>
</tr>
<tr> 
 <td width="41%">Costo de la inversi&oacute;n </td> 
  <td colspan="3"> 
   <input name="partecinv" type="text"	value="<?php if(!$flagconsultarparte){ echo 
$sbreg[partecinv];}else {echo $partecinv;}?>" size="14"> 
  </td> 
 </tr> 
<tr> 
 <td width="41%">Vida &uacute;til </td> 
  <td colspan="3"> 
   <input name="parteviduti" type="text"	value="<?php if(!$flagconsultarparte){ 
echo $sbreg[parteviduti];}else {echo $parteviduti;}?>" size="14"> 
  </td> 
 </tr> 
 <tr>
   <td>Descripci&oacute;n </td>
   <td colspan="3" rowspan="2"><textarea name="partedescri" cols="34" rows="3" wrap="VIRTUAL"><?php if(!$flagconsultarparte){ 
echo $sbreg[partedescri];}else {echo $partedescri;}?></textarea></td>
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
onclick="form1.accionconsultarparte.value =  1; 
form1.action='maestablparte.php';"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablparte.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagconsultarparte" value="1"> 
<input type="hidden" name="accionconsultarparte"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="columnas" value="partecodigo, 
componcodigo, 
partenombre, 
partedescri, 
partefabric, 
partemarca, 
partemodelo, 
parteserie, 
partefeccom, 
partefecins, 
partecinv, 
partevengar, 
parteviduti, 
componubicac, 
componalto, 
componlargo, 
componancho, 
componpeso, 
componestado, 
componactivo 
"> 
<input type="hidden" name="nombtabl" value="parte"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
