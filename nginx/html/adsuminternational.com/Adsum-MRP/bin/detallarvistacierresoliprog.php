<?php 
ob_start();
ini_set('display_errors',1);
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblcampertippro.php');
	include ( '../src/FunPerPriNiv/pktblcamperdesarr.php');
	include ( '../src/FunPerPriNiv/pktblcamperplanea.php');
	include ( '../src/FunPerPriNiv/pktblcptpdetope.php');
	include ( '../src/FunPerPriNiv/pktblcpdesadetope.php');
	include ( '../src/FunPerPriNiv/pktblcpplandetope.php');
	include ( '../src/FunPerPriNiv/pktblproducformula.php');
	include ( '../src/FunPerPriNiv/pktblproducpadreitem.php');
	include ( '../src/FunPerPriNiv/pktblproducpedido.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktbltiposoliprog.php');
	include ( '../src/FunPerPriNiv/pktblpadreitem.php');
	include ( '../src/FunPerPriNiv/pktblitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblvistaitemplaneacion.php');
	include ( '../src/FunPerPriNiv/pktblplaneapadreitem.php');
	include ( '../src/FunPerPriNiv/pktblplaneaitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblplanearutaitempv.php');
	include ( '../src/FunPerPriNiv/pktblformulacion.php');
	include ( '../src/FunPerPriNiv/pktblcierresoliprog.php');
	include ( '../src/FunPerPriNiv/pktblop.php');
	include ( '../src/FunPerPriNiv/pktblopextrusion.php');
	include ( '../src/FunPerPriNiv/pktblopflexo.php');
	include ( '../src/FunPerPriNiv/pktbloplaminado.php');
	include ( '../src/FunPerPriNiv/pktblopcorte.php');
	include ( '../src/FunPerPriNiv/pktblopsellado.php');
	include ( '../src/FunPerPriNiv/pktblopdoblado.php');
	include ( '../src/FunPerPriNiv/pktbloppauchado.php');
	include ( '../src/FunPerPriNiv/pktblopmicroperforado.php');
	include ( '../src/FunPerPriNiv/pktbloptroquelado.php');
	include ( '../src/FunPerPriNiv/pktblopvalvulado.php');
	include ( '../src/FunPerPriNiv/pktblreporteopp.php');
	include ( '../src/FunPerPriNiv/pktblreporteoppreportepn.php');
	include ( '../src/FunPerPriNiv/pktblreporteoppdesperdiciopn.php');
	include ( '../src/FunPerPriNiv/pktbldesperdiciopn.php');
	include ( '../src/FunPerPriNiv/pktblprocedimiento.php');
	include ('../src/FunPerPriNiv/pktbltipocump.php');		
	include ( '../src/FunGen/cargainput.php');
	
	if($acciondetallarvistacierresoliprog) 
		include ( 'editavistacierresoliprog.php');

ob_end_flush();

	if(!$flagdetallarvistacierresoliprog)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');
		//regriso de vistacierresoliprog
		$idcon = fncconn();
		$solprocodigo = $sbreg['solprocodigo'];
		$estsolcodigo = $sbreg['estsolcodigo']; 
		$usuacodigo = $sbreg['usuacodi']; 
		$produccodigo = $sbreg['produccodigo'];
		$produccoduno = $sbreg['produccoduno'];
		$producnombre = $sbreg['producnombre'];
		$ordcomcodcli = $sbreg['ordcomcodcli'];
		$ordcomrazsoc = $sbreg['ordcomrazsoc'];
		$tipevecodigo = $sbreg['tipevecodigo'];
		$pedvennumero = $sbreg['pedvennumero'];
		$solprofecha = $sbreg['solprofecha']; 
		$solprohora = $sbreg['solprohora']; 
		$plantacodigo = $sbreg['plantacodigo'];
		$pedvenfecrec = $sbreg['pedvenfecrec'];
		$pedvenfecelb = $sbreg['pedvenfecelb'];
		$pedvenfecent = $sbreg['pedvenfecent'];
		$solprodocume = $sbreg['solprodocume'];
		$solprodosize = $sbreg['solprodosize'];
		$solprofecest = $sbreg['solprofecest'];
		$tipitecodigo = $sbreg['tipprocodigo'];
		$propedcansol = $sbreg['propedcansol'];
		$unidadcodigo = $sbreg['unidadcodigo'];

		$producto = $produccodigo;
		include 'cargarcampertippro.php';
	
		$producto = $produccodigo;
		include 'cargarcamperdesarr.php';
	
		$producto = $produccodigo;
		include 'cargarcamperplanea.php';
	
		include 'cargarconfsoliprog.php';
		
		$rwCierre = loadrecordcierresoliprog1($solprocodigo,$idcon);
		
		$tipcumcodigo = $rwCierre['tipcumcodigo'];
		$cieoppdescri = $rwCierre['ciesoldescri'];
		
		fncclose($idcon);
	}
	
	$idcon = fncconn();
	
