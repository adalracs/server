<?php 
	include('../src/FunGen/sesion/fncvalses.php');
	include('../src/FunPerPriNiv/pktblcentcost.php');
	include('../src/FunPerPriNiv/pktblherramieproveedo.php');
	include('../src/FunPerPriNiv/pktblproveedo.php');
	include ( '../src/FunPerPriNiv/pktblproveestado.php');
	include('../src/FunGen/cargainput.php');

	if(!$flagborrarherramie)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');

		//----
		$idcon = fncconn();			
		//---
		$cencosnombre = cargacentcostnumero($sbreg["cencoscodigo"], $idcon);
	}
?>
<html> 
	<head> 
		<title>Borrar registro de herramienta</title> 
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
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Borrar registro</font></span></td></tr>
				<tr>
					<td>
       					<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
       						<tr> 
 								<td width="25%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
  								<td width="75%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[herramcodigo]; ?></td> 
 							</tr>
       						<tr> 
 								<td class="NoiseFooterTD">&nbsp;Nombre</td> 
  								<td class="NoiseDataTD">&nbsp;<?php echo $sbreg[herramnombre]; ?></td> 
 							</tr>
 							<tr>
								<td class="NoiseFooterTD">&nbsp;C&oacute;digo financiero</td>
								<td class="NoiseDataTD">&nbsp;<?php echo $cencosnombre ?></td>
					    	</tr>
					    	<tr>
							 	<td class="NoiseFooterTD">&nbsp;Valor</td>
							 	<td class="NoiseDataTD">&nbsp;<?php echo $sbreg[herramvalor]; ?></td>
							</tr>
					    	<tr>
							 	<td class="NoiseFooterTD">&nbsp;Cantidad disponible</td>
							 	<td class="NoiseDataTD">&nbsp;<?php echo $sbreg[herramdispon]; ?></td>
							</tr>
							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td></tr>
							<tr><td colspan="2" class="NoiseDataTD">&nbsp;<?php echo $sbreg[herramdescri]; ?></td></tr>
						</table>
					</td>
				</tr>
				<tr> 
					<td><?php 
							$detalle = 1;
							$noAjax = true;
							
							$idcon = fncconn();
							$rs_extproveedo = dinamicscanopherramieproveedo(array('herramcodigo' => $sbreg['herramcodigo']), array('herramcodigo' => '='), $idcon);
							
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
			<input type="hidden" name="herramcodigo" value="<?php echo $sbreg[herramcodigo]; ?>">
			<input type="hidden" name="accionborrarherramie">
			<input type="hidden" name="flagborrarherramie" value="1">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="borrar">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>