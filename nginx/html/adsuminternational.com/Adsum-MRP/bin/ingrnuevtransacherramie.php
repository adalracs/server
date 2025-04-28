<?php 
ob_start(); 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include('../src/FunPerPriNiv/pktbltipomovi.php');
	include('../src/FunPerPriNiv/pktblherramie.php');
	include('../src/FunPerPriNiv/pktblbodega.php');
	include('../src/FunPerPriNiv/pktblherramestado.php');
	
	if($accionnuevotransacherramie) 
		include ( 'grabatransacherramie.php');

	if($flagnuevotransacherramie)
	{
		$idcon = fncconn();
		$rs_herramie = loadrecordherramie($herramcodigo, $idcon);
	}
	
ob_end_flush(); 
?>
<html> 
	<head> 
		<title>Nuevo registro de transaccion de herramienta</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		
		<script type="text/javascript">
			function changeProcede(index)
			{
				if(index == 1)
				{
					document.getElementById('procede').innerHTML = 'Bodega';
					document.getElementById('tecnico').style.display = 'none';
					document.getElementById('bodega').style.display = 'block';
				}
				else
				{
					document.getElementById('procede').innerHTML = 'T&eacute;cnico';
					document.getElementById('tecnico').style.display = 'block';
					document.getElementById('bodega').style.display = 'none';
				}
			}
			
		</script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Entrada/Salida de herramienta</font></p> 
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
       						<tr><td colspan="2" class="ui-state-default"><small>&nbsp;<?php echo date("Y-m-d")  ?></small></td></tr> 
 							<tr><td colspan="2" class="ui-state-default"></td></tr> 
 							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["tipmovcodigo"] == 1){ $tipmovcodigo = null; echo "*";} ?>&nbsp;Tipo de movimiento</td>
								<td width="80%" class="NoiseDataTD"><select name="tipmovcodigo">
									<option value="">-- Seleccione --</option>
									<?php
										if(!$flagnuevotransacherramie)
											unset($tipmovcodigo);
										
										include ('../src/FunGen/floadtipomovi.php');
										$idcon = fncconn();
										floadtipomovisel($tipmovcodigo, $idcon);
									?>
								</select></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
       					<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
	        					<td width="20%"  class="NoiseFooterTD">&nbsp;De</td>
	        					<td class="NoiseDataTD" width="80%"><select name="bodegatipo" id="bodegatipo" onchange="changeProcede(this.value);">
	        						<option value="1"<?php if($flagnuevotransacherramie && $bodegatipo == 1 ) echo ' selected' ?>>Bodega</option>
	        						<option value="2"<?php if($flagnuevotransacherramie && $bodegatipo == 2 ) echo ' selected' ?>>T&eacute;cnico</option>
	        					</select></td>
	        				</tr>
	        				<tr>
	        					<td class="NoiseFooterTD"><?php if ($campnomb["bodegacodigo"] == 1) { $bodegacodigo = null; echo "*"; }?>&nbsp;<span id="procede"><?php if($bodegatipo == 2): echo 'T&eacute;cnico'; else: echo 'Bodega'; endif; ?></span></td>
	        					<td class="NoiseDataTD">
	        						<div id="tecnico" style="display: <?php if($bodegatipo == 2): echo 'block;'; else: echo 'none;'; endif; ?>">
		        						<input type="text" name="usuacodigo" id="usuacodigo" value="<?php if($flagnuevotransacherramie){ echo $usuacodigo; } ?>" size="10" >
		        						<input type="text" name="usuanombre" id="usuanombre" value="<?php if($flagnuevotransacherramie){ echo $usuanombre; } ?>" size="50" >
		        					</div>
	        						<div id="bodega" style="display: <?php if($bodegatipo != 2): echo 'block;'; else: echo 'none;'; endif; ?>">
		        						<input type="hidden" name="bodegacodigo" id="bodegacodigo" value="<?php if($flagnuevotransacherramie){ echo $bodegacodigo; } ?>" >
		        						<input type="text" name="bodeganombre" id="bodeganombre" value="<?php if($flagnuevotransacherramie){ echo $bodeganombre; } ?>" size="65" >
		        					</div>
	        					</td>
      						</tr>
      					</table> 
					</td>
				</tr>
				<tr>
					<td>
       					<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
	        					<td width="20%"  class="NoiseFooterTD">&nbsp;Herramienta</td>
	        					<td class="NoiseDataTD">
	        						<input type="hidden" name="herramcodigo" id="herramcodigo" value="<?php if($flagnuevotransacherramie){ echo $herramcodigo; } ?>">
	        						<input type="text" name="herramnombre" id="herramnombre" value="<?php if($flagnuevotransacherramie){ echo $herramnombre; } ?>" size="65" >
	        					</td>
      						</tr>
      						<tr><td colspan="2" class="ui-state-default"></td></tr>
      						<tr>
      							<td colspan="2">
      								<div id="filtrherramie">
	       								<table width="100%" border="0" cellspacing="0" cellpadding="1" align="center">
										    <tr>
										    	<td width="50%" class="ui-state-default">&nbsp;Disponible&nbsp;&nbsp;<?php echo $rs_herramie['herramdispon'] ?></td>
										    	<td width="50%" class="ui-state-default">&nbsp;Valor&nbsp;&nbsp;<?php echo $rs_herramie['herramvalor'] ?><input type="hidden" name="herramvalor" value="<?php echo $rs_herramie[herramvalor] ?>"></td>
											</tr>
										</table>
									</div>
								</td>
      						</tr>
      					</table>
					</td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td>
       					<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
       						<tr> 
							 	<td width="20%" class="NoiseFooterTD"><?php if ($campnomb["herestcodigo"] == 1) { $herestcodigo = null; echo "*"; }?>&nbsp;Estado</td> 
							 	<td width="30%" class="NoiseDataTD"><select name="herestcodigo">
							    <option value="">-- Seleccione --</option>
									<?php
										if(!$flagnuevotransacherramie)
											unset($herestcodigo);
											
										include ('../src/FunGen/floadherramestado.php');
										floadherramestadosel($herestcodigo, $idcon);
										fncclose($idcon);
								?>
								</select></td> 
							 	<td width="20%" class="NoiseFooterTD"><?php if($campnomb["transhercanti"] == 1){$transhercanti = null; echo "*";} ?>&nbsp;Cantidad</td>
							 	<td width="30%" class="NoiseDataTD"><input name="transhercanti" type="text"	value="<?php if(!$flagnuevotransacitem){ echo $sbreg[transhercanti];}else{ echo $transhercanti; }?>" size="10"></span></td>
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
			<input type="hidden" name="transhercodigo" value="<?php if(!$flagnuevotransacherramie){ echo $sbreg[transhercodigo];}else{ echo $transhercodigo; } ?>">
			<input type="hidden" name="transhertotal"	value="<?php if(!$flagnuevotransacherramie){ echo $sbreg[transhertotal];}else{ echo $transhertotal; }?>">
			<input type="hidden" name="transherfecha" value="<?php echo date('Y-m-d'); ?>">
			<input type="hidden" name="accionnuevotransacherramie">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="nuevo">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>