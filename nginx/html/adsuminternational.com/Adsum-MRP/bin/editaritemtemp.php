<?php
ob_start();
include ( '../src/FunGen/sesion/fncvalses.php');;
include('../src/FunPerPriNiv/pktblcentcost.php');
include('../src/FunPerPriNiv/pktblproveedo.php');
include('../src/FunPerPriNiv/pktblunimedida.php');

if($accioneditaritem)
{
		include ('editaitemtemp.php');
		$flageditaritem = 1;
}
ob_end_flush();

if(!$flageditaritem)
{
	include ( '../src/FunGen/sesion/fnccarga.php');

	$sbreg = fnccarga($nombtabl,$radiobutton);

	if(!$sbreg)
	{
		include( '../src/FunGen/fnccontfron.php');
	}
}
?>
<html>
<head>
<title>Editar registro de item</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="0">
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
agree = 0;
//  End -->
</script>
<script language="JavaScript" src="motofech.js"></script>
<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js" type="text/javascript" ></SCRIPT>
<script language=JavaScript src="../src/FunGen/cargarProveeselec.js" type="text/javascript" ></script>
</head>
<?php
if(!$codigo)
{ echo "<!--";}
?>
<body bgcolor="FFFFFF" text="#000000" <?php  if(($flageditaritem) && !(empty($arreglo_aux))) echo "onload=\"cargarProveeselec('".$arreglo_aux."');\"";?>>
 <font class="NoiseFormHeaderFont">Item</font>
 <form name="form1" method="post"  enctype="multipart/form-data">
  <table border="0" cellspacing="1" cellpadding="2" align="center"
class="NoiseFormTABLE">
  <tr>
    <td width="612" class="NoiseErrorDataTD">&nbsp;</td>
  </tr>
  <tr>
          <td class="NoiseFieldCaptionTD"><span class="style5"><font
color="FFFFFF">
Editar registro</font></span></td></tr>
<tr>
  <td>
            <table width="97%" border="0" cellspacing="1" cellpadding="0"
align="center">
              <tr>
                <td width="20%"></td>
<td colspan="3">
</tr>
<tr>
 <td width="20%"><?php if($campnomb["itemnombre"] == 1){ $itemnombre=null;
 echo "*";}?>Nombre</td>
 <td colspan="3">
  <input type="text" name="itemnombre"	value="<?php if(!$flageditaritem){ echo
$sbreg['itetemnombre'];}else{ echo $itemnombre;}?>">
 </td>
 </tr>
<tr>
 <td width="20%"><?php if($campnomb["cencoscodigo"] == 1){ $cencoscodigo=null;
 echo "*";}
 ?>C&oacute;digo financiero</td>
 <td width="28%">
 <select name="cencoscodigo">
 <?php
include ('../src/FunGen/floadcentcost.php');

if(!$flageditaritem)
{
	if(!empty($sbreg['cencoscodigo']))
	{
		$idcon = fncconn();
		$arrcentcost = loadrecordcentcost($sbreg['cencoscodigo'], $idcon);
		echo "<option value='".$arrcentcost['cencoscodigo']."'>".$arrcentcost['cencosnumero'];
		echo "</option>";
		fncclose($idcon);
	}
	else echo "<option value=''>Seleccione</option>";
}
else {
	if(!empty($cencoscodigo))
	{
		$idcon = fncconn();
		$arrcentcost = loadrecordcentcost($cencoscodigo, $idcon);
		echo "<option value='".$arrcentcost['cencoscodito']."'>".$arrcentcost['cencosnumero'];
		echo "</option>";
		fncclose($idcon);
	}
	else echo "<option value=''>Seleccione</option>";
}

$idcon = fncconn();
floadcentcost($idcon);
fncclose($idcon);
 ?>
 </select>
 </td>
 <td width="20%">&nbsp;</td>
 <td width="32%">&nbsp;</td>
</tr>
<tr>
<td width="20%"><?php if($campnomb["unidadcodigo"] == 1){ $unidadcodigo = null;
 echo "*";}
 ?>
  Unidad de medida</td>
<td width="28%"><select name="unidadcodigo">
<?php
include ('../src/FunGen/floadunimedida.php');

