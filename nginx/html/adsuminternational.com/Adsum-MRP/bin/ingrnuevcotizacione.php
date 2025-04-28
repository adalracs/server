<?php 
ob_start(); 
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktblusuario.php'); 
if($accionnuevocotizacione) 
{ 
	include ( 'grabacotizacione.php'); 
} 
ob_end_flush();

$idcon = fncconn();

$arrusr = loadrecordusuario($usuacodi,$idcon);
$usrname = $arrusr[usuanombre]." ".$arrusr[usuapriape]." ".$arrusr[usuasegape];

fncclose($idcon);

$fecactual = date("Y-m-d");
$horactual = date("H:i:s");
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andr�s A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Nuevo registro de cotizacione</title> 
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
<body bgcolor="FFFFFF" text="#000000"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Cotizaci&oacute;n</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td width="525" class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Ingresar nuevo registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="95%" border="0" cellspacing="0" cellpadding="3" 
align="center">
<tr> 
 <td width="24%">&nbsp;</td> 
 <td colspan="3" align="right">Fecha: <?php echo $fecactual;?>
 &nbsp;&nbsp;&nbsp;&nbsp;Hora:&nbsp;<?php echo substr($horactual,0,5);?>
 </td>
 </tr>
 <tr> 
		<td>Encargado:</td>
		<td width="19%">Cod.&nbsp;<input type="text" name="usuacodi" onfocus="if(!agree)this.blur();" size="5" value="<?php if(!$flagnuevocotizacione){ echo $usuacodi;}else{ echo $usuacodi; }?>"></td>
		<td width="14%">Nombre&nbsp;</td>
		<td width="43%"><input type="text" size="28" name="usrname" value="<?if(!$flagnuevocotizacione) echo $usrname; else echo $usrname;?>" onfocus="if(!agree)this.blur();"></td>
 </tr>
<tr>
<td colspan="4"><hr></td>
</tr>
<tr> 
 	<td><?php if($campnomb["proveecodigo"] == 1){$proveecodigo = null; $proveenombre = null; echo 
"*";}?>Proveedor:&nbsp;&nbsp;
		<input name="radio1"  type="radio" onclick="window.open('consultarproveedogen.php?codigo=<?php echo $codigo?>','equipogen','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" alt="Cancelar" border=0 href="#" target="_parent">
		<td>Cod.&nbsp;<input type="text" name="proveecodigo" onfocus="if(!agree)this.blur();" size="5" value="<?php if(!$flagnuevocotizacione){ echo $sbreg[proveecodigo];}else{ echo $proveecodigo; }?>"></td>
		<td>Nombre</td>
		<td><input type="text" size="28" name="proveenombre" value="<?if($flagnuevocotizacione) echo $proveenombre;?>" onfocus="if(!agree)this.blur();"></td>
 </tr>
 <tr>
<td colspan="4"><hr></td>
</tr>  
<tr> 
 <td><?php if($campnomb["cotiznombre"] == 1){$cotiznombre = null; echo 
"*";}?>Nombre&nbsp;&nbsp;</td>
  <td colspan="3"><input type="text" name="cotiznombre"	size="24" value="<?php 
if(!$flagnuevocotizacione){ echo $sbreg[cotiznombre];}else{ echo $cotiznombre; 
}?>"> 
 </td>
 </tr>  
<tr> 
 <td><?php if($campnomb["cotizdescri"] == 1){$cotizdescri = null; echo 
"*";}?>Descripci&oacute;n</td>
<td colspan="3">
<textarea name="cotizdescri" rows="3" cols="45"><?php 
if(!$flagnuevocotizacione){ echo $sbreg[cotizdescri];}else{ echo $cotizdescri; 
}?></textarea>
</td> 
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
onclick="form1.accionnuevocotizacione.value =  1;"  width="86" height="18" 
alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablcotizacione.php';"  width="86" height="18" 
alt="Cancelar" border=0>
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
<?php
if($campnomb){echo '<font face = "Verdana" >Corregir los capos marcados con 
*</font>';} 
?> 
<input type="hidden" name="cotizacodigo" value="<?php 
if(!$flagnuevocotizacione){ echo $sbreg[cotizacodigo];}else{ echo 
$cotizacodigo; } ?>"> 
<input type="hidden" name="accionnuevocotizacione"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="cotizafecha" value="<?php echo $fecactual; ?>"> 
<input type="hidden" name="cotizahora" value="<?php echo $horactual; ?>"> 
</form>
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
