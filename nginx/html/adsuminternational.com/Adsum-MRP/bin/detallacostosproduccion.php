<?php 
ini_set("display_errors", 1);
ob_start();
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
	include ( '../src/FunPerPriNiv/pktblop.php');
	include ( '../src/FunPerPriNiv/pktblopextrusion.php');
	include ( '../src/FunPerPriNiv/pktblopflexo.php');
	include ( '../src/FunPerPriNiv/pktbloplaminado.php');
	include ( '../src/FunPerPriNiv/pktblopcorte.php');
	include ( '../src/FunPerPriNiv/pktblopsellado.php');
	include ( '../src/FunPerPriNiv/pktbloppauchado.php');
	include ( '../src/FunPerPriNiv/pktbltarifa.php');
	include ( '../src/FunPerPriNiv/pktblopdoblado.php');
	include ( '../src/FunPerPriNiv/pktblopmicroperforado.php');
	include ( '../src/FunPerPriNiv/pktbloptroquelado.php');
	include ( '../src/FunPerPriNiv/pktblopvalvulado.php');
	include ( '../src/FunPerPriNiv/pktblreporteopp.php');
	include ( '../src/FunPerPriNiv/pktblreporteoppreportepn.php');
	include ( '../src/FunPerPriNiv/pktblreporteoppdesperdiciopn.php');
	include ( '../src/FunPerPriNiv/pktbldesperdiciopn.php');
	include ( '../src/FunPerPriNiv/pktbltiposoliprog.php');
	include ( '../src/FunPerPriNiv/pktblpadreitem.php');
	include ( '../src/FunPerPriNiv/pktblitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblvistaitemplaneacion.php');
	include ( '../src/FunPerPriNiv/pktblplaneapadreitem.php');
	include ( '../src/FunPerPriNiv/pktblplaneaitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblplanearutaitempv.php');
	include ( '../src/FunPerPriNiv/pktblformulacion.php');
	include ( '../src/FunPerPriNiv/pktblprocedimiento.php');
	include ( '../src/FunPerPriNiv/pktblvistagestionsoliprog.php');
	include ( '../src/FunPerPriNiv/pktblsoliprog.php');
	include ( '../src/FunPerPriNiv/pktblgestionopp.php');
	include ( '../src/FunPerPriNiv/pktblvistasoliprog.php');
	include ( '../src/FunPerPriNiv/pktblgestionoppitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblreporteopptiempopn.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerSecNiv/fncconn.php');
	include ( '../src/FunPerSecNiv/fncnumreg.php');
	include ( '../src/FunPerSecNiv/fncfetch.php');
	include ( '../src/FunPerSecNiv/fncsqlrun.php');
	include ( '../src/FunPerSecNiv/fncclose.php');
	include ( '../src/FunGen/cargainput.php');

