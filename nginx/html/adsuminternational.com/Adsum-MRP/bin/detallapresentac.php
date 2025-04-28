<html>
<head>
<title>Par&aacute;metros de presentaci&oacute;n</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="0">
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
<script language="JavaScript" src="motofech.js"></script>
<script language="JavaScript" type="text/javascript">
function loadIframe(theURL)
{
	var img = new Image();
	img.src = theURL;

	document.getElementById("cwindow").height = img.height;
	document.getElementById("cwindow").width = img.width;
	window.resizeTo((img.width+100),(img.height+200));
	self.moveTo(500,150);
}
</script>
</head>
<body bgcolor="FFFFFF" text="#000000" onload="this.focus(); loadIframe('<?php echo $imgpresentac; ?>')">
<form name="form1" method="post"  enctype="multipart/form-data">
<p><font class="NoiseFormHeaderFont">Par&aacute;metros de presentaci&oacute;n</font></p>
<table border="0" cellspacing="1" cellpadding="2" align="center"
class="NoiseFormTABLE">
  <tr>
    <td class="NoiseErrorDataTD">&nbsp;</td>
  </tr>
<tr>
  <td><iframe name="cwindow" id="cwindow" src="<?php echo $imgpresentac; ?>" scrolling="no" marginwidth="0" marginheight="0" frameborder="1"></iframe></td> </tr>
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
<input type="hidden" name="imgpresentac" value="<?php echo $imgpresentac; ?>">
</form>
</body>
</html>