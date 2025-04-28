<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andr�s A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Consultar en pedido</title> 
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
<p><font class="NoiseFormHeaderFont">pedido</font></p> 
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
            <table width="85%" border="0" cellspacing="0" cellpadding="0" 
align="center"> 
              <tr> 
                <td width="41%">pedidocodigo</td> 
<td width="59%"> 
<input type="text" name="pedidocodigo" value="<?php if(!$flagconsultarpedido){ 
echo $sbreg[pedidocodigo];}else{ echo $pedidocodigo; } ?>"> 
</td> 
</tr> 
<tr> 
 <td width="41%">pedidocodigo</td> 
 <td width="59%"> 
  <input type="text" name="pedidocodigo"	value="<?php 
if(!$flagconsultarpedido){ echo $sbreg[pedidocodigo];}else{ echo $pedidocodigo; 
}?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%">cotizacodigo</td> 
 <td width="59%"> 
  <input type="text" name="cotizacodigo"	value="<?php 
if(!$flagconsultarpedido){ echo $sbreg[cotizacodigo];}else{ echo $cotizacodigo; 
}?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%">proveecodigo</td> 
 <td width="59%"> 
  <input type="text" name="proveecodigo"	value="<?php 
if(!$flagconsultarpedido){ echo $sbreg[proveecodigo];}else{ echo $proveecodigo; 
}?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%">usuacodi</td> 
 <td width="59%"> 
  <input type="text" name="usuacodi"	value="<?php if(!$flagconsultarpedido){ 
echo $sbreg[usuacodi];}else{ echo $usuacodi; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%">pedidofecgen</td> 
 <td width="59%"> 
  <input type="text" name="pedidofecgen"	value="<?php 
if(!$flagconsultarpedido){ echo $sbreg[pedidofecgen];}else{ echo $pedidofecgen; 
}?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%">pedidofecfin</td> 
 <td width="59%"> 
  <input type="text" name="pedidofecfin"	value="<?php 
if(!$flagconsultarpedido){ echo $sbreg[pedidofecfin];}else{ echo $pedidofecfin; 
}?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%">pedidofecrec</td> 
 <td width="59%"> 
  <input type="text" name="pedidofecrec"	value="<?php 
if(!$flagconsultarpedido){ echo $sbreg[pedidofecrec];}else{ echo $pedidofecrec; 
}?>"> 
 </td> 
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
onclick="form1.accionconsultarpedido.value =  
1;form1.action='maestablpedido.php';"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablpedido.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagconsultarpedido" value="1"> 
<input type="hidden" name="accionconsultarpedido"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="columnas" value="pedidocodigo, 
cotizacodigo, 
proveecodigo, 
usuacodi, 
pedidofecgen, 
pedidofecfin, 
pedidofecrec 
"> 
<input type="hidden" name="nombtabl" value="pedido"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
