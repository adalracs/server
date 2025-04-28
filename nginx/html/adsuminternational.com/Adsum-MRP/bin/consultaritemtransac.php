<?php 
//include ( '../src/FunGen/sesion/fncvalses.php'); 
include('../src/FunPerSecNiv/fncconn.php');
include('../src/FunPerSecNiv/fncclose.php');
include('../src/FunPerSecNiv/fncnumreg.php');
include('../src/FunPerSecNiv/fncfetch.php');
include('../src/FunPerPriNiv/pktblproveedo.php');
include('../src/FunPerPriNiv/pktblcentcost.php');
include('../src/FunPerPriNiv/pktblunimedida.php');
?> 
<html> 
<head> 
<title>Consultar en item</title> 
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
Consultar registro</font></span></td></tr>
<tr>
  <td>
            <table width="97%" border="0" cellspacing="1" cellpadding="0"
align="center">
              <tr>
                <td width="20%"></td>
<td colspan="3"></td>
</tr>
<tr>
 <td width="20%">C&oacute;digo</td>
 <td colspan="3">
  <input type="text" name="itemcodigo"	value="<?php if(!$flagconsultaritem){ echo
$sbreg[itemcodigo];}else{ echo $itemcodigo;}?>" size="15">
 </td>
 </tr>
<tr>
 <td width="20%">Nombre</td>
 <td colspan="3">
  <input type="text" name="itemnombre"	value="<?php if(!$flagconsultaritem){ echo
$sbreg[itemnombre];}else{ echo $itemnombre;}?>">
 </td>
 </tr>
<tr>
 <td width="20%">C&oacute;digo financiero</td>
 <td width="28%">
 <select name="cencoscodigo">
 <?php
    	if(!$flagconsultaritem)
            {
            	echo '<option value = "">Seleccione'; 
            }
            elseif ($accionconsultaritem)
            {
            	if($cencoscodigo)
            	{
	            	echo '<option value = "'.$cencoscodigo.'">'; 
	                $idcon	= fncconn();
					$arrcentcost = loadrecordcentcost($cencoscodigo,$idcon);
					echo $arrcentcost[cencosnombre];
					fncclose($idcon);
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
<td width="20%">Unidad de medida</td>
<td width="28%"><select name="unidadcodigo">
  <?php
    	if(!$flagconsultaritem)
            {
            	echo '<option value = "">Seleccione'; 
            }
            elseif ($accionconsultaritem)
            {
            	if($unidadcodigo)
            	{
	            	echo '<option value = "'.$unidadcodigo.'">'; 
	                $idcon	= fncconn();
					$arrunimedida= loadrecordunimedida($unidadcodigo,$idcon);
					echo $arrunimedida[unidadacra];
					fncclose($idcon);
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
 <td width="20%">Valor</td>
 <td width="32%"><input type="text" name="itemvalor"	value="<?php if(!$flagconsultaritem){ echo
$sbreg[itemvalor];}else{ echo $itemvalor;}?>"></td>
</tr>
<tr>
 <td width="20%">Cantidad M&iacute;nima</td>
 <td width="28%"><input type="text" name="itemcanmin"	value="<?php if(!$flagconsultaritem){ echo
$sbreg[itemcanmin];}else{ echo $itemcanmin;}?>"></td>
 <td width="20%">Cantidad M&aacute;xima</td>
 <td width="32%"><input type="text" name="itemcanmax"	value="<?php if(!$flagconsultaritem){ echo
$sbreg[itemcanmax];}else{ echo $itemcanmax;}?>"></td>
</tr>
<tr>
 <td width="20%">Cantidad Disponible</td>
 <td width="28%"><input type="text" name="itemdispon"	value="<?php if(!$flagconsultaritem){ 
echo $sbreg[itemdispon];}else{ echo $itemdispon;}?>"></td>
 <td colspan="2"></td>
</tr>
<tr>
 <td width="20%">Nota</td>
 <td colspan="3" rowspan="2">
   <textarea name="itemnota" cols="30" rows="3" wrap="VIRTUAL"><?php if(!$flagconsultaritem){ echo
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
onclick="form1.accionconsultaritem.value =  1; 
form1.action='maestablitemtransac.php';"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="window.close();"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagconsultaritem" value="1"> 
<input type="hidden" name="accionconsultaritem"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="columnas" value="itemcodigo, 
unidadcodigo,
cencoscodigo,
itemnombre,
itemcanmin,
itemcanmax, 
itemvalor, 
itemnota,
itemdispon
"> 
<input type="hidden" name="nombtabl" value="item"> 
<input type="hidden" name="accionconsultartransacitem" value="<?php echo $accionconsultartransacitem; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
