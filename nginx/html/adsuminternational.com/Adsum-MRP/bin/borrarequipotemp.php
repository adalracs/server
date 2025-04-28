<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
if(!$flagborrarequipotemp) 
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
<title>Borrar registro de equipotemp</title> 
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
Borrar registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="85%" border="0" cellspacing="0" cellpadding="0" 
align="center"> 
              <tr> 
                <td width="41%">equtemcodigo</td> 
<td width="59%"> 
<input type="text" name="equtemcodigo" value="<?php if(!$flagborrarequipotemp){ 
echo $sbreg[equtemcodigo];}else{ echo $equtemcodigo; } ?>"> 
</td> 
</tr> 
<tr> 
 <td width="25%">equtemcodigo</td> 
 <td width="25%"> 
  <input type="text" name="equtemcodigo" value="<?php 
if(!$flagborrarequipotemp){ echo $sbreg[equtemcodigo];}else{ echo 
$equtemcodigo; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 <td width="25%">estadocodigo</td> 
 <td width="25%"> 
  <input type="text" name="estadocodigo" value="<?php 
if(!$flagborrarequipotemp){ echo $sbreg[estadocodigo];}else{ echo 
$estadocodigo; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="25%">sistemcodigo</td> 
 <td width="25%"> 
  <input type="text" name="sistemcodigo" value="<?php 
if(!$flagborrarequipotemp){ echo $sbreg[sistemcodigo];}else{ echo 
$sistemcodigo; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 <td width="25%">cencoscodigo</td> 
 <td width="25%"> 
  <input type="text" name="cencoscodigo" value="<?php 
if(!$flagborrarequipotemp){ echo $sbreg[cencoscodigo];}else{ echo 
$cencoscodigo; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="25%">equtemnombre</td> 
 <td width="25%"> 
  <input type="text" name="equtemnombre" value="<?php 
if(!$flagborrarequipotemp){ echo $sbreg[equtemnombre];}else{ echo 
$equtemnombre; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 <td width="25%">equtemdescri</td> 
 <td width="25%"> 
  <input type="text" name="equtemdescri" value="<?php 
if(!$flagborrarequipotemp){ echo $sbreg[equtemdescri];}else{ echo 
$equtemdescri; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="25%">equtemfabric</td> 
 <td width="25%"> 
  <input type="text" name="equtemfabric" value="<?php 
if(!$flagborrarequipotemp){ echo $sbreg[equtemfabric];}else{ echo 
$equtemfabric; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 <td width="25%">equtemmarca</td> 
 <td width="25%"> 
  <input type="text" name="equtemmarca" value="<?php 
if(!$flagborrarequipotemp){ echo $sbreg[equtemmarca];}else{ echo $equtemmarca; 
} ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="25%">equtemmodelo</td> 
 <td width="25%"> 
  <input type="text" name="equtemmodelo" value="<?php 
if(!$flagborrarequipotemp){ echo $sbreg[equtemmodelo];}else{ echo 
$equtemmodelo; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 <td width="25%">equtemserie</td> 
 <td width="25%"> 
  <input type="text" name="equtemserie" value="<?php 
if(!$flagborrarequipotemp){ echo $sbreg[equtemserie];}else{ echo $equtemserie; 
} ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="25%">equtemlargo</td> 
 <td width="25%"> 
  <input type="text" name="equtemlargo" value="<?php 
if(!$flagborrarequipotemp){ echo $sbreg[equtemlargo];}else{ echo $equtemlargo; 
} ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 <td width="25%">equtemancho</td> 
 <td width="25%"> 
  <input type="text" name="equtemancho" value="<?php 
if(!$flagborrarequipotemp){ echo $sbreg[equtemancho];}else{ echo $equtemancho; 
} ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="25%">equtemalto</td> 
 <td width="25%"> 
  <input type="text" name="equtemalto" value="<?php if(!$flagborrarequipotemp){ 
echo $sbreg[equtemalto];}else{ echo $equtemalto; } ?>" onFocus="if 
(!agree)this.blur();" > 
 </td> 
 <td width="25%">equtempeso</td> 
 <td width="25%"> 
  <input type="text" name="equtempeso" value="<?php if(!$flagborrarequipotemp){ 
echo $sbreg[equtempeso];}else{ echo $equtempeso; } ?>" onFocus="if 
(!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="25%">equtemvolta</td> 
 <td width="25%"> 
  <input type="text" name="equtemvolta" value="<?php 
if(!$flagborrarequipotemp){ echo $sbreg[equtemvolta];}else{ echo $equtemvolta; 
} ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 <td width="25%">equtemcorrie</td> 
 <td width="25%"> 
  <input type="text" name="equtemcorrie" value="<?php 
if(!$flagborrarequipotemp){ echo $sbreg[equtemcorrie];}else{ echo 
$equtemcorrie; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="25%">equtempoten</td> 
 <td width="25%"> 
  <input type="text" name="equtempoten" value="<?php 
if(!$flagborrarequipotemp){ echo $sbreg[equtempoten];}else{ echo $equtempoten; 
} ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 <td width="25%">equtemfeccom</td> 
 <td width="25%"> 
  <input type="text" name="equtemfeccom" value="<?php 
if(!$flagborrarequipotemp){ echo $sbreg[equtemfeccom];}else{ echo 
$equtemfeccom; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="25%">equtemcinv</td> 
 <td width="25%"> 
  <input type="text" name="equtemcinv" value="<?php if(!$flagborrarequipotemp){ 
echo $sbreg[equtemcinv];}else{ echo $equtemcinv; } ?>" onFocus="if 
(!agree)this.blur();" > 
 </td> 
 <td width="25%">equtemvengar</td> 
 <td width="25%"> 
  <input type="text" name="equtemvengar" value="<?php 
if(!$flagborrarequipotemp){ echo $sbreg[equtemvengar];}else{ echo 
$equtemvengar; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="25%">equtemviduti</td> 
 <td width="25%"> 
  <input type="text" name="equtemviduti" value="<?php 
if(!$flagborrarequipotemp){ echo $sbreg[equtemviduti];}else{ echo 
$equtemviduti; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 <td width="25%">equtemfecins</td> 
 <td width="25%"> 
  <input type="text" name="equtemfecins" value="<?php 
if(!$flagborrarequipotemp){ echo $sbreg[equtemfecins];}else{ echo 
$equtemfecins; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="25%">equtemubicac</td> 
 <td width="25%"> 
  <input type="text" name="equtemubicac" value="<?php 
if(!$flagborrarequipotemp){ echo $sbreg[equtemubicac];}else{ echo 
$equtemubicac; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 <td width="25%">equtemvalhor</td> 
 <td width="25%"> 
  <input type="text" name="equtemvalhor" value="<?php 
if(!$flagborrarequipotemp){ echo $sbreg[equtemvalhor];}else{ echo 
$equtemvalhor; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="25%">equtemnohs</td> 
 <td width="25%"> 
  <input type="text" name="equtemnohs" value="<?php if(!$flagborrarequipotemp){ 
echo $sbreg[equtemnohs];}else{ echo $equtemnohs; } ?>" onFocus="if 
(!agree)this.blur();" > 
 </td> 
 <td width="25%">equtemacti</td> 
 <td width="25%"> 
  <input type="text" name="equtemacti" value="<?php if(!$flagborrarequipotemp){ 
echo $sbreg[equtemacti];}else{ echo $equtemacti; } ?>" onFocus="if 
(!agree)this.blur();" > 
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
onclick="form1.accionborrarequipotemp.value =  1; 
form1.action='maestablequipotemp.php';"  width="86" height="18" alt="Aceptar" 
border=0> 
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
 <input type="hidden" name="flagborrarequipotemp" value="1"> 
<input type="hidden" name="accionborrarequipotemp"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
