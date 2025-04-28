<?php  
ob_start(); 
	include ( '../src/FunGen/sesion/fnccantrow.php'); 
	include ( '../src/FunGen/sesion/fnccantrow1.php'); 
	include ( '../src/FunPerPriNiv/limitscancapacitacion.php'); 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include ( '../src/FunPerPriNiv/pktblcapacitacion.php'); 
	include ( '../src/FunPerPriNiv/pktblsaloncapaci.php'); 
	include ( '../src/FunPerPriNiv/pktblubicaccapaci.php'); 
	include ( '../src/FunPerPriNiv/pktblusuario.php'); 
	include ( '../src/FunPerPriNiv/pktblmateapoy.php'); 
	include ( '../src/FunPerPriNiv/pktblcurso.php'); 
	include ( '../src/FunGen/sesion/fncalmdat.php'); 
	include ( '../src/FunGen/sesion/fnccaf.php');
	 
	$reccomact =  fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]);
	
	if($accionborrarcapacitacion) 
		include ( 'borracapacitacion.php'); 
	else 
	{ 
		if($accionconsultarcapacitacion) 
		{ 
			$nusw = 0; 
			$nombcamp = strtok ($columnas,","); 
			while ($nombcamp) 
			{ 
				$nombcamp = trim($nombcamp);

				if($nombcamp == 'departcodigo')
					$recarreglo[$nombcamp] = $departcodigo1;
				elseif($nombcamp == 'usuacodi')
					$recarreglo[$nombcamp] = $usuacodigo;
				else
					$recarreglo[$nombcamp] = $$nombcamp; 
				if($recarreglo[$nombcamp]){ $nusw =1;} 
				$nombcamp = strtok(","); 
			} 
			if(!$nusw)
				$accionconsultarcapacitacion = 0; 
		} 
	} 
	
	include ( '../src/FunGen/sesion/fncaumdec.php'); 
	include('../src/FunGen/fncpageposition.php');
	
	$intervalo = fncaumdec('capacitacion',$inicio,$fin,$mov,$accionconsultarcapacitacion,$recarreglo); 
	$cantrow = $intervalo[total]; 
	if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; } 
ob_end_flush(); 
?> 
<html> 
	<head> 
		<title>Registros de capacitacion</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<script language="JavaScript" type="text/javascript" src="../src/FunGen/fncsetcheck.js"></script>
		<script language="javascript" type="text/javascript" src="../src/FunGen/fncremembercheck.js"></script>
		<script language=JavaScript src="../src/FunGen/starPage_position.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/colorfooter.js" type="text/javascript" ></script>
		
		<?php include('../def/jquery.library_maestro.php');?>
		
		<script type="text/javascript">
			$(function(){
				/**
				 * Boton Calificar
				 */
				$('#calificar').button({ icons: { primary: "ui-icon-check" } }).click(function() {
					if(document.form1.selstar.value == 1)
					{
						document.form1.action = 'ingrnuevccapacitacion.php';
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
		
		
	</head>
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" class="NoisePageBODY"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Listado de capacitaci&oacute;n</font><br><br></p> 
			<table border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content" width="850">
				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablcapacitacion.php',$flagcheck); ?></td></tr>
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
								<td width="2%" class="ui-state-default">Sel.</td> 
<!--								<td width="8%" class="ui-state-default">C&oacute;digo</td> -->
								<td width="15%" class="ui-state-default">Fecha</td>
								<td width="25%" class="ui-state-default">Curso</td> 
								<td width="30%" class="ui-state-default">Ubicaci&oacute;n</td> 
								<td width="20%" class="ui-state-default">Responsable</td> 
								<td width="8%" class="ui-state-default">Calificado</td> 
							</tr> 
							<?php 
								include ( '../src/FunGen/sesion/fncvisregcapacitacion.php'); 
								$reg[0] = 'capacicodigo'; 
								$reg1[0] = 'n'; 
								$nureturn = fncvisregcapacitacion('capacitacion', $reg, $reg1, $idtrans, $arr_borrar, $flagcheck);
							?> 
   						</table> 
   					</td> 
  				</tr> 
  				<tr><td></td></tr>
		    	<tr><td></td></tr>
  				<tr><td><?php include ('../def/jquery.button_navdown.php') ?></td></tr> 
  				<tr><td>&nbsp;</td></tr>
  				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablcapacitacion.php',$flagcheck); ?></td></tr>
			</table> 
 			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
 			<input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
 			<input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>">
 			<input type="hidden" name="sourcetable" value="capacitacion"> 
 			<input type="hidden" name="selstar" id="selstar" value="0"> 
 			<input type="hidden" name="nombtabl" value="capacitacion"> 
			<input type="hidden" name="columnas" value="capacicodigo,cursocodigo,ubicapcodigo,salcapcodigo,capacifecgen,capacifecini,capacihorini,capacihorfin,usuacodi,departcodigo,capacigenera,capaciobjeti"> 
			<input type="hidden" name="capacicodigo" value="<?php if($accionconsultarcapacitacion) echo $capacicodigo; ?>"> 
			<input type="hidden" name="cursocodigo" value="<?php if($accionconsultarcapacitacion) echo $cursocodigo; ?>"> 
			<input type="hidden" name="ubicapcodigo" value="<?php if($accionconsultarcapacitacion) echo $ubicapcodigo; ?>"> 
			<input type="hidden" name="salcapcodigo" value="<?php if($accionconsultarcapacitacion) echo $salcapcodigo; ?>"> 
			<input type="hidden" name="capacifecgen" value="<?php if($accionconsultarcapacitacion) echo $capacifecgen; ?>"> 
			<input type="hidden" name="capacifecini" value="<?php if($accionconsultarcapacitacion) echo $capacifecini; ?>"> 
			<input type="hidden" name="capacihorini" value="<?php if($accionconsultarcapacitacion) echo $capacihorini; ?>"> 
			<input type="hidden" name="capacihorfin" value="<?php if($accionconsultarcapacitacion) echo $capacihorfin; ?>"> 
			<input type="hidden" name="usuacodigo" value="<?php if($accionconsultarcapacitacion) echo $usuacodigo; ?>"> 
			<input type="hidden" name="usuanombre" value="<?php if($accionconsultarcapacitacion) echo $usuanombre; ?>"> 
			<input type="hidden" name="departcodigo1" value="<?php if($accionconsultarcapacitacion) echo $departcodigo1; ?>"> 
			<input type="hidden" name="departnombre" value="<?php if($accionconsultarcapacitacion) echo $departnombre; ?>"> 
			<input type="hidden" name="capacigenera" value="<?php if($accionconsultarcapacitacion) echo $capacigenera; ?>"> 
			<input type="hidden" name="capaciobjeti" value="<?php if($accionconsultarcapacitacion) echo $capaciobjeti; ?>"> 
			<input type="hidden" name="accionconsultarcapacitacion" value="<?php echo $accionconsultarcapacitacion; ?>"> 
 			<input type="hidden" name="mov"> 
			<!-- Permite el cambio de checkbox/radiobuttion --> 
			<input type="hidden" name="flagcheck" value="<?php echo $flagcheck;?>">
			<!-- Campos a visualizar en maestablborrgen		-->
			<input type="hidden" name="selcampos" value="capacicodigo">
			<!--											-->
			<input type="hidden" name="arr_borrar" value="<?php echo $arr_borrar;?>">
			<input type="hidden" name="arreglo_b">
			<!--											--> 
 		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div> 
 	</body> 
<?php if(!$codigo){ echo " -->"; } ?>
</html>