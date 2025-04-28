<?php 
	ini_set('display_erros',1);
	include ( '../src/FunPerPriNiv/pktblproducpadreitem.php');
	include ( '../src/FunPerSecNiv/fncconn.php');
	include ( '../src/FunPerSecNiv/fncclose.php');
	include ( '../src/FunPerSecNiv/fncsqlrun.php');
	include ( '../src/FunPerSecNiv/fncnumreg.php');
	include ( '../src/FunPerSecNiv/fncfetch.php');
	include ( '../src/FunPerPriNiv/pktblproducto.php');
	include ( '../src/FunPerPriNiv/pktblproducpedido.php');
	include ( '../src/FunPerPriNiv/pktblpedidoventa.php');
	include ( '../src/FunPerPriNiv/pktblpedidotemp.php');
	include ( '../src/FunPerPriNiv/pktblordencompra.php');
	include ( '../src/FunPerPriNiv/pktblcptpdetope.php');
	include ( '../src/FunPerPriNiv/pktblcpdesadetope.php');
	include ( '../src/FunPerPriNiv/pktblcampertippro.php');
	include ( '../src/FunPerPriNiv/pktblcamperdesarr.php');
	include ( '../src/FunPerPriNiv/pktblformulacion.php');
	include ('../src/FunPerPriNiv/pktblusuario.php');
	include ('../src/FunPerPriNiv/pktblpadreitem.php');
	include ('../src/FunGen/cargainput.php');
	$idcon = fncconn();
	$rwProducto = loadrecordproducto($codigo,$idcon);	
	//variables globales
	$tipitecodigo = $rwProducto['tipprocodigo']; 
	$produccodigo = $rwProducto['produccodigo'];
	//registro de producpedido
	$rwProducpedido = loadrecordproducpedidoPER('produccodigo',$rwProducto['produccodigo'],$idcon);
	//registro de pedido venta
	$rwPedidoventa = loadrecordpedidoventa($rwProducpedido['pedvencodigo'],$idcon);
	$tipevecodigo = $rwPedidoventa['tipevecodigo'];
	$nombre = cargausuanombre($rwPedidoventa['usuacodi'], $idcon);
	//registro de orden de compra si no es pedido de repeticion
	if($rwPedidoventa['tipevecodigo'] !=4)
	{
		$rwOrdencompra = loadrecordordencompra($rwPedidoventa['ordcomcodigo'],$idcon);
	}
	$clientnombre = $rwOrdencompra['ordcomrazsoc'];
	//carga de campos de personalizados de ventas 
	//nota hay que asignar la varible producto con el codigo del producto actual. 
	$producto = $produccodigo;
	include 'cargarcampertippro.php';
	//campos adicionales para el formato de impresion
	$pedvencodven = $rwPedidoventa['pedvencodven'];
	$pedvenvendedor = $rwPedidoventa['pedvenvendedor'];
	$pedvenfecent = $rwPedidoventa['pedvenfecent'];
	$pedvennumero = $rwPedidoventa['pedvennumero'];
	$pedvendiapac = $rwPedidoventa['pedvendiapac'];
	$produccoduno = $rwProducto['produccoduno'];
	$producnombre = $rwProducto['producnombre'];
	$producfecha = $rwProducto['producfecha'];
	$ordcomcodcli = $rwOrdencompra['ordcomcodcli'];
	$ordcomrazsoc = $rwOrdencompra['ordcomrazsoc'];
	$ordcomnumero = $rwOrdencompra['ordcomnumero'];
	$ordcomfecrec = $rwOrdencompra['ordcomfecrec'];
	$arrNro = explode(',',$arrCampertippro['list_colors']);
	$unidadcodigo = $rwProducpedido['unidadcodigo'];
	$propedcansol = $rwProducpedido['propedcansol'];
	$pedvenobserv = $rwPedidoventa['pedvenobserv'];
	if($tipo_estruc != 'monocapa') $flaglaminado = 1;
	//carga de campos de personalizados de desarrollo 
	//nota hay que asignar la varible producto con el codigo del producto actual. 
	$producto = $produccodigo;
	include 'cargarcamperdesarr.php';
