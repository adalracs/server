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
	include ('../src/FunPerPriNiv/pktblsaldos.php');
	include ('../src/FunGen/sesion/fncvalses.php'); 
	include ('../src/FunPerPriNiv/pktblusuario.php');
	include ('../src/FunPerPriNiv/pktblitemdesa.php');
	include ('../src/FunPerPriNiv/pktblopestado.php');
	include ('../src/FunPerPriNiv/pktblformulacion.php');
	include ( '../src/FunPerPriNiv/pktblgestionopp.php');
	include ('../src/FunPerPriNiv/pktbloppitemdesa.php');
	include ('../src/FunPerPriNiv/pktblprocedimiento.php');
	include ('../src/FunPerPriNiv/pktblplanearutaitempv.php');	
	include ( '../src/FunPerPriNiv/pktblgestionoppsaldos.php');
	include ( '../src/FunPerPriNiv/pktblgestionoppreporte.php');
	include ( '../src/FunPerPriNiv/pktblgestionoppitemdesa.php');
	
	if($accionnuevoreportegestionopp) 
		include ( 'grabareportegestionopp.php');
		
		
	if(!$flagnuevoreportegestionopp)
	{
		$idcon = fncconn();
		$nombre = cargausuanombre($usuacodi, $idcon);
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg) 
			include( '../src/FunGen/fnccontfron.php');
		$idcon = fncconn();
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
		
		$gesoppdescri = 'Gestion de Entrega [OK]';
		
		if($tipsolcodigo != 1)
		{
			$rsOppitemdesa = dinamicscanoppitemdesa(array( 'ordoppcodigo' => $ordoppcodigo),$idcon);
			$nrOppitemdesa = fncnumreg($rsOppitemdesa);
			for( $a = 0; $a < $nrOppitemdesa; $a++)
			{
				$rwOppitemdesa = fncfetch($rsOppitemdesa,$a);;
				$arritem = ($arritem)? $arritem.':|:'.$rwOppitemdesa['itedescodigo'].':-:f' : $rwOppitemdesa['itedescodigo'].':-:f' ;
			}
		}
		
			
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
	$rwOpestado = loadrecordopestado($opestacodigo,$idcon);
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
<?php else:?>
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
<?php endif; ?>
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Nuevo registro</font></span></td></tr>        		
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
						<?php include '../src/FunjQuery/jquery.tabs/gestionopp/jquery.especificaciones.php'; ?>
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
								<td width="20%" class="NoiseFooterTD">&nbsp;Ruta Completa</td>
								<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo ($rutaitempv)? strtoupper($rutaitempv) : '---' ; ?></td>
							</tr>
						</table>
					</td>
				</tr>
				<?php if($tipsolcodigo != 1){?>
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
							<tr class="ui-state-default">
								<td class="cont-title">&nbsp;Datos de material</td>
							</tr>
						</table>
						<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
							<?php 
								$rsOppitemdesa = dinamicscanoppitemdesa(array( 'ordoppcodigo' => $ordoppcodigo ),$idcon);
								$nrOppitemdesa = fncnumreg($rsOppitemdesa);
								if(!$nrOppitemdesa)
								{
							?>
							<tr>
								<td>
									<div class="ui-widget">
				 						<div style="margin-top: 1px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all"> 
			  								<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
			  								<b>No se encontraron materiales asignados en OPP.</b></p>
			 							</div>
									</div>
								</td>
							</tr>
							<?php 
								}
								for( $a = 0; $a < $nrOppitemdesa; $a++)
								{
									$rwOppitemdesa = fncfetch($rsOppitemdesa,$a)
							?>
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Item.</td>
								<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo $rwOppitemdesa['itedescodigo']; ?></td>
							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Material.</td>
								<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo carganombitemdesa($rwOppitemdesa['itedescodigo'],$idcon); ?></td>
							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Kilogramos&nbsp;<b>(kgs)</b></td>
								<td width="30%" class="NoiseDataTD">&nbsp;<?php echo $rwOppitemdesa['oppitecantid'] ?></td>
								<td width="20%" class="NoiseFooterTD">&nbsp;Metros&nbsp;<b>(mts)</b></td>
								<td width="30%" class="NoiseDataTD">&nbsp;---</td>
							</tr>
							<?php
								} 
							?>
						</table>
					</td>
				</tr>
				<?php }?>
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
							<tr class="ui-state-default">
								<td class="cont-title">&nbsp;<a onClick="return verocultar('filgestionopp',1);" href="javascript:animatedcollapse.toggle('filgestionopp');"><img id="row1" align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0">Historial Gestiones</a></td>
							</tr>
						</table>
						<div id="filgestionopp" style="padding: 2px 2px 2px 2px; display:none;" >
							<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
								<?php 
									$rsGestionopp = dinamicscangestionopp(array( 'ordoppcodigo' => $ordoppcodigo, 'gesopptipo' => 1 ),$idcon);
									$nrGestionopp = fncnumreg($rsGestionopp);
									if(!$nrGestionopp)
									{
								?>
								<tr>
									<td>
										<div class="ui-widget">
					 						<div style="margin-top: 1px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all"> 
				  								<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
				  								<b>No se encontraron gestiones.</b></p>
				 							</div>
										</div>
									</td>
								</tr>
								<?php 
									}
									for( $a = 0; $a < $nrGestionopp; $a++)
									{
										$rwGestionopp = fncfetch($rsGestionopp,$a);
										$rsGestionoppitemdesa = dinamicscangestionoppitemdesa(array('gesoppcodigo' => $rwGestionopp['gesoppcodigo']),$idcon);
										$nrGestionoppitemdesa = fncnumreg($rsGestionoppitemdesa);
								?>				
								<tr>
									<td class="ui-state-default" width="3%">#</td>
									<td class="ui-state-default" width="27%">Usuario</td>
									<td class="ui-state-default" width="18%">Fecha / Hora</td>
									<td class="ui-state-default" width="52%">Motivo / Aclaraci&oacute;n</td>
								</tr>
								<tr>
									<td class="NoiseDataTD row-soliserv">&nbsp;<?php echo ($a + 1) ?></td>
									<td class="NoiseDataTD row-soliserv">&nbsp;<?php echo cargausuanombre($rwGestionopp['usuacodi'],$idcon); ?></td>
									<td class="NoiseDataTD row-soliserv">&nbsp;<?php echo $rwGestionopp['gesoppfecha'].' - '.$rwGestionopp['gesopphora']?></td>
									<td class="NoiseDataTD row-soliserv">&nbsp;<?php echo $rwGestionopp['gesoppdescri']; ?></td>
								</tr>								
								<?php 
										for( $b = 0; $b < $nrGestionoppitemdesa; $b++){
											$rwGestionoppitemdesa = fncfetch($rsGestionoppitemdesa,$b);
								?>
								<tr>
									<td class="NoiseDataTD row-soliserv">&nbsp;</td>
									<td colspan="3">
										<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
											<tr>
												<td class="NoiseDataTD row-soliserv" width="5%">&nbsp;</td>
												<td class="NoiseDataTD row-soliserv" width="65%">&nbsp;<b>Asignacion :</b>&nbsp;<?php echo carganombitemdesa1($rwGestionoppitemdesa['itedescodigo'],$idcon)?></td>
												<td class="NoiseDataTD row-soliserv" width="15%">&nbsp;<?php echo $rwGestionoppitemdesa['gesoppcantkg'];?>&nbsp;<b>(kgs)</b></td>
												<td class="NoiseDataTD row-soliserv" width="15%">&nbsp;<?php echo $rwGestionoppitemdesa['gesoppcantmt'];?>&nbsp;<b>(mts)</b></td>
											</tr>
										</table>
									</td>
								</tr>
								<?php 
										}
										
										$rsGestionoppsaldos = dinamicscangestionoppsaldos(array('gesoppcodigo' => $rwGestionopp['gesoppcodigo']),$idcon);
										$nrGestionoppsaldos = fncnumreg($rsGestionoppsaldos);
										
										for( $c = 0; $c < $nrGestionoppsaldos; $c++){
											$rwGestionoppsaldos = fncfetch($rsGestionoppsaldos,$c);
											$rwSaldos = loadrecordsaldos($rwGestionoppsaldos['saldoscodigo'],$idcon);
								?>
								<tr>
									<td class="NoiseDataTD row-soliserv">&nbsp;</td>
									<td colspan="3">
										<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
											<tr>
												<td class="NoiseDataTD row-soliserv" width="5%">&nbsp;</td>
												<td class="NoiseDataTD row-soliserv" width="65%">&nbsp;<b>Asignacion saldo :</b>&nbsp;<?php echo carganombitemdesa1($rwSaldos['itedescodigo'],$idcon)?></td>
												<td class="NoiseDataTD row-soliserv" width="15%">&nbsp;<?php echo $rwGestionoppsaldos['gesoppcantkg'];?>&nbsp;<b>(kgs)</b></td>
												<td class="NoiseDataTD row-soliserv" width="15%">&nbsp;<?php echo $rwGestionoppsaldos['gesoppcantmt'];?>&nbsp;<b>(mts)</b></td>
											</tr>
										</table>
									</td>
								</tr>
								<?php 
										}
									}
								?>
							</table>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
							<tr class="ui-state-default">
								<td class="cont-title">&nbsp;<a onClick="return verocultar('filgestionoppreporte',2);" href="javascript:animatedcollapse.toggle('filgestionoppreporte');"><img id="row2" align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0">Historial Reportes</a></td>
							</tr>
						</table>
						<div id="filgestionoppreporte" style="padding: 2px 2px 2px 2px; display:none;" >
							<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
								<?php 
									$rsGestionopp = dinamicscangestionopp(array( 'ordoppcodigo' => $ordoppcodigo, 'gesopptipo' => 2 ),$idcon);
									$nrGestionopp = fncnumreg($rsGestionopp);
									if(!$nrGestionopp)
									{
								?>
								<tr>
									<td>
										<div class="ui-widget">
					 						<div style="margin-top: 1px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all"> 
				  								<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
				  								<b>No se encontraron reportes.</b></p>
				 							</div>
										</div>
									</td>
								</tr>
								<?php 
									}
									for( $a = 0; $a < $nrGestionopp; $a++)
									{
										$rwGestionopp = fncfetch($rsGestionopp,$a);
										$rsGestionoppreporte = dinamicscangestionoppreporte(array('gesoppcodigo' => $rwGestionopp['gesoppcodigo']),$idcon);
										$nrGestionoppreporte = fncnumreg($rsGestionoppreporte);
								?>				
								<tr>
									<td class="ui-state-default" width="3%">#</td>
									<td class="ui-state-default" width="27%">Usuario</td>
									<td class="ui-state-default" width="18%">Fecha / Hora</td>
									<td class="ui-state-default" width="52%">Motivo / Aclaraci&oacute;n</td>
								</tr>
								<tr>
									<td class="NoiseDataTD row-soliserv">&nbsp;<?php echo ($a + 1) ?></td>
									<td class="NoiseDataTD row-soliserv">&nbsp;<?php echo cargausuanombre($rwGestionopp['usuacodi'],$idcon); ?></td>
									<td class="NoiseDataTD row-soliserv">&nbsp;<?php echo $rwGestionopp['gesoppfecha'].' - '.$rwGestionopp['gesopphora']?></td>
									<td class="NoiseDataTD row-soliserv">&nbsp;<?php echo $rwGestionopp['gesoppdescri']; ?></td>
								</tr>	
									<?php 
										for( $b = 0; $b < $nrGestionoppreporte; $b++){
											$rwGestionoppreporte = fncfetch($rsGestionoppreporte,$b);
								?>
								<tr>
									<td class="NoiseDataTD row-soliserv">&nbsp;</td>
									<td colspan="3">
										<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
											<tr>
												<td class="NoiseDataTD row-soliserv" width="5%">&nbsp;</td>
												<td class="NoiseDataTD row-soliserv" width="65%">&nbsp;<b>Entrega :</b>&nbsp;<?php echo carganombitemdesa1($rwGestionoppreporte['itedescodigo'],$idcon)?></td>
												<td class="NoiseDataTD row-soliserv" width="15%">&nbsp;<?php echo $rwGestionoppreporte['gesoppcantkg'];?>&nbsp;<b>(kgs)</b></td>
												<td class="NoiseDataTD row-soliserv" width="15%">&nbsp;<?php echo $rwGestionoppreporte['gesoppcantmt'];?>&nbsp;<b>(mts)</b></td>
											</tr>
										</table>
									</td>
								</tr>
								<?php 
										}
									}
								?>
							</table>
						</div>
					</td>
				</tr>
			<?php if($rwOpestado['opestatipo'] == 3 || $rwOpestado['opestatipo'] == 4):?>
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
							<tr class="ui-state-default">
								<td class="cont-title">&nbsp;Gestion opp</td>
							</tr>
						</table>
						<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["opestacodigo"] == 1){ $gesoppdescri = null;echo "*";}?>&nbsp;Estado</td>
								<td colspan="3" class="NoiseDataTD">
									<select name="opestacodigo1" id="opestacodigo1">
										<option value="">--Seleccione--</option>
										<?php 
											include '../src/FunGen/floadopestado.php';	
											floadopestadoreporte($opestacodigo1,$idcon);
										?>
									</select>
								</td>
							</tr>
							<tr><td colspan="4" class="NoiseFooterTD"><?php if($campnomb["gesoppdescri"] == 1){ $gesoppdescri = null;echo "*";}?>&nbsp;Aclaraci&oacute;n</td></tr>
							<tr>
  								<td colspan="4" rowspan="3"><textarea name="gesoppdescri" cols="90" rows="3"><?php echo $gesoppdescri; ?></textarea></td>
 							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
							<tr class="ui-state-default">
								<td class="cont-title">&nbsp;Reporte de opp</td>
							</tr>
						</table>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Material.</td>
								<td width="30%" class="NoiseDataTD">&nbsp;
									<select name="idmaterial" id="idmaterial">
										<option value="">--Seleccione--</option>
											<?php 
									  			include ('../src/FunGen/floadgestionopp.php');
									  			floadgestioopp_reporte($ordoppcodigo,$idcon);
										  	?>
									</select>
								</td>
								<td width="50%" class="NoiseDataTD" align="center">
									<div class="ui-buttonset-fe">
										<button id="ingresarbobina">Agregar item</button>
										<button id="quitarbobina">Quitar item</button>
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="3" class="NoiseDataTD">
									<div id="listadobobinas">
										<?php
											$noAjax = true;
											include '../src/FunjQuery/jquery.visors/jquery.reporteopp.php';
										?>
									</div>
									<input type="hidden" name="arrbobina" id="arrbobina" value="<?php echo $arrbobina ?>" />
									<input type="hidden" name="arrbobinatmp" id="arrbobinatmp" value="<?php echo $arrbobinatmp ?>" />
								</td>
							</tr>
						</table>
					</td>
				</tr>
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
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
	</body> 
<?php if (! $codigo) echo " -->"; ?> 
</html>