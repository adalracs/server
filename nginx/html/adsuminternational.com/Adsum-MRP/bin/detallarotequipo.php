<?php
ob_start();
	include ( '../src/FunPerPriNiv/pktblvistaequipoplanta.php');	
	include('../src/FunPerSecNiv/fncfetch.php');
	include('../src/FunPerSecNiv/fncnumreg.php');
	include ( '../src/FunPerSecNiv/fncconn.php');
	include ( '../src/FunPerSecNiv/fncclose.php');
ob_end_flush();
	include ( '../src/FunPerPriNiv/pktblestado.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblsistema.php');
	include ( '../src/FunPerPriNiv/pktbltipoequipo.php');
	include ( '../src/FunPerPriNiv/pktblcentcost.php');
	include ( '../src/FunPerPriNiv/pktblusuaequipo.php');
	include ( '../src/FunPerPriNiv/pktblnormaseguri.php');
	include ( '../src/FunPerPriNiv/pktblnormaseguriequipo.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunGen/cargainput.php');
	
	if($equipocodigo)
	{
		$idcon = fncconn();
		$sbreg = loadrecordvistaequipoplanta($equipocodigo, $idcon);
	
		$rs_sistema = loadrecordsistema($sbreg['sistemcodigo'],$idcon);
		$rs_planta = loadrecordplanta($rs_sistema['plantacodigo'],$idcon);
		$rs_usuaequi = loadrecordusuaequipo1($sbreg['equipocodigo'],$idcon);
		
		//-----
	   	$arr_ext = array('.gif','.jpg','.jpeg','.png','.bmp','.GIF','.JPG','.JPEG','.PNG','.BMP');
	   	for($i = 0; $i < count($arr_ext); $i++)
	   	{
		   	if(file_exists('../img/pics_equipos/equipo'.$sbreg['equipocodigo'].$arr_ext[$i]))
		   	{
		   		$oldusuaimage = 'equipo'.$sbreg['equipocodigo'].$arr_ext[$i];
		   		break;
		   	}
	   	}
	   	//-----
	}