?> 
<html> 
	<head> 
    	<title>detallar registro de solicitud de programacion</title> 
    	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
    	<meta http-equiv="expires" content="0">
    	<?php include('../def/jquery.library_maestro.php');?>
    	<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
    	<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.soliprog.js"></script>
    	<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_reporteopp.js"></script>
    	<script type="text/javascript">
    		$(function(){
    			// setter
    			$( "#solprofecest" ).datepicker( "option", "minDate", "<?php echo $pedvenfecrec; ?>");
    		});
    	</script>
  </head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Solicitud de programacion</font></p> 
			<table width="800" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content">
<?php if($campnomb || $flagdetallarvistacierresoliprog): ?>
				<tr><td><div class="ui-widget">
					<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
						<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
						<strong>Advertencia:</strong> Corrija los campos marcados con *</p>
					</div>
				</div></td></tr>
<?php else: ?> 		
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
<?php endif; ?>
        		<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> detallar registro</font></span></td></tr>        		
        		<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
							<tr class="ui-widget-header">
								<td width="50%" class="cont-title">&nbsp;Solicitud de programacion No.&nbsp;{<?php echo $solprocodigo; ?>}</td>
								<td width="50%" class="cont-title">&nbsp;Fecha.&nbsp;<?php echo $solprofecha ?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td>
									<div id="tabs_soliprog">
										<ul>
											<li><a href="#tabs_solicitud">Solicitud</a></li>
											<?php if($arrProceso['tabs_solicitud']['ext'][0] > 0){?>
												<li><a href="#tabs_extrusion">Extrusion</a></li>
											<?php }?>
											<?php if($arrProceso['tabs_solicitud']['lmn'][0] > 0){?>
												<li><a href="#tabs_laminado">Laminado</a></li>
											<?php }?>
											<?php if($arrProceso['tabs_solicitud']['flx'][0] > 0){?>
												<li><a href="#tabs_flexografia">Flexografia</a></li>
											<?php }?>
											<?php if($arrProceso['tabs_solicitud']['cor'][0] > 0){?>
												<li><a href="#tabs_corte">Corte</a></li>
											<?php }?>
											<?php if($arrProceso['tabs_solicitud']['sld'][0] > 0){?>
												<li><a href="#tabs_sellado">Sellado</a></li>
											<?php }?>
											<?php if($arrProceso['tabs_solicitud']['pch'][0] > 0){?>
												<li><a href="#tabs_pauchado">Pauchado</a></li>
											<?php }?>
											<?php if($arrProceso['tabs_solicitud']['dbl'][0] > 0){?>
												<li><a href="#tabs_doblado">Doblado</a></li>
											<?php }?>
											<?php if($arrProceso['tabs_solicitud']['mcr'][0] > 0){?>
												<li><a href="#tabs_microperforado">Microperforado</a></li>
											<?php }?>
											<?php if($arrProceso['tabs_solicitud']['crt'][0]> 0){?>
												<li><a href="#tabs_corter">Corte reproceso</a></li>
											<?php }?>
										</ul>
<!-- 	INICIO SOLICITUD -->
										<div id="tabs_solicitud">
											<?php include '../src/FunjQuery/jquery.tabs/gestionsoliprog/jquery.solicitud.det.php'; ?>
											<?php include '../src/FunjQuery/jquery.tabs/cierresoliprog/jquery.cierresoliprog.det.php'; ?>
										</div>
