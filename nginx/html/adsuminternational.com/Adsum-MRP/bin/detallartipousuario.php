<?php 
include ( '../src/FunGen/sesion/fncvalses.php');
if(!$flagdetallartipousuario){
	include ( '../src/FunGen/sesion/fnccarga.php');
	$sbreg = fnccarga($nombtabl,$radiobutton);
	if (!$sbreg){
		include( '../src/FunGen/fnccontfron.php');
	}
}
?> 
<html> 
	<head> 
		<title>Detalle de registro de tipo usuario</title> 
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
<?php if(!$codigo){ echo "<!--";}?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Tipos de empleados</font></p> 
			<table width="40%" border="0" align="center" cellpadding="2" cellspacing="1" class="NoiseFormTABLE"> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Detallar registro</font></span></td></tr> 
				<tr> 
					<td> 
						<table width="85%" border="0" cellspacing="1" cellpadding="3" align="center"> 
							<tr> 
								<td width="33%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
								<td width="67%" class="NoiseDataTD"><?php if(!$flagdetallartipousuario){ echo $sbreg[tipusucodigo];}else{ echo $tipusucodigo;} ?></td> 
							</tr> 
							<tr> 
								<td width="33%" class="NoiseFooterTD">&nbsp;Nombre</td> 
								<td width="67%" class="NoiseDataTD"><?php if(!$flagdetallartipousuario){ echo $sbreg[tipusunombre];}else{ echo $tipusunombre;} ?></td> 
							</tr> 
							<tr> 
								<td width="33%" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td> 
								<td width="67%" rowspan="2" class="NoiseDataTD" valign="top"><?php if(!$flagdetallartipousuario){ echo $sbreg[tipusudescri];}else{ echo $tipusudescri;} ?></td> 
							</tr>
							<tr class="NoiseFooterTD"><td>&nbsp;</td></tr> 
						</table> 
					</td> 
				</tr> 
				<tr> 
					<td> 
						<div align="center"> 
							<input type="image" name="aceptar"  src="../img/aceptar.gif" onclick="form1.action='maestabltipousuario.php';"  width="86" height="18" alt="Aceptar" border=0> 
						</div> 
					</td> 
				</tr> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
			<input type="hidden" name="flagdetallartipousuario" value="1"> 
			<input type="hidden" name="acciondetallartipousuario"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; }?> 
</html> 