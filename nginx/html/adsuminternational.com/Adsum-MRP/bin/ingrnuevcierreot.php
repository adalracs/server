<?php 
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktblusuario.php');
include ( '../src/FunPerPriNiv/pktbltipocump.php');
if($accionnuevocierreot)
{
	include ( 'grabacierreot.php');
}

$idcon = fncconn();

$arrusr = loadrecordusuario($usuacodi,$idcon);
$usrname = $arrusr[usuanombre]." ".$arrusr[usuapriape]." ".$arrusr[usuasegape];

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
<title>Nuevo registro de cierreot</title> 
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
<p><font class="NoiseFormHeaderFont">Cierre de Orden de Trabajo</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
width="75%" class="NoiseFormTABLE"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Ingresar nuevo registro</font></span></td></tr> 
<tr> 
  <td> 
	<table width="100%" border="0" cellspacing="1" cellpadding="3" align="center"> 
		<tr>
			<td class="NoiseFooterTD" colspan="2"><?php if($campnomb["reportcodigo"] == 1){$reportcodigo = null; echo "*";}?><input type="button" value="Buscar OT" onclick="window.open('consultarrepcierreot.php?codigo=<?php echo $codigo?>&usuaplanta=<?php echo $GLOBALS[usuaplanta]?>','secundaria1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');">
			<input name="reportcodigo" type="hidden" size="14" onfocus="if(!agree)this.blur();" value="<?php if(!$flagnuevocierreot){echo $sbreg[reportcodigo];}else{ echo $reportcodigo; }?>">
			</td>
			<td class="NoiseFooterTD">&nbsp;Fecha&nbsp;&nbsp;&nbsp;<input name="reportfecha" type="text" size="14" onfocus="if(!agree)this.blur();" value="<?php if($flagnuevocierreot) {echo $reportfecha;}?>"></td>
		</tr>
<tr>
<td width="25%" class="NoiseFooterTD" colspan="2">&nbsp;&nbsp;Tipo de Mantenimiento<br><input name="tipmannombre" type="text" size="22" onfocus="if(!agree)this.blur();"
value="<?php if($flagnuevocierreot) {echo $tipmannombre;}?>"></td>
<td width="35%"class="NoiseFooterTD">&nbsp;&nbsp;Prioridad<br><input name="priorinombre" type="text" size="22" onfocus="if(!agree)this.blur();"
value="<?php if($flagnuevocierreot){echo $priorinombre;}?>"></td>
</tr>
<tr>
<td width="25%" class="NoiseFooterTD" colspan="2">&nbsp;&nbsp;Tipo de Trabajo<br><input name="tiptranombre" type="text" size="22" onfocus="if(!agree)this.blur();"
value="<?php if($flagnuevocierreot){echo $tiptranombre;}?>"></td>
<td width="35%" class="NoiseFooterTD">&nbsp;&nbsp;Tarea<br><input name="tareanombre" type="text" size="22" onfocus="if(!agree)this.blur();"
value="<?php if($flagnuevocierreot){echo $tareanombre;}?>"></td>
</tr>
<tr>
<td colspan="3" class="NoiseDataTD">&nbsp;&nbsp;Descripci&oacute;n<br><textarea name="reportdescri" cols="60" rows="2" onfocus="if(!agree)this.blur();"><?php
if(!$flagnuevocierreot)
{
	echo $sbreg[reportdescri];
}
else 
{
	echo $reportdescri;
}?></textarea></td>
</tr>
<tr>
<td colspan="3" align="right" bgcolor="#f0f6ff">Hora: <?php echo date("H:i");?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Fecha: <?php echo date("Y-m-d");?></td>
</tr>
<tr>
<td colspan="3">
<table width="100%" height="100%" border="1">
<tr>
<td class="NoiseFooterTD"><?php if($campnomb["usuacodi"] == 1){$usuacodi = null; echo 
"*";}?>Encargado:</td>
<td width="25%" class="NoiseDataTD">&nbsp;C&oacute;digo&nbsp;&nbsp;<input type="text" name="usuacodi" size="5" onfocus="if(!agree)this.blur();" value="<?php if(!$flagnuevocierreot){ echo 
$usuacodi;}else{ echo $usuacodi; }?>"></td>
<td width="50%" align="center" class="NoiseDataTD">&nbsp;Nombre&nbsp;&nbsp;<input type="usuanombre" size="25" onfocus="if(!agree)this.blur();" value="<?php if(!$flagnuevocierreot){ echo 
$usrname;}else{ echo $usrname; }?>"></td>
</tr>
</table>
</td>
 </tr> 
<tr> 
 <td colspan="2" class="NoiseFooterTD"><?php if($campnomb["tipcumcodigo"] == 1){$tipcumcodigo = null; 
echo "*";}?>&nbsp;&nbsp;Tipo de cumplimiento&nbsp;&nbsp;&nbsp;&nbsp; 
<select name="tipcumcodigo">
<?php
if(!$flagnuevocierreot)
{
	echo '<option value = "">Seleccione';
}
else if($accionnuevocierreot)
{
	if($tipcumcodigo)
	{
		echo '<option value = "'.$tipcumcodigo.'">';
		$idcon	= fncconn();
		$arrtipocum = loadrecordtipocump($tipcumcodigo,$idcon);
		echo $arrtipocum[tipcumnombre];
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
 <td width="35%" class="NoiseFooterTD">&nbsp;</td>
 </tr> 
<tr> 
 <td colspan="3" class="NoiseDataTD"><?php if($campnomb["cierotdescri"] == 1){$cierotdescri = null; 
echo "*";}?>&nbsp;&nbsp;Descripci&oacute;n<br>
<textarea name="cierotdescri" cols="60" rows="2"><?php if(!$flagnuevocierreot){ 
echo $sbreg[cierotdescri];}else{ echo $cierotdescri; }?></textarea>
</tr> 
</table> 
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center">  
  <input type="image" name="aceptar"  src="../img/aceptar.gif" onclick="form1.accionnuevocierreot.value =  1;"  width="86" height="18" 
alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" onclick="form1.action='maestablcierreot.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
<!--<img name="ayuda" src="../img/ayuda.gif" width="86" 
height="18" alt="Ayuda" border=0>-->
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
<input type="hidden" name="cierotcodigo" value="<?php if(!$flagnuevocierreot){ echo $sbreg[cierotcodigo];}else{ echo $cierotcodigo; } ?>"> 
<input type="hidden" name="accionnuevocierreot"> 
<input type="hidden" name="cierotfecfin" value="<?php echo date("Y-m-d")?>">
<input type="hidden" name="cierothorfin" value="<?php echo date("H:i:s")?>">
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
</form> 
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 