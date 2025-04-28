<html> 
<head> 
<title>Manual</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<script language="JavaScript" src="motofech.js"></script> 
</head> 
<body bgcolor="FFFFFF" text="#000000" onload="this.focus();"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Manual</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
<tr> 
  <td><iframe name="cwindow" style="border:1" scrolling="auto"  width=750 height=550 src="<?php echo $imgmanual;?>"></iframe></td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="window.close();"  width="86" height="18" alt="Aceptar" 
border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
<input type="hidden" name="imgmanual" value="<?php echo $imgmanual; ?>"> 
</form> 
</body> 
</html> 
