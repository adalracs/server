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
	include ( '../src/FunPerPriNiv/pktbltarifa.php');
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
	include ( '../src/FunPerPriNiv/pktblreporteoppmaterial.php');
	include ( '../src/FunPerPriNiv/pktblreporteopptiempopn.php');
	include ( '../src/FunPerPriNiv/pktblgestionoppreporte.php');
	include ( '../src/FunPerSecNiv/fncconn.php');
	include ( '../src/FunPerSecNiv/fncnumreg.php');
	include ( '../src/FunPerSecNiv/fncfetch.php');
	include ( '../src/FunPerSecNiv/fncsqlrun.php');
	include ( '../src/FunPerSecNiv/fncclose.php');
	include ( '../src/FunGen/cargainput.php');

ob_end_flush();
$sql="	SELECT opp.ordoppcodigo,cptpdetope.cptprovalor FROM op
		LEFT JOIN opp ON opp.ordoppcodigo=op.ordoppcodigo
		LEFT JOIN soliprog ON soliprog.solprocodigo=op.solprocodigo
		LEFT JOIN producto ON soliprog.produccodigo = producto.produccodigo
		LEFT JOIN tipoproduc ON producto.tipprocodigo = tipoproduc.tipprocodigo
		LEFT JOIN producpedido ON soliprog.produccodigo = producpedido.produccodigo
		left join cptpdetope on cptpdetope.produccodigo = producpedido.produccodigo and cptpdetope.cptodocodigo IN (1)
		LEFT JOIN pedidoventa ON producpedido.pedvencodigo = pedidoventa.pedvencodigo
		LEFT JOIN ordencompra ON pedidoventa.ordcomcodigo = ordencompra.ordcomcodigo
		LEFT JOIN oe ON oe.ordoppcodigo=opp.ordoppcodigo
		WHERE soliprog.solprofecha between '{$consulfecini}' AND '{$consulfecfin}' ";

		if($pedvennumero) {
			$sql.=" AND pedidoventa.pedvennumero ='".$pedvennumero."'";
		}
		if($ordoppcodigo) {
				$sql.=" AND pedidoventa.ordoppcodigo ='".$ordoppcodigo."'";
		}	
		if($ordcomrazsoc) {
				$sql.=" AND ordencompra.ordcomrazsoc ='".$ordcomrazsoc."'";
		}	
$idcon = fncconn();
$rsOp = fncsqlrun($sql,$idcon);
$nrOp = fncnumreg($rsOp);
$totalcosto=0;

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

