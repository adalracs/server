<?php 
ob_start(); 
include ( '../src/FunGen/sesion/fncvalses.php'); 
include ( '../src/FunPerPriNiv/pktblestado.php');
include ( '../src/FunPerPriNiv/pktblbarra.php');
if($accionnuevovinculo) 
{ 
	include ( 'grabavinculo.php'); 
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
<title>Nuevo registro de vinculo</title> 
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
<p><font class="NoiseFormHeaderFont">vinculo</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Ingresar nuevo registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="85%" border="0" cellspacing="0" cellpadding="3" 
align="center"> 
<tr>
 <td width="25%">Estado</td>
 <td width="25%">
<select name="estadocodigo">
<?php
if(!$flagnuevovinculo)
{
 echo '<option value="">Seleccione';
}
else if($accionnuevovinculo)
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
 <td width="25%">Barra</td>
 <td width="25%">
<select name="barracodigo">
<?php
if(!$flagnuevovinculo)
{
 echo '<option value="">Seleccione';
}
else if($accionnuevovinculo)
{
	if($barracodigo)
	{
		echo '<option value="'.$barracodigo.'">';
		$idcon = fncconn();
		$arrbarra=loadrecordbarra($barracodigo,$idcon);
		echo $arrbarra[barratitulo];
		fncclose($idcon);
	}
	else
	{
		echo '<option value="">Seleccione';
	}
}
?></OPTION><?php
include ( '../src/FunGen/floadbarra.php');
$idcon = fncconn();
floadbarra($idcon);
fncclose($idcon);
?>
</select>
</td>
</tr>
<tr> 
 <td width="41%"><?php if($campnomb == "vinculnombre"){$vinculnombre = null; 
echo "*";}?>Nombre</td> 
 <td width="59%"> 
  <textarea name="vinculnombre" cols="24" wrap="VIRTUAL" rows="3"><?php 
if(!$flagnuevovinculo){ echo $sbreg[vinculnombre];}else{ echo $vinculnombre; }?></textarea>
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "vinculrefere"){$vinculrefere = null; 
echo "*";}?>Referencia</td> 
 <td width="59%"> 
  <textarea name="vinculrefere" cols="24" wrap="VIRTUAL" rows="3"><?php 
if(!$flagnuevovinculo){ echo $sbreg[vinculrefere];}else{ echo $vinculrefere; }?></textarea>
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "vinculdescri"){$vinculdescri = null; 
echo "*";}?>Descripci&oacute;n</td> 
 <td width="59%"> 
  <textarea name="vinculdescri" cols="24" wrap="VIRTUAL" rows="3"><?php 
if(!$flagnuevovinculo){ echo $sbreg[vinculdescri];}else{ echo $vinculdescri; }?></textarea>
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
onclick="form1.accionnuevovinculo.value =  1;"  width="86" height="18" 
alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablvinculo.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
<input type="image" name="cancelar2" src="../img/ayuda.gif" width="86" 
height="18" alt="Cancelar" border=0> 
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
<input type="hidden" name="vinculcodigo" value="<?php if(!$flagnuevovinculo){ 
echo $sbreg[vinculcodigo];}else{ echo $vinculcodigo; } ?>"> 
<input type="hidden" name="accionnuevovinculo"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
