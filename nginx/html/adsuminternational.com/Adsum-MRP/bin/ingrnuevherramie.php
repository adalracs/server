<?php 
ob_start();
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include('../src/FunPerPriNiv/pktblcentcost.php');
	include ( '../src/FunPerPriNiv/pktblproveedo.php');
	include ( '../src/FunPerPriNiv/pktblproveestado.php');
	
	if($accionnuevoherramie)
		include ( 'grabaherramie.php');
ob_end_flush();
?>
<html> 
	<head> 
		<title>Nuevo registro de herramienta</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Herramienta</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="600">
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
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Ingresar nuevo registro</font></span></td></tr>
				<tr>
					<td>
       					<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
       						<tr> 
 								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["herramnombre"] == 1){ $herramnombre = null; echo "*";} ?>&nbsp;Nombre</td> 
  								<td width="80%" class="NoiseDataTD"><input type="text" name="herramnombre"	value="<?php if(!$flagnuevoherramie){ echo $sbreg[herramnombre];}else {echo $herramnombre;}?>" size="50"></td> 
 							</tr>
 							<tr>
								<td class="NoiseFooterTD"><?php if($campnomb["cencoscodigo"] == 1){ $cencoscodigo = null; echo "*";}?>&nbsp;C&oacute;digo financiero</td>
								<td class="NoiseDataTD"><select name="cencoscodigo">
									<option value = "">-- Seleccione --</option>
								 	<?php
								 		if(!$flagnuevoherramie)
								 			unset($cencoscodigo);
								 	
										include ('../src/FunGen/floadcentcost.php');
										$idcon = fncconn();
										floadcentcost($cencoscodigo,$idcon);
								 	?>
								</select></td>
					    	</tr>
					    	<tr>
							 	<td class="NoiseFooterTD"><?php if($campnomb["herramvalor"] == 1){ $herramvalor = null; echo "*";}?>&nbsp;Valor</td>
							 	<td class="NoiseDataTD"><input name="herramvalor" type="text"	value="<?php if(!$flagnuevoherramie){ echo $sbreg[herramvalor];}else{ echo $herramvalor;}?>" size="20"></td>
							</tr>
							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD"><?php if($campnomb["herramdescri"]	 == 1){$herramdescri = null; echo "*";}?>&nbsp;Descripci&oacute;n</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><textarea name="herramdescri" rows="3" cols="63"><?php if(!$flagnuevoherramie){ echo $sbreg[herramdescri];}else{ echo $herramdescri;} ?></textarea>  </td></tr>
						</table>
					</td>
				</tr>
				<tr> 
					<td><?php 
							$noAjax = true;
       						include '../src/FunjQuery/jquery.visors/jquery.proveedo.php'; 
       				?></td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_form.php'; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
			</table>
			<input type="hidden" name="herramcodigo" value="<?php if(!$flagnuevoherramie){ echo $sbreg[herramcodigo];}else{ echo $herramcodigo;} ?>">
			<input type="hidden" name="herramdispon" value="0">
			<input type="hidden" name="accionnuevoherramie">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="nuevo">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>