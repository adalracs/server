<?php 
ob_start();
	include ( '../src/FunGen/sesion/fnccantrow.php');
	include ( '../src/FunGen/sesion/fnccantrow1.php');
	include ( '../src/FunGen/sesion/fnccantrownew.php');
	include ( '../src/FunPerPriNiv/limitscan.php');
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblot.php');
	include ( '../src/FunPerPriNiv/pktblvistarepcierre.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblusuariotareot.php');
	include ( '../src/FunPerPriNiv/pktbltareot.php');
	include ( '../src/FunPerPriNiv/pktblreportot.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktbltipomant.php');
	include ( '../src/FunGen/sesion/fncalmdat.php');
	include ( '../src/FunGen/sesion/fnccaf.php');
	include ( '../src/FunPerPriNiv/limitscanvistas.php');

	$reccomact =  fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]);

	if($accionborrarreportot)
		include ( 'borrareportot.php');
	else
	{
		if($accionconsultarreportot)
		{
			$nusw = 0;
			$nombcamp = strtok ($columnas,",");
			while ($nombcamp)
			{
				$nombcamp = trim($nombcamp);
				$recarreglo[$nombcamp] = $$nombcamp;
				if($recarreglo[$nombcamp]){ $nusw =1;}
				$nombcamp = strtok(",");
			}
			
			if(!$nusw)
				$accionconsultarreportot = 0;
		}
		if(!$recarreglo)
		{
			unset($recarreglo);
			$recarreglo = $GLOBALS[usuaplanta][sistemcodigo];
		}
	}
	
	include ( '../src/FunGen/sesion/fncaumdec.php');
	include('../src/FunGen/fncpageposition.php');
	
	$intervalo = fncaumdec('vistarepcierre',$inicio,$fin,$mov,$accionconsultarreportot,$recarreglo);
	$cantrow = $intervalo[total];
	if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; }
ob_end_flush();
?> 
<html> 
	<head> 
		<title>Registros de reportes de ordenes de trabajo</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<script language="JavaScript" type="text/javascript" src="../src/FunGen/fncsetcheck.js"></script>
		<script language="javascript" type="text/javascript" src="../src/FunGen/fncremembercheck.js"></script>
		<script language=JavaScript src="../src/FunGen/starPage_position.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/colorfooter.js" type="text/javascript" ></script>
	
		<?php include('../def/jquery.library_maestro.php');?>
		<style type="text/css">
			.content-reg-row { font-size: 95%; }
		</style>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" class="NoisePageBODY"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Listado de ordenes de trabajo reportadas</font><br><br></p> 
			<table border="0" cellspacing="1" cellpadding="2" align="center" class="ui-widget-content" width="800">
				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablreportot.php',$flagcheck); ?></td></tr>
				<tr><td>&nbsp;</td></tr> 
  				<tr><td align="left" class="NoiseErrorDataTD"><?php include ('../def/jquery.maestablbuttons.php') ?></td></tr>
 				<tr><td>&nbsp;</td></tr>
 				<tr><td><?php include ('../def/jquery.button_navup.php') ?></td></tr>
 				<tr><td></td></tr>
		    	<tr><td></td></tr>
 				<tr> 
  					<td> 
  						<table width="100%" border="0" align="center" cellspacing="1" cellpadding="1" class="ui-widget-content"> 
							<tr> 
								<td width="4%" class="ui-state-default tbl-head-font">Sel.</td> 
								<td width="10%" class="ui-state-default tbl-head-font">Fecha Reporte</td> 
								<td width="8%" class="ui-state-default tbl-head-font">Num OT</td> 
								<td width="25%" class="ui-state-default tbl-head-font">Ubicaci&oacute;n</td> 
								<td width="25%" class="ui-state-default tbl-head-font">Equipo</td> 
								<td width="28%" class="ui-state-default tbl-head-font">Encargado</td> 
							</tr>
							<?php 
								include ( '../src/FunGen/sesion/fncvisregreportot.php');
								$reg[0] = 'reportcodigo';
								$reg1[0] = 'n';
								$nureturn = fncvisregreportot('vistarepcierre', $reg, $reg1, $idtrans, $arr_borrar, $flagcheck);
							?> 
   						</table> 
   					</td> 
  				</tr> 
  				<tr><td></td></tr>
		    	<tr><td></td></tr>
  				<tr><td><?php include ('../def/jquery.button_navdown.php') ?></td></tr> 
  				<tr><td>&nbsp;</td></tr>
  				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablreportot.php',$flagcheck); ?></td></tr> 				
 			</table>  
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
 			<input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
 			<input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>"> 
 			<input type="hidden" name="nombtabl" value="reportot"> 
 			<input type="hidden" name="sourcetable" value="reportot"> 
 			<input type="hidden" name="selstar" id="selstar" value="0">
			<input type="hidden" name="columnas" value="reportcodigo,
