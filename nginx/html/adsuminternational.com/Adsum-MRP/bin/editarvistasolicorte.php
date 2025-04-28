<?php 
ob_start();
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
	include ( '../src/FunPerPriNiv/pktblplaneaitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblplaneapadreitem.php');
	include ( '../src/FunPerPriNiv/pktblformulacion.php');
	include ( '../src/FunGen/cargainput.php');
	
	if($accioneditarvistasolicorte) 
		include ( 'editavistasolicorte.php');

ob_end_flush();

	if(!$flageditarvistasolicorte)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');
		//regriso de vistasolicorte
		$idcon = fncconn();
		$solprocodigo = $sbreg['solprocodigo'];
		$estsolcodigo = $sbreg['estsolcodigo']; 
		$usuacodigo = $sbreg['usuacodi']; 
		$produccodigo = $sbreg['produccodigo'];
		$produccoduno = $sbreg['produccoduno'];
		$tipevecodigo = $sbreg['tipevecodigo'];
		$pedvennumero = $sbreg['pedvennumero'];
		$solprofecha = $sbreg['solprofecha']; 
		$solprohora = $sbreg['solprohora']; 
		$plantacodigo = $sbreg['plantacodigo'];
		$procedcodigo = $sbreg['procedcodigo'];  
		$procednombre = $sbreg['procednombre'];  
		$plarutcodigo = $sbreg['plarutcodigo']; 
		$producto = $produccodigo;		
		include 'cargarcampertippro.php';
		$producto = $produccodigo;
		include 'cargarcamperdesarr.php';
		$producto = $produccodigo;
		include 'cargarcamperplanea.php';
		fncconn($idcon);
	}
	$idcon = fncconn();
	//escaneo a la tabla planeapadreitem
	$nr_op = 0;	
	$rsPlaneapadreitem = dinamicscanplaneapadreitem(array("produccodigo" => $produccodigo),$idcon);
	//consulta numero de materiales 
	$nrPlaneapadreitem = fncnumreg($rsPlaneapadreitem);
	unset($obj_estructura);
	//recorre consulta
	for($i=0;$i<$nrPlaneapadreitem;$i++)
	{
		//trae registo de padre item dependiendo de su indice
		$rwPlaneapadreitem = fncfetch($rsPlaneapadreitem,$i);
		$rwpadreitem = loadrecordpadreitem($rwPlaneapadreitem['paditecodigo'],$idcon);
		//objetos a usar
		if($rwpadreitem['paditeconfig'] == '0')
		{
			$obj_estructura = ($obj_estructura)? $obj_estructura.' / '.$rwpadreitem['paditenombre'] : $rwpadreitem['paditenombre'] ;
			//variables a usar 
			$obj_calibre = 'calibre_'.$nr_op;
			$obj_cant_kg = 'cant_kg_'.$nr_op;
			$obj_cant_mt = 'cant_mt_'.$nr_op;
			$obj_ancho = 'ancho_'.$nr_op;
			//valor de las variables
			$$obj_desempeno = $rwPlaneapadreitem['plapaddesem'];
			$$obj_tipo = $rwPlaneapadreitem['plapadtipo'];
			$$obj_calibre = $rwPlaneapadreitem['plapadcalib'];
			$$obj_cant_kg = $rwPlaneapadreitem['plapadcantkg'];
			$$obj_cant_mt = $rwPlaneapadreitem['plapadcantmt'];
			$$obj_ancho = $rwPlaneapadreitem['plapadanchoi'];
		}
	}
	$nr_op = 1;	
?> 

