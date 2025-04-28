<?php 
	ini_set('display_errors',1);
	include ( "../src/FunPerPriNiv/pktblgestionoppitemdesa.php");
	include ( "../src/FunPerPriNiv/pktblgestionoppsaldo.php");
	include ( "../src/FunPerPriNiv/pktblgestionoppreporte.php");
	include ("../src/FunPerPriNiv/pktblvistaalarmagestion.php");
	include ("../src/FunPerPriNiv/pktblplanearutaitempv.php");
	include ("../src/FunPerPriNiv/pktblprocedimiento.php");
	include ("../src/FunPerPriNiv/pktblalarmamodulo.php");
	include ("../src/FunPerPriNiv/pktblestadosaldo.php");
	include ("../src/FunPerPriNiv/pktblformulacion.php");			
	include ( "../src/FunPerPriNiv/pktblgestionopp.php");
	include ("../src/FunPerPriNiv/pktbloppitemdesa.php");	
	include ("../src/FunPerPriNiv/pktbloplaminado.php");
	include ("../src/FunPerPriNiv/pktblopextrusion.php");
	include ("../src/FunPerPriNiv/pktblalarmaitem.php");
	include ("../src/FunPerPriNiv/pktblopcorte.php");
	include ("../src/FunPerPriNiv/pktblpadreitem.php");
	include ("../src/FunPerPriNiv/pktblopsellado.php");
	include ("../src/FunPerPriNiv/pktbloppauchado.php");	
	include ("../src/FunPerPriNiv/pktblusuario.php");
	include ("../src/FunPerPriNiv/pktblitemdesa.php");	
	include ("../src/FunPerPriNiv/pktblopestado.php");
	include ("../src/FunPerPriNiv/pktblvistaopp.php");
	include ("../src/FunPerPriNiv/pktblopflexo.php");
	include ("../src/FunPerPriNiv/pktblsaldo.php");
	include ("../src/FunGen/sesion/fncvalses.php"); 
	include ("../src/FunPerPriNiv/pktblalarma.php");
	include ("../src/FunPerPriNiv/pktblopp.php");
	include ("../src/FunPerPriNiv/pktblop.php");
	include ( '../src/FunPerPriNiv/pktblestadoanalisis.php');
	include ( '../src/FunPerPriNiv/pktblprvaranalisis.php');
	include ( '../src/FunPerPriNiv/pktblvaranalisis.php');
	include ( '../src/FunPerPriNiv/pktblanalisispr.php');
	include ("../src/FunGen/cargainput.php");


	if(!$flagdetallargestionoppanalisispr){

		$idcon = fncconn();
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$ordoppcodigo);

		$idcon = fncconn();

		if (!$sbreg) {
			$ordoppcodigo = str_replace('|n', '', $ordoppcodigo);
			$sbreg= loadrecordvistaopp($ordoppcodigo,$idcon);
			$rwOrdenp = loadrecordop1($ordoppcodigo,$idcon);
			$flagvalidaciongestionopp = 1;
		}else{
			$ordoppcodigo = $sbreg["ordoppcodigo"];
		}

		$ordoppcodigo = $sbreg["ordoppcodigo"];
		$opestacodigo = $sbreg["opestacodigo"];
		$equipocodigo = $sbreg["equipocodigo"];
		$equiponombre = $sbreg["equiponombre"];
		$ordprofecgen = $sbreg["ordprofecgen"];
		$prograindice = $sbreg["prograindice"];
		$procedcodigo = $sbreg["procedcodigo"];
		$procednombre = $sbreg["procednombre"];
		$pedvencodigo = $sbreg["pedvencodigo"];
		$pedvennumero = $sbreg["pedvennumero"];
		$tipevecodigo = $sbreg["tipevecodigo"];
		$tipevenombre = $sbreg["tipevenombre"];
		$produccodigo = $sbreg["produccodigo"];
		$produccoduno = $sbreg["produccoduno"];
		$producnombre = $sbreg["producnombre"];
		$ordcomcodcli = $sbreg["ordcomcodcli"];
		$ordcomrazsoc = $sbreg["ordcomrazsoc"];
		$plantacodigo = $sbreg["plantacodigo"];
		$plantanombre = $sbreg["plantanombre"];
		$tipsolcodigo = $sbreg["tipsolcodigo"];
		$solprocodigo = $sbreg["solprocodigo"];
		$gesoppdescri = "Gestion [OK]";
		
		$MODULOCODIGO	= 7;//constante de la tabla "modulo" 
		$rutamodulo = "maestablgestionopp.php";
		include "scanalarma.php";//se escanea para activar alarmas configuradas

		$rwAnalispr = loadrecordanalisispr1($ordoppcodigo,$idcon);

		if($rwAnalispr > 0){

			$analiscodigo = $rwAnalispr["analiscodigo"];
			$procedcodigo = $rwAnalispr["procedcodigo"];
			$itedescodigo = $rwAnalispr["itedescodigo"];
			$usuacodigo = $rwAnalispr["usuacodi"];
			$analisfecha = $rwAnalispr["analisfecha"];
			$estanacodigo = $rwAnalispr["estanacodigo"];
			$analisdescri = $rwAnalispr["analisdescri"];

			$rsPrvaranalisis = dinamicscanopprvaranalisis(array("analiscodigo" => $analiscodigo), array("analiscodigo" => "="), $idcon);
			$nrPrvaranalisis = fncnumreg($rsPrvaranalisis);

			for( $a = 0; $a < $nrPrvaranalisis; $a++){

				$rwPrvaranalisis = fncfetch($rsPrvaranalisis,$a);

				$varValor = 'txtvalor'.$rwPrvaranalisis['varanacodigo'];
				$$varValor = $rwPrvaranalisis["prvaravalor"];

			}
		}
		
		fncclose($idcon);

	}

	$idcon = fncconn();