ob_end_flush();
	

		$idcon = fncconn();
		if($pedvennumero) {
			$ircrecord['pedvennumero']=$pedvennumero;
			$ircrecordop['pedvennumero']='=';
		}
		if($solprocodigo){
			$ircrecord['solprocodigo']=$solprocodigo;
			$ircrecordop['solprocodigo']='=';
		}
		if($produccoduno){
			$ircrecord['produccoduno']=$produccoduno;
			$ircrecordop['produccoduno']='=';
		}
		if($producnombre){
			$ircrecord['producnombre']=$producnombre;
			$ircrecordop['producnombre']='=';
		}
		$sql="SELECT DISTINCT soliprog.solprocodigo, soliprog.estsolcodigo, soliprog.usuacodi, soliprog.produccodigo, producto.tipprocodigo, tipoproduc.tippronombre, producto.produccoduno, producto.producnombre, ordencompra.ordcomcodcli, ordencompra.ordcomrazsoc, pedidoventa.tipevecodigo, pedidoventa.pedvennumero, soliprog.solprofecha, soliprog.solprohora, soliprog.plantacodigo, pedidoventa.pedvenfecrec, pedidoventa.pedvenfecelb, pedidoventa.pedvenfecent, soliprog.solprodocume, soliprog.solprodosize, soliprog.solprofecest, producpedido.propedcansol, producpedido.unidadcodigo
			   FROM soliprog
	   		   LEFT JOIN soliprogestado ON soliprog.estsolcodigo = soliprogestado.estsolcodigo
			   LEFT JOIN producto ON soliprog.produccodigo = producto.produccodigo
			   LEFT JOIN tipoproduc ON producto.tipprocodigo = tipoproduc.tipprocodigo
			   LEFT JOIN producpedido ON soliprog.produccodigo = producpedido.produccodigo
			   LEFT JOIN pedidoventa ON producpedido.pedvencodigo = pedidoventa.pedvencodigo
			   LEFT JOIN ordencompra ON pedidoventa.ordcomcodigo = ordencompra.ordcomcodigo
			   LEFT JOIN op ON soliprog.solprocodigo =  op.solprocodigo
			   LEFT JOIN opp on opp.ordoppcodigo =  op.ordoppcodigo
			   LEFT JOIN gestionopp on gestionopp.ordoppcodigo = opp.ordoppcodigo
			   LEFT JOIN gestionoppitemdesa on gestionoppitemdesa.gesoppcodigo = gestionopp.gesoppcodigo
			   WHERE op.ordprocodigo is not null AND opp.ordoppcodigo  is not null AND gestionopp.gesoppcodigo is not null AND 
			   gestionoppitemdesa.itedescodigo is not null ";
			if($consulfecini && $consulfecfin) {    
			   $sql.=" AND solprofecha BETWEEN '".$consulfecini."' AND '".$consulfecfin."'"; 
			}

			if($pedvennumero) {
				$sql.=" AND pedidoventa.pedvennumero ='".trim($pedvennumero)."'";
				$flaganidar=1;
			}

			if($tipprocodigo){
				if($flaganidar){
					$sql.=" AND producto.tipprocodigo ='".$tipprocodigo."'";
					$flaganidar=1;
				}else{
					$sql.=" AND producto.tipprocodigo ='".$tipprocodigo."'";
					$flaganidar=0;
				}
			}
			if($produccoduno){
				if($flaganidar){
					$sql.=" AND producto.produccoduno ='".$produccoduno."'";
					$flaganidar=1;
				}else{
					$sql.=" AND producto.produccoduno ='".$produccoduno."'";
					$flaganidar=0;
				}
			}
			if($producnombre){
				if($flaganidar){
					$sql.=" AND producto.producnombre ='".$producnombre."'";
					$flaganidar=1;
				}else{
					$sql.="AND producto.producnombre ='".$producnombre."'";
					$flaganidar=0;
				}
			}
			if($ordcomrazsoc){
				if($flaganidar){
					$sql.=" AND ordencompra.ordcomrazsoc ='".$ordcomrazsoc."'";
					$flaganidar=1;
				}else{
					$sql.="AND ordencompra.ordcomrazsoc ='".$ordcomrazsoc."'";
					$flaganidar=0;
				}
			}
			if($ordoppcodigo){
				if($flaganidar){
					$sql.=" AND op.ordoppcodigo ='".$ordoppcodigo."'";
					$flaganidar=1;
				}else{
					$sql.="AND op.ordoppcodigo ='".$ordoppcodigo."'";
					$flaganidar=0;
				}
			}
			//echo $sql;
		//$srGestionsoliprog = dinamicscanopvistasoliprog($ircrecord,$ircrecordop,$idcon);
		$srGestionsoliprog = fncsqlrun($sql,$idcon);
		$nrGestionsoliprog = fncnumreg($srGestionsoliprog);	
		$costosMateriaprima=0;
		$costosManoObra=0;
	
	
