<?php
include ( '../src/FunGen/sesion/fncvalses.php');
if(!$flagborrartipousuario){
	include ( '../src/FunGen/sesion/fnccarga.php');
	$sbreg = fnccarga($nombtabl,$radiobutton);
	if (!$sbreg){
		include( '../src/FunGen/fnccontfron.php');
	}
}
?>
<html>
	<head>
		<title>Borrar registro de tipousuario</title>
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
				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Borrar registro</font></span></td></tr>
				<tr>
					<td>
						<table width="85%" border="0" cellspacing="1" cellpadding="3" align="center">
							<tr>
								<td width="33%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td>
								<td width="67%" class="NoiseDataTD"><?php if(!$flagborrartipousuario){ echo $sbreg[tipusucodigo];}else{ echo $tipusucodigo;}?></td>
							</tr>
							<tr>
								<td width="33%" class="NoiseFooterTD">&nbsp;Nombre</td>
								<td width="67%" class="NoiseDataTD"><?php if(!$flagborrartipousuario){ echo $sbreg[tipusunombre];}else{ echo $tipusunombre;} ?></td>
							</tr>
							<tr>
								<td width="33%" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td>
								<td width="67%" rowspan="2" class="NoiseDataTD" valign="top"><?php if(!$flagborrartipousuario){ echo $sbreg[tipusudescri];}else{ echo $tipusudescri;} ?></td>
							</tr>
							<tr class="NoiseFooterTD"><td>&nbsp;</td></tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<div align="center">
							<input type="image" name="aceptar"  src="../img/aceptar.gif" onclick="form1.accionborrartipousuario.value =  1; form1.action='maestabltipousuario.php';"  width="86" height="18" alt="Aceptar" border=0>
							<input type="image" name="cancelar" src="../img/cancelar.gif" onclick="form1.action='maestabltipousuario.php';"  width="86" height="18" alt="Cancelar" border=0>
						</div>
					</td>
				</tr>
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
			</table>
			<input type="hidden" name="flagborrartipousuario" value="1">
			<input type="hidden" name="accionborrartipousuario">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="tipusucodigo" value="<?php if(!$flagborrartipousuario){ echo $sbreg[tipusucodigo];}else{ echo $tipusucodigo;}?>">
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; }?>
</html>