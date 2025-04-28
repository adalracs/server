<?php 
include ( '../src/FunGen/sesion/fncvalses.php');
if(!$flagdetallarestado)
{
	include ( '../src/FunGen/sesion/fnccarga.php');
	$sbreg = fnccarga($nombtabl,$radiobutton);
	if (!$sbreg)
	{
		include( '../src/FunGen/fnccontfron.php');
	}
	$arrtipo = array('Inactivo', 'Activo', 'De Baja');
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
<title>Detalle de registro de estado</title> 
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
<p><font class="NoiseFormHeaderFont">Estado</font></p> 
<table width="350" border="0" align="center" cellpadding="2" cellspacing="1" 
class="NoiseFormTABLE"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Detallar registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="85%" border="0" cellspacing="1" cellpadding="0" 
align="center"> 
              <tr> 
                <td width="35%"></td> 
<td width="65%"></tr> 
<tr> 
 <td width="35%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
 <td width="65%" class="NoiseDataTD"><?php if(!$flagdetallarestado){ 
echo $sbreg[estadocodigo];}else{ echo $estadocodigo; } ?></td> 
 </tr> 
<tr> 
 <td width="35%" class="NoiseFooterTD">&nbsp;Nombre</td> 
 <td width="65%" class="NoiseDataTD"><?php if(!$flagdetallarestado){ 
echo $sbreg[estadonombre];}else{ echo $estadonombre; } ?></td> 
 </tr> 
<tr> 
 <td width="35%" class="NoiseFooterTD">&nbsp;Tipo</td> 
 <td width="65%" class="NoiseDataTD"><?php echo $arrtipo[$sbreg['estadotipo']] ?></td> 
 </tr> 
<tr> 
 <td width="35%" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td> 
 <td width="65%" rowspan="2" class="NoiseDataTD" valign="top"><?php if(!$flagdetallarestado){ 
echo $sbreg[estadodescri];}else{ echo $estadodescri; } ?></td> 
 </tr>
<tr class="NoiseFooterTD">
  <td>&nbsp;</td>
</tr> 
</table> 
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.action='maestablestado.php';"  width="86" height="18" 
alt="Aceptar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagdetallarestado" value="1"> 
<input type="hidden" name="acciondetallarestado"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 
