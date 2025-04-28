<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andr�s A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Consultar en departamento</title> 
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
<p><font class="NoiseFormHeaderFont">Departamento</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Consultar departamento</font></span></td></tr> 
<tr> 
  <td> 
            <table width="85%" border="0" cellspacing="0" cellpadding="3" 
align="center"> 
<tr> 
 <td width="41%" class="NoiseFooterTD">C&oacute;digo</td> 
 <td width="59%" class="NoiseFooterTD"> 
  <input type="text" name="departcodigo" value="<?php 
if(!$flagconsultardepartamento){ echo $sbreg[departcodigo];}else{ echo 
$departcodigo; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%" class="NoiseFooterTD">Nombre</td> 
 <td width="59%" class="NoiseFooterTD"> 
  <input type="text" name="departnombre" value="<?php 
if(!$flagconsultardepartamento){ echo $sbreg[departnombre];}else{ echo 
$departnombre; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%" class="NoiseFooterTD">Descripci&oacute;n</td> 
 <td width="59%" class="NoiseFooterTD"> 
  <textarea name="departdescri"	cols="24" wrap="VIRTUAL" rows="3"><?php 
if(!$flagconsultardepartamento){ echo $sbreg[departdescri];}else{ echo $departdescri; }?></textarea>
</td> 
 </tr> 
</table> 
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionconsultardepartamento.value =  
1;form1.action='maestabldepartamento.php';"  width="86" height="18" 
alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestabldepartamento.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagconsultardepartamento" value="1"> 
<input type="hidden" name="accionconsultardepartamento"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="columnas" value="departcodigo, 
departnombre, 
departdescri 
"> 
<input type="hidden" name="nombtabl" value="departamento"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
