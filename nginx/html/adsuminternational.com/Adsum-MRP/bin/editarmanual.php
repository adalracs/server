<?php 
ob_start();
include ( '../src/FunGen/sesion/fncvalses.php');
if($accioneditarmanual) 
{ 
	include ( 'editamanual.php'); 
}
ob_end_flush();
if(!$flageditarmanual)
{
	include ( '../src/FunGen/sesion/fnccarga.php');
	$sbreg = fnccarga($nombtabl,$radiobutton);
	if (!$sbreg)
	{
		include( '../src/FunGen/fnccontfron.php');
	}
	$imgmanual = $sbreg[manualruta];
}
?> 
<html> 
<head> 
<title>Editar registro de manual</title> 
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
<p><font class="NoiseFormHeaderFont">Manual</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Editar registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="85%" border="0" cellspacing="0" cellpadding="3" 
align="center"> 
<tr> 
 <td width="41%"><?php if($campnomb["manualnombre"] == 1){ $manualnombre=null;
echo "*";}
?>Nombre </td> 
  <td><input type="text" name="manualnombre"	value="<?php if(!$flageditarmanual){ 
echo $sbreg[manualnombre];} else {echo $manualnombre;}?>"> 
  </td> 
 </tr> 
  <tr> 
 <td width="41%"><?php if($campnomb["manualruta"] == 1){ $manualruta = null;
echo "*";}
?>Ruta</td> 
  <td><input type="text" name="manualruta"	onFocus="if (!agree)this.blur();" 
value="<?php if(!$flageditarmanual){ echo $sbreg[manualruta];}else {echo $manualruta;}?>"> 
  </td> 
 </tr> 
 <tr>
  <td width="41%">Ruta nueva</td>
  <td><input type="file" name="file" onkeydown="this.blur();"></td>
  </tr>
<tr> 
 <td width="41%"><?php if($campnomb["manualdescri"] == 1){ $manualdescri=null;
echo "*";}
?>Descripci&oacute;n</td> 
  <td><textarea name="manualdescri" rows="3" wrap="VIRTUAL"><?php if(!$flageditarmanual){ 
echo $sbreg[manualdescri];} else {echo $manualdescri;}?></textarea> 
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
onclick="form1.accioneditarmanual.value =  1;"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablmanual.php';"  width="86" height="18" 
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
 <input type="hidden" name="manualcodigo"	value="<?php if(!$flageditarmanual){ echo $sbreg[manualcodigo];}else{ echo $manualcodigo;} ?>">
 <input type="hidden" name="accioneditarmanual"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">  
<input type="hidden" name="imgmanual" value="<?php echo $imgmanual; ?>">  
</form> 
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 