?>
<html> 
	<head> 
		<title>detallar registro</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=UTF8"> 
		<meta http-equiv="expires" content="0"> 
		<meta http-equiv="X-UA-Compatible" content="IE=9"> 
		<?php include ('../def/jquery.library_maestro.php'); ?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_gestionopp.js"></script>
		<style type="text/css">
			.ui-autocomplete-loading { background: white url('../img/ui-anim_basic_16x16.gif') right center no-repeat; }
		</style>
	</head> 
<?php if (! $codigo) echo "<!--"; ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post" enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Detallar Analisis calidad orden de produccion programada {OPP}</font></p> 
			<table width="800" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content">
<?php if($campnomb): ?>
				<tr><td><div class="ui-widget">
					<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
						<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
						<strong>Advertencia:</strong> <?php if($campnomb['err']): echo $campnomb['err']; else: ?> Corrija los campos marcados con *<?php endif; ?></p>
					</div>
				</div></td></tr>
<?php elseif($varMsj): echo $varMsj; ?>
<?php elseif($flagvalidaciongestionopp): ?> 	
				<tr><td><div class="ui-widget">
					<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
						<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
						<strong>Advertencia:</strong> No es posible realizar esta operacion.</p>
					</div>
				</div></td></tr>	
<?php else: ?> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
<?php endif; ?>
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr>        		
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
							<tr class="ui-widget-header">
								<td width="50%" class="cont-title">&nbsp;Orden de produccion programada {OPP} No.&nbsp;{<?php echo $solprocodigo; ?>}</td>
								<td width="50%" class="cont-title">&nbsp;Fecha.&nbsp;<?php echo $ordprofecgen; ?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<?php include '../src/FunjQuery/jquery.tabs/gestionopp/jquery.especificaciones.php'; ?>
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0"align="center" class="ui-widget-content">
							<tr class="ui-state-default">
								<td class="cont-title">&nbsp;Datos de la OPP</td>
							</tr>
						</table>
						<table width="100%" border="0" cellspacing="1" cellpadding="1"align="center" class="ui-widget-content">
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Ubicaci&oacute;n</td>
								<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($plantanombre)? strtoupper($plantanombre) : '---' ;?></td>
								<td width="20%" class="NoiseFooterTD">&nbsp;Proceso</td>
								<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($procednombre)? strtoupper($procednombre) : '---' ; ?></td>
							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;PV</td>
								<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($pedvennumero)? strtoupper($pedvennumero) : '---' ;?></td>
								<td width="20%" class="NoiseFooterTD">&nbsp;Tipo PV</td>
								<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($tipevenombre)? strtoupper($tipevenombre) : '---' ; ?></td>
							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Item</td>
								<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($produccoduno)? strtoupper($produccoduno) : '---' ;?></td>
								<td width="20%" class="NoiseFooterTD">&nbsp;Orden entrada</td>
								<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($prograindice)? strtoupper($prograindice) : '---' ; ?></td>
							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Referencia</td>
								<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo ($producnombre)? strtoupper($producnombre) : '---' ;?></td>
							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Cliente</td>
								<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo ($ordcomrazsoc)? strtoupper($ordcomrazsoc) : '---' ; ?></td>
							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Equipo</td>
								<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo ($equiponombre)? strtoupper($equiponombre) : '---' ; ?></td>
							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Ficha tecnica.</td>
								<td colspan="3" class="NoiseDataTD">&nbsp;<a href="#" onclick="window.open('imprimirfichatecnica.php?codigo=<?php echo $produccodigo ?>','impresion','status=no,menubar=no,scrollbars=yes,resizable=yes,width=880,height=650');">Detallar FT.</a></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Analisis producto proceso</font></span></td></tr>        		
				<?php if($rwAnalispr > 0){ ?>
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
            				<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo ($analiscodigo)? $analiscodigo : "---" ; ?></td> 
 							</tr>
            				<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Responsable</td>
								<td width="80%" class="NoiseDataTD"><?php echo ($usuacodigo)? cargausuanombre($usuacodigo,$idcon) : "---" ; ?></td> 
 							</tr>
 							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Fecha</td>
								<td width="80%" class="NoiseDataTD"><?php echo ($analisfecha)? $analisfecha : "---" ; ?></td> 
 							</tr>
 							<tr>
								<td colspan="2">
 									<div class="ui-buttonset ui-state-default NoiseDataTD">&nbsp;Plan de inspecci&oacute;n&nbsp;</div>
 										<div id="filtrlistavaranalisis">
										<?php
											$noAjax = true;
											$flagDetallar=1;
											include '../src/FunjQuery/jquery.visors/jq.vanalisispr.php';  
										?>
									</div>
 								</td>
							</tr>
      						<tr>
								<td width="20%" width="20%" class="NoiseFooterTD">&nbsp;Estado</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo ($estanacodigo)? carganombreestado($estanacodigo,$idcon) : "---" ;?></td> 
							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo $analisdescri; ?></td> 
 							</tr>
 						</table>
 					</td>
 				</tr>
 				<?php }else{ ?>
 				<tr> 
  					<td> 
 						<div class="ui-widget">
							<div style="margin-top: 1px; padding: 0 .7em;height: 100px;" class="ui-state-highlight ui-corner-all">
								<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span> <b>No se encontro analisis a la orden !</b></p>
							</div>
						</div>
					</td>
				</tr>
 				<?php } ?>
				<tr>
					<td class="NoiseErrorDataTD" align="center"></td>
				</tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_formdetall.php'; ?></td>
				</tr>
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table>
			<input type="hidden" name="acciondetallargestionoppanalisispr" />
			<input type="hidden" name="flagdetallargestionoppanalisispr" value="1" />
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>" /> 
			<input type="hidden" name="sourceaction" id="sourceaction" value="detallar" />  
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<!--		VARIABLES DE LA VISTA -->
			<input type="hidden" name="ordoppcodigo" id="ordoppcodigo" value="<?php echo $ordoppcodigo; ?>">
			<input type="hidden" name="equipocodigo" value="<?php echo $equipocodigo; ?>">
			<input type="hidden" name="equiponombre" value="<?php echo $equiponombre; ?>">
			<input type="hidden" name="ordprofecgen" value="<?php echo $ordprofecgen; ?>">
			<input type="hidden" name="prograindice" value="<?php echo $prograindice; ?>">
			<input type="hidden" name="procedcodigo" value="<?php echo $procedcodigo; ?>">
			<input type="hidden" name="procednombre" value="<?php echo $procednombre; ?>">
			<input type="hidden" name="pedvencodigo" value="<?php echo $pedvencodigo; ?>">
			<input type="hidden" name="pedvennumero" value="<?php echo $pedvennumero; ?>">		
			<input type="hidden" name="tipevecodigo" value="<?php echo $tipevecodigo; ?>">
			<input type="hidden" name="tipevenombre" value="<?php echo $tipevenombre; ?>">
			<input type="hidden" name="produccodigo" value="<?php echo $produccodigo; ?>">
			<input type="hidden" name="produccoduno" value="<?php echo $produccoduno; ?>">
			<input type="hidden" name="producnombre" value="<?php echo $producnombre; ?>">
			<input type="hidden" name="ordcomcodcli" value="<?php echo $ordcomcodcli; ?>">
			<input type="hidden" name="ordcomrazsoc" value="<?php echo $ordcomrazsoc; ?>">
			<input type="hidden" name="plantacodigo" value="<?php echo $plantacodigo; ?>">				
			<input type="hidden" name="plantanombre" value="<?php echo $plantanombre; ?>">
			<input type="hidden" name="tipsolcodigo" id="tipsolcodigo" value="<?php echo $tipsolcodigo; ?>">	
			<input type="hidden" name="solprocodigo" value="<?php echo $solprocodigo; ?>">
			<input type="hidden" name="arritem1" value="<?php echo $arritem1; ?>">
			<input type="hidden" name="rutaitempv" value="<?php echo $rutaitempv ?>">	
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
		<div id="msgwindowform" title="Adsum Kallpa [Ingredientes/Items]"><span id="msgform"></span></div>
	</body> 
<?php if (! $codigo) echo " -->"; ?> 
</html>