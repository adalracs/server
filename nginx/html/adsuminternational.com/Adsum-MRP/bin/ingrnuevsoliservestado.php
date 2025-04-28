<?php 
ob_start(); 
include ( '../src/FunGen/sesion/fncvalses.php'); 
if($accionnuevosoliservestado) 
{ 
	include ( 'grabasoliservestado.php'); 
} 
ob_end_flush(); 
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andr�s A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Nuevo registro de soliservestado</title> 
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
<p><font class="NoiseFormHeaderFont">Estados de Solicitud de Servicio</font></p> 
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
             <table width="85%" border="0" cellspacing="0" cellpadding="3" align="center"> 
<tr> 
 <td width="41%" class="NoiseFooterTD"><?php if($campnomb["estsolnombre"] == 1){$estsolnombre = null; echo "*";}?>
 Nombre</td> 
 <td width="59%" class="NoiseErrorDataTD"> 
  <input type="text" name="estsolnombre"	value="<?php 
if(!$flagnuevosoliservestado){ echo $sbreg[estsolnombre];}else{ echo $estsolnombre; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%" class="NoiseFooterTD"><?php if($campnomb["estsoltipo"] == 1){ $estsoltipo = null; echo "*";}?>
 Tipo</td> 
 <td width="59%" class="NoiseErrorDataTD"> 
 <select name="estsoltipo">
            <?php
            if(!$flagnuevosoliservestado)
            {
            	echo '<option value = "">Seleccione'; 
            }
            elseif ($accionnuevosoliservestado)
            {
            	echo '<option value = "'.$estsoltipo.'">'; 
                if($estsoltipo > 0)
					echo "1";
				elseif($estsoltipo == null) 
					echo "Seleccione"; 
				else 
					echo "0";
					
			}?></OPTION>
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
            </select>
 </td> 
 </tr> 
<tr> 
 <td width="41%" class="NoiseFooterTD"><?php if($campnomb["estsoldescri"] == 1){$estsoldescri = null; 
echo "*";}?>Descripci&oacute;n</td> 
 <td width="59%" class="NoiseErrorDataTD"> 
  <textarea name="estsoldescri" rows="2" wrap="VIRTUAL"><?php if(!$flagnuevosoliservestado){echo $sbreg[estsoldescri];}else {echo $estsoldescri;}?></textarea>
 </td> 
 </tr> 
</table> 
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionnuevosoliservestado.value =  1;"  width="86" height="18" 
alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablsoliservestado.php';"  width="86" height="18" 
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
<input type="hidden" name="estsolcodigo" value="<?php 
if(!$flagnuevosoliservestado){ echo $sbreg[estsolcodigo];}else{ echo $estsolcodigo; } ?>"> 
<input type="hidden" name="accionnuevosoliservestado"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
