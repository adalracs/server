<?php 
ini_set("display_errors", 1);
ob_start();
		ini_set("memory_limit", "512M");
	ini_set("display_errors", 1);
	
	include "../src/FunPHPExcel/Classes/PHPExcel.php";
	require "../src/FunPHPExcel/Classes/PHPExcel/Writer/Excel5.php";

	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblcampertippro.php');
	include ( '../src/FunPerPriNiv/pktblcamperdesarr.php');
	include ( '../src/FunPerPriNiv/pktblcamperplanea.php');
	include ( '../src/FunPerPriNiv/pktblcptpdetope.php');
	include ( '../src/FunPerPriNiv/pktblcpdesadetope.php');
	include ( '../src/FunPerPriNiv/pktblcpplandetope.php');
	include ( '../src/FunPerPriNiv/pktblproducformula.php');
	include ( '../src/FunPerPriNiv/pktblproducpadreitem.php');
	include ( '../src/FunPerPriNiv/pktblproducpedido.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblop.php');
	include ( '../src/FunPerPriNiv/pktblopextrusion.php');
	include ( '../src/FunPerPriNiv/pktblopflexo.php');
	include ( '../src/FunPerPriNiv/pktbloplaminado.php');
	include ( '../src/FunPerPriNiv/pktblopcorte.php');
	include ( '../src/FunPerPriNiv/pktblopsellado.php');
	include ( '../src/FunPerPriNiv/pktbloppauchado.php');
	include ( '../src/FunPerPriNiv/pktblopdoblado.php');
	include ( '../src/FunPerPriNiv/pktblopmicroperforado.php');
	include ( '../src/FunPerPriNiv/pktbloptroquelado.php');
	include ( '../src/FunPerPriNiv/pktblopvalvulado.php');
	include ( '../src/FunPerPriNiv/pktblreporteopp.php');
	include ( '../src/FunPerPriNiv/pktblreporteoppreportepn.php');
	include ( '../src/FunPerPriNiv/pktblreporteoppdesperdiciopn.php');
	include ( '../src/FunPerPriNiv/pktbldesperdiciopn.php');
	include ( '../src/FunPerPriNiv/pktbltiposoliprog.php');
	include ( '../src/FunPerPriNiv/pktblpadreitem.php');
	include ( '../src/FunPerPriNiv/pktblitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblvistaitemplaneacion.php');
	include ( '../src/FunPerPriNiv/pktblplaneapadreitem.php');
	include ( '../src/FunPerPriNiv/pktblplaneaitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblplanearutaitempv.php');
	include ( '../src/FunPerPriNiv/pktblformulacion.php');
	include ( '../src/FunPerPriNiv/pktblprocedimiento.php');
	include ( '../src/FunPerPriNiv/pktblvistagestionsoliprog.php');
	include ( '../src/FunPerPriNiv/pktblsoliprog.php');
	include ( '../src/FunPerPriNiv/pktblgestionopp.php');
	include ( '../src/FunPerPriNiv/pktblvistasoliprog.php');
	include ( '../src/FunPerPriNiv/pktblgestionoppitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblreporteopptiempopn.php');
	include ( '../src/FunPerSecNiv/fncconn.php');
	include ( '../src/FunPerSecNiv/fncnumreg.php');
	include ( '../src/FunPerSecNiv/fncfetch.php');
	include ( '../src/FunPerSecNiv/fncsqlrun.php');
	include ( '../src/FunPerSecNiv/fncclose.php');
	include ( '../src/FunGen/cargainput.php');

ob_end_flush();
$sql="SELECT op.*,gestionoppitemdesa.*,itemdesa.*,equipo.equiponombre,procedimiento.procednombre,opestado.opestanombre FROM op
		INNER JOIN  opp ON opp.ordoppcodigo=op.ordoppcodigo
		INNER JOIN gestionopp ON gestionopp.ordoppcodigo = opp.ordoppcodigo
		INNER JOIN gestionoppitemdesa ON gestionoppitemdesa.gesoppcodigo = gestionopp.gesoppcodigo
		INNER JOIN itemdesa ON itemdesa.itedescodigo = gestionoppitemdesa.itedescodigo
		INNER JOIN equipo ON equipo.equipocodigo = op.equipocodigo
		INNER JOIN procedimiento ON procedimiento.procedcodigo = op.procedcodigo
		INNER JOIN opestado ON opestado.opestacodigo = op.opestacodigo
		WHERE ordprofecgen between '{$consulfecini}' AND '{$consulfecfin}' order by proceddestin";
