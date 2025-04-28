<?php 
	include ( '../src/FunGen/sesion/fnccantrow.php');
	include ( '../src/FunGen/sesion/fnccantrow1.php');
	include ( '../src/FunPerPriNiv/limitscan.php');
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktbltareot.php');
	include ( '../src/FunPerPriNiv/pktblvistamaxtareot.php');
	include ( '../src/FunPerPriNiv/pktblusuariotareot.php');
	include ( '../src/FunPerPriNiv/pktbltipomant.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblot.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblsistema.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');	
	include ( '../src/FunPerPriNiv/pktblotestado.php');
	include ( '../src/FunGen/sesion/fncalmdat.php');
	include ( '../src/FunGen/sesion/fnccaf.php');
	include ( '../src/FunPerPriNiv/limitscanvistas.php');
	$reccomact =  fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]);
	// --
	session_unregister("arrtransac");
	session_unregister("arrtransaccod");
	session_unregister("arrtransacherr");
	session_unregister("flagsoliot");
	session_unregister("arrtransacitem");
	session_unregister("arrtransaccoditem");
	session_unregister("arrtransacite");
	session_unregister("flagsoliotitem");
	session_unregister("arrtransactran");
	// --
	if($accionconsultartareot)
	{
		$recon = 1;
		$nusw = 0;
		$nombcamp = strtok ($columnas,",");
		
		while ($nombcamp)
		{
			$nombcamp = trim($nombcamp);
			if($nombcamp == 'usuacodigo')
				$recarreglo['usuacodi'] = $$nombcamp;
			else
				$recarreglo[$nombcamp] = $$nombcamp;
			if($recarreglo[$nombcamp] || $recarreglo['usuacodi']){ $nusw =1;}
			$nombcamp = strtok(",");
		}
		
		if(!$nusw)
			$accionconsultartareot = 0;
	}

	if($equipocodigocmbx && $filterindex && $recon)
	{
		$equipocodigo = $equipocodigocmbx;
		unset($plantacodigo, $sistemcodigo);
		$recarreglo['plantacodigo'] = $plantacodigo;
		$recarreglo['sistemcodigo'] = $sistemcodigo;
		$recarreglo['equipocodigo'] = $equipocodigocmbx;
		$accionconsultartareot = 1;
	}
	
//	$recarreglo[usuacodi] = $_POST[usuacodi];
	
	include ( '../src/FunGen/sesion/fncaumdec.php');
	include('../src/FunGen/fncpageposition.php');
	$intervalo = fncaumdec('vistamaxtareot',$inicio,$fin,$mov,$accionconsultartareot,$recarreglo);
  	$cantrow = $intervalo[total];
  	if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans];  }
