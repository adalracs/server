<?php 
ob_start();
include ( '../src/FunGen/sesion/fncvalses.php');
if($accioneditartipousuario){ 
		include ( 'editatipousuario.php'); 
		$flageditartipousuario = 1;
}
ob_end_flush();
if(!$flageditartipousuario){
	include ( '../src/FunGen/sesion/fnccarga.php');
	$sbreg = fnccarga($nombtabl,$radiobutton);
	if (!$sbreg){
		include( '../src/FunGen/fnccontfron.php');
	}
}
?> 
<html> 
	<head> 
		<title>Editar registro de tipousuario</title> 
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
				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Editar registro</font></span></td></tr> 
				<tr> 
					<td> 
						<table width="85%" border="0" cellspacing="1" cellpadding="3" align="center"> 
							<tr> 
								<td width="33%" class="NoiseFooterTD"><?php if($campnomb["tipusunombre"] == 1){ $tipusunombre = null; echo "*";}?>Nombre</td> 
								<td width="67%" class="NoiseFooterTD"><input type="text" name="tipusunombre"	value="<?php if(!$flageditartipousuario){ echo $sbreg[tipusunombre];}else{ echo $tipusunombre;}?>"></td> 
							</tr> 
							<tr> 
								<td width="33%" class="NoiseFooterTD"><?php if($campnomb["tipusudescri"] == 1){ $tipusudescri = null; echo "*";}?>Descripci&oacute;n</td> 
								<td width="67%" rowspan="2" class="NoiseFooterTD"><textarea name="tipusudescri" rows="3" wrap="VIRTUAL"><?php if(!$flageditartipousuario){ echo $sbreg[tipusudescri];}else{ echo $tipusudescri;}?></textarea></td> 
							</tr>
							<tr><td class="NoiseFooterTD">&nbsp;</td></tr> 

						</table> 
					</td> 
				</tr> 
				<tr> 
					<td> 
						<div align="center"> 
							<input type="image" name="aceptar"  src="../img/aceptar.gif" onclick="form1.accioneditartipousuario.value =  1;"  width="86" height="18" alt="Aceptar" border=0> 
							<input type="image" name="cancelar" src="../img/cancelar.gif" onclick="form1.action='maestabltipousuario.php';"  width="86" height="18" alt="Cancelar" border=0> 
						</div> 
					</td> 
				</tr> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
<?php if($campnomb){ echo '<font face="Verdana" >Corregir los campos marcados con *</font>';}?>
			<input type="hidden" name="tipusucodigo"	value="<?php if(!$flageditartipousuario){ echo $sbreg[tipusucodigo];}else{ echo $tipusucodigo;}?>"> 
			<input type="hidden" name="accioneditartipousuario"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; }?> 
</html>