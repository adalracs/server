<?php 
include ('../src/FunPerPriNiv/pktblreclampedido.php');
include ('../src/FunPerPriNiv/pktbldevolupedido.php');
include ('../src/FunPerPriNiv/pktblpedidoventa.php');
include ('../src/FunPerPriNiv/pktblproducpedido.php');
include ('../src/FunPerPriNiv/pktblproducto.php');
include ('../src/FunGen/sesion/fncvalses.php'); 
include ('../src/FunPerPriNiv/pktblusuario.php');
include ('../src/FunPerSecNiv/fncsqlrun.php');
include ('../src/FunGen/cargainput.php'); 
if (! $flagborrardevolucion) { 
	include ('../src/FunGen/sesion/fnccarga.php'); 
	$sbreg = fnccarga ( $nombtabl, $radiobutton ); 
	if (! $sbreg) { 
		include ('../src/FunGen/fnccontfron.php'); 
	} 
	
	$idcon = fncconn();
	$nombre = cargausuanombre($sbreg[usuacodi], $idcon);
	if($sbreg[devolucondici] == 1){$condicion= 'Recoger Donde el Cliente';};
	if($sbreg[devolucondici] == 2){$condicion= 'Cliente Envia';};
	if($sbreg[devolucondici] == 3){$condicion= 'Cambio de factura';};
	if($sbreg[devolucondici] == 4){$condicion= 'Se Hace Nota de Credito';};
	if($sbreg[devolucondici] < 0){$condicion= 'N/A';};
	
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
		<title>borrar registro de devolucion</title> 
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
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> borrar registro</font></span></td></tr> 
				<tr>
  					<td> 
            			<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr>
								<td width="15%" class="NoiseFooterTD">&nbsp;Vendedor</td>
								<td width="25%" class="NoiseDataTD">&nbsp;<?php echo $nombre ?></td>
 								<td width="25%" class="NoiseFooterTD">&nbsp;Fecha</td>
								<td width="35%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[devolufecha]?></td>
 							</tr> 
 							<tr>
 								<td width="15%" class="NoiseFooterTD">&nbsp;Reclamo&nbsp;</td>
								<td colspan="3" class="NoiseDataTD">&nbsp;No. <?php echo $sbreg[reclamcodigo] ?></td>
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
 								<td width="25%" class="NoiseFooterTD">&nbsp;Bodega &nbsp;</td>
								<td width="25%" class="NoiseDataTD"><?php echo $sbreg[devolubodega] ?></td>
								<td colspan="2" class="NoiseDataTD"><b>*</b><?php echo $condicion ?></td>
 							</tr>
 							<tr>
 								<td colspan="4" class="NoiseFooterTD"></td>
 							</tr>
 							<tr><td colspan="4" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="4" class="NoiseFooterTD">&nbsp;Observaciones</td></tr>
							<tr><td colspan="4" rowspan="2" class="NoiseDataTD">&nbsp;<?php echo $sbreg[devoludescri] ?></td></tr>
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
			<input type="hidden" name="accionborrardevolucion">  
			<input type="hidden" name="accionseleccionareclamo">  
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="borrar">						
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="devolufecha" value="<?php echo date('Y-m-d');?>"> 
		</form> 	
		<script type="text/javascript">
				$("#listadodevolucion :input").bind("focus", function(){$(this).blur();});
				$("#listadodevolucion input:radio").bind("click", function(){return false;});
		</script>
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>