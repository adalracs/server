<?php 
	ini_set('display_errors',1);
	include ("../src/FunPerPriNiv/pktblplaneaitemdesa.php");
	include ( "../src/FunPerPriNiv/pktblrequisicionitemdesa.php");
	include ( "../src/FunPerPriNiv/pktblgestionoppreportesaldo.php");
	include ( "../src/FunPerPriNiv/pktblgestionoppitemdesa.php");
	include ( "../src/FunPerPriNiv/pktblgestionoppreporte.php");
	include ( "../src/FunPerPriNiv/pktblgestionoppsaldo.php");
	include ("../src/FunPerPriNiv/pktblvistaalarmagestion.php");
	include ("../src/FunPerPriNiv/pktblplanearutaitempv.php");
	include ( "../src/FunPerPriNiv/pktblrequisicionopp.php");
	include ("../src/FunPerPriNiv/pktblprocedimiento.php");	
	include ("../src/FunPerPriNiv/pktblalarmamodulo.php");
	include ("../src/FunPerPriNiv/pktblopextrusion.php");
	include ("../src/FunPerPriNiv/pktblformulacion.php");
	include ( "../src/FunPerPriNiv/pktblgestionopp.php");
	include ("../src/FunPerPriNiv/pktbloppitemdesa.php");
	include ("../src/FunPerPriNiv/pktblalarmaitem.php");
	include ("../src/FunPerPriNiv/pktbloppauchado.php");
	include ("../src/FunPerPriNiv/pktbloplaminado.php");
	include ("../src/FunPerPriNiv/pktblopsellado.php");
	include ("../src/FunPerPriNiv/pktblitemdesa.php");
	include ("../src/FunPerPriNiv/pktblopestado.php");
	include ("../src/FunPerPriNiv/pktblopflexo.php");
	include ("../src/FunPerPriNiv/pktblopcorte.php");
	include ("../src/FunPerPriNiv/pktblvistaopp.php");
	include ("../src/FunPerPriNiv/pktblusuario.php");
	include ("../src/FunPerPriNiv/pktblpadreitem.php");
	include ("../src/FunPerPriNiv/pktblalarma.php");
	include ("../src/FunPerPriNiv/pktblsaldo.php");
	include ("../src/FunGen/sesion/fncvalses.php"); 
	include ("../src/FunPerPriNiv/pktbllote.php");
	include ("../src/FunPerPriNiv/pktblopp.php");
	include ("../src/FunPerPriNiv/pktblop.php");	
	include ("../src/FunGen/cargainput.php");
	include_once("../src/FunGen/floadlotesaldo.php");
	include_once("../src/FunPerSecNiv/fncsqlrun.php");
	
	if($accionnuevoreportegestionopp) 
		include ( "grabareportegestionopp.php");
		
		
	if(!$flagnuevoreportegestionopp)
	{
		$idcon = fncconn();
		$nombre = cargausuanombre($usuacodi, $idcon);
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$ordoppcodigo);

		$idcon = fncconn();

		if (!$sbreg)
		{
			$ordoppcodigo = str_replace('|n', '', $ordoppcodigo);
			$sbreg= loadrecordvistaopp($ordoppcodigo,$idcon);
			$rwOrdenp = loadrecordop1($ordoppcodigo,$idcon);
			$flagvalidaciongestionopp = 1;
		}else{
			$ordoppcodigo = $sbreg["ordoppcodigo"];
		}
		//VARIABLES DE LA VISTA
		$ordoppcodigo = $sbreg["ordoppcodigo"];
		$opestacodigo = $sbreg["opestacodigo"];
		$opestacodigo2 = $sbreg["opestacodigo"];
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
		$gesoppdescri = "Gestion de Entrega [OK]";

		//$MODULOCODIGO	= 7;//constante de la tabla "modulo" 
		//$rutamodulo = 'maestablgestionopp.php';
		//include 'scanalarma.php';//se escanea para activar alarmas configuradas
		
		$rwGestionopp = loadrecordultimagestionopp($ordoppcodigo,$idcon);

		if( $rwGestionopp > 0 ){

			$rsGestionOppSaldo = dinamicscanopgestionoppsaldo( array( "gesoppcodigo" => $rwGestionopp["gesoppcodigo"]), array( "gesoppcodigo" => "=" ), $idcon);
			$nrGestionOppSaldo = fncnumreg($rsGestionOppSaldo);
			for( $a = 0; $a < $nrGestionOppSaldo; $a++)
			{
				$rwGestionOppSaldo = fncfetch($rsGestionOppSaldo,$a);
				$rwSaldo = loadrecordsaldo($rwGestionOppSaldo["saldocodigo"],$idcon);
				$arritem = ($arritem)? $arritem.":|:".$rwSaldo["itedescodigo"].":-:t:-:".$rwGestionOppSaldo["saldocodigo"] : $rwSaldo["itedescodigo"].":-:t:-:".$rwGestionOppSaldo["saldocodigo"] ;
				$obj_itedescodigoid = "itedescodigoid_".$rwSaldo["itedescodigo"].":-:t:-:".$rwGestionOppSaldo["saldocodigo"];
				$$obj_itedescodigoid = $rwGestionOppSaldo["itedescodigoid"];
			}

			$rsGestionOppItemdesa = dinamicscanopgestionoppitemdesa( array( "gesoppcodigo" => $rwGestionopp["gesoppcodigo"]), array( "gesoppcodigo" => "=" ), $idcon);
			$nrGestionOppItemdesa = fncnumreg($rsGestionOppItemdesa);
			for( $a = 0; $a < $nrGestionOppItemdesa; $a++)
			{
				$rwGestionOppItemdesa = fncfetch($rsGestionOppItemdesa,$a);
				$arritem = ($arritem)? $arritem.":|:".$rwGestionOppItemdesa["itedescodigo"].":-:f" : $rwGestionOppItemdesa["itedescodigo"].":-:f" ;
				$obj_consumo = "consumo_".$rwGestionOppItemdesa["itedescodigo"].":-:f";
				$$obj_consumo = $rwGestionOppItemdesa["gesoppcantkg"];
			}

		}
		
		$rsRutaitempv = dinamicscanplanearutaitempv(array( "produccodigo" => $produccodigo),$idcon);
		$nrRutaitempv = fncnumreg($rsRutaitempv);
		for( $a = 0; $a < $nrRutaitempv; $a++)
		{
			$rwRutaitempv = fncfetch($rsRutaitempv,$a);
			$rutaitempv = ($rutaitempv)? $rutaitempv." <b>/</b>".cargaprocedimientonombre($rwRutaitempv["procedcodigo"],$idcon) : cargaprocedimientonombre($rwRutaitempv["procedcodigo"],$idcon) ;
		}
		
		$rsOrdenpro = dinamicscanop(array("ordoppcodigo" => $ordoppcodigo),$idcon);
		$nrOrdenpro = fncnumreg($rsOrdenpro);
		for( $a = 0; $a < 1; $a++)
		{
			$rwOrdenpro = fncfetch($rsOrdenpro,$a);
			$rwOpextrision = loadrecordopextrusion($rwOrdenpro["ordprocodigo"],$idcon);
			$rwFormulacion = loadrecordformulacion($rwOpextrision["formulcodigo"],$idcon);
			$formulnumero = $rwFormulacion["formulnumero"];
		}
		fncclose($idcon);
	}

	$idcon = fncconn();

	$rwOpestado = loadrecordopestado($opestacodigo2,$idcon);
