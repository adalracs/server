<?php 
ob_start();
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
	
	if($accioneditarlistaempaque) 
	{ 
		include ( 'editalistaempaque.php'); 
		$flageditarlistaempaque = 1;
	}
ob_end_flush();
	if(!$flageditarlistaempaque)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');
		
		$idcon = fncconn();
	
		$lisempcodigo = $sbreg['lisempcodigo'];
		$ordoppcodigo = $sbreg['ordoppcodigo'];
		$lisempestacodigo = $sbreg['lisempestacodigo'];
		$plantacodigo = $sbreg['plantacodigo'];
		$lisempnumept = $sbreg['lisempnumept'];
		$lisempdireccion = $sbreg['lisempdireccion'];
		$lisempdescri = $sbreg['lisempdescri'];
		
		
		$usuacodi1 = $sbreg['usuacodi'];
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
		
		$rsOereporteopprepotepn = dinamicscanoplistaempreporteoppreportepn(array('lisempcodigo' => $sbreg['lisempcodigo']),array('lisempcodigo' => '='),$idcon);
		$nrOereporteopprepotepn = fncnumreg($rsOereporteopprepotepn);
		
		for($a = 0; $a < $nrOereporteopprepotepn; $a++)
		{
			$rwOereporteopprepotepn = fncfetch($rsOereporteopprepotepn,$a);
			$arrlistaempaque = ($arrlistaempaque)? $arrlistaempaque.','.$rwOereporteopprepotepn['reoppncodigo'] : $rwOereporteopprepotepn['reoppncodigo'] ;
		}
		fncclose($idcon);
	}
	$arrlistaempaque1 = $arrlistaempaque; 
	$idcon = fncconn();
?>
<html> 
	<head> 
		<title>editar registro</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=UTF8"> 
		<meta http-equiv="expires" content="0"> 
		<meta http-equiv="X-UA-Compatible" content="IE=9"> 
		<?php include ('../def/jquery.library_maestro.php'); ?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jq.fnc.listaempaque.js"></script>
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
			<p><font class="NoiseFormHeaderFont">Orden de entrega</font></p> 
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
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> editar registro</font></span></td></tr>
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
								<td width="100%" class="cont-title">&nbsp;Orden de produccion {opp} No.&nbsp;<?php echo $ordoppcodigo; ?></td>
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
											<td width="20%" class="NoiseFooterTD"><?php if($campnomb['lisempestacodigo'] == 1) echo '*';?>&nbsp;Estado</td>
											<td width="30%" class="NoiseDataTD">&nbsp;
												<select name="lisempestacodigo" id="lisempestacodigo">
													<option value="">--Seleccione--</option>
													<?php 
													include ('../src/FunGen/floadlistaempaqueestado.php');
													floadlistaempaqueestadogestion($lisempestacodigo,$idcon);
													?>
												</select>
											</td>
											<td width="20%" class="NoiseFooterTD"><?php if($campnomb['plantacodigo'] == 1) echo '*';?>&nbsp;Planta</td>
											<td width="30%" class="NoiseDataTD">&nbsp;
												<select name="plantacodigo" id="plantacodigo">
													<option value="">--Seleccione--</option>
													<?php 
													include ('../src/FunGen/floadplanta.php');
													floadplanta($plantacodigo,$idcon);
													?>
												</select>
											</td>
										</tr>
										<tr>
											<td width="20%" class="NoiseFooterTD">&nbsp;Entregado Por:</td>
											<td width="30%" class="NoiseDataTD">&nbsp;<?php echo cargausuanombre($usuacodi,$idcon);?></td>
											<td width="20%" class="NoiseFooterTD"><?php if($campnomb['lisempnumept'] == 1) echo '*';?>&nbsp;Numero EPT:</td>
											<td width="30%" class="NoiseDataTD">&nbsp;<input type="text" name="lisempnumept" id="lisempnumept" value="<?php echo $lisempnumept ?>"/></td> 	
										</tr>
										<tr>
											<td width="20%" class="NoiseFooterTD">&nbsp;Direcci&oacute;n</td>
											<td colspan="3" class="NoiseDataTD">&nbsp;<input type="text" name="lisempdireccion" id="lisempdireccion" value="<?php echo $lisempdireccion ?>"/></td>
										</tr>
										<tr><td colspan="4" class="NoiseErrorDataTD"></td></tr>
										<tr><td colspan="4" class="NoiseFooterTD"><?php if($campnomb['lisempdescri'] == 1){$lisempdescri = null; echo "*";}?>&nbsp;Nota</td></tr>
										<tr><td colspan="4" rowspan="2" class="NoiseDataTD"><textarea name="lisempdescri" rows="3" cols="63"><?php if(!$flageditarlistaempaque){ echo $sbreg[lisempdescri];}else{ echo $lisempdescri;} ?></textarea>  </td></tr>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
										<tr class="ui-state-default">
											<td class="cont-title">&nbsp;<?php if($campnomb["arrlistaempaque"] == 1){ $arrlistaempaque = null;echo "*";}?>Reporte Material a Entregar</td>
										</tr>
									</table>
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
										<tr>
											<td class="NoiseFooterTD">
												<div class="ui-buttonset-fe">
													<button id="ingresaritem">Agregar item</button>
													<button id="quitaritem">Quitar item</button>
												</div>
											</td>
										</tr>
										<tr>
											<td class="NoiseDataTD">
												<div id="listlistaempaque">
													<?php
														$noAjax = true;
														include '../src/FunjQuery/jquery.visors/jq.vlistaempaque.php';
													?>
												</div>
												<input type="hidden" name="arrlistaempaque" id="arrlistaempaque" value="<?php echo $arrlistaempaque ?>" /> 
												<input type="hidden" name="arrlistaempaque1" id="arrlistaempaque1" value="<?php echo $arrlistaempaque1 ?>" /> 
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
				<tr><td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_form.php'; ?></td></tr> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table>
			<input type="hidden" name="flageditarlistaempaque">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>"> 
			<input type="hidden" name="sourceaction" id="sourceaction" value="editar">  
			<input type="hidden" name="accioneditarlistaempaque"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			 
			<input type="hidden" name="ordoppcodigo" id="ordoppcodigo" value="<?php echo $ordoppcodigo; ?>"> 
			<input type="hidden" name="lisempcodigo" id="lisempcodigo" value="<?php echo $lisempcodigo; ?>"> 
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