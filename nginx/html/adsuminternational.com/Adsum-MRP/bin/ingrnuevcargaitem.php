<?php
ob_start();

if($accionnuevofile)
{
	include ( 'cargaitem.php');
}
ob_end_flush();
?>

<html>
<head>
<title>Par&aacute;metros de presentaci&oacute;n</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="0">
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
<script language="JavaScript" src="motofech.js"></script>
</head>
<body bgcolor="FFFFFF" text="#000000">
<form name="form1" method="post"  enctype="multipart/form-data">
<p><font class="NoiseFormHeaderFont">Cargar File</font></p>
<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE">
  <tr>
    <td class="NoiseErrorDataTD">&nbsp;</td>
  </tr>
  <tr>
  	<td>Archivo Plano&nbsp;&nbsp;<input type="file" name="filepath"></td>
  </tr>
  <tr>
    <td>
      <div align="center">
        <input type="image" name="aceptar"  src="../img/aceptar.gif" onclick="form1.accionnuevofile.value =  1;" width="86" height="18" alt="Aceptar" border=0>
      </div>
    </td>
  </tr>
  <tr>
    <td class="NoiseErrorDataTD">&nbsp;</td>
  </tr>
</table>
<input type="hidden" name="filepath" value="<?php echo $filepath; ?>">
<!--<input type="hidden" name="accionnuevofile" value="<?php // echo $accionnuevofile; ?>">-->
</form>
</body>
</html>