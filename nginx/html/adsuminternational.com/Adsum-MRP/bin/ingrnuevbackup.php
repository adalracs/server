<?php
    include ( '../src/FunGen/fnctoday.php');
    include ( '../src/FunPerSecNiv/fncconn.php');
    include ( '../src/FunPerSecNiv/fncnumreg.php');
    include ( '../src/FunPerSecNiv/fncfetch.php');
    include ( '../src/FunPerPriNiv/pktbltabla.php');

    $fecha = fnctoday(1);
    $hora= date("H:i");
    $arr = explode("-",$fecha);
    $arrhora = explode(":",$hora);
    $nombre = null;

    for($a = 0; $a < 3; $a++)
    {
        $nombre = $nombre.$arr[$a];
    }
    $nombre = $nombre.$arrhora[0].$arrhora[1];
	if($flag1)
    {
	include ('main.html');
	die();
    }
//    echo "Sistema operativo = ";
//    echo PHP_OS;
//    die();
?>
<!-- C�digo creado por:
Andr�s Riascos
Fecha: 06012002 -->
<html>
<head>
<title>Nuevo registro de Centro</title>
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
<body bgcolor="#FFFFFF" text="#000000">
<form name="form1" method="post"  enctype="multipart/form-data">
  <table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE">
    <tr>
      <td width="534" class="NoiseErrorDataTD">&nbsp;</td>
    </tr>
    <tr>
      <td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Back-up</font></span></td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#f0f6ff">
        <table width="93%" border="0" cellspacing="0" cellpadding="0"
align="center">
          <tr>
            <td width="33%"><font size="2" face="Arial, Helvetica,sans-serif">Fecha:  <?php echo $fecha; ?></font></td>
            <td width="67%" align="right"><font size="2" face="Arial, Helvetica,sans-serif">Hora:  <?php echo $hora; ?></font></td>
          </tr>
		  <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2">
              <div align="left">Esta copia de seguridad quedar&aacute; en un archivo 
			  con el nombre " <?php echo $nombre.".gz"; ?> "</div></td>
          </tr>
		  <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
             <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td colspan="2">
        <div align="center">
      <input type="image" name="aceptar" src="../img/aceptar.gif" onClick="form1.flag.value = 1;form1.action='ingrnuevbackup.php';submit();"  width="86" height="18" alt="Aceptar" border=0>
	  <input type="image" name="cancelar" src="../img/cancelar.gif" onClick="form1.flag1.value=1;form1.action ='ingrnuevbackup.php';"  width="86" height="18" alt="Cancelar" border=0>
	  <input type="image" name="cancelar2" src="../img/ayuda.gif" width="86" height="18" alt="Cancelar" border=0 onClick="window.open('ayudas/general.html','General','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=900,height=700');"> 
      </div></td>
    </tr>
    <tr>
      <td class="NoiseErrorDataTD">&nbsp;</td>
    </tr>
  </table>
  <?php
  	if($flag)
    {
    	include ('grababackup.php');
    }
	if($saveas){ echo '<iframe STYLE="display:none" name="cwindow" src="../src/FunMig/'.$nombre.'.gz"></iframe>';echo '<script language= "javascript">';
	 echo '<!--//'."\n";
	 echo 'alert("Back-up exitoso")';
	 echo '//-->'."\n";
	 echo '</script>';};
	
  ?>
  <input type="hidden" name="nombre" value="<?php echo $nombre; ?>">
  <input type="hidden" name="saveas" value="<?php echo $saveas; ?>">
  
<input type="hidden" name="flag">
<input type="hidden" name="flag1">
</form>
</body>
</html>
