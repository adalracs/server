<?php
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktblcamperequipo.php');
include ( '../src/FunPerPriNiv/pktbltipoequipocamperequipo.php');
if(!$flagborrartipoequipo)
{
	include ( '../src/FunGen/sesion/fnccarga.php');
	$sbreg = fnccarga($nombtabl,$radiobutton);
	if (!$sbreg)
	{
		include( '../src/FunGen/fnccontfron.php');
	}
}
?>
<!-- Propiedad intelectual de Adsum SA (c)
-Todos los derechos reservados-
Creado con WAG Adsum
Autor: Andr�s A. Riascos D.
Fecha: 26052004
GenVers: 3.1 -->
<html>
<head>
<title>Borrar registro de tipoequipo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="0">
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
agree = 0;
//  End -->
</script>
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
-->
</style>
</head>
<?php
if(!$codigo)
{ echo "<!--";}
?>
<body bgcolor="FFFFFF" text="#000000">
<form name="form1" method="post"  enctype="multipart/form-data">
<p><font class="NoiseFormHeaderFont">Tipo de equipo </font></p>
<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE" width="80%">
  <tr>
    <td class="NoiseErrorDataTD">&nbsp;</td>
  </tr>
  <tr>
          <td class="NoiseFieldCaptionTD"><span class="style5"><font
color="FFFFFF">
Borrar registro</font></span></td></tr>
<tr>
  <td>
            <table width="40%" border="0" cellspacing="1" cellpadding="0"
align="center">
<tr>
 <td width="33%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td>
 <td width="67%" class="NoiseDataTD"><?php echo $sbreg["tipequcodigo"]; ?></td>
</tr>
<tr>
 <td class="NoiseFooterTD">&nbsp;Nombre</td>
 <td class="NoiseDataTD"><?php echo $sbreg["tipequnombre"]; ?></td>
</tr>
<tr>
 <td class="NoiseFooterTD">&nbsp;Acr&oacute;nimo</td>
 <td class="NoiseDataTD"><?php echo $sbreg["tipequacroni"]; ?></td>
</tr>
<tr>
 <td class="NoiseFooterTD" valign="top">&nbsp;Descripci&oacute;n</td>
 <td rowspan="2" class="NoiseDataTD"><?php echo $sbreg["tipequdescri"]; ?></td>
</tr>
<tr class="NoiseFooterTD">
  <td class="NoiseFooterTD">&nbsp;</td>
</tr>
</table>
<table border="0" align="center" cellpadding="0" cellspacing="1">
<tr>
 <td colspan="6" class="NoiseFieldCaptionTD Estilo1">&nbsp;Equipo</td>
</tr>
			<?php
			include ('../src/FunGen/fnccargatipequcampos.php');
			
			$idcon = fncconn();
			fnccargatipequcampos($idcon);
			fncclose($idcon);
			?>
			<tr>
				<td colspan="6" class="NoiseErrorDataTD">&nbsp;Campos personalizados</td>
			</tr>
				<?php
					include('../src/FunGen/fnccargacamperequipo.php');
					$idcon = fncconn();
					fnccargacamperequipo($idcon,'equipo', true, $sbreg["tipequcodigo"]);
					fncclose($idcon);
				?>
		</table>	</td>
</tr>
<tr>
<td><div align="center">
  <input type="image" name="aceptar"  src="../img/aceptar.gif"
onClick="form1.accionborrartipoequipo.value =  1;
form1.action='maestabltipoequipo.php';"  width="86" height="18" alt="Aceptar"
border=0>
  <input type="image" name="cancelar" src="../img/cancelar.gif"
onClick="form1.action='maestabltipoequipo.php';"  width="86" height="18"
alt="Cancelar" border=0>
</div></td>
</tr>
<tr>
<td class="NoiseErrorDataTD">&nbsp;</td>
</tr>
</table>
  </td>
 </tr>
</table>
 <input type="hidden" name="flagborrartipoequipo" value="1">
<input type="hidden" name="accionborrartipoequipo">
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
<input type="hidden" name="tipequcodigo"	value="<?php echo $sbreg["tipequcodigo"]; ?>">
</form>
</body>
<?php
if(!$codigo)
{ echo " -->"; }
?>
</html>