<?php 
include ( '../src/FunGen/sesion/fncvalses.php');
if(!$flagdetallarcausafalla)
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
		<title>Detalle de registro de causa de falla</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Causa de Falla</font></p> 
			<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE" width="45%"> 
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr> 
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
					<td><div align="center"> 
  						<input type="image" name="aceptar"  src="../img/aceptar.gif" onclick="form1.action='maestablcausafalla.php';"  width="86" height="18" alt="Aceptar" border=0> 
					</div></td> 
 				</tr> 
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
 			<input type="hidden" name="flagdetallarcausafalla" value="1"> 
			<input type="hidden" name="acciondetallarcausafalla"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>