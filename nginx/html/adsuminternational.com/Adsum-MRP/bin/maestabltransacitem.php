<?php 
ob_start(); 
	include ( '../src/FunGen/sesion/fnccantrow.php'); 
	include ( '../src/FunGen/sesion/fnccantrow1.php'); 
	include ( '../src/FunPerPriNiv/limitscan.php'); 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include ( '../src/FunPerPriNiv/pktbltransacitem.php'); 
	include ( '../src/FunPerPriNiv/pktbltipomovi.php'); 
	include ( '../src/FunPerPriNiv/pktblitem.php'); 
	include ( '../src/FunGen/sesion/fncalmdat.php'); 
	include ( '../src/FunGen/sesion/fnccaf.php'); 
	$reccomact= fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]); 
	session_unregister("arrtransacitem");
	session_unregister("arrtransaccoditem");
	session_unregister("flagsoliotitem");
	
	if($accionborrartransacitem) 
		include ( 'borratransacitem.php'); 
	else 
	{ 
		if($accionconsultartransacitem) 
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
				$accionconsultartransacitem = 0; 
		} 
	} 
		
	include ( '../src/FunGen/sesion/fncaumdec.php'); 
	include('../src/FunGen/fncpageposition.php');
	$intervalo = fncaumdec('transacitem',$inicio,$fin,$mov,$accionconsultartransacitem,$recarreglo); 
	$cantrow = $intervalo[total]; 
	if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; } 
ob_end_flush(); 
?>
<html> 
	<head> 
		<title>Registros de transaccion de item</title> 
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
			<p><font class="NoiseFormHeaderFont">Listado de Entrada/Salida de item</font><br><br></p> 
			<table border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content" width="750">
				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestabltransacitem.php',$flagcheck); ?></td></tr>
  				<tr><td>&nbsp;</td></tr> 
  				<tr><td align="left" class="NoiseErrorDataTD"><?php include ('../def/jquery.maestablbuttonstranc.php') ?></td></tr>
 				<tr><td>&nbsp;</td></tr>
 				<tr><td><?php include ('../def/jquery.button_navup.php') ?></td></tr>
 				<tr><td></td></tr> 
		    	<tr><td></td></tr>
 				<tr> 
  					<td> 
  						<table width="100%" border="0" align="center" cellspacing="1" cellpadding="1" class="ui-widget-content"> 
							<tr> 
								<td width="6%" class="ui-state-default">Sel.</td> 
								<td width="10%" class="ui-state-default">C&oacute;digo</td> 
								<td width="20%" class="ui-state-default">Movimiento</td>
								<td width="34%" class="ui-state-default">Item</td>
								<td width="15%" class="ui-state-default">Cantidad</td>
								<td width="15%" class="ui-state-default">Fecha</td>
							</tr>
							<?php 
								include ( '../src/FunGen/sesion/fncvisregtransacitem.php'); 
								$reg[0] = 'transitecodigo'; 
								$reg1[0] = 'n'; 
								$nureturn = fncvisregtransacitem('transacitem',$reg,$reg1,$idtrans); 
							?> 
   						</table> 
   					</td> 
  				</tr> 
  				<tr><td></td></tr>
		    	<tr><td></td></tr>
  				<tr><td><?php include ('../def/jquery.button_navdown.php') ?></td></tr> 
  				<tr><td>&nbsp;</td></tr>
  				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestabltransacitem.php',$flagcheck); ?></td></tr>
			</table> 
 			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
 			<input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
 			<input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>">
 			<input type="hidden" name="sourcetable" value="transacitem"> 
 			<input type="hidden" name="selstar" id="selstar" value="0"> 
 			<input type="hidden" name="nombtabl" value="transacitem"> 
			<input type="hidden" name="columnas" value="transitecodigo,tipmovcodigo,itemcodigo,transitefecha,transitecantid,transitetotal,usacodi,bodegacodigo,pedidocodigo,itestacodigo">
			<input type="hidden" name="transitecodigo" value="<?php if($accionconsultartransacitem) echo $transitecodigo;?>"> 
			<input type="hidden" name="tipmovcodigo" value="<?php if($accionconsultartransacitem) echo $tipmovcodigo; ?>">
			<input type="hidden" name="itemcodigo" value="<?php if($accionconsultartransacitem) echo $itemcodigo; ?>"> 
			<input type="hidden" name="itemnombre" value="<?php if($accionconsultartransacitem) echo $itemnombre; ?>"> 
			<input type="hidden" name="transitefecha" value="<?php if($accionconsultartransacitem) echo $transitefecha;?>"> 
			<input type="hidden" name="transitecantid" value="<?php if($accionconsultartransacitem) echo $transitecantid;?>"> 
			<input type="hidden" name="transitetotal" value="<?php if($accionconsultartransacitem) echo $transitetotal;?>"> 
			<input type="hidden" name="usuacodigo" value="<?php if($accionconsultartransacitem) echo $usuacodigo;?>"> 
			<input type="hidden" name="bodegacodigo" value="<?php if($accionconsultartransacitem) echo $bodegacodigo;?>"> 
			<input type="hidden" name="pedidocodigo" value="<?php if($accionconsultartransacitem) echo $pedidocodigo;?>"> 
			<input type="hidden" name="itestacodigo" value="<?php if($accionconsultartransacitem) echo $itestacodigo;?>"> 
			<input type="hidden" name="accionconsultartransacitem" value="<?php echo $accionconsultartransacitem; ?>">
 			<input type="hidden" name="mov"> 
			<!-- Permite el cambio de checkbox/radiobuttion --> 
			<input type="hidden" name="flagcheck" value="<?php echo $flagcheck;?>">
 		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div> 
 	</body> 
<?php if(!$codigo){ echo " -->"; } ?>
</html>