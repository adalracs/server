<?php
	ini_set("display_errors", 1);

	include("../src/FunGen/sesion/fncvalsesion.php");
	include("../src/FunPerPriNiv/pktblusuario.php");
	include("../src/FunPerSecNiv/fncsqlrun.php");
	include("../src/FunPerSecNiv/fncnumreg.php");
	include("../src/FunPerSecNiv/fncfetchall.php");
	include("../src/FunPerSecNiv/fncfetch.php");
	include("../src/FunGen/cargainput.php");
	
	$idcon = fncconn();
	$nombre = cargausuanombre($usuacodi,$idcon);
	
	$sbSql = "SELECT 
				producto.produccoduno, producto.producnombre, formula.formulnumero, formula.formulnombre,
				producformula.proforanilox, producformula.proforgrupo, producformula.proforindice
			FROM producformula 
			LEFT JOIN producto ON producformula.produccodigo = producto.produccodigo
			LEFT JOIN formula ON producformula.formulcodigo = formula.formulcodigo";
	
	$sbSql .= " WHERE producto.producfecha BETWEEN '{$producfechaini}' AND '{$producfechafin}' ";
	$sbSql .= " AND producto.producdelrec = 1 ORDER BY producto.produccodigo,producformula.proforindice ";
	
	$rsFormula = fncsqlrun($sbSql, $idcon);
	$nrFormula = fncnumreg($rsFormula);
?>
<html>
	<head>
		<title>Reporte formulas de tintas</title>
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

				$('#expexcel').button({ icons: { primary: "ui-icon-calculator" } }).click(function() {
					
					$.ajax({	   
						dataType: "html",
						type: "POST",
						url: "../src/FunPHPExcel/infrepformula.php",
						data: {"usuacodigog" : $("#usuacodigog").val(), "producfechaini" : $("#producfechaini").val(), "producfechafin" : $("#producfechafin").val()},
						beforeSend: function(data){ 
							$("#msgwindow").dialog("open");
							$("#msg").html("Espere mientras se carga el archivo xls...");
						},
						success: function(requestData){
							$("#msgwindow").dialog("close");
							window.open('../temp/ADM_InfFormula.xls','Contratistas');
						},         
						error: function(requestData, strError, strTipoError){},
						complete: function(requestData, exito){ }                                      
					});

					
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
			<!--<button id="exportar">Exportar excel</button>-->
			<button id="imprimir">Imprimir</button>
			<button id="expexcel">Exportar a Excel</button>&nbsp;
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
										<td align="center" colspan="3"><b>LISTA DE FORMULAS</b></td>
									</tr>
									<tr>
										<td align="right" width="30%"><b>FECHA:</b></td>
										<td align="right" width="50%"><?php echo date('Y/m/d') ?></td>
										<td rowspan="4" width="20%">&nbsp;</td>
									</tr>
									<tr>
										<td align="right"><b>USUARIO:</b></td>
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
	          				<td class="NoiseFooterTD cont-label-b" colspan="11">&nbsp;<b>NUMERO ENCONTRADOS (<?php echo $nrFormula ?> )</b></td>
	          			</tr>
	          			<tr>
	          				<td class="NoiseFooterTD cont-label-b" width="10%">&nbsp;ITEM.</td>
	          				<td class="NoiseFooterTD cont-field-b" width="30%">&nbsp;REFERENCIA.</td>
	          				<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;COD COLOR.</td>
	          				<td class="NoiseFooterTD cont-field-b" width="20%">&nbsp;COLOR</td>
	          				<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;ANILOX</td>
	          				<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;GRUPO</td>
	          				<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;INDICE</td>
	          			</tr>
	          			<?php 
							for($a = 0; $a < $nrFormula; $a++)
							{
								$rwFormula = fncfetch($rsFormula, $a);
	          			?>
	          			<tr>
	          				<td class="NoiseDataTD cont-label-b" width="10%">&nbsp;<?php echo ($rwFormula['produccoduno'])? $rwFormula['produccoduno'] : '---' ; ?></td>
	          				<td class="NoiseDataTD cont-field-b" width="30%">&nbsp;<?php echo ($rwFormula['producnombre'])? $rwFormula['producnombre'] : '---' ;?></td>
	          				<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<?php echo ($rwFormula['formulnumero'])? $rwFormula['formulnumero'] : '---' ;?></td>
	          				<td class="NoiseDataTD cont-field-b" width="20%">&nbsp;<?php echo ($rwFormula['formulnombre'])? $rwFormula['formulnombre'] : '---' ;?></td>
	          				<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<?php echo ($rwFormula['proforanilox'])? $rwFormula['proforanilox'] : '---' ;?></td>
	          				<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<?php echo ($rwFormula['proforgrupo'])? $rwFormula['proforgrupo'] : '---' ;?></td>
	          				<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<?php echo ($rwFormula['proforindice'])? $rwFormula['proforindice'] : '---' ;?></td>
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
			<input type="hidden" name="usuacodigog" id="usuacodigog" value="<?php echo $usuacodi; ?>">
			<input type="hidden" name="producfechaini" id="producfechaini" value="<?php echo $producfechaini; ?>">
			<input type="hidden" name="producfechafin" id="producfechafin" value="<?php echo $producfechafin; ?>">
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>	
	</body>
</html>