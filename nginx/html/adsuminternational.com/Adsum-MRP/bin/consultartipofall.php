<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
?> 
<html> 
<head> 
<title>Consultar en tipofall</title> 
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
Consultar registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="85%" border="0" cellspacing="0" cellpadding="3" 
align="center"> 
              <tr> 
 <td width="25%">C&oacute;digo</td> 
  <td width="25%"> 
   <input type="text" name="tipfalcodigo"	value="<?php 
if(!$flagconsultartipofall){ echo $sbreg[tipfalcodigo];}else{ echo 
$tipfalcodigo;} ?>"> 
  </td> 
  </tr> 
              <tr>
                <td>Nombre</td>
                <td><input type="text" name="tipfalnombre"	value="<?php 
if(!$flagconsultartipofall){ echo $sbreg[tipfalnombre];}else{ echo 
$tipfalnombre;} ?>"></td>
              </tr>
              <tr> 
 <td width="25%">Descripci&oacute;n</td> 
  <td width="25%" rowspan="2"> 
    <textarea name="tipfaldescri" rows="3" wrap="VIRTUAL"><?php 
if(!$flagconsultartipofall){ echo $sbreg[tipfaldescri];}else{ echo 
$tipfaldescri;} ?></textarea> 
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
onclick="form1.accionconsultartipofall.value =  1; 
form1.action='maestabltipofall.php';"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestabltipofall.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagconsultartipofall" value="1"> 
<input type="hidden" name="accionconsultartipofall"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="columnas" value="tipfalcodigo, 
tipfalnombre, 
tipfaldescri, 
exmempinifec, 
cursoconten, 
cursofecha, 
cursohora, 
cursoubicac, 
proveeurl, 
proveeemail, 
proveenota 
"> 
<input type="hidden" name="nombtabl" value="tipofall"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
