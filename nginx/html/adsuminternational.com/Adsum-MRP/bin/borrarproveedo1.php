<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblproveestado.php');
	include ( '../src/FunPerPriNiv/pktblciudad.php');
	include ( '../src/FunPerPriNiv/pktbldepartamento.php');	
	include ( '../src/FunPerPriNiv/pktbltipoproveedor.php');
	include ( '../src/FunPerPriNiv/pktblproveefabri.php');
	include ('../src/FunPerPriNiv/pktblfabricante.php');
	include ( '../src/FunGen/cargainput.php');	
		
	if(!$flagborrarproveedo1)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');
			
		$idcon = fncconn();
		$rs_ciudad = cargaciudadnombredep($sbreg[ciudadcodigo],$idcon);
		
		$sbregproveestado = loadrecordproveestado($sbreg[proestcodigo],$idcon);
		if($sbreg[tipprocodigo]){
			$sbregtipproveedor= loadrecordtipoproveedor($sbreg[tipprocodigo],$idcon);
		}
		$rsFabrica= dinamicscanproveefabri(array('proveecodigo' => $sbreg[proveecodigo]),$idcon);
		$nrFabrica= fncnumreg($rsFabrica);
		for($a = 0; $a < $nrFabrica; $a++)
		{
			$rwtrfabricante = fncfetch($rsFabrica,$a);
			$arrfabricanteprovee = ($arrfabricanteprovee)? $arrfabricanteprovee.','.$rwtrfabricante['fabricodigo'] : $rwtrfabricante['fabricodigo'];
		}
		fncclose($idcon);
	}
?>
<html> 
	<head> 
		<title>Borrar registro de proveedor</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_provfabri.js"></script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Proveedor</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="650">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Borrar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr>
								<td class="NoiseFooterTD">&nbsp;C&oacute;digo</td>
								<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo $sbreg[proveecodigo]; ?></td> 
 							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Nombre</td>
								<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo $sbreg[proveenombre]; ?></td> 
 							</tr>
							<tr>
     							<td class="NoiseFooterTD">&nbsp;Estado</td>
     							<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo $sbregproveestado[proestnombre] ?></td>
    						</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Representante legal</td>
								<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo $sbreg[proveerepleg]; ?></td> 
 							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Tel&eacute;fono</td>
								<td width="30%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[proveetelefo]; ?></td> 
								<td width="20%" class="NoiseFooterTD">&nbsp;FAX</td>
								<td width="30%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[proveefax]; ?></td> 
 							</tr>
      						<tr>
								<td class="NoiseFooterTD">&nbsp;Pa&iacute;s</td>
								<td class="NoiseDataTD">&nbsp;<?php echo $sbreg[proveepais]; ?></td> 
     							<td class="NoiseFooterTD">&nbsp;Ciudad</td>
     							<td class="NoiseDataTD">&nbsp;<?php echo $rs_ciudad; ?></td>
							</tr>
      						<tr>
								<td class="NoiseFooterTD">&nbsp;C&oacute;digo postal</td>
								<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo $sbreg[proveepostal]; ?></td> 
 							</tr>
 							<tr>
								<td class="NoiseFooterTD">&nbsp;Direcci&oacute;n</td>
								<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo $sbreg[proveedirecc]; ?></td> 
 							</tr>
 							<tr>
								<td class="NoiseFooterTD">&nbsp;E-mail</td>
								<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo $sbreg[proveeemail]; ?></td> 
 							</tr>
 							<tr>
								<td class="NoiseFooterTD">&nbsp;URL</td>
								<td colspan="3" class="NoiseDataTD">&nbsp;http://<?php echo $sbreg[proveeurl]; ?></td> 
 							</tr>
 							<tr>
								<td class="NoiseFooterTD">&nbsp;Contacto</td>
								<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo $sbreg[proveecontac]; ?></td> 
 							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Tel&eacute;fono</td>
								<td class="NoiseDataTD">&nbsp;<?php echo $sbreg[proveetelcon]; ?></td> 
								<td colspan="2" class="NoiseFooterTD">&nbsp;</td> 
 							</tr>
 							<tr>
								<td class="NoiseFooterTD">&nbsp;Tipo de proveedor</td>
								<td class="NoiseDataTD">&nbsp;<?php echo $sbregtipproveedor[tippronombre]; ?></td> 
								<td colspan="2" class="NoiseFooterTD">&nbsp;</td> 
 							</tr>
 							<tr>
            					<td colspan="4">
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
										<tr class="ui-state-default">
											<td  class="cont-title"><?php if($campnomb['arrfabricanteprovee'] == 1){$arrfabricanteprovee = null; echo "*";}?>&nbsp;Fabricantes</td>
										</tr>
									</table>
								</td>
							</tr>
 							<tr>
								<td colspan="4">
 								<!-- Contenido de Listado de referencias a reportar -->
	               					<div class="contenido-general" style="width:958px;">
						                		<div id="listreprefefabricante" style="width:958px;">
						                            <?php 
							                           $noAjax = true;
							                           $flagDetallar=1;
							                            include '../src/FunjQuery/jquery.visors/jq.vproveedorfabricante.php';
							                        ?>
					                             </div>
						             <input type="hidden" name="arrfabricanteprovee" id="arrfabricanteprovee" value="<?php echo $arrfabricanteprovee; ?>">
						           </div>
					           </td>
					         </tr> 
 							<tr><td colspan="4" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="4" class="NoiseFooterTD">&nbsp;Nota</td></tr>
							<tr><td colspan="4" class="NoiseDataTD"><?php echo $sbreg[proveenota]; ?></td></tr>
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
 			<input type="hidden" name="proveecodigo" value="<?php echo $sbreg[proveecodigo]; ?>">
			<input type="hidden" name="accionborrarproveedo1">
			<input type="hidden" name="flagborrarproveedo1" value="1">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="borrar">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>