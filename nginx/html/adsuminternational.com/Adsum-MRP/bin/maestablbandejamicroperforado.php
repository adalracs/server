<?php
ob_start();
ini_set('display_errors',1);
	include ( '../src/FunPerPriNiv/pktblvistabandejamicroperforado.php');
	include ( '../src/FunPerPriNiv/pktblopmicroperforado.php');
	include ( '../src/FunPerPriNiv/pktblprogramamicroperforado.php');
	include ( '../src/FunPerPriNiv/pktblplaneapadreitem.php');
	include ( '../src/FunPerPriNiv/pktblplaneaitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblsoliprogestado.php');
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunGen/fncnumprox.php');
	include ( '../src/FunGen/cargainput.php');
	include ( '../src/FunGen/fncnumact.php');
	include ( '../src/FunGen/floadtimehours.php');
	include ( '../src/FunGen/floadtimeminut.php');
	include ( '../src/FunPerSecNiv/fncsqlrun.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblop.php');
	include ( '../src/FunPerPriNiv/pktblopp.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktblpadreitem.php');
	include ( '../src/FunPerPriNiv/pktblitemdesa.php');
	include ( '../src/FunGen/sesion/fncalmdat.php'); 
	include ( '../src/FunGen/sesion/fnccaf.php');
	$reccomact =  fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]);
	
	//conexion
	$idcon = fncconn();
	$rs_equipo = fullscanprogramamicroperforadodisctequipo($idcon);
	//se cuenta el numero de resgistro de la consulta
	$nr_equipo = fncnumreg($rs_equipo);unset($arrequipo);
	//se recorre la consulta 	
	for($a = 0;$a < $nr_equipo;$a++)
	{
		//se extrae un de la consulta respecto a su indice
		$rw_equipo = fncfetch($rs_equipo,$a);
		//se crea el array de equipos para ser explosionado
		$arrequipo = ($arrequipo)? $arrequipo = $arrequipo.','.$rw_equipo['equipocodigo'] : $arrequipo = $rw_equipo['equipocodigo'];
		//se asigna la variable equipo
		$equipo = $rw_equipo['equipocodigo'];
		if($equipo)
			$rs_opp = dinamicscanopprogramamicroperforado1(array('equipocodigo' => $equipo),array('equipocodigo' => '='),$idcon);
		//se consulta el numero de registros
		$nr_opp = fncnumreg($rs_opp);
		//objetos para el total por maquina
		$total_equipound = $equipo.'_und';
		$total_equipomts = $equipo.'_mts';
		$total_equipokgs = $equipo.'_kgs';
		//ciclo para sumar cantidades por maquina
		for($b = 0; $b < $nr_opp; $b++)
		{
			$rw_opp = fncfetch($rs_opp, $b);
			//sumatoria de unidades , metros, kilogramos
			$$total_equipound = $$total_equipound + 1; 
			$$total_equipokgs = $$total_equipokgs + $rw_opp['ordoppcantid'];
			$$total_equipomts = $$total_equipomts + $rw_opp['ordoppmetros'];
		}
	}
