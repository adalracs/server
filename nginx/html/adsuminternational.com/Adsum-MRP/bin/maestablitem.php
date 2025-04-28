<?php 
ob_start(); 
	include ( '../src/FunGen/sesion/fnccantrow.php');
	include ( '../src/FunGen/sesion/fnccantrow1.php');
	include ( '../src/FunPerPriNiv/limitscan.php');
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblitem.php');
	include ( '../src/FunPerPriNiv/pktblproveedo.php');
	include ( '../src/FunPerPriNiv/pktblbodega.php');
	include ( '../src/FunPerPriNiv/pktblcentcost.php');
	include ( '../src/FunGen/sesion/fncalmdat.php');
	include ( '../src/FunGen/sesion/fnccaf.php');
	
	$reccomact= fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]);
	
	if($accionborraritem)
		include ( 'borraitem.php');
	else
	{
		if($accionconsultaritem)
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
				$accionconsultaritem = 0;
		}
	}
	
	include ( '../src/FunGen/sesion/fncaumdec.php');
	include('../src/FunGen/fncpageposition.php');
  	$intervalo = fncaumdec('item',$inicio,$fin,$mov,$accionconsultaritem,$recarreglo);
  	$cantrow = $intervalo[total];
  	if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; }
ob_end_flush(); 
?>
<html> 
	<head> 
		<title>Registros de items</title> 
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
			<p><font class="NoiseFormHeaderFont">Listado de items</font><br><br></p> 
			<table border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content" width="780">
				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablitem.php',$flagcheck); ?></td></tr>
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
								<td width="4%" class="ui-state-default">Sel.</td> 
								<td width="12%" class="ui-state-default">C&oacute;digo</td> 
								<td width="54%" class="ui-state-default">Nombre</td>
								<td width="10%" class="ui-state-default">Disponible</td>
								<td width="20%" class="ui-state-default">C&oacute;digo financiero</td>
							</tr>
							<?php 
								include ( '../src/FunGen/sesion/fncvisregitem.php');
								$reg[0] = 'itemcodigo';
								$reg1[0] = 'n';
								$nureturn = fncvisregitem('item',$reg,$reg1,$idtrans);
							?> 
   						</table> 
   					</td> 
  				</tr> 
  				<tr><td></td></tr>
		    	<tr><td></td></tr>
  				<tr><td><?php include ('../def/jquery.button_navdown.php') ?></td></tr> 
  				<tr><td>&nbsp;</td></tr>
  				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablitem.php',$flagcheck); ?></td></tr>
			</table> 
 			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
 			<input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
 			<input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>">
 			<input type="hidden" name="sourcetable" value="item"> 
 			<input type="hidden" name="selstar" id="selstar" value="0"> 
 			<input type="hidden" name="nombtabl" value="item"> 
			<input type="hidden" name="columnas" value="itemcodigo,unidadcodigo,cencoscodigo,itemnombre,itemcanmin,itemcanmax,itemvalor,itemnota,itemdispon">
			<input type="hidden" name="itemcodigo" value="<?php if($accionconsultaritem) echo $itemcodigo; ?>"> 
			<input type="hidden" name="unidadcodigo" value="<?php if($accionconsultaritem) echo $unidadcodigo; ?>"> 
			<input type="hidden" name="cencoscodigo" value="<?php if($accionconsultaritem) echo $cencoscodigo; ?>"> 
			<input type="hidden" name="itemnombre" value="<?php if($accionconsultaritem) echo $itemnombre; ?>"> 
			<input type="hidden" name="itemcanmin" value="<?php if($accionconsultaritem) echo $itemcanmin; ?>"> 
			<input type="hidden" name="itemcanmax" value="<?php if($accionconsultaritem) echo $itemcanmax; ?>"> 
			<input type="hidden" name="itemvalor" value="<?php if($accionconsultaritem) echo $itemvalor; ?>"> 
			<input type="hidden" name="itemnota" value="<?php if($accionconsultaritem) echo $itemnota; ?>"> 
			<input type="hidden" name="itemdispon" value="<?php if($accionconsultaritem) echo $itemdispon; ?>"> 
			<input type="hidden" name="accionconsultaritem" value="<?php echo $accionconsultaritem; ?>"> 
 			<input type="hidden" name="mov"> 
			<!-- Permite el cambio de checkbox/radiobuttion --> 
			<input type="hidden" name="flagcheck" value="<?php echo $flagcheck;?>">
 		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div> 
 	</body> 
<?php if(!$codigo){ echo " -->"; } ?>
</html>