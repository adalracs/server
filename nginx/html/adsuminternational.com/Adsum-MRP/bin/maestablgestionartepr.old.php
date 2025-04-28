<?php 
ini_set('display_errors',1);
include ('../src/FunGen/sesion/fnccantrow.php'); 
include ('../src/FunGen/sesion/fnccantrow1.php'); 
include ('../src/FunPerPriNiv/limitscan.php'); 
include ('../src/FunGen/sesion/fncvalses.php'); 
include ('../src/FunPerPriNiv/pktblvistagestionartepr.php');
include ('../src/FunPerPriNiv/pktblusuario.php');
include ('../src/FunPerPriNiv/pktblplanta.php');    
include ('../src/FunGen/sesion/fncalmdat.php'); 
include ('../src/FunGen/sesion/fnccaf.php'); 
$reccomact = fnccaf ( $GLOBALS [usuacodi], $_SERVER ["SCRIPT_FILENAME"] ); 
 
if ($accionborrargestionartepr) { 
	include ('borragestionartepr.php'); 
} else { 
	if ($accionconsultargestionartepr) { 
		$nusw = 0; 
		$nombcamp = strtok ( $columnas, "," ); 
		while ( $nombcamp ) { 
			$nombcamp = trim ( $nombcamp ); 
			$recarreglo [$nombcamp] = $$nombcamp; 
			if ($recarreglo [$nombcamp]) { 
				$nusw = 1; 
			} 
			$nombcamp = strtok ( "," ); 
		} 
		if (! $nusw) { 
			$accionconsultargestionartepr = 0; 
		} 
	} 
} 
include ('../src/FunGen/sesion/fncaumdec.php'); 
include ('../src/FunGen/fncpageposition.php'); 
 
$intervalo = fncaumdec ( 'vistagestionartepr', $inicio, $fin, $mov, $accionconsultargestionartepr, $recarreglo ); 
$cantrow = $intervalo [total]; 
if ($intervalo [idtrans]) { 
	$idtrans = $intervalo [idtrans]; 
} 
?> 

