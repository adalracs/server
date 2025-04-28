<?php 
ob_start();
	include ( '../src/FunGen/sesion/fnccantrow.php');
	include ( '../src/FunGen/sesion/fnccantrow1.php');
	include ( '../src/FunPerPriNiv/limitscan.php');
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblvistaprogramacion.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblsistema.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktbltipomant.php');
	include ( '../src/FunPerPriNiv/pktbltipotrab.php');
	include ( '../src/FunPerPriNiv/pktbltareot.php');
	include ( '../src/FunGen/sesion/fncalmdat.php');
	include ( '../src/FunGen/sesion/fnccaf.php');
	include ( '../src/FunPerPriNiv/limitscanvistas.php');

	$reccomact =  fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]);
	
	if($accionborrarprogramacionequipos)
		include ('borraprogramacion.php');
	else
	{
		if($accionconsultarprogramacionequipos)
		{
			$recon = 1;
			$nusw = 0;
			$nombcamp = strtok ($columnas,",");
			
			while ($nombcamp)
			{
				$nombcamp = trim($nombcamp);
				$recarreglo[$nombcamp] = $$nombcamp;
				if($recarreglo[$nombcamp] != null){ $nusw =1;}
				$nombcamp = strtok(",");
			}
			if(!$nusw){
				$accionconsultarprogramacionequipos = 0;
			}
		}
	}
	
	if($equipocodigocmbx && $filterindex && $recon)
	{
		$equipocodigo = $equipocodigocmbx;
		unset($plantacodigo, $sistemcodigo);
		$recarreglo['plantacodigo'] = $plantacodigo;
		$recarreglo['sistemcodigo'] = $sistemcodigo;
		$recarreglo['equipocodigo'] = $equipocodigocmbx;
		$accionconsultarprogramacionequipos = 1;
	}
	
	
	include ( '../src/FunGen/sesion/fncaumdec.php');
	include('../src/FunGen/fncpageposition.php');

	$intervalo = fncaumdec('vistaprogramacion',$inicio,$fin,$mov, $accionconsultarprogramacionequipos, $recarreglo);
	$cantrow = $intervalo[total];
	if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; }
ob_end_flush();
?> 
<html> 
	<head> 
		<title>Registro Programacion de mantenimiento a Equipos</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<script language=JavaScript src="../src/FunGen/starPage_position.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/colorfooter.js" type="text/javascript" ></script>
		<?php include('../def/jquery.library_maestro.php');?>
		
		<script type="text/javascript">
			$(function(){
				$('#nuevorutina').button({ icons: { primary: "ui-icon-document" } }).click(function() {
					document.form1.action = 'ingrnuevrutinaprogramacion.php';
					document.form1.submit();
					
					return false; 
				});
			});
		</script>
	</head> 
