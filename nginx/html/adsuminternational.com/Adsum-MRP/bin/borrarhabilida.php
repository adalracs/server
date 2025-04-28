<?php
include ( '../src/FunGen/sesion/fncvalses.php');
if(!$flagborrarhabilida){
	include ( '../src/FunGen/sesion/fnccarga.php');
	$sbreg = fnccarga($nombtabl,$radiobutton);
	
	if (!$sbreg){
		include( '../src/FunGen/fnccontfron.php');
	}
}
?> 
<html> 
	<head> 
		<title>Borrar registro de habilidades</title> 
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
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Habilidades</font></p> 
			<table width="40%" border="0" align="center" cellpadding="2" cellspacing="1" class="NoiseFormTABLE"> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Borrar registro</font></span></td></tr> 
				<tr>
					<td> 
						<table width="85%" border="0" cellspacing="1" cellpadding="3" align="center"> 
							<tr> 
								<td width="30%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
								<td width="70%" class="NoiseDataTD"><?php if(!$flagborrarhabilida){ echo $sbreg[habilicodigo];}else{ echo $habilicodigo;}?></td> 
							</tr> 
							<tr>
								<td class="NoiseFooterTD">&nbsp;Nombre</td>
								<td class="NoiseDataTD"><?php if(!$flagborrarhabilida){ echo $sbreg[habilinombre];}else{ echo $habilinombre;} ?></td>
							</tr>
							<tr> 
								<td width="30%" class="NoiseFooterTD" valign="top">&nbsp;Descripci&oacute;n</td> 
								<td rowspan="2" class="NoiseDataTD" valign="top"><?php if(!$flagborrarhabilida){ echo $sbreg[habilidescri];}else{ echo $habilidescri;}?></td> 
							</tr>
							<tr class="NoiseFooterTD"><td>&nbsp;</td></tr>
						</table> 
					</td> 
				</tr> 
				<tr> 
					<td> 
						<div align="center"> 
							<input type="image" name="aceptar"  src="../img/aceptar.gif" onclick="form1.accionborrarhabilida.value =  1; form1.action='maestablhabilida.php';"  width="86" height="18" alt="Aceptar" border=0> 
							<input type="image" name="cancelar" src="../img/cancelar.gif" onclick="form1.action='maestablhabilida.php';"  width="86" height="18" alt="Cancelar" border=0> 
						</div> 
					</td> 
				</tr> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
			<input type="hidden" name="flagborrarhabilida" value="1"> 
			<input type="hidden" name="accionborrarhabilida"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="habilicodigo" value="<?php if(!$flagborrarhabilida){ echo $sbreg[habilicodigo];}else{ echo $habilicodigo;}?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; }?> 
</html>