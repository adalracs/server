<?php 
ob_start();
include ( '../src/FunGen/sesion/fncvalses.php');
/*if($accionnuevocargo)
{
	include ( 'grabacargo.php');
}*/
ob_end_flush();
?> 
<html> 
<head> 
<title>Tiempo medio de reparaciones</title> 
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
<p><font class="NoiseFormHeaderFont">Tiempo medio de reparaciones</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Tiempo medio de reparaciones</font></span></td></tr> 
<tr> 
  <td>
            <table width="85%" border="0" cellspacing="0" cellpadding="3" 
align="center">
<tr>
  <td width="59%">
  <input type="button" name="buscar" value="Buscar equipo(s)" onclick="window.open('consultarequipotimedrep.php?codigo=<?php 
  echo $codigo?>','secundaria1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');"
  width="86" height="18" alt="Cancelar" border=0 href="#" target="_parent">

  </td> 
  </tr>
  <tr>
 <td width="41%"> <?php if($campnomb == "cargonombre"){ $cargonombre = null;
echo "*";}
?>Nombre</td> 
  <td width="59%"> 
   <input type="text" name="cargonombre"	value="<?php if(!$flagnuevocargo){ 
echo $sbreg[cargonombre];}else {echo $cargonombre; }?>"> 
  </td> 
 </tr> 
<tr> 
 <td width="41%"> <?php if($campnomb == "cargodescri"){ $cargodescri = null;
echo "*";}
?>Descripci&oacute;n</td> 
  <td width="59%" rowspan="2"> 
    <textarea name="cargodescri" rows="3" wrap="VIRTUAL"><?php if(!$flagnuevocargo){ 
echo $sbreg[cargodescri];}else {echo $cargodescri;}?></textarea> 
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
onclick="form1.accionnuevocargo.value =  1;"  
width="86" height="18" alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='';"  width="86" height="18" 
alt="Cancelar" border=0> 
<img src="../img/ayuda.gif" border="0" alt="Ayuda">
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
<input type="hidden" name="cargocodigo"	value="<?php if(!$flagnuevocargo){ 
echo $sbreg[cargocodigo];}else{ echo $cargocodigo;} ?>">
<input type="hidden" name="accionnuevocargo"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 
