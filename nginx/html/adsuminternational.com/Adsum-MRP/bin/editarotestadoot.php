<?php 
ob_start(); 
include ( '../src/FunGen/sesion/fncvalses.php'); 
if($accioneditarotestadoot) 
{ 
	include ( 'editaotestadoot.php'); 
	$flageditarotestadoot = 1; 
} 
ob_end_flush(); 
if(!$flageditarotestadoot) 
{ 
include ( '../src/FunGen/sesion/fnccarga.php'); 
$sbreg = fnccarga($nombtabl,$radiobutton); 
if (!$sbreg) 
	{ 
		include( '../src/FunGen/fnccontfron.php'); 
	} 
} 
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andrés A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Editar registro de otestadoot</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<SCRIPT LANGUAGE="JavaScript"> 
<!-- Begin 
agree = 0; 
//  End --> 
</script> 
</head> 
<?php 
    if(!$codigo) 
    { echo "<!--";} 
?> 
<body bgcolor="FFFFFF" text="#000000"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">otestadoot</font></p> 
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
            <table width="85%" border="0" cellspacing="0" cellpadding="0" 
align="center"> 
<tr> 
 <td width="41%"><?php if($campnomb == "otestcodigo"){$otestcodigo = null; echo 
"*";}?>otestcodigo</td> 
 <td width="59%"> 
  <input type="text" name="otestcodigo"	value="<?php 
if(!$flageditarotestadoot){ echo $sbreg[otestcodigo];}else{ echo $otestcodigo; 
}?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "ordtracodigo"){$ordtracodigo = null; 
echo "*";}?>ordtracodigo</td> 
 <td width="59%"> 
  <input type="text" name="ordtracodigo"	value="<?php 
if(!$flageditarotestadoot){ echo $sbreg[ordtracodigo];}else{ echo 
$ordtracodigo; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "otestacodigo"){$otestacodigo = null; 
echo "*";}?>otestacodigo</td> 
 <td width="59%"> 
  <input type="text" name="otestacodigo"	value="<?php 
if(!$flageditarotestadoot){ echo $sbreg[otestacodigo];}else{ echo 
$otestacodigo; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "otestorigen"){$otestorigen = null; echo 
"*";}?>otestorigen</td> 
 <td width="59%"> 
  <input type="text" name="otestorigen"	value="<?php 
if(!$flageditarotestadoot){ echo $sbreg[otestorigen];}else{ echo $otestorigen; 
}?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "otestfecini"){$otestfecini = null; echo 
"*";}?>otestfecini</td> 
 <td width="59%"> 
  <input type="text" name="otestfecini"	value="<?php 
if(!$flageditarotestadoot){ echo $sbreg[otestfecini];}else{ echo $otestfecini; 
}?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "otesthorini"){$otesthorini = null; echo 
"*";}?>otesthorini</td> 
 <td width="59%"> 
  <input type="text" name="otesthorini"	value="<?php 
if(!$flageditarotestadoot){ echo $sbreg[otesthorini];}else{ echo $otesthorini; 
}?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "otestfecfin"){$otestfecfin = null; echo 
"*";}?>otestfecfin</td> 
 <td width="59%"> 
  <input type="text" name="otestfecfin"	value="<?php 
if(!$flageditarotestadoot){ echo $sbreg[otestfecfin];}else{ echo $otestfecfin; 
}?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "otesthorfin"){$otesthorfin = null; echo 
"*";}?>otesthorfin</td> 
 <td width="59%"> 
  <input type="text" name="otesthorfin"	value="<?php 
if(!$flageditarotestadoot){ echo $sbreg[otesthorfin];}else{ echo $otesthorfin; 
}?>"> 
 </td> 
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
<input type="image" name="cancelar2" src="../img/ayuda.gif" width="86" 
height="18" alt="Cancelar" border=0> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accioneditarotestadoot.value =  1;"  width="86" height="18" 
alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablotestadoot.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
<?php 
if($campnomb){echo '<font face = "Verdana" >Corregir los capos marcados con 
*</font>}';} 
?> 
<input type="hidden" name="otestcodigo" value="<?php 
if(!$flageditarotestadoot){ echo $sbreg[otestcodigo];}else{ echo $otestcodigo; 
} ?>"> 
<input type="hidden" name="accioneditarotestadoot"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
