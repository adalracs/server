<?php 
include('../src/FunPerSecNiv/fncconn.php');
include('../src/FunPerSecNiv/fncclose.php');
include('../src/FunPerSecNiv/fncfetch.php');
include('../src/FunPerSecNiv/fncnumreg.php');
?> 
<html> 
<head> 
<title>Consultar en exammedi</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<SCRIPT LANGUAGE="JavaScript"> 
<!-- Begin 
agree = 0; 
//  End --> 
</script> 
<script language="JavaScript" src="motofech.js"></script> 
</head> 
<?php 
    if(!$codigo) 
    { echo "<!--";} 
?> 
<body bgcolor="FFFFFF" text="#000000" onload="this.focus();"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Ex&aacute;men m&eacute;dico</font></p> 
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
            <table width="92%" border="0" cellspacing="1" cellpadding="1" 
align="center"> 
<tr> 
 <td width="34%">Codigo</td>
  <td><input type="text" name="examedcodigo"	value="<?php if(!$flagconsultarexammedi){
echo $sbreg[examedcodigo];} else {echo $examedcodigo;}?>">
  </td>
 </tr> 
              <tr> 
 <td width="34%">Nombre</td>
  <td width="66%"><input type="text" name="examednombre"	value="<?php if(!$flagconsultarexammedi){
echo $sbreg[examednombre];} else {echo $examednombre;}?>" size="30">
  </td>
 </tr>
              <tr>
                <td>Periodicidad</td>
                <td><input type="text" name="examedperiod"	value="<?php if(!$flagconsultarexammedi){
echo $sbreg[examedperiod];} else {echo $examedperiod;}?>" size="15">&nbsp;&nbsp;d&iacute;as</td>
              </tr>
              <tr>
 <td width="34%">Descripci&oacute;n</td>
  <td rowspan="2"><textarea name="exameddescri" cols ="40" rows="3" wrap="VIRTUAL"><?php if(!$flagconsultarexammedi){
echo $sbreg[exameddescri];} else {echo $exameddescri;}?></textarea>
  </td>
 </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
 <tr>
  <td width="34%">&nbsp;</td>
 </tr>
</table>
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionconsultarexammedi.value =  1; 
form1.action='maestablexammediaux.php';"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="window.close();"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagconsultarexammedi" value="1"> 
<input type="hidden" name="accionconsultarexammedi"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="columnas" value="examedcodigo, 
examednombre, 
examedperiod, 
exameddescri, 
cursoconten, 
cursofecha, 
cursohora, 
cursoubicac, 
proveeurl, 
proveeemail, 
proveenota 
"> 
<input type="hidden" name="nombtabl" value="exammedi"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
