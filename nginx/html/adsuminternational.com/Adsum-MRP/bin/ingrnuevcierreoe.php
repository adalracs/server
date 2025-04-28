<?php 
	ini_set('display_errors',1);
	include ('../src/FunPerPriNiv/pktbloereporteoppreportepn.php');
	include ('../src/FunPerPriNiv/pktblreporteoppreportepn.php');
	include ('../src/FunPerPriNiv/pktblopmicroperforado.php');
	include ('../src/FunPerPriNiv/pktblvistareporteopp.php');
	include ('../src/FunPerPriNiv/pktblprocedimiento.php');
	include ('../src/FunPerPriNiv/pktbloptroquelado.php');
	include ('../src/FunPerPriNiv/pktbloppauchado.php');
	include ('../src/FunPerPriNiv/pktblopextrusion.php');
	include ('../src/FunPerPriNiv/pktblopvalvulado.php');
	include ('../src/FunPerPriNiv/pktbloplaminado.php');
	include ('../src/FunPerPriNiv/pktblopdoblado.php');
	include ('../src/FunPerPriNiv/pktblopsellado.php');
	include ('../src/FunPerPriNiv/pktbloeestado.php');
	include ('../src/FunPerPriNiv/pktblopflexo.php');
	include ('../src/FunPerPriNiv/pktblsoliprog.php');
	include ('../src/FunPerPriNiv/pktblproducto.php');
	include ('../src/FunPerPriNiv/pktblopcorte.php');
	include ('../src/FunPerPriNiv/pktblusuario.php');
	include ('../src/FunGen/sesion/fncvalses.php');
	include ('../src/FunPerPriNiv/pktblplanta.php');
	include ('../src/FunPerPriNiv/pktblopp.php');
	include ('../src/FunPerPriNiv/pktblop.php');
	include ('../src/FunPerPriNiv/pktblcierreoe.php');
	include ('../src/FunPerPriNiv/pktblvistaoe.php');
	include ('../src/FunPerPriNiv/pktbltipocump.php');
	include ( '../src/FunGen/fncstrfecha.php');
	include ('../src/FunGen/cargainput.php');
	
	if($accionnuevocierreoe)
		include ( 'grabacierreoe.php');
		
	
	if($ordentcodigo)
	{	
		$idcon = fncconn();
		
		$nombre = cargausuanombre($usuacodi, $idcon);
		$rsCierreoe = dinamicscancierreoe($ordentcodigo,$idcon);
		if($rsCierreoe > 0){
			$err = 'La Orden de Entega {oe} se encuentra Cerrada';
		}else{
			$rwOe = loadrecordvistaoe($ordentcodigo,$idcon);
			$ordoppcodigo = $rwOe['ordoppcodigo'];
			$usuacodi1 = $rwOe['usuacodi'];
			if($rwOe < 0){
				$err = 'No se encontro la orden de produccion {opp}';
			}else{
				$rsOpp = dinamicscanopopp(array('ordoppcodigo' => $ordoppcodigo),array('ordoppcodigo' => '='),$idcon);
				if($rsOpp > 0){
					$rwOpp = loadrecordopp($ordoppcodigo,$idcon);
					if($rwOpp < 0){
						$err = 'No se encontro la orden de produccion {opp}';
					}else{
						//VARIABLES DE LA ORDEN DE ENTREGA
						$rwOp = loadrecordop1($ordoppcodigo,$idcon);
						$rwSoliprog = loadrecordsoliprog($rwOp['solprocodigo'],$idcon);
						$rwProducto = loadrecordproducto($rwSoliprog['produccodigo'],$idcon);
						$rwProcedimiento = loadrecordprocedimiento($rwOp['procedcodigo'],$idcon);
						$solprocodigo = $rwOp['solprocodigo'];
						$tipsolcodigo = $rwProcedimiento['tipsolcodigo'];
						$produccoduno = $rwProducto['produccoduno'];
						$producnombre = $rwProducto['producnombre'];
						$procednombre = $rwProcedimiento['procednombre'];
					}
				}
			}
		}
		
		$rsOereporteopprepotepn = dinamicscanopoereporteoppreportepn(array('ordentcodigo' => $rwOe['ordentcodigo']),array('ordentcodigo' => '='),$idcon);
		$nrOereporteopprepotepn = fncnumreg($rsOereporteopprepotepn);
		unset($arroe);
		for($a = 0; $a < $nrOereporteopprepotepn; $a++)
		{
			$rwOereporteopprepotepn = fncfetch($rsOereporteopprepotepn,$a);
			$arroe = ($arroe)? $arroe.','.$rwOereporteopprepotepn['reoppncodigo'] : $rwOereporteopprepotepn['reoppncodigo'] ; 
		}
		fncclose($idcon);
							
	}
	$arroe1 = $arroe; 
	$idcon = fncconn();
	$rwPlanta = loadrecordplanta($rwOe['plantacodigo'],$idcon);
?> 
<html> 
	<head> 
		<title>nuevo registro</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=UTF8"> 
		<meta http-equiv="expires" content="0"> 
		<meta http-equiv="X-UA-Compatible" content="IE=9"> 
		<?php include ('../def/jquery.library_maestro.php'); ?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jq.fnc.oe.js"></script>
		<style type="text/css">
			.ui-autocomplete-loading { background: white url('../img/ui-anim_basic_16x16.gif') right center no-repeat; }
		</style>
		<script type="text/javascript">
			$(function(){
				$('#reloadform').button({ icons: { primary: "ui-icon-refresh" }, text: false }).click(function() {
					document.form1.submit();
					return false;
				});
			});
		</script>
	</head> 
<?php if (! $codigo) echo "<!--"; ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post" enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Cierre Orden de entrega</font></p> 
			<table width="800" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content">
