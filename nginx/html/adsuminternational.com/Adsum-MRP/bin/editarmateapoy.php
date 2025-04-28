<?php 
ob_start();
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblciudad.php');
//	include ( '../src/FunPerPriNiv/pktblunicom.php');
	include ( '../src/FunGen/cargainput.php');
	
	if($accioneditarmateapoy) 
	{ 
		include ( 'editamateapoy.php'); 
		$flageditarmateapoy = 1;
	}
ob_end_flush();
	if(!$flageditarmateapoy)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');

	
	}
?>
<html> 
	<head> 
		<title>Editar registro de material de apoyo</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">material de apoyo</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="700">
<?php if($campnomb): ?>
				<tr><td><div class="ui-widget">
					<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
						<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
						<strong>Advertencia:</strong> Corrija los campos marcados con *</p>
					</div>
				</div></td></tr>
<?php else: ?> 		
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
<?php endif; ?>
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Editar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" > 
							<tr>
								<td width="10%" class="NoiseFooterTD"><?php if($campnomb["matapocodigo"] == 1){ $matapocodigo = null; echo "*";}?>&nbsp;Codigo&nbsp;</td>
								<td width="30%" class="NoiseDataTD"><?php echo $sbreg[matapocodigo];?></td> 
 							</tr> 
 							<tr>
								<td width="10%" class="NoiseFooterTD"><?php if($campnomb["mataponombre"] == 1){ $mataponombre = null; echo "*";}?>&nbsp;Nombre&nbsp;</td>
								<td width="30%" class="NoiseDataTD" colspan="2"><input type="text" name="mataponombre" size="30"	value="<?php if(!$flageditarmateapoy){ echo $sbreg[mataponombre];}else {echo $mataponombre; }?>"></td>
 							</tr>
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD"><?php if($campnomb["matapodescri"]	 == 1){$matapodescri = null; echo "*";}?>&nbsp;Nota</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><textarea name="matapodescri" rows="3" cols="80"><?php if(!$flagnuevoacceje){ echo $sbreg[matapodescri];}else{ echo $matapodescri;} ?></textarea>  </td></tr>																	
						</table>
					</td>
				</tr> 
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_form.php'; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
			</table> 
			<input type="hidden" name="accioneditarmateapoy">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="matapocodigo" value="<?php echo $sbreg[matapocodigo];?>">
			<input type="hidden" name="sourceaction" value="editar">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>