?>
<html>
	<head>
		<style>
			.tabla {
			margin-left: 0px;
			margin-top: 0px;
			margin-right: 0px;
			margin-bottom: 0px;
			font-family: Verdana, Arial, Helvetica, sans-serif;
			font-size:10px;
			width: 800px;}
		</style>
	</head>
	<body>
		<table border="1" class="tabla" cellpadding="0">
			<tr>
				<td><img src="../img/barra.png"></img></td>
				<td align="center"><b>INFORMACION PEDIDOS DE VENTA </b></td>
				<td align="center"><b>DOCUMENTO EN PRUEBA</b></td>
			</tr>
		</table>
		<!-- 	DATOS DEL PEDIDO DE VENTA -->
		<table border="0" class="tabla" cellpadding="0">
			<tr>
				<td width="120px">&nbsp;Pedido</td>
				<td width="230px">&nbsp;<font size=3><b><?php echo ($tipopedido)? strtoupper($tipopedido) : '---' ;?></b></font></td>
				<td width="120px">&nbsp;Codigo Adsum</td>
				<td width="230px">&nbsp;
					<font size=2>
						<b><?php echo ($codigo)? strtoupper($codigo) : '---' ;?></b>
						::
						<b><?php echo ($producfecha)? strtoupper($producfecha) : '---' ;?></b>
					</font>
				</td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Fecha de entrega&nbsp;</td>
				<td width="230px">&nbsp;<?php echo ($pedvenfecent)? strtoupper($pedvenfecent) : '---' ; ?></td>
				<td width="120px">&nbsp;Recepcion&nbsp;<b>(OC)</b></td>
				<td width="230px">&nbsp;<?php echo ($ordcomfecrec)? strtoupper($ordcomfecrec) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Codigo vendedor</td>
				<td width="230px">&nbsp;<?php echo ($pedvencodven)? strtoupper($pedvencodven) : '---' ;?></td>
				<td width="120px">&nbsp;Vendedor</td>
				<td width="230px">&nbsp;<?php echo ($pedvenvendedor)? strtoupper($pedvenvendedor) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Elaborado por</td>
				<td width="230px">&nbsp;<?php echo ($nombre)? strtoupper($nombre) : '---' ;?></td>
				<td width="120px">&nbsp;Dias pactados</td>
				<td width="230px">&nbsp;<?php echo ($pedvendiapac)? strtoupper($pedvendiapac) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="120px">&nbsp;No pedido venta</td>
				<td width="230px">&nbsp;<font size=2><b><?php echo ($pedvennumero)? strtoupper($pedvennumero) : '---' ;?></b></font></td>
				<td width="120px">&nbsp;Codigo cliente</td>
				<td width="230px">&nbsp;<?php echo ($codigosap)? strtoupper($codigosap) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Item</td>
				<td width="230px">&nbsp;<font size=2><b><?php echo ($produccoduno)? strtoupper($produccoduno) : '---' ;?></b></font></td>
				<td width="120px">&nbsp;No orden de compra</td>
				<td width="230px">&nbsp;<?php echo ($ordcomnumero)? strtoupper($ordcomnumero) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Referencia</td>
				<td colspan="3">&nbsp;<?php echo ($producnombre)? strtoupper($producnombre) : '---' ;?></td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Cliente NIT</td>
				<td width="230px">&nbsp;<?php echo ($ordcomcodcli)? strtoupper($ordcomcodcli) : '---' ;?></td>
				<td width="120px">&nbsp;Exportacion</td>
				<td width="230px">&nbsp;<?php echo ($exportacion)? strtoupper($exportacion) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Razon social</td>
				<td colspan="3">&nbsp;<?php echo ($ordcomrazsoc)? strtoupper($ordcomrazsoc) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Precio</td>
				<td width="230px">&nbsp;<?php echo ($precio)? strtoupper($precio) : '---' ;?></td>
				<td width="120px">&nbsp;Moneda</td>
				<td width="230px">&nbsp;<?php echo ($moneda)? strtoupper($moneda) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Cartera cumple</td>
				<td width="230px">&nbsp;<?php echo ($cartera)? strtoupper($cartera) : '---' ;?></td>
				<td width="120px">&nbsp;Cobro fotopolimeros</td>
				<td width="230px">&nbsp;<?php echo ($cobro_fotopo)? strtoupper($cobro_fotopo) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Tipo impresion</td>
				<td width="230px">&nbsp;<?php echo ($tipo_impresion)? strtoupper($tipo_impresion) : '---' ;?></td>
				<td width="120px">&nbsp;Version de arte</td>
				<td width="230px">&nbsp;<?php echo ($version_arte)? strtoupper($version_arte) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Listado de colores (<?php echo count($arrNro) ?>)</td>
				<td colspan="3">&nbsp;<?php echo ($list_colors)? strtoupper($list_colors) : '---' ; ?></td>
			</tr>
			</tr>
				<td width="120px">&nbsp;Tintas resistentes a</td>
				<td colspan="3">&nbsp;<?php echo ($tintasa)? strtoupper($tintasa) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="120px">&nbsp;P. aprobados por</td>
				<td width="230px">&nbsp;<?php echo ($producto_avaliable)? strtoupper($producto_avaliable) : '---' ; ?></td>
				<td width="120px">&nbsp;Colores aprobado por</td>
				<td width="230px">&nbsp;<?php echo ($colorespor)? strtoupper($colorespor) : '---' ; ?></td>
			<tr>
				<td width="120px">&nbsp;Cantidad solicitada</td>
				<td width="230px">&nbsp;<?php echo ($propedcansol)? number_format($propedcansol, 2, ',', '.') : '---' ; ?></td>
				<td width="120px">&nbsp;Tolerancia cantidad(%)</td>
				<td width="230px">&nbsp;
					<b>+</b><?php echo ($tole_cant_ms)? strtoupper($tole_cant_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_cant_mn)? strtoupper($tole_cant_mn) : 'xx' ; ?>
				</td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Cantidad de inventario</td>
				<td width="230px">&nbsp;---</td>
				<td width="120px">&nbsp;Cantidad a produccir</td>
				<td width="230px">&nbsp;---</td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Unidad de medida</td>
				<td width="230px">&nbsp;<?php echo ($unidadcodigo)? strtoupper($unidadcodigo) : '---' ; ?></td>
				<td width="120px">&nbsp;Tipo de estructura</td>
				<td width="230px">&nbsp;<?php echo ($tipo_estruc)? strtoupper($tipo_estruc) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Nota</td>
				<td colspan="3">&nbsp;<?php echo ($pedvenobserv)? strtoupper($pedvenobserv) : '---' ; ?></td>
			</tr>
		</table>
		<!-- 	FIN DATOS DEL PEDIDO DE VENTA -->
		
		<!-- 	ESTRUCTURA DEL ITEM  -->
		<table border="0" class="tabla" cellpadding="0">
			<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>ESTRUCTURA ITEM <?php echo strtoupper($tipoproducto) ?></b></td>
			</tr>
			<tr>
				<td width="400px">&nbsp;Material</td>
				<td width="100px">&nbsp;Color</td>
				<td width="100px">&nbsp;Calibre</td>
				<td width="100px">&nbsp;Gramaje</td>
			</tr>
			<?php 
				if($arrtabla1)
				{
					$array_tmp = explode(':|:',$arrtabla1);
					for($a = 0; $a < count($array_tmp); $a++)
					{
						$rwArray_tmp = explode(':-:', $array_tmp[$a]);
						$rwPadreitem = loadrecordpadreitem($rwArray_tmp[1],$idcon);
						if($rwPadreitem['paditeextrui'] == 't') $flagextruido = 1;
						$objColor = 'color_'.$rwArray_tmp[0].'_'.$rwArray_tmp[1];						
						$total_gramaje += ($rwArray_tmp[3] * $rwArray_tmp[2]);
						$total_calibre += $rwArray_tmp[3];
 			?>
 			<tr>
 				<td width="400px">&nbsp;<?php echo ($rwPadreitem['paditenombre'])? strtoupper($rwPadreitem['paditenombre']) : '---' ; ?></td>
				<td width="100px">&nbsp;<?php echo ($$objColor)? strtoupper($$objColor) : '---' ;?></td>
				<td width="100px">&nbsp;<?php echo ($rwArray_tmp[3])? $rwArray_tmp[3] : '---' ;?></td>
				<td width="100px">&nbsp;<?php echo ($rwArray_tmp[3] * $rwArray_tmp[2]) ?></td>
 			</tr>
 			<?php 
	 				}
 				}
 			?>
 		</table>
 		<table border="0" class="tabla" cellpadding="0">
 			<tr>
 				<td width="120px">&nbsp;Total calibre</td>
				<td width="230px">&nbsp;<?php echo ($total_calibre)? strtoupper($total_calibre) : '---' ; ?></td>
				<td width="100px">&nbsp;Total Gramaje</td>
				<td width="230px">&nbsp;<?php echo ($total_gramaje)? strtoupper($total_gramaje) : '---' ; ?></td>
			</tr>
		</table>
		<!-- 	FIN ESTRUCTURA DEL ITEM  -->
		
		
		
		<?php if($tipitecodigo == 1){?>
		<!-- 	MEDIDAS PARA BOLSA FLOW PACK -->
			<table border="0" class="tabla" cellpadding="0">
				<tr>
					<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>ESPECIFICACIONES BOLSA FLOW PACK</b></td>
				</tr>
				<tr>
					<td width="120px">&nbsp;Ancho <b>(mm)</b></td>
					<td width="230px">&nbsp;<?php echo ($ancho)? strtoupper($ancho) : '---' ; ?></td>
					<td width="140px">&nbsp;Tolerancia ancho <b>(mm)</b></td>
					<td width="210px">&nbsp;
						<b>+</b><?php echo ($tole_ancho_ms)? strtoupper($tole_ancho_ms) : 'xx' ; ?>&nbsp;
						<b>-</b><?php echo ($tole_ancho_ms)? strtoupper($tole_ancho_ms) : 'xx' ; ?>
					</td>
				</tr>
				<tr>
					<td width="120px">&nbsp;Largo <b>(mm)</b></td>
					<td width="230px">&nbsp;<?php echo ($largo)? strtoupper($largo) : '---' ; ?></td>
					<td width="140px">&nbsp;Tolerancia largo <b>(mm)</b></td>
					<td width="210px">&nbsp;
						<b>+</b><?php echo ($tole_largo_ms)? strtoupper($tole_largo_ms) : 'xx' ; ?>&nbsp;
						<b>-</b><?php echo ($tole_largo_mn)? strtoupper($tole_largo_mn) : 'xx' ; ?>
					</td>
				</tr>
				<tr>
					<td width="120px">&nbsp;Fuelle <b>(mm)</b></td>
					<td width="230px">&nbsp;<?php echo ($fuelle)? strtoupper($fuelle) : '---' ; ?></td>
					<td width="140px">&nbsp;Tolerancia fuelle <b>(mm)</b></td>
					<td width="210px">&nbsp;
						<b>+</b><?php echo ($tole_fuelle_ms)? strtoupper($tole_fuelle_ms) : 'xx' ; ?>&nbsp;
						<b>-</b><?php echo ($tole_fuelle_mn)? strtoupper($tole_fuelle_mn) : 'xx' ; ?>
					</td>
				</tr>
				<tr>
					<td width="120px">&nbsp;Traslape <b>(mm)</b></td>
					<td width="230px">&nbsp;<?php echo ($traslape)? strtoupper($traslape) : '---' ; ?></td>
					<td width="140px">&nbsp;Tolerancia traslape <b>(mm)</b></td>
					<td width="210px">&nbsp;
						<b>+</b><?php echo ($tole_traslape_ms)? strtoupper($tole_traslape_ms) : 'xx' ; ?>&nbsp;
						<b>-</b><?php echo ($tole_traslape_mn)? strtoupper($tole_traslape_mn) : 'xx' ; ?>
					</td>
				</tr>
				<tr>
					<td width="120px">&nbsp;Tipo Traslape</td>
					<td width="230px">&nbsp;<?php echo ($tipo_traslape)? strtoupper($tipo_traslape) : '---' ; ?></td>
					<td width="140px">&nbsp;Peso millar</td>
<!--					<td width="210px">&nbsp;<?php //echo (round(((($solapa / 1000) + ($largo / 1000 * 2) + ($solapa / 1000 * 2) + ($fuelle / 1000 * 2)) * (($ancho / 1000) * $total_gramaje))*100) / 100) / 2 ?></td>-->
					<td width="210px">&nbsp;<?php echo number_format( ( ( ($ancho / 1000 * 2) + ($traslape / 1000 * 2) + ($fuelle / 1000 * 2) ) * ($largo / 1000) * ($total_gramaje) ), 2, ',', '.')?></td>
				</tr>
				<tr>
					<td width="120px">&nbsp;Troquel</td>
					<td width="230px">&nbsp;<?php echo ($troquel)? strtoupper($troquel) : '---' ; ?></td>
					<td width="140px">&nbsp;Tipo troquel</td>
					<td width="210px">&nbsp;<?php echo ($tipo_troquel)? strtoupper($tipo_troquel) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="120px">&nbsp;Ancho de selle</td>
					<td width="230px">&nbsp;<?php echo ($aselle_bolsa)? strtoupper($aselle_bolsa) : '---' ; ?></td>
					<td width="140px">&nbsp;Valvula</td>
					<td width="210px">&nbsp;<?php echo ($valve)? strtoupper($valve) : '---' ; ?></td>
				</tr>
				<?php if($valve == 'si'){?>
				<tr>
					<td width="120px">&nbsp;Color tapa valvula</td>
					<td width="230px">&nbsp;<?php echo ($ctapa_valve)? strtoupper($ctapa_valve) : '---' ; ?></td>
					<td width="140px">&nbsp;Medida valvula (mm)</td>
					<td width="210px">&nbsp;<?php echo ($medi_valve)? strtoupper($medi_valve) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="120px">&nbsp;Ubicacion valvula</td>
					<td width="230px">&nbsp;<?php echo ($ubic_valve)? strtoupper($ubic_valve) : '---' ; ?></td>
					<td width="140px">&nbsp;Tipo valvula</td>
					<td width="210px">&nbsp;<?php echo ($tipo_valve)? strtoupper($tipo_valve) : '---' ; ?></td>
				</tr>
				<?php }?>
				<tr>
					<td width="120px">&nbsp;Codigo de barras</td>
					<td width="230px">&nbsp;<?php echo ($cod_barras)? strtoupper($cod_barras) : '---' ; ?></td>
					<td width="140px">&nbsp;Llenado</td>
					<td width="210px">&nbsp;<?php echo ($tipo_llenado)? strtoupper($tipo_llenado) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="120px">&nbsp;Observaciones</td>
					<td colspan="3">&nbsp;<?php echo ($note_product)? strtoupper($note_product) : '---' ; ?></td>
				</tr>
			</table>
		<?php }?>
		<!-- 	FIN MEDIDAS PARA BOLSA FLOW PACK -->
		
		
		
		
		
		<?php if($tipitecodigo == 2){?>
		<!-- 	MEDIDAS PARA BOLSA LATERAL -->
			<table border="0" class="tabla" cellpadding="0">
				<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>ESPECIFICACIONES BOLSA LATERAL</b></td>
			</tr>
				<tr>
					<td width="120px">&nbsp;Ancho <b>(mm)</b></td>
					<td width="230px">&nbsp;<?php echo ($ancho)? strtoupper($ancho) : '---' ; ?></td>
					<td width="140px">&nbsp;Tolerancia ancho <b>(mm)</b></td>
					<td width="210px">&nbsp;
						<b>+</b><?php echo ($tole_ancho_ms)? strtoupper($tole_ancho_ms) : 'xx' ; ?>&nbsp;
						<b>-</b><?php echo ($tole_ancho_ms)? strtoupper($tole_ancho_ms) : 'xx' ; ?>
					</td>
				</tr>
				<tr>
					<td width="120px">&nbsp;Largo <b>(mm)</b></td>
					<td width="230px">&nbsp;<?php echo ($largo)? strtoupper($largo) : '---' ; ?></td>
					<td width="140px">&nbsp;Tolerancia largo <b>(mm)</b></td>
					<td width="210px">&nbsp;
						<b>+</b><?php echo ($tole_largo_ms)? strtoupper($tole_largo_ms) : 'xx' ; ?>&nbsp;
						<b>-</b><?php echo ($tole_largo_mn)? strtoupper($tole_largo_mn) : 'xx' ; ?>
					</td>
				</tr>
				<tr>
					<td width="120px">&nbsp;Fuelle <b>(mm)</b></td>
					<td width="230px">&nbsp;<?php echo ($fuelle)? strtoupper($fuelle) : '---' ; ?></td>
					<td width="140px">&nbsp;Tolerancia fuelle <b>(mm)</b></td>
					<td width="210px">&nbsp;
						<b>+</b><?php echo ($tole_fuelle_ms)? strtoupper($tole_fuelle_ms) : 'xx' ; ?>&nbsp;
						<b>-</b><?php echo ($tole_fuelle_mn)? strtoupper($tole_fuelle_mn) : 'xx' ; ?>
					</td>
				</tr>
				<tr>
					<td width="120px">&nbsp;Solapa <b>(mm)</b></td>
					<td width="230px">&nbsp;<?php echo ($solapa)? strtoupper($solapa) : '---' ; ?></td>
					<td width="140px">&nbsp;No caras impresas</td>
					<td width="210px">&nbsp;<?php echo ($ncaras_imp)? strtoupper($ncaras_imp) : '---' ;?></td>
				</tr>
				<tr>
					<td width="120px">&nbsp;Wicket</td>
					<td width="230px">&nbsp;<?php echo ($wicket)? strtoupper($wicket) : '---' ; ?></td>
					<td width="120px">&nbsp;Peso millar</td>
					<td width="230px">&nbsp;<?php echo round((((double) $solapa / 1000) + ((double) $largo / 1000 * 2) + ((double)  $solapa / 1000 * 2) + ((double)  $fuelle / 1000 * 2)) * (((double)  $ancho / 1000) * ((double) $total_gramaje)) * 100 ) / 100 ?></td>
				</tr>
				<tr>
					<td width="120px">&nbsp;Troquel</td>
					<td width="230px">&nbsp;<?php echo ($troquel)? strtoupper($troquel) : '---' ; ?></td>
					<td width="140px">&nbsp;Tipo troquel</td>
					<td width="210px">&nbsp;<?php echo ($tipo_troquel)? strtoupper($tipo_troquel) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="120px">&nbsp;Llenado</td>
					<td width="230px">&nbsp;<?php echo ($tipo_llenado)? strtoupper($tipo_llenado) : '---' ; ?></td>
					<td width="140px">&nbsp;Codigo de barras</td>
					<td width="210px">&nbsp;<?php echo ($cod_barras)? strtoupper($cod_barras) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="120px">&nbsp;Observaciones</td>
					<td colspan="3">&nbsp;<?php echo ($note_product)? strtoupper($note_product) : '---' ; ?></td>
				</tr>
			</table>
		<?php }?>
		<!-- 	FIN MEDIDAS PARA BOLSA LATERAL -->
		
		
		
		
		
		<?php if($tipitecodigo == 3){?>
		<!-- 	MEDIDAS PARA BOLSA POUCH DOY PACK -->
			<table border="0" class="tabla" cellpadding="0">
				<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>ESPECIFICACIONES BOLSA POUCH DOY PACK</b></td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Ancho <b>(mm)</b></td>
				<td width="230px">&nbsp;<?php echo ($ancho)? strtoupper($ancho) : '---' ; ?></td>
				<td width="140px">&nbsp;Tolerancia ancho <b>(mm)</b></td>
				<td width="210px">&nbsp;
					<b>+</b><?php echo ($tole_ancho_ms)? strtoupper($tole_ancho_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_ancho_ms)? strtoupper($tole_ancho_ms) : 'xx' ; ?>
				</td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Largo <b>(mm)</b></td>
				<td width="230px">&nbsp;<?php echo ($largo)? strtoupper($largo) : '---' ; ?></td>
				<td width="140px">&nbsp;Tolerancia largo <b>(mm)</b></td>
				<td width="210px">&nbsp;
					<b>+</b><?php echo ($tole_largo_ms)? strtoupper($tole_largo_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_largo_mn)? strtoupper($tole_largo_mn) : 'xx' ; ?>
				</td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Fuelle <b>(mm)</b></td>
				<td width="230px">&nbsp;<?php echo ($fuelle)? strtoupper($fuelle) : '---' ; ?></td>
				<td width="140px">&nbsp;Tolerancia fuelle <b>(mm)</b></td>
				<td width="210px">&nbsp;
					<b>+</b><?php echo ($tole_fuelle_ms)? strtoupper($tole_fuelle_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_fuelle_mn)? strtoupper($tole_fuelle_mn) : 'xx' ; ?>
				</td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Tipo de selle</td>
				<td width="230px">&nbsp;<?php echo ($tipo_selle)? strtoupper($tipo_selle) : '---' ; ?></td>
				<td width="140px">&nbsp;Ancho de selle</td>
				<td width="210px">&nbsp;<?php echo ($aselle_bolsa)? strtoupper($aselle_bolsa) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="120px">&nbsp;No sellos</td>
				<td width="230px">&nbsp;<?php echo ($sellos)? strtoupper($sellos) : '---' ; ?></td>
				<td width="140px">&nbsp;Peso millar</td>
				<td width="210px">&nbsp;<?php echo round((((double) $solapa / 1000) + ((double) $largo / 1000 * 2) + ((double)  $solapa / 1000 * 2) + ((double)  $fuelle / 1000 * 2)) * (((double)  $ancho / 1000) * ((double) $total_gramaje)) * 100 ) / 100 ?></td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Troquel</td>
				<td width="230px">&nbsp;<?php echo ($troquel)? strtoupper($troquel) : '---' ; ?></td>
				<td width="140px">&nbsp;Tipo troquel</td>
				<td width="210px">&nbsp;<?php echo ($tipo_troquel)? strtoupper($tipo_troquel) : '---' ; ?></td>
			</tr>
			
			<tr>
				<td width="120px">&nbsp;Valvula</td>
				<td width="230px">&nbsp;<?php echo ($valve)? strtoupper($valve) : '---' ; ?></td>
				<td width="140px">&nbsp;Tipo de apertura</td>
				<td width="210px">&nbsp;<?php echo ($tipo_aper)? strtoupper($tipo_aper) : '---' ; ?></td>
			</tr>
			<?php if($valve == 'si'){?>
			<tr>
				<td width="120px">&nbsp;Color tapa valvula</td>
				<td width="230px">&nbsp;<?php echo ($ctapa_valve)? strtoupper($ctapa_valve) : '---' ; ?></td>
				<td width="140px">&nbsp;Medida valvula (mm)</td>
				<td width="210px">&nbsp;<?php echo ($medi_valve)? strtoupper($medi_valve) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Ubicacion valvula</td>
				<td width="230px">&nbsp;<?php echo ($ubic_valve)? strtoupper($ubic_valve) : '---' ; ?></td>
				<td width="140px">&nbsp;Tipo valvula</td>
				<td width="210px">&nbsp;<?php echo ($tipo_valve)? strtoupper($tipo_valve) : '---' ; ?></td>
			</tr>
			<?php }?>
			<tr>
				<td width="120px">&nbsp;Tipo de cierre</td>
				<td width="230px">&nbsp;<?php echo ($tipo_cierre)? strtoupper($tipo_cierre) : '---' ; ?></td>
				<td width="140px">&nbsp;Distancion apertura&nbsp;<b>(mm)</b></td>
				<td width="210px">&nbsp;<?php echo ($dist_aper)? strtoupper($dist_aper) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Llenado</td>
				<td width="230px">&nbsp;<?php echo ($tipo_llenado)? strtoupper($tipo_llenado) : '---' ; ?></td>
				<td width="140px">&nbsp;Codigo de barras</td>
				<td width="210px">&nbsp;<?php echo ($cod_barras)? strtoupper($cod_barras) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Observaciones</td>
				<td colspan="3">&nbsp;<?php echo ($note_product)? strtoupper($note_product) : '---' ; ?></td>
			</tr>
		</table>
			<?php }?>
		<!-- 	FIN DE MEDIDAS PARA BOLSA POUCH DOY PACK -->
		
		
		
		
		<?php if($tipitecodigo == 4){?>
		<!-- 	MEDIDAS PARA BOLSA POUCH LATERAL -->
		<table border="0" class="tabla" cellpadding="0">
			<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>ESPECIFICACIONES BOLSA POUCH LATERAL</b></td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Ancho <b>(mm)</b></td>
				<td width="230px">&nbsp;<?php echo ($ancho)? strtoupper($ancho) : '---' ; ?></td>
				<td width="140px">&nbsp;Tolerancia ancho <b>(mm)</b></td>
				<td width="210px">&nbsp;
					<b>+</b><?php echo ($tole_ancho_ms)? strtoupper($tole_ancho_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_ancho_ms)? strtoupper($tole_ancho_ms) : 'xx' ; ?>
				</td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Largo <b>(mm)</b></td>
				<td width="230px">&nbsp;<?php echo ($largo)? strtoupper($largo) : '---' ; ?></td>
				<td width="140px">&nbsp;Tolerancia largo <b>(mm)</b></td>
				<td width="210px">&nbsp;
					<b>+</b><?php echo ($tole_largo_ms)? strtoupper($tole_largo_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_largo_mn)? strtoupper($tole_largo_mn) : 'xx' ; ?>
				</td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Troquel</td>
				<td width="230px">&nbsp;<?php echo ($troquel)? strtoupper($troquel) : '---' ; ?></td>
				<td width="140px">&nbsp;Tipo troquel</td>
				<td width="210px">&nbsp;<?php echo ($tipo_troquel)? strtoupper($tipo_troquel) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="120px">&nbsp;No caras impresas</td>
				<td width="230px">&nbsp;<?php echo ($ncaras_imp)? strtoupper($ncaras_imp) : '---' ; ?></td>
				<td width="140px">&nbsp;Codigo de barras</td>
				<td width="210px">&nbsp;<?php echo ($cod_barras)? strtoupper($cod_barras) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="120px">&nbsp;No de sellos</td>
				<td width="230px">&nbsp;<?php echo ($nro_sellos)? strtoupper($nro_sellos) : '---' ; ?></td>
				<td width="140px">&nbsp;Peso millar</td>
				<td width="210px">&nbsp;<?php echo round((((double) $solapa / 1000) + ((double) $largo / 1000 * 2) + ((double)  $solapa / 1000 * 2) + ((double)  $fuelle / 1000 * 2)) * (((double)  $ancho / 1000) * ((double) $total_gramaje)) * 100 ) / 100 ?></td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Ancho de selle</td>
				<td width="230px">&nbsp;<?php echo ($aselle_bolsa)? strtoupper($aselle_bolsa) : '---' ; ?></td>
				<td width="140px">&nbsp;Valvula</td>
				<td width="210px">&nbsp;<?php echo ($valve)? strtoupper($valve) : '---' ; ?></td>
			</tr>
			<?php if($valve == 'si'){?>
			<tr>
				<td width="120px">&nbsp;Color tapa valvula</td>
				<td width="230px">&nbsp;<?php echo ($ctapa_valve)? strtoupper($ctapa_valve) : '---' ; ?></td>
				<td width="140px">&nbsp;Medida valvula (mm)</td>
				<td width="210px">&nbsp;<?php echo ($medi_valve)? strtoupper($medi_valve) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Ubicacion valvula</td>
				<td width="230px">&nbsp;<?php echo ($ubic_valve)? strtoupper($ubic_valve) : '---' ; ?></td>
				<td width="140px">&nbsp;Tipo valvula</td>
				<td width="210px">&nbsp;<?php echo ($tipo_valve)? strtoupper($tipo_valve) : '---' ; ?></td>
			</tr>
			<?php }?>
			<tr>
				<td width="120px">&nbsp;Tipo de cierre</td>
				<td width="230px">&nbsp;<?php echo ($tipo_cierre)? strtoupper($tipo_cierre) : '---' ; ?></td>
				<td width="140px">&nbsp;Tipo de apertura</td>
				<td width="210px">&nbsp;<?php echo ($tipo_aper)? strtoupper($tipo_aper) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Ziper</td>
				<td width="230px">&nbsp;<?php echo ($ziper)? strtoupper($ziper) : '---' ; ?></td>
				<td width="140px">&nbsp;Muesca</td>
				<td width="210px">&nbsp;<?php echo ($muesca)? strtoupper($muesca) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Precorte</td>
				<td width="230px">&nbsp;<?php echo ($precorte)? strtoupper($precorte) : '---' ; ?></td>
				<td width="140px">&nbsp;Llenado</td>
				<td width="210px">&nbsp;<?php echo ($tipo_llenado)? strtoupper($tipo_llenado) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Observaciones</td>
				<td colspan="3">&nbsp;<?php echo ($note_product)? strtoupper($note_product) : '---' ; ?></td>
			</tr>
		</table>
		<?php }?>
		<!-- 	FIN MEDIDAS PARA BOLSA POUCH LATERAL -->
		
		
		
		
		
		<?php if($tipitecodigo == 5){?>
		<!-- 	MEDIDAS PARA CAPUCHON -->
		<table border="0" class="tabla" cellpadding="0">
			<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>ESPECIFICACIONES CAPUCHON</b></td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Material a imprimir</td>
				<td width="230px">&nbsp;<?php echo ($mate_imp)? strtoupper($mate_imp) : '---' ; ?></td>
				<td width="140px">&nbsp;Posicion a imprimir</td>
				<td width="210px">&nbsp;<?php echo ($pos_imp)? strtoupper($pos_imp) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Largo <b>(mm)</b></td>
				<td width="230px">&nbsp;<?php echo ($largo)? strtoupper($largo) : '---' ; ?></td>
				<td width="140px">&nbsp;Tolerancia largo <b>(mm)</b></td>
				<td width="210px">&nbsp;
					<b>+</b><?php echo ($tole_largo_ms)? strtoupper($tole_largo_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_largo_mn)? strtoupper($tole_largo_mn) : 'xx' ; ?>
				</td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Pesta&ntilde;a <b>(mm)</b></td>
				<td width="230px">&nbsp;<?php echo ($pestania)? strtoupper($pestania) : '---' ; ?></td>
				<td width="140px">&nbsp;Tolerancia pesta&ntilde;a <b>(mm)</b></td>
				<td width="210px">&nbsp;
					<b>+</b><?php echo ($tole_pestania_ms)? strtoupper($tole_pestania_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_pestania_mn)? strtoupper($tole_pestania_mn) : 'xx' ; ?>
				</td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Base mayor <b>(mm)</b></td>
				<td width="230px">&nbsp;<?php echo ($bmayor)? strtoupper($bmayor) : '---' ; ?></td>
				<td width="140px">&nbsp;Tolerancia base mayor <b>(mm)</b></td>
				<td width="210px">&nbsp;
					<b>+</b><?php echo ($tole_bmayor_ms)? strtoupper($tole_bmayor_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_bmayor_mn)? strtoupper($tole_bmayor_mn) : 'xx' ; ?>
				</td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Base menor <b>(mm)</b></td>
				<td width="230px">&nbsp;<?php echo ($bmenor)? strtoupper($bmenor) : '---' ; ?></td>
				<td width="140px">&nbsp;Tolerancia base menor <b>(mm)</b></td>
				<td width="210px">&nbsp;
					<b>+</b><?php echo ($tole_bmenor_ms)? strtoupper($tole_bmenor_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_bmenor_mn)? strtoupper($tole_bmenor_mn) : 'xx' ; ?>
				</td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Macroperforaciones</td>
				<td width="230px">&nbsp;<?php echo ($macroper)? strtoupper($macroper) : '---' ; ?></td>
				<td width="140px">&nbsp;No de macroperforaciones</td>
				<td width="210px">&nbsp;<?php echo ($nro_macroper)? strtoupper($nro_macroper) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Microperforaciones</td>
				<td width="230px">&nbsp;<?php echo ($microper)? strtoupper($microper) : '---' ; ?></td>
				<td width="140px">&nbsp;No de microperdoradas</td>
				<td width="210px">&nbsp;<?php echo ($ncaras_microper)? strtoupper($ncaras_microper) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Tipo de microperforaciones</td>
				<td width="230px">&nbsp;<?php echo ($tipo_microper)? strtoupper($tipo_microper) : '---' ; ?></td>
				<td width="140px">&nbsp;Distancia microperforacion</td>
				<td width="210px">&nbsp;<?php echo ($dist_microper)? strtoupper($dist_microper) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Troquel</td>
				<td width="230px">&nbsp;<?php echo ($troquel)? strtoupper($troquel) : '---' ; ?></td>
				<td width="140px">&nbsp;Tipo troquel</td>
				<td width="210px">&nbsp;<?php echo ($tipo_troquel)? strtoupper($tipo_troquel) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Selle de fondo</td>
				<td width="230px">&nbsp;<?php echo ($selle_fondo)? strtoupper($selle_fondo) : '---' ; ?></td>
				<?php
					//se adiciono la correcion de el calculo de el peso millar de  los capuchones
					unset($estructura_n); ($tipo_estruc == 'compuesto')? $estructura_n = 2 : $estructura_n = 1;
				?>
				<td width="140px">&nbsp;Peso millar</td>
<!--			<td width="210px">&nbsp;<?php //echo round((((((double) $bmayor / 1000) + ((double) $bmenor / 1000 )) / 2 ) * ( (((double)  $largo / 1000) * 2) + (((double) $pestania / 1000) * 2)))*$total_gramaje  * 100 ) / 100 ?></td>-->
				<td width="210px">&nbsp;<?php echo round(((((($bmayor / 1000) + ($bmenor / 1000)) / 2)  * ((($largo / 1000) * 2) + ($pestania / 1000 ) * 2)) *  (($total_gramaje / $estructura_n))) * 100) / 100; ?></td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Dist perf pesta&ntilde;a</td>
				<td width="230px">&nbsp;<?php echo ($dist_microper)? strtoupper($dist_microper) : '---' ; ?></td>
				<td width="140px">&nbsp;Codigo de barras</td>
				<td width="210px">&nbsp;<?php echo ($cod_barras)? strtoupper($cod_barras) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="120px">&nbsp;Observaciones</td>
				<td colspan="3">&nbsp;<?php echo ($note_product)? strtoupper($note_product) : '---' ; ?></td>
			</tr>
		</table>
		<?php }?>
		<!-- 	FIN MEDIDAS PARA CAPUCHON  -->
		
		
		
		
		
		<?php if($tipitecodigo == 6){?>
		<!-- 	MEDIDAS PARA LAMINA -->
		<table border="0" class="tabla" cellpadding="0">
			<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>ESPECIFICACIONES LAMINA</b></td>
			</tr>
			<tr>
				<td width="140px">&nbsp;Ancho <b>(mm)</b></td>
				<td width="210px">&nbsp;<?php echo ($ancho)? strtoupper($ancho) : '---' ; ?></td>
				<td width="140px">&nbsp;Tolerancia ancho <b>(mm)</b></td>
				<td width="210px">&nbsp;
					<b>+</b><?php echo ($tole_ancho_ms)? strtoupper($tole_ancho_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_ancho_mn)? strtoupper($tole_ancho_mn) : 'xx' ; ?>
				</td>
			</tr>
			<tr>
				<td width="140px">&nbsp;Largo <b>(mm)</b></td>
				<td width="210px">&nbsp;<?php echo ($largo)? strtoupper($largo) : '---' ; ?></td>
				<td width="140px">&nbsp;Tolerancia largo <b>(mm)</b></td>
				<td width="210px">&nbsp;
					<b>+</b><?php echo ($tole_largo_ms)? strtoupper($tole_largo_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_largo_mn)? strtoupper($tole_largo_mn) : 'xx' ; ?>
				</td>
			</tr>
			<tr>
				<td width="140px">&nbsp;Ancho fotocelda <b>(mm)</b></td>
				<td width="210px">&nbsp;<?php echo ($ancho_fotoc)? strtoupper($ancho_fotoc) : '---' ; ?></td>
				<td width="140px">&nbsp;Largo fotocelda <b>(mm)</b></td>
				<td width="210px">&nbsp;<?php echo ($largo_fotoc)? strtoupper($largo_fotoc) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="140px">&nbsp;Dist. fotocelda borde <b>(mm)</b></td>
				<td width="210px">&nbsp;<?php echo ($dfotoc_borde)? strtoupper($dfotoc_borde) : '---' ; ?></td>
				<td width="140px">&nbsp;Color fotocelda</td>
				<td width="210px">&nbsp;<?php echo ($color_fotoc)? strtoupper($color_fotoc) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="140px">&nbsp;Tipo de embobinado</td>
				<td width="210px">&nbsp;<?php echo ($tipo_emb)? strtoupper($tipo_emb) : '---' ; ?></td>
				<td width="140px">&nbsp;Con respecto a</td>
				<td width="210px">&nbsp;<?php echo ($con_resp)? strtoupper($con_resp) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="140px">&nbsp;Codigo de barras</td>
				<td colspan="3">&nbsp;<?php echo ($cod_barras)? strtoupper($cod_barras) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="140px">&nbsp;Observaciones</td>
				<td colspan="3">&nbsp;<?php echo ($note_product)? strtoupper($note_product) : '---' ; ?></td>
			</tr>
		</table>
		<?php }?>
		<!-- 	FIN MEDIDAS PARA LAMINA  -->
		
		
		
		
		
		<?php if($tipitecodigo != 6){?>
		<!-- 	ESPECIFICACIONES DE EMBALAJE PARA BOLSAS Y CAPUCHONES-->
			<table border="0" class="tabla" cellpadding="0">
				<tr>
					<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>ESPECIFICACIONES DE EMBALAJE</b></td>
				</tr>
				<tr>
					<td width="120px">&nbsp;Tipo de empaque</td>
					<td width="230px">&nbsp;<?php echo ($tipo_empaque)? strtoupper($tipo_empaque) : '---' ; ?></td>
					<td width="140px">&nbsp;Unidades por empaque</td>
					<td width="210px">&nbsp;<?php echo ($uni_empaque)? strtoupper($uni_empaque) : '---' ; ?></td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;Peso maximo por empaque</td>
					<td colspan="2">&nbsp;<?php echo ($peso_empaque)? strtoupper($peso_empaque) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="120px">&nbsp;Unidades por paquete</td>
					<td width="230px">&nbsp;<?php echo ($uni_paquete)? strtoupper($uni_paquete) : '---' ; ?></td>
					<td width="140px">&nbsp;Estibado</td>
					<td width="210px">&nbsp;<?php echo ($estibado)? strtoupper($estibado) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="120px">&nbsp;Tama&ntilde;o de estiba</td>
					<td width="230px">&nbsp;<?php echo ($tam_estiba)? strtoupper($tam_estiba) : '---' ; ?></td>
					<td width="140px">&nbsp;Tipo de estiba</td>
					<td width="210px">&nbsp;<?php echo ($tipo_estiba)? strtoupper($tipo_estiba) : '---' ; ?></td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;Altura maxima pallet <b>(mm)</b></td>
					<td colspan="2">&nbsp;<?php echo ($alt_pallet)? strtoupper($alt_pallet) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="120px">&nbsp;Peso por pallet</td>
					<td width="230px">&nbsp;<?php echo ($pes_pallet)? strtoupper($pes_pallet) : '---' ; ?></td>
					<td width="140px">&nbsp;Estresado</td>
					<td width="210px">&nbsp;<?php echo ($estresado)? strtoupper($estresado) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="120px">&nbsp;Observaciones</td>
					<td colspan="3">&nbsp;<?php echo ($note_embalaje)? strtoupper($note_embalaje) : '---' ; ?></td>
				</tr>
			</table>
		<?php }?>
		<!-- 	FIN ESPECIFICACIONES DE EMBALAJE PARA BOLSAS Y CAPUCHONES-->
		
		<?php if($tipitecodigo == 6){?>
		<!-- 	ESPECIFICACIONES DE EMBALAJE PARA LAMINA-->
			<table border="0" class="tabla" cellpadding="0">
				<tr>
					<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>ESPECIFICACIONES DE EMBALAJE</b></td>
				</tr>
				<tr>
					<td width="140px">&nbsp;Tama&ntilde;o del core <b>(mm)</b></td>
					<td width="210px">&nbsp;<?php echo ($tam_core)? strtoupper($tam_core) : '---' ; ?></td>
					<td width="140px">&nbsp;Metros del rollo</td>
					<td width="210px">&nbsp;<?php echo ($mrollo)? strtoupper($mrollo) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="140px">&nbsp;Peso del rollo <b>(kg)</b></td>
					<td width="210px">&nbsp;<?php echo ($prollo)? strtoupper($prollo) : '---' ; ?></td>
					<td width="140px">&nbsp;Tolerancia peso <b>(kg)</b></td>
					<td width="210px">&nbsp;
					<b>+</b><?php echo ($tole_prollo_ms || $tole_drollo_ms == '0')? strtoupper($tole_prollo_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_prollo_mn || $tole_prollo_mn == '0')? strtoupper($tole_prollo_mn) : 'xx' ; ?>
					</td>
				</tr>
				<tr>
					<td width="140px">&nbsp;Diametro del rollo <b>(mm)</b></td>
					<td width="210px">&nbsp;<?php echo ($drollo)? strtoupper($drollo) : '---' ; ?></td>
					<td width="140px">&nbsp;Tolerancia diametro <b>(mm)</b></td>
					<td width="210px">&nbsp;
					<b>+</b><?php echo ($tole_drollo_ms || $tole_drollo_ms == '0')? strtoupper($tole_drollo_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_drollo_mn || $tole_drollo_mn == '0')? strtoupper($tole_drollo_mn) : 'xx' ; ?>
					</td>
				</tr>
				<tr>
					<td width="140px">&nbsp;Bandera</td>
					<td width="210px">&nbsp;<?php echo ($flag)? strtoupper($flag) : '---' ; ?></td>
					<td width="140px">&nbsp;Color bandera</td>
					<td width="210px">&nbsp;<?php echo ($color_flag)? strtoupper($color_flag) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="140px">&nbsp;Ubicacion bandera</td>
					<td colspan="3">&nbsp;<?php echo ($ubic_flag)? strtoupper($ubic_flag) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="140px">&nbsp;No maximo de empalmes</td>
					<td width="210px">&nbsp;<?php echo ($nmax_empal)? strtoupper($nmax_empal) : '---' ; ?></td>
					<td width="140px">&nbsp;Ancho de empalme<b>(mm)</b></td>
					<td width="210px">&nbsp;<?php echo ($ancho_empal)? strtoupper($ancho_empal) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="140px">&nbsp;Color empalme cara</td>
					<td width="210px">&nbsp;<?php echo ($cempal_cara)? strtoupper($cempal_cara) : '---' ; ?></td>
					<td width="140px">&nbsp;Color empalme dorso</td>
					<td width="210px">&nbsp;<?php echo ($cempal_dorso)? strtoupper($cempal_dorso) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="140px">&nbsp;Observaciones</td>
					<td colspan="3">&nbsp;<?php echo ($note_embalaje)? strtoupper($note_embalaje) : '---' ; ?></td>
				</tr>
				<tr>
					<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>FORMA DE EMPAQUE</b></td>
				</tr>
				<tr>
					<td width="140px">&nbsp;Forma de empaque</td>
					<td colspan="3">&nbsp;<?php echo ($form_empa)? strtoupper($form_empa) : '---' ; ?></td>
				</tr>
				
				<?php if($form_empa == 'suspendido'){?>
				<tr>
					<td width="140px">&nbsp;Niveles por estiba</td>
					<td width="210px">&nbsp;<?php echo ($niv_estiba)? strtoupper($niv_estiba) : '---' ; ?></td>
					<td width="140px">&nbsp;Peso por estiba</td>
					<td width="210px">&nbsp;<?php echo ($peso_estiba)? strtoupper($peso_estiba) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="140px">&nbsp;Bolsa plastica</td>
					<td colspan="3">&nbsp;<?php echo ($bolsa_plastica)? strtoupper($bolsa_plastica) : '---' ; ?></td>
				</tr>
				<?php }?>
				
				<?php if($form_empa == 'caja'){?>
				<tr>
					<td width="140px">&nbsp;Protector core</td>
					<td width="210px">&nbsp;<?php echo ($pro_core)? strtoupper($pro_core) : '---' ; ?></td>
					<td width="140px">&nbsp;Bolsa plastica</td>
					<td width="210px">&nbsp;<?php echo ($bolsa_plastica)? strtoupper($bolsa_plastica) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="140px">&nbsp;Peso maximo <b>(kg)</b></td>
					<td colspan="3">&nbsp;<?php echo ($peso_max)? strtoupper($peso_max) : '---' ; ?></td>
				</tr>
				<?php }?>
				
				<?php if($form_empa == 'bolsa_plastica'){?>
				<tr>
					<td width="140px">&nbsp;Protector core</td>
					<td width="210px">&nbsp;<?php echo ($pro_core)? strtoupper($pro_core) : '---' ; ?></td>
					<td width="140px">&nbsp;Peso maximo <b>(mm)</b></td>
					<td width="210px">&nbsp;<?php echo ($peso_max)? strtoupper($peso_max) : '---' ; ?></td>
				</tr>
				<?php }?>
				
				<?php  if($form_empa == 'carton_extremos' || $form_empa == 'cubierto_extremos'){?>
				<tr>
					<td width="140px">&nbsp;Protector core</td>
					<td width="210px">&nbsp;<?php echo ($pro_core)? strtoupper($pro_core) : '---' ; ?></td>
					<td width="140px">&nbsp;Bolsa plastica</td>
					<td width="210px">&nbsp;<?php echo ($bolsa_plastica)? strtoupper($bolsa_plastica) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="140px">&nbsp;No rollos</td>
					<td colspan="3">&nbsp;<?php echo ($no_rollos)? strtoupper($no_rollos) : '---' ; ?></td>
				</tr>
				<?php }?>
				
				<tr>
					<td width="140px">&nbsp;Material estibado</td>
					<td colspan="3">&nbsp;<?php echo ($estibado)? strtoupper($estibado) : '---' ; ?></td>
				</tr>
				<?php if($estibado == 'si'){?>
				<tr>
					<td width="140px">&nbsp;Tama&ntilde;o estiba <b>(mm)</b></td>
					<td width="210px">&nbsp;<?php echo ($tam_estiba)? strtoupper($tam_estiba) : '---' ; ?></td>
					<td width="140px">&nbsp;Tipo de estiba</td>
					<td width="210px">&nbsp;<?php echo ($tipo_estiba)? strtoupper($tipo_estiba) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="140px">&nbsp;Altura maxima pallet <b>(mm)</b></td>
					<td width="210px">&nbsp;<?php echo ($alt_pallet)? strtoupper($alt_pallet) : '---' ; ?></td>
					<td width="140px">&nbsp;Peso por pallet<b>(kg)</b></td>
					<td width="210px">&nbsp;<?php echo ($pes_pallet)? strtoupper($pes_pallet) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="140px">&nbsp;Estresado</td>
					<td colspan="3">&nbsp;<?php echo ($estresado)? strtoupper($estresado) : '---' ; ?></td>
				</tr>
				<?php }?>
				<tr>
					<td width="140px">&nbsp;Observaciones</td>
					<td colspan="3">&nbsp;<?php echo ($note_formaempaque)? strtoupper($note_formaempaque) : '---' ; ?></td>
				</tr>
			</table>
		<?php }?>
		<!-- 	FIN ESPECIFICACIONES DE EMBALAJE PARA BOLSAS Y CAPUCHONES-->
		

		<!-- 	ESPECIFICACIONES DE MATERIAL EXTRUIDO-->
			<?php if($flagextruido){?>
			<table border="0" class="tabla" cellpadding="0">
				<tr>
					<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>ESPECIFICACIONES DE MATERIAL EXTRUIDO</b></td>
				</tr>
				<?php 
					if($arrtabla1)
					{
						$array_tmp = explode(':|:',$arrtabla1);
						for($a = 0; $a < count($array_tmp); $a++)
						{
							$rwArray_tmp = explode(':-:', $array_tmp[$a]);
							$rwItem = loadrecordpadreitem($rwArray_tmp[1],$idcon);	
		
							if($rwArray_tmp[4] == 't')
							{
								//objetos de campos personalizados
		
								$objapli_mate = 'apli_mate_'.($a + 1); // aplicacion del material
								$objcolor = 'color_'.($a + 1); // color de material
								$objtratamiento = 'tratamiento_'.($a + 1); // tratamiento
								$objplano_tratado = 'plano_tratado_'.($a + 1); // tratamiento
								$objtrata_min = 'trata_min_'.($a + 1); // tratamiento minimo
								$objtrata_max = 'trata_max_'.($a + 1); // tratamiento maximo
								$objncaras_trata = 'ncaras_trata_'.($a + 1); // numero de caras tratadas
								$objmat_sellable = 'mat_sellable_'.($a + 1); // material sellable
								$objncaras_sellable = 'ncaras_sellable_'.($a + 1); // numero de caras sellables
								$objcofmax_nt = 'cofmax_nt_'.($a + 1); // cofmax_nt
								$objcofmax_tt = 'cofmax_tt_'.($a + 1); // cofmax_tt
								$objhaze = 'haze_'.($a + 1); // haze
								$objtole_haze_ms = 'tole_haze_ms_'.($a + 1); // tolerancia haze por mas
								$objtole_haze_mn = 'tole_haze_mn_'.($a + 1); // tolerancia haze por menos
								$objnote_extruido = 'note_extruido_'.($a + 1); // nota para material extruido
								
								$objformul_cod = 'formulcodigo_'.($a + 1); // formulacion codigo
								$objformul_num = 'formulnumero_'.($a + 1); // formiulacion numero
				?>
				<tr>
					<td colspan="4">&nbsp;<b>Sustrato no <?php echo ($a + 1)?> <?php echo $rwItem['paditenombre'] ?> Calibre <?php echo $rwArray_tmp[3] ?></b></td>
 				</tr>
 				<tr>
					<td width="120px">&nbsp;Aplicacion del material</td>
					<td width="230px">&nbsp;<?php echo ($$objapli_mate)? strtoupper($$objapli_mate) : '---' ; ?></td>
					<td width="140px">&nbsp;Color</td>
					<td width="210px">&nbsp;<?php echo ($$objcolor)? strtoupper($$objcolor) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="120px">&nbsp;Tratamiento</td>
					<td width="230px">&nbsp;<?php echo ($$objtratamiento)? strtoupper($$objtratamiento) : '---' ; ?></td>
					<td width="140px">&nbsp;Plano tratado</td>
					<td width="210px">&nbsp;<?php echo ($$objplano_tratado)? strtoupper($$objplano_tratado) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="120px">&nbsp;Tratamiento</td>
					<td width="230px">&nbsp;<?php echo ($$objtratamiento)? strtoupper($$objtratamiento) : '---' ; ?></td>
					<td width="140px">&nbsp;Formula</td>
					<td width="210px">&nbsp;<?php echo ($$objformul_num && ($tipevecodigo == 1 || $tipevecodigo == 2) )? strtoupper($$objformul_num) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="120px">&nbsp;Trata. min (dinas)</td>
					<td width="230px">&nbsp;<?php echo ($$objtrata_min)? strtoupper($$objtrata_min) : '---' ; ?></td>
					<td width="140px">&nbsp;Trata. max (dinas)</td>
					<td width="210px">&nbsp;<?php echo ($$objtrata_max)? strtoupper($$objtrata_max) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="120px">&nbsp;Material sellable</td>
					<td width="230px">&nbsp;<?php echo ($$objmat_sellable)? strtoupper($$objmat_sellable) : '---' ; ?></td>
					<td width="140px">&nbsp;No caras sellables</td>
					<td width="210px">&nbsp;<?php echo ($$objncaras_sellable)? strtoupper($$objncaras_sellable) : '---' ; ?></td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;<b>(cof)</b> Cara no tratada max</td>
					<td colspan="3">&nbsp;<?php echo ($$objcofmax_nt)? strtoupper($$objcofmax_nt) : '---' ; ?></td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;<b>(cof)</b> Cara tratada max</td>
					<td colspan="3">&nbsp;<?php echo ($$objcofmax_tt)? strtoupper($$objcofmax_tt) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="120px">&nbsp;Opacidad haze <b>%</b></td>
					<td width="230px">&nbsp;<?php echo ($$objhaze)? strtoupper($$objhaze) : '---' ; ?></td>
					<td width="140px">&nbsp;Tolerancia haze</td>
					<td width="210px">&nbsp;
						<b>+</b><?php echo ($$objtole_haze_ms)? strtoupper($$objtole_haze_ms) : 'xx' ; ?>&nbsp;
						<b>-</b><?php echo ($$objtole_haze_mn)? strtoupper($$objtole_haze_mn) : 'xx' ; ?>
				</tr>
				<tr>
					<td width="120px">&nbsp;Observaciones</td>
					<td colspan="3">&nbsp;<?php echo ($$objnote_extruido)? strtoupper($$objnote_extruido) : '---' ; ?></td>
				</tr>
				<?php 
							}
						}
					}
				?>
				
			</table>
			<?php }?>
		<!-- 	FIN ESPECIFICACIONES DE MATERIAL EXTRUIDO-->
		
		
		<!-- 	ESPECIFICACIONES DE LAMINACION-->
		<?php if($flaglaminado){?>
			<table border="0" class="tabla" cellpadding="0">
				<tr>
					<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>ESPECIFICACIONES DE LAMINACION</b></td>
				</tr>
				<tr>
					<td width="120px">&nbsp;Lado brillante foil</td>
					<td width="230px">&nbsp;<?php echo ($lado_foil)? strtoupper($lado_foil) : '---' ; ?></td>
					<td width="140px">&nbsp;Tipo de adhesion</td>
					<td width="210px">&nbsp;<?php echo ($tipo_proceso)? strtoupper($tipo_proceso) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="120px">&nbsp;Observaciones</td>
					<td colspan="3">&nbsp;<?php echo ($note_laminacion)? strtoupper($note_laminacion) : '---' ; ?></td>
				</tr>
			</table>
			<?php }?>
		<!-- 	FIN ESPECIFICACIONES DE LAMINACION-->
		
		<!-- 	ESPECIFICACIONES DE CONDICIONES DE PROCESOS PARA EL DESARROLLO-->
			<table border="0" class="tabla" cellpadding="0">
				<tr>
					<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>CONDICIONES DEL PROCESO DE DESARROLLO</b></td>
				</tr>
				<tr>
					<td width="120px">&nbsp;Producto a empacar</td>
					<td width="230px">&nbsp;<?php echo ($product_empa)? strtoupper($product_empa) : '---' ; ?></td>
					<td width="140px">&nbsp;Temperatura empacado<b>(c)</b></td>
					<td width="210px">&nbsp;<?php echo ($temp_empa)? strtoupper($temp_empa) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="120px">&nbsp;Tipo de sellado</td>
					<td width="230px">&nbsp;<?php echo ($tipo_sellado)? strtoupper($tipo_sellado) : '---' ; ?></td>
					<td width="140px">&nbsp;Velocidad de empaque</td>
					<td width="210px">&nbsp;<?php echo ($vel_empa)? strtoupper($vel_empa) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="120px">&nbsp;Observaciones</td>
					<td colspan="3">&nbsp;<?php echo ($note_proces)? strtoupper($note_proces) : '---' ; ?></td>
				</tr>
			</table>
		<!-- 	DIN ESPECIFICACIONES DE CONDICIONES DE PROCESOS PARA EL DESARROLLO-->
		
		
		
		
		<!-- 	ESPECIFICACIONES APROBACAION-->
			<table border="0" class="tabla" cellpadding="0">
				<tr>
					<td width="233px">&nbsp;</td>
					<td width="233px">&nbsp;</td>
					<td width="233px">&nbsp;</td>
				</tr>
				<tr>
					<td width="233px">&nbsp;<?php echo ($nombre)? strtoupper($nombre) : '---' ; ?></td>
					<td width="233px">&nbsp;</td>
					<td width="233px">&nbsp;</td>
				</tr>
				<tr>
					<td width="233px">&nbsp;<b>ELABORADO POR</b></td>
					<td width="233px">&nbsp;<b>APROBADO POR</b></td>
					<td width="233px">&nbsp;<b>RECIBIDO POR</b></td>
				</tr>
			</table>
			
			<!-- 	DATOS ADJUNTOS-->
			<table border="0" class="tabla" cellpadding="0">
				<tr>
					<td width="233px">&nbsp;</td>
					<td width="233px">&nbsp;</td>
					<td width="233px">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="3">&nbsp;
						<?php 
							if($uploadocumen)
							{
								$arrUpload = explode('::', $uploadocumen);
								$arrUploadSize = explode('::', $uploadocumensize);
								for($a = 0; $a < count($arrUpload); $a++)
								{
						?>
						<a href="javascript: void(0);" onclick="window.open('http://192.168.60.55/plasticel/doc/upload/documentos/<?php echo $arrUpload[$a] ?>','impresion','status=no,menubar=no,scrollbars=yes,resizable=yes,width=880,height=650');"><?php echo $arrUpload[$a].' ('.$arrUploadSize[$a].')' ?></a>
						<?php												
								}
							}
						?>
					</td>
				</tr>
		</table>
							
		
	</body>
</html>
