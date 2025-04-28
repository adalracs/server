<?php
ini_set("display_error", 1);

	include_once ( '../src/FunPerPriNiv/pktblvistabandejaflexografia.php');
	include_once ( '../src/FunPerPriNiv/pktblprocedimiento.php');
	include_once ( '../src/FunPerPriNiv/pktblvelocidadpn.php');	
	include_once ( "../src/FunGen/fncobtenercampertippro.php");
	include_once ( '../src/FunPerPriNiv/pktblpadreitem.php');
	include_once ( '../src/FunPerPriNiv/pktblajustepn.php');			
	include_once ( '../src/FunPerPriNiv/pktblitemdesa.php');	
	include_once ( '../src/FunGen/sesion/fncvarsesion.php');
	include_once ( '../src/FunPerPriNiv/pktblsoliprog.php');
	include_once ( '../src/FunPerPriNiv/pktblusuario.php');	
	include_once ( '../src/FunPerPriNiv/pktblplanta.php');
	include_once ( '../src/FunPerPriNiv/pktblequipo.php');
	include_once ( '../src/FunGen/sesion/fncvalses.php');
	include_once ( '../src/FunGen/floadtimehours.php');
	include_once ( '../src/FunGen/floadtimeminut.php');
	include_once ( '../src/FunPerPriNiv/pktblop.php');
	include_once ( '../src/FunGen/fncstrfecha.php');
	include_once ( '../src/FunGen/cargainput.php');	

	if($arrop) $objsarrop = explode(",", $arrop); else $objsarrop;

	if($accionnuevoopp)
		include ( 'grabaopp_flx.php');

	if(!$flagnuevoopp){

		$ordoppcantkg = 0;
		$ordoppcantmt = 0;
		$ordoppcalibr = 0;
		$ordoppancref = 0;

		if($arrmaterial) $objsarrmaterial = explode(':|:',$arrmaterial); else unset($objsarrmaterial);

		if( count($objsarrmaterial) > 0 && $matimprimir > 0){

			for($a =  0; $a < count($objsarrmaterial); $a++){

				if($matimprimir == $objsarrmaterial[$a]){

					$objCantKgs = "cantkgs_".$objsarrmaterial[$a].($a + 1);
					$objCantMts = "cantmts_".$objsarrmaterial[$a].($a + 1);
					$objCalibre = "calibre_".$objsarrmaterial[$a].($a + 1);
					$objRefile = "refile_".$objsarrmaterial[$a].($a + 1);

					$ordoppcantkg = $$objCantKgs;
					$ordoppcantmt = $$objCantMts;
					$ordoppcalibr = $$objCalibre;
					$ordoppancref = $$objRefile;
				}

			}

		}

	}

	$idcon = fncconn();	
?>
<html> 
	<head> 
		<title>Nuevo registro de orden de produccion flexografia programadas</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.ui.ajax_accionextras.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_bandejaflx.js"></script>
	</head>
	<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Orden de flexografia</font></p> 
			<table width="800" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content">
<?php if($flagerrorasignacion): ?>
				<tr><td><div class="ui-widget">
					<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
						<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
						<strong>Advertencia:</strong> Materiales asignados no cumplen los requerimientos de la orden.</p>
					</div>
				</div></td></tr>
<?php elseif($campnomb): ?> 
				<tr><td><div class="ui-widget">
					<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
						<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
						<strong>Advertencia:</strong> Corrija los campos marcados con *</p>
					</div>
				</div></td></tr>	

