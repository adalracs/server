<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblestado.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblsistema.php');
	include ( '../src/FunPerPriNiv/pktblcomponen.php');
	include ( '../src/FunPerPriNiv/pktbltipoequipo.php');
	include ( '../src/FunPerPriNiv/pktblcentcost.php');
	include ( '../src/FunPerPriNiv/pktblusuaequipo.php');
	include ( '../src/FunPerPriNiv/pktblnormaseguri.php');
	include ( '../src/FunPerPriNiv/pktblnormaseguriequipo.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ('../src/FunPerPriNiv/pktbltipocomponen.php');
	
	include ( '../src/FunGen/cargainput.php');

	if(!$flagdetallarequipo)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');
			
		$idcon = fncconn();
		$rs_sistema = loadrecordsistema($sbreg['sistemcodigo'],$idcon);
		$rs_planta = loadrecordplanta($rs_sistema['plantacodigo'],$idcon);
		$rs_usuaequi = loadrecordusuaequipo1($sbreg['equipocodigo'],$idcon);
	
		//Planos y Manuales
		include_once ('../src/FunPerPriNiv/pktbldocuequi.php');
		include_once ('../src/FunPerPriNiv/pktblplano.php');
		include_once ('../src/FunPerPriNiv/pktblmanual.php');
		
		$rs_documentos = loadrecorddocuequilist($sbreg[equipocodigo],$idcon);
		
		if($rs_documentos['plano'])
		{
			for($a = 0; $a < count($rs_documentos['plano']); $a++)
				$planos[$a] = loadrecordplano($rs_documentos['plano'][$a], $idcon);
		}
	
		if($rs_documentos['manual'])
		{
			for($a = 0; $a < count($rs_documentos['manual']); $a++)
				$manuales[$a] = loadrecordmanual($rs_documentos['manual'][$a], $idcon);
		}
		
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
		<?php include('../def/jquery.library_maestro.php');?>
		
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
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
		</style>


<!--		<style type="text/css">-->
<!--			ul {list-style-type:square}-->
<!--			ul li {padding: 1px;}-->
<!--		</style>		-->
	</head>
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Equipo</font></p> 
			<table width="800" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Detallar registro</font></span></td></tr>
				<tr> 
  					<td>
  						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
  							<tr> 
								<td class="NoiseFooterTD">&nbsp;Ubicaci&oacute;n / Proceso</td>
								<td class="NoiseDataTD">&nbsp;<b><?php echo $rs_planta['plantanombre'].' / '.$rs_sistema['sistemnombre'] ?></b></td>
								<td class="NoiseErrorDataTD" rowspan="8" width="30%" align="center">
            						<ul class="gallery clearfix">
										<li><a href="../img/pics_equipos/<?php if($oldusuaimage): echo $oldusuaimage; else: ?>no_image.png<?php endif; ?>" rel="prettyPhoto" title="<?php echo trim($sbreg['equiponombre']) ?>"><img width="212" height="150" src="../img/pics_equipos/<?php if($oldusuaimage): echo $oldusuaimage; else: ?>no_image.png<?php endif; ?>"></a></li>
									</ul>
            					</td>
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
  						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
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
							<!-- <tr> 
								<td class="NoiseFooterTD" width="20%">&nbsp;Fabricante</td>
								<td class="NoiseDataTD" width="30%">&nbsp;<?php echo $sbreg['equipofabric'] ?></td>
								<td class="NoiseFooterTD" width="20%">&nbsp;Marca</td>
								<td class="NoiseDataTD" width="30%">&nbsp;<?php echo $sbreg['equipomarca'] ?></td>
							</tr>
							<tr> 
								<td class="NoiseFooterTD">&nbsp;Modelo</td>
								<td class="NoiseDataTD">&nbsp;<?php echo $sbreg['equipomodelo'] ?></td>
								<td class="NoiseFooterTD">&nbsp;No. serie</td>
								<td class="NoiseDataTD">&nbsp;<?php echo $sbreg['equiposerie'] ?></td>
							</tr>
							<tr> 
								<td class="NoiseFooterTD">&nbsp;No. inventario</td>
								<td class="NoiseDataTD">&nbsp;<?php echo $sbreg['equipocinv'] ?></td>
								<td class="NoiseFooterTD">&nbsp;Ubicaci&oacute;n</td>
								<td class="NoiseDataTD">&nbsp;<?php echo $sbreg['equipoubicac'] ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Vida &uacute;util</td>
								<td class="NoiseDataTD">&nbsp;<?php echo $sbreg['equipoviduti'] ?></td>
								<td class="NoiseFooterTD">&nbsp;Fecha compra</td>
								<td class="NoiseDataTD">&nbsp;<?php echo $sbreg['equipofeccom'] ?> aaaa-mm-dd</td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Fecha instalaci&oacute;n</td>
								<td class="NoiseDataTD">&nbsp;<?php echo $sbreg['equipofecins'] ?> aaaa-mm-dd</td>
								<td class="NoiseFooterTD">&nbsp;Venc. garant&iacute;a</td>
								<td class="NoiseDataTD">&nbsp;<?php echo $sbreg['equipovengar'] ?> aaaa-mm-dd</td>
							</tr>
							<tr> 
								<td class="NoiseFooterTD">&nbsp;NPAS</td>
								<td class="NoiseDataTD">&nbsp;<?php echo $sbreg['equiponpas'] ?></td>
								<td class="NoiseFooterTD" colspan="2">&nbsp;</td>
							</tr> -->
						</table>
					</td>
				</tr>
				<tr> 
  					<td>
  						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
				<?php
					include('../src/FunGen/floadnormaseguriequipo.php');
		          	floadnormaseguriequipo($sbreg[equipocodigo], $idcon);
				?>
						</table>
					</td>
				</tr>
				<tr> 
  					<td>
  						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
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
  						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
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
							<!-- <tr> 
								<td class="NoiseFooterTD" width="20%">&nbsp;Voltaje</td>
								<td class="NoiseDataTD" width="30%">&nbsp;<?php echo $sbreg['equipovolta'] ?></td>
								<td class="NoiseFooterTD" width="20%">&nbsp;Corriente</td>
								<td class="NoiseDataTD" width="30%">&nbsp;<?php echo $sbreg['equipocorrie'] ?></td>
							</tr>
							<tr> 
								<td class="NoiseFooterTD">&nbsp;Potencia</td>
								<td class="NoiseDataTD">&nbsp;<?php echo $sbreg['equipopoten'] ?></td>
								<td class="NoiseFooterTD">&nbsp;Nivel de tensi&oacute;n</td>
								<td class="NoiseDataTD">&nbsp;<?php echo $sbreg['equiponivten'] ?></td>
							</tr> -->
						</table>
					</td>
				</tr>
				<tr> 
  					<td>
  						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
  							<tr>
  								<td class="NoiseFooterTD" width="20%">&nbsp;Manuales</td>
          				  		<td valign="top" class="NoiseErrorDataTD" width="80%"><ul id="lista_manuales" class="example">
          						    <?php 
			                  			if($manuales)
			                  			{
			                  				for($b = 0; $b < count($manuales); $b++)
												echo "<li>".'<a href="'.$manuales[$b]['manualruta'].'"><b>'.$manuales[$b]['manualnombre'].'</b></a></li>';                  					
			                  			}
			                  		?>
								</ul></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Planos </td>
								<td colspan="4" class="NoiseDataTD"><ul id="lista_planos" class="example">
	                	        	<?php 
			                  			if($planos)
			                  			{
			                  				for($b = 0; $b < count($planos); $b++)
												echo "<li>".'<a href="'.$planos[$b]['planoruta'].'"><b>'.$planos[$b]['planonombre'].'</b></a></li>';                  					
			                  			}
			                  		?>
	                	        </ul></td>
							</tr> 
						</table> 
					</td>
				</tr>
				<tr>
		           	<td>
					<?php if($sbreg['equipocodigo']): ?>
						<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center"  class="ui-widget-content">
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
 				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center">
							<tr>
  								<td>
  									<div style="width:778px; height: 14px; margin:0 auto; text-align:left;" class="ui-state-default">&nbsp;&nbsp;
										<a onClick="return verocultar('involucrados',2);" href="javascript:animatedcollapse.toggle('involucrados');"><img id="row2" align="middle" align="top"  src="temas/Noise/<?php if($arrheots) echo 'AscOn'; else echo 'DescOn'  ?>.gif" border="0">&nbsp;Componentes</a>
									</div>
  									<div id="involucrados" style="display:none;">
										<?php 
											$equipocodigosel = $sbreg['equipocodigo'];
											$noAjax = true;
											include '../src/FunjQuery/jquery.visors/jquery.componen.php'; 
										?>
									</div>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_formdetall.php'; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr> 
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
 			<input type="hidden" name="flagdetallarequipo" value="1"> 
			<input type="hidden" name="acciondetallarequipo">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="nombtabl" value="equipo">
			<input type="hidden" name="columnas" value="equipocodigo,
estadocodigo,
sistemcodigo,
cencoscodigo,
equiponombre,
equipodescri,
equipofabric,
equipomarca,
equipomodelo,
equiposerie,
equipolargo,
equipoancho,
equipoalto,
equipopeso,
equipovolta,
equipocorrie,
equipopoten,
equipofeccom,
equipocinv,
equipovengar,
equipoviduti,
equipofecins,
equipoubicac,
equipovalhor,
equiponohs,
equipoacti,
equipotipo,
codigosrf,
equiponpas,
tipequcodigo,
usuacodigo"> 
			<input type="hidden" name="equipocodigo" value="<?php if($accionconsultarequipo) echo $equipocodigo; ?>"> 
			<input type="hidden" name="estadocodigo" value="<?php if($accionconsultarequipo) echo $estadocodigo; ?>"> 
			<input type="hidden" name="sistemcodigo" value="<?php if($accionconsultarequipo) echo $sistemcodigo; ?>"> 
			<input type="hidden" name="cencoscodigo" value="<?php if($accionconsultarequipo) echo $cencoscodigo; ?>"> 
			<input type="hidden" name="equiponombre" value="<?php if($accionconsultarequipo) echo $equiponombre; ?>"> 
			<input type="hidden" name="equipodescri" value="<?php if($accionconsultarequipo) echo $equipodescri; ?>"> 
			<input type="hidden" name="equipofabric" value="<?php if($accionconsultarequipo) echo $equipofabric; ?>"> 
			<input type="hidden" name="equipomarca" value="<?php if($accionconsultarequipo) echo $equipomarca; ?>"> 
			<input type="hidden" name="equipomodelo" value="<?php if($accionconsultarequipo) echo $equipomodelo; ?>"> 
			<input type="hidden" name="equiposerie" value="<?php if($accionconsultarequipo) echo $equiposerie; ?>"> 
			<input type="hidden" name="equipolargo" value="<?php if($accionconsultarequipo) echo $equipolargo; ?>"> 
			<input type="hidden" name="equipoancho" value="<?php if($accionconsultarequipo) echo $equipoancho; ?>"> 
			<input type="hidden" name="equipoalto" value="<?php if($accionconsultarequipo) echo $equipoalto; ?>"> 
			<input type="hidden" name="equipopeso" value="<?php if($accionconsultarequipo) echo $equipopeso; ?>"> 
			<input type="hidden" name="equipovolta" value="<?php if($accionconsultarequipo) echo $equipovolta; ?>"> 
			<input type="hidden" name="equipocorrie" value="<?php if($accionconsultarequipo) echo $equipocorrie; ?>"> 
			<input type="hidden" name="equipopoten" value="<?php if($accionconsultarequipo) echo $equipopoten; ?>"> 
			<input type="hidden" name="equipofeccom" value="<?php if($accionconsultarequipo) echo $equipofeccom; ?>"> 
			<input type="hidden" name="equipocinv" value="<?php if($accionconsultarequipo) echo $equipocinv; ?>"> 
			<input type="hidden" name="equipovengar" value="<?php if($accionconsultarequipo) echo $equipovengar; ?>"> 
			<input type="hidden" name="equipoviduti" value="<?php if($accionconsultarequipo) echo $equipoviduti; ?>"> 
			<input type="hidden" name="equipofecins" value="<?php if($accionconsultarequipo) echo $equipofecins; ?>"> 
			<input type="hidden" name="equipoubicac" value="<?php if($accionconsultarequipo) echo $equipoubicac; ?>"> 
			<input type="hidden" name="equipovalhor" value="<?php if($accionconsultarequipo) echo $equipovalhor; ?>"> 
			<input type="hidden" name="equiponohs" value="<?php if($accionconsultarequipo) echo $equiponohs; ?>"> 
			<input type="hidden" name="equipoacti" value="<?php if($accionconsultarequipo) echo $equipoacti; ?>"> 
			<input type="hidden" name="equipotipo" value="<?php if($accionconsultarequipo) echo $equipotipo; ?>"> 
			<input type="hidden" name="equiponpas" value="<?php if($accionconsultarequipo) echo $equiponpas; ?>"> 
			<input type="hidden" name="codigosrf" value="<?php if($accionconsultarequipo) echo $codigosrf; ?>"> 
			<input type="hidden" name="tipequcodigo" value="<?php if($accionconsultarequipo) echo $tipequcodigo; ?>"> 
			<input type="hidden" name="usuacodigo" value="<?php if($accionconsultarequipo) echo $usuacodigo; ?>"> 
			<input type="hidden" name="usuanombre" value="<?php if($accionconsultarequipo) echo $usuanombre; ?>"> 
			<input type="hidden" name="plantacodigo" value="<?php if($accionconsultarequipo) echo $plantacodigo; ?>"> 
			<input type="hidden" name="accionconsultarequipo" value="<?php echo $accionconsultarequipo; ?>">
		</form>
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function(){
				$(".gallery a[rel^='prettyPhoto']").prettyPhoto({ social_tools: false, theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */ });
			});
		</script>
	</body> 
<?php if(!$codigo){ echo " -->"; }?> 
</html>