<?php
    ob_start();
	include ( '../src/FunGen/sesion/fncvalses.php');
	if($accionxml)
	{				
		include ( 'armaxml.php'); // Llamado del archivo armaxml.php
	}
	ob_end_flush();
?>
<!-- Cï¿½digo creado por:
Andrï¿½s Riascos
Fecha: 06012002 -->
<html>
<head>
<title>Datos XML</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="0">
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
agree = 0;
//  End -->
</script>
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
agree = 0;
//  End -->
</script>
<script language="JavaScript" src="motofech.js"></script>
</head>
<body bgcolor="#FFFFFF" text="#000000">
<form name="form1" method="post"  enctype="multipart/form-data">
  <table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE">
    <tr>
      <td width="534" class="NoiseErrorDataTD">&nbsp;</td>
    </tr>
    <tr>
      <td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Cargar XML</font></span></td>
    </tr>
    <tr>
      <td colspan="2">
        <table width="93%" border="0" cellspacing="1" cellpadding="1"
align="center">
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td class="NoiseFooterTD"><font size="2" face="Arial, Helvetica,sans-serif">&nbsp;Fecha:  <?php echo $ordtrafecini=date("Y-m-d");?></font></td>
          </tr>
          <tr>
            <td colspan="2" class="NoiseFooterTD">
              <div align="left">&nbsp;Este Archivo quedará Cargado en la Carpeta etc/data.xml&nbsp;...&nbsp;
           </div></td>
     
          </tr>
          
		  <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td colspan="2">
        <div align="center">
      <input type="image" name="aceptar" src="../img/aceptar.gif" onClick="form1.accionxml.value=1;" width="86" height="18" alt="Aceptar" border=0>
	  <input type="image" name="cancelar" src="../img/cancelar.gif" onClick="form1.flag1.value=1;form1.action ='ingrnuevarmarxml.php';"  width="86" height="18" alt="Cancelar" border=0>
      </div></td>
    </tr>
    <tr>
      <td class="NoiseErrorDataTD">&nbsp;</td>
    </tr>
  </table>
<input type="hidden" name="accionxml">
</form>
</body>
</html>
