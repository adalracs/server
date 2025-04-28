<?php
	include ( '../src/FunGen/sesion/fncvalses.php');
	include('../src/FunPerPriNiv/pktblcentcost.php');
	include('../src/FunPerPriNiv/pktblproveedo.php');
	include('../src/FunPerPriNiv/pktblitemproveedo.php');
	include('../src/FunPerPriNiv/pktblproveestado.php');
	include('../src/FunPerPriNiv/pktblunimedida.php');
	include('../src/FunGen/cargainput.php');

	if(!$flagborraritem)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');
			
		$idcon = fncconn();			
		$cencosnombre = cargacentcostnumero($sbreg["cencoscodigo"], $idcon);
		$unidadnombre = cargaunimacra($sbreg["unidadcodigo"], $idcon);
		
		if(!$unidadnombre)
			$unidadnombre = $sbreg["unidadcodigo"];
	}
?>
<html> 
	<head> 
		<title>Borrar registro de Item</title> 
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
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Borrar registro</font></span></td></tr>
				<tr>
					<td>
       					<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
       						<tr> 
 								<td class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
  								<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo $sbreg[itemcodigo]; ?></td> 
 							</tr>
       						<tr> 
 								<td class="NoiseFooterTD">&nbsp;Nombre</td> 
  								<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo $sbreg[itemnombre]; ?></td> 
 							</tr>
 							<tr>
								<td class="NoiseFooterTD">&nbsp;C&oacute;digo financiero</td>
								<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo $cencosnombre; ?></td>
					    	</tr>
					    	<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Unidad de medida</td>
								<td width="30%" class="NoiseDataTD">&nbsp;<?php echo $unidadnombre; ?></td>
							 	<td width="20%" class="NoiseFooterTD">&nbsp;Valor</td>
							 	<td width="30%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[itemvalor]; ?></td>
							</tr>
					    	<tr>
							 	<td class="NoiseFooterTD">&nbsp;Cantidad M&iacute;nima</td>
							 	<td class="NoiseDataTD">&nbsp;<?php echo $sbreg[itemcanmin]; ?></td>
							 	<td class="NoiseFooterTD">&nbsp;Cantidad M&aacute;xima</td>
							 	<td class="NoiseDataTD">&nbsp;<?php echo $sbreg[itemcanmax]; ?></td>
							</tr>
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Densidad</td> 
  								<td class="NoiseDataTD">&nbsp;<?php echo $sbreg[itemdensid]; ?></td> 
  								<td class="NoiseFooterTD">&nbsp;Extruido</td>
								<td class="NoiseDataTD">&nbsp;<?php echo ($sbreg[itemextru] == 't')? 'Si':'No';?></td>
 							</tr>
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Pigmentado</td> 
  								<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo ($sbreg[itempgime] == 't')? 'Si':'No'; ?></td> 
 							</tr>
							<tr><td colspan="4" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="4" class="NoiseFooterTD">&nbsp;Nota</td></tr>
							<tr><td colspan="4" class="NoiseDataTD">&nbsp;<?php echo $sbreg[itemnota]; ?></td></tr>
						</table>
					</td>
				</tr>
				<tr> 
					<td><?php 
							$detalle = 1;
							$noAjax = true;
							
							$idcon = fncconn();
							$rs_extproveedo = dinamicscanopitemproveedo(array('itemcodigo' => $sbreg['itemcodigo']), array('itemcodigo' => '='), $idcon);
							
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
			<input type="hidden" name="flagborraritem" value="1">
			<input type="hidden" name="accionborraritem">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="borrar">
			<input type="hidden" name="flagerror" value="<?php echo $flagerror; ?>"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>