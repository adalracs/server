<?php 
	//ini_set('display_errors',1);
	include ('../src/FunPerPriNiv/pktblalarma.php');
	include ('../src/FunPerPriNiv/pktblvistaalarmagestion.php');
	include ('../src/FunPerPriNiv/pktblalarmaitem.php');
	include ('../src/FunPerPriNiv/pktblalarmamodulo.php');

	include ('../src/FunGen/sesion/fncvalses.php'); 
	include ('../src/FunPerSecNiv/fncsqlrun.php');
	include ('../src/FunPerPriNiv/pktblitemdesa.php');
	include ('../src/FunPerPriNiv/pktblusuario.php');
	include ('../src/FunPerPriNiv/pktblformula.php');
	include ('../src/FunPerPriNiv/pktblpadreitem.php');
	include ('../src/FunPerPriNiv/pktblproducto.php');
	include ('../src/FunPerPriNiv/pktblproducpadreitem.php');
	include ('../src/FunPerPriNiv/pktblproducpadreitem_ft.php');
	include ('../src/FunPerPriNiv/pktblcampertippro.php');
	include ('../src/FunPerPriNiv/pktblcamperdesarr.php');
	include ('../src/FunPerPriNiv/pktblcamperdispen.php');
	include ('../src/FunPerPriNiv/pktblcamperplanea.php');
	include ('../src/FunPerPriNiv/pktblcamperfichat.php');
	include ('../src/FunPerPriNiv/pktblcpdesadetope.php');
	include ('../src/FunPerPriNiv/pktblcptpdetope.php');
	include ('../src/FunPerPriNiv/pktblcpdispdetope.php');
	include ('../src/FunPerPriNiv/pktblcpplandetope.php');
	include ('../src/FunPerPriNiv/pktblcpfichdetope.php');
	include ('../src/FunPerPriNiv/pktblproducpedido.php');
	include ('../src/FunPerPriNiv/pktblproducformula.php');
	include ('../src/FunPerPriNiv/pktblproducformula_ft.php');
	include ('../src/FunPerPriNiv/pktblformulacion.php');
	include ('../src/FunPerPriNiv/pktblpedidoventa.php');
	include ('../src/FunPerPriNiv/pktblordencompra.php');
	include ('../src/FunPerPriNiv/pktblequipo.php');
	include ('../src/FunPerPriNiv/pktblplaneaitemdesa.php');
	include ('../src/FunPerPriNiv/pktblvistaproductos.php');
	include ('../src/FunGen/cargainput.php');
	include ('../src/FunGen/fncnumprox.php'); 
	include ('../src/FunGen/fncnumact.php'); 
	
	if(!$flagdetallarvistafichaitem) 
	{ 
		$idcon = fncconn();
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton);
		
		if (!$sbreg) 
			include( '../src/FunGen/fnccontfron.php');
		//carga de campos personalizados necesarios para el formulario.
		$idcon = fncconn();
		//variables globales
		$tipitecodigo = $sbreg['tipprocodigo']; 
		$produccodigo = $sbreg['produccodigo'];
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
		$ordcomcodcli = $rwOrdencompra['ordcomcodcli'];
		$MODULOCODIGO	= 7;//constante de la tabla "modulo" 
		$rutamodulo = 'maestablvistafichaitem.php';
		include 'scanalarma.php';//se escanea para activar alarmas configuradas
		//carga de campos de personalizados de ventas 		
		//nota hay que asignar la varible producto con el codigo del producto actual. 
		$producto = $produccodigo;		
		include 'cargarcamperfichat.php';
		$nombre = cargausuanombre($usuacodirespon, $idcon);
		$respon = $nombre;
		//para  la imagen de los tipos de embobinados
		$arr_ext = array('.gif','.jpg','.jpeg','.png','.bmp','.GIF','.JPG','.JPEG','.PNG','.BMP');
	   	for($i = 0; $i < count($arr_ext); $i++)
	   	{
		   	if(file_exists('../img/pics_embobinados/embobinado_'.$tipembcodigo.$arr_ext[$i]))
		   	{
		   		$embobinado_icon = 'embobinado_'.$tipembcodigo.$arr_ext[$i];
		   		break;
		   	}
	   	}

	   	//validacion para modificaciones pendientes por gestionar
	   	$rsVistaroductos = dinamicscanopvistaproductos(array("produccoduno" => $produccoduno, "tipevecodigo" => 3, "produccodigo" => $produccodigo, "producproces" => 6, "producfecha" => "2013-08-01"), array("produccoduno" => "=", "tipevecodigo" => "!=", "produccodigo" => "!=", "producproces" => "<=", "producfecha" => ">=date"), $idcon);
	   	$nrVistaroductos = fncnumreg($rsVistaroductos);

	   	if($nrVistaroductos > 0) $rwVistaroductos = fncfetch($rsVistaroductos, 0);
	} 	
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
		<title>Detallar registro de producto</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=UTF8"> 
		<meta http-equiv="expires" content="0"> 
		<meta http-equiv="X-UA-Compatible" content="IE=9"> 
		<?php include ('../def/jquery.library_maestro.php'); ?>
		<script type="text/javascript">
			$(function(){
				$('#imprimir').button({ icons: { primary: "ui-icon-document" } }).click(function() {
					window.open('imprimirfichatecnica.php?codigo=<?php echo $produccodigo ?>','impresion','status=no,menubar=no,scrollbars=yes,resizable=yes,width=880,height=650');
					location ="maestablvistafichaitem.php?codigo=<?php echo $codigo?>;"
					return false;
				});
			});
		</script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.itemfichatecnica.js"></script>
		<style type="text/css">
			.ui-autocomplete-loading { background: white url('../img/ui-anim_basic_16x16.gif') right center no-repeat; }
			#embobinado-label {display: block;font-weight: bold;margin-bottom: 1em;}
    		#embobinado-icon {float: left;height: 64px;width: 64px;}
    		#embobinado-description {margin: 0;padding: 0;}
		</style>
	</head> 
