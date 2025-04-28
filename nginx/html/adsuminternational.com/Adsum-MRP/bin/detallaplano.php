<html> 
<head> 
<title>Plano</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<script language="JavaScript" src="motofech.js"></script> 
</head> 
<body bgcolor="FFFFFF" text="#000000" onload="this.focus();"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
<tr> 
  <td><iframe name="cwindow" style="border:1" scrolling="auto"  width=950 height=650 src="<?php echo $imgplano;?>"></iframe></td> 
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
<input type="hidden" name="imgplano" value="<?php echo $imgplano; ?>"> 
</form> 
</body> 
</html> 
