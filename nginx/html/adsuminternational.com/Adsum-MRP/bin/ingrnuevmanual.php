<?php 
ob_start();
include ( '../src/FunGen/sesion/fncvalses.php'); 
if($accionnuevomanual)
{
	include ( 'grabamanual.php');
}
ob_end_flush();
?> 
<html> 
<head> 
<title>Nuevo registro de manual</title> 
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
<body bgcolor="FFFFFF" text="#000000"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Manuales</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" width="50%"
class="NoiseFormTABLE"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Ingresar nuevo registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="85%" border="0" cellspacing="0" cellpadding="3" 
align="center"> 
<tr> 
 <td width="41%"><?php if($campnomb["manualnombre"] == 1){ $manualnombre=null;
echo "*";}
?>Nombre </td> 
  <td><input type="text" name="manualnombre" value="<?php if(!$flagnuevomanual){ echo $sbreg[manualnombre];} else {echo $manualnombre;}?>"> 
  </td> 
 </tr> 
<tr>
  <td width="41%"><?php if($campnomb["manualruta"] == 1){ $manualruta = null;
echo "*";}
?>Ruta</td>
  <td><input type="file" name="file" onkeydown="this.blur();"></td>
  </tr>
<tr> 
 <td width="41%"><?php if($campnomb["manualdescri"] == 1){ $manualdescri=null;
echo "*";}
?>Descripci&oacute;n</td> 
  <td rowspan="2"><textarea name="manualdescri" rows="3" wrap="VIRTUAL"><?php if(!$flagnuevomanual){ 
echo $sbreg[manualdescri];} else {echo $manualdescri;}?></textarea> 
  </td> 
 </tr>
<tr>
  <td>&nbsp;</td>
</tr> 
 <tr> 
  <td colspan="2">Recuerde que el peso m&aacute;ximo del archivo debe ser de 1 Mb&nbsp;</td> 
 </tr> 
</table>  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionnuevomanual.value =  1;"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablmanual.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
<?php 
if($campnomb){ echo '<font face="Verdana" >Corregir los campos marcados con *</font>';} 
 ?>
<input type="hidden" name="manualcodigo" value="<?php if(!$flagnuevomanual){ echo $sbreg[manualcodigo];}else{ echo $manualcodigo;} ?>">
<input type="hidden" name="manualruta1" value="<?php echo $manualruta;?>">
<input type="hidden" name="accionnuevomanual"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
