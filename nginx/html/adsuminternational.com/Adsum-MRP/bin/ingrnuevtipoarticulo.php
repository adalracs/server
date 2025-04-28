<?php 
ob_start(); 
include ( '../src/FunGen/sesion/fncvalses.php'); 
include ( '../src/FunPerPriNiv/pktbllinea.php'); 
include ( '../src/FunPerPriNiv/pktblestado.php');
if($accionnuevotipoarticulo) 
{ 
	include ( 'grabatipoarticulo.php'); 
} 
ob_end_flush(); 
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andrés A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Nuevo registro de tipo de art&iacute;culo</title> 
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
<p><font class="NoiseFormHeaderFont">Tipo de art&iacute;culo</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Ingresar nuevo tipo de art&iacute;culo</font></span></td></tr> 
<tr> 
  <td> 
            <table width="85%" border="0" cellspacing="0" cellpadding="3" 
align="center"> 
<tr> 
 <td width="41%"><?php if($campnomb == "lineacodigo"){$lineacodigo = null; 
echo "*";}?>L&iacute;nea</td>
 <td width="59%">
<select name="lineacodigo">
<?php
if(!$flagnuevotipoarticulo)
{
 echo '<option value="">Seleccione';
}
else if($accionnuevotipoarticulo)
{
	if($lineacodigo)
	{
		echo '<option value="'.$lineacodigo.'">';
		$idcon = fncconn();
		$arrlinea=loadrecordlinea($lineacodigo,$idcon);
		echo $arrlinea[lineanombre];
		fncclose($idcon);
	}
	else
	{
		echo '<option value="">Seleccione';
	}
}
?></OPTION><?php
include ( '../src/FunGen/floadlinea.php');
$idcon = fncconn();
floadlinea($idcon);
fncclose($idcon);
?>
</select>
 </td>
 </tr>
<tr>
 <td width="25%">Estado</td>
 <td width="25%">
<select name="estadocodigo">
<?php
if(!$flagnuevotipoarticulo)
{
 echo '<option value="">Seleccione';
}
else if($accionnuevotipoarticulo)
{
	if($estadocodigo)
	{
		echo '<option value="'.$estadocodigo.'">';
		$idcon = fncconn();
		$arrestado=loadrecordestado($estadocodigo,$idcon);
		echo $arrestado[estadonombre];
		fncclose($idcon);
	}
	else
	{
		echo '<option value="">Seleccione';
	}
}
?></OPTION><?php
include ( '../src/FunGen/floadestado.php');
$idcon = fncconn();
floadestado($idcon);
fncclose($idcon);
?>
</select>
</td>
</tr>
<tr> 
 <td width="41%"><?php if($campnomb == "tipartnombre"){$tipartnombre = null; echo "*";}?>
 Nombre</td> 
 <td width="59%"> 
  <input type="text" name="tipartnombre"	value="<?php 
if(!$flagnuevotipoarticulo){ echo $sbreg[tipartnombre];}else{ echo 
$tipartnombre; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "tipartdescri"){$tipartdescri = null; 
echo "*";}?>Descripci&oacute;n</td> 
 <td width="59%"> 
  <textarea name="tipartdescri" cols="24" wrap="VIRTUAL" rows="3"><?php 
if(!$flagnuevotipoarticulo){ echo $sbreg[tipartdescri];}else{ echo $tipartdescri; }?></textarea>
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
onclick="form1.accionnuevotipoarticulo.value =  1;"  width="86" height="18" 
alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestabltipoarticulo.php';"  width="86" height="18" 
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
<input type="hidden" name="tipartcodigo" value="<?php 
if(!$flagnuevotipoarticulo){ echo $sbreg[tipartcodigo];}else{ echo 
$tipartcodigo; } ?>"> 
<input type="hidden" name="accionnuevotipoarticulo"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
