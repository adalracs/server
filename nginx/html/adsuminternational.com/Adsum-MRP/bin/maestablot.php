<?php
	include ( '../src/FunGen/sesion/fnccantrownew.php');
	include ( '../src/FunGen/sesion/fnccantrow1.php');
	include ( '../src/FunGen/sesion/fnccantrow.php');
	include ( '../src/FunPerPriNiv/limitscanot.php');
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblot.php');
	include ( '../src/FunPerPriNiv/pktblvistamaxtareot.php');
	include ( '../src/FunPerPriNiv/pktblotestado.php');
	include ( '../src/FunPerPriNiv/pktbltareot.php');
	include ( '../src/FunPerPriNiv/pktbltarea.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblsistema.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktbltipotrab.php');
	include ( '../src/FunPerPriNiv/pktblpriorida.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblusuariotareot.php');
	include ( '../src/FunPerPriNiv/limitscanvistas.php');
	include ( '../src/FunPerPriNiv/pktblvistaot.php');  
	include ( '../src/FunGen/sesion/fncalmdat.php');
	include ( '../src/FunGen/sesion/fncalmdatc.php');
	include ( '../src/FunGen/sesion/fnccaf.php');
	
	$_SESSION['masterot'] = 1;

	$flagsoliot = 1;
	$flagsoliotitem = 1;
	$reccomact =  fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]);

	if($accionborrarot)
		include ( 'borraot.php');
	else
	{
		if($accionconsultarot)
		{
			$recon = 1;
			$nusw = 0;
			$nombcamp = strtok ($columnas,",");
			while ($nombcamp)
			{
				$nombcamp = trim($nombcamp);
				if($nombcamp == "usuacodi")
					$recarreglo[$nombcamp] = $usuacodigo;
				else
					$recarreglo[$nombcamp] = $$nombcamp;
				if($recarreglo[$nombcamp] != null)
					$nusw =1;
				$nombcamp = strtok(",");
			}
			if(!$nusw)
				$accionconsultarot = 0;
		}
		if(!$recarreglo)
			$recarreglo = $GLOBALS[usuaplanta][sistemcodigo];
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
	$intervalo = fncaumdec('vistaot',$inicio,$fin,$mov,$accionconsultarot,$recarreglo);
	$cantrow = $intervalo[total];
	if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans];}
?>
<html> 
	<head> 
		<title>Registros de ordenes de trabajo</title> 
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
			<p><font class="NoiseFormHeaderFont">Listado de ordenes de trabajo</font></p> 
			<table border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content" width="99%"> 
 				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablot.php',$flagcheck); ?></td></tr>
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
								<td width="2%" class="ui-state-default tbl-head-font">Sel.</td> 
								<td width="6%" class="ui-state-default tbl-head-font">Num OT</td> 
<!--								<td width="12%" class="ui-state-default tbl-head-font">Tarea</td> -->
								<td width="12%" class="ui-state-default tbl-head-font">Tipo trabajo</td> 
								<td width="20%" class="ui-state-default tbl-head-font">Ubicaci&oacute;n</td>
								<td width="10%" class="ui-state-default tbl-head-font">Proceso</td> 
								<td width="25%" class="ui-state-default tbl-head-font">Equipo</td> 
								<td width="15%" class="ui-state-default tbl-head-font">Encargado</td> 
<!--								<td width="6%" class="ui-state-default tbl-head-font">Prioridad</td> -->
								<td width="10%" class="ui-state-default tbl-head-font">Estado</td> 
							</tr>
							<?php 
								include ( '../src/FunGen/sesion/fncvisregvistaot.php');
								$reg[0] = 'ordtracodigo';
								$reg1[0] = 'n';
								$nureturn = fncvisregvistaot('vistaot', $reg, $reg1, $idtrans, $arr_borrar, $flagcheck);
							?> 
   						</table> 
   					</td> 
  				</tr> 
  				<tr><td></td></tr>
		    	<tr><td></td></tr>
  				<tr><td><?php include ('../def/jquery.button_navdown.php') ?></td></tr> 
  				<tr><td>&nbsp;</td></tr>
  				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablot.php',$flagcheck); ?></td></tr> 				
 			</table> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
 			<input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
 			<input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>"> 
 			<input type="hidden" name="nombtabl" value="ot"> 
  			<input type="hidden" name="sourcetable" value="ot"> 
 			<input type="hidden" name="selstar" id="selstar" value="0">  
			<input type="hidden" name="columnas" value="ordtracodigo,
