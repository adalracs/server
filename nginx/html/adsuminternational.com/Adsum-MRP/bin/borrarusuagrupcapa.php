<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
include ( '../src/FunPerPriNiv/pktblgrupcapa.php');	
include ( '../src/FunPerPriNiv/pktblusuario.php');	
if(!$flagborrarusuagrupcapa) 
{ 
	include ( '../src/FunGen/sesion/fnccarga.php'); 
	$sbreg = fnccarga($nombtabl,$radiobutton); 
	if (!$sbreg) 
	{ 
		include( '../src/FunGen/fnccontfron.php'); 
	} 
	
	$idcon = fncconn();
	$sbregusua = loadrecordusuario($sbreg[usuacodi],$idcon);
	$usuanombre = $sbregusua[usuanombre]." ".$sbregusua[usuapriape]." ".$sbregusua[usuasegape];
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
<title>Borrar registro de usuagrupcapa</title> 
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
<p><font class="NoiseFormHeaderFont">Grupo de empleados</font></p> 
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
 <table width="98%" border="0" cellspacing="0" cellpadding="1" align="center"> 
<tr> 
 <td width="21%">C&oacute;digo</td> 
 <td width="23%"> 
<input type="text" name="usugrucodigo" value="<?php if(!$flagborrarusuagrupcapa){ echo $sbreg[usugrucodigo];}?>" size="17" onFocus="if (!agree)this.blur();"> 
</td> 
<td width="12%">&nbsp;</td> 
<td width="44%">&nbsp;</td>
</tr> 
<tr> 
 <td width="21%">Grupo</td> 
  <td width="59%"> 
  <input type="text" name="grucapcodigo" value="<?php if(!$flagborrarusuagrupcapa){ echo $grupnombre;}?>" onFocus="if (!agree)this.blur();" > 
 </td>
 <td width="44%">&nbsp;</td>
</tr> 
 <tr> 
  <td colspan="2">&nbsp;</td> 
 </tr> 
<tr> 
 <td width="21%">Codigo empleado</td> 
 <td width="23%"><input name="usuariocodigo" type="text"	value="<?php if(!$flagborrarusuagrupcapa){echo $sbreg[usuacodi]; }?>" size="17" onFocus="if (!agree)this.blur();"></td>
 <td width="12%">Nombre 
 </td> 
 <td width="44%"><input name="usuanombre" type="text"	value="<?php if(!$flagborrarusuagrupcapa){ echo $usuanombre;}?>" size="35" onFocus="if (!agree)this.blur();"></td>
</tr>
 <tr> 
  <td colspan="2">&nbsp;</td> 
 </tr> 
</table> 
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionborrarusuagrupcapa.value =  1; 
form1.action='maestablusuagrupcapa.php';"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablusuagrupcapa.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagborrarusuagrupcapa" value="1"> 
<input type="hidden" name="accionborrarusuagrupcapa"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
