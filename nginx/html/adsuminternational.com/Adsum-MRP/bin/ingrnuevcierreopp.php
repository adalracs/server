<?php 
	ini_set('display_errors',1);
	include ('../src/FunGen/cargainput.php');
	include ('../src/FunPerPriNiv/pktblop.php');
	include ('../src/FunPerPriNiv/pktblopflexo.php');
	include ('../src/FunPerPriNiv/pktbloplaminado.php');
	include ('../src/FunPerPriNiv/pktblopextrusion.php');
	include ('../src/FunPerPriNiv/pktblopcorte.php');
	include ('../src/FunPerPriNiv/pktblopsellado.php');
	include ('../src/FunPerPriNiv/pktbloppauchado.php');
	include ('../src/FunPerPriNiv/pktblopp.php');	
	include ('../src/FunPerPriNiv/pktblvistaopp.php');	
	include ('../src/FunPerPriNiv/pktblsaldo.php');
	include ('../src/FunGen/sesion/fncvalses.php'); 
	include ('../src/FunPerPriNiv/pktblusuario.php');
	include ('../src/FunPerPriNiv/pktblitemdesa.php');	
	include ('../src/FunPerPriNiv/pktblopestado.php');
	include ('../src/FunPerPriNiv/pktblgestionopp.php');
	include ('../src/FunPerPriNiv/pktblformulacion.php');			
	include ( '../src/FunPerPriNiv/pktblreporteopp.php');
	include ('../src/FunPerPriNiv/pktbloppitemdesa.php');	
	include ('../src/FunPerPriNiv/pktblprocedimiento.php');
	include ('../src/FunPerPriNiv/pktbldesperdiciopn.php');
	include ('../src/FunPerPriNiv/pktblflagproduccion.php');
	include ('../src/FunPerPriNiv/pktblgestionoppsaldo.php');
	include ( '../src/FunPerPriNiv/pktblvistareporteopp.php');
	include ('../src/FunPerPriNiv/pktblplanearutaitempv.php');	
	include ('../src/FunPerPriNiv/pktblgestionoppreporte.php');
	include ('../src/FunPerPriNiv/pktblreporteoppmaterial.php');
	include ('../src/FunPerPriNiv/pktblgestionoppitemdesa.php');
	include ('../src/FunPerPriNiv/pktblreporteopptiempopn.php');
	include ('../src/FunPerPriNiv/pktblreporteoppreportepn.php');
	include ('../src/FunPerPriNiv/pktblreporteoppdesperdiciopn.php');
	include ('../src/FunPerPriNiv/pktblreporteoppflagproduccion.php');
	include ('../src/FunPerPriNiv/pktbltiempopn.php');
	include ('../src/FunPerPriNiv/pktblcierreopp.php');
	include ('../src/FunPerPriNiv/pktbltipocump.php');
	
	if($accionnuevocierreopp)
		include ( 'grabacierreopp.php');
	
	if($ordoppcodigo){
		
		$idcon = fncconn();
		$ordoppcodigo = str_replace( '|n' , '', $ordoppcodigo);
		$nombre = cargausuanombre($usuacodi, $idcon);
		$rsCierreoop = dinamicscanopcierreopp(array("ordoppcodigo" => $ordoppcodigo), array("ordoppcodigo" => "="),$idcon);
		if($rsCierreoop > 0){
			$err = 'La Orden de Produccion {opp} se encuentra Cerrada';
		}else{
			//$rwOpp = loadrecordvistareporteopp($ordoppcodigo,$idcon);
			$rwOpp = loadrecordvistaopp($ordoppcodigo,$idcon);
			if($rwOpp < 0){
				$err = 'No se encontro la orden de produccion {opp}';
			}else{
				//VARIABLES DE LA VISTA		
				$ordoppcodigo = $rwOpp['ordoppcodigo'];
				//$opestacodigo = $rwOpp['opestacodigo'];
				$equipocodigo = $rwOpp['equipocodigo'];
				$equiponombre = $rwOpp['equiponombre'];
				$ordprofecgen = $rwOpp['ordprofecgen'];
				$prograindice = $rwOpp['prograindice'];
				$procedcodigo = $rwOpp['procedcodigo'];
				$procednombre = $rwOpp['procednombre'];
				$pedvencodigo = $rwOpp['pedvencodigo'];
				$pedvennumero = $rwOpp['pedvennumero'];
				$tipevecodigo = $rwOpp['tipevecodigo'];
				$tipevenombre = $rwOpp['tipevenombre'];
				$produccodigo = $rwOpp['produccodigo'];
				$produccoduno = $rwOpp['produccoduno'];
				$producnombre = $rwOpp['producnombre'];
				$ordcomcodcli = $rwOpp['ordcomcodcli'];
				$ordcomrazsoc = $rwOpp['ordcomrazsoc'];
				$plantacodigo = $rwOpp['plantacodigo'];
				$plantanombre = $rwOpp['plantanombre'];
				$tipsolcodigo = $rwOpp['tipsolcodigo'];
				$solprocodigo = $rwOpp["solprocodigo"];
				
				$cieoppdescri = 'Cierre [OK]';
				
				$rsRutaitempv = dinamicscanplanearutaitempv(array( 'produccodigo' => $produccodigo),$idcon);
				$nrRutaitempv = fncnumreg($rsRutaitempv);
				for( $a = 0; $a < $nrRutaitempv; $a++)
				{
					$rwRutaitempv = fncfetch($rsRutaitempv,$a);
					$rutaitempv = ($rutaitempv)? $rutaitempv.' <b>/</b>'.cargaprocedimientonombre($rwRutaitempv['procedcodigo'],$idcon) : cargaprocedimientonombre($rwRutaitempv['procedcodigo'],$idcon) ;
				}
				
				$rsOrdenpro = dinamicscanop(array('ordoppcodigo' => $ordoppcodigo),$idcon);
				$nrOrdenpro = fncnumreg($rsOrdenpro);
				for( $a = 0; $a < 1; $a++)
				{
					$rwOrdenpro = fncfetch($rsOrdenpro,$a);
					$rwOpextrision = loadrecordopextrusion($rwOrdenpro['ordprocodigo'],$idcon);
					$rwFormulacion = loadrecordformulacion($rwOpextrision['formulcodigo'],$idcon);
					$formulnumero = $rwFormulacion['formulnumero'];
				}
			}
		}
		fncclose($idcon);
	}

	$idcon = fncconn();
