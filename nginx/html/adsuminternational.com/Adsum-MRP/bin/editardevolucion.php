<?php 
	include ('../src/FunPerPriNiv/pktblreclampedido.php');
	include ('../src/FunPerPriNiv/pktbldevolupedido.php');
	include ('../src/FunPerPriNiv/pktblpedidoventa.php');
	include ('../src/FunPerPriNiv/pktblproducpedido.php');
	include ('../src/FunPerPriNiv/pktblproducto.php');
	include ('../src/FunPerPriNiv/pktblreclamo.php');
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include ('../src/FunPerPriNiv/pktblusuario.php');
	include ('../src/FunPerSecNiv/fncsqlrun.php');
	include ('../src/FunGen/cargainput.php');
	
if ($accioneditardevolucion) { 
	include ('editadevolucion.php'); 
	$flageditardevolucion = 1; 
} 
if (! $flageditardevolucion) { 
	include ('../src/FunGen/sesion/fnccarga.php'); 
	$sbreg = fnccarga ( $nombtabl, $radiobutton ); 
	if (! $sbreg) { 
		include ('../src/FunGen/fnccontfron.php'); 
	} 
	
	$idcon = fncconn();
	$nombre = cargausuanombre($sbreg[usuacodi], $idcon);
	$devolucondici = $sbreg[devolucondici];
	
		unset($arrpedven);
		//$arrpedven
			$rsReclampedido = dinamicscanreclampedido(array("reclamcodigo" => $sbreg[reclamcodigo]), $idcon);
			$nrReclampedido = fncnumreg($rsReclampedido);
		
		for($i = 0; $i < $nrReclampedido; $i++):
			$rwReclampedido = fncfetch($rsReclampedido, $i);
			
			($arrpedven) ? $arrpedven .= ','.$rwReclampedido['pedvencodigo'] : $arrpedven = $rwReclampedido['pedvencodigo'];  

			//variables en memoria para la carga del listado
			$objRecPR = 'recpectiprecpr_'.$rwReclampedido['pedvencodigo'];
			$objRecAS = 'recpectiprecas_'.$rwReclampedido['pedvencodigo'];
			$objRecEL = 'recpectiprecel_'.$rwReclampedido['pedvencodigo'];
			$objDevolucion = 'recpeddevolu_'.$rwReclampedido['pedvencodigo'];
			$objCantid = 'recpedcantid_'.$rwReclampedido['pedvencodigo'];
			$objDescri = 'recpeddescri_'.$rwReclampedido['pedvencodigo'];
			
			if($rwReclampedido['recpedtiprec']) $arrObject = explode(',', $rwReclampedido['recpedtiprec']);
				for($j = 0; $j < count($arrObject); $j++):	
				
					if($arrObject[$j] == 1)
						$$objRecPR = 1;
						
					if($arrObject[$j] == 2)
						$$objRecAS = 2;
						
					if($arrObject[$j] == 3)
						$$objRecEL = 3;
						
				endfor;
			unset($arrObject);
			
			$$objDevolucion = $rwReclampedido['recpeddevolu'];
			$$objCantid = $rwReclampedido['recpedcantid'];
			$$objDescri = $rwReclampedido['recpeddescri'];
		endfor;
		
			$rsDevolupedido = dinamicscandevolupedido(array("devolucodigo" => $sbreg[devolucodigo]), $idcon);
			$nrDevolupedido = fncnumreg($rsDevolupedido);
		
		for($i = 0; $i < $nrDevolupedido; $i++):
			$rwDevolupedido = fncfetch($rsDevolupedido, $i); 

			//variables en memoria para la carga del listado
			$objNumfac = 'devpednumfac_'.$rwDevolupedido['pedvencodigo'];
			$objFecfac = 'devpedfecfac_'.$rwDevolupedido['pedvencodigo'];
			$objDesc = 'devpeddescri_'.$rwDevolupedido['pedvencodigo'];
			$objAutori = 'devpedautori_'.$rwDevolupedido['pedvencodigo'];
			
			
			$$objNumfac = $rwDevolupedido['devpednumfac'];
			$$objFecfac = $rwDevolupedido['devpedfecfac'];
			$$objDesc = $rwDevolupedido['devpeddescri'];
			$$objAutori = $rwDevolupedido['devpedautori'];
		endfor;
		
		unset($arrObject);
		fncclose($idcon);
} 
?> 
<html> 
	<head> 
		<title>editar registro de devolucion</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript">
			function cargaVisor(valor){
					document.getElementsByName('accionseleccionareclamo')[0].value = 1;
					document.form1.submit();
					return false;
				}
		</script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Devolucion</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="950px">
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
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Ingresar editar registro</font></span></td></tr> 
				<tr>
  					<td> 
            			<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr>
								<td width="15%" class="NoiseFooterTD">&nbsp;Vendedor</td>
								<td width="25%" class="NoiseDataTD">&nbsp;<?php echo $nombre ?></td>
 								<td width="25%" class="NoiseFooterTD">&nbsp;Fecha</td>
								<td width="35%" class="NoiseDataTD">&nbsp;<b><?php echo date('Y-m-d');?></b></td>
 							</tr> 
 							<tr>
 								<td width="15%" class="NoiseFooterTD"><?php if($campnomb["reclamcodigo"] == 1){ $reclamcodigo = null; echo "*";}?>&nbsp;Reclamo&nbsp;</td>
								<td colspan="3" class="NoiseDataTD"><select name="reclamcodigo" onchange="cargaVisor(this.value);">
								<?php if(!$flageditardevolucion){$reclamcodigo = $sbreg[reclamcodigo];}?>
								<option value="">--Seleccione--</option>
								<?php 
								include '../src/FunGen/floadreclamo.php';
								$idcon = fncconn();
								floadmodreclamo($idcon,$reclamcodigo);
								?>
								</select></td>
 							</tr>
 							<tr>
 								<td width="15%" class="NoiseFooterTD">&nbsp;NOTA:</td>
								<td colspan="3" class="NoiseDataTD">&nbsp;<b>P</b> = Producto&nbsp;&nbsp;&nbsp;<b>A/S</b> = Atencion Y Servicio&nbsp;&nbsp;&nbsp;<b>E/L</b> = Entrada Y Logistica... En caso (tipo reclamo)</td>
 							</tr>
		  					<tr>
		  						<td colspan="4">
		  							<div id="listadodevolucion">
										<?php
											$noAjax = true;
											include '../src/FunjQuery/jquery.visors/jquery.devolucion.php';  
										?>
									</div>
								</td>
		  					</tr>
							<tr>
 								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["devolubodega"] == 1){ $devolubodega = null; echo "*";}?>&nbsp;Bodega &nbsp;</td>
								<td width="25%" class="NoiseDataTD"><input type="text" name="devolubodega" size="30" value="<?php if(!$flageditardevolucion){ echo $sbreg[devolubodega];}else {echo $devolubodega; }?>"></td>
								<td width="25%" class="NoiseDataTD"><?php if($campnomb["devolucondici"] == 1){ $devolucondici = null; echo "*";}?>&nbsp;Recoger Donde El  Cliente&nbsp;<input type="radio" name="devolucondici"  value="1" <?php if($devolucondici == 1){echo 'checked';}?>></td>
								<td width="25%" class="NoiseDataTD">&nbsp;Cliente envia&nbsp;<input type="radio" name="devolucondici"  value="2" <?php if($devolucondici == 2){echo 'checked';}?>></td>
 							</tr>
 							<tr>
 								<td width="25%" class="NoiseDataTD">&nbsp;</td>
								<td width="25%" class="NoiseDataTD">&nbsp;</td>
								<td width="25%" class="NoiseDataTD"><?php if($campnomb["devolucondici"] == 1){ $devolucondici = null; echo "*";}?>&nbsp;Se Hace Nota De Credito &nbsp;<input type="radio" name="devolucondici" value="3" <?php if($devolucondici == 3){echo 'checked';}?>></td>
								<td width="25%" class="NoiseDataTD">&nbsp;Cambio De Factura&nbsp;<input type="radio" name="devolucondici"  value="4" <?php if($devolucondici == 4){echo 'checked';}?>></td>
 							</tr>
 							<tr>
 								<td colspan="4" class="NoiseFooterTD"></td>
 							</tr>
 							<tr><td colspan="4" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="4" class="NoiseFooterTD"><?php if($campnomb["devoludescri"]	 == 1){$devoludescri = null; echo "*";}?>&nbsp;Observaciones</td></tr>
							<tr><td colspan="4" rowspan="2" class="NoiseDataTD"><textarea name="devoludescri" rows="2" cols="115"><?php if(!$flageditardevolucion){ echo $sbreg[devoludescri];}else{ echo $devoludescri;} ?></textarea>  </td></tr>
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
			<input type="hidden" name="accioneditardevolucion">  
			<input type="hidden" name="accionseleccionareclamo">  
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="editar">						
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="devolufecha" value="<?php echo date('Y-m-d');?>"> 
			<input type="hidden" name="devolucodigo" value="<?php if(!$flageditardevolucion){echo $sbreg[devolucodigo];}else{echo $devolucodigo;}?>"> 
		</form> 	
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>