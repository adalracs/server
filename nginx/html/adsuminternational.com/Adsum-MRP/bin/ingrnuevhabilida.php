<?php
ob_start();
include ( '../src/FunGen/sesion/fncvalses.php');
if($accionnuevohabilida){
	include ( 'grabahabilida.php');
}
ob_end_flush();
?>
<html>
	<head>
		<title>Nuevo registro de habilida</title>
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
			<p><font class="NoiseFormHeaderFont">Habilidades</font></p>
			<table width="40%" border="0" align="center" cellpadding="2" cellspacing="1" class="NoiseFormTABLE">
	  			<tr><td width="273" class="NoiseErrorDataTD">&nbsp;</td>
	  			</tr>
	  			<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Ingresar nuevo registro</font></span></td></tr>
				<tr>
	  				<td>
	            				<table width="85%" border="0" cellspacing="1" cellpadding="3" align="center">
							<tr>
								<td valign="top" class="NoiseFooterTD"><?php if($campnomb["habilinombre"] == 1){ $habilinombre = null; echo "*";} ?>Nombre</td>
	                						<td class="NoiseFooterTD"><input type="text" name="habilinombre"	value="<?php if(!$flagnuevohabilida){ echo $sbreg[habilinombre];} else {echo $habilinombre;}?>"></td>
              					  </tr>
	              					<tr>
	 							<td width="33%" valign="top" class="NoiseFooterTD"> <?php if($campnomb["habilidescri"] == 1){ $habilidescri = null; echo "*";} ?>Descripci&oacute;n</td>
	  							<td width="67%" rowspan="2" class="NoiseFooterTD"><textarea name="habilidescri" rows="3" wrap="VIRTUAL"><?php if(!$flagnuevohabilida){ echo $sbreg[habilidescri];} else {echo $habilidescri;}?></textarea></td>
	 						</tr>
	              					<tr><td class="NoiseFooterTD">&nbsp;</td>
	              					</tr>

					  </table>
					</td>
	 			</tr>
	 			<tr>
					<td>
						<div align="center">
							<input type="image" name="aceptar"  src="../img/aceptar.gif" onClick="form1.accionnuevohabilida.value =  1;"  width="86" height="18" alt="Aceptar"  border=0>
							<input type="image" name="cancelar" src="../img/cancelar.gif" onClick="form1.action='maestablhabilida.php';"  width="86" height="18" alt="Cancelar" border=0>
						</div>
					</td>
	 			</tr>
	 			<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
		  </table>
<?php if($campnomb){ echo '<font face="Verdana" >Corregir los campos marcados con *</font>';}  ?>
	 		<input type="hidden" name="habilicodigo"	value="<?php if(!$flagnuevohabilida){ echo $sbreg[habilicodigo];}else{ echo $habilicodigo;} ?>">
			<input type="hidden" name="accionnuevohabilida">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>