?> 
<html> 
	<head> 
		<title>nuevo registro</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=UTF8"> 
		<meta http-equiv="expires" content="0"> 
		<meta http-equiv="X-UA-Compatible" content="IE=9"> 
		<?php include ('../def/jquery.library_maestro.php'); ?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_reporteopp.js"></script>
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
			<p><font class="NoiseFormHeaderFont">Cierre de orden de produccion programada {OPP}</font></p> 
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
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
							<tr class="ui-widget-header">
								<td width="50%" class="cont-title">&nbsp;Orden de produccion programada {OPP} No.&nbsp;{<?php echo $solprocodigo; ?>}</td>
								<td width="50%" class="cont-title">&nbsp;Fecha.&nbsp;<?php echo $ordprofecgen ?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<?php include '../src/FunjQuery/jquery.tabs/reporteopp/jquery.especificaciones.php'; ?>
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td>
									<div id="tabs_opp">
										<ul>
											<li><a href="#tabs_cierre">Cierre orden {opp}</a></li>
											<li><a href="#tabs_histog">Historial de Gestiones</a></li>
											<li><a href="#tabs_histor">Historial de Reportes</a></li>
											<li><a href="#tabs_histot">Historial de Tiempos</a></li>
										</ul>
										
										<div id="tabs_cierre">
											<?php include '../src/FunjQuery/jquery.tabs/cierreopp/jquery.cierreopp.php'; ?>
										</div>
										
										<div id="tabs_histog">
											<?php include '../src/FunjQuery/jquery.tabs/cierreopp/jquery.histogestionopp.php'; ?>
										</div>
										
										<div id="tabs_histor">
											<?php include '../src/FunjQuery/jquery.tabs/cierreopp/jquery.historeporteopp.php'; ?>
										</div>
										
										<div id="tabs_histot">
											<?php include '../src/FunjQuery/jquery.tabs/cierreopp/jquery.histotiempopn.php'; ?>
										</div>
										
									</div>
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
			<input type="hidden" name="ordoppcodigo" id="ordoppcodigo" value="<?php echo $ordoppcodigo; ?>">
			<input type="hidden" name="tipsolcodigo" id="tipsolcodigo" value="<?php echo $tipsolcodigo; ?>">	
			<input type="hidden" name="sourceaction" id="sourceaction" value="nuevo">  
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="sourcetable" value="cierreopp"> 
			<input type="hidden" name="accionnuevocierreopp">
			<input type="hidden" name="flagnuevocierreopp">
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
	</body> 
<?php if (! $codigo) echo " -->"; ?> 
</html>