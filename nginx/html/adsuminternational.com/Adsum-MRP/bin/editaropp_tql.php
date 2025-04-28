<?php
	ini_set('display_errors',1);
	include ( '../src/FunPerPriNiv/pktblvistabandejatroquelado.php');
	include ( '../src/FunPerPriNiv/pktblprocedimiento.php');
	include ( '../src/FunPerPriNiv/pktbloppvelocidadpn.php');
	include ( '../src/FunPerPriNiv/pktbloppajustepn.php');	
	include ( '../src/FunGen/sesion/fncvarsesion.php');
	include ( '../src/FunPerPriNiv/pktblvelocidadpn.php');			
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktblsoliprog.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');	
	include ( '../src/FunPerPriNiv/pktbloptroquelado.php');				
	include ( '../src/FunPerPriNiv/pktblajustepn.php');		
	include ( '../src/FunPerPriNiv/pktblitemdesa.php');			
	include ( '../src/FunGen/floadtimehours.php');
	include ( '../src/FunGen/floadtimeminut.php');
	include ( '../src/FunPerPriNiv/pktblopp.php');
	include ( '../src/FunPerPriNiv/pktblop.php');
	include ( '../src/FunGen/fncstrfecha.php');
	include ( '../src/FunGen/cargainput.php');				
	
	if($accioneditaropp)
		include ( 'editaopp_tql.php');
	
	if(!$flageditaropp)
	{
		$idcon = fncconn();
		$sbreg = loadrecordopp($arropp,$idcon);		
		$ordoppcodigo = $sbreg['ordoppcodigo'];
		$plantacodigo = $sbreg['plantacodigo'];
		$ordoppanchot = $sbreg['ordoppanchot'];
		$ordoppcantkg = $sbreg['ordoppcantkg'];
		$ordoppcantmt = $sbreg['ordoppcantmt'];
		$equipocodigo = $sbreg['equipocodigo'];
		$ordoppancref = ($sbreg['ordoppancref'])? $sbreg['ordoppancref'] : 0 ;
		$ordoppcorte = $sbreg['ordoppcorte'];
		
		$rsOrdproduccion = dinamicscanopoptroquelado(array('ordoppcodigo' => $arropp),array('ordoppcodigo' => '='),$idcon);
		$nrOrdproduccion = fncnumreg($rsOrdproduccion);
		for($a = 0; $a < $nrOrdproduccion; $a++)
		{
			$rwOrdproduccion = fncfetch($rsOrdproduccion,$a);
			$arrop = $rwOrdproduccion['ordprocodigo'];
			$ordoppcalibr = $rwOrdproduccion['ordprocalibr'];
			$proceddestin = $rwOrdproduccion['proceddestin'];
			//objetos a usar
			$obj_itedes = 'itedescodigo_'.$rwOrdproduccion['ordprocodigo'];
			$$obj_itedes = $rwOrdproduccion['itedescodigo'];
		}
		
		$rsOppVelocidadpn = dinamicscanopoppvelocidadpn(array('ordoppcodigo' => $arropp),array('ordoppcodigo' => '='),$idcon);
		$nrOppVelocidadpn = fncnumreg($rsOppVelocidadpn);
		for($a = 0; $a < $nrOppVelocidadpn; $a++)
		{
			$rwOppVelocidadpn = fncfetch($rsOppVelocidadpn,$a);
			$arrvelocidadpn = ($arrvelocidadpn)? $arrvelocidadpn.','.$rwOppVelocidadpn['velocicodigo'] : $rwOppVelocidadpn['velocicodigo'];
		}
		unset($arrvelocidadpn);
		
		$rsOppAjustepn = dinamicscanopoppajustepn(array('ordoppcodigo' => $arropp),array('ordoppcodigo' => '='),$idcon);
		$nrOppAjustepn = fncnumreg($rsOppAjustepn);
		for($a = 0; $a < $nrOppAjustepn; $a++)
		{
			$rwOppAjustepn = fncfetch($rsOppAjustepn,$a);
			$arrajustepn = ($arrajustepn)? $arrajustepn.','.$rwOppAjustepn['ajustecodigo'] : $rwOppAjustepn['ajustecodigo'];
		}
		unset($arrajustepn);
		
	}
		
	$idcon = fncconn();
?>
<html> 
	<head> 
		<title>editar registro de orden de produccion troquelado programadas</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.ui.ajax_accionextras.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_bandejatql.js"></script>
	</head>
	<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Orden de troquelado</font></p> 
			<table width="800" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content">
<?php if($campnomb): ?>
				<tr><td><div class="ui-widget">
					<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
						<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
						<strong>Advertencia:</strong> Corrija los campos marcados con *</p>
					</div>
				</div></td></tr>
