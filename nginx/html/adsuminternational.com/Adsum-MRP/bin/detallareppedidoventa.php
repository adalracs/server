<?php
	ini_set("display_errors", 1);
	include ('../src/FunGen/sesion/fncvalsesion.php');
	include '../src/FunPerPriNiv/pktblusuario.php';
	include '../src/FunPerSecNiv/fncsqlrun.php';
	include '../src/FunPerSecNiv/fncnumreg.php';
	include '../src/FunPerSecNiv/fncfetchall.php';
	include '../src/FunPerSecNiv/fncfetch.php';
	include '../src/FunGen/cargainput.php';
	
	$idcon = fncconn();
	$nombre = cargausuanombre($usuacodi,$idcon);
	$arrListapv = array();
	$optcliente = '';
	$optvendedor = '';
	if($arrclienteoc) $arrObject = explode(',',$arrclienteoc);
	for( $a = 0; $a < count($arrObject); $a++)
	{
		$optcliente = ($optcliente)? $optcliente.",'".$arrObject[$a]."'" : "'".$arrObject[$a]."'";
	}	
	$sqlClienteoc = ($arrclienteoc) ? " ordencompra.ordcomcodcli IN ({$optcliente})" : null;
	$sqlVendedorpv = ($arrvendedorpv) ? " pedidoventa.pedvencodven IN ({$arrvendedorpv})" : null;
	$sqlProducfecha = ($arrvendedorpv) ? " pedidoventa.pedvencodven IN ({$arrvendedorpv})" : null;
	
	$sbSql = "SELECT 
					producto.produccodigo,pedidoventa.pedvennumero,tipopedven.tipevenombre,
					producto.produccoduno,producto.producnombre,tipoproduc.tippronombre,
					ordencompra.ordcomcodcli::text,ordencompra.ordcomrazsoc,pedidoventa.pedvencodven,
					pedidoventa.pedvenvendedor,producto.producfecha,producto.producproces,
					pedidoventa.pedvenfecent,producpedido.propedcansol,producpedido.unidadcodigo
				FROM
					producto
			  	LEFT JOIN producpedido on producto.produccodigo = producpedido.produccodigo
			  	LEFT JOIN pedidoventa on producpedido.pedvencodigo = pedidoventa.pedvencodigo
			  	LEFT JOIN tipopedven on tipopedven.tipevecodigo = pedidoventa.tipevecodigo
			  	LEFT JOIN tipoproduc on producto.tipprocodigo = tipoproduc.tipprocodigo
			  	LEFT JOIN ordencompra on pedidoventa.ordcomcodigo = ordencompra.ordcomcodigo";
	
	$sbWhere .= (($sbWhere && $sqlClienteoc) ? ' AND ' : '').$sqlClienteoc; 
	$sbWhere .= (($sbWhere && $sqlVendedorpv) ? ' AND ' : '').$sqlVendedorpv; 
	$sbSql .= (($sbWhere) ? ' WHERE ' : '').$sbWhere;
	$sbSql .= " AND producto.producfecha BETWEEN '{$producfechaini}' AND '{$producfechafin}' ";
	$sbSql .= " AND producto.producdelrec = 1 order by produccodigo ";
	
	$rsPedidoventa = fncsqlrun($sbSql, $idcon);
	$nrPedidoventa = fncnumreg($rsPedidoventa);
