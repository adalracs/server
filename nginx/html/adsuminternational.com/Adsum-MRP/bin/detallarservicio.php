<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
include ( '../src/FunPerPriNiv/pktblnegocio.php'); 
if(!$flagdetallarservicio) 
{ 
include ( '../src/FunGen/sesion/fnccarga.php'); 
$sbreg = fnccarga($nombtabl,$radiobutton); 
if (!$sbreg) 
	{ 
		include( '../src/FunGen/fnccontfron.php'); 
	} 
}
if($sbreg["negocicodigo"] != "")
{
	$idcon = fncconn();
	$cod_negocio = $sbreg["negocicodigo"];
	$arrNegocio = loadrecordnegocio($cod_negocio, $idcon);
	$negocinombre_i = $arrNegocio["negocinombre"];
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
<title>Detalle de registro de servicio</title> 
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
<p><font class="NoiseFormHeaderFont">Servicio</font></p> 
<table width="350" border="0" align="center" cellpadding="0" cellspacing="0" 
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
<td width="28%" valign="top" class="NoiseFooterTD">&nbsp;C&oacute;digo</td>
<td width="72%" class="NoiseDataTD"><?php 
if(!$flagdetallarservicio){ echo $sbreg[servicicodigo];}else{ echo 
$servicicodigo; } ?></td>
</tr>
<tr> 
<td valign="top" class="NoiseFooterTD">&nbsp;Negocio</td>
<td class="NoiseDataTD"><?php if(!$flagconsultarservicio){ 
echo $negocinombre_i;}else{ echo $negocinombre;} ?></td>
 </tr>
<tr> 
 <td valign="top" class="NoiseFooterTD">&nbsp;Nombre</td>
 <td class="NoiseDataTD"><?php 
if(!$flagdetallarservicio){ echo $sbreg[servicinombre];}else{ echo 
$servicinombre;} ?></td>
 </tr> 
<tr>
  <td valign="top" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td>
  <td rowspan="2" valign="top" class="NoiseDataTD"><?php 
if(!$flagdetallarservicio){ echo $sbreg[servicidescri];}else{ echo 
$servicidescri;} ?></td>
</tr>
<tr valign="top"> 
 <td class="NoiseFooterTD">&nbsp;</td>
 </tr> 
</table> 
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.action='maestablservicio.php';"  width="86" height="18" 
alt="Aceptar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagdetallarservicio" value="1"> 
<input type="hidden" name="acciondetallarservicio"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