<!-- 	FIN SOLICITUD -->
<!-- 	INICIO EXTRUSION -->
									<?php if($arrProceso['tabs_solicitud']['ext'][0] > 0){?>
										<div id="tabs_extrusion">
											<?php include '../src/FunjQuery/jquery.tabs/gestionsoliprog/jquery.extrusion.det.php'; ?>
										</div>
									<?php }?>
<!-- 	FIN EXTRUSION -->
<!-- 	FLEXOGRAFIA -->
									<?php if($arrProceso['tabs_solicitud']['flx'][0] > 0){?>
										<div id="tabs_flexografia">
											<?php include '../src/FunjQuery/jquery.tabs/gestionsoliprog/jquery.flexografia.det.php'; ?>
										</div>
									<?php }?>
<!-- 	FIN FLEXOGRAFIA -->
<!-- 	LAMINADO -->
									<?php if($arrProceso['tabs_solicitud']['lmn'][0] > 0){?>
										<div id="tabs_laminado">
											<?php include '../src/FunjQuery/jquery.tabs/gestionsoliprog/jquery.laminado.det.php'; ?>
										</div>
									<?php }?>
<!-- 	FIN LAMINADO -->
<!-- 	CORTE -->
									<?php if($arrProceso['tabs_solicitud']['cor'][0] > 0){?>
										<div id="tabs_corte">
											<?php include '../src/FunjQuery/jquery.tabs/gestionsoliprog/jquery.corte.det.php'; ?>
										</div>
									<?php }?>
<!-- 	FIN CORTE -->
<!-- 	SELLADO -->
									<?php if($arrProceso['tabs_solicitud']['sld'][0] > 0){?>
										<div id="tabs_sellado">
											<?php include '../src/FunjQuery/jquery.tabs/gestionsoliprog/jquery.sellado.det.php'; ?>
										</div>
									<?php }?>
<!-- 	FIN SELLADO -->
<!-- 	PAUCHADO -->
									<?php if($arrProceso['tabs_solicitud']['pch'][0] > 0){?>
										<div id="tabs_pauchado">
											<?php include '../src/FunjQuery/jquery.tabs/gestionsoliprog/jquery.pauchado.det.php'; ?>
										</div>
									<?php }?>
<!-- 	FIN PAUCHADO -->
<!-- 	DOBLADO -->
									<?php if($arrProceso['tabs_solicitud']['dbl'][0] > 0){?>
										<div id="tabs_doblado">
											<?php include '../src/FunjQuery/jquery.tabs/gestionsoliprog/jquery.doblado.det.php'; ?>
										</div>
									<?php }?>
<!-- 	FIN DOBLADO -->
<!-- 	MICROPERFORADO -->
									<?php if($arrProceso['tabs_solicitud']['mcr'][0] > 0){?>
										<div id="tabs_microperforado">
											<?php include '../src/FunjQuery/jquery.tabs/gestionsoliprog/jquery.microperforado.det.php'; ?>
										</div>
									<?php }?>
<!-- 	FIN MICROPERFORADO -->
<!-- 	TROQUELADO -->
									<?php if($arrProceso['tabs_solicitud']['tql'][0] > 0){?>
										<div id="tabs_troquelado">
											<?php include '../src/FunjQuery/jquery.tabs/gestionsoliprog/jquery.troquelado.det.php'; ?>
										</div>
									<?php }?>
<!-- 	FIN TROQUELADO -->
<!-- 	VALVULADO -->
									<?php if($arrProceso['tabs_solicitud']['vlv'][0] > 0){?>
										<div id="tabs_valvulado">
											<?php include '../src/FunjQuery/jquery.tabs/gestionsoliprog/jquery.valvulado.det.php'; ?>
										</div>
									<?php }?>
<!-- 	FIN VALVULADO -->
<!-- 	CORTE-REPROCESO -->
									<?php if($arrProceso['tabs_solicitud']['crt'][0] > 0){?>
										<div id="tabs_corter">
											<?php include '../src/FunjQuery/jquery.tabs/soliprog/jquery.corter.det.php'; ?>
										</div>
									<?php }?>