?> 
<html> 
	<head> 
		<title>Registros de Gestion de Ordenes de trabajo</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<script language=JavaScript src="../src/FunGen/starPage_position.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/colorfooter.js" type="text/javascript" ></script>
		
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript">
			$(function(){
				$('#gestionar').button({ icons: { primary: "ui-icon-gear" } }).click(function() {
					if(document.form1.selstar.value == 1)
					{
						document.form1.action = 'ingrnuev' + document.form1.sourcetable.value + '.php';
						document.form1.submit();
					}
					else
					{
						document.getElementById('msg').innerHTML = 'Debe seleccionar un registro.'
						$('#msgwindow').dialog('open');
					}
					
					return false;
				});

				/**
				 * Boton Editar
				 */
				$('#editar1').button({ icons: { primary: "ui-icon-transferthick-e-w" } }).click(function() {
					if(document.form1.selstar.value == 1)
					{
						document.form1.action = 'editar' + document.form1.sourcetable.value + '.php';
						document.form1.submit();
					}
					else
					{
						document.getElementById('msg').innerHTML = 'Debe seleccionar un registro.'
						$('#msgwindow').dialog('open');
					}
					
					return false;
				});
			});
		</script>
		<style type="text/css">
			.content-reg-row { font-size: 95%; }
		</style>
	</head>
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" class="NoisePageBODY"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Listado de &oacute;rdenes de trabajo a gestionar</font></p> 
			<table border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content" width="90%"> 
 				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestabltareot.php',$flagcheck); ?></td></tr>
				<tr><td>&nbsp;</td></tr> 
  				<tr><td align="left" class="NoiseErrorDataTD">
  					<div class="ui-buttonset">
					<?php
						if($reccomact[nuevo] && !$flagcheck)
					  		echo '<button id="gestionar">Gestionar</button>&nbsp;&nbsp;';
					  	
					  	if($reccomact[consultar] && !$flagcheck)
					  		echo '<button id="consultar">Consulta</button>&nbsp;&nbsp;';
					  	
						if($reccomact[detallar] && !$flagcheck)
					   		echo '<button id="detallar">Ver detalle</button>&nbsp;&nbsp;';
					   	
					   	if($reccomact[modificar] && !$flagcheck)
					   		echo '<button id="editar1">Reasignar funcionario</button>&nbsp;&nbsp;';
					?>
					</div>
				</td></tr>
 				<tr><td>&nbsp;</td></tr>
 				<tr><td><?php include ('../def/jquery.button_navup.php') ?></td></tr>
 				<tr><td></td></tr>
		    	<tr><td></td></tr>
 				<tr> 
  					<td> 
  						<table width="100%" border="0" align="center" cellspacing="1" cellpadding="1" class="ui-widget-content"> 
							<tr> 
								<td width="4%" class="ui-state-default tbl-head-font">Sel.</td> 
								<td width="5%" class="ui-state-default tbl-head-font">Num OT</td> 
								<td width="15%" class="ui-state-default tbl-head-font">Ubicaci&oacute;n</td>
								<td width="15%" class="ui-state-default tbl-head-font">Proceso</td>
								<td width="20%" class="ui-state-default tbl-head-font">Equipo</td>
								<td width="15%" class="ui-state-default tbl-head-font">Encargado</td> 
								<td width="10%" class="ui-state-default tbl-head-font">Mantenimiento</td> 
								<td width="15%" class="ui-state-default tbl-head-font">Estado</td> 
							</tr>
							<?php 
								include ( '../src/FunGen/sesion/fncvisregvistamaxtareot.php');
								$reg[0] = 'ordtracodigo';
								$reg1[0] = 'n';
								$nureturn = fncvisregvistamaxtareot('vistamaxtareot',$reg,$reg1,$idtrans,$arr_borrar, $flagcheck);
							?> 
   						</table> 
   					</td> 
  				</tr> 
  				<tr><td></td></tr>
		    	<tr><td></td></tr>
  				<tr><td><?php include ('../def/jquery.button_navdown.php') ?></td></tr> 
  				<tr><td>&nbsp;</td></tr>
  				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestabltareot.php',$flagcheck); ?></td></tr> 				
 			</table> 
 			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
 			<input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
 			<input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>"> 
 			<input type="hidden" name="nombtabl" value="tareot">
 			<input type="hidden" name="sourcetable" value="tareot"> 
 			<input type="hidden" name="selstar" id="selstar" value="0">
			<input type="hidden" name="columnas" value="ordtracodigo,otestacodigo,plantacodigo,sistemcodigo,equipocodigo,componcodigo,tipmancodigo,tipfalcodigo,prioricodigo,tipfalcodigo,prioricodigo,ordtrafecini,ordtrafecfin,ordtrahorfin,usuacodigo,usuanombre,tiptracodigo,tareacodigo"> 
 			<input type="hidden" name="tareotcodigo" value="<?php if($accionconsultartareot) echo $tareotcodigo; ?>"> 
  			<input type="hidden" name="ordtracodigo" value="<?php if($accionconsultartareot) echo $ordtracodigo; ?>"> 
 			<input type="hidden" name="tareacodigo" value="<?php if($accionconsultartareot) echo $tareacodigo; ?>"> 
 			<input type="hidden" name="tiptracodigo" value="<?php if($accionconsultartareot) echo $tiptracodigo; ?>"> 
 			<input type="hidden" name="operaccodigo" value="<?php if($accionconsultartareot) echo $operaccodigo; ?>">
 			<input type="hidden" name="tareottiedur" value="<?php if($accionconsultartareot) echo $tareottiedur; ?>"> 
 			<input type="hidden" name="tareotnota" value="<?php if($accionconsultartareot) echo $tareotnota; ?>">
 			<input type="hidden" name="progracodigo" value="<?php if($accionconsultartareot) echo $progracodigo; ?>"> 
 			<input type="hidden" name="tareothorini" value="<?php if($accionconsultartareot) echo $tareothorini; ?>"> 
 			<input type="hidden" name="tareotfecini" value="<?php if($accionconsultartareot) echo $tareotfecini; ?>"> 
 			<input type="hidden" name="tareothorfin" value="<?php if($accionconsultartareot) echo $tareothorfin; ?>"> 
 			<input type="hidden" name="tareotfecfin" value="<?php if($accionconsultartareot) echo $tareotfecfin; ?>"> 
 			<input type="hidden" name="tareotsecuen" value="<?php if($accionconsultartareot) echo $tareotsecuen; ?>"> 
 			<input type="hidden" name="tareotfin" value="<?php if($accionconsultartareot) echo $tareotfin; ?>"> 
 			<input type="hidden" name="usuacodigo" value="<?php if($accionconsultartareot) echo $usuacodigo; ?>"> 
 			<input type="hidden" name="usuanombre" value="<?php if($accionconsultartareot) echo $usuanombre; ?>"> 
 			<input type="hidden" name="otestacodigo" value="<?php if($accionconsultartareot) echo $otestacodigo; ?>"> 
 			<input type="hidden" name="prioricodigo" value="<?php if($accionconsultartareot) echo $prioricodigo; ?>"> 
 			<input type="hidden" name="tipcumcodigo" value="<?php if($accionconsultartareot) echo $tipcumcodigo; ?>"> 
 			<input type="hidden" name="otestacodigo" value="<?php if($accionconsultartareot) echo $otestacodigo; ?>"> 
 			<input type="hidden" name="plantacodigo" value="<?php if($accionconsultartareot) echo $plantacodigo; ?>"> 
 			<input type="hidden" name="sistemcodigo" value="<?php if($accionconsultartareot) echo $sistemcodigo; ?>"> 
 			<input type="hidden" name="equipocodigo" value="<?php if($accionconsultartareot) echo $equipocodigo; ?>"> 
 			<input type="hidden" name="ordtrafecgen" value="<?php if($accionconsultartareot) echo $ordtrafecgen; ?>">
 			<input type="hidden" name="tipmancodigo" value="<?php if($accionconsultartareot) echo $tipmancodigo; ?>">
 			<input type="hidden" name="tipfalcodigo" value="<?php if($accionconsultartareot) echo $tipfalcodigo; ?>">
 			<input type="hidden" name="partecodigo" value="<?php if($accionconsultartareot) echo $partecodigo; ?>">
 			<input type="hidden" name="tiptracodigo" value="<?php if($accionconsultartareot) echo $tiptracodigo; ?>">
 			<input type="hidden" name="tareacodigo" value="<?php if($accionconsultartareot) echo $tareacodigo; ?>">
 			<input type="hidden" name="equiponombre" value="<?php if($accionconsultartareot) echo $equiponombre; ?>">
			<input type="hidden" name="equipocodigocmbx" value="<?php if($accionconsultartareot) echo $equipocodigocmbx; ?>">
			<input type="hidden" name="filterindex" value="<?php if($accionconsultartareot) echo $filterindex; ?>">
 			<input type="hidden" name="accionconsultartareot" value="<?php echo $accionconsultartareot ?>">
 			<input type="hidden" name="mov"> 
 			
 			<input type="hidden" name="flagcheck" value="<?php  echo $flagcheck;?>">
 		</form> 
 		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
 	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>