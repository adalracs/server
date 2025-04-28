<?php
   	//include ( '../src/FunGen/sesion/fncvalses.php');
   	include ( '../src/FunPerSecNiv/fncconn.php');
	include ( '../src/FunPerSecNiv/fncclose.php');
	include ( '../src/FunPerSecNiv/fncfetch.php');
	include ( '../src/FunPerSecNiv/fncnumreg.php');
	include ( '../src/FunPerPriNiv/pktblotestado.php');
	include ('../src/FunGen/floadotestado.php');
	if($radiobutton)
	{
		$tok = explode("-",$radiobutton);
	}
	if($accioneditarregla)
	{
		include('borraordenotestado.php');
		//die("Hola mundo");
	}
	$idcon = fncconn();
	$arrotestadoini = loadrecordotestado($tok[0],$idcon);
	$arrotestadofin = loadrecordotestado($tok[1],$idcon);
	
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
      <td colspan="2" class="NoiseFieldCaptionTD"><span class="style5"><font color="#FFFFFF">Borrar ord&eacute;n</font></span></td>
    </tr>
        <tr>
    <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
      <td colspan="2">
        <table width="97%" border="0" cellspacing="0" cellpadding="0"
align="center">
        <tr><td>Inicial</td>
    	<td><input type="text" name="otestanombini" value="<?php echo $arrotestadoini[otestanombre];?>" onFocus="if (!agree)this.blur();">
    	</td>
    	<td>Final</td>
    	<td><input type="text" name="otestanombfin" value="<?php echo $arrotestadofin[otestanombre];?>" onFocus="if (!agree)this.blur();">
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
          <input type="image" name="siguiente" onClick="form1.accioneditarregla.value=1;" alt="Aceptar" border=0 width="86" height="18" src="../img/aceptar.gif">
          <input type="image" name="cancelar" onClick="form1.action='ingrnuevregotestado.php';" alt="Cancelar" border=0 width="86" height="18" src="../img/cancelar.gif">
          <font color="#FFFFFF">Espacio vacio</font></div>
      </td>
    </tr>
    <tr>
      <td class="NoiseErrorDataTD" colspan="2">&nbsp;</td>
    </tr>
  </table>
<input type="hidden" name="accioneditarregla">
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
<input type="hidden" name="arrcodtex" value="<?php echo $arrcodtex; ?>">
<input type="hidden" name="otestacodini" value="<?php echo $tok[0]; ?>">
<input type="hidden" name="otestacodfin" value="<?php echo $tok[1]; ?>">
</form>
</body>
<?php
    if(!$codigo)
    { echo " -->"; }
?>
</html>