<?php 
include ( '../src/FunGen/sesion/fncvalses.php');
if(!$flagborrarplano)
{
	include ( '../src/FunGen/sesion/fnccarga.php');
	$sbreg = fnccarga($nombtabl,$radiobutton);
	if (!$sbreg)
	{
		include( '../src/FunGen/fnccontfron.php');
	}
	$imgplano = $sbreg[planoruta];
}
?> 
<html> 
<head> 
<title>Borrar registro de plano</title> 
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
<p><font class="NoiseFormHeaderFont">Plano</font></p> 
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
 <td width="41%">C&oacute;digo</td> 
  <td><input type="text" name="planocodigo"	value="<?php if(!$flagborrarplano){ 
echo $sbreg[planocodigo];}else {echo $planocodigo;}?>" onFocus="if 
(!agree)this.blur();"> 
  </td> 
 </tr> 
<tr> 
 <td width="41%">Nombre</td> 
  <td><input type="text" name="planonombre"	value="<?php if(!$flagborrarplano){ 
echo $sbreg[planonombre];}else {echo $planonombre;}?>" onFocus="if 
(!agree)this.blur();"> 
  </td> 
 </tr> 
<tr>
  <td width="41%">Ruta</td>
  <td><input type="text" name="planoruta"	value="<?php if(!$flagborrarplano){ echo 
$sbreg[planoruta];}else {echo $planoruta;}?>" onFocus="if 
(!agree)this.blur();"></td>
  </tr>
<tr> 
 <td width="41%">Descripci&oacute;n</td> 
  <td> 
    <textarea name="planodescri" rows="3" wrap="VIRTUAL" onFocus="if 
(!agree)this.blur();"><?php if(!$flagborrarplano){ 
echo $sbreg[planodescri];}else {echo $planodescri;}?></textarea> 
  </td> 
 </tr>
  <tr> 
 <td colspan="2">Desea ver el plano?<input type="image" src="../img/aceptar.gif" onclick="window.open('detallaplano.php?imgplano=<?php echo $imgplano;?>','detallaplano','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" alt="Aceptar" border=0></td> 
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
onclick="form1.accionborrarplano.value =  1; form1.action='maestablplano.php';" 
 width="86" height="18" alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablplano.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
<input type="image" name="cancelar2" src="../img/ayuda.gif" width="86" 
height="18" alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagborrarplano" value="1"> 
<input type="hidden" name="accionborrarplano"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="imgplano" value="<?php echo $imgplano; ?>"> 
</form> 
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 
