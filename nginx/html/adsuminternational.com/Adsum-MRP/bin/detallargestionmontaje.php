<?php
	ini_set('display_errors',1);
	include ('../src/FunGen/sesion/fncvalses.php'); 
	include ('../src/FunPerSecNiv/fncsqlrun.php');
	include ('../src/FunPerPriNiv/pktblitemdesa.php');
	include ('../src/FunPerPriNiv/pktblusuario.php');
	include ('../src/FunPerPriNiv/pktblformulacion.php');
	include ('../src/FunPerPriNiv/pktblpadreitem.php');
	include ('../src/FunPerPriNiv/pktblproducpadreitem.php');
	include ('../src/FunPerPriNiv/pktblcampertippro.php');
	include ('../src/FunPerPriNiv/pktblcamperdesarr.php');
	include ('../src/FunPerPriNiv/pktblcamperplanea.php');
	include ('../src/FunPerPriNiv/pktblcpplandetope.php');
	include ('../src/FunPerPriNiv/pktblcpdesadetope.php');
	include ('../src/FunPerPriNiv/pktblcptpdetope.php');
	include ('../src/FunPerPriNiv/pktblproducpedido.php');
	include ('../src/FunPerPriNiv/pktblpedidoventa.php');
	include ('../src/FunPerPriNiv/pktblplaneaitemdesa.php');
	include ('../src/FunPerPriNiv/pktblordencompra.php');
	include ('../src/FunPerPriNiv/pktblequipo.php');
	include ('../src/FunPerPriNiv/pktblformula.php');
	include ('../src/FunPerPriNiv/pktblproducformula.php');
	include( '../src/FunPerPriNiv/pktblcpdispdetope.php'); 
	include( '../src/FunPerPriNiv/pktblcamperdispen.php'); 
	include( '../src/FunPerPriNiv/pktblplanearutaitempv.php'); 
	include( '../src/FunPerPriNiv/pktblprocedimiento.php'); 
	include( '../src/FunPerPriNiv/pktblop.php'); 
	include( '../src/FunPerPriNiv/pktblvistaopp.php'); 
	include( '../src/FunPerPriNiv/pktblopextrusion.php'); 
	include ( '../src/FunPerPriNiv/pktblgestionmontaje.php');
	include ( '../src/FunPerPriNiv/pktblgestionmontajeformula.php');
	include ( '../src/FunPerPriNiv/pktblgestionartepr.php');
	include ( '../src/FunPerPriNiv/pktblgestionarteprformula.php');
	include ('../src/FunGen/cargainput.php');
		
	if(!$flagdetallargestionmontaje)
	{
		$idcon = fncconn();
		$nombre = cargausuanombre($usuacodi, $idcon);
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton);

		$idcon = fncconn();

		if (!$sbreg)
		{
			$ordoppcodigo = str_replace('|n', '', $ordoppcodigo);
			$sbreg= loadrecordvistaopp($ordoppcodigo,$idcon);
			$rwOrdenp = loadrecordop1($ordoppcodigo,$idcon);
			$flagvalidacionreporteopp = 1;
		}else{
			$ordoppcodigo = $sbreg['ordoppcodigo'];
		}

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
		//para asi traer para los colores de el dispensing
		$rsProducformula = dinamicscanproducformula(array("produccodigo" =>$produccodigo), $idcon);
		//consultamos el numero de registros que devuleve la consulta
		$nrProducformula = fncnumreg($rsProducformula);
		//se borra para evitar duplucidad en la informacion
		unset($arrdispensing);
		//escaniamos de acuerdo a la contidad de registro y asignamos los valores a array de dispensing $arrdispensing
		for($a = 0; $a < $nrProducformula; $a++)
		{
			$rwProducformula = fncfetch($rsProducformula, $a);
			$rwItem = loadrecordformula($rwProducformula['formulcodigo'],$idcon);
			//creamos el registro encadenado separado por el comidin ':-:' 
			$newRow = $rwProducformula['proforindice'].':-:'.$rwProducformula['formulcodigo'].':-:'.$rwProducformula['proforanilox'].':-:'.$rwProducformula['proforgrupo'];
			//si se encadena registro por registro por otro separador adicional con el comodin ':|:'
			($arrdispensing) ? $arrdispensing .= ':|:'.$newRow : $arrdispensing = $newRow;
		}
		$producto = $produccodigo;
		include 'cargarcampertippro.php';
		$producto = $produccodigo;
		include 'cargarcamperplanea.php';
		
		$rwUgestionartepr = loadrecordultimagestionarteprformula($ordoppcodigo,$idcon);
		$rwgestionartepr = loadrecordgestionartepr($rwUgestionartepr['gesartcodigo'],$idcon);
		$gesartfpista = $rwgestionartepr['gesartfpista'];
