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
<title>Prueba</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="0">
<script language="Javascript" type="text/javascript">
function path(){
	window.document.form1.filepath1.value = window.document.form1.filepath.value 
}
</script>
<script type="text/javascript" language="JavaScript">
function check() {
  var ext = document.form1.filepath.value; 
  ext = ext.substring(ext.length-3,ext.length);
  ext = ext.toLowerCase();
  if(ext != 'pto') {
    alert("El archivo no es correcto. Seleccione el archivo con extencion '.pto'");
  }else{
    document.form1.accionnuevofile.value = 1;
  }
}
</script>

</head>
<body bgcolor="FFFFFF" text="#000000">
<form name="form1" method="post"  enctype="multipart/form-data">
<p><font class="NoiseFormHeaderFont">Cargar File</font></p>
<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE">
  <tr>
    <td class="NoiseErrorDataTD">&nbsp;</td>
  </tr>
  <tr>
  	<td>Archivo Plano&nbsp;&nbsp;<input type="file" name="filepath" accept="text/plain" ></td>
  </tr>
  <tr>
    <td>
      <div align="center">
        <input type="image" name="aceptar"  src="../img/aceptar.gif" onclick="path();check();" width="86" height="18" alt="Aceptar" border=0>
      </div>
    </td>
  </tr>
  <tr>
    <td class="NoiseErrorDataTD">&nbsp;</td>
  </tr>
</table>

<input type="hidden" name="accionnuevofile" value="<?php echo $accionnuevofile; ?>">
<input type="hidden" name="filepath1" value="<?php echo $filepath1; ?>">

</form>
</body>
</html>