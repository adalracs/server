<?php 
ob_start();
	include ( '../src/FunGen/sesion/fnccantrow.php');
	include ( '../src/FunGen/sesion/fnccantrow1.php');
	include ( '../src/FunGen/sesion/fnccantrownew.php');
	include ( '../src/FunPerPriNiv/limitscan.php');
	include ( '../src/FunGen/sesion/fncvalses.php');
	
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblsistema.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblot.php');
	include ( '../src/FunPerPriNiv/pktblvistadocureportot.php');
	
	include ( '../src/FunGen/sesion/fncalmdat.php');
	include ( '../src/FunGen/sesion/fnccaf.php');
	include ( '../src/FunPerPriNiv/limitscanvistas.php');

	$reccomact =  fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]);

	if($accionborrarmedipredic)
		include ( 'borramedipredic.php');
	else
	{
		if($accionconsultarmedipredic)
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
				$accionconsultarmedipredic = 0;
		}
		if(!$recarreglo)
		{
			unset($recarreglo);
			$recarreglo = $GLOBALS[usuaplanta][sistemcodigo];
		}
	}
	
	include ( '../src/FunGen/sesion/fncaumdec.php');
	include('../src/FunGen/fncpageposition.php');
	
	$intervalo = fncaumdec('vistadocureportot',$inicio,$fin,$mov,$accionconsultarmedipredic,$recarreglo);
	$cantrow = $intervalo[total];
	if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; }
ob_end_flush();
?> 
<html> 
	<head> 
		<title>Registros de Documentos Mediciones predictivas</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<script language="JavaScript" type="text/javascript" src="../src/FunGen/fncsetcheck.js"></script>
		<script language="javascript" type="text/javascript" src="../src/FunGen/fncremembercheck.js"></script>
		<script language=JavaScript src="../src/FunGen/starPage_position.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/colorfooter.js" type="text/javascript" ></script>
	
		<?php include('../def/jquery.library_maestro.php');?>
		<style type="text/css">
			.tbl-cont-font { font-size: 95%; }
		</style>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" class="NoisePageBODY"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Listado de Documentos Mediciones predictivas</font><br><br></p> 
			<table border="0" cellspacing="1" cellpadding="2" align="center" class="ui-widget-content" width="850">
				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablmedipredic.php',$flagcheck); ?></td></tr>
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
								<td width="3%" class="ui-state-default tbl-head-font">Sel.</td> 
								<td width="7%" class="ui-state-default tbl-head-font">Num. OT</td> 
								<td width="12%" class="ui-state-default tbl-head-font">Fecha reporte</td> 
								<td width="20%" class="ui-state-default tbl-head-font">Ubicaci&oacute;n</td> 
								<td width="13%" class="ui-state-default tbl-head-font">Proceso</td> 
								<td width="22%" class="ui-state-default tbl-head-font">Equipo</td> 
								<td width="23%" class="ui-state-default tbl-head-font">Encargado</td> 
							</tr>
							<?php 
								include ( '../src/FunGen/sesion/fncvisregmedipredic.php');
								$reg[0] = 'reportcodigo';
								$reg1[0] = 'n';
								$nureturn = fncvisreg('vistadocureportot', $reg, $reg1, $idtrans, $arr_borrar, $flagcheck);
							?> 
   						</table> 
   					</td> 
  				</tr> 
  				<tr><td></td></tr>
		    	<tr><td></td></tr>
  				<tr><td><?php include ('../def/jquery.button_navdown.php') ?></td></tr> 
  				<tr><td>&nbsp;</td></tr>
  				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablmedipredic.php',$flagcheck); ?></td></tr> 				
 			</table>  
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
 			<input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
 			<input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>"> 
 			<input type="hidden" name="nombtabl" value="medipredic"> 
 			<input type="hidden" name="sourcetable" value="medipredic"> 
 			<input type="hidden" name="selstar" id="selstar" value="0">
			<input type="hidden" name="columnas" value="reportcodigo,ordtracodigo,plantacodigo,sistemcodigo,equipocodigo,usuacodigo,reportfecha">
 			<input type="hidden" name="reportcodigo" value="<?php if($accionconsultarmedipredic) echo $ordtracodigo; ?>"> 
 			<input type="hidden" name="ordtracodigo" value="<?php if($accionconsultarmedipredic) echo $ordtracodigo; ?>"> 
 			<input type="hidden" name="reportfecha" value="<?php if($accionconsultarreportot) echo $reportfecha; ?>"> 
 			<input type="hidden" name="usuacodigo" value="<?php if($accionconsultarmedipredic) echo $usuacodigo; ?>">
 			<input type="hidden" name="usuanombre" value="<?php if($accionconsultarmedipredic) echo $usuanombre; ?>">
 			<input type="hidden" name="plantacodigo" value="<?php if($accionconsultarmedipredic) echo $plantacodigo; ?>"> 
 			<input type="hidden" name="sistemcodigo" value="<?php if($accionconsultarmedipredic) echo $sistemcodigo; ?>"> 
 			<input type="hidden" name="equipocodigo" value="<?php if($accionconsultarmedipredic) echo $equipocodigo; ?>">
 			
 			<input type="hidden" name="accionconsultarmedipredic" value="<?php echo $_POST['accionconsulmedipredic']; ?>">
 			<input type="hidden" name="mov"> 
 			<!-- Permite el cambio de checkbox/radiobuttion --> 
			<input type="hidden" name="flagcheck" value="<?php echo $flagcheck;?>">
			<!-- Campos a visualizar en maestablborrgen		-->
			<input type="hidden" name="selcampos" value="reportcodigo">
			<!--											-->
			<input type="hidden" name="arr_borrar" value="<?php echo $arr_borrar;?>">
			<input type="hidden" name="arreglo_b">
			<!--											-->
 		</form> 
 		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
 	</body> 
<?php if(!$codigo){ echo " -->"; } ?>
</html>
