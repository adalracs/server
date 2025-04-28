<?php
ob_start();
include ( '../src/FunGen/sesion/fncvalses.php'); 
if($accionnuevotipofall)
{
	include ( 'grabatipofall.php');
}
ob_end_flush();
?> 
<html> 
<head> 
<title>Nuevo registro de tipofall</title> 
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
<p><font class="NoiseFormHeaderFont">Tipos de fallas</font></p>
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
               <td class="NoiseFooterTD"> <?php if($campnomb["tipfalnombre"] == 1){ $tipfalnombre=null;
echo "*";}
?>Nombre</td>
               <td class="NoiseErrorDataTD"><input type="text" name="tipfalnombre"	value="<?php if(!$flagnuevotipofall){
echo $sbreg[tipfalnombre];}else {echo $tipfalnombre;}?>"></td>
             </tr>
             <tr>
 <td width="41%" class="NoiseFooterTD"> <?php if($campnomb["tipfaldescri"] == 1){ $tipfaldescri=null;
echo "*";}
?>Descripci&oacute;n</td>
  <td width="25%" class="NoiseErrorDataTD">
    <textarea name="tipfaldescri" rows="2" wrap="VIRTUAL"><?php if(!$flagnuevotipofall){
echo $sbreg[tipfaldescri];}else {echo $tipfaldescri;}?></textarea>
  </td>
 </tr>
</table>
  </td>
 </tr>
 <tr>
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionnuevotipofall.value =  1;"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestabltipofall.php';"  width="86" height="18" 
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
 <input type="hidden" name="tipfalcodigo"	value="<?php if(!$flagnuevotipofall){
echo $sbreg[tipfalcodigo];}else{ echo $tipfalcodigo;} ?>">
<input type="hidden" name="accionnuevotipofall">
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
</form>
</body>
<?php
    if(!$codigo)
    { echo " -->"; }
?>
</html>
