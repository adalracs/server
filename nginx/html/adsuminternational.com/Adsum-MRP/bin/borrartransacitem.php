<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
include('../src/FunPerPriNiv/pktbltipomovi.php');
include('../src/FunPerPriNiv/pktblitem.php');
include('../src/FunPerPriNiv/pktblunimedida.php');
if(!$flagborrartransacitem) 
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
<title>Borrar registro de transacitem</title> 
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
<p><font class="NoiseFormHeaderFont">Entrada/Salida de Item</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td width="467" class="NoiseErrorDataTD">&nbsp;</td> 
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
  <input name="transitecodigo" type="text"	value="<?php 
if(!$flagborrartransacitem){ echo $sbreg[transitecodigo];}else{ echo 
$transitecodigo; }?>" size="10">
 </td> 
 </tr> 
<tr>
 <td width="23%">Tipo de movimiento</td>
 <td colspan="2">
 <input name="tipmovcodigo" type="text"	value="<?php 
if(!$flagborrartransacitem){
	$idcon = fncconn();
	$sbregtipom = loadrecordtipomovi($sbreg[tipmovcodigo],$idcon);
	fncclose($idcon);
	echo $sbregtipom[tipmovnombre];}else{ echo $tipmovcodigo; }?>">
 </td>
 <td>Fecha</td>
 <td><?php if(!$flagborrartransacitem){ echo $sbreg[transitefecha];}else{ echo $transitefecha;}?></td>
 <td>&nbsp;</td>
 </tr>
 <tr>
<td colspan="6"><hr></td>
		</tr>
<tr> 
 <td width="23">Nombre</td>
 <td colspan="2"><input type="text" name="itemcodigo" value="<?php if(!$flagborrartransacitem){
 	$idcon = fncconn();
	$sbregitem = loadrecorditem($sbreg[itemcodigo],$idcon);
	fncclose($idcon);
	echo $sbregitem[itemnombre];}else{echo $itemcodigo;} ?>" onFocus="if (!agree)this.blur();"></td>
<td>Valor $</td> 
 <td colspan="2"> 
  <input name="itemvalor" type="text"	value="<?php 
if(!$flagborrartransacitem){ $idcon = fncconn();
	$sbregitem = loadrecorditem($sbreg[itemcodigo],$idcon);
	fncclose($idcon);
	echo $sbregitem[itemvalor];}else{echo $itemvalor;} ?>" size="12">
 </td> 
 </tr>
<tr>
<td colspan="6"><hr></td>
		</tr>
<tr> 
 <td width="23%">Cantidad</td> 
 <td colspan="2"> 
  <input name="transitecantid" type="text"	value="<?php 
if(!$flagborrartransacitem){ echo $sbreg[transitecantid];}else{ echo 
$transitecantid; }?>" size="10">&nbsp;<?php if(!$flagborrartransacitem){$idcon = fncconn();
	$sbregunim = loadrecordunimedida($sbregitem[unidadcodigo],$idcon);
	fncclose($idcon);
	echo $sbregunim[unidadacra];} ?>
 </td> 
  <td>Total $</td> 
 <td colspan="2"> 
  <input name="transitetotal" type="text"	value="<?php 
if(!$flagborrartransacitem){ echo $sbreg[transitetotal];}else{ echo $transitetotal; }?>" size="12">
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
onclick="form1.accionborrartransacitem.value =  1; 
form1.action='maestabltransacitem.php';"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestabltransacitem.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagborrartransacitem" value="1"> 
<input type="hidden" name="accionborrartransacitem"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="tipmovcodigo" value="<?php $tipmovcodigo = ""; echo $tipmovcodigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
