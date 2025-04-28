<?php 
ob_start(); 
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktblmedidoequipo.php');
include ( '../src/FunPerPriNiv/pktblequipo.php');
include ( '../src/FunPerPriNiv/pktbltipomedi.php');
if($accioneditarmedicion) 
{ 
	include ( 'editamedicion.php'); 
	$flageditarmedicion = 1; 
} 
ob_end_flush(); 
if(!$flageditarmedicion) 
{ 
include ( '../src/FunGen/sesion/fnccarga.php'); 
$sbreg = fnccarga($nombtabl,$radiobutton); 
if (!$sbreg) 
	{ 
		include( '../src/FunGen/fnccontfron.php'); 
	} 
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
<title>Editar registro de medicion</title> 
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
<p><font class="NoiseFormHeaderFont">medicion</font></p> 
<table width="350" border="0" align="center" cellpadding="2" cellspacing="1" 
class="NoiseFormTABLE"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Editar registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="95%" border="0" cellspacing="0" cellpadding="0" 
align="center"> 
<tr> 
 <td width="41%"><?php if($campnomb == "medicicodigo"){$medicicodigo = null; 
echo "*";}?>
C&oacute;digo</td> 
 <td width="59%"> 
  <input type="text" name="medicicodigo"	value="<?php if(!$flageditarmedicion){ 
echo $sbreg[medicicodigo];}else{ echo $medicicodigo; }?>"> </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "medequcodigo"){$medequcodigo = null; 
echo "*";}?>Equipo/Medidor</td> 
 <td width="59%"> 
  <select name="select">
    <?php
     if(!$flagnuevomedicion)
     {
     	echo '<option value = "">Seleccione';
     	$idcon	= fncconn();
		echo '<option selected value ='.$sbreg[medequcodigo];
		$arr= loadrecordmedidoequipo ($sbreg[medequcodigo],$idcon);
		$equiponombre=loadrecordequipo($arr[equipocodigo],$conn);
		echo $equiponombre[equiponombre];
		$tipmednombre=loadrecordtipomedi($arr[tipmedcodigo],$conn);
		echo " / ".$tipmednombre[tipmednombre].'</option>';
		unset($arr);
     	include ('../src/FunGen/floadmedicion.php');
     	$idcon = fncconn();
     	floadmedicion($idcon);
     	fncclose($idcon);
     }
?>
  </select>
</td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "medicicantid"){$medicicantid = null; 
echo "*";}?>Cantidad</td> 
 <td width="59%"> 
  <input type="text" name="medicicantid"	value="<?php if(!$flageditarmedicion){ 
echo $sbreg[medicicantid];}else{ echo $medicicantid; }?>"> </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "medicifecreg"){$medicifecreg = null; 
echo "*";}?>Fecha de registro</td> 
 <td width="59%"> 
  <input type="text" name="medicifecreg"	value="<?php if(!$flageditarmedicion){ 
echo $sbreg[medicifecreg];}else{ echo $medicifecreg; }?>"> </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "usuacodi"){$usuacodi = null; echo 
"*";}?>Usuario</td> 
 <td width="59%"> 
  <input type="text" name="usuacodi"	value="<?php if(!$flageditarmedicion){ 
echo $sbreg[usuacodi];}else{ echo $usuacodi; }?>"> </td> 
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
<input type="image" name="cancelar2" src="../img/ayuda.gif" width="86" 
height="18" alt="Cancelar" border=0> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accioneditarmedicion.value =  1;"  width="86" height="18" 
alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablmedicion.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
<?php 
if($campnomb){echo '<font face = "Verdana" >Corregir los capos marcados con 
*</font>';} 
?> 
<input type="hidden" name="medicicodigo" value="<?php if(!$flageditarmedicion){ 
echo $sbreg[medicicodigo];}else{ echo $medicicodigo; } ?>"> 
<input type="hidden" name="accioneditarmedicion"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
