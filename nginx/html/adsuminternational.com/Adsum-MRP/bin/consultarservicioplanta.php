<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andrés A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Consultar en servicio</title> 
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
<p><font class="NoiseFormHeaderFont">Servicio</font></p> 
<table width="450" border="0" align="center" cellpadding="0" cellspacing="0" 
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
<td class="NoiseDataTD">&nbsp;C&oacute;digo</td> 
<td><input type="text" name="servicicodigo" size="10" value="<?php 
if(!$flagconsultarservicio){ echo $sbreg[servicicodigo];}else{ echo 
$servicicodigo; } ?>"></td>
</tr>
<tr> 
 <td class="NoiseDataTD"><?php if($campnomb["negocicodigo"] == 1){$negocicodigo = null; 
echo "*";}?>
   <input name="opnNegocio" type="button" onClick="window.open('consultarnegocioservicio.php?codigo=<?php echo $codigo?>','ventana_aux','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" value="Buscar negocio" <?php if(($flagconsultarservicio) && ($negocicodigo))echo "checked";?>></td>
<td><input type="text" size="10" name="negocicodigo" value="<?php if(!$flagconsultarservicio){ 
echo $sbreg[negocicodigo];}else{ echo $negocicodigo;} ?>" onFocus="if(!agree)this.blur();">  <input type="text" name="negocinombre" value="<?php if(!$flagconsultarservicio){ 
echo $sbreg[negocinombre];}else{ echo $negocinombre;} ?>" onFocus="if(!agree)this.blur();" size="20">  </td>
</tr>
<tr> 
 <td class="NoiseDataTD">&nbsp;Nombre</td> 
 <td><input type="text" name="servicinombre" value="<?php 
if(!$flagconsultarservicio){ echo $sbreg[servicinombre];}else{ echo 
$servicinombre;}?>"></td>
 </tr> 
<tr> 
 <td class="NoiseDataTD">&nbsp;Descripci&oacute;n</td>
 <td rowspan="2"><textarea name="servicidescri" cols="40" rows="3"><?php 
if(!$flagconsultarservicio){ echo $sbreg[servicidescri];}else{ echo 
$servicidescri;} ?>
 </textarea></td>
 </tr>
<tr class="NoiseDataTD">
  <td>&nbsp;</td>
</tr> 
</table> 
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center">  
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionconsultarservicioplanta.value =  
1;form1.action='maestablservicioplanta.php';"  width="86" height="18" alt="Aceptar" 
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
 <input type="hidden" name="flagconsultarservicio" value="1"> 
<input type="hidden" name="accionconsultarservicioplanta"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="columnas" value="
servicicodigo, 
negocicodigo, 
servicinombre, 
servicidescri 
"> 
<input type="hidden" name="nombtabl" value="servicio"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html>