<?php
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktblplanta.php');
include ( '../src/FunPerPriNiv/pktblsistema.php');
include ( '../src/FunGen/sesion/fnccaf.php');
include ( '../src/FunGen/fncfiffhours.php');

$reccomact = fnccaf($GLOBALS[usuacodi], $_SERVER["SCRIPT_FILENAME"]);
?>
<html>
<head>
<title>Tiempo medio de reparaciones</title>
<meta http-equiv="expires" content="0">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
<script language="JavaScript" type="text/javascript" src="../src/FunGen/ajxCargarTimedrep.js"></script>
<script language="JavaScript" type="text/javascript" src="../src/FunSpec/validaformtimedrep.js"></script>
<script language="JavaScript" src="motofech.js"></script>
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
agree = 0;
//  End -->
</script>
</head>
<?php
    if(!$codigo)
    { echo "<!--";}
?>
<body bgcolor="FFFFFF" text="#000000">
<form name="form1" method="post"  enctype="multipart/form-data">
<p><font class="NoiseFormHeaderFont">Tiempo Medio de Reparaciones</font></p>
<table border="0" cellspacing="1" cellpadding="2" align="center"
class="NoiseFormTABLE" width="70%">
  <tr>
    <td class="NoiseErrorDataTD">&nbsp;</td>
  </tr>
  <tr>
          <td class="NoiseFieldCaptionTD"><span class="style5"><font
color="FFFFFF">Tiempo Medio de Reparaciones</font></span></td></tr>
<tr>
	<td>
		<table width="93%" border="0" cellspacing="0" cellpadding="3" align="center">
		<tr>
		 <td class="NoiseColumnTD" colspan="3">Seleccione un(os) &iacute;tem(s) y el periodo de tiempo a observar.</td>
		</tr>
		<tr>
		 <td colspan="3">&nbsp;</td>
		</tr>
		<tr>
		 <td colspan="3"><INPUT type="button" name="btnEquipo" value="Equipo" onclick="window.open('consultarequipoindgen.php?codigo=<?php echo  $codigo?>','equipogen','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');">&nbsp;
		 <INPUT type="button" name="btnComponetne" value="Componente" onclick="window.open('consultarcomponenindgen.php?codigo=<?php echo $codigo?>','equipogen','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');">&nbsp;
		 <SPAN id="imgLoading" style="display:none;"><IMG src="../img/loading.gif" alt="Cargando..." /></SPAN></td>
		</tr>
		<tr>
		 <td colspan="3">
		 <SPAN id="tableHeader" style="display:none">
		 <TABLE border="0" id="dynamicTable" width="100%">
		  <!-- tabla dinamicas -->
		  <tr class="NoiseColumnTD">
		   <td width="30%">C&oacute;digo</td>
		   <td colspan="2">Nombre</td>
		  </tr>
		 </TABLE>
		 </SPAN>
		 </td>
		</tr>
		<tr>
		 <td colspan="3"><HR /></td>
		</tr>
        <tr>
		  <td><B>Periodo a observar</B></td>
		  <td>Fecha inicial&nbsp;<input type="text" name="fecini" size="8" onfocus="if(!agree)this.blur();" />&nbsp;<img src="../img/cal.gif" border="0" alt="Calendario" onClick="window.open('formcalendario.php?calencodigo=fecini','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');" /></td>
		  <td>Fecha final&nbsp;<input type="text" name="fecfin" size="8" onfocus="if(!agree)this.blur();" />&nbsp;<img src="../img/cal.gif" border="0" alt="Calendario" onClick="window.open('formcalendario.php?calencodigo=fecfin','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');" /></td>
		</tr>
		<tr>
		 <td colspan="3">&nbsp;</td>
		</tr>
        </table>
  </td>
 </tr>
 <tr>
<td>
<div align="center">
<input type="image" name="aceptar"  src="../img/aceptar.gif"
onclick="form1.action='reporttimedrep.php'; return validaformtimedrep();"  width="86" height="18" alt="Aceptar" border=0>&nbsp;
<input type="image" src="../img/cancelar.gif" border="0" alt="Cancelar" onclick="form1.action='main.php';">
</div>
</td>
 </tr>
 <tr>
  <td class="NoiseErrorDataTD">&nbsp;</td>
 </tr>
</table>
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
<input type="text"   name="strdataload" size="1" value="" style="border:none; color:#FFFFFF;" onfocus="sendReq(this.value); this.value=''; this.blur();">
<!-- Data: EQUIPOS|e COMPONETNES|c -->
<input type="hidden" name="strdata" value="<?php echo $strdata; ?>">
</form>
</body>
<?php
if(!$codigo)
{ echo " -->"; }
?>
</html>