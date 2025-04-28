<?php
include ( '../src/FunGen/sesion/fncvalses.php');
?>
<!-- Propiedad intelectual de Adsum SA (c)
-Todos los derechos reservados-
Creado con WAG Adsum
Autor: Andr�s A. Riascos D.
Fecha: 26052004
GenVers: 3.1 -->
<html>
<head>
<title>Consultar en reporte</title>
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
<p><font class="NoiseFormHeaderFont">Reporte</font></p>
<table border="0" cellspacing="1" cellpadding="2" align="center"
class="NoiseFormTABLE">
  <tr>
    <td class="NoiseErrorDataTD">&nbsp;</td>
  </tr>
  <tr>
          <td class="NoiseFieldCaptionTD"><span class="style5"><font
color="FFFFFF">
Consultar registro</font></span></td></tr>
<tr>
  <td>
            <table width="85%" border="0" cellspacing="0" cellpadding="3"
align="center">
</tr>
<tr>
 <td width="41%">C&oacute;digo</td>
 <td width="59%">
  <input type="text" name="reportcodigo"	value="<?php
if(!$flagconsultarreporte){ echo $sbreg[reportcodigo];}else{ echo
$reportcodigo; }?>">
 </td>
 </tr>
<tr>
 <td width="41%">Nombre</td>
 <td width="59%">
  <input type="text" name="reportnombre"	value="<?php
if(!$flagconsultarreporte){ echo $sbreg[reportnombre];}else{ echo
$reportnombre; }?>">
 </td>
 </tr>
<tr>
 <td width="41%">Fecha</td>
 <td width="59%">
  <input type="text" name="reportfecha"	value="<?php
if(!$flagconsultarreporte){ echo $sbreg[reportfecha];}else{ echo $reportfecha;
}?>" size="8" onfocus="if(!agree)this.blur();">&nbsp;&nbsp;
 <img src="../img/cal.gif" border="0" onClick="window.open('formcalendario.php?calencodigo=reportfecha','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');">
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
onclick="form1.accionconsultarreporte.value =
1;form1.action='maestablreporte.php';"  width="86" height="18" alt="Aceptar"
border=0>
  <input type="image" name="cancelar" src="../img/cancelar.gif"
onclick="form1.action='maestablreporte.php';"  width="86" height="18"
alt="Cancelar" border=0>
</div>
</td>
 </tr>
 <tr>
  <td class="NoiseErrorDataTD">&nbsp;</td>
 </tr>
</table>
 <input type="hidden" name="flagconsultarreporte" value="1">
<input type="hidden" name="accionconsultarreporte">
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
<input type="hidden" name="columnas" value="reportcodigo,
reportnombre,
reportselect,
reportfecha
">
<input type="hidden" name="nombtabl" value="reporte">
</form>
</body>
<?php
    if(!$codigo)
    { echo " -->"; }
?>
</html>