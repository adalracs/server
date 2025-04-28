<?php 
ob_start();
include ( '../src/FunGen/sesion/fncvalses.php');
if($accioneditartarea) 
{ 
		include ( 'editatarea.php'); 
		$flageditartarea = 1;
}
ob_end_flush();
if(!$flageditartarea)
{
	include ( '../src/FunGen/sesion/fnccarga.php');
	$sbreg = fnccarga($nombtabl,$radiobutton);
	if (!$sbreg)
	{
		include( '../src/FunGen/fnccontfron.php');
	}
}
?> 
<html> 
<head> 
<title>Editar registro de tarea</title> 
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
<p><font class="NoiseFormHeaderFont">Tarea</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Editar registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="85%" border="0" cellspacing="0" cellpadding="3" 
align="center"> 
              <tr>
                <td><?php if($campnomb["tareanombre"] == 1){ $tareanombre = null;
echo "*";}
?>Nombre</td>
                <td><input type="text" name="tareanombre"	value="<?php if(!$flageditartarea){ 
echo $sbreg[tareanombre];}else{ echo $tareanombre;} ?>"></td>
              </tr>
              <tr> 
 <td width="25%"><?php if($campnomb["tareadescri"] == 1){ $tareadescri = null;
echo "*";}
?>Descripci&oacute;n</td> 
  <td width="25%" rowspan="2"> 
    <textarea name="tareadescri" rows="3" wrap="VIRTUAL"><?php if(!$flageditartarea){ 
echo $sbreg[tareadescri];}else{ echo $tareadescri;} ?></textarea> 
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
onclick="form1.accioneditartarea.value =  1;" width="86" height="18" alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestabltarea.php';"  width="86" height="18" 
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
<input type="hidden" name="tareacodigo"	value="<?php if(!$flageditartarea){ echo $sbreg[tareacodigo];}else{ echo $tareacodigo;} ?>" > 
<input type="hidden" name="accioneditartarea"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 
