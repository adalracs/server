<?php 
	include_once ('../src/FunPerPriNiv/pktblestructuraitemintegracion.php');
	include_once ('../src/FunPerPriNiv/pktblcoloritemintegracion.php');
	include_once ('../src/FunPerPriNiv/pktbldataitemintegracion.php');
	include_once ('../src/FunPerPriNiv/pktblitemintegracion.php');

	include ('../src/FunPerPriNiv/pktblalarma.php');
	include ('../src/FunPerPriNiv/pktblvistaalarmagestion.php');
	include ('../src/FunPerPriNiv/pktblalarmaitem.php');
	include ('../src/FunPerPriNiv/pktblalarmamodulo.php');
	include ('../src/FunGen/sesion/fncvalses.php'); 
	include ('../src/FunPerSecNiv/fncsqlrun.php');
	include ('../src/FunPerPriNiv/pktblitemdesa.php');
	include ('../src/FunPerPriNiv/pktblusuario.php');
	include ('../src/FunPerPriNiv/pktblmodulo.php');
	include ('../src/FunPerPriNiv/pktblproductoseguimiento.php');
	include ('../src/FunPerPriNiv/pktblformulacion.php');
	include ('../src/FunPerPriNiv/pktblpadreitem.php');
	include ('../src/FunPerPriNiv/pktblproducpadreitem.php');
	include ('../src/FunPerPriNiv/pktblcampertippro.php');
	include ('../src/FunPerPriNiv/pktblcamperdesarr.php');
	include ('../src/FunPerPriNiv/pktblcpdesadetope.php');
	include ('../src/FunPerPriNiv/pktblcptpdetope.php');
	include ('../src/FunPerPriNiv/pktblproducpedido.php');
	include ('../src/FunPerPriNiv/pktblpedidoventa.php');
	include ('../src/FunPerPriNiv/pktblordencompra.php');
	include ('../src/FunPerPriNiv/pktblequipo.php');
	include ('../src/FunPerPriNiv/pktblformula.php');
	include ('../src/FunPerPriNiv/pktblproducformula.php');
	include( '../src/FunPerPriNiv/pktblcpdispdetope.php'); 
	include( '../src/FunPerPriNiv/pktblcamperdispen.php'); 
	include ('../src/FunGen/cargainput.php');
	include ('../src/FunGen/fncnumprox.php'); 
	include ('../src/FunGen/fncnumact.php'); 	
	
	if($accionnuevovistadispensing) 
		include ( 'grabavistadispensing.php');
		
		
	if(!$flagnuevovistadispensing)
	{
		$idcon = fncconn();
		$nombre = cargausuanombre($usuacodi, $idcon);
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg) 
			include( '../src/FunGen/fnccontfron.php');
		//carga de campos personalizados necesarios para el formulario.
		$idcon = fncconn();
		//variables globales
		$tipitecodigo = $sbreg['tipprocodigo']; 
		$produccodigo = $sbreg['produccodigo'];
		$produccoduno = $sbreg['produccoduno'];
		//registro de producpedido
		$rwProducpedido = loadrecordproducpedidoPER('produccodigo',$sbreg['produccodigo'],$idcon);
		//registro de pedido venta
		$rwPedidoventa = loadrecordpedidoventa($rwProducpedido['pedvencodigo'],$idcon);
		//campos para formulario
		$pedvenfecent = $rwPedidoventa['pedvenfecent'];
		$pedvenfecent = $rwPedidoventa['pedvenfecelb'];
		$pedvennumero = $rwPedidoventa['pedvennumero'];
		$produccoduno = $sbreg['produccoduno'];
		$producnombre = $sbreg['producnombre'];
		$pedvenfecrec =  $rwPedidoventa['pedvenfecrec'];
		$tipevecodigo = $rwPedidoventa['tipevecodigo'];
		$nombre = cargausuanombre($rwPedidoventa['usuacodi'], $idcon);
		//registro de orden de compra si no es pedido de repeticion
		if($rwPedidoventa['tipevecodigo'] !=4)
			$rwOrdencompra = loadrecordordencompra($rwPedidoventa['ordcomcodigo'],$idcon);
		$clientnombre = $rwOrdencompra['ordcomrazsoc'];
		$ordcomcodcli = $rwOrdencompra['ordcomcodcli'];//codigo del cliente

		//carga de campos de personalizados de ventas 	
		//nota hay que asignar la varible producto con el codigo del producto actual. 
		$producto = $produccodigo;
		include 'cargarcampertippro.php';
		//nota hay que asignar la varible producto con el codigo del producto actual. 
		$producto = $produccodigo;
		include 'cargarcamperdesarr.php';
		//carga de campos de personalizados de dispensing 
		//nota hay que asignar la varible producto con el codigo del producto actual. 
		$producto = $produccodigo;
		include 'cargarcamperdispen.php';
		//carga de campos de personalizados de desarrollo 
		if(!$arrdispensing){
			include '../src/FunjQuery/jquery.tabs/reloadItemIntegracion.php';	
		}
		fncclose($idcon);
	}

	$idcon = fncconn();
	$rwProductoSeguimiento = loadrecordproductoseguimiento1($produccodigo,$idcon);
	
	
