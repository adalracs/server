<?php
ob_start();
include ( '../src/FunGen/sesion/fncvalses.php'); 
if($accionnuevotipotrab)
{
	include ( 'grabatipotrab.php');
}
ob_end_flush();
?> 
<html> 
<head> 
<title>Nuevo registro de tipotrab</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
</head>
<?php 
    if(!$codigo) 
    { echo "<!--";} 
?> 
<body bgcolor="FFFFFF" text="#000000"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Tipo de trabajo</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE"> 
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
                <td class="NoiseFooterTD"> <?php if($campnomb["tiptranombre"] == 1){ $tiptranombre=null;
echo "*";}
?>Nombre</td>
                <td class="NoiseErrorDataTD"><input type="text" name="tiptranombre"	value="<?php if(!$flagnuevotipotrab){
echo $sbreg[tiptranombre];}else {echo $tiptranombre;}?>"></td>
              </tr>
              <tr>
 <td width="41%" class="NoiseFooterTD"> <?php if($campnomb["tiptradescri"] == 1){ $tiptradescri=null;
echo "*";}
?>Descripci&oacute;n</td>
  <td class="NoiseErrorDataTD">
    <textarea name="tiptradescri" rows="2" wrap="VIRTUAL"><?php if(!$flagnuevotipotrab){echo $sbreg[tiptradescri];}else {echo $tiptradescri;}?></textarea>
  </td>
 </tr>
</table>
  </td>
 </tr>
 <tr>
<td>
<div align="center">
  <input type="image" name="aceptar"  src="../img/aceptar.gif"
onclick="form1.accionnuevotipotrab.value =  1;"  width="86" height="18" alt="Aceptar"
border=0>
  <input type="image" name="cancelar" src="../img/cancelar.gif"
onclick="form1.action='maestabltipotrab.php';"  width="86" height="18"
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
<input type="hidden" name="tiptracodigo"	value="<?php if(!$flagnuevotipotrab){
echo $sbreg[tiptracodigo];}else{ echo $tiptracodigo;} ?>">
<input type="hidden" name="accionnuevotipotrab">
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
</form>
</body>
<?php
    if(!$codigo)
    { echo " -->"; }
?> 
</html> 
