<?php
ob_start();
include('../src/FunPerPriNiv/pktblcentcost.php');
include('../src/FunPerPriNiv/pktblunimedida.php');
include ( '../src/FunGen/sesion/fncsesact.php');
include ( '../src/FunGen/sesion/fncvalopcmen.php');
include ( '../src/FunPerPriNiv/pktblsesion.php');
include ( '../src/FunPerSecNiv/fncconn.php');
include ( '../src/FunPerSecNiv/fncclose.php');
if($accionnuevoitem)
{
	include ( 'grabaitem.php');
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
<title>Nuevo registro de item</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="0">
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
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
<body bgcolor="FFFFFF" text="#000000" onload="this.focus();">
<form name="form1" method="post"  enctype="multipart/form-data">
<p><font class="NoiseFormHeaderFont">Item</font></p>
<table border="0" cellspacing="1" cellpadding="2" align="center"
class="NoiseFormTABLE">
  <tr>
    <td width="612" class="NoiseErrorDataTD">&nbsp;</td>
  </tr>
  <tr>
          <td class="NoiseFieldCaptionTD"><span class="style5"><font
color="FFFFFF">
Ingresar nuevo registro</font></span></td></tr>
<tr>
  <td>
            <table width="97%" border="0" cellspacing="1" cellpadding="0"
align="center">
              <tr>
                <td width="20%"></td>
<td colspan="3">
</tr>
<tr>
 <td width="20%"><?php if($campnomb == "itemnombre"){ $itemnombre=null;
 echo "*";}
 ?>Nombre</td>
 <td colspan="3">
  <input type="text" name="itemnombre"	value="<?php if(!$flagnuevoitem){ echo
$sbreg[itemnombre];}else{ echo $itemnombre;}?>">
 </td>
 </tr>
<tr>
 <td width="20%"><?php if($campnomb == "cencoscodigo"){ $cencoscodigo=null;
 echo "*";}
 ?>C&oacute;digo financiero</td>
 <td width="28%">
 <select name="cencoscodigo">
 <?php
    	if(!$flagnuevoitem)
            {
            	echo '<option value = "">Seleccione'; 
            }
            elseif ($accionnuevoitem)
            {
            	if($cencoscodigo)
            	{
	            	echo '<option value = "'.$cencoscodigo.'">'; 
	                $idcon	= fncconn();
					$arrcentcost = loadrecordcentcost($cencoscodigo,$idcon);
					echo $arrcentcost[cencosnumero];
					fncclose($idcon);
            	}else
            	{
            	echo '<option value = "">Seleccione'; 
            	}
            }?></OPTION>        
 <?php
	include ('../src/FunGen/floadcentcost.php');
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
<td width="20%"><?php if($campnomb == "unidadcodigo"){ $unidadcodigo = null;
 echo "*";}
 ?>Unidad de medida</td>
<td width="28%"><select name="unidadcodigo">
  <?php
    	if(!$flagnuevoitem)
            {
            	echo '<option value = "">Seleccione'; 
            }
            elseif ($accionnuevoitem)
            {
            	if($unidadcodigo)
            	{
	            	echo '<option value = "'.$unidadcodigo.'">'; 
	                $idcon	= fncconn();
					$arrunimedida= loadrecordunimedida($unidadcodigo,$idcon);
					echo $arrunimedida[unidadacra];
					fncclose($idcon);
            	}else
            	{
            	echo '<option value = "">Seleccione'; 
            	}
            }
 ?>
  <?php
	include ('../src/FunGen/floadunimedida.php');
	$idcon = fncconn();
	floadunimedida($idcon);
	fncclose($idcon);
 ?>
</select>
 </td>
 <td width="20%"><?php if($campnomb == "itemvalor"){ $itemvalor = null;
 echo "*";}
 ?>
   Valor</td>
 <td width="32%"><input type="text" name="itemvalor"	value="<?php if(!$flagnuevoitem){ echo
$sbreg[itemvalor];}else{ echo $itemvalor;}?>"></td>
</tr>
<tr>
 <td width="20%"><?php if($campnomb == "itemcanmin"){ $itemcanmin=null;
 echo "*";}
 ?>
   Cantidad M&iacute;nima</td>
 <td width="28%"><input type="text" name="itemcanmin"	value="<?php if(!$flagnuevoitem){ echo
$sbreg[itemcanmin];}else{ echo $itemcanmin;}?>"></td>
 <td width="20%"><?php if($campnomb == "itemcanmax"){ $itemcanmax=null;
 echo "*";}
 ?>
   Cantidad M&aacute;xima</td>
 <td width="32%"><input type="text" name="itemcanmax"	value="<?php if(!$flagnuevoitem){ echo
$sbreg[itemcanmax];}else{ echo $itemcanmax;}?>"></td>
</tr>
<tr>
 <td width="20%"><?php if($campnomb == "itemnota"){ $itemnota=null;
 echo "*";}
 ?>Nota</td>
 <td colspan="3" rowspan="2">
   <textarea name="itemnota" cols="30" rows="3" wrap="VIRTUAL"><?php if(!$flagnuevoitem){ echo
 $sbreg[itemnota];}else{ echo $itemnota;} ?></textarea> </td>
 </tr>
 <tr>
  <td width="20%">&nbsp;</td>
 </tr>
</table>
  </td>
 </tr>
 <tr>
<td>
<div align="center">
  <input type="image" name="aceptar"  src="../img/aceptar.gif"
onclick="form1.accionnuevoitem.value =  1;"  width="86" height="18"
alt="Aceptar" border=0>
  <input type="image" name="cancelar" src="../img/cancelar.gif"
onclick="window.close();"  width="86" height="18"
alt="Cancelar" border=0>
<img src="../img/ayuda.gif" border="0" alt="Ayuda">
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
<input type="hidden" name="itemcodigo"	value="<?php if(!$flagnuevoitem){ echo $sbreg[itemcodigo];}else{ echo $itemcodigo;}?>">
<input type="hidden" name="itemdisponib"	value="<?php if(!$flagnuevoitem){ $itemdispon = 0; echo $itemdispon;}else{ echo $itemdispon;}?>">
<input type="hidden" name="accionnuevoitem">
<input type="hidden" name="flag" value="1">
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
</form>
</body>
<?php
    if(!$codigo)
    { echo " -->"; }
?>
</html>