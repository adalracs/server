<?php 
ob_start();
include ( '../src/FunGen/sesion/fncvalses.php'); 
if($accionnuevoplano)
{
	include ( 'grabaplano.php');
}
ob_end_flush();
?> 
<html> 
<head> 
<title>Nuevo registro de plano</title> 
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
<p><font class="NoiseFormHeaderFont">Planos</font></p> 
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
            <table width="85%" border="0" cellspacing="0" cellpadding="3" 
align="center"> 
<tr> 
 <td width="41%"><?php if($campnomb["planonombre"] == 1){ $planonombre=null;
echo "*";}
?>Nombre</td> 
  <td><input type="text" name="planonombre"	value="<?php if(!$flagnuevoplano){ 
echo $sbreg[planonombre];}else {echo $planonombre;}?>"> 
  </td> 
 </tr> 
<tr>
  <td width="41%"><?php if($campnomb["planoruta"] == 1){ $planoruta=null;
echo "*";}
?>Ruta</td>
  <td>
  <input type="file" name="file" onkeydown="this.blur();">
  </td>
  </tr>
<tr> 
 <td width="41%"><?php if($campnomb["planodescri"] == 1){ $planodescri=null;
echo "*";}
?>Descripci&oacute;n</td> 
  <td rowspan="2"> 
    <textarea name="planodescri" rows="3" wrap="VIRTUAL"><?php if(!$flagnuevoplano){ 
echo $sbreg[planodescri];}else {echo $planodescri;}?></textarea> 
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
<input type="image" name="aceptar" src="../img/aceptar.gif"
onclick="form1.accionnuevoplano.value =  1;" width="86" height="18" alt="Aceptar" border=0>
<input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablplano.php';"  width="86" height="18" 
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
<input type="hidden" name="planocodigo"	value="<?php if(!$flagnuevoplano){ echo $sbreg[planocodigo];}else{ echo $planocodigo;} ?>">
<input type="hidden" name="planoruta1" value="<?php echo $planoruta;?>">
<input type="hidden" name="accionnuevoplano"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