?> 
<html> 
	<head> 
    	<title>Costos por produccion</title> 
    	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
    	<meta http-equiv="expires" content="0">
    	<?php include('../def/jquery.library_maestro.php');?>
    	<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
    	<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.soliprog.js"></script>
    	<script type="text/javascript">
    		$(function(){
    			// setter
    			$( "#solprofecest" ).datepicker( "option", "minDate", "<?php echo $pedvenfecrec; ?>");

    			$('#aceptarcost').button({ icons: { primary: "ui-icon-circle-check" } }).click(function() {

    				document.form1.action = 'maestablcostosproduccion.php?codigo=2308';
					document.form1.submit();
    			});
    		});
    	</script>
  </head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Costos por produccion</font></p> 
			<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content">
        		<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
							<tr class="ui-widget-header">
								<td width="50%" class="cont-title">&nbsp;Periodo de obervacion: desde&nbsp;<?php echo $consulfecini ?>&nbsp;hasta&nbsp;<?php echo $consulfecfin ?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td>
									<div>
									<?php 

										for($i = 0; $i < $nrGestionsoliprog; $i++) { 
										
										$rwGestionsoliporg = fncfetch($srGestionsoliprog,$i);

										//regriso de vistasoliprog
										$solprocodigo = $rwGestionsoliporg['solprocodigo'];
										$estsolcodigo = $rwGestionsoliporg['estsolcodigo']; 
										$usuacodigo   = $rwGestionsoliporg['usuacodi']; 
										$produccodigo = $rwGestionsoliporg['produccodigo'];
										$produccoduno = $rwGestionsoliporg['produccoduno'];
										$producnombre = $rwGestionsoliporg['producnombre'];
										$ordcomcodcli = $rwGestionsoliporg['ordcomcodcli'];
										$ordcomrazsoc = $rwGestionsoliporg['ordcomrazsoc'];
										$tipevecodigo = $rwGestionsoliporg['tipevecodigo'];
										$pedvennumero = $rwGestionsoliporg['pedvennumero'];
										$solprofecha  = $rwGestionsoliporg['solprofecha']; 
										$solprohora   = $rwGestionsoliporg['solprohora']; 
										$plantacodigo = $rwGestionsoliporg['plantacodigo'];
										$pedvenfecrec = $rwGestionsoliporg['pedvenfecrec'];
										$pedvenfecelb = $rwGestionsoliporg['pedvenfecelb'];
										$pedvenfecent = $rwGestionsoliporg['pedvenfecent'];
										$solprodocume = $rwGestionsoliporg['solprodocume'];
										$solprodosize = $rwGestionsoliporg['solprodosize'];
										$solprofecest = $rwGestionsoliporg['solprofecest'];
										$tipitecodigo = $rwGestionsoliporg['tipprocodigo'];
										$propedcansol = $rwGestionsoliporg['propedcansol'];
										$unidadcodigo = $rwGestionsoliporg['unidadcodigo'];

										include 'cargarconfsoliprog.php';

										include '../src/FunjQuery/jquery.tabs/gestionsoliprog/jquery.solicitud.cost.php';
										unset($rutaitempv);
									?>
									 </div>
									<?php if($arrProceso['tabs_solicitud']['ext'][0] > 0){?>
										<div id="tabs_extrusion">
											<?php include '../src/FunjQuery/jquery.tabs/gestionsoliprog/jquery.extrusion.cost.php'; ?>
										</div>
									<?php }?>
<!-- 	FIN EXTRUSION -->
<!-- 	FLEXOGRAFIA -->
									<?php if($arrProceso['tabs_solicitud']['flx'][0] > 0){?>
										<div id="tabs_flexografia">
											<?php include '../src/FunjQuery/jquery.tabs/gestionsoliprog/jquery.flexografia.cost.php'; ?>
										</div>
									<?php }?>
<!-- 	FIN FLEXOGRAFIA -->
<!-- 	LAMINADO -->
									<?php if($arrProceso['tabs_solicitud']['lmn'][0] > 0){?>
										<div id="tabs_laminado">
											<?php include '../src/FunjQuery/jquery.tabs/gestionsoliprog/jquery.laminado.cost.php'; ?>
										</div>
									<?php }?>
<!-- 	FIN LAMINADO -->
<!-- 	CORTE -->
									<?php if($arrProceso['tabs_solicitud']['cor'][0] > 0){?>
										<div id="tabs_corte">
											<?php include '../src/FunjQuery/jquery.tabs/gestionsoliprog/jquery.corte.cost.php'; ?>
										</div>
									<?php }?>
<!-- 	FIN CORTE -->
<!-- 	SELLADO -->
									<?php if($arrProceso['tabs_solicitud']['sld'][0] > 0){?>
										<div id="tabs_sellado">
											<?php include '../src/FunjQuery/jquery.tabs/gestionsoliprog/jquery.sellado.cost.php'; ?>
										</div>
									<?php }?>
<!-- 	FIN SELLADO -->
<!-- 	PAUCHADO -->
									<?php if($arrProceso['tabs_solicitud']['pch'][0] > 0){?>
										<div id="tabs_pauchado">
											<?php include '../src/FunjQuery/jquery.tabs/gestionsoliprog/jquery.pauchado.cost.php'; ?>
										</div>
									<?php }?>
<!-- 	FIN PAUCHADO -->
<!-- 	DOBLADO -->
									<?php if($arrProceso['tabs_solicitud']['dbl'][0] > 0){?>
										<div id="tabs_doblado">
											<?php include '../src/FunjQuery/jquery.tabs/gestionsoliprog/jquery.doblado.cost.php'; ?>
										</div>
									<?php }?>
<!-- 	FIN DOBLADO -->
<!-- 	MICROPERFORADO -->
									<?php if($arrProceso['tabs_solicitud']['mcr'][0] > 0){?>
										<div id="tabs_microperforado">
											<?php include '../src/FunjQuery/jquery.tabs/gestionsoliprog/jquery.microperforado.cost.php'; ?>
										</div>
									<?php }?>
<!-- 	FIN MICROPERFORADO -->
<!-- 	TROQUELADO -->
									<?php if($arrProceso['tabs_solicitud']['tql'][0] > 0){?>
										<div id="tabs_troquelado">
											<?php include '../src/FunjQuery/jquery.tabs/gestionsoliprog/jquery.troquelado.cost.php'; ?>
										</div>
									<?php }?>
<!-- 	FIN TROQUELADO -->
<!-- 	VALVULADO -->
									<?php if($arrProceso['tabs_solicitud']['vlv'][0] > 0){?>
										<div id="tabs_valvulado">
											<?php include '../src/FunjQuery/jquery.tabs/gestionsoliprog/jquery.valvulado.cost.php'; ?>
										</div>
									<?php }?>
<!-- 	FIN VALVULADO -->	
							<?php }?>
								</td>
							</tr>
						</table>
						<table width="50%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Total costos materia prima</td>
								<td width="30%" class="NoiseDataTD">&nbsp;<?php echo number_format($costosMateriaprima, 2, ',', '.'); ?></td>
							</tr>	
						</table>	
					</td>
				</tr>
    			<tr><td>&nbsp;</td></tr>
    			<tr>
					<td class="NoiseErrorDataTD" align="center"><div class="ui-buttonset">
						<button id="aceptarcost">Aceptar</button>&nbsp;&nbsp;&nbsp;&nbsp;
					</div></td>
				</tr>
				<tr><td>&nbsp;</td></tr>
     		</table> 
<!-- FIN VARIABLES UTILIZADAS PARA LA SOLICITUD DE PROGRAMACION Y SUS ORDENES DE PRODUCCION -->
   		</form> 
   		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
   		<div id="msgwindowform" title="Adsum Kallpa[Gestion MP]"><span id="msgform"></span></div>
 	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>