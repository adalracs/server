<?php 
ob_start(); 
	include ( '../src/FunGen/sesion/fnccantrow.php'); 
	include ( '../src/FunGen/sesion/fnccantrow1.php'); 
	include ( '../src/FunPerPriNiv/limitscan.php'); 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include ( '../src/FunPerPriNiv/pktbltransacherramie.php'); 
	include ( '../src/FunPerPriNiv/pktbltipomovi.php'); 
	include ( '../src/FunPerPriNiv/pktblherramie.php'); 
	include ( '../src/FunGen/sesion/fncalmdat.php'); 
	include ( '../src/FunGen/sesion/fnccaf.php');
	
	$reccomact= fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]);
	 
	session_unregister("arrtransac");
	session_unregister("arrtransaccod");
	session_unregister("arrtransacherr");
	session_unregister("flagsoliot");
	
	if($accionborrartransacherramie) 
		include ( 'borratransacherramie.php'); 
	else 
	{ 
		if($accionconsultartransacherramie) 
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
				$accionconsultartransacherramie = 0; 
		} 
	}
		
	include ( '../src/FunGen/sesion/fncaumdec.php'); 
	include('../src/FunGen/fncpageposition.php');

   	$intervalo = fncaumdec('transacherramie',$inicio,$fin,$mov,$accionconsultartransacherramie,$recarreglo); 
	$cantrow = $intervalo[total]; 
	if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; } 
ob_end_flush(); 
?>
<html> 
	<head> 
		<title>Registros de transaccion de herramienta</title> 
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
			<p><font class="NoiseFormHeaderFont">Listado de Entrada/Salida de herramienta</font><br><br></p> 
			<table border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content" width="750">
				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestabltransacherramie.php',$flagcheck); ?></td></tr>
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
								<td width="34%" class="ui-state-default">Herramienta</td>
								<td width="15%" class="ui-state-default">Cantidad</td>
								<td width="15%" class="ui-state-default">Fecha</td>
							</tr>
							<?php 
								include ( '../src/FunGen/sesion/fncvisregtransacherramie.php'); 
								$reg[0] = 'transhercodigo'; 
								$reg1[0] = 'n'; 
								$nureturn = fncvisregtransacherramie('transacherramie',$reg,$reg1,$idtrans); 
							?> 
   						</table> 
   					</td> 
  				</tr> 
  				<tr><td></td></tr>
		    	<tr><td></td></tr>
  				<tr><td><?php include ('../def/jquery.button_navdown.php') ?></td></tr> 
  				<tr><td>&nbsp;</td></tr>
  				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestabltransacherramie.php',$flagcheck); ?></td></tr>
			</table> 
 			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
 			<input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
 			<input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>">
 			<input type="hidden" name="sourcetable" value="transacherramie"> 
 			<input type="hidden" name="selstar" id="selstar" value="0"> 
 			<input type="hidden" name="nombtabl" value="transacherramie"> 
			<input type="hidden" name="columnas" value="transhercodigo,tipmovcodigo,herramcodigo,transherfecha,transhercanti,transhertotal,usuacodi,bodegacodigo,herestcodigo">
			<input type="hidden" name="transhercodigo" value="<?php if($accionconsultartransacherramie) echo $transhercodigo; ?>"> 
			<input type="hidden" name="tipmovcodigo" value="<?php if($accionconsultartransacherramie) echo $tipmovcodigo; ?>"> 
			<input type="hidden" name="herramcodigo" value="<?php if($accionconsultartransacherramie) echo $herramcodigo; ?>"> 
			<input type="hidden" name="herramnombre" value="<?php if($accionconsultartransacherramie) echo $herramnombre; ?>"> 
			<input type="hidden" name="transherfecha" value="<?php if($accionconsultartransacherramie) echo $transherfecha; ?>"> 
			<input type="hidden" name="transhercanti" value="<?php if($accionconsultartransacherramie) echo $transhercanti; ?>"> 
			<input type="hidden" name="transhertotal" value="<?php if($accionconsultartransacherramie) echo $transhertotal; ?>"> 
			<input type="hidden" name="usuacodigo" value="<?php if($accionconsultartransacherramie) echo $usuacodigo; ?>"> 
			<input type="hidden" name="bodegacodigo" value="<?php if($accionconsultartransacherramie) echo $bodegacodigo; ?>"> 
			<input type="hidden" name="herestcodigo" value="<?php if($accionconsultartransacherramie) echo $herestcodigo; ?>"> 
			<input type="hidden" name="accionconsultartransacherramie" value="<?php echo $accionconsultartransacherramie; ?>"> 
 			<input type="hidden" name="mov"> 
			<!-- Permite el cambio de checkbox/radiobuttion --> 
			<input type="hidden" name="flagcheck" value="<?php echo $flagcheck;?>">
 		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div> 
 	</body> 
<?php if(!$codigo){ echo " -->"; } ?>
</html>