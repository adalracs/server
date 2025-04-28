<?php 
ob_start(); 
include ( '../src/FunGen/sesion/fncvalses.php'); 
include ( '../src/FunPerPriNiv/pktblestado.php');
if($accioneditartipooferta) 
{ 
	include ( 'editatipooferta.php'); 
	$flageditartipooferta = 1; 
} 
ob_end_flush(); 
if(!$flageditartipooferta) 
{ 
include ( '../src/FunGen/sesion/fnccarga.php'); 
$sbreg = fnccarga($nombtabl,$radiobutton); 
if (!$sbreg) 
	{ 
		include( '../src/FunGen/fnccontfron.php'); 
	} 
	$idcon = fncconn();	
	$varestado = $sbreg[estadocodigo];
	$arrestado= loadrecordestado($varestado,$idcon);
	$codestado = $sbreg[estadocodigo];
	fncclose($idcon);
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
<title>Editar registro de tipo de oferta</title> 
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
<p><font class="NoiseFormHeaderFont">Tipo de oferta</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Editar tipo de oferta</font></span></td></tr> 
<tr> 
  <td> 
            <table width="85%" border="0" cellspacing="0" cellpadding="3" 
align="center"> 
<tr> 
 <td width="41%"><?php if($campnomb == "tipofecodigo"){$tipofecodigo = null; 
echo "*";}?>C&oacute;digo</td> 
 <td width="59%"> 
  <input type="text" name="tipofecodigo" onFocus="if (!agree)this.blur();" value="<?php 
if(!$flageditartipooferta){ echo $sbreg[tipofecodigo];}else{ echo 
$tipofecodigo; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "tipofenombre"){$tipofenombre = null; 
echo "*";}?>Nombre</td> 
 <td width="59%"> 
  <input type="text" name="tipofenombre"	value="<?php 
if(!$flageditartipooferta){ echo $sbreg[tipofenombre];}else{ echo 
$tipofenombre; }?>"> 
 </td> 
 </tr> 
<tr>
 <td width="41%"><?php if($campnomb == "estadocodigo"){$estadocodigo = null; echo
"*";}?>Estado</td>
 <td width="59%">
<select name="estadocodigo">
<?php
if(!$flageditartipooferta)
{
 echo '<option value="'.$codestado.'">';
 echo $arrestado[estadonombre];
}
if($accioneditartipooferta)
{
 echo '<option value="'.$estadocodigo.'">';
 $idcon=fncconn();
 $arrestado = loadrecordestado($estadocodigo,$idcon);
 echo $arrestado[estadonombre];
 $idcon = fncconn();
 fncclose($idcon);}
?></OPTION>
<?php
include ( '../src/FunGen/floadestado.php');
$idcon = fncconn();
floadestado($idcon);
fncclose($idcon);
?>
</select>
 </td>
 </tr>
<tr> 
 <td width="41%"><?php if($campnomb == "tipofedescri"){$tipofedescri = null; 
echo "*";}?>Descripci&oacute;n</td> 
 <td width="59%"> 
  <textarea name="tipofedescri"	cols="24" wrap="VIRTUAL" rows="3"><?php
if(!$flageditartipooferta){ echo $sbreg[tipofedescri];}else{ echo $tipofedescri; }?></textarea></td> 
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
onclick="form1.accioneditartipooferta.value =  1;"  width="86" height="18" 
alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestabltipooferta.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
<a href= "javascript:;"><input type="image" name="cancelar2" src="../img/ayuda.gif" width="86" height="18" alt="Cancelar" border=0></a> 
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
<input type="hidden" name="tipofecodigo" value="<?php 
if(!$flageditartipooferta){ echo $sbreg[tipofecodigo];}else{ echo 
$tipofecodigo; } ?>"> 
<input type="hidden" name="accioneditartipooferta"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
