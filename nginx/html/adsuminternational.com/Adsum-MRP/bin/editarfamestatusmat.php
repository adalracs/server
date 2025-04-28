<?php 
ini_set("display_errors", 1);
ob_start();
	include ("../src/FunPerPriNiv/pktblitemdesa.php");
	include ( "../src/FunGen/cargainput.php");
	include ( "../src/FunGen/sesion/fncvalses.php");
	include ( "../src/FunPerSecNiv//fncsqlrun.php");  
	
	if($accioneditarfamestatusmat) { 

		include ( "editafamestatusmat.php"); 
	}

ob_end_flush();

	if(!$flageditarfamestatusmat){

		include ( "../src/FunGen/sesion/fnccarga.php");
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( "../src/FunGen/fnccontfron.php");

		$famestcodigo = $sbreg["famestcodigo"];
		$famestnombre = $sbreg["famestnombre"];
		$famestdescri = $sbreg["famestdescri"];
		$famestestado = $sbreg["famestestado"];
		$famesttipo = $sbreg["famesttipo"];
	}
?>
<html> 
	<head> 
		<title>Editar registro de familias x estatus</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include("../def/jquery.library_maestro.php");?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Familias x estatus</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="500">
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
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["famestnombre"] == 1){ $famestnombre = null; echo "*";}?>&nbsp;Nombre&nbsp;</td>
								<td width="80%" class="NoiseDataTD" colspan="2"><input type="text" name="famestnombre" size="30"	value="<?php echo $famestnombre; ?>"></td>
 							</tr>
 							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["famestestado"] == 1){ $famestestado = null; echo "*";}?>&nbsp;Estado&nbsp;</td>
								<td width="80%" class="NoiseDataTD" colspan="2">
									<select name="famestestado" id="famestestado">
										<option value="">--Seleccione--</option>
										<option value="0" <?php if($famestestado == '0'){echo 'selected';}?> >Activo</option>
										<option value="1" <?php if($famestestado == '1'){echo 'selected';}?> >In-Activo</option>
									</select>
								</td>
 							</tr> 
 							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["famesttipo"] == 1){ $famesttipo = null; echo "*";}?>&nbsp;Tipo&nbsp;</td>
								<td width="80%" class="NoiseDataTD" colspan="2">
									<select name="famesttipo" id="famesttipo">
										<option value="">--Seleccione--</option>
										<option value="0" <?php if($famesttipo == '0'){echo 'selected';}?> >Manufacturados</option>
										<option value="1" <?php if($famesttipo == '1'){echo 'selected';}?> >Importados</option>
									</select>
								</td>
 							</tr> 					 						 					 					 						
 							<tr>
 								<td width="10%" class="NoiseFooterTD"></td>
 							</tr>
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD"><?php if($campnomb["famestdescri"]	 == 1){$famestdescri = null; echo "*";}?>&nbsp;Nota</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><textarea name="famestdescri" rows="3" cols="63"><?php echo $famestdescri; ?></textarea>  </td></tr>
						</table> 
  					</td> 
 				</tr> 

				</tr> 
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_form.php'; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
			</table> 
			<input type="hidden" name="accioneditarfamestatusmat">
			<input type="hidden" name="sourceaction" value="editar">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="material" value="<?php echo $material; ?>">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="famestcodigo" value="<?php echo $famestcodigo; ?>">
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>