$idcon = fncconn();
$rsOp = fncsqlrun($sql,$idcon);
$nrOp = fncnumreg($rsOp);
$totalcosto=0;
$flagtipoinforme=2;
$procedimiento=array();
for($a = 0;$a < $nrOp; $a++){
	$rwOP = fncfetch($rsOp,$a);
	$procedimiento[$rwOP['procednombre']]+=($rwOP['gesoppcantkg']*$rwOP['itedescosto']);
}
$cn=0;
foreach ($procedimiento as $proceso => $costo) {
	$cadenaConsoliidado.=(($cn>0)?",".$proceso.":.".$costo:$proceso.":.".$costo);
	$cn++;
}
//include("../src/FunPHPExcel/infreinventario.php");
$objPHPExcel = new PHPExcel();
$objPHPExcel->getDefaultStyle()->getFont()->setName("Tahoma");
$objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
	
	$uploaddir = '../temp/';
	$uploaddir2 = '../temp/';
	$sheet = 0;
	$styleArray = array(
		'borders' => array(
			'outline' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN,
				'color' => array('argb' => 'FF92CDDC'),
			),
		),
	);

if($sheet > 0) $objPHPExcel->createSheet();
$rcont = 0;	
?> 
<html> 
	<head> 
    	<title>Informe de inventario</title> 
    	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
    	<meta http-equiv="expires" content="0">
    	<?php include('../def/jquery.library_maestro.php');?>
    	<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
    	<script type="text/javascript">
		   swfobject.embedSWF("../src/FunChart/open-flash-chart.swf", "graph_data", "1000", "450", "9.0.0", "expressInstall.swf", {"data-file":"../src/FunChart/ofc.graph.charts/ofc.costoifoinventario.php?parameter=<?php echo $consulfecini ?>[::]<?php echo $consulfecfin ?>[::]<?php echo $cadenaConsoliidado; ?>","loading":"Escribiendo la grafica..."},false);
		</script>
		<script type="text/javascript">
			// The chart object
			function chart(name) {
				this.name = name;
			 
				this.image_saved = function(id) {
					alert('saved:' + this.name + ', id:' + id );
				};
			}
				 
			// create a new chart object
			var graph_data = new chart('chart 1');
		 
			function done(id)
			{
				alert("Finished upload. Id:"+id);
			}
		 
			function post_image(debug, chart)
			{
				url = "../src/FunChart/php-ofc-library/ofc_upload_image.php?name=" + chart + ".png";
				var ofc = findSWF(chart);
				
				x = ofc.post_image( url, 'done', debug );
			}
	
			function ofc_ready()
			{ }
			 
			function findSWF(movieName) {
				return document[movieName];
			}
	
			$(function(){
				$('#expimage').button({ icons: { primary: "ui-icon-image" } }).click(function() {
					post_image(null, 'graph_data'); 
					setTimeout("window.open('../src/FunChart/tmp-upload-images/graph_data.png','gestion_mantenimiento')",2000);
					return false;
				});
			});
		</script>
		
		<script type="text/javascript">
			$(function(){
				$('#viewinf').button({ icons: { primary: "ui-icon-image" } }).click(function() {
					if(document.getElementById('flagtipoinforme').value == 1)
						document.getElementById('flagtipoinforme').value = 2;
					else
						document.getElementById('flagtipoinforme').value = 1;
	
					document.form1.submit();
					
					return false;
				});
				
				$('#expconciliado').button({ icons: { primary: "ui-icon-image" } }).click(function() {
					<?php 	for($a = 0; $a < $nrOt; $a++): ?>
					post_image(null, 'graph_data');
					<?php 	endfor; ?>
					setTimeout("window.open('../src/FunCompress/comprimir.php?plantas=<?php echo $arrusuaplanta ?>','gestion_mantenimiento')",2000);
					return false;
				});
				
			});
		</script>
    	<style type="text/css">
    		#infinventxls{
				text-decoration: none;
				width: 70px;
				height: 8px;
				/*border: 1px solid #0A6B03;*/
				border-radius: 5px;
				color: #FFFFFF;
				font-size: 12px;
				padding: 5px;
				background: #9dd53a; /* Old browsers */
				background: -moz-linear-gradient(top, #9dd53a 0%, #a1d54f 50%, #80c217 51%, #7cbc0a 100%); /* FF3.6+ */
				background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#9dd53a), color-stop(50%,#a1d54f), color-stop(51%,#80c217), color-stop(100%,#7cbc0a)); /* Chrome,Safari4+ */
				background: -webkit-linear-gradient(top, #9dd53a 0%,#a1d54f 50%,#80c217 51%,#7cbc0a 100%); /* Chrome10+,Safari5.1+ */
				background: -o-linear-gradient(top, #9dd53a 0%,#a1d54f 50%,#80c217 51%,#7cbc0a 100%); /* Opera 11.10+ */
				background: -ms-linear-gradient(top, #9dd53a 0%,#a1d54f 50%,#80c217 51%,#7cbc0a 100%); /* IE10+ */
				background: linear-gradient(to bottom, #9dd53a 0%,#a1d54f 50%,#80c217 51%,#7cbc0a 100%); /* W3C */
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#9dd53a', endColorstr='#7cbc0a',GradientType=0 ); /* IE6-9 */
			}
			.console-buttons-float-topright { display:scroll; position:fixed; top:0px; right:0px; }
			.console-buttons-float-topleft { display:scroll; position:fixed; top:0px; left:0px; }
			.console-buttons-float-bottomleft { display:scroll; position:fixed; bottom:0px; left:0px; }
			.console-buttons-float-bottomright { display:scroll; position:fixed; bottom:0px; right:0px; }
    	</style>
  </head> 
<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Informe de inventario</font></p> 
			<?php if($flagtipoinforme==2): ?>
			<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content">
        		<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
							<tr class="ui-widget-header">
								<td colspan="12" width="50%" class="cont-title">&nbsp;Materias primas</td>
							</tr>
							<tr>
								<td class="ui-state-default" width="5%"  align="center"># OPP</td>
								<td class="ui-state-default" width="20%"  align="center">Equipo</td>
								<td class="ui-state-default" width="5%"  align="center">Estado</td>
								<td class="ui-state-default" width="20%"  align="center">Proceso</td>
								<td class="ui-state-default" width="5%"  align="center">Fecha</td>
								<td class="ui-state-default" width="5%"  align="center">Item</td>
								<td class="ui-state-default" width="20%"  align="center">Descripcion</td> 
								<td class="ui-state-default" width="5%"  align="center"><b>Cant.</b></td>
								<td class="ui-state-default" width="5%"  align="center"><b>UM</b></td>  
								<td class="ui-state-default" width="5%"  align="center"><b>Precio Unitario</b></td>
								<td class="ui-state-default" width="10%"  align="center"><b>Costo</b></td> 
							</tr>
							<?php 
								$rcont++;
								$objPHPExcel->getActiveSheet($sheet)->setCellValue('A'.$rcont,"# OPP")->getStyle('A'.$rcont)->applyFromArray($styleArray);
								$objPHPExcel->getActiveSheet($sheet)->setCellValue('B'.$rcont,"Equipo")->getStyle('B'.$rcont)->applyFromArray($styleArray);
								$objPHPExcel->getActiveSheet($sheet)->setCellValue('C'.$rcont,"Estado")->getStyle('C'.$rcont)->applyFromArray($styleArray);
								$objPHPExcel->getActiveSheet($sheet)->setCellValue('D'.$rcont,"Proceso")->getStyle('D'.$rcont)->applyFromArray($styleArray);
								$objPHPExcel->getActiveSheet($sheet)->setCellValue('E'.$rcont,"Fecha")->getStyle('E'.$rcont)->applyFromArray($styleArray);
								$objPHPExcel->getActiveSheet($sheet)->setCellValue('F'.$rcont,"Item")->getStyle('F'.$rcont)->applyFromArray($styleArray);
								$objPHPExcel->getActiveSheet($sheet)->setCellValue('G'.$rcont,"Descripcion" )->getStyle('G'.$rcont)->applyFromArray($styleArray);
								$objPHPExcel->getActiveSheet($sheet)->setCellValue('H'.$rcont,"Cant.")->getStyle('H'.$rcont)->applyFromArray($styleArray);
								$objPHPExcel->getActiveSheet($sheet)->setCellValue('I'.$rcont,"UM"  )->getStyle('I'.$rcont)->applyFromArray($styleArray);
								$objPHPExcel->getActiveSheet($sheet)->setCellValue('J'.$rcont,"Precio Unitario")->getStyle('J'.$rcont)->applyFromArray($styleArray);
								$objPHPExcel->getActiveSheet($sheet)->setCellValue('K'.$rcont,"Costo" )->getStyle('K'.$rcont)->applyFromArray($styleArray);

								$objPHPExcel->getActiveSheet()->getStyle('A1:K1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
								$objPHPExcel->getActiveSheet()->getStyle('A1:K1')->getFill()->getStartColor()->setARGB('FFC5D9F1');
								$objPHPExcel->getActiveSheet()->getStyle('A1:K1')->getFont()->getColor()->setARGB("FF1F497D");
								$objPHPExcel->getActiveSheet()->getStyle('A1:K1')->getFont()->setBold(true);
							 ?>
							<?php
								for($a = 0;$a < $nrOp; $a++)
								{
									$rwOP = fncfetch($rsOp,$a);
								    $totalcosto+=($rwOP['gesoppcantkg']*$rwOP['itedescosto']);
									($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)" ' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)" ';
								?>

									<tr <?php echo $complement ?>>
										<td class="cont-line" >&nbsp;<?php echo str_pad($rwOP['ordoppcodigo'], 4, "0", STR_PAD_LEFT); ?></td>
										<td class="cont-line">&nbsp;<?php echo $rwOP['equipocodigo'].'/'.$rwOP['equiponombre']; ?></td>
										<td class="cont-line">&nbsp;<?php echo $rwOP['opestanombre']; ?></td>
										<td class="cont-line">&nbsp;<?php echo $rwOP['procednombre']; ?></td>
										<td class="cont-line">&nbsp;<?php echo $rwOP['ordprofecgen'];?></td>
										<td class="cont-line" align="center">&nbsp;<?php echo $rwOP['itedescodigo']; ?></td>
										<td class="cont-line">&nbsp;<?php echo $rwOP['itedesnombre']; ?></td>
										<td class="cont-line">&nbsp;<?php echo number_format($rwOP['gesoppcantkg'], 2, ',', '.'); ?></td>
										<td class="cont-line">&nbsp;<?php echo $rwOP['itedesunimed']; ?></td>
										<td class="cont-line">&nbsp;<?php echo '$'.number_format($rwOP['itedescosto'], 2, ',', '.'); ?></td>
										<td class="cont-line">&nbsp;<?php echo '$'.number_format($rwOP['gesoppcantkg']*$rwOP['itedescosto'], 2, ',', '.'); ?></td>
									</tr>
									<?php 
										$rcont++; 
										$objPHPExcel->getActiveSheet($sheet)->setCellValue('A'.$rcont,str_pad($rwOP['ordoppcodigo'], 4, "0", STR_PAD_LEFT))->getStyle('A'.$rcont)->applyFromArray($styleArray);
										$objPHPExcel->getActiveSheet($sheet)->setCellValue('B'.$rcont,$rwOP['equipocodigo'].'/'.$rwOP['equiponombre'])->getStyle('B'.$rcont)->applyFromArray($styleArray);
										$objPHPExcel->getActiveSheet($sheet)->setCellValue('C'.$rcont,$rwOP['opestanombre'])->getStyle('C'.$rcont)->applyFromArray($styleArray);
										$objPHPExcel->getActiveSheet($sheet)->setCellValue('D'.$rcont,$rwOP['procednombre'])->getStyle('D'.$rcont)->applyFromArray($styleArray);
										$objPHPExcel->getActiveSheet($sheet)->setCellValue('E'.$rcont,$rwOP['ordprofecgen'])->getStyle('E'.$rcont)->applyFromArray($styleArray);
										$objPHPExcel->getActiveSheet($sheet)->setCellValue('F'.$rcont,$rwOP['itedescodigo'])->getStyle('F'.$rcont)->applyFromArray($styleArray);
										$objPHPExcel->getActiveSheet($sheet)->setCellValue('G'.$rcont, $rwOP['itedesnombre'])->getStyle('G'.$rcont)->applyFromArray($styleArray);
										$objPHPExcel->getActiveSheet($sheet)->setCellValue('H'.$rcont,number_format($rwOP['gesoppcantkg'], 2, ',', '.'))->getStyle('H'.$rcont)->applyFromArray($styleArray);
										$objPHPExcel->getActiveSheet($sheet)->setCellValue('I'.$rcont,$rwOP['itedesunimed'])->getStyle('I'.$rcont)->applyFromArray($styleArray);
										$objPHPExcel->getActiveSheet($sheet)->setCellValue('J'.$rcont,'$'.number_format($rwOP['itedescosto'], 2, ',', '.'))->getStyle('J'.$rcont)->applyFromArray($styleArray);
										$objPHPExcel->getActiveSheet($sheet)->setCellValue('K'.$rcont,'$'.number_format($rwOP['gesoppcantkg']*$rwOP['itedescosto'], 2, ',', '.'))->getStyle('K'.$rcont)->applyFromArray($styleArray);
									 ?>
								<?php } ?>
						</table>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
								<tr>
									<td class="ui-state-default" width="5%"  align="center">Total costo materia prima</td>
									<td class="ui-state-default" width="20%"  align="center"><?php echo '$'.number_format($totalcosto, 2, ',', '.') ?></td>
								</tr>
						</table>	
						<?php 
							if(file_exists($uploaddir."ADM_InfInventario.xls")){

								unlink($uploaddir."ADM_InfInventario.xls");
							}

							$objPHPExcel->getActiveSheet()->setShowGridlines(true);
							$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(85);
							$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
							$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
							$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
							$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
							$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
							$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
							$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
							$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
							$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
							$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
							$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);

							$objPHPExcel->setActiveSheetIndex(0);
							$objPHPExcel->getProperties()->setCreator("ADSUM KALLPA");
							$objPHPExcel->getProperties()->setLastModifiedBy("ADSUM KALLPA");
							$objPHPExcel->getProperties()->setTitle("Office 5 XLS Adsum Document");
							$objPHPExcel->getProperties()->setSubject("Office 5 XLS Adsum Document");
							$objPHPExcel->getProperties()->setDescription("Este documento fue generado desde el software Adsum ");
							$objPHPExcel->getProperties()->setKeywords("office php adsum kallpa");
							$objPHPExcel->getProperties()->setCategory("Export result file");
							$objWriterSinzona = new PHPExcel_Writer_Excel5($objPHPExcel);
							$objWriterSinzona->save($uploaddir.'ADM_InfInventario.xls');


							$direccion=$uploaddir2.'ADM_InfInventario.xls';
						 ?>
					</td>
				</tr>
			</table>					
		<?php endif; ?>
		<?php if($flagtipoinforme==1): ?>
		<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content">
        	<tr>
				<td>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
						<tr>
	 						<td><div id="graph_data"></div></td>  
						</tr>
					</table>	
				</td>
			</tr>
		</table>			
		<?php endif; ?>
      	<div class="console-buttons-float-topright">
			<div class="ui-widget">
				<div class="ui-state-highlight ui-corner-all" style="padding: .5em .5em;"> 
					<div class="ui-buttonset">
					<button id="viewinf"><?php if($flagtipoinforme == 1): ?>Ver detallado<?php else: ?>Ver consiliado<?php endif; ?></button>&nbsp;
						<!--<button id="expconciliado">Exportar todos como imagen</button>&nbsp;-->
						<?php if($flagtipoinforme == 2): ?><a href="<?php echo $direccion; ?>" id="infinventxls">Exportar a Excel</a>&nbsp;<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<input type="hidden" name="consulfecini" id="consulfecini" value="<?php echo $consulfecini ?>">
		<input type="hidden" name="consulfecfin" id="consulfecfin" value="<?php echo $consulfecfin ?>">
		<input type="hidden" name="flagtipoinforme" id="flagtipoinforme" value="<?php echo $flagtipoinforme ?>">
		</form> 
   		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
   		<div id="msgwindowform" title="Adsum Kallpa[Gestion MP]"><span id="msgform"></span></div>
 	</body> 
</html>