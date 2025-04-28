<?php
ob_start();
include ( '../src/FunGen/sesion/fncvalses.php'); 
include('../src/FunPerPriNiv/pktblusuario.php');
if (!$radiobutton)
{
	include( '../src/FunGen/fnccontfron.php');
}
if($accionvalidausuario)
{
	include('../src/FunGen/validatransacitem.php');
}
	$idcon = fncconn();
	$sbreg = loadrecordusuario($GLOBALS[usuacodi],$idcon);
    $usuanomb = $sbreg[usuanomb];
    fncclose($idcon);
ob_end_flush();
?> 
<html> 
<head> 
<title>Nuevo registro</title> 
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
<p><font class="NoiseFormHeaderFont">Validar usuario</font></p>
<table border="0" cellspacing="1" cellpadding="2" align="center"
class="NoiseFormTABLE">
  <tr>
    <td class="NoiseErrorDataTD">&nbsp;</td>
  </tr>
  <tr>
          <td class="NoiseFieldCaptionTD"><span class="style5"><font
color="FFFFFF">
Validar usuario</font></span></td></tr>
<tr>
  <td>
            <table width="85%" border="0" cellspacing="0" cellpadding="3"
align="center">
             <tr>
               <td>Usuario</td>
               <td><input type="text" name="usuanomb"	value="<?php if(!$flageditartransacitem){ echo $usuanomb;}?>" onFocus="if (!agree)this.blur();"></td>
             </tr>
    <tr>
               <td>Password</td>
               <td><input type="password" name="usuapass" value="<?php if(!$flageditartransacitem){echo $usuapass;}?>">
               </td>
             </tr>
             <tr>
               <td>&nbsp;</td>
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
onclick="form1.accionvalidausuario.value =  1;"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestabltransacitem.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
<input type="image" name="cancelar2" src="../img/ayuda.gif" width="86" 
height="18" alt="Cancelar" border=0> 
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
<input type="hidden" name="accionvalidausuario">
<input type="hidden" name="radiobutton" value="<?php echo $radiobutton;?>"> 
<input type="hidden" name="nombtabl" value="<?php echo $nombtabl;?>"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
</form>
</body>
<?php
    if(!$codigo)
    { echo " -->"; }
?>
</html>
