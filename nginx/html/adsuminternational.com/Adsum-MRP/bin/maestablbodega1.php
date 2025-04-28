<?php 
ob_start(); 
	include ( '../src/FunGen/sesion/fnccantrow.php'); 
	include ( '../src/FunGen/sesion/fnccantrow1.php'); 
	include ( '../src/FunPerPriNiv/limitscan.php'); 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include ( '../src/FunPerPriNiv/pktblvistabodega.php'); 
	include ( '../src/FunPerPriNiv/pktblbodega.php'); 
	include ( '../src/FunGen/sesion/fncalmdat.php'); 
	include ( '../src/FunGen/sesion/fnccaf.php'); 
	
	$reccomact =  fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]); 
	
	if($accionborrarbodega1) 
		include ( 'borrabodega1.php'); 
	else 
	{
		if($accionconsultarbodega1)
		{
			$nusw = 0;
			$nombcamp = strtok ($columnas,",");
			while ($nombcamp)
			{
				$nombcamp = trim($nombcamp);
				if($nombcamp == "usuacodi")
					$recarreglo[$nombcamp] = $usuacodigo;
				else 
					$recarreglo[$nombcamp] = $$nombcamp;
				if($recarreglo[$nombcamp] != null){ $nusw =1;}
					$nombcamp = strtok(",");
			}
			if(!$nusw)
				$accionconsultarbodega1 = 0;
		}
	}
	
	include ( '../src/FunGen/sesion/fncaumdec.php'); 
	include('../src/FunGen/fncpageposition.php');
	$intervalo = fncaumdec('vistabodega',$inicio,$fin,$mov,$accionconsultarbodega1,$recarreglo); 
	$cantrow = $intervalo[total]; 
	if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; } 
ob_end_flush(); 
?> 
<html> 
	<head> 
		<title>Registros de bodega</title> 
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
			<p><font class="NoiseFormHeaderFont">Listado de bodega</font><br><br></p> 
			<table border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content" width="600">
				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablbodega.php',$flagcheck); ?></td></tr>
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
								<td width="6%" class="ui-state-default">Sel.</td> 
								<td width="16%" class="ui-state-default">C&oacute;digo</td> 
								<td width="44%" class="ui-state-default">Nombre</td>
								<td width="34%" class="ui-state-default">Ubicaci&oacute;n</td>
							</tr>
							<?php 
								include ( '../src/FunGen/sesion/fncvisregbodega.php'); 
								$reg[0] = 'bodegacodigo'; 
								$reg1[0] = 'n'; 
								$nureturn = fncvisregbodega('vistabodega', $reg, $reg1, $idtrans, $arr_borrar, $flagcheck); 
							?> 
   						</table> 
   					</td> 
  				</tr> 
  				<tr><td></td></tr>
		    	<tr><td></td></tr>
  				<tr><td><?php include ('../def/jquery.button_navdown.php') ?></td></tr> 
  				<tr><td>&nbsp;</td></tr>
  				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablbodega.php',$flagcheck); ?></td></tr>
			</table> 
 			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
 			<input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
 			<input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>">
 			<input type="hidden" name="sourcetable" value="bodega1"> 
 			<input type="hidden" name="selstar" id="selstar" value="0"> 
 			<input type="hidden" name="nombtabl" value="bodega"> 
			<input type="hidden" name="columnas" value="bodegacodigo,bodeganombre,usuacodi,bodegaubicac,bodegacapaci,bodeganota,cencosocodigo,ciudadcodigo"> 
			<input type="hidden" name="bodegacodigo" value="<?php if($accionconsultarbodega1) echo $bodegacodigo; ?>"> 
			<input type="hidden" name="bodeganombre" value="<?php if($accionconsultarbodega1) echo $bodeganombre; ?>"> 
			<input type="hidden" name="usuacodigo" value="<?php if($accionconsultarbodega1) echo $usuacodigo; ?>"> 
			<input type="hidden" name="usuanombre" value="<?php if($accionconsultarbodega1) echo $usuanombre; ?>"> 
			<input type="hidden" name="bodegaubicac" value="<?php if($accionconsultarbodega1) echo $bodegaubicac; ?>"> 
			<input type="hidden" name="bodegacapaci" value="<?php if($accionconsultarbodega1) echo $bodegacapaci; ?>"> 
			<input type="hidden" name="bodeganota" value="<?php if($accionconsultarbodega1) echo $bodeganota; ?>"> 
			<input type="hidden" name="cencoscodigo" value="<?php if($accionconsultarbodega1) echo $cencoscodigo; ?>"> 
			<input type="hidden" name="ciudadcodigo" value="<?php if($accionconsultarbodega1) echo $ciudadcodigo; ?>"> 
			<input type="hidden" name="deptocodigo" value="<?php if($accionconsultarbodega1) echo $deptocodigo; ?>"> 
			<input type="hidden" name="accionconsultarbodega1" value="<?php echo $accionconsultarbodega1; ?>"> 
 			<input type="hidden" name="mov"> 
			<!-- Permite el cambio de checkbox/radiobuttion --> 
			<input type="hidden" name="flagcheck" value="<?php echo $flagcheck;?>">
			<!-- Campos a visualizar en maestablborrgen		-->
			<input type="hidden" name="selcampos" value="bodegacodigo, bodeganombre, bodegaubicac">
			<!--											-->
			<input type="hidden" name="arr_borrar" value="<?php echo $arr_borrar;?>">
			<input type="hidden" name="arreglo_b">
			<!--											--> 
 		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div> 
 	</body> 
<?php if(!$codigo){ echo " -->"; } ?>
</html>