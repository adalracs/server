<?php 
include ( '../src/FunGen/sesion/fncvalses.php');
if(!$flagborrartipotrab)
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
<title>Borrar registro de tipotrab</title> 
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
<p><font class="NoiseFormHeaderFont">Tipo de trabajo</font></p> 
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
 <td width="25%">C&oacute;digo</td> 
  <td width="25%"> 
   <input type="text" name="tiptracodigo" value="<?php 
   if(!$flagborrartipotrab){ echo $sbreg[tiptracodigo];}else{ echo $tiptracodigo;}
?>" onFocus="if (!agree)this.blur();" > 
  </td> 
 </tr> 
              <tr>
                <td>Nombre</td>
                <td><input type="text" name="tiptranombre" value="<?php 
                if(!$flagborrartipotrab){ echo $sbreg[tiptranombre];}else{ echo $tiptranombre;}
?>" onFocus="if (!agree)this.blur();" ></td>
              </tr>
              <tr> 
 <td width="25%">Descripci&oacute;n</td> 
  <td width="25%" rowspan="2"> 
    <textarea name="tiptradescri" rows="3" wrap="VIRTUAL" onFocus="if (!agree)this.blur();"><?php 
    if(!$flagborrartipotrab){ echo $sbreg[tiptradescri];}else{ echo $tiptradescri;}
?>
    </textarea> 
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
onclick="form1.accionborrartipotrab.value =  1; 
form1.action='maestabltipotrab.php';"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestabltipotrab.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagborrartipotrab" value="1"> 
<input type="hidden" name="accionborrartipotrab"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 