?> 
<!-- Propiedad intelectual de Adsum SAS (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andrés A. Riascos D. 
Fecha: 20120110 
GenVers: 4.8 --> 
<!doctype html> 
<html> 
	<head> 
		<title>nuevo registro de dispensing</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=UTF8"> 
		<meta http-equiv="expires" content="0"> 
		<meta http-equiv="X-UA-Compatible" content="IE=9"> 
		<?php include ('../def/jquery.library_maestro.php'); ?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.dispensing.js"></script>
		<script type="text/javascript">
			$(function(){
				$( "#tabitems" ).tabs( "option", "disabled", [<?php echo $arrTabs ?>] );

				$("#pedvenfecent").datepicker("setDate","<?php echo $pedvenfecent?>");
				$("#pedvenfecrec").datepicker("setDate","<?php echo $pedvenfecrec?>");
			});
			
		</script>
		<style type="text/css">
			.ui-autocomplete-loading { background: white url('../img/ui-anim_basic_16x16.gif') right center no-repeat; }
		</style>
	</head> 
<?php if (! $codigo) echo "<!--"; ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post" enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Pedido/&Iacute;tem [Dispensing]</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="800">

<?php if( $rwProductoSeguimiento > 0 && isset($rwProductoSeguimiento['prosegdescri']) ): ?>
				<tr>
					<td>
						<div class="ui-widget">
							<div class="ui-state-highlight ui-corner-all" style="padding: 0 .7em;"> 
								<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
									<strong>Mensaje de devolucion:</strong>&nbsp;<?php echo $rwProductoSeguimiento['prosegdescri']; ?>
								</p>
								<p><span class="ui-icon ui-icon-home" style="float: left; margin-right: .3em;"></span> 
									<strong>Modulo:</strong>&nbsp;<?php echo strtoupper( carganombremodulo($rwProductoSeguimiento['modulocodigoorg'],$idcon) ); ?>
								</p>
								<p><span class="ui-icon ui-icon-person" style="float: left; margin-right: .3em;"></span> 
									<strong>Responsable:</strong>&nbsp;<?php echo cargausuanombre($rwProductoSeguimiento['usuacodi'],$idcon); ?>
								</p>
							</div>
						</div>
					</td>
				</tr>
<?php endif; ?>

<?php if($campnomb): ?>
				<tr><td><div class="ui-widget">
					<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
						<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
						<strong>Advertencia:</strong> Corrija los campos marcados con *</p>
					</div>
				</div></td></tr>
<?php elseif($varMsj): echo $varMsj; ?>
<?php else: ?> 		
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
<?php endif; ?>

				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> nuevo registro</font></span></td></tr>
				<tr><td class="ui-state-default">&nbsp;<small>Item General</small></td></tr>
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
							<tr>
  								<td width="20%" class="NoiseFooterTD">&nbsp;Item</td>
  								<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="produccoduno" value="<?php echo $produccoduno ?>" /><?php echo $produccoduno ?></td>
  							</tr>
  							<tr>
  								<td width="20%" class="NoiseFooterTD">&nbsp;Referencia</td>
  								<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="producnombre" value="<?php echo $producnombre ?>" /><?php echo $producnombre ?></td>
  							</tr>
							<tr>
  								<td width="20%" class="NoiseFooterTD">&nbsp;Tipo producto</td>
  								<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="tipoproducto" value="<?php echo $tipoproducto ?>" /><?php echo $tipoproducto ?></td>
  								<td width="20%" class="NoiseFooterTD">&nbsp;Estructura</td>
  								<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="tipo_estruc" value="<?php echo $tipo_estruc ?>" /><?php echo strtoupper($tipo_estruc) ?></td>
  							</tr>
  							<tr>
  								<td width="20%" class="NoiseFooterTD">&nbsp;PV</td>
  								<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="pedvennumero" value="<?php echo $pedvennumero ?>" /><?php echo $pedvennumero ?></td>
  								<td width="20%" class="NoiseFooterTD">&nbsp;Tipo PV </td>
  								<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="tipopedido" value="<?php echo $tipopedido ?>" /><?php echo $tipopedido ?></td>
  							</tr>
  							<tr>
  								<td width="20%" class="NoiseFooterTD">&nbsp;Cliente</td>
  								<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="clientnombre" value="<?php echo $clientnombre ?>" /><?php echo $clientnombre ?></td>
  							</tr>
						</table>
					</td>
				</tr>
				<tr><td class="ui-state-default">&nbsp;<small>Especificaciones</small></td></tr>
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
							<tr>
  								<td width="20%" class="NoiseFooterTD">&nbsp;Caracteristicas de empaque</td>
  								<td width="80%" class="NoiseDataTD">&nbsp;<input type="hidden" name="product_empa" value="<?php echo $product_empa ?>" /><?php echo strtoupper($product_empa) ?></td>
  							</tr>
							<tr>
  								<td width="20%" class="NoiseFooterTD">&nbsp;Colores</td>
  								<td width="80%" class="NoiseDataTD">&nbsp;<input type="hidden" name="list_colors" value="<?php echo $list_colors ?>" /><?php echo strtoupper($list_colors) ?></td>
  							</tr>
  							<tr>
  								<td width="20%" class="NoiseFooterTD">&nbsp;Tipo Impresion</td>
  								<td width="80%" class="NoiseDataTD">&nbsp;<input type="hidden" name="tipo_impresion" value="<?php echo $tipo_impresion ?>" /><?php echo strtoupper($tipo_impresion) ?></td>
  							</tr>
  							<tr>
  								<td width="20%" class="NoiseFooterTD">&nbsp;Colores aprobados por:</td>
  								<td width="80%" class="NoiseDataTD">&nbsp;<input type="hidden" name="colorespor" value="<?php echo $colorespor ?>" /><?php echo strtoupper($colorespor) ?></td>
  							</tr>
  							<tr>
  								<td width="20%" class="NoiseFooterTD">&nbsp;Productos aprobados por:</td>
  								<td width="80%" class="NoiseDataTD">&nbsp;<input type="hidden" name="producpor" value="<?php echo $producpor ?>" /><?php echo strtoupper($producpor) ?></td>
  							</tr>
  							<tr>
  								<td width="20%" class="NoiseFooterTD">&nbsp;Tintas resistentas a:</td>
  								<td width="80%" class="NoiseDataTD">&nbsp;<input type="hidden" name="tintasa" value="<?php echo $tintasa ?>" /><?php echo strtoupper($tintasa) ?></td>
  							</tr>
  							<tr>
  								<td width="20%" class="NoiseFooterTD">&nbsp;Tintas especiales para:</td>
  								<td width="80%" class="NoiseDataTD">&nbsp;<input type="hidden" name="tinta_espe" value="<?php echo $tinta_espe ?>" /><?php echo strtoupper($tinta_espe) ?></td>
  							</tr>
  							<tr>
  								<td width="20%" class="NoiseFooterTD">&nbsp;Otros materiales:</td>
  								<td width="80%" class="NoiseDataTD">&nbsp;<input type="hidden" name="other" value="<?php echo $other ?>" /><?php echo strtoupper($other) ?></td>
  							</tr>
  							<tr>
  								<td colspan="2" class="NoiseFooterTD">&nbsp;Observacion</td>
  							</tr>
  							<tr>
  								<td colspan="2" class="NoiseDataTD">&nbsp;<input type="hidden" name="note_flexo_desa" value="<?php echo $note_flexo_desa ?>" /><?php echo strtoupper($note_flexo_desa) ?></td>
  							</tr>
						</table>
					</td>
				</tr>
				<tr><td class="ui-state-default">&nbsp;<small>Estructura</small></td></tr>
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
							<?php if($tipo_impresion == 'interna' || $tipo_impresion == 'externa'){?>
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Material a imprimir</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<input type="hidden" name="product_imp" id="product_imp" value="<?php echo $product_imp; ?>" /><?php if($product_imp){$rwPad = loadrecordpadreitem($product_imp,$idcon);} echo ($rwPad['paditenombre'])? strtoupper($rwPad['paditenombre']) : '---' ;?></td>
							</tr>
								<?php if($tipo_estruc != 'monocapa'){?>
									<?php for($h=0;$h<$valid_produc_imp;$h++){
									$obj_produclam = "product_lam_".($h +1);
									?>
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Material a laminar # <?php echo ($h +1 )?></td>
								<td width="80%" class="NoiseDataTD">&nbsp;<input type="hidden" name="<?php echo $obj_produclam; ?>" id="<?php echo $obj_produclam; ?>" value="<?php echo $$obj_produclam; ?>" /><?php if($$obj_produclam){$rwPad = loadrecordpadreitem($$obj_produclam,$idcon);}echo ($rwPad['paditenombre'])? strtoupper($rwPad['paditenombre']) : '---' ;unset($rwPad);?></td>
							</tr>
									<?php }?>
								<?php }?>
							<?php }?>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<!-- 	DOCUMENTOS ADJUNTOS -->
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
							<tr class="ui-state-default">
								<td class="cont-title">&nbsp;Documentos Adjuntos PV</td>
							</tr>
						</table>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td>
									<div style="height: 2px;"></div>
									<div class="ui-widget-content content">
										<div id="reportot_file_load" class="file-upname">
											<?php 
												unset($arrUpload,$arrUploadSize);
												if($uploadocumen)
												{
													$arrUpload = explode('::', $uploadocumen);
													$arrUploadSize = explode('::', $uploadocumensize);
													for($a = 0; $a < count($arrUpload); $a++)
													{
											?>
											<div class="uploadifyQueueItem completed">
												<div class="cancel">
													<a href="javascript: void(0);" onclick="window.open('http://192.168.60.55/plasticel/doc/upload/documentos/<?php echo $arrUpload[$a] ?>','impresion','status=no,menubar=no,scrollbars=yes,resizable=yes,width=880,height=650');">Detallar
													</a>
												</div>
												<span class="fileName"><?php echo $arrUpload[$a].' ('.$arrUploadSize[$a].')' ?></span>
											</div>
											<?php
													}
												}
											?>
										</div>
										<input type="hidden" name="uploadocumen" id="uploadocumen" value="<?php echo $uploadocumen?>">
										<input type="hidden" name="uploadocumensize" id="uploadocumensize" value="<?php echo $uploadocumensize ?>">
									</div>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td class="ui-state-default">&nbsp;<small>Colores</small></td></tr>
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
							<tr>
  								<td width="20%" class="NoiseFooterTD"><?php if ($campnomb["equipocodigo"] == 1) { $equipocodigo = null; echo "*";}?>&nbsp;Maquina</td>
  								<td colspan="2" class="NoiseDataTD"><select name="equipocodigo" id="equipocodigo"> 
  								<option value="">--Seleccione--</option>
  								<?php 
  									include '../src/FunGen/floadequipodispensing.php';
  									$idcon = fncconn();
  									floadequipodispensing($equipocodigo,'3','3',$idcon);
  								?>
  								</select></td>
  							</tr>
  							<tr>
  								<td width="20%" class="NoiseFooterTD"><?php if ($campnomb["arrdispensing"] == 1) { $arrdispensing = null; echo "*";}?>&nbsp;Color</td>
  								<td width="60%" class="NoiseDataTD"><input type="hidden" name="formulcodigo" id="formulcodigo" value="<?php echo $formulcodigo ?>" /><input type="text" name="formulnumero" id="formulnumero" value="<?php echo $formulnumero ?>" size ="70" /></td>
  								<td width="20%" class="NoiseDataTD">
  									<div class="ui-buttonset" align="right">
										<button id="ingresarcolor">Agregar</button>&nbsp;&nbsp;
		            					<button id="quitarcolor">Quitar</button>
									</div>
  								</td>
  							</tr>
  							<tr>
  								<td colspan="3">
  									<div id="filtrlistacolores">
  										<?php 
  											$noAjax = true;
	  										include '../src/FunjQuery/jquery.visors/jquery.dispensing.php'; 
  										?>
  									</div>
  									<input type="hidden" name="arrdispensing" id="arrdispensing" size="60" value="<?php echo $arrdispensing ?>" />
									<input type="hidden" name="arrdispensingtmp" id="arrdispensingtmp" size="60" value="<?php echo $arrdispensingtmp ?>" />
  								</td>
  							</tr>
						</table>
					</td>
				</tr>
				<tr>
				<td class="NoiseErrorDataTD" align="center"></td>
				</tr>
				<tr><td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_form.php'; ?></td></tr> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table>
			<input type="hidden" name="esp_pro" id="esp_pro" value="<?php echo $esp_pro ?>" />
			<input type="hidden" name="emb" id="emb" value="<?php echo $emb ?>" />
			<input type="hidden" name="ext" id="ext" value="<?php echo $ext ?>" />
			<input type="hidden" name="lmn" id="lmn" value="<?php echo $lmn ?>" />
			<input type="hidden" name="con_pro" id="con_pro" value="<?php echo $con_pro ?>" />
			<input type="hidden" name="not_mod" id="not_mod" value="<?php echo $not_mod ?>" />
			<input type="hidden" name="for_emp" id="for_emp" value="<?php echo $for_emp ?>" />
			<input type="hidden" name="arrTabs" id="arrTabs" value="<?php echo $arrTabs ?>" />
			<input type="hidden" name="flagnuevovistadispensing">

			<input type="hidden" name="modulocodigo" id="modulocodigo" value="4"><!-- modulo de dispensing -->
			<input type="hidden" name="produccoduno" id="produccoduno" value="<?php echo $produccoduno; ?>"><!-- codigo item -->
			<input type="hidden" name="ordcomcodcli" id="ordcomcodcli" value="<?php echo $ordcomcodcli; ?>"><!-- codigo cliente -->

			<input type="hidden" name="pedvencodigo" value="<?php if(!$flagnuevovistadispensing){ echo $rwPedidoventa['pedvencodigo'];}else{ echo $pedvencodigo; }?>"> 
			<input type="hidden" name="produccodigo" id="produccodigo" value="<?php echo $produccodigo; ?>" >
			<input type="hidden" name="valid_produc_imp" id="valid_produc_imp" value="<?php echo $valid_produc_imp; ?>" />
			<input type="hidden" name="ordcomcodigo" value="<?php if(!$flagnuevovistadispensing){ echo $rwOrdencompra['ordcomcodigo'];}else{ echo $ordcomcodigo; } ?>">  		
			<input type="hidden" name="propedcodigo" value="<?php if(!$flagnuevovistadispensing){ echo $rwProducpedido['propedcodigo'];}else{ echo $propedcodigo; } ?>">  		
			<input type="hidden" name="tipitecodigo" id="tipitecodigo" value="<?php echo $tipitecodigo; ?>"> 
			<input type="hidden" name="tipevecodigo" id="tipevecodigo" value="<?php echo $tipevecodigo; ?>"> 
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>"> 
			<input type="hidden" name="sourceaction" id="sourceaction" value="nuevo">  
			<input type="hidden" name="accionnuevovistadispensing"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
	</body> 
<?php if (! $codigo) echo " -->"; ?> 
</html>