<?php 
	ini_set('display_errors',1);
ob_start();
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
	include ("../src/FunGen/cargainput.php");
ob_end_flush();
	if($accioneditaranalisispr) 
	{ 
		include ( 'editaanalisispr.php'); 
		$flageditaranalisispr = 1;
		
	}

	if(!$flageditaranalisispr)
	{

		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');
			
		$idcon = fncconn();

		$analiscodigo = $sbreg["analiscodigo"];
		$procedcodigo = $sbreg["procedcodigo"];
		$ordoppcodigo = $sbreg["ordoppcodigo"];
		$usuacodigo = $sbreg["usuacodi"];
		$analisfecha = $sbreg["analisfecha"];
		$estanacodigo = $sbreg["estanacodigo"];
		$analisdescri = $sbreg["analisdescri"];
			
		$rwOpp = loadrecordvistaopp($ordoppcodigo,$idcon);
		$rwOrdenp = loadrecordop1($ordoppcodigo,$idcon);
		$flagvalidaciongestionopp = 1;

		$ordoppcodigo = $rwOpp["ordoppcodigo"];
		$opestacodigo = $rwOpp["opestacodigo"];
		$equipocodigo = $rwOpp["equipocodigo"];
		$equiponombre = $rwOpp["equiponombre"];
		$ordprofecgen = $rwOpp["ordprofecgen"];
		$prograindice = $rwOpp["prograindice"];
		$procedcodigo = $rwOpp["procedcodigo"];
		$procednombre = $rwOpp["procednombre"];
		$pedvencodigo = $rwOpp["pedvencodigo"];
		$pedvennumero = $rwOpp["pedvennumero"];
		$tipevecodigo = $rwOpp["tipevecodigo"];
		$tipevenombre = $rwOpp["tipevenombre"];
		$produccodigo = $rwOpp["produccodigo"];
		$produccoduno = $rwOpp["produccoduno"];
		$producnombre = $rwOpp["producnombre"];
		$ordcomcodcli = $rwOpp["ordcomcodcli"];
		$ordcomrazsoc = $rwOpp["ordcomrazsoc"];
		$plantacodigo = $rwOpp["plantacodigo"];
		$plantanombre = $rwOpp["plantanombre"];
		$tipsolcodigo = $rwOpp["tipsolcodigo"];
		$solprocodigo = $rwOpp["solprocodigo"];
		
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
				$rwVarAnalisis = loadrecordvaranalisis($rwPrvaranalisis['varanacodigo'],$idcon);
				$varValor = 'txtvalor'.$rwPrvaranalisis['varanacodigo'];
				$$varValor = $rwPrvaranalisis["prvaravalor"];

				if($rwVarAnalisis["varanatipespe"] == 1){

				//ingresar codigo para validar con porcentaje

				}else if($rwVarAnalisis["varanatipespe"] == 2){//mayor igual

					if( $$varValor < $rwVarAnalisis["varanadetesp"] ){

						$campnombre[$varValor] = 1;
					}
					
				}else if($rwVarAnalisis["varanatipespe"] == 3){//menor igual

					if( $$varValor > $rwVarAnalisis["varanadetesp"] ){

						$campnombre[$varValor] = 1;
					}

				}else if($rwVarAnalisis["varanatipespe"] == 4){//binaria 1/0

					if( $$varValor != 1){
						$campnombre[$varValor] = 1;
					}

				}

			}
		}
		
		fncclose($idcon);
	}

$idcon = fncconn();
?>
<html> 
	<head> 
		<title>Editar registro de analisis de materias primas</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_analisispr.js"></script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Analisis de materias primas</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="650">
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
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
            				<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Responsable</td>
								<td width="80%" class="NoiseDataTD"><?php echo ($usuacodi)? cargausuanombre($usuacodi,$idcon) : "---" ; ?></td> 
 							</tr>
 							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["analisfecha"] == 1){ $analisfecha = null; echo "*";}?>&nbsp;Fecha</td>
								<td width="80%" class="NoiseDataTD"><?php echo date("Y-m-d"); ?></td> 
 							</tr>
 							<tr>
								<td colspan="2">
 									<div class="ui-buttonset ui-state-default NoiseDataTD">&nbsp;Plan de inspecci&oacute;n&nbsp;</div>
 										<div id="filtrlistavaranalisis">
										<?php
											$noAjax = true;
											include '../src/FunjQuery/jquery.visors/jq.vanalisispr.php';  
										?>
									</div>
 								</td>
							</tr>
      						<tr>
     							<td width="20%" class="NoiseFooterTD"><?php if($campnomb["estanacodigo"] == 1): $estanacodigo = null; ?><span style="color:black;">*</span><?php endif; ?>&nbsp;Estado</td>
     							<td width="80%" class="NoiseDataTD">
     								<select name="estanacodigo" id="estanacodigo">
     									<option value = "">-- Seleccione --</option>
	     								<?php									
											include ('../src/FunGen/floadestadoanalisis.php');
											floadestadoanalisis($estanacodigo,$idcon);
										?>
    								</select>
    							</td>
							</tr>
							<tr><td colspan="4" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="4" class="NoiseFooterTD"><?php if($campnomb["analisdescri"]== 1){$analisdescri = null; echo "*";}?>&nbsp;Descripci&oacute;n</td></tr>
							<tr><td colspan="4" rowspan="2" class="NoiseDataTD"><textarea name="analisdescri" rows="3" cols="95"><?php echo $analisdescri; ?></textarea> </td></tr>
 						</table>
 					</td>
 				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_form.php'; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
			</table> 
			<input type="hidden" name="accioneditaranalisispr">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="editar">
			<input type="hidden" name="usuacodigo" value="<?php echo $usuacodigo; ?>"> 
			<input type="hidden" name="analiscodigo" value="<?php echo $analiscodigo; ?>"> 
			<input type="hidden" name="analisfecha" value="<?php echo $analisfecha; ?>">
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
<?php if(!$codigo){ echo " -->"; } ?> 
</html>