<?php 
ob_start();
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktbltipomedi.php');
	include ( '../src/FunGen/cargainput.php');
	
	if($accioneditarmedidoequipo) 
	{ 
		include ( 'editamedidoequipo.php'); 
		$flageditarmedidoequipo = 1;
	}
ob_end_flush();
	if(!$flageditarmedidoequipo)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');
			
		$idcon = fncconn();
		$equipocodigo = $sbreg[equipocodigo];
		$rsEquipo = loadrecordequipo($sbreg[equipocodigo],$idcon);
		$equipo = ($rsEquipo > 0)? $rsEquipo[equiponombre] : 'DESCONOCIDO';
		$tipmedcodigo  = $sbreg[tipmedcodigo];
		
	}
	
?>
<html> 
	<head> 
		<title>Editar registro de tipo de medidor</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">tipo de medidor</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="450">
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
 								<td class="NoiseFooterTD">&nbsp;Equipo</td> 
  								<td class="NoiseDataTD"><?php echo $equipo ?></td> 
 							</tr> 
 							<tr>
								<td width="30%" class="NoiseFooterTD"><?php if($campnomb["tipmedcodigo"] == 1){ $tipmedcodigo = null; echo "*";}?>&nbsp;Tipo de medidor</td>
								<td width="70%" class="NoiseDataTD" colspan="2"><select name="tipmedcodigo">
								<option value="">--Seleccione--</option>
								<?php 
								include '../src/FunGen/floadtipomedi.php';
								$idcon = fncconn();
								floadtipomedi($tipmedcodigo,$idcon);
								?>
								</select></td>
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
			<input type="hidden" name="accioneditarmedidoequipo">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="medequcodigo" value="<?php if(!$flageditarmedidoequipo){echo $sbreg[medequcodigo];}else{echo $medequcodigo;}?>">
			<input type="hidden" name="equipocodigo" value="<?php echo $equipocodigo ?>">
			<input type="hidden" name="equipo" value="<?php echo $equipo ?>">
			<input type="hidden" name="sourceaction" value="editar">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>