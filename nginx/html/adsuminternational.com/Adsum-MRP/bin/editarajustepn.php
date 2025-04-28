<?php 
ob_start();
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblcomplejidadpn.php');
	include ( '../src/FunPerPriNiv/pktbltiposoliprog.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunGen/cargainput.php');
	
	if($accioneditarajustepn) 
	{ 
		include ( 'editaajustepn.php'); 
		$flageditarajustepn = 1;
	}
ob_end_flush();
	if(!$flageditarajustepn)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');
			
		$ajustecodigo = $sbreg['ajustecodigo'];
		$ajustenombre = $sbreg['ajustenombre'];
		$complecodigo = $sbreg['complecodigo'];
		$tipsolcodigo = $sbreg['tipsolcodigo'];
		$equipocodigo = $sbreg['equipocodigo'];
		$ajustevalora = $sbreg['ajustevalora'];
		$ajustedescri = $sbreg['ajustedescri'];
	}
	
	$idcon = fncconn();
?>
<html> 
	<head> 
		<title>Editar registro de ajustes y/o cambios de produccion</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Ajustes y/o cambios en produccion</font></p> 
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
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["ajustenombre"] == 1){ $ajustenombre = null; echo "*";}?>&nbsp;Nombre&nbsp;</td>
								<td width="75%" class="NoiseDataTD"><input type="text" name="ajustenombre" size="30"	value="<?php echo $ajustenombre; ?>"></td>
 							</tr>
 							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["complecodigo"] == 1){ $complecodigo = null; echo "*";}?>&nbsp;Nivel&nbsp;</td>
								<td width="75%" class="NoiseDataTD">
									<select name="complecodigo"> 
										<option value="">--Seleccione--</option>
										<?php 
											include ("../src/FunGen/floadcomplejidadpn.php");
											floadcomplejidadpn($complecodigo,$idcon);
										?>
									</select>
 							</tr>
 							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["tipsolcodigo"] == 1){ $tipsolcodigo = null; echo "*";}?>&nbsp;Tipo&nbsp;</td>
								<td width="75%" class="NoiseDataTD">
									<select name="tipsolcodigo" id="tipsolcodigo" onchange="document.form1.submit();"> 
										<option value="">--Seleccione--</option>
										<?php 
											include ("../src/FunGen/floadtiposoliprog.php");
											floadtiposoliprog($tipsolcodigo,$idcon);
										?>
									</select>
 							</tr>
 							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["equipocodigo"] == 1){ $equipocodigo = null; echo "*";}?>&nbsp;Equipo&nbsp;</td>
								<td width="75%" class="NoiseDataTD">
									<select name="equipocodigo" id="equipocodigo"> 
										<option value="">--Seleccione--</option>
										<?php 
											include ("../src/FunGen/floadequipoop.php");
											floadequipotiposoliprog($tipsolcodigo,$equipocodigo,$idcon);
										?>
									</select>
 							</tr>
 							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["ajustevalora"] == 1){ $ajustevalora = null; echo "*";}?>&nbsp;Minutos</td>
								<td width="75%" class="NoiseDataTD"><input type="text" name="ajustevalora" size="30"	value="<?php echo $ajustevalora; ?>"></td>
 							</tr>
 							<tr>
 								<td width="10%" class="NoiseFooterTD"></td>
 							</tr>
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD"><?php if($campnomb["ajustedescri"]	 == 1){$ajustedescri = null; echo "*";}?>&nbsp;Nota</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><textarea name="ajustedescri" rows="3" cols="63"><?php echo $ajustedescri; ?></textarea>  </td></tr>
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
			<input type="hidden" name="accioneditarajustepn">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="editar">
			<input type="hidden" name="ajustecodigo" value="<?php echo $ajustecodigo; ?>">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>