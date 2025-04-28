<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
include('../src/FunPerPriNiv/pktbltipomovi.php');
include('../src/FunPerPriNiv/pktblherramie.php');
if(!$flagborrartransacherramie) 
{ 
include ( '../src/FunGen/sesion/fnccarga.php'); 
$sbreg = fnccarga($nombtabl,$radiobutton); 
if (!$sbreg) 
	{ 
		include( '../src/FunGen/fnccontfron.php'); 
	} 
} 
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andr�s A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Borrar registro de transacherramie</title> 
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
<p><font class="NoiseFormHeaderFont">Entrada/Salida de Herramienta</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
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
            <table width="97%" border="0" cellspacing="0" cellpadding="3" 
align="center"> 
<tr> 
 <td width="23%">C&oacute;digo</td> 
 <td colspan="5"> 
  <input name="transhercodigo" type="text"	value="<?php 
if(!$flagborrartransacherramie){ echo $sbreg[transhercodigo];}else{ echo 
$transhercodigo; }?>" size="10">
 </td> 
 </tr> 
<tr>
 <td width="23%">Tipo de movimiento</td>
 <td colspan="2">
 <input name="tipmovcodigo" type="text"	value="<?php 
if(!$flagborrartransacherramie){
	$idcon = fncconn();
	$sbregtipom = loadrecordtipomovi($sbreg[tipmovcodigo],$idcon);
	fncclose($idcon);
	echo $sbregtipom[tipmovnombre];}else{ echo $tipmovcodigo; }?>">
 </td>
 <td>Fecha</td>
 <td><?php if(!$flagborrartransacherramie){ echo $sbreg[transherfecha];}else{ echo $transherfecha;}?></td>
 <td>&nbsp;</td>
 </tr>
 <tr>
<td colspan="6"><hr></td>
		</tr>
<tr> 
 <td width="23">Nombre</td>
 <td colspan="2"><input type="text" name="herramcodigo" value="<?php if(!$flagborrartransacherramie){
 	$idcon = fncconn();
	$sbregherramie = loadrecordherramie($sbreg[herramcodigo],$idcon);
	fncclose($idcon);
	echo $sbregherramie[herramnombre];}else{echo $herramcodigo;} ?>" onFocus="if (!agree)this.blur();"></td>
<td>Valor $</td> 
 <td colspan="2"> 
  <input name="itemvalor" type="text"	value="<?php if(!$flagborrartransacherramie){ $idcon = fncconn();
	$sbregherramie = loadrecordherramie($sbreg[herramcodigo],$idcon);
	fncclose($idcon);
	echo $sbregherramie[herramvalor];}else{echo $herramvalor;} ?>" size="12">
 </td> 
 </tr>
<tr>
<td colspan="6"><hr></td>
		</tr>
<tr> 
 <td width="23%">Cantidad</td> 
 <td colspan="2"> 
  <input name="transhercanti" type="text"	value="<?php 
if(!$flagborrartransacherramie){ echo $sbreg[transhercanti];}else{ echo 
$transhercanti; }?>" size="10">
 </td> 
  <td>Total $</td> 
 <td colspan="2"> 
  <input name="transhertotal" type="text"	value="<?php 
if(!$flagborrartransacherramie){ echo $sbreg[transhertotal];}else{ echo $transhertotal; }?>" size="12">
 </td> 
 </tr> 
 <tr> 
  <td width="23%">&nbsp;</td> 
 </tr> 
</table> 
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionborrartransacherramie.value =  1; 
form1.action='maestabltransacherramie.php';"  width="86" height="18" 
alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestabltransacherramie.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
  <img src="../img/ayuda.gif" border="0" alt="Ayuda">
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagborrartransacherramie" value="1"> 
<input type="hidden" name="accionborrartransacherramie"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