if(!$flageditaritem)
{
	if(!empty($sbreg['unidadcodigo']))
	{
		$idcon = fncconn();
		$arrunimedida = loadrecordunimedida($sbreg['unidadcodigo'], $idcon);
		echo "<option value='".$arrunimedida['unidadcodigo']."'>".$arrunimedida['unidadacra'];
		echo "</option>";
		fncclose($idcon);
	}
	else echo "<option value=''>Seleccione</option>";
}
else {
	if(!empty($unidadcodigo))
	{
		$idcon = fncconn();
		$arrunimedida = loadrecordunimedida($unidadcodigo, $idcon);
		echo "<option value='".$arrunimedida['unidadcodigo']."'>".$arrunimedida['unidadacra'];
		echo "</option>";
		fncclose($idcon);
	}
	else echo "<option value=''>Seleccione</option>";
}
$idcon = fncconn();
floadunimedida($idcon);
fncclose($idcon);
 ?>
</select>
 </td>
 <td width="20%"><?php if($campnomb["itemvalor"] == 1){ $itemvalor = null;
 echo "*";}
 ?>
   Valor</td>
 <td width="32%"><input type="text" name="itemvalor" value="<?php if(!$flageditaritem){ echo
$sbreg['itetemvalor'];}else{ echo $itemvalor;}?>"></td>
</tr>
<tr>
 <td width="20%"><?php if($campnomb["itemcanmin"] == 1){ $itemcanmin=null;
 echo "*";}
 ?>
   Cantidad M&iacute;nima</td>
 <td width="28%"><input type="text" name="itemcanmin"	value="<?php if(!$flageditaritem){ echo
$sbreg['itetemcanmin'];}else{ echo $itemcanmin;}?>"></td>
 <td width="20%"><?php if($campnomb["itemcanmax"] == 1){ $itemcanmax=null;
 echo "*";}
 ?>
   Cantidad M&aacute;xima</td>
 <td width="32%"><input type="text" name="itemcanmax"	value="<?php if(!$flageditaritem){ echo
$sbreg['itetemcanmax'];}else{ echo $itemcanmax;}?>"></td>
</tr>
<tr>
 <td width="20%"><?php if($campnomb["itemnota"] == 1){ $itemnota=null;
 echo "*";}
 ?>Nota</td>
 <td colspan="3" rowspan="2">
   <textarea name="itemnota" cols="30" rows="3" wrap="VIRTUAL"><?php if(!$flageditaritem){ echo
 $sbreg['itetemnota'];}else{ echo $itemnota;} ?></textarea> </td>
 </tr>
 <tr>
  <td width="20%">&nbsp;</td>
 </tr>
  <tr>
  <td width="20%">&nbsp;</td>
 </tr>
 <tr>
  <td colspan="4"><hr></td>
 </tr>
 <tr>
  <td><?php if($campnomb["proveeselec"] == 1){ echo "*";}?>Proveedores&nbsp;&nbsp;<input type="radio" name="opnProveedo" onclick="window.open('consultaritemproveedo.php?codigo=<?php echo $codigo?>','ventana','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" onfocus="cargarProveeselec(document.form1.arreglo_aux.value);" <?php if(($flageditaritem) && !(empty($arreglo_aux))) echo "checked"; ?> /><br /><br />
  <select name="proveeselec" size="3"></select>
  </td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 </tr>
</table>
  </td>
 </tr>
 <tr>
<td>
<div align="center">
  <input type="image" name="aceptar"  src="../img/aceptar.gif"
onclick="form1.accioneditaritem.value =  1;" width="86" height="18" alt="Aceptar" border=0>
  <input type="image" name="cancelar" src="../img/cancelar.gif"
onclick="form1.action='maestablitemtemp.php';"  width="86" height="18"
alt="Cancelar" border=0>
</div>
</td>
 </tr>
 <tr>
  <td class="NoiseErrorDataTD">&nbsp;</td>
 </tr>
</table>
<?php
if($campnomb){ echo '<font face= "Verdana" >Corregir los campos marcados con *</font>';}
?>
<input type="hidden" name="itetemcodigo"	value="<?php if(!$flageditaritem){ echo $sbreg['itetemcodigo'];}else{ echo $itetemcodigo;}?>">
<input type="hidden" name="accioneditaritem">
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
<!--																	 -->
<input type="hidden" name="arreglo_aux" value="<?php echo $arreglo_aux; ?>">
<!--																	 -->
</form>
</body>
<?php
if(!$codigo)
{ echo " -->"; }
?>
</html>