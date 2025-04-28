<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
include ( '../src/FunPerPriNiv/pktblusuario.php'); 
include ( '../src/FunPerPriNiv/pktbltipomant.php'); 
include ( '../src/FunPerPriNiv/pktblreportot.php'); 
include ( '../src/FunPerPriNiv/pktblpriorida.php'); 
include ( '../src/FunPerPriNiv/pktbltarea.php'); 
include ( '../src/FunPerPriNiv/pktbltipotrab.php'); 
include ( '../src/FunPerPriNiv/pktbltipocump.php');
if(!$flagborrarcierreot)
{
	include ( '../src/FunGen/sesion/fnccarga.php');
	$sbreg = fnccarga($nombtabl,$radiobutton);
	if (!$sbreg)
	{
		include( '../src/FunGen/fnccontfron.php');
	}
	$idcon = fncconn();

	$arrusr = loadrecordusuario($sbreg[usuacodi],$idcon);
	$usrname = $arrusr[usuanombre]." ".$arrusr[usuapriape]." ".$arrusr[usuasegape];

	$arrreport = loadrecordreportot($sbreg[reportcodigo],$idcon);
	$reportfecha = $arrreport[reportfecha];
	$reportdescri = $arrreport[reportdescri];
	$arrtipomant = loadrecordtipomant($arrreport[tipmancodigo],$idcon);
	$tipmannombre = $arrtipomant[tipmannombre];
	$arrpriorida = loadrecordpriorida($arrreport[prioricodigo],$idcon);
	$priorinombre = $arrpriorida[priorinombre];
	$arrtipotrab = loadrecordtipotrab($arrreport[tiptracodigo],$idcon);
	$tiptranombre = $arrtipotrab[tiptranombre];
	$arrtarea = loadrecordtarea($arrreport[tareacodigo],$idcon);
	$tareanombre = $arrtarea[tareanombre];

	$arrtipocump = loadrecordtipocump($sbreg[tipcumcodigo],$idcon);
	$tipcumnombre = $arrtipocump[tipcumnombre];

	fncclose($idcon);
}
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andrés A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Borrar registro de cierreot</title> 
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
<p><font class="NoiseFormHeaderFont">Cierre de orden de trabajo</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" width="65%"
class="NoiseFormTABLE"> 
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
<td width="25%"><?php if($campnomb == "reportcodigo"){$reportcodigo = null; 
echo "*";}?>Reporte de OT<br><input name="reportcodigo" type="text" size="14" onfocus="if(!agree)this.blur();" value="<?php if(!$flagborrarcierreot){
echo $sbreg[reportcodigo];}else{ echo $reportcodigo; }?>"></td>
<td width="40%">&nbsp;</td>
<td width="35%">Fecha:<br><input name="reportfecha" type="text" size="14" onfocus="if(!agree)this.blur();"
value="<?php if(!$flagborrarcierreot) {echo $reportfecha;} else echo $reportfecha;?>"></td>
</tr>
<tr>
<td colspan="3"><hr></td>
</tr>
<tr>
<td width="25%">Tipo de mantenimiento<br><input name="tipmannombre" type="text" size="22" onfocus="if(!agree)this.blur();"
value="<?php if(!$flagborrarcierreot) {echo $tipmannombre;} else echo $tipmannombre;?>"></td>
<td width="40%">&nbsp;</td>
<td width="35%">Prioridad<br><input name="priorinombre" type="text" size="22" onfocus="if(!agree)this.blur();"
value="<?php if(!$flagborrarcierreot){echo $priorinombre;} else echo $priorinombre?>"></td>
</tr>
<tr>
<td width="25%">Tipo de trabajo<br><input name="tiptranombre" type="text" size="22" onfocus="if(!agree)this.blur();"
value="<?php if(!$flagborrarcierreot){echo $tiptranombre;} else echo $tiptranombre;?>"></td>
<td width="40%">&nbsp;</td>
<td width="35%">Tarea<br><input name="tareanombre" type="text" size="22" onfocus="if(!agree)this.blur();"
value="<?php if(!$flagborrarcierreot){echo $tareanombre;} else echo $tareanombre;?>"></td>
</tr>
<tr>
<td colspan="3">Descripci&oacute;n<br><textarea name="reportdescri" cols="41" rows="3" onfocus="if(!agree)this.blur();"><?php 
if(!$flagborrarcierreot)
{
	echo $reportdescri;
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
<td>Fecha&nbsp;&nbsp;<input type="text" size="14" name="cierotfecfin" onfocus="if(!agree)this.blur();"
value="<?php if(!$flagborrarcierreot)echo $sbreg[cierotfecfin]; else echo $cierotfecfin;?>"></td>
<td colspan="2">
	<table width="100%" border="0">
		<tr>
		<td width="26%">&nbsp;</td>
		<td>Hora&nbsp;&nbsp;&nbsp;&nbsp;&nbsp<input type="text" size="14" name="cierothorfin" onfocus="if(!agree)this.blur();"
		value="<?php if(!$flagborrarcierreot)echo substr($sbreg[cierothorfin],0,5); else echo $cierothorfin;?>"></td></tr>
	</table>
</td>
<tr>
<td colspan="3">
<table width="100%" height="100%" border="0">
<tr>
<td width="25%"><?php if($campnomb == "usuacodi"){$usuacodic = null; echo 
"*";}?>Encargado:</td>
<td width="25%">C&oacute;digo&nbsp;<input type="text" name="usuacodic" size="5" onfocus="if(!agree)this.blur();" value="<?php if(!$flagborrarcierreot){ echo 
$sbreg[usuacodi];}else{ echo $usuacodic; }?>"></td>
<td width="50%" align="center">Nombre&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="usuanombre" size="22" onfocus="if(!agree)this.blur();" value="<?php if(!$flagborrarcierreot){ echo 
$usrname;}else{ echo $usrname; }?>"></td>
</tr>
</table>
</td>
 </tr> 
<tr> 
 <td colspan="2"><?php if($campnomb == "tipcumcodigo"){$tipcumcodigo = null; 
echo "*";}?>Tipo de cumplimiento&nbsp;&nbsp;&nbsp;&nbsp; 
<input type="text" size="14" name="tipcumcodigo" onfocus="if(!agree) this.blur();"
value="<?php if(!$flagborrarcierreot){echo $tipcumnombre;} else echo $tipcumnombre;?>">
 </td> 
 <td colspan="3">&nbsp;</td>
 </tr> 
<tr> 
 <td colspan="3"><?php if($campnomb == "cierotdescri"){$cierotdescri = null; 
echo "*";}?>Descripci&oacute;n<br>
<textarea name="cierotdescri" cols="41" rows="3" onfocus="if(!agree)this.blur();"><?php if(!$flagborrarcierreot){ 
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
onclick="form1.accionborrarcierreot.value =  1; 
form1.action='maestablcierreot.php';"  width="86" height="18" alt="Aceptar" 
border=0> 
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
 <input type="hidden" name="flagborrarcierreot" value="1"> 
 <input type="hidden" name="cierotcodigo"  value="<?php echo $sbreg[cierotcodigo]; ?>"> 
<input type="hidden" name="accionborrarcierreot"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 
