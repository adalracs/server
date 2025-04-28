<?php
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktblcamperequipo.php');
include ( '../src/FunPerPriNiv/pktbltiposistemacamperequipo.php');
if(!$flagdetallartiposistema)
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
Autor: 
Fecha:
GenVers: 3.1 -->
<html>
<head>
<title>Detalle de registro de tipo de sistema</title>
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
<p><font class="NoiseFormHeaderFont">Tipo de sistema</font></p>
<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE" width="80%">
  <tr>
    <td class="NoiseErrorDataTD">&nbsp;</td>
  </tr>
  <tr>
          <td class="NoiseFieldCaptionTD"><span class="style5"><font
color="FFFFFF">
Detallar registro</font></span></td></tr>
<tr>
  <td>
            <table width="40%" border="0" align="center" cellpadding="0" cellspacing="1">
<tr>
 <td class="NoiseFooterTD" width="33%">&nbsp;C&oacute;digo</td>
 <td class="NoiseDataTD" width="67%"><?php echo $sbreg["tipsiscodigo"]; ?></td>
</tr>
<tr>
 <td class="NoiseFooterTD">&nbsp;Nombre</td>
 <td class="NoiseDataTD"><?php echo $sbreg["tipsisnombre"]; ?></td>
</tr>
<tr>
 <td class="NoiseFooterTD">&nbsp;Acr&oacute;nimo</td>
 <td class="NoiseDataTD"><?php echo $sbreg["tipsisacroni"]; ?></td>
</tr>
<tr>
 <td class="NoiseFooterTD" valign="top">&nbsp;Descripci&oacute;n</td>
 <td rowspan="2" class="NoiseDataTD"><?php echo $sbreg["tipsisdescri"]; ?></td>
</tr>
<tr>
  <td class="NoiseFooterTD">&nbsp;</td>
</tr>
</table>
<table border="0" align="center" cellpadding="0" cellspacing="1">
<tr>
 <td colspan="6" class="NoiseFieldCaptionTD Estilo1">&nbsp;Sistema</td>
</tr>
			<?php
			include ('../src/FunGen/fnccargatipsiscampos.php');
			
			$idcon = fncconn();
			fnccargatipsiscampos($idcon);
			fncclose($idcon);
			?>
			<tr>
				<td class="NoiseErrorDataTD" colspan="6">&nbsp;Campos personalizados</td>
			</tr>
				<?php
					include('../src/FunGen/fnccargacamperequipo.php');
					$idcon = fncconn();
					fnccargacamperequipo($idcon,'sistema', true, $sbreg["tipsiscodigo"]);
					fncclose($idcon);
				?>
		</table>	</td>
</tr>
<tr>
 <td colspan="2"><div align="center">
   <input type="image" name="aceptar"  src="../img/aceptar.gif"
onClick="form1.action='maestabltiposistema.php';"  width="86" height="18"
alt="Aceptar" border=0>
 </div></td>
</tr>
<tr>
 <td colspan="2" class="NoiseErrorDataTD">&nbsp;</td>
</tr>
</table>
<input type="hidden" name="flagdetallartiposistema" value="1">
<input type="hidden" name="acciondetallartiposistema">
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
</form>
</body>
<?php
if(!$codigo)
{ echo " -->"; }
?>
</html>