ob_end_flush();
?>
<html>
	<head>
		<title>Bandeja de solicitudes microperforado</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunGen/starPage_position.js"></script>		
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.ui.ajax_accionextras.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_bandejamcr.js"></script>
	</head>
	<?php if(!$codigo){echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">{Microperforado}</font></p>			
			<div id="bandejaotgeneral">
				<ul>
					<li><a href="#tabs-1">Bandeja de op</a></li>
					<li><a href="#tabs-2">Ordenes de produccion {opp}</a></li>
				</ul>
				<div id="tabs-1">
					<table width="100%" align="center" cellpadding="1" cellspacing="1">
			    		<tr>
							<td>
								<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
									<tr>
										<td>
											<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
												<tr>
		  											<td class="ui-state-default">&nbsp;&nbsp;op de microperforado
						       							<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
						       								<tr>
																<td class="NoiseFooterTD">
																	<div id="detallebandejamicroperforado" style="height: 350px; margin:0 auto; overflow:auto;">
																		<?php $noAjax = true;include 'detallabandejamicroperforado.php'; ?>
																	</div>
																</td>
															</tr>
						                   				</table>
													</td>
												</tr>					        				
						                   	</table>
										</td>
									</tr>
									<tr>
		  								<td class="ui-state-default">&nbsp;&nbsp;Resumen de bandeja
						        			<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
						        				<tr>
													<td width="15%"  class="NoiseFooterTD">&nbsp;<b>Total Ordenes.</b></td>
													<td width="15%"  class="NoiseFooterTD">&nbsp;<span id="total_und_lbl"><?php echo number_format($total_und, 2, ',', '.') ?></span></td>
													<td width="15%"  class="NoiseFooterTD">&nbsp;<b>Total Kilogramos.</b></td>
													<td width="15%"  class="NoiseFooterTD">&nbsp;<span id="total_kgs_lbl"><?php echo number_format($total_kgs, 2, ',', '.') ?></span></td>
													<td width="15%"  class="NoiseFooterTD">&nbsp;<b>Total Metros.</b></td>
													<td width="25%"  class="NoiseFooterTD">&nbsp;<span id="total_mts_lbl"><?php echo number_format($total_mts, 2, ',', '.') ?></span></td>
												</tr>
						                   	</table>
										</td>
									</tr>
									<tr>
										<td class="ui-state-default">&nbsp;<a onClick="return verocultar('filresbandejaop',2);" href="javascript:animatedcollapse.toggle('filresbandejaop');"><img id="row2" align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0">&nbsp;Filtro Resumen de bandeja por equipo</a>
											<div id="filresbandejaop" style="padding: 2px 2px 2px 2px; display:none;" >
						        				<table width="96%" border="0" cellspacing="1" cellpadding="0" align="center">
													<?php 
														//se valida y explosiona el array de equipos => arrequipo
														if($arrequipo) 
														{
															$arrObject = explode(',',$arrequipo);
															//se recorre el array
															for($a = 0;$a < count($arrObject);$a++)
															{	
																$equipo = $arrObject[$a];
																//objetos para el total por maquina
																$total_equipound = $equipo.'_und';
																$total_equipokgs = $equipo.'_kgs';
																$total_equipomts = $equipo.'_mts';
													?>
													<tr>
							  							<td class="ui-state-default">&nbsp;&nbsp;<?php echo cargaequiponombre($equipo,$idcon) ?>
											        		<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
											       				<tr>
																	<td width="15%"  class="NoiseFooterTD">&nbsp;<b>Total Ordenes.</b></td>
																	<td width="15%"  class="NoiseDataTD">&nbsp;<span id="total_und_lbl"><?php echo number_format($$total_equipound, 2, ',', '.') ?></span></td>
																	<td width="15%"  class="NoiseFooterTD">&nbsp;<b>Total Kilogramos.</b></td>
																	<td width="15%"  class="NoiseDataTD">&nbsp;<span id="total_kgs_lbl"><?php echo number_format($$total_equipokgs, 2, ',', '.') ?></span></td>
																	<td width="15%"  class="NoiseFooterTD">&nbsp;<b>Total Metros.</b></td>
																	<td width="25%"  class="NoiseDataTD">&nbsp;<span id="total_mts_lbl"><?php echo number_format($$total_equipomts, 2, ',', '.') ?></span></td>
																</tr>
											         		</table>
														</td>
													</tr>
													<?php 
															}
														}
														else
														{
											 		?>
													<tr>
											  			<td class="ui-state-default">
										  					<div class="ui-widget">
				 												<div style="margin-top: 20px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all"> 
			  														<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
			  														<b>No se encontraron OPP.</b></p>
			 													</div>
															</div>
										  				</td>
										  			</tr>
													<?php 
														}
													?>		
												</table>
											</div>
								 		</td>
						 			</tr>
								</table>
							</td>
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td class="NoiseErrorDataTD" align="center"><div class="ui-buttonset">
								<?php  		
									if($reccomact[nuevo] && !$flagcheck)
										echo '<button id="generaropp_mcr">Generar [opp]</button>&nbsp';
								?>
							</div></td>
						</tr>
						<tr><td>&nbsp;</td></tr> 
					</table>
			  	</div>
				<div id="tabs-2">
				  		<table width="100%" align="center" cellpadding="1" cellspacing="1">
				    		<tr>
								<td>
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td>
												<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
													<tr>
			  											<td class="ui-state-default">&nbsp;&nbsp;
							        						<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
							        							<tr>
																	<td class="NoiseFooterTD">
																		<div id="detalleordenmicroperforado" style="height: 350px; margin:0 auto; overflow:auto;">
																			<?php $noAjax = true;include 'detallaordenmicroperforado.php'; ?>
																		</div>
																	</td>
																</tr>
							                   				</table>						                   				
														</td>
													</tr>					        				
							                   	</table>
											</td>
										</tr>
										<tr>
			  								<td class="ui-state-default">&nbsp;&nbsp;Resumen de las ordenes
							        			<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
							        				<tr>
														<td width="15%"  class="NoiseFooterTD">&nbsp;<b>Total Ordenes.</b></td>
														<td width="15%"  class="NoiseFooterTD">&nbsp;<span id=totalopp_und_lbl><?php echo number_format($totalopp_und, 2, ',', '.') ?></span></td>
														<td width="15%"  class="NoiseFooterTD">&nbsp;<b>Total Kilogramos.</b></td>
														<td width="15%"  class="NoiseFooterTD">&nbsp;<span id="totalopp_kgs_lbl"><?php echo number_format($totalopp_kgs, 2, ',', '.') ?></span></td>
														<td width="15%"  class="NoiseFooterTD">&nbsp;<b>Total Metros.</b></td>
														<td width="25%"  class="NoiseFooterTD">&nbsp;<span id=totalopp_mts_lbl><?php echo number_format($totalopp_mts, 2, ',', '.') ?></span></td>
													</tr>
							                   	</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr><td>&nbsp;</td></tr>
							<tr>
								<td class="NoiseErrorDataTD" align="center"><div class="ui-buttonset">
									<?php  		
										if($reccomact[modificar] && !$flagcheck)
											echo '<button id="editaropp_mcr">Editar [opp]</button>';
									?>
								</div></td>
							</tr>
							<tr><td>&nbsp;</td></tr> 
						</table>
				  	</div>
				</div>
			<input type="hidden" name="accionnuevoopp" />
			<input type="hidden" name="arrop" id="arrop" value="<?php echo $arrop?>" />
			<input type="hidden" name="arropp" id="arropp" value="<?php echo $arropp?>" />
			<input type="hidden" name="codigo" id="codigo" value="<?php echo $codigo; ?>" />
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
  	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>