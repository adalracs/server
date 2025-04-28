<?php 
ob_start();
ini_set('display_errors',1);
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunGen/fncnumprox.php');
	include ( '../src/FunGen/cargainput.php');
	include ( '../src/FunGen/fncnumact.php');
	include ( '../src/FunGen/floadtimehours.php');
	include ( '../src/FunGen/floadtimeminut.php');
	include ( '../src/FunPerSecNiv/fncsqlrun.php');
	include ( '../src/FunPerPriNiv/pktblop.php');
	include ( '../src/FunPerPriNiv/pktblopp.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblopflexo.php');
	include ( '../src/FunPerPriNiv/pktblopcorte.php');
	include ( '../src/FunPerPriNiv/pktblitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblproducto.php');
	include ( '../src/FunPerPriNiv/pktblpadreitem.php');
	include ( '../src/FunPerPriNiv/pktbloplaminado.php');	
	include ( '../src/FunPerPriNiv/pktblformulacion.php');
	include ( '../src/FunPerPriNiv/pktblopextrusion.php');
	include ( '../src/FunPerPriNiv/pktblprocedimiento.php');
	include ( '../src/FunPerPriNiv/pktblprogramaflexo.php');
	include ( '../src/FunPerPriNiv/pktblprogramacorte.php');
	include ( '../src/FunPerPriNiv/pktblprogramalaminado.php');
	include ( '../src/FunPerPriNiv/pktblprogramaextrusion.php');	
	
	$idcon = fncconn();
