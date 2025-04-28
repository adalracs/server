<?php 
ob_start(); 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include('../src/FunPerPriNiv/pktbltipomovi.php');
	include('../src/FunPerPriNiv/pktblitem.php');
	include('../src/FunPerPriNiv/pktblunimedida.php'); 
	include('../src/FunPerPriNiv/pktblbodega.php'); 
	include('../src/FunPerPriNiv/pktblitemestado.php');
	 
	if($accionnuevotransacitem) 
		include ( 'grabatransacitem.php'); 
		
	unset($rs_item);
	if($flagnuevotransacitem)
	{
		$idcon = fncconn();
		$rs_item = loadrecorditem($itemcodigo, $idcon);
	}
ob_end_flush(); 
?>
<html> 
	<head> 
		<title>Nuevo registro de transaccion de item</title> 
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
			<p><font class="NoiseFormHeaderFont">Entrada/Salida de item</font></p> 
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
										if(!$flagnuevotransacitem)
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
	        						<option value="1"<?php if($flagnuevotransacitem && $bodegatipo == 1 ) echo ' selected' ?>>Bodega</option>
	        						<option value="2"<?php if($flagnuevotransacitem && $bodegatipo == 2 ) echo ' selected' ?>>T&eacute;cnico</option>
	        					</select></td>
	        				</tr>
	        				<tr>
	        					<td class="NoiseFooterTD"><?php if ($campnomb["bodegacodigo"] == 1) { $bodegacodigo = null; echo "*"; }?>&nbsp;<span id="procede"><?php if($bodegatipo == 2): echo 'T&eacute;cnico'; else: echo 'Bodega'; endif; ?></span></td>
	        					<td class="NoiseDataTD">
	        						<div id="tecnico" style="display: <?php if($bodegatipo == 2): echo 'block;'; else: echo 'none;'; endif; ?>">
		        						<input type="text" name="usuacodigo" id="usuacodigo" value="<?php if($flagnuevotransacitem){ echo $usuacodigo; } ?>" size="10" >
		        						<input type="text" name="usuanombre" id="usuanombre" value="<?php if($flagnuevotransacitem){ echo $usuanombre; } ?>" size="50" >
		        					</div>
	        						<div id="bodega" style="display: <?php if($bodegatipo != 2): echo 'block;'; else: echo 'none;'; endif; ?>">
		        						<input type="hidden" name="bodegacodigo" id="bodegacodigo" value="<?php if($flagnuevotransacitem){ echo $bodegacodigo; } ?>" >
		        						<input type="text" name="bodeganombre" id="bodeganombre" value="<?php if($flagnuevotransacitem){ echo $bodeganombre; } ?>" size="65" >
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
	        					<td width="20%"  class="NoiseFooterTD">&nbsp;Item</td>
	        					<td class="NoiseDataTD">
	        						<input type="hidden" name="itemcodigo" id="itemcodigo" value="<?php if($flagnuevotransacitem){ echo $itemcodigo; } ?>">
	        						<input type="text" name="itemnombre" id="itemnombre" value="<?php if($flagnuevotransacitem){ echo $itemnombre; } ?>" size="65" >
	        					</td>
      						</tr>
      						<tr><td colspan="2" class="ui-state-default"></td></tr>
      						<tr>
      							<td colspan="2">
      								<div id="filtritem">
	       								<table width="100%" border="0" cellspacing="0" cellpadding="1" align="center">
	      									<tr>
												<td width="25%" class="ui-state-default">&nbsp;Cant. M&iacute;nima&nbsp;&nbsp;<?php  echo $rs_item[itemcanmin]; ?></td>
												<td width="25%" class="ui-state-default">&nbsp;Cant. M&aacute;xima&nbsp;&nbsp;<?php  echo $rs_item[itemcanmax]; ?></td>
												<td width="25%" class="ui-state-default">&nbsp;Disponible&nbsp;&nbsp;<?php  echo $rs_item[itemdispon]; ?></td>
												<td width="25%" class="ui-state-default">Valor $&nbsp;&nbsp;<?php echo $rs_item[itemvalor]; ?><input type="hidden" name="itemvalor" value="<?php echo $rs_item[itemvalor] ?>"></td>
											</tr>
										</table>
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
							 	<td width="20%" class="NoiseFooterTD"><?php if ($campnomb["itestacodigo"] == 1) { $itestacodigo = null; echo "*"; }?>&nbsp;Estado</td> 
							 	<td width="30%" class="NoiseDataTD"><select name="itestacodigo">
							    <option value="">-- Seleccione --</option>
									<?php
										if(!$flagnuevotransacitem)
											unset($itestacodigo);
											
										include ('../src/FunGen/floaditemestado.php');
										floaditemestadosel($itestacodigo, $idcon);
										fncclose($idcon);
								?>
								</select></td> 
							 	<td width="20%" class="NoiseFooterTD"><?php if($campnomb["transitecantid"] == 1){$transitecantid = null; echo "*";} ?>&nbsp;Cantidad</td>
							 	<td width="30%" class="NoiseDataTD"><input name="transitecantid" type="text"	value="<?php if(!$flagnuevotransacitem){ echo $sbreg[transitecantid];}else{ echo $transitecantid; }?>" size="10">&nbsp;<span id="acronimo"><?php echo $rs_unidad[unidadacra]; ?></span></td>
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
			<input type="hidden" name="transitecodigo" value="<?php if(!$flagnuevotransacitem){ echo $sbreg[transitecodigo];}else{ echo $transitecodigo; } ?>">
			<input type="hidden" name="transitetotal"	value="<?php if(!$flagnuevotransacitem){ echo $sbreg[transitetotal];}else{ echo $transitetotal; }?>">
			<input type="hidden" name="transitefecha" value="<?php echo date('Y-m-d'); ?>">
			<input type="hidden" name="accionnuevotransacitem">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="nuevo">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>