?>
<html>
	<head>
		<title>Reporte pedido venta</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript">
			$(function(){
				$('#exportar').button({icons: { primary: "ui-icon-print" }}).click(function() {
					$("#datos_a_enviar").val( $("<div>").append( $("#Exportar_a_Excel").eq(0).clone()).html());
				    $("#FormularioExportacion").submit();
				});
				$('#imprimir').button({ icons: { primary: "ui-icon-print" } }).click(function() {
					window.print();
					return false;
				});
			});
		</script>
		<style type="text/css">
			.contenido-general-inf { width: 100%;  margin-bottom:12px; }
			.contenido-general-inf .cont-label { font-size: 14px; }
			.contenido-general-inf .cont-field { border-left: 1px solid #A6C9E2; font-size: 14px; }
			.contenido-general-inf .cont-label-b { border-bottom: 1px solid #A6C9E2; }
			.contenido-general-inf .cont-field-b { border-left: 1px solid #A6C9E2; border-bottom: 1px solid #A6C9E2;}

			ul li {}
		</style>
	</head>
	<body bgcolor="FFFFFF" text="#000000">
		<form action="ficheroExcel.php" method="post" target="_blank" id="FormularioExportacion">
			<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
		</form>
		<div class="ui-buttonset">
			<button id="exportar">Exportar excel</button>
			<button id="imprimir">Imprimir</button>
		</div>
		<form name="form1" method="post"  enctype="multipart/form-data" >
<!--	 CONTENIDO GENERAL -->
			<div style="padding: 6px;" id="Exportar_a_Excel">
			
	<!-- CABECERA REPORTE-->
			<div class="contenido-general-inf">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
						<tr>
							<td align="left" width="50%" class="borde-cell"><p><img src="../img/adsumcuasipequeno.jpg"><br><b><small>NIT 800.049.527-3</small></b></p></td>
							<td width="50%" class="head-title-report borde-cell">
								<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
									<tr>
										<td align="center" colspan="3"><b>LISTA DE PEDIDOS DE VENTA</b></td>
									</tr>
									<tr>
										<td align="right" width="30%"><b>FECHA:</b></td>
										<td align="right" width="50%"><?php echo date('Y/m/d') ?></td>
										<td rowspan="4" width="20%">&nbsp;</td>
									</tr>
									<tr>
										<td align="right"><b>EJECUTIVO:</b></td>
										<td align="right"><?php echo $nombre ?></td>
									</tr>
				    			</table>
							</td>
						</tr>
	    			</table>
				</div>
	<!-- FIN CABECERA REPORTE-->
	
	<!-- CONTENIDO REPORTE-->
				<div class="ui-widget-content contenido-general-inf">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
					<?php if($informedet == 1): ?>
						<tr>
	          				<td class="NoiseFooterTD cont-label-b" colspan="11">&nbsp;<b>NUMERO PEDIDOS DE VENTA ENCONTRADOS (<?php echo $nrPedidoventa ?> )</b></td>
	          			</tr>
	          			<tr>
	          				<td class="NoiseFooterTD cont-label-b" width="5%">&nbsp;COD.</td>
	          				<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;TIPO PV.</td>
	          				<td class="NoiseFooterTD cont-field-b" width="5%">&nbsp;PV.</td>
	          				<td class="NoiseFooterTD cont-field-b" width="5%">&nbsp;ITEM</td>
	          				<td class="NoiseFooterTD cont-field-b" width="20%">&nbsp;REFERENCIA</td>
	          				<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;RAZON SOCIAL.</td>
	          				<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;FECHA PED.</td>
	          				<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;FECHA ENT.</td>
	          				<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;CANTIDAD S.</td>
	          				<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;VENDEDOR</td>
	          				<td class="NoiseFooterTD cont-field-b" width="5%">&nbsp;DPTO.</td>
	          			</tr>
	          			<?php 
							for($a = 0; $a < $nrPedidoventa; $a++)
							{
								$rwPedidoventa = fncfetch($rsPedidoventa, $a);
								$optUbicacion = '';
								switch ($rwPedidoventa['producproces']) 
								{
	    							case 1:
	        							$optUbicacion = "VNT";
	        							break;
	    							case 2:
	        							$optUbicacion = "FCT";
	        							break;
	    							case 3:
	        							$optUbicacion = "DSR";
	        							break;
	        						case 4:
	        							$optUbicacion = "DPS";
	        							break;
	        						case 5:
	        							$optUbicacion = "PLN";
	        							break;
	        						case 6:
	        							$optUbicacion = "PPN";
	        							break;
								}
	          			?>
	          			<tr>
	          				<td class="NoiseDataTD cont-label-b" width="5%">&nbsp;<?php echo ($rwPedidoventa['produccodigo'])? $rwPedidoventa['produccodigo'] : '---' ; ?></td>
	          				<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<?php echo ($rwPedidoventa['tipevenombre'])? $rwPedidoventa['tipevenombre'] : '---' ;?></td>
	          				<td class="NoiseDataTD cont-field-b" width="5%">&nbsp;<?php echo ($rwPedidoventa['pedvennumero'])? $rwPedidoventa['pedvennumero'] : '---' ;?></td>
	          				<td class="NoiseDataTD cont-field-b" width="5%">&nbsp;<?php echo ($rwPedidoventa['produccoduno'])? $rwPedidoventa['produccoduno'] : '---' ;?></td>
	          				<td class="NoiseDataTD cont-field-b" width="20%">&nbsp;<?php echo ($rwPedidoventa['producnombre'])? $rwPedidoventa['producnombre'] : '---' ;?></td>
	          				<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<?php echo ($rwPedidoventa['ordcomrazsoc'])? $rwPedidoventa['ordcomrazsoc'] : '---' ;?></td>
	          				<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<?php echo ($rwPedidoventa['producfecha'])? $rwPedidoventa['producfecha'] : '---' ;?></td>
	          				<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<?php echo ($rwPedidoventa['pedvenfecent'])? $rwPedidoventa['pedvenfecent'] : '---' ;?></td>
	          				<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<?php echo ($rwPedidoventa['propedcansol'])? $rwPedidoventa['propedcansol'].' '.$rwPedidoventa['unidadcodigo'] : '---' ;?></td>
	          				<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<?php echo ($rwPedidoventa['pedvenvendedor'])? $rwPedidoventa['pedvenvendedor'] : '---' ;?></td>
	          				<td class="NoiseDataTD cont-field-b" width="5%">&nbsp;<?php echo ($optUbicacion)? $optUbicacion : '---' ;?></td>
	          			</tr>
	          			<?php 
							}
						endif;
						
						if($informedet == 2):
						?>
						<tr>
	          				<td class="NoiseFooterTD cont-label-b" colspan="8">&nbsp;<b>NUMERO PEDIDOS DE VENTA ENCONTRADOS (<?php echo $nrPedidoventa ?> )</b></td>
	          			</tr>
						<tr>
	          				<td class="NoiseFooterTD cont-label-b" width="5%">&nbsp;COD.</td>
	          				<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;PV.</td>
	          				<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;TIPO PV.</td>
	          				<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;PRD.</td>
	          				<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;ITEM</td>
	          				<td class="NoiseFooterTD cont-field-b" colspan="2">&nbsp;REFERENCIA</td>
	          				<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;FECHA</td>
	          			</tr>
	          			<?php 
							for($a = 0; $a < $nrPedidoventa; $a++)
							{
								$rwPedidoventa = fncfetch($rsPedidoventa, $a);
								$optUbicacion = '';
								switch ($rwPedidoventa['producproces']) 
								{
	    							case 1:
	        							$optUbicacion = "VENTAS";
	        							break;
	    							case 2:
	        							$optUbicacion = "FT";
	        							break;
	    							case 3:
	        							$optUbicacion = "DESARROLLO";
	        							break;
	        						case 4:
	        							$optUbicacion = "DISPENSING";
	        							break;
	        						case 5:
	        							$optUbicacion = "PLANEACION";
	        							break;
	        						case 6:
	        							$optUbicacion = "PRODUCCION";
	        							break;
								}
	          			?>
	          			<tr>
	          				<td class="NoiseDataTD cont-label-b" width="5%" rowspan="3">&nbsp;<?php echo ($rwPedidoventa['produccodigo'])? $rwPedidoventa['produccodigo'] : '---' ; ?></td>
	          				<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<?php echo ($rwPedidoventa['pedvennumero'])? $rwPedidoventa['pedvennumero'] : '---' ;?></td>
	          				<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<?php echo ($rwPedidoventa['tipevenombre'])? $rwPedidoventa['tipevenombre'] : '---' ;?></td>
	          				<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<?php echo ($rwPedidoventa['tippronombre'])? $rwPedidoventa['tippronombre'] : '---' ;?></td>
	          				<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<?php echo ($rwPedidoventa['produccoduno'])? $rwPedidoventa['produccoduno'] : '---' ;?></td>
	          				<td class="NoiseDataTD cont-field-b" colspan="2">&nbsp;<?php echo ($rwPedidoventa['producnombre'])? $rwPedidoventa['producnombre'] : '---' ;?></td>
	          				<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<?php echo ($rwPedidoventa['producfecha'])? $rwPedidoventa['producfecha'] : '---' ;?></td>
	          			</tr>
	          			<tr>
	          				<td class="NoiseFooterTD cont-label-b" width="10%">&nbsp;NIT.</td>
	          				<td class="NoiseFooterTD cont-field-b" colspan="3">&nbsp;RAZON SOCIAL</td>
	          				<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;COD. VENDEDOR</td>
	          				<td class="NoiseFooterTD cont-field-b" width="35%">&nbsp;VENDEDOR</td>
	          				<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;UBICACION</td>
	          			</tr>
	          			<tr>
	          				<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<?php echo ($rwPedidoventa['ordcomcodcli'])? $rwPedidoventa['ordcomcodcli'] : '---' ;?></td>
	          				<td class="NoiseDataTD cont-field-b" colspan="3">&nbsp;<?php echo ($rwPedidoventa['ordcomrazsoc'])? $rwPedidoventa['ordcomrazsoc'] : '---' ;?></td>
	          				<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<?php echo ($rwPedidoventa['pedvencodven'])? $rwPedidoventa['pedvencodven'] : '---' ;?></td>
	          				<td class="NoiseDataTD cont-field-b" width="30%">&nbsp;<?php echo ($rwPedidoventa['pedvenvendedor'])? $rwPedidoventa['pedvenvendedor'] : '---' ;?></td>
	          				<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<?php echo ($optUbicacion)? $optUbicacion : '---' ;?></td>
	          			</tr>
	          			<?php 
							}
						endif;	
						?>
	          		</table>
	          	</div>	
	<!-- FIN CONTENIDO REPORTE-->
	
	<!-- 	PIE DE PAGINA -->
				<div class="contenido-general-inf">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
						<tr>
							<td colspan="10" align="center"><b>PLASTICEL S.A - L&iacute;deres en la Tranformaci&oacute;n del Pl&aacute;stico</b></td>
						</tr>
						<tr>
							<td colspan="10" align="center">Calle 15 #29-69 Acopi. Yumbo, Valle del Cauca Colombia Tel&eacute;fono (572) 6901010 www.plasticel.com e-mail info@plasticel.com </td>
	          			</tr>
	    			</table>
				</div>
	<!-- 	FIN PIE DE PAGINA -->	
			
			</div>
<!--	 FIN CONTENIDO GENERAL -->
		</form>
	</body>
</html>