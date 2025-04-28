<?php 
include ( '../src/FunGen/sesion/fncvalses.php');
if(!$flagdetallarplano)
{
	include ( '../src/FunGen/sesion/fnccarga.php');
	$sbreg = fnccarga($nombtabl,$radiobutton);
	if (!$sbreg)
	{
		include( '../src/FunGen/fnccontfron.php');
	}
	$imgplano = $sbreg[planoruta];
}
?> 
<html> 
<head> 
<title>Detalle de registro de plano</title> 
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
<p><font class="NoiseFormHeaderFont">Plano</font></p> 
<table width="40%" border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Detallar registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="90%" border="0" cellspacing="0" cellpadding="3" 
align="center"> 
<tr> 
 <td width="41%" class="NoiseDataTD">C&oacute;digo</td> 
  <td><?php if(!$flagdetallarplano){ 
echo $sbreg[planocodigo];}else {echo $planocodigo;}?>
  </td> 
 </tr> 
<tr> 
 <td width="41%" class="NoiseDataTD">Nombre</td> 
  <td><?php if(!$flagdetallarplano){ 
echo $sbreg[planonombre];}else {echo $planonombre;}?>
  </td> 
 </tr> 
<tr>
  <td width="41%" class="NoiseDataTD">Ruta</td>
  <td><?php if(!$flagdetallarplano){ echo 
$sbreg[planoruta];}else {echo $planoruta;}?></td>
  </tr>
<tr> 
 <td width="41%" class="NoiseDataTD">Descripci&oacute;n</td> 
  <td> 

<?php if(!$flagdetallarplano){ 
echo $sbreg[planodescri];}else {echo $planodescri;}?> 
  </td> 
 </tr>
 <tr> 
 <td class="NoiseDataTD">Desea ver el plano?</td><td> <input type="image" src="../img/aceptar.gif" onclick="window.open('detallaplano.php?imgplano=<?php echo $imgplano;?>','detallaplano','status=no,menubar=no,scrollbars=yes,resizable=yes,left=210, top=150,width=1024,height=768');" width="86" height="18" alt="Aceptar" border=0></td> 
  </tr>
</table>  
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="Regresar"  src="../img/regresar.gif" 
onclick="form1.action='maestablplano.php';"  width="86" height="18" 
alt="Aceptar" border=0> 

</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagdetallarplano" value="1"> 
<input type="hidden" name="acciondetallarplano"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="imgplano" value="<?php echo $imgplano; ?>"> 
</form> 
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 
