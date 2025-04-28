<?php
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktblplanta.php');
include ( '../src/FunPerPriNiv/pktblsistema.php');
include ( '../src/FunGen/sesion/fnccaf.php');

$reccomact = fnccaf($GLOBALS[usuacodi], $_SERVER["SCRIPT_FILENAME"]);
?>
<html>
<head>
<title>No conformidades de mantenimientos</title>
<meta http-equiv="expires" content="0">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
<script language="JavaScript" type="text/javascript" src="../src/FunGen/ajxCargarTimedrep.js"></script>
<script language="JavaScript" type="text/javascript" src="../src/FunSpec/validaformtimedrep.js"></script>
<script language="JavaScript" type="text/javascript">
function carga()
{
	if ((window.document.form1.fecini.value != "") && (window.document.form1.fecfin.value != ""))
	{
		var iniDate = window.document.form1.fecini.value.split('-');
		var endDate = window.document.form1.fecfin.value.split('-');

		if (endDate[0] <= iniDate[0])
		{
			if (endDate[1] <= iniDate[1])
			{
				if (endDate[2] <= iniDate[2])
				{
					alert("La fecha de fin debe ser mayor o igual a la fecha final");
					return false;
				}
			}
		}
		return true;
	}
	alert("Seleccione un periodo a observar. Verifique los datos suministrados");

	return false;
}
</script>
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
<p><font class="NoiseFormHeaderFont">No conformidades de mantenimientos</font></p>
<table border="0" cellspacing="1" cellpadding="2" align="center"
class="NoiseFormTABLE" width="70%">
  <tr>
    <td class="NoiseErrorDataTD">&nbsp;</td>
  </tr>
  <tr>
          <td class="NoiseFieldCaptionTD"><span class="style5"><font
color="FFFFFF">No conformidades de mantenimientos</font></span></td></tr>
<tr>
	<td>
		<table width="93%" border="0" cellspacing="1" cellpadding="1" align="center">
		<tr>
		 <td class="NoiseColumnTD" colspan="3">Seleccione el periodo de tiempo</td>
		</tr>
		<tr>
		 <td colspan="3">&nbsp;</td>
		</tr>
        <tr>
		  <td class="NoiseFooterTD"><B>Periodo a observar</B></td>
		  <td class="NoiseDataTD">Fecha inicial&nbsp;<input type="text" name="fecini" size="8" onfocus="if(!agree)this.blur();" />&nbsp;<img src="../img/cal.gif" border="0" alt="Calendario" onClick="window.open('formcalendario.php?calencodigo=fecini','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');" /></td>
		  <td class="NoiseDataTD">Fecha final&nbsp;<input type="text" name="fecfin" size="8" onfocus="if(!agree)this.blur();" />&nbsp;<img src="../img/cal.gif" border="0" alt="Calendario" onClick="window.open('formcalendario.php?calencodigo=fecfin','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');" /></td>
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
onclick=" carga(); form1.action='reportnoconform.php';"  width="86" height="18" alt="Aceptar" border=0>&nbsp;
<input type="image" src="../img/cancelar.gif" border="0" alt="Cancelar" onclick="form1.action='main.php';">
</div>
</td>
 </tr>
 <tr>
  <td class="NoiseErrorDataTD">&nbsp;</td>
 </tr>
</table>
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
</form>
</body>
<?php
if(!$codigo)
{ echo " -->"; }
?>
</html>