<?php 
include ( '../src/FunGen/sesion/fncvalses.php');
if(!$flagborrarcamperequipo)
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
<title>Borrar registro de campo personalizado</title> 
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
<table width="350" border="0" align="center" cellpadding="2" cellspacing="1" 
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
            <table width="85%" border="0" cellspacing="1" cellpadding="0" 
align="center"> 
<tr> 
 <td width="41%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
  <td width="59%" bgcolor="#E8F0F6"> <?php if(!$flagborrarcamperequipo){ 
echo $sbreg[capeeqcodigo];}else{ echo $capeeqcodigo;} ?>
  </td> 
 </tr> 
<tr> 
 <td width="41%" class="NoiseFooterTD">&nbsp;Nombre</td> 
  <td width="59%" bgcolor="#E8F0F6"><?php if(!$flagborrarcamperequipo){ 
echo $sbreg[capeeqnombre];}else{ echo $capeeqnombre;} ?></td> 
 </tr> 
<tr> 
 <td width="41%" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td> 
  <td width="59%" rowspan="2" bgcolor="#E8F0F6"><?php if(!$flagborrarcamperequipo){ 
echo $sbreg[capeeqdescri];}else{ echo $capeeqdescri;} ?></td> 
 </tr>
<tr class="NoiseFooterTD">
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
onclick="form1.accionborrarcamperequipo.value =  1; form1.action='maestablcamperequipo.php';" 
 width="86" height="18" alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablcamperequipo.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagborrarcamperequipo" value="1"> 
<input type="hidden" name="accionborrarcamperequipo"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="capeeqcodigo" value="<?php if(!$flagborrarcamperequipo){ 
echo $sbreg[capeeqcodigo];}else{ echo $capeeqcodigo;} ?>"> 
</form> 
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 
