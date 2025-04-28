<?php
ob_start();
	include ( '../src/FunGen/sesion/fnccantrow.php');
	include ( '../src/FunGen/sesion/fnccantrow1.php');
	include ( '../src/FunGen/sesion/fnccantrownew.php');
	include ( '../src/FunPerPriNiv/limitscan.php');
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblvistacierreot.php');
	include ( '../src/FunPerPriNiv/pktblcierreot.php');
	include ( '../src/FunPerPriNiv/pktblreportot.php');
	include ( '../src/FunPerPriNiv/pktblot.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblusuariotareot.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunGen/sesion/fncalmdat.php');
	include ( '../src/FunGen/sesion/fnccaf.php');
	include ( '../src/FunPerPriNiv/limitscanvistas.php');

	$reccomact = fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]);

	if($accionborrarreportcierreot)
		include ('borrareportcierreot.php');
	else
	{
		if($accionconsultarreportcierreot)
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
			if(!$nusw){
				$accionconsultarreportot = 0;
			}
		}
		if(!$recarreglo)
		{
			unset($recarreglo);
			$recarreglo = $GLOBALS[usuaplanta][sistemcodigo];
		}
	}

	include ( '../src/FunGen/sesion/fncaumdec.php');
	include('../src/FunGen/fncpageposition.php');

  	$intervalo = fncaumdec('vistacierreot',$inicio,$fin,$mov,$accionconsultarreportcierreot,$recarreglo);
  	$cantrow = $intervalo[total];
  	if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; }
ob_end_flush();
?>
<html> 
	<head> 
		<title>Registros de reporte/cierre de Ordenes de trabajo</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<script language=JavaScript src="../src/FunGen/starPage_position.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/colorfooter.js" type="text/javascript" ></script>
		
		<?php include('../def/jquery.library_maestro.php');?>
	</head>
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" class="NoisePageBODY"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Listado de ordenes de trabajo cerradas</font></p> 
			<table border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content" width="850"> 
 				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablreportcierreot.php',$flagcheck); ?></td></tr>
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
								<td width="7%" class="ui-state-default tbl-head-font">Num OT</td> 
								<td width="20%" class="ui-state-default tbl-head-font">Ubicaci&oacute;n</td> 
								<td width="30%" class="ui-state-default tbl-head-font">Equipo</td> 
								<td width="40%" class="ui-state-default tbl-head-font">Descripci&oacute;n</td> 
							</tr>
							<?php
								include ( '../src/FunGen/sesion/fncvisregcierreot.php');
								$reg[0] = 'cierotcodigo';
								$reg1[0] = 'n';
								$nureturn = fncvisregcierreot('vistacierreot', $reg, $reg1, $idtrans, $arr_borrar, $flagcheck);
							?>
   						</table> 
   					</td> 
  				</tr> 
  				<tr><td></td></tr>
		    	<tr><td></td></tr>
  				<tr><td><?php include ('../def/jquery.button_navdown.php') ?></td></tr> 
  				<tr><td>&nbsp;</td></tr>
  				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablreportcierreot.php',$flagcheck); ?></td></tr> 				
 			</table> 
 			
 			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
 			<input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>">
 			<input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>">
 			<input type="hidden" name="nombtabl" value="cierreot">
  			<input type="hidden" name="sourcetable" value="reportcierreot"> 
 			<input type="hidden" name="selstar" id="selstar" value="0">
			<input type="hidden" name="columnas" value="cierotcodigo,
ordtracodigo,
plantacodigo,
sistemcodigo,
equipocodigo,
componcodigo,
tipmancodigo,
prioricodigo,
tipfalcodigo,
ordtrafecini,
ordtrafecfin,
tiptracodigo,
tareacodigo,
cierotdescri">
 			<input type="hidden" name="cierotcodigo" value="<?php if($accionconsultarreportcierreot) echo $cierotcodigo; ?>">
 			<input type="hidden" name="ordtracodigo" value="<?php if($accionconsultarreportcierreot) echo $ordtracodigo; ?>">
 			<input type="hidden" name="plantacodigo" value="<?php if($accionconsultarreportcierreot) echo $plantacodigo; ?>">
 			<input type="hidden" name="sistemcodigo" value="<?php if($accionconsultarreportcierreot) echo $sistemcodigo; ?>">
 			<input type="hidden" name="equipocodigo" value="<?php if($accionconsultarreportcierreot) echo $equipocodigo; ?>">
 			<input type="hidden" name="tipmancodigo" value="<?php if($accionconsultarreportcierreot) echo $tipmancodigo; ?>">
 			<input type="hidden" name="componcodigo" value="<?php if($accionconsultarreportcierreot) echo $componcodigo; ?>">
 			<input type="hidden" name="prioricodigo" value="<?php if($accionconsultarreportcierreot) echo $prioricodigo; ?>">
 			<input type="hidden" name="tipfalcodigo" value="<?php if($accionconsultarreportcierreot) echo $tipfalcodigo; ?>">
 			<input type="hidden" name="ordtrafecini" value="<?php if($accionconsultarreportcierreot) echo $ordtrafecini; ?>">
 			<input type="hidden" name="ordtrafecfin" value="<?php if($accionconsultarreportcierreot) echo $ordtrafecfin; ?>">
 			<input type="hidden" name="tiptracodigo" value="<?php if($accionconsultarreportcierreot) echo $tiptracodigo; ?>">
 			<input type="hidden" name="tareacodigo" value="<?php if($accionconsultarreportcierreot) echo $tareacodigo; ?>">
 			<input type="hidden" name="cierotdescri" value="<?php if($accionconsultarreportcierreot) echo $cierotdescri; ?>">
 			<input type="hidden" name="accionconsultarreportcierreot" value="<?php echo $accionconsultarreportcierreot; ?>">
 			<input type="hidden" name="mov">
 			<!-- Permite el cambio de checkbox/radiobuttion -->
			<input type="hidden" name="flagcheck" value="<?php echo $flagcheck;?>">
			<!-- Campos a visualizar en maestablborrgen		-->
			<input type="hidden" name="selcampos" value="cierotcodigo, cierotdescri">
			<!--											-->
			<input type="hidden" name="arr_borrar" value="<?php echo $arr_borrar;?>">
			<input type="hidden" name="arreglo_b">
			<!--											-->
 		</form>
 		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
 	</body>
<?php if(!$codigo){ echo " -->"; }?>
</html>