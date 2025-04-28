<?php 
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktblusuario.php'); 
include ( '../src/FunPerPriNiv/pktblproveedo.php'); 
if(!$flagborrarcotizacione) 
{ 
include ( '../src/FunGen/sesion/fnccarga.php'); 
$sbreg = fnccarga($nombtabl,$radiobutton); 
if (!$sbreg) 
	{ 
		include( '../src/FunGen/fnccontfron.php'); 
	} 
}
$idcon = fncconn();

$arrusr = loadrecordusuario($sbreg[usuacodi],$idcon);
$arrpro = loadrecordproveedo($sbreg[proveecodigo],$idcon);

$usrname = $arrusr[usuanomb]." " .$arrusr[usuapriape]." ".$arrusr[usuasegape];

fncclose($idcon); 
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andr�s A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Borrar registro de cotizacione</title> 
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
class="NoiseFormTABLE" width="78%"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Borrar registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="85%" border="0" cellspacing="0" cellpadding="3" 
align="center"> 
<tr> 
 <td width="30%">&nbsp;</td> 
 <td width="30%">&nbsp; 
 </td><td width="40%">Hora:&nbsp;<?php echo substr($sbreg[cotizahora],0,5);?>
 &nbsp;&nbsp;&nbsp;&nbsp;
 Fecha: <?php echo $sbreg[cotizafecha];?></td>
 </tr>
 <tr>
<td colspan="3">C&oacute;digo&nbsp;&nbsp;<input type="text" size="5" name="cotizacodigo" onfocus="if(!agree)this.blur();"
value="<?php echo $sbreg[cotizacodigo]?>"></td>
</tr>
 <tr> 
 <td colspan="3">
<table width="100%" border="0">
	<tr>
		<td>Encargado:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		C&oacute;digo&nbsp;
		<input type="text" name="usuacodi" onfocus="if(!agree)this.blur();" size="5" value="<?php if(!$flagborrarcotizacione){ 
echo $sbreg[usuacodi];}else{ echo $arrusr[usuacodi]; }?>">
		</td>
		<td>Nombre&nbsp;
		<input type="text" size="28" name="usrname" value="<?php if(!$flagborrarcotizacione) echo $usrname; else echo $usrname;?>"
onfocus="if(!agree)this.blur();">
		</td>
	</tr>
</table>
</td>
 </tr>
<tr>
<td colspan="3"><hr></td>
</tr> 
 <td colspan="3">
<table width="100%" border="0">
	<tr>
		<td>Proveedor:&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		C&oacute;digo&nbsp;
		<input type="text" name="proveecodigo" onfocus="if(!agree)this.blur();" size="5" value="<?php 
if(!$flagborrarcotizacione){ echo $sbreg[proveecodigo];}else{ echo 
$proveecodigo; }?>">
		</td>
		<td>Nombre&nbsp;
		<input type="text" size="28" name="proveenombre" value="<?php if(!$flagborrarcotizacione) echo $arrpro[proveenombre];
		else echo $proveenombre;?>"
onfocus="if(!agree)this.blur();">
		</td>
	</tr>
</table>
</td>
 </tr>
 <tr>
<td colspan="3"><hr></td>
</tr>  
<tr> 
 <td colspan="2">Nombre&nbsp;&nbsp;
  <input type="text" onfocus="if(!agree) this.blur();"  name="cotiznombre"	size="24" value="<?php 
if(!$flagborrarcotizacione){ echo $sbreg[cotiznombre];}else{ echo $cotiznombre; 
}?>"> 
 </td>
 </tr>  
<tr> 
 <td colspan="3">Descripci&oacute;n<br>
<textarea name="cotizdescri" onfocus="if(!agree) this.blur();" rows="3" cols="65"><?php 
if(!$flagborrarcotizacione){ echo $sbreg[cotizdescri];}else{ echo $cotizdescri; 
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
onclick="form1.accionborrarcotizacione.value =  1; 
form1.action='maestablcotizacione.php';"  width="86" height="18" alt="Aceptar" 
border=0> 
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
 <input type="hidden" name="flagborrarcotizacione" value="1"> 
<input type="hidden" name="accionborrarcotizacione"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