?> 
<html> 
	<head> 
		<title>Detalle registro en equipo</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0">
		<link rel="stylesheet" type="text/css" href="temas/Noise/help.css">
		<?php include('../def/jquery.library_maestro.php');?>

		<style type="text/css">
			h1 { font-family: Georgia; font-style: italic; margin-bottom: 10px; }
			
			h2 {
				font-family: Georgia;
				font-style: italic;
				margin: 25px 0 5px 0;
			}
			
			p { font-size: 1.2em; }
			ul {margin: 0; padding: 0;}
			ul li { display: inline; }
			
			.wide {
				border-bottom: 1px #000 solid;
				width: 4000px;
			}
			
			.fleft { float: left; margin: 0 20px 0 0; }
			
			.cboth { clear: both; }
			body {
				margin-left: 0px;
				margin-top: 0px;
				margin-right: 0px;
				margin-bottom: 0px;
			}
		</style>
	</head>
	<body bgcolor="#f7f7f7" text="#000000">
		<?php if(!$equipocodigo): ?>
		<div class="ui-widget">
			<div style="margin-top: 20px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all"> 
				<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
				<b>No se encontro el Equipo</b></p>
			</div>
		</div>
		<?php else: ?>
		<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content">
			<tr> 
  				<td>
  					<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
  						<tr> 
							<td class="NoiseFooterTD">&nbsp;Ubicaci&oacute;n / Proceso</td>
							<td class="NoiseDataTD">&nbsp;<b><?php echo $rs_planta['plantanombre'].' / '.$rs_sistema['sistemnombre'] ?></b></td>
							<td class="NoiseErrorDataTD" rowspan="8" width="30%" align="center"><img width="212" height="150" src="../img/pics_equipos/<?php if($oldusuaimage): echo $oldusuaimage; else: ?>no_image.jpg<?php endif; ?>"></td>
						</tr>
  						<tr> 	
            				<td class="NoiseFooterTD" width="20%">&nbsp;Tipo equipo</td>
            				<td class="NoiseDataTD" width="50%">&nbsp;<?php echo cargatipequnombre($sbreg['tipequcodigo'], $idcon) ?></td>
          				</tr>
          				<tr> 
							<td class="NoiseFooterTD">&nbsp;Mantenedor</td>
							<td class="NoiseDataTD">&nbsp;<?php if($rs_usuaequi['usuacodi']) echo $rs_usuaequi['usuacodi'].' - '.cargausuanombre($rs_usuaequi['usuacodi'], $idcon); ?></td>
						</tr>
						<tr>
							<td class="NoiseFooterTD">&nbsp;C&oacute;digo SIGMA</td>
							<td class="NoiseDataTD">&nbsp;<?php echo $sbreg['equipocodigo'] ?></td>
						</tr>
						<tr>
							<td class="NoiseFooterTD">&nbsp;Codigo SRF</td>
							<td class="NoiseDataTD">&nbsp;<?php echo $sbreg['codigosrf'] ?></td>
						</tr>
						<tr> 
							<td class="NoiseFooterTD">&nbsp;Nombre</td>
							<td class="NoiseDataTD">&nbsp;<?php echo trim($sbreg['equiponombre']) ?></td>                	
						</tr>         
						<tr>
							<td class="NoiseFooterTD">&nbsp;Estado</td>
							<td class="NoiseDataTD">&nbsp;<?php echo cargaestadonombre($sbreg['estadocodigo'], $idcon) ?></td>
						</tr>  
						<tr>
							<td class="NoiseFooterTD">&nbsp;Centro de costo</td>
							<td class="NoiseDataTD">&nbsp;<?php echo cargacentcostnumero($sbreg['cencoscodigo'], $idcon) ?></td>
						</tr>
					</table>
				</td>
			</tr>
			<?php 
				$arr_field = array('equipofabric', 'equipomarca', 'equipomodelo', 'equiposerie', 'equipocinv', 'equipoubicac', 'equipoviduti',
									'equipofeccom', 'equipofecins', 'equipovengar', 'equiponpas', ''); 
				$arr_lblfield = array('Fabricante', 'Marca', 'Modelo', 'No. serie', 'No. inventario', 'Ubicaci&oacute;n', 'Vida &uacute;util',
									'Fecha compra', 'Fecha instalaci&oacute;n', 'Venc. garant&iacute;a', 'NPAS') 
			?>
			<tr> 
  				<td>
  					<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
  						<?php 
  							$col = 1;
							$excl = 0;
							
  							for($a = 0; $a < count($arr_field); $a++):
  									
  								if($col == 1 && $sbreg[$arr_field[$a]]):	
						?>		
						<tr>
						<?php 	endif;
						 
								if($sbreg[$arr_field[$a]]): ?>
							<td class="NoiseFooterTD" width="20%">&nbsp;<?php echo $arr_lblfield[$a] ?></td>
							<td class="NoiseDataTD" width="30%">&nbsp;<?php echo $sbreg[$arr_field[$a]]; if($arr_field[$a] == 'equipofeccom' || $arr_field[$a] == 'equipofecins' || $arr_field[$a] == 'equipovengar'): ?>&nbsp;<small><b>aaaa-mm-dd</b></small><?php endif ?></td>
						<?php 
									$col++;
								else:
									$excl++;
								endif;

								if($a == (count($arr_field) - 1) && ($excl % 2) > 0 && $excl < $a):
						?>
							<td class="NoiseFooterTD" width="20%">&nbsp;</td>
							<td class="NoiseFooterTD" width="30%">&nbsp;</td>
						<?php 		$col++;	
								endif;

								if($col == 3):
						?>
						</tr>
						<?php 
									$col = 1;
								endif;
							endfor;
						?>
					</table>
				</td>
			</tr>
			<tr> 
  				<td>
  					<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<?php
				include('../src/FunGen/floadnormaseguriequipo.php');
	          	floadnormaseguriequipo($sbreg[equipocodigo], $idcon);
			?>
					</table>
				</td>
			</tr>
			<tr> 
  				<td>
  					<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
						<tr><td class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td></tr>
						<tr><td class="NoiseDataTD"><?php echo $sbreg['equipodescri'] ?></td></tr>
					</table>
				</td>
			</tr>
			<?php 
				$arr_field = array('equipovolta', 'equipocorrie', 'equipopoten', 'equiponivten'); 
				$arr_lblfield = array('Voltaje', 'Corriente', 'Potencia', 'Nivel de tensi&oacute;n') 
			?>
			<tr> 
  				<td>
  					<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
  						<?php 
  							$col = 1;
							$excl = 0;
							
  							for($a = 0; $a < count($arr_field); $a++):
  									
  								if($col == 1 && trim($sbreg[$arr_field[$a]])):	
						?>		
						<tr>
						<?php 	endif;
						 
								if(trim($sbreg[$arr_field[$a]])): ?>
							<td class="NoiseFooterTD" width="20%">&nbsp;<?php echo $arr_lblfield[$a] ?></td>
							<td class="NoiseDataTD" width="30%">&nbsp;<?php echo $sbreg[$arr_field[$a]] ?></td>
						<?php 
									$col++;
								else:
									$excl++;
								endif;

								if($a == (count($arr_field) - 1) && ($excl % 2) > 0 && $excl < $a):
						?>
							<td class="NoiseFooterTD" width="20%">&nbsp;</td>
							<td class="NoiseFooterTD" width="30%">&nbsp;</td>
						<?php 		$col++;	
								endif;

								if($col == 3):
						?>
						</tr>
						<?php 
									$col = 1;
								endif;
							endfor;
						?>
					</table>
				</td>
			</tr>
			<tr>
	           	<td>
				<?php if($sbreg['equipocodigo']): ?>
					<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center"  class="ui-widget-content">
						<tr><td colspan="4" class="ui-state-default">&nbsp;Campos personalizados</td></tr>
						<?php 
							include_once '../src/FunPerPriNiv/pktblequipocamperequipo.php';
							include_once '../src/FunPerPriNiv/pktblcamperequipo.php';
					
							$idcon = fncconn();
							$iRegcompcampequipo["equipocodigo"] = $sbreg['equipocodigo'];
							$id_equipo = dinamicscanequipocamperequipo($iRegcompcampequipo, $idcon);

							$numregtip = fncnumreg($id_equipo);
							$col = 1;
							$excl = 0;
								
							for ($j=0; $j< $numregtip; $j++):
								$arr_tipCam = fncfetch($id_equipo, $j);
								$arr_camper = loadrecordcamperequipo($arr_tipCam["capeeqcodigo"], $idcon);
								
								if($col == 1 && $arr_tipCam["capeeqvalor"]):	
						?>		
						<tr>
						<?php 	endif; 
								if($arr_tipCam["capeeqvalor"]): ?>
							<td class="NoiseFooterTD" width="18%"><small>&nbsp;<?php  echo $arr_camper["capeeqnombre"] ?></small></td>
							<td class="NoiseDataTD" width="32%">&nbsp;<?php echo $arr_tipCam["capeeqvalor"] ?></td>
						<?php 
									$col++;
								else:
									$excl++;
								endif;
								
								if($j == ($numregtip - 1) && ($excl % 2) > 0 && $excl < $j):
						?>
							<td class="NoiseFooterTD" width="18%"><small>&nbsp;</small></td>
							<td class="NoiseFooterTD" width="32%">&nbsp;</td>
						<?php 		$col++;	
								endif;

								if($col == 3):
						?>
						</tr>
						<?php 
									$col = 1;
								endif;
							endfor;
						?>
					</table>
				<?php endif; ?>
				</td>
			</tr>
		</table> 
		<?php endif ?>
	</body>
</html>