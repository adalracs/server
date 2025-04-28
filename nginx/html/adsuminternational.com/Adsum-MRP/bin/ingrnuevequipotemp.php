<?php 
ob_start(); 
include ( '../src/FunGen/sesion/fncvalses.php'); 
if($accionnuevoequipotemp) 
{ 
	include ( 'grabaequipotemp.php'); 
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
<title>Nuevo registro de equipotemp</title> 
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
<p><font class="NoiseFormHeaderFont">equipotemp</font></p> 
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
            <table width="85%" border="0" cellspacing="0" cellpadding="0" 
align="center"> 
<tr> 
 <td width="25%"><?php if($campnomb == "equtemcodigo"){$equtemcodigo = null; 
echo "*";}?>equtemcodigo</td> 
 <td width="25%"> 
  <input type="text" name="equtemcodigo"	value="<?php 
if(!$flagnuevoequipotemp){ echo $sbreg[equtemcodigo];}else{ echo $equtemcodigo; 
}?>"> 
 </td> 
 <td width="25%"><?php if($campnomb == "estadocodigo"){$estadocodigo = null; 
echo "*";}?>estadocodigo</td> 
 <td width="25%"> 
  <input type="text" name="estadocodigo"	value="<?php 
if(!$flagnuevoequipotemp){ echo $sbreg[estadocodigo];}else{ echo $estadocodigo; 
}?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="25%"><?php if($campnomb == "sistemcodigo"){$sistemcodigo = null; 
echo "*";}?>sistemcodigo</td> 
 <td width="25%"> 
  <input type="text" name="sistemcodigo"	value="<?php 
if(!$flagnuevoequipotemp){ echo $sbreg[sistemcodigo];}else{ echo $sistemcodigo; 
}?>"> 
 </td> 
 <td width="25%"><?php if($campnomb == "cencoscodigo"){$cencoscodigo = null; 
echo "*";}?>cencoscodigo</td> 
 <td width="25%"> 
  <input type="text" name="cencoscodigo"	value="<?php 
if(!$flagnuevoequipotemp){ echo $sbreg[cencoscodigo];}else{ echo $cencoscodigo; 
}?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="25%"><?php if($campnomb == "equtemnombre"){$equtemnombre = null; 
echo "*";}?>equtemnombre</td> 
 <td width="25%"> 
  <input type="text" name="equtemnombre"	value="<?php 
if(!$flagnuevoequipotemp){ echo $sbreg[equtemnombre];}else{ echo $equtemnombre; 
}?>"> 
 </td> 
 <td width="25%"><?php if($campnomb == "equtemdescri"){$equtemdescri = null; 
echo "*";}?>equtemdescri</td> 
 <td width="25%"> 
  <input type="text" name="equtemdescri"	value="<?php 
if(!$flagnuevoequipotemp){ echo $sbreg[equtemdescri];}else{ echo $equtemdescri; 
}?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="25%"><?php if($campnomb == "equtemfabric"){$equtemfabric = null; 
echo "*";}?>equtemfabric</td> 
 <td width="25%"> 
  <input type="text" name="equtemfabric"	value="<?php 
if(!$flagnuevoequipotemp){ echo $sbreg[equtemfabric];}else{ echo $equtemfabric; 
}?>"> 
 </td> 
 <td width="25%"><?php if($campnomb == "equtemmarca"){$equtemmarca = null; echo 
"*";}?>equtemmarca</td> 
 <td width="25%"> 
  <input type="text" name="equtemmarca"	value="<?php if(!$flagnuevoequipotemp){ 
echo $sbreg[equtemmarca];}else{ echo $equtemmarca; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="25%"><?php if($campnomb == "equtemmodelo"){$equtemmodelo = null; 
echo "*";}?>equtemmodelo</td> 
 <td width="25%"> 
  <input type="text" name="equtemmodelo"	value="<?php 
if(!$flagnuevoequipotemp){ echo $sbreg[equtemmodelo];}else{ echo $equtemmodelo; 
}?>"> 
 </td> 
 <td width="25%"><?php if($campnomb == "equtemserie"){$equtemserie = null; echo 
"*";}?>equtemserie</td> 
 <td width="25%"> 
  <input type="text" name="equtemserie"	value="<?php if(!$flagnuevoequipotemp){ 
echo $sbreg[equtemserie];}else{ echo $equtemserie; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="25%"><?php if($campnomb == "equtemlargo"){$equtemlargo = null; echo 
"*";}?>equtemlargo</td> 
 <td width="25%"> 
  <input type="text" name="equtemlargo"	value="<?php if(!$flagnuevoequipotemp){ 
echo $sbreg[equtemlargo];}else{ echo $equtemlargo; }?>"> 
 </td> 
 <td width="25%"><?php if($campnomb == "equtemancho"){$equtemancho = null; echo 
"*";}?>equtemancho</td> 
 <td width="25%"> 
  <input type="text" name="equtemancho"	value="<?php if(!$flagnuevoequipotemp){ 
echo $sbreg[equtemancho];}else{ echo $equtemancho; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="25%"><?php if($campnomb == "equtemalto"){$equtemalto = null; echo 
"*";}?>equtemalto</td> 
 <td width="25%"> 
  <input type="text" name="equtemalto"	value="<?php if(!$flagnuevoequipotemp){ 
echo $sbreg[equtemalto];}else{ echo $equtemalto; }?>"> 
 </td> 
 <td width="25%"><?php if($campnomb == "equtempeso"){$equtempeso = null; echo 
"*";}?>equtempeso</td> 
 <td width="25%"> 
  <input type="text" name="equtempeso"	value="<?php if(!$flagnuevoequipotemp){ 
