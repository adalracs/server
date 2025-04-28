<?php 
include ( '../src/FunGen/sesion/fncvalses.php');
if(!$flagdetallartipofall)
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
<title>Detalle de registro de tipofall</title> 
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
<p><font class="NoiseFormHeaderFont">Tipos de fallas</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Detallar registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="85%" border="0" cellspacing="0" cellpadding="3" 
align="center"> 
             <tr> 
 <td width="25%">C&oacute;digo</td> 
  <td width="25%"> 
   <input type="text" name="tipfalcodigo" value="<?php 
   if(!$flagdetallartipofall){ echo $sbreg[tipfalcodigo];}else{ echo
$tipfalcodigo;} ?>" onFocus="if (!agree)this.blur();" > 
  </td> 
 </tr> 
             <tr>
               <td>Nombre</td>
               <td><input type="text" name="tipfalnombre" value="<?php 
               if(!$flagdetallartipofall){ echo $sbreg[tipfalnombre];}else{ echo
$tipfalnombre;} ?>" onFocus="if (!agree)this.blur();" ></td>
             </tr>
             <tr> 
 <td width="25%">Descripci&oacute;n</td> 
  <td width="25%" rowspan="2"> 
    <textarea name="tipfaldescri" rows="3" wrap="VIRTUAL" onFocus="if (!agree)this.blur();"><?php 
    if(!$flagdetallartipofall){ echo $sbreg[tipfaldescri];}else{ echo
$tipfaldescri;} ?>
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
onclick="form1.action='maestabltipofall.php';"  width="86" height="18" 
alt="Aceptar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagdetallartipofall" value="1"> 
<input type="hidden" name="acciondetallartipofall"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 
