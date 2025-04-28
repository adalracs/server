<?php 
	ini_set('display_errors',1);
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ('../src/FunPerPriNiv/pktbllistaempreporteoppreportepn.php');
	include ('../src/FunPerPriNiv/pktblreporteoppreportepn.php');
	include ('../src/FunPerPriNiv/pktblusuario.php');
	include ('../src/FunPerPriNiv/pktbllistaempaqueestado.php');
	include ('../src/FunPerPriNiv/pktblop.php');
	include ('../src/FunPerPriNiv/pktblopextrusion.php');
	include ('../src/FunPerPriNiv/pktblopflexo.php');
	include ('../src/FunPerPriNiv/pktbloplaminado.php');
	include ('../src/FunPerPriNiv/pktblopcorte.php');
	include ('../src/FunPerPriNiv/pktblopsellado.php');
	include ('../src/FunPerPriNiv/pktbloppauchado.php');
	include ('../src/FunPerPriNiv/pktblopdoblado.php');
	include ('../src/FunPerPriNiv/pktblopmicroperforado.php');
	include ('../src/FunPerPriNiv/pktbloptroquelado.php');
	include ('../src/FunPerPriNiv/pktblopvalvulado.php');
	include ('../src/FunPerPriNiv/pktblopp.php');
	include ('../src/FunPerPriNiv/pktblsoliprog.php');
	include ('../src/FunPerPriNiv/pktblproducto.php');
	include ('../src/FunPerPriNiv/pktblprocedimiento.php');
	include ('../src/FunPerPriNiv/pktblplanta.php');
	include ('../src/FunGen/cargainput.php');
	include ( '../src/FunGen/fncstrfecha.php');
	
	if(!$flagdetallarcierrelistaempaque) 
	{ 		
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton);

		if (!$sbreg) 
			include( '../src/FunGen/fnccontfron.php');
		
		$idcon = fncconn();
		$lisempcodigo = $sbreg['lisempcodigo'];
		$ordoppcodigo = $sbreg['ordoppcodigo'];
		$usuacodi1 = $sbreg['usuacodi'];
		$usuacodi2 = $sbreg['usuacodigo'];
		if($ordoppcodigo)
		{
			$nombre = cargausuanombre($usuacodi, $idcon);
			$rsOpp = dinamicscanopopp(array('ordoppcodigo' => $ordoppcodigo),array('ordoppcodigo' => '='),$idcon);
			if($rsOpp > 0){
				$rwOpp = loadrecordopp($ordoppcodigo,$idcon);
				if($rwOpp < 0){
					$err = 'No se encontro la orden de produccion {opp}';
				}else{
					//	VARIABLES DE LA ORDEN DE ENTREGA
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
		
		$rslistaempaquereporteopprepotepn = dinamicscanoplistaempreporteoppreportepn(array('lisempcodigo' => $sbreg['lisempcodigo']),array('lisempcodigo' => '='),$idcon);
		$nrlistaempaquereporteopprepotepn = fncnumreg($rslistaempaquereporteopprepotepn);
		
		for($a = 0; $a < $nrlistaempaquereporteopprepotepn; $a++)
		{
			$rwlistaempaquereporteopprepotepn = fncfetch($rslistaempaquereporteopprepotepn,$a);
			$arrlistaempaque = ($arrlistaempaque)? $arrlistaempaque.','.$rwlistaempaquereporteopprepotepn['reoppncodigo'] : $rwlistaempaquereporteopprepotepn['reoppncodigo'] ; 
		}
		fncclose($idcon);
	} 
	
	$idcon = fncconn();
	$rwPlanta = loadrecordplanta($sbreg['plantacodigo'],$idcon);
?>
<html> 
	<head> 
		<title>detallar registro</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=UTF8"> 
		<meta http-equiv="expires" content="0"> 
		<meta http-equiv="X-UA-Compatible" content="IE=9"> 
		<?php include ('../def/jquery.library_maestro.php'); ?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jq.fnc.listaempaque.js"></script>
	</head> 
<?php if (! $codigo) echo "<!--"; ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post" enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Lista de Empaque</font></p> 
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
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr>
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr><td class="ui-state-default">&nbsp;<small><?php echo strfecha($sbreg['lisempfecgen'])  ?></small></td></tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
							<tr class="ui-widget-header">
								<td width="100%" class="cont-title">&nbsp;Orden de entrega {listaempaque} No.&nbsp;<?php echo $sbreg['lisempcodigo']; ?>&nbsp;en orden de produccion {opp} No.&nbsp;<?php echo $sbreg['ordoppcodigo']; ?></td>
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
											<td class="cont-title">&nbsp;Datos de la Lista de Empaque</td>
										</tr>
									</table>
									<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
										<tr>
											<td width="20%" class="NoiseFooterTD">&nbsp;Estado</td>
											<td width="30%" class="NoiseDataTD">&nbsp;<?php echo cargalistaempaqueestanombre($sbreg['lisempestacodigo'],$idcon);?></td>
											<td width="20%" class="NoiseFooterTD">&nbsp;Planta</td>
											<td width="30%" class="NoiseDataTD">&nbsp;<?php echo cargaplantanombre($sbreg['plantacodigo'],$idcon);?></td>
										</tr>
										<tr>
											<td width="20%" class="NoiseFooterTD">&nbsp;Entregado Por:</td>
											<td width="30%" class="NoiseDataTD">&nbsp;<?php echo cargausuanombre($usuacodi1,$idcon);?></td>
											<td width="20%" class="NoiseFooterTD">&nbsp;Numero EPT:</td>
											<td width="30%" class="NoiseDataTD">&nbsp;<?php echo $sbreg['lisempnumept']; ?></td> 	
										</tr>
										<tr>
										  <td class="NoiseFooterTD">&nbsp;Direccion:</td>
										  <td colspan="3" class="NoiseDataTD">&nbsp;<?php echo $sbreg['lisempdireccion']; ?></td>
									  </tr>
										<tr>
											<td width="20%" class="NoiseFooterTD">&nbsp;Recibido Por:</td>
											<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo cargausuanombre($usuacodi2,$idcon);?></td>
										</tr>
										<tr><td colspan="4" class="NoiseErrorDataTD"></td></tr>
										<tr><td colspan="4" class="NoiseFooterTD">&nbsp;Nota</td></tr>
										<tr><td colspan="4" rowspan="2" class="NoiseDataTD">&nbsp;<?php echo $sbreg['lisempdescri']; ?></td></tr>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
										<tr class="ui-state-default">
											<td class="cont-title">&nbsp;Reporte Listado de Empaque</td>
										</tr>
									</table>
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
										<tr>
											<td class="NoiseDataTD">
												<div id="listlistaempaque">
													<?php
														$noAjax = true;
														$flagdetallar = 1;
														include '../src/FunjQuery/jquery.visors/jq.vlistaempaque.php';
													?>
												</div>
												<input type="hidden" name="arrlistaempaque" id="arrlistaempaque" value="<?php echo $arrlistaempaque ?>" /> 
												<input type="hidden" name="arrlistaempaquetmp" id="arrlistaempaquetmp" value="<?php echo $arrlistaempaque ?>" />
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"></td>
				</tr>
				<tr><td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_formdetall.php'; ?></td></tr> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table>
			<input type="hidden" name="flagdetallarcierrelistaempaque">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>"> 
			<input type="hidden" name="sourceaction" id="sourceaction" value="detallar">  
			<input type="hidden" name="acciondetallarcierrelistaempaque"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			 
			<input type="hidden" name="ordoppcodigo" id="ordoppcodigo" value="<?php echo $ordoppcodigo; ?>"> 
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