<!doctype html> 
<html> 
<head> 
<title>ordenes de produccion programadas {opp} arte y prepensa</title> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF8"> 
<meta http-equiv="expires" content="0"> 
<meta http-equiv="X-UA-Compatible" content="IE=9"> 
<script language=JavaScript src="../src/FunGen/starPage_position.js" type="text/javascript"></script> 
<script language="JavaScript" type="text/javascript" src="../src/FunGen/fncsetcheck.js"></script> 
<script language="javascript" type="text/javascript" src="../src/FunGen/fncremembercheck.js"></script> 
<script language=JavaScript src="../src/FunGen/colorfooter.js" type="text/javascript"></script> 
<?php 
include ('../def/jquery.library_maestro.php'); 
?> 
</head> 
<?php 
if (! $codigo) { 
	echo "<!--"; 
} 
?> 
<script type="text/javascript">
	$(function(){
		$('#gestionar').button({ icons: { primary: "ui-icon-gear" } }).click(function() {
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
		
		$('#reporte').button({ icons: { primary: "ui-icon-gear" }}).click(function(){
			if(document.form1.selstar.value == 1)
			{
				document.form1.action = 'ingrnuevreporte' + document.form1.sourcetable.value + '.php';
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
<body bgcolor="FFFFFF" class="NoisePageBODY"> 
<form name="form1" method="post" enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Gestion de ordenes {opp} arte de preprensa</font></p> 
<table border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content" width="99%"> 
	<tr> 
		<td class="NoiseErrorDataTD" align="right"> 
	<?php 
	page_position ( $intervalo, 'maestablgestionartepr.php', $flagcheck ); 
	?></td> 
	</tr> 
	<tr> 
		<td>&nbsp;</td> 
	</tr> 
	<tr> 
		<td align="left" class="NoiseErrorDataTD">
			<div class="ui-buttonset">
			<?php  		
				if($reccomact[nuevo] && !$flagcheck)
  					echo '<button id="gestionar">Gestionar</button>&nbsp;&nbsp;';
  	
  				if($reccomact[consultar] && !$flagcheck)
  					echo '<button id="consultar">Consulta</button>&nbsp;&nbsp;';
  	
				if($reccomact[detallar] && !$flagcheck)
   					echo '<button id="detallar">Ver detalle</button>&nbsp;&nbsp;';
   	
   				if($reccomact[reporte] && !$flagcheck)
  					echo '<button id="reporte">Reportar OPP</button>&nbsp;&nbsp;';
			?>
			</div>
		</td> 
	</tr> 
	<tr> 
		<td>&nbsp;</td> 
	</tr> 
	<tr> 
		<td><?php 
		include ('../def/jquery.button_navup.php')?></td> 
	</tr> 
	<tr> 
		<td></td> 
	</tr> 
	<tr> 
		<td></td> 
	</tr> 
	<tr> 
		<td> 
		<table width="100%" border="0" align="center" cellspacing="1" 
			cellpadding="1" class="ui-widget-content"> 
			<tr> 
				<td class="ui-state-default tbl-head-font">Sel.</td>
				<td width="4%" class="ui-state-default tbl-head-font">OPP</td>
				<td width="6%" class="ui-state-default tbl-head-font">Fecha P.</td>
				<td width="2%" class="ui-state-default tbl-head-font">O.E</td> 
				<td width="18%" class="ui-state-default tbl-head-font">Equipo</td>
				<td width="15%" class="ui-state-default tbl-head-font">Ruta</td> 
				<td width="5%" class="ui-state-default tbl-head-font">PV</td> 
				<td width="5%" class="ui-state-default tbl-head-font">Item</td>
				<td width="30%" class="ui-state-default tbl-head-font">Ref.</td>
				<td width="15%" class="ui-state-default tbl-head-font">Estado</td>
			</tr>
				<?php 
				include ('../src/FunGen/sesion/fncvisreggestionartepr.php'); 
				$reg [0] = 'ordoppcodigo'; 
				$reg1 [0] = 'n'; 
				$nureturn = fncvisreggestionartepr ( 'gestionartepr', $reg, $reg1, $idtrans, $arr_borrar, $flagcheck); 
				?> 
		</table> 
		</td> 
	</tr> 
	<tr> 
		<td></td> 
	</tr> 
	<tr> 
		<td></td> 
	</tr> 
	<tr> 
		<td><?php 
		include ('../def/jquery.button_navdown.php')?></td> 
	</tr> 
	<tr> 
		<td>&nbsp;</td> 
	</tr> 
	<tr> 
		<td class="NoiseErrorDataTD" align="right"> <?php 
		page_position ( $intervalo, 'maestablgestionartepr.php', $flagcheck ); 
		?></td> 
	</tr> 
</table> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="inicio" value="<?php echo $intervalo [inicio];	?>"> 
<input type="hidden" name="fin"	value="<?php echo $intervalo [fin];	?>"> 
<input type="hidden" name="sourcetable" value="gestionartepr"> 
<input type="hidden" name="selstar" id="selstar" value="0"> 
<input type="hidden" name="nombtabl" value="vistagestionartepr"> 
<input type="hidden" name="columnas" value="ordoppcodigo"> 
<input type="hidden" name="ordoppcodigo" value="<?php if ($accionconsultargestionartepr) { echo $ordoppcodigo; } ?>">  
<input type="hidden" name="accionconsultargestionartepr"	value="<?php echo $accionconsultargestionartepr; ?>"> 
<input type="hidden" name="mov"><!-- Permite el cambio de checkbox/radiobuttion --> 
<input type="hidden" name="flagcheck" value="<?php echo $flagcheck; ?>"><!-- Campos a visualizar en maestablborrgen	--> 
<input type="hidden" name="selcampos" value="ordoppcodigo"><!--					--> 
<input type="hidden" name="arr_borrar" value="<?php echo $arr_borrar; ?>"> 
<input type="hidden" name="arreglo_b"> <!--						--></form> 
<input type="hidden" name="vistares" id="vistares" value="1"> 
<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div> 
</body> 
<?php 
if (! $codigo) { 
	echo " -->"; 
} 
?> 
</html> 