<html> 
	<head> 
    	<title>Editar registro de solicitud de programacion de corte</title> 
    	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
    	<meta http-equiv="expires" content="0">
    	<?php include('../def/jquery.library_maestro.php');?>
    	<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
  </head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Solicitud de programacion corte</font></p> 
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
        		<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Editar registro</font></span></td></tr>
        		<tr>
					<td>
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
							<tr class="ui-widget-header">
								<td width="50%" class="cont-title">&nbsp;Solicitud de programacion corte No.&nbsp;{<?php echo $solprocodigo; ?>}</td>
								<td width="50%" class="cont-title">&nbsp;Fecha.&nbsp;<?php echo $solprofecha ?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center"  class="ui-widget-content">
							<tr class="ui-state-default"><td class="cont-title">&nbsp;Datos de la solicitud</td></tr>
						</table>
						<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
							<tr>
								<td class="NoiseFooterTD" width="15%">&nbsp;Ubicaci&oacute;n</td>
								<td class="NoiseDataTD"><?php echo cargaplantanombre($plantacodigo, $idcon); ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Proceso</td>
								<td class="NoiseDataTD"><?php echo strtoupper($procednombre) ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;PV</td>
								<td class="NoiseDataTD"><?php echo  $pedvennumero ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Item</td>
								<td class="NoiseDataTD"><?php echo  $produccoduno ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Solicitante</td>
								<td class="NoiseDataTD"><?php echo cargausuanombre($usuacodigo, $idcon); ?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center"  class="ui-widget-content">
							<tr class="ui-state-default"><td class="cont-title">&nbsp;Informacion de corte </td></tr>
						</table>	
						<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
							<tr>
								<td class="NoiseFooterTD" width="15%">&nbsp;Tipo estructura</td>
								<td class="NoiseDataTD"><?php echo strtoupper($tipo_estruc); ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD" width="15%">&nbsp;Estructura</td>
								<td class="NoiseDataTD"><?php echo strtoupper($obj_estructura); ?></td>
							</tr>
						</table>
						<?php 
							for($a = 0;$a < $nr_op;$a++){
								//variables a usar 
								$obj_calibre = 'calibre_'.$a;
								$obj_cant_kg = 'cant_kg_'.$a;
								$obj_cant_mt = 'cant_mt_'.$a;
								$obj_ancho = 'ancho_'.$a;
						?>					
						<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
							<tr>
								<td class="NoiseFooterTD" width="15%">&nbsp;Calibre&nbsp;</td>
								<td class="NoiseDataTD"><?php echo $$obj_calibre ?><b>&micro;m</b></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD" width="15%">&nbsp;Ancho&nbsp;</td>
								<td class="NoiseDataTD"><?php echo number_format($$obj_ancho, 2, ',', '.') ?><b>mm</b></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Cantidad</td>
								<td class="NoiseDataTD"><?php echo  number_format($$obj_cant_kg, 2, ',', '.') ?>&nbsp;<b>kgs</b>&nbsp;-&nbsp;<?php echo  number_format($$obj_cant_mt, 2, ',', '.') ?>&nbsp;<b>mts</b></td>
							</tr>
						</table>
						<?php }?>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td colspan="3" class="ui-state-default">&nbsp;Observaciones </td>
							</tr>
						</table>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td>
									<textarea name="solprodescri" cols="92" rows="3"><?php echo $solprodescri; ?></textarea>
								</td>
							</tr>
						</table>
					</td>
				</tr>
    			<tr><td>&nbsp;</td></tr>
    			<tr>
					<td class="NoiseErrorDataTD" align="center"><div class="ui-buttonset">
						<button id="aceptar">Aceptar</button>&nbsp;&nbsp;&nbsp;&nbsp;
						<button id="cancelar">Cancelar</button>
					</div></td>
				</tr>
				<tr><td>&nbsp;</td></tr>
     		</table> 
     		<input type="hidden" name="accionnuevosoliot">
     		<input type="hidden" name="accioneditarvistasolicorte">
   			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="editar">
     		<input type="hidden" name="solprocodigo" value="<?php echo $solprocodigo; ?>"> 
     		<input type="hidden" name="estsolcodigo" value="<?php echo $estsolcodigo; ?>"> 
     		<input type="hidden" name="produccodigo" value="<?php echo $produccodigo; ?>"> 
     		<input type="hidden" name="produccoduno" value="<?php echo $produccoduno; ?>"> 
     		<input type="hidden" name="tipevecodigo" value="<?php echo $tipevecodigo; ?>">
     		<input type="hidden" name="pedvennumero" value="<?php echo $pedvennumero; ?>">
     		<input type="hidden" name="solprofecha" value="<?php echo $solprofecha; ?>">
     		<input type="hidden" name="solprohora" value="<?php echo $solprohora; ?>">
     		<input type="hidden" name="plantacodigo" value="<?php echo $plantacodigo; ?>">
     		<input type="hidden" name="procedcodigo" value="<?php echo $procedcodigo; ?>">
     		<input type="hidden" name="procednombre" value="<?php echo $procednombre; ?>">
     		<input type="hidden" name="plarutcodigo" value="<?php echo $plarutcodigo; ?>">
     		<input type="hidden" name="usuacodigo" value="<?php echo $usuacodigo; ?>">
     		<input type="hidden" name="nropistas" value="<?php echo $nropistas; ?>">
     		<input type="hidden" name="tipo_estruc" value="<?php echo $tipo_estruc; ?>">
     		<input type="hidden" name="ancho" value="<?php echo $ancho; ?>">
     		<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
   		</form> 
   		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
   		<div id="msgwindowform" title="Adsum Kallpa[Gestion MP]"><span id="msgform"></span></div>
 	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>