<?php if(!$codigo) { echo "<!--";} ?> 
	<body bgcolor="FFFFFF" class="NoisePageBODY"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Listado Programaci&oacute;n de Mantenimiento a Equipos</font><br><br></p>
			<table border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content" width="95%"> 
 				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablprogramacionequipos.php',$flagcheck); ?></td></tr>
  				<tr><td>&nbsp;</td></tr> 
  				<tr><td align="left" class="NoiseErrorDataTD"><div class="ui-buttonset">
				<?php
					if($reccomact[nuevo] && !$flagcheck)
					{
				  		echo '<button id="nuevo">Nuevo</button>&nbsp;&nbsp;';
				  		echo '<button id="nuevorutina">Cargar rutinas</button>&nbsp;&nbsp;';
					}
				  	if($reccomact[consultar] && !$flagcheck)
				  		echo '<button id="consultar">Consulta</button>&nbsp;&nbsp;';
				  	
					if($reccomact[detallar] && !$flagcheck)
				   		echo '<button id="detallar">Ver detalle</button>&nbsp;&nbsp;';
				   	
				   	if($reccomact[borrar] && !$flagcheck)
				   		echo '<button id="borrar">Borrar</button>&nbsp;&nbsp;';
				   	
				   	if($reccomact[borrar] && $flagcheck)
				   		echo '<button id="borrarselect">Borrar selecci&oacute;n</button>&nbsp;&nbsp;';
				   	
				   	if($reccomact[modificar] && !$flagcheck)
				   		echo '<button id="editar">Modificar</button>&nbsp;&nbsp;';
				   		
				   	if($reccomact[imprimir] && !$flagcheck)
				   		echo '<button id="imprimir">Imprimir</button>&nbsp;&nbsp;';
				?>
				</div></td></tr>
 				<tr><td>&nbsp;</td></tr>
 				<tr><td><?php include ('../def/jquery.button_navup.php') ?></td></tr>
 				<tr><td></td></tr>
		    	<tr><td></td></tr>
 				<tr> 
  					<td> 
  						<table width="100%" border="0" align="center" cellspacing="1" cellpadding="1" class="ui-widget-content"> 
							<tr> 
								<td width="3%" class="ui-state-default tbl-head-font">Sel.</td> 
								<td width="18%" class="ui-state-default tbl-head-font">Ubicaci&oacute;n</td> 
								<td width="11%" class="ui-state-default tbl-head-font">Sistema</td> 
								<td width="38%" class="ui-state-default tbl-head-font">Equipo</td>
								<td width="10%" class="ui-state-default tbl-head-font">Mantenimiento</td> 
								<td width="12%" class="ui-state-default tbl-head-font">Tipo trabajo</td> 
								<td width="6%" class="ui-state-default tbl-head-font">#Rutinas</td> 
							</tr>
							<?php 
								include ( '../src/FunGen/sesion/fncvisregprogramacion.php');
								$reg[0] = 'equipocodigo';
								$reg1[0] = 's';
								$reg[1] = 'tipmancodigo';
								$reg1[1] = 'n';
								$reg[2] = 'tiptracodigo';
								$reg1[2] = 'n';
								$nureturn = fncvisregprogramacion('vistaprogramacion', $reg, $reg1, $idtrans, $arr_borrar, $flagcheck);
							?> 
   						</table> 
   					</td> 
  				</tr> 
  				<tr><td></td></tr>
		    	<tr><td></td></tr>
  				<tr><td><?php include ('../def/jquery.button_navdown.php') ?></td></tr> 
  				<tr><td>&nbsp;</td></tr>
  				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablprogramacionequipos.php',$flagcheck); ?></td></tr> 				
 			</table> 

			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
			<input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>">
			<input type="hidden" name="sourcetable" value="programacionequipos"> 
 			<input type="hidden" name="selstar" id="selstar" value="0">
			<input type="hidden" name="nombtabl" value="vistaprogramacion"> 
			<input type="hidden" name="columnas" value="plantacodigo,sistemcodigo,equipocodigo,tipmancodigo,tiptracodigo"> 
			<input type="hidden" name="equipocodigo" value="<?php if($accionconsultarprogramacionequipos) echo $equipocodigo; ?>"> 
 			<input type="hidden" name="sistemcodigo" value="<?php if($accionconsultarprogramacionequipos) echo $sistemcodigo; ?>"> 
 			<input type="hidden" name="plantacodigo" value="<?php if($accionconsultarprogramacionequipos) echo $plantacodigo; ?>"> 
			<input type="hidden" name="tipmancodigo" value="<?php if($accionconsultarprogramacionequipos) echo $tipmancodigo; ?>">
			<input type="hidden" name="tiptracodigo" value="<?php if($accionconsultarprogramacionequipos) echo $tiptracodigo; ?>">
 			<input type="hidden" name="accionconsultarprogramacionequipos" value="<?php echo $accionconsultarprogramacionequipos; ?>"> 
 			<input type="hidden" name="mov"> 
 			<input type="hidden" name="flagcheck" value="<?php  echo $flagcheck;?>">
		</form> 
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
 	</body> 
<?php  if(!$codigo) { echo " -->"; } ?> 
</html>