ordtracodigo,
tipmancodigo,
prioricodigo,
tiptracodigo,
tareacodigo,
reportfecha,
reporttiedur,
reportdescri,
plantacodigo,
sistemcodigo,
equipocodigo,
componcodigo,
ordtrafecini,
ordtrafecfin,
tipfalcodigo">
 			<input type="hidden" name="reportcodigo" value="<?php if($accionconsultarreportot) echo $reportcodigo; ?>"> 
 			<input type="hidden" name="ordtracodigo" value="<?php if($accionconsultarreportot) echo $ordtracodigo; ?>"> 
 			<input type="hidden" name="tipmancodigo" value="<?php if($accionconsultarreportot) echo $tipmancodigo; ?>"> 
 			<input type="hidden" name="prioricodigo" value="<?php if($accionconsultarreportot) echo $prioricodigo; ?>"> 
 			<input type="hidden" name="tiptracodigo" value="<?php if($accionconsultarreportot) echo $tiptracodigo; ?>"> 
 			<input type="hidden" name="tareacodigo" value="<?php if($accionconsultarreportot) echo $tareacodigo; ?>"> 
 			<input type="hidden" name="reportfecha" value="<?php if($accionconsultarreportot) echo $reportfecha; ?>"> 
 			<input type="hidden" name="reporttiedur" value="<?php if($accionconsultarreportot) echo $reporttiedur; ?>"> 
 			<input type="hidden" name="reportdescri" value="<?php if($accionconsultarreportot) echo $reportdescri; ?>"> 
 			<input type="hidden" name="plantacodigo" value="<?php if($accionconsultarreportot) echo $plantacodigo; ?>"> 
 			<input type="hidden" name="sistemcodigo" value="<?php if($accionconsultarreportot) echo $sistemcodigo; ?>"> 
 			<input type="hidden" name="equipocodigo" value="<?php if($accionconsultarreportot) echo $equipocodigo; ?>"> 
 			<input type="hidden" name="componcodigo" value="<?php if($accionconsultarreportot) echo $componcodigo; ?>"> 
 			<input type="hidden" name="ordtrafecini" value="<?php if($accionconsultarreportot) echo $ordtrafecini; ?>"> 
 			<input type="hidden" name="ordtrafecfin" value="<?php if($accionconsultarreportot) echo $ordtrafecfin; ?>"> 
 			<input type="hidden" name="tipfalcodigo" value="<?php if($accionconsultarreportot) echo $tipfalcodigo; ?>"> 
 			<input type="hidden" name="accionconsultarreportot" value="<?php echo $accionconsultarreportot; ?>">
 			<input type="hidden" name="mov"> 
 			<!-- Permite el cambio de checkbox/radiobuttion --> 
			<input type="hidden" name="flagcheck" value="<?php echo $flagcheck;?>">
			<!-- Campos a visualizar en maestablborrgen		-->
			<input type="hidden" name="selcampos" value="reportcodigo, reportdescri">
			<!--											-->
			<input type="hidden" name="arr_borrar" value="<?php echo $arr_borrar;?>">
			<input type="hidden" name="arreglo_b">
			<!--											-->
 		</form> 
 		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
 	</body> 
<?php if(!$codigo){ echo " -->"; } ?>
</html>