<?php 
ob_start();
include ( '../src/FunGen/sesion/fncvalses.php');
if($accioneditarestado) 
{ 
		include ( 'editaestado.php'); 
		$flageditarestado = 1;
}
ob_end_flush();
if(!$flageditarestado)
{
	include ( '../src/FunGen/sesion/fnccarga.php');
	$sbreg = fnccarga($nombtabl,$radiobutton);
	if (!$sbreg)
	{
		include( '../src/FunGen/fnccontfron.php');
	}
	$estadotipo = $sbreg['estadotipo'];
}
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andr�s A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Editar registro de estado</title> 
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
<p><font class="NoiseFormHeaderFont">Estado</font></p> 
<table width="350" border="0" align="center" cellpadding="2" cellspacing="1" 
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
            <table width="85%" border="0" cellspacing="1" cellpadding="0" 
align="center"> 
              <tr> 
                <td width="41%"></td> 
<td width="59%"> 
</tr> 
<tr> 
 <td width="41%" class="NoiseFooterTD"><?php if($campnomb["estadonombre"] == 1){ $estadonombre = null;
echo "*";}
?>&nbsp;N&oacute;mbre</td> 
 <td width="59%" class="NoiseDataTD"> 
  <input type="text" name="estadonombre"	value="<?php if(!$flageditarestado){ 
echo $sbreg[estadonombre];}else{echo $estadonombre;}?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%" class="NoiseFooterTD"><?php if($campnomb["estadotipo"] == 1){ $estadotipo = null;
echo "*";}
?>&nbsp;Tipo</td> 
 <td width="59%" class="NoiseDataTD"> 
 <select name="estadotipo">
  	<option value="1" <?php if($estadotipo == 1) echo 'selected' ?>>Activo</option>
 	<option value="0" <?php if($estadotipo == '0') echo 'selected' ?>>Inactivo</option>
 	<option value="2" <?php if($estadotipo == 2) echo 'selected' ?>>De Baja</option>
            </select>
 </td> 
 </tr> 
<tr> 
 <td width="41%" class="NoiseFooterTD"><?php if($campnomb["estadodescri"] == 1){ $estadodescri = null;
echo "*";}
?>&nbsp;Descripci&oacute;n</td> 
 <td width="59%" rowspan="2" class="NoiseDataTD"> 
   <textarea name="estadodescri" rows="3" wrap="VIRTUAL"><?php if(!$flageditarestado){echo $sbreg[estadodescri];}else{echo $estadodescri;}?></textarea> 
 </td> 
 </tr>
<tr class="NoiseFooterTD">
  <td>&nbsp;</td>
</tr> 
</table> 
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accioneditarestado.value =  1;"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablestado.php';"  width="86" height="18" 
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
 <input type="hidden" name="estadocodigo"	value="<?php if(!$flageditarestado){ echo $sbreg[estadocodigo];}?>">
 <input type="hidden" name="accioneditarestado"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 
