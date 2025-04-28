<?php

ob_start();
	include ( '../src/FunPerPriNiv/pktblformula.php');
	include ( '../src/FunPerPriNiv/pktblvistabandejaflexografia.php');
	include ( '../src/FunPerPriNiv/pktblprogramaflexo.php');
	include ( '../src/FunPerPriNiv/pktblplaneaitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblsoliprog.php');
	include ( '../src/FunPerPriNiv/pktblpadreitem.php');
	include ( '../src/FunPerPriNiv/pktblproducto.php');
	include ( '../src/FunPerPriNiv/pktblitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerSecNiv/fncsqlrun.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunGen/floadtimehours.php');
	include ( '../src/FunGen/floadtimeminut.php');
	include ( '../src/FunGen/fncnumprox.php');
	include ( '../src/FunGen/cargainput.php');
	include ( '../src/FunGen/fncnumact.php');	
	include ( '../src/FunPerPriNiv/pktblop.php');
	include ( '../src/FunPerPriNiv/pktblopflexo.php');
	include ( '../src/FunPerPriNiv/pktblopp.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunGen/sesion/fncalmdat.php'); 
	include ( '../src/FunGen/sesion/fnccaf.php');
	$reccomact =  fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]);
	//conexion
	$idcon = fncconn();
	$rs_equipo = fullscanprogramaflexodisctequipo($idcon);
	//se cuenta el numero de resgistro de la consulta
	$nr_equipo = fncnumreg($rs_equipo);;unset($arrequipo);
	//se recorre la consulta 	
	for($a = 0;$a < $nr_equipo;$a++)
	{
		//se extrae un de la consulta respecto a su indice
		$rw_equipo = fncfetch($rs_equipo,$a);
		//se crea el array de equipos para ser explosionado
		$arrequipo = ($arrequipo)? $arrequipo = $arrequipo.','.$rw_equipo['equipocodigo'] : $arrequipo = $rw_equipo['equipocodigo'];
		//se asigna la variable equipo
		$equipo = $rw_equipo['equipocodigo'];
		//consulta dinamica al programa de flexo
		$rs_opp = dinamicscanopprogramaflexo1(array('equipocodigo' => $equipo),array('equipocodigo' => '='),$idcon);
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
			$$total_equipokgs = $$total_equipokgs + $rw_opp['ordoppcantkg'];
			$$total_equipomts = $$total_equipomts + $rw_opp['ordoppcantmt'];
		}
	}
