<?php 
include ( '../src/FunPerSecNiv/fncconn.php'); 
include ( '../src/FunPerSecNiv/fncclose.php'); 
include ( '../src/FunPerSecNiv/fncfetch.php'); 
include ( '../src/FunPerSecNiv/fncnumreg.php'); 

?> 
<html> 
<head> 
<title>Material de apoyo</title> 
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
<p><font class="NoiseFormHeaderFont">Material de apoyo</font></p> 
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
            <table width="85%" border="0" cellspacing="1" cellpadding="3" 
align="center"> 
              <tr> 
 <td width="25%" class="NoiseFooterTD">C&oacute;digo</td> 
  <td width="25%" class="NoiseFooterTD"> 
   <input type="text" name="matapocodigo"	value="<?php 
if(!$flagconsultarmateapoy){ echo $sbreg[matapocodigo];}else{ echo 
$matapocodigo;} ?>"> 
  </td> 
 </tr> 
              <tr>
                <td class="NoiseFooterTD">Nombre</td>
                <td class="NoiseFooterTD"><input type="text" name="mataponombre"	value="<?php 
if(!$flagconsultarmateapoy){ echo $sbreg[mataponombre];}else{ echo 
$mataponombre;} ?>"></td>
              </tr>
              <tr> 
 <td width="25%" class="NoiseFooterTD">Descripci&oacute;n</td> 
  <td width="25%" class="NoiseFooterTD"> 
    <textarea name="matapodescri" rows="3" wrap="VIRTUAL"><?php 
if(!$flagconsultarmateapoy){ echo $sbreg[matapodescri];}else{ echo 
$matapodescri;} ?></textarea> 
  </td> 
 </tr>
</table> 
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionconsultarmateapoy.value =  1; 
form1.action='maestablmatauxapoy.php';"  width="86" height="18" alt="Aceptar" 
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
 <input type="hidden" name="flagconsultarmateapoy" value="1"> 
<input type="hidden" name="accionconsultarmateapoy"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="columnas" value="matapocodigo, 
mataponombre, 
matapodescri, 
matapocodigo, 
cursoconten, 
cursofecha, 
cursohora, 
cursoubicac, 
proveeurl, 
proveeemail, 
proveenota 
"> 
<input type="hidden" name="nombtabl" value="mateapoy"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
