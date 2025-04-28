<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
?> 
<html> 
	<head> 
		<title>Consultar en tipo usuario</title> 
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
			<p><font class="NoiseFormHeaderFont">Tipos de empleados</font></p> 
			<table width="40%" border="0" align="center" cellpadding="2" cellspacing="1" class="NoiseFormTABLE"> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Consultar registro</font></span></td></tr> 
				<tr> 
					<td> 
						<table width="85%" border="0" cellspacing="1" cellpadding="3" align="center"> 
							<tr> 
								<td width="33%" class="NoiseFooterTD">C&oacute;digo</td> 
								<td width="67%" class="NoiseFooterTD"><input type="text" name="tipusucodigo"	value="<?php if(!$flagconsultartipousuario){ echo $sbreg[tipusucodigo];}else{ echo $tipusucodigo;} ?>"></td> 
							</tr> 
							<tr> 
								<td width="33%" class="NoiseFooterTD">Nombre</td> 
								<td width="67%" class="NoiseFooterTD"><input type="text" name="tipempnombre"	value="<?php if(!$flagconsultartipousuario){ echo $sbreg[tipusunombre];}else{ echo $tipusunombre;} ?>"> </td> 
							</tr> 
							<tr> 
								<td width="33%" class="NoiseFooterTD">Descripci&oacute;n</td> 
								<td width="67%" rowspan="2" class="NoiseFooterTD"><textarea name="tipusudescri" rows="3" wrap="VIRTUAL"><?php if(!$flagconsultartipousuario){ echo $sbreg[tipusudescri];}else{ echo $tipusudescri;} ?></textarea></td> 
							</tr>
							<tr class="NoiseFooterTD"><td>&nbsp;</td></tr> 
						</table> 
					</td> 
				</tr> 
				<tr> 
					<td> 
						<div align="center"> 
							<input type="image" name="aceptar"  src="../img/aceptar.gif" onclick="form1.accionconsultartipousuario.value =  1; form1.action='maestabltipousuario.php';"  width="86" height="18" alt="Aceptar" border=0> 
							<input type="image" name="cancelar" src="../img/cancelar.gif" onclick="form1.action='maestabltipousuario.php';"  width="86" height="18" alt="Cancelar" border=0> 
						</div> 
					</td> 
				</tr> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
			<input type="hidden" name="flagconsultartipousuario" value="1"> 
			<input type="hidden" name="accionconsultartipousuario"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="columnas" value="tipusucodigo, 
tipusunombre, 
tipusudescri 
"> 
			<input type="hidden" name="nombtabl" value="tipousuario"> 
		</form> 
	</body> 
	<?php if(!$codigo){ echo " -->"; } ?> 
</html> 