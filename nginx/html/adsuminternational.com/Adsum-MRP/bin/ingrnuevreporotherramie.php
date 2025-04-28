<?php
include('../src/FunPerSecNiv/fncconn.php'); 
include('../src/FunPerSecNiv/fncclose.php'); 
include('../src/FunPerSecNiv/fncfetch.php'); 
include('../src/FunPerSecNiv/fncnumreg.php');
//------------------------------------------ 
include('../src/FunPerPriNiv/pktbltareot.php'); 
include('../src/FunPerPriNiv/pktblherramie.php'); 
include('../src/FunPerPriNiv/pktbltareotherramie.php'); 
include('../src/FunPerPriNiv/pktbltransacherramie.php'); 
include('../src/FunPerPriNiv/pktblunimedida.php'); 
include('../src/FunPerPriNiv/pktblherramestado.php'); 
ob_start();
if($accionnuevoreporotherramie)
{
	include ( 'grabareporotherramie.php');
}
ob_end_flush();
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andrés A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Nuevo registro de reporotherramie</title> 
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
<p><font class="NoiseFormHeaderFont">Devoluci&oacute;n de herramientas</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
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
<TABLE width='93%' border='0' cellspacing='0' cellpadding='3' align='center'>            
<?php
include('../src/FunGen/fnccargareporotherramie.php');
$idcon = fncconn();
fnccargareporotherramie($ordtracodigo, $idcon);
fncclose($idcon);
?>
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
onclick="form1.accionnuevoreporotherramie.value =  1;"  width="86" height="18" 
alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="self.close();"  width="86" height="18" 
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
<input type="hidden" name="rephercodigo" value="<?php 
if(!$flagnuevoreporotherramie){ echo $sbreg[rephercodigo];}else{ echo
$rephercodigo; } ?>"> 
<input type="hidden" name="accionnuevoreporotherramie"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 
