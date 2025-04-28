<?php 
ob_start(); 
include ( '../src/FunGen/sesion/fncvalses.php');
 
if($accionnuevodepartamento) 
{ 
	include ( 'grabadepartamento.php'); 
} 
ob_end_flush(); 
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andr�s A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Nuevo registro de departamento</title> 
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
Ingresar Nuevo Departamento</font></span></td></tr> 
<tr> 
  <td> 
            <table width="85%" border="0" cellspacing="1" cellpadding="3" 
align="center"> 
<tr> 
<td width="41%" class="NoiseFooterTD"><?php if($campnomb["deptonombre"] == 1){$deptonombre = null; echo "*";} ?>&nbsp;Nombre</td> 
<td width="59%" class="NoiseFooterTD"><input type="text" name="deptonombre" size="18" value="<?php if(!$flagnuevodepartamento){ echo $sbreg[deptonombre];}else{ echo $deptonombre; }?>"></td> 
 </tr> 
<tr> 
 <td width="41%" class="NoiseFooterTD"><?php if($campnomb == "deptodescri"){$deptodescri = null; 
echo "*";}?>Descripci&oacute;n</td> 
 <td width="59%" class="NoiseFooterTD"> 
  <textarea name="deptodescri"	cols="17" wrap="VIRTUAL" rows="2"><?php 
if(!$flagnuevodepartamento){ echo $sbreg[deptodescri];}else{ echo $deptodescri; }?></textarea>
</td> 
 </tr> 
</table> 
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionnuevodepartamento.value =  1;"  width="86" height="18" 
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
<?php 
if($campnomb){echo '<font face = "Verdana" >Corregir los campos marcados con 
*</font>';} 
?> 
<input type="hidden" name="deptocodigo" value="<?php 
if(!$flagnuevodepartamento){ echo $sbreg[deptocodigo];}else{ echo 
$deptocodigo; } ?>"> 
<input type="hidden" name="accionnuevodepartamento"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
