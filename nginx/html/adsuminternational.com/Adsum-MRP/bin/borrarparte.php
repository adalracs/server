<?php 
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktblcomponen.php'); 
if(!$flagborrarparte)
{
	include ( '../src/FunGen/sesion/fnccarga.php');
	$sbreg = fnccarga($nombtabl,$radiobutton);
	if (!$sbreg)
	{
		include( '../src/FunGen/fnccontfron.php');
	}	
	$idcon = fncconn();
	$sbregcompon = loadrecordcomponen($sbreg[componcodigo],$idcon);
	$componnombre = $sbregcompon[componnombre];
	fncclose($idcon);
}
?> 
<html> 
<head> 
<title>Borrar registro de parte</title> 
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
Borrar registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="85%" border="0" cellspacing="0" cellpadding="1" 
align="center"> 
<tr> 
 <td width="41%">C&oacute;digo</td> 
  <td width="25%"><input name="partecodigo" type="text"	value="<?php if(!$flagborrarparte){ 
echo $sbreg[partecodigo];} else {echo $partecodigo;}?>" size="14" onFocus="if (!agree)this.blur();"> 
  </td> 
 <td width="25%">&nbsp;</td> 
  <td width="25%">&nbsp;</td> 
 </tr> 
<tr> 
 <td width="41%">Nombre</td> 
  <td colspan="2"><input name="partenombre" type="text"	value="<?php if(!$flagborrarparte){ 
echo $sbreg[partenombre];} else {echo $partenombre;}?>" size="20"> 
  </td> 
   <td>&nbsp;</td>
              </tr> 
 <tr>
<td colspan="4"><hr></td>              
</tr>
<tr>
 <td width="41%">Componente</td>
 <td>Cod.&nbsp;<input name="componcodigo" type="text"	value="<?php if(!$flagborrarparte){ 
echo $sbreg[componcodigo];} else {echo $componcodigo;} ?>" size="8" onFocus="if (!agree)this.blur();"></td>
 <td>Nombre</td>
 <td><input name="componnombre" type="text"	value="<?php if(!$flagborrarparte){ 
echo $componnombre;} else {echo $componnombre;} ?>" size="14" onFocus="if (!agree)this.blur();"></td>
 </tr><tr> 
 <td width="41%">Fabricante</td> 
  <td width="25%"><input name="partefabric" type="text"	value="<?php if(!$flagborrarparte){ 
echo $sbreg[partefabric];}else {echo $partefabric;}?>" size="14" onFocus="if (!agree)this.blur();"> 
  </td> 
 <td width="25%">Marca</td> 
  <td width="25%"><input name="partemarca" type="text"	value="<?php if(!$flagborrarparte){ echo 
$sbreg[partemarca];} else {echo $partemarca;}?>" size="17" onFocus="if (!agree)this.blur();">
  </td> 
 </tr> 
<tr> 
 <td width="41%">Modelo</td> 
  <td width="25%"> 
   <input name="partemodelo" type="text"	value="<?php if(!$flagborrarparte){ 
echo $sbreg[partemodelo];} else {echo $partemodelo;}?>" size="14" onFocus="if (!agree)this.blur();"> 
  </td> 
 <td width="25%">No. serie </td> 
  <td width="25%">
   <input name="parteserie" type="text"	value="<?php if(!$flagborrarparte){ echo 
$sbreg[parteserie];}else {echo $parteserie;}?>" size="17" onFocus="if (!agree)this.blur();"> 
  </td> 
 </tr>
<tr>
 <td width="41%">Fecha de compra </td> 
<td colspan="3"><input name="partefeccom" type="text"	value="<?php if(!$flagborrarparte){ 
echo $sbreg[partefeccom];} else {echo $partefeccom;}?>" size="14" onFocus="if (!agree)this.blur();"> aaaa-mm-dd</td>
<td>&nbsp;</td>
 </tr> 
<tr>
  <td>Fecha de instalaci&oacute;n </td>
  <td colspan="3"><input name="partefecins" type="text"	value="<?php if(!$flagborrarparte){ 
echo $sbreg[partefecins];} else {echo $partefecins;}?>" size="14" onFocus="if (!agree)this.blur();"> aaaa-mm-dd</td>
<td>&nbsp;</td>
 </tr>
<tr>
  <td>Vencimiento de garant&iacute;a</td>
<td colspan="3"><input name="partevengar" type="text"	value="<?php if(!$flagborrarparte){ 
echo $sbreg[partevengar];} else {echo $partevengar;}?>" size="14" onFocus="if (!agree)this.blur();"> aaaa-mm-dd</td>
<td>&nbsp;</td>
</tr> 
 <tr>
   <td>Descripci&oacute;n </td>
   <td colspan="3" rowspan="2"><textarea name="partedescri" cols="34" rows="3" wrap="VIRTUAL" onFocus="if (!agree)this.blur();"><?php if(!$flagborrarparte){ 
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
onclick="form1.accionborrarparte.value =  1; form1.action='maestablparte.php';" 
 width="86" height="18" alt="Aceptar" border=0> 
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
 <input type="hidden" name="flagborrarparte" value="1"> 
<input type="hidden" name="accionborrarparte"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 
