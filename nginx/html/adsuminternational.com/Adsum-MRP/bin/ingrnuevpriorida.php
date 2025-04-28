<?php
ob_start();
include ( '../src/FunGen/sesion/fncvalses.php'); 
if($accionnuevopriorida)
{
	include ( 'grabapriorida.php');
}
ob_end_flush();
?> 
<html> 
<head> 
<title>Nuevo registro de priorida</title> 
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
<p><font class="NoiseFormHeaderFont">Prioridades</font></p>
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
            <table width="85%" border="0" cellspacing="1" cellpadding="3"
align="center">
<tr>
  <td class="NoiseFooterTD"> <?php if($campnomb["priorinombre"] == 1){ $priorinombre=null;
echo "*";}
?>Nombre</td>
  <td class="NoiseErrorDataTD"><input type="text" name="priorinombre"	value="<?php if(!$flagnuevopriorida){
echo $sbreg[priorinombre];}else {echo $priorinombre;}?>"></td>
</tr>
<tr>
 <td width="41%" class="NoiseFooterTD"> <?php if($campnomb["prioridescri"] == 1){ $prioridescri=null;
echo "*";}
?>Descripci&oacute;n</td>
  <td width="25%" class="NoiseErrorDataTD">
    <textarea name="prioridescri" rows="2" wrap="VIRTUAL"><?php if(!$flagnuevopriorida){
echo $sbreg[prioridescri];}else {echo $prioridescri;}?></textarea>
  </td>
 </tr>
</table>
  </td>
 </tr>
 <tr>
<td>
<div align="center">
  <input type="image" name="aceptar"  src="../img/aceptar.gif"
onclick="form1.accionnuevopriorida.value =  1;"  width="86" height="18" alt="Aceptar"
border=0>
  <input type="image" name="cancelar" src="../img/cancelar.gif"
onclick="form1.action='maestablpriorida.php';"  width="86" height="18"
alt="Cancelar" border=0>
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
<input type="hidden" name="prioricodigo"	value="<?php if(!$flagnuevopriorida){
echo $sbreg[prioricodigo];}else{ echo $prioricodigo;} ?>">
<input type="hidden" name="accionnuevopriorida">
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
</form>
</body>
<?php
    if(!$codigo)
    { echo " -->"; }
?>
</html>
