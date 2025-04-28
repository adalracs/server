<?php 
ob_start();
	include ( '../src/FunPerPriNiv/pktbltipoestadosaldo.php');
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunGen/cargainput.php');
	
	if($accioneditarestadosaldo) 
	{ 
		include ( 'editaestadosaldo.php'); 
		$flageditarestadosaldo = 1;
	}
ob_end_flush();
	if(!$flageditarestadosaldo)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');
			
		$tipestcodigo = $sbreg[tipestcodigo];
	}
?>
<html> 
	<head> 
		<title>Editar registro de estados de saldos</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Estados de saldos</font></p> 
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
								<td width="10%" class="NoiseFooterTD"><?php if($campnomb["estsalcodigo"] == 1){ $estsalcodigo = null; echo "*";}?>&nbsp;Codigo&nbsp;</td>
								<td width="30%" class="NoiseDataTD"><?php if(!$flageditarestadosaldo){echo $sbreg[estsalcodigo];}else{echo $estsalcodigo;}?></td> 
 							</tr> 
 							<tr>
								<td width="10%" class="NoiseFooterTD"><?php if($campnomb["estsalnombre"] == 1){ $estsalcodigo = null; echo "*";}?>&nbsp;Nombre&nbsp;</td>
								<td width="40%" class="NoiseDataTD"><input type="text" name="estsalnombre" size="30"	value="<?php if(!$flageditarestadosaldo){ echo $sbreg[estsalnombre];}else {echo $estsalnombre; }?>"></td>
 							</tr>
 							<tr>
								<td width="10%" class="NoiseFooterTD"><?php if($campnomb["tipestcodigo"] == 1){ $tipestcodigo = null; echo "*";}?>&nbsp;Tipo&nbsp;</td>
								<td width="40%" class="NoiseDataTD"><select name="tipestcodigo" id="tipestcodigo"> 
								<option value="">--Seleccione--</option>
								<?php 
									$idcon = fncconn();
									include "../src/FunGen/floadtipoestadosaldo.php";
									floadtipoestadosaldo($tipestcodigo,$idcon);
								?>
								</select>
 							</tr>
 							<tr>
 								<td width="10%" class="NoiseFooterTD"></td>
 							</tr>
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD"><?php if($campnomb["estsaldescri"] == 1){$estsaldescri = null; echo "*";}?>&nbsp;Descripcion</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><textarea name="estsaldescri" rows="3" cols="63"><?php if(!$flagnuevoestadosaldo){ echo $sbreg[estsaldescri];}else{ echo $estsaldescri;} ?></textarea>  </td></tr>																
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
			<input type="hidden" name="accioneditarestadosaldo">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="estsalcodigo" value="<?php if(!$flageditarestadosaldo){echo $sbreg[estsalcodigo];}else{echo $estsalcodigo;}?>">
			<input type="hidden" name="sourceaction" value="editar">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>