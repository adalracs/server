<?php 
	ini_set('display_errors',1);
	include ('../src/FunGen/cargainput.php');
	include ('../src/FunPerPriNiv/pktblop.php');
	include ('../src/FunPerPriNiv/pktblsaldo.php');
	include ('../src/FunGen/sesion/fncvalses.php'); 
	include ('../src/FunPerPriNiv/pktblusuario.php');
	include ('../src/FunPerPriNiv/pktblitemdesa.php');	
	include ('../src/FunPerPriNiv/pktblopestado.php');
	include ('../src/FunPerPriNiv/pktblgestionopp.php');
	include ('../src/FunPerPriNiv/pktblopextrusion.php');
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
		
	if(!$flagdetallarcierreopp)
	{
		$idcon = fncconn();
		$nombre = cargausuanombre($usuacodi, $idcon);
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg) 
			include( '../src/FunGen/fnccontfron.php');
		//VARIABLES DE LA VISTA		
		$ordoppcodigo = $sbreg['ordoppcodigo'];
		$opestacodigo = $sbreg['opestacodigo'];
		$equipocodigo = $sbreg['equipocodigo'];
		$equiponombre = $sbreg['equiponombre'];
		$ordprofecgen = $sbreg['ordprofecgen'];
		$prograindice = $sbreg['prograindice'];
		$procedcodigo = $sbreg['procedcodigo'];
		$procednombre = $sbreg['procednombre'];
		$pedvencodigo = $sbreg['pedvencodigo'];
		$pedvennumero = $sbreg['pedvennumero'];
		$tipevecodigo = $sbreg['tipevecodigo'];
		$tipevenombre = $sbreg['tipevenombre'];
		$produccodigo = $sbreg['produccodigo'];
		$produccoduno = $sbreg['produccoduno'];
		$producnombre = $sbreg['producnombre'];
		$ordcomcodcli = $sbreg['ordcomcodcli'];
		$ordcomrazsoc = $sbreg['ordcomrazsoc'];
		$plantacodigo = $sbreg['plantacodigo'];
		$plantanombre = $sbreg['plantanombre'];
		$tipsolcodigo = $sbreg['tipsolcodigo'];
		$solprocodigo = $sbreg["solprocodigo"];
		
		$idcon = fncconn();
		
		$rwCierre = loadrecordcierreopp1($ordoppcodigo,$idcon);
		
		$tipcumcodigo = $rwCierre['tipcumcodigo'];
		$cieoppdescri = $rwCierre['cieoppdescri'];
			
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
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_reporteopp.js"></script>
		<style type="text/css">
			.ui-autocomplete-loading { background: white url('../img/ui-anim_basic_16x16.gif') right center no-repeat; }
		</style>
	</head> 
<?php if (! $codigo) echo "<!--"; ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post" enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Detalle de orden de produccion programada {OPP}</font></p> 
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
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr>        		
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
											<?php include '../src/FunjQuery/jquery.tabs/cierreopp/jquery.cierreopp.det.php'; ?>
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
				<tr><td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_formdetall.php'; ?></td></tr> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table>
			<input type="hidden" name="flagdetallarcierreopp" value="1">
			<input type="hidden" name="acciondetallarcierreopp">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>"> 
			<input type="hidden" name="sourceaction" value="detallar">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<!--		VARIABLES DE LA VISTA -->
			<input type="hidden" name="ordoppcodigo" value="<?php echo $ordoppcodigo ?>">
			<input type="hidden" name="opestacodigo" value="<?php echo $opestacodigo ?>">
			<input type="hidden" name="equipocodigo" value="<?php echo $equipocodigo ?>">
			<input type="hidden" name="equiponombre" value="<?php echo $equiponombre ?>">
			<input type="hidden" name="ordprofecgen" value="<?php echo $ordprofecgen ?>">
			<input type="hidden" name="prograindice" value="<?php echo $prograindice ?>">
			<input type="hidden" name="procedcodigo" value="<?php echo $procedcodigo ?>">
			<input type="hidden" name="procednombre" value="<?php echo $procednombre ?>">
			<input type="hidden" name="pedvencodigo" value="<?php echo $pedvencodigo ?>">
			<input type="hidden" name="pedvennumero" value="<?php echo $pedvennumero ?>">		
			<input type="hidden" name="tipevecodigo" value="<?php echo $tipevecodigo ?>">
			<input type="hidden" name="tipevenombre" value="<?php echo $tipevenombre ?>">
			<input type="hidden" name="produccodigo" value="<?php echo $produccodigo ?>">
			<input type="hidden" name="produccoduno" value="<?php echo $produccoduno ?>">
			<input type="hidden" name="producnombre" value="<?php echo $producnombre ?>">
			<input type="hidden" name="ordcomcodcli" value="<?php echo $ordcomcodcli ?>">
			<input type="hidden" name="ordcomrazsoc" value="<?php echo $ordcomrazsoc ?>">
			<input type="hidden" name="plantacodigo" value="<?php echo $plantacodigo ?>">				
			<input type="hidden" name="plantanombre" value="<?php echo $plantanombre ?>">	
			<input type="hidden" name="tipsolcodigo" value="<?php echo $tipsolcodigo ?>">	
			<input type="hidden" name="rutaitempv" value="<?php echo $rutaitempv ?>">	
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
	</body> 
<?php if (! $codigo) echo " -->"; ?> 
</html>