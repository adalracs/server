<?php
ob_start();
	include ( '../src/FunGen/sesion/fncvalses.php');;
	include('../src/FunPerPriNiv/pktblcentcost.php');
	include('../src/FunPerPriNiv/pktblproveedo.php');
	include('../src/FunPerPriNiv/pktblitemequipo.php');
	include('../src/FunPerPriNiv/pktblitemproveedo.php');
	include('../src/FunPerPriNiv/pktblunimedida.php');
	include ( '../src/FunPerPriNiv/pktblproveestado.php');
		
	if($accioneditaritem)
	{
		include ( 'editaitem.php');
		$flageditaritem = 1;
	}
ob_end_flush();
	if(!$flageditaritem)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');

		//-----
		$idcon = fncconn();			
		$record["itemcodigo"] = $sbreg[itemcodigo];
		$rs_itemproveedo = dinamicscanitemproveedo($record, $idcon);

		if($rs_itemproveedo > 0)
		{
			$numReg = fncnumreg($rs_itemproveedo);
			
			for($i = 0; $i < $numReg; $i++)
			{
				$sbRow = fncfetch($rs_itemproveedo, $i);
	
				if($sbRow["itemcodigo"] == $sbreg["itemcodigo"])
				{	
					if($proveedor)
						$proveedor .= ','.$sbRow["proveecodigo"];
					else
						$proveedor = $sbRow["proveecodigo"];
				}
			}
		}
		//----
		$cencoscodigo = $sbreg[cencoscodigo];
		$unidadcodigo = $sbreg[unidadcodigo];
	}