ob_end_flush();
?>
<html>
	<head>
		<title>Programacion de produccion</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.ui.ajax_accionextras.js"></script>
		<script type="text/javascript">
			$(function(){
				//tab's para la bandeja general de corte
				$("#programacionproduccion").tabs({
					ajaxOptions: {
						error: function(xhr, status, index, anchor) {
							$(anchor.hash).html("No se puede cargar esta pesta&ntilde;a. Vamos a tratar de solucionar este problema lo m&aacute;s pronto posible.");
						}
					}
				});
			});
		</script>
	</head>
	<?php if(!$codigo){echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
<!-- 	CONTENIDO GENERAL -->
		<div style="padding: 6px;">
			<br>
			<div class="contenido-general-inf">
			
			
			<!-- 	TITULO -->
				<br>
	 			<div class="ui-widget-content">
	          		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
						<tr class="ui-widget-header">
	          				<td>&nbsp;<b>PROGRAMACION DE PRODUCCION</b></td>
	          				<td>&nbsp;<b>OPP : ORDEN DE PRODUCCION PROGRAMADA </b></td>
	          				<td>&nbsp;<b>OP : ORDEN DE PRODUCCION </b></td>
	         			</tr>
	         			<tr>
	         				<td align="right" colspan="3" class="borde-cell"><p><img src="../img/adsumcuasipequeno.jpg"><br><b><small>NIT 890307885-1</small></b></p></td>
	         			</tr>
	         		</table>
	         	</div>
	         <!-- 	FIN TITULO -->
	         
<?php $EXTRUSION = 1;if($EXTRUSION > 0){?>	         
<!-- EXTRUSION -->        
	         <!-- 	SUBTITULO INFORMATIVO -->
				<br>
				<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
					<tr>
						<td width="40%">
							<div class="ui-widget-content">
								<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
									<tr>
										<td class="ui-widget-header" width="30%">&nbsp;<b>SISTEMA:</b></td>
										<td class="ui-state-default" width="70%">&nbsp;EXTRUSION</td>
									</tr>
									<tr class="ui-widget-header">
										<td class="ui-widget-header" width="30%">&nbsp;<b>FECHA:</b></td>
										<td class="ui-state-default" width="70%">&nbsp;<?php echo date('Y/m/d') ?></td>
									</tr>
								</table>
							</div>
						</td>
						<td align="right" width="60%" class="borde-cell">&nbsp;</td>
					</tr>
				</table>
			</div>
			<br>
			<!-- 	FIN SUBTITULO INFORMATIVO -->
			
			<!-- 	CONTENIDO -->
			<div class="ui-widget-content contenido-general-inf">
	          	<?php 
	          		$rsExtrusionEqu = fullscanprogramaextrusionequipos($idcon,1);
	          		$nrExtrusionEqu = fncnumreg($rsExtrusionEqu);
	          		//VARIBLES PARA LOS ORDENES DE PRODUCCION PROGRAMADAS {OPP}
	          		$UNDEXTRUSION = 0;
					$KGSEXTRUSION = 0;
					$MTSEXTRUSION = 0;
					$OPPEXTRUSION = 0;
					//se emite mensaje sin ordenes en programa
					if(!$nrExtrusionEqu)
					{
				?>
				<div class="ui-widget">
	 				<div style="margin-top: 1px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all"> 
  						<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
  						<b>No se encontraron OPP.</b></p>
 					</div>
				</div>
				<?php 
					}
	          		for($a = 0; $a < $nrExtrusionEqu; $a++)
	          		{
	          			$rwExtrusionEqu = fncfetch($rsExtrusionEqu,$a);
	          	?>
	          	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
					<tr class="ui-widget-header">
						<td colspan="10">&nbsp;<b><?php echo cargaequiponombre($rwExtrusionEqu['equipocodigo'],$idcon) ?></b></td>
					</tr>
					<tr>
	          			<td class="NoiseFooterTD cont-field-b" width="5%">&nbsp;OE&nbsp;</td>
	          			<td class="NoiseFooterTD cont-field-b" width="5%">&nbsp;<b># OPP</b>&nbsp;</td>
	          			<td class="NoiseFooterTD cont-field-b" width="5%">&nbsp;<b>MEZCLA</b>&nbsp;</td>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;ANCHO&nbsp;<b>(mm)</b>&nbsp;</td>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;ANCHO C&nbsp;<b>(mm)</b>&nbsp;</td>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;PISTAS&nbsp;<b>(mm)</b>&nbsp;</td>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;CALIBRE&nbsp;<b>(um)</b>&nbsp;</td>
	          			<td class="NoiseFooterTD cont-field-b" width="25%">&nbsp;ITEM PR&nbsp;<b>(mts)</b>&nbsp;</td>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;KILOS&nbsp;</td>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;METROS&nbsp;</td>	          			
	         		</tr>
	          	<?php 
	          			$rsExtrusion = dinamicscanopprogramaextrusion(array('equipocodigo' => $rwExtrusionEqu['equipocodigo']),array('equipocodigo' => '='),$idcon);
	          			$nrExtrusion = fncnumreg($rsExtrusion);
	          			for($b = 0; $b < $nrExtrusion; $b++)
	           			{
	           				unset($FORMULAEXTRUSION,$CORTEEXTRUSION,$PISTASEXTRUSION,$CALIBREEXTRUSION,$ITEMPRODUCCION,$PEDIDOPRODUCCION,$CLIENTEPRODUCCION,$DESTINOPRODUCCION);
	          				$rwExtrusion = fncfetch($rsExtrusion, $b);
	          				//VARIBLES PARA LOS ORDENES DE PRODUCCION PROGRAMADAS {OPP}
	          				$UNDEXTRUSION++;
							$KGSEXTRUSION = $KGSEXTRUSION + $rwExtrusion['ordoppcantkg'];
							$MTSEXTRUSION = $MTSEXTRUSION + $rwExtrusion['ordoppcantmt'];
							$OPPEXTRUSION = $rwExtrusion['ordoppcodigo'];
							if($OPPEXTRUSION > 0)
	         				{
	         					$rsOpextrusion = dinamicscanopopextrusion(array('ordoppcodigo' =>$OPPEXTRUSION),array('ordoppcodigo' => '='),$idcon);
								$nrOpextrusion = fncnumreg($rsOpextrusion);
								//VARIBLES PARA LOS ORDENES DE PRODUCCION {OP}
								$CORTEEXTRUSION = '';
								$PISTASEXTRUSION = '';
								for($c = 0; $c < $nrOpextrusion; $c++)
								{
									$rwOpextrusion = fncfetch($rsOpextrusion, $c);
									$FORMULAEXTRUSION = ($rwOpextrusion['formulnumero'])? $rwOpextrusion['formulnumero'] : '---' ;
									$CALIBREEXTRUSION = ($rwOpextrusion['ordprocalibr'])? $rwOpextrusion['ordprocalibr'] : '---' ;
									if($rwOpextrusion['itedescodigo']) $ITEMPRODUCCION = ($ITEMPRODUCCION)? $ITEMPRODUCCION.' | '.$rwOpextrusion['itedescodigo'] : $rwOpextrusion['itedescodigo'] ;
									if($rwOpextrusion['pedvennumero']) $PEDIDOPRODUCCION = ($PEDIDOPRODUCCION)? $PEDIDOPRODUCCION.'<br>&nbsp;'.$rwOpextrusion['pedvennumero'] : $rwOpextrusion['pedvennumero'] ;
									if($rwOpextrusion['ordcomrazsoc']) $CLIENTEPRODUCCION = ($CLIENTEPRODUCCION)? $CLIENTEPRODUCCION.'<br>&nbsp;'.$rwOpextrusion['ordcomrazsoc'] : $rwOpextrusion['ordcomrazsoc'] ;
									if($rwOpextrusion['producnombre']) $REFPRODUCCION = ($REFPRODUCCION)? $REFPRODUCCION.'<br>&nbsp;'.$rwOpextrusion['producnombre'] : $rwOpextrusion['producnombre'] ;
									if($rwOpextrusion['procednombre']) $DESTINOPRODUCCION = ($DESTINOPRODUCCION)? $DESTINOPRODUCCION.'<br>&nbsp;'.strtoupper($rwOpextrusion['procednombre']) : strtoupper($rwOpextrusion['procednombre']) ;									
									if($rwOpextrusion['ordproancext'] && $rwOpextrusion['ordpropistae']) 
									{
										$CORTEEXTRUSION = ($CORTEEXTRUSION)? $CORTEEXTRUSION.' | '.($rwOpextrusion['ordpropistae'] * $rwOpextrusion['ordproancext']) : ($rwOpextrusion['ordpropistae'] * $rwOpextrusion['ordproancext']);
										$PISTASEXTRUSION = ($PISTASEXTRUSION)? $PISTASEXTRUSION.' | '.$rwOpextrusion['ordpropistae'].' * '.$rwOpextrusion['ordproancext'] : $rwOpextrusion['ordpropistae'].' * '.$rwOpextrusion['ordproancext'] ;
									}
								}
	         				}	          		
	          	?>
					<tr>
	          			<td class="NoiseDataTD cont-field-b" width="5%">&nbsp;<font color="#000080"><b><?php echo str_pad( ($b + 1) , 3, "0", STR_PAD_LEFT) ?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="5%">&nbsp;<font color="#FF0000"><b><?php echo ($rwOpextrusion['solprocodigo'])? str_pad($rwOpextrusion['solprocodigo'], 3, "0", STR_PAD_LEFT) : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="5%">&nbsp;<font color="#000080"><b><?php echo ($FORMULAEXTRUSION)? $FORMULAEXTRUSION : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#000080"><b><?php echo ($rwExtrusion['ordoppanchot'])? number_format($rwExtrusion['ordoppanchot'], 2, ',', '.') : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#000080"><b><?php echo ($CORTEEXTRUSION)? number_format($CORTEEXTRUSION, 2, ',', '.') : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#000080"><b><?php echo ($PISTASEXTRUSION)? number_format($PISTASEXTRUSION, 2, ',', '.') : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#000080"><b><?php echo ($CALIBREEXTRUSION)? number_format($CALIBREEXTRUSION, 2, ',', '.') : '---' ;?></b></font></td>	          			
	          			<td class="NoiseDataTD cont-field-b" width="25%">&nbsp;<font color="#000080"><b><?php echo ($ITEMPRODUCCION)? $ITEMPRODUCCION : '---' ;?></b></font></td>	          			
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#000080"><b><?php echo ($rwExtrusion['ordoppcantkg'])? number_format($rwExtrusion['ordoppcantkg'], 2, ',', '.') : '---' ;?></b></font></td>	          			
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#000080"><b><?php echo ($rwExtrusion['ordoppcantmt'])? number_format($rwExtrusion['ordoppcantmt'], 2, ',', '.') : '---' ;?></b></font></td>	          			
	         		</tr> 
	         		<tr>
	          			<td class="NoiseDataTD cont-field-b" width="5%">&nbsp;</td>
	          			<td class="NoiseDataTD cont-field-b" width="5%" colspan="2">&nbsp;<font color="#000080"><b><?php echo ($PEDIDOPRODUCCION)? 'PV-'.$PEDIDOPRODUCCION : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="5%" colspan="7">&nbsp;<font color="#000080"><b><?php echo ($CLIENTEPRODUCCION)? $CLIENTEPRODUCCION : '---' ;?></b></font></td>
	         		</tr> 
	         		<tr>
	         			<td class="NoiseDataTD cont-field-b" colspan="10">&nbsp;</td>
	         		</tr>   		
					<?php 
							
						}
	         		?>
	         	</table>
	         	<?php
					} 
	         	?>
	 		</div>
	 		<!-- 	FIN CONTENIDO -->
	 		
	 		
	 		<!--  CONSOLIDADO DE CONTENIDO -->
	 		<br>
	 		<div class="ui-widget-content">
	          	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
					<tr class="ui-widget-header">
	          			<td class="ui-widget-header" width="15%">&nbsp;Total Ordenes :&nbsp;</td>
	          			<td class="ui-state-default" width="15%">&nbsp;<?php echo str_pad($UNDEXTRUSION, 3, "0", STR_PAD_LEFT) ?>&nbsp;<b>(und)</b></td>
	          			<td class="ui-widget-header" width="15%">&nbsp;Total Kilos :&nbsp;</td>
	          			<td class="ui-state-default" width="15%">&nbsp;<?php echo number_format($KGSEXTRUSION, 2, ',', '.') ?>&nbsp;<b>(kgs)</b></td>
	          			<td class="ui-widget-header" width="15%">&nbsp;Total Metros :&nbsp;</td>
	          			<td class="ui-state-default"width="25%">&nbsp;<?php echo number_format($MTSEXTRUSION, 2, ',', '.') ?>&nbsp;<b>(mts)</b></td>
	         		</tr>
	         	</table>
	         </div>
	         <!--  FIN CONSOLIDADO DE CONTENIDO -->
	         <br><br><br>
<!-- FIN EXTRUSION -->
<?php }?>



<?php $FLEXOGRAFIA = 1;if($FLEXOGRAFIA > 0){?>	    
<!-- FLEXOGRAFIA -->
	         
	         <!-- 	SUBTITULO INFORMATIVO -->
				<br>
				<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
					<tr>
						<td width="40%">
							<div class="ui-widget-content">
								<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
									<tr>
										<td class="ui-widget-header" width="30%">&nbsp;<b>SISTEMA:</b></td>
										<td class="ui-state-default" width="70%">&nbsp;FLEXOGRAFIA</td>
									</tr>
									<tr>
										<td class="ui-widget-header"width="30%">&nbsp;<b>FECHA:</b></td>
										<td class="ui-state-default" width="70%">&nbsp;<?php echo date('Y/m/d') ?></td>
									</tr>
								</table>
							</div>
						</td>
						<td align="right" width="60%" class="borde-cell">&nbsp;</td>
					</tr>
				</table>
			<br>
			<!-- 	FIN SUBTITULO INFORMATIVO -->
			
			
			<!-- 	CONTENIDO -->
			<div class="ui-widget-content contenido-general-inf">
				<?php 
	          		$rsFlexografiaEqu = fullscanprogramaflexoequipos($idcon,1);
	          		$nrFlexografiaEqu = fncnumreg($rsFlexografiaEqu);
	          		//VARIBLES PARA LOS ORDENES DE PRODUCCION PROGRAMADAS {OPP}
	          		$UNDFLEXOGRAFIA = 0;
					$KGSFLEXOGRAFIA = 0;
					$MTSFLEXOGRAFIA = 0;
					$OPPFLEXOGRAFIA = 0 ;
					if(!$nrFlexografiaEqu)
					{
				?>
				<div class="ui-widget">
	 				<div style="margin-top: 1px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all"> 
  						<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
  						<b>No se encontraron OPP.</b></p>
 					</div>
				</div>
				<?php 
					}
	          		for($a = 0; $a < $nrFlexografiaEqu; $a++)
	          		{
	          			$rwFlexografiaEqu = fncfetch($rsFlexografiaEqu,$a);
	          	?>
	          	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
					<tr class="ui-widget-header">
						<td colspan="11">&nbsp;<b><?php echo cargaequiponombre($rwFlexografiaEqu['equipocodigo'],$idcon) ?></b></td>
					</tr>
					<tr>
	          			<td class="NoiseFooterTD cont-field-b" width="5%">&nbsp;OE&nbsp;</td>
	          			<td class="NoiseFooterTD cont-field-b" width="5%">&nbsp;<b># OPP</b>&nbsp;</td>
	          			<td class="NoiseFooterTD cont-field-b" width="5%">&nbsp;ITEM&nbsp;</td>
	          			<td class="NoiseFooterTD cont-field-b" width="15%">&nbsp;REFERENCIA&nbsp;</td>
	          			<td class="NoiseFooterTD cont-field-b" width="15%">&nbsp;MATERIAL&nbsp;</td>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;ANCHO&nbsp;<b>(mm)</b>&nbsp;</td>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;KILOS&nbsp;<b>(kg)</b>&nbsp;</td>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;METROS&nbsp;<b>(mts)</b>&nbsp;</td>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;IMPRESION&nbsp;</td>	          			
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;F. ENTREGA&nbsp;</td>	          			
	          			<td class="NoiseFooterTD cont-field-b" width="5%">&nbsp;RODILLO&nbsp;</td>	          			
	         		</tr>
	          	<?php 
	          			$rsFlexografia = dinamicscanopprogramaflexo(array('equipocodigo' => $rwFlexografiaEqu['equipocodigo']),array('equipocodigo' => '='),$idcon);
	          			$nrFlexografia = fncnumreg($rsFlexografia);
	          			for($b = 0; $b < $nrFlexografia; $b++)
	           			{
	           				unset($ITEMPRODUCCION,$REFPRODUCCION,$FECHAENTREGA,$MATERIALIMPRESION,$TIPOIMPRESION,$RODILLOIMPRESION,$PEDIDOPRODUCCION,$CLIENTEPRODUCCION,$DESTINOPRODUCCION);
	          				$rwFlexografia = fncfetch($rsFlexografia, $b);
	          				//VARIBLES PARA LOS ORDENES DE PRODUCCION PROGRAMADAS {OPP}
	          				$UNDFLEXOGRAFIA++;
							$KGSFLEXOGRAFIA = $KGSFLEXOGRAFIA + $rwFlexografia['ordoppcantkg'];
							$MTSFLEXOGRAFIA = $MTSFLEXOGRAFIA + $rwFlexografia['ordoppcantmt'];
							$OPPFLEXOGRAFIA = $rwFlexografia['ordoppcodigo'];
	           				if($OPPFLEXOGRAFIA > 0)
	         				{
			         			$rsOpflexografia = dinamicscanopopflexo(array('ordoppcodigo' =>$OPPFLEXOGRAFIA),array('ordoppcodigo' => '='),$idcon);
								$nrOpflexografia = fncnumreg($rsOpflexografia);
								for($c = 0; $c < $nrOpflexografia; $c++)
								{
									$rwOpflexografia = fncfetch($rsOpflexografia, $c);
									//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
									$MATERIALIMPRESION = ($rwOpflexografia['paditenombre'])? $rwOpflexografia['paditenombre'] : '---' ;
									$TIPOIMPRESION = ($rwOpflexografia['ordprotipimp'])? strtoupper($rwOpflexografia['ordprotipimp']) : '---' ;
									$RODILLOIMPRESION = ($rwOpflexografia['ordprorodill'])? $rwOpflexografia['ordprorodill'] : '---' ;
									if($rwOpflexografia['produccoduno']) $ITEMPRODUCCION = ($ITEMPRODUCCION)? $ITEMPRODUCCION.'<br>&nbsp;'.$rwOpflexografia['produccoduno'] : $rwOpflexografia['produccoduno'] ;
									if($rwOpflexografia['producnombre']) $REFPRODUCCION = ($REFPRODUCCION)? $REFPRODUCCION.'<br>&nbsp;'.$rwOpflexografia['producnombre'] : $rwOpflexografia['producnombre'] ;
									if($rwOpflexografia['pedvenfecent']) $FECHAENTREGA = ($FECHAENTREGA)? $FECHAENTREGA.'<br>&nbsp;'.strtoupper($rwOpflexografia['pedvenfecent']) : strtoupper($rwOpflexografia['pedvenfecent']) ;
									if($rwOpflexografia['pedvennumero']) $PEDIDOPRODUCCION = ($PEDIDOPRODUCCION)? $PEDIDOPRODUCCION.'<br>&nbsp;'.$rwOpflexografia['pedvennumero'] : $rwOpflexografia['pedvennumero'] ;
									if($rwOpflexografia['ordcomrazsoc']) $CLIENTEPRODUCCION = ($CLIENTEPRODUCCION)? $CLIENTEPRODUCCION.'<br>&nbsp;'.$rwOpflexografia['ordcomrazsoc'] : $rwOpflexografia['ordcomrazsoc'] ;
									if($rwOpflexografia['procednombre']) $DESTINOPRODUCCION = ($DESTINOPRODUCCION)? $DESTINOPRODUCCION.'<br>&nbsp;'.strtoupper($rwOpflexografia['procednombre']) : strtoupper($rwOpflexografia['procednombre']);
								}
	         				}      		
	          	?>
					<tr>
	          			<td class="NoiseDataTD cont-field-b" width="5%">&nbsp;<font color="#000080"><b><?php echo str_pad( ($b + 1) , 3, "0", STR_PAD_LEFT) ?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="5%">&nbsp;<font color="#FF0000"><b><?php echo ($rwOpflexografia['solprocodigo'])? str_pad($rwOpflexografia['solprocodigo'], 3, "0", STR_PAD_LEFT) : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="5%">&nbsp;<font color="#000080"><b><?php echo ($ITEMPRODUCCION)? $ITEMPRODUCCION : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="15%">&nbsp;<font color="#000080"><b><?php echo ($REFPRODUCCION)? $REFPRODUCCION : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#000080"><b><?php echo ($MATERIALIMPRESION)? $MATERIALIMPRESION : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#000080"><b><?php echo ($rwFlexografia['ordoppanchot'])? number_format($rwFlexografia['ordoppanchot'], 2, ',', '.') : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#000080"><b><?php echo ($rwFlexografia['ordoppcantkg'])? number_format($rwFlexografia['ordoppcantkg'], 2, ',', '.') : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#000080"><b><?php echo ($rwFlexografia['ordoppcantmt'])? number_format($rwFlexografia['ordoppcantmt'], 2, ',', '.') : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#000080"><b><?php echo ($TIPOIMPRESION)? $TIPOIMPRESION : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#000080"><b><?php echo ($FECHAENTREGA)? $FECHAENTREGA : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="5%">&nbsp;<font color="#000080"><b><?php echo ($RODILLOIMPRESION)? $RODILLOIMPRESION : '---' ;?></b></font></td>
	         		</tr>
	         		<tr>
	          			<td class="NoiseDataTD cont-field-b" width="5%">&nbsp;</td>
	          			<td class="NoiseDataTD cont-field-b" colspan="2">&nbsp;<font color="#000080"><b><?php echo ($PEDIDOPRODUCCION)? 'PV-'.$PEDIDOPRODUCCION : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" colspan="8">&nbsp;<font color="#000080"><b><?php echo ($CLIENTEPRODUCCION)? $CLIENTEPRODUCCION : '---' ;?></b></font></td>
	         		</tr> 
	         		<tr>
	         			<td class="NoiseDataTD cont-field-b" colspan="11">&nbsp;</td>
	         		</tr>     	
	         		<?php 
						}
	         		?>
	          	</table>
	         	<?php
					} 
	         	?>
	 		</div>
	 		<!-- 	FIN CONTENIDO -->
	 		
	 		
	 		<!--  CONSOLIDADO DE CONTENIDO -->
	 		<br>
	 		<div class="ui-widget-content">
	          	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
					<tr>
	          			<td class="ui-widget-header" width="15%">&nbsp;Total Ordenes :&nbsp;</td>
	          			<td class="ui-state-default" width="15%">&nbsp;<?php echo str_pad($UNDFLEXOGRAFIA, 3, "0", STR_PAD_LEFT) ?>&nbsp;<b>(und)</b></td>
	          			<td class="ui-widget-header" width="15%">&nbsp;Total Kilos :&nbsp;</td>
	          			<td class="ui-state-default" width="15%">&nbsp;<?php echo number_format($KGSFLEXOGRAFIA, 2, ',', '.') ?>&nbsp;<b>(kgs)</b></td>
	          			<td class="ui-widget-header" class="ui-widget-header" width="15%">&nbsp;Total Metros :&nbsp;</td>
	          			<td class="ui-state-default"width="25%">&nbsp;<?php echo number_format($MTSFLEXOGRAFIA, 2, ',', '.') ?>&nbsp;<b>(mts)</b></td>
	         		</tr>
	         	</table>
	         </div>
	         <!--  FIN CONSOLIDADO DE CONTENIDO -->
			<br><br><br>
			
<!-- FIN FLEXOGRAFIA -->
<?php }?>




<?php $LAMINADO = 1;if($LAMINADO > 0){?>	   
<!-- LAMINADO -->
	         
	         <!-- 	SUBTITULO INFORMATIVO -->
				<br>
				<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
					<tr>
						<td width="40%">
							<div class="ui-widget-content">
								<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
									<tr>
										<td class="ui-widget-header" width="30%">&nbsp;<b>SISTEMA:</b></td>
										<td class="ui-state-default" width="70%">&nbsp;LAMINADO</td>
									</tr>
									<tr>
										<td class="ui-widget-header" width="30%">&nbsp;<b>FECHA:</b></td>
										<td class="ui-state-default" width="70%">&nbsp;<?php echo date('Y/m/d') ?></td>
									</tr>
								</table>
							</div>
						</td>
						<td align="right" width="60%" class="borde-cell">&nbsp;</td>
					</tr>
				</table>
				<br>
			<!-- 	FIN SUBTITULO INFORMATIVO -->
			
			
			<!-- 	CONTENIDO -->
			<div class="ui-widget-content contenido-general-inf">
	          	<?php 
	          		$rsLaminadoEqu = fullscanprogramalaminadoequipos($idcon,1);
	          		$nrLaminadoEqu = fncnumreg($rsLaminadoEqu);
	          		//VARIBLES PARA LOS ORDENES DE PRODUCCION PROGRAMADAS {OPP}
	          		$UNDLAMINADO = 0;
					$KGSLAMINADO = 0;
					$MTSLAMINADO = 0;
					$OPPLAMINADO = 0 ;
					if(!$nrLaminadoEqu)
					{
				?>
				<div class="ui-widget">
	 				<div style="margin-top: 1px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all"> 
  						<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
  						<b>No se encontraron OPP.</b></p>
 					</div>
				</div>
				<?php 
						
					}
	          		for($a = 0; $a < $nrLaminadoEqu; $a++)
	          		{
	          			$rwLaminadoEqu = fncfetch($rsLaminadoEqu,$a);
	          	?>
	          	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
					<tr class="ui-widget-header">
						<td colspan="9">&nbsp;<b><?php echo cargaequiponombre($rwLaminadoEqu['equipocodigo'],$idcon) ?></b></td>
					</tr>
					<tr>
	          			<td class="NoiseFooterTD cont-field-b" width="5%">&nbsp;OE&nbsp;</td>
	          			<td class="NoiseFooterTD cont-field-b" width="5%">&nbsp;<b># OPP</b>&nbsp;</td>
	          			<td class="NoiseFooterTD cont-field-b" width="20%">&nbsp;ADHESIVO&nbsp;</td>
	          			<td class="NoiseFooterTD cont-field-b" width="20%">&nbsp;DESEMPENO&nbsp;</td>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;LAMINADO&nbsp;</td>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;ANCHO&nbsp;</td>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;F. ENTREGA&nbsp;</td>	          			
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;KILOS&nbsp;</td>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;METROS&nbsp;</td>	          			
	         		</tr>
	          	<?php 
	          			$rsLaminado = dinamicscanopprogramalaminado(array('equipocodigo' => $rwLaminadoEqu['equipocodigo']),array('equipocodigo' => '='),$idcon);
	          			$nrLaminado = fncnumreg($rsLaminado);
	          			for($b = 0; $b < $nrLaminado; $b++)
	           			{
	           				unset($TIPOADHESIVO,$DESEMPENOADHESIVO,$LAMINADOADHESIVO,$FECHAENTREGA,$PEDIDOPRODUCCION,$CLIENTEPRODUCCION);
	          				$rwLaminado = fncfetch($rsLaminado, $b);
	          				//VARIBLES PARA LOS ORDENES DE PRODUCCION PROGRAMADAS {OPP}
	          				$UNDLAMINADO++;
							$KGSLAMINADO = $KGSLAMINADO + $rwLaminado['ordoppcantkg'];
							$MTSLAMINADO = $MTSLAMINADO + $rwLaminado['ordoppcantmt'];
							$OPPLAMINADO = $rwLaminado['ordoppcodigo'];
							if($OPPLAMINADO > 0)
	         				{
	         					$rsOplaminado = dinamicscanopoplaminado(array('ordoppcodigo' =>$OPPLAMINADO),array('ordoppcodigo' => '='),$idcon);
								$nrOplaminado = fncnumreg($rsOplaminado);
								for($c = 0; $c < $nrOplaminado; $c++)
								{
									$rwOplaminado = fncfetch($rsOplaminado, $c);
									//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
									$TIPOADHESIVO = ($rwOplaminado['ordprotiposo'])? strtoupper($rwOplaminado['ordprotiposo']) : '---' ;
									$DESEMPENOADHESIVO = ($rwOplaminado['ordprodesemp'])? strtoupper($rwOplaminado['ordprodesemp']) : '---' ;
									$LAMINADOADHESIVO = ($rwOplaminado['ordprolamina'])? strtoupper($rwOplaminado['ordprolamina']) : '---' ;
									if($rwOplaminado['pedvenfecent']) $FECHAENTREGA = strtoupper($rwOplaminado['pedvenfecent']);
									if($rwOplaminado['pedvennumero']) $PEDIDOPRODUCCION = $rwOplaminado['pedvennumero'] ;
									if($rwOplaminado['ordcomrazsoc']) $CLIENTEPRODUCCION = $rwOplaminado['ordcomrazsoc'] ;			
								}
	         				}
	          	?>
					<tr>
	          			<td class="NoiseDataTD cont-field-b" width="5%">&nbsp;<font color="#000080"><b><?php echo str_pad( ($b + 1) , 3, "0", STR_PAD_LEFT) ?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="5%">&nbsp;<font color="#FF0000"><b><?php echo ($rwOplaminado['solprocodigo'])? str_pad($rwOplaminado['solprocodigo'], 3, "0", STR_PAD_LEFT) : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="20%">&nbsp;<font color="#000080"><b><?php echo ($TIPOADHESIVO)? $TIPOADHESIVO : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="20%">&nbsp;<font color="#000080"><b><?php echo ($DESEMPENOADHESIVO)? $DESEMPENOADHESIVO : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#000080"><b><?php echo ($LAMINADOADHESIVO)? $LAMINADOADHESIVO : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#000080"><b><?php echo ($rwLaminado['ordoppanchot'])? number_format($rwLaminado['ordoppanchot'],2,',','.') : '---' ;?></b></font></td>	          			
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#000080"><b><?php echo ($FECHAENTREGA)? $FECHAENTREGA : '---' ;?></b></font></td>	          			
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#000080"><b><?php echo ($rwLaminado['ordoppcantkg'])? number_format($rwLaminado['ordoppcantkg'],2,',','.'): '---' ;?></b></font></td>	          			
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#000080"><b><?php echo ($rwLaminado['ordoppcantmt'])? number_format($rwLaminado['ordoppcantmt'],2,',','.') : '---' ;?></b></font></td>	          			
	         		</tr>
	         		<tr>
	          			<td class="NoiseDataTD cont-field-b" width="5%">&nbsp;</td>
	          			<td class="NoiseDataTD cont-field-b" colspan="2">&nbsp;<font color="#000080"><b><?php echo ($PEDIDOPRODUCCION)? 'PV-'.$PEDIDOPRODUCCION : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" colspan="6">&nbsp;<font color="#000080"><b><?php echo ($CLIENTEPRODUCCION)? $CLIENTEPRODUCCION : '---' ;?></b></font></td>
	         		</tr> 
	         		<tr>
	         			<td class="NoiseDataTD cont-field-b" colspan="11">&nbsp;</td>
	         		</tr>     	
					<?php 
	         			}
	         		?>
	          	</table>
	          	<?php
					} 
	         	?>
	 		</div>
	 		<!-- 	FIN CONTENIDO -->
	 		
	 		
	 		<!--  CONSOLIDADO DE CONTENIDO -->
	 		<br>
	 		<div class="ui-widget-content">
	          	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
					<tr>
	          			<td class="ui-widget-header" width="15%">&nbsp;Total Ordenes :&nbsp;</td>
	          			<td class="ui-state-default" width="15%">&nbsp;<?php echo str_pad($UNDLAMINADO, 3, "0", STR_PAD_LEFT) ?>&nbsp;<b>(und)</b></td>
	          			<td class="ui-widget-header" width="15%">&nbsp;Total Kilos :&nbsp;</td>
	          			<td class="ui-state-default" width="15%">&nbsp;<?php echo number_format($KGSLAMINADO, 2, ',', '.') ?>&nbsp;<b>(kgs)</b></td>
	          			<td class="ui-widget-header" width="15%">&nbsp;Total Metros :&nbsp;</td>
	          			<td class="ui-state-default" width="25%">&nbsp;<?php echo number_format($MTSLAMINADO, 2, ',', '.') ?>&nbsp;<b>(mts)</b></td>
	         		</tr>
	         	</table>
	         </div>
	         <!--  FIN CONSOLIDADO DE CONTENIDO -->
			<br><br><br>
			
<!-- FIN LAMINADO -->
<?php }?>






<?php $CORTE = 1;if($CORTE > 0){?>	   
<!-- CORTE -->
	         
	         <!-- 	SUBTITULO INFORMATIVO -->
				<br>
				<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
					<tr>
						<td width="40%">
							<div class="ui-widget-content">
								<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
									<tr>
										<td class="ui-widget-header" width="30%">&nbsp;<b>SISTEMA:</b></td>
										<td class="ui-state-default" width="70%">&nbsp;CORTE</td>
									</tr>
									<tr>
										<td class="ui-widget-header" width="30%">&nbsp;<b>FECHA:</b></td>
										<td class="ui-state-default" width="70%">&nbsp;<?php echo date('Y/m/d') ?></td>
									</tr>
								</table>
							</div>
						</td>
						<td align="right" width="60%" class="borde-cell">&nbsp;</td>
					</tr>
				</table>
			<br>
			<!-- 	FIN SUBTITULO INFORMATIVO -->
			
			
			<!-- 	CONTENIDO -->
			<div class="ui-widget-content contenido-general-inf">
				<?php 
	          		$rsCorteEqu = fullscanprogramacorteequipos($idcon,1);
	          		$nrCorteEqu = fncnumreg($rsCorteEqu);
	          		//VARIBLES PARA LOS ORDENES DE PRODUCCION PROGRAMADAS {OPP}
	          		$UNDCORTE = 0;
					$KGSCORTE = 0;
					$MTSCORTE = 0;
					$OPPCORTE = 0;
					if(!$nrCorteEqu)
					{
				?>
				<div class="ui-widget">
	 				<div style="margin-top: 1px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all"> 
  						<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
  						<b>No se encontraron OPP.</b></p>
 					</div>
				</div>
				<?php 
					}
	          		for($a = 0; $a < $nrCorteEqu; $a++)
	          		{
	          			$rwCorteEqu = fncfetch($rsCorteEqu,$a);
	          	?>
	          	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
					<tr class="ui-widget-header">
						<td colspan="9">&nbsp;<b><?php echo cargaequiponombre($rwCorteEqu['equipocodigo'],$idcon) ?></b></td>
					</tr>
	          	<?php 
	          			$rsCorte = dinamicscanopprogramacorte(array('equipocodigo' => $rwCorteEqu['equipocodigo']),array('equipocodigo' => '='),$idcon);
	          			$nrCorte = fncnumreg($rsCorte);
	          			for($b = 0; $b < $nrCorte; $b++)
	           			{
	           				unset($TAMANOCORE,$PISTASCORTE,$ANCHOCORTE);
	          				$rwCorte = fncfetch($rsCorte, $b);
	          				//VARIBLES PARA LOS ORDENES DE PRODUCCION PROGRAMADAS {OPP}
	          				$UNDCORTE++;
							$KGSCORTE = $KGSCORTE + $rwCorte['ordoppcantkg'];
							$MTSCORTE = $MTSCORTE + $rwCorte['ordoppcantmt'];
							$OPPCORTE = $rwCorte['ordoppcodigo'];  
							//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
							$TAMANOCORE = ($rwOpcorte['ordprotacore'])? $rwOpcorte['ordprotacore'] : '---' ;
							if($OPPCORTE > 0)
	         				{
		         				$rsOpcorte = dinamicscanopopcorte(array('ordoppcodigo' =>$OPPCORTE),array('ordoppcodigo' => '='),$idcon);
								$nrOpcorte = fncnumreg($rsOpcorte);
								for($c = 0; $c < $nrOpcorte; $c++)
								{
									$rwOpcorte = fncfetch($rsOpcorte, $c);
									if($rwOpcorte['pedvenfecent']) $FECHAENTREGA = strtoupper($rwOpcorte['pedvenfecent']) ;
									if($rwOpcorte['pedvennumero']) $PEDIDOPRODUCCION = $rwOpcorte['pedvennumero'] ;
									if($rwOpcorte['ordcomrazsoc']) $CLIENTEPRODUCCION = $rwOpcorte['ordcomrazsoc'] ;
									if($rwOpcorte['ordproancmat'] && $rwOpcorte['ordpropistap']) 
									{
										$ANCHOCORTE = ($rwOpcorte['ordpropistap'] * $rwOpcorte['ordproancmat']);
										$PISTACORTE =  $rwOpcorte['ordpropistap'].' * '.$rwOpcorte['ordproancmat'];
									}
								}
	         				}      		
	          	?>
					<tr>
	          			<td class="NoiseFooterTD cont-field-b" width="5%">&nbsp;OE&nbsp;</td>
	          			<td class="NoiseFooterTD cont-field-b" width="5%">&nbsp;<b># OPP</b>&nbsp;</td>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;T. CORE&nbsp;<b>(mm)</b>&nbsp;</td>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;ANCHO&nbsp;<b>(mm)</b>&nbsp;</td>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;ANCHO CORTE&nbsp;<b>(mm)</b>&nbsp;</td>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;PISTAS&nbsp;<b>(kg)</b>&nbsp;</td>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;KILOS&nbsp;<b>(kg)</b>&nbsp;</td>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;METROS&nbsp;<b>(mts)</b>&nbsp;</td>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;F. ENTREGA&nbsp;</td>
	         		</tr>
					<tr>
	          			<td class="NoiseDataTD cont-field-b" width="5%">&nbsp;<font color="#000080"><b><?php echo str_pad( ($b + 1) , 3, "0", STR_PAD_LEFT) ?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="5%">&nbsp;<font color="#FF0000"><b><?php echo ($rwOpcorte['solprocodigo'])? str_pad($rwOpcorte['solprocodigo'], 3, "0", STR_PAD_LEFT) : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#000080"><b><?php echo ($TAMANOCORE)? $TAMANOCORE : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#000080"><b><?php echo ($rwCorte['ordoppanchot'])? number_format($rwCorte['ordoppanchot'], 2, ',', '.') : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#000080"><b><?php echo ($ANCHOCORTE)? $ANCHOCORTE : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#000080"><b><?php echo ($PISTACORTE)? $PISTACORTE : '---' ;?></b></font></td>	          			
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#000080"><b><?php echo ($rwCorte['ordoppcantkg'])? number_format($rwCorte['ordoppcantkg'], 2, ',', '.') : '---' ;?></b></font></td>	          			
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#000080"><b><?php echo ($rwCorte['ordoppcantmt'])? number_format($rwCorte['ordoppcantmt'], 2, ',', '.') : '---' ;?></b></font></td>	          			
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#000080"><b><?php echo ($FECHAENTREGA)? $FECHAENTREGA : '---' ;?></b></font></td>	          			
	         		</tr>
	         		<tr>
	          			<td class="NoiseDataTD cont-field-b" width="5%">&nbsp;</td>
	          			<td class="NoiseDataTD cont-field-b" colspan="2">&nbsp;<font color="#000080"><b><?php echo ($PEDIDOPRODUCCION)? 'PV-'.$PEDIDOPRODUCCION : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" colspan="6">&nbsp;<font color="#000080"><b><?php echo ($CLIENTEPRODUCCION)? $CLIENTEPRODUCCION : '---' ;?></b></font></td>
	         		</tr> 
	         		<tr>
	         			<td class="NoiseDataTD cont-field-b" colspan="11">&nbsp;</td>
	         		</tr>   
					<?php 
	           			}
	         		?>
	          	</table>
	          	<?php
					} 
	         	?>
	 		</div>
	 		<!-- 	FIN CONTENIDO -->
	 		
	 		
	 		<!--  CONSOLIDADO DE CONTENIDO -->
	 		<br>
	 		<div class="ui-widget-content">
	          	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
					<tr>
	          			<td class="ui-widget-header" width="15%">&nbsp;Total Ordenes :&nbsp;</td>
	          			<td class="ui-state-default" width="15%">&nbsp;<?php echo str_pad($UNDCORTE, 3, "0", STR_PAD_LEFT) ?>&nbsp;<b>(und)</b></td>
	          			<td class="ui-widget-header" width="15%">&nbsp;Total Kilos :&nbsp;</td>
	          			<td class="ui-state-default" width="15%">&nbsp;<?php echo number_format($KGSCORTE, 2, ',', '.') ?>&nbsp;<b>(kgs)</b></td>
	          			<td class="ui-widget-header" width="15%">&nbsp;Total Metros :&nbsp;</td>
	          			<td class="ui-state-default" width="25%">&nbsp;<?php echo number_format($MTSCORTE, 2, ',', '.') ?>&nbsp;<b>(mts)</b></td>
	         		</tr>
	         	</table>
	         </div>
	         <!--  FIN CONSOLIDADO DE CONTENIDO -->
			<br><br><br>
			
<!-- FIN CORTE -->
<?php }?>



	         
	         
	         <!-- 	PIE DE PAGINA -->
			<br><br>
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
<!-- 	FIN CONTENIDO GENERAL -->
			<input type="hidden" name="arrop" id="arrop" value="<?php echo $arrop?>" />
			<input type="hidden" name="codigo" id="codigo" value="<?php echo $codigo; ?>" />
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
  	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>