ob_end_flush();
?>
<html>
	<head>
		<title>Bandeja de solicitudes flexografia</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunGen/starPage_position.js"></script>		
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.ui.ajax_accionextras.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_bandejaflx.js"></script>
	</head>
	<?php if(!$codigo){echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<!--<p><font class="NoiseFormHeaderFont">{Flexografia}</font></p>-->
			<div id="bandejaotgeneral" style="width:900px;align:center;margin-left:20px;">
				<ul>
					<li><a href="#tabs-1"><span class="ui-icon ui-icon-clipboard" style="float: left; margin-right: .3em;"></span>Bandeja flexografia.</a></li>
					<li><a href="#tabs-2"><span class="ui-icon ui-icon-star" style="float: left; margin-right: .3em;"></span>Ordenes de producci&oacute;n.</a></li>
				</ul>
				<div id="tabs-1">
					<table width="860px" align="center" cellpadding="1" cellspacing="1">
			    		<tr>
							<td>
								<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
									<tr>
					  					<td class="ui-state-default">&nbsp;<a onClick="return verocultar('filopsbandejaop',1);" href="javascript:animatedcollapse.toggle('filopsbandejaop');"><img id="row1" align="middle" align="top"  src="temas/Noise/AscOn.gif" border="0">&nbsp;Filtros de la bandeja.</a>
											<div id="filopsbandejaop" style="padding: 2px 2px 2px 2px; display:block;" >
									   			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center">
										       		<tr>
														<td width="10%"  class="NoiseFooterTD">&nbsp;Planta</td>
														<td width="40%"  class="NoiseFooterTD"><select name="plantacodigo" id="plantacodigo" onchange="ajax_filtro();">
															<option value = "">-- Seleccione --</option>
															<?php
																include ('../src/FunGen/floadplanta.php');
																floadplanta($plantacodigo,$idcon);
															?>
														</select></td>
														<td width="10%"  class="NoiseFooterTD">&nbsp;Rodillo</td>
														<td width="40%"  class="NoiseFooterTD"><select name="ordprorodill" id="ordprorodill" onchange="ajax_filtro();">
															<option value = "">-- Seleccione --</option>
															<?php
																include ('../src/FunGen/floadvistabandejaflexografia.php');
																floadvistabandejaflexografia_rodill($ordprorodill,$idcon);
															?>
														</select></td>
													</tr>
													<tr>
														<td width="10%"  class="NoiseFooterTD">&nbsp;Calibre</td>
														<td class="NoiseFooterTD"><select name=ordprocalibr id="ordprocalibr" onchange="ajax_filtro();">
															<option value = "">-- Seleccione --</option>
															<?php																
																floadvistabandejaflexografia_calibre($ordprocalib,$idcon);
															?>
														</select></td>
														<td width="10%"  class="NoiseFooterTD">&nbsp;Estructura.</td>
														<td width="40%"  class="NoiseFooterTD"><select name="ordproestruc" id="ordproestruc" onchange="ajax_filtro();">
															<option value = "">-- Seleccione --</option>
															<?php
																floadvistabandejaflexografia_estructura($ordproestruc,$idcon);
															?>
														</select></td>
													</tr>
						                   		</table>
						               		</div> 
										</td>
									</tr>
									<tr>
										<td class="ui-state-default">
											<div id="detallebandejaflexografia" style="height: 350px; margin:0 auto; overflow:auto;">
												<?php $noAjax = true;include 'detallabandejaflexografia.php'; ?>
											</div>
										</td>
									</tr>
									<tr>
		  								<td class="ui-state-default"><span class="ui-icon ui-icon-pencil" style="float: left; margin-right: .3em;"></span>Resumen de bandeja.
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
										<td class="ui-state-default">&nbsp;<a onClick="return verocultar('filresbandejaop',2);" href="javascript:animatedcollapse.toggle('filresbandejaop');"><img id="row2" align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0">&nbsp;Filtro Resumen de bandeja por equipo.</a>
											<div id="filresbandejaop" style="padding: 2px 2px 2px 2px; display:none;" >
						        				<table width="96%" border="0" cellspacing="1" cellpadding="0" align="center">
												<?php 
													//se valida y explosiona el array de equipos => arrequipo
													if($arrequipo){
														$arrObject = explode(',',$arrequipo);
														//se recorre el array
														for($a = 0;$a < count($arrObject);$a++){	
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
																	<td width="15%"  class="NoiseDataTD">&nbsp;<span id="total_und_lbl"><?php echo number_format($$total_equipound, 0, ',', '.') ?></span></td>
																	<td width="15%"  class="NoiseFooterTD">&nbsp;<b>Total Kilogramos.</b></td>
																	<td width="15%"  class="NoiseDataTD">&nbsp;<span id="total_kgs_lbl"><?php echo number_format($$total_equipokgs, 0, ',', '.') ?></span></td>
																	<td width="15%"  class="NoiseFooterTD">&nbsp;<b>Total Metros.</b></td>
																	<td width="25%"  class="NoiseDataTD">&nbsp;<span id="total_mts_lbl"><?php echo number_format($$total_equipomts, 0, ',', '.') ?></span></td>
																</tr>
											         		</table>
														</td>
													</tr>
												<?php 
														}
													}else{
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
									if($reccomact[simular] && !$flagcheck)
										echo '<button id="simularopp_flx">Simular [oop]</button>';
								?>
							</div></td>
						</tr>
						<tr><td>&nbsp;</td></tr> 
					</table>
			  	</div>
			  	<div id="tabs-2">
			  		<table width="860px" align="center" cellpadding="1" cellspacing="1">
			    		<tr>
							<td>
								<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
									<tr>
		  								<td class="ui-state-default">&nbsp;<a onClick="return verocultar('filopsbandejaopp',3);" href="javascript:animatedcollapse.toggle('filopsbandejaopp');"><img id="row3" align="middle" align="top"  src="temas/Noise/AscOn.gif" border="0">&nbsp;Filtros de las ordenes.</a>
											<div id="filopsbandejaopp" style="padding: 2px 2px 2px 2px; display:block;" >
						        				<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center">
						        					<tr>
														<td width="10%"  class="NoiseFooterTD">&nbsp;Planta</td>
														<td width="40%"  class="NoiseFooterTD"><select name="plantacodigo_opp" id="plantacodigo_opp" onchange="ajax_filtroopp();">
															<option value = "">-- Seleccione --</option>
															<?php
																floadplanta($plantacodigo_opp,$idcon);
															?>
														</select></td>
														<td width="10%"  class="NoiseFooterTD">&nbsp;Rodillo</td>
														<td width="40%"  class="NoiseFooterTD"><select name="ordprorodill_opp" id="ordprorodill_opp" onchange="ajax_filtroopp();">
															<option value = "">-- Seleccione --</option>
															<?php
																floadvistabandejaflexografia_rodillopp($ordprorodill_opp,$idcon);
															?>
														</select></td>
													</tr>
													<tr>
														<td width="10%"  class="NoiseFooterTD">&nbsp;Calibre</td>
														<td class="NoiseFooterTD"><select name="ordprocalibr_opp" id="ordprocalibr_opp" onchange="ajax_filtroopp();">
															<option value = "">-- Seleccione --</option>
															<?php																
																floadvistabandejaflexografia_calibreopp($ordprocalibr_opp,$idcon);
															?>
														</select></td>
														<td width="10%"  class="NoiseFooterTD">&nbsp;Estructura.</td>
														<td width="40%"  class="NoiseFooterTD"><select name="ordproestruc_opp" id="ordproestruc_opp" onchange="ajax_filtroopp();">
															<option value = "">-- Seleccione --</option>
															<?php
																floadvistabandejaflexografia_estructuraopp($ordproestruc_opp,$idcon);
															?>
														</select></td>
													</tr>
						                   		</table>
						                   	</div> 
										</td>
									</tr>
									<tr>
										<td class="ui-state-default">
											<div id="detalleordenflexo" style="height: 350px; margin:0 auto; overflow:auto;">
												<?php $noAjax = true;include 'detallaordenflexo.php'; ?>
											</div>
										</td>
									</tr>		
									<tr>
		  								<td class="ui-state-default"><span class="ui-icon ui-icon-pencil" style="float: left; margin-right: .3em;"></span>Resumen de las ordenes.
						        			<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
						        				<tr>
													<td width="15%"  class="NoiseFooterTD">&nbsp;<b>Total Ordenes.</b></td>
													<td width="15%"  class="NoiseFooterTD">&nbsp;<span id=totalopp_und_lbl><?php echo number_format($totalopp_und, 0, ',', '.') ?></span></td>
													<td width="15%"  class="NoiseFooterTD">&nbsp;<b>Total Kilogramos.</b></td>
													<td width="15%"  class="NoiseFooterTD">&nbsp;<span id="totalopp_kgs_lbl"><?php echo number_format($totalopp_kgs, 0, ',', '.') ?></span></td>
													<td width="15%"  class="NoiseFooterTD">&nbsp;<b>Total Metros.</b></td>
													<td width="25%"  class="NoiseFooterTD">&nbsp;<span id=totalopp_mts_lbl><?php echo number_format($totalopp_mts, 0, ',', '.') ?></span></td>
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
										echo '<button id="editaropp_flx">Editar [opp]</button>';
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