<?php 
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktblexammedi.php');
include ( '../src/FunPerPriNiv/pktblusuario.php');
if(!$flagdetallarexammediusuario)
{
	include ( '../src/FunGen/sesion/fnccarga.php');
	$sbreg = fnccarga($nombtabl,$radiobutton);
	if (!$sbreg)
	{
		include( '../src/FunGen/fnccontfron.php');
	}
	$idcon = fncconn();
	$arrexamen = loadrecordexammedi($sbreg[examedcodigo],$idcon);
	$examednombre = $arrexamen[examednombre];
	$arrusuario = loadrecordusuario($sbreg[usuacodi],$idcon);
	$usrnombre = $arrusuario[usuanombre]." ".$arrusuario[usuapriape]." ".$arrusuario[usuasegape];
	fncclose($idcon);
}
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andr�s A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Detalle de registro de exammediusuario</title> 
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
<p><font class="NoiseFormHeaderFont">Ex&aacute;men M&eacute;dico</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE" width="40%"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Detallar registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="85%" border="0" cellspacing="0" cellpadding="3" 
align="center">
<tr> 
 <td width="41%">C&oacute;digo</td> 
 <td width="59%"> 
  <input type="text" name="exmusucodigo" value="<?php 
  if(!$flagdetallarexammediusuario){ echo $sbreg[exmusucodigo];}else{ echo
$exmusucodigo; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr>
 <tr> 
 <td width="25%">Ex&aacute;men</td> 
 <td width="25%">Cod.&nbsp;<input type="text" name="examedcodigo" size="4" value="<?php 
 if(!$flagdetallarexammediusuario){ echo $sbreg[examedcodigo];}else{ echo
$examedcodigo; } ?>" onFocus="if (!agree)this.blur();" > 
<td width="50%">Nombre&nbsp;<input type="text" onfocus="if(!agree) this.blur();" size="18" value="<?php
if(!$flagdetallarexammediusuario) {echo $examednombre;} else {echo $examednombre;}?>"></td> 
</td> 
 </tr>
 <tr><td colspan="3"><hr></td></tr>
<tr> 
 <td width="25%">Empleado</td> 
 <td width="25%">Cod.&nbsp;<input type="text" name="usuacodigo" size="4" value="<?php 
  if(!$flagdetallarexammediusuario){ echo $sbreg[usuacodi];}else{ echo $usuacodigo;
} ?>" onFocus="if (!agree)this.blur();" > 
</td> 
<td width="50%">Nombre&nbsp;<input type="text" onfocus="if(!agree) this.blur();" size="18" value="<?php
if(!$flagdetallarexammediusuario) {echo $usrnombre;} else {echo $usrnombre;}?>"></td> 
</td>
</tr> 
 <tr><td colspan="3"><hr width="100%"></td></tr>
<tr> 
 <td width="25%">Fecha</td> 
 <td width="25%"> 
  <input type="text" name="exmusupinifec" value="<?php 
  if(!$flagdetallarexammediusuario){ echo $sbreg[exmusupinifec];}else{ echo
$exmusupinifec; } ?>" onFocus="if (!agree)this.blur();" > 
 </td> 
<td width="50%">aaaa-mm-dd</td>
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
onclick="form1.action='maestablexammediusuario.php';"  width="86" height="18" 
alt="Aceptar" border=0> 
 </div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagdetallarexammediusuario" value="1"> 
<input type="hidden" name="acciondetallarexammediusuario"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 