<?php if (! $codigo) echo "<!--"; ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post" enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">&Iacute;tem [Ficha Tecnica]</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="850">

<?php if( $nrVistaroductos > 0 && isset($rwVistaroductos) ): 
	echo '<script language= "javascript">';
	echo '<!--//'."\n";
	echo 'alert("Alerta : En el sistema se encuentra el PV '.$rwVistaroductos["pedvennumero"].' con una nueva version del item.")';
	echo '//-->'."\n";
	echo '</script>';
?>
				<tr>
					<td>
						<div class="ui-widget">
							<div class="ui-state-highlight ui-corner-all" style="padding: 0 .7em;"> 
								<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
									<strong>Mensaje:</strong>&nbsp;
									En el sistema se encuentra el PV <?php echo $rwVistaroductos["pedvennumero"]; ?> 
									con una nueva version del item.
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
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr>
				<tr>
					<td>
						<?php if($tipitecodigo): ?>
						<div id="tabitems">
							<ul>
								<li style="text-align: center"><a href="#opt-tab1"><small>Item<br/>&nbsp;</small></a></li>
								<li style="text-align: center"><a href="#opt-tab2"><small>Especificaciones del<br/>producto</small></a></li>
								<li style="text-align: center"><a href="#opt-tab4"><small>Especificaci&oacute;n de<br/>embalaje</small></a></li>
								<li style="text-align: center"><a href="#opt-tab5"><small>Especificaciones de <br/>Material extruido</small></a></li>
								<?php if($tipitecodigo != 5): ?>
								<li style="text-align: center"><a href="#opt-tab6"><small>Laminaci&oacute;n<br/>&nbsp;</small></a></li>
								<?php endif?>
								<li style="text-align: center"><a href="#opt-tab7"><small>Corte/Refilado<br/>&nbsp;</small></a></li>
								<?php if($tipitecodigo != 6): ?>
								<li style="text-align: center"><a href="#opt-tab4a"><small>Sellado<br/>&nbsp;Doblado/Micro</small></a></li>
								<?php endif?>
							</ul>
							<?php include '../src/FunjQuery/jquery.tabs/fichatecnica/jquery.itemgeneral.det.php' ?>
							<!--		TABS PARA NUEVO MUESTRA	 -->
							<?php if($tipitecodigo == 1) include '../src/FunjQuery/jquery.tabs/fichatecnica/jquery.bolsaflowpack.det.php' ?>
							<?php if($tipitecodigo == 2) include '../src/FunjQuery/jquery.tabs/fichatecnica/jquery.bolsalateral.det.php' ?>
							<?php if($tipitecodigo == 3) include '../src/FunjQuery/jquery.tabs/fichatecnica/jquery.bolsapouchdoypack.det.php' ?>
							<?php if($tipitecodigo == 4) include '../src/FunjQuery/jquery.tabs/fichatecnica/jquery.bolsapouchlateral.det.php' ?>
							<?php if($tipitecodigo == 5) include '../src/FunjQuery/jquery.tabs/fichatecnica/jquery.capuchon.det.php' ?>
							<?php if($tipitecodigo == 6) include '../src/FunjQuery/jquery.tabs/fichatecnica/jquery.lamina.det.php' ?>
						</div>
						<?php endif?>
					</td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><?php $imprimir=1;include '../def/jquery.button_formdetall.php'; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr> 
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
			<input type="hidden" name="flagnuevovistaitemfichatecnica">

			<input type="hidden" name="windetallar" id="windetallar" value="1"><!-- ventana de detalle -->
			<input type="hidden" name="modulocodigo" id="modulocodigo" value="7"><!-- modulo de fichas tecnicas -->
			<input type="hidden" name="produccoduno" id="produccoduno" value="<?php echo $produccoduno; ?>"><!-- codigo item -->
			<input type="hidden" name="ordcomcodcli" id="ordcomcodcli" value="<?php echo $ordcomcodcli; ?>"><!-- codigo cliente -->


			<input type="hidden" name="pedvencodigo" value="<?php if(!$flagnuevovistaitemfichatecnica){ echo $rwPedidoventa[pedvencodigo];}else{ echo $pedvencodigo; }?>"> 
			<input type="hidden" name="produccodigo" value="<?php if(!$flagnuevovistaitemfichatecnica){ echo $sbreg[produccodigo];}else{ echo $produccodigo; } ?>">  		
			<input type="hidden" name="ordcomcodigo" value="<?php if(!$flagnuevovistaitemfichatecnica){ echo $rwOrdencompra[ordcomcodigo];}else{ echo $ordcomcodigo; } ?>">  		
			<input type="hidden" name="propedcodigo" value="<?php if(!$flagnuevovistaitemfichatecnica){ echo $rwProducpedido[propedcodigo];}else{ echo $propedcodigo; } ?>">  		
			<input type="hidden" name="tipitecodigo" id="tipitecodigo" value="<?php echo $tipitecodigo; ?>"> 
			<input type="hidden" name="tipevecodigo" id="tipevecodigo" value="<?php echo $tipevecodigo; ?>"> 
			<input type="hidden" name="valid_produc_imp" id="valid_produc_imp" value="<?php echo $valid_produc_imp; ?>">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">  
			<input type="hidden" name="sourceaction" id="sourceaction" value="detallar">  
			<input type="hidden" name="acciondetallarvistafichaitem"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="seltack">
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
	</body> 
<?php if (! $codigo) echo " -->"; ?> 
</html>