<?php if($campnomb || $err): ?>
				<tr><td><div class="ui-widget">
					<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
						<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
						<strong>Advertencia:</strong> <?php if($err): echo $err; else: ?> Corrija los campos marcados con *<?php endif; ?></p>
					</div>
				</div></td></tr>
<?php else: ?> 		
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
<?php endif; ?>
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Nuevo registro</font></span></td></tr>
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr><td class="ui-state-default">&nbsp;<small><?php echo strfecha(date("Y-m-d"))  ?></small></td></tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
							<tr class="ui-widget-header">
								<td width="100%" class="cont-title">&nbsp;Orden de entrega No.&nbsp;<input type="text" name="ordentcodigo" id="ordentcodigo" size="13" value="<?php echo $ordentcodigo; ?>" title="Digite el Numero de la Orden de entega ..."><button id="reloadform">Reload</button></td>
							</tr>
						</table>
					</td>
				</tr> 
				<?php if($ordoppcodigo > 0){?>
				<tr>
					<td>
						<?php include '../src/FunjQuery/jquery.tabs/reporteopp/jquery.especificaciones.php'; ?>
					</td>
				</tr>
				<?php }?>
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td>
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
										<tr class="ui-state-default">
											<td class="cont-title">&nbsp;Datos de la orden de entrega</td>
										</tr>
									</table>
									<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
										<tr>
											<td width="20%" class="NoiseFooterTD">&nbsp;Estado</td>
											<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($rwOe['oeestacodigo'])? cargaoeestanombre($rwOe['oeestacodigo'],$idcon) : '---' ;?></td>
											<td width="20%" class="NoiseFooterTD">&nbsp;Planta</td>
											<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($rwOe['plantacodigo'])? cargaplantanombre($rwOe['plantacodigo'],$idcon) : '---' ;;?></td>
										</tr>
										<tr>
											<td width="20%" class="NoiseFooterTD">&nbsp;Entregado Por:</td>
											<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($usuacodi1)? cargausuanombre($usuacodi1,$idcon) : '---' ;?></td>
											<td width="20%" class="NoiseFooterTD">&nbsp;Numero EPT:</td>
											<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($rwOe['ordentnumept'])? $rwOe['ordentnumept'] : '---' ; ?></td> 	
										</tr>
										<tr>
											<td width="20%" class="NoiseFooterTD">&nbsp;Recibido Por:</td>
											<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo ($usuacodi)? cargausuanombre($usuacodi,$idcon) : '---' ;?></td>
										</tr>
										<tr><td colspan="4" class="NoiseErrorDataTD"></td></tr>
										<tr><td colspan="4" class="NoiseFooterTD">&nbsp;Nota</td></tr>
										<tr><td colspan="4" rowspan="2" class="NoiseDataTD">&nbsp;<?php echo ($rwOe['ordentdescri'])? $rwOe['ordentdescri'] : '' ; ?></td></tr>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
										<tr class="ui-state-default">
											<td class="cont-title">&nbsp;Reporte Material a Entregar</td>
										</tr>
									</table>
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
										<tr>
											<td class="NoiseDataTD">
												<div id="listordenentrega">
													<?php
														$noAjax = true;
														$flagdetallar = 1;
														include '../src/FunjQuery/jquery.visors/jq.voe.php';
													?>
												</div>
												<input type="hidden" name="arroe" id="arroe" value="<?php echo $arroe ?>" />
												<input type="hidden" name="arroe1" id="arroe1" value="<?php echo $arroe1 ?>" /> 
												<input type="hidden" name="arroetmp" id="arroetmp" value="<?php echo $arroe ?>" />
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
							<tr class="ui-state-default">
								<td class="cont-title">&nbsp;Cierre Orden entrega</td>
							</tr>
						</table>
						<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb['oeestacodigo'] == 1) echo '*';?>&nbsp;Estado</td>
								<td width="30%" class="NoiseDataTD">&nbsp;
									<select name="oeestacodigo" id="oeestacodigo">
										<option value="">--Seleccione--</option>
										<?php 
											include ('../src/FunGen/floadoeestado.php');
											floadoeestadocierre($oeestacodigo,$idcon);
										?>
									</select>
								</td>
							</tr>
							<tr><td colspan="4" class="NoiseFooterTD"><?php if($campnomb["cieorddescri"] == 1){ $cieorddescri = null;echo "*";}?>&nbsp;Aclaraci&oacute;n</td></tr>
							<tr>
  								<td colspan="4" rowspan="3"><textarea name="cieorddescri" cols="90" rows="3"><?php echo $cieorddescri; ?></textarea></td>
 							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"></td>
				</tr>
				<tr><td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_form.php'; ?></td></tr> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table>
			<input type="hidden" name="flagnuevocierreoe">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>"> 
			<input type="hidden" name="sourceaction" id="sourceaction" value="nuevo">  
			<input type="hidden" name="accionnuevocierreoe"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			 
			<input type="hidden" name="tipsolcodigo" id="tipsolcodigo" value="<?php echo $tipsolcodigo; ?>"> 
			<input type="hidden" name="solprocodigo" id="solprocodigo" value="<?php echo $solprocodigo; ?>"> 
			<input type="hidden" name="produccoduno" id="produccoduno" value="<?php echo $produccoduno; ?>"> 
			<input type="hidden" name="producnombre" id="producnombre" value="<?php echo $producnombre; ?>"> 
			<input type="hidden" name="procednombre" id="procednombre" value="<?php echo $procednombre; ?>"> 
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
		<div id="msgwindowform" title="Adsum Kallpa [Material]"><span id="msgform"></span></div>
	</body> 
<?php if (! $codigo) echo " -->"; ?> 
</html>      