<?php 
ob_start(); 
	include ( '../src/FunGen/sesion/fnccantrow.php');
	include ( '../src/FunGen/sesion/fnccantrow1.php');
	include ( '../src/FunPerPriNiv/limitscan.php');
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktbllote.php');
	include ( '../src/FunPerPriNiv/pktblestadoanalisis.php');
	include ('../src/FunPerPriNiv/pktbltipoitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblvistahistorialmp.php');
	include ( '../src/FunPerPriNiv/pktblanalisismp.php');
	include ('../src/FunPerPriNiv/pktbltipocump.php');
	include ( '../src/FunGen/sesion/fncalmdat.php');
	include ( '../src/FunGen/sesion/fnccaf.php');
	
	$reccomact =  fnccaf($GLOBALS["usuacodi"],$_SERVER["SCRIPT_FILENAME"]);
	
	
	if($accionconsultarhistorialamp)
	{
		$nusw = 0;
		$nombcamp = strtok ($columnas,",");
		while ($nombcamp){
			$nombcamp = trim($nombcamp);
			$recarreglo[$nombcamp] = $$nombcamp;
			if($recarreglo[$nombcamp]){ $nusw =1;}
			$nombcamp = strtok(",");
		}
		if(!$nusw)
			$accionconsultarhistorialamp = 0;
	}
	
	include ( '../src/FunGen/sesion/fncaumdec.php');
	include('../src/FunGen/fncpageposition.php');
	
  	$intervalo = fncaumdec('vistahistorialmp',$inicio,$fin,$mov,$accionconsultarhistorialamp,$recarreglo);
  	$cantrow = $intervalo["total"];
  	if($intervalo["idtrans"]){ $idtrans = $intervalo["idtrans"]; }
ob_end_flush(); 
?>
<html> 
	<head> 
		<title>Historial de analisis de materias primas</title> 
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
			<p><font class="NoiseFormHeaderFont">Historial de analisis de materias primas</font><br><br></p> 
			<table border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content" width="950">
				<tr><td class="NoiseErrorDataTD" align="right"><?php page_position($intervalo,'maestablhistorialamp.php',$flagcheck); ?></td></tr>
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
								<td width="20%" class="ui-state-default">Responsable</td> 
								<td width="15%" class="ui-state-default">Estado</td> 
							</tr>
							<?php 
								include ( '../src/FunGen/sesion/fncvisreganalisismp.php');
								$reg[0] = 'analiscodigo';
								$reg1[0] = 'n';
								$nureturn = fncvisreganalisismp('vistahistorialmp', $reg, $reg1, $idtrans, $arr_borrar, $flagcheck);
							?> 
   						</table> 
   					</td> 
  				</tr> 
  				<tr><td></td></tr>
		    	<tr><td></td></tr>
  				<tr><td><?php include ('../def/jquery.button_navdown.php') ?></td></tr> 
  				<tr><td>&nbsp;</td></tr>
  				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablhistorialamp.php',$flagcheck); ?></td></tr>
			</table> 
 			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
 			<input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
 			<input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>">
 			<input type="hidden" name="sourcetable" value="historialamp"> 
 			<input type="hidden" name="selstar" id="selstar" value="0"> 
 			<input type="hidden" name="nombtabl" value="analisismp"> 
			<input type="hidden" name="columnas" value="analiscodigo,alotecodigo,itedescodigo,usuacodi,analisfecha,estanacodigo,analisdescri,analisestado">
			<input type="hidden" name="analiscodigo" value="<?php if($accionconsultarhistorialamp) echo $analiscodigo; ?>">
			<input type="hidden" name="lotecodigo" value="<?php if($accionconsultarhistorialamp) echo $analisnolote; ?>">
			<input type="hidden" name="itedescodigo" value="<?php if($accionconsultarhistorialamp) echo $itedescodigo; ?>">
			<input type="hidden" name="usuacodi" value="<?php if($accionconsultarhistorialamp) echo $usuacodi; ?>">
			<input type="hidden" name="analisfecha" value="<?php if($accionconsultarhistorialamp) echo $analisfecha; ?>">
			<input type="hidden" name="estanacodigo" value="<?php if($accionconsultarhistorialamp) echo $estanacodigo; ?>">
			<input type="hidden" name="analisdescri" value="<?php if($accionconsultarhistorialamp) echo $analisdescri; ?>">
			<input type="hidden" name="analisestado" value="<?php if($accionconsultarhistorialamp) echo $analisestado; ?>">
			<input type="hidden" name="accionconsultarhistorialamp" value="<?php echo $accionconsultarhistorialamp; ?>">
 			<input type="hidden" name="mov"> 
			<!-- Permite el cambio de checkbox/radiobuttion --> 
			<input type="hidden" name="flagcheck" value="<?php echo $flagcheck;?>">
			<!-- Campos a visualizar en maestablborrgen		-->
			<input type="hidden" name="selcampos" value="analiscodigo">
			<!--											-->
			<input type="hidden" name="arr_borrar" value="<?php echo $arr_borrar;?>">
			<input type="hidden" name="arreglo_b">
			<input type="hidden" name="seltack" id="seltack">
			<input type="hidden" name="usuacodigo" value="<?php echo $usuacodi; ?>">

			<!--											--> 
 		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div> 
		<div id="windowcerraranalisis" title="Adsum Kallpa"><span id="msg2"></span></div> 
		<div id="msgwindowanalisis" title="Adsum Kallpa"><span id="msg1"></span></div>
 	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>