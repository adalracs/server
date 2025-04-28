<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
?> 
<html> 
<head> 
<title>Consultar en cargo</title> 
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
<p><font class="NoiseFormHeaderFont">Cargo</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Consultar registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="85%" border="0" cellspacing="0" cellpadding="3" 
align="center"> 
<tr> 
 <td width="41%">C&oacute;digo</td> 
  <td width="59%"> 
   <input type="text" name="cargocodigo"	value="<?php if(!$flagconsultarcargo){echo $sbreg[cargocodigo];}else{ echo $cargocodigo;} ?>"> 
  </td> 
 </tr> 
<tr> 
 <td width="41%">Nombre</td> 
  <td width="59%"> 
   <input type="text" name="cargonombre"	value="<?php if(!$flagconsultarcargo){ 
echo $sbreg[cargonombre];}else{ echo $cargonombre;} ?>"> 
  </td> 
 </tr> 
<tr> 
 <td width="41%">Descripci&oacute;n</td> 
  <td width="59%" rowspan="2"> 
    <textarea name="cargodescri" rows="3" wrap="VIRTUAL"><?php if(!$flagconsultarcargo){ echo $sbreg[cargodescri];}else{ echo $cargodescri;}?></textarea> 
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
onclick="form1.accionconsultarcargo.value =  1; 
form1.action='maestablcargo.php';"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablcargo.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagconsultarcargo" value="1"> 
<input type="hidden" name="accionconsultarcargo"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="columnas" value="cargocodigo, 
cargonombre, 
cargodescri, 
plantaubicac, 
plantaarea, 
plantadescri 
"> 
<input type="hidden" name="nombtabl" value="cargo"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
