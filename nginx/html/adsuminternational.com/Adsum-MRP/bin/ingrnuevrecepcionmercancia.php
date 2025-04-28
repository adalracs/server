<?php 
ob_start();
	include ( '../src/FunPerPriNiv/pktblrecepcionmercancia.php');
	include ( '../src/FunPerPriNiv/pktblreporteoppestado.php');
	include ( '../src/FunPerPriNiv/pktbltipoitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblvaranalisis.php');
	include ( '../src/FunPerPriNiv/pktblproveefabri.php');
	include ( '../src/FunPerPriNiv/pktblfabricante.php');
	include ( '../src/FunPerPriNiv/pktblunimedida.php');
	include ( '../src/FunPerPriNiv/pktblproveedo.php');
	include ( '../src/FunPerPriNiv/pktblbodega.php');
	include ( '../src/FunGen/sesion/fncvalses.php'); 

	if($accionnuevorecepcionmercancia)
		include ( 'grabarecepcionmercancia.php');

ob_end_flush();

$idcon = fncconn();
?>
<html> 
	<head> 
		<title>Nuevo registro de recepcion de mercancia</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jq.fnc.recepcionmercancia.js"></script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Recepcion de mercancia</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="650">
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
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
            				<tr>
 								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["opclote"] == 1){ $opclote = null; echo "*";}?>&nbsp;Ingreso Lote</td>
     							<td width="80%" class="NoiseDataTD">
     								<select name="opclote" id="opclote">
     									<option value="">--Seleccione--</option>
     									<option value="1" <?php if($opclote == 1) echo "selected"; ?> >Nuevo</option>
     									<option value="2" <?php if($opclote == 2) echo "selected"; ?> >Existente</option>
     								</select>
    							</td>
							</tr>
							<tr>
								<td colspan="2">
									<div id="sesionnuevolote" style="display : <?php echo ($opclote == 1)? "block" : "none" ; ?>">
										<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
            								<tr><td class="ui-widget-header" colspan="2"><span class="style5"><font color="FFFFFF"> Datos Lote</font></span></td></tr> 
            								<tr>
 												<td width="20%" class="NoiseFooterTD"><?php if($campnomb["lotenumero"] == 1){echo "*";}?>&nbsp;No. Lote</td>
     											<td width="80%" class="NoiseDataTD">
     												<input type="text" name="lotenumero" id="lotenumero" value="<?php echo $lotenumero; ?>" size="20" />
     											</td>
											</tr>
											<tr>
     											<td width="20%" class="NoiseFooterTD"><?php if($campnomb["proveecodigo"] == 1){ $proveecodigo = null; echo "*";}?>&nbsp;Proveedor</td>
     											<td width="80%" class="NoiseDataTD">
     												<select name="proveecodigo" id="proveecodigo">
     													<option value = "">--Seleccione--</option>
	     												<?php
															include ('../src/FunGen/floadproveedo.php');
															floadproveedosel($proveecodigo,$idcon);
														?>
    												</select>
    											</td>
											</tr>
											<tr>
							 					<td width="20%" class="NoiseFooterTD"><?php if($campnomb["fabricodigo"] == 1){ $fabricodigo = null; echo "*";}?>&nbsp;Fabricante</td>
					    						<td width="80%" class="NoiseDataTD">
													<select name="fabricodigo" id="fabricodigo">
														<option value="">--Seleccione--</option>
														<?php
															include ('../src/FunGen/floadfabricante.php');	
															floadfabricanteproveedor($fabricodigo,$proveecodigo,$idcon);
														?>	
								   					</select>
					    						</td>
					    					</tr>
					    					<tr>
 												<td width="20%" class="NoiseFooterTD"><?php if($campnomb["lotefecfabri"] == 1){echo "*";}?>&nbsp;Fecha Fabricacion</td>
     											<td width="80%" class="NoiseDataTD">
     												<input type="text" name="lotefecfabri" id="lotefecfabri" value="<?php echo $lotefecfabri; ?>" size="20" />
     											</td>
											</tr>
											<tr>
 												<td width="20%" class="NoiseFooterTD"><?php if($campnomb["lotefecperio"] == 1){echo "*";}?>&nbsp;Fecha Vencimiento</td>
     											<td width="80%" class="NoiseDataTD">
     												<input type="text" name="lotefecperio" id="lotefecperio" value="<?php echo $lotefecperio; ?>" size="20" />
     											</td>
											</tr>
            							</table>
									</div>
									<div id="sesionlote" style="display : <?php echo ($opclote == 2)? "block" : "none" ; ?>">
										<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center"> 
            								<tr>
 												<td width="20%" class="NoiseFooterTD"><?php if($campnomb["lotecodigo"] == 1){echo "*";}?>&nbsp;No. Lote</td>
     											<td width="80%" class="NoiseDataTD">
													<input type="hidden" name="lotecodigo" id="lotecodigo" value="<?php echo $lotecodigo; ?>" />
     												<input type="text" name="lotenumeron" id="lotenumeron" value="<?php echo $lotenumeron; ?>" size="20" /></td>
											</tr>
            							</table>
									</div>
								</td>
							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["itedescodigo"] == 1){ $itedescodigo = null; echo "*";}?>&nbsp;Item</td>
								<td width="80%" class="NoiseDataTD">
									<input type="hidden" name="itedescodigo" id="itedescodigo" value="<?php echo $itedescodigo; ?>">
									<input type="text" name="itedesnombre" id="itedesnombre" value="<?php echo $itedesnombre; ?>" size="50">
								</td> 
							</tr>
      						<tr>
     							<td width="20%" class="NoiseFooterTD"><?php if($campnomb["unidadcodigo"] == 1): $unidadcodigo = null; ?><span style="color:black;">*</span><?php endif; ?>&nbsp;Unidad de Medida</td>
     							<td width="80%" class="NoiseDataTD"><select name="unidadcodigo">
     								<option value = "">-- Seleccione --</option>
	     							<?php
										include ('../src/FunGen/floadunimedida.php');
										floadunimedidasel($unidadcodigo,$idcon);
									?>
    							</select></td>
							</tr>
      						<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["recmercantidad"] == 1){ $recmercantidad = null; echo "*";}?>&nbsp;Cantidad</td>
								<td width="80%" class="NoiseDataTD"><input type="text" name="recmercantidad" size="20"	value="<?php echo $recmercantidad; ?>"></td> 
 							</tr>
 							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["recmerordcomp"] == 1){ $recmerordcomp = null; echo "*";}?>&nbsp;Orden de compra</td>
								<td width="80%" class="NoiseDataTD"><input type="text" name="recmerordcomp" size="20"	value="<?php echo $recmerordcomp;?>"></td> 
 							</tr>
 							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["recmernoir"] == 1){ $recmernoir = null; echo "*";}?>&nbsp;No. IR</td>
								<td width="80%" class="NoiseDataTD"><input type="text" name="recmernoir" size="20"	value="<?php echo $recmernoir; ?>"></td> 
 							</tr>
 							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["recmernofact"] == 1){ $recmernofact = null; echo "*";}?>&nbsp;No. Factura</td>
								<td width="80%" class="NoiseDataTD"><input type="text" name="recmernofact" size="20"	value="<?php echo $recmernofact; ?>"></td> 
 							</tr>
							 <tr>
 								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["bodegacodigo"] == 1){ $bodegacodigo = null; echo "*";}?>&nbsp;Bodega</td>
     							<td width="80%" class="NoiseDataTD">
     								<select name="bodegacodigo" id="bodegacodigo">
     									<option value = "">--seleccione--</option>
	     								<?php
											include ('../src/FunGen/floadbodega.php');
											floadbodegasel($bodegacodigo, $idcon);
										?>
    								</select>
    							</td>
							</tr>
							<tr>
								<td class="NoiseFooterTD"><?php if($campnomb["recmercertificado"] == 1){ $recmercertificado = null; echo "*";}?>&nbsp;No. Certificado</td>
								<td colspan="3" class="NoiseDataTD"><input type="text" name="recmercertificado" size="20"	value="<?php echo $recmercertificado;?>"></td> 
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
 			<input type="hidden" name="recmercodigo" value="<?php if(!$flagnuevorecepcionmercancia){ echo $sbreg[recmercodigo];}else{ echo $recmercodigo;} ?>">
			<input type="hidden" name="accionnuevorecepcionmercancia">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="nuevo">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>