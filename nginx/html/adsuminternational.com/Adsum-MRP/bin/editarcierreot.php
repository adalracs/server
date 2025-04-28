<?php 
ob_start();
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktblusuario.php');
include ( '../src/FunPerPriNiv/pktbltipocump.php');
if($accioneditarcierreot)
{
	include ( 'editacierreot.php');
	$foo = $reportcodigo."|x";
	$flageditarcierreot = 1;
}
ob_end_flush();
if(!$flageditarcierreot)
{
	include ( '../src/FunGen/sesion/fnccarga.php');
	$sbreg = fnccarga($nombtabl,$radiobutton);
	if (!$sbreg)
	{
		include( '../src/FunGen/fnccontfron.php');
	}
	$idcon = fncconn();

	$foo = $sbreg[reportcodigo]."|x";	
	
	$vartipocump = $sbreg["tipcumcodigo"];
	$arrtipocump = loadrecordtipocump($vartipocump,$idcon);
	$codtipocump = $arrtipocump["tipcumcodigo"];
	
	$arrusr = loadrecordusuario($sbreg["usuacodi"],$idcon);
	$usrname = $arrusr["usuanombre"]." ".$arrusr["usuapriape"]." ".$arrusr["usuasegape"];
	fncclose($idcon);
}?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andrés A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Editar registro de cierreot</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<script language="JavaScript" type="text/javascript" src="../src/FunGen/jsrsClient.js"></script>
<script language="JavaScript" type="text/javascript" src="../src/FunGen/cargarReporteot.js"></script>
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
<body bgcolor="FFFFFF" onload="window.document.form1.usrname.value = window.document.form1.usuanombre.value;cargarReporteot('<?php echo $foo;?>');" text="#000000"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Cierre de orden de trabajo</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" width="65%"
class="NoiseFormTABLE"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Ingresar editar registro</font></span></td></tr> 
<tr> 
  <td> 
<table width="85%" border="0" cellspacing="0" cellpadding="3" 
align="center"> 
<tr>
<td width="25%"><input type="button" value="Buscar Reporte" onclick="window.open('consultarrepcierreot.php?codigo=<?php echo $codigo?>','secundaria1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');"></td>
<td width="40%">&nbsp;</td>
<td width="40%">&nbsp;</td>
</tr>
<tr>
<td width="25%"><?php if($campnomb["reportcodigo"] == 1){$reportcodigo = null; 
echo "*";}?>Reporte de OT<br><input name="reportcodigo" type="text" size="14" onfocus="if(!agree)this.blur();" value="<?php if(!$flageditarcierreot){
echo $sbreg[reportcodigo];}else{ echo $reportcodigo; }?>"></td>
<td width="40%">&nbsp;</td>
<td width="35%">Fecha<br><input name="reportfecha" type="text" size="14" onfocus="if(!agree)this.blur();"
value="<?php if($flageditarcierreot) {echo $reportfecha;}?>"></td>
</tr>
<tr>
<td colspan="3"><hr></td>
</tr>
<tr>
<td width="25%">Tipo de mantenimiento<br><input name="tipmannombre" type="text" size="22" onfocus="if(!agree)this.blur();"
value="<?php if($flageditarcierreot) {echo $tipmannombre;}?>"></td>
<td width="40%">&nbsp;</td>
<td width="35%">Prioridad<br><input name="priorinombre" type="text" size="22" onfocus="if(!agree)this.blur();"
value="<?php if($flageditarcierreot){echo $priorinombre;}?>"></td>
</tr>
<tr>
<td width="25%">Tipo de trabajo<br><input name="tiptranombre" type="text" size="22" onfocus="if(!agree)this.blur();"
value="<?php if($flageditarcierreot){echo $tiptranombre;}?>"></td>
<td width="40%">&nbsp;</td>
<td width="35%">Tarea<br><input name="tareanombre" type="text" size="22" onfocus="if(!agree)this.blur();"
value="<?php if($flageditarcierreot){echo $tareanombre;}?>"></td>
</tr>
<tr>
<td colspan="3">Descripci&oacute;n<br><textarea name="reportdescri" cols="41" rows="3" onfocus="if(!agree)this.blur();"><?php
if(!$flageditarcierreot)
{
	echo $sbreg[reportdescri];
}
else 
{
	echo $reportdescri;
}?></textarea></td>
</tr>
<tr>
<td colspan="3"><hr></td>
</tr>
<tr>
<tr>
<td colspan="3" align="right">Hora: <input type="text" style="border:none;" name="cierothorfin" onfocus="if(!agree)this.blur();" size="5" value="<?php if(!$flageditarcierreot){ echo 
substr($sbreg[cierothorfin],0,5);}else{ echo $cierothorfin;}?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Fecha: <input type="text" style="border:none;" name="cierotfecfin" onfocus="if(!agree)this.blur();" size="10" value="<?php if(!$flageditarcierreot){ echo 
$sbreg[cierotfecfin];}else{ echo $cierotfecfin;}?>"></td>
</tr>
<tr>
<td colspan="3">
<table width="100%" height="100%" border="0">
<tr>
<td width="25%"><?php if($campnomb["usuacodi"] == 1){$usuacodi = null; echo 
"*";}?>Encargado:</td>
<td width="25%">C&oacute;digo&nbsp;<input type="text" name="usuacodigo" size="5" onfocus="if(!agree)this.blur();" value="<?php if(!$flageditarcierreot){ echo 
$sbreg[usuacodi];}else{ echo $usuacodigo; }?>"></td>
<td width="50%" align="center">Nombre&nbsp;<input type="text" name="usrname" size="18" onfocus="if(!agree)this.blur();" value=" "></td>
</tr>
</table>
</td>
 </tr> 