<?php else: ?> 		
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
<?php endif; ?>
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Editar registro</font></span></td></tr>
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
							<tr><td class="ui-state-default" colspan="2"></td></tr>
						</table>
					</td>
				</tr>
				<?php 
					unset($arrObject);
					if($arrop) $arrObject = explode(',',$arrop);
      				for ($a = 0; $a < count($arrObject); $a++)
      				{
      					$rwOp = loadrecordop($arrObject[$a],$idcon);
      					$obj_itedes = 'itedescodigo_'.$a;
      					$rwSoliprog = loadrecordsoliprog($rwOp['solprocodigo'],$idcon);
      					$rwVistaop = loadrecordoptroquelado($arrObject[$a],$idcon);
      					$ordoppanchot = $rwVistaop['ordproancmat'];
      					$ordoppcantmt = $rwVistaop['ordprocantmt'];
      					$ordoppcalibr = $rwVistaop['ordprocalibr'];
      					$ordoppcantkg = $rwVistaop['ordprocantkg'];
      					$ordoppcodigo = $rwOp['ordoppcodigo'];
      			?>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">		
							<tr><td class="ui-state-default" colspan="6">&nbsp;Datos de la OP # <?php echo str_pad($rwOp['ordprocodigo'], 4, "0", STR_PAD_LEFT) ?></td></tr>
							<tr>
								<td colspan="6" class="NoiseDataTD">&nbsp;Orden de producci&oacute;n generada apartir de la solicitud de corte (#<?php echo str_pad($rwSoliprog['solprocodigo'], 4, "0", STR_PAD_LEFT) ?>) de <b><?php echo  cargausuanombre($rwSoliprog['usuacodi'],$idcon) ?></b></td>
							</tr>
							<tr>
								<td width="10%" class="ui-state-default"><small>Item</small></td>
								<td width="44%" class="ui-state-default"><small>Ref.</small></td>
								<td width="28%" class="ui-state-default"><small>Cliente</small></td>
								<td width="8%" class="ui-state-default"><small>Anc.<b>(mm)</b></small></td>
								<td width="8%" class="ui-state-default"><small><b>(kgs)</b></small></td>
							</tr>
							<tr>
								<td class="NoiseDataTD">&nbsp;<?php echo $rwVistaop['produccoduno'] ?></td>
								<td class="NoiseDataTD">&nbsp;<?php echo $rwVistaop['producnombre'] ?></td>
								<td class="NoiseDataTD">&nbsp;<?php echo $rwVistaop['ordcomrazsoc'] ?></td>
								<td class="NoiseDataTD">&nbsp;<?php echo $rwVistaop['ordproancmat'] ?></td>
								<td class="NoiseDataTD">&nbsp;<?php echo number_format($rwVistaop['ordprocantkg'], 2, ',', '.') ?></td>
							</tr>
							<tr><td class="ui-state-default" colspan="7"></td></tr>
						</table>
					</td>
				</tr>
				<?php
      				} 
      			?>
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
											floadequipoop_tql($equipocodigo,$idcon);
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
            					<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="ordoppanchot" id="ordoppanchot" value="<?php echo $ordoppanchot ?>" /><?php echo ($ordoppanchot)? $ordoppanchot : '---' ;?></td>
            					<td width="20%" class="NoiseFooterTD"><?php if($campnomb["ordoppcantmt"] == 1)echo "*"; ?>&nbsp;Metros <b>(mts)</b></td>
            					<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="ordoppcantmt" id="ordoppcantmt" value="<?php echo $ordoppcantmt ?>" /><?php echo ($ordoppcantmt)? round($ordoppcantmt * 100) / 100 : '---' ;?></td>
		  					</tr>
		  					<tr>
		  						<td width="20%" class="NoiseFooterTD"><?php if($campnomb["ordoppcalibr"] == 1)echo "*"; ?>&nbsp;Calibre <b>(&micro;m)</b></td>
            					<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="ordoppcalibr" id="ordoppcalibr" value="<?php echo $ordoppcalibr ?>" /><?php echo ($ordoppcalibr)? $ordoppcalibr : '---' ;?></td>
		  						<td width="20%" class="NoiseFooterTD"><?php if($campnomb["ordoppcantkg"] == 1)echo "*"; ?>&nbsp;Cantidad <b>(kgs)</b></td>
            					<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="ordoppcantkg" id="ordoppcantkg" value="<?php echo $ordoppcantkg ?>" /><?php echo ($ordoppcantkg)? round($ordoppcantkg * 100) / 100 : '---' ;?></td>
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
 											$tipsolcodigo = 6;//id tiposoliprog troquelado
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
 										$tipsolcodigo = 6;//id tiposoliprog troquelado
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
						<button id="aceptaropp_tql">Aceptar</button>&nbsp;&nbsp;&nbsp;&nbsp;
						<button id="cancelaropp_tql">Cancelar</button>
					</div></td>
				</tr>
				<tr><td>&nbsp;</td></tr> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table>
			<input type="hidden" name="accioneditaropp"> 
			<input type="hidden" name="sourcetable" value="opp">
			<input type="hidden" name="sourceaction" value="editar">
			<input type="hidden" name="flageditaropp">
			<input type="hidden" name="arrop" value="<?php echo $arrop ?>">
			<input type="hidden" name="ordoppcodigo" value="<?php echo $ordoppcodigo ?>">  
			<input type="hidden" name="arrmatplan" value="<?php echo $arrmatplan ?>"> 
			<input type="hidden" name="codigo" id="codigo" value="<?php echo $codigo; ?>" />
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>