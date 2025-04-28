<?php
ob_start();
include ('../src/FunGen/sesion/fncvalses.php');
include ('../src/FunGen/fncloadpresentac.php');

if($accionnuevopresentac){
	include ( 'grabapresentac.php');
}
ob_end_flush();
?>
<html>
	<head>
		<title>Presentaci&oacute;n</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
		<link rel="stylesheet" type="text/css" href="temas/Noise/help.css"> 		
		<SCRIPT LANGUAGE="JavaScript">
			<!-- Begin
			agree = 0;
			//  End -->
		</script>
		<script language="JavaScript" src="motofech.js"></script>
		<style type="text/css">
			<!--
			.Estilo1 {font-size: 10px}
			-->
		</style>
	</head>
<?php  if(!$codigo){ echo "<!--"; }  ?>
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Par&aacute;metros de presentaci&oacute;n</font></p>
			<table border="0" cellspacing="1" cellpadding="3" align="center" class="NoiseFormTABLE" width="60%">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Par&aacute;metros de presentaci&oacute;n</font></span></td></tr>
				<tr>
					<td>
						<table width="70%" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
							<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr class="NoiseFooterTD"><td colspan="4">&nbsp;Barra de encabezado</td></tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
							<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr class="NoiseDataTD"> 
								<td ><a href="javascript:void(0);" onclick="window.open('detallapresentac.php?imgpresentac=<?php echo  $sbreg['presenbarra'];?>','detallaplano','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600'); return false;">Ver barra actual...</a> </td>
								<td>&nbsp;</td>
								<td colspan="2"><?php  if($campnomb['presenbarra']) echo "*"; ?>Nueva barra&nbsp;&nbsp;<input type="file" name="presenbarra"></td>
							</tr>
							<tr><td class="NoiseFooterTD" colspan="4"></td></tr>
							<tr><td class="NoiseFooterTD" colspan="4"></td></tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
							<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr class="NoiseFooterTD"><td colspan="4">&nbsp;Logo (grande)</td></tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
							<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr class="NoiseDataTD"> 
								<td ><a href="javascript:void(0);" onclick="window.open('detallapresentac.php?imgpresentac=<?php echo  $sbreg['presenloggra'];?>','detallaplano','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600'); return false;">Ver Logo actual...</a> </td>
								<td>&nbsp;</td>
								<td colspan="2"><?php  if($campnomb['presenloggra']) echo "*"; ?>Nuevo logo&nbsp;&nbsp;<input type="file" name="presenloggra"><br><span class="Estilo1">Esta im&aacute;gen debe tener una dimensi&oacute;n aproximada de 300x83 pix </span></td>
							</tr>
							<tr><td class="NoiseFooterTD" colspan="4"></td></tr>
							<tr><td class="NoiseFooterTD" colspan="4"></td></tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
							<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr class="NoiseFooterTD"><td colspan="4">&nbsp;Logo (peque&ntilde;o)</td></tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
							<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr class="NoiseDataTD"> 
								<td  width="30%" ><a href="javascript:void(0);" onclick="window.open('detallapresentac.php?imgpresentac=<?php echo  $sbreg['presenlogpeq'];?>','detallaplano','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600'); return false;">Ver Logo actual...</a> </td>
								<td  width="10%">&nbsp;</td>
								<td colspan="2"><?php  if($campnomb['presenlogpeq']) echo "*"; ?>Nuevo logo&nbsp;&nbsp;<input type="file" name="presenlogpeq"></td>
							</tr>
							<tr><td class="NoiseFooterTD" colspan="4"></td></tr>
							<tr><td class="NoiseFooterTD" colspan="4"></td></tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
							<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr class="NoiseFooterTD"><td colspan="4">&nbsp;Presentaci&oacute;n</td></tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
							<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr class="NoiseDataTD"><td colspan="4" rowspan="2"><textarea name="presenemppre" cols="60" rows="3"><?php echo  $sbreg['presenemppre']; ?></textarea></td></tr>
							<tr><td colspan="4"></td></tr>
							<tr><td class="NoiseFooterTD" colspan="4"></td></tr>
							<tr><td class="NoiseFooterTD" colspan="4"></td></tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
							<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr class="NoiseFooterTD"><td colspan="4">&nbsp;Copyright</td></tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
							<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr class="NoiseDataTD"><td colspan="4" rowspan="2"><textarea name="presenempcop" cols="60" rows="3"><?php echo  $sbreg['presenempcop']; ?></textarea></td></tr>
						</table>
					</td>
				</tr>
				<tr>
					<td><div align="center">
						<input type="image" name="aceptar"  src="../img/aceptar.gif" onclick="form1.accionnuevopresentac.value =  1;" width="86" height="18" alt="Aceptar" border=0>
						<input type="image" name="cancelar" src="../img/cancelar.gif" onclick="form1.action='main.php';"  width="86" height="18" alt="Cancelar" border=0>
					</div></td>
				</tr>
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
			</table>
<?php if($campnomb){ echo '<font face="Verdana" >Corregir los campos marcados con *</font>';} ?>
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="validaimg" value="<?php echo $validaimg; ?>">
			<input type="hidden" name="accionnuevopresentac" value="<?php echo $accionnuevopresentac; ?>">
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>
