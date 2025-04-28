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
<title>Consultar en soliservestado</title> 
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
<p><font class="NoiseFormHeaderFont">Estados de Solicitud de Servicio</font></p> 
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
                <td width="41%">C&oacute;digo</td> 
<td width="59%"> 
<input type="text" name="estsolcodigo" value="<?php if(!$flagconsultarsoliservestado){ echo $sbreg[estsolcodigo];}?>"> 
</td> 
</tr> 
<tr> 
 <td width="41%">Nombre</td> 
 <td width="59%"> 
  <input type="text" name="estsolnombre"	value="<?php 
if(!$flagconsultarsoliservestado){ echo $sbreg[estsolnombre];}?>"> 
 </td> 
 </tr> 
  <tr> 
 <td width="41%">Tipo</td> 
 <td width="59%"> 
<select name="estsoltipo">
            <option value = "">Seleccione</OPTION>
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
            </select> </td> 
 </tr> 
<tr> 
 <td width="41%">Descripci&oacute;n	</td> 
 <td width="59%"> 
  <textarea name="estsoldescri" rows="3" wrap="VIRTUAL"><?php if(!$flagconsultarsoliservestado){ echo $sbreg[estsoldescri];}?></textarea> 
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
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionconsultarsoliservestado.value = 1;form1.action='maestablsoliservestado.php';"  width="86" height="18" alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablsoliservestado.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagconsultarsoliservestado" value="1"> 
<input type="hidden" name="accionconsultarsoliservestado"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="columnas" value="estsolcodigo, 
estsolnombre, 
estsoldescri, 
estsoltipo 
"> 
<input type="hidden" name="nombtabl" value="soliservestado"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