?> 
<html> 
	<head> 
		<title>nuevo reporte</title> 
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
			<p><font class="NoiseFormHeaderFont">Reporte de orden de produccion programada {OPP}</font></p> 
			<table width="800" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content">
<?php if($campnomb): ?>
				<tr><td><div class="ui-widget">
					<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
						<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
						<strong>Advertencia:</strong> <?php if($campnomb['err']): echo $campnomb['err']; else: ?> Corrija los campos marcados con *<?php endif; ?></p>
					</div>
				</div></td></tr>
<?php elseif($rwOpestado['opestatipo'] == 2): ?> 	
				<tr><td><div class="ui-widget">
					<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
						<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
						<strong>Advertencia:</strong> No es posible realizar esta operacion.</p>
						<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
						<strong>Nota:</strong> Debe de tener materiales asignados.</p>
					</div>
				</div></td></tr>	
<?php elseif($flagvalidaciongestionopp): ?> 	
				<tr><td><div class="ui-widget">
					<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
						<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
						<strong>Advertencia:</strong> No es posible realizar esta operacion.</p>
						<!--
						<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
						<strong>Nota:</strong> Debe de tener gestion de materiales asignados.</p>
						<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
						<strong>Estado :</strong> <?php //echo cargaopestanombre($rwOrdenp['opestacodigo'],$idcon); ?></p>
						-->
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
						<?php include '../src/FunjQuery/jquery.tabs/gestionopp/jquery.especificaciones.php'; ?>
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td>
									<div id="tabs_opp">
										<ul>
											<li><a href="#tabs_material">Reporte Material</a></li>
											<li><a href="#tabs_reporte">Reporte orden {opp}</a></li>
										</ul>
										
										<div id="tabs_material">
											<?php include '../src/FunjQuery/jquery.tabs/gestionopp/jquery.datosmaterial.php'; ?>
											<?php include '../src/FunjQuery/jquery.tabs/gestionopp/jquery.gestionmaterial.det.php';?>
											<?php include '../src/FunjQuery/jquery.tabs/gestionopp/jquery.reportegestionoppmaterial.php'; ?>
										</div>

										<div id="tabs_reporte">
											<?php include '../src/FunjQuery/jquery.tabs/gestionopp/jquery.reportegestionopp.php'; ?>
											<?php include '../src/FunjQuery/jquery.tabs/gestionopp/jquery.histogestionopp.php'; ?>
											<?php include '../src/FunjQuery/jquery.tabs/gestionopp/jquery.historeporteopp.php'; ?>
											<?php include '../src/FunjQuery/jquery.tabs/gestionopp/jquery.historeporterecepoppapro.php'; ?>
											<?php include '../src/FunjQuery/jquery.tabs/gestionopp/jquery.historeporterecepopprech.php'; ?>
										</div>
										
									</div>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			<?php if($rwOpestado['opestatipo'] == 3 || $rwOpestado['opestatipo'] == 4):?>
			<?php endif;?>
				<tr>
					<td class="NoiseErrorDataTD" align="center"></td>
				</tr>
			<?php if($rwOpestado['opestatipo'] == 3 || $rwOpestado['opestatipo'] == 4):?>
				<tr><td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_form.php'; ?></td></tr>
			<?php else:?>
				<tr><td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_formdetall.php'; ?></td></tr>
			<?php endif;?> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table>
			<?php if($rwOpestado['opestatipo'] == 3 || $rwOpestado['opestatipo'] == 4):?>
			<input type="hidden" name="flagnuevoreportegestionopp">
			<input type="hidden" name="sourceaction" id="sourceaction" value="nuevoreporte"> 
			<input type="hidden" name="sourcetable" value="gestionopp">
			<input type="hidden" name="accionnuevoreportegestionopp"> 
			<?php else:?>
			<input type="hidden" name="flagdetallargestionopp" value="1">
			<input type="hidden" name="sourceaction" id="sourceaction" value="detallar">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>"> 
			<input type="hidden" name="acciondetallargestionopp">
			<?php endif;?> 
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
			<input type="hidden" name="tipsolcodigo" value="<?php echo $tipsolcodigo; ?>">	
			<input type="hidden" name="solprocodigo" value="<?php echo $solprocodigo; ?>">
			<input type="hidden" name="opestacodigo2" value="<?php echo $opestacodigo2; ?>">
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
		<div id="msgwindowform" title="Adsum Kallpa"><span id="msgform"></span></div>
	</body> 
<?php if (! $codigo) echo " -->"; ?> 
</html>