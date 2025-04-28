<?php
ob_start();
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktblcamperequipo.php');
if($accionnuevotipoequipo)
{
	include ( 'grabatipoequipo.php');
}
ob_end_flush();
?>
<!-- Propiedad intelectual de Adsum SA (c)
-Todos los derechos reservados-
Creado con WAG Adsum
Autor: Andr�s A. Riascos D.
Fecha: 26052004
GenVers: 3.1 -->
<html>
<head>
<title>Nuevo registro de tipo de equipo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="0">
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
<script language="Javascript" type="text/javascript">
function carga()
{
	var campo_string;
	var form_ref = window.document.forms[0];
	var c = 0;

	for(var i=0; i<form_ref.elements.length; i++)
	{
		if(form_ref.elements[i].type == "checkbox")
		{
			if((form_ref.elements[i].checked == true) && (form_ref.elements[i].disabled == false))
			{
				(c == 0) ? campo_string = form_ref.elements[i].value : campo_string = campo_string + "," + form_ref.elements[i].value;
				c++;
			}
		}
	}
	if(campo_string == undefined)
		campo_string = "";

	window.document.form1.arreglo_aux.value = campo_string;
}
</script>
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
<p><font class="NoiseFormHeaderFont">Tipo de equipo</font></p>
<table width="85%" border="0" align="center" cellpadding="2" cellspacing="1" class="NoiseFormTABLE">
  <tr>
    <td class="NoiseErrorDataTD">&nbsp;</td>
  </tr>
  <tr>
     <td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Ingresar nuevo registro</font></span></td>
  </tr>
  <tr>
  	<td>
		<table width="47%" border="0" align="center" cellpadding="0" cellspacing="1">
			<tr>
				<td class="NoiseFooterTD"><?php if($campnomb["tipequnombre"] == 1){ $tipequnombre = null; echo "*";}?>Nombre</fontS></td>
 				<td class="NoiseFooterTD"><input type="text" name="tipequnombre"	value="<?php if(!$flagnuevotipoequipo){ echo $sbreg[tipequnombre];}else{ echo $tipequnombre; }?>" size="21"></td>
			</tr>
			<tr>
				 <td class="NoiseFooterTD"><?php if($campnomb["tipequacroni"] == 1){ $tipequacroni = null; echo "*";}?>Acr&oacute;nimo</td>
				 <td class="NoiseFooterTD"><input type="text" name="tipequacroni"	value="<?php if(!$flagnuevotipoequipo){ echo $sbreg[tipequacroni];}else{ echo $tipequacroni; }?>" size="21"></td>
			</tr>
			<tr>
				 <td class="NoiseFooterTD"><?php if($campnomb["tipequdescri"] == 1){$tipequdescri = null; echo "*";}?>Descripci&oacute;n</td>
				 <td rowspan="3" class="NoiseFooterTD"><textarea name="tipequdescri" rows="3" wrap="VIRTUAL"><?php if(!$flagnuevotipoequipo){ echo $sbreg[tipequdescri];}else{ echo $tipequdescri; }?></textarea></td>
			</tr>
			<tr class="NoiseDataTD">
			  <td class="NoiseFooterTD">&nbsp;</td>
		  </tr>
		</table>
			<table width="95%" border="0" align="center" cellpadding="0" cellspacing="1">
			<tr>
 				<td colspan="6" class="NoiseFieldCaptionTD Estilo1">&nbsp;Campos predeterminados del equipo </td>
			</tr>
			<?php
							include('../src/FunGen/fnccargatipequcampos.php');
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
							fnccargacamperequipo($idcon,'equipo');
							fncclose($idcon);
						?>
					<!--<?php echo $codigo?>-->
		</table>	  </td>
	</tr>
			<tr>
 				<td colspan="2"><div align="center">
 				  <input type="image" name="aceptar"  src="../img/aceptar.gif"
onClick="carga(); form1.accionnuevotipoequipo.value =  1;"  width="86" height="18"
alt="Aceptar" border=0>
 				  <input type="image" name="cancelar" src="../img/cancelar.gif"
onClick="form1.action='maestabltipoequipo.php';"  width="86" height="18"
alt="Cancelar" border=0>
			    </div></td>
			</tr>
						<tr>
 				<td colspan="2" class="NoiseErrorDataTD">&nbsp;</td>
			</tr>
  </table>

<?php
if($campnomb){echo '<font face = "Verdana" >Corregir los capos marcados con
*</font>';}
?>
<input type="hidden" name="tipequcodigo" value="<?php if(!$flagnuevotipoequipo){ echo $sbreg[tipequcodigo];}else{ echo $tipequcodigo;} ?>">
<input type="hidden" name="accionnuevotipoequipo">
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
<input type="hidden" name="arreglo_aux" value="<?php echo $arreglo_aux; ?>">
<!--<input type="text" name="tipequcampo1" onfocus="submit();" size="0" maxlength="0" style="border:none">-->
</form>
</body>
<?php
    if(!$codigo)
    { echo " -->"; }
?>
</html>