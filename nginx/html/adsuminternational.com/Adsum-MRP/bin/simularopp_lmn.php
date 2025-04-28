<?php
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunGen/sesion/fncvarsesion.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktblpadreitem.php');
	include ( '../src/FunPerPriNiv/pktblvistabandejalaminado.php');	
	include ( '../src/FunGen/floadtimehours.php');
	include ( '../src/FunGen/floadtimeminut.php');
	include ( '../src/FunGen/fncstrfecha.php');
	
	$idcon = fncconn();
	if($arrop) $arrObject = explode(',',$arrop);
	$idcon = fncconn();
	$nr_op = 0;
	for($a = 0;$a < count($arrObject);$a++)
	{
		$rwOp = loadrecordvistabandejaextrusion($arrObject[$a],$idcon);
		($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
		//variables
		$pistas = 1;
		$ordopprefile = 30;		
		$ordoppcalib = $rwOp['ordprocalib'];
		$paditecodigo = $rwOp['paditecodigo'];
		//se carga registro de padreitem
		$rwPadreitem = loadrecordpadreitem($paditecodigo,$idcon);
		$ordoppdensid = $rwPadreitem['paditedensid'];
		//objetos a utilizar
		$obj_ops = 'ops_'.$a;
		$obj_pistas = 'pista_'.$a;
		//valor de los objetos
		$$obj_ops = $arrObject[$a];
		$$obj_pistas = 1;
		//variables de extrusion
		$ordoppanchoe = $ordoppanchoe + $rwOp['ordproanchop'];
		$ordoppcantid = $ordoppcantid + $rwOp['ordprocantid'];
		$ordoppcalib = $rwOp['ordprocalib'];
		$formulnumero = $rwOp['formulnumero'];
		$nr_op++;
	}	
	
	$ordoppmetros = $ordoppcantid / ($ordoppanchoe * ($ordoppdensid * $ordoppcalib) ) * 1000000;
	$ordoppanchoe = $ordoppanchoe + $ordopprefile;
?>
<html> 
	<head> 
		<title>Simulacion de opp</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.ui.ajax_accionextras.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_bandejaext.js"></script>
	</head>
	<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Simulacion de opp (laminado)</font></p> 
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
								<td class="NoiseFooterTD" colspan="2">
									<div id="detallesilmularop" style="height: auto; margin:0 auto; overflow:auto;">
										<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">
											<tr>
												<td class="ui-state-default" width="10%"  align="center"># OP</td>
												<td class="ui-state-default" width="10%"  align="center">Mezcla</td>
												<td class="ui-state-default" width="10%"  align="center"># Pistas</td>
												<td class="ui-state-default" width="10%"  align="center">Calibre</td>
												<td class="ui-state-default" width="10%"  align="center">Ancho</td>
												<td class="ui-state-default" width="10%"  align="center"><b>(kgs)</b></td>
												<td class="ui-state-default" width="15%"  align="center"><b>Ancho mat. (mm)</b></td>
												<td class="ui-state-default" width="15%"  align="center"><b>Total mat. (kgs)</b></td>
												<td class="ui-state-default" width="10%"  align="center"><b>%</b></td>
											</tr>
											<?php 
												for($a = 0;$a < $nr_op;$a++)
												{
													$rwOp = loadrecordvistabandejaextrusion($$obj_ops,$idcon);
													//objetos a utilizar
													$obj_ops = 'ops_'.$a;
													$obj_pistas = 'pista_'.$a;
													$obj_porcen = 'porcen_'.$a;
													$obj_cantid = 'cantid_'.$a;
													$obj_ancho = 'ancho_'.$a;
													$obj_anchot = 'anchot_'.$a;
													//label a utilizar
													$obj_porcen_lb = 'lb_'.$obj_porcen;
													$obj_cantid_lb = 'lb_'.$obj_cantid;
													$obj_ancho_lb = 'lb_'.$obj_ancho;
													$obj_anchot_lb = 'lb_'.$obj_anchot;
													//valor de los objetos
													$$obj_porcen = $rwOp['ordproanchop'] / ($ordoppanchoe);
													$$obj_cantid = $$obj_porcen * $ordoppcantid;
													$$obj_ancho = $rwOp['ordproanchop'];
													$$obj_anchot = $rwOp['ordproanchop'] * $$obj_pistas;
													($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';													
											?>
											<tr <?php echo $complement ?>">
												<td class="cont-line">&nbsp;<?php echo str_pad($rwOp['ordprocodigo'], 4, "0", STR_PAD_LEFT) ?></td>
												<td class="cont-line">&nbsp;<?php echo $rwOp['formulnumero'] ?></td>
												<td class="cont-line">&nbsp;<input type="text" name="<?php echo $obj_pistas ?>" id="<?php echo $obj_pistas ?>" value="<?php echo $$obj_pistas ?>" size="7" onkeyup="eventAnchoBobina();" /></td>
												<td class="cont-line">&nbsp;<?php echo $rwOp['ordprocalib'] ?></td>
												<td class="cont-line">&nbsp;<input type="hidden" name="<?php echo $obj_ancho ?>" id="<?php echo $obj_ancho ?>" value="<?php echo $$obj_ancho ?>" /><span id="<?php echo $obj_ancho_lb ?>"><?php echo ($$obj_ancho)? $$obj_ancho : '---' ;?></span></td>
												<td class="cont-line">&nbsp;<?php echo $rwOp['ordprocantid'] ?></td>
												<td class="cont-line">&nbsp;<input type="hidden" name="<?php echo $obj_anchot ?>" id="<?php echo $obj_anchot ?>" value="<?php echo $$obj_anchot ?>" /><span id="<?php echo $obj_anchot_lb ?>"><?php echo ($$obj_anchot)? $$obj_anchot : '---' ;?></span></td>
												<td class="cont-line">&nbsp;<input type="hidden" name="<?php echo $obj_cantid ?>" id="<?php echo $obj_cantid ?>" value="<?php echo $$obj_cantid ?>" /><span id="<?php echo $obj_cantid_lb ?>"><?php echo ($$obj_cantid)? round($$obj_cantid * 100) / 100 : '---' ;?></span></td>
												<td class="cont-line">&nbsp;<input type="hidden" name="<?php echo $obj_porcen ?>" id="<?php echo $obj_porcen ?>" value="<?php echo $$obj_porcen ?>" /><span id="<?php echo $obj_porcen_lb ?>"><?php echo ($$obj_porcen)? (round($$obj_porcen * 100) / 100) * 100 : '---' ; ?></span></td>
											</tr>
											<?php 
												}
											?>
										</table>
									</div>
								</td>
							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["ordopprefile"] == 1)echo "*"; ?>&nbsp;Refile <b>(mm)</b></td>
								<td width="80%" class="NoiseDataTD">&nbsp;<input type="text" name="ordopprefile" id="ordopprefile" value="<?php echo $ordopprefile ?>" size="7" onkeyup="eventAnchoBobina();" /></td>
							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["ordoppanchoe"] == 1)echo "*"; ?>&nbsp;Ancho Bobina <b>(mm)</b></td>
								<td width="80%" class="NoiseDataTD">&nbsp;<input type="hidden" name="ordoppanchoe" id="ordoppanchoe" value="<?php echo $ordoppanchoe ?>" size="7" /><span id="ordoppanchoe_lb"><?php echo ($ordoppanchoe)? $ordoppanchoe : '--' ; ?></span></td>
							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["ordoppcantid"] == 1)echo "*"; ?>&nbsp;Cantidad <b>(kg)</b></td>
								<td width="80%" class="NoiseDataTD">&nbsp;<input type="text" name="ordoppcantid" id="ordoppcantid" value="<?php echo $ordoppcantid ?>" size="7" onkeyup="eventAnchoBobina();" /></td>
							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["ordoppmetros"] == 1)echo "*"; ?>&nbsp;Metros <b>(mts)</b></td>
								<td width="80%" class="NoiseDataTD">&nbsp;<input type="hidden" name="ordoppmetros" id="ordoppmetros" value="<?php echo $ordoppmetros ?>" size="7" /><span id="ordoppmetros_lb"><?php echo ($ordoppmetros)? round($ordoppmetros * 100) / 100 : '--' ; ?></span></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><div class="ui-buttonset">
						<button id="generaropp_lmn">Generar [opp]</button>&nbsp;
						<button id="backward_lmn">Atras</button>
					</div></td>
				</tr>
				<tr><td>&nbsp;</td></tr> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table>
			<input type="hidden" name="accionnuevoopp"> 
			<input type="hidden" name="sourcetable" value="op">
			<input type="hidden" name="sourceaction" value="nuevo"> 
			<input type="hidden" name="nr_op" id="nr_op" value="<?php echo $nr_op?>"> 
			<input type="hidden" name="arrop" id="arrop" value="<?php echo $arrop?>"> 
			<input type="hidden" name="ordoppcalib" id="ordoppcalib" value="<?php echo $ordoppcalib?>"> 
			<input type="hidden" name="ordoppdensid" id="ordoppdensid" value="<?php echo $ordoppdensid?>"> 
			<input type="hidden" name="formulnumero" id="formulnumero" value="<?php echo $formulnumero?>"> 
			<input type="hidden" name="codigo" id="codigo" value="<?php echo $codigo; ?>" />
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>