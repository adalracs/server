<?php
ob_start();
include ( '../src/FunGen/sesion/fncvalses.php'); 
if($accionnuevoexammedi)
{
	include ( 'grabaexammedi.php');
}
ob_end_flush();
?> 
<html> 
<head> 
<title>Nuevo registro de exammedi</title> 
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
<p><font class="NoiseFormHeaderFont">Ex&aacute;men m&eacute;dico</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td width="404" class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Ingresar nuevo registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="92%" border="0" cellspacing="1" cellpadding="1" 
align="center"> 
              <tr> 
 <td width="34%"> <?php if($campnomb["examednombre"] == 1){ $examednombre = null;
echo "*";}
?>Nombre</td>
  <td width="66%"><input type="text" name="examednombre"	value="<?php if(!$flagnuevoexammedi){
echo $sbreg[examednombre];} else {echo $examednombre;}?>" size="30">
  </td>
 </tr>
              <tr>
                <td> <?php if($campnomb["examedperiod"] == 1){ $examedperiod = null;
echo "*";}
?>Periodicidad</td>
                <td><input type="text" name="examedperiod"	value="<?php if(!$flagnuevoexammedi){
echo $sbreg[examedperiod];} else {echo $examedperiod;}?>" size="15">&nbsp;&nbsp;d&iacute;as</td>
              </tr>
              <tr>
 <td width="34%"> <?php if($campnomb["exameddescri"] == 1){ $exameddescri = null;
echo "*";}
?>Descripci&oacute;n</td>
  <td rowspan="2"><textarea name="exameddescri" cols ="40" rows="3" wrap="VIRTUAL"><?php if(!$flagnuevoexammedi){
echo $sbreg[exameddescri];} else {echo $exameddescri;}?></textarea>
  </td>
 </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
 <tr>
  <td width="34%">&nbsp;</td>
 </tr>
</table>
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
 <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionnuevoexammedi.value =  1;"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablexammedi.php';"  width="86" height="18" 
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
 <input type="hidden" name="examedcodigo"	value="<?php if(!$flagnuevoexammedi){ 
echo $sbreg[examedcodigo];}else{ echo $examedcodigo;} ?>">
<input type="hidden" name="accionnuevoexammedi"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
