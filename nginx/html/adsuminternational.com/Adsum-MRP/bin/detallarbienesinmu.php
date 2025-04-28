<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	
	if(!$flagdetallarbienesinmueble)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');
	}
?> 
<html> 
	<head> 
		<title>Detalle de registro de bienes inmueble</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
		<script language="JavaScript" src="motofech.js"></script> 
	</head> 
<?php if(!$codigo){ echo "<!--";}?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Bienes inmuebles temporales</font></p> 
			<table width="40%" border="0" align="center" cellpadding="2" cellspacing="1" class="NoiseFormTABLE"> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Detallar registro</font></span></td></tr> 
				<tr> 
					<td> 
						<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr> 
								<td width="20%" valign="top" class="NoiseFooterTD">&nbsp;C&oacute;digo</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[bieninmucodigo]; ?></td> 
							</tr> 
							<tr> 
								<td class="NoiseFooterTD">&nbsp;Nombre</td> 
								<td class="NoiseDataTD">&nbsp;<?php echo $sbreg[bieninmunombre]; ?></td> 
							</tr> 
							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD">&nbsp;<?php echo $sbreg[bieninmudescri]; ?></td></tr>
					  </table> 
					</td> 
				</tr> 
				<tr> 
					<td> 
						<div align="center"> 
							<input type="image" name="aceptar"  src="../img/aceptar.gif" onClick="form1.action='maestablbienesinmu.php';"  width="86" height="18" alt="Aceptar" border=0> 
						</div> 
					</td> 
				</tr> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
			<input type="hidden" name="flagdetallarbienesinmueble" value="1"> 
			<input type="hidden" name="acciondetallarbienesinmueble"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="columnas" value="bieninmucodigo,bieninmunombre,bieninmudescri">
			<input type="hidden" name="bieninmucodigo" value="<?php echo $bieninmucodigo; ?>">
 			<input type="hidden" name="bieninmunombre" value="<?php echo $bieninmunombre; ?>">
 			<input type="hidden" name="bieninmudescri" value="<?php echo $bieninmudescri; ?>">
 			<input type="hidden" name="accionconsultarbienesinmueble" value="<?php echo $accionconsultarbienesinmueble; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; }?> 
</html>