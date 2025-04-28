<?php
ini_set('display_errors', 1);
	include ( '../src/FunPerPriNiv/pktblvistabandejaflexografia.php');		
	include ( '../src/FunPerPriNiv/pktblplaneapadreitem.php');	
	include ( '../src/FunPerPriNiv/pktblplanearutaitempv.php');
	include ( '../src/FunPerPriNiv/pktblprocedimiento.php');	
	include ( '../src/FunPerPriNiv/pktblplaneaitemdesa.php');		
	include ( '../src/FunPerPriNiv/pktblpadreitem.php');
	include ( '../src/FunPerPriNiv/pktblitemdesa.php');		
	include ( '../src/FunGen/sesion/fncvarsesion.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunGen/floadtimehours.php');
	include ( '../src/FunGen/floadtimeminut.php');
	include ( '../src/FunPerPriNiv/pktblop.php');
	include ( '../src/FunGen/fncstrfecha.php');	

	include ('../src/FunGen/cargainput.php');
	include ('../src/FunPerSecNiv/fncsqlrun.php');
	include ('../src/FunPerPriNiv/pktblusuario.php');
	include ('../src/FunPerPriNiv/pktblcriterio.php');
	include ('../src/FunPerPriNiv/pktblproducto.php');
	include ('../src/FunPerPriNiv/pktblcptpdetope.php');
	include ('../src/FunPerPriNiv/pktblformulacion.php');
	include ('../src/FunPerPriNiv/pktblordencompra.php');
	include ('../src/FunPerPriNiv/pktblproducpedido.php');
	include ('../src/FunPerPriNiv/pktblpedidoventa.php');
	include ('../src/FunPerPriNiv/pktblcampertippro.php');
	include ('../src/FunPerPriNiv/pktblcamperdesarr.php');
	include ('../src/FunPerPriNiv/pktblcamperplanea.php');
	include ('../src/FunPerPriNiv/pktblcpdesadetope.php');
	include ('../src/FunPerPriNiv/pktblcpplandetope.php');
	include ('../src/FunPerPriNiv/pktblproducpadreitem.php');

	
	$idcon = fncconn();
	if($arrop) $arrObject = explode(",",$arrop);unset($ordoppanchot);

	for($a = 0;$a < count($arrObject);$a++){
		($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
		$rwOp= loadrecordvistabandejaflexografia($arrObject[$a],$idcon);
		$rwOp1 = loadrecordop($arrObject[$a],$idcon);
		//variables de flexografia
		$ordopprefile = $rwOp["ordproancref"];//ancho de refile de la bobina
		$ordoppanchot = $ordoppanchot + ( (int) $rwOp["ordproancmat"] * (int) $rwOp["ordpropistap"]);//ancho total de la bobina
		$ordoppcantkg = $ordoppcantkg + $rwOp["ordprocantkg"];//kilogramos a imprimir
		$ordoppcalibr = $rwOp["ordprocalibr"];//calibre de impresion
		$paditecodigo = $rwOp["paditecodigo"];//padreitem del material --> sirve para indenficar el tipo de material asignado a la orden
		$produccodigo = $rwOp["produccodigo"];//codigo del producto -->hace referencia al PV que se va a imprimir


		$rwProducto = loadrecordproducto($produccodigo,$idcon);
		$tipitecodigo = $rwProducto["tipprocodigo"];

		$procedcodigo = $rwOp1["procedcodigo"];//proceso al que hace parte la orden de produccion
		$rwPadreitem = loadrecordpadreitem($paditecodigo,$idcon);
		$ordoppdensid = $rwPadreitem["paditedensid"];//densidad del material para calculos de metros


		$rsPlaneaitemdesa = dinamicscanopplaneaitemdesa(array( "produccodigo" => $produccodigo ), array("produccodigo" => "="),$idcon);
		$nrPlaneaitemdesa = fncnumreg($rsPlaneaitemdesa);
		for($b = 0;$b<$nrPlaneaitemdesa;$b++){
			$rwPlaneaitemdesa = fncfetch($rsPlaneaitemdesa,$b);
			$rwItemdesa = loadrecorditemdesa($rwPlaneaitemdesa["itedescodigo"],$idcon);
			$arrmatplan = ($arrmatplan)? $arrmatplan.":|:".$rwItemdesa["itedescodigo"].":-:".$rwPlaneaitemdesa['procedcodigo'] : $rwItemdesa["itedescodigo"].':-:'.$rwPlaneaitemdesa['procedcodigo'];//se crea array con materiales asignados en planeacion
			$obj_consumo = 'consumo_'.$rwItemdesa["itedescodigo"].":-:".$rwPlaneaitemdesa['procedcodigo'];//kilosgramos a asignar a la orden
			$$obj_consumo = $rwPlaneaitemdesa["plaitecantid"];//se precargan los asignados en planeacion
		}

		$rsPlaneaPadreitem = dinamicscanopplaneapadreitem(array( "produccodigo" => $produccodigo ), array("produccodigo" => "="),$idcon);
		$nrPlaneaPadreitem = fncnumreg($rsPlaneaPadreitem);
		for($c = 0; $c < $nrPlaneaPadreitem; $c++){
			$rwPlaneaPadreitem = fncfetch($rsPlaneaPadreitem,$c);
			$rwPadreitem = loadrecordpadreitem($rwPlaneaPadreitem["paditecodigo"],$idcon);
			if($rwPadreitem['paditeconfig'] < 1){//para omitir padre item que son por conf
				$arrPadreitem = ($arrPadreitem)? $arrPadreitem.":|:".$rwPadreitem["paditecodigo"].":-:".$rwPadreitem["paditenombre"] : $rwPadreitem["paditecodigo"].':-:'.$rwPadreitem["paditenombre"];
			}
		}

		$rsPlaneaRutaItempv = dinamicscanopplanearutaitempv(array( "produccodigo" => $produccodigo ), array("produccodigo" => "="),$idcon);
		$nrPlaneaRutaItempv = fncnumreg($rsPlaneaRutaItempv);
		for($d = 0; $d < $nrPlaneaRutaItempv; $d++){
			$rwPlaneaRutaItempv = fncfetch($rsPlaneaRutaItempv,$d);
			$arrrutaitem = ($arrrutaitem)? $arrrutaitem.":|:".$rwPlaneaRutaItempv["procedcodigo"] : $rwPlaneaRutaItempv["procedcodigo"] ;
		}

	}

	$arrmatplan1 = $arrmatplan;

	if(count($arrObject) > 1)
		$ordopprefile = 0;
	//formula para cantidad de metros de la orden
	$ordoppcantmt = $ordoppcantkg / ($ordoppanchot * ($ordoppdensid * $ordoppcalibr) ) * 1000000;
	$ordoppanchot = $ordoppanchot + $ordopprefile;

	//registro de producpedido
	$rwProducpedido = loadrecordproducpedidoPER('produccodigo',$produccodigo,$idcon);
	//registro de pedido venta
	$rwPedidoventa = loadrecordpedidoventa($rwProducpedido['pedvencodigo'],$idcon);
	//campos para formulario
	$pedvenfecent = $rwPedidoventa['pedvenfecent'];
	$pedvenfecent = $rwPedidoventa['pedvenfecelb'];
	$pedvennumero = $rwPedidoventa['pedvennumero'];
	$produccoduno = $sbreg['produccoduno'];
	$pedvenfecrec =  $rwPedidoventa['pedvenfecrec'];
	$tipevecodigo = $rwPedidoventa['tipevecodigo'];
	$nombre = cargausuanombre($rwPedidoventa['usuacodi'], $idcon);
	//registro de orden de compra si no es pedido de repeticion
	if($rwPedidoventa['tipevecodigo'] !=4)
		$rwOrdencompra = loadrecordordencompra($rwPedidoventa['ordcomcodigo'],$idcon);
	$clientnombre = $rwOrdencompra['ordcomrazsoc'];
	$ordcomcodcli = $rwOrdencompra['ordcomcodcli'];//codigo del cliente


$idcon = fncconn();
	$producto = $produccodigo;
	include 'cargarcampertippro.php';
	//carga de campos de personalizados de desarrollo 
	//nota hay que asignar la varible producto con el codigo del producto actual. 	
	$producto = $produccodigo;
	include 'cargarcamperdesarr.php';	
	//carga de campos de personalizados de planeacion 
	//nota hay que asignar la varible producto con el codigo del producto actual. 
	$producto = $produccodigo;
	include 'cargarcamperplanea.php';
	//adicionales
	$unimedi = $rwProducpedido['unidadcodigo'];
	$cantsol = $rwProducpedido['propedcansol'];
	$nombre = $sbreg['producnombre'];
	//peso millar = round((((double) $solaa / 1000) + ((double) $largo / 1000 * 2) + ((double)  $solapa / 1000 * 2) + ((double)  $fuelle / 1000 * 2)) * (((double)  $ancho / 1000) * ((double) $total_gramaje)) * 100 ) / 100;
	if(!$cant_planea)
		$cant_planea = $cantsol;
	
	$arrmatplan = $arrmatplan1;
?>
<html> 
	<head> 
		<title>Simulacion de opp</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
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
						<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td class="NoiseFooterTD" colspan="2">
									<div id="detallesilmularop" style="height: auto; margin:0 auto; overflow:auto;">
										<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">
											<tr>
												<td class="ui-state-default" width="3%"  align="center"># OP</td>
												<td class="ui-state-default" width="23%"  align="center">Cliente</td>
												<td class="ui-state-default" width="5%"  align="center">Item</td>
												<td class="ui-state-default" width="25%"  align="center">Referencia</td>
												<td class="ui-state-default" width="5%"  align="center">Ancho</td>
												<td class="ui-state-default" width="6%"  align="center"># Pistas</td>
												<td class="ui-state-default" width="5%"  align="center">Pistas</td>
												<td class="ui-state-default" width="10%"  align="center"><b>kgs</b>&nbsp;pv</td>
												<td class="ui-state-default" width="5%"  align="center"><b>kgs</b>&nbsp;pln</td>
												<td class="ui-state-default" width="5%"  align="center"><b>%</b></td>
												<td class="ui-state-default" width="7%"  align="center">Ancho ideal</td>
											</tr>
											<?php 
												unset($arrObject);if($arrop) $arrObject = explode(',',$arrop);

												for($a = 0;$a < count($arrObject);$a++){
													$rwOp= loadrecordvistabandejaflexografia($arrObject[$a],$idcon);
													//objetos a utilizar
													$obj_pistas = "pista_".$arrObject[$a];
													$obj_porcen = "porcen_".$arrObject[$a];
													$obj_cantid = "cantid_".$arrObject[$a];
													$obj_cantidf = "cantidf_".$arrObject[$a];
													$obj_ancho = "ancho_".$arrObject[$a];
													$obj_anchot = "anchot_".$arrObject[$a];
													//label a utilizar
													$obj_porcen_lb = "lb_".$obj_porcen;
													$obj_cantid_lb = "lb_".$obj_cantid;
													$obj_ancho_lb = "lb_".$obj_ancho;
													$obj_anchot_lb = "lb_".$obj_anchot;
													//condiciones adicionales
													if(!$$obj_pistas){$$obj_pistas = $rwOp["ordpropistap"];}
													if(!$$obj_pistas){$$obj_pistas = 1;}
													//valor de los objetos
													$$obj_porcen = ($rwOp["ordproancmat"] * $$obj_pistas)  / ($ordoppanchot);
													$$obj_cantid = $$obj_porcen * $ordoppcantkg;
													$$obj_cantidf  = $rwOp["ordprocantkg"];
													$$obj_ancho = $rwOp["ordproancmat"];
													$$obj_anchot = $rwOp["ordproancmat"] * $$obj_pistas;
													($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';													
											?>
											<tr <?php echo $complement; ?> >
												<td class="cont-line">&nbsp;<?php echo str_pad($rwOp["ordprocodigo"], 4, "0", STR_PAD_LEFT); ?></td>
												<td class="cont-line">&nbsp;<?php echo $rwOp["ordcomrazsoc"]; ?></td>
												<td class="cont-line">&nbsp;<?php echo $rwOp["produccoduno"]; ?></td>
												<td class="cont-line">&nbsp;<?php echo $rwOp["producnombre"]; ?></td>
												<td class="cont-line">&nbsp;<input type="hidden" name="<?php echo $obj_ancho ?>" id="<?php echo $obj_ancho ?>" value="<?php echo $$obj_ancho ?>" /><span id="<?php echo $obj_ancho_lb ?>"><?php echo ($$obj_ancho)? number_format($$obj_ancho, 2, ",", ".") : "---" ;?></span></td>
												<td class="cont-line">&nbsp;---</td>
												<td class="cont-line">&nbsp;<input type="text" name="<?php echo $obj_pistas ?>" id="<?php echo $obj_pistas ?>" value="<?php echo $$obj_pistas ?>" size="3" onkeyup="eventAnchoBobina();" /></td>
												<td class="cont-line">&nbsp;<?php echo ($rwOp["propedcansol"])? number_format($rwOp["propedcansol"], 2, ",", ".") : "---" ; ?> / <?php echo ($$obj_cantidf)? number_format($$obj_cantidf, 2, ",", ".") : "---" ; ?></td>
												<td class="cont-line">&nbsp;<input type="hidden" name="<?php echo $obj_cantid ?>" id="<?php echo $obj_cantid ?>" value="<?php echo $$obj_cantid ?>" /><span id="<?php echo $obj_cantid_lb ?>"><?php echo ($$obj_cantid)? number_format($$obj_cantid, 2, ",", ".") : "---" ;?></span></td>
												<td class="cont-line">&nbsp;<input type="hidden" name="<?php echo $obj_porcen ?>" id="<?php echo $obj_porcen ?>" value="<?php echo $$obj_porcen ?>" /><span id="<?php echo $obj_porcen_lb ?>"><?php echo ($$obj_porcen)? number_format( ($$obj_porcen) * 100 , 2, ",", ".") : "---" ; ?></span></td>
												<td class="cont-line">&nbsp;<input type="hidden" name="<?php echo $obj_anchot ?>" id="<?php echo $obj_anchot ?>" value="<?php echo $$obj_anchot ?>" /><span id="<?php echo $obj_anchot_lb ?>"><?php echo ($$obj_anchot)? number_format($$obj_anchot, 2, ",", ".") : "---" ;?></span></td>
											</tr>
											<?php 
												}
											?>
										</table>
									</div>
								</td>
							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["ordopprefile"] == 1)echo "*"; ?>&nbsp;Refile <b>(mm)</b></td>
								<td width="80%" class="NoiseDataTD">&nbsp;<input type="text" name="ordopprefile" id="ordopprefile" value="<?php echo $ordopprefile ?>" size="7" onkeyup="eventAnchoBobina();" /></td>
							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["ordoppanchot"] == 1)echo "*"; ?>&nbsp;Ancho Bobina  + refile&nbsp;<b>(mm)</b></td>
								<td width="80%" class="NoiseDataTD">&nbsp;<input type="hidden" name="ordoppanchot" id="ordoppanchot" value="<?php echo $ordoppanchot ?>" size="7" /><span id="ordoppanchot_lb"><?php echo ($ordoppanchot)? number_format($ordoppanchot, 2, ',', '.') : '--' ; ?></span></td>
							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["ordoppcantkg"] == 1)echo "*"; ?>&nbsp;Cantidad <b>(kg)</b></td>
								<td width="80%" class="NoiseDataTD">&nbsp;<input type="text" name="ordoppcantkg" id="ordoppcantkg" value="<?php echo round($ordoppcantkg * 100) / 100 ?>" size="7" onkeyup="eventAnchoBobina1();" /></td>
							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["ordoppcantmt"] == 1)echo "*"; ?>&nbsp;Metros <b>(mts)</b></td>
								<td width="80%" class="NoiseDataTD">&nbsp;<input type="hidden" name="ordoppcantmt" id="ordoppcantmt" value="<?php echo $ordoppcantmt ?>" size="7" /><span id="ordoppcantmt_lb"><?php echo ($ordoppcantmt)? number_format($ordoppcantmt, 2, ',', '.') : '--' ; ?></span></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td>
									<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
										<tr>
											<td colspan="4" class="ui-state-default">&nbsp;Estructura</td>
										</tr>
										<tr>
											<td colspan="4" >
												<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
													<?php if($tipo_impresion == 'interna' || $tipo_impresion == 'externa'){$idcon = fncconn();?>
													<tr>
														<td width="20%" class="NoiseFooterTD">&nbsp;Material a imprimir</td>
														<td width="80%" class="NoiseDataTD">&nbsp;<?php if($product_imp) $rwPad = loadrecordpadreitem($product_imp,$idcon); echo ($rwPad['paditenombre'])? strtoupper($rwPad['paditenombre']) : '---' ;?></td>
													</tr>
														<?php if($tipo_estruc != 'monocapa'){?>
															<?php for($h=0;$h<$valid_produc_imp;$h++){
															$obj_produclam = "product_lam_".($h +1);
														?>
													<tr>
														<td width="20%" class="NoiseFooterTD">&nbsp;Material a laminar # <?php echo ($h +1 )?></td>
														<td width="80%" class="NoiseDataTD">&nbsp;<?php if($$obj_produclam){ $rwPad = loadrecordpadreitem($$obj_produclam,$idcon); echo ($rwPad['paditenombre'])? strtoupper($rwPad['paditenombre']) : '---' ;unset($rwPad);?><input type="hidden" name="<?php echo $obj_produclam ?>" id="<?php echo $obj_produclam ?>" value="<?php echo $$obj_produclam ?>" /><?php }?></td>
													</tr>
															<?php }?>
														<?php }?>
													<?php }?>
												</table>
											</td>
										</tr>
								  		<tr>
											<td width="20%" class="NoiseFooterTD"><?php if ($campnomb["cant_planea"] == 1) { $cant_planea = null; echo "*";}?>&nbsp;Cant. Planeada (<?php echo $unimedi ?>)</td>
											<td width="30%" class="NoiseDataTD"><input type="text" name="cant_planea" id="cant_planea" value="<?php echo $cant_planea ?>" onkeyup="validaCantplaneada(this.value);" /></td>
											<td width="20%" class="NoiseFooterTD"><?php if ($campnomb["criterio"] == 1) { $criterio = null; echo "*";}?>&nbsp;Criterio </td>
											<td width="30%" class="NoiseDataTD"><input type="hidden" name="criterio_val" id="criterio_val" value="<?php echo $criterio_val ?>" /><select name="criterio" id="criterio"  onchange="cargaCriterio(this.value);">
											<option value="">--Seleccione--</option>
											<?php 
												$idcon = fncconn();
												//floadcriterio($criterio,$idcon);
											?>
											</select></td>
										</tr>
									</table>
									
									<div id="filtrlistaplaneacion">
										<?php
											$noAjax = true;
											include '../src/FunjQuery/jquery.phpscripts/jquery.ajax_planeacion.php';  
										?>
									</div>		
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
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
												floadpadreitemxarr($idmaterial,$arrPadreitem,$idcon);
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
			<input type="hidden" name="accionnuevoopp"> 
			<input type="hidden" name="sourcetable" value="op">
			<input type="hidden" name="sourceaction" value="nuevo"> 
			<input type="hidden" name="arrop" id="arrop" value="<?php echo $arrop?>"> 
			<input type="hidden" name="ordoppcalibr" id="ordoppcalibr" value="<?php echo $ordoppcalibr; ?>">
			<input type="hidden" name="ordoppanchou" id="ordoppanchou" value="<?php echo $ordoppanchou; ?>"> 
			<input type="hidden" name="ordoppdensid" id="ordoppdensid" value="<?php echo $ordoppdensid; ?>"> 
			<input type="hidden" name="formulnumero" id="formulnumero" value="<?php echo $formulnumero; ?>"> 
			<input type="hidden" name="arrrutaitem" id="arrrutaitem" value="<?php echo $arrrutaitem; ?>">
			<input type="hidden" name="codigo" id="codigo" value="<?php echo $codigo; ?>" />
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>		
		<div id="msgwindowform" title="Adsum Kallpa[Gestion MP]"><span id="msgform"></span></div>
	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>





