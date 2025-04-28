<?php 
ini_set('display_errors',1);
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblpatronestruc.php');
	include ( '../src/FunPerPriNiv/pktblcamperequipopn.php');
	include ( '../src/FunPerPriNiv/pktblcpeqpndetope.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	
	if(!$flagdetallarreportelampn) 
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton);
		
		if (!$sbreg) 
			include( '../src/FunGen/fnccontfron.php');
		
		$idcon = fncconn();
			
		$relapncodigo = $sbreg[relapncodigo];
		$patestcodigo = $sbreg[patestcodigo];
		$equipocodigo = $sbreg[equipocodigo];
			
		$rwPatronestruc = loadrecordpatronestruc($patestcodigo,$idcon);
		$rwEquipo = loadrecordequipo($equipocodigo,$idcon);
		include 'cargarcamperequipopn.php';
	} 
?>
<html> 
	<head> 
		<title>Detalle de registro de reporte parametros de laminacion</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Reporte parametros de laminacion</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="750">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center">
 							<tr>
								<td width="30%" class="NoiseFooterTD">&nbsp;Patron Estructura&nbsp;</td>
								<td width="70%" class="NoiseDataTD">&nbsp;<?php echo strtoupper($rwPatronestruc['patestnombre']) ?></td>
 							</tr>
 							<tr>
 								<td width="20%" class="NoiseFooterTD">&nbsp;Equipo&nbsp;</td>
 								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo $rwEquipo['equiponombre'] ?></td>
 							</tr>
 							<tr><td colspan="2" class="ui-state-default">&nbsp;<small>Parametros Equipo</small></td></tr>
 							<tr>
 								<td colspan="2" class="NoiseDataTD">
 									<?php include '../src/FunjQuery/jquery.phpscripts/jquery.camperequipopn.det.php' ?> 
 								</td>
 							</tr>
 							<tr>
 								<td width="10%" class="NoiseFooterTD"></td>
 							</tr>
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Nota</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><?php echo $observaciones; ?></td></tr>
						</table> 
  					</td> 
 				</tr> 
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_formdetall.php'; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr> 
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
 			<input type="hidden" name="flagdetallarreportelampn" value="1"> 
			<input type="hidden" name="acciondetallarreportelampn">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="columnas" value="relapncodigo,patestcodigo,equipocodigo">
			<input type="hidden" name="relapncodigo" value="<?php if($accionconsultarreportelampn) echo $relapncodigo; ?>"> 
 			<input type="hidden" name="patestcodigo" value="<?php if($accionconsultarreportelampn) echo $patestcodigo; ?>"> 
 			<input type="hidden" name="equipocodigo" value="<?php if($accionconsultarreportelampn) echo $equipocodigo; ?>"> 
 			<input type="hidden" name="accionconsultarreportelampn" value="<?php echo $accionconsultarreportelampn; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>