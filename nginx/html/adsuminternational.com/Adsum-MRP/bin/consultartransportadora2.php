<?php
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktbltransportadora.php');
?>
<!-- Propiedad intelectual de Adsum SA (c)
-Todos los derechos reservados-
Creado con WAG Adsum
Autor: Andrés A. Riascos D.
Fecha: 26052004
GenVers: 3.1 -->
<html>
<head>
<title>Consultar Transportadora</title>
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
<p><font class="NoiseFormHeaderFont">Transportadora</font></p>
<table border="0" cellspacing="1" cellpadding="2" align="center"
class="NoiseFormTABLE">
  <tr>
    <td class="NoiseErrorDataTD">&nbsp;</td>
  </tr>
  <tr>
          <td class="NoiseFieldCaptionTD"><span class="style5"><font
color="FFFFFF">
Consultar Transportadora</font></span></td></tr>
<tr>
  <td>
            <table width="85%" border="0" cellspacing="0" cellpadding="3"
align="center">
<tr>
 <td width="41%">C&oacute;digo</td>
 <td width="59%">
  <input type="text" name="codtransportadora" value="<?php
if(!$flagconsultartransportadora){ echo $sbreg[codtransportadora];}else{ echo $codtransportadora;}?>">
 </td>
 </tr>
 <tr>
 <td width="41%">Descripci&oacute;n</td>
 <td width="59%">
  <textarea name="imagendescri" cols="24" wrap="VIRTUAL" rows="3"><?php
if(!$flagconsultartransportadora){ echo $sbreg[transportadesc];}else{ echo $transportadesc;}?></textarea>
 </td>
 </tr>
<tr>
 <td width="41%">Logo</td>
 <td width="59%">
  <input type="text" name="logonombre"	value="<?php
if(!$flagconsultartransportadora){ echo $sbreg[logonombre];}else{ echo $logonombre;
}?>">
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
onclick="
if(form1.articupadre.value!=''){form1.codtransportadora.value=form1.articupadre.value;}
form1.accionconsultartransportadora.value =1;form1.action='maestabltransportadora.php';"  width="86" height="18"
alt="Aceptar" border=0>
<input type="image" name="cancelar" src="../img/cancelar.gif"
onclick="form1.action='maestabltransportadora.php';"  width="86" height="18"
alt="Cancelar" border=0>
<a href= "javascript:;"><input type="image" name="cancelar2" src="../img/ayuda.gif" width="86" height="18" alt="Cancelar" border=0></a>
</div>
</td>
 </tr>
 <tr>
  <td class="NoiseErrorDataTD">&nbsp;</td>
 </tr>
</table>
<input type="hidden" name="articupadre" value="<?php if(!$flagconsultartransportadora){
echo $sbreg[articupadre];}else{ echo $articupadre; }?>">
<input type="hidden" name="codtransportadora" value="<?php if(!$flagconsultartransportadora){
echo $sbreg[codtransportadora];}else{ echo $codtransportadora; }?>">
<input type="hidden" name="flagconsultartransportadora" value="1">
<input type="hidden" name="accionconsultartransportadora">
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
<input type="hidden" name="columnas" value="codtransportadora,
transportadesc,
logonombre
">
<input type="hidden" name="nombtabl" value="transportadora">
</form>
</body>
<?php
    if(!$codigo)
    { echo " -->"; }
?>
</html>
