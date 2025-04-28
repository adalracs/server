<?php 

	ob_start();
		include ( "../src/FunPerPriNiv/pktbltiposoliprog.php"); 
		include ( "../src/FunPerPriNiv/pktblcentcost.php"); 
		include ( "../src/FunGen/cargainput.php");
		include ( "../src/FunGen/sesion/fncvalses.php");
		include ( "../src/FunPerSecNiv//fncsqlrun.php");  
	
	ob_end_flush();

	if($accioneditartarifa) { 
		include ( "editatarifa.php"); 
	}

	if(!$flageditartarifa)
	{
		include ( "../src/FunGen/sesion/fnccarga.php");
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( "../src/FunGen/fnccontfron.php");

		$idcon = fncconn();
		if($sbreg['tipsolcodigo'])
			$tipsol = loadrecordtiposoliprog($sbreg['tipsolcodigo'],$idcon);

		if($sbreg['cencoscodigo'])
			$cencos = loadrecordcentcost($sbreg['cencoscodigo'],$idcon);



		$tarifacodigo = $sbreg["tarifacodigo"];
		$cencoscodigo = $cencos["cencoscodigo"];
		$tipsolcodigo = $tipsol["tipsolcodigo"];
		$tarifames = $sbreg["tarifames"];
		$tarifaano = $sbreg["tarifaano"];
		$tarifamod = $sbreg["tarifamod"];
		$tarifamoi = $sbreg["tarifamoi"];
		$tarifacdep = $sbreg["tarifacdep"];
		$tarifasdep = $sbreg["tarifasdep"];
		$tarifaene = $sbreg["tarifaene"];
		$tarifaman = $sbreg["tarifaman"];
		$tarifaotros = $sbreg["tarifaotros"];
			

		$fildat.="&tarifacodigo_c=".$tarifacodigo_c;   
		$fildat.="&cencoscodigo_c=".$cencoscodigo_c;   
		$fildat.="&tipsolcodigo_c=".$tipsolcodigo_c;   
		$fildat.="&tarifames_c=".$tarifames_c;   
		$fildat.="&tarifaano_c=".$tarifaano_c;   
		$fildat.="&tarifamod_c=".$tarifamod_c;   
		$fildat.="&tarifamoi_c=".$tarifamoi_c;   
		$fildat.="&tarifacdep_c=".$tarifacdep_c;   
		$fildat.="&tarifasdep_c=".$tarifasdep_c;  
		$fildat.="&tarifaene_c=".$tarifaene_c;  
		$fildat.="&tarifaman_c=".$tarifaman_c;  
		$fildat.="&tarifaotros_c=".$tarifaotros_c;   
		$fildat.="&accionconsultartarifa=".$accionconsultartarifa;

		$meses = array(
		"ENERO",
		"FEBRERO",
		"MARZO",
		"ABRIL",
		"MAYO",
		"JUNIO",
		"JULIO",
		"AGOSTO",
		"SEPTIEMBRE",
		"OCTRUBRE",
		"NOVEIMBRE",
		"DICIEMBRE",
		);
	}
