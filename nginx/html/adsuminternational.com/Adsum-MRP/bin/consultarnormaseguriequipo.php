<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andr�s A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Consultar en Norma de deguridad</title> 
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
<p><font class="NoiseFormHeaderFont">Norma de seguridad</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td width="430" class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Consultar registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="99%" border="0" cellspacing="0" cellpadding="0" 
align="center"> 
<tr> 
 <td width="20%">C&oacute;digo</td> 
 <td width="80%"> 
  <input type="text" name="norsegcodigo" value="<?php if(!$flagconsultarnormaseguri){ echo $sbreg[norsegcodigo];}else{ echo $norsegcodigo; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="20%">Nombre</td> 
 <td width="80%"> 
  <input type="text" name="norsegnombre" value="<?php if(!$flagconsultarnormaseguri){ echo $sbreg[norsegnombre];}else{ echo $norsegnombre; }?>" size="40"> 
 </td> 
 </tr> 
<tr> 
 <td width="20%">Descripci&oacute;n</td> 
 <td width="80%" rowspan="2"> 
  <textarea name="norsegdescri" rows="3" cols="45" wrap="VIRTUAL"><?php if(!$flagconsultarnormaseguri){ echo $sbreg[norsegdescri];}else{ echo $norsegdescri; }?></textarea> 
 </td> 
 </tr> 
 <tr> 
  <td colspan="2">&nbsp;</td> 
 </tr> 
</table> 
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionconsultarnormaseguriequipo.value =  
1;form1.action='maestablnormaseguriequipo.php';"  width="86" height="18" 
alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="window.close();"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagconsultarnormaseguri" value="1"> 
<input type="hidden" name="accionconsultarnormaseguriequipo"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="columnas" value="norsegcodigo, 
norsegnombre, 
norsegdescri 
"> 
<input type="hidden" name="nombtabl" value="normaseguri"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
