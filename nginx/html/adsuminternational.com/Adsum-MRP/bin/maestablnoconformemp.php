<?php  
ob_start(); 
	include ( '../src/FunPerPriNiv/pktblnoconformemp.php');
	include ( '../src/FunPerPriNiv/pktblanalisismp.php');
	include ( '../src/FunPerPriNiv/pktbltipoitemdesa.php');
	include ( '../src/FunGen/sesion/fnccantrow1.php'); 
	include ( '../src/FunGen/sesion/fnccantrow.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktbldefecto.php');
	include ( '../src/FunPerPriNiv/limitscan.php'); 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include ( '../src/FunPerPriNiv/pktbllote.php');
	include ( '../src/FunPerPriNiv/pktblcausa.php');
	include ( '../src/FunGen/sesion/fncalmdat.php'); 
	include ( '../src/FunGen/sesion/fnccaf.php');
	 
	$reccomact =  fnccaf($GLOBALS["usuacodi"],$_SERVER["SCRIPT_FILENAME"]);
	
	if($accionconsultarnoconformemp) 
	{ 
		$nusw = 0; 
		$nombcamp = strtok ($columnas,","); 
		while ($nombcamp) { 
			$nombcamp = trim($nombcamp); 
			$recarreglo[$nombcamp] = $$nombcamp; 
			if($recarreglo[$nombcamp]){ $nusw =1;} 
			$nombcamp = strtok(","); 
		} 
		if(!$nusw)
			$accionconsultarnoconformemp = 0; 
	} 
	
	include ( '../src/FunGen/sesion/fncaumdec.php'); 
	include('../src/FunGen/fncpageposition.php');
	
	$intervalo = fncaumdec('noconformemp',$inicio,$fin,$mov,$accionconsultarnoconformemp,$recarreglo); 
	$cantrow = $intervalo["total"]; 
	if($intervalo["idtrans"]){ $idtrans = $intervalo["idtrans"]; } 
ob_end_flush(); 
?> 
<html> 
	<head> 
		<title>Registros de no conformes</title> 
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
			<p><font class="NoiseFormHeaderFont">Listado de no conformes</font><br><br></p> 
			<table border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content" width="950">
				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablnoconformemp.php',$flagcheck); ?></td></tr>
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
								<td width="5%" class="ui-state-default">C&oacute;digo</td> 
								<td width="10%" class="ui-state-default">Item</td>
								<td width="5%" class="ui-state-default">Fecha</td> 
								<td width="10%" class="ui-state-default">Lote</td> 
								<td width="30%" class="ui-state-default">Plan Inspecci&oacute;n</td> 
								<td width="15%" class="ui-state-default">Responsable</td> 
								<td width="20%" class="ui-state-default">Analisado</td> 
							</tr>
							<?php 
								include ( '../src/FunGen/sesion/fncvisregnoconformemp.php');
								$reg[0] = 'nocomcodigo';
								$reg1[0] = 'n';
								$nureturn = fncvisregnoconformemp('noconformemp', $reg, $reg1, $idtrans, $arr_borrar, $flagcheck);
							?> 
   						</table> 
   					</td> 
  				</tr> 
  				<tr><td></td></tr>
		    	<tr><td></td></tr>
  				<tr><td><?php include ('../def/jquery.button_navdown.php') ?></td></tr> 
  				<tr><td>&nbsp;</td></tr>
  				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablnoconformemp.php',$flagcheck); ?></td></tr>
			</table> 
 			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
 			<input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
 			<input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>">
 			<input type="hidden" name="sourcetable" value="noconformemp"> 
 			<input type="hidden" name="selstar" id="selstar" value="0"> 
 			<input type="hidden" name="nombtabl" value="noconformemp"> 
			<input type="hidden" name="columnas" value="nocomcodigo,analiscodigo,usuacodi1,usuacodi2,nocomfecha,nocomhora,causacodigo,causadescri,defectcodigo,defectodescri,nocomplnaccion">
			<input type="hidden" name="nocomcodigo" value="<?php if($accionconsultarnoconformemp) echo $analiscodigo; ?>">
			<input type="hidden" name="analiscodigo" value="<?php if($accionconsultarnoconformemp) echo $proveecodigo; ?>">
			<input type="hidden" name="nocomfecha1" value="<?php if($accionconsultarnoconformemp) echo $analisnolote; ?>">                   
			<input type="hidden" name="usuacodi2" value="<?php if($accionconsultarnoconformemp) echo $itedescodigo; ?>">
			<input type="hidden" name="usuacodi" value="<?php if($accionconsultarnoconformemp) echo $usuacodi; ?>">
			<input type="hidden" name="nocomhora" value="<?php if($accionconsultarnoconformemp) echo $nocomhora; ?>">
			<input type="hidden" name="causacodigo" value="<?php if($accionconsultarnoconformemp) echo $causacodigo; ?>">
			<input type="hidden" name="causadescri" value="<?php if($accionconsultarnoconformemp) echo $causadescri; ?>">
			<input type="hidden" name="defectcodigo" value="<?php if($accionconsultarnoconformemp) echo $defectcodigo; ?>">
			<input type="hidden" name="defectcodigo" value="<?php if($accionconsultarnoconformemp) echo $defectcodigo; ?>">
			<input type="hidden" name="defectodescri" value="<?php if($accionconsultarnoconformemp) echo $defectodescri; ?>">
			<input type="hidden" name="accionconsultarnoconformemp" value="<?php echo $accionconsultarnoconformemp; ?>">
 			<input type="hidden" name="mov"> 
			<!-- Permite el cambio de checkbox/radiobuttion --> 
			<input type="hidden" name="flagcheck" value="<?php echo $flagcheck;?>">
			<!-- Campos a visualizar en maestablborrgen		-->
			<input type="hidden" name="selcampos" value="noconformemp">
			<!--											-->
			<input type="hidden" name="arr_borrar" value="<?php echo $arr_borrar;?>">
			<input type="hidden" name="arreglo_b">
			<!--											--> 
 		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div> 
 	</body> 
<?php if(!$codigo){ echo " -->"; } ?>
</html>