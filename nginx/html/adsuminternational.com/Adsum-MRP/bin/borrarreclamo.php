<?php 
include ('../src/FunGen/sesion/fncvalses.php'); 
include ('../src/FunPerPriNiv/pktblusuario.php'); 
include ('../src/FunPerPriNiv/pktblservicio.php'); 
include ('../src/FunPerPriNiv/pktblciudad.php'); 
include ('../src/FunPerPriNiv/pktblreclampedido.php'); 
include ('../src/FunPerPriNiv/pktblpedidoventa.php'); 
include ('../src/FunPerPriNiv/pktblproducpedido.php'); 
include ('../src/FunPerPriNiv/pktblproducto.php'); 
include ('../src/FunGen/cargainput.php'); 

if (! $flagborrarreclamo) { 
	include ('../src/FunGen/sesion/fnccarga.php'); 
	$sbreg = fnccarga ( $nombtabl, $radiobutton ); 
	if (! $sbreg) { 
		include ('../src/FunGen/fnccontfron.php'); 
	} 
	
	$idcon = fncconn();
	$nombre = cargausuanombre($sbreg[usuacodi], $idcon);
	$servicio = carganombservicio ($sbreg[servicicodigo],$idcon);
	$ciudad = cargaciudadnombre($sbreg[ciudadcodigo],$idcon);
	
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
		
		fncclose($idcon);
} 
?> 
<html> 
	<head> 
		<title>borrar registro de reclamo</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Reclamo</font></p> 
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
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Ingresar borrar registro</font></span></td></tr> 
				<tr>
  					<td> 
            			<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center"> 
            				<tr>
								<td colspan="4" class="ui-state-default" align="center">&nbsp;<b>Datos Generales</b></td>
							</tr>
							<tr>
								<td colspan="4" class="NoiseFooterTD"></td>
 							<tr>
							<tr>
								<td colspan="1" class="NoiseFooterTD">&nbsp;Planta/Servicio</td>
								<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo $servicio ?></td>
 							</tr> 
 							<tr>
								<td width="15%" class="NoiseFooterTD">&nbsp;Fecha Reclamo&nbsp;</td>
								<td width="25%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[reclamfecrec] ?></td>
 								<td width="25%" class="NoiseFooterTD">&nbsp;Fecha de Radicacion</td>
								<td width="35%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[reclamfecrad] ?></td>
 							</tr> 
 							<tr>
								<td width="15%" class="NoiseFooterTD">&nbsp;Nombre Cliente</td>
								<td width="25%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[reclamclinom] ?></td>
								<td width="25%" class="NoiseFooterTD">&nbsp;Vendedor</td>
								<td width="35%" class="NoiseDataTD">&nbsp;<?php echo $nombre ?></td>
 							</tr>
 							<tr>
								<td colspan="4" class="ui-state-default" align="center">&nbsp;<b>Datos del Cliente</b></td>
							</tr>
							<tr>
								<td colspan="4" class="NoiseFooterTD"></td>
 							<tr>
								<td width="15%" class="NoiseFooterTD">&nbsp;Nombre Del Contacto</td>
								<td width="25%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[reclamnomcon] ?></td>
 								<td width="25%" class="NoiseFooterTD">&nbsp;Cargo&nbsp;</td>
								<td width="35%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[reclamcargo] ?></td>
 							</tr>  
 							<tr>
								<td width="15%" class="NoiseFooterTD">&nbsp;Ciudad</td>
								<td width="25%" class="NoiseDataTD">&nbsp;<?php echo $ciudad ?></td>
 								<td width="25%" class="NoiseFooterTD">&nbsp;Telefono&nbsp;</td>
								<td width="35%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[reclamtelefono] ?></td>
 							</tr> 
 							<tr>
								<td width="15%" class="NoiseFooterTD">&nbsp;E-Mail</td>
								<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo $sbreg[reclammail] ?></td>
 							</tr>
		  					<tr>
		  						<td colspan="4">
		  							<div id="listadoreclamo">
										<?php
											$noAjax = true;
											include '../src/FunjQuery/jquery.visors/jquery.reclamo.php';  
										?>
									</div>
								</td>
		  					</tr>
 							<tr>
 								<td colspan="4" class="NoiseFooterTD"></td>
 							</tr>
 							<tr><td colspan="4" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="4" class="NoiseFooterTD">&nbsp;Observaciones</td></tr>
							<tr><td colspan="4" rowspan="2" class="NoiseDataTD">&nbsp;<?php echo $sbreg[reclamdescri] ?></td></tr>
							<tr>
 								<td colspan="4" class="NoiseFooterTD"></td>
 							</tr>
							<tr>
								<td width="15%" class="NoiseFooterTD">&nbsp;Acuerdos con el cliente</td>
								<td width="25%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[acuercodigo] ?></td>
 								<td width="25%" class="NoiseFooterTD">&nbsp;Otros&nbsp;</td>
								<td width="35%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[reclamotros	] ?></td>
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
			<input type="hidden" name="accionborrarreclamo">  
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="borrar">						
			<input type="hidden" name="reclamfecrad" value="<?php echo date('Y-m-d');?>">						
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 	
		<script type="text/javascript">
				$("#listadoreclamo :input").bind("focus", function(){$(this).blur();});
				$("#listadoreclamo input:radio").bind("click", function(){return false;});
   				$("#listadoreclamo input:checkbox").bind("click", function(){return false;});
		</script>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>