<!-- 	FIN CORTE-REPROCESO -->
									</div>
								</td>
							</tr>
						</table>
					</td>
				</tr>
    			<tr><td>&nbsp;</td></tr>
    			<tr>
					<td class="NoiseErrorDataTD" align="center"><div class="ui-buttonset">
						<button id="aceptar">Aceptar</button>&nbsp;&nbsp;&nbsp;&nbsp;
					</div></td>
				</tr>
				<tr><td>&nbsp;</td></tr>
     		</table> 
     		<input type="hidden" name="accionnuevosoliprog">
     		<input type="hidden" name="acciondetallarvistacierresoliprog">
   			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar">
     		<input type="hidden" name="solprocodigo" value="<?php echo $solprocodigo; ?>"> 
     		<input type="hidden" name="estsolcodigo" value="<?php echo $estsolcodigo; ?>"> 
     		<input type="hidden" name="produccodigo" value="<?php echo $produccodigo; ?>"> 
     		<input type="hidden" name="produccoduno" value="<?php echo $produccoduno; ?>"> 
     		<input type="hidden" name="producnombre" value="<?php echo $producnombre; ?>"> 
     		<input type="hidden" name="ordcomcodcli" value="<?php echo $ordcomcodcli; ?>"> 
     		<input type="hidden" name="ordcomrazsoc" value="<?php echo $ordcomrazsoc; ?>"> 
     		<input type="hidden" name="tipevecodigo" value="<?php echo $tipevecodigo; ?>">
     		<input type="hidden" name="pedvennumero" value="<?php echo $pedvennumero; ?>">
     		<input type="hidden" name="solprofecha" value="<?php echo $solprofecha; ?>">
     		<input type="hidden" name="solprohora" value="<?php echo $solprohora; ?>">
     		<input type="hidden" name="plantacodigo" value="<?php echo $plantacodigo; ?>">     		
     		<input type="hidden" name="pedvenfecrec" id="pedvenfecrec" value="<?php echo $pedvenfecrec; ?>">     		
     		<input type="hidden" name="pedvenfecelb" value="<?php echo $pedvenfecelb; ?>">     		
     		<input type="hidden" name="pedvenfecent" value="<?php echo $pedvenfecent; ?>">     		
     		<input type="hidden" name="solprodocume" value="<?php echo $solprodocume; ?>">     		
     		<input type="hidden" name="solprodosize" value="<?php echo $solprodosize; ?>">     		
     		<input type="hidden" name="usuacodigo" value="<?php echo $usuacodigo; ?>">
     		<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<!-- VARIABLES UTILIZADAS PARA LA SOLICITUD DE PROGRAMACION Y SUS ORDENES DE PRODUCCION -->
			<input type="hidden" name="tipo_impresion" value="<?php echo $tipo_impresion; ?>">
			<input type="hidden" name="anchoproceso" value="<?php echo $anchoproceso; ?>">
			<input type="hidden" name="ordprocantid" value="<?php echo $ordprocantid; ?>">
			<input type="hidden" name="version_arte" value="<?php echo $version_arte; ?>">
			<input type="hidden" name="product_imp" value="<?php echo $product_imp; ?>">
			<input type="hidden" name="tipo_estruc" value="<?php echo $tipo_estruc; ?>">
			<input type="hidden" name="tam_core" value="<?php echo $tam_core; ?>">
     		<input type="hidden" name="nropistas" value="<?php echo $nropistas; ?>">
     		<input type="hidden" name="nrorepet" value="<?php echo $nrorepet; ?>">
     		<input type="hidden" name="continuo" value="<?php echo $continuo; ?>">
     		<input type="hidden" name="pmillar" value="<?php echo $pmillar; ?>">
     		<input type="hidden" name="rodillo" value="<?php echo $rodillo; ?>">
     		<input type="hidden" name="fuelle" value="<?php echo $fuelle; ?>">     	     		
     		<input type="hidden" name="ancho" value="<?php echo $ancho; ?>">
     		<input type="hidden" name="largo" value="<?php echo $largo; ?>">
     		
<!-- FIN VARIABLES UTILIZADAS PARA LA SOLICITUD DE PROGRAMACION Y SUS ORDENES DE PRODUCCION -->
   		</form> 
   		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
   		<div id="msgwindowform" title="Adsum Kallpa[Gestion MP]"><span id="msgform"></span></div>
 	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>