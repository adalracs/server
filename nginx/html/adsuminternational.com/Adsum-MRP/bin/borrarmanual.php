<?php 
include ( '../src/FunGen/sesion/fncvalses.php');
if(!$flagborrarmanual)
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
<title>Borrar registro de manual</title> 
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
Borrar registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="85%" border="0" cellspacing="0" cellpadding="3" 
align="center"> 
<tr> 
 <td width="41%">C&oacute;digo </td>  
  <td><input type="text" name="manualcodigo"	value="<?php if(!$flagborrarmanual){ 
echo $sbreg[manualcodigo];} else {echo $manualcodigo;}?>"onFocus="if 
(!agree)this.blur();" >  
  </td> 
 </tr> 
<tr> 
 <td width="41%">Nombre </td> 
  <td><input type="text" name="manualnombre"	value="<?php if(!$flagborrarmanual){ 
echo $sbreg[manualnombre];} else {echo $manualnombre;}?>"onFocus="if 
(!agree)this.blur();" >  
  </td> 
 </tr> 
<tr>
  <td width="41%">Ruta</td>
  <td><input type="text" name="manualruta"	value="<?php if(!$flagborrarmanual){ 
echo $sbreg[manualruta];} else {echo $manualruta;}?>"onFocus="if 
(!agree)this.blur();" > 
</td>
  </tr>
<tr> 
 <td width="41%">Descripci&oacute;n</td> 
  <td><textarea name="manualdescri" rows="3"  wrap="VIRTUAL" onFocus="if 
(!agree)this.blur();"><?php if(!$flagborrarmanual){ 
echo $sbreg[manualdescri];} else {echo $manualdescri;}?> </textarea> 
  </td> 
 </tr>
 <tr> 
 <td colspan="2">Desea ver el manual?<input type="image" src="../img/aceptar.gif" onclick="window.open('detallamanual.php?imgmanual=<?php echo $imgmanual;?>','detallamanual','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" alt="Aceptar" border=0></td> 
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
onclick="form1.accionborrarmanual.value =  1; 
form1.action='maestablmanual.php';"  width="86" height="18" alt="Aceptar" 
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
 <input type="hidden" name="flagborrarmanual" value="1"> 
<input type="hidden" name="accionborrarmanual"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="imgmanual" value="<?php echo $imgmanual; ?>"> 
</form> 
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 
