<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
?> 
<html> 
	<head> 
		<title>Consultar en habilidad</title> 
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
if(!$codigo) { echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Habilidades</font></p> 
			<table width="40%" border="0" align="center" cellpadding="2" cellspacing="1" class="NoiseFormTABLE"> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Consultar registro</font></span></td></tr> 
				<tr>
					<td> 
						<table width="85%" border="0" cellspacing="1" cellpadding="3" align="center"> 
							<tr> 
								<td width="33%" class="NoiseFooterTD">C&oacute;digo</td> 
								<td width="67%" class="NoiseFooterTD"><input type="text" name="habilicodigo"	value="<?php if(!$flagconsultarhabilida){ echo $sbreg[habilicodigo];}else{ echo $habilicodigo;} ?>">   </td> 
							</tr> 
							<tr>
								<td class="NoiseFooterTD">Nombre</td>
								<td class="NoiseFooterTD"><input type="text" name="habilinombre"	value="<?php if(!$flagconsultarhabilida){ echo $sbreg[habilinombre];}else{ echo $habilinombre;} ?>"></td>
							</tr>
							<tr> 
								<td width="33%" class="NoiseFooterTD">Descripci&oacute;n</td> 
								<td width="67%" rowspan="2" class="NoiseFooterTD"><textarea name="habilidescri" rows="3" wrap="VIRTUAL"><?php if(!$flagconsultarhabilida){ echo $sbreg[habilidescri];}else{ echo $habilidescri;} ?></textarea></td> 
							</tr>
							<tr><td class="NoiseFooterTD">&nbsp;</td></tr> 
						</table> 
					</td> 
				</tr> 
				<tr> 
					<td> 
						<div align="center"> 
							<input type="image" name="aceptar"  src="../img/aceptar.gif" onclick="form1.accionconsultarhabilida.value =  1; form1.action='maestablhabilida.php';"  width="86" height="18" alt="Aceptar" border=0> 
							<input type="image" name="cancelar" src="../img/cancelar.gif" onclick="form1.action='maestablhabilida.php';"  width="86" height="18" alt="Cancelar" border=0> 
						</div> 
					</td> 
				</tr> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
			<input type="hidden" name="flagconsultarhabilida" value="1"> 
			<input type="hidden" name="accionconsultarhabilida"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="columnas" value="habilicodigo, 
habilinombre, 
habilidescri, 
equiponombre, 
equipodescri, 
equipofabric, 
equipomarca, 
equipomodelo, 
equiposerie, 
equipolargo, 
equipoancho, 
equipoalto, 
equipopeso, 
equipofeccom, 
equipocinv, 
equipovengar, 
equipoviduti, 
equipofecins, 
equipoubicac, 
equipovalhor, 
equiponohs 
"> 
			<input type="hidden" name="nombtabl" value="habilida"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html> 