<?php
ini_set("display_errors", 1);
	include_once ( "../src/FunGen/fncobtenercantplaneada.php");
	include_once ( "../src/FunGen/fncobtenerunidadmedida.php");
	include_once ( "../src/FunGen/fncobtenercampertippro.php");
	include_once ( "../src/FunGen/fncobtenermaterialimp.php");	
	include_once ( "../src/FunGen/fncobtenermateriallam.php");	
	include_once ( "../src/FunGen/fncobtenerreferencia.php");
	include_once ( "../src/FunGen/sesion/fncvarsesion.php");
	include_once ( "../src/FunPerPriNiv/pktblsoliprog.php");
	include_once ( "../src/FunPerPriNiv/pktblcriterio.php");
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

	$arrmaterial = fncobtenermaterial($objsarrop);
	$arrcalibre = fncobtenercalibre($objsarrop, $totalcalibre, $totalgramaje, $totalgramaje);
	$matimprimir = fncobtenermaterialimp($objsarrop);
	$arrmatlaminar = fncobtenermateriallam($objsarrop);
	$cant_planea = fncobtenercantplaneada($objsarrop);
	$unimedi = fncobtenerunidadmedida($objsarrop);
	$arrreferencia = fncobtenerreferencia($objsarrop,$tipprocodigo,$produccodigo);

	fncobtenercampertippro($produccodigo, &$ancho, &$largo, &$traslape, &$fuelle, &$pestania, &$solapa, &$bmayor, &$bmenor);

	$idcon = fncconn();
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
						<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td colspan="4" class="ui-state-default">&nbsp;Producto (s)</td>
							</tr>
							<tr>
								<td colspan="4">
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
										<?php 
											if($arrreferencia) $objarrreferencia = explode(":|:", $arrreferencia); else unset($objarrreferencia); 

											for( $a = 0; $a < count($objarrreferencia); $a++):
												$rowobjarrreferencia = explode(":-:", $objarrreferencia[$a]);
										?>
										<tr>
											<td width="20%" class="NoiseFooterTD">&nbsp;Item</td>
											<td width="80%" class="NoiseDataTD">&nbsp;<?php echo ($rowobjarrreferencia[0])? $rowobjarrreferencia[0] : "---"; ?></td>
										</tr>
										<tr>
											<td width="20%" class="NoiseFooterTD">&nbsp;Referencia</td>
											<td width="80%" class="NoiseDataTD">&nbsp;<?php echo ($rowobjarrreferencia[1])? $rowobjarrreferencia[1] : "---"; ?></td>
										</tr>
										<?php
											endfor;
										?>
									</table>								
								</td>
							</tr>
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
											<td width="30%" class="NoiseDataTD"><input type="text" name="cant_planea" id="cant_planea" value="<?php echo $cant_planea ?>" onkeyup="validaCantplaneada(this.value);" /></td>
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
															floadpadreitemxarr($idmaterial,$arrPadreitem,$idcon);
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
			</table>
		</form>
	</body>
	<?php if(!$codigo){ echo " -->"; } ?>
</html>



	