echo $sbreg[equtempeso];}else{ echo $equtempeso; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="25%"><?php if($campnomb == "equtemvolta"){$equtemvolta = null; echo 
"*";}?>equtemvolta</td> 
 <td width="25%"> 
  <input type="text" name="equtemvolta"	value="<?php if(!$flagnuevoequipotemp){ 
echo $sbreg[equtemvolta];}else{ echo $equtemvolta; }?>"> 
 </td> 
 <td width="25%"><?php if($campnomb == "equtemcorrie"){$equtemcorrie = null; 
echo "*";}?>equtemcorrie</td> 
 <td width="25%"> 
  <input type="text" name="equtemcorrie"	value="<?php 
if(!$flagnuevoequipotemp){ echo $sbreg[equtemcorrie];}else{ echo $equtemcorrie; 
}?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="25%"><?php if($campnomb == "equtempoten"){$equtempoten = null; echo 
"*";}?>equtempoten</td> 
 <td width="25%"> 
  <input type="text" name="equtempoten"	value="<?php if(!$flagnuevoequipotemp){ 
echo $sbreg[equtempoten];}else{ echo $equtempoten; }?>"> 
 </td> 
 <td width="25%"><?php if($campnomb == "equtemfeccom"){$equtemfeccom = null; 
echo "*";}?>equtemfeccom</td> 
 <td width="25%"> 
  <input type="text" name="equtemfeccom"	value="<?php 
if(!$flagnuevoequipotemp){ echo $sbreg[equtemfeccom];}else{ echo $equtemfeccom; 
}?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="25%"><?php if($campnomb == "equtemcinv"){$equtemcinv = null; echo 
"*";}?>equtemcinv</td> 
 <td width="25%"> 
  <input type="text" name="equtemcinv"	value="<?php if(!$flagnuevoequipotemp){ 
echo $sbreg[equtemcinv];}else{ echo $equtemcinv; }?>"> 
 </td> 
 <td width="25%"><?php if($campnomb == "equtemvengar"){$equtemvengar = null; 
echo "*";}?>equtemvengar</td> 
 <td width="25%"> 
  <input type="text" name="equtemvengar"	value="<?php 
if(!$flagnuevoequipotemp){ echo $sbreg[equtemvengar];}else{ echo $equtemvengar; 
}?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="25%"><?php if($campnomb == "equtemviduti"){$equtemviduti = null; 
echo "*";}?>equtemviduti</td> 
 <td width="25%"> 
  <input type="text" name="equtemviduti"	value="<?php 
if(!$flagnuevoequipotemp){ echo $sbreg[equtemviduti];}else{ echo $equtemviduti; 
}?>"> 
 </td> 
 <td width="25%"><?php if($campnomb == "equtemfecins"){$equtemfecins = null; 
echo "*";}?>equtemfecins</td> 
 <td width="25%"> 
  <input type="text" name="equtemfecins"	value="<?php 
if(!$flagnuevoequipotemp){ echo $sbreg[equtemfecins];}else{ echo $equtemfecins; 
}?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="25%"><?php if($campnomb == "equtemubicac"){$equtemubicac = null; 
echo "*";}?>equtemubicac</td> 
 <td width="25%"> 
  <input type="text" name="equtemubicac"	value="<?php 
if(!$flagnuevoequipotemp){ echo $sbreg[equtemubicac];}else{ echo $equtemubicac; 
}?>"> 
 </td> 
 <td width="25%"><?php if($campnomb == "equtemvalhor"){$equtemvalhor = null; 
echo "*";}?>equtemvalhor</td> 
 <td width="25%"> 
  <input type="text" name="equtemvalhor"	value="<?php 
if(!$flagnuevoequipotemp){ echo $sbreg[equtemvalhor];}else{ echo $equtemvalhor; 
}?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="25%"><?php if($campnomb == "equtemnohs"){$equtemnohs = null; echo 
"*";}?>equtemnohs</td> 
 <td width="25%"> 
  <input type="text" name="equtemnohs"	value="<?php if(!$flagnuevoequipotemp){ 
echo $sbreg[equtemnohs];}else{ echo $equtemnohs; }?>"> 
 </td> 
 <td width="25%"><?php if($campnomb == "equtemacti"){$equtemacti = null; echo 
"*";}?>equtemacti</td> 
 <td width="25%"> 
  <input type="text" name="equtemacti"	value="<?php if(!$flagnuevoequipotemp){ 
echo $sbreg[equtemacti];}else{ echo $equtemacti; }?>"> 
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
<input type="image" name="cancelar2" src="../img/ayuda.gif" width="86" 
height="18" alt="Cancelar" border=0> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionnuevoequipotemp.value =  1;"  width="86" height="18" 
alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablequipotemp.php';"  width="86" height="18" 
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
<input type="hidden" name="equtemcodigo" value="<?php 
if(!$flagnuevoequipotemp){ echo $sbreg[equtemcodigo];}else{ echo $equtemcodigo; 
} ?>"> 
<input type="hidden" name="accionnuevoequipotemp"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
