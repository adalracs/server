<?php
ob_start();
	include ( '../src/FunGen/sesion/fnccantrow.php');
	include ( '../src/FunGen/sesion/fnccantrow1.php');
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');//New 12-sep-2007 cbedoya
	include ( '../src/FunPerPriNiv/pktblsistema.php');//New 12-sep-2007 cbedoya
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktblsoliservestado.php');
	include ( '../src/FunPerPriNiv/pktblvistahistsoliserv.php');
	include ( '../src/FunPerPriNiv/pktbltipofall.php');
	include ( '../src/FunGen/sesion/fncalmdat.php');
	include ( '../src/FunGen/sesion/fnccaf.php');
	include ( '../src/FunPerPriNiv/limitscanvistas.php');
	include ( '../src/FunPerPriNiv/pktbltabla.php');
	include ( '../src/FunPerPriNiv/pktblcampo.php');

	$reccomact= fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]);
  
	if($accionconsultarhistsoliserv)
	{
		
		$nusw = 0;
		$nombcamp = strtok ($columnas,",");
		
		while ($nombcamp)
		{
			$nombcamp = trim($nombcamp);
			
			if($nombcamp == 'usuacodi')
				$recarreglo[$nombcamp] = $usuacodigo;
			else
				$recarreglo[$nombcamp] = $$nombcamp;
				
			if($recarreglo[$nombcamp] != null){ $nusw =1;}
			$nombcamp = strtok(",");
		}
		if(!$nusw)
			$accionconsultarhistsoliserv = 0;
	} 
	
	if($equipocodigocmbx && $filterindex && $recon)
	{
		$equipocodigo = $equipocodigocmbx;
		unset($plantacodigo, $sistemcodigo);
		$recarreglo['plantacodigo'] = $plantacodigo;
		$recarreglo['sistemcodigo'] = $sistemcodigo;
		$recarreglo['equipocodigo'] = $equipocodigocmbx;
		$accionconsultarot = 1;
	}
	
	
	include ( '../src/FunGen/sesion/fncaumdec.php');
	include('../src/FunGen/fncpageposition.php');
	$intervalo = fncaumdec('vistahistsoliserv',$inicio,$fin,$mov,$accionconsultarhistsoliserv,$recarreglo);
	$cantrow = $intervalo[total];
	if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; }
ob_end_flush();
?>
<html>
	<head>
		<title>Registros de historial solicitudes de servicio</title>
	    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	    <meta http-equiv="expires" content="0">
		<script language=JavaScript src="../src/FunGen/starPage_position.js" type="text/javascript" ></script>
		<script language="JavaScript" type="text/javascript" src="../src/FunGen/fncsetcheck.js"></script>
		<script language="javascript" type="text/javascript" src="../src/FunGen/fncremembercheck.js"></script>
		<script language=JavaScript src="../src/FunGen/colorfooter.js" type="text/javascript" ></script>
		
		<?php include('../def/jquery.library_maestro.php');?>
	</head>
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" class="NoisePageBODY">
    	<form name="form1" method="post"  enctype="multipart/form-data">
      		<p><font class="NoiseFormHeaderFont">Listado Historial solicitudes de servicio</font><br><br></p>
      		<table border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content" width="99%"> 
 				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablhistsoliserv.php',$flagcheck); ?></td></tr>
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
								<td width="6%" class="ui-state-default tbl-head-font">Num SS</td>
								<td width="7%" class="ui-state-default tbl-head-font">Fecha</td> 
								<td width="8%" class="ui-state-default tbl-head-font">Solicitante</td> 
								<td width="14%" class="ui-state-default tbl-head-font">Ubicaci&oacute;n</td>
								<td width="9%" class="ui-state-default tbl-head-font">Proceso</td> 
								<td width="26%" class="ui-state-default tbl-head-font">Equipo</td> 
								<td width="14%" class="ui-state-default tbl-head-font">Tipo de falla</td> 
								<td width="7%" class="ui-state-default tbl-head-font">Estado</td> 
								<td width="6%" class="ui-state-default tbl-head-font">Num. OT</td> 
<!--								<td width="6%" class="ui-state-default tbl-head-font">Prioridad</td> -->
								 
							</tr>
							<?php 
								include ( '../src/FunGen/sesion/fncvisreghistsoliserv.php');
								$reg[0] = 'solsercodigo';
								$reg1[0] = 'n';
								$nureturn = fncvisregsoliserv('vistahistsoliserv', $reg, $reg1, $idtrans, $arr_borrar, $flagcheck);
							?> 
   						</table> 
   					</td> 
  				</tr> 
  				<tr><td></td></tr>
		    	<tr><td></td></tr>
  				<tr><td><?php include ('../def/jquery.button_navdown.php') ?></td></tr> 
  				<tr><td>&nbsp;</td></tr>
  				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablhistsoliserv.php',$flagcheck); ?></td></tr> 				
 			</table>
 			
 			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
 			<input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>">
 			<input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>">
 			<input type="hidden" name="nombtabl" value="soliserv">
 			<input type="hidden" name="sourcetable" value="histsoliserv"> 
 			<input type="hidden" name="selstar" id="selstar" value="0">
			<input type="hidden" name="columnas" value="solsercodigo,usuacodi,tipfalcodigo,estsolcodigo,solsermotivo,solserfecha,plantacodigo,sistemcodigo,equipocodigo,componcodigo,ordtracodigo">
 			<input type="hidden" name="solsercodigo" value="<?php if($accionconsultarhistsoliserv) echo $solsercodigo; ?>">
 			<input type="hidden" name="usuacodigo" value="<?php if($accionconsultarhistsoliserv) echo $usuacodigo; ?>">
  			<input type="hidden" name="tipfalcodigo" value="<?php if($accionconsultarhistsoliserv) echo $tipfalcodigo; ?>">
 			<input type="hidden" name="estsolcodigo" value="<?php if($accionconsultarhistsoliserv) echo $estsolcodigo; ?>">
 			<input type="hidden" name="solsermotivo" value="<?php if($accionconsultarhistsoliserv) echo $solsermotivo; ?>">
 			<input type="hidden" name="solserfecha" value="<?php if($accionconsultarhistsoliserv) echo $solserfecha; ?>">
 			<input type="hidden" name="plantacodigo" value="<?php if($accionconsultarhistsoliserv) echo $plantacodigo; ?>">
 			<input type="hidden" name="sistemcodigo" value="<?php if($accionconsultarhistsoliserv) echo $sistemcodigo; ?>">
 			<input type="hidden" name="equipocodigo" value="<?php if($accionconsultarhistsoliserv) echo $equipocodigo; ?>">
 			<input type="hidden" name="accionconsultarhistsoliserv" value="<?php echo $accionconsultarhistsoliserv; ?>">
 			<input type="hidden" name="mov">
 			<!-- Permite el cambio de checkbox/radiobuttion -->
			<input type="hidden" name="flagcheck" value="<?php echo $flagcheck;?>">
			<!-- Campos a visualizar en maestablborrgen		-->
			<input type="hidden" name="selcampos" value="solsercodigo, solsermotivo">
			<!--											-->
			<input type="hidden" name="arr_borrar" value="<?php echo $arr_borrar;?>">
			<input type="hidden" name="arreglo_b">
			<!--											-->
 		</form>
 		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
 	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>
