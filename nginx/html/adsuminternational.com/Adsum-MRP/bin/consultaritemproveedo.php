<?php
include ('../src/FunPerPriNiv/pktblproveestado.php');
// --- Se incluyen los siguientes archivos en las ventanas emergentes ---
// ----------------------------------------------------------------------
include ( '../src/FunPerSecNiv/fncnumreg.php');
include ( '../src/FunPerSecNiv/fncfetch.php');
include ( '../src/FunPerSecNiv/fncconn.php');
include ( '../src/FunPerSecNiv/fncclose.php');
// ---
?> 
<html> 
<head> 
<title>Consultar en proveedo</title> 
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
<p><font class="NoiseFormHeaderFont">Proveedor</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td width="629" class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
    <td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF"> 
Consultar registro</font></span></td></tr> 
<tr> 
  <td>
            <table width="95%" border="0" cellspacing="1" cellpadding="1" 
align="center"> 
             <tr> 
 <td width="16%">C&oacute;digo</td> 
  <td> <input type="text" name="proveecodigo" value="<?php if(!$flagconsultarproveedo){ 
echo $sbreg[proveecodigo];}else {echo $proveecodigo;}?>"> 
  </td> 
 <td colspan="2">&nbsp;</td> 
 </tr> 
             <tr> 
 <td>Nombre</td> 
  <td><input type="text" name="proveenombre" value="<?php if(!$flagnuevoproveedo){ 
echo $sbreg[proveenombre];}else {echo $proveenombre;}?>" size="35"> 
  </td> 
   <td>Estado</td>
           <td width="28%">
           	<select name="proestcodigo">
            <option value ="">Seleccione</option>
            <?php
				include ('../src/FunGen/floadproveestado.php');
				$idcon = fncconn();
				floadproveestado($idcon);
				fncclose($idcon);
			?></select>
            </td>
  </td> 
</tr> 
<tr> 
 <td width="16%">Representante legal </td> 
  <td width="40%"> 
   <input name="proveerepleg" type="text"	value="<?php if(!$flagconsultarproveedo){ 
echo $sbreg[proveerepleg];}else {echo $proveerepleg;}?>" size="35"> 
  </td> 
 <td>Tel&eacute;fono</td>
  <td width="27%"> 
   <input name="proveetelefo" type ="text"	value="<?php if(!$flagconsultarproveedo){ 
echo $sbreg[proveetelefo];}else {echo $proveetelefo;}?>" size="16">
  </td> 
 </tr> 
<tr> 
 <td width="16%">Fax</td> 
  <td> 
   <input name="proveefax" type="text"	value="<?php if(!$flagconsultarproveedo){ 
echo $sbreg[proveefax];}else {echo $proveefax;}?>" size="25"> 
  </td> 
 <td>Pa&iacute;s</td>
  <td width="27%"> 
   <input name="proveepais" type="text"	value="<?php if(!$flagconsultarproveedo){ 
echo $sbreg[proveepais];}else {echo $proveepais;}?>" size="16"> 
  </td> 
 </tr> 
<tr> 
 <td width="16%">Ciudad</td> 
  <td> 
   <input name="proveeciudad" type="text"	value="<?php if(!$flagconsultarproveedo){ 
echo $sbreg[proveeciudad];}else {echo $proveeciudad;}?>" size="25"> 
  </td> 
 <td>C&oacute;digo postal</td>
  <td width="27%"> 
   <input name="proveepostal" type="text"	value="<?php if(!$flagconsultarproveedo){ 
echo $sbreg[proveepostal];}else {echo $proveepostal;}?>" size="16">
  </td> 
 </tr> 
<tr> 
 <td width="16%">Direcci&oacute;n</td>
  <td> 
  <input name="proveedirecc" type="text"	value="<?php if(!$flagconsultarproveedo){ 
echo $sbreg[proveedirecc];}else {echo $proveedirecc;}?>" size="25">
   </td> 
 <td width="13%">E-mail</td>
  <td width="27%"> 
   <input name="proveeemail" type="text"	value="<?php if(!$flagconsultarproveedo){ 
echo $sbreg[proveeemail];}else {echo $proveeemail;}?>" size="16">
  </td> 
 </tr> 
 <tr> 
 <td width="16%">URL</td> 
   <td colspan="3"> 
   <input name="proveeurl" type="text"	value="<?php if(!$flagconsultarproveedo){ 
echo $sbreg[proveeurl];}else {echo $proveeurl;}?>" size="35">
  </td> 
  </tr>
  <tr> 
 <td width="16%">Contacto</td> 
  <td> 
  <input name="proveecontac" type="text"	value="<?php if(!$flagconsultarproveedo){ 
echo $sbreg[proveecontac];}else {echo $proveecontac;}?>" size="35">
   </td> 
 <td>Tel&eacute;fono</td>
  <td width="27%"> 
   <input name="proveetelcon" type="text"	value="<?php if(!$flagconsultarproveedo){ 
echo $sbreg[proveetelcon];}else {echo $proveetelcon;}?>" size="16">
  </td> 
 </tr> 
<tr> 
 <td width="16%">Nota</td> 
  <td colspan="3" rowspan="2"> 
    <textarea name="proveenota" cols="63" rows="3" wrap="VIRTUAL"><?php if(!$flagconsultarproveedo){ 
echo $sbreg[proveenota];}else {echo $proveenota;}?></textarea>
  </td> 
  <td width="4%" rowspan="2">&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
</tr> 
 <tr> 
  <td width="16%">&nbsp;</td> 
 </tr> 
</table> 
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionconsultarproveedo.value =  1; 
form1.action='maestablitemproveedo.php';"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="self.close();"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagconsultarproveedo" value="1"> 
<input type="hidden" name="accionconsultarproveedo"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="columnas" value="proveecodigo, 
proveenombre, 
proveerepleg, 
proveetelefo, 
proveefax, 
proveepais, 
proveeciudad, 
proveedirecc, 
proveeurl, 
proveeemail, 
proveenota,
proestcodigo,
proveespostal,
proveecontac,
proveetelcon 
"> 
<input type="hidden" name="nombtabl" value="proveedo"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html>