<?php
ini_set("display_errors", 1);
	include_once ( "../src/FunPerPriNiv/pktblvistabandejaflexografia.php");
	include_once ( "../src/FunPerPriNiv/pktbloppitemdesa.php");
	include_once ( "../src/FunPerPriNiv/pktblplaneaitemdesa.php");
	include_once ( "../src/FunPerPriNiv/pktblprocedimiento.php");
	include_once ( "../src/FunGen/fncobtenercantplaneada.php");
	include_once ( "../src/FunGen/fncobtenerunidadmedida.php");
	include_once ( "../src/FunGen/fncobtenercampertippro.php");
	include_once ( "../src/FunGen/fncobtenermaterialimp.php");	
	include_once ( "../src/FunGen/fncobtenermateriallam.php");
	include_once ( "../src/FunGen/fncobteneranchototal.php");	
	include_once ( "../src/FunGen/fncobtenerreferencia.php");
	include_once ( "../src/FunGen/sesion/fncvarsesion.php");
	include_once ( "../src/FunPerPriNiv/pktblsoliprog.php");
	include_once ( "../src/FunPerPriNiv/pktblcriterio.php");
	include_once ( "../src/FunPerPriNiv/pktblitemdesa.php");
	include_once ( "../src/FunGen/fncobtenercriterio.php");
	include_once ( "../src/FunGen/fncobtenerrutaitem.php");
	include_once ( "../src/FunGen/fncobtenermaterial.php");	
	include_once ( "../src/FunGen/fncobtenercalibre.php");	
	include_once ( "../src/FunGen/sesion/fncvalses.php");
	include_once ( "../src/FunGen/fncmensajealerta.php");	
	include_once ( "../src/FunGen/fncredireccionar.php");	
	include_once ( "../src/FunGen/floadtimehours.php");
	include_once ( "../src/FunGen/floadtimeminut.php");
	include_once ( "../src/FunPerPriNiv/pktblop.php");
	include_once ( "../src/FunGen/fncstrfecha.php");	
	include_once ( "../src/FunGen/cargainput.php");
	
	if($arrop) $objsarrop = explode(",", $arrop); else $objsarrop;

	if( count($objsarrop) > 1){
		include ("../src/FunGen/fncvalcoimpresion.php");
	}

	$totalcalibre = 0;
	$totalgramaje = 0;
	$tipprocodigo = 0;
	$ordoppcantkg = 0;

	$arrmaterial = fncobtenermaterial($objsarrop);
	$arrcalibre = fncobtenercalibre($objsarrop, $totalcalibre, $totalgramaje, $totalgramaje);
	$matimprimir = fncobtenermaterialimp($objsarrop);
	$arrmatlaminar = fncobtenermateriallam($objsarrop);
	$cant_planea = fncobtenercantplaneada($objsarrop);
	$cant_planea_ = $cant_planea;
	$criterio = fncobtenercriterio($objsarrop, $cant_planea);
	$unimedi = fncobtenerunidadmedida($objsarrop);
	$arrreferencia = fncobtenerreferencia($objsarrop,$tipprocodigo,$produccodigo);
	$arrrutaitem = fncobtenerrutaitem($produccodigo);

	fncobtenercampertippro($produccodigo, &$ancho, &$largo, &$traslape, &$fuelle, &$pestania, &$solapa, &$bmayor, &$bmenor);

	$ordoppanchot = fncobteneranchototal($objsarrop, $ordoppcantkg, $ancho, $largo, $traslape, $fuelle, $pestania, $solapa, $bmayor, $bmenor);

	$idcon = fncconn();

	for($a = 0; $a < count($objsarrop); $a++){
		$rwOp = loadrecordop($objsarrop[$a], $idcon);
		$rwSoliprog = loadrecordsoliprog($rwOp["solprocodigo"],$idcon);

		$rsPlaneaitemdesa = dinamicscanopplaneaitemdesa(array( "produccodigo" => $rwSoliprog["produccodigo"] ), array("produccodigo" => "="),$idcon);
		$nrPlaneaitemdesa = fncnumreg($rsPlaneaitemdesa);
		for($b = 0; $b < $nrPlaneaitemdesa; $b++){
			$rwPlaneaitemdesa = fncfetch($rsPlaneaitemdesa,$b);
			$arrmatplan = ($arrmatplan)? $arrmatplan.":|:".$rwPlaneaitemdesa["itedescodigo"].":-:".$rwPlaneaitemdesa['procedcodigo'] : $rwPlaneaitemdesa["itedescodigo"].':-:'.$rwPlaneaitemdesa['procedcodigo'];//se crea array con materiales asignados en planeacion
			$obj_consumo = 'consumo_'.$rwPlaneaitemdesa["itedescodigo"].":-:".$rwPlaneaitemdesa['procedcodigo'];//kilosgramos a asignar a la orden
			$$obj_consumo = $rwPlaneaitemdesa["plaitecantid"];//se precargan los asignados en planeacion
		}

		break;

	}

	if( count($objsarrop)  == 1 ){

		$rwOp = loadrecordop($objsarrop[0], $idcon);
		$rwSoliprog = loadrecordsoliprog($rwOp["solprocodigo"],$idcon);

		$rsPlaneaPadreitem = dinamicscanopplaneapadreitem(array( "produccodigo" => $rwSoliprog["produccodigo"] ), array("produccodigo" => "="),$idcon);
		$nrPlaneaPadreitem = fncnumreg($rsPlaneaPadreitem);

		for($a = 0; $a < $nrPlaneaPadreitem; $a++){
			$rwPlaneaPadreitem = fncfetch($rsPlaneaPadreitem,$a);
			$rwPadreItem = loadrecordpadreitem($rwPlaneaPadreitem["paditecodigo"],$idcon);
			if($rwPadreItem['paditeconfig'] < 1){//para omitir padre item que son por conf
				$objRefile = "refile_".$rwPadreItem["paditecodigo"].($a + 1);
				$$objRefile = $rwPlaneaPadreitem["plapadrefile"];
			}
		}

	}

