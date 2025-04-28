<?php
   	//include ( '../src/FunGen/sesion/fncvalses.php');
   	include ( '../src/FunPerSecNiv/fncconn.php');
	include ( '../src/FunPerSecNiv/fncclose.php');
	include ( '../src/FunPerSecNiv/fncfetch.php');
	include ( '../src/FunPerSecNiv/fncnumreg.php');
	include ( '../src/FunPerPriNiv/pktblotestado.php');
	include ('../src/FunGen/floadotestado.php');
	
	if($accionnuevoregla)
	{
		include('grabaordenotestado.php');
	}
?>
<html>
<head>
<title>Nuevo registro de Regla</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="0">
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
agree = 0;
//  End -->
</script>
<script language="JavaScript" src="motofech.js"></script>
<script language=JavaScript src="../src/FunGen/cargarOtestado.js" type="text/javascript" ></script>
</head>
<?php
    if(!$codigo)
    { echo "<!--";}
?>
<body bgcolor="#FFFFFF" text="#000000">
<form name="form1" method="post"  enctype="multipart/form-data">
  <p><font class="NoiseFormHeaderFont">Reglas de estados de OT</font></p>
  <table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE">
    <tr>
      <td width="400" colspan="2" class="NoiseErrorDataTD">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" class="NoiseFieldCaptionTD"><span class="style5"><font color="#FFFFFF">Ingresar nuevo ord&eacute;n</font></span></td>
    </tr>
        <tr>
    <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
      <td colspan="2">
        <table width="97%" border="0" cellspacing="0" cellpadding="0"
align="center">
        <tr><td>Inicial</td>
    	<td><select name="otestacodini">
    		<?php
		        $idcon = fncconn();
			    floadotestado($idcon);
            ?></select>
    	</td>
    	<td>Final</td>
    	<td><select name="otestacodfin">
    		<?php
            	floadotestado($idcon);
			    fncclose($idcon);
            ?></select>
         </td></tr>
           <tr>
            <td colspan="4">&nbsp;</td>
           </tr>
           <tr>
            <td colspan="4">&nbsp;
           </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <div align="center"> <font color="#FFFFFF">Espacio vacio</font>
          <input type="image" name="siguiente" onClick="form1.accionnuevoregla.value=1;" alt="Aceptar" border=0 width="86" height="18" src="../img/aceptar.gif">
          <input type="image" name="cancelar" onClick="form1.action='ingrnuevregotestado.php';" alt="Cancelar" border=0 width="86" height="18" src="../img/cancelar.gif">
          <font color="#FFFFFF">Espacio vacio</font></div>
      </td>
    </tr>
    <tr>
      <td class="NoiseErrorDataTD" colspan="2">&nbsp;</td>
    </tr>
  </table>
<input type="hidden" name="accionnuevoregla">
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
<input type="hidden" name="arrcodtex" value="<?php echo $arrcodtex; ?>">
</form>
</body>
<?php
    if(!$codigo)
    { echo " -->"; }
?>
</html>