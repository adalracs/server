<?php 
include ( '../src/FunPerSecNiv/fncclose.php');
include ( '../src/FunPerSecNiv/fncconn.php');
include ( '../src/FunPerSecNiv/fncfetch.php');
include ( '../src/FunPerSecNiv/fncnumreg.php');
if($accionnuevocamperequipo)
{
	include ( 'grabacamperequipogen.php');
}
ob_end_flush();
?> 
<html> 
<head> 
<title>Nuevo registro de campos personalizados</title> 
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
<p><font class="NoiseFormHeaderFont">Campo personalizado</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Ingresar nuevo registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="85%" border="0" cellspacing="0" cellpadding="3" 
align="center"> 
<tr> 
 <td width="41%"> <?php if($campnomb["capeeqnombre"] == 1){ $capeeqnombre = null;
echo "*";}
?>Nombre</td> 
  <td width="59%"> 
   <input type="text" name="capeeqnombre"	value="<?php if(!$flagnuevocamperequipo){ 
echo $sbreg[capeeqnombre];}else {echo $capeeqnombre; }?>"> 
  </td> 
 </tr> 
<tr> 
 <td width="41%"> <?php if($campnomb["capeeqdescri"] == 1){ $capeeqdescri = null;
echo "*";}
?>Descripci&oacute;n</td> 
  <td width="59%" rowspan="2"> 
    <textarea name="capeeqdescri" rows="3" wrap="VIRTUAL"><?php if(!$flagnuevocamperequipo){ 
echo $sbreg[capeeqdescri];}else {echo $capeeqdescri;}?></textarea> 
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
onclick="form1.accionnuevocamperequipo.value =  1;"  
width="86" height="18" alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="window.opener.document.form1.tipequcampo1.focus();window.close();"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
<?php 
if($campnomb){ echo '<font face="Verdana" >Corregir los campos marcados con *</font>';} 
 ?>
<input type="hidden" name="capeeqcodigo"	value="<?php if(!$flagnuevocamperequipo){ 
echo $sbreg[capeeqcodigo];}else{ echo $capeeqcodigo;} ?>">
<input type="hidden" name="accionnuevocamperequipo"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 
