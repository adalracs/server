<?php 
ob_start();
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ('../src/FunPerPriNiv/pktblcentcost.php');
	include ( '../src/FunPerPriNiv/pktblproveedo.php');
	include ( '../src/FunPerPriNiv/pktblproveestado.php');
	include ( '../src/FunPerPriNiv/pktblherramieproveedo.php');
	
	if($accioneditarherramie) 
	{ 
		include ( 'editaherramie.php'); 
		$flageditarherramie = 1;
	}
ob_end_flush();
	if(!$flageditarherramie)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');
		
		//----
		$idcon = fncconn();			
		$record["herramcodigo"] = $sbreg[herramcodigo];
		$rs_herramieproveedo = dinamicscanherramieproveedo($record, $idcon);

		if($rs_herramieproveedo > 0)
		{
			$numReg = fncnumreg($rs_herramieproveedo);
			
			for($i = 0; $i < $numReg; $i++)
			{
				$sbRow = fncfetch($rs_herramieproveedo, $i);
	
				if($sbRow["herramcodigo"] == $sbreg["herramcodigo"])
				{	
					if($proveedor)
						$proveedor .= ','.$sbRow["proveecodigo"];
					else
						$proveedor = $sbRow["proveecodigo"];
				}
			}
		}
		//---
		$cencoscodigo = $sbreg[cencoscodigo];
	}
?>
<html> 
	<head> 
		<title>Editar registro de herramienta</title> 
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
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Editar registro</font></span></td></tr>
				<tr>
					<td>
       					<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
       						<tr> 
 								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["herramnombre"] == 1){ $herramnombre = null; echo "*";} ?>&nbsp;Nombre</td> 
  								<td width="75%" class="NoiseDataTD"><input type="text" name="herramnombre"	value="<?php if(!$flageditarherramie){ echo $sbreg[herramnombre];}else {echo $herramnombre;}?>" size="50"></td> 
 							</tr>
 							<tr>
								<td class="NoiseFooterTD"><?php if($campnomb["cencoscodigo"] == 1){ $cencoscodigo = null; echo "*";}?>&nbsp;C&oacute;digo financiero</td>
								<td class="NoiseDataTD"><select name="cencoscodigo">
									<option value = "">-- Seleccione --</option>
								 	<?php
										include ('../src/FunGen/floadcentcost.php');
										$idcon = fncconn();
										floadcentcost($cencoscodigo,$idcon);
								 	?>
								</select></td>
					    	</tr>
					    	<tr>
							 	<td class="NoiseFooterTD"><?php if($campnomb["herramvalor"] == 1){ $herramvalor = null; echo "*";}?>&nbsp;Valor</td>
							 	<td class="NoiseDataTD"><input name="herramvalor" type="text"	value="<?php if(!$flageditarherramie){ echo $sbreg[herramvalor];}else{ echo $herramvalor;}?>" size="20"></td>
							</tr>
							<tr>
		                		<td class="NoiseFooterTD">&nbsp;Cantidad disponible</td>
		                		<td class="NoiseDataTD">&nbsp;<?php if(!$flageditarherramie){ if($sbreg[herramdispon])echo $sbreg[herramdispon]; else echo "0";} else { echo $herramdispon;}?></td>
		              		</tr>
							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD"><?php if($campnomb["herramdescri"]	 == 1){$herramdescri = null; echo "*";}?>&nbsp;Descripci&oacute;n</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><textarea name="herramdescri" rows="3" cols="63"><?php if(!$flageditarherramie){ echo $sbreg[herramdescri];}else{ echo $herramdescri;} ?></textarea>  </td></tr>
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
			<input type="hidden" name="herramcodigo" value="<?php if(!$flageditarherramie){ echo $sbreg[herramcodigo];}else{ echo $herramcodigo;} ?>">
			<input type="hidden" name="herramdispon" value="<?php if(!$flageditarherramie){ if($sbreg[herramdispon])echo $sbreg[herramdispon]; else echo "0";} else { echo $herramdispon;}?>">
			<input type="hidden" name="accioneditarherramie">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="editar">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>