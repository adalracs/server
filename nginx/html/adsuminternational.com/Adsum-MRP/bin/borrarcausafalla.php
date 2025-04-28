<?php 
include ( '../src/FunGen/sesion/fncvalses.php');
if(!$flagborrarcausafalla)
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
<title>Borrar registro de causa falla</title> 
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
<p><font class="NoiseFormHeaderFont">Causas de Falla</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE" width="45%"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Borrar registro</font></span></td></tr> 
<tr> 
  					<td> 
            			<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center"> 
             				<tr> 
 								<td width="25%" class="NoiseFooterTD">C&oacute;digo</td> 
  								<td width="75%" class="NoiseDataTD"><?php echo $sbreg[caufallcodigo]; ?></td> 
 							</tr> 
             				<tr>
               					<td class="NoiseFooterTD">Nombre</td>
               					<td class="NoiseDataTD"><?php echo $sbreg[caufallnombre]; ?></td>
             				</tr>
             				<tr><td colspan="2" class="NoiseFooterTD">Descripci&oacute;n</td></tr>
             				<tr><td colspan="2" class="NoiseDataTD"><?php echo $sbreg[caufalldescri]; ?></td></tr>
						</table> 
  					</td> 
 				</tr> 	
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionborrarcausafalla.value =  1; 
form1.action='maestablcausafalla.php';"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablcausafalla.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagborrarcausafalla" value="1"> 
<input type="hidden" name="accionborrarcausafalla"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="caufallcodigo" value="<?php echo $sbreg[caufallcodigo]; ?>"> 
</form> 
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 