?>
<html> 
	<head> 
		<title>Simulacion de opp</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php'); ?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.ui.ajax_accionextras.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_bandejaflx.js"></script>
	</head>
	<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Simulacion de opp (flexografia) - coimpresiones</font></p> 
			<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content">
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
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr><td class="ui-state-default">&nbsp;<small><?php echo strfecha(date("Y-m-d"))  ?></small></td></tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<div id="filtrlistasimulacionflx">
							<?php
								$noAjax = true;
								include '../src/FunjQuery/jquery.phpscripts/jq_ajaxsimulacionflx.php';  
							?>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td colspan="4" class="ui-state-default">&nbsp;Estructura</td>
							</tr>
							<tr>
								<td colspan="4">
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
										<tr>
											<td width="20%" class="NoiseFooterTD">&nbsp;Material a imprimir</td>
											<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo ($matimprimir)? cargapadreitemnombre($matimprimir,$idcon) : "---" ; ?></td>
										</tr>
										<tr>
											<?php 
												if($arrmatlaminar) $objarrmatlaminar = explode(":|:", $arrmatlaminar); else unset($objarrmatlaminar); 

												for( $a = 0; $a < count($objarrmatlaminar); $a++):
											?>
										<tr>
											<td width="20%" class="NoiseFooterTD">&nbsp;Material a laminar #<?php echo ($a + 1); ?></td>
											<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo ($objarrmatlaminar[$a])? cargapadreitemnombre($objarrmatlaminar[$a],$idcon) : "---" ; ?></td>
										</tr>
											<?php
												endfor;
											?>
										<tr>
											<td width="20%" class="NoiseFooterTD"><?php if ($campnomb["cant_planea"] == 1) { $cant_planea = null; echo "*";}?>&nbsp;Cant. Planeada (<?php echo $unimedi ?>)</td>
											<td width="30%" class="NoiseDataTD"><input type="text" name="cant_planea" id="cant_planea" value="<?php echo $cant_planea ?>" onkeyup="accionReloadAjax_planeacion();accionReloadAjax_similacionflx();" /></td>
											<td width="20%" class="NoiseFooterTD"><?php if ($campnomb["criterio"] == 1) { $criterio = null; echo "*";}?>&nbsp;Criterio </td>
											<td width="30%" class="NoiseDataTD"><input type="hidden" name="criterio_val" id="criterio_val" value="<?php echo $criterio_val ?>" />
												<select name="criterio" id="criterio"  onchange="cargaCriterio(this.value);">
													<option value="">--Seleccione--</option>
													<?php 
														include_once ("../src/FunGen/floadcriterio.php");
														floadcriterio($criterio,$idcon);
													?>
												</select>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="4" class="ui-state-default">&nbsp;Explision de materiales</td>
							</tr>
							<tr>
								<td colspan="4">
									<div id="filtrlistaplaneacion">
										<?php
											$noAjax = true;
											include '../src/FunjQuery/jquery.phpscripts/jquery.ajax_planeacion1.php';  
										?>
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="4">
									<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
										<tr>
											<td colspan="2" class="ui-state-default">&nbsp;Asignar Materia prima.</td>
										</tr>
										<tr>
											<td colspan="2">
												<div style="width:100%;" class="ui-buttonset ui-state-default NoiseDataTD">&nbsp;
													<?php if($campnomb["material"] == 1){ $paditekeylin = null; echo "*";}?>Material&nbsp;
													<select name="idmaterial" id="idmaterial"> 
														<option value="">--Seleccione--</option>
														<?php 
															include_once("../src/FunGen/floadpadreitem.php");
															floadpadreitemxarr1($idmaterial,$arrmaterial,$idcon);
														?>
													</select>
													<button id="anxmaterial">Agregar a la lista</button>&nbsp;
													<button id="retmaterial">Quitar de la lista</button>
												</div>
											</td>
										</tr>
										<tr>
											<td colspan="2">
												<div id="listamateriales">
													<?php
														$noAjax = true;
														include "../src/FunjQuery/jquery.visors/jquery.mat_planeacion_.php";  
													?>
												</div>
												<input type="hidden" name="arrmatplan" id="arrmatplan" size="60"value="<?php echo $arrmatplan ?>" />
												<input type="hidden" name="arrmatplantmp" id="arrmatplantmp" size="60"value="<?php echo $arrmatplantmp ?>" />
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><div class="ui-buttonset">
						<button id="generaropp_flx">Generar [opp]</button>&nbsp;
						<button id="backward_flx">Atras</button>
					</div></td>
				</tr>
				<tr><td>&nbsp;</td></tr> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table>
			<input type="hidden" name="arrmatlaminar" id="arrmatlaminar" value="<?php echo $arrmatlaminar; ?>" />
			<input type="hidden" name="arrrutaitem" id="arrrutaitem" value="<?php echo $arrrutaitem; ?>" />
			<input type="hidden" name="totalgramaje" id="totalgramaje" value="<?php echo $totalgramaje; ?>" />
			<input type="hidden" name="totalcalibre" id="totalcalibre" value="<?php echo $totalcalibre; ?>" />
			<input type="hidden" name="tipprocodigo" id="tipprocodigo" value="<?php echo $tipprocodigo; ?>" />
			<input type="hidden" name="ordoppanchot" id="ordoppanchot" value="<?php echo $ordoppanchot; ?>" />
			<input type="hidden" name="cant_planea_" id="cant_planea_" value="<?php echo $cant_planea_; ?>" />
			<input type="hidden" name="matimprimir" id="matimprimir" value="<?php echo $matimprimir; ?>" />
			<input type="hidden" name="arrmaterial" id="arrmaterial" value="<?php echo $arrmaterial; ?>" />
			<input type="hidden" name="arrcalibre" id="arrcalibre" value="<?php echo $arrcalibre; ?>" />
			<input type="hidden" name="unimedi" id="unimedi" value="<?php echo $unimedi; ?>" />
			<input type="hidden" name="codigo" id="codigo" value="<?php echo $codigo; ?>" />
			<input type="hidden" name="arrop" id="arrop" value="<?php echo $arrop; ?>" /> 
			<input type="hidden" name="ancho" id="ancho" value="<?php echo $ancho; ?> " />
			<input type="hidden" name="sourceaction" value="nuevo" /> 
			<input type="hidden" name="sourcetable" value="op" />
			<input type="hidden" name="accionnuevoopp" /> 
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>		
		<div id="msgwindowform" title="Adsum Kallpa[Gestion MP]"><span id="msgform"></span></div>
	</body>
	<?php if(!$codigo){ echo " -->"; } ?>
</html>

