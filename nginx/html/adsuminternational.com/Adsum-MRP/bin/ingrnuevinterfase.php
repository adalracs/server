<?php
ob_start();
include ( '../src/FunGen/sesion/fncvalses.php'); 
if($accionnuevointerfase)
{
	include ( 'grabainterfase.php');
}
ob_end_flush();
?> 
<html> 
<head> 
<title>Nuevo registro de interfase</title> 
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
<p><font class="NoiseFormHeaderFont">Ingreso de interfase</font></p>
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
               <td> <?php if($campnomb["interfregist"] == 1){ $interfregist=null;
echo "*";}
?>Registro</td>
               <td><textarea name="interfregist" cols="45" rows="25" wrap="VIRTUAL"><?php if(!$flagnuevointerfase){echo $sbreg[interfregist];}else {echo $interfregist;}?></textarea>

</td>
             </tr>
             <tr>
 <td width="41%">&nbsp;</td>
  <td width="25%">
    <input type="hidden" name="interfutiliz" value="0"></td>
 </tr>
</table>
  </td>
 </tr>
 <tr>
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionnuevointerfase.value =  1;"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablinterfase.php';"  width="86" height="18" 
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
 <input type="hidden" name="interfcodigo"	value="<?php if(!$flagnuevointerfase){
echo $sbreg[interfcodigo];}else{ echo $interfcodigo;} ?>">
<input type="hidden" name="accionnuevointerfase">
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
</form>
</body>
<?php
    if(!$codigo)
    { echo " -->"; }
?>
</html>