<?php else: ?> 		
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
<?php endif; ?>
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Ingresar nuevo registro</font></span></td></tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr><td class="ui-state-default">&nbsp;<small><?php echo strfecha(date("Y-m-d"))  ?></small></td></tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["plantacodigo"] == 1)echo "*"; ?>&nbsp;Ubicaci&oacute;n</td>
          						<td width="80%" class="NoiseDataTD"><select name="plantacodigo" id="plantacodigo">
          							<option value = "">-- Seleccione --</option>
									<?php
										include ('../src/FunGen/floadplanta.php');
										floadplanta($plantacodigo,$idcon);
									?>
            					</select></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<div id="filtrlistordenesflexo">
							<?php
								$noAjax = true;
								include '../src/FunjQuery/jquery.phpscripts/jq.listordenesflexo.php';  
							?>
						</div>
					</td>
				</tr>
      			<tr>
					<td>
						<div id="filtrlistmaterialesflexo">
							<?php
								$noAjax = true;
								include '../src/FunjQuery/jquery.phpscripts/jq.listmaterialesflexo.php';  
							?>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div id="filtrlistaplaneacion" style="display:none">
							<?php
								$noAjax = true;
								include '../src/FunjQuery/jquery.phpscripts/jquery.ajax_planeacion1.php';  
							?>
						</div>
					</td>
				</tr>
      			<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">		
							<tr><td class="ui-state-default" colspan="5">&nbsp;Datos de la opp</td></tr>
							<tr>
            					<td width="20%" class="NoiseFooterTD"><?php if($campnomb["equipocodigo"] == 1)echo "*"; ?>&nbsp;Equipo&nbsp;</td>
            					<td width="30%" class="NoiseDataTD">
            						<select name="equipocodigo" id="equipocodigo" onchange="reladlistVelocidadpn();reladlistAjsutepn();">
										<option value = "">-- Seleccione --</option>
		            					<?php
											include ('../src/FunGen/floadequipoop.php');
											floadequipoop_flx($equipocodigo,$idcon);
				    					?>
									</select>
		  						</td>
		  						<td width="20%" class="NoiseFooterTD"><?php if($campnomb["proceddestin"] == 1)echo "*"; ?>&nbsp;Entegar a:</td>
								<td width="30%" class="NoiseDataTD"><select name="proceddestin" id="proceddestin">
          							<option value = "">-- Seleccione --</option>
									<?php
										include_once ('../src/FunGen/floadprocedimiento.php');
										floadprocedimiento($proceddestin,$idcon);
									?>
            						</select>
            					</td>
		  					</tr>
		  					<tr>
		  						<td width="20%" class="NoiseFooterTD"><?php if($campnomb["ordoppanchot"] == 1)echo "*"; ?>&nbsp;Ancho Bobina <b>(mm)</b></td>
            					<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="ordoppanchot" id="ordoppanchot" value="<?php echo $ordoppanchot ?>" /><?php echo ($ordoppanchot)? number_format($ordoppanchot, 2, ",", ".") : '---' ;?></td>
            					<td width="20%" class="NoiseFooterTD"><?php if($campnomb["ordoppcantmt"] == 1)echo "*"; ?>&nbsp;Metros <b>(mts)</b></td>
            					<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="ordoppcantmt" id="ordoppcantmt" value="<?php echo $ordoppcantmt ?>" /><?php echo ($ordoppcantmt)? number_format($ordoppcantmt, 2, ",", ".") : '---' ;?></td>
		  					</tr>
		  					<tr>
		  						<td width="20%" class="NoiseFooterTD"><?php if($campnomb["ordoppcalibr"] == 1)echo "*"; ?>&nbsp;Calibre <b>(&micro;m)</b></td>
            					<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="ordoppcalibr" id="ordoppcalibr" value="<?php echo $ordoppcalibr ?>" /><?php echo ($ordoppcalibr)? number_format($ordoppcalibr, 2, ",", "." ) : '---' ;?></td>
		  						<td width="20%" class="NoiseFooterTD"><?php if($campnomb["ordoppcantkg"] == 1)echo "*"; ?>&nbsp;Cantidad <b>(kgs)</b></td>
            					<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="ordoppcantkg" id="ordoppcantkg" value="<?php echo $ordoppcantkg ?>" /><?php echo ($ordoppcantkg)? number_format($ordoppcantkg, 2, ",", "." ) : '---' ;?></td>
		  					</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">		
							<tr><td class="ui-state-default" colspan="2"><?php if($campnomb["arrvelocidadpn"] == 1)echo "*"; ?>&nbsp;Datos de orden - velocidad de orden</td></tr>
		  					<tr>
 								<td colspan="2">
 									<div id="listavelocidadpn">
 										<?php 
 											$noAjax = true;
 											$tipsolcodigo = 3;//id tiposoliprog flexografia
 											include "../src/FunjQuery/jquery.visors/jquery.velocidadpn.php";
 										?>
 									</div>
 									<input type="hidden" name="arrvelocidadpn" id="arrvelocidadpn" size="60"value="<?php echo $arrvelocidadpn ?>" />
									<input type="hidden" name="arrvelocidadpntmp" id="arrvelocidadpntmp" size="60"value="<?php echo $arrvelocidadpntmp ?>" />
 								</td>
 							</tr>
		  				</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">		
							<tr><td class="ui-state-default" colspan="2"><?php if($campnomb["arrajustepn"] == 1)echo "*"; ?>&nbsp;Datos de orden - Ajustes y/o cambios en orden</td></tr>
		  					<tr>
		  				</tr>
		  				<tr>
 							<td colspan="2">
 								<div id="listaajustepn">
 									<?php 
 										$noAjax = true;
 										$tipsolcodigo = 3;//id tiposoliprog flexografia
 										include "../src/FunjQuery/jquery.visors/jquery.ajustepn.php";
 									?>
 								</div>
 								<input type="hidden" name="arrajustepn" id="arrajustepn" size="60"value="<?php echo $arrajustepn ?>" />
								<input type="hidden" name="arrajustepntmp" id="arrajustepntmp" size="60"value="<?php echo $arrajustepntmp ?>" />
 							</td>
 						</tr>
 					</table>
 				</td>
 			</tr>
			<tr><td>&nbsp;</td></tr>
			<tr>
				<td class="NoiseErrorDataTD" align="center"><div class="ui-buttonset">
					<button id="aceptaropp_flx">Aceptar</button>&nbsp;&nbsp;&nbsp;&nbsp;
					<button id="cancelaropp_flx">Cancelar</button>
				</div></td>
			</tr>
			<tr><td>&nbsp;</td></tr> 
			<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table>
			<input type="hidden" name="arrmatlaminar" id="arrmatlaminar" value="<?php echo $arrmatlaminar; ?>" />
			<input type="hidden" name="tipprocodigo" id="tipprocodigo" value="<?php echo $tipprocodigo; ?>" />
			<input type="hidden" name="totalgramaje" id="totalgramaje" value="<?php echo $totalgramaje; ?>" />
			<input type="hidden" name="totalcalibre" id="totalcalibre" value="<?php echo $totalcalibre; ?>" />
			<input type="hidden" name="arrrutaitem" id="arrrutaitem" value="<?php echo $arrrutaitem; ?>" />
			<input type="hidden" name="cant_planea" id="cant_planea" value="<?php echo $cant_planea; ?>" />
			<input type="hidden" name="matimprimir" id="matimprimir" value="<?php echo $matimprimir; ?>" />
			<input type="hidden" name="arrmaterial" id="arrmaterial" value="<?php echo $arrmaterial; ?>" />
			<input type="hidden" name="arrcalibre" id="arrcalibre" value="<?php echo $arrcalibre; ?>" />
			<input type="hidden" name="arrmatplan" id="arrmatplan" value="<?php echo $arrmatplan; ?>"> 
			<input type="hidden" name="unimedi" id="unimedi" value="<?php echo $unimedi; ?>" />
			<input type="hidden" name="codigo" id="codigo" value="<?php echo $codigo; ?>" />
			<input type="hidden" name="ancho" id="ancho" value="<?php echo $ancho; ?> " />
			<input type="hidden" name="arrop" id="arrop" value="<?php echo $arrop; ?>" /> 
			<input type="hidden" name="sourceaction" value="nuevo">
			<input type="hidden" name="sourcetable" value="opp">
			<input type="hidden" name="accionnuevoopp"> 
			<input type="hidden" name="flagnuevoopp">			
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>