<tr> 
 <td colspan="2"><?php if($campnomb["tipcumcodigo"] == 1){$auxtipcumcodigo = null; 
echo "*";}?>Tipo de cumplimiento&nbsp;&nbsp;&nbsp;&nbsp; 
<select name="auxtipcumcodigo">
<?php
if(!$flageditarcierreot)
{
	echo '<option value = "'.$codtipocump.'">';
	if($arrtipocump["tipcumnombre"] == null)
		echo 'Seleccione';
	else
		 echo $arrtipocump["tipcumnombre"];
}
else if($accioneditarcierreot)
{
	if($auxtipcumcodigo)
	{
		echo '<option value = "'.$auxtipcumcodigo.'">';
		$idcon	= fncconn();
		$arrtipocump = loadrecordtipocump($auxtipcumcodigo,$idcon);
		echo $arrtipocump["tipcumnombre"];
		fncclose($idcon);
	}
	else
	{
		echo '<option value = "">Seleccione';
	}
}?></option>
<?php
include ('../src/FunGen/floadtipocump.php');
$idcon = fncconn();
floadtipocump($idcon);
fncclose($idcon);
?></select> 
 </td> 
 <td width="35%">&nbsp;</td>
 </tr> 
<tr> 
 <td colspan="3"><?php if($campnomb["cierotdescri"] == 1){$cierotdescri = null; 
echo "*";}?>Descripci&oacute;n<br>
<textarea name="cierotdescri" cols="41" rows="3"><?php if(!$flageditarcierreot){ 
echo $sbreg[cierotdescri];}else{ echo $cierotdescri; }?></textarea>
</tr> 
 <tr> 
  <td width="41%">&nbsp;</td> 
 </tr> 
</table> 
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center">  
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="window.document.form1.tipcumcodigo.value = window.document.form1.auxtipcumcodigo.value;
form1.accioneditarcierreot.value =  1;"  width="86" height="18" 
alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablcierreot.php';"  width="86" height="18" 
alt="Cancelar" border=0>
  <img src="../img/ayuda.gif" width="86" 
height="18" alt="Ayuda" border=0> 
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
<input type="hidden" name="cierotcodigo" value="<?php if(!$flageditarcierreot){ 
echo $sbreg[cierotcodigo];}else{ echo $cierotcodigo; } ?>"> 
<input type="hidden" name="accioneditarcierreot">
<input type="hidden" name="usuanombre" value="<?php if (!$flageditarcierreot){ 
echo $usrname;} else{ echo $usuanombre; }?>">
<input type="hidden" name="tipcumcodigo"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 