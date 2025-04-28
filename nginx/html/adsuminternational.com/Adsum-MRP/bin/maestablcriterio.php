<?php  
ob_start(); 
	include ( '../src/FunGen/sesion/fnccantrow.php'); 
	include ( '../src/FunGen/sesion/fnccantrow1.php'); 
	include ( '../src/FunPerPriNiv/limitscan.php'); 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include ( '../src/FunPerPriNiv/pktblcriterio.php'); 
	include ( '../src/FunGen/sesion/fncalmdat.php'); 
	include ( '../src/FunGen/sesion/fnccaf.php');
	 
	$reccomact =  fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]);
	
	if($accionborrarcriterio) 
		include ( 'borracriterio.php'); 
	else 
	{ 
		if($accionconsultarcriterio) 
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
				$accionconsultarcriterio = 0; 
		} 
	} 
	include ( '../src/FunGen/sesion/fncaumdec.php'); 
	include('../src/FunGen/fncpageposition.php');
	
	$intervalo = fncaumdec('criterio',$inicio,$fin,$mov,$accionconsultarcriterio,$recarreglo); 
	$cantrow = $intervalo[total]; 
	if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; } 
ob_end_flush(); 
?> 
<html> 
	<head> 
		<title>Registros de criterio</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<script language="JavaScript" type="text/javascript" src="../src/FunGen/fncsetcheck.js"></script>
		<script language="javascript" type="text/javascript" src="../src/FunGen/fncremembercheck.js"></script>
		<script language=JavaScript src="../src/FunGen/starPage_position.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/colorfooter.js" type="text/javascript" ></script>
		
		<?php include('../def/jquery.library_maestro.php');?>
	</head>
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" class="NoisePageBODY"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Listado de criterios</font><br><br></p> 
			<table border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content" width="550">
				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablcriterio.php',$flagcheck); ?></td></tr>
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
								<td width="5%" class="ui-state-default">Sel.</td> 
								<td width="10%" class="ui-state-default">C&oacute;digo</td> 
								<td width="85%" class="ui-state-default">Nombre</td> 
							</tr> 
							<?php 
								include ( '../src/FunGen/sesion/fncvisreg.php'); 
								$reg[0] = 'critercodigo'; 
								$reg1[0] = 'n'; 
								$nureturn = fncvisreg('criterio', $reg, $reg1, $idtrans, $arr_borrar, $flagcheck);
							?> 
   						</table> 
   					</td> 
  				</tr> 
  				<tr><td></td></tr>
		    	<tr><td></td></tr>
  				<tr><td><?php include ('../def/jquery.button_navdown.php') ?></td></tr> 
  				<tr><td>&nbsp;</td></tr>
  				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablcriterio.php',$flagcheck); ?></td></tr>
			</table> 
 			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
 			<input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
 			<input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>">
 			<input type="hidden" name="sourcetable" value="criterio"> 
 			<input type="hidden" name="selstar" id="selstar" value="0"> 
 			<input type="hidden" name="nombtabl" value="criterio"> 
			<input type="hidden" name="columnas" value="critercodigo,criternombre,criterdescri"> 
			<input type="hidden" name="critercodigo" value="<?php if($accionconsultarcriterio) echo $critercodigo; ?>"> 
			<input type="hidden" name="criternombre" value="<?php if($accionconsultarcriterio) echo $criternombre; ?>"> 
			<input type="hidden" name="criterdescri" value="<?php if($accionconsultarcriterio) echo $criterdescri; ?>"> 
 			<input type="hidden" name="mov"> 
			<!-- Permite el cambio de checkbox/radiobuttion --> 
			<input type="hidden" name="flagcheck" value="<?php echo $flagcheck;?>">
			<!-- Campos a visualizar en maestablborrgen		-->
			<input type="hidden" name="selcampos" value="critercodigo">
			<!--											-->
			<input type="hidden" name="arr_borrar" value="<?php echo $arr_borrar;?>">
			<input type="hidden" name="arreglo_b">
			<!--											--> 
 		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div> 
 	</body> 
<?php if(!$codigo){ echo " -->"; } ?>
</html>