//		$gesartdescri = $rwgestionartepr['gesartdescri'];
		if($rwUgestionartepr['gesartcodigo'])
		{
			$rsGestionarteprformula = dinamicscangestionarteprformula(array('gesartcodigo' => $rwUgestionartepr['gesartcodigo']),$idcon);
			$nrGestionarteprformula = fncnumreg($rsGestionarteprformula);
		}
		
		for( $a = 0; $a < $nrGestionarteprformula; $a++)
		{
			$rwGestionarteprformula = fncfetch($rsGestionarteprformula,$a);
			$objCintasug = 'cintasug_'.$rwGestionarteprformula['formulcodigo'];
			$$objCintasug = $rwGestionarteprformula['gearfoscinta'];
		}
		
		
		$rwUgestionmontaje = loadrecordultimagestionmontajeformula($ordoppcodigo,$idcon);
		$rwgestionmontaje = loadrecordgestionmontaje($rwUgestionmontaje['gesmoncodigo'],$idcon);
		$gesmondescri = $rwgestionmontaje['gesmondescri'];
		if($rwgestionmontaje['gesmoncodigo'])
		{
			$rsGestionmontajeformula = dinamicscangestionmontajeformula(array('gesmoncodigo' => $rwgestionmontaje['gesmoncodigo']),$idcon);
			$nrGestionmontajeformula = fncnumreg($rsGestionmontajeformula);
		}
		
		for( $a = 0; $a < $nrGestionmontajeformula; $a++)
		{
			$rwGestionmontajeformula = fncfetch($rsGestionmontajeformula,$a);
			$objCintaimp = 'cintaimp_'.$rwGestionmontajeformula['formulcodigo'];
			$objNovedades = 'novedades_'.$rwGestionmontajeformula['formulcodigo'];
			$$objCintaimp = $rwGestionmontajeformula['gemofoicinta'];
			$$objNovedades = $rwGestionmontajeformula['gemofodescri'];
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
								<td width="50%" class="cont-title">&nbsp;Orden de produccion programada {OPP} No.&nbsp;{<?php echo $ordoppcodigo; ?>}</td>
								<td width="50%" class="cont-title">&nbsp;Fecha.&nbsp;<?php echo $ordprofecgen ?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
							<tr class="ui-state-default">
								<td class="cont-title">&nbsp;Datos de la OPP</td>
							</tr>
						</table>
						<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
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
								<td width="20%" class="NoiseFooterTD">&nbsp;Codigo de barras</td>
								<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo ($cod_barras)? strtoupper($cod_barras) : '---' ; ?></td>
							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Continuo</td>
								<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($continuo)? strtoupper($continuo) : '---' ;  ?>&nbsp;</td>
								<td width="20%" class="NoiseFooterTD">&nbsp;Rodillo</td>
								<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($rodillo)? strtoupper($rodillo) : '---' ;  ?>&nbsp;<b>mm</b>&nbsp;</td>
							</tr>
							<tr>
								<td width="	20%" class="NoiseFooterTD">&nbsp;No pistas</td>
								<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($nropistas)? strtoupper($nropistas) : '---' ;  ?>&nbsp;</td>
								<td width="	20%" class="NoiseFooterTD">&nbsp;Pistas fotopolimeros</td>
								<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($gesartfpista)? $gesartfpista : '---' ;?>&nbsp;</td>
							</tr>
							<tr><td colspan="4" class="NoiseFooterTD">&nbsp;Aclaraci&oacute;n</td></tr>
							<tr>
  								<td colspan="4" rowspan="3" class="NoiseDataTD"><?php echo $gesartdescri; ?></td>
 							</tr>
		  				</table>  		
	  				</td>  
	  			</tr>	
				<tr><td class="ui-state-default">&nbsp;<small>Colores</small></td></tr>
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
  							<tr>
  								<td>
  									<div id="filtrlistacolores">
  										<?php 
  											$noAjax = true;
  											$flagdetallar = 1;
	  										include '../src/FunjQuery/jquery.visors/jquery.montaje.php'; 
  										?>
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
			<input type="hidden" name="flagdetallargestionmontaje" value="1">
			<input type="hidden" name="acciondetallargestionmontaje">
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
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
	</body> 
<?php if (! $codigo) echo " -->"; ?> 
</html>