ordtrafecgen,
plantacodigo,
sistemcodigo,
equipocodigo,
componcodigo,
tipmancodigo,
ordtranota,
ordtrafecini,
ordtrahorini,
ordtrafecfin,
ordtrahorfin,
usuacodi,
tiptracodigo,
tareacodigo,
prioricodigo,
tipfallcodigo">
			<input type="hidden" name="ordtracodigo" value="<?php if($accionconsultarot) echo $ordtracodigo; ?>">
			<input type="hidden" name="plantacodigo" value="<?php if($accionconsultarot) echo $plantacodigo; ?>">
			<input type="hidden" name="sistemcodigo" value="<?php if($accionconsultarot) echo $sistemcodigo; ?>">
			<input type="hidden" name="equipocodigo" value="<?php if($accionconsultarot) echo $equipocodigo; ?>">
			<input type="hidden" name="tipmancodigo" value="<?php if($accionconsultarot) echo $tipmancodigo; ?>">
			<input type="hidden" name="ordtrafecini" value="<?php if($accionconsultarot) echo $ordtrafecini; ?>">
			<input type="hidden" name="ordtrahorini" value="<?php if($accionconsultarot) echo $ordtrahorini; ?>">
			<input type="hidden" name="ordtrafecfin" value="<?php if($accionconsultarot) echo $ordtrafecfin; ?>">
			<input type="hidden" name="ordtrahorfin" value="<?php if($accionconsultarot) echo $ordtrahorfin; ?>">
			<input type="hidden" name="tiptracodigo" value="<?php if($accionconsultarot) echo $tiptracodigo; ?>">
			<input type="hidden" name="tareacodigo" value="<?php if($accionconsultarot) echo $tareacodigo; ?>">
			<input type="hidden" name="usutarcodigo" value="<?php if($accionconsultarot) echo $usutarcodigo; ?>">
			<input type="hidden" name="usuacodigo" value="<?php if($accionconsultarot) echo $usuacodigo; ?>">
			<input type="hidden" name="usuanombre" value="<?php if($accionconsultarot) echo $usuanombre; ?>">
			<input type="hidden" name="equiponombre" value="<?php if($accionconsultarot) echo $equiponombre; ?>">
			<input type="hidden" name="equipocodigocmbx" value="<?php if($accionconsultarot) echo $equipocodigocmbx; ?>">
			<input type="hidden" name="filterindex" value="<?php if($accionconsultarot) echo $filterindex; ?>">
			<input type="hidden" name="tipfallcodigo" value="<?php if($accionconsultarot) echo $tipfallcodigo; ?>">
			<input type="hidden" name="prioricodigo" value="<?php if($accionconsultarot) echo $prioricodigo; ?>">
			<input type="hidden" name="accionconsultarot"	value="<?php  echo $accionconsultarot; ?>">
			<input type="hidden" name="flagsoliotitem" value="1">
			<input type="hidden" name="mov"> <!-- Permite el cambio de checkbox/radiobuttion -->
			<input type="hidden" name="flagcheck" value="<?php  echo $flagcheck;?>">
			<!-- Campos a visualizar en maestablborrgen		-->
			<input type="hidden" name="selcampos" value="ordtracodigo, ordtrafecini, ordtrahorini, ordtranota">
			<input type="hidden" name="arr_borrar" value="<?php  echo $arr_borrar;?>">
			<input type="hidden" name="arreglo_b">
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>
