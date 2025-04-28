<?php 
ini_set('display_errors',1);
include ('../src/FunGen/sesion/fnccantrow.php'); 
include ('../src/FunGen/sesion/fnccantrow1.php'); 
include ('../src/FunPerPriNiv/limitscan.php'); 
include ('../src/FunGen/sesion/fncvalses.php'); 
include ('../src/FunPerPriNiv/pktblvistasoliflexo.php');
include ('../src/FunPerPriNiv/pktblusuario.php');
include ('../src/FunPerPriNiv/pktblplanta.php');    
include ('../src/FunGen/sesion/fncalmdat.php'); 
include ('../src/FunGen/sesion/fnccaf.php'); 
$reccomact = fnccaf ( $GLOBALS [usuacodi], $_SERVER ["SCRIPT_FILENAME"] ); 
 
if ($accionborrarvistasoliflexo) { 
	include ('borravistasoliflexo.php'); 
} else { 
	if ($accionconsultarvistasoliflexo) { 
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
			$accionconsultarvistasoliflexo = 0; 
		} 
	} 
} 
include ('../src/FunGen/sesion/fncaumdec.php'); 
include ('../src/FunGen/fncpageposition.php'); 
 
$intervalo = fncaumdec ( 'vistasoliflexo', $inicio, $fin, $mov, $accionconsultarvistasoliflexo, $recarreglo ); 
$cantrow = $intervalo [total]; 
if ($intervalo [idtrans]) { 
	$idtrans = $intervalo [idtrans]; 
} 
?> 
<!-- Propiedad intelectual de Adsum SAS (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andrés A. Riascos D. 
Fecha: 20120110 
GenVers: 4.8 --> 
<!doctype html> 
<html> 
<head> 
<title>Registros de solicitud de programacion de flexografia</title> 
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
				$('#calificar').button({ icons: { primary: "ui-icon-check" } }).click(function() {

					if(document.form1.selstar.value == 1)
					{
						document.form1.action = 'calificar' + document.form1.sourcetable.value + '.php';
						document.form1.submit();
					}
					else
					{
						document.getElementById('msg').innerHTML = 'Debe seleccionar un registro.'
						$('#msgwindow').dialog('open');
					}
					
					return false;

				});



				$('#gestionar').button({ icons: { primary: "ui-icon-gear" } }).click(function() {
					if(document.form1.selstar.value == 1)
					{
						document.form1.action = 'editar' + document.form1.sourcetable.value + '.php';
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
<p><font class="NoiseFormHeaderFont">Listado de solicitudes de programacion [Flexografia]</font></p> 
<table width="850px" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content"> 
	<tr> 
		<td class="NoiseErrorDataTD" align="right"> 
	<?php 
	page_position ( $intervalo, 'maestablvistasoliflexo.php', $flagcheck ); 
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
  					echo '<button id="nuevo">Nuevo</button>&nbsp;&nbsp;';
  	
  				if($reccomact[consultar] && !$flagcheck)
  					echo '<button id="consultar">Consulta</button>&nbsp;&nbsp;';
  	
				if($reccomact[detallar] && !$flagcheck)
   					echo '<button id="detallar">Ver detalle</button>&nbsp;&nbsp;';
   	
   				if($reccomact[borrar] && !$flagcheck)
   					echo '<button id="borrar">Borrar</button>&nbsp;&nbsp;';
   	
   				if($reccomact[borrar] && $flagcheck)
   					echo '<button id="borrarselect">Borrar selecci&oacute;n</button>&nbsp;&nbsp;';
   	
   				if($reccomact[modificar] && !$flagcheck)
   					echo '<button id="gestionar">Gestionar</button>&nbsp;&nbsp;';
   		
   				if($reccomact[calificar] && !$flagcheck)
   					echo '<button id="calificar">Calificar</button>&nbsp;&nbsp;';
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
				<td width="5%" class="ui-state-default tbl-head-font">C&oacute;digo</td>
				<td width="20%" class="ui-state-default tbl-head-font">Solicitante</td>
				<td width="20%" class="ui-state-default tbl-head-font">Ubicaci&oacute;n</td>
				<td width="10%" class="ui-state-default tbl-head-font">PV</td> 
				<td width="5%" class="ui-state-default tbl-head-font">ITEM</td>
				<td width="10%" class="ui-state-default tbl-head-font">Fecha</td> 
				<td width="10%" class="ui-state-default tbl-head-font">Estado</td> 
				<td width="15%" class="ui-state-default tbl-head-font">Proceso</td> 
			</tr>
				<?php 
				include ('../src/FunGen/sesion/fncvisregvistasoliflexo.php'); 
				$reg [0] = 'solprocodigo'; 
				$reg1 [0] = 'n'; 
				$nureturn = fncvisregvistasoliflexo ( 'vistasoliflexo', $reg, $reg1, $idtrans, $arr_borrar, $flagcheck); 
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
		page_position ( $intervalo, 'maestablvistasoliflexo.php', $flagcheck ); 
		?></td> 
	</tr> 
</table> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="inicio" value="<?php echo $intervalo [inicio];	?>"> 
<input type="hidden" name="fin"	value="<?php echo $intervalo [fin];	?>"> 
<input type="hidden" name="sourcetable" value="vistasoliflexo"> 
<input type="hidden" name="selstar" id="selstar" value="0"> 
<input type="hidden" name="nombtabl" value="vistasoliflexo"> 
<input type="hidden" name="columnas" value="solprocodigo"> 
<input type="hidden" name="solprocodigo" value="<?php if ($accionconsultarvistasoliflexo) { echo $solprocodigo; } ?>">  
<input type="hidden" name="accionconsultarvistasoliflexo"	value="<?php echo $accionconsultarvistasoliflexo; ?>"> 
<input type="hidden" name="mov"><!-- Permite el cambio de checkbox/radiobuttion --> 
<input type="hidden" name="flagcheck" value="<?php echo $flagcheck; ?>"><!-- Campos a visualizar en maestablborrgen	--> 
<input type="hidden" name="selcampos" value="solprocodigo"><!--					--> 
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
