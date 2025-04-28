<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andr�s A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Consultar en tipoequipo</title> 
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
<p><font class="NoiseFormHeaderFont">Tipo de equipo</font></p> 
<table width="350" border="0" align="center" cellpadding="2" cellspacing="1" 
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
            <table width="85%" border="0" cellspacing="1" cellpadding="0" 
align="center"> 
              <tr> 
                <td width="41%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
<td width="59%" class="NoiseDataTD"> 
<input type="text" name="tipequcodigo" value="<?php 
if(!$flagconsultartipoequipo){ echo $sbreg[tipequcodigo];}else{ echo 
$tipequcodigo; } ?>">
</td> 
</tr>
<tr> 
 <td width="41%" class="NoiseFooterTD">&nbsp;Nombre</td> 
 <td width="59%" class="NoiseDataTD">
  <input type="text" name="tipequnombre"	value="<?php 
if(!$flagconsultartipoequipo){ echo $sbreg[tipequnombre];}else{ echo 
$tipequnombre; }?>"> 
 </td> 
 </tr>
<tr> 
 <td width="41%" class="NoiseFooterTD">&nbsp;Acr&oacute;nimo</td> 
 <td width="59%" class="NoiseDataTD">
  <input type="text" name="tipequacroni"	value="<?php 
if(!$flagconsultartipoequipo){ echo $sbreg[tipequacroni];}else{ echo 
$tipequacroni; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td> 
 <td width="59%" rowspan="2" class="NoiseDataTD"><textarea rows="3" name="tipequdescri" wrap="VIRTUAL"><?php 
if(!$flagconsultartipoequipo){ echo $sbreg[tipequdescri];}else{ echo 
$tipequdescri; }?></textarea>
 </td> 
 </tr>
  <tr class="NoiseFooterTD"> 
  <td width="41%">&nbsp;</td> 
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
onclick="form1.accionconsultartipoequipo.value =  
1;form1.action='maestabltipoequipoaux.php';"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="self.close();"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagconsultartipoequipo" value="1"> 
<input type="hidden" name="accionconsultartipoequipo"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="columnas" value="tipequcodigo, 
tipequnombre, 
tipequdescri, 
tipequcampo,
tipequacroni
"> 
<input type="hidden" name="nombtabl" value="tipoequipo"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 