<?php 
include ( '../src/FunGen/sesion/fncvalses.php');
include ('../src/FunPerPriNiv/pktbltipooper.php');
include ('../src/FunPerPriNiv/pktblcentcost.php');
if(!$flagborraroperacio)
{
	include ( '../src/FunGen/sesion/fnccarga.php');
	$sbreg = fnccarga($nombtabl,$radiobutton);
	if (!$sbreg)
	{
		include( '../src/FunGen/fnccontfron.php');
	}
	$idcon = fncconn();
	$sbregtipooper = loadrecordtipooper($sbreg[tipopecodigo],$idcon);
	fncclose($idcon);
}
?> 
<html> 
<head> 
<title>Borrar registro de operacio</title> 
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
<p><font class="NoiseFormHeaderFont">Operaciones</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
        <td width="474" class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Borrar registro</font></span></td></tr> 
<tr> 
  <td> 
              <table width="100%" border="0" cellspacing="1" cellpadding="3" align="center">
        <tr>
       
          <td width="31%">C&oacute;digo</td>
          <td><input type="text" name="operaccodigo" value="<?php if(!$flagborraroperacio){ echo $sbreg[operaccodigo];}else {echo $operaccodigo;}?>" size="14" onFocus="if (!agree)this.blur();"></td>
          <td>Fecha</td>
          <td width="27%"><input type="text" name="operacfecha"	value="<?php if(!$flagborraroperacio){ echo $sbreg[operacfecha];} else {echo $operacfecha;}?>" size="10" onfocus="if(!agree) this.blur();"></td>
        </tr>
       <tr>
          <td width="31%">Tipo de operaci&oacute;n</td>
          <td width="31%"><input type="text" name="tipopecodigo" value="<?php if(!$flagborraroperacio){echo $sbregtipooper[tipopenombre];}else{echo $tipopecodigo;} ?>" onFocus="if (!agree)this.blur();" size="25" ></td>
          <td width="11%">Valor</td>
          <td width="27%"><input type="text" name="operacvalor"	value="<?php if(!$flagborraroperacio){ 
echo $sbreg[operacvalor];}else {echo $operacvalor;}?>" size="10"></td>
        </tr>
        <tr>
          <td width="31%">&nbsp;</td>
        </tr>
    </table>
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionborraroperacio.value =  1; 
form1.action='maestabloperacio.php';"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestabloperacio.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagborraroperacio" value="1"> 
<input type="hidden" name="accionborraroperacio"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 
