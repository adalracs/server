<?php
ob_start();
	include ( '../src/FunPerPriNiv/pktblreporteoppreportepn.php');
	include ( '../src/FunPerPriNiv/pktblvistabandejacorte.php');
	include ( '../src/FunPerPriNiv/pktblprogramacorte.php');
	include ( '../src/FunPerPriNiv/pktblplaneapadreitem.php');
	include ( '../src/FunPerPriNiv/pktblplaneaitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblsoliprogestado.php');
	include ( '../src/FunPerPriNiv/pktblopcorte.php');
	include ( '../src/FunPerPriNiv/pktbloppajustepn.php');
	include ( '../src/FunPerPriNiv/pktblajustepn.php');
	include ( '../src/FunPerPriNiv/pktblvelocidadpn.php');
	include ( '../src/FunPerPriNiv/pktbloppvelocidadpn.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunGen/fncnumprox.php');
	include ( '../src/FunGen/cargainput.php');
	include ( '../src/FunGen/fncnumact.php');
	include ( '../src/FunGen/floadtimehours.php');
	include ( '../src/FunGen/floadtimeminut.php');
	include ( '../src/FunPerSecNiv/fncsqlrun.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblop.php');
	include ( '../src/FunPerPriNiv/pktblopp.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktblpadreitem.php');
	include ( '../src/FunPerPriNiv/pktblitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblreporteopp.php');
	
	
	//evento para el array de maquinas para programa de corte
	//conexion
	$idcon = fncconn();
	$rs_equipo = fullscanprogramacortedisctequipo($idcon);
	//se cuenta el numero de resgistro de la consulta
	$nr_equipo = fncnumreg($rs_equipo);unset($arrequipo);
	//se recorre la consulta 	
	for($a = 0;$a < $nr_equipo;$a++)
	{
		//se extrae un de la consulta respecto a su indice
		$rw_equipo = fncfetch($rs_equipo,$a);
		//se crea el array de equipos para ser explosionado
		if($rw_equipo['equipocodigo'])
			$arrequipo = ($arrequipo)? $arrequipo = $arrequipo.','.$rw_equipo['equipocodigo'] : $arrequipo = $rw_equipo['equipocodigo'];
	}
ob_end_flush();
?>
<html>
	<head>
		<title>Bandeja de solicitudes corte</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunGen/starPage_position.js"></script>		
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.ui.ajax_accionextras.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_bandejacor.js"></script>
	</head>
	<?php if(!$codigo){echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<div style="height: 450px;">
				<?php $noAjax = true;include 'detallaprogramacorte.php'; ?>
			</div>
			<table width="100%" align="center" cellpadding="1" cellspacing="1">				
				<tr>
					<td class="ui-state-default">&nbsp;<a onClick="return verocultar('filresbandejaop',1);" href="javascript:animatedcollapse.toggle('filresbandejaop');"><img id="row1" align="middle" align="top"  src="temas/Noise/AscOn.gif" border="0">&nbsp;Filtro Resumen de bandeja.</a>
						<div id="filresbandejaop" style="padding: 2px 2px 2px 2px; display:none;" >
							<table width="96%" border="0" cellspacing="1" cellpadding="0" align="center">
								<?php 
									//se valida y explosiona el array de equipos => arrequipo
									if($arrequipo)
									{
										$arrObject = explode(',',$arrequipo);
										//se recorre el array
										for($a = 0;$a < count($arrObject);$a++)
										{
											$equipo = $arrObject[$a];
											//objetos para el total por maquina
											$total_equipound = $equipo.'_und';
											$total_equipokgs = $equipo.'_kgs';
											$total_equipomts = $equipo.'_mts';
								?>
								<tr>
							  		<td class="ui-state-default">&nbsp;&nbsp;<?php echo cargaequiponombre($equipo,$idcon) ?>
										<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
											<tr>
												<td width="15%"  class="NoiseFooterTD">&nbsp;<b>Total Ordenes.</b></td>
												<td width="15%"  class="NoiseDataTD">&nbsp;<span id="total_und_lbl"><?php echo number_format($$total_equipound, 2, ',', '.') ?></span></td>
												<td width="15%"  class="NoiseFooterTD">&nbsp;<b>Total Kilogramos.</b></td>
												<td width="15%"  class="NoiseDataTD">&nbsp;<span id="total_kgs_lbl"><?php echo number_format($$total_equipokgs, 2, ',', '.') ?></span></td>
												<td width="15%"  class="NoiseFooterTD">&nbsp;<b>Total Metros.</b></td>
												<td width="25%"  class="NoiseDataTD">&nbsp;<span id="total_mts_lbl"><?php echo number_format($$total_equipomts, 2, ',', '.') ?></span></td>
											</tr>
										</table>
									</td>
								</tr>
								<?php 
										}
									}
									else
									{
								?>
								<tr>
							  		<td class="ui-state-default">
							  			<div class="ui-widget">
 											<div style="margin-top: 20px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all"> 
  												<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
  												<b>No se encontraron OPP.</b></p>
 											</div>
										</div>
							  		</td>
							  	</tr>
								<?php 
										}
								?>
							</table>
						</div>
					</td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><div class="ui-buttonset">
						<button id="editarprograma_cor">Editar programa</button>
					</div></td>
				</tr>
				<tr><td>&nbsp;</td></tr> 
			</table>
			<input type="hidden" name="accionnuevoopp" />
			<input type="hidden" name="arrop" id="arrop" value="<?php echo $arrop?>" />
			<input type="hidden" name="codigo" id="codigo" value="<?php echo $codigo; ?>" />
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
		<div id="msgwindowup" title="Adsum Kallpa"><span id="msg1"></span></div>
  	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>