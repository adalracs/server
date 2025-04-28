<?php

	ini_set("display_errors", 1);
	include ("../src/FunPerPriNiv/pktblplaneaitemdesa.php");
	include ("../src/FunPerPriNiv/pktbloppitemdesa.php");
	include ("../src/FunGen/sesion/fncvalsesion.php");
	include ("../src/FunPerPriNiv/pktblusuario.php");
	include ("../src/FunPerSecNiv/fncfetchall.php");
	include ("../src/FunPerSecNiv/fncsqlrun.php");
	include ("../src/FunPerSecNiv/fncnumreg.php");
	include ("../src/FunPerSecNiv/fncfetch.php");
	include ("../src/FunGen/cargainput.php");
	
	$idcon = fncconn();

	$sqlKeyLinea = ($arrkeylinea) ? " itemdesa.keylinea IN ({$arrkeylinea})" : null;

	$sbSql = "
			SELECT 
				itemdesa.itedescodigo, itemdesa.itedesnombre, itemdesa.keylinea, itemdesa.itedeslinea,
				itemdesa.itedesancho,itemdesa.itedescalib, itemdesa.itedesinvent, itemdesa.itedescantoc,
				itemdesa.itedescantec
				FROM itemdesa";
	
	$sbWhere .= (($sbWhere && $sqlKeyLinea) ? ' AND ' : '').$sqlKeyLinea;	

	$sbSql .= (($sbWhere) ? ' WHERE ' : '').$sbWhere;
	//$sbSql .= " AND producto.producfecha BETWEEN '{$producfechaini}' AND '{$producfechafin}' ";
	$sbSql .= " ORDER BY (itemdesa.itedescalib,itemdesa.itedesancho)";
	
	$rsItemDesa = fncsqlrun($sbSql, $idcon);
	$nrItemDesa = fncnumreg($rsItemDesa);
?>
<html>
	<head>
		<title>Informe estatus de materiales</title>
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
										<td align="center" colspan="3"><b>ESTATUS DE MATERIALES</b></td>
									</tr>
									<tr>
										<td align="right" width="30%"><b>FECHA:</b></td>
										<td align="right" width="50%"><?php echo date('Y/m/d') ?></td>
										<td rowspan="4" width="20%">&nbsp;</td>
									</tr>
									<tr>
										<td align="right"><b>GENERADO POR:</b></td>
										<td align="right"><?php echo cargausuanombre($usuacodi, $idcon); ?></td>
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
						<tr>
	          				<td class="NoiseFooterTD cont-label-b" colspan="11">&nbsp;<b>NUMERO DE MATERIALES ENCONTRADOS (<?php echo $nrItemDesa; ?> )</b></td>
	          			</tr>
	          			<tr>
	          				<td class="NoiseFooterTD cont-label-b" width="5%">&nbsp;ITEM</td>
	          				<td class="NoiseFooterTD cont-field-b" width="25%">&nbsp;DESCRIPCI&Oacute;N</td>
	          				<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;ANCHO&nbsp;<b>(mm)<b/></td>
	          				<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;CALIBRE&nbsp;<b>(&micro;m)<b></td>
	          				<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;DISPONIBLE&nbsp;<b>(kgs)<b></td>
	          				<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;CONSUMO&nbsp;<b>(kgs)<b></td>
	          				<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;SALDO FINAL&nbsp;<b>(kgs)<b></td>
	          				<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;TRANSITO&nbsp;<b>(kgs)<b></td>
	          			</tr>
	          			<?php 
							for($a = 0; $a < $nrItemDesa; $a++)
							{
								$rwItemDesa = fncfetch($rsItemDesa, $a);
								$rwPlaneaItemDesa = loadrecordplaneaitemdesasum($rwItemDesa["itedescodigo"], $idcon);
								$rwOppItemDesa = loadrecordoppitemdesasumopp($rwItemDesa["itedescodigo"], $idcon);
	          			?>
	          			<tr>
	          				<td class="NoiseDataTD cont-label-b" width="5%">&nbsp;<?php echo ($rwItemDesa['itedescodigo'])? $rwItemDesa['itedescodigo'] : '---' ; ?></td>
	          				<td class="NoiseDataTD cont-field-b" width="25%">&nbsp;<?php echo ($rwItemDesa['itedesnombre'])? $rwItemDesa['itedesnombre'] : '---' ;?></td>
	          				<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<?php echo number_format($rwItemDesa['itedesancho'], 2, ",", "."); ?></td>
	          				<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<?php echo number_format($rwItemDesa['itedescalib'], 2, ",", "."); ?></td>
	          				<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<?php echo number_format($rwItemDesa['itedesinvent'], 2, ",", ".");?></td>
	          				<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<?php echo number_format($rwPlaneaItemDesa["plaitecantid"], 2, ",", ".");?></td>
	          				<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<?php echo number_format($rwItemDesa["itedesinvent"] - $rwPlaneaItemDesa["plaitecantid"], 2, ",", ".")?></td>
	          				<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<?php echo number_format($rwItemDesa["itedescantoc"] - $rwItemDesa["itedescantec"],2, ",", "."); ?></td>
	          			</tr>
	          			<?php }?>
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