?>
<html> 
	<head> 
		<title>Editar registro de tarifa</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include("../def/jquery.library_maestro.php");?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Tarifa</font></p> 
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
            			<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center"> 
            				 <tr>
								<td width="35%" class="NoiseFooterTD"><?php if($campnomb["cencoscodigo"] == 1){ $cencoscodigo = null; echo "*";}?>&nbsp;Centro de costo&nbsp;</td>
								<td colspan="3" width="55%" class="NoiseDataTD">
									<select name="cencoscodigo" id="cencoscodigo">
										<option value="">--Seleccione--</option>
										<?php
											include("../src/FunGen/floadcentcost.php");
											floadcentcost($cencoscodigo,$idcon);
										?>
									</select>
								</td>
 							</tr>
 							<tr>
								<td width="35%" class="NoiseFooterTD"><?php if($campnomb["tipsolcodigo"] == 1){ $tipsolcodigo = null; echo "*";}?>&nbsp;Proceso&nbsp;</td>
								<td colspan="3" width="55%" class="NoiseDataTD">
									<select name="tipsolcodigo" id="tipsolcodigo">
										<option value="">--Seleccione--</option>
										<?php
											include("../src/FunGen/floadtiposoliprog.php");
											floadtiposoliprog($tipsolcodigo,$idcon);
										?>
									</select>
								</td>
 							</tr>
            				<tr>
								<td width="10%" class="NoiseFooterTD"><?php if($campnomb["tarifames"] == 1){ $tarifames = null; echo "*";}?>&nbsp;Mes&nbsp;</td>
								<td width="10%" class="NoiseDataTD">
									<select name="tarifames" id="tarifames">
										<option value="">--Seleccione--</option>
										<?php for ($i=0; $i < 12 ; $i++) { ?>
											<option  <?php echo ((($i+1)==$tarifames)?'selected':''); ?>  value="<?php echo (($i>9)?$i+1:"0".($i+1)); ?>"><?php echo $meses[$i]; ?></option>
										<?php } ?>
									</select>
								</td>
								<td width="10%" class="NoiseFooterTD"><?php if($campnomb["tarifaano"] == 1){ $tarifaano = null; echo "*";}?>&nbsp;Año&nbsp;</td>
								<td width="10%" class="NoiseDataTD">
									<select name="tarifaano" id="tarifaano">
										<option value="">--Seleccione--</option>
										<?php for ($i=2012; $i < 3000 ; $i++) { ?>
											<option  <?php echo (($i==$tarifaano)?'selected':''); ?>  value="<?php echo $i; ?>"><?php echo $i; ?></option>
										<?php } ?>
									</select>
								</td>
 							</tr>
 							<tr>
								<td width="35%" class="NoiseFooterTD"><?php if($campnomb["tarifamod"] == 1){ $tarifamod = null; echo "*";}?>&nbsp;Mano de obra directa&nbsp;</td>
								<td colspan="3" width="55%" class="NoiseDataTD"><input type="text" name="tarifamod" size="20" value="<?php echo $tarifamod; ?>" /></td>
 							</tr>
 							<tr>
								<td width="35%" class="NoiseFooterTD"><?php if($campnomb["tarifamoi"] == 1){ $tarifamoi = null; echo "*";}?>&nbsp;Mano de obra indirecta&nbsp;</td>
								<td colspan="3" width="55%" class="NoiseDataTD"><input type="text" name="tarifamoi" size="20" value="<?php echo $tarifamoi; ?>" /></td>
 							</tr>
 							<tr>
								<td width="35%" class="NoiseFooterTD"><?php if($campnomb["tarifacdep"] == 1){ $tarifacdep = null; echo "*";}?>&nbsp;Cif con depresiacion&nbsp;</td>
								<td colspan="3" width="55%" class="NoiseDataTD"><input type="text" name="tarifacdep" size="20" value="<?php echo $tarifacdep; ?>" /></td>
 							</tr>
 							  				<tr>
								<td width="35%" class="NoiseFooterTD"><?php if($campnomb["tarifasdep"] == 1){ $tarifasdep = null; echo "*";}?>&nbsp;Cif sin depresiacion&nbsp;</td>
								<td colspan="3" width="55%" class="NoiseDataTD"><input type="text" name="tarifasdep" size="20" value="<?php echo $tarifasdep; ?>" /></td>
 							</tr>
 							<tr>
								<td width="35%" class="NoiseFooterTD"><?php if($campnomb["tarifaene"] == 1){ $tarifaene = null; echo "*";}?>&nbsp;Energia&nbsp;</td>
								<td colspan="3" width="55%" class="NoiseDataTD"><input type="text" name="tarifaene" size="20" value="<?php echo $tarifaene; ?>" /></td>
 							</tr>
 							<tr>
								<td width="35%" class="NoiseFooterTD"><?php if($campnomb["tarifaman"] == 1){ $tarifaman = null; echo "*";}?>&nbsp;Mantenimiento&nbsp;</td>
								<td colspan="3" width="55%" class="NoiseDataTD"><input type="text" name="tarifaman" size="20" value="<?php echo $tarifaman; ?>" /></td>
 							</tr>
 							<tr>
								<td width="35%" class="NoiseFooterTD"><?php if($campnomb["tarifaotros"] == 1){ $tarifaotros = null; echo "*";}?>&nbsp;Otros&nbsp;</td>
								<td colspan="3" width="55%" class="NoiseDataTD"><input type="text" name="tarifaotros" size="20" value="<?php echo $tarifaotros; ?>" /></td>
 							</tr>
 							<tr>
 								<td width="10%" class="NoiseFooterTD"></td>
 							</tr>
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
			<input type="hidden" name="accioneditartarifa">
			<input type="hidden" name="sourceaction" value="editar">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="tarifacodigo" value="<?php echo $tarifacodigo; ?>">

			<input type="hidden" name="fildat" value="<?php echo $fildat; ?>">
			<input type="hidden" name="columnas" value="tarifacodigo,cencoscodigo,tipsolcodigo,tarifames,tarifaano,tarifamod,tarifamoi,tarifacdep,tarifasdep,tarifaman,tarifaotros"> 
			<input type="hidden" name="tarifacodigo_c" value="<?php if ($accionconsultartarifa) { echo $tarifacodigo_c; } ?>">  
			<input type="hidden" name="cencoscodigo_c" value="<?php if ($accionconsultartarifa) { echo $cencoscodigo_c; } ?>">  
			<input type="hidden" name="tipsolcodigo_c" value="<?php if ($accionconsultartarifa) { echo $tipsolcodigo_c; } ?>">  
			<input type="hidden" name="tarifames_c" value="<?php if ($accionconsultartarifa) { echo $tarifames_c; } ?>">  
			<input type="hidden" name="tarifaano_c" value="<?php if ($accionconsultartarifa) { echo $tarifaano_c; } ?>">  
			<input type="hidden" name="tarifamod_c" value="<?php if ($accionconsultartarifa) { echo $tarifamod_c; } ?>">  
			<input type="hidden" name="tarifamoi_c" value="<?php if ($accionconsultartarifa) { echo $tarifamoi_c; } ?>">  
			<input type="hidden" name="tarifacdep_c" value="<?php if ($accionconsultartarifa) { echo $tarifacdep_c; } ?>">  
			<input type="hidden" name="tarifasdep_c" value="<?php if ($accionconsultartarifa) { echo $tarifasdep_c; } ?>"> 
			<input type="hidden" name="tarifaene_c" value="<?php if ($accionconsultartarifa) { echo $tarifaene_c; } ?>"> 
			<input type="hidden" name="tarifaman_c" value="<?php if ($accionconsultartarifa) { echo $tarifaman_c; } ?>"> 
			<input type="hidden" name="tarifaotros_c" value="<?php if ($accionconsultartarifa) { echo $tarifaotros_c; } ?>">  
			<input type="hidden" name="accionconsultartarifa"	value="<?php echo $accionconsultartarifa; ?>"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>