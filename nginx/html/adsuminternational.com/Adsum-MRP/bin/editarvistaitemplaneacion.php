<?php 
ini_set("display_errors", 1);
ob_start();
	include ( "../src/FunPerPriNiv/pktblfamestatusmat.php");
	include ( "../src/FunPerPriNiv/pktblusuario.php");
	include ( "../src/FunGen/sesion/fncvalses.php");
	include ( "../src/FunGen/cargainput.php");
	
	if($accioneditarvistaitemplaneacion) { 
		include ( 'editavistaitemplaneacion.php'); 
		$flageditarvistaitemplaneacion = 1;
	}

ob_end_flush();
	if(!$flageditarvistaitemplaneacion){

		include ( "../src/FunGen/sesion/fnccarga.php");
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( "../src/FunGen/fnccontfron.php");

		$itedescodigo= $sbreg["itedescodigo"];
		$itedesnombre= $sbreg["itedesnombre"];
		$itedeslinea= $sbreg["itedeslinea"];
		$itedesfecha= $sbreg["itedesfecha"];
		$itedesunimed= $sbreg["itedesunimed"];
		$itedescosto= $sbreg["itedescosto"];
		$fechacarga= $sbreg["fechacarga"];
		$itedesslip= $sbreg["itedesslip"];
		$itedesantibl= $sbreg["itedesantibl"];
		$itedesancho= $sbreg["itedesancho"];
		$itedescalib= $sbreg["itedescalib"];
		$famestcodigo= $sbreg["famestcodigo"];
		$itedesformul = $sbreg["itedesformul"];
	
	}

	$idcon = fncconn();
?>
<html> 
	<head> 
		<title>Editar registro de item</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include("../def/jquery.library_maestro.php");?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">item</font></p> 
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
 								<td width="25%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
  								<td width="75%" class="NoiseDataTD"><input type="hidden" name="itedescodigo" id="itedescodigo" value="<?php echo $itedescodigo ?>" /><?php echo $itedescodigo; ?></td> 
 							</tr> 
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Nombre</td> 
  								<td class="NoiseDataTD"><input type="hidden" name="itedesnombre" id="itedesnombre" value="<?php echo $itedesnombre ?>" /><?php echo $itedesnombre; ?></td> 
 							</tr> 
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Linea</td> 
  								<td class="NoiseDataTD"><input type="hidden" name="itedeslinea" id="itedeslinea" value="<?php echo $itedeslinea ?>" /><?php echo $itedeslinea ?></td> 
 							</tr> 
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Fecha Creacion</td> 
  								<td class="NoiseDataTD"><input type="hidden" name="itedesfecha" id="itedesfecha" value="<?php echo $itedesfecha ?>" /><?php echo $itedesfecha ?></td> 
 							</tr> 
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Unidad de Medida</td> 
  								<td class="NoiseDataTD"><input type="hidden" name="itedesunimed" id="itedesunimed" value="<?php echo $itedesunimed ?>" /><?php echo $itedesunimed ?></td> 
 							</tr> 
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Costo</td> 
  								<td class="NoiseDataTD"><input type="hidden" name="itedescosto" id="itedescosto" value="<?php echo $itedescosto ?>" /><?php echo $itedescosto ?></td> 
 							</tr> 
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Fecha Actualizacion</td> 
  								<td class="NoiseDataTD"><input type="hidden" name="fechacarga" id="fechacarga" value="<?php echo $fechacarga ?>" /><?php echo $fechacarga ?></td> 
 							</tr> 
 							<tr> 
 								<td class="NoiseFooterTD"><?php if($campnomb['itedesancho']){echo '*';}?>&nbsp;Ancho </td> 
  								<td class="NoiseDataTD"><input type="text" name="itedesancho" id="itedesancho" value="<?php echo $itedesancho ?>" />&nbsp;(mm)</td> 
 							</tr> 
 							<tr> 
 								<td class="NoiseFooterTD"><?php if($campnomb['itedesancho']){echo '*';}?>&nbsp;Calibre </td> 
  								<td class="NoiseDataTD"><input type="text" name="itedescalib" id="itedescalib" value="<?php echo $itedescalib ?>" />&nbsp;(&micro;m)</td> 
 							</tr>
 							<tr> 
 								<td class="NoiseFooterTD"><?php if($campnomb['famestcodigo']){echo '*';}?>&nbsp;Familia </td> 
  								<td class="NoiseDataTD">
  									<select name="famestcodigo" id="famestcodigo">
  										<option value="">--Seleccione--</option>
										<?php
											include("../src/FunGen/floadfamestatusmat.php");
											floadfamestatusmat($famestcodigo, $idcon);
										?>
  									</select>
  								</td>
 							</tr>
 							<tr> 
 								<td class="NoiseFooterTD"><?php if($campnomb['itedesformul']){echo '*';}?>&nbsp;Formula </td> 
  								<td class="NoiseDataTD"><input type="text" name="itedesformul" id="itedesformul" value="<?php echo $itedesformul; ?>" /></td> 
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
			<input type="hidden" name="accioneditarvistaitemplaneacion">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="editar">
			<input type="hidden" name="codigo1" value="<?php if(!$flageditarvistaitemplaneacion){echo $sbreg[itedescodigo];}else{echo $codigo1;}?>">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>