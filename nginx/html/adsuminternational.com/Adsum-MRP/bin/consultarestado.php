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
<title>Consultar en estado</title> 
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
<p><font class="NoiseFormHeaderFont">Estado</font></p> 
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
                <td width="41%"></td> 
<td width="59%"> 
</tr> 
<tr> 
 <td width="41%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
 <td width="59%" class="NoiseDataTD"> 
  <input type="text" name="estadocodigo"	value="<?php 
if(!$flagconsultarestado){ echo $sbreg[estadocodigo];}?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%" class="NoiseFooterTD">&nbsp;Nombre</td> 
 <td width="59%" class="NoiseDataTD"> 
  <input type="text" name="estadonombre"	value="<?php 
if(!$flagconsultarestado){ echo $sbreg[estadonombre];}?>"> 
 </td> 
 </tr> 
 <tr> 
 <td width="41%" class="NoiseFooterTD">&nbsp;Tipo</td> 
 <td width="59%" class="NoiseDataTD"> 
 <select name="estadotipo">
 	<option value="">-- Seleccione --</option>
 	<option value="1" <?php if($estadotipo == 1) echo 'selected' ?>>Activo</option>
 	<option value="0" <?php if($estadotipo == '0') echo 'selected' ?>>Inactivo</option>
 	<option value="2" <?php if($estadotipo == 2) echo 'selected' ?>>De Baja</option>
 	</select>
 	</td>
 </tr> 
<tr> 
 <td width="41%" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td> 
 <td width="59%" rowspan="2" class="NoiseDataTD"> 
   <textarea name="estadodescri" rows="3" wrap="VIRTUAL"><?php 
if(!$flagconsultarestado){ echo $sbreg[estadodescri];}?></textarea> 
 </td> 
 </tr>
<tr class="NoiseFooterTD">
  <td>&nbsp;</td>
</tr> 
</table> 
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionconsultarestado.value =  
1;form1.action='maestablestado.php';"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablestado.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagconsultarestado" value="1"> 
<input type="hidden" name="accionconsultarestado"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="columnas" value="estadocodigo, 
estadonombre, 
estadodescri,
estadotipo 
"> 
<input type="hidden" name="nombtabl" value="estado"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