?>
<html> 
	<head> 
		<title>Editar registro de Item</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Item</font></p> 
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
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Editar registro</font></span></td></tr>
				<tr>
					<td>
       					<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
       						<tr> 
 								<td class="NoiseFooterTD"><?php if($campnomb["itemcodigo"] == 1){ $itemcodigo = null; echo "*";} ?>&nbsp;C&oacute;digo</td> 
  								<td colspan="3" class="NoiseDataTD"><input type="text" name="itemcodigo"	value="<?php if(!$flageditaritem){ echo $sbreg[itemcodigo];}else {echo $itemcodigo;}?>" size="10"></td> 
 							</tr>
       						<tr> 
 								<td class="NoiseFooterTD"><?php if($campnomb["itemnombre"] == 1){ $itemnombre = null; echo "*";} ?>&nbsp;Nombre</td> 
  								<td colspan="3" class="NoiseDataTD"><input type="text" name="itemnombre"	value="<?php if(!$flageditaritem){ echo $sbreg[itemnombre];}else {echo $itemnombre;}?>" size="50"></td> 
 							</tr>
 							<tr>
								<td class="NoiseFooterTD"><?php if($campnomb["cencoscodigo"] == 1){ $cencoscodigo = null; echo "*";}?>&nbsp;C&oacute;digo financiero</td>
								<td colspan="3" class="NoiseDataTD"><select name="cencoscodigo">
									<option value = "">-- Seleccione --</option>
								 	<?php
										include ('../src/FunGen/floadcentcost.php');
										$idcon = fncconn();
										floadcentcost($cencoscodigo,$idcon);
								 	?>
								</select></td>
					    	</tr>
					    	<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["unidadcodigo"] == 1){ $unidadcodigo = null; echo "*";} ?>&nbsp;Unidad de medida</td>
								<td width="30%" class="NoiseDataTD"><select name="unidadcodigo">
							  		<option value = "">-- Seleccione --</option>
								 	<?php
										include ('../src/FunGen/floadunimedida.php');
										floadunimedidasel($unidadcodigo, $idcon);
								 	?>
								</select></td>
							 	<td width="20%" class="NoiseFooterTD"><?php if($campnomb["itemvalor"] == 1){ $itemvalor = null; echo "*";}?>&nbsp;Valor</td>
							 	<td width="30%" class="NoiseDataTD"><input name="itemvalor" type="text"	value="<?php if(!$flageditaritem){ echo $sbreg[itemvalor];}else{ echo $itemvalor;}?>" size="20"></td>
							</tr>
					    	<tr>
							 	<td class="NoiseFooterTD"><?php if($campnomb["itemcanmin"] == 1){ $itemcanmin=null; echo "*";}?>&nbsp;Cantidad M&iacute;nima</td>
							 	<td class="NoiseDataTD"><input name="itemcanmin" type="text"	value="<?php if(!$flageditaritem){ echo $sbreg[itemcanmin];}else{ echo $itemcanmin;}?>" size="20"></td>
							 	<td class="NoiseFooterTD"><?php if($campnomb["itemcanmax"] == 1){ $itemcanmax=null; echo "*";}?>&nbsp;Cantidad M&aacute;xima</td>
							 	<td class="NoiseDataTD"><input name="itemcanmax" type="text"	value="<?php if(!$flageditaritem){ echo $sbreg[itemcanmax];}else{ echo $itemcanmax;}?>" size="20"></td>
							</tr>
					    	<tr>
							 	<td class="NoiseFooterTD">&nbsp;Cantidad Disponible</td>
							 	<td class="NoiseDataTD">&nbsp;<?php if(!$flageditaritem){ if($sbreg[itemdispon]) echo $sbreg[itemdispon]; else echo "0"; } else { echo $itemdispon; } ?></td>
							 	<td class="NoiseFooterTD">&nbsp;Densidad</td>
							 	<td class="NoiseDataTD"><input name="itemdensid" type="text"	value="<?php if(!$flageditaritem){ echo $sbreg[itemdensid];}else{ echo $itemdensid;}?>" size="20"></td>
							</tr>
							<tr> 
 								<td class="NoiseFooterTD"><?php if($campnomb["itemextru"] == 1){ $itemextru = null; echo "*";} ?>&nbsp;Extruido</td> 
  								<td colspan="3" class="NoiseDataTD"><select name="itemextru" id="itemextru">
  								<?php if($flageditaritem) $sbreg[itemextru] = $itemextru; ?>
 								<option value="">--Seleccione--</option>
 								<option value="t" <?php if($sbreg[itemextru] == 't'){echo 'selected';}?>>Si</option>
 								<option value="f" <?php if($sbreg[itemextru] == 'f'){echo 'selected';}?>>No</option>
 								</select></td> 
 							</tr>
 							<tr> 
 								<td class="NoiseFooterTD"><?php if($campnomb["itempigme"] == 1){ $itempigme = null; echo "*";} ?>&nbsp;Pigmentado</td> 
  								<td colspan="3" class="NoiseDataTD"><select name="itempigme" id="itempigme">
  								<?php if($flageditaritem) $sbreg[itempigme] = $itempigme; ?>
 								<option value="">--Seleccione--</option>
 								<option value="t" <?php if($sbreg[itempigme] == 't'){echo 'selected';}?>>Si</option>
 								<option value="f" <?php if($sbreg[itempigme] == 'f'){echo 'selected';}?>>No</option>
 								</select></td> 
 							</tr>
							<tr><td colspan="4" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="4" class="NoiseFooterTD"><?php if($campnomb["itemnota"]	 == 1){$itemnota = null; echo "*";}?>&nbsp;Nota</td></tr>
							<tr><td colspan="4" rowspan="2" class="NoiseDataTD"><textarea name="itemnota" rows="3" cols="65"><?php if(!$flageditaritem){ echo $sbreg[itemnota];}else{ echo $itemnota;} ?></textarea>  </td></tr>
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
			<input type="hidden" name="itemdispon" value="<?php if(!$flageditaritem){ if($sbreg[itemdispon]) echo $sbreg[itemdispon]; else echo "0"; } else { echo $itemdispon; } ?>">
			<input type="hidden" name="accioneditaritem">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="editar">
			<input type="hidden" name="flagerror" value="<?php echo $flagerror; ?>"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>