function resta($inicio, $fin){
		return date("H:i:s", strtotime("00:00:00") + (strtotime($fin) - strtotime($inicio)));
}
?> 
<html> 
	<head> 
    	<title>Informe de inventario</title> 
    	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
    	<meta http-equiv="expires" content="0">
    	<?php include('../def/jquery.library_maestro.php');?>
    	<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
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
					$("#detallado").css("display","none");
					$("#consolidado").css("display","block");
					return false;
				});

				$('#viewdet').button({ icons: { primary: "ui-icon-image" } }).click(function() {
					$("#detallado").css("display","block");
					$("#consolidado").css("display","none");
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
			<p><font class="NoiseFormHeaderFont">Informe de gerencial</font></p> 
			<div id="detallado">
			<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content">
        		<tr>
					<td>
						<div>
							<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
								<tr class="ui-widget-header">
									<td colspan="12" width="50%" class="cont-title">&nbsp;Materias primas</td>
								</tr>
								<tr>
									<td class="ui-state-default" style="font-size:10px;" width="5%"  align="center">Codigo Mp</td>
									<td class="ui-state-default" style="font-size:10px;" width="10%"  align="center">Descripcion</td>
									<td class="ui-state-default" style="font-size:10px;" width="7%"  align="center">Cantidad Real</td>
									<td class="ui-state-default" style="font-size:10px;" width="10%"  align="center">Desperdicio</td>
									<td class="ui-state-default" style="font-size:10px;" width="10%"  align="center">Precio Unitario Mp</td>
									<td class="ui-state-default" style="font-size:10px;" width="5%"  align="center">Costo total</td>
									<td class="ui-state-default" style="font-size:10px;" width="7%"  align="center">Cantidad planeada</td> 
									<td class="ui-state-default" style="font-size:10px;" width="10%"  align="center"><b>Desviacion (planeada y real)</b></td>
								</tr>
							</table>	
						</div>
						<div style="overflow-y: scroll;height:200px;" >
							<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
							<?php 
								$rcont++;
								$objPHPExcel->getActiveSheet($sheet)->setCellValue('A'.$rcont,"Codigo Mp")->getStyle('A'.$rcont)->applyFromArray($styleArray);
								$objPHPExcel->getActiveSheet($sheet)->setCellValue('B'.$rcont,"Descripcion")->getStyle('B'.$rcont)->applyFromArray($styleArray);
								$objPHPExcel->getActiveSheet($sheet)->setCellValue('C'.$rcont,"Cantidad Real")->getStyle('C'.$rcont)->applyFromArray($styleArray);
								$objPHPExcel->getActiveSheet($sheet)->setCellValue('D'.$rcont,"Desperdicio")->getStyle('D'.$rcont)->applyFromArray($styleArray);
								$objPHPExcel->getActiveSheet($sheet)->setCellValue('E'.$rcont,"Precio Unitario Mp")->getStyle('E'.$rcont)->applyFromArray($styleArray);
								$objPHPExcel->getActiveSheet($sheet)->setCellValue('F'.$rcont,"Costo total")->getStyle('F'.$rcont)->applyFromArray($styleArray);
								$objPHPExcel->getActiveSheet($sheet)->setCellValue('G'.$rcont,"Cantidad planeada" )->getStyle('G'.$rcont)->applyFromArray($styleArray);
								$objPHPExcel->getActiveSheet($sheet)->setCellValue('H'.$rcont,"Desviacion (planeada y real)")->getStyle('H'.$rcont)->applyFromArray($styleArray);

								$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
								$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFill()->getStartColor()->setARGB('FFC5D9F1');
								$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFont()->getColor()->setARGB("FF1F497D");
								$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);
							 ?>
							<?php
								for($a = 0;$a < $nrOp; $a++)
								{
									$rwOP = fncfetch($rsOp,$a);
								    
										if($rwOP['ordoppcodigo']){
										$sql="SELECT  DISTINCT itemdesa.itedescodigo,itemdesa.itedesnombre,gestionoppreporte.gesoppcantkg,itemdesa.itedescosto,oppitemdesa.oppitecantid,sum(reporteoppdesperdiciopn.reopdecantkg) as reopdecantkg
														from opp 
														left join reporteopp ON reporteopp.ordoppcodigo=opp.ordoppcodigo
														left join reporteoppmaterial ON reporteoppmaterial.repoppcodigo=reporteopp.repoppcodigo
														left join gestionoppreporte ON gestionoppreporte.geoprecodigo=reporteoppmaterial.geoprecodigo
														left join gestionoppitemdesa ON gestionoppitemdesa.itedescodigo=gestionoppreporte.itedescodigo
														inner join itemdesa ON itemdesa.itedescodigo=gestionoppitemdesa.itedescodigo
														left  join oppitemdesa ON oppitemdesa.ordoppcodigo = opp.ordoppcodigo AND oppitemdesa.itedescodigo = itemdesa.itedescodigo
														left  join reporteoppdesperdiciopn ON reporteoppdesperdiciopn.repoppcodigo = reporteopp.repoppcodigo
														left join reporteopptiempopn on  reporteopptiempopn.repoppcodigo=reporteopp.repoppcodigo
														left join tiempopn on tiempopn.tiempocodigo = reporteopptiempopn.tiempocodigo
														WHERE  opp.ordoppcodigo = '".$rwOP['ordoppcodigo']."' 
														group by itemdesa.itedescodigo,itemdesa.itedesnombre,gestionoppreporte.gesoppcantkg,itemdesa.itedescosto,oppitemdesa.oppitecantid
														order by itemdesa.itedescodigo";
									    $precioventa += $rwOP['cptprovalor'];
										$rsMaterial=fncsqlrun($sql,$idcon);				
										$nrMaterial=fncnumreg($rsMaterial);
										for ($w=0; $w <$nrMaterial; $w++) { 
											$rwMaterial = fncfetch($rsMaterial,$w);
											($w % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)" ' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)" ';	
										    $canttotalproduci += $rwMaterial['gesoppcantkg']; 	
										    $costostotales += $rwMaterial['itedescosto']*$rwMaterial['gesoppcantkg'];		
									?>
											<tr <?php echo $complement ?>>
												<!--<td class="cont-line"  style="font-size:10px;" width="5%" >&nbsp;<?php echo $rwReporteoppmaterial['gesoppcantmt']; ?></td>-->
												<td class="cont-line"  style="font-size:10px;" width="5%"  align="center">&nbsp;<?php echo $rwMaterial['itedescodigo']; ?></td>
												<td class="cont-line"  style="font-size:10px;" width="10%" align="center">&nbsp;<?php echo $rwMaterial['itedesnombre']; ?></td>
												<td class="cont-line"  style="font-size:10px;" width="7%"  align="center">&nbsp;<?php echo $rwMaterial['gesoppcantkg']; ?></td>
												<td class="cont-line"  style="font-size:10px;" width="10%" align="center">&nbsp;<?php echo number_format($rwMaterial['reopdecantkg'], 2, ',', '.'); ?></td>
												<td class="cont-line"  style="font-size:10px;" width="10%" align="center">&nbsp;<?php echo '$'.number_format($rwMaterial['itedescosto'], 2, ',', '.'); ?></td>
												<td class="cont-line"  style="font-size:10px;" width="5%"  align="center">&nbsp;<?php echo '$'.number_format($rwMaterial['itedescosto']*$rwMaterial['gesoppcantkg'], 2, ',', '.'); ?></td>
												<td class="cont-line"  style="font-size:10px;" width="7%"  align="center">&nbsp;<?php echo number_format($rwMaterial['oppitecantid'], 2, ',', '.'); ?></td>
												<td class="cont-line"  style="font-size:10px;" width="10%" align="center">&nbsp;<?php echo number_format(($rwMaterial['oppitecantid']- $rwMaterial['gesoppcantkg']), 2, ',', '.'); ?></td>
											</tr>
											<?php 
												$rcont++;
												$objPHPExcel->getActiveSheet($sheet)->setCellValue('A'.$rcont,$rwMaterial['itedescodigo'])->getStyle('A'.$rcont)->applyFromArray($styleArray);
												$objPHPExcel->getActiveSheet($sheet)->setCellValue('B'.$rcont,$rwMaterial['itedesnombre'])->getStyle('B'.$rcont)->applyFromArray($styleArray);
												$objPHPExcel->getActiveSheet($sheet)->setCellValue('C'.$rcont,$rwMaterial['gesoppcantkg'])->getStyle('C'.$rcont)->applyFromArray($styleArray);
												$objPHPExcel->getActiveSheet($sheet)->setCellValue('D'.$rcont,number_format($rwMaterial['reopdecantkg'], 2, ',', '.'))->getStyle('D'.$rcont)->applyFromArray($styleArray);
												$objPHPExcel->getActiveSheet($sheet)->setCellValue('E'.$rcont,'$'.number_format($rwMaterial['itedescosto'], 2, ',', '.'))->getStyle('E'.$rcont)->applyFromArray($styleArray);
												$objPHPExcel->getActiveSheet($sheet)->setCellValue('F'.$rcont,'$'.number_format($rwMaterial['itedescosto']*$rwMaterial['gesoppcantkg'], 2, ',', '.'))->getStyle('F'.$rcont)->applyFromArray($styleArray);
												$objPHPExcel->getActiveSheet($sheet)->setCellValue('G'.$rcont,number_format($rwMaterial['oppitecantid'], 2, ',', '.'))->getStyle('G'.$rcont)->applyFromArray($styleArray);
												$objPHPExcel->getActiveSheet($sheet)->setCellValue('H'.$rcont,number_format(($rwMaterial['oppitecantid']- $rwMaterial['gesoppcantkg']), 2, ',', '.'))->getStyle('H'.$rcont)->applyFromArray($styleArray);
											?>
										<?php }?>
									<?php }?>
						
								<?php } ?>
							</table>
						</div>
						<br>
						<div>
							<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
								<tr class="ui-widget-header">
									<td colspan="12" width="50%" class="cont-title">&nbsp;MOD Y CIF</td>
								</tr>
								<tr>
									<td class="ui-state-default" style="font-size:10px;" width="5%"  align="center">Proceso</td>
									<td class="ui-state-default" style="font-size:10px;" width="10%"  align="center">Horas Totales</td>
									<td class="ui-state-default" style="font-size:10px;" width="7%"  align="center">Mano de obra Directa</td>
									<td class="ui-state-default" style="font-size:10px;" width="10%"  align="center">Mano de obra indirecta</td>
									<td class="ui-state-default" style="font-size:10px;" width="7%"  align="center">Energia</td>
									<td class="ui-state-default" style="font-size:10px;" width="5%"  align="center">Mantenimiento</td>
									<td class="ui-state-default" style="font-size:10px;" width="7%"  align="center">Depreciacion</td> 
									<td class="ui-state-default" style="font-size:10px;" width="10%"  align="center"><b>Otros</b></td>
								</tr>			
							    <?php 
									$rcont++;
									$objPHPExcel->getActiveSheet($sheet)->setCellValue('A'.$rcont,"Proceso")->getStyle('A'.$rcont)->applyFromArray($styleArray);
									$objPHPExcel->getActiveSheet($sheet)->setCellValue('B'.$rcont,"Horas Totales")->getStyle('B'.$rcont)->applyFromArray($styleArray);
									$objPHPExcel->getActiveSheet($sheet)->setCellValue('C'.$rcont,"Mano de obra Directa")->getStyle('C'.$rcont)->applyFromArray($styleArray);
									$objPHPExcel->getActiveSheet($sheet)->setCellValue('D'.$rcont,"Mano de obra indirecta")->getStyle('D'.$rcont)->applyFromArray($styleArray);
									$objPHPExcel->getActiveSheet($sheet)->setCellValue('E'.$rcont,"Energia")->getStyle('E'.$rcont)->applyFromArray($styleArray);
									$objPHPExcel->getActiveSheet($sheet)->setCellValue('F'.$rcont,"Mantenimiento")->getStyle('F'.$rcont)->applyFromArray($styleArray);
									$objPHPExcel->getActiveSheet($sheet)->setCellValue('G'.$rcont,"Depreciacion" )->getStyle('G'.$rcont)->applyFromArray($styleArray);
									$objPHPExcel->getActiveSheet($sheet)->setCellValue('H'.$rcont,"Otros" )->getStyle('H'.$rcont)->applyFromArray($styleArray);

									$objPHPExcel->getActiveSheet()->getStyle('A'.$rcont.':H'.$rcont)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
									$objPHPExcel->getActiveSheet()->getStyle('A'.$rcont.':H'.$rcont)->getFill()->getStartColor()->setARGB('FFC5D9F1');
									$objPHPExcel->getActiveSheet()->getStyle('A'.$rcont.':H'.$rcont)->getFont()->getColor()->setARGB("FF1F497D");
									$objPHPExcel->getActiveSheet()->getStyle('A'.$rcont.':H'.$rcont)->getFont()->setBold(true);
							 	?>
							</table>	
						</div>
						<div style="overflow-y: scroll;height:200px;" >
							<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
								<?php 
									for($a = 0;$a < $nrOp; $a++)
									{
										$rwOP = fncfetch($rsOp,$a);
										if($rwOP['ordoppcodigo']){
											$sql="SELECT DISTINCT vistaoppcosto.ordoppcodigo,vistaoppcosto.producnombre,vistaoppcosto.equipocodigo,vistaoppcosto.ordprofecgen,vistaoppcosto.equiponombre,reporteopptiempopn.reoptihorfin as horfin,reporteopptiempopn.reoptihorini as horini,vistaoppcosto.tipsolcodigo,reporteopp.repoppfecha
																	from vistaoppcosto
																	inner join reporteopp on reporteopp.ordoppcodigo=vistaoppcosto.ordoppcodigo
																	inner join reporteopptiempopn on  reporteopptiempopn.repoppcodigo=reporteopp.repoppcodigo
																	inner join tiempopn on tiempopn.tiempocodigo = reporteopptiempopn.tiempocodigo
																	where vistaoppcosto.ordprofecgen BETWEEN '".$consulfecini."' AND '".$consulfecfin."' 
																	AND vistaoppcosto.ordoppcodigo = '".$rwOP['ordoppcodigo']."'";

												$rsManoobra=fncsqlrun($sql,$idcon);				
												$nrManoobra=fncnumreg($rsManoobra);
										}
										for ($i=0; $i < $nrManoobra; $i++) { 
										
											$rwManoobra = fncfetch($rsManoobra,$i);

										 	$diferencia = resta($rwManoobra["horini"],$rwManoobra["horfin"]); 
											$tiem = explode(":", $diferencia);
											$hor=$tiem[0]*1;
											$min=$tiem[1]/60;
											$tiempo=$hor+$min;
											$tiempo=round($tiempo,2);
											$totaltiempo+=$tiempo;
											
											$procesogasto[$rwManoobra['tipsolcodigo']]+=$tiempo;
										}
									}
								if ($procesogasto){
									foreach ($procesogasto as $idtiposol => $value) {																	  
									  	$tarifa = loadrecordtarifaultimo($idtiposol,$idcon);
									  	$proceso = loadrecordtiposoliprog($idtiposol,$idcon);
									  	$d++;
									  	($d % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)" ' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)" ';	

									  	$toltarifamod+=$value*$tarifa['tarifamod'];
									  	$toltarifamoi+=$tarifa['tarifamoi'];
									  	$toltarifaene+=$tarifa['tarifaene'];
									  	$toltarifaman+=$tarifa['tarifaman'];
									  	$toltarifasdep+=$tarifa['tarifasdep'];
									  	$toltarifaotros+=$tarifa['tarifaotros'];
									  	$horas+=$value;

										  
								 ?>
								<tr <?php echo $complement ?>>
									<td class="cont-line"  style="font-size:10px;" width="5%"  align="left">&nbsp;<?php echo $proceso['tipsoldescri']; ?></td>
									<td class="cont-line"  style="font-size:10px;" width="5%"  align="left">&nbsp;<?php echo number_format($value, 2, ',', '.'); ?></td>
									<td class="cont-line"  style="font-size:10px;" width="5%"  align="left">&nbsp;<?php echo '$'.number_format($value*$tarifa['tarifamod'], 2, ',', '.'); ?></td>
									<td class="cont-line"  style="font-size:10px;" width="5%"  align="left">&nbsp;<?php echo '$'.number_format($tarifa['tarifamoi'], 2, ',', '.'); ?></td>
									<td class="cont-line"  style="font-size:10px;" width="5%"  align="left">&nbsp;<?php echo '$'.number_format($tarifa['tarifaene'], 2, ',', '.'); ?></td>
									<td class="cont-line"  style="font-size:10px;" width="5%"  align="left">&nbsp;<?php echo '$'.number_format($tarifa['tarifaman'], 2, ',', '.'); ?></td>
									<td class="cont-line"  style="font-size:10px;" width="5%"  align="left">&nbsp;<?php echo '$'.number_format($tarifa['tarifasdep'], 2, ',', '.'); ?></td>
									<td class="cont-line"  style="font-size:10px;" width="5%"  align="left">&nbsp;<?php echo '$'.number_format($tarifa['tarifaotros'], 2, ',', '.'); ?></td>
								</tr>
								<?php 
									$rcont++;
									$objPHPExcel->getActiveSheet($sheet)->setCellValue('A'.$rcont,$proceso['tipsoldescri'])->getStyle('A'.$rcont)->applyFromArray($styleArray);
									$objPHPExcel->getActiveSheet($sheet)->setCellValue('B'.$rcont,'$'.number_format($value, 2, ',', '.'))->getStyle('B'.$rcont)->applyFromArray($styleArray);
									$objPHPExcel->getActiveSheet($sheet)->setCellValue('C'.$rcont,'$'.number_format($value*$tarifa['tarifamod'], 2, ',', '.'))->getStyle('C'.$rcont)->applyFromArray($styleArray);
									$objPHPExcel->getActiveSheet($sheet)->setCellValue('D'.$rcont,'$'.number_format($tarifa['tarifamoi'], 2, ',', '.'))->getStyle('D'.$rcont)->applyFromArray($styleArray);
									$objPHPExcel->getActiveSheet($sheet)->setCellValue('E'.$rcont,'$'.number_format($tarifa['tarifaene'], 2, ',', '.'))->getStyle('E'.$rcont)->applyFromArray($styleArray);
									$objPHPExcel->getActiveSheet($sheet)->setCellValue('F'.$rcont,'$'.number_format($tarifa['tarifaman'], 2, ',', '.'))->getStyle('F'.$rcont)->applyFromArray($styleArray);
									$objPHPExcel->getActiveSheet($sheet)->setCellValue('G'.$rcont,'$'.number_format($tarifa['tarifasdep'], 2, ',', '.'))->getStyle('G'.$rcont)->applyFromArray($styleArray);
									$objPHPExcel->getActiveSheet($sheet)->setCellValue('H'.$rcont,'$'.number_format($tarifa['tarifaotros'], 2, ',', '.'))->getStyle('H'.$rcont)->applyFromArray($styleArray);
								?>
								<?php } 
								}?>
								<tr >
									<td class="ui-state-default"  style="font-size:10px;" width="5%"  align="left">&nbsp;Total</td>
									<td class="ui-state-default"  style="font-size:10px;" width="5%"  align="left">&nbsp;<?php echo number_format($horas, 2, ',', '.'); ?></td>
									<td class="ui-state-default"  style="font-size:10px;" width="5%"  align="left">&nbsp;<?php echo '$'.number_format($toltarifamod, 2, ',', '.'); ?></td>
									<td class="ui-state-default"  style="font-size:10px;" width="5%"  align="left">&nbsp;<?php echo '$'.number_format($toltarifamoi, 2, ',', '.'); ?></td>
									<td class="ui-state-default"  style="font-size:10px;" width="5%"  align="left">&nbsp;<?php echo '$'.number_format($toltarifaene, 2, ',', '.'); ?></td>
									<td class="ui-state-default"  style="font-size:10px;" width="5%"  align="left">&nbsp;<?php echo '$'.number_format($toltarifaman, 2, ',', '.'); ?></td>
									<td class="ui-state-default"  style="font-size:10px;" width="5%"  align="left">&nbsp;<?php echo '$'.number_format($toltarifasdep, 2, ',', '.'); ?></td>
									<td class="ui-state-default"  style="font-size:10px;" width="5%"  align="left">&nbsp;<?php echo '$'.number_format($toltarifaotros, 2, ',', '.'); ?></td>
								</tr>
								<?php $gastosfabrica=$toltarifamod+$toltarifamoi+$toltarifaene+$toltarifaman+$toltarifasdep+$toltarifaotros; ?>
							</table>
						</div>

						<br>

						<div>
							<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
								<tr class="ui-widget-header">
									<td colspan="12" width="50%" class="cont-title">&nbsp;Resumen</td>
								</tr>
								<tr>
									<td class="ui-state-default" style="font-size:10px;" width="30%" >Cantidad total Producida</td> 
									<td class="cont-line"  style="font-size:10px;" width="70%"  class="NoiseDataTD" >&nbsp;<?php echo number_format($canttotalproduci, 2, ',', '.'); ?></td>
								</tr>
								<tr>
									<td class="ui-state-default" style="font-size:10px;" width="30%"  >Costo Total</td> 
									<td class="cont-line"  style="font-size:10px;" width="70%"  class="NoiseDataTD" >&nbsp;<?php echo '$'.number_format($costostotales+$gastosfabrica, 2, ',', '.'); ?></td>
								</tr>
								<tr>
									<td class="ui-state-default" style="font-size:10px;" width="30%" >Gastos Fabrica</td> 
									<td class="cont-line"  style="font-size:10px;" width="70%"  class="NoiseDataTD" >&nbsp;<?php echo '$'.number_format($gastosfabrica, 2, ',', '.'); ?></td>
								</tr>
								<tr>
									<td class="ui-state-default" style="font-size:10px;" width="30%"  >Precio de  Venta</td> 
									<td class="cont-line"  style="font-size:10px;" width="70%"  class="NoiseDataTD" >&nbsp;<?php echo '$'.number_format($precioventa, 2, ',', '.'); ?></td>
								</tr>
								<tr>
									<td class="ui-state-default" style="font-size:10px;" width="30%"  >Cantidad Entregados</td> 
									<td class="cont-line"  style="font-size:10px;" width="70%"  class="NoiseDataTD" >&nbsp;<?php echo number_format($canttotalproduci, 2, ',', '.'); ?></td>
								</tr>
								<tr>
									<td class="ui-state-default" style="font-size:10px;" width="30%" >Cantidad pendientes</td> 
									<td class="cont-line"  style="font-size:10px;" width="70%"  class="NoiseDataTD" >&nbsp;<?php echo number_format($canttotalproduci, 2, ',', '.'); ?></td>
								</tr>
								<tr>
									<td class="ui-state-default" style="font-size:10px;" width="30%" >Margen Bruto sin Depreciaci&oacute;n</td> 
									<td class="cont-line"  style="font-size:10px;" width="70%"  class="NoiseDataTD" >&nbsp;<?php echo '$'.number_format($margensinbsepre, 2, ',', '.'); ?></td>
								</tr>
								<tr>
									<td class="ui-state-default" style="font-size:10px;" width="30%"  >Margen Bruto con Depreciaci&oacute;n</td> 
									<td class="cont-line"  style="font-size:10px;" width="70%"  class="NoiseDataTD" >&nbsp;<?php echo '$'.number_format($margenconbsepre, 2, ',', '.'); ?></td>
								</tr>
							</table>	
						</div>
						<?php 	
								$rcont++;
								$objPHPExcel->getActiveSheet()->getStyle('A'.($rcont).':A'.($rcont+7))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
								$objPHPExcel->getActiveSheet()->getStyle('A'.($rcont).':A'.($rcont+7))->getFill()->getStartColor()->setARGB('FFC5D9F1');
								$objPHPExcel->getActiveSheet()->getStyle('A'.($rcont).':A'.($rcont+7))->getFont()->getColor()->setARGB("FF1F497D");
								$objPHPExcel->getActiveSheet()->getStyle('A'.($rcont).':A'.($rcont+7))->getFont()->setBold(true);

								
								$objPHPExcel->getActiveSheet($sheet)->setCellValue('A'.$rcont,"Cantidad total Producida")->getStyle('A'.$rcont)->applyFromArray($styleArray);
								$objPHPExcel->getActiveSheet($sheet)->setCellValue('B'.$rcont,'$'.number_format($canttotalproduci, 2, ',', '.'))->getStyle('B'.$rcont)->applyFromArray($styleArray);
								$rcont++;
								$objPHPExcel->getActiveSheet($sheet)->setCellValue('A'.$rcont,"Costo Total")->getStyle('A'.$rcont)->applyFromArray($styleArray);
								$objPHPExcel->getActiveSheet($sheet)->setCellValue('B'.$rcont,'$'.number_format($costostotales+$gastosfabrica, 2, ',', '.'))->getStyle('B'.$rcont)->applyFromArray($styleArray);
								$rcont++;
								$objPHPExcel->getActiveSheet($sheet)->setCellValue('A'.$rcont,"Gastos Fabrica")->getStyle('A'.$rcont)->applyFromArray($styleArray);
								$objPHPExcel->getActiveSheet($sheet)->setCellValue('B'.$rcont,'$'.number_format($gastosfabrica, 2, ',', '.'))->getStyle('B'.$rcont)->applyFromArray($styleArray);
								$rcont++;
								$objPHPExcel->getActiveSheet($sheet)->setCellValue('A'.$rcont,"Precio de  Venta")->getStyle('A'.$rcont)->applyFromArray($styleArray);
								$objPHPExcel->getActiveSheet($sheet)->setCellValue('B'.$rcont,'$'.number_format($precioventa, 2, ',', '.'))->getStyle('B'.$rcont)->applyFromArray($styleArray);
								$rcont++;
								$objPHPExcel->getActiveSheet($sheet)->setCellValue('A'.$rcont,"Cantidad Entregados")->getStyle('A'.$rcont)->applyFromArray($styleArray);
								$objPHPExcel->getActiveSheet($sheet)->setCellValue('B'.$rcont,'$'.number_format(0, 2, ',', '.'))->getStyle('B'.$rcont)->applyFromArray($styleArray);
								$rcont++;
								$objPHPExcel->getActiveSheet($sheet)->setCellValue('A'.$rcont,"Cantidad pendientes")->getStyle('A'.$rcont)->applyFromArray($styleArray);
								$objPHPExcel->getActiveSheet($sheet)->setCellValue('B'.$rcont,'$'.number_format(0, 2, ',', '.'))->getStyle('B'.$rcont)->applyFromArray($styleArray);
								$rcont++;
								$objPHPExcel->getActiveSheet($sheet)->setCellValue('A'.$rcont,"Margen Bruto sin Depreciacion")->getStyle('A'.$rcont)->applyFromArray($styleArray);
								$objPHPExcel->getActiveSheet($sheet)->setCellValue('B'.$rcont,'$'.number_format(0, 2, ',', '.'))->getStyle('B'.$rcont)->applyFromArray($styleArray);
								$rcont++;
								$objPHPExcel->getActiveSheet($sheet)->setCellValue('A'.$rcont,"Margen Bruto con Depreciacion")->getStyle('A'.$rcont)->applyFromArray($styleArray);
								$objPHPExcel->getActiveSheet($sheet)->setCellValue('B'.$rcont,'$'.number_format(0, 2, ',', '.'))->getStyle('B'.$rcont)->applyFromArray($styleArray);
								
							if(file_exists($uploaddir."ADM_InfGerencial.xls")){

								unlink($uploaddir."ADM_InfGerencial.xls");
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
							$objWriterSinzona->save($uploaddir.'ADM_InfGerencial.xls');


							$direccion=$uploaddir2.'ADM_InfGerencial.xls';
						 ?>
					</td>
				</tr>
		</table>					
		</div>
		<div id="consolidado" style="display:none">
			<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content">
				<script type="text/javascript">
			   		swfobject.embedSWF("../src/FunChart/open-flash-chart.swf", "graph_data", "1000", "450", "9.0.0", "expressInstall.swf", {"data-file":"../src/FunChart/ofc.graph.charts/ofc.costoifogerencial.php?parameter=<?php echo $consulfecini ?>[::]<?php echo $consulfecfin ?>[::]<?php echo $canttotalproduci ?>[::]<?php echo $costostotales ?>[::]<?php echo $gastosfabrica ?>[::]<?php echo $precioventa ?>","loading":"Escribiendo la grafica..."},false);
				</script>
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
		</div>
      	<div class="console-buttons-float-topright">
			<div class="ui-widget">
				<div class="ui-state-highlight ui-corner-all" style="padding: .5em .5em;"> 
					<div class="ui-buttonset">
						<button type="button" id="viewinf">Ver consolidado</button>&nbsp;
						<button type="button" id="viewdet" >Ver detallado</button>&nbsp;
						<a href="<?php echo $direccion; ?>"  id="infinventxls">Exportar a Excel</a>&nbsp;
					</div>
				</div>
			</div>
		</div>
		<input type="hidden" name="consulfecini" id="consulfecini" value="<?php echo $consulfecini ?>">
		<input type="hidden" name="consulfecfin" id="consulfecfin" value="<?php echo $consulfecfin ?>">
		<input type="hidden" name="arrmodcif" id="arrmodcif" value="<?php echo $arrmodcif ?>">
		<input type="hidden" name="flagtipoinforme" id="flagtipoinforme" value="<?php echo $flagtipoinforme ?>">
		</form> 
   		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
   		<div id="msgwindowform" title="Adsum Kallpa[Gestion MP]"><span id="msgform"></span></div>
 	</body> 
</html>