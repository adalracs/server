<?php
	include ( '../src/FunGen/sesion/fnccantrownew.php');
	include ( '../src/FunGen/sesion/fnccantrow1.php');
	include ( '../src/FunGen/sesion/fnccantrow.php');
	include ( '../src/FunPerPriNiv/limitscanot.php');
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblot.php');
	include ( '../src/FunPerPriNiv/pktblotestado.php');
	include ( '../src/FunPerPriNiv/pktbltareot.php');
	include ( '../src/FunPerPriNiv/pktbltarea.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblsistema.php');
	include ( '../src/FunPerPriNiv/pktbltipotrab.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktblpriorida.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblusuariotareot.php');
	include ( '../src/FunPerPriNiv/limitscanvistas.php');
	include ( '../src/FunPerPriNiv/pktblvistaotp.php');  
	include ( '../src/FunGen/sesion/fncalmdat.php');
	include ( '../src/FunGen/sesion/fnccaf.php');
	
	$_SESSION['masterot'] = 1;

	$flagsoliot = 1;
	$flagsoliotitem = 1;
	$reccomact =  fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]);

	if($accionconsultarotp)
	{
		$recon = 1;
		$nusw = 0;
		$nombcamp = strtok ($columnas,",");
		while ($nombcamp)
		{
			$nombcamp = trim($nombcamp);
			$recarreglo[$nombcamp] = $$nombcamp;
			if($recarreglo[$nombcamp] != null) $nusw =1;
			$nombcamp = strtok(",");
		}
		if(!$nusw)
			$accionconsultarotp = 0;
	}
	
	include ( '../src/FunGen/sesion/fncaumdec.php');
	include('../src/FunGen/fncpageposition.php');
	$intervalo = fncaumdec('vistaotp',$inicio,$fin,$mov,$accionconsultarotp,$recarreglo);
	$cantrow = $intervalo[total];
	if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans];}
?>
<html> 
	<head> 
		<title>Registros de ordenes de trabajo programada</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<script language=JavaScript src="../src/FunGen/starPage_position.js" type="text/javascript" ></script>
		<script language="JavaScript" type="text/javascript" src="../src/FunGen/fncsetcheck.js"></script>
		<script language="javascript" type="text/javascript" src="../src/FunGen/fncremembercheck.js"></script>
		<script language=JavaScript src="../src/FunGen/colorfooter.js" type="text/javascript" ></script>
		
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript">
			$(function(){
				$('#imprimir').button({ icons: { primary: "ui-icon-print" }}).click(function(){
					if(document.form1.selstar.value == 1)
					{
						var arrCode =  document.form1.printotp.value.split('|n');
						window.open('imprimirotp.php?ordtranumpro=' + arrCode[0],'impresion','width=800, height=650, scrollbars=yes');
					}
					else
					{
						document.getElementById('msg').innerHTML = 'Debe seleccionar un registro.'
						$('#msgwindow').dialog('open');
					}
					
					return false;
				});
				
				$('#reporte').button({ icons: { primary: "ui-icon-gear" }}).click(function(){
					if(document.form1.selstar.value == 1)
					{
						document.form1.action = 'ingrnuev' + document.form1.sourcetable.value + '.php';
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
			<p><font class="NoiseFormHeaderFont">Listado de ordenes de trabajo progragamdas</font></p> 
			<table border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content" width="700"> 
 				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablotp.php',$flagcheck); ?></td></tr>
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
								<td width="4%" class="ui-state-default tbl-head-font">Sel.</td> 
								<td width="10%" class="ui-state-default tbl-head-font">Num OTP</td> 
								<td width="35%" class="ui-state-default tbl-head-font">Ubicaci&oacute;n</td>
								<td width="28%" class="ui-state-default tbl-head-font">Tarea</td> 
								<td width="23%" class="ui-state-default tbl-head-font">Tipo trabajo</td> 
							</tr>
							<?php 
								include ( '../src/FunGen/sesion/fncvisregvistaotp.php');
								$reg[0] = 'ordtranumpro';
								$reg1[0] = 'n';
								$nureturn = fncvisregvistaotp('vistaotp', $reg, $reg1, $idtrans, $arr_borrar, $flagcheck);
							?> 
   						</table> 
   					</td> 
  				</tr> 
  				<tr><td></td></tr>
		    	<tr><td></td></tr>
  				<tr><td><?php include ('../def/jquery.button_navdown.php') ?></td></tr> 
  				<tr><td>&nbsp;</td></tr>
  				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablotp.php',$flagcheck); ?></td></tr> 				
 			</table> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
 			<input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
 			<input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>"> 
 			<input type="hidden" name="nombtabl" value="otp"> 
  			<input type="hidden" name="sourcetable" value="otp"> 
 			<input type="hidden" name="selstar" id="selstar" value="0">  
			<input type="hidden" name="columnas" value="ordtranumpro,plantacodigo,tiptracodigo,tareacodigo">
			<input type="hidden" name="plantacodigo" value="<?php if($accionconsultarotp) echo $plantacodigo; ?>">
			<input type="hidden" name="tiptracodigo" value="<?php if($accionconsultarotp) echo $tiptracodigo; ?>">
			<input type="hidden" name="tareacodigo" value="<?php if($accionconsultarotp) echo $tareacodigo; ?>">
			<input type="hidden" name="ordtranumpro" value="<?php if($accionconsultarotp) echo $ordtranumpro; ?>">
			<input type="hidden" name="printotp" id="printotp">
			<input type="hidden" name="accionconsultarotp"	value="<?php  echo $accionconsultarotp; ?>">
			<input type="hidden" name="flagsoliotitem" value="1">
			<input type="hidden" name="mov"> <!-- Permite el cambio de checkbox/radiobuttion -->
			<input type="hidden" name="flagcheck" value="<?php  echo $flagcheck;?>">
			<!-- Campos a visualizar en maestablborrgen		-->
			<input type="hidden" name="selcampos" value="ordtranumpro,plantacodigo,tiptracodigo,tareacodigo">
			<input type="hidden" name="arr_borrar" value="<?php  echo $arr_borrar;?>">
			<input type